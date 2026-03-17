<?php
/**
 * Single Weekly Recap Template
 *
 * Displays a GTA Online weekly recap with podium vehicle,
 * bonuses, discounts, and date range.
 * Zones rendered in admin-defined order via the Layout Engine.
 *
 * @package GtaLobby
 */

get_header();

$category_slug = gtalobby_get_current_category_slug();
$single_zones  = gtalobby_get_layout( 'single', $category_slug );

$article_zones = array( 'post_header', 'featured_image', 'gta6_confidence', 'post_type_fields', 'weekly_bonuses', 'body_content' );
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

<div class="gl-single gl-single--recap">

    <div class="gl-container gl-single__layout">

        <main class="gl-single__main" id="main-content">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class( 'gl-article gl-article--recap' ); ?>>

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

                                <?php $date_range = get_post_meta( get_the_ID(), 'recap_week_date_range', true ); ?>
                                <?php if ( $date_range ) : ?>
                                <div class="gl-recap-dates">
                                    <svg class="gl-icon" width="16" height="16"><use href="#icon-clock"/></svg>
                                    <span><?php echo esc_html( $date_range ); ?></span>
                                </div>
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

                            /* -- Post Type Fields (Podium Vehicle) ---------- */
                            case 'post_type_fields':
                                $podium_vehicle = get_post_meta( get_the_ID(), 'recap_podium_vehicle', true );
                                if ( $podium_vehicle ) :
                            ?>
                            <div class="gl-recap-podium" data-zone="post_type_fields">
                                <h2 class="gl-recap-podium__title"><?php esc_html_e( 'Podium Vehicle', 'gtalobby' ); ?></h2>
                                <div class="gl-recap-podium__vehicle">
                                    <span class="gl-recap-podium__icon">🏆</span>
                                    <span class="gl-recap-podium__name"><?php echo esc_html( $podium_vehicle ); ?></span>
                                </div>
                            </div>
                            <?php
                                endif;
                                break;

                            /* -- Weekly Bonuses & Discounts ------------------ */
                            case 'weekly_bonuses':
                                $bonuses = get_post_meta( get_the_ID(), 'recap_bonuses', true );
                                if ( is_array( $bonuses ) && ! empty( $bonuses ) ) :
                            ?>
                            <div class="gl-recap-section gl-recap-section--bonuses" data-zone="weekly_bonuses">
                                <h2 class="gl-recap-section__title"><?php esc_html_e( 'Bonuses & Rewards', 'gtalobby' ); ?></h2>
                                <div class="gl-recap-grid">
                                    <?php foreach ( $bonuses as $bonus ) : ?>
                                        <?php if ( ! empty( $bonus['bonus_title'] ) ) : ?>
                                        <div class="gl-recap-card gl-recap-card--bonus">
                                            <h3 class="gl-recap-card__title"><?php echo esc_html( $bonus['bonus_title'] ); ?></h3>
                                            <?php if ( ! empty( $bonus['bonus_multiplier'] ) ) : ?>
                                            <span class="gl-recap-card__badge"><?php echo esc_html( $bonus['bonus_multiplier'] ); ?></span>
                                            <?php endif; ?>
                                            <?php if ( ! empty( $bonus['bonus_description'] ) ) : ?>
                                            <p class="gl-recap-card__desc"><?php echo esc_html( $bonus['bonus_description'] ); ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php
                                endif;

                                // Discounts (part of weekly_bonuses zone)
                                $discounts = get_post_meta( get_the_ID(), 'recap_discounts', true );
                                if ( is_array( $discounts ) && ! empty( $discounts ) ) :
                            ?>
                            <div class="gl-recap-section gl-recap-section--discounts">
                                <h2 class="gl-recap-section__title"><?php esc_html_e( 'Discounts', 'gtalobby' ); ?></h2>
                                <table class="gl-recap-discounts gl-sortable-table" data-sortable>
                                    <thead>
                                        <tr>
                                            <th data-sort="string"><?php esc_html_e( 'Item', 'gtalobby' ); ?></th>
                                            <th data-sort="string"><?php esc_html_e( 'Discount', 'gtalobby' ); ?></th>
                                            <th data-sort="string"><?php esc_html_e( 'Category', 'gtalobby' ); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ( $discounts as $discount ) : ?>
                                            <?php if ( ! empty( $discount['discount_item'] ) ) : ?>
                                            <tr>
                                                <td><?php echo esc_html( $discount['discount_item'] ); ?></td>
                                                <td><span class="gl-discount-badge"><?php echo esc_html( $discount['discount_percent'] ?? '' ); ?></span></td>
                                                <td><?php echo esc_html( $discount['discount_category'] ?? '' ); ?></td>
                                            </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
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

                            /* -- GTA 6 Confidence (no-op for recaps) -------- */
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
                   Post Zones — rendered below the article
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
