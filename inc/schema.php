<?php
/**
 * GtaLobby — Schema / JSON-LD Structured Data
 *
 * Outputs JSON-LD schema for:
 * - Article (posts, guides, recaps)
 * - FAQPage (hub pages with FAQ)
 * - HowTo (guides with steps)
 * - ItemList (rankings)
 * - SoftwareApplication (mod listings)
 * - Dataset (database posts)
 * - Organization (sitewide)
 *
 * @package GtaLobby
 */

defined( 'ABSPATH' ) || exit;

/**
 * Output JSON-LD schema in wp_head.
 */
function gtalobby_output_schema() {
    if ( ! gtalobby_get_seo_option( 'enable_json_ld' ) ) {
        return;
    }

    $schemas = array();

    // Organization — always present
    $schemas[] = gtalobby_schema_organization();

    // WebSite
    if ( is_front_page() ) {
        $schemas[] = gtalobby_schema_website();
    }

    // Singular pages
    if ( is_singular() ) {
        $post_type = get_post_type();

        // Article schema for most types
        if ( gtalobby_get_seo_option( 'enable_article_schema' ) ) {
            $schemas[] = gtalobby_schema_article();
        }

        // Type-specific schemas
        switch ( $post_type ) {
            case 'guide':
                if ( gtalobby_get_seo_option( 'enable_howto_schema' ) ) {
                    $howto = gtalobby_schema_howto();
                    if ( $howto ) {
                        $schemas[] = $howto;
                    }
                }
                break;

            case 'ranking':
                $schemas[] = gtalobby_schema_itemlist();
                break;

            case 'mod':
                $schemas[] = gtalobby_schema_software_application();
                break;

            case 'database':
                $schemas[] = gtalobby_schema_dataset();
                break;

            case 'answer':
                if ( gtalobby_get_seo_option( 'enable_faq_schema' ) ) {
                    $schemas[] = gtalobby_schema_faq_from_answer();
                }
                break;
        }

        // Hub pages with FAQ
        if ( is_page_template( 'page-hub.php' ) && gtalobby_get_seo_option( 'enable_faq_schema' ) ) {
            $faq = gtalobby_schema_faq_from_hub();
            if ( $faq ) {
                $schemas[] = $faq;
            }
        }
    }

    // Output
    foreach ( $schemas as $schema ) {
        if ( ! empty( $schema ) ) {
            echo "\n<script type=\"application/ld+json\">\n";
            echo wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
            echo "\n</script>\n";
        }
    }
}
add_action( 'wp_head', 'gtalobby_output_schema', 25 );

/* ================================================================
   SCHEMA BUILDERS
   ================================================================ */

/**
 * Organization schema.
 */
function gtalobby_schema_organization() {
    $schema = array(
        '@context' => 'https://schema.org',
        '@type'    => 'Organization',
        'name'     => gtalobby_get_seo_option( 'org_name' ) ?: get_bloginfo( 'name' ),
        'url'      => home_url( '/' ),
    );

    $logo = gtalobby_get_seo_option( 'org_logo_url' );
    if ( ! $logo ) {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        if ( $custom_logo_id ) {
            $logo = wp_get_attachment_image_url( $custom_logo_id, 'full' );
        }
    }
    if ( $logo ) {
        $schema['logo'] = array(
            '@type' => 'ImageObject',
            'url'   => $logo,
        );
    }

    $schema['sameAs'] = array();

    return $schema;
}

/**
 * WebSite schema (for front page — enables sitelinks search box).
 */
function gtalobby_schema_website() {
    return array(
        '@context'        => 'https://schema.org',
        '@type'           => 'WebSite',
        'name'            => get_bloginfo( 'name' ),
        'url'             => home_url( '/' ),
        'potentialAction' => array(
            '@type'       => 'SearchAction',
            'target'      => array(
                '@type'        => 'EntryPoint',
                'urlTemplate'  => home_url( '/?s={search_term_string}' ),
            ),
            'query-input' => 'required name=search_term_string',
        ),
    );
}

/**
 * Article schema for singular posts.
 */
function gtalobby_schema_article() {
    $post_id   = get_the_ID();
    $post_type = get_post_type();

    $article_type = 'Article';
    if ( in_array( $post_type, array( 'recap', 'answer' ), true ) ) {
        $article_type = 'NewsArticle';
    }

    $schema = array(
        '@context'         => 'https://schema.org',
        '@type'            => $article_type,
        'headline'         => get_the_title(),
        'url'              => get_permalink(),
        'datePublished'    => get_the_date( 'c' ),
        'dateModified'     => get_the_modified_date( 'c' ),
        'mainEntityOfPage' => array(
            '@type' => 'WebPage',
            '@id'   => get_permalink(),
        ),
        'author'           => array(
            '@type' => 'Person',
            'name'  => get_the_author(),
            'url'   => get_author_posts_url( get_the_author_meta( 'ID' ) ),
        ),
        'publisher'        => array(
            '@type' => 'Organization',
            'name'  => gtalobby_get_seo_option( 'org_name' ) ?: get_bloginfo( 'name' ),
        ),
    );

    // Featured image
    if ( has_post_thumbnail() ) {
        $img_id   = get_post_thumbnail_id();
        $img_data = wp_get_attachment_image_src( $img_id, 'full' );
        if ( $img_data ) {
            $schema['image'] = array(
                '@type'  => 'ImageObject',
                'url'    => $img_data[0],
                'width'  => $img_data[1],
                'height' => $img_data[2],
            );
        }
    }

    // Description
    $excerpt = get_the_excerpt();
    if ( $excerpt ) {
        $schema['description'] = wp_strip_all_tags( $excerpt );
    }

    // Word count
    $content    = get_post_field( 'post_content', $post_id );
    $word_count = str_word_count( wp_strip_all_tags( $content ) );
    if ( $word_count > 0 ) {
        $schema['wordCount'] = $word_count;
    }

    return $schema;
}

/**
 * HowTo schema for guides with steps.
 */
function gtalobby_schema_howto() {
    $post_id    = get_the_ID();
    $difficulty = get_post_meta( $post_id, 'difficulty_rating', true );
    $time       = get_post_meta( $post_id, 'time_to_complete', true );

    // Extract steps from content headings or ACF steps
    $steps = array();

    // Try ACF install_steps first (for mod type)
    $acf_steps = get_post_meta( $post_id, 'install_steps', true );
    if ( is_array( $acf_steps ) && ! empty( $acf_steps ) ) {
        foreach ( $acf_steps as $i => $step ) {
            $steps[] = array(
                '@type' => 'HowToStep',
                'name'  => isset( $step['step_title'] ) ? $step['step_title'] : sprintf( 'Step %d', $i + 1 ),
                'text'  => isset( $step['step_content'] ) ? wp_strip_all_tags( $step['step_content'] ) : '',
            );
        }
    }

    // Fallback: extract from H3 headings in content
    if ( empty( $steps ) ) {
        $content = get_the_content();
        preg_match_all( '/<h3[^>]*>(.*?)<\/h3>/i', $content, $matches );
        if ( ! empty( $matches[1] ) ) {
            foreach ( $matches[1] as $heading ) {
                $steps[] = array(
                    '@type' => 'HowToStep',
                    'name'  => wp_strip_all_tags( $heading ),
                    'text'  => wp_strip_all_tags( $heading ),
                );
            }
        }
    }

    if ( empty( $steps ) ) {
        return null;
    }

    $schema = array(
        '@context' => 'https://schema.org',
        '@type'    => 'HowTo',
        'name'     => get_the_title(),
        'step'     => $steps,
    );

    if ( $time ) {
        $schema['totalTime'] = 'PT' . intval( $time ) . 'M';
    }

    if ( has_post_thumbnail() ) {
        $schema['image'] = get_the_post_thumbnail_url( null, 'full' );
    }

    return $schema;
}

/**
 * ItemList schema for rankings.
 */
function gtalobby_schema_itemlist() {
    $post_id      = get_the_ID();
    $ranked_items = get_post_meta( $post_id, 'ranked_items', true );

    $list_items = array();

    if ( is_array( $ranked_items ) && ! empty( $ranked_items ) ) {
        foreach ( $ranked_items as $i => $item ) {
            $list_item = array(
                '@type'    => 'ListItem',
                'position' => isset( $item['rank'] ) ? intval( $item['rank'] ) : ( $i + 1 ),
                'name'     => isset( $item['item_name'] ) ? $item['item_name'] : '',
            );

            if ( ! empty( $item['item_description'] ) ) {
                $list_item['description'] = $item['item_description'];
            }

            $list_items[] = $list_item;
        }
    }

    if ( empty( $list_items ) ) {
        // Fallback: use numbered list from content
        return array(
            '@context' => 'https://schema.org',
            '@type'    => 'ItemList',
            'name'     => get_the_title(),
            'url'      => get_permalink(),
        );
    }

    return array(
        '@context'        => 'https://schema.org',
        '@type'           => 'ItemList',
        'name'            => get_the_title(),
        'url'             => get_permalink(),
        'numberOfItems'   => count( $list_items ),
        'itemListElement' => $list_items,
    );
}

/**
 * SoftwareApplication schema for mod listings.
 */
function gtalobby_schema_software_application() {
    $post_id = get_the_ID();

    $schema = array(
        '@context'            => 'https://schema.org',
        '@type'               => 'SoftwareApplication',
        'name'                => get_the_title(),
        'url'                 => get_permalink(),
        'applicationCategory' => 'Game Modification',
        'operatingSystem'     => 'Windows',
    );

    $version   = get_post_meta( $post_id, 'mod_version', true );
    $file_size = get_post_meta( $post_id, 'file_size', true );
    $author    = get_post_meta( $post_id, 'author_name', true );

    if ( $version ) {
        $schema['softwareVersion'] = $version;
    }
    if ( $file_size ) {
        $schema['fileSize'] = $file_size;
    }
    if ( $author ) {
        $schema['author'] = array(
            '@type' => 'Person',
            'name'  => $author,
        );
    }

    $download = get_post_meta( $post_id, 'download_url', true );
    if ( $download ) {
        $schema['downloadUrl'] = $download;
    }

    if ( has_post_thumbnail() ) {
        $schema['image'] = get_the_post_thumbnail_url( null, 'full' );
    }

    return $schema;
}

/**
 * Dataset schema for database posts.
 */
function gtalobby_schema_dataset() {
    $post_id = get_the_ID();

    $schema = array(
        '@context'    => 'https://schema.org',
        '@type'       => 'Dataset',
        'name'        => get_the_title(),
        'url'         => get_permalink(),
        'description' => wp_strip_all_tags( get_the_excerpt() ),
    );

    $source       = get_post_meta( $post_id, 'data_source', true );
    $last_updated = get_post_meta( $post_id, 'data_last_updated', true );

    if ( $source ) {
        $schema['creator'] = array(
            '@type' => 'Organization',
            'name'  => $source,
        );
    }

    if ( $last_updated ) {
        $schema['dateModified'] = $last_updated;
    }

    $schema['license'] = 'https://creativecommons.org/licenses/by-nc/4.0/';

    return $schema;
}

/**
 * FAQ schema from hub page FAQ repeater.
 */
function gtalobby_schema_faq_from_hub() {
    $post_id   = get_the_ID();
    $faq_items = get_post_meta( $post_id, 'hub_faq_items', true );

    if ( ! is_array( $faq_items ) || empty( $faq_items ) ) {
        return null;
    }

    $questions = array();
    foreach ( $faq_items as $faq ) {
        if ( ! empty( $faq['question'] ) && ! empty( $faq['answer'] ) ) {
            $questions[] = array(
                '@type'          => 'Question',
                'name'           => $faq['question'],
                'acceptedAnswer' => array(
                    '@type' => 'Answer',
                    'text'  => wp_strip_all_tags( $faq['answer'] ),
                ),
            );
        }
    }

    if ( empty( $questions ) ) {
        return null;
    }

    return array(
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => $questions,
    );
}

/**
 * FAQ schema from Quick Answer post type.
 */
function gtalobby_schema_faq_from_answer() {
    $post_id      = get_the_ID();
    $short_answer = get_post_meta( $post_id, 'short_answer', true );

    if ( empty( $short_answer ) ) {
        return null;
    }

    $questions = array(
        array(
            '@type'          => 'Question',
            'name'           => get_the_title(),
            'acceptedAnswer' => array(
                '@type' => 'Answer',
                'text'  => wp_strip_all_tags( $short_answer ),
            ),
        ),
    );

    // Add related questions if available
    $related = get_post_meta( $post_id, 'related_questions', true );
    if ( is_array( $related ) ) {
        foreach ( $related as $rq ) {
            if ( ! empty( $rq['question'] ) && ! empty( $rq['answer'] ) ) {
                $questions[] = array(
                    '@type'          => 'Question',
                    'name'           => $rq['question'],
                    'acceptedAnswer' => array(
                        '@type' => 'Answer',
                        'text'  => wp_strip_all_tags( $rq['answer'] ),
                    ),
                );
            }
        }
    }

    return array(
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => $questions,
    );
}
