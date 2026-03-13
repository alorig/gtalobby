<?php
/**
 * GtaLobby — Internal Linking Engine
 *
 * Handles automatic internal link insertion, hub page link widgets,
 * sibling/cross-cluster queries, and link density management.
 *
 * @package GtaLobby
 */

defined( 'ABSPATH' ) || exit;

/* ================================================================
   1. AUTO INTERNAL LINKS — inject links into post content
   ================================================================ */

/**
 * Auto-insert internal links into post content.
 * Links hub page keywords, sibling posts, and cross-cluster content.
 *
 * @param string $content Post content.
 * @return string Modified content.
 */
function gtalobby_auto_internal_links( $content ) {
    if ( ! is_singular() || ! gtalobby_is_enabled( 'enable_interlinking' ) ) {
        return $content;
    }

    $max_links   = gtalobby_get_seo_option( 'max_auto_links_per_post' );
    $post_id     = get_the_ID();
    $links_added = 0;

    if ( $max_links <= 0 ) {
        return $content;
    }

    // Get link targets: hub page, sibling posts, cross-cluster hubs
    $targets = gtalobby_get_link_targets( $post_id );

    if ( empty( $targets ) ) {
        return $content;
    }

    foreach ( $targets as $target ) {
        if ( $links_added >= $max_links ) {
            break;
        }

        $keyword = preg_quote( $target['keyword'], '/' );

        // Only link first occurrence, not inside existing links/headings
        $pattern = '/(?<!["\'>\/])(?<!\<a[^>]*>)\b(' . $keyword . ')\b(?![^<]*<\/a>)(?![^<]*<\/h[1-6]>)/iu';

        $replacement = '<a href="' . esc_url( $target['url'] ) . '" class="gl-autolink" title="' . esc_attr( $target['title'] ) . '">$1</a>';

        $content = preg_replace( $pattern, $replacement, $content, 1, $count );

        if ( $count > 0 ) {
            $links_added++;
        }
    }

    return $content;
}
add_filter( 'the_content', 'gtalobby_auto_internal_links', 20 );

/**
 * Gather link targets for auto-linking.
 *
 * @param int $post_id Current post ID.
 * @return array Array of [ 'keyword' => '', 'url' => '', 'title' => '' ]
 */
function gtalobby_get_link_targets( $post_id ) {
    $targets = array();

    // 1. Hub page (if post is assigned to one)
    $hub_id = get_post_meta( $post_id, 'hub_page_assignment', true );
    if ( $hub_id ) {
        $hub_keyword = get_post_meta( $hub_id, 'hub_primary_keyword', true );
        if ( $hub_keyword ) {
            $targets[] = array(
                'keyword' => $hub_keyword,
                'url'     => get_permalink( $hub_id ),
                'title'   => get_the_title( $hub_id ),
            );
        }
    }

    // 2. Cross-cluster hubs (from hub's cross_cluster_links)
    if ( $hub_id ) {
        $cross_links = get_post_meta( $hub_id, 'hub_cross_cluster_links', true );
        if ( is_array( $cross_links ) ) {
            foreach ( array_slice( $cross_links, 0, 3 ) as $cross_hub_id ) {
                $cross_keyword = get_post_meta( $cross_hub_id, 'hub_primary_keyword', true );
                if ( $cross_keyword ) {
                    $targets[] = array(
                        'keyword' => $cross_keyword,
                        'url'     => get_permalink( $cross_hub_id ),
                        'title'   => get_the_title( $cross_hub_id ),
                    );
                }
            }
        }
    }

    // 3. Sibling posts (same hub, different post)
    if ( $hub_id ) {
        $siblings = gtalobby_get_hub_siblings( $post_id, $hub_id, 3 );
        foreach ( $siblings as $sibling ) {
            $targets[] = array(
                'keyword' => $sibling->post_title,
                'url'     => get_permalink( $sibling->ID ),
                'title'   => $sibling->post_title,
            );
        }
    }

    // 4. Category hub pages
    $cat = gtalobby_get_primary_category( $post_id );
    if ( $cat ) {
        $cat_hubs = gtalobby_get_category_hubs( $cat->slug, 2, $hub_id ? array( $hub_id ) : array() );
        foreach ( $cat_hubs as $cat_hub ) {
            $cat_keyword = get_post_meta( $cat_hub->ID, 'hub_primary_keyword', true );
            if ( $cat_keyword ) {
                $targets[] = array(
                    'keyword' => $cat_keyword,
                    'url'     => get_permalink( $cat_hub->ID ),
                    'title'   => $cat_hub->post_title,
                );
            }
        }
    }

    return $targets;
}

/* ================================================================
   2. HUB SIBLING QUERIES
   ================================================================ */

/**
 * Get sibling posts from the same hub.
 *
 * @param int $post_id    Current post ID.
 * @param int $hub_id     Hub page ID.
 * @param int $count      Number of siblings.
 * @return WP_Post[]
 */
function gtalobby_get_hub_siblings( $post_id, $hub_id, $count = 5 ) {
    $child_ids = get_post_meta( $hub_id, 'hub_child_posts', true );

    if ( ! is_array( $child_ids ) || empty( $child_ids ) ) {
        // Fallback: query by hub_page_assignment meta
        $query = new WP_Query( array(
            'post_type'      => gtalobby_get_post_types(),
            'posts_per_page' => $count,
            'post__not_in'   => array( $post_id ),
            'post_status'    => 'publish',
            'meta_key'       => 'hub_page_assignment',
            'meta_value'     => $hub_id,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ) );
        return $query->posts;
    }

    $sibling_ids = array_diff( $child_ids, array( $post_id ) );
    if ( empty( $sibling_ids ) ) {
        return array();
    }

    $query = new WP_Query( array(
        'post__in'       => array_slice( $sibling_ids, 0, $count ),
        'post_type'      => 'any',
        'posts_per_page' => $count,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    ) );

    return $query->posts;
}

/* ================================================================
   3. CATEGORY HUB QUERIES
   ================================================================ */

/**
 * Get hub pages for a specific SAG category.
 *
 * @param string $category_slug Category slug.
 * @param int    $count         Number of hubs.
 * @param array  $exclude       Hub IDs to exclude.
 * @return WP_Post[]
 */
function gtalobby_get_category_hubs( $category_slug, $count = 5, $exclude = array() ) {
    $args = array(
        'post_type'      => 'page',
        'posts_per_page' => $count,
        'post_status'    => 'publish',
        'meta_query'     => array(
            array(
                'key'     => '_wp_page_template',
                'value'   => 'page-hub.php',
                'compare' => '=',
            ),
        ),
        'category_name'  => $category_slug,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    );

    if ( ! empty( $exclude ) ) {
        $args['post__not_in'] = $exclude;
    }

    $query = new WP_Query( $args );
    return $query->posts;
}

/**
 * Get all hub pages grouped by SAG category.
 *
 * @return array Keyed by category slug.
 */
function gtalobby_get_all_hubs_by_category() {
    static $cache = null;
    if ( $cache !== null ) {
        return $cache;
    }

    $cache = array();
    $sag   = gtalobby_get_sag_categories();

    foreach ( array_keys( $sag ) as $slug ) {
        $cache[ $slug ] = gtalobby_get_category_hubs( $slug, 50 );
    }

    return $cache;
}

/* ================================================================
   4. CROSS-CLUSTER LINK DISPLAY
   ================================================================ */

/**
 * Display cross-cluster links for a hub page.
 *
 * @param int|null $hub_id Optional. Defaults to current post.
 */
function gtalobby_cross_cluster_links( $hub_id = null ) {
    $hub_id      = $hub_id ?: get_the_ID();
    $cross_links = get_post_meta( $hub_id, 'hub_cross_cluster_links', true );

    if ( ! is_array( $cross_links ) || empty( $cross_links ) ) {
        return;
    }

    echo '<div class="gl-cross-cluster">';
    echo '<h3 class="gl-cross-cluster__title">' . esc_html__( 'Related Topics', 'gtalobby' ) . '</h3>';
    echo '<div class="gl-cross-cluster__links">';

    foreach ( $cross_links as $link_hub_id ) {
        $title = get_the_title( $link_hub_id );
        $url   = get_permalink( $link_hub_id );

        if ( ! $title || ! $url ) {
            continue;
        }

        // Get hub's category for color
        $hub_cats = get_the_category( $link_hub_id );
        $color    = '';
        if ( $hub_cats ) {
            $color = gtalobby_get_category_color( $hub_cats[0]->slug );
        }

        printf(
            '<a href="%s" class="gl-cross-cluster__link" %s>%s</a>',
            esc_url( $url ),
            $color ? 'style="--link-accent:' . esc_attr( $color ) . '"' : '',
            esc_html( $title )
        );
    }

    echo '</div></div>';
}

/* ================================================================
   5. LINK DENSITY CHECKER
   ================================================================ */

/**
 * Count internal links in post content.
 *
 * @param int|null $post_id Optional.
 * @return int Link count.
 */
function gtalobby_count_internal_links( $post_id = null ) {
    $post_id = $post_id ?: get_the_ID();
    $content = get_post_field( 'post_content', $post_id );
    $home    = preg_quote( home_url(), '/' );

    preg_match_all( '/<a[^>]+href=["\'](' . $home . '[^"\']*)["\'][^>]*>/i', $content, $matches );

    return count( $matches[0] );
}

/**
 * Check if a post needs more internal links.
 *
 * @param int|null $post_id Optional.
 * @return bool
 */
function gtalobby_needs_more_links( $post_id = null ) {
    $post_id     = $post_id ?: get_the_ID();
    $link_count  = gtalobby_count_internal_links( $post_id );
    $target      = gtalobby_get_seo_option( 'link_density_target' );
    $word_count  = str_word_count( wp_strip_all_tags( get_post_field( 'post_content', $post_id ) ) );

    // Target: roughly $target links per 1000 words
    $expected = max( 1, floor( ( $word_count / 1000 ) * $target ) );

    return $link_count < $expected;
}

/* ================================================================
   6. HUB CHILD POSTS WIDGET
   ================================================================ */

/**
 * Display a compact list of hub child posts (for sidebars).
 *
 * @param int $hub_id Hub page ID.
 * @param int $count  Number of items.
 */
function gtalobby_hub_children_list( $hub_id, $count = 10 ) {
    $children = gtalobby_get_hub_siblings( 0, $hub_id, $count );

    if ( empty( $children ) ) {
        return;
    }

    echo '<div class="gl-hub-children">';
    echo '<h4 class="gl-hub-children__title">' . esc_html__( 'In This Topic', 'gtalobby' ) . '</h4>';
    echo '<ul class="gl-hub-children__list">';

    foreach ( $children as $child ) {
        $info      = gtalobby_get_post_type_info( $child->post_type );
        $is_active = ( get_the_ID() === $child->ID ) ? ' gl-hub-children__item--active' : '';

        printf(
            '<li class="gl-hub-children__item%s"><a href="%s"><span class="gl-hub-children__type" style="color:%s">%s</span> %s</a></li>',
            esc_attr( $is_active ),
            esc_url( get_permalink( $child->ID ) ),
            esc_attr( $info['color'] ),
            esc_html( $info['label'] ),
            esc_html( $child->post_title )
        );
    }

    echo '</ul></div>';
}
