<?php
/**
 * Template Name: Hub Page
 * Template Post Type: page
 *
 * GtaLobby Hub Page — Micro-website / Magazine + Landing Page hybrid.
 * Uses the Layout Engine zone system for fully configurable content blocks.
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
$category_slug   = gtalobby_get_current_category_slug();
?>

<div class="gl-hub gl-hub--<?php echo esc_attr( $hub_layout ); ?> gl-hub--hero-<?php echo esc_attr( $hub_hero_style ); ?>">

    <?php /* --- BREADCRUMB ZONE --- */ ?>
    <div class="gl-zone gl-zone--breadcrumb">
        <div class="gl-container">
            <?php gtalobby_breadcrumbs(); ?>
        </div>
    </div>

    <?php /* --- HERO ZONE --- */ ?>
    <section class="gl-zone gl-zone--hero gl-hub-hero gl-hub-hero--<?php echo esc_attr( $hub_hero_style ); ?>">
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

    <?php /* --- KEY FACTS ZONE --- */ ?>
    <?php if ( is_array( $key_facts ) && ! empty( $key_facts ) ) : ?>
    <section class="gl-zone gl-zone--key-facts">
        <div class="gl-container">
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
    <?php endif; ?>

    <?php /* --- QUICK ANSWER ZONE --- */ ?>
    <?php if ( $hub_quick_ans ) : ?>
    <section class="gl-zone gl-zone--quick-answer">
        <div class="gl-container gl-container--narrow">
            <div class="gl-quick-answer">
                <h2 class="gl-quick-answer__heading"><?php esc_html_e( 'Quick Answer', 'gtalobby' ); ?></h2>
                <div class="gl-quick-answer__text"><?php echo wp_kses_post( $hub_quick_ans ); ?></div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php /* --- TABLE OF CONTENTS ZONE --- */ ?>
    <?php
    $toc = gtalobby_generate_toc( get_the_content() );
    if ( $toc ) :
    ?>
    <section class="gl-zone gl-zone--toc">
        <div class="gl-container gl-container--narrow">
            <?php echo $toc; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        </div>
    </section>
    <?php endif; ?>

    <?php /* --- BODY CONTENT ZONE --- */ ?>
    <section class="gl-zone gl-zone--body-content">
        <div class="gl-container gl-container--narrow">
            <div class="gl-content gl-typography">
                <?php the_content(); ?>
            </div>
        </div>
    </section>

    <?php /* --- FEATURED POST ZONE --- */ ?>
    <?php if ( $featured_post ) : ?>
    <section class="gl-zone gl-zone--featured">
        <div class="gl-container">
            <h2 class="gl-zone__title"><?php esc_html_e( 'Featured', 'gtalobby' ); ?></h2>
            <?php
            $feat_query = new WP_Query( array(
                'post__in'       => array( $featured_post ),
                'post_type'      => 'any',
                'posts_per_page' => 1,
            ) );
            if ( $feat_query->have_posts() ) :
                while ( $feat_query->have_posts() ) :
                    $feat_query->the_post();
                    gtalobby_card( 'feature' );
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </section>
    <?php endif; ?>

    <?php /* --- CHILD POSTS GRID ZONE --- */ ?>
    <?php if ( is_array( $child_posts ) && ! empty( $child_posts ) ) : ?>
    <section class="gl-zone gl-zone--child-posts">
        <div class="gl-container">
            <h2 class="gl-zone__title"><?php esc_html_e( 'All Content in This Topic', 'gtalobby' ); ?></h2>

            <?php
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
            ?>

            <!-- Post Type Filter Tabs -->
            <div class="gl-hub-filters">
                <button class="gl-hub-filter gl-hub-filter--active" data-filter="all"><?php esc_html_e( 'All', 'gtalobby' ); ?></button>
                <?php
                // Get unique post types in children
                $child_types = array();
                if ( $children_query->have_posts() ) :
                    foreach ( $children_query->posts as $cp ) {
                        $child_types[ $cp->post_type ] = true;
                    }
                    foreach ( array_keys( $child_types ) as $ct ) :
                        $pt_info = gtalobby_get_post_type_info( $ct );
                ?>
                    <button class="gl-hub-filter" data-filter="<?php echo esc_attr( $ct ); ?>"><?php echo esc_html( $pt_info['label'] . 's' ); ?></button>
                <?php
                    endforeach;
                endif;
                ?>
            </div>

            <div class="gl-card-grid gl-card-grid--3col">
                <?php
                if ( $children_query->have_posts() ) :
                    while ( $children_query->have_posts() ) :
                        $children_query->the_post();
                        echo '<div class="gl-card-grid__item" data-post-type="' . esc_attr( get_post_type() ) . '">';
                        gtalobby_card( 'standard' );
                        echo '</div>';
                    endwhile;
                endif;
                wp_reset_postdata();
                ?>
            </div>

            <?php gtalobby_pagination( $children_query ); ?>
        </div>
    </section>
    <?php endif; ?>

    <?php /* --- CROSS-CLUSTER LINKS ZONE --- */ ?>
    <?php if ( is_array( $cross_links ) && ! empty( $cross_links ) ) : ?>
    <section class="gl-zone gl-zone--cross-cluster">
        <div class="gl-container">
            <?php gtalobby_cross_cluster_links( $hub_id ); ?>
        </div>
    </section>
    <?php endif; ?>

    <?php /* --- FAQ ZONE --- */ ?>
    <?php if ( is_array( $faq_items ) && ! empty( $faq_items ) ) : ?>
    <section class="gl-zone gl-zone--faq">
        <div class="gl-container gl-container--narrow">
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
    <?php endif; ?>

    <?php /* --- GTA 6 NOTICE ZONE --- */ ?>
    <?php if ( gtalobby_is_gta6_content() && gtalobby_is_enabled( 'enable_gta6_mode' ) ) : ?>
    <section class="gl-zone gl-zone--gta6-notice">
        <div class="gl-container gl-container--narrow">
            <div class="gl-gta6-notice">
                <p><?php echo esc_html( gtalobby_get_gta6_option( 'gta6_notice_text' ) ); ?></p>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php /* --- AD SLOT ZONE --- */ ?>
    <div class="gl-zone gl-zone--ad">
        <div class="gl-container">
            <?php gtalobby_render_ad_slot( 'ad_hub_zone' ); ?>
        </div>
    </div>

</div><!-- /.gl-hub -->

<?php get_footer(); ?>
