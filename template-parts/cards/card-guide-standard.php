<?php
/**
 * Card Template — Guide (Standard)
 *
 * Guide-specific card with difficulty badge and platform icons.
 *
 * @package GtaLobby
 */

$cat       = gtalobby_get_primary_category();
$cat_color = $cat ? gtalobby_get_category_color( $cat->slug ) : '';
?>
<article <?php post_class( 'gl-card gl-card--standard gl-card--guide' ); ?> style="<?php echo $cat_color ? '--cat-accent:' . esc_attr( $cat_color ) : ''; ?>">

    <div class="gl-card__image">
        <a href="<?php the_permalink(); ?>">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'gl-card', array( 'class' => 'gl-card__img', 'loading' => 'lazy' ) ); ?>
            <?php else : ?>
                <?php gtalobby_stock_image( $cat ? $cat->slug : 'gta6', 'card', 'gl-card__img' ); ?>
            <?php endif; ?>
        </a>
        <?php gtalobby_post_type_badge( null, false ); ?>
    </div>

    <div class="gl-card__body">
        <div class="gl-card__badges">
            <?php gtalobby_category_badge(); ?>
            <?php gtalobby_difficulty_badge(); ?>
        </div>

        <h3 class="gl-card__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <p class="gl-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>

        <div class="gl-card__footer">
            <?php gtalobby_platform_icons(); ?>
            <?php gtalobby_reading_time(); ?>
        </div>
    </div>
</article>
