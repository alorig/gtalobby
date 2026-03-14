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

    <?php if ( gtalobby_is_zone_enabled( 'single', 'breadcrumb' ) ) : ?>
    <div class="gl-zone gl-zone--breadcrumb">
        <div class="gl-container">
            <?php gtalobby_breadcrumbs(); ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="gl-container gl-single__layout">

        <main class="gl-single__main" id="main-content">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class( 'gl-article' ); ?>>

                    <?php if ( gtalobby_is_zone_enabled( 'single', 'post_header' ) ) : ?>
                    <header class="gl-article__header">
                        <?php gtalobby_post_type_badge(); ?>
                        <?php gtalobby_category_badge(); ?>

                        <h1 class="gl-article__title"><?php the_title(); ?></h1>

                        <?php gtalobby_post_meta(); ?>

                        <?php if ( gtalobby_is_gta6_content() ) : ?>
                            <?php gtalobby_confidence_badge(); ?>
                        <?php endif; ?>
                    </header>
                    <?php endif; ?>

                    <?php if ( gtalobby_is_zone_enabled( 'single', 'featured_image' ) && has_post_thumbnail() ) : ?>
                    <div class="gl-article__hero">
                        <?php the_post_thumbnail( 'gl-hero', array( 'class' => 'gl-article__hero-img' ) ); ?>
                    </div>
                    <?php endif; ?>

                    <?php gtalobby_render_ad_slot( 'ad_before_content' ); ?>

                    <?php
                    $toc = gtalobby_generate_toc( get_the_content() );
                    if ( gtalobby_is_zone_enabled( 'single', 'toc' ) && $toc ) :
                    ?>
                    <div class="gl-article__toc">
                        <?php echo $toc; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    </div>
                    <?php endif; ?>

                    <?php if ( gtalobby_is_zone_enabled( 'single', 'body_content' ) ) : ?>
                    <div class="gl-article__content gl-typography">
                        <?php the_content(); ?>
                    </div>
                    <?php endif; ?>

                    <?php gtalobby_render_ad_slot( 'ad_after_content' ); ?>

                    <?php if ( gtalobby_is_zone_enabled( 'single', 'hub_link' ) || gtalobby_is_zone_enabled( 'single', 'related_posts' ) || gtalobby_is_zone_enabled( 'single', 'social_share' ) ) : ?>
                    <footer class="gl-article__footer">
                        <?php gtalobby_taxonomy_tags(); ?>
                        <?php if ( gtalobby_is_zone_enabled( 'single', 'hub_link' ) ) : ?><?php gtalobby_hub_link(); ?><?php endif; ?>
                        <?php if ( gtalobby_is_zone_enabled( 'single', 'social_share' ) ) : ?><?php gtalobby_social_share(); ?><?php endif; ?>
                    </footer>
                    <?php endif; ?>

                </article>

                <?php if ( gtalobby_is_zone_enabled( 'single', 'author_box' ) ) : ?><?php gtalobby_author_box(); ?><?php endif; ?>
                <?php if ( gtalobby_is_zone_enabled( 'single', 'related_posts' ) ) : ?><?php gtalobby_related_posts(); ?><?php endif; ?>
                <?php if ( gtalobby_is_zone_enabled( 'single', 'post_navigation' ) ) : ?><?php gtalobby_post_navigation(); ?><?php endif; ?>

                <?php
                if ( gtalobby_is_zone_enabled( 'single', 'comments' ) && ( comments_open() || get_comments_number() ) ) :
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
