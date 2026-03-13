<?php
/**
 * GtaLobby — Breadcrumbs
 *
 * Generates SEO-friendly breadcrumb trails with BreadcrumbList schema.
 * Respects hub page hierarchy and SAG category structure.
 *
 * @package GtaLobby
 */

defined( 'ABSPATH' ) || exit;

/**
 * Display breadcrumb navigation.
 *
 * @param array $args Optional display arguments.
 */
function gtalobby_breadcrumbs( $args = array() ) {
    if ( ! gtalobby_is_enabled( 'enable_breadcrumbs' ) ) {
        return;
    }

    // Don't show on front page
    if ( is_front_page() ) {
        return;
    }

    $defaults = array(
        'wrapper_class' => 'gl-breadcrumbs',
        'separator'     => '<span class="gl-breadcrumbs__sep" aria-hidden="true">/</span>',
        'show_home'     => true,
        'home_text'     => esc_html__( 'Home', 'gtalobby' ),
    );
    $args  = wp_parse_args( $args, $defaults );
    $items = array();

    // Home
    if ( $args['show_home'] ) {
        $items[] = array(
            'url'  => home_url( '/' ),
            'text' => $args['home_text'],
        );
    }

    // Build context-specific crumbs
    if ( is_singular() ) {
        $items = array_merge( $items, gtalobby_breadcrumbs_singular() );
    } elseif ( is_category() ) {
        $items = array_merge( $items, gtalobby_breadcrumbs_category() );
    } elseif ( is_tax() ) {
        $items = array_merge( $items, gtalobby_breadcrumbs_taxonomy() );
    } elseif ( is_post_type_archive() ) {
        $items = array_merge( $items, gtalobby_breadcrumbs_post_type_archive() );
    } elseif ( is_search() ) {
        $items[] = array(
            'url'  => '',
            'text' => sprintf( esc_html__( 'Search: %s', 'gtalobby' ), get_search_query() ),
        );
    } elseif ( is_404() ) {
        $items[] = array(
            'url'  => '',
            'text' => esc_html__( 'Page Not Found', 'gtalobby' ),
        );
    } elseif ( is_archive() ) {
        $items[] = array(
            'url'  => '',
            'text' => get_the_archive_title(),
        );
    }

    // Render
    if ( empty( $items ) ) {
        return;
    }

    echo '<nav class="' . esc_attr( $args['wrapper_class'] ) . '" aria-label="' . esc_attr__( 'Breadcrumb', 'gtalobby' ) . '">';
    echo '<ol class="gl-breadcrumbs__list" itemscope itemtype="https://schema.org/BreadcrumbList">';

    $count = count( $items );
    foreach ( $items as $i => $item ) {
        $is_last = ( $i === $count - 1 );

        echo '<li class="gl-breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';

        if ( ! $is_last && ! empty( $item['url'] ) ) {
            printf(
                '<a href="%s" itemprop="item"><span itemprop="name">%s</span></a>',
                esc_url( $item['url'] ),
                esc_html( $item['text'] )
            );
        } else {
            printf( '<span itemprop="name" aria-current="page">%s</span>', esc_html( $item['text'] ) );
        }

        printf( '<meta itemprop="position" content="%d" />', $i + 1 );
        echo '</li>';

        if ( ! $is_last ) {
            echo $args['separator']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
    }

    echo '</ol></nav>';
}

/**
 * Build breadcrumb items for singular posts/pages.
 *
 * @return array Breadcrumb items.
 */
function gtalobby_breadcrumbs_singular() {
    $items     = array();
    $post_type = get_post_type();
    $post_id   = get_the_ID();

    // Post type archive link (for CPTs)
    if ( ! in_array( $post_type, array( 'post', 'page' ), true ) ) {
        $pt_obj = get_post_type_object( $post_type );
        if ( $pt_obj && $pt_obj->has_archive ) {
            $items[] = array(
                'url'  => get_post_type_archive_link( $post_type ),
                'text' => $pt_obj->labels->name,
            );
        }
    }

    // Primary category
    $cat = gtalobby_get_primary_category( $post_id );
    if ( $cat ) {
        // Category ancestors
        $ancestors = get_ancestors( $cat->term_id, 'category' );
        $ancestors = array_reverse( $ancestors );
        foreach ( $ancestors as $anc_id ) {
            $anc = get_term( $anc_id, 'category' );
            if ( $anc && ! is_wp_error( $anc ) ) {
                $items[] = array(
                    'url'  => get_category_link( $anc->term_id ),
                    'text' => $anc->name,
                );
            }
        }

        $items[] = array(
            'url'  => get_category_link( $cat->term_id ),
            'text' => $cat->name,
        );
    }

    // Hub page (if assigned)
    $hub_id = get_post_meta( $post_id, 'hub_page_assignment', true );
    if ( $hub_id ) {
        $hub_title = get_the_title( $hub_id );
        if ( $hub_title ) {
            $items[] = array(
                'url'  => get_permalink( $hub_id ),
                'text' => $hub_title,
            );
        }
    }

    // Page parent hierarchy
    if ( 'page' === $post_type ) {
        $page_ancestors = get_post_ancestors( $post_id );
        $page_ancestors = array_reverse( $page_ancestors );
        foreach ( $page_ancestors as $anc_id ) {
            $items[] = array(
                'url'  => get_permalink( $anc_id ),
                'text' => get_the_title( $anc_id ),
            );
        }
    }

    // Current post (no link)
    $items[] = array(
        'url'  => '',
        'text' => get_the_title(),
    );

    return $items;
}

/**
 * Build breadcrumb items for category archives.
 *
 * @return array Breadcrumb items.
 */
function gtalobby_breadcrumbs_category() {
    $items = array();
    $cat   = get_queried_object();

    // Parent categories
    $ancestors = get_ancestors( $cat->term_id, 'category' );
    $ancestors = array_reverse( $ancestors );
    foreach ( $ancestors as $anc_id ) {
        $anc = get_term( $anc_id, 'category' );
        if ( $anc && ! is_wp_error( $anc ) ) {
            $items[] = array(
                'url'  => get_category_link( $anc->term_id ),
                'text' => $anc->name,
            );
        }
    }

    $items[] = array(
        'url'  => '',
        'text' => $cat->name,
    );

    return $items;
}

/**
 * Build breadcrumb items for custom taxonomy archives.
 *
 * @return array Breadcrumb items.
 */
function gtalobby_breadcrumbs_taxonomy() {
    $items = array();
    $term  = get_queried_object();
    $tax   = get_taxonomy( $term->taxonomy );

    if ( $tax ) {
        $items[] = array(
            'url'  => '',
            'text' => $tax->labels->name,
        );
    }

    // Parent terms
    if ( is_taxonomy_hierarchical( $term->taxonomy ) ) {
        $ancestors = get_ancestors( $term->term_id, $term->taxonomy );
        $ancestors = array_reverse( $ancestors );
        foreach ( $ancestors as $anc_id ) {
            $anc = get_term( $anc_id, $term->taxonomy );
            if ( $anc && ! is_wp_error( $anc ) ) {
                $items[] = array(
                    'url'  => get_term_link( $anc ),
                    'text' => $anc->name,
                );
            }
        }
    }

    $items[] = array(
        'url'  => '',
        'text' => $term->name,
    );

    return $items;
}

/**
 * Build breadcrumb items for post type archives.
 *
 * @return array Breadcrumb items.
 */
function gtalobby_breadcrumbs_post_type_archive() {
    $items  = array();
    $pt_obj = get_post_type_object( get_queried_object()->name ?? get_query_var( 'post_type' ) );

    if ( $pt_obj ) {
        $items[] = array(
            'url'  => '',
            'text' => $pt_obj->labels->name,
        );
    }

    return $items;
}
