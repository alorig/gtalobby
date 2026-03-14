<?php
/**
 * Search Results Template
 *
 * @package GtaLobby
 */

get_header();
?>

<div class="gl-archive gl-archive--search">

    <!-- ============================================================
         Search Header
         ============================================================ -->
    <section class="gl-zone gl-zone--archive-header gl-search-header">
        <div class="gl-container">
            <h1 class="gl-search-header__title">
                <?php printf( esc_html__( 'Search Results for: %s', 'gtalobby' ), '<span>' . get_search_query() . '</span>' ); ?>
            </h1>

            <div class="gl-search-header__form">
                <?php get_search_form(); ?>
            </div>

            <?php if ( have_posts() ) : ?>
            <p class="gl-search-header__count">
                <?php printf( esc_html( _n( '%s result found', '%s results found', $wp_query->found_posts, 'gtalobby' ) ), number_format_i18n( $wp_query->found_posts ) ); ?>
            </p>
            <?php endif; ?>
        </div>
    </section>

    <!-- ============================================================
         Search Results Grid
         ============================================================ -->
    <div class="gl-container gl-archive__layout">

        <main class="gl-archive__main" id="main-content">
            <?php if ( have_posts() ) : ?>

            <div class="gl-card-grid gl-card-grid--2col">
                <?php
                while ( have_posts() ) :
                    the_post();
                    echo '<div class="gl-card-grid__item">';
                    gtalobby_card( 'standard' );
                    echo '</div>';
                endwhile;
                ?>
            </div>

            <?php gtalobby_pagination(); ?>

            <?php else : ?>

            <div class="gl-no-results">
                <h2><?php esc_html_e( 'No Results', 'gtalobby' ); ?></h2>
                <p><?php esc_html_e( 'Sorry, no results were found. Try different keywords or browse our categories.', 'gtalobby' ); ?></p>

                <div class="gl-no-results__categories">
                    <?php
                    $sag_categories = gtalobby_get_sag_categories();
                    foreach ( $sag_categories as $slug => $data ) :
                        $cat_obj = get_category_by_slug( $slug );
                        if ( ! $cat_obj ) continue;
                    ?>
                    <a href="<?php echo esc_url( get_category_link( $cat_obj->term_id ) ); ?>"
                       class="gl-btn gl-btn--outline">
                        <?php echo esc_html( $cat_obj->name ); ?>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php endif; ?>
        </main>

        <aside class="gl-archive__sidebar" role="complementary">
            <?php get_sidebar(); ?>
        </aside>

    </div>
</div>

<?php get_footer(); ?>
