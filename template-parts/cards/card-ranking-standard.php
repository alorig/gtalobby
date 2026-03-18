<?php
/**
 * Card Template — Ranking (Standard)
 *
 * Ranking-specific card with item count indicator.
 *
 * @package GtaLobby
 */

$cat       = gtalobby_get_primary_category();
$cat_color = $cat ? gtalobby_get_category_color( $cat->slug ) : '';
$items     = get_post_meta( get_the_ID(), 'ranked_items', true );
$count     = is_array( $items ) ? count( $items ) : 0;
?>
<article <?php post_class( 'gl-card gl-card--standard gl-card--ranking' ); ?> style="<?php echo $cat_color ? '--cat-accent:' . esc_attr( $cat_color ) : ''; ?>">

    <div class="gl-card__image">
        <a href="<?php the_permalink(); ?>">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'gl-card', array( 'class' => 'gl-card__img', 'loading' => 'lazy' ) ); ?>
            <?php else : ?>
                <?php gtalobby_stock_image( $cat ? $cat->slug : 'gta6', 'card', 'gl-card__img' ); ?>
            <?php endif; ?>
        </a>
        <?php gtalobby_post_type_badge( null, false ); ?>
        <?php if ( $count > 0 ) : ?>
        <span class="gl-card__rank-count"><?php echo esc_html( $count ); ?> <?php esc_html_e( 'items', 'gtalobby' ); ?></span>
        <?php endif; ?>
    </div>

    <div class="gl-card__body">
        <?php gtalobby_category_badge(); ?>

        <h3 class="gl-card__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <p class="gl-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>

        <div class="gl-card__footer">
            <?php gtalobby_post_meta( array(
                'show_type'     => false,
                'show_category' => false,
                'show_author'   => true,
            ) ); ?>
        </div>
    </div>
</article>
