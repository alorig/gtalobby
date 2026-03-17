<?php
/**
 * Single Quick Answer Template
 *
 * Displays a quick answer with a prominent answer box,
 * sources, and related questions.
 * Zones rendered in admin-defined order via the Layout Engine.
 *
 * @package GtaLobby
 */

get_header();

$category_slug = gtalobby_get_current_category_slug();
$single_zones  = gtalobby_get_layout( 'single', $category_slug );

$article_zones = array( 'post_header', 'quick_answer_box', 'featured_image', 'gta6_confidence', 'toc', 'body_content', 'related_questions' );
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

<div class="gl-single gl-single--answer">
<div class="gl-container gl-single__layout">
<main class="gl-single__main" id="main-content">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class( 'gl-article gl-article--answer' ); ?>>

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

                /* -- Quick Answer Box --------------------------- */
                case 'quick_answer_box':
                    $short_answer = get_post_meta( get_the_ID(), 'answer_short_answer', true );
                    if ( $short_answer ) :
                ?>
                <div class="gl-answer-box" data-zone="quick_answer_box" data-animate>
                    <div class="gl-answer-box__glow" aria-hidden="true"></div>
                    <div class="gl-answer-box__icon" aria-hidden="true">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                        </svg>
                    </div>
                    <div class="gl-answer-box__content">
                        <h2 class="gl-answer-box__label"><?php esc_html_e( 'Quick Answer', 'gtalobby' ); ?></h2>
                        <div class="gl-answer-box__text"><?php echo wp_kses_post( $short_answer ); ?></div>
                    </div>
                </div>
                <?php
                    endif;
                    break;

                /* -- Featured Image ----------------------------- */
                case 'featured_image':
                    if ( has_post_thumbnail() ) :
                ?>
                <div class="gl-article__hero" data-zone="featured_image" data-animate>
                    <?php the_post_thumbnail( 'gl-feature', array( 'class' => 'gl-article__hero-img' ) ); ?>
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
                    // Sources section (part of body content zone for answers)
                    $sources = get_post_meta( get_the_ID(), 'answer_sources', true );
                    if ( $sources ) :
                ?>
                <div class="gl-sources">
                    <h2 class="gl-sources__title"><?php esc_html_e( 'Sources', 'gtalobby' ); ?></h2>
                    <div class="gl-sources__content gl-typography"><?php echo wp_kses_post( $sources ); ?></div>
                </div>
                <?php
                    endif;
                    gtalobby_render_ad_slot( 'ad_after_content' );
                    break;

                /* -- Related Questions -------------------------- */
                case 'related_questions':
                    $related_qs = get_post_meta( get_the_ID(), 'answer_related_questions', true );
                    if ( is_array( $related_qs ) && ! empty( $related_qs ) ) :
                ?>
                <div class="gl-related-questions" data-zone="related_questions" data-animate>
                    <h2 class="gl-related-questions__title"><?php esc_html_e( 'Related Questions', 'gtalobby' ); ?></h2>
                    <ul class="gl-related-questions__list">
                        <?php foreach ( $related_qs as $rq ) : ?>
                            <?php if ( ! empty( $rq['question_text'] ) ) : ?>
                            <li class="gl-related-questions__item">
                                <?php if ( ! empty( $rq['question_link'] ) ) : ?>
                                    <a href="<?php echo esc_url( $rq['question_link'] ); ?>"><?php echo esc_html( $rq['question_text'] ); ?></a>
                                <?php else : ?>
                                    <?php echo esc_html( $rq['question_text'] ); ?>
                                <?php endif; ?>
                            </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php
                    endif;
                    break;

                /* -- GTA 6 Confidence (handled in header) ------- */
                case 'gta6_confidence':
                    break;

            endswitch;
        endforeach;
        ?>

        <?php
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
       Post Zones — rendered in admin-defined order
    -------------------------------------------------------- */
    foreach ( $sorted_post as $zone_id => $zone_cfg ) :
        if ( ! gtalobby_is_zone_enabled( 'single', $zone_id, $category_slug ) ) {
            continue;
        }
        switch ( $zone_id ) :

            /* -- Author Box --------------------------------- */
            case 'author_box':
                gtalobby_author_box();
                break;

            /* -- Related Posts ------------------------------ */
            case 'related_posts':
                gtalobby_related_posts();
                break;

            /* -- Post Navigation ---------------------------- */
            case 'post_navigation':
                if ( function_exists( 'gtalobby_post_navigation' ) ) {
                    gtalobby_post_navigation();
                }
                break;

            /* -- Comments ----------------------------------- */
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
