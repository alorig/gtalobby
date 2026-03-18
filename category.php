<?php
/**
 * Category Archive Template — Premium Design
 *
 * Cinematic hero header, featured post, filter bar,
 * masonry content grid. Each of the 9 SAG categories
 * gets a unique visual identity.
 *
 * @package GtaLobby
 */

get_header();

$category       = get_queried_object();
$category_slug  = $category->slug ?? '';
$category_color = gtalobby_get_category_color( $category_slug );
$category_icon  = gtalobby_get_category_icon( $category_slug );
$archive_zones  = gtalobby_get_layout( 'archive', $category_slug );

/* Category hero images */
$cat_hero_images = array(
    'gta6'       => 'https://images.pexels.com/photos/31002084/pexels-photo-31002084.jpeg?auto=compress&cs=tinysrgb&w=1600&h=600&dpr=1',
    'cheats'     => 'https://images.pexels.com/photos/5380642/pexels-photo-5380642.jpeg?auto=compress&cs=tinysrgb&w=1600&h=600&dpr=1',
    'online'     => 'https://images.pexels.com/photos/30469967/pexels-photo-30469967.jpeg?auto=compress&cs=tinysrgb&w=1600&h=600&dpr=1',
    'mods'       => 'https://images.pexels.com/photos/7915357/pexels-photo-7915357.jpeg?auto=compress&cs=tinysrgb&w=1600&h=600&dpr=1',
    'cars'       => 'https://images.pexels.com/photos/5880077/pexels-photo-5880077.jpeg?auto=compress&cs=tinysrgb&w=1600&h=600&dpr=1',
    'characters' => 'https://images.pexels.com/photos/2773521/pexels-photo-2773521.jpeg?auto=compress&cs=tinysrgb&w=1600&h=600&dpr=1',
    'locations'  => 'https://images.pexels.com/photos/2706750/pexels-photo-2706750.jpeg?auto=compress&cs=tinysrgb&w=1600&h=600&dpr=1',
    'money'      => 'https://images.pexels.com/photos/4386431/pexels-photo-4386431.jpeg?auto=compress&cs=tinysrgb&w=1600&h=600&dpr=1',
    'news'       => 'https://images.pexels.com/photos/3944454/pexels-photo-3944454.jpeg?auto=compress&cs=tinysrgb&w=1600&h=600&dpr=1',
);
$hero_img = isset( $cat_hero_images[ $category_slug ] ) ? $cat_hero_images[ $category_slug ] : '';

/* Category descriptions */
$cat_descriptions = array(
    'gta6'       => 'Everything confirmed, leaked, and rumored about the next Grand Theft Auto.',
    'cheats'     => 'Every cheat code for every platform — button combos, phone numbers, and console commands.',
    'online'     => 'Money guides, weekly updates, heists, businesses, and GTA Online strategies.',
    'mods'       => 'Best mods, installation guides, and visual overhauls for GTA 5 on PC.',
    'cars'       => 'Vehicle stats, top speed rankings, lap times, and the best cars to buy.',
    'characters' => 'Character profiles, voice actors, backstories, and story analysis.',
    'locations'  => 'Map guides, hidden locations, collectibles, and secret spots.',
    'money'      => 'Business guides, passive income setups, and money-making strategies.',
    'news'       => 'Latest news, patch notes, DLC announcements, and community updates.',
);
$cat_desc = category_description() ?: ( isset( $cat_descriptions[ $category_slug ] ) ? $cat_descriptions[ $category_slug ] : '' );
?>

<div class="gl-archive gl-archive--category gl-category-<?php echo esc_attr( $category_slug ); ?>" style="--cat-accent: <?php echo esc_attr( $category_color ); ?>">

    <?php
    foreach ( $archive_zones as $zone_id => $zone_cfg ) :
        if ( ! gtalobby_is_zone_enabled( 'archive', $zone_id, $category_slug ) ) {
            continue;
        }

        switch ( $zone_id ) :

            /* ==========================================================
               CATEGORY HERO HEADER
               ========================================================== */
            case 'archive_header':
            ?>
            <section class="gl-cat-hero" data-zone="archive_header" data-animate="blur">
                <?php if ( $hero_img ) : ?>
                <div class="gl-cat-hero__bg" style="background-image: url('<?php echo esc_url( $hero_img ); ?>')"></div>
                <?php endif; ?>
                <div class="gl-cat-hero__overlay"></div>

                <!-- Decorative accent glow -->
                <div class="gl-cat-hero__glow"></div>

                <div class="gl-container gl-cat-hero__inner">
                    <div class="gl-cat-hero__icon">
                        <?php gtalobby_icon( $category_icon, 36 ); ?>
                    </div>

                    <h1 class="gl-cat-hero__title" data-animate="fade-up" data-delay="200"><?php single_cat_title(); ?></h1>

                    <?php if ( $cat_desc ) : ?>
                    <p class="gl-cat-hero__desc"><?php echo wp_kses_post( $cat_desc ); ?></p>
                    <?php endif; ?>

                    <div class="gl-cat-hero__meta" data-animate="fade-up" data-delay="400">
                        <span class="gl-cat-hero__count">
                            <?php printf( esc_html( _n( '%s article', '%s articles', $category->count, 'gtalobby' ) ), '<strong>' . number_format_i18n( $category->count ) . '</strong>' ); ?>
                        </span>
                        <span class="gl-cat-hero__divider">&middot;</span>
                        <span class="gl-cat-hero__updated"><?php esc_html_e( 'Updated regularly', 'gtalobby' ); ?></span>
                    </div>
                </div>

                <!-- Bottom accent strip -->
                <div class="gl-cat-hero__strip"></div>
            </section>
            <?php
                break;

            /* ==========================================================
               PINNED HUBS
               ========================================================== */
            case 'pinned_hubs':
                $hub_pages = get_pages( array(
                    'meta_key'    => 'hub_sector',
                    'meta_value'  => $category_slug,
                    'sort_order'  => 'ASC',
                    'sort_column' => 'menu_order,post_title',
                ) );

                if ( empty( $hub_pages ) ) {
                    $hub_pages = get_pages( array(
                        'meta_key'   => '_wp_page_template',
                        'meta_value' => 'page-hub.php',
                    ) );
                    $hub_pages = array_filter( $hub_pages, function( $page ) use ( $category_slug ) {
                        return get_post_meta( $page->ID, 'hub_sector', true ) === $category_slug;
                    } );
                }

                if ( ! empty( $hub_pages ) ) :
            ?>
            <section class="gl-zone gl-cat-hubs" data-zone="pinned_hubs" data-animate="fade-scale">
                <div class="gl-container">
                    <div class="gl-cat-hubs__header">
                        <h2 class="gl-cat-hubs__title">
                            <?php gtalobby_icon( 'grid', 20 ); ?>
                            <?php esc_html_e( 'Topic Hubs', 'gtalobby' ); ?>
                        </h2>
                    </div>

                    <div class="gl-cat-hubs__grid">
                        <?php foreach ( $hub_pages as $hub ) :
                            $cluster = get_post_meta( $hub->ID, 'hub_cluster_name', true );
                            $hub_children = get_post_meta( $hub->ID, 'hub_child_posts', true );
                            $child_count  = is_array( $hub_children ) ? count( $hub_children ) : 0;
                        ?>
                        <a href="<?php echo esc_url( get_permalink( $hub->ID ) ); ?>" class="gl-cat-hub-card">
                            <div class="gl-cat-hub-card__accent"></div>
                            <div class="gl-cat-hub-card__body">
                                <div class="gl-cat-hub-card__icon">
                                    <?php gtalobby_icon( $category_icon, 20 ); ?>
                                </div>
                                <div>
                                    <h3 class="gl-cat-hub-card__title"><?php echo esc_html( $hub->post_title ); ?></h3>
                                    <?php if ( $cluster ) : ?>
                                    <span class="gl-cat-hub-card__cluster"><?php echo esc_html( $cluster ); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if ( $child_count ) : ?>
                            <span class="gl-cat-hub-card__count"><?php echo esc_html( $child_count ); ?> <?php esc_html_e( 'articles', 'gtalobby' ); ?></span>
                            <?php endif; ?>
                            <span class="gl-cat-hub-card__arrow">&rarr;</span>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <?php
                endif;
                break;

            /* ==========================================================
               FILTER BAR
               ========================================================== */
            case 'filter_bar':
                $current_pt = isset( $_GET['post_type'] ) ? sanitize_key( $_GET['post_type'] ) : '';
            ?>
            <div class="gl-cat-filters" data-zone="filter_bar" data-animate="fade-down">
                <div class="gl-container">
                    <div class="gl-cat-filters__bar">
                        <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>"
                           class="gl-cat-filter <?php echo empty( $current_pt ) ? 'gl-cat-filter--active' : ''; ?>">
                            <?php esc_html_e( 'All Content', 'gtalobby' ); ?>
                        </a>

                        <?php foreach ( gtalobby_get_post_types() as $pt_slug ) :
                            $pt_obj = get_post_type_object( $pt_slug );
                            if ( ! $pt_obj ) continue;
                        ?>
                        <a href="<?php echo esc_url( add_query_arg( 'post_type', $pt_slug, get_category_link( $category->term_id ) ) ); ?>"
                           class="gl-cat-filter <?php echo ( $current_pt === $pt_slug ) ? 'gl-cat-filter--active' : ''; ?>">
                            <?php echo esc_html( $pt_obj->labels->name ); ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php
                break;

            /* ==========================================================
               FEATURED POST + POST GRID
               ========================================================== */
            case 'post_grid':
                gtalobby_render_ad_slot( 'ad_before_content' );
            ?>
            <div class="gl-cat-content" data-zone="post_grid" data-animate="fade-up">
                <div class="gl-container">

                    <?php if ( have_posts() ) : ?>

                        <?php
                        /* First post = featured card */
                        if ( ! is_paged() ) :
                            the_post();
                        ?>
                        <article class="gl-cat-featured" data-animate="fade-scale">
                            <div class="gl-cat-featured__image">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'gl-feature', array( 'class' => 'gl-cat-featured__img' ) ); ?>
                                <?php else : ?>
                                    <div class="gl-cat-featured__placeholder">
                                        <?php gtalobby_icon( $category_icon, 56 ); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="gl-cat-featured__overlay"></div>
                                <div class="gl-cat-featured__content">
                                    <div class="gl-cat-featured__badges">
                                        <?php gtalobby_post_type_badge(); ?>
                                        <span class="gl-cat-featured__label"><?php esc_html_e( 'Featured', 'gtalobby' ); ?></span>
                                    </div>
                                    <h2 class="gl-cat-featured__title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                    <p class="gl-cat-featured__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 28 ) ); ?></p>
                                    <div class="gl-cat-featured__meta">
                                        <span><?php echo esc_html( get_the_date() ); ?></span>
                                        <a href="<?php the_permalink(); ?>" class="gl-cat-featured__read"><?php esc_html_e( 'Read Article', 'gtalobby' ); ?> &rarr;</a>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <?php endif; ?>

                        <?php if ( have_posts() ) : ?>
                        <div class="gl-cat-grid" data-animate="fade-up" data-delay="200">
                            <?php
                            $post_index = 0;
                            while ( have_posts() ) :
                                the_post();
                                $post_index++;
                            ?>
                            <article class="gl-cat-card">
                                <div class="gl-cat-card__image">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail( 'gl-card', array( 'class' => 'gl-cat-card__img' ) ); ?>
                                        </a>
                                    <?php else : ?>
                                        <a href="<?php the_permalink(); ?>" class="gl-cat-card__placeholder">
                                            <?php gtalobby_icon( $category_icon, 28 ); ?>
                                        </a>
                                    <?php endif; ?>
                                    <?php gtalobby_post_type_badge( null, false ); ?>
                                </div>
                                <div class="gl-cat-card__body">
                                    <span class="gl-cat-card__date"><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></span>
                                    <h3 class="gl-cat-card__title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                    <p class="gl-cat-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 16 ) ); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="gl-cat-card__link"><?php esc_html_e( 'Read More', 'gtalobby' ); ?> &rarr;</a>
                                </div>
                            </article>
                            <?php endwhile; ?>
                        </div>
                        <?php endif; ?>

                        <?php if ( gtalobby_is_zone_enabled( 'archive', 'pagination', $category_slug ) ) : ?>
                            <?php gtalobby_pagination(); ?>
                        <?php endif; ?>

                    <?php else : ?>
                    <div class="gl-cat-empty" data-animate="fade-up">
                        <div class="gl-cat-empty__icon"><?php gtalobby_icon( $category_icon, 48 ); ?></div>
                        <h2><?php esc_html_e( 'No Articles Yet', 'gtalobby' ); ?></h2>
                        <p><?php printf( esc_html__( 'Content for %s is coming soon. Check back later!', 'gtalobby' ), '<strong>' . esc_html( single_cat_title( '', false ) ) . '</strong>' ); ?></p>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
            <?php
                break;

            case 'pagination':
                break;

        endswitch;
    endforeach;
    ?>

</div>

<?php get_footer(); ?>
