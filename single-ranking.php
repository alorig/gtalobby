<?php
/**
 * Single Ranking Template
 *
 * Displays a ranking / top-list with scored items,
 * criteria explanation, and sortable ranking table.
 * Zones rendered in admin-defined order via the Layout Engine.
 *
 * @package GtaLobby
 */

get_header();

$category_slug = gtalobby_get_current_category_slug();
$single_zones  = gtalobby_get_layout( 'single', $category_slug );

$article_zones = array( 'post_header', 'featured_image', 'gta6_confidence', 'post_type_fields', 'ranked_items', 'video_embed', 'toc', 'body_content' );
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

<div class="gl-single gl-single--ranking">

    <div class="gl-container gl-single__layout">

        <main class="gl-single__main" id="main-content">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class( 'gl-article gl-article--ranking' ); ?>>

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

                            /* -- Post Type Fields (Ranking Criteria) -------- */
                            case 'post_type_fields':
                                $criteria = get_post_meta( get_the_ID(), 'ranking_criteria', true );
                                if ( $criteria ) :
                            ?>
                            <div class="gl-ranking-criteria" data-zone="post_type_fields">
                                <h2 class="gl-ranking-criteria__title"><?php esc_html_e( 'Ranking Criteria', 'gtalobby' ); ?></h2>
                                <div class="gl-ranking-criteria__text gl-typography"><?php echo wp_kses_post( $criteria ); ?></div>
                            </div>
                            <?php
                                endif;
                                break;

                            /* -- Ranked Items ------------------------------- */
                            case 'ranked_items':
                                $ranked_items = get_post_meta( get_the_ID(), 'ranking_ranked_items', true );
                                if ( is_array( $ranked_items ) && ! empty( $ranked_items ) ) :
                            ?>
                            <div class="gl-ranking-table-wrap" data-zone="ranked_items">
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

                                <?php if ( count( $ranked_items ) >= 3 ) : ?>
                                <div class="gl-podium">
                                    <?php
                                    $podium_order = array( 1, 0, 2 );
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

                            /* -- No-op Zones -------------------------------- */
                            case 'gta6_confidence':
                            case 'video_embed':
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
                    <footer class="gl-article__footer">
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

                        /* -- Related Posts ------------------------------- */
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
