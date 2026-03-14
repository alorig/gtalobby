<?php
/**
 * Single Guide Template
 *
 * Displays a guide with difficulty rating, estimated time,
 * step count, tools needed, and optional video embed.
 * Zones rendered in admin-defined order via the Layout Engine.
 *
 * @package GtaLobby
 */

get_header();

$category_slug = gtalobby_get_current_category_slug();
$single_zones  = gtalobby_get_layout( 'single', $category_slug );

$article_zones = array( 'post_header', 'featured_image', 'gta6_confidence', 'post_type_fields', 'video_embed', 'toc', 'body_content' );
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

<div class="gl-single gl-single--guide">
    <div class="gl-container gl-single__layout">

        <main class="gl-single__main" id="main-content">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class( 'gl-article gl-article--guide' ); ?>>

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
                        <header class="gl-article__header" data-zone="post_header">
                            <?php if ( gtalobby_is_zone_enabled( 'single', 'breadcrumb', $category_slug ) ) : ?>
                                <div class="gl-article__breadcrumb"><?php gtalobby_breadcrumbs(); ?></div>
                            <?php endif; ?>

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
                        <div class="gl-article__hero" data-zone="featured_image">
                            <?php the_post_thumbnail( 'gl-hero', array( 'class' => 'gl-article__hero-img' ) ); ?>
                        </div>
                        <?php
                            endif;
                            break;

                        /* -- Guide Meta (difficulty, time, steps, tools) */
                        case 'post_type_fields':
                            $difficulty    = get_post_meta( get_the_ID(), 'guide_difficulty_rating', true );
                            $time_complete = get_post_meta( get_the_ID(), 'guide_time_to_complete', true );
                            $step_count    = get_post_meta( get_the_ID(), 'guide_step_count', true );
                            $tools_needed  = get_post_meta( get_the_ID(), 'guide_tools_needed', true );

                            if ( $difficulty || $time_complete || $step_count || $tools_needed ) :
                        ?>
                        <div class="gl-guide-meta" data-zone="post_type_fields">
                            <h2 class="gl-sr-only"><?php esc_html_e( 'Guide Overview', 'gtalobby' ); ?></h2>
                            <div class="gl-guide-meta__grid">
                                <?php if ( $difficulty ) : ?>
                                <div class="gl-guide-meta__item">
                                    <span class="gl-guide-meta__label"><?php esc_html_e( 'Difficulty', 'gtalobby' ); ?></span>
                                    <span class="gl-guide-meta__value"><?php gtalobby_difficulty_badge( $difficulty ); ?></span>
                                </div>
                                <?php endif; ?>

                                <?php if ( $time_complete ) : ?>
                                <div class="gl-guide-meta__item">
                                    <span class="gl-guide-meta__label"><?php esc_html_e( 'Time', 'gtalobby' ); ?></span>
                                    <span class="gl-guide-meta__value"><?php echo esc_html( $time_complete ); ?></span>
                                </div>
                                <?php endif; ?>

                                <?php if ( $step_count ) : ?>
                                <div class="gl-guide-meta__item">
                                    <span class="gl-guide-meta__label"><?php esc_html_e( 'Steps', 'gtalobby' ); ?></span>
                                    <span class="gl-guide-meta__value"><?php echo esc_html( $step_count ); ?></span>
                                </div>
                                <?php endif; ?>

                                <?php if ( $tools_needed ) : ?>
                                <div class="gl-guide-meta__item gl-guide-meta__item--full">
                                    <span class="gl-guide-meta__label"><?php esc_html_e( 'Tools Needed', 'gtalobby' ); ?></span>
                                    <span class="gl-guide-meta__value"><?php echo esc_html( $tools_needed ); ?></span>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php
                            endif;
                            break;

                        /* -- Video Embed -------------------------------- */
                        case 'video_embed':
                            $video_embed = get_post_meta( get_the_ID(), 'guide_video_embed', true );
                            if ( $video_embed ) :
                        ?>
                        <div class="gl-video-embed" data-zone="video_embed">
                            <div class="gl-video-embed__wrapper">
                                <?php echo wp_oembed_get( $video_embed ) ?: '<a href="' . esc_url( $video_embed ) . '" target="_blank" rel="noopener">' . esc_html__( 'Watch Video', 'gtalobby' ) . '</a>'; ?>
                            </div>
                        </div>
                        <?php
                            endif;
                            break;

                        /* -- Table of Contents -------------------------- */
                        case 'toc':
                            $toc = gtalobby_generate_toc( get_the_content() );
                            if ( $toc ) :
                        ?>
                        <div class="gl-article__toc" data-zone="toc">
                            <?php echo $toc; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        </div>
                        <?php
                            endif;
                            break;

                        /* -- Body Content ------------------------------- */
                        case 'body_content':
                            gtalobby_render_ad_slot( 'ad_before_content' );
                        ?>
                        <div class="gl-article__content gl-typography" data-zone="body_content">
                            <?php the_content(); ?>
                        </div>
                        <?php
                            gtalobby_render_ad_slot( 'ad_after_content' );
                            break;

                        case 'gta6_confidence':
                            break;

                    endswitch;
                endforeach;
                ?>

                <?php
                /* --------------------------------------------------------
                   Article Footer — tags, platforms, hub link, sharing
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
                <footer class="gl-article__footer">
                    <?php gtalobby_taxonomy_tags(); ?>
                    <?php gtalobby_platform_icons(); ?>

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
