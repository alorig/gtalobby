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
$sag_images = array(
    'gta6'       => 'https://images.unsplash.com/photo-1514565131-fce0801e5785?w=600&h=400&fit=crop&q=80',
    'cheats'     => 'https://images.unsplash.com/photo-1600861194942-f883de0dfe96?w=600&h=400&fit=crop&q=80',
    'online'     => 'https://images.unsplash.com/photo-1511882150382-421056c89033?w=600&h=400&fit=crop&q=80',
    'mods'       => 'https://images.unsplash.com/photo-1593305841991-05c297ba4575?w=600&h=400&fit=crop&q=80',
    'cars'       => 'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?w=600&h=400&fit=crop&q=80',
    'characters' => 'https://images.unsplash.com/photo-1559386484-97dfc0e15539?w=600&h=400&fit=crop&q=80',
    'locations'  => 'https://images.unsplash.com/photo-1480714378408-67cf0d13bc1b?w=600&h=400&fit=crop&q=80',
    'money'      => 'https://images.unsplash.com/photo-1526304640581-d334cdbbf45e?w=600&h=400&fit=crop&q=80',
    'news'       => 'https://images.unsplash.com/photo-1504711434969-e33886168d5c?w=600&h=400&fit=crop&q=80',
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
                $online_cat = get_category_by_slug( 'online' );
                $cheats_cat = get_category_by_slug( 'cheats' );
                $mods_cat   = get_category_by_slug( 'mods' );
            ?>
            <section class="gl-hero-accordion" data-zone="hero" data-animate="blur">
                <div class="gl-hero-accordion__panels">

                    <!-- Panel 1 — GTA 6 (Cyber Cyan) -->
                    <div class="gl-hero-panel" data-panel="1">
                        <div class="gl-hero-panel__color" style="background: #27D9FF"></div>
                        <div class="gl-hero-panel__image" style="background-image: url('https://images.unsplash.com/photo-1514565131-fce0801e5785?w=1600&h=1000&fit=crop&q=80')"></div>
                        <span class="gl-hero-panel__num">01</span>
                        <span class="gl-hero-panel__label"><?php esc_html_e( 'GTA 6', 'gtalobby' ); ?></span>
                        <div class="gl-hero-panel__content">
                            <div class="gl-hero-panel__expanded">
                                <span class="gl-hero-panel__overline"><?php esc_html_e( 'Coming Soon', 'gtalobby' ); ?></span>
                                <h2 class="gl-hero-panel__title">GTA 6<br><?php esc_html_e( 'Coverage', 'gtalobby' ); ?></h2>
                                <p class="gl-hero-panel__desc"><?php esc_html_e( 'Everything confirmed, leaked, and rumored about the next Grand Theft Auto. Trailers, map leaks, character details, and release analysis.', 'gtalobby' ); ?></p>
                                <?php if ( $gta6_cat ) : ?>
                                <a href="<?php echo esc_url( get_category_link( $gta6_cat->term_id ) ); ?>" class="gl-hero-panel__cta gl-hero-panel__cta--cyan">
                                    <?php esc_html_e( 'Explore GTA 6', 'gtalobby' ); ?>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Panel 2 — GTA Online (Neon Magenta) -->
                    <div class="gl-hero-panel" data-panel="2">
                        <div class="gl-hero-panel__color" style="background: #FF2C98"></div>
                        <div class="gl-hero-panel__image" style="background-image: url('https://images.unsplash.com/photo-1511882150382-421056c89033?w=1600&h=1000&fit=crop&q=80')"></div>
                        <span class="gl-hero-panel__num">02</span>
                        <span class="gl-hero-panel__label"><?php esc_html_e( 'Online', 'gtalobby' ); ?></span>
                        <div class="gl-hero-panel__content">
                            <div class="gl-hero-panel__expanded">
                                <span class="gl-hero-panel__overline"><?php esc_html_e( 'Multiplayer', 'gtalobby' ); ?></span>
                                <h2 class="gl-hero-panel__title">GTA<br><?php esc_html_e( 'Online', 'gtalobby' ); ?></h2>
                                <p class="gl-hero-panel__desc"><?php esc_html_e( 'Money guides, weekly updates, heist walkthroughs, business setups, and the best strategies to dominate Los Santos Online.', 'gtalobby' ); ?></p>
                                <?php if ( $online_cat ) : ?>
                                <a href="<?php echo esc_url( get_category_link( $online_cat->term_id ) ); ?>" class="gl-hero-panel__cta gl-hero-panel__cta--magenta">
                                    <?php esc_html_e( 'GTA Online Guides', 'gtalobby' ); ?>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Panel 3 — Cheats & Codes (Purple) -->
                    <div class="gl-hero-panel" data-panel="3">
                        <div class="gl-hero-panel__color" style="background: #6C5CE7"></div>
                        <div class="gl-hero-panel__image" style="background-image: url('https://images.unsplash.com/photo-1600861194942-f883de0dfe96?w=1600&h=1000&fit=crop&q=80')"></div>
                        <span class="gl-hero-panel__num">03</span>
                        <span class="gl-hero-panel__label"><?php esc_html_e( 'Cheats', 'gtalobby' ); ?></span>
                        <div class="gl-hero-panel__content">
                            <div class="gl-hero-panel__expanded">
                                <span class="gl-hero-panel__overline"><?php esc_html_e( 'All Platforms', 'gtalobby' ); ?></span>
                                <h2 class="gl-hero-panel__title"><?php esc_html_e( 'Cheats', 'gtalobby' ); ?><br>&amp; <?php esc_html_e( 'Codes', 'gtalobby' ); ?></h2>
                                <p class="gl-hero-panel__desc"><?php esc_html_e( 'Every cheat code for every platform — button combos, phone numbers, console commands, and secret unlocks across all GTA titles.', 'gtalobby' ); ?></p>
                                <?php if ( $cheats_cat ) : ?>
                                <a href="<?php echo esc_url( get_category_link( $cheats_cat->term_id ) ); ?>" class="gl-hero-panel__cta gl-hero-panel__cta--purple">
                                    <?php esc_html_e( 'Browse Cheats', 'gtalobby' ); ?>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Panel 4 — Mods (Dark Vice) -->
                    <div class="gl-hero-panel" data-panel="4">
                        <div class="gl-hero-panel__color" style="background: #0f1328"></div>
                        <div class="gl-hero-panel__image" style="background-image: url('https://images.unsplash.com/photo-1593305841991-05c297ba4575?w=1600&h=1000&fit=crop&q=80')"></div>
                        <span class="gl-hero-panel__num">04</span>
                        <span class="gl-hero-panel__label"><?php esc_html_e( 'Mods', 'gtalobby' ); ?></span>
                        <div class="gl-hero-panel__content">
                            <div class="gl-hero-panel__expanded">
                                <span class="gl-hero-panel__overline"><?php esc_html_e( 'PC Gaming', 'gtalobby' ); ?></span>
                                <h2 class="gl-hero-panel__title"><?php esc_html_e( 'Mods', 'gtalobby' ); ?><br>&amp; <?php esc_html_e( 'Overhauls', 'gtalobby' ); ?></h2>
                                <p class="gl-hero-panel__desc"><?php esc_html_e( 'Best mods, installation guides, and visual overhauls for GTA 5 on PC. Transform Los Santos with stunning graphics and gameplay mods.', 'gtalobby' ); ?></p>
                                <?php if ( $mods_cat ) : ?>
                                <a href="<?php echo esc_url( get_category_link( $mods_cat->term_id ) ); ?>" class="gl-hero-panel__cta gl-hero-panel__cta--dark">
                                    <?php esc_html_e( 'Explore Mods', 'gtalobby' ); ?>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Theme color strip -->
                <div class="gl-hero-accordion__strip">
                    <span style="background: #27D9FF"></span>
                    <span style="background: #FF2C98"></span>
                    <span style="background: #6C5CE7"></span>
                    <span style="background: #0f1328"></span>
                </div>
            </section>
            <?php
                break;

            /* ============================================================
               STATS BAR (between hero & categories)
               ============================================================ */
            case 'stats_bar':
                $total_posts = wp_count_posts();
                $published   = $total_posts->publish ?? 0;
                foreach ( gtalobby_get_post_types() as $cpt ) {
                    $cpt_count = wp_count_posts( $cpt );
                    $published += $cpt_count->publish ?? 0;
                }
                $total_cats  = count( $sag_categories );
                $total_hubs  = (int) ( new WP_Query( array(
                    'post_type' => 'page', 'posts_per_page' => -1,
                    'post_status' => 'publish', 'meta_key' => '_wp_page_template',
                    'meta_value' => 'page-hub.php', 'fields' => 'ids',
                ) ) )->found_posts;
            ?>
            <div class="gl-stats-bar" data-animate="fade-scale">
                <div class="gl-stats-bar__glow" aria-hidden="true"></div>
                <div class="gl-container">
                    <div class="gl-stats-bar__inner">
                        <div class="gl-stats-bar__item">
                            <span class="gl-stats-bar__num" data-count="<?php echo esc_attr( $published ); ?>"><?php echo esc_html( $published ); ?></span>
                            <span class="gl-stats-bar__label"><?php esc_html_e( 'Articles', 'gtalobby' ); ?></span>
                        </div>
                        <div class="gl-stats-bar__item">
                            <span class="gl-stats-bar__num" data-count="<?php echo esc_attr( $total_cats ); ?>"><?php echo esc_html( $total_cats ); ?></span>
                            <span class="gl-stats-bar__label"><?php esc_html_e( 'Categories', 'gtalobby' ); ?></span>
                        </div>
                        <div class="gl-stats-bar__item">
                            <span class="gl-stats-bar__num" data-count="<?php echo esc_attr( $total_hubs ); ?>"><?php echo esc_html( $total_hubs ); ?></span>
                            <span class="gl-stats-bar__label"><?php esc_html_e( 'Topic Hubs', 'gtalobby' ); ?></span>
                        </div>
                        <div class="gl-stats-bar__item">
                            <span class="gl-stats-bar__num" data-count="7">7</span>
                            <span class="gl-stats-bar__label"><?php esc_html_e( 'Post Types', 'gtalobby' ); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                break;

            /* ============================================================
               CATEGORY GRID
               ============================================================ */
            case 'category_grid':
            ?>
            <section class="gl-zone gl-home-categories" data-zone="category_grid" data-animate="fade-up">
                <div class="gl-container">
                    <div class="gl-home-categories__header">
                        <h2 class="gl-zone__title"><?php esc_html_e( 'Explore by Category', 'gtalobby' ); ?></h2>
                        <p class="gl-zone__subtitle"><?php esc_html_e( '9 content silos covering every aspect of the GTA universe', 'gtalobby' ); ?></p>
                    </div>
                    <div class="gl-category-grid" data-animate="fade-up" data-delay="200">
                        <?php foreach ( $sag_categories as $slug => $cat_name ) :
                            $cat_obj = get_category_by_slug( $slug );
                            if ( ! $cat_obj ) continue;
                            $color    = gtalobby_get_category_color( $slug );
                            $icon     = gtalobby_get_category_icon( $slug );
                            $desc     = isset( $sag_descriptions[ $slug ] ) ? $sag_descriptions[ $slug ] : '';
                            $cat_img  = isset( $sag_images[ $slug ] ) ? $sag_images[ $slug ] : '';
                        ?>
                        <a href="<?php echo esc_url( get_category_link( $cat_obj->term_id ) ); ?>" class="gl-category-tile" style="--cat-accent: <?php echo esc_attr( $color ); ?>">
                            <?php if ( $cat_img ) : ?>
                            <div class="gl-category-tile__image" style="background-image: url('<?php echo esc_url( $cat_img ); ?>')"></div>
                            <?php endif; ?>
                            <div class="gl-category-tile__overlay"></div>
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
               GTA 6 SPOTLIGHT — Cinematic Layout
               ============================================================ */
            case 'gta6_spotlight':
                if ( ! gtalobby_is_enabled( 'enable_gta6_mode' ) ) break;

                $gta6_count = isset( $zone_cfg['count'] ) ? (int) $zone_cfg['count'] : 5;
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
            ?>
            <section class="gl-zone gl-home-gta6" data-zone="gta6_spotlight" data-animate="clip-left">
                <!-- Decorative background -->
                <div class="gl-home-gta6__bg">
                    <div class="gl-home-gta6__bg-glow"></div>
                </div>

                <div class="gl-container">
                    <div class="gl-home-gta6__header">
                        <div class="gl-home-gta6__header-left">
                            <span class="gl-home-gta6__badge"><?php esc_html_e( 'Exclusive Coverage', 'gtalobby' ); ?></span>
                            <h2 class="gl-home-gta6__heading">GTA 6 <span><?php esc_html_e( 'Coverage', 'gtalobby' ); ?></span></h2>
                            <p class="gl-home-gta6__tagline"><?php esc_html_e( 'The latest confirmed details, leaks, and analysis from Vice City', 'gtalobby' ); ?></p>
                        </div>
                        <?php if ( $gta6_cat ) : ?>
                        <a href="<?php echo esc_url( get_category_link( $gta6_cat->term_id ) ); ?>" class="gl-home-gta6__cta">
                            <?php esc_html_e( 'All GTA 6 Articles', 'gtalobby' ); ?>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </a>
                        <?php endif; ?>
                    </div>

                    <?php if ( $gta6_query->have_posts() ) : ?>
                    <div class="gl-home-gta6__layout">
                        <?php
                        $gta6_i = 0;
                        while ( $gta6_query->have_posts() ) :
                            $gta6_query->the_post();
                            $gta6_i++;

                            if ( $gta6_i === 1 ) :
                        ?>
                        <!-- Hero featured article -->
                        <article class="gl-gta6-hero-card">
                            <div class="gl-gta6-hero-card__image">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'gl-feature', array( 'class' => 'gl-gta6-hero-card__img' ) ); ?>
                                <?php else : ?>
                                    <div class="gl-gta6-hero-card__placeholder">
                                        <?php gtalobby_icon( 'gamepad', 64 ); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="gl-gta6-hero-card__overlay"></div>
                                <div class="gl-gta6-hero-card__content">
                                    <?php gtalobby_post_type_badge(); ?>
                                    <h3 class="gl-gta6-hero-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <p class="gl-gta6-hero-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 25 ) ); ?></p>
                                    <div class="gl-gta6-hero-card__meta">
                                        <span><?php echo esc_html( get_the_date() ); ?></span>
                                        <a href="<?php the_permalink(); ?>" class="gl-gta6-hero-card__read"><?php esc_html_e( 'Read Article', 'gtalobby' ); ?> &rarr;</a>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <!-- Secondary articles grid -->
                        <div class="gl-gta6-side">
                        <?php else : ?>
                            <article class="gl-gta6-card">
                                <span class="gl-gta6-card__num"><?php echo esc_html( str_pad( $gta6_i, 2, '0', STR_PAD_LEFT ) ); ?></span>
                                <div class="gl-gta6-card__body">
                                    <?php gtalobby_post_type_badge(); ?>
                                    <h4 class="gl-gta6-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                    <p class="gl-gta6-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 10 ) ); ?></p>
                                    <span class="gl-gta6-card__date"><?php echo esc_html( get_the_date( 'M j' ) ); ?></span>
                                </div>
                            </article>
                        <?php
                            endif;
                        endwhile;
                        if ( $gta6_i > 1 ) echo '</div>';
                        wp_reset_postdata();
                        ?>
                    </div>
                    <?php else : ?>
                    <div class="gl-home-gta6__empty">
                        <div class="gl-home-gta6__empty-icon"><?php gtalobby_icon( 'gamepad', 48 ); ?></div>
                        <h3><?php esc_html_e( 'GTA 6 Coverage Coming Soon', 'gtalobby' ); ?></h3>
                        <p><?php esc_html_e( 'We\'re preparing in-depth analysis, leaks coverage, and everything you need to know about the next Grand Theft Auto.', 'gtalobby' ); ?></p>
                    </div>
                    <?php endif; ?>
                </div>
            </section>
            <?php
                break;

            /* ============================================================
               FEATURED HUBS — Magazine Masonry
               ============================================================ */
            case 'featured_hubs':
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
            ?>
            <section class="gl-zone gl-home-hubs" data-zone="featured_hubs" data-animate="fade-up">
                <div class="gl-container">
                    <div class="gl-home-hubs__header">
                        <div>
                            <h2 class="gl-zone__title"><?php esc_html_e( 'Topic Hubs', 'gtalobby' ); ?></h2>
                            <p class="gl-zone__subtitle"><?php esc_html_e( 'Deep-dive landing pages covering entire keyword clusters', 'gtalobby' ); ?></p>
                        </div>
                    </div>

                    <?php if ( $hubs_query->have_posts() ) : ?>
                    <div class="gl-hubs-masonry" data-animate="zoom" data-delay="200">
                        <?php
                        $hub_i = 0;
                        while ( $hubs_query->have_posts() ) :
                            $hubs_query->the_post();
                            $hub_i++;
                            $hub_sector   = get_post_meta( get_the_ID(), 'hub_sector', true );
                            $hub_color    = gtalobby_get_category_color( $hub_sector );
                            $hub_cn       = get_post_meta( get_the_ID(), 'hub_cluster_name', true );
                            $hub_icon     = gtalobby_get_category_icon( $hub_sector );
                            $hub_children = get_post_meta( get_the_ID(), 'hub_child_posts', true );
                            $child_count  = is_array( $hub_children ) ? count( $hub_children ) : 0;
                            $is_featured  = ( $hub_i === 1 );
                        ?>
                        <a href="<?php the_permalink(); ?>"
                           class="gl-hub-tile <?php echo $is_featured ? 'gl-hub-tile--featured' : ''; ?>"
                           style="--hub-accent: <?php echo esc_attr( $hub_color ); ?>">
                            <div class="gl-hub-tile__accent"></div>
                            <div class="gl-hub-tile__inner">
                                <div class="gl-hub-tile__icon">
                                    <?php gtalobby_icon( $hub_icon, $is_featured ? 32 : 24 ); ?>
                                </div>
                                <div class="gl-hub-tile__top">
                                    <span class="gl-hub-tile__cluster"><?php echo esc_html( $hub_cn ); ?></span>
                                    <?php if ( $child_count > 0 ) : ?>
                                    <span class="gl-hub-tile__count"><?php echo esc_html( $child_count ); ?> <?php esc_html_e( 'articles', 'gtalobby' ); ?></span>
                                    <?php endif; ?>
                                </div>
                                <h3 class="gl-hub-tile__title"><?php the_title(); ?></h3>
                                <p class="gl-hub-tile__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), $is_featured ? 24 : 14 ) ); ?></p>
                                <span class="gl-hub-tile__link">
                                    <?php esc_html_e( 'Explore Hub', 'gtalobby' ); ?>
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                                </span>
                            </div>
                        </a>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        ?>
                    </div>
                    <?php endif; ?>
                </div>
            </section>
            <?php
                break;

            /* ============================================================
               LATEST CONTENT — Tabbed Category Layout
               ============================================================ */
            case 'latest_posts':
                $latest_cats = array_slice( array_keys( $sag_categories ), 0, 5 );
            ?>
            <section class="gl-zone gl-home-latest" data-zone="latest_posts" data-animate="slide-left">
                <div class="gl-container">
                    <div class="gl-home-latest__top">
                        <h2 class="gl-zone__title"><?php esc_html_e( 'Latest Content', 'gtalobby' ); ?></h2>

                        <!-- Category tabs -->
                        <div class="gl-latest-tabs" role="tablist">
                            <?php
                            $tab_i = 0;
                            foreach ( $latest_cats as $cat_slug ) :
                                $tab_cat = get_category_by_slug( $cat_slug );
                                if ( ! $tab_cat ) continue;
                                $tab_color = gtalobby_get_category_color( $cat_slug );
                                $tab_i++;
                            ?>
                            <button class="gl-latest-tab <?php echo $tab_i === 1 ? 'gl-latest-tab--active' : ''; ?>"
                                    role="tab"
                                    data-tab="<?php echo esc_attr( $cat_slug ); ?>"
                                    aria-selected="<?php echo $tab_i === 1 ? 'true' : 'false'; ?>"
                                    style="--tab-accent: <?php echo esc_attr( $tab_color ); ?>">
                                <?php echo esc_html( $tab_cat->name ); ?>
                            </button>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Tab panels -->
                    <?php
                    $panel_i = 0;
                    foreach ( $latest_cats as $cat_slug ) :
                        $cat_obj = get_category_by_slug( $cat_slug );
                        if ( ! $cat_obj ) continue;
                        $cat_color = gtalobby_get_category_color( $cat_slug );
                        $cat_icon  = gtalobby_get_category_icon( $cat_slug );
                        $panel_i++;

                        $cat_query = new WP_Query( array(
                            'cat'            => $cat_obj->term_id,
                            'posts_per_page' => 4,
                            'post_status'    => 'publish',
                            'post_type'      => array_merge( array( 'post' ), gtalobby_get_post_types() ),
                        ) );

                        if ( ! $cat_query->have_posts() ) {
                            wp_reset_postdata();
                            continue;
                        }
                    ?>
                    <div class="gl-latest-panel <?php echo $panel_i === 1 ? 'gl-latest-panel--active' : ''; ?>"
                         data-panel="<?php echo esc_attr( $cat_slug ); ?>"
                         role="tabpanel"
                         style="--cat-accent: <?php echo esc_attr( $cat_color ); ?>">

                        <div class="gl-latest-panel__grid">
                            <?php
                            $post_i = 0;
                            while ( $cat_query->have_posts() ) :
                                $cat_query->the_post();
                                $post_i++;

                                if ( $post_i === 1 ) :
                            ?>
                            <!-- Featured first post -->
                            <article class="gl-latest-featured">
                                <div class="gl-latest-featured__image">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <?php the_post_thumbnail( 'gl-feature', array( 'class' => 'gl-latest-featured__img' ) ); ?>
                                    <?php else : ?>
                                        <div class="gl-latest-featured__placeholder" style="--cat-accent: <?php echo esc_attr( $cat_color ); ?>">
                                            <?php gtalobby_icon( $cat_icon, 48 ); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="gl-latest-featured__overlay"></div>
                                    <div class="gl-latest-featured__content">
                                        <?php gtalobby_post_type_badge(); ?>
                                        <h3 class="gl-latest-featured__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <p class="gl-latest-featured__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?></p>
                                        <div class="gl-latest-featured__meta">
                                            <span><?php echo esc_html( get_the_date() ); ?></span>
                                            <a href="<?php the_permalink(); ?>" class="gl-latest-featured__read"><?php esc_html_e( 'Read More', 'gtalobby' ); ?> &rarr;</a>
                                        </div>
                                    </div>
                                </div>
                            </article>

                            <!-- Side cards column -->
                            <div class="gl-latest-panel__side">
                            <?php else : ?>
                                <article class="gl-latest-side-card">
                                    <div class="gl-latest-side-card__thumb">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <?php the_post_thumbnail( 'thumbnail', array( 'class' => 'gl-latest-side-card__img' ) ); ?>
                                        <?php else : ?>
                                            <div class="gl-latest-side-card__icon" style="--cat-accent: <?php echo esc_attr( $cat_color ); ?>">
                                                <?php gtalobby_icon( $cat_icon, 20 ); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="gl-latest-side-card__body">
                                        <?php gtalobby_post_type_badge(); ?>
                                        <h4 class="gl-latest-side-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                        <span class="gl-latest-side-card__date"><?php echo esc_html( get_the_date( 'M j' ) ); ?></span>
                                    </div>
                                </article>
                            <?php
                                endif;
                            endwhile;
                            if ( $post_i > 1 ) echo '</div>'; // close side column
                            wp_reset_postdata();
                            ?>
                        </div>

                        <div class="gl-latest-panel__footer">
                            <a href="<?php echo esc_url( get_category_link( $cat_obj->term_id ) ); ?>" class="gl-latest-panel__viewall">
                                <?php printf( esc_html__( 'View All %s', 'gtalobby' ), esc_html( $cat_obj->name ) ); ?>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                            </a>
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
            case 'newsletter':
            ?>
            <section class="gl-zone gl-home-newsletter" data-zone="newsletter" data-animate="bounce">
                <div class="gl-home-newsletter__glow" aria-hidden="true"></div>
                <div class="gl-container">
                    <?php gtalobby_newsletter_form(); ?>
                </div>
            </section>
            <?php
                break;

            case 'weekly_recap':
            case 'mod_spotlight':
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
