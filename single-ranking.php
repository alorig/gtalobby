<?php
/**
 * Single Ranking Template
 *
 * Displays a ranking / top-list with scored items,
 * criteria explanation, and sortable ranking table.
 *
 * @package GtaLobby
 */

get_header();
?>

<div class="gl-single gl-single--ranking">

    <div class="gl-zone gl-zone--breadcrumb">
        <div class="gl-container">
            <?php gtalobby_breadcrumbs(); ?>
        </div>
    </div>

    <div class="gl-container gl-single__layout">

        <main class="gl-single__main" id="main-content">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class( 'gl-article gl-article--ranking' ); ?>>

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

                    <?php /* --- RANKING CRITERIA --- */ ?>
                    <?php $criteria = get_post_meta( get_the_ID(), 'ranking_criteria', true ); ?>
                    <?php if ( $criteria ) : ?>
                    <div class="gl-ranking-criteria">
                        <h2 class="gl-ranking-criteria__title"><?php esc_html_e( 'Ranking Criteria', 'gtalobby' ); ?></h2>
                        <div class="gl-ranking-criteria__text gl-typography"><?php echo wp_kses_post( $criteria ); ?></div>
                    </div>
                    <?php endif; ?>

                    <?php /* --- RANKED ITEMS TABLE --- */ ?>
                    <?php
                    $ranked_items = get_post_meta( get_the_ID(), 'ranking_ranked_items', true );
                    if ( is_array( $ranked_items ) && ! empty( $ranked_items ) ) :
                    ?>
                    <div class="gl-ranking-table-wrap">
                        <h2 class="gl-ranking-table__title"><?php esc_html_e( 'Full Rankings', 'gtalobby' ); ?></h2>
                        <table class="gl-ranking-table gl-sortable-table" data-sortable>
                            <thead>
                                <tr>
                                    <th class="gl-ranking-table__th gl-ranking-table__th--rank" data-sort="number"><?php esc_html_e( '#', 'gtalobby' ); ?></th>
                                    <th class="gl-ranking-table__th gl-ranking-table__th--name" data-sort="string"><?php esc_html_e( 'Name', 'gtalobby' ); ?></th>
                                    <th class="gl-ranking-table__th gl-ranking-table__th--score" data-sort="number"><?php esc_html_e( 'Score', 'gtalobby' ); ?></th>
                                    <th class="gl-ranking-table__th gl-ranking-table__th--pros"><?php esc_html_e( 'Pros', 'gtalobby' ); ?></th>
                                    <th class="gl-ranking-table__th gl-ranking-table__th--cons"><?php esc_html_e( 'Cons', 'gtalobby' ); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ( $ranked_items as $item ) : ?>
                                <tr class="gl-ranking-table__row">
                                    <td class="gl-ranking-table__td gl-ranking-table__td--rank">
                                        <span class="gl-rank-badge"><?php echo esc_html( $item['item_rank'] ?? '' ); ?></span>
                                    </td>
                                    <td class="gl-ranking-table__td gl-ranking-table__td--name">
                                        <strong><?php echo esc_html( $item['item_name'] ?? '' ); ?></strong>
                                    </td>
                                    <td class="gl-ranking-table__td gl-ranking-table__td--score">
                                        <?php if ( ! empty( $item['item_score'] ) ) : ?>
                                        <span class="gl-score-badge"><?php echo esc_html( $item['item_score'] ); ?>/10</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="gl-ranking-table__td gl-ranking-table__td--pros">
                                        <?php echo esc_html( $item['item_pros'] ?? '' ); ?>
                                    </td>
                                    <td class="gl-ranking-table__td gl-ranking-table__td--cons">
                                        <?php echo esc_html( $item['item_cons'] ?? '' ); ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <?php /* --- TOP 3 PODIUM (visual) --- */ ?>
                    <?php if ( count( $ranked_items ) >= 3 ) : ?>
                    <div class="gl-podium">
                        <?php
                        $podium_order = array( 1, 0, 2 ); // Silver, Gold, Bronze positions
                        $podium_class = array( 'silver', 'gold', 'bronze' );
                        foreach ( $podium_order as $idx => $pos ) :
                            if ( isset( $ranked_items[ $pos ] ) ) :
                        ?>
                        <div class="gl-podium__place gl-podium__place--<?php echo esc_attr( $podium_class[ $idx ] ); ?>">
                            <span class="gl-podium__rank"><?php echo esc_html( $ranked_items[ $pos ]['item_rank'] ?? ( $pos + 1 ) ); ?></span>
                            <span class="gl-podium__name"><?php echo esc_html( $ranked_items[ $pos ]['item_name'] ?? '' ); ?></span>
                            <?php if ( ! empty( $ranked_items[ $pos ]['item_score'] ) ) : ?>
                            <span class="gl-podium__score"><?php echo esc_html( $ranked_items[ $pos ]['item_score'] ); ?>/10</span>
                            <?php endif; ?>
                        </div>
                        <?php
                            endif;
                        endforeach;
                        ?>
                    </div>
                    <?php endif; ?>

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
