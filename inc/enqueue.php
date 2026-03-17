<?php
/**
 * GtaLobby — Asset Enqueue
 *
 * Registers and enqueues all stylesheets, scripts, and Google Fonts.
 *
 * @package GtaLobby
 */

defined( 'ABSPATH' ) || exit;

/* ================================================================
   1. FRONTEND STYLES & SCRIPTS
   ================================================================ */

function gtalobby_enqueue_assets() {
    $ver = GTALOBBY_VERSION;
    $uri = GTALOBBY_URI;

    /* --- Google Fonts --- */
    $fonts_url = gtalobby_get_google_fonts_url();
    if ( $fonts_url ) {
        wp_enqueue_style( 'gtalobby-fonts', $fonts_url, array(), null );
    }

    /* --- Stylesheets --- */
    // Design tokens (CSS custom properties)
    wp_enqueue_style( 'gtalobby-tokens', $uri . '/css/design-tokens.css', array(), $ver );

    // Main theme stylesheet (header only, but needed for WP recognition)
    wp_enqueue_style( 'gtalobby-style', get_stylesheet_uri(), array( 'gtalobby-tokens' ), $ver );

    // Core styles (always loaded)
    wp_enqueue_style( 'gtalobby-typography', $uri . '/css/typography.css', array( 'gtalobby-tokens' ), $ver );
    wp_enqueue_style( 'gtalobby-components', $uri . '/css/components.css', array( 'gtalobby-tokens' ), $ver );
    wp_enqueue_style( 'gtalobby-layout', $uri . '/css/layout.css', array( 'gtalobby-components' ), $ver );
    wp_enqueue_style( 'gtalobby-responsive', $uri . '/css/responsive.css', array( 'gtalobby-layout' ), $ver );
    wp_enqueue_style( 'gtalobby-animations', $uri . '/css/animations.css', array( 'gtalobby-responsive' ), $ver );

    // Context-specific styles
    if ( is_page_template( 'page-hub.php' ) ) {
        wp_enqueue_style( 'gtalobby-hub', $uri . '/css/hub-page.css', array( 'gtalobby-components' ), $ver );
    }

    if ( is_singular() && ! is_page() ) {
        wp_enqueue_style( 'gtalobby-single', $uri . '/css/single-templates.css', array( 'gtalobby-components' ), $ver );
    }

    if ( is_front_page() ) {
        wp_enqueue_style( 'gtalobby-homepage', $uri . '/css/homepage.css', array( 'gtalobby-components' ), $ver );
    }

    if ( is_front_page() || is_archive() || is_home() || is_search() || is_404() ) {
        wp_enqueue_style( 'gtalobby-archives', $uri . '/css/archives.css', array( 'gtalobby-components' ), $ver );
    }

    /* --- Scripts --- */
    // Main navigation
    wp_enqueue_script(
        'gtalobby-navigation',
        $uri . '/js/navigation.js',
        array(),
        $ver,
        true
    );

    // Smooth scroll (conditional)
    if ( gtalobby_is_enabled( 'enable_smooth_scroll' ) ) {
        wp_add_inline_script( 'gtalobby-navigation', "document.documentElement.style.scrollBehavior='smooth';" );
    }

    // Sortable tables (database post type)
    if ( is_singular( 'database' ) ) {
        wp_enqueue_script(
            'gtalobby-sortable',
            $uri . '/js/sortable-table.js',
            array(),
            $ver,
            true
        );
    }

    // Copy-to-clipboard for share buttons
    wp_enqueue_script(
        'gtalobby-share',
        $uri . '/js/share.js',
        array(),
        $ver,
        true
    );

    // Scroll animations controller
    wp_enqueue_script(
        'gtalobby-animations',
        $uri . '/js/animations.js',
        array(),
        $ver,
        true
    );

    // Localize script data
    wp_localize_script( 'gtalobby-navigation', 'gtalobbyData', array(
        'ajaxUrl'  => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'gtalobby_ajax' ),
        'siteUrl'  => home_url( '/' ),
        'i18n'     => array(
            'menuOpen'  => esc_html__( 'Open Menu', 'gtalobby' ),
            'menuClose' => esc_html__( 'Close Menu', 'gtalobby' ),
            'copied'    => esc_html__( 'Link copied!', 'gtalobby' ),
            'loading'   => esc_html__( 'Loading…', 'gtalobby' ),
        ),
    ) );

    // Comment reply script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'gtalobby_enqueue_assets' );

/* ================================================================
   2. ADMIN STYLES & SCRIPTS
   ================================================================ */

function gtalobby_enqueue_admin_assets( $hook ) {
    $ver = GTALOBBY_VERSION;
    $uri = GTALOBBY_URI;

    // Only on GtaLobby admin pages
    $gtalobby_pages = array(
        'toplevel_page_gtalobby-settings',
        'gtalobby_page_gtalobby-layout',
        'gtalobby_page_gtalobby-gta6',
    );

    if ( ! in_array( $hook, $gtalobby_pages, true ) ) {
        return;
    }

    // WordPress color picker
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker' );

    // jQuery UI sortable for layout composer
    wp_enqueue_script( 'jquery-ui-sortable' );

    // Admin CSS
    wp_enqueue_style(
        'gtalobby-admin',
        $uri . '/css/admin.css',
        array( 'wp-color-picker' ),
        $ver
    );

    // Admin JS
    wp_enqueue_script(
        'gtalobby-admin-settings',
        $uri . '/js/admin-settings.js',
        array( 'jquery', 'wp-color-picker' ),
        $ver,
        true
    );

    // Layout composer (only on layout page)
    if ( $hook === 'gtalobby_page_gtalobby-layout' ) {
        wp_enqueue_script(
            'gtalobby-layout-composer',
            $uri . '/js/layout-composer.js',
            array( 'jquery', 'jquery-ui-sortable' ),
            $ver,
            true
        );

        wp_localize_script( 'gtalobby-layout-composer', 'gtalobbyLayout', array(
            'ajaxUrl'    => admin_url( 'admin-ajax.php' ),
            'saveAction' => 'gtalobby_save_layout',
            'resetAction' => 'gtalobby_reset_layout',
            'nonce'      => wp_create_nonce( 'gtalobby_save_layout' ),
            'i18n'       => array(
                'saving'     => esc_html__( 'Saving…', 'gtalobby' ),
                'saved'      => esc_html__( 'Layout saved!', 'gtalobby' ),
                'resetConfirm' => esc_html__( 'Reset layout to defaults? This cannot be undone.', 'gtalobby' ),
                'error'      => esc_html__( 'Error saving layout.', 'gtalobby' ),
            ),
        ) );
    }
}
add_action( 'admin_enqueue_scripts', 'gtalobby_enqueue_admin_assets' );

/* ================================================================
   3. PRELOAD HINTS
   ================================================================ */

function gtalobby_resource_hints( $urls, $relation_type ) {
    if ( $relation_type === 'preconnect' ) {
        $urls[] = array(
            'href'        => 'https://fonts.googleapis.com',
            'crossorigin' => true,
        );
        $urls[] = array(
            'href'        => 'https://fonts.gstatic.com',
            'crossorigin' => true,
        );
    }
    return $urls;
}
add_filter( 'wp_resource_hints', 'gtalobby_resource_hints', 10, 2 );

/* ================================================================
   4. CLEANUP — Remove unnecessary default WP assets
   ================================================================ */

function gtalobby_cleanup_head() {
    remove_action( 'wp_head', 'wp_generator' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'rsd_link' );
}
add_action( 'init', 'gtalobby_cleanup_head' );
