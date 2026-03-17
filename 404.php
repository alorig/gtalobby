<?php
/**
 * 404 Page Template — Premium Cinematic Design
 *
 * Full-viewport hero with glitch-animated 404, glassmorphism
 * search, category pills, and recent content cards.
 *
 * @package GtaLobby
 */

get_header();
?>

<div class="gl-page gl-page--404">

    <!-- ============================================================
         Cinematic 404 Hero
         ============================================================ -->
    <section class="gl-404-hero" data-animate>
        <!-- Decorative background orbs -->
        <div class="gl-404-hero__orb gl-404-hero__orb--accent" aria-hidden="true"></div>
        <div class="gl-404-hero__orb gl-404-hero__orb--secondary" aria-hidden="true"></div>
        <div class="gl-404-hero__orb gl-404-hero__orb--dim" aria-hidden="true"></div>

        <div class="gl-container">
            <div class="gl-404-hero__inner">

                <!-- Glitch 404 number -->
                <div class="gl-404-hero__code" aria-hidden="true" data-text="404">404</div>

                <h1 class="gl-404-hero__title" data-animate>
                    <?php esc_html_e( 'Page Not Found', 'gtalobby' ); ?>
                </h1>

                <p class="gl-404-hero__desc" data-animate>
                    <?php esc_html_e( 'The page you\'re looking for doesn\'t exist or has been moved. Try searching below or browse our categories.', 'gtalobby' ); ?>
                </p>

                <!-- Glassmorphism search -->
                <div class="gl-404-hero__search" data-animate>
                    <?php get_search_form(); ?>
                </div>

                <!-- Home CTA -->
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="gl-404-hero__cta">
                    <?php gtalobby_icon( 'home', 18 ); ?>
                    <?php esc_html_e( 'Back to Home', 'gtalobby' ); ?>
                </a>
            </div>
        </div>
    </section>

    <!-- ============================================================
         Category Pills
         ============================================================ -->
    <section class="gl-404-cats" data-animate>
        <div class="gl-container">
            <h2 class="gl-404-cats__title">
                <?php gtalobby_icon( 'grid', 22 ); ?>
                <?php esc_html_e( 'Browse Categories', 'gtalobby' ); ?>
            </h2>

            <div class="gl-404-cats__grid">
                <?php
                $sag_categories = gtalobby_get_sag_categories();
                foreach ( $sag_categories as $slug => $data ) :
                    $cat_obj = get_category_by_slug( $slug );
                    if ( ! $cat_obj ) continue;
                    $icon  = gtalobby_get_category_icon( $slug );
                    $color = gtalobby_get_category_color( $slug );
                ?>
                <a href="<?php echo esc_url( get_category_link( $cat_obj->term_id ) ); ?>"
                   class="gl-404-pill"
                   style="--pill-accent: <?php echo esc_attr( $color ); ?>">
                    <span class="gl-404-pill__icon"><?php gtalobby_icon( $icon, 18 ); ?></span>
                    <span class="gl-404-pill__name"><?php echo esc_html( $cat_obj->name ); ?></span>
                    <span class="gl-404-pill__count"><?php echo esc_html( $cat_obj->count ); ?></span>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ============================================================
         Recent Content
         ============================================================ -->
    <section class="gl-404-recent" data-animate>
        <div class="gl-container">
            <h2 class="gl-404-recent__title">
                <?php gtalobby_icon( 'clock', 22 ); ?>
                <?php esc_html_e( 'Recent Content', 'gtalobby' ); ?>
            </h2>

            <div class="gl-card-grid gl-card-grid--3col">
                <?php
                $recent = new WP_Query( array(
                    'posts_per_page' => 6,
                    'post_status'    => 'publish',
                    'post_type'      => array_merge( array( 'post' ), array_keys( gtalobby_get_post_types() ) ),
                ) );

                if ( $recent->have_posts() ) :
                    while ( $recent->have_posts() ) :
                        $recent->the_post();
                        echo '<div class="gl-card-grid__item">';
                        gtalobby_card( 'standard' );
                        echo '</div>';
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </section>

</div>

<?php get_footer(); ?>
