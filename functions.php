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

// Content seeders
require_once GTALOBBY_INC . '/seed-hub-pages.php';
require_once GTALOBBY_INC . '/seed-bulk-content.php';
require_once GTALOBBY_INC . '/seed-content.php';
require_once GTALOBBY_INC . '/seed-vehicles.php';

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
 * Get the category accent color for a given slug or name.
 */
function gtalobby_get_category_color( $slug ) {
    // Pull colors from the centralized color system (admin-editable)
    $config = gtalobby_get_color_config();

    $fallback = $config['cat_gta6'];

    if ( ! $slug ) {
        return $fallback;
    }

    $slug = strtolower( trim( $slug ) );

    // Direct match: slug → cat_{slug}
    if ( isset( $config[ 'cat_' . $slug ] ) ) {
        return $config[ 'cat_' . $slug ];
    }

    // Support category name lookup from SAG category labels.
    foreach ( gtalobby_get_sag_categories() as $item_slug => $label ) {
        if ( strtolower( $label ) === $slug ) {
            return isset( $config[ 'cat_' . $item_slug ] ) ? $config[ 'cat_' . $item_slug ] : $fallback;
        }
    }

    // Support existing WordPress category slug / name via taxonomy lookup.
    $term = get_category_by_slug( $slug );
    if ( $term && ! is_wp_error( $term ) && isset( $config[ 'cat_' . $term->slug ] ) ) {
        return $config[ 'cat_' . $term->slug ];
    }

    $term = get_term_by( 'name', $slug, 'category' );
    if ( $term && ! is_wp_error( $term ) && isset( $config[ 'cat_' . $term->slug ] ) ) {
        return $config[ 'cat_' . $term->slug ];
    }

    return $fallback;
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

/**
 * Output Open Graph and Twitter Card meta tags.
 */
function gtalobby_open_graph_meta() {
    if ( is_admin() ) {
        return;
    }

    $title       = wp_get_document_title();
    $description = get_bloginfo( 'description' );
    $url         = home_url( '/' );
    $image       = '';
    $image_w     = '';
    $image_h     = '';
    $type        = 'website';
    $published   = '';
    $modified    = '';
    $author      = '';
    $section     = '';

    if ( is_singular() ) {
        $type        = 'article';
        $url         = get_permalink();
        $description = has_excerpt() ? get_the_excerpt() : wp_trim_words( get_the_content(), 30, '...' );
        $description = wp_strip_all_tags( $description );
        $published   = get_the_date( 'c' );
        $modified    = get_the_modified_date( 'c' );
        $author      = get_the_author_meta( 'display_name' );

        // Get primary category
        $cats = get_the_category();
        if ( ! empty( $cats ) ) {
            $section = $cats[0]->name;
        }

        if ( has_post_thumbnail() ) {
            $image    = get_the_post_thumbnail_url( null, 'gl-feature' );
            $img_id   = get_post_thumbnail_id();
            $img_data = wp_get_attachment_image_src( $img_id, 'gl-feature' );
            if ( $img_data ) {
                $image_w = $img_data[1];
                $image_h = $img_data[2];
            }
        }
    } elseif ( is_category() ) {
        $cat         = get_queried_object();
        $description = $cat->description ?: $description;
        $url         = get_category_link( $cat->term_id );
    } elseif ( is_search() ) {
        $description = sprintf( 'Search results for "%s" on %s', get_search_query(), get_bloginfo( 'name' ) );
        $url         = get_search_link();
    }

    $description = esc_attr( wp_trim_words( $description, 30, '...' ) );
    ?>
    <!-- SEO Meta -->
    <meta name="description" content="<?php echo $description; ?>">
    <link rel="canonical" href="<?php echo esc_url( $url ); ?>">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">

    <!-- Open Graph -->
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="<?php echo esc_attr( $type ); ?>">
    <meta property="og:title" content="<?php echo esc_attr( $title ); ?>">
    <meta property="og:description" content="<?php echo $description; ?>">
    <meta property="og:url" content="<?php echo esc_url( $url ); ?>">
    <meta property="og:site_name" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
    <?php if ( $image ) : ?>
    <meta property="og:image" content="<?php echo esc_url( $image ); ?>">
    <?php if ( $image_w && $image_h ) : ?>
    <meta property="og:image:width" content="<?php echo esc_attr( $image_w ); ?>">
    <meta property="og:image:height" content="<?php echo esc_attr( $image_h ); ?>">
    <?php endif; ?>
    <meta property="og:image:type" content="image/jpeg">
    <?php endif; ?>
    <?php if ( $published ) : ?>
    <meta property="article:published_time" content="<?php echo esc_attr( $published ); ?>">
    <meta property="article:modified_time" content="<?php echo esc_attr( $modified ); ?>">
    <?php endif; ?>
    <?php if ( $section ) : ?>
    <meta property="article:section" content="<?php echo esc_attr( $section ); ?>">
    <?php endif; ?>

    <!-- Twitter Card -->
    <meta name="twitter:card" content="<?php echo $image ? 'summary_large_image' : 'summary'; ?>">
    <meta name="twitter:title" content="<?php echo esc_attr( $title ); ?>">
    <meta name="twitter:description" content="<?php echo $description; ?>">
    <?php if ( $image ) : ?>
    <meta name="twitter:image" content="<?php echo esc_url( $image ); ?>">
    <?php endif; ?>
    <?php
}

/**
 * Add lazy loading to post thumbnails.
 */
function gtalobby_lazy_load_thumbnails( $attr, $attachment, $size ) {
    if ( ! is_admin() ) {
        $attr['loading'] = 'lazy';
    }
    return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'gtalobby_lazy_load_thumbnails', 10, 3 );

/**
 * Get a free stock image URL for a given category slug.
 *
 * Returns a Pexels CDN URL sized to the requested dimensions.
 * Used as fallback when posts have no featured image.
 *
 * @param string $slug   Category slug (gta6, cheats, online, etc.)
 * @param int    $width  Desired width.
 * @param int    $height Desired height.
 * @return string Pexels image URL.
 */
function gtalobby_get_stock_image_url( $slug = '', $width = 800, $height = 450 ) {
    $images = array(
        'gta6'       => 31002084,
        'cheats'     => 5380642,
        'online'     => 30469967,
        'mods'       => 7915357,
        'cars'       => 5880077,
        'characters' => 2773521,
        'locations'  => 2706750,
        'money'      => 4386431,
        'news'       => 3944454,
    );

    $id = isset( $images[ $slug ] ) ? $images[ $slug ] : 31002084;
    return sprintf(
        'https://images.pexels.com/photos/%d/pexels-photo-%d.jpeg?auto=compress&cs=tinysrgb&w=%d&h=%d&dpr=1',
        $id, $id, $width, $height
    );
}

/**
 * Output a stock image <img> tag as placeholder for missing thumbnails.
 *
 * @param string $slug  Category slug.
 * @param string $size  Size keyword: 'feature', 'card', 'thumb', 'square'.
 * @param string $class CSS class for the img element.
 */
function gtalobby_stock_image( $slug = '', $size = 'card', $class = '' ) {
    $sizes = array(
        'hero'    => array( 1440, 600 ),
        'feature' => array( 800, 450 ),
        'card'    => array( 400, 260 ),
        'square'  => array( 400, 400 ),
        'thumb'   => array( 200, 130 ),
    );
    $dim = isset( $sizes[ $size ] ) ? $sizes[ $size ] : $sizes['card'];
    $url = gtalobby_get_stock_image_url( $slug, $dim[0], $dim[1] );

    printf(
        '<img src="%s" alt="%s" width="%d" height="%d" class="%s" loading="lazy" />',
        esc_url( $url ),
        esc_attr( ucfirst( str_replace( '-', ' ', $slug ) ) . ' stock image' ),
        $dim[0],
        $dim[1],
        esc_attr( $class )
    );
}

/**
 * Add lazy loading to content images.
 */
function gtalobby_lazy_load_content_images( $content ) {
    if ( is_admin() || is_feed() ) {
        return $content;
    }
    $content = preg_replace(
        '/<img(?!.*loading=)([^>]*)>/i',
        '<img loading="lazy"$1>',
        $content
    );
    return $content;
}
add_filter( 'the_content', 'gtalobby_lazy_load_content_images', 99 );

/**
 * Google Analytics / GTM placeholder.
 * Replace GA_MEASUREMENT_ID with your actual tracking ID in WP Admin or here.
 */
function gtalobby_analytics_head() {
    $ga_id = gtalobby_get_option( 'gtalobby_general_options', 'ga_measurement_id', '' );
    if ( empty( $ga_id ) || is_admin() ) {
        return;
    }
    ?>
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( $ga_id ); ?>"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '<?php echo esc_js( $ga_id ); ?>');
    </script>
    <?php
}
add_action( 'wp_head', 'gtalobby_analytics_head', 1 );

/**
 * Basic XML Sitemap generation.
 */
function gtalobby_register_sitemap() {
    // WordPress 5.5+ has built-in sitemaps — enable them
    add_filter( 'wp_sitemaps_enabled', '__return_true' );

    // Add custom post types to the sitemap
    add_filter( 'wp_sitemaps_post_types', function( $post_types ) {
        $custom_types = gtalobby_get_post_types();
        foreach ( $custom_types as $cpt ) {
            $obj = get_post_type_object( $cpt );
            if ( $obj && $obj->public ) {
                $post_types[ $cpt ] = $obj;
            }
        }
        return $post_types;
    } );
}
add_action( 'init', 'gtalobby_register_sitemap' );

/**
 * Newsletter signup form shortcode and template tag.
 * Usage: <?php gtalobby_newsletter_form(); ?> or [gtalobby_newsletter]
 */
function gtalobby_newsletter_form() {
    ?>
    <div class="gl-newsletter">
        <div class="gl-newsletter__inner">
            <div class="gl-newsletter__text">
                <h3 class="gl-newsletter__title"><?php esc_html_e( 'Stay in the Loop', 'gtalobby' ); ?></h3>
                <p class="gl-newsletter__desc"><?php esc_html_e( 'Get the latest GTA 6 news, guides, and cheat codes delivered to your inbox.', 'gtalobby' ); ?></p>
            </div>
            <form class="gl-newsletter__form" action="#" method="post">
                <?php wp_nonce_field( 'gtalobby_newsletter', 'gl_newsletter_nonce' ); ?>
                <div class="gl-newsletter__field">
                    <input type="email" name="gl_newsletter_email" class="gl-newsletter__input"
                           placeholder="<?php esc_attr_e( 'Enter your email', 'gtalobby' ); ?>"
                           required aria-label="<?php esc_attr_e( 'Email address', 'gtalobby' ); ?>">
                    <button type="submit" class="gl-newsletter__btn">
                        <?php esc_html_e( 'Subscribe', 'gtalobby' ); ?>
                        <svg class="gl-icon" width="16" height="16"><use href="#icon-arrow-right"></use></svg>
                    </button>
                </div>
                <p class="gl-newsletter__privacy"><?php esc_html_e( 'No spam. Unsubscribe anytime.', 'gtalobby' ); ?></p>
            </form>
        </div>
    </div>
    <?php
}
add_shortcode( 'gtalobby_newsletter', function() {
    ob_start();
    gtalobby_newsletter_form();
    return ob_get_clean();
} );

/**
 * Include custom post types in category, tag, and taxonomy archives.
 * Without this, WordPress only shows standard 'post' type on category pages.
 */
function gtalobby_include_cpts_in_archives( $query ) {
    if ( is_admin() || ! $query->is_main_query() ) {
        return;
    }

    if ( is_category() || is_tag() || is_tax() ) {
        $cpts  = gtalobby_get_post_types();
        $types = array_merge( array( 'post' ), $cpts );
        $query->set( 'post_type', $types );
    }

    // Also include CPTs on the main blog/home page
    if ( is_home() ) {
        $cpts  = gtalobby_get_post_types();
        $types = array_merge( array( 'post' ), $cpts );
        $query->set( 'post_type', $types );
    }
}
add_action( 'pre_get_posts', 'gtalobby_include_cpts_in_archives' );

/**
 * SEO: Optimized title tag with site name separator.
 */
function gtalobby_document_title_separator( $sep ) {
    return '—';
}
add_filter( 'document_title_separator', 'gtalobby_document_title_separator' );

/**
 * SEO: Add breadcrumb JSON-LD structured data.
 */
function gtalobby_breadcrumb_schema() {
    if ( is_admin() || is_front_page() ) {
        return;
    }

    $items = array();
    $pos   = 1;

    $items[] = array(
        '@type'    => 'ListItem',
        'position' => $pos++,
        'name'     => get_bloginfo( 'name' ),
        'item'     => home_url( '/' ),
    );

    if ( is_category() ) {
        $cat = get_queried_object();
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => $pos++,
            'name'     => $cat->name,
            'item'     => get_category_link( $cat->term_id ),
        );
    } elseif ( is_singular() ) {
        $cats = get_the_category();
        if ( ! empty( $cats ) ) {
            $items[] = array(
                '@type'    => 'ListItem',
                'position' => $pos++,
                'name'     => $cats[0]->name,
                'item'     => get_category_link( $cats[0]->term_id ),
            );
        }
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => $pos++,
            'name'     => get_the_title(),
            'item'     => get_permalink(),
        );
    }

    if ( count( $items ) > 1 ) {
        $schema = array(
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => $items,
        );
        echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
    }
}
add_action( 'wp_head', 'gtalobby_breadcrumb_schema', 5 );

/**
 * SEO: Add custom post type archive pages to sitemap with priority.
 */
function gtalobby_sitemap_entry( $entry, $post_type, $post ) {
    if ( in_array( $post_type, array( 'guide', 'ranking', 'database', 'profile' ), true ) ) {
        $entry['lastmod'] = get_the_modified_date( 'Y-m-d\TH:i:sP', $post );
    }
    return $entry;
}
add_filter( 'wp_sitemaps_posts_entry', 'gtalobby_sitemap_entry', 10, 3 );

/**
 * SEO: Output hreflang for international support (future-ready).
 */
function gtalobby_hreflang_tags() {
    if ( is_admin() ) {
        return;
    }
    $url = is_singular() ? get_permalink() : home_url( $_SERVER['REQUEST_URI'] );
    echo '<link rel="alternate" hreflang="en" href="' . esc_url( $url ) . '">' . "\n";
    echo '<link rel="alternate" hreflang="x-default" href="' . esc_url( $url ) . '">' . "\n";
}
add_action( 'wp_head', 'gtalobby_hreflang_tags', 3 );

/**
 * SEO: Remove unnecessary WordPress head clutter.
 */
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
