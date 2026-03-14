<?php
/**
 * Category Archive Template
 *
 * Displays a SAG sector/category page with hub links,
 * category accent colors, and filterable content grid.
 * Zones rendered in admin-defined order via the Layout Engine.
 *
 * @package GtaLobby
 */

get_header();

$category       = get_queried_object();
$category_slug  = $category->slug ?? '';
$category_color = gtalobby_get_category_color( $category_slug );
$archive_zones  = gtalobby_get_layout( 'archive', $category_slug );
?>

<div class="gl-archive gl-archive--category gl-category-<?php echo esc_attr( $category_slug ); ?>" style="--cat-accent: <?php echo esc_attr( $category_color ); ?>">

    <?php
    /* ================================================================
       Archive Zones — rendered in admin-defined order
       ================================================================ */
    foreach ( $archive_zones as $zone_id => $zone_cfg ) :
        if ( ! gtalobby_is_zone_enabled( 'archive', $zone_id, $category_slug ) ) {
            continue;
        }

        switch ( $zone_id ) :

            /* -- Breadcrumb (rendered inside archive_header) -------- */
            case 'breadcrumb':
                break;

            /* -- Archive Header ------------------------------------- */
            case 'archive_header':
            ?>
            <section class="gl-zone gl-zone--archive-header gl-category-header" data-zone="archive_header">
                <div class="gl-container">
                    <?php if ( gtalobby_is_zone_enabled( 'archive', 'breadcrumb', $category_slug ) ) : ?>
                        <div class="gl-category-header__breadcrumb"><?php gtalobby_breadcrumbs(); ?></div>
                    <?php endif; ?>

                    <div class="gl-category-header__content">
                        <?php gtalobby_category_badge(); ?>

                        <h1 class="gl-category-header__title"><?php single_cat_title(); ?></h1>

                        <?php if ( category_description() ) : ?>
                            <div class="gl-category-header__desc"><?php echo wp_kses_post( category_description() ); ?></div>
                        <?php endif; ?>

                        <div class="gl-category-header__stats">
                            <span class="gl-category-header__count">
                                <?php printf( esc_html( _n( '%s article', '%s articles', $category->count, 'gtalobby' ) ), number_format_i18n( $category->count ) ); ?>
                            </span>
                        </div>
                    </div>
                </div>
            </section>
            <?php
                break;

            /* -- Pinned Hubs ---------------------------------------- */
            case 'pinned_hubs':
                $hub_pages = get_pages( array(
                    'meta_key'    => 'hub_sector',
                    'meta_value'  => $category_slug,
                    'sort_order'  => 'ASC',
                    'sort_column' => 'menu_order,post_title',
                ) );

                if ( empty( $hub_pages ) ) {
                    $hub_pages = get_pages( array(
                        'meta_key'   => '_wp_page_template',
                        'meta_value' => 'page-hub.php',
                    ) );
                    $hub_pages = array_filter( $hub_pages, function( $page ) use ( $category_slug ) {
                        return get_post_meta( $page->ID, 'hub_sector', true ) === $category_slug;
                    } );
                }

                if ( ! empty( $hub_pages ) ) :
            ?>
            <section class="gl-zone gl-zone--pinned-hubs" data-zone="pinned_hubs">
                <div class="gl-container">
                    <h2 class="gl-zone__title"><?php esc_html_e( 'Topic Hubs', 'gtalobby' ); ?></h2>

                    <div class="gl-card-grid gl-card-grid--3col">
                        <?php foreach ( $hub_pages as $hub ) : ?>
                        <a href="<?php echo esc_url( get_permalink( $hub->ID ) ); ?>"
                           class="gl-hub-card"
                           style="--cat-accent: <?php echo esc_attr( $category_color ); ?>">

                            <?php if ( has_post_thumbnail( $hub->ID ) ) : ?>
                            <div class="gl-hub-card__thumb">
                                <?php echo get_the_post_thumbnail( $hub->ID, 'gl-card-square', array( 'class' => 'gl-hub-card__img' ) ); ?>
                            </div>
                            <?php endif; ?>

                            <div class="gl-hub-card__body">
                                <h3 class="gl-hub-card__title"><?php echo esc_html( $hub->post_title ); ?></h3>
                                <?php
                                $cluster = get_post_meta( $hub->ID, 'hub_cluster_name', true );
                                if ( $cluster ) :
                                ?>
                                <span class="gl-hub-card__cluster"><?php echo esc_html( $cluster ); ?></span>
                                <?php endif; ?>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <?php
                endif;
                break;

            /* -- Filter Bar ----------------------------------------- */
            case 'filter_bar':
            ?>
            <div class="gl-zone gl-zone--filter-bar" data-zone="filter_bar">
                <div class="gl-container">
                    <div class="gl-archive-filters">
                        <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>"
                           class="gl-hub-filter gl-hub-filter--active">
                            <?php esc_html_e( 'All', 'gtalobby' ); ?>
                        </a>

                        <?php foreach ( gtalobby_get_post_types() as $pt_slug ) :
                            $pt_obj = get_post_type_object( $pt_slug );
                            if ( ! $pt_obj ) continue;
                        ?>
                        <a href="<?php echo esc_url( add_query_arg( 'post_type', $pt_slug, get_category_link( $category->term_id ) ) ); ?>"
                           class="gl-hub-filter">
                            <?php echo esc_html( $pt_obj->labels->name ); ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php
                break;

            /* -- Post Grid + Sidebar -------------------------------- */
            case 'post_grid':
                gtalobby_render_ad_slot( 'ad_before_content' );
                $cols = isset( $zone_cfg['columns'] ) ? (int) $zone_cfg['columns'] : 3;
            ?>
            <div class="gl-container gl-archive__layout" data-zone="post_grid">
                <main class="gl-archive__main" id="main-content">

                    <?php if ( have_posts() ) : ?>
                    <div class="gl-card-grid gl-card-grid--<?php echo esc_attr( $cols ); ?>col">
                        <?php
                        while ( have_posts() ) :
                            the_post();
                            echo '<div class="gl-card-grid__item" data-post-type="' . esc_attr( get_post_type() ) . '">';
                            gtalobby_card( 'standard' );
                            echo '</div>';
                        endwhile;
                        ?>
                    </div>

                    <?php if ( gtalobby_is_zone_enabled( 'archive', 'pagination', $category_slug ) ) : ?>
                        <?php gtalobby_pagination(); ?>
                    <?php endif; ?>

                    <?php else : ?>
                    <div class="gl-no-results">
                        <h2><?php esc_html_e( 'No Articles Yet', 'gtalobby' ); ?></h2>
                        <p><?php printf( esc_html__( 'Content for %s is coming soon. Check back later!', 'gtalobby' ), esc_html( single_cat_title( '', false ) ) ); ?></p>
                    </div>
                    <?php endif; ?>

                </main>

                <aside class="gl-archive__sidebar" role="complementary">
                    <?php get_sidebar(); ?>
                </aside>
            </div>
            <?php
                break;

            /* -- Pagination (handled inside post_grid) -------------- */
            case 'pagination':
                break;

        endswitch;
    endforeach;
    ?>

</div>

<?php get_footer(); ?>
