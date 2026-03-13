<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- SVG Icon Sprite (hidden) -->
<svg xmlns="http://www.w3.org/2000/svg" style="display:none">
    <symbol id="icon-clock" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></symbol>
    <symbol id="icon-grid" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></symbol>
    <symbol id="icon-chevron-left" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></symbol>
    <symbol id="icon-chevron-right" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></symbol>
    <symbol id="icon-search" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></symbol>
    <symbol id="icon-menu" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></symbol>
    <symbol id="icon-x" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></symbol>
    <symbol id="icon-link" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></symbol>
    <symbol id="icon-facebook" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></symbol>
    <symbol id="icon-reddit" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="10"/><path d="M16.5 13.5c0 .83-.67 1.5-1.5 1.5s-1.5-.67-1.5-1.5.67-1.5 1.5-1.5 1.5.67 1.5 1.5z" fill="white"/><path d="M10.5 13.5c0 .83-.67 1.5-1.5 1.5s-1.5-.67-1.5-1.5.67-1.5 1.5-1.5 1.5.67 1.5 1.5z" fill="white"/></symbol>
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
                    <?php bloginfo( 'name' ); ?>
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
            }
            ?>
        </nav>

        <!-- Header Actions (search + mobile toggle) -->
        <div class="gl-header__actions">
            <!-- Search Toggle -->
            <button class="gl-header__search-toggle" aria-label="<?php esc_attr_e( 'Toggle Search', 'gtalobby' ); ?>" data-toggle="search">
                <svg class="gl-icon" width="20" height="20"><use href="#icon-search"></use></svg>
            </button>

            <!-- Mobile Menu Toggle -->
            <button class="gl-header__menu-toggle" aria-label="<?php esc_attr_e( 'Toggle Menu', 'gtalobby' ); ?>" aria-expanded="false" data-toggle="menu">
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

<main id="main-content" class="gl-main" role="main">
