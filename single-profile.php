<?php
/**
 * Single Profile Template
 *
 * Displays an entity profile (character, vehicle, weapon, location)
 * with stats table, gallery, and related profiles.
 * Zones rendered in admin-defined order via the Layout Engine.
 *
 * @package GtaLobby
 */

get_header();

$category_slug = gtalobby_get_current_category_slug();
$single_zones  = gtalobby_get_layout( 'single', $category_slug );

$article_zones = array( 'post_header', 'featured_image', 'gta6_confidence', 'stats_table', 'toc', 'body_content', 'gallery' );
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

<div class="gl-single gl-single--profile">

    <div class="gl-container gl-single__layout">

        <main class="gl-single__main" id="main-content">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class( 'gl-article gl-article--profile' ); ?>>

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
                            ?>
                            <div class="gl-profile-hero" data-zone="featured_image">
                                <?php if ( has_post_thumbnail() ) : ?>
                                <div class="gl-profile-hero__image">
                                    <?php the_post_thumbnail( 'gl-feature', array( 'class' => 'gl-profile-hero__img' ) ); ?>
                                </div>
                                <?php endif; ?>
                                <div class="gl-profile-hero__info">
                                    <?php
                                    $entity_type = get_post_meta( get_the_ID(), 'profile_entity_type', true );
                                    if ( $entity_type ) :
                                    ?>
                                    <span class="gl-profile-hero__type"><?php echo esc_html( ucfirst( $entity_type ) ); ?></span>
                                    <?php endif; ?>
                                    <?php if ( has_excerpt() ) : ?>
                                    <p class="gl-profile-hero__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php
                                break;

                            /* -- Stats Table -------------------------------- */
                            case 'stats_table':
                                $stats_table = get_post_meta( get_the_ID(), 'profile_stats_table', true );
                                if ( is_array( $stats_table ) && ! empty( $stats_table ) ) :
                            ?>
                            <div class="gl-stats-table-wrap" data-zone="stats_table">
                                <h2 class="gl-stats-table__title"><?php esc_html_e( 'Stats & Attributes', 'gtalobby' ); ?></h2>
                                <table class="gl-stats-table">
                                    <tbody>
                                        <?php foreach ( $stats_table as $stat ) : ?>
                                            <?php if ( ! empty( $stat['stat_label'] ) ) : ?>
                                            <tr class="gl-stats-table__row">
                                                <th class="gl-stats-table__label"><?php echo esc_html( $stat['stat_label'] ); ?></th>
                                                <td class="gl-stats-table__value">
                                                    <?php if ( is_numeric( $stat['stat_value'] ?? '' ) && ( $stat['stat_value'] >= 0 && $stat['stat_value'] <= 100 ) ) : ?>
                                                        <?php gtalobby_stat_bar( $stat['stat_label'], intval( $stat['stat_value'] ) ); ?>
                                                    <?php else : ?>
                                                        <?php echo esc_html( $stat['stat_value'] ?? '' ); ?>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
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

                            /* -- Gallery ------------------------------------ */
                            case 'gallery':
                                $gallery = get_post_meta( get_the_ID(), 'profile_gallery', true );
                                if ( is_array( $gallery ) && ! empty( $gallery ) ) :
                            ?>
                            <div class="gl-gallery" data-zone="gallery">
                                <h2 class="gl-gallery__title"><?php esc_html_e( 'Gallery', 'gtalobby' ); ?></h2>
                                <div class="gl-gallery__grid">
                                    <?php foreach ( $gallery as $img_id ) : ?>
                                    <figure class="gl-gallery__item">
                                        <?php echo wp_get_attachment_image( $img_id, 'gl-card', false, array( 'class' => 'gl-gallery__img', 'loading' => 'lazy' ) ); ?>
                                    </figure>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php
                                endif;
                                break;

                            /* -- GTA 6 Confidence (handled in post_header) -- */
                            case 'gta6_confidence':
                                break;

                        endswitch;
                    endforeach;
                    ?>

                    <?php
                    /* --------------------------------------------------------
                       Related Profiles
                    -------------------------------------------------------- */
                    $related_profiles = get_post_meta( get_the_ID(), 'profile_related_profiles', true );
                    if ( is_array( $related_profiles ) && ! empty( $related_profiles ) ) :
                    ?>
                    <div class="gl-related-profiles">
                        <h2 class="gl-related-profiles__title"><?php esc_html_e( 'Related Profiles', 'gtalobby' ); ?></h2>
                        <div class="gl-card-grid gl-card-grid--4col">
                            <?php
                            $rp_query = new WP_Query( array(
                                'post__in'       => $related_profiles,
                                'post_type'      => 'profile',
                                'posts_per_page' => 8,
                                'post_status'    => 'publish',
                            ) );
                            if ( $rp_query->have_posts() ) :
                                while ( $rp_query->have_posts() ) :
                                    $rp_query->the_post();
                                    gtalobby_card( 'compact' );
                                endwhile;
                                wp_reset_postdata();
                            endif;
                            ?>
                        </div>
                    </div>
                    <?php endif; ?>

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
                   Post-Article Zones — rendered in admin-defined order
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
