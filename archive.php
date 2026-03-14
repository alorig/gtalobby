<?php
/**
 * Generic Archive Template
 *
 * Used for post type archives and any taxonomy archives
 * without a dedicated template file.
 *
 * @package GtaLobby
 */

get_header();
$category_slug = gtalobby_get_current_category_slug();
?>

<div class="gl-archive">

    <?php if ( gtalobby_is_zone_enabled( 'archive', 'breadcrumb' ) ) : ?>
    <div class="gl-zone gl-zone--breadcrumb">
        <div class="gl-container">
            <?php gtalobby_breadcrumbs(); ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if ( gtalobby_is_zone_enabled( 'archive', 'archive_header' ) ) : ?>
    <section class="gl-zone gl-zone--archive-header gl-archive-header">
        <div class="gl-container">
            <?php if ( is_post_type_archive() ) : ?>
                <?php $pt = get_queried_object(); ?>
                <h1 class="gl-archive-header__title"><?php post_type_archive_title(); ?></h1>
                <?php if ( ! empty( $pt->description ) ) : ?>
                    <p class="gl-archive-header__desc"><?php echo esc_html( $pt->description ); ?></p>
                <?php endif; ?>
            <?php elseif ( is_tax() ) : ?>
                <h1 class="gl-archive-header__title"><?php single_term_title(); ?></h1>
                <?php if ( term_description() ) : ?>
                    <div class="gl-archive-header__desc"><?php echo wp_kses_post( term_description() ); ?></div>
                <?php endif; ?>
            <?php elseif ( is_tag() ) : ?>
                <h1 class="gl-archive-header__title"><?php single_tag_title(); ?></h1>
                <?php if ( tag_description() ) : ?>
                    <div class="gl-archive-header__desc"><?php echo wp_kses_post( tag_description() ); ?></div>
                <?php endif; ?>
            <?php elseif ( is_author() ) : ?>
                <h1 class="gl-archive-header__title"><?php printf( esc_html__( 'Posts by %s', 'gtalobby' ), get_the_author() ); ?></h1>
                <?php if ( get_the_author_meta( 'description' ) ) : ?>
                    <p class="gl-archive-header__desc"><?php echo esc_html( get_the_author_meta( 'description' ) ); ?></p>
                <?php endif; ?>
            <?php elseif ( is_date() ) : ?>
                <h1 class="gl-archive-header__title">
                    <?php
                    if ( is_day() ) {
                        printf( esc_html__( 'Archives: %s', 'gtalobby' ), get_the_date() );
                    } elseif ( is_month() ) {
                        printf( esc_html__( 'Archives: %s', 'gtalobby' ), get_the_date( 'F Y' ) );
                    } elseif ( is_year() ) {
                        printf( esc_html__( 'Archives: %s', 'gtalobby' ), get_the_date( 'Y' ) );
                    }
                    ?>
                </h1>
            <?php else : ?>
                <h1 class="gl-archive-header__title"><?php esc_html_e( 'Archives', 'gtalobby' ); ?></h1>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <?php gtalobby_render_ad_slot( 'ad_before_content' ); ?>

    <div class="gl-container gl-archive__layout">

        <main class="gl-archive__main" id="main-content">
            <?php if ( have_posts() ) : ?>

            <?php if ( gtalobby_is_zone_enabled( 'archive', 'post_grid' ) ) : ?>
            <div class="gl-card-grid gl-card-grid--3col">
                <?php
                while ( have_posts() ) :
                    the_post();
                    echo '<div class="gl-card-grid__item">';
                    gtalobby_card( 'standard' );
                    echo '</div>';
                endwhile;
                ?>
            </div>
            <?php endif; ?>

            <?php if ( gtalobby_is_zone_enabled( 'archive', 'pagination' ) ) : ?>
                <?php gtalobby_pagination(); ?>
            <?php endif; ?>

            <?php else : ?>

            <div class="gl-no-results">
                <h2><?php esc_html_e( 'Nothing Found', 'gtalobby' ); ?></h2>
                <p><?php esc_html_e( 'No content matched your criteria. Try a different search or browse our categories.', 'gtalobby' ); ?></p>
                <?php get_search_form(); ?>
            </div>

            <?php endif; ?>
        </main>

        <aside class="gl-archive__sidebar" role="complementary">
            <?php get_sidebar(); ?>
        </aside>

    </div>
</div>

<?php get_footer(); ?>
