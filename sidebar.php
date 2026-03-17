<?php
/**
 * GtaLobby — Sidebar Template
 *
 * Context-aware sidebar that changes content based on page type.
 *
 * @package GtaLobby
 */

defined( 'ABSPATH' ) || exit;
?>

<aside class="gl-sidebar" role="complementary" aria-label="<?php esc_attr_e( 'Sidebar', 'gtalobby' ); ?>">

    <?php
    /* -- Hub Pages -------------------------------------------------- */
    if ( is_page_template( 'page-hub.php' ) && is_active_sidebar( 'sidebar-hub' ) ) :
        echo '<div class="gl-sidebar__section" data-animate="slide-right" data-delay="100">';
        dynamic_sidebar( 'sidebar-hub' );
        echo '</div>';

    /* -- Singular Posts --------------------------------------------- */
    elseif ( is_singular() ) :

        /* Hub children list (if post is assigned to a hub) */
        $hub_id = get_post_meta( get_the_ID(), 'hub_page_assignment', true );
        if ( $hub_id ) :
            gtalobby_hub_children_list( $hub_id );
        endif;

        /* GTA 6 confidence / source info widget */
        if ( gtalobby_is_gta6_content() && gtalobby_is_enabled( 'enable_gta6_mode' ) ) :
            $confidence    = get_post_meta( get_the_ID(), 'confidence_level', true );
            $source_url    = get_post_meta( get_the_ID(), 'source_url', true );
            $source_type   = get_post_meta( get_the_ID(), 'source_type', true );
            $last_verified = get_post_meta( get_the_ID(), 'last_verified', true );
        ?>
        <div class="gl-sidebar__section" data-animate="slide-right" data-delay="200">
        <div class="gl-sidebar__gta6-info gl-widget">
            <h3 class="gl-widget__title"><?php esc_html_e( 'Source Info', 'gtalobby' ); ?></h3>

            <?php if ( $confidence ) : ?>
            <div class="gl-sidebar__meta-row">
                <span class="gl-sidebar__meta-label"><?php esc_html_e( 'Confidence:', 'gtalobby' ); ?></span>
                <?php gtalobby_confidence_badge(); ?>
            </div>
            <?php endif; ?>

            <?php if ( $source_type ) : ?>
            <div class="gl-sidebar__meta-row">
                <span class="gl-sidebar__meta-label"><?php esc_html_e( 'Source:', 'gtalobby' ); ?></span>
                <span><?php echo esc_html( ucfirst( $source_type ) ); ?></span>
            </div>
            <?php endif; ?>

            <?php if ( $source_url ) : ?>
            <div class="gl-sidebar__meta-row">
                <a href="<?php echo esc_url( $source_url ); ?>"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="gl-sidebar__source-link">
                    <?php esc_html_e( 'View Source', 'gtalobby' ); ?> &rarr;
                </a>
            </div>
            <?php endif; ?>

            <?php if ( $last_verified ) : ?>
            <div class="gl-sidebar__meta-row">
                <span class="gl-sidebar__meta-label"><?php esc_html_e( 'Verified:', 'gtalobby' ); ?></span>
                <span><?php echo esc_html( $last_verified ); ?></span>
            </div>
            <?php endif; ?>
        </div>
        </div>
        <?php
        endif;

        /* Sidebar ad slot */
        gtalobby_render_ad_slot( 'ad_sidebar' );

        /* Primary sidebar widgets */
        if ( is_active_sidebar( 'sidebar-primary' ) ) :
            echo '<div class="gl-sidebar__section" data-animate="slide-right" data-delay="300">';
            dynamic_sidebar( 'sidebar-primary' );
            echo '</div>';
        endif;

    /* -- Archive / Default Sidebar ---------------------------------- */
    else :
        if ( is_active_sidebar( 'sidebar-primary' ) ) :
            echo '<div class="gl-sidebar__section" data-animate="slide-right" data-delay="100">';
            dynamic_sidebar( 'sidebar-primary' );
            echo '</div>';
        endif;

        gtalobby_render_ad_slot( 'ad_sidebar' );
    endif;
    ?>

</aside>
