<?php
/**
 * GtaLobby — Layout Engine
 *
 * The core layout composer system. Manages zone ordering, visibility,
 * presentation variants, and conditional layout rules for all template types.
 * All settings are stored in wp_options and configurable from admin.
 *
 * @package GtaLobby
 */

defined( 'ABSPATH' ) || exit;

/* ================================================================
   ZONE DEFINITIONS
   Each template type has a set of zones that can be reordered,
   toggled, and configured independently.
   ================================================================ */

/**
 * Get default zone configuration for hub pages.
 */
function gtalobby_get_hub_zones_default() {
    return array(
        'breadcrumb' => array(
            'label'    => __( 'Breadcrumb', 'gtalobby' ),
            'enabled'  => true,
            'order'    => 10,
            'width'    => 'contained',
            'bg'       => 'inherit',
            'spacing'  => 'compact',
        ),
        'hero' => array(
            'label'    => __( 'Hero Header', 'gtalobby' ),
            'enabled'  => true,
            'order'    => 20,
            'width'    => 'full',
            'bg'       => 'accent',
            'spacing'  => 'normal',
        ),
        'key_facts' => array(
            'label'    => __( 'Key Facts Strip', 'gtalobby' ),
            'enabled'  => true,
            'order'    => 30,
            'width'    => 'contained',
            'bg'       => 'surface',
            'spacing'  => 'compact',
        ),
        'subnav' => array(
            'label'    => __( 'Sticky Sub-Navigation', 'gtalobby' ),
            'enabled'  => true,
            'order'    => 40,
            'width'    => 'contained',
            'bg'       => 'inherit',
            'spacing'  => 'compact',
            'sticky'   => true,
        ),
        'quick_answer' => array(
            'label'    => __( 'Quick Answer Box', 'gtalobby' ),
            'enabled'  => true,
            'order'    => 50,
            'width'    => 'contained',
            'bg'       => 'accent-tint',
            'spacing'  => 'normal',
        ),
        'toc' => array(
            'label'    => __( 'Table of Contents', 'gtalobby' ),
            'enabled'  => true,
            'order'    => 60,
            'width'    => 'narrow',
            'bg'       => 'inherit',
            'spacing'  => 'normal',
        ),
        'body_content' => array(
            'label'    => __( 'Body Content', 'gtalobby' ),
            'enabled'  => true,
            'order'    => 70,
            'width'    => 'narrow',
            'bg'       => 'inherit',
            'spacing'  => 'normal',
        ),
        'structured_data' => array(
            'label'    => __( 'Structured Data Section', 'gtalobby' ),
            'enabled'  => true,
            'order'    => 80,
            'width'    => 'contained',
            'bg'       => 'surface',
            'spacing'  => 'normal',
        ),
        'featured_children' => array(
            'label'    => __( 'Featured Child Articles', 'gtalobby' ),
            'enabled'  => true,
            'order'    => 90,
            'width'    => 'contained',
            'bg'       => 'inherit',
            'spacing'  => 'breathing',
            'columns'  => 3,
            'style'    => 'magazine',
            'count'    => 5,
        ),
        'child_posts_grid' => array(
            'label'    => __( 'All Child Articles Grid', 'gtalobby' ),
            'enabled'  => true,
            'order'    => 100,
            'width'    => 'contained',
            'bg'       => 'surface',
            'spacing'  => 'normal',
            'columns'  => 3,
            'style'    => 'card-grid',
            'count'    => 12,
            'filterable' => true,
        ),
        'cross_cluster' => array(
            'label'    => __( 'Cross-Cluster Hub Links', 'gtalobby' ),
            'enabled'  => true,
            'order'    => 110,
            'width'    => 'contained',
            'bg'       => 'inherit',
            'spacing'  => 'normal',
            'columns'  => 3,
        ),
        'faq' => array(
            'label'    => __( 'FAQ Accordion', 'gtalobby' ),
            'enabled'  => true,
            'order'    => 120,
            'width'    => 'narrow',
            'bg'       => 'surface',
            'spacing'  => 'normal',
            'style'    => 'accordion',
        ),
        'gta6_notice' => array(
            'label'    => __( 'GTA 6 Update Notice', 'gtalobby' ),
            'enabled'  => true,
            'order'    => 130,
            'width'    => 'contained',
            'bg'       => 'accent-tint',
            'spacing'  => 'compact',
            'conditional' => array( 'category' => 'gta6' ),
        ),
        'sources' => array(
            'label'    => __( 'Sources & Methodology', 'gtalobby' ),
            'enabled'  => true,
            'order'    => 140,
            'width'    => 'narrow',
            'bg'       => 'surface',
            'spacing'  => 'compact',
        ),
        'ad_slot_hub' => array(
            'label'    => __( 'Ad Slot', 'gtalobby' ),
            'enabled'  => false,
            'order'    => 95,
            'width'    => 'contained',
            'bg'       => 'inherit',
            'spacing'  => 'compact',
        ),
    );
}

/**
 * Get default zone configuration for single post templates.
 */
function gtalobby_get_single_zones_default() {
    return array(
        'breadcrumb' => array(
            'label'   => __( 'Breadcrumb', 'gtalobby' ),
            'enabled' => true,
            'order'   => 10,
        ),
        'post_header' => array(
            'label'   => __( 'Post Header (Title + Meta)', 'gtalobby' ),
            'enabled' => true,
            'order'   => 20,
        ),
        'featured_image' => array(
            'label'   => __( 'Featured Image', 'gtalobby' ),
            'enabled' => true,
            'order'   => 30,
        ),
        'quick_answer_box' => array(
            'label'   => __( 'Quick Answer / Snippet Box', 'gtalobby' ),
            'enabled' => true,
            'order'   => 35,
            'conditional' => array( 'post_type' => array( 'answer' ) ),
        ),
        'post_type_fields' => array(
            'label'   => __( 'Post Type Custom Fields', 'gtalobby' ),
            'enabled' => true,
            'order'   => 40,
        ),
        'toc' => array(
            'label'   => __( 'Table of Contents', 'gtalobby' ),
            'enabled' => true,
            'order'   => 45,
        ),
        'body_content' => array(
            'label'   => __( 'Body Content', 'gtalobby' ),
            'enabled' => true,
            'order'   => 50,
        ),
        'video_embed' => array(
            'label'   => __( 'Video Embed', 'gtalobby' ),
            'enabled' => true,
            'order'   => 55,
            'conditional' => array( 'post_type' => array( 'guide', 'ranking' ) ),
        ),
        'ranked_items' => array(
            'label'   => __( 'Ranked Items List', 'gtalobby' ),
            'enabled' => true,
            'order'   => 60,
            'conditional' => array( 'post_type' => array( 'ranking' ) ),
        ),
        'data_table' => array(
            'label'   => __( 'Data Table', 'gtalobby' ),
            'enabled' => true,
            'order'   => 60,
            'conditional' => array( 'post_type' => array( 'database' ) ),
        ),
        'stats_table' => array(
            'label'   => __( 'Stats Table / Profile', 'gtalobby' ),
            'enabled' => true,
            'order'   => 60,
            'conditional' => array( 'post_type' => array( 'profile' ) ),
        ),
        'gallery' => array(
            'label'   => __( 'Gallery', 'gtalobby' ),
            'enabled' => true,
            'order'   => 65,
            'conditional' => array( 'post_type' => array( 'mod', 'profile' ) ),
        ),
        'install_steps' => array(
            'label'   => __( 'Install Steps', 'gtalobby' ),
            'enabled' => true,
            'order'   => 55,
            'conditional' => array( 'post_type' => array( 'mod' ) ),
        ),
        'download_box' => array(
            'label'   => __( 'Download Box', 'gtalobby' ),
            'enabled' => true,
            'order'   => 25,
            'conditional' => array( 'post_type' => array( 'mod' ) ),
        ),
        'weekly_bonuses' => array(
            'label'   => __( 'Weekly Bonuses & Discounts', 'gtalobby' ),
            'enabled' => true,
            'order'   => 55,
            'conditional' => array( 'post_type' => array( 'recap' ) ),
        ),
        'related_questions' => array(
            'label'   => __( 'Related Questions', 'gtalobby' ),
            'enabled' => true,
            'order'   => 70,
            'conditional' => array( 'post_type' => array( 'answer' ) ),
        ),
        'gta6_confidence' => array(
            'label'   => __( 'GTA 6 Confidence Badge + Sources', 'gtalobby' ),
            'enabled' => true,
            'order'   => 22,
            'conditional' => array( 'category' => 'gta6' ),
        ),
        'hub_link' => array(
            'label'   => __( 'Parent Hub Link', 'gtalobby' ),
            'enabled' => true,
            'order'   => 75,
        ),
        'related_posts' => array(
            'label'   => __( 'Related Posts (Cross-Cluster)', 'gtalobby' ),
            'enabled' => true,
            'order'   => 80,
        ),
        'author_box' => array(
            'label'   => __( 'Author Box', 'gtalobby' ),
            'enabled' => true,
            'order'   => 85,
        ),
        'social_share' => array(
            'label'   => __( 'Social Share Buttons', 'gtalobby' ),
            'enabled' => true,
            'order'   => 90,
        ),
        'comments' => array(
            'label'   => __( 'Comments', 'gtalobby' ),
            'enabled' => true,
            'order'   => 100,
        ),
    );
}

/**
 * Get default zone configuration for archive pages.
 */
function gtalobby_get_archive_zones_default() {
    return array(
        'breadcrumb' => array(
            'label'   => __( 'Breadcrumb', 'gtalobby' ),
            'enabled' => true,
            'order'   => 10,
        ),
        'archive_header' => array(
            'label'   => __( 'Archive Header + Description', 'gtalobby' ),
            'enabled' => true,
            'order'   => 20,
        ),
        'pinned_hubs' => array(
            'label'   => __( 'Pinned Hub Pages', 'gtalobby' ),
            'enabled' => true,
            'order'   => 30,
        ),
        'filter_bar' => array(
            'label'   => __( 'Post Type / Taxonomy Filter Bar', 'gtalobby' ),
            'enabled' => true,
            'order'   => 40,
        ),
        'post_grid' => array(
            'label'    => __( 'Post Grid', 'gtalobby' ),
            'enabled'  => true,
            'order'    => 50,
            'columns'  => 3,
            'style'    => 'card-grid',
            'per_page' => 12,
        ),
        'pagination' => array(
            'label'   => __( 'Pagination', 'gtalobby' ),
            'enabled' => true,
            'order'   => 60,
        ),
    );
}

/**
 * Get default zone configuration for the homepage.
 */
function gtalobby_get_homepage_zones_default() {
    return array(
        'hero' => array(
            'label'   => __( 'Hero Section', 'gtalobby' ),
            'enabled' => true,
            'order'   => 10,
            'width'   => 'full',
            'bg'      => 'accent',
            'style'   => 'featured-hub',
        ),
        'stats_bar' => array(
            'label'   => __( 'Stats Bar', 'gtalobby' ),
            'enabled' => true,
            'order'   => 15,
            'width'   => 'full',
            'bg'      => 'surface',
        ),
        'category_grid' => array(
            'label'   => __( 'Category Grid (9 Sectors)', 'gtalobby' ),
            'enabled' => true,
            'order'   => 20,
            'width'   => 'contained',
            'bg'      => 'surface',
            'columns' => 3,
        ),
        'gta6_spotlight' => array(
            'label'   => __( 'GTA 6 Spotlight', 'gtalobby' ),
            'enabled' => true,
            'order'   => 30,
            'width'   => 'contained',
            'bg'      => 'accent-tint',
            'count'   => 4,
        ),
        'featured_hubs' => array(
            'label'   => __( 'Featured Hub Pages', 'gtalobby' ),
            'enabled' => true,
            'order'   => 40,
            'width'   => 'contained',
            'bg'      => 'inherit',
            'count'   => 6,
        ),
        'latest_posts' => array(
            'label'   => __( 'Latest Content', 'gtalobby' ),
            'enabled' => true,
            'order'   => 50,
            'width'   => 'contained',
            'bg'      => 'inherit',
            'count'   => 8,
        ),
        'weekly_recap' => array(
            'label'   => __( 'Weekly Recap Highlight', 'gtalobby' ),
            'enabled' => true,
            'order'   => 60,
            'width'   => 'contained',
            'bg'      => 'surface',
        ),
        'mod_spotlight' => array(
            'label'   => __( 'Mod Spotlight', 'gtalobby' ),
            'enabled' => true,
            'order'   => 70,
            'width'   => 'contained',
            'bg'      => 'inherit',
            'count'   => 4,
        ),
        'newsletter' => array(
            'label'   => __( 'Newsletter / CTA', 'gtalobby' ),
            'enabled' => false,
            'order'   => 80,
            'width'   => 'contained',
            'bg'      => 'accent',
        ),
    );
}

/* ================================================================
   LAYOUT SETTINGS PERSISTENCE
   ================================================================ */

/**
 * Get layout configuration for a specific template type.
 * Merges saved settings with defaults.
 *
 * @param string $template_type  'hub', 'single', 'archive', 'homepage'
 * @param string $context        Optional category slug for per-category overrides.
 * @return array Sorted zone configuration
 */
function gtalobby_get_layout( $template_type, $context = '' ) {
    $defaults_fn = "gtalobby_get_{$template_type}_zones_default";
    if ( ! function_exists( $defaults_fn ) ) {
        return array();
    }

    $defaults = call_user_func( $defaults_fn );

    // Check for per-category override first
    if ( $context ) {
        $saved = get_option( "gtalobby_layout_{$template_type}_{$context}", array() );
    } else {
        $saved = array();
    }

    // Fall back to default layout for this template type
    if ( empty( $saved ) ) {
        $saved = get_option( "gtalobby_layout_{$template_type}", array() );
    }

    // Merge saved into defaults
    if ( ! empty( $saved ) && is_array( $saved ) ) {
        foreach ( $saved as $zone_id => $zone_settings ) {
            if ( isset( $defaults[ $zone_id ] ) ) {
                $defaults[ $zone_id ] = wp_parse_args( $zone_settings, $defaults[ $zone_id ] );
            }
        }
    }

    // Sort by order
    uasort( $defaults, function( $a, $b ) {
        return ( $a['order'] ?? 50 ) - ( $b['order'] ?? 50 );
    } );

    return $defaults;
}

/**
 * Check if a specific zone is enabled, considering layout options and conditions.
 */
function gtalobby_is_zone_enabled( $template_type, $zone_id, $context = '' ) {
    $zones = gtalobby_get_layout( $template_type, $context );
    if ( empty( $zones[ $zone_id ] ) ) {
        return false;
    }

    $zone = $zones[ $zone_id ];
    if ( empty( $zone['enabled'] ) ) {
        return false;
    }

    if ( ! gtalobby_zone_conditions_met( $zone ) ) {
        return false;
    }

    return true;
}

/**
 * Save layout configuration for a template type.
 */
function gtalobby_save_layout( $template_type, $zones, $context = '' ) {
    $option_key = "gtalobby_layout_{$template_type}";
    if ( $context ) {
        $option_key .= "_{$context}";
    }
    return update_option( $option_key, $zones );
}

/* ================================================================
   ZONE RENDERING ENGINE
   ================================================================ */

/**
 * Render zones for a template. Iterates through the sorted zone config
 * and calls the appropriate template part for each enabled zone.
 *
 * @param string $template_type The template type (hub, single, archive, homepage)
 * @param array  $args          Extra arguments to pass to template parts
 */
function gtalobby_render_zones( $template_type, $args = array() ) {
    $context = gtalobby_get_current_category_slug();
    $zones   = gtalobby_get_layout( $template_type, $context );

    foreach ( $zones as $zone_id => $zone_config ) {
        // Skip disabled zones
        if ( empty( $zone_config['enabled'] ) ) {
            continue;
        }

        // Check conditional rules
        if ( ! gtalobby_zone_conditions_met( $zone_config ) ) {
            continue;
        }

        // Build zone wrapper classes
        $zone_classes = array(
            'gl-zone',
            'gl-zone--' . sanitize_html_class( $zone_id ),
        );

        // Width classes
        $width = $zone_config['width'] ?? 'contained';
        $zone_classes[] = 'gl-zone--' . $width;

        // Background classes
        $bg = $zone_config['bg'] ?? 'inherit';
        if ( $bg !== 'inherit' ) {
            $zone_classes[] = 'gl-zone--bg-' . sanitize_html_class( $bg );
        }

        // Spacing classes
        $spacing = $zone_config['spacing'] ?? 'normal';
        $zone_classes[] = 'gl-zone--spacing-' . sanitize_html_class( $spacing );

        // Sticky
        if ( ! empty( $zone_config['sticky'] ) ) {
            $zone_classes[] = 'gl-zone--sticky';
        }

        $class_string = implode( ' ', $zone_classes );

        // Open zone wrapper
        echo '<section class="' . esc_attr( $class_string ) . '" data-zone="' . esc_attr( $zone_id ) . '">';

        // Inner container for contained/narrow widths
        if ( $width !== 'full' ) {
            echo '<div class="gl-container gl-container--' . esc_attr( $width ) . '">';
        }

        // Load the zone template part
        $template_args = array_merge( $args, array(
            'zone_config' => $zone_config,
            'zone_id'     => $zone_id,
        ) );

        // Try type-specific zone first, then generic
        $located = locate_template( array(
            "template-parts/zones/{$template_type}-{$zone_id}.php",
            "template-parts/zones/{$zone_id}.php",
        ) );

        if ( $located ) {
            // Pass args to template
            set_query_var( 'gl_zone_args', $template_args );
            load_template( $located, false );
        }

        // Close containers
        if ( $width !== 'full' ) {
            echo '</div>';
        }

        echo '</section>';
    }
}

/**
 * Check if a zone's conditional rules are met.
 */
function gtalobby_zone_conditions_met( $zone_config ) {
    if ( empty( $zone_config['conditional'] ) ) {
        return true;
    }

    $conditions = $zone_config['conditional'];

    // Category condition
    if ( isset( $conditions['category'] ) ) {
        $slug = gtalobby_get_current_category_slug();
        $required = (array) $conditions['category'];
        if ( ! in_array( $slug, $required, true ) ) {
            return false;
        }
    }

    // Post type condition
    if ( isset( $conditions['post_type'] ) ) {
        $current_pt = get_post_type();
        $allowed    = (array) $conditions['post_type'];
        if ( ! in_array( $current_pt, $allowed, true ) ) {
            return false;
        }
    }

    // Custom field condition
    if ( isset( $conditions['field'] ) ) {
        foreach ( $conditions['field'] as $field_key => $expected ) {
            $value = get_field( $field_key );
            if ( ! $value && ! function_exists( 'get_field' ) ) {
                $value = get_post_meta( get_the_ID(), $field_key, true );
            }
            if ( $value != $expected ) {
                return false;
            }
        }
    }

    return true;
}

/* ================================================================
   CARD PRESENTATION VARIANTS
   Controls how post type cards render in different contexts.
   ================================================================ */

/**
 * Get the card variant for a post type in a specific context.
 *
 * @param string $post_type  The post type slug.
 * @param string $context    Where the card appears: 'hub', 'archive', 'homepage', 'taxonomy', 'related'
 * @return string The card variant slug.
 */
function gtalobby_get_card_variant( $post_type, $context = 'archive' ) {
    $defaults = gtalobby_get_card_variant_defaults();
    $saved    = get_option( 'gtalobby_card_variants', array() );

    // Check saved settings first
    if ( isset( $saved[ $post_type ][ $context ] ) ) {
        return $saved[ $post_type ][ $context ];
    }

    // Return default
    if ( isset( $defaults[ $post_type ][ $context ] ) ) {
        return $defaults[ $post_type ][ $context ];
    }

    return 'standard';
}

/**
 * Default card variant mapping.
 */
function gtalobby_get_card_variant_defaults() {
    return array(
        'mod' => array(
            'hub'      => 'download',
            'archive'  => 'compact-row',
            'homepage' => 'feature',
            'taxonomy' => 'download',
            'related'  => 'compact-row',
        ),
        'guide' => array(
            'hub'      => 'standard',
            'archive'  => 'standard',
            'homepage' => 'standard',
            'taxonomy' => 'standard',
            'related'  => 'standard',
        ),
        'ranking' => array(
            'hub'      => 'podium',
            'archive'  => 'list-preview',
            'homepage' => 'podium',
            'taxonomy' => 'standard',
            'related'  => 'standard',
        ),
        'profile' => array(
            'hub'      => 'entity',
            'archive'  => 'entity',
            'homepage' => 'compact-badge',
            'taxonomy' => 'entity',
            'related'  => 'compact-badge',
        ),
        'answer' => array(
            'hub'      => 'snippet',
            'archive'  => 'snippet',
            'homepage' => 'inline-answer',
            'taxonomy' => 'snippet',
            'related'  => 'snippet',
        ),
        'database' => array(
            'hub'      => 'table-preview',
            'archive'  => 'stats',
            'homepage' => 'stats',
            'taxonomy' => 'stats',
            'related'  => 'stats',
        ),
        'recap' => array(
            'hub'      => 'weekly',
            'archive'  => 'weekly',
            'homepage' => 'highlight',
            'taxonomy' => 'weekly',
            'related'  => 'timeline',
        ),
    );
}

/**
 * Get available card variants for a post type.
 */
function gtalobby_get_available_card_variants( $post_type ) {
    $variants = array(
        'mod' => array(
            'download'    => __( 'Download Card (image + size + DL button)', 'gtalobby' ),
            'compact-row' => __( 'Compact Row (name + version + size)', 'gtalobby' ),
            'feature'     => __( 'Feature Card (hero image + overlay)', 'gtalobby' ),
            'standard'    => __( 'Standard Card', 'gtalobby' ),
        ),
        'guide' => array(
            'standard'      => __( 'Standard Card (thumb + title + excerpt + badge)', 'gtalobby' ),
            'step-preview'  => __( 'Step Preview (shows first 3 steps)', 'gtalobby' ),
            'timeline'      => __( 'Timeline Card (numbered + time)', 'gtalobby' ),
        ),
        'ranking' => array(
            'podium'       => __( 'Podium Card (top 3 shown + ranks)', 'gtalobby' ),
            'list-preview' => __( 'List Preview (#1-#5 inline)', 'gtalobby' ),
            'score'        => __( 'Score Card (name + score bar)', 'gtalobby' ),
            'standard'     => __( 'Standard Card', 'gtalobby' ),
        ),
        'profile' => array(
            'entity'       => __( 'Entity Card (image + stats sidebar)', 'gtalobby' ),
            'compact-badge' => __( 'Compact Badge (icon + name + key stat)', 'gtalobby' ),
            'full-preview' => __( 'Full Preview (image + bio + stats)', 'gtalobby' ),
            'standard'     => __( 'Standard Card', 'gtalobby' ),
        ),
        'answer' => array(
            'snippet'       => __( 'Snippet Card (question + answer box)', 'gtalobby' ),
            'inline-answer' => __( 'Inline Answer (full answer visible)', 'gtalobby' ),
            'qa-pair'       => __( 'Q&A Pair (accordion)', 'gtalobby' ),
            'standard'      => __( 'Standard Card', 'gtalobby' ),
        ),
        'database' => array(
            'table-preview' => __( 'Table Preview (first 5 rows)', 'gtalobby' ),
            'stats'         => __( 'Stats Card (columns + rows + updated)', 'gtalobby' ),
            'mini-table'    => __( 'Interactive Mini Table', 'gtalobby' ),
            'standard'      => __( 'Standard Card', 'gtalobby' ),
        ),
        'recap' => array(
            'weekly'    => __( 'Weekly Card (date + bonus + discount count)', 'gtalobby' ),
            'highlight' => __( 'Highlight Card (podium vehicle featured)', 'gtalobby' ),
            'timeline'  => __( 'Timeline Entry (date + summary)', 'gtalobby' ),
            'standard'  => __( 'Standard Card', 'gtalobby' ),
        ),
    );

    return isset( $variants[ $post_type ] ) ? $variants[ $post_type ] : array( 'standard' => __( 'Standard Card', 'gtalobby' ) );
}

/**
 * Render a post card with the appropriate variant.
 *
 * @param WP_Post|int $post    The post object or ID.
 * @param string      $context The rendering context.
 * @param array       $args    Additional arguments.
 */
function gtalobby_render_card( $post = null, $context = 'archive', $args = array() ) {
    $post = get_post( $post );
    if ( ! $post ) {
        return;
    }

    $post_type = $post->post_type;
    $variant   = gtalobby_get_card_variant( $post_type, $context );

    // Set up post data
    setup_postdata( $post );

    // Try to load variant-specific card template
    $templates = array(
        "template-parts/cards/card-{$post_type}-{$variant}.php",
        "template-parts/cards/card-{$post_type}.php",
        "template-parts/cards/card-{$variant}.php",
        'template-parts/cards/card-standard.php',
    );

    $located = locate_template( $templates );
    if ( $located ) {
        set_query_var( 'gl_card_args', array_merge( $args, array(
            'variant'   => $variant,
            'context'   => $context,
            'post_type' => $post_type,
        ) ) );
        load_template( $located, false );
    }

    wp_reset_postdata();
}

/* ================================================================
   RESPONSIVE LAYOUT SETTINGS
   ================================================================ */

/**
 * Get responsive layout configuration.
 */
function gtalobby_get_responsive_config() {
    $defaults = array(
        'widescreen' => array(
            'breakpoint'   => 1440,
            'columns'      => 'three-column',
            'sidebar'      => 'both',
            'hub_grid'     => 4,
            'archive_grid' => 4,
        ),
        'desktop' => array(
            'breakpoint'   => 1200,
            'columns'      => 'two-column',
            'sidebar'      => 'right',
            'hub_grid'     => 3,
            'archive_grid' => 3,
        ),
        'tablet' => array(
            'breakpoint'   => 768,
            'columns'      => 'single-collapsible',
            'sidebar'      => 'collapsible',
            'hub_grid'     => 2,
            'archive_grid' => 2,
        ),
        'mobile' => array(
            'breakpoint'   => 0,
            'columns'      => 'single',
            'sidebar'      => 'hidden',
            'hub_grid'     => 1,
            'archive_grid' => 1,
        ),
    );

    $saved = get_option( 'gtalobby_responsive_config', array() );
    return wp_parse_args( $saved, $defaults );
}

/* ================================================================
   CONDITIONAL LAYOUT RULES ENGINE
   Allows admin-defined rules for single post layout variations.
   ================================================================ */

/**
 * Get conditional layout rules.
 */
function gtalobby_get_layout_rules() {
    $defaults = array(
        array(
            'name'      => 'GTA 6 Guide',
            'condition' => array( 'category' => 'gta6', 'post_type' => 'guide' ),
            'show'      => array( 'gta6_confidence', 'gta6_notice', 'sources' ),
            'hide'      => array(),
            'style'     => 'hero-overlay',
        ),
        array(
            'name'      => 'Cheats Database',
            'condition' => array( 'category' => 'cheats', 'post_type' => 'database' ),
            'show'      => array( 'data_table' ),
            'hide'      => array( 'video_embed' ),
            'style'     => 'utility-first',
        ),
        array(
            'name'      => 'Vehicle Profile',
            'condition' => array( 'category' => 'cars', 'post_type' => 'profile' ),
            'show'      => array( 'stats_table', 'gallery' ),
            'hide'      => array(),
            'style'     => 'entity-showcase',
        ),
        array(
            'name'      => 'Mod Listing',
            'condition' => array( 'post_type' => 'mod' ),
            'show'      => array( 'download_box', 'install_steps', 'gallery' ),
            'hide'      => array(),
            'style'     => 'product-page',
        ),
    );

    return get_option( 'gtalobby_layout_rules', $defaults );
}

/**
 * Apply conditional rules to a zone configuration for single posts.
 */
function gtalobby_apply_layout_rules( $zones, $post_id = null ) {
    $post_id   = $post_id ?: get_the_ID();
    $post_type = get_post_type( $post_id );
    $cat_slug  = gtalobby_get_current_category_slug();
    $rules     = gtalobby_get_layout_rules();

    foreach ( $rules as $rule ) {
        // Check if rule matches current post
        $matches = true;

        if ( isset( $rule['condition']['post_type'] ) && $rule['condition']['post_type'] !== $post_type ) {
            $matches = false;
        }
        if ( isset( $rule['condition']['category'] ) && $rule['condition']['category'] !== $cat_slug ) {
            $matches = false;
        }

        if ( ! $matches ) {
            continue;
        }

        // Apply show rules
        if ( ! empty( $rule['show'] ) ) {
            foreach ( (array) $rule['show'] as $zone_id ) {
                if ( isset( $zones[ $zone_id ] ) ) {
                    $zones[ $zone_id ]['enabled'] = true;
                }
            }
        }

        // Apply hide rules
        if ( ! empty( $rule['hide'] ) ) {
            foreach ( (array) $rule['hide'] as $zone_id ) {
                if ( isset( $zones[ $zone_id ] ) ) {
                    $zones[ $zone_id ]['enabled'] = false;
                }
            }
        }
    }

    return $zones;
}
