<?php
/**
 * Template Name: Hub Page
 * Template Post Type: page
 *
 * GtaLobby Hub Page — Micro-website landing page with sidebar.
 * Each hub page covers an entire SAG keyword cluster.
 * Zones are rendered in admin-defined order via the Layout Engine.
 *
 * @package GtaLobby
 */

get_header();

$hub_id          = get_the_ID();
$hub_cluster     = get_post_meta( $hub_id, 'hub_cluster_name', true );
$hub_sector      = get_post_meta( $hub_id, 'hub_sector', true );
$hub_keyword     = get_post_meta( $hub_id, 'hub_primary_keyword', true );
$hub_quick_ans   = get_post_meta( $hub_id, 'hub_quick_answer', true );
$hub_hero_style  = get_post_meta( $hub_id, 'hub_hero_style', true ) ?: 'standard';
$hub_layout      = get_post_meta( $hub_id, 'hub_layout_style', true ) ?: 'micro_website';
$key_facts       = get_post_meta( $hub_id, 'hub_key_facts', true );
$faq_items       = get_post_meta( $hub_id, 'hub_faq_items', true );
$child_posts     = get_post_meta( $hub_id, 'hub_child_posts', true );
$featured_post   = get_post_meta( $hub_id, 'hub_featured_post', true );
$cross_links     = get_post_meta( $hub_id, 'hub_cross_cluster_links', true );
$cat_color        = gtalobby_get_category_color( $hub_sector );
$cat_color_dark   = gtalobby_darken_hex( $cat_color, 0.28 );

/* ------------------------------------------------------------------
   LAYOUT ENGINE — Get zone configuration (order, visibility, width)
   ------------------------------------------------------------------ */
$hub_zones = gtalobby_get_layout( 'hub', $hub_sector );
$toc       = gtalobby_generate_toc( get_the_content() );

// Zone groups: full-width top, sidebar-layout, full-width bottom
$top_zone_ids      = array( 'breadcrumb', 'hero', 'key_facts', 'subnav' );
$sidebar_zone_ids  = array( 'quick_answer', 'toc', 'body_content', 'structured_data', 'gta6_notice' );
$bottom_zone_ids   = array( 'featured_children', 'child_posts_grid', 'cross_cluster', 'faq', 'sources', 'ad_slot_hub' );

// Sort each group by admin-defined order
$sorted_top = $sorted_sidebar = $sorted_bottom = array();
foreach ( $hub_zones as $zone_id => $zone_cfg ) {
    if ( in_array( $zone_id, $top_zone_ids, true ) ) {
        $sorted_top[ $zone_id ] = $zone_cfg;
    } elseif ( in_array( $zone_id, $sidebar_zone_ids, true ) ) {
        $sorted_sidebar[ $zone_id ] = $zone_cfg;
    } elseif ( in_array( $zone_id, $bottom_zone_ids, true ) ) {
        $sorted_bottom[ $zone_id ] = $zone_cfg;
    }
}

/**
 * Helper: get container class from zone width setting.
 */
function gtalobby_hub_container_class( $zone_cfg ) {
    $width = isset( $zone_cfg['width'] ) ? $zone_cfg['width'] : 'contained';
    if ( 'narrow' === $width ) {
        return 'gl-container gl-container--narrow';
    }
    if ( 'full' === $width ) {
        return '';
    }
    return 'gl-container';
}

/**
 * Helper: get columns class from zone config.
 */
function gtalobby_hub_grid_cols( $zone_cfg ) {
    $cols = isset( $zone_cfg['columns'] ) ? (int) $zone_cfg['columns'] : 3;
    return 'gl-card-grid gl-card-grid--' . $cols . 'col';
}
?>

<div class="gl-hub gl-hub--<?php echo esc_attr( $hub_layout ); ?>" style="--hub-accent: <?php echo esc_attr( $cat_color ); ?>; --hub-accent-rgb: <?php echo esc_attr( gtalobby_hex_to_rgb( $cat_color ) ); ?>; --hub-accent-dark: <?php echo esc_attr( $cat_color_dark ); ?>; --hub-accent-dark-rgb: <?php echo esc_attr( gtalobby_hex_to_rgb( $cat_color_dark ) ); ?>;">

    <?php
    /* ==================================================================
       TOP ZONES — Full-width, rendered in admin order
       ================================================================== */
    foreach ( $sorted_top as $zone_id => $zone_cfg ) :
        if ( ! gtalobby_is_zone_enabled( 'hub', $zone_id, $hub_sector ) ) {
            continue;
        }

        switch ( $zone_id ) :

            case 'breadcrumb':
                ?>
                <section class="gl-zone gl-zone--breadcrumb" data-zone="breadcrumb">
                    <div class="<?php echo esc_attr( gtalobby_hub_container_class( $zone_cfg ) ); ?>">
                        <?php gtalobby_breadcrumbs(); ?>
                    </div>
                </section>
                <?php
                break;

            case 'hero':
                ?>
                <section class="gl-hub-hero gl-hub-hero--<?php echo esc_attr( $hub_hero_style ); ?>" data-zone="hero">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="gl-hub-hero__bg" style="background-image: url(<?php echo esc_url( get_the_post_thumbnail_url( $hub_id, 'gl-hero' ) ); ?>)"></div>
                    <?php endif; ?>
                    <div class="gl-container gl-hub-hero__content">
                        <?php gtalobby_category_badge(); ?>
                        <h1 class="gl-hub-hero__title"><?php the_title(); ?></h1>
                        <?php if ( $hub_keyword ) : ?>
                            <p class="gl-hub-hero__subtitle"><?php echo esc_html( $hub_keyword ); ?></p>
                        <?php endif; ?>
                        <?php if ( has_excerpt() ) : ?>
                            <p class="gl-hub-hero__desc"><?php echo esc_html( get_the_excerpt() ); ?></p>
                        <?php endif; ?>
                    </div>
                </section>
                <?php
                break;

            case 'key_facts':
                if ( is_array( $key_facts ) && ! empty( $key_facts ) ) :
                ?>
                <section class="gl-zone gl-zone--key-facts" data-zone="key_facts">
                    <div class="<?php echo esc_attr( gtalobby_hub_container_class( $zone_cfg ) ); ?>">
                        <div class="gl-key-facts">
                            <?php foreach ( $key_facts as $fact ) : ?>
                                <?php if ( ! empty( $fact['fact_label'] ) && ! empty( $fact['fact_value'] ) ) : ?>
                                <div class="gl-key-fact">
                                    <dt class="gl-key-fact__label"><?php echo esc_html( $fact['fact_label'] ); ?></dt>
                                    <dd class="gl-key-fact__value"><?php echo esc_html( $fact['fact_value'] ); ?></dd>
                                </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>
                <?php
                endif;
                break;

            case 'subnav':
                // Sticky sub-navigation with jump links to zone anchors
                ?>
                <nav class="gl-zone gl-zone--subnav gl-hub-subnav" data-zone="subnav">
                    <div class="<?php echo esc_attr( gtalobby_hub_container_class( $zone_cfg ) ); ?>">
                        <ul class="gl-hub-subnav__list">
                            <?php if ( $hub_quick_ans ) : ?>
                                <li><a href="#zone-quick-answer"><?php esc_html_e( 'Quick Answer', 'gtalobby' ); ?></a></li>
                            <?php endif; ?>
                            <?php if ( $toc ) : ?>
                                <li><a href="#zone-toc"><?php esc_html_e( 'Contents', 'gtalobby' ); ?></a></li>
                            <?php endif; ?>
                            <li><a href="#zone-body-content"><?php esc_html_e( 'Article', 'gtalobby' ); ?></a></li>
                            <?php if ( is_array( $child_posts ) && ! empty( $child_posts ) ) : ?>
                                <li><a href="#zone-child-posts"><?php esc_html_e( 'Articles', 'gtalobby' ); ?></a></li>
                            <?php endif; ?>
                            <?php if ( is_array( $faq_items ) && ! empty( $faq_items ) ) : ?>
                                <li><a href="#zone-faq"><?php esc_html_e( 'FAQ', 'gtalobby' ); ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </nav>
                <?php
                break;

        endswitch;
    endforeach;
    ?>

    <?php
    /* ==================================================================
       SIDEBAR LAYOUT — Two-column with zones in admin order
       ================================================================== */
    ?>
    <div class="gl-container">
        <div class="gl-hub-layout">

            <div class="gl-hub-layout__primary">
                <?php
                foreach ( $sorted_sidebar as $zone_id => $zone_cfg ) :
                    if ( ! gtalobby_is_zone_enabled( 'hub', $zone_id, $hub_sector ) ) {
                        continue;
                    }

                    switch ( $zone_id ) :

                        case 'quick_answer':
                            if ( $hub_quick_ans ) :
                            ?>
                            <section class="gl-zone gl-zone--quick-answer" id="zone-quick-answer" data-zone="quick_answer">
                                <div class="gl-quick-answer">
                                    <h2 class="gl-quick-answer__heading"><?php esc_html_e( 'Quick Answer', 'gtalobby' ); ?></h2>
                                    <div class="gl-quick-answer__text"><?php echo wp_kses_post( $hub_quick_ans ); ?></div>
                                </div>
                            </section>
                            <?php
                            endif;
                            break;

                        case 'toc':
                            if ( $toc ) :
                            ?>
                            <section class="gl-zone gl-zone--toc" id="zone-toc" data-zone="toc">
                                <?php echo $toc; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                            </section>
                            <?php
                            endif;
                            break;

                        case 'body_content':
                            ?>
                            <section class="gl-zone gl-zone--body-content" id="zone-body-content" data-zone="body_content">
                                <div class="gl-content gl-typography">
                                    <?php the_content(); ?>
                                </div>
                            </section>
                            <?php
                            break;

                        case 'structured_data':
                            // Renders any structured data sections defined via custom fields
                            $data_section = get_post_meta( $hub_id, 'hub_structured_data', true );
                            if ( $data_section ) :
                            ?>
                            <section class="gl-zone gl-zone--structured-data" data-zone="structured_data">
                                <div class="gl-structured-data">
                                    <?php echo wp_kses_post( $data_section ); ?>
                                </div>
                            </section>
                            <?php
                            endif;
                            break;

                        case 'gta6_notice':
                            if ( gtalobby_is_gta6_content() && gtalobby_is_enabled( 'enable_gta6_mode' ) ) :
                            ?>
                            <div class="gl-gta6-notice" data-zone="gta6_notice">
                                <strong><?php esc_html_e( 'GTA 6 Content Notice', 'gtalobby' ); ?></strong>
                                <p><?php echo esc_html( gtalobby_get_gta6_option( 'gta6_notice_text' ) ?: 'This article covers pre-release GTA 6 information and will be updated when the game launches.' ); ?></p>
                            </div>
                            <?php
                            endif;
                            break;

                    endswitch;
                endforeach;
                ?>
            </div><!-- /.gl-hub-layout__primary -->

            <aside class="gl-hub-layout__sidebar">

                <?php
                $related_hubs = get_posts( array(
                    'post_type'      => 'page',
                    'posts_per_page' => 5,
                    'post_status'    => 'publish',
                    'meta_key'       => 'hub_sector',
                    'meta_value'     => $hub_sector,
                    'exclude'        => array( $hub_id ),
                ) );
                if ( ! empty( $related_hubs ) ) :
                ?>
                <div class="gl-sidebar__section">
                    <h3 class="gl-sidebar__title"><?php esc_html_e( 'Related Hubs', 'gtalobby' ); ?></h3>
                    <ul class="gl-sidebar__list">
                        <?php foreach ( $related_hubs as $rh ) : ?>
                        <li>
                            <a href="<?php echo esc_url( get_permalink( $rh->ID ) ); ?>">
                                <?php echo esc_html( get_post_meta( $rh->ID, 'hub_cluster_name', true ) ?: $rh->post_title ); ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <?php
                $sector_cat = get_category_by_slug( $hub_sector );
                if ( $sector_cat ) :
                ?>
                <div class="gl-sidebar__section">
                    <h3 class="gl-sidebar__title"><?php esc_html_e( 'Category', 'gtalobby' ); ?></h3>
                    <a href="<?php echo esc_url( get_category_link( $sector_cat->term_id ) ); ?>" class="gl-sidebar__cat-link" style="--cat-accent: <?php echo esc_attr( $cat_color ); ?>">
                        <?php gtalobby_icon( gtalobby_get_category_icon( $hub_sector ), 18 ); ?>
                        <?php echo esc_html( $sector_cat->name ); ?>
                        <span class="gl-sidebar__cat-count"><?php echo esc_html( $sector_cat->count ); ?></span>
                    </a>
                </div>
                <?php endif; ?>

                <div class="gl-sidebar__section">
                    <h3 class="gl-sidebar__title"><?php esc_html_e( 'About This Hub', 'gtalobby' ); ?></h3>
                    <dl class="gl-sidebar__info-list">
                        <?php if ( $hub_cluster ) : ?>
                        <dt><?php esc_html_e( 'Cluster', 'gtalobby' ); ?></dt>
                        <dd><?php echo esc_html( $hub_cluster ); ?></dd>
                        <?php endif; ?>
                        <?php if ( $hub_keyword ) : ?>
                        <dt><?php esc_html_e( 'Target Keyword', 'gtalobby' ); ?></dt>
                        <dd><?php echo esc_html( $hub_keyword ); ?></dd>
                        <?php endif; ?>
                        <?php if ( is_array( $child_posts ) && ! empty( $child_posts ) ) : ?>
                        <dt><?php esc_html_e( 'Articles', 'gtalobby' ); ?></dt>
                        <dd><?php echo count( $child_posts ); ?></dd>
                        <?php endif; ?>
                    </dl>
                </div>

                <?php gtalobby_render_ad_slot( 'ad_hub_sidebar' ); ?>

            </aside><!-- /.gl-hub-layout__sidebar -->

        </div><!-- /.gl-hub-layout -->
    </div>

    <?php
    /* ==================================================================
       BOTTOM ZONES — Full-width, rendered in admin order
       ================================================================== */
    foreach ( $sorted_bottom as $zone_id => $zone_cfg ) :
        if ( ! gtalobby_is_zone_enabled( 'hub', $zone_id, $hub_sector ) ) {
            continue;
        }

        $container = gtalobby_hub_container_class( $zone_cfg );

        switch ( $zone_id ) :

            case 'featured_children':
                if ( $featured_post ) :
                    $feat_query = new WP_Query( array(
                        'post__in'       => array( $featured_post ),
                        'post_type'      => 'any',
                        'posts_per_page' => 1,
                    ) );
                    if ( $feat_query->have_posts() ) :
                ?>
                <section class="gl-zone gl-zone--featured-children" data-zone="featured_children">
                    <div class="<?php echo esc_attr( $container ); ?>">
                        <h2 class="gl-zone__title"><?php esc_html_e( 'Featured Article', 'gtalobby' ); ?></h2>
                        <?php
                        while ( $feat_query->have_posts() ) :
                            $feat_query->the_post();
                        ?>
                        <article class="gl-featured-card gl-featured-card--hub">
                            <?php if ( has_post_thumbnail() ) : ?>
                            <div class="gl-featured-card__thumb">
                                <?php the_post_thumbnail( 'gl-feature', array( 'class' => 'gl-featured-card__img' ) ); ?>
                            </div>
                            <?php else : ?>
                            <div class="gl-featured-card__thumb gl-featured-card__thumb--placeholder" style="--cat-accent: <?php echo esc_attr( $cat_color ); ?>">
                                <?php gtalobby_icon( gtalobby_get_category_icon( $hub_sector ), 48 ); ?>
                            </div>
                            <?php endif; ?>
                            <div class="gl-featured-card__body">
                                <?php gtalobby_post_type_badge(); ?>
                                <h3 class="gl-featured-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <p class="gl-featured-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 30 ) ); ?></p>
                                <div class="gl-featured-card__footer">
                                    <span><?php echo esc_html( get_the_date() ); ?></span>
                                    <span class="gl-featured-card__read"><?php esc_html_e( 'Read Article', 'gtalobby' ); ?> →</span>
                                </div>
                            </div>
                        </article>
                        <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                </section>
                <?php
                    endif;
                endif;
                break;

            case 'child_posts_grid':
                if ( is_array( $child_posts ) && ! empty( $child_posts ) ) :
                    $per_hub = gtalobby_get_option( 'gtalobby_general_options', 'posts_per_hub', 12 );
                    $paged   = max( 1, get_query_var( 'paged' ) );
                    $children_query = new WP_Query( array(
                        'post__in'       => $child_posts,
                        'post_type'      => 'any',
                        'posts_per_page' => $per_hub,
                        'paged'          => $paged,
                        'post_status'    => 'publish',
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                    ) );
                    if ( $children_query->have_posts() ) :
                        $grid_class = gtalobby_hub_grid_cols( $zone_cfg );
                ?>
                <section class="gl-zone gl-zone--child-posts" id="zone-child-posts" data-zone="child_posts_grid">
                    <div class="<?php echo esc_attr( $container ); ?>">
                        <h2 class="gl-zone__title gl-zone__title--children"><?php esc_html_e( 'All Articles in This Hub', 'gtalobby' ); ?></h2>

                        <div class="gl-hub-filters">
                            <button class="gl-hub-filter gl-hub-filter--active" data-filter="all"><?php esc_html_e( 'All', 'gtalobby' ); ?></button>
                            <?php
                            $child_types = array();
                            foreach ( $children_query->posts as $cp ) {
                                $child_types[ $cp->post_type ] = true;
                            }
                            foreach ( array_keys( $child_types ) as $ct ) :
                                $pt_info = gtalobby_get_post_type_info( $ct );
                            ?>
                            <button class="gl-hub-filter" data-filter="<?php echo esc_attr( $ct ); ?>">
                                <?php echo esc_html( $pt_info['label'] . 's' ); ?>
                            </button>
                            <?php endforeach; ?>
                        </div>

                        <div class="<?php echo esc_attr( $grid_class ); ?>">
                            <?php while ( $children_query->have_posts() ) : $children_query->the_post(); ?>
                            <div class="gl-card-grid__item" data-post-type="<?php echo esc_attr( get_post_type() ); ?>">
                                <article class="gl-post-card">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="gl-post-card__thumb">
                                        <?php the_post_thumbnail( 'gl-card', array( 'class' => 'gl-post-card__img' ) ); ?>
                                    </div>
                                    <?php else : ?>
                                    <div class="gl-post-card__thumb gl-post-card__thumb--placeholder" style="--cat-accent: <?php echo esc_attr( $cat_color ); ?>">
                                        <?php gtalobby_icon( gtalobby_get_category_icon( $hub_sector ), 28 ); ?>
                                    </div>
                                    <?php endif; ?>
                                    <div class="gl-post-card__body">
                                        <div class="gl-post-card__meta">
                                            <?php gtalobby_post_type_badge(); ?>
                                            <span class="gl-post-card__date"><?php echo esc_html( get_the_date( 'M j' ) ); ?></span>
                                        </div>
                                        <h4 class="gl-post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                        <p class="gl-post-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 14 ) ); ?></p>
                                    </div>
                                </article>
                            </div>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>

                        <?php gtalobby_pagination( $children_query ); ?>
                    </div>
                </section>
                <?php
                    endif;
                endif;
                break;

            case 'cross_cluster':
                if ( is_array( $cross_links ) && ! empty( $cross_links ) ) :
                    $cross_cols = isset( $zone_cfg['columns'] ) ? (int) $zone_cfg['columns'] : 3;
                ?>
                <section class="gl-zone gl-zone--cross-cluster" data-zone="cross_cluster">
                    <div class="<?php echo esc_attr( $container ); ?>">
                        <h2 class="gl-zone__title"><?php esc_html_e( 'Related Topic Hubs', 'gtalobby' ); ?></h2>
                        <div class="gl-cross-cluster__grid">
                            <?php
                            $cross_query = new WP_Query( array(
                                'post__in'       => $cross_links,
                                'post_type'      => 'page',
                                'posts_per_page' => 5,
                                'post_status'    => 'publish',
                            ) );
                            if ( $cross_query->have_posts() ) :
                                while ( $cross_query->have_posts() ) :
                                    $cross_query->the_post();
                                    $cx_sector = get_post_meta( get_the_ID(), 'hub_sector', true );
                                    $cx_color  = gtalobby_get_category_color( $cx_sector );
                                    $cx_name   = get_post_meta( get_the_ID(), 'hub_cluster_name', true );
                            ?>
                            <a href="<?php the_permalink(); ?>" class="gl-cross-card" style="--cat-accent: <?php echo esc_attr( $cx_color ); ?>">
                                <span class="gl-cross-card__cluster"><?php echo esc_html( $cx_name ); ?></span>
                                <h3 class="gl-cross-card__title"><?php the_title(); ?></h3>
                                <p class="gl-cross-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 16 ) ); ?></p>
                                <span class="gl-cross-card__link"><?php esc_html_e( 'Explore', 'gtalobby' ); ?> →</span>
                            </a>
                            <?php
                                endwhile;
                                wp_reset_postdata();
                            endif;
                            ?>
                        </div>
                    </div>
                </section>
                <?php
                endif;
                break;

            case 'faq':
                if ( is_array( $faq_items ) && ! empty( $faq_items ) ) :
                ?>
                <section class="gl-zone gl-zone--faq" id="zone-faq" data-zone="faq">
                    <div class="<?php echo esc_attr( $container ); ?>">
                        <h2 class="gl-zone__title"><?php esc_html_e( 'Frequently Asked Questions', 'gtalobby' ); ?></h2>
                        <div class="gl-faq">
                            <?php foreach ( $faq_items as $faq ) : ?>
                                <?php if ( ! empty( $faq['question'] ) && ! empty( $faq['answer'] ) ) : ?>
                                <details class="gl-faq__item">
                                    <summary class="gl-faq__question"><?php echo esc_html( $faq['question'] ); ?></summary>
                                    <div class="gl-faq__answer"><?php echo wp_kses_post( $faq['answer'] ); ?></div>
                                </details>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>
                <?php
                endif;
                break;

            case 'sources':
                $sources = get_post_meta( $hub_id, 'hub_sources', true );
                if ( $sources ) :
                ?>
                <section class="gl-zone gl-zone--sources" data-zone="sources">
                    <div class="<?php echo esc_attr( $container ); ?>">
                        <h2 class="gl-zone__title"><?php esc_html_e( 'Sources & Methodology', 'gtalobby' ); ?></h2>
                        <div class="gl-sources">
                            <?php echo wp_kses_post( $sources ); ?>
                        </div>
                    </div>
                </section>
                <?php
                endif;
                break;

            case 'ad_slot_hub':
                ?>
                <div class="gl-zone gl-zone--ad" data-zone="ad_slot_hub">
                    <div class="<?php echo esc_attr( $container ); ?>">
                        <?php gtalobby_render_ad_slot( 'ad_hub_zone' ); ?>
                    </div>
                </div>
                <?php
                break;

        endswitch;
    endforeach;
    ?>

</div><!-- /.gl-hub -->

<?php get_footer(); ?>
