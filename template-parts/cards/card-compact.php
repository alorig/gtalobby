<?php
/**
 * Card Template — Compact
 *
 * Smaller card for related posts, sidebar widgets, and dense grids.
 *
 * @package GtaLobby
 */

$post_type = get_post_type();
$cat       = gtalobby_get_primary_category();
$cat_color = $cat ? gtalobby_get_category_color( $cat->slug ) : '';
?>
<article <?php post_class( 'gl-card gl-card--compact gl-card--' . esc_attr( $post_type ) ); ?> style="<?php echo $cat_color ? '--cat-accent:' . esc_attr( $cat_color ) : ''; ?>">

    <div class="gl-card__image gl-card__image--compact">
        <a href="<?php the_permalink(); ?>">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'gl-thumb', array( 'class' => 'gl-card__img', 'loading' => 'lazy' ) ); ?>
            <?php else : ?>
                <?php gtalobby_stock_image( $cat ? $cat->slug : 'gta6', 'thumb', 'gl-card__img' ); ?>
            <?php endif; ?>
        </a>
    </div>

    <div class="gl-card__body">
        <h3 class="gl-card__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <div class="gl-card__footer">
            <?php gtalobby_post_meta( array(
                'show_type'         => true,
                'show_category'     => false,
                'show_author'       => false,
                'show_reading_time' => false,
            ) ); ?>
        </div>
    </div>
</article>
