<?php
/**
 * Generic Single Post Template
 *
 * Falls back for any post type without a dedicated single-{post_type}.php.
 * Provides the standard single-post layout with sidebar.
 *
 * @package GtaLobby
 */

get_header();
?>

<div class="gl-single">

    <div class="gl-zone gl-zone--breadcrumb">
        <div class="gl-container">
            <?php gtalobby_breadcrumbs(); ?>
        </div>
    </div>

    <div class="gl-container gl-single__layout">

        <main class="gl-single__main" id="main-content">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class( 'gl-article' ); ?>>

                    <header class="gl-article__header">
                        <?php gtalobby_post_type_badge(); ?>
                        <?php gtalobby_category_badge(); ?>

                        <h1 class="gl-article__title"><?php the_title(); ?></h1>

                        <?php gtalobby_post_meta(); ?>

                        <?php if ( gtalobby_is_gta6_content() ) : ?>
                            <?php gtalobby_confidence_badge(); ?>
                        <?php endif; ?>
                    </header>

                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="gl-article__hero">
                        <?php the_post_thumbnail( 'gl-hero', array( 'class' => 'gl-article__hero-img' ) ); ?>
                    </div>
                    <?php endif; ?>

                    <?php gtalobby_render_ad_slot( 'ad_before_content' ); ?>

                    <?php
                    $toc = gtalobby_generate_toc( get_the_content() );
                    if ( $toc ) :
                    ?>
                    <div class="gl-article__toc">
                        <?php echo $toc; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    </div>
                    <?php endif; ?>

                    <div class="gl-article__content gl-typography">
                        <?php the_content(); ?>
                    </div>

                    <?php gtalobby_render_ad_slot( 'ad_after_content' ); ?>

                    <footer class="gl-article__footer">
                        <?php gtalobby_taxonomy_tags(); ?>
                        <?php gtalobby_hub_link(); ?>
                        <?php gtalobby_social_share(); ?>
                    </footer>

                </article>

                <?php gtalobby_author_box(); ?>
                <?php gtalobby_related_posts(); ?>
                <?php gtalobby_post_navigation(); ?>

                <?php
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
                ?>

            <?php endwhile; endif; ?>
        </main>

        <aside class="gl-single__sidebar" role="complementary">
            <?php get_sidebar(); ?>
        </aside>

    </div>
</div>

<?php get_footer(); ?>
