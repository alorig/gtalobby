<?php
/**
 * Single Quick Answer Template
 *
 * Displays a quick answer with a prominent answer box,
 * sources, and related questions.
 *
 * @package GtaLobby
 */

get_header();
?>

<div class="gl-single gl-single--answer">

    <div class="gl-zone gl-zone--breadcrumb">
        <div class="gl-container">
            <?php gtalobby_breadcrumbs(); ?>
        </div>
    </div>

    <div class="gl-container gl-single__layout">

        <main class="gl-single__main" id="main-content">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class( 'gl-article gl-article--answer' ); ?>>

                    <header class="gl-article__header">
                        <?php gtalobby_post_type_badge(); ?>
                        <?php gtalobby_category_badge(); ?>
                        <h1 class="gl-article__title"><?php the_title(); ?></h1>
                        <?php gtalobby_post_meta(); ?>
                        <?php if ( gtalobby_is_gta6_content() ) gtalobby_confidence_badge(); ?>
                    </header>

                    <?php /* --- QUICK ANSWER BOX --- */ ?>
                    <?php $short_answer = get_post_meta( get_the_ID(), 'answer_short_answer', true ); ?>
                    <?php if ( $short_answer ) : ?>
                    <div class="gl-answer-box">
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
                    <?php endif; ?>

                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="gl-article__hero">
                        <?php the_post_thumbnail( 'gl-feature', array( 'class' => 'gl-article__hero-img' ) ); ?>
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

                    <?php /* --- SOURCES --- */ ?>
                    <?php $sources = get_post_meta( get_the_ID(), 'answer_sources', true ); ?>
                    <?php if ( $sources ) : ?>
                    <div class="gl-sources">
                        <h2 class="gl-sources__title"><?php esc_html_e( 'Sources', 'gtalobby' ); ?></h2>
                        <div class="gl-sources__content gl-typography"><?php echo wp_kses_post( $sources ); ?></div>
                    </div>
                    <?php endif; ?>

                    <?php /* --- RELATED QUESTIONS --- */ ?>
                    <?php
                    $related_qs = get_post_meta( get_the_ID(), 'answer_related_questions', true );
                    if ( is_array( $related_qs ) && ! empty( $related_qs ) ) :
                    ?>
                    <div class="gl-related-questions">
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
                    <?php endif; ?>

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
