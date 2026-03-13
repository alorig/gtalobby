<?php
/**
 * Single Weekly Recap Template
 *
 * Displays a GTA Online weekly recap with podium vehicle,
 * bonuses, discounts, and date range.
 *
 * @package GtaLobby
 */

get_header();
?>

<div class="gl-single gl-single--recap">

    <div class="gl-zone gl-zone--breadcrumb">
        <div class="gl-container">
            <?php gtalobby_breadcrumbs(); ?>
        </div>
    </div>

    <div class="gl-container gl-single__layout">

        <main class="gl-single__main" id="main-content">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class( 'gl-article gl-article--recap' ); ?>>

                    <header class="gl-article__header">
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

                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="gl-article__hero">
                        <?php the_post_thumbnail( 'gl-hero', array( 'class' => 'gl-article__hero-img' ) ); ?>
                    </div>
                    <?php endif; ?>

                    <?php /* --- PODIUM VEHICLE --- */ ?>
                    <?php $podium_vehicle = get_post_meta( get_the_ID(), 'recap_podium_vehicle', true ); ?>
                    <?php if ( $podium_vehicle ) : ?>
                    <div class="gl-recap-podium">
                        <h2 class="gl-recap-podium__title"><?php esc_html_e( 'Podium Vehicle', 'gtalobby' ); ?></h2>
                        <div class="gl-recap-podium__vehicle">
                            <span class="gl-recap-podium__icon">🏆</span>
                            <span class="gl-recap-podium__name"><?php echo esc_html( $podium_vehicle ); ?></span>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php /* --- BONUSES --- */ ?>
                    <?php
                    $bonuses = get_post_meta( get_the_ID(), 'recap_bonuses', true );
                    if ( is_array( $bonuses ) && ! empty( $bonuses ) ) :
                    ?>
                    <div class="gl-recap-section gl-recap-section--bonuses">
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
                    <?php endif; ?>

                    <?php /* --- DISCOUNTS --- */ ?>
                    <?php
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
                    <?php endif; ?>

                    <?php gtalobby_render_ad_slot( 'ad_before_content' ); ?>

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
