<?php
/**
 * Single Guide Template
 *
 * Displays a guide with difficulty rating, estimated time,
 * step count, tools needed, and optional video embed.
 *
 * @package GtaLobby
 */

get_header();
?>

<div class="gl-single gl-single--guide">

    <div class="gl-zone gl-zone--breadcrumb">
        <div class="gl-container">
            <?php gtalobby_breadcrumbs(); ?>
        </div>
    </div>

    <div class="gl-container gl-single__layout">

        <main class="gl-single__main" id="main-content">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class( 'gl-article gl-article--guide' ); ?>>

                    <header class="gl-article__header">
                        <?php gtalobby_post_type_badge(); ?>
                        <?php gtalobby_category_badge(); ?>
                        <h1 class="gl-article__title"><?php the_title(); ?></h1>
                        <?php gtalobby_post_meta(); ?>
                        <?php if ( gtalobby_is_gta6_content() ) gtalobby_confidence_badge(); ?>
                    </header>

                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="gl-article__hero">
                        <?php the_post_thumbnail( 'gl-hero', array( 'class' => 'gl-article__hero-img' ) ); ?>
                    </div>
                    <?php endif; ?>

                    <?php /* --- GUIDE META CARD --- */ ?>
                    <?php
                    $difficulty    = get_post_meta( get_the_ID(), 'guide_difficulty_rating', true );
                    $time_complete = get_post_meta( get_the_ID(), 'guide_time_to_complete', true );
                    $step_count    = get_post_meta( get_the_ID(), 'guide_step_count', true );
                    $tools_needed  = get_post_meta( get_the_ID(), 'guide_tools_needed', true );
                    $video_embed   = get_post_meta( get_the_ID(), 'guide_video_embed', true );

                    if ( $difficulty || $time_complete || $step_count || $tools_needed ) :
                    ?>
                    <div class="gl-guide-meta">
                        <h2 class="gl-sr-only"><?php esc_html_e( 'Guide Overview', 'gtalobby' ); ?></h2>
                        <div class="gl-guide-meta__grid">
                            <?php if ( $difficulty ) : ?>
                            <div class="gl-guide-meta__item">
                                <span class="gl-guide-meta__label"><?php esc_html_e( 'Difficulty', 'gtalobby' ); ?></span>
                                <span class="gl-guide-meta__value">
                                    <?php gtalobby_difficulty_badge( $difficulty ); ?>
                                </span>
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
                    <?php endif; ?>

                    <?php /* --- VIDEO EMBED --- */ ?>
                    <?php if ( $video_embed ) : ?>
                    <div class="gl-video-embed">
                        <div class="gl-video-embed__wrapper">
                            <?php echo wp_oembed_get( $video_embed ) ?: '<a href="' . esc_url( $video_embed ) . '" target="_blank" rel="noopener">' . esc_html__( 'Watch Video', 'gtalobby' ) . '</a>'; ?>
                        </div>
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
                        <?php gtalobby_platform_icons(); ?>
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
