<?php
/**
 * Front Page Template
 *
 * Homepage with GTA 6-focused hero, SAG category grid,
 * featured hubs, GTA 6 spotlight, and latest posts by category.
 * Zones rendered in admin-defined order via the Layout Engine.
 *
 * @package GtaLobby
 */

get_header();

$sag_categories = gtalobby_get_sag_categories();
$sag_descriptions = array(
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

/* Layout Engine — get sorted zones */
$home_zones = gtalobby_get_layout( 'homepage' );
$gta6_cat   = get_category_by_slug( 'gta6' );
?>

<div class="gl-home">

    <?php
    foreach ( $home_zones as $zone_id => $zone_cfg ) :
        if ( ! gtalobby_is_zone_enabled( 'homepage', $zone_id ) ) {
            continue;
        }

        switch ( $zone_id ) :

            /* ============================================================
               HERO
               ============================================================ */
            case 'hero':
            ?>
            <section class="gl-home-hero" data-zone="hero">
                <div class="gl-home-hero__bg"></div>
                <div class="gl-container">
                    <div class="gl-home-hero__inner">
                        <div class="gl-home-hero__content">
                            <span class="gl-home-hero__eyebrow"><?php esc_html_e( 'Your GTA Resource Hub', 'gtalobby' ); ?></span>
                            <h1 class="gl-home-hero__title">
                                <?php esc_html_e( 'Guides, Cheats, Mods & Everything GTA', 'gtalobby' ); ?>
                            </h1>
                            <p class="gl-home-hero__desc">
                                <?php esc_html_e( 'Covering GTA 6 anticipation, GTA Online strategies, cheat codes, vehicle rankings, mods, and more — built on 672 mapped keywords across 9 topic hubs.', 'gtalobby' ); ?>
                            </p>
                            <div class="gl-home-hero__actions">
                                <?php if ( $gta6_cat ) : ?>
                                <a href="<?php echo esc_url( get_category_link( $gta6_cat->term_id ) ); ?>" class="gl-btn gl-btn--primary gl-btn--lg">
                                    <?php esc_html_e( 'Explore GTA 6', 'gtalobby' ); ?>
                                    <svg class="gl-icon" width="16" height="16"><use href="#icon-arrow-right"/></svg>
                                </a>
                                <?php endif; ?>
                                <form class="gl-home-hero__search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                    <div class="gl-home-hero__search-field">
                                        <svg class="gl-icon" width="18" height="18"><use href="#icon-search"/></svg>
                                        <input type="search" name="s" placeholder="<?php esc_attr_e( 'Search guides, cheats, mods...', 'gtalobby' ); ?>" value="<?php echo get_search_query(); ?>">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="gl-home-hero__stats">
                            <div class="gl-home-hero__stat">
                                <span class="gl-home-hero__stat-value">9</span>
                                <span class="gl-home-hero__stat-label"><?php esc_html_e( 'Topic Hubs', 'gtalobby' ); ?></span>
                            </div>
                            <div class="gl-home-hero__stat">
                                <span class="gl-home-hero__stat-value">7</span>
                                <span class="gl-home-hero__stat-label"><?php esc_html_e( 'Content Types', 'gtalobby' ); ?></span>
                            </div>
                            <div class="gl-home-hero__stat">
                                <span class="gl-home-hero__stat-value">672</span>
                                <span class="gl-home-hero__stat-label"><?php esc_html_e( 'Keywords Mapped', 'gtalobby' ); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
                break;

            /* ============================================================
               CATEGORY GRID
               ============================================================ */
            case 'category_grid':
            ?>
            <section class="gl-zone gl-home-categories" data-zone="category_grid">
                <div class="gl-container">
                    <div class="gl-home-categories__header">
                        <h2 class="gl-zone__title"><?php esc_html_e( 'Explore by Category', 'gtalobby' ); ?></h2>
                        <p class="gl-zone__subtitle"><?php esc_html_e( '9 content silos covering every aspect of the GTA universe', 'gtalobby' ); ?></p>
                    </div>
                    <div class="gl-category-grid">
                        <?php foreach ( $sag_categories as $slug => $cat_name ) :
                            $cat_obj = get_category_by_slug( $slug );
                            if ( ! $cat_obj ) continue;
                            $color = gtalobby_get_category_color( $slug );
                            $icon  = gtalobby_get_category_icon( $slug );
                            $desc  = isset( $sag_descriptions[ $slug ] ) ? $sag_descriptions[ $slug ] : '';
                        ?>
                        <a href="<?php echo esc_url( get_category_link( $cat_obj->term_id ) ); ?>" class="gl-category-tile" style="--cat-accent: <?php echo esc_attr( $color ); ?>">
                            <div class="gl-category-tile__icon-wrap">
                                <?php gtalobby_icon( $icon, 28 ); ?>
                            </div>
                            <div class="gl-category-tile__text">
                                <h3 class="gl-category-tile__name"><?php echo esc_html( $cat_obj->name ); ?></h3>
                                <?php if ( $desc ) : ?>
                                <p class="gl-category-tile__desc"><?php echo esc_html( $desc ); ?></p>
                                <?php endif; ?>
                            </div>
                            <span class="gl-category-tile__count"><?php echo esc_html( $cat_obj->count ); ?></span>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <?php
                break;

            /* ============================================================
               GTA 6 SPOTLIGHT
               ============================================================ */
            case 'gta6_spotlight':
                if ( ! gtalobby_is_enabled( 'enable_gta6_mode' ) ) break;
            ?>
            <section class="gl-zone gl-home-gta6" data-zone="gta6_spotlight">
                <div class="gl-container">
                    <div class="gl-home-gta6__header">
                        <div>
                            <h2 class="gl-zone__title"><?php esc_html_e( 'GTA 6 Coverage', 'gtalobby' ); ?></h2>
                            <p class="gl-zone__subtitle"><?php esc_html_e( 'The latest confirmed details, leaks, and analysis', 'gtalobby' ); ?></p>
                        </div>
                        <?php if ( $gta6_cat ) : ?>
                        <a href="<?php echo esc_url( get_category_link( $gta6_cat->term_id ) ); ?>" class="gl-btn gl-btn--outline gl-btn--sm">
                            <?php esc_html_e( 'View All GTA 6', 'gtalobby' ); ?> →
                        </a>
                        <?php endif; ?>
                    </div>

                    <?php
                    $gta6_count = isset( $zone_cfg['count'] ) ? (int) $zone_cfg['count'] : 4;
                    $gta6_args = array(
                        'post_type'      => array_merge( array( 'post' ), gtalobby_get_post_types() ),
                        'posts_per_page' => $gta6_count,
                        'post_status'    => 'publish',
                        'orderby'        => 'modified',
                        'order'          => 'DESC',
                    );

                    $gta6_query = new WP_Query( array_merge( $gta6_args, array(
                        'meta_query' => array(
                            'relation' => 'OR',
                            array( 'key' => 'gta6_confidence_level', 'compare' => 'EXISTS' ),
                            array( 'key' => 'confidence_level', 'compare' => 'EXISTS' ),
                        ),
                    ) ) );

                    if ( ! $gta6_query->have_posts() && $gta6_cat ) {
                        $gta6_query = new WP_Query( array_merge( $gta6_args, array(
                            'cat' => $gta6_cat->term_id,
                        ) ) );
                    }

                    if ( $gta6_query->have_posts() ) :
                    ?>
                    <div class="gl-home-gta6__grid">
                        <?php
                        $first = true;
                        while ( $gta6_query->have_posts() ) :
                            $gta6_query->the_post();
                            if ( $first ) :
                                $first = false;
                        ?>
                        <div class="gl-home-gta6__featured">
                            <article class="gl-featured-card">
                                <?php if ( has_post_thumbnail() ) : ?>
                                <div class="gl-featured-card__thumb">
                                    <?php the_post_thumbnail( 'gl-feature', array( 'class' => 'gl-featured-card__img' ) ); ?>
                                </div>
                                <?php else : ?>
                                <div class="gl-featured-card__thumb gl-featured-card__thumb--placeholder">
                                    <div class="gl-featured-card__placeholder-icon">
                                        <?php gtalobby_icon( 'gamepad', 48 ); ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="gl-featured-card__body">
                                    <?php gtalobby_post_type_badge(); ?>
                                    <h3 class="gl-featured-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <p class="gl-featured-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 30 ) ); ?></p>
                                    <span class="gl-featured-card__meta"><?php echo esc_html( get_the_date() ); ?></span>
                                </div>
                            </article>
                        </div>
                        <div class="gl-home-gta6__sidebar-list">
                        <?php else : ?>
                            <article class="gl-mini-card">
                                <div class="gl-mini-card__body">
                                    <?php gtalobby_post_type_badge(); ?>
                                    <h4 class="gl-mini-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                    <span class="gl-mini-card__date"><?php echo esc_html( get_the_date() ); ?></span>
                                </div>
                            </article>
                        <?php
                            endif;
                        endwhile;
                        echo '</div>'; // close sidebar-list
                        wp_reset_postdata();
                        ?>
                    </div>
                    <?php else : ?>
                    <p class="gl-home-gta6__empty"><?php esc_html_e( 'GTA 6 content coming soon.', 'gtalobby' ); ?></p>
                    <?php endif; ?>
                </div>
            </section>
            <?php
                break;

            /* ============================================================
               FEATURED HUBS
               ============================================================ */
            case 'featured_hubs':
            ?>
            <section class="gl-zone gl-home-hubs" data-zone="featured_hubs">
                <div class="gl-container">
                    <div class="gl-home-hubs__header">
                        <h2 class="gl-zone__title"><?php esc_html_e( 'Topic Hubs', 'gtalobby' ); ?></h2>
                        <p class="gl-zone__subtitle"><?php esc_html_e( 'Deep-dive landing pages covering entire keyword clusters', 'gtalobby' ); ?></p>
                    </div>
                    <div class="gl-home-hubs__grid">
                        <?php
                        $hub_count = isset( $zone_cfg['count'] ) ? (int) $zone_cfg['count'] : 9;
                        $hubs_query = new WP_Query( array(
                            'post_type'      => 'page',
                            'posts_per_page' => $hub_count,
                            'post_status'    => 'publish',
                            'meta_key'       => '_wp_page_template',
                            'meta_value'     => 'page-hub.php',
                            'orderby'        => 'menu_order date',
                            'order'          => 'ASC',
                        ) );

                        if ( $hubs_query->have_posts() ) :
                            while ( $hubs_query->have_posts() ) :
                                $hubs_query->the_post();
                                $hub_sector = get_post_meta( get_the_ID(), 'hub_sector', true );
                                $hub_color  = gtalobby_get_category_color( $hub_sector );
                                $hub_kw     = get_post_meta( get_the_ID(), 'hub_primary_keyword', true );
                                $hub_cn     = get_post_meta( get_the_ID(), 'hub_cluster_name', true );
                                $hub_children = get_post_meta( get_the_ID(), 'hub_child_posts', true );
                                $child_count  = is_array( $hub_children ) ? count( $hub_children ) : 0;
                        ?>
                        <a href="<?php the_permalink(); ?>" class="gl-hub-card-v2" style="--cat-accent: <?php echo esc_attr( $hub_color ); ?>">
                            <div class="gl-hub-card-v2__top">
                                <span class="gl-hub-card-v2__sector"><?php echo esc_html( $hub_cn ); ?></span>
                                <?php if ( $child_count > 0 ) : ?>
                                <span class="gl-hub-card-v2__count"><?php echo esc_html( $child_count ); ?> <?php esc_html_e( 'articles', 'gtalobby' ); ?></span>
                                <?php endif; ?>
                            </div>
                            <h3 class="gl-hub-card-v2__title"><?php the_title(); ?></h3>
                            <p class="gl-hub-card-v2__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
                            <span class="gl-hub-card-v2__link"><?php esc_html_e( 'Explore Hub', 'gtalobby' ); ?> →</span>
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
                break;

            /* ============================================================
               LATEST CONTENT
               ============================================================ */
            case 'latest_posts':
            ?>
            <section class="gl-zone gl-home-latest" data-zone="latest_posts">
                <div class="gl-container">
                    <h2 class="gl-zone__title"><?php esc_html_e( 'Latest Content', 'gtalobby' ); ?></h2>

                    <?php
                    $latest_cats = array_slice( array_keys( $sag_categories ), 0, 4 );
                    foreach ( $latest_cats as $cat_slug ) :
                        $cat_obj = get_category_by_slug( $cat_slug );
                        if ( ! $cat_obj ) continue;
                        $cat_color = gtalobby_get_category_color( $cat_slug );

                        $cat_query = new WP_Query( array(
                            'cat'            => $cat_obj->term_id,
                            'posts_per_page' => 3,
                            'post_status'    => 'publish',
                            'post_type'      => array_merge( array( 'post' ), gtalobby_get_post_types() ),
                        ) );

                        if ( ! $cat_query->have_posts() ) {
                            wp_reset_postdata();
                            continue;
                        }
                    ?>
                    <div class="gl-home-latest__section">
                        <div class="gl-home-latest__header">
                            <h3 class="gl-home-latest__cat-title" style="--cat-accent: <?php echo esc_attr( $cat_color ); ?>">
                                <?php echo esc_html( $cat_obj->name ); ?>
                            </h3>
                            <a href="<?php echo esc_url( get_category_link( $cat_obj->term_id ) ); ?>" class="gl-home-latest__more">
                                <?php esc_html_e( 'View All', 'gtalobby' ); ?> →
                            </a>
                        </div>
                        <div class="gl-card-grid gl-card-grid--3col">
                            <?php
                            while ( $cat_query->have_posts() ) :
                                $cat_query->the_post();
                            ?>
                            <article class="gl-post-card">
                                <?php if ( has_post_thumbnail() ) : ?>
                                <div class="gl-post-card__thumb">
                                    <?php the_post_thumbnail( 'gl-card', array( 'class' => 'gl-post-card__img' ) ); ?>
                                </div>
                                <?php else : ?>
                                <div class="gl-post-card__thumb gl-post-card__thumb--placeholder" style="--cat-accent: <?php echo esc_attr( $cat_color ); ?>">
                                    <?php gtalobby_icon( gtalobby_get_category_icon( $cat_slug ), 32 ); ?>
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
                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </section>
            <?php
                break;

            /* ============================================================
               WEEKLY RECAP / MOD SPOTLIGHT / NEWSLETTER
               ============================================================ */
            case 'weekly_recap':
            case 'mod_spotlight':
            case 'newsletter':
                // Future zone implementations
                break;

        endswitch;

        // Ad slot after GTA 6 spotlight
        if ( 'gta6_spotlight' === $zone_id ) {
            gtalobby_render_ad_slot( 'ad_homepage' );
        }
    endforeach;
    ?>

</div>

<?php get_footer(); ?>
