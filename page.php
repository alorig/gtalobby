<?php
/**
 * Standard Page Template
 *
 * @package GtaLobby
 */

get_header();
?>

<div class="gl-page">

    <div class="gl-zone gl-zone--breadcrumb">
        <div class="gl-container">
            <?php gtalobby_breadcrumbs(); ?>
        </div>
    </div>

    <div class="gl-container gl-page__layout">

        <main class="gl-page__main" id="main-content">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                <article id="page-<?php the_ID(); ?>" <?php post_class( 'gl-article gl-article--page' ); ?>>

                    <header class="gl-article__header">
                        <h1 class="gl-article__title"><?php the_title(); ?></h1>
                    </header>

                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="gl-article__hero">
                        <?php the_post_thumbnail( 'gl-hero', array( 'class' => 'gl-article__hero-img' ) ); ?>
                    </div>
                    <?php endif; ?>

                    <div class="gl-article__content gl-typography">
                        <?php the_content(); ?>
                    </div>

                    <?php
                    wp_link_pages( array(
                        'before' => '<nav class="gl-page-links"><span class="gl-page-links__label">' . esc_html__( 'Pages:', 'gtalobby' ) . '</span>',
                        'after'  => '</nav>',
                    ) );
                    ?>

                </article>

                <?php
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
                ?>

            <?php endwhile; endif; ?>
        </main>

        <?php if ( is_active_sidebar( 'sidebar-primary' ) ) : ?>
        <aside class="gl-page__sidebar" role="complementary">
            <?php get_sidebar(); ?>
        </aside>
        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>
