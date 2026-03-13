<?php
/**
 * 404 Page Template
 *
 * @package GtaLobby
 */

get_header();
?>

<div class="gl-page gl-page--404">
    <div class="gl-container gl-container--narrow">

        <main class="gl-page__main" id="main-content">
            <article class="gl-404">

                <div class="gl-404__code">404</div>

                <h1 class="gl-404__title"><?php esc_html_e( 'Page Not Found', 'gtalobby' ); ?></h1>
                <p class="gl-404__desc"><?php esc_html_e( 'The page you\'re looking for doesn\'t exist or has been moved. Try searching or browse our categories below.', 'gtalobby' ); ?></p>

                <div class="gl-404__search">
                    <?php get_search_form(); ?>
                </div>

                <div class="gl-404__categories">
                    <h2 class="gl-404__subtitle"><?php esc_html_e( 'Browse Categories', 'gtalobby' ); ?></h2>
                    <div class="gl-category-grid gl-category-grid--compact">
                        <?php
                        $sag_categories = gtalobby_get_sag_categories();
                        foreach ( $sag_categories as $slug => $data ) :
                            $cat_obj = get_category_by_slug( $slug );
                            if ( ! $cat_obj ) continue;
                            $icon = gtalobby_get_category_icon( $slug );
                        ?>
                        <a href="<?php echo esc_url( get_category_link( $cat_obj->term_id ) ); ?>" class="gl-category-tile gl-category-tile--compact" style="--cat-accent: <?php echo esc_attr( gtalobby_get_category_color( $slug ) ); ?>">
                            <span class="gl-category-tile__icon"><?php gtalobby_icon( $icon, 20 ); ?></span>
                            <span class="gl-category-tile__name"><?php echo esc_html( $cat_obj->name ); ?></span>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="gl-404__recent">
                    <h2 class="gl-404__subtitle"><?php esc_html_e( 'Recent Content', 'gtalobby' ); ?></h2>
                    <div class="gl-card-grid gl-card-grid--3col">
                        <?php
                        $recent = new WP_Query( array(
                            'posts_per_page' => 3,
                            'post_status'    => 'publish',
                            'post_type'      => array_merge( array( 'post' ), array_keys( gtalobby_get_post_types() ) ),
                        ) );
                        if ( $recent->have_posts() ) :
                            while ( $recent->have_posts() ) : $recent->the_post();
                                gtalobby_card( 'compact' );
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                </div>

            </article>
        </main>

    </div>
</div>

<?php get_footer(); ?>
