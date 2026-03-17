<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/favicon.ico" sizes="32x32">
    <link rel="icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/apple-touch-icon.png">
    <link rel="manifest" href="<?php echo esc_url( get_template_directory_uri() ); ?>/manifest.json">
    <meta name="theme-color" content="#060714">
    <?php gtalobby_open_graph_meta(); ?>
    <style id="gl-preloader-critical">
        .gl-preloader{position:fixed;inset:0;z-index:99999;background:#060714;display:flex;align-items:center;justify-content:center}
        .gl-preloader.is-done{opacity:0;visibility:hidden;pointer-events:none;transition:opacity .5s,visibility .5s}
        body.gl-loading{overflow:hidden}
    </style>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Preloader -->
<div class="gl-preloader" id="gl-preloader" aria-hidden="true">
    <div class="gl-preloader__inner">
        <div class="gl-preloader__logo">
            <span class="gl-preloader__icon">GL</span>
            <span class="gl-preloader__site"><?php bloginfo( 'name' ); ?></span>
        </div>
        <div class="gl-preloader__bar">
            <div class="gl-preloader__progress" id="gl-preloader-progress"></div>
        </div>
        <span class="gl-preloader__text">Loading</span>
    </div>
    <!-- Animated background particles -->
    <div class="gl-preloader__particles">
        <span></span><span></span><span></span><span></span><span></span><span></span>
    </div>
</div>

<a class="gl-skip-link" href="#main-content"><?php esc_html_e( 'Skip to content', 'gtalobby' ); ?></a>
<div class="gl-scroll-progress" aria-hidden="true"></div>

<!-- SVG Icon Sprite (hidden) -->
<svg xmlns="http://www.w3.org/2000/svg" style="display:none">

    <!-- ==================== UI Icons ==================== -->

    <symbol id="icon-clock" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
    </symbol>

    <symbol id="icon-grid" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
        <rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>
    </symbol>

    <symbol id="icon-chevron-left" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <polyline points="15 18 9 12 15 6"/>
    </symbol>

    <symbol id="icon-chevron-right" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <polyline points="9 18 15 12 9 6"/>
    </symbol>

    <symbol id="icon-search" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
    </symbol>

    <symbol id="icon-menu" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <line x1="3" y1="12" x2="21" y2="12"/>
        <line x1="3" y1="6" x2="21" y2="6"/>
        <line x1="3" y1="18" x2="21" y2="18"/>
    </symbol>

    <symbol id="icon-x" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
    </symbol>

    <symbol id="icon-link" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
    </symbol>

    <symbol id="icon-facebook" viewBox="0 0 24 24" fill="currentColor">
        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
    </symbol>

    <symbol id="icon-reddit" viewBox="0 0 24 24" fill="currentColor">
        <circle cx="12" cy="12" r="10"/>
        <path d="M16.5 13.5c0 .83-.67 1.5-1.5 1.5s-1.5-.67-1.5-1.5.67-1.5 1.5-1.5 1.5.67 1.5 1.5z" fill="white"/>
        <path d="M10.5 13.5c0 .83-.67 1.5-1.5 1.5s-1.5-.67-1.5-1.5.67-1.5 1.5-1.5 1.5.67 1.5 1.5z" fill="white"/>
    </symbol>

    <symbol id="icon-arrow-right" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
    </symbol>

    <symbol id="icon-x-twitter" viewBox="0 0 24 24" fill="currentColor">
        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
    </symbol>

    <symbol id="icon-external" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/>
        <polyline points="15 3 21 3 21 9"/>
        <line x1="10" y1="14" x2="21" y2="3"/>
    </symbol>

    <!-- ==================== Category Icons ==================== -->

    <symbol id="icon-cat-gta6" viewBox="0 0 24 24">
        <path d="M6 11V6a2 2 0 012-2h8a2 2 0 012 2v5" fill="none" stroke="currentColor" stroke-width="2"/>
        <rect x="4" y="11" width="16" height="9" rx="2" fill="none" stroke="currentColor" stroke-width="2"/>
        <circle cx="9" cy="15.5" r="1.5" fill="currentColor"/>
        <circle cx="15" cy="15.5" r="1.5" fill="currentColor"/>
        <path d="M10.5 13h3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
    </symbol>

    <symbol id="icon-cat-cheats" viewBox="0 0 24 24">
        <rect x="5" y="11" width="14" height="10" rx="2" fill="none" stroke="currentColor" stroke-width="2"/>
        <path d="M8 11V7a4 4 0 018 0v4" fill="none" stroke="currentColor" stroke-width="2"/>
        <circle cx="12" cy="16" r="1.5" fill="currentColor"/>
        <line x1="12" y1="17.5" x2="12" y2="19" stroke="currentColor" stroke-width="2"/>
    </symbol>

    <symbol id="icon-cat-online" viewBox="0 0 24 24">
        <circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="2"/>
        <path d="M2 12h20" stroke="currentColor" stroke-width="2"/>
        <path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z" fill="none" stroke="currentColor" stroke-width="2"/>
    </symbol>

    <symbol id="icon-cat-mods" viewBox="0 0 24 24">
        <path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z" fill="none" stroke="currentColor" stroke-width="2"/>
    </symbol>

    <symbol id="icon-cat-cars" viewBox="0 0 24 24">
        <path d="M5 17h14v-5l-2-5H7L5 12v5z" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
        <circle cx="7.5" cy="17" r="2" fill="none" stroke="currentColor" stroke-width="2"/>
        <circle cx="16.5" cy="17" r="2" fill="none" stroke="currentColor" stroke-width="2"/>
        <path d="M5 12h14" stroke="currentColor" stroke-width="2"/>
    </symbol>

    <symbol id="icon-cat-characters" viewBox="0 0 24 24">
        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" fill="none" stroke="currentColor" stroke-width="2"/>
        <circle cx="12" cy="7" r="4" fill="none" stroke="currentColor" stroke-width="2"/>
    </symbol>

    <symbol id="icon-cat-locations" viewBox="0 0 24 24">
        <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" fill="none" stroke="currentColor" stroke-width="2"/>
        <circle cx="12" cy="10" r="3" fill="none" stroke="currentColor" stroke-width="2"/>
    </symbol>

    <symbol id="icon-cat-money" viewBox="0 0 24 24">
        <line x1="12" y1="1" x2="12" y2="23" stroke="currentColor" stroke-width="2"/>
        <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" fill="none" stroke="currentColor" stroke-width="2"/>
    </symbol>

    <symbol id="icon-cat-news" viewBox="0 0 24 24">
        <path d="M4 4h16a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2z" fill="none" stroke="currentColor" stroke-width="2"/>
        <line x1="6" y1="8" x2="18" y2="8" stroke="currentColor" stroke-width="2"/>
        <line x1="6" y1="12" x2="12" y2="12" stroke="currentColor" stroke-width="2"/>
        <line x1="6" y1="16" x2="14" y2="16" stroke="currentColor" stroke-width="2"/>
        <rect x="14" y="11" width="4" height="5" rx="0.5" fill="currentColor" opacity="0.3"/>
    </symbol>

</svg>

<?php
// GTA 6 announcement banner
if ( gtalobby_is_enabled( 'enable_gta6_mode' ) && gtalobby_get_gta6_option( 'gta6_banner_enabled' ) ) :
    $banner_text = gtalobby_get_gta6_option( 'gta6_banner_text' );
    $banner_link = gtalobby_get_gta6_option( 'gta6_banner_link' );
    if ( $banner_text ) :
?>
<div class="gl-announcement-bar">
    <div class="gl-container">
        <?php if ( $banner_link ) : ?>
            <a href="<?php echo esc_url( $banner_link ); ?>" class="gl-announcement-bar__link">
                <?php echo esc_html( $banner_text ); ?>
            </a>
        <?php else : ?>
            <span class="gl-announcement-bar__text"><?php echo esc_html( $banner_text ); ?></span>
        <?php endif; ?>
    </div>
</div>
<?php endif; endif; ?>

<header class="gl-header" role="banner">
    <div class="gl-container gl-header__inner">

        <!-- Logo / Site Identity -->
        <div class="gl-header__brand">
            <?php if ( has_custom_logo() ) : ?>
                <div class="gl-header__logo">
                    <?php the_custom_logo(); ?>
                </div>
            <?php else : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="gl-header__site-name" rel="home">
                    <span class="gl-header__site-icon">GL</span>
                    <span class="gl-header__site-text"><?php bloginfo( 'name' ); ?></span>
                </a>
            <?php endif; ?>
        </div>

        <!-- Primary Navigation -->
        <nav class="gl-header__nav" role="navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'gtalobby' ); ?>">
            <?php
            if ( has_nav_menu( 'primary' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'gl-nav__list',
                    'container'      => false,
                    'depth'          => 2,
                    'fallback_cb'    => false,
                ) );
            } else {
                // Fallback navigation from SAG categories
                $sag_nav = gtalobby_get_sag_categories();
                echo '<ul class="gl-nav__list">';
                foreach ( $sag_nav as $slug => $name ) {
                    $cat = get_category_by_slug( $slug );
                    if ( ! $cat ) continue;
                    printf(
                        '<li><a href="%s">%s</a></li>',
                        esc_url( get_category_link( $cat->term_id ) ),
                        esc_html( $name )
                    );
                }
                echo '</ul>';
            }
            ?>
        </nav>

        <!-- Header Actions (search + mobile toggle) -->
        <div class="gl-header__actions">
            <button class="gl-header__search-toggle"
                    aria-label="<?php esc_attr_e( 'Toggle Search', 'gtalobby' ); ?>"
                    data-toggle="search">
                <svg class="gl-icon" width="20" height="20"><use href="#icon-search"></use></svg>
            </button>

            <button class="gl-header__menu-toggle"
                    aria-label="<?php esc_attr_e( 'Toggle Menu', 'gtalobby' ); ?>"
                    aria-expanded="false"
                    data-toggle="menu">
                <svg class="gl-icon gl-icon--menu" width="24" height="24"><use href="#icon-menu"></use></svg>
                <svg class="gl-icon gl-icon--close" width="24" height="24"><use href="#icon-x"></use></svg>
            </button>
        </div>
    </div>

    <!-- Search Overlay -->
    <div class="gl-search-overlay" id="gl-search-overlay" aria-hidden="true">
        <div class="gl-container">
            <form role="search" method="get" class="gl-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <label class="gl-search-form__label" for="gl-search-input">
                    <?php esc_html_e( 'Search GtaLobby', 'gtalobby' ); ?>
                </label>
                <div class="gl-search-form__field">
                    <input type="search" id="gl-search-input" class="gl-search-form__input" name="s"
                           placeholder="<?php esc_attr_e( 'Search guides, mods, rankings…', 'gtalobby' ); ?>"
                           value="<?php echo esc_attr( get_search_query() ); ?>" />
                    <button type="submit" class="gl-search-form__submit">
                        <svg class="gl-icon" width="20" height="20"><use href="#icon-search"></use></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Mobile Navigation Drawer -->
    <div class="gl-mobile-nav" id="gl-mobile-nav" aria-hidden="true">
        <div class="gl-mobile-nav__inner">
            <?php
            if ( has_nav_menu( 'mobile' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'mobile',
                    'menu_class'     => 'gl-mobile-nav__list',
                    'container'      => false,
                    'depth'          => 2,
                    'fallback_cb'    => false,
                ) );
            } elseif ( has_nav_menu( 'primary' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'gl-mobile-nav__list',
                    'container'      => false,
                    'depth'          => 2,
                    'fallback_cb'    => false,
                ) );
            }
            ?>
        </div>
    </div>
</header>

<?php
// Header ad slot
gtalobby_render_ad_slot( 'ad_header_banner', 'gl-ad-slot gl-ad-slot--header' );
?>

<div class="gl-main">
