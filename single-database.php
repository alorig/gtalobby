<?php
/**
 * Single Database Template
 *
 * Displays a database/data-table post with sortable columns,
 * filter controls, and data source attribution.
 * Zones rendered in admin-defined order via the Layout Engine.
 *
 * @package GtaLobby
 */

get_header();

$category_slug = gtalobby_get_current_category_slug();
$single_zones  = gtalobby_get_layout( 'single', $category_slug );

$article_zones = array( 'post_header', 'gta6_confidence', 'post_type_fields', 'data_table', 'toc', 'body_content' );
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

<div class="gl-single gl-single--database">
<div class="gl-container gl-single__layout">
<main class="gl-single__main gl-single__main--wide" id="main-content">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class( 'gl-article gl-article--database' ); ?>>

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
                        <?php if ( gtalobby_is_zone_enabled( 'single', 'breadcrumb', $category_slug ) ) : ?>
                            <div class="gl-article__breadcrumb"><?php gtalobby_breadcrumbs(); ?></div>
                        <?php endif; ?>

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

                    /* -- Post Type Fields --------------------------- */
                    case 'post_type_fields':
                        $data_source = get_post_meta( get_the_ID(), 'database_data_source', true );
                        if ( $data_source ) :
                    ?>
                    <div class="gl-data-source" data-zone="post_type_fields">
                        <span class="gl-data-source__label"><?php esc_html_e( 'Data Source:', 'gtalobby' ); ?></span>
                        <span class="gl-data-source__value"><?php echo esc_html( $data_source ); ?></span>
                    </div>
                    <?php
                        endif;
                        break;

                    /* -- Data Table --------------------------------- */
                    case 'data_table':
                        $headers    = get_post_meta( get_the_ID(), 'database_column_headers', true );
                        $table_data = get_post_meta( get_the_ID(), 'database_table_data', true );

                        if ( is_array( $headers ) && ! empty( $headers ) && is_array( $table_data ) && ! empty( $table_data ) ) :
                    ?>
                    <div class="gl-database" data-zone="data_table">
                        <div class="gl-database__toolbar">
                            <div class="gl-database__search">
                                <input type="text" class="gl-database__search-input" placeholder="<?php esc_attr_e( 'Search table...', 'gtalobby' ); ?>" data-table-search>
                            </div>
                            <div class="gl-database__count">
                                <span data-table-count><?php echo count( $table_data ); ?></span> <?php esc_html_e( 'entries', 'gtalobby' ); ?>
                            </div>
                        </div>
                        <div class="gl-database__scroll">
                            <table class="gl-database__table gl-sortable-table" data-sortable>
                                <thead>
                                    <tr>
                                        <?php foreach ( $headers as $header ) : ?>
                                        <th class="gl-database__th" data-sort="string"><?php echo esc_html( $header ); ?></th>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ( $table_data as $row ) : ?>
                                    <tr class="gl-database__row">
                                        <?php
                                        if ( is_array( $row ) ) :
                                            foreach ( $row as $cell ) :
                                        ?>
                                            <td class="gl-database__td"><?php echo esc_html( $cell ); ?></td>
                                        <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
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

                    /* -- GTA 6 Confidence (no-op) ------------------- */
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
</div>
</div>

<?php get_footer(); ?>
