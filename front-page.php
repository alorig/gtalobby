<?php
/**
 * Front Page Template
 *
 * Homepage with hero section, SAG category grid,
 * GTA 6 spotlight, featured hubs, and latest posts.
 *
 * @package GtaLobby
 */

get_header();

$sag_categories = gtalobby_get_sag_categories();
?>

<div class="gl-home">

    <?php /* --- HERO SECTION --- */ ?>
    <section class="gl-zone gl-zone--hero gl-home-hero">
        <div class="gl-container">
            <div class="gl-home-hero__content">
                <h1 class="gl-home-hero__title">
                    <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
                </h1>
                <p class="gl-home-hero__tagline">
                    <?php echo esc_html( get_bloginfo( 'description' ) ); ?>
                </p>
                <form class="gl-home-hero__search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="search" name="s" class="gl-home-hero__search-input" placeholder="<?php esc_attr_e( 'Search guides, cheats, mods, vehicles...', 'gtalobby' ); ?>" value="<?php echo get_search_query(); ?>">
                    <button type="submit" class="gl-home-hero__search-btn">
                        <svg class="gl-icon" width="20" height="20"><use href="#icon-search"/></svg>
                        <span class="gl-sr-only"><?php esc_html_e( 'Search', 'gtalobby' ); ?></span>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <?php /* --- SAG CATEGORY GRID --- */ ?>
    <section class="gl-zone gl-zone--categories gl-home-categories">
        <div class="gl-container">
            <h2 class="gl-zone__title"><?php esc_html_e( 'Explore by Category', 'gtalobby' ); ?></h2>
            <div class="gl-category-grid">
                <?php foreach ( $sag_categories as $slug => $cat_data ) :
                    $cat_obj = get_category_by_slug( $slug );
                    if ( ! $cat_obj ) continue;
                    $color = gtalobby_get_category_color( $slug );
                ?>
                <a href="<?php echo esc_url( get_category_link( $cat_obj->term_id ) ); ?>" class="gl-category-tile" style="--cat-accent: <?php echo esc_attr( $color ); ?>">
                    <span class="gl-category-tile__icon"><?php echo esc_html( $cat_data['icon'] ?? '📁' ); ?></span>
                    <h3 class="gl-category-tile__name"><?php echo esc_html( $cat_obj->name ); ?></h3>
                    <span class="gl-category-tile__count"><?php echo esc_html( $cat_obj->count ); ?> <?php esc_html_e( 'articles', 'gtalobby' ); ?></span>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php /* --- GTA 6 SPOTLIGHT --- */ ?>
    <?php if ( gtalobby_is_enabled( 'enable_gta6_mode' ) ) : ?>
    <section class="gl-zone gl-zone--gta6-spotlight gl-home-gta6">
        <div class="gl-container">
            <h2 class="gl-zone__title"><?php esc_html_e( 'GTA 6 Coverage', 'gtalobby' ); ?></h2>
            <div class="gl-home-gta6__grid">
                <?php
                $gta6_query = new WP_Query( array(
                    'post_type'      => 'any',
                    'posts_per_page' => 4,
                    'post_status'    => 'publish',
                    'meta_query'     => array(
                        array(
                            'key'     => 'gta6_confidence_level',
                            'compare' => 'EXISTS',
                        ),
                    ),
                    'orderby'        => 'modified',
                    'order'          => 'DESC',
                ) );

                if ( $gta6_query->have_posts() ) :
                    $first = true;
                    while ( $gta6_query->have_posts() ) :
                        $gta6_query->the_post();
                        if ( $first ) {
                            echo '<div class="gl-home-gta6__featured">';
                            gtalobby_card( 'feature' );
                            echo '</div><div class="gl-home-gta6__list">';
                            $first = false;
                        } else {
                            gtalobby_card( 'compact' );
                        }
                    endwhile;
                    echo '</div>';
                    wp_reset_postdata();
                else :
                ?>
                <p class="gl-home-gta6__empty"><?php esc_html_e( 'GTA 6 content coming soon.', 'gtalobby' ); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php gtalobby_render_ad_slot( 'ad_homepage' ); ?>

    <?php /* --- FEATURED HUBS --- */ ?>
    <section class="gl-zone gl-zone--featured-hubs gl-home-hubs">
        <div class="gl-container">
            <h2 class="gl-zone__title"><?php esc_html_e( 'Popular Topic Hubs', 'gtalobby' ); ?></h2>
            <div class="gl-hub-grid">
                <?php
                $hubs_query = new WP_Query( array(
                    'post_type'      => 'page',
                    'posts_per_page' => 6,
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
                ?>
                <a href="<?php the_permalink(); ?>" class="gl-hub-card" style="--cat-accent: <?php echo esc_attr( $hub_color ); ?>">
                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="gl-hub-card__thumb">
                        <?php the_post_thumbnail( 'gl-card-square', array( 'class' => 'gl-hub-card__img' ) ); ?>
                    </div>
                    <?php endif; ?>
                    <div class="gl-hub-card__body">
                        <h3 class="gl-hub-card__title"><?php the_title(); ?></h3>
                        <?php
                        $cluster = get_post_meta( get_the_ID(), 'hub_cluster_name', true );
                        if ( $cluster ) :
                        ?>
                        <span class="gl-hub-card__cluster"><?php echo esc_html( $cluster ); ?></span>
                        <?php endif; ?>
                    </div>
                </a>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </section>

    <?php /* --- LATEST POSTS BY CATEGORY --- */ ?>
    <section class="gl-zone gl-zone--latest gl-home-latest">
        <div class="gl-container">
            <h2 class="gl-zone__title"><?php esc_html_e( 'Latest Content', 'gtalobby' ); ?></h2>

            <?php
            $latest_cats = array_slice( array_keys( $sag_categories ), 0, 4 );
            foreach ( $latest_cats as $cat_slug ) :
                $cat_obj = get_category_by_slug( $cat_slug );
                if ( ! $cat_obj ) continue;
            ?>
            <div class="gl-home-latest__section">
                <div class="gl-home-latest__header">
                    <h3 class="gl-home-latest__cat-title"><?php echo esc_html( $cat_obj->name ); ?></h3>
                    <a href="<?php echo esc_url( get_category_link( $cat_obj->term_id ) ); ?>" class="gl-home-latest__more">
                        <?php esc_html_e( 'View All', 'gtalobby' ); ?> →
                    </a>
                </div>
                <div class="gl-card-grid gl-card-grid--4col">
                    <?php
                    $cat_query = new WP_Query( array(
                        'cat'            => $cat_obj->term_id,
                        'posts_per_page' => 4,
                        'post_status'    => 'publish',
                        'post_type'      => array_merge( array( 'post' ), array_keys( gtalobby_get_post_types() ) ),
                    ) );
                    if ( $cat_query->have_posts() ) :
                        while ( $cat_query->have_posts() ) :
                            $cat_query->the_post();
                            gtalobby_card( 'compact' );
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </section>

</div>

<?php get_footer(); ?>
