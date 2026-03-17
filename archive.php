<?php
/**
 * Generic Archive Template — Premium Design
 *
 * Used for post type archives and any taxonomy archives
 * without a dedicated template file. Zones rendered in
 * admin-defined order via the Layout Engine.
 *
 * @package GtaLobby
 */

get_header();
$category_slug = gtalobby_get_current_category_slug();
$archive_zones = gtalobby_get_layout( 'archive', $category_slug );
?>

<div class="gl-archive">

    <?php
    /* ================================================================
       Archive Zones — rendered in admin-defined order
       ================================================================ */
    foreach ( $archive_zones as $zone_id => $zone_cfg ) :
        if ( ! gtalobby_is_zone_enabled( 'archive', $zone_id, $category_slug ) ) {
            continue;
        }

        switch ( $zone_id ) :

            /* -- Breadcrumb (rendered inside archive_header) -------- */
            case 'breadcrumb':
                break;

            /* -- Archive Header — Premium Cinematic Hero ------------ */
            case 'archive_header':
            ?>
            <section class="gl-zone gl-zone--archive-header gl-arc-hero" data-zone="archive_header" data-animate>
                <!-- Decorative glow orb -->
                <div class="gl-arc-hero__orb" aria-hidden="true"></div>

                <div class="gl-container">
                    <div class="gl-arc-hero__inner">

                        <?php if ( gtalobby_is_zone_enabled( 'archive', 'breadcrumb', $category_slug ) ) : ?>
                            <div class="gl-arc-hero__breadcrumb" data-animate><?php gtalobby_breadcrumbs(); ?></div>
                        <?php endif; ?>

                        <?php if ( is_post_type_archive() ) :
                            $pt = get_queried_object();
                            $pt_obj = get_post_type_object( $pt->name ?? '' );
                        ?>
                            <div class="gl-arc-hero__badge" data-animate>
                                <span class="gl-arc-hero__badge-icon">
                                    <?php gtalobby_icon( 'archive', 24 ); ?>
                                </span>
                                <span class="gl-arc-hero__badge-label">
                                    <?php esc_html_e( 'Post Type Archive', 'gtalobby' ); ?>
                                </span>
                            </div>

                            <h1 class="gl-arc-hero__title" data-animate><?php post_type_archive_title(); ?></h1>

                            <?php if ( ! empty( $pt->description ) ) : ?>
                                <p class="gl-arc-hero__desc" data-animate><?php echo esc_html( $pt->description ); ?></p>
                            <?php endif; ?>

                            <?php
                            /* Post count for post type */
                            $pt_count = wp_count_posts( $pt->name ?? 'post' );
                            if ( $pt_count && isset( $pt_count->publish ) && $pt_count->publish > 0 ) : ?>
                                <div class="gl-arc-hero__meta" data-animate>
                                    <strong><?php echo esc_html( number_format_i18n( $pt_count->publish ) ); ?></strong>
                                    <span><?php echo esc_html( _n( 'published post', 'published posts', $pt_count->publish, 'gtalobby' ) ); ?></span>
                                </div>
                            <?php endif; ?>

                        <?php elseif ( is_tax() ) : ?>
                            <div class="gl-arc-hero__badge" data-animate>
                                <span class="gl-arc-hero__badge-icon">
                                    <?php gtalobby_icon( 'tag', 24 ); ?>
                                </span>
                                <span class="gl-arc-hero__badge-label">
                                    <?php echo esc_html( get_taxonomy( get_queried_object()->taxonomy )->labels->singular_name ?? __( 'Taxonomy', 'gtalobby' ) ); ?>
                                </span>
                            </div>

                            <h1 class="gl-arc-hero__title" data-animate><?php single_term_title(); ?></h1>

                            <?php if ( term_description() ) : ?>
                                <div class="gl-arc-hero__desc" data-animate><?php echo wp_kses_post( term_description() ); ?></div>
                            <?php endif; ?>

                            <?php
                            $term_obj = get_queried_object();
                            if ( $term_obj && $term_obj->count > 0 ) : ?>
                                <div class="gl-arc-hero__meta" data-animate>
                                    <strong><?php echo esc_html( number_format_i18n( $term_obj->count ) ); ?></strong>
                                    <span><?php echo esc_html( _n( 'post', 'posts', $term_obj->count, 'gtalobby' ) ); ?></span>
                                </div>
                            <?php endif; ?>

                        <?php elseif ( is_tag() ) : ?>
                            <div class="gl-arc-hero__badge" data-animate>
                                <span class="gl-arc-hero__badge-icon">
                                    <?php gtalobby_icon( 'hash', 24 ); ?>
                                </span>
                                <span class="gl-arc-hero__badge-label">
                                    <?php esc_html_e( 'Tag', 'gtalobby' ); ?>
                                </span>
                            </div>

                            <h1 class="gl-arc-hero__title" data-animate><?php single_tag_title(); ?></h1>

                            <?php if ( tag_description() ) : ?>
                                <div class="gl-arc-hero__desc" data-animate><?php echo wp_kses_post( tag_description() ); ?></div>
                            <?php endif; ?>

                            <?php
                            $tag_obj = get_queried_object();
                            if ( $tag_obj && $tag_obj->count > 0 ) : ?>
                                <div class="gl-arc-hero__meta" data-animate>
                                    <strong><?php echo esc_html( number_format_i18n( $tag_obj->count ) ); ?></strong>
                                    <span><?php echo esc_html( _n( 'post', 'posts', $tag_obj->count, 'gtalobby' ) ); ?></span>
                                </div>
                            <?php endif; ?>

                        <?php elseif ( is_author() ) :
                            $author_id = get_queried_object_id();
                        ?>
                            <div class="gl-arc-author" data-animate>
                                <div class="gl-arc-author__avatar">
                                    <?php echo get_avatar( $author_id, 96, '', '', array( 'class' => 'gl-arc-author__img' ) ); ?>
                                    <div class="gl-arc-author__avatar-ring" aria-hidden="true"></div>
                                </div>

                                <div class="gl-arc-author__info">
                                    <div class="gl-arc-hero__badge">
                                        <span class="gl-arc-hero__badge-icon">
                                            <?php gtalobby_icon( 'user', 20 ); ?>
                                        </span>
                                        <span class="gl-arc-hero__badge-label">
                                            <?php esc_html_e( 'Author', 'gtalobby' ); ?>
                                        </span>
                                    </div>

                                    <h1 class="gl-arc-hero__title"><?php echo esc_html( get_the_author() ); ?></h1>

                                    <?php if ( get_the_author_meta( 'description' ) ) : ?>
                                        <p class="gl-arc-hero__desc"><?php echo esc_html( get_the_author_meta( 'description' ) ); ?></p>
                                    <?php endif; ?>

                                    <div class="gl-arc-hero__meta">
                                        <strong><?php echo esc_html( number_format_i18n( count_user_posts( $author_id ) ) ); ?></strong>
                                        <span><?php echo esc_html( _n( 'post', 'posts', count_user_posts( $author_id ), 'gtalobby' ) ); ?></span>
                                    </div>
                                </div>
                            </div>

                        <?php elseif ( is_date() ) : ?>
                            <div class="gl-arc-date" data-animate>
                                <div class="gl-arc-date__calendar" aria-hidden="true">
                                    <?php if ( is_day() ) : ?>
                                        <span class="gl-arc-date__month"><?php echo esc_html( get_the_date( 'M' ) ); ?></span>
                                        <span class="gl-arc-date__day"><?php echo esc_html( get_the_date( 'd' ) ); ?></span>
                                        <span class="gl-arc-date__year"><?php echo esc_html( get_the_date( 'Y' ) ); ?></span>
                                    <?php elseif ( is_month() ) : ?>
                                        <span class="gl-arc-date__month"><?php echo esc_html( get_the_date( 'F' ) ); ?></span>
                                        <span class="gl-arc-date__day">&mdash;</span>
                                        <span class="gl-arc-date__year"><?php echo esc_html( get_the_date( 'Y' ) ); ?></span>
                                    <?php elseif ( is_year() ) : ?>
                                        <span class="gl-arc-date__month"><?php esc_html_e( 'Year', 'gtalobby' ); ?></span>
                                        <span class="gl-arc-date__day"><?php echo esc_html( get_the_date( 'Y' ) ); ?></span>
                                        <span class="gl-arc-date__year">&nbsp;</span>
                                    <?php endif; ?>
                                </div>

                                <div class="gl-arc-date__info">
                                    <div class="gl-arc-hero__badge">
                                        <span class="gl-arc-hero__badge-icon">
                                            <?php gtalobby_icon( 'calendar', 20 ); ?>
                                        </span>
                                        <span class="gl-arc-hero__badge-label">
                                            <?php esc_html_e( 'Date Archive', 'gtalobby' ); ?>
                                        </span>
                                    </div>

                                    <h1 class="gl-arc-hero__title">
                                        <?php
                                        if ( is_day() ) {
                                            printf( esc_html__( 'Archives: %s', 'gtalobby' ), get_the_date() );
                                        } elseif ( is_month() ) {
                                            printf( esc_html__( 'Archives: %s', 'gtalobby' ), get_the_date( 'F Y' ) );
                                        } elseif ( is_year() ) {
                                            printf( esc_html__( 'Archives: %s', 'gtalobby' ), get_the_date( 'Y' ) );
                                        }
                                        ?>
                                    </h1>
                                </div>
                            </div>

                        <?php else : ?>
                            <div class="gl-arc-hero__badge" data-animate>
                                <span class="gl-arc-hero__badge-icon">
                                    <?php gtalobby_icon( 'archive', 24 ); ?>
                                </span>
                                <span class="gl-arc-hero__badge-label">
                                    <?php esc_html_e( 'Archive', 'gtalobby' ); ?>
                                </span>
                            </div>

                            <h1 class="gl-arc-hero__title" data-animate><?php esc_html_e( 'Archives', 'gtalobby' ); ?></h1>
                        <?php endif; ?>

                    </div>
                </div>

                <!-- Bottom accent strip -->
                <div class="gl-arc-hero__strip" aria-hidden="true"></div>
            </section>
            <?php
                break;

            /* -- Pinned Hubs ---------------------------------------- */
            case 'pinned_hubs':
                if ( is_category() ) :
                    $cat_obj      = get_queried_object();
                    $pinned_query = new WP_Query( array(
                        'post_type'      => 'page',
                        'posts_per_page' => 3,
                        'post_status'    => 'publish',
                        'meta_key'       => 'hub_sector',
                        'meta_value'     => $cat_obj->slug,
                    ) );

                    if ( $pinned_query->have_posts() ) :
                        $cat_color = gtalobby_get_category_color( $cat_obj->slug );
                ?>
                <section class="gl-zone gl-zone--pinned-hubs" data-zone="pinned_hubs" data-animate>
                    <div class="gl-container">
                        <h2 class="gl-zone__title"><?php esc_html_e( 'Topic Hubs', 'gtalobby' ); ?></h2>

                        <div class="gl-card-grid gl-card-grid--3col">
                            <?php
                            while ( $pinned_query->have_posts() ) :
                                $pinned_query->the_post();
                                $hub_cn = get_post_meta( get_the_ID(), 'hub_cluster_name', true );
                            ?>
                            <a href="<?php the_permalink(); ?>"
                               class="gl-hub-card"
                               style="--cat-accent: <?php echo esc_attr( $cat_color ); ?>">
                                <div class="gl-hub-card__body">
                                    <h3 class="gl-hub-card__title"><?php echo esc_html( $hub_cn ?: get_the_title() ); ?></h3>
                                    <span class="gl-hub-card__cluster"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 12 ) ); ?></span>
                                </div>
                            </a>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>
                    </div>
                </section>
                <?php
                    endif;
                endif;
                break;

            /* -- Filter Bar ----------------------------------------- */
            case 'filter_bar':
                if ( is_category() ) :
                    $cat_obj = get_queried_object();
                ?>
                <div class="gl-zone gl-zone--filter-bar" data-zone="filter_bar">
                    <div class="gl-container">
                        <div class="gl-archive-filters">
                            <a href="<?php echo esc_url( get_category_link( $cat_obj->term_id ) ); ?>"
                               class="gl-hub-filter gl-hub-filter--active">
                                <?php esc_html_e( 'All', 'gtalobby' ); ?>
                            </a>

                            <?php foreach ( gtalobby_get_post_types() as $pt_slug ) :
                                $pt_obj = get_post_type_object( $pt_slug );
                                if ( ! $pt_obj ) continue;
                            ?>
                            <a href="<?php echo esc_url( add_query_arg( 'post_type', $pt_slug, get_category_link( $cat_obj->term_id ) ) ); ?>"
                               class="gl-hub-filter">
                                <?php echo esc_html( $pt_obj->labels->name ); ?>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php
                endif;
                break;

            /* -- Post Grid + Sidebar -------------------------------- */
            case 'post_grid':
                gtalobby_render_ad_slot( 'ad_before_content' );
                $cols = isset( $zone_cfg['columns'] ) ? (int) $zone_cfg['columns'] : 3;
            ?>
            <div class="gl-container gl-archive__layout" data-zone="post_grid">
                <main class="gl-archive__main" id="main-content">

                    <?php if ( have_posts() ) : ?>
                    <div class="gl-card-grid gl-card-grid--<?php echo esc_attr( $cols ); ?>col" data-animate>
                        <?php
                        while ( have_posts() ) :
                            the_post();
                            echo '<div class="gl-card-grid__item">';
                            gtalobby_card( 'standard' );
                            echo '</div>';
                        endwhile;
                        ?>
                    </div>

                    <?php if ( gtalobby_is_zone_enabled( 'archive', 'pagination', $category_slug ) ) : ?>
                        <?php gtalobby_pagination(); ?>
                    <?php endif; ?>

                    <?php else : ?>
                    <div class="gl-no-results">
                        <h2><?php esc_html_e( 'Nothing Found', 'gtalobby' ); ?></h2>
                        <p><?php esc_html_e( 'No content matched your criteria. Try a different search or browse our categories.', 'gtalobby' ); ?></p>
                        <?php get_search_form(); ?>
                    </div>
                    <?php endif; ?>

                </main>

                <aside class="gl-archive__sidebar" role="complementary">
                    <?php get_sidebar(); ?>
                </aside>
            </div>
            <?php
                break;

            /* -- Pagination (handled inside post_grid) -------------- */
            case 'pagination':
                break;

        endswitch;
    endforeach;
    ?>

</div>

<?php get_footer(); ?>
