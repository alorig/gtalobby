<?php
/**
 * GtaLobby Theme Functions
 *
 * Master functions file — sets up theme support, includes all modules.
 * Each module is in inc/ for maintainability.
 *
 * @package GtaLobby
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/* -------------------------------------------------------
   CONSTANTS
   ------------------------------------------------------- */
define( 'GTALOBBY_VERSION', '1.0.0' );
define( 'GTALOBBY_DIR', get_template_directory() );
define( 'GTALOBBY_URI', get_template_directory_uri() );
define( 'GTALOBBY_INC', GTALOBBY_DIR . '/inc' );

/* -------------------------------------------------------
   THEME SETUP
   ------------------------------------------------------- */
if ( ! function_exists( 'gtalobby_setup' ) ) {
    function gtalobby_setup() {
        // Translation support
        load_theme_textdomain( 'gtalobby', GTALOBBY_DIR . '/languages' );

        // Core WP features
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ) );
        add_theme_support( 'custom-logo', array(
            'height'      => 80,
            'width'       => 280,
            'flex-height' => true,
            'flex-width'  => true,
        ) );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'responsive-embeds' );
        add_theme_support( 'wp-block-styles' );

        // Custom image sizes
        add_image_size( 'gl-hero',        1440, 600, true );  // Hub hero
        add_image_size( 'gl-feature',     800,  450, true );  // Feature cards
        add_image_size( 'gl-card',        400,  260, true );  // Standard card
        add_image_size( 'gl-card-square', 400,  400, true );  // Square card
        add_image_size( 'gl-thumb',       200,  130, true );  // Compact thumbnail
        add_image_size( 'gl-avatar',      120,  120, true );  // Character avatar
        add_image_size( 'gl-gallery',     1200, 800, false );  // Gallery images

        // Navigation menus
        register_nav_menus( array(
            'primary'   => esc_html__( 'Primary Navigation', 'gtalobby' ),
            'footer'    => esc_html__( 'Footer Navigation', 'gtalobby' ),
            'mobile'    => esc_html__( 'Mobile Navigation', 'gtalobby' ),
        ) );

        // Content width
        if ( ! isset( $content_width ) ) {
            $content_width = 1200;
        }
    }
}
add_action( 'after_setup_theme', 'gtalobby_setup' );

/* -------------------------------------------------------
   WIDGET AREAS
   ------------------------------------------------------- */
function gtalobby_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Primary Sidebar', 'gtalobby' ),
        'id'            => 'sidebar-primary',
        'description'   => esc_html__( 'Main sidebar — contextual content based on page type.', 'gtalobby' ),
        'before_widget' => '<div id="%1$s" class="gl-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="gl-widget__title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Hub Sidebar', 'gtalobby' ),
        'id'            => 'sidebar-hub',
        'description'   => esc_html__( 'Sidebar for hub (cluster) pages.', 'gtalobby' ),
        'before_widget' => '<div id="%1$s" class="gl-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="gl-widget__title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Column 1', 'gtalobby' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'First footer column.', 'gtalobby' ),
        'before_widget' => '<div id="%1$s" class="gl-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="gl-widget__title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Column 2', 'gtalobby' ),
        'id'            => 'footer-2',
        'description'   => esc_html__( 'Second footer column.', 'gtalobby' ),
        'before_widget' => '<div id="%1$s" class="gl-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="gl-widget__title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Column 3', 'gtalobby' ),
        'id'            => 'footer-3',
        'description'   => esc_html__( 'Third footer column.', 'gtalobby' ),
        'before_widget' => '<div id="%1$s" class="gl-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="gl-widget__title">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'gtalobby_widgets_init' );

/* -------------------------------------------------------
   MODULE INCLUDES (Order matters for dependencies)
   ------------------------------------------------------- */

// Core data layer
require_once GTALOBBY_INC . '/post-types.php';
require_once GTALOBBY_INC . '/taxonomies.php';
require_once GTALOBBY_INC . '/custom-fields.php';

// Design & layout system
require_once GTALOBBY_INC . '/color-system.php';
require_once GTALOBBY_INC . '/layout-engine.php';

// Template helpers
require_once GTALOBBY_INC . '/template-tags.php';
require_once GTALOBBY_INC . '/breadcrumbs.php';
require_once GTALOBBY_INC . '/schema.php';
require_once GTALOBBY_INC . '/interlinking.php';

// Admin & settings
require_once GTALOBBY_INC . '/admin-settings.php';

// Content seeder (hub pages)
require_once GTALOBBY_INC . '/seed-hub-pages.php';

// Assets
require_once GTALOBBY_INC . '/enqueue.php';

/* -------------------------------------------------------
   UTILITY FUNCTIONS
   ------------------------------------------------------- */

/**
 * Get the primary category for a post.
 * Uses Yoast primary category if available, else first category.
 */
function gtalobby_get_primary_category( $post_id = null ) {
    $post_id = $post_id ?: get_the_ID();
    $categories = get_the_category( $post_id );

    if ( empty( $categories ) ) {
        return null;
    }

    // Try Yoast primary category
    $primary_term_id = get_post_meta( $post_id, '_yoast_wpseo_primary_category', true );
    if ( $primary_term_id ) {
        $primary = get_term( $primary_term_id, 'category' );
        if ( $primary && ! is_wp_error( $primary ) ) {
            return $primary;
        }
    }

    return $categories[0];
}

/**
 * Get category slug for the current context (post, archive, etc.)
 */
function gtalobby_get_current_category_slug() {
    if ( is_category() ) {
        return get_queried_object()->slug;
    }

    if ( is_singular() ) {
        $cat = gtalobby_get_primary_category();
        return $cat ? $cat->slug : '';
    }

    return '';
}

/**
 * Get the 9 SAG category slugs.
 */
function gtalobby_get_sag_categories() {
    return array(
        'gta6'       => esc_html__( 'GTA 6', 'gtalobby' ),
        'cheats'     => esc_html__( 'Cheat Codes & Cheats', 'gtalobby' ),
        'online'     => esc_html__( 'GTA Online', 'gtalobby' ),
        'mods'       => esc_html__( 'Mods & Modding', 'gtalobby' ),
        'cars'       => esc_html__( 'Cars & Vehicles', 'gtalobby' ),
        'characters' => esc_html__( 'Characters & Story', 'gtalobby' ),
        'locations'  => esc_html__( 'Map & Locations', 'gtalobby' ),
        'money'      => esc_html__( 'Money & Business', 'gtalobby' ),
        'news'       => esc_html__( 'News & Updates', 'gtalobby' ),
    );
}

/**
 * Get the category accent color for a given slug.
 */
function gtalobby_get_category_color( $slug ) {
    $colors = array(
        'gta6'       => '#6C5CE7',
        'cheats'     => '#E17055',
        'online'     => '#00CEC9',
        'mods'       => '#00B894',
        'cars'       => '#FDCB6E',
        'characters' => '#E84393',
        'locations'  => '#0984E3',
        'money'      => '#F9A825',
        'news'       => '#636E72',
    );
    return isset( $colors[ $slug ] ) ? $colors[ $slug ] : '#6C5CE7';
}

/**
 * Get the SVG icon sprite ID for a SAG category slug.
 */
function gtalobby_get_category_icon( $slug ) {
    $icons = array(
        'gta6'       => 'icon-cat-gta6',
        'cheats'     => 'icon-cat-cheats',
        'online'     => 'icon-cat-online',
        'mods'       => 'icon-cat-mods',
        'cars'       => 'icon-cat-cars',
        'characters' => 'icon-cat-characters',
        'locations'  => 'icon-cat-locations',
        'money'      => 'icon-cat-money',
        'news'       => 'icon-cat-news',
    );
    return isset( $icons[ $slug ] ) ? $icons[ $slug ] : 'icon-grid';
}

/**
 * Render SVG icon from the sprite.
 */
function gtalobby_icon( $id, $size = 24, $class = '' ) {
    $cls = 'gl-icon' . ( $class ? ' ' . esc_attr( $class ) : '' );
    printf(
        '<svg class="%s" width="%d" height="%d" aria-hidden="true"><use href="#%s"></use></svg>',
        $cls,
        (int) $size,
        (int) $size,
        esc_attr( $id )
    );
}

/**
 * Check if current post/page is in the GTA 6 category.
 */
function gtalobby_is_gta6_content() {
    if ( is_category( 'gta6' ) ) {
        return true;
    }
    if ( is_singular() ) {
        return has_category( 'gta6' );
    }
    return false;
}

/**
 * Add category-specific body classes for CSS targeting.
 */
function gtalobby_body_classes( $classes ) {
    $slug = gtalobby_get_current_category_slug();
    if ( $slug ) {
        $classes[] = 'category-' . $slug;
    }

    // Post type classes
    if ( is_singular() ) {
        $classes[] = 'gl-single';
        $classes[] = 'gl-single--' . get_post_type();
    }

    if ( is_page_template( 'page-hub.php' ) ) {
        $classes[] = 'gl-hub-page';
    }

    // Layout tier
    $classes[] = 'gl-light-theme';

    return $classes;
}
add_filter( 'body_class', 'gtalobby_body_classes' );

/**
 * Customize excerpt length.
 */
function gtalobby_excerpt_length( $length ) {
    if ( is_admin() ) {
        return $length;
    }
    return 25;
}
add_filter( 'excerpt_length', 'gtalobby_excerpt_length' );

/**
 * Customize excerpt more text.
 */
function gtalobby_excerpt_more( $more ) {
    return '&hellip;';
}
add_filter( 'excerpt_more', 'gtalobby_excerpt_more' );
