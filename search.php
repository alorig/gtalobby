<?php
/**
 * Search Results Template — Premium Design
 *
 * Gradient hero header with glow orb, inline re-search,
 * filter tabs, premium card grid, and enhanced no-results state.
 *
 * @package GtaLobby
 */

get_header();

$search_query = get_search_query();
$total_results = $wp_query->found_posts ?? 0;
$current_type  = isset( $_GET['post_type'] ) ? sanitize_key( $_GET['post_type'] ) : '';
?>

<div class="gl-archive gl-archive--search">

    <!-- ============================================================
         Search Hero Header
         ============================================================ -->
    <section class="gl-search-hero" data-animate>
        <!-- Decorative glow -->
        <div class="gl-search-hero__orb" aria-hidden="true"></div>

        <div class="gl-container">
            <div class="gl-search-hero__inner">

                <?php if ( $search_query ) : ?>
                    <p class="gl-search-hero__label">
                        <?php gtalobby_icon( 'search', 16 ); ?>
                        <?php esc_html_e( 'Search Results', 'gtalobby' ); ?>
                    </p>

                    <h1 class="gl-search-hero__title">
                        <?php echo esc_html( $search_query ); ?>
                    </h1>

                    <?php if ( have_posts() ) : ?>
                    <p class="gl-search-hero__count">
                        <strong><?php echo esc_html( number_format_i18n( $total_results ) ); ?></strong>
                        <?php echo esc_html( _n( 'result found', 'results found', $total_results, 'gtalobby' ) ); ?>
                    </p>
                    <?php endif; ?>
                <?php else : ?>
                    <h1 class="gl-search-hero__title">
                        <?php esc_html_e( 'Search', 'gtalobby' ); ?>
                    </h1>
                    <p class="gl-search-hero__desc">
                        <?php esc_html_e( 'Enter a keyword to find guides, news, and more.', 'gtalobby' ); ?>
                    </p>
                <?php endif; ?>

                <!-- Inline re-search form -->
                <div class="gl-search-hero__form" data-animate>
                    <?php get_search_form(); ?>
                </div>

            </div>
        </div>

        <!-- Bottom accent strip -->
        <div class="gl-search-hero__strip" aria-hidden="true"></div>
    </section>

    <!-- ============================================================
         Filter Tabs
         ============================================================ -->
    <?php if ( have_posts() && $search_query ) : ?>
    <div class="gl-search-filters" data-animate>
        <div class="gl-container">
            <div class="gl-search-filters__bar">
                <a href="<?php echo esc_url( get_search_link( $search_query ) ); ?>"
                   class="gl-search-filter <?php echo empty( $current_type ) ? 'gl-search-filter--active' : ''; ?>">
                    <?php esc_html_e( 'All', 'gtalobby' ); ?>
                </a>

                <?php
                $post_types = array_merge( array( 'post' => 'post' ), gtalobby_get_post_types() );
                foreach ( $post_types as $pt_slug => $pt_val ) :
                    $pt_obj = get_post_type_object( is_string( $pt_val ) ? $pt_val : $pt_slug );
                    if ( ! $pt_obj ) continue;

                    $type_count = new WP_Query( array(
                        's'              => $search_query,
                        'post_type'      => $pt_slug,
                        'posts_per_page' => 1,
                        'fields'         => 'ids',
                        'no_found_rows'  => false,
                    ) );
                    if ( $type_count->found_posts < 1 ) {
                        wp_reset_postdata();
                        continue;
                    }
                    wp_reset_postdata();
                ?>
                <a href="<?php echo esc_url( add_query_arg( 'post_type', $pt_slug, get_search_link( $search_query ) ) ); ?>"
                   class="gl-search-filter <?php echo ( $current_type === $pt_slug ) ? 'gl-search-filter--active' : ''; ?>">
                    <?php echo esc_html( $pt_obj->labels->name ); ?>
                    <span class="gl-search-filter__count"><?php echo esc_html( $type_count->found_posts ); ?></span>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- ============================================================
         Search Results Grid
         ============================================================ -->
    <div class="gl-container gl-archive__layout" data-animate>

        <main class="gl-archive__main" id="main-content">
            <?php if ( have_posts() ) : ?>

            <div class="gl-card-grid gl-card-grid--2col" data-animate>
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

            <!-- Enhanced No Results -->
            <div class="gl-search-empty" data-animate>
                <div class="gl-search-empty__icon" aria-hidden="true">
                    <?php gtalobby_icon( 'search', 48 ); ?>
                </div>

                <h2 class="gl-search-empty__title">
                    <?php esc_html_e( 'No Results Found', 'gtalobby' ); ?>
                </h2>

                <p class="gl-search-empty__desc">
                    <?php if ( $search_query ) : ?>
                        <?php printf( esc_html__( 'We couldn\'t find anything matching "%s". Try different keywords or browse our categories.', 'gtalobby' ), '<strong>' . esc_html( $search_query ) . '</strong>' ); ?>
                    <?php else : ?>
                        <?php esc_html_e( 'Enter a search term above to find content across the site.', 'gtalobby' ); ?>
                    <?php endif; ?>
                </p>

                <!-- Suggestions -->
                <div class="gl-search-empty__tips">
                    <h3><?php esc_html_e( 'Search Tips', 'gtalobby' ); ?></h3>
                    <ul>
                        <li><?php esc_html_e( 'Check your spelling and try again', 'gtalobby' ); ?></li>
                        <li><?php esc_html_e( 'Use fewer or more general keywords', 'gtalobby' ); ?></li>
                        <li><?php esc_html_e( 'Try browsing our categories below', 'gtalobby' ); ?></li>
                    </ul>
                </div>

                <!-- Category pills -->
                <div class="gl-search-empty__cats">
                    <h3><?php esc_html_e( 'Browse Categories', 'gtalobby' ); ?></h3>
                    <div class="gl-search-empty__pills">
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
                            <span class="gl-404-pill__icon"><?php gtalobby_icon( $icon, 16 ); ?></span>
                            <span class="gl-404-pill__name"><?php echo esc_html( $cat_obj->name ); ?></span>
                        </a>
                        <?php endforeach; ?>
                    </div>
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
