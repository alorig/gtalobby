</div><!-- /.gl-main -->

<!-- Decorative gradient divider between content and footer -->
<div class="gl-footer__divider" aria-hidden="true"></div>

<footer class="gl-footer" role="contentinfo">

    <!-- ============================================================
         Newsletter Signup — Glassmorphism Card
         ============================================================ -->
    <div class="gl-footer__newsletter" data-animate="fade-up">
        <div class="gl-container">
            <div class="gl-footer__newsletter-card">
                <div class="gl-footer__newsletter-content">
                    <h3 class="gl-footer__newsletter-title">
                        <?php esc_html_e( 'Stay in the Loop', 'gtalobby' ); ?>
                    </h3>
                    <p class="gl-footer__newsletter-desc">
                        <?php esc_html_e( 'Get the latest GTA news, guides, and exclusive content delivered to your inbox.', 'gtalobby' ); ?>
                    </p>
                </div>
                <form class="gl-footer__newsletter-form" action="#" method="post">
                    <div class="gl-footer__newsletter-field">
                        <input type="email" name="newsletter_email" placeholder="<?php esc_attr_e( 'Enter your email', 'gtalobby' ); ?>" required class="gl-footer__newsletter-input" />
                        <button type="submit" class="gl-footer__newsletter-btn">
                            <?php esc_html_e( 'Subscribe', 'gtalobby' ); ?>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </button>
                    </div>
                    <p class="gl-footer__newsletter-note">
                        <?php esc_html_e( 'No spam. Unsubscribe anytime.', 'gtalobby' ); ?>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <!-- ============================================================
         Footer Top — Brand + Quick Links
         ============================================================ -->
    <div class="gl-footer__top" data-animate="fade-up">
        <div class="gl-container gl-footer__top-grid">

            <!-- Brand -->
            <div class="gl-footer__brand">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="gl-footer__logo-link">
                    <span class="gl-footer__logo-icon">GL</span>
                    <span class="gl-footer__logo-text"><?php bloginfo( 'name' ); ?></span>
                </a>
                <p class="gl-footer__tagline"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></p>

                <!-- Social Media Icons -->
                <div class="gl-footer__social">
                    <a href="#" class="gl-footer__social-link gl-footer__social-link--twitter" aria-label="<?php esc_attr_e( 'Follow us on X (Twitter)', 'gtalobby' ); ?>">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    <a href="#" class="gl-footer__social-link gl-footer__social-link--discord" aria-label="<?php esc_attr_e( 'Join our Discord', 'gtalobby' ); ?>">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057 19.9 19.9 0 0 0 5.993 3.03.078.078 0 0 0 .084-.028c.462-.63.874-1.295 1.226-1.994a.076.076 0 0 0-.041-.106 13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.892.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.03zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.956-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.955-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.946 2.418-2.157 2.418z"/></svg>
                    </a>
                    <a href="#" class="gl-footer__social-link gl-footer__social-link--youtube" aria-label="<?php esc_attr_e( 'Subscribe on YouTube', 'gtalobby' ); ?>">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                    <a href="#" class="gl-footer__social-link gl-footer__social-link--reddit" aria-label="<?php esc_attr_e( 'Join us on Reddit', 'gtalobby' ); ?>">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0zm5.01 4.744c.688 0 1.25.561 1.25 1.249a1.25 1.25 0 0 1-2.498.056l-2.597-.547-.8 3.747c1.824.07 3.48.632 4.674 1.488.308-.309.73-.491 1.207-.491.968 0 1.754.786 1.754 1.754 0 .716-.435 1.333-1.01 1.614a3.111 3.111 0 0 1 .042.52c0 2.694-3.13 4.87-7.004 4.87-3.874 0-7.004-2.176-7.004-4.87 0-.183.015-.366.043-.534A1.748 1.748 0 0 1 4.028 12c0-.968.786-1.754 1.754-1.754.463 0 .898.196 1.207.49 1.207-.883 2.878-1.43 4.744-1.487l.885-4.182a.342.342 0 0 1 .14-.197.35.35 0 0 1 .238-.042l2.906.617a1.214 1.214 0 0 1 1.108-.701zM9.25 12C8.561 12 8 12.562 8 13.25c0 .687.561 1.248 1.25 1.248.687 0 1.248-.561 1.248-1.249 0-.688-.561-1.249-1.249-1.249zm5.5 0c-.687 0-1.248.561-1.248 1.25 0 .687.561 1.248 1.249 1.248.688 0 1.249-.561 1.249-1.249 0-.687-.562-1.249-1.25-1.249zm-5.466 3.99a.327.327 0 0 0-.231.094.33.33 0 0 0 0 .463c.842.842 2.484.913 2.961.913.477 0 2.105-.056 2.961-.913a.361.361 0 0 0 .029-.463.33.33 0 0 0-.464 0c-.547.533-1.684.73-2.512.73-.828 0-1.979-.196-2.512-.73a.326.326 0 0 0-.232-.095z"/></svg>
                    </a>
                </div>
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
         Category Pills with Colored Dot Indicators
         ============================================================ -->
    <div class="gl-footer__categories" data-animate="fade-up">
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
                    <span class="gl-footer__cat-dot" aria-hidden="true"></span>
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
         Animated Wave/Gradient Separator
         ============================================================ -->
    <div class="gl-footer__wave-separator" aria-hidden="true">
        <div class="gl-footer__wave-gradient"></div>
    </div>

    <!-- ============================================================
         Copyright
         ============================================================ -->
    <div class="gl-footer__bottom" data-animate="fade-up">
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

<button class="gl-back-to-top" aria-label="<?php esc_attr_e( 'Back to top', 'gtalobby' ); ?>">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"/></svg>
</button>

<?php wp_footer(); ?>
</body>
</html>
