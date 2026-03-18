<?php
/**
 * Card Template — Standard
 *
 * Default card layout used in archives and grids.
 *
 * @package GtaLobby
 */

$card_args = get_query_var( 'card_args', array() );
$post_type = get_post_type();
$cat       = gtalobby_get_primary_category();
$cat_color = $cat ? gtalobby_get_category_color( $cat->slug ) : '';
?>
<article <?php post_class( 'gl-card gl-card--standard gl-card--' . esc_attr( $post_type ) ); ?> style="<?php echo $cat_color ? '--cat-accent:' . esc_attr( $cat_color ) : ''; ?>">

    <?php if ( has_post_thumbnail() ) : ?>
    <div class="gl-card__image">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail( 'gl-card', array( 'class' => 'gl-card__img', 'loading' => 'lazy' ) ); ?>
        </a>
        <?php gtalobby_post_type_badge( null, false ); ?>
    </div>
    <?php else : ?>
    <div class="gl-card__image">
        <a href="<?php the_permalink(); ?>">
            <?php gtalobby_stock_image( $cat ? $cat->slug : 'gta6', 'card', 'gl-card__img' ); ?>
        </a>
        <?php gtalobby_post_type_badge( null, false ); ?>
    </div>
    <?php endif; ?>

    <div class="gl-card__body">
        <?php gtalobby_category_badge(); ?>

        <h3 class="gl-card__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <p class="gl-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>

        <div class="gl-card__footer">
            <?php gtalobby_post_meta( array(
                'show_type'         => false,
                'show_category'     => false,
                'show_author'       => true,
                'show_reading_time' => true,
            ) ); ?>
        </div>
    </div>
</article>
