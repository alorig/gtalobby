</main><!-- /.gl-main -->

<footer class="gl-footer" role="contentinfo">

    <!-- Footer Widgets -->
    <?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) : ?>
    <div class="gl-footer__widgets">
        <div class="gl-container gl-footer__columns">
            <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                <div class="gl-footer__col">
                    <?php dynamic_sidebar( 'footer-1' ); ?>
                </div>
            <?php endif; ?>

            <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                <div class="gl-footer__col">
                    <?php dynamic_sidebar( 'footer-2' ); ?>
                </div>
            <?php endif; ?>

            <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                <div class="gl-footer__col">
                    <?php dynamic_sidebar( 'footer-3' ); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- SAG Category Grid -->
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
                ?>
                    <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"
                       class="gl-footer__cat-link"
                       style="--cat-color: <?php echo esc_attr( $color ); ?>">
                        <?php echo esc_html( $name ); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Footer Navigation -->
    <?php if ( has_nav_menu( 'footer' ) ) : ?>
    <div class="gl-footer__nav">
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
    </div>
    <?php endif; ?>

    <!-- Copyright -->
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
