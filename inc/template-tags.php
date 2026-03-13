<?php
/**
 * GtaLobby — Template Tags
 *
 * Reusable template output functions for cards, badges, metadata,
 * post-type-specific components, and UI helpers.
 *
 * @package GtaLobby
 */

defined( 'ABSPATH' ) || exit;

/* ================================================================
   1. POST TYPE BADGE
   ================================================================ */

/**
 * Display a colored post-type badge.
 *
 * @param string|null $post_type Optional. Defaults to current.
 * @param bool        $link      Whether to link to the archive.
 */
function gtalobby_post_type_badge( $post_type = null, $link = true ) {
    if ( ! gtalobby_is_enabled( 'show_post_type_badge' ) ) {
        return;
    }

    $info = gtalobby_get_post_type_info( $post_type );
    $pt   = $post_type ?: get_post_type();

    $badge = sprintf(
        '<span class="gl-badge gl-badge--post-type gl-badge--%s" style="--badge-color:%s">%s</span>',
        esc_attr( $pt ),
        esc_attr( $info['color'] ),
        esc_html( $info['label'] )
    );

    if ( $link ) {
        $archive = get_post_type_archive_link( $pt );
        if ( $archive ) {
            $badge = '<a href="' . esc_url( $archive ) . '" class="gl-badge-link">' . $badge . '</a>';
        }
    }

    echo $badge;
}

/* ================================================================
   2. CATEGORY BADGE
   ================================================================ */

/**
 * Display the primary category badge with accent color.
 *
 * @param int|null $post_id Optional.
 */
function gtalobby_category_badge( $post_id = null ) {
    $cat = gtalobby_get_primary_category( $post_id );
    if ( ! $cat ) {
        return;
    }

    $color = gtalobby_get_category_color( $cat->slug );
    printf(
        '<a href="%s" class="gl-badge gl-badge--category" style="--badge-color:%s">%s</a>',
        esc_url( get_category_link( $cat->term_id ) ),
        esc_attr( $color ),
        esc_html( $cat->name )
    );
}

/* ================================================================
   3. READING TIME
   ================================================================ */

/**
 * Calculate and display reading time.
 *
 * @param int|null $post_id Optional.
 */
function gtalobby_reading_time( $post_id = null ) {
    if ( ! gtalobby_is_enabled( 'show_reading_time' ) ) {
        return;
    }

    $post_id = $post_id ?: get_the_ID();
    $content = get_post_field( 'post_content', $post_id );
    $words   = str_word_count( wp_strip_all_tags( $content ) );
    $minutes = max( 1, ceil( $words / 250 ) );

    printf(
        '<span class="gl-meta__reading-time"><svg class="gl-icon" width="16" height="16"><use href="#icon-clock"></use></svg> %s</span>',
        /* translators: %d: minutes */
        esc_html( sprintf( _n( '%d min read', '%d min read', $minutes, 'gtalobby' ), $minutes ) )
    );
}

/* ================================================================
   4. POST META LINE
   ================================================================ */

/**
 * Display post metadata (date, author, reading time, category, type badge).
 *
 * @param array $args Options: show_date, show_author, show_category, show_type, show_reading_time
 */
function gtalobby_post_meta( $args = array() ) {
    $defaults = array(
        'show_date'         => true,
        'show_author'       => true,
        'show_category'     => true,
        'show_type'         => true,
        'show_reading_time' => true,
        'show_modified'     => false,
    );
    $args = wp_parse_args( $args, $defaults );

    echo '<div class="gl-meta">';

    if ( $args['show_type'] ) {
        gtalobby_post_type_badge();
    }

    if ( $args['show_category'] ) {
        gtalobby_category_badge();
    }

    if ( $args['show_date'] ) {
        printf(
            '<time class="gl-meta__date" datetime="%s">%s</time>',
            esc_attr( get_the_date( 'c' ) ),
            esc_html( get_the_date() )
        );
    }

    if ( $args['show_modified'] && get_the_modified_date() !== get_the_date() ) {
        printf(
            '<time class="gl-meta__modified" datetime="%s">%s %s</time>',
            esc_attr( get_the_modified_date( 'c' ) ),
            esc_html__( 'Updated', 'gtalobby' ),
            esc_html( get_the_modified_date() )
        );
    }

    if ( $args['show_author'] ) {
        printf(
            '<span class="gl-meta__author">%s <a href="%s">%s</a></span>',
            esc_html__( 'by', 'gtalobby' ),
            esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
            esc_html( get_the_author() )
        );
    }

    if ( $args['show_reading_time'] ) {
        gtalobby_reading_time();
    }

    echo '</div>';
}

/* ================================================================
   5. CONFIDENCE BADGE (GTA 6)
   ================================================================ */

/**
 * Display a confidence level badge for GTA 6 content.
 *
 * @param int|null $post_id Optional.
 */
function gtalobby_confidence_badge( $post_id = null ) {
    if ( ! gtalobby_is_enabled( 'enable_gta6_mode' ) ) {
        return;
    }

    $post_id    = $post_id ?: get_the_ID();
    $confidence = get_post_meta( $post_id, 'confidence_level', true );

    if ( ! $confidence ) {
        $confidence = gtalobby_get_gta6_option( 'gta6_default_confidence' );
    }

    if ( ! $confidence ) {
        return;
    }

    $labels = array(
        'confirmed'   => esc_html__( 'Confirmed', 'gtalobby' ),
        'high'        => esc_html__( 'High Confidence', 'gtalobby' ),
        'medium'      => esc_html__( 'Medium Confidence', 'gtalobby' ),
        'low'         => esc_html__( 'Low Confidence', 'gtalobby' ),
        'speculation' => esc_html__( 'Speculation', 'gtalobby' ),
    );

    $label = isset( $labels[ $confidence ] ) ? $labels[ $confidence ] : $confidence;

    printf(
        '<span class="gl-confidence-badge gl-confidence--%s" title="%s">%s</span>',
        esc_attr( $confidence ),
        esc_attr__( 'Information confidence level', 'gtalobby' ),
        esc_html( $label )
    );
}

/* ================================================================
   6. TAXONOMY TAGS
   ================================================================ */

/**
 * Display taxonomy terms as tag pills.
 *
 * When called without arguments it renders pills for every
 * non-hierarchical public taxonomy attached to the current post,
 * plus the standard 'post_tag' and 'category' taxonomies.
 *
 * @param string|null $taxonomy Optional. A single taxonomy slug.
 * @param int|null    $post_id  Optional.
 */
function gtalobby_taxonomy_tags( $taxonomy = null, $post_id = null ) {
    $post_id = $post_id ?: get_the_ID();

    // If a specific taxonomy was requested, render just that one.
    if ( $taxonomy ) {
        $terms = get_the_terms( $post_id, $taxonomy );
        if ( ! $terms || is_wp_error( $terms ) ) {
            return;
        }
        echo '<div class="gl-tags gl-tags--' . esc_attr( $taxonomy ) . '">';
        foreach ( $terms as $term ) {
            printf(
                '<a href="%s" class="gl-tag">%s</a>',
                esc_url( get_term_link( $term ) ),
                esc_html( $term->name )
            );
        }
        echo '</div>';
        return;
    }

    // Auto-detect: gather terms from all relevant taxonomies.
    $post_type  = get_post_type( $post_id );
    $taxonomies = get_object_taxonomies( $post_type, 'objects' );
    $has_output = false;

    foreach ( $taxonomies as $tax ) {
        if ( ! $tax->public ) {
            continue;
        }
        // Skip 'category' — it is shown elsewhere (breadcrumbs, meta).
        if ( 'category' === $tax->name ) {
            continue;
        }
        $terms = get_the_terms( $post_id, $tax->name );
        if ( ! $terms || is_wp_error( $terms ) ) {
            continue;
        }
        if ( ! $has_output ) {
            echo '<div class="gl-tags">';
            $has_output = true;
        }
        foreach ( $terms as $term ) {
            printf(
                '<a href="%s" class="gl-tag gl-tag--%s">%s</a>',
                esc_url( get_term_link( $term ) ),
                esc_attr( $tax->name ),
                esc_html( $term->name )
            );
        }
    }

    if ( $has_output ) {
        echo '</div>';
    }
}

/* ================================================================
   7. PLATFORM ICONS
   ================================================================ */

/**
 * Display platform icons for a post.
 *
 * @param int|null $post_id Optional.
 */
function gtalobby_platform_icons( $post_id = null ) {
    $post_id   = $post_id ?: get_the_ID();
    $platforms = get_the_terms( $post_id, 'platform' );

    if ( ! $platforms || is_wp_error( $platforms ) ) {
        return;
    }

    echo '<div class="gl-platforms">';
    foreach ( $platforms as $platform ) {
        printf(
            '<span class="gl-platform gl-platform--%s" title="%s">%s</span>',
            esc_attr( $platform->slug ),
            esc_attr( $platform->name ),
            esc_html( $platform->name )
        );
    }
    echo '</div>';
}

/* ================================================================
   8. STAT BAR (Profile post type)
   ================================================================ */

/**
 * Render a visual stat bar.
 *
 * @param string     $label Stat name.
 * @param int|string $value Stat value (0-100 for bar width).
 */
function gtalobby_stat_bar( $label, $value ) {
    $numeric = is_numeric( $value ) ? intval( $value ) : 0;
    $width   = min( 100, max( 0, $numeric ) );

    echo '<div class="gl-stat-bar">';
    printf( '<span class="gl-stat-bar__label">%s</span>', esc_html( $label ) );
    echo '<div class="gl-stat-bar__track">';
    printf(
        '<div class="gl-stat-bar__fill" style="width:%d%%" aria-valuenow="%d" aria-valuemin="0" aria-valuemax="100"></div>',
        $width,
        $width
    );
    echo '</div>';
    printf( '<span class="gl-stat-bar__value">%s</span>', esc_html( $value ) );
    echo '</div>';
}

/* ================================================================
   9. DIFFICULTY BADGE
   ================================================================ */

/**
 * Display difficulty level for guides/rankings.
 *
 * @param int|null $post_id Optional.
 */
function gtalobby_difficulty_badge( $post_id = null ) {
    $post_id = $post_id ?: get_the_ID();
    $terms   = get_the_terms( $post_id, 'difficulty' );

    if ( ! $terms || is_wp_error( $terms ) ) {
        return;
    }

    $term = $terms[0];
    printf(
        '<span class="gl-difficulty gl-difficulty--%s">%s</span>',
        esc_attr( $term->slug ),
        esc_html( $term->name )
    );
}

/* ================================================================
   10. HUB PAGE LINK (back-reference)
   ================================================================ */

/**
 * Display link back to the parent hub page.
 *
 * @param int|null $post_id Optional.
 */
function gtalobby_hub_link( $post_id = null ) {
    $post_id = $post_id ?: get_the_ID();
    $hub_id  = get_post_meta( $post_id, 'hub_page_assignment', true );

    if ( ! $hub_id ) {
        return;
    }

    $hub_title = get_the_title( $hub_id );
    $hub_url   = get_permalink( $hub_id );

    if ( ! $hub_title || ! $hub_url ) {
        return;
    }

    printf(
        '<a href="%s" class="gl-hub-backlink"><svg class="gl-icon" width="16" height="16"><use href="#icon-grid"></use></svg> %s</a>',
        esc_url( $hub_url ),
        esc_html( $hub_title )
    );
}

/* ================================================================
   11. CARD WRAPPER — Generic card output
   ================================================================ */

/**
 * Output a post card.
 * Tries template-parts/cards/card-{post_type}-{variant}.php,
 * then card-{variant}.php, then card-standard.php.
 *
 * @param string $variant Card variant name.
 * @param array  $args    Extra args passed to template.
 */
function gtalobby_card( $variant = 'standard', $args = array() ) {
    $post_type = get_post_type();
    $templates = array(
        "template-parts/cards/card-{$post_type}-{$variant}.php",
        "template-parts/cards/card-{$variant}.php",
        'template-parts/cards/card-standard.php',
    );

    $located = '';
    foreach ( $templates as $tpl ) {
        if ( file_exists( get_template_directory() . '/' . $tpl ) ) {
            $located = $tpl;
            break;
        }
    }

    if ( $located ) {
        $card_args = wp_parse_args( $args, array(
            'variant'   => $variant,
            'post_type' => $post_type,
        ) );
        set_query_var( 'card_args', $card_args );
        get_template_part( str_replace( '.php', '', $located ) );
    } else {
        // Inline fallback card
        gtalobby_card_fallback( $variant );
    }
}

/**
 * Fallback card output when no template part exists.
 *
 * @param string $variant Card variant name.
 */
function gtalobby_card_fallback( $variant = 'standard' ) {
    $post_type = get_post_type();
    $info      = gtalobby_get_post_type_info( $post_type );
    ?>
    <article <?php post_class( 'gl-card gl-card--' . esc_attr( $variant ) . ' gl-card--' . esc_attr( $post_type ) ); ?>>
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="gl-card__image">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail( 'gl-card', array( 'class' => 'gl-card__img', 'loading' => 'lazy' ) ); ?>
                </a>
                <?php gtalobby_post_type_badge( null, false ); ?>
            </div>
        <?php endif; ?>

        <div class="gl-card__body">
            <?php gtalobby_category_badge(); ?>

            <h3 class="gl-card__title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>

            <?php if ( 'compact' !== $variant && 'minimal' !== $variant ) : ?>
                <p class="gl-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
            <?php endif; ?>

            <div class="gl-card__footer">
                <?php gtalobby_post_meta( array(
                    'show_type'         => false,
                    'show_category'     => false,
                    'show_author'       => ( 'compact' !== $variant ),
                    'show_reading_time' => ( 'compact' !== $variant ),
                ) ); ?>
            </div>
        </div>
    </article>
    <?php
}

/* ================================================================
   12. RELATED POSTS
   ================================================================ */

/**
 * Display related posts grid.
 *
 * @param int|null $post_id Optional.
 */
function gtalobby_related_posts( $post_id = null ) {
    if ( ! gtalobby_is_enabled( 'show_related_posts' ) ) {
        return;
    }

    $post_id = $post_id ?: get_the_ID();
    $count   = gtalobby_get_option( 'gtalobby_general_options', 'related_posts_count', 6 );
    $cat     = gtalobby_get_primary_category( $post_id );

    $args = array(
        'post_type'      => get_post_type( $post_id ),
        'posts_per_page' => $count,
        'post__not_in'   => array( $post_id ),
        'post_status'    => 'publish',
        'orderby'        => 'rand',
    );

    // Prefer same category
    if ( $cat ) {
        $args['category__in'] = array( $cat->term_id );
    }

    // Try same hub first
    $hub_id = get_post_meta( $post_id, 'hub_page_assignment', true );
    if ( $hub_id ) {
        $hub_children = get_post_meta( $hub_id, 'hub_child_posts', true );
        if ( is_array( $hub_children ) && count( $hub_children ) > 1 ) {
            $siblings = array_diff( $hub_children, array( $post_id ) );
            if ( count( $siblings ) >= $count ) {
                $args['post__in']  = array_slice( $siblings, 0, $count );
                $args['post_type'] = 'any';
                unset( $args['category__in'] );
            }
        }
    }

    $query = new WP_Query( $args );

    if ( ! $query->have_posts() ) {
        wp_reset_postdata();
        return;
    }

    echo '<section class="gl-related">';
    echo '<h2 class="gl-related__title">' . esc_html__( 'Related Content', 'gtalobby' ) . '</h2>';
    echo '<div class="gl-related__grid">';

    while ( $query->have_posts() ) {
        $query->the_post();
        gtalobby_card( 'compact' );
    }

    echo '</div>';
    echo '</section>';
    wp_reset_postdata();
}

/* ================================================================
   13. TABLE OF CONTENTS
   ================================================================ */

/**
 * Generate a table of contents from post content headings.
 *
 * @param string $content Post content HTML.
 * @return string TOC HTML.
 */
function gtalobby_generate_toc( $content = '' ) {
    if ( ! gtalobby_is_enabled( 'enable_toc' ) ) {
        return '';
    }

    if ( empty( $content ) ) {
        $content = get_the_content();
    }

    $min_headings = gtalobby_get_option( 'gtalobby_general_options', 'toc_min_headings', 3 );

    // Extract headings
    preg_match_all( '/<h([2-4])[^>]*>(.*?)<\/h[2-4]>/i', $content, $matches, PREG_SET_ORDER );

    if ( count( $matches ) < $min_headings ) {
        return '';
    }

    $toc = '<nav class="gl-toc" aria-label="' . esc_attr__( 'Table of Contents', 'gtalobby' ) . '">';
    $toc .= '<h2 class="gl-toc__title">' . esc_html__( 'Table of Contents', 'gtalobby' ) . '</h2>';
    $toc .= '<ol class="gl-toc__list">';

    foreach ( $matches as $i => $match ) {
        $level   = intval( $match[1] );
        $text    = wp_strip_all_tags( $match[2] );
        $slug    = sanitize_title( $text );
        $indent  = $level - 2; // h2=0, h3=1, h4=2

        $toc .= sprintf(
            '<li class="gl-toc__item gl-toc__item--level-%d"><a href="#%s">%s</a></li>',
            $indent,
            esc_attr( $slug ),
            esc_html( $text )
        );
    }

    $toc .= '</ol></nav>';
    return $toc;
}

/**
 * Add ID anchors to headings in post content.
 *
 * @param string $content Post content.
 * @return string Modified content with IDs on headings.
 */
function gtalobby_add_heading_ids( $content ) {
    if ( ! is_singular() || ! gtalobby_is_enabled( 'enable_toc' ) ) {
        return $content;
    }

    $content = preg_replace_callback(
        '/<h([2-4])([^>]*)>(.*?)<\/h([2-4])>/i',
        function ( $matches ) {
            $level = $matches[1];
            $attrs = $matches[2];
            $text  = $matches[3];
            $slug  = sanitize_title( wp_strip_all_tags( $text ) );

            // Don't override existing ID
            if ( preg_match( '/\bid=["\']/', $attrs ) ) {
                return $matches[0];
            }

            return sprintf( '<h%s%s id="%s">%s</h%s>', $level, $attrs, esc_attr( $slug ), $text, $level );
        },
        $content
    );

    return $content;
}
add_filter( 'the_content', 'gtalobby_add_heading_ids', 5 );

/* ================================================================
   14. SOCIAL SHARE BUTTONS
   ================================================================ */

/**
 * Display social share buttons.
 */
function gtalobby_social_share() {
    $url   = urlencode( get_permalink() );
    $title = urlencode( get_the_title() );

    $networks = array(
        'x'        => array(
            'url'   => "https://x.com/intent/tweet?url={$url}&text={$title}",
            'label' => 'X (Twitter)',
            'icon'  => 'x',
        ),
        'facebook' => array(
            'url'   => "https://www.facebook.com/sharer/sharer.php?u={$url}",
            'label' => 'Facebook',
            'icon'  => 'facebook',
        ),
        'reddit'   => array(
            'url'   => "https://www.reddit.com/submit?url={$url}&title={$title}",
            'label' => 'Reddit',
            'icon'  => 'reddit',
        ),
        'copy'     => array(
            'url'   => '#',
            'label' => esc_html__( 'Copy Link', 'gtalobby' ),
            'icon'  => 'link',
        ),
    );

    echo '<div class="gl-share">';
    echo '<span class="gl-share__label">' . esc_html__( 'Share:', 'gtalobby' ) . '</span>';

    foreach ( $networks as $key => $net ) {
        $extra = ( $key === 'copy' ) ? ' data-clipboard="' . esc_attr( get_permalink() ) . '"' : ' target="_blank" rel="noopener noreferrer"';
        printf(
            '<a href="%s" class="gl-share__btn gl-share__%s" aria-label="%s"%s><svg class="gl-icon" width="18" height="18"><use href="#icon-%s"></use></svg></a>',
            esc_url( $net['url'] ),
            esc_attr( $key ),
            esc_attr( $net['label'] ),
            $extra,
            esc_attr( $net['icon'] )
        );
    }

    echo '</div>';
}

/* ================================================================
   15. AUTHOR BOX
   ================================================================ */

/**
 * Display author bio box.
 */
function gtalobby_author_box() {
    if ( ! gtalobby_is_enabled( 'show_author_box' ) ) {
        return;
    }

    $author_id = get_the_author_meta( 'ID' );
    ?>
    <div class="gl-author-box">
        <div class="gl-author-box__avatar">
            <?php echo get_avatar( $author_id, 80, '', '', array( 'class' => 'gl-author-box__img' ) ); ?>
        </div>
        <div class="gl-author-box__info">
            <h4 class="gl-author-box__name">
                <a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>">
                    <?php echo esc_html( get_the_author() ); ?>
                </a>
            </h4>
            <?php if ( get_the_author_meta( 'description' ) ) : ?>
                <p class="gl-author-box__bio"><?php echo esc_html( get_the_author_meta( 'description' ) ); ?></p>
            <?php endif; ?>
        </div>
    </div>
    <?php
}

/* ================================================================
   16. PAGINATION
   ================================================================ */

/**
 * Display numbered pagination for archives.
 */
function gtalobby_pagination( $query = null ) {
    $args = array(
        'prev_text' => '<svg class="gl-icon" width="16" height="16"><use href="#icon-chevron-left"></use></svg> ' . esc_html__( 'Previous', 'gtalobby' ),
        'next_text' => esc_html__( 'Next', 'gtalobby' ) . ' <svg class="gl-icon" width="16" height="16"><use href="#icon-chevron-right"></use></svg>',
        'mid_size'  => 2,
        'type'      => 'list',
        'class'     => 'gl-pagination',
    );

    if ( $query ) {
        $args['total']   = $query->max_num_pages;
        $args['current'] = max( 1, get_query_var( 'paged' ) );
    }

    $pagination = paginate_links( $args );
    if ( $pagination ) {
        echo '<nav class="gl-pagination-nav" aria-label="' . esc_attr__( 'Page navigation', 'gtalobby' ) . '">' . $pagination . '</nav>';
    }
}

/* ================================================================
   17. POST NAVIGATION (prev/next)
   ================================================================ */

/**
 * Display previous/next post links with thumbnails.
 */
function gtalobby_post_navigation() {
    $prev = get_previous_post( true, '', 'category' );
    $next = get_next_post( true, '', 'category' );

    if ( ! $prev && ! $next ) {
        return;
    }

    echo '<nav class="gl-post-nav" aria-label="' . esc_attr__( 'Post navigation', 'gtalobby' ) . '">';

    if ( $prev ) {
        echo '<a href="' . esc_url( get_permalink( $prev ) ) . '" class="gl-post-nav__prev">';
        echo '<span class="gl-post-nav__label">' . esc_html__( 'Previous', 'gtalobby' ) . '</span>';
        echo '<span class="gl-post-nav__title">' . esc_html( get_the_title( $prev ) ) . '</span>';
        echo '</a>';
    }

    if ( $next ) {
        echo '<a href="' . esc_url( get_permalink( $next ) ) . '" class="gl-post-nav__next">';
        echo '<span class="gl-post-nav__label">' . esc_html__( 'Next', 'gtalobby' ) . '</span>';
        echo '<span class="gl-post-nav__title">' . esc_html( get_the_title( $next ) ) . '</span>';
        echo '</a>';
    }

    echo '</nav>';
}
