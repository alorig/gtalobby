<?php
/**
 * Index Template — WordPress Fallback
 *
 * This is the ultimate fallback template. It displays a standard
 * blog/archive listing. All other contexts should use their
 * dedicated templates (archive.php, single.php, page.php, etc.)
 *
 * @package GtaLobby
 */

get_header();
?>

<?php
$category_slug = '';
?>

<div class="gl-archive gl-archive--index">

    <!-- Archive Hero Header -->
    <section class="gl-arc-hero" data-animate>
        <div class="gl-arc-hero__orb" aria-hidden="true"></div>
        <div class="gl-container">
            <div class="gl-arc-hero__inner">
                <div class="gl-arc-hero__badge">
                    <span class="gl-arc-hero__badge-icon">
                        <?php gtalobby_icon( 'grid', 24 ); ?>
                    </span>
                    <span class="gl-arc-hero__badge-label">
                        <?php esc_html_e( 'Blog', 'gtalobby' ); ?>
                    </span>
                </div>

                <h1 class="gl-arc-hero__title" data-animate>
                    <?php
                    if ( is_home() && ! is_front_page() ) {
                        single_post_title();
                    } else {
                        esc_html_e( 'Latest Articles', 'gtalobby' );
                    }
                    ?>
                </h1>

                <p class="gl-arc-hero__desc" data-animate>
                    <?php esc_html_e( 'Guides, news, rankings, and everything GTA — all in one place.', 'gtalobby' ); ?>
                </p>
            </div>
        </div>
        <div class="gl-arc-hero__strip" aria-hidden="true"></div>
    </section>

    <!-- Post Grid -->
    <div class="gl-container gl-archive__layout">
        <main class="gl-archive__main" id="main-content">
            <?php if ( have_posts() ) : ?>
            <div class="gl-card-grid gl-card-grid--3col" data-animate>
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
            <div class="gl-no-results" data-animate>
                <h2><?php esc_html_e( 'Nothing Found', 'gtalobby' ); ?></h2>
                <p><?php esc_html_e( 'No content matched your criteria. Try a different search.', 'gtalobby' ); ?></p>
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
