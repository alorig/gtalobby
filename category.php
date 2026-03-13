<?php
/**
 * Category Archive Template
 *
 * Displays a SAG sector/category page with hub links,
 * category accent colors, and filterable content grid.
 *
 * @package GtaLobby
 */

get_header();

$category       = get_queried_object();
$category_slug  = $category->slug ?? '';
$category_color = gtalobby_get_category_color( $category_slug );
?>

<div class="gl-archive gl-archive--category gl-category-<?php echo esc_attr( $category_slug ); ?>">

    <div class="gl-zone gl-zone--breadcrumb">
        <div class="gl-container">
            <?php gtalobby_breadcrumbs(); ?>
        </div>
    </div>

    <?php /* --- CATEGORY HERO HEADER --- */ ?>
    <section class="gl-zone gl-zone--archive-header gl-category-header" style="--cat-accent: <?php echo esc_attr( $category_color ); ?>">
        <div class="gl-container">
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

    <?php /* --- HUB PAGES FOR THIS CATEGORY --- */ ?>
    <?php
    $hub_pages = get_pages( array(
        'meta_key'   => 'hub_sector',
        'meta_value' => $category_slug,
        'sort_order' => 'ASC',
        'sort_column' => 'menu_order,post_title',
    ) );
    // Also check pages with Hub Page template that reference this category
    if ( empty( $hub_pages ) ) {
        $hub_pages = get_pages( array(
            'meta_key'   => '_wp_page_template',
            'meta_value' => 'page-hub.php',
        ) );
        // Filter to those matching this category sector
        $hub_pages = array_filter( $hub_pages, function( $page ) use ( $category_slug ) {
            $sector = get_post_meta( $page->ID, 'hub_sector', true );
            return $sector === $category_slug;
        } );
    }

    if ( ! empty( $hub_pages ) ) :
    ?>
    <section class="gl-zone gl-zone--hub-links">
        <div class="gl-container">
            <h2 class="gl-zone__title"><?php esc_html_e( 'Topic Hubs', 'gtalobby' ); ?></h2>
            <div class="gl-hub-grid">
                <?php foreach ( $hub_pages as $hub ) : ?>
                <a href="<?php echo esc_url( get_permalink( $hub->ID ) ); ?>" class="gl-hub-card">
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
    <?php endif; ?>

    <?php gtalobby_render_ad_slot( 'ad_before_content' ); ?>

    <?php /* --- POST TYPE FILTER TABS --- */ ?>
    <div class="gl-container gl-archive__layout">

        <main class="gl-archive__main" id="main-content">

            <div class="gl-archive-filters">
                <button class="gl-hub-filter gl-hub-filter--active" data-filter="all"><?php esc_html_e( 'All', 'gtalobby' ); ?></button>
                <?php
                $cat_post_types = array();
                if ( have_posts() ) :
                    global $wp_query;
                    foreach ( $wp_query->posts as $p ) {
                        $cat_post_types[ $p->post_type ] = true;
                    }
                    foreach ( array_keys( $cat_post_types ) as $pt ) :
                        $pt_obj = get_post_type_object( $pt );
                        if ( $pt_obj ) :
                ?>
                    <button class="gl-hub-filter" data-filter="<?php echo esc_attr( $pt ); ?>"><?php echo esc_html( $pt_obj->labels->name ); ?></button>
                <?php
                        endif;
                    endforeach;
                endif;
                ?>
            </div>

            <?php if ( have_posts() ) : ?>

            <div class="gl-card-grid gl-card-grid--3col">
                <?php
                while ( have_posts() ) :
                    the_post();
                    echo '<div class="gl-card-grid__item" data-post-type="' . esc_attr( get_post_type() ) . '">';
                    gtalobby_card( 'standard' );
                    echo '</div>';
                endwhile;
                ?>
            </div>

            <?php gtalobby_pagination(); ?>

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
</div>

<?php get_footer(); ?>
