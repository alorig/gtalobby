</div><!-- /.gl-main -->

<footer class="gl-footer" role="contentinfo">

    <!-- ============================================================
         Footer Top — Brand + Quick Links
         ============================================================ -->
    <div class="gl-footer__top">
        <div class="gl-container gl-footer__top-grid">

            <!-- Brand -->
            <div class="gl-footer__brand">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="gl-footer__logo-link">
                    <span class="gl-footer__logo-icon">GL</span>
                    <span class="gl-footer__logo-text"><?php bloginfo( 'name' ); ?></span>
                </a>
                <p class="gl-footer__tagline"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></p>
            </div>

            <!-- Quick Links Columns -->
            <?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) : ?>

                <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                    <div class="gl-footer__col"><?php dynamic_sidebar( 'footer-1' ); ?></div>
                <?php endif; ?>

                <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                    <div class="gl-footer__col"><?php dynamic_sidebar( 'footer-2' ); ?></div>
                <?php endif; ?>

                <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                    <div class="gl-footer__col"><?php dynamic_sidebar( 'footer-3' ); ?></div>
                <?php endif; ?>

            <?php else : ?>

                <!-- Default columns when no widgets assigned -->
                <div class="gl-footer__col">
                    <h4 class="gl-footer__col-title"><?php esc_html_e( 'Top Categories', 'gtalobby' ); ?></h4>
                    <ul class="gl-footer__links">
                        <?php
                        $top_cats = array( 'gta6', 'cheats', 'online', 'mods' );
                        foreach ( $top_cats as $s ) :
                            $c = get_category_by_slug( $s );
                            if ( ! $c ) continue;
                        ?>
                        <li><a href="<?php echo esc_url( get_category_link( $c->term_id ) ); ?>"><?php echo esc_html( $c->name ); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="gl-footer__col">
                    <h4 class="gl-footer__col-title"><?php esc_html_e( 'More Topics', 'gtalobby' ); ?></h4>
                    <ul class="gl-footer__links">
                        <?php
                        $more_cats = array( 'cars', 'characters', 'locations', 'money', 'news' );
                        foreach ( $more_cats as $s ) :
                            $c = get_category_by_slug( $s );
                            if ( ! $c ) continue;
                        ?>
                        <li><a href="<?php echo esc_url( get_category_link( $c->term_id ) ); ?>"><?php echo esc_html( $c->name ); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="gl-footer__col">
                    <h4 class="gl-footer__col-title"><?php esc_html_e( 'About', 'gtalobby' ); ?></h4>
                    <ul class="gl-footer__links">
                        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'gtalobby' ); ?></a></li>

                        <?php if ( get_page_by_path( 'about' ) ) : ?>
                        <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About Us', 'gtalobby' ); ?></a></li>
                        <?php endif; ?>

                        <?php if ( get_page_by_path( 'contact' ) ) : ?>
                        <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'gtalobby' ); ?></a></li>
                        <?php endif; ?>

                        <?php if ( get_privacy_policy_url() ) : ?>
                        <li><a href="<?php echo esc_url( get_privacy_policy_url() ); ?>"><?php esc_html_e( 'Privacy Policy', 'gtalobby' ); ?></a></li>
                        <?php endif; ?>
                    </ul>
                </div>

            <?php endif; ?>
        </div>
    </div>

    <!-- ============================================================
         Category Pills
         ============================================================ -->
    <div class="gl-footer__categories">
        <div class="gl-container">
            <h3 class="gl-footer__heading"><?php esc_html_e( 'Browse by Category', 'gtalobby' ); ?></h3>

            <div class="gl-footer__cat-grid">
                <?php
                $sag_cats = gtalobby_get_sag_categories();
                foreach ( $sag_cats as $slug => $name ) :
                    $cat = get_category_by_slug( $slug );
                    if ( ! $cat ) continue;
                    $color = gtalobby_get_category_color( $slug );
                    $icon  = gtalobby_get_category_icon( $slug );
                ?>
                <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"
                   class="gl-footer__cat-link"
                   style="--cat-color: <?php echo esc_attr( $color ); ?>">
                    <?php gtalobby_icon( $icon, 14 ); ?>
                    <?php echo esc_html( $name ); ?>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- ============================================================
         Footer Navigation
         ============================================================ -->
    <?php if ( has_nav_menu( 'footer' ) ) : ?>
    <nav class="gl-footer__nav-wrap" aria-label="<?php esc_attr_e( 'Footer Navigation', 'gtalobby' ); ?>">
        <div class="gl-container">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'footer',
                'menu_class'     => 'gl-footer__nav-list',
                'container'      => false,
                'depth'          => 1,
                'fallback_cb'    => false,
            ) );
            ?>
        </div>
    </nav>
    <?php endif; ?>

    <!-- ============================================================
         Copyright
         ============================================================ -->
    <div class="gl-footer__bottom">
        <div class="gl-container gl-footer__bottom-inner">
            <p class="gl-footer__copyright">
                &copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>.
                <?php esc_html_e( 'All rights reserved.', 'gtalobby' ); ?>
            </p>
            <p class="gl-footer__disclaimer">
                <?php esc_html_e( 'GtaLobby is not affiliated with Rockstar Games, Take-Two Interactive, or any of their subsidiaries.', 'gtalobby' ); ?>
            </p>
        </div>
    </div>

</footer>

<?php wp_footer(); ?>
</body>
</html>
