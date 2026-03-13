<?php
/**
 * Single Database Template
 *
 * Displays a database/data-table post with sortable columns,
 * filter controls, and data source attribution.
 *
 * @package GtaLobby
 */

get_header();
?>

<div class="gl-single gl-single--database">

    <div class="gl-zone gl-zone--breadcrumb">
        <div class="gl-container">
            <?php gtalobby_breadcrumbs(); ?>
        </div>
    </div>

    <div class="gl-container gl-single__layout">

        <main class="gl-single__main gl-single__main--wide" id="main-content">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class( 'gl-article gl-article--database' ); ?>>

                    <header class="gl-article__header">
                        <?php gtalobby_post_type_badge(); ?>
                        <?php gtalobby_category_badge(); ?>
                        <h1 class="gl-article__title"><?php the_title(); ?></h1>
                        <?php gtalobby_post_meta(); ?>
                        <?php if ( gtalobby_is_gta6_content() ) gtalobby_confidence_badge(); ?>
                    </header>

                    <?php /* --- DATA SOURCE --- */ ?>
                    <?php $data_source = get_post_meta( get_the_ID(), 'database_data_source', true ); ?>
                    <?php if ( $data_source ) : ?>
                    <div class="gl-data-source">
                        <span class="gl-data-source__label"><?php esc_html_e( 'Data Source:', 'gtalobby' ); ?></span>
                        <span class="gl-data-source__value"><?php echo esc_html( $data_source ); ?></span>
                    </div>
                    <?php endif; ?>

                    <?php gtalobby_render_ad_slot( 'ad_before_content' ); ?>

                    <?php /* --- DATABASE TABLE --- */ ?>
                    <?php
                    $headers    = get_post_meta( get_the_ID(), 'database_column_headers', true );
                    $table_data = get_post_meta( get_the_ID(), 'database_table_data', true );

                    if ( is_array( $headers ) && ! empty( $headers ) && is_array( $table_data ) && ! empty( $table_data ) ) :
                    ?>
                    <div class="gl-database">
                        <!-- Search / Filter Bar -->
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
                    <?php endif; ?>

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

    </div>
</div>

<?php get_footer(); ?>
