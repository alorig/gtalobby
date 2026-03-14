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

<div class="gl-archive gl-archive--index">

    <div class="gl-container gl-archive__layout">

        <main class="gl-archive__main" id="main-content">

            <?php if ( is_home() && ! is_front_page() ) : ?>
            <header class="gl-archive-header">
                <div class="gl-container">
                    <h1 class="gl-archive-header__title"><?php single_post_title(); ?></h1>
                </div>
            </header>
            <?php endif; ?>

            <?php if ( have_posts() ) : ?>
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

            <?php gtalobby_pagination(); ?>
            <?php else : ?>

            <div class="gl-no-results">
                <h2><?php esc_html_e( 'Nothing Found', 'gtalobby' ); ?></h2>
                <p><?php esc_html_e( 'No posts to display. Check back soon!', 'gtalobby' ); ?></p>
            </div>
            <?php endif; ?>

        </main>

        <aside class="gl-archive__sidebar" role="complementary">
            <?php get_sidebar(); ?>
        </aside>

    </div>
</div>

<?php get_footer(); ?>
