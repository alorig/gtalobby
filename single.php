<?php
/**
 * Generic Single Post Template
 *
 * Falls back for any post type without a dedicated single-{post_type}.php.
 * Zones rendered in admin-defined order via the Layout Engine.
 *
 * @package GtaLobby
 */

get_header();

$category_slug = gtalobby_get_current_category_slug();
$single_zones  = gtalobby_get_layout( 'single', $category_slug );

// Split zones: main-content (inside article), post-article
$article_zones = array( 'post_header', 'featured_image', 'quick_answer_box', 'post_type_fields', 'gta6_confidence', 'toc', 'body_content', 'video_embed', 'ranked_items', 'data_table', 'stats_table', 'gallery', 'install_steps', 'download_box', 'weekly_bonuses', 'related_questions' );
$footer_zones  = array( 'hub_link', 'social_share' );
$post_zones    = array( 'author_box', 'related_posts', 'post_navigation', 'comments' );

$sorted_article = $sorted_post = array();
foreach ( $single_zones as $zone_id => $zone_cfg ) {
    if ( in_array( $zone_id, $article_zones, true ) ) {
        $sorted_article[ $zone_id ] = $zone_cfg;
    } elseif ( in_array( $zone_id, $post_zones, true ) ) {
        $sorted_post[ $zone_id ] = $zone_cfg;
    }
}
?>

<div class="gl-single">
    <div class="gl-container gl-single__layout">

        <main class="gl-single__main" id="main-content">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class( 'gl-article' ); ?>>

                <?php
                /* --------------------------------------------------------
                   Article Zones — rendered in admin-defined order
                   -------------------------------------------------------- */
                foreach ( $sorted_article as $zone_id => $zone_cfg ) :
                    if ( ! gtalobby_is_zone_enabled( 'single', $zone_id, $category_slug ) ) {
                        continue;
                    }

                    switch ( $zone_id ) :

                        /* -- Post Header -------------------------------- */
                        case 'post_header':
                        ?>
                        <header class="gl-article__header" data-zone="post_header" data-animate>
                            <div class="gl-article__header-glow" aria-hidden="true"></div>
                            <?php gtalobby_post_type_badge(); ?>
                            <?php gtalobby_category_badge(); ?>

                            <h1 class="gl-article__title"><?php the_title(); ?></h1>

                            <?php gtalobby_post_meta(); ?>

                            <?php if ( gtalobby_is_gta6_content() ) : ?>
                                <?php gtalobby_confidence_badge(); ?>
                            <?php endif; ?>
                        </header>
                        <?php
                            break;

                        /* -- Featured Image ----------------------------- */
                        case 'featured_image':
                            if ( has_post_thumbnail() ) :
                        ?>
                        <div class="gl-article__hero" data-zone="featured_image" data-animate>
                            <?php the_post_thumbnail( 'gl-hero', array( 'class' => 'gl-article__hero-img' ) ); ?>
                        </div>
                        <div class="gl-article__accent-divider" aria-hidden="true"></div>
                        <?php
                            endif;
                            break;

                        /* -- Table of Contents -------------------------- */
                        case 'toc':
                            $toc = gtalobby_generate_toc( get_the_content() );
                            if ( $toc ) :
                        ?>
                        <div class="gl-article__toc" data-zone="toc" data-animate>
                            <?php echo $toc; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        </div>
                        <?php
                            endif;
                            break;

                        /* -- Body Content ------------------------------- */
                        case 'body_content':
                            gtalobby_render_ad_slot( 'ad_before_content' );
                        ?>
                        <div class="gl-article__content gl-typography" data-zone="body_content" data-animate>
                            <?php the_content(); ?>
                        </div>
                        <?php
                            gtalobby_render_ad_slot( 'ad_after_content' );
                            break;

                        /* -- Post-type-specific zones ------------------- */
                        case 'quick_answer_box':
                        case 'post_type_fields':
                        case 'gta6_confidence':
                        case 'video_embed':
                        case 'ranked_items':
                        case 'data_table':
                        case 'stats_table':
                        case 'gallery':
                        case 'install_steps':
                        case 'download_box':
                        case 'weekly_bonuses':
                        case 'related_questions':
                            // These zones are handled by dedicated single-{post_type}.php templates.
                            // The generic single.php renders the core zones only.
                            break;

                    endswitch;
                endforeach;
                ?>

                <?php
                /* --------------------------------------------------------
                   Article Footer — taxonomy tags, hub link, social share
                   -------------------------------------------------------- */
                $has_footer = false;
                foreach ( $footer_zones as $fz ) {
                    if ( gtalobby_is_zone_enabled( 'single', $fz, $category_slug ) ) {
                        $has_footer = true;
                        break;
                    }
                }

                if ( $has_footer ) :
                ?>
                <footer class="gl-article__footer" data-animate>
                    <?php gtalobby_taxonomy_tags(); ?>

                    <?php if ( gtalobby_is_zone_enabled( 'single', 'hub_link', $category_slug ) ) : ?>
                        <?php gtalobby_hub_link(); ?>
                    <?php endif; ?>

                    <?php if ( gtalobby_is_zone_enabled( 'single', 'social_share', $category_slug ) ) : ?>
                        <?php gtalobby_social_share(); ?>
                    <?php endif; ?>
                </footer>
                <?php endif; ?>

            </article>

            <?php
            /* --------------------------------------------------------
               Post-Article Zones — author, related, nav, comments
               -------------------------------------------------------- */
            foreach ( $sorted_post as $zone_id => $zone_cfg ) :
                if ( ! gtalobby_is_zone_enabled( 'single', $zone_id, $category_slug ) ) {
                    continue;
                }

                switch ( $zone_id ) :
                    case 'author_box':
                        gtalobby_author_box();
                        break;

                    case 'related_posts':
                        gtalobby_related_posts();
                        break;

                    case 'post_navigation':
                        if ( function_exists( 'gtalobby_post_navigation' ) ) {
                            gtalobby_post_navigation();
                        }
                        break;

                    case 'comments':
                        if ( comments_open() || get_comments_number() ) {
                            comments_template();
                        }
                        break;
                endswitch;
            endforeach;
            ?>

        <?php endwhile; endif; ?>
        </main>

        <aside class="gl-single__sidebar" role="complementary">
            <?php get_sidebar(); ?>
        </aside>

    </div>
</div>

<?php get_footer(); ?>
