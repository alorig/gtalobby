<?php
/**
 * Card Template — Profile (Standard)
 *
 * Character profile card with avatar-style layout.
 *
 * @package GtaLobby
 */

$cat_color  = gtalobby_get_category_color( 'characters' );
$game_title = get_the_terms( get_the_ID(), 'game_title' );
$game_label = ( $game_title && ! is_wp_error( $game_title ) ) ? $game_title[0]->name : '';
?>
<article <?php post_class( 'gl-card gl-card--standard gl-card--profile' ); ?> style="--cat-accent: <?php echo esc_attr( $cat_color ); ?>">

    <div class="gl-card__image gl-card__image--profile">
        <a href="<?php the_permalink(); ?>">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'gl-card-square', array( 'class' => 'gl-card__img', 'loading' => 'lazy' ) ); ?>
            <?php else : ?>
                <?php gtalobby_stock_image( 'characters', 'square', 'gl-card__img' ); ?>
            <?php endif; ?>
        </a>
        <?php gtalobby_post_type_badge( null, false ); ?>
    </div>

    <div class="gl-card__body">
        <h3 class="gl-card__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <?php if ( $game_label ) : ?>
        <span class="gl-card__subtitle"><?php echo esc_html( $game_label ); ?></span>
        <?php endif; ?>

        <p class="gl-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 12 ) ); ?></p>
    </div>
</article>
