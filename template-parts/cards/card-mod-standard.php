<?php
/**
 * Card Template — Mod (Standard)
 *
 * Mod-specific card with download/version info.
 *
 * @package GtaLobby
 */

$cat       = gtalobby_get_primary_category();
$cat_color = $cat ? gtalobby_get_category_color( $cat->slug ) : gtalobby_get_category_color( 'mods' );
$mod_ver    = get_post_meta( get_the_ID(), 'mod_version', true );
$mod_compat = get_post_meta( get_the_ID(), 'mod_compatibility', true );
?>
<article <?php post_class( 'gl-card gl-card--standard gl-card--mod' ); ?> style="--cat-accent: <?php echo esc_attr( $cat_color ); ?>">

    <?php if ( has_post_thumbnail() ) : ?>
    <div class="gl-card__image">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail( 'gl-card', array( 'class' => 'gl-card__img', 'loading' => 'lazy' ) ); ?>
        </a>
        <?php gtalobby_post_type_badge( null, false ); ?>
    </div>
    <?php else : ?>
    <div class="gl-card__image gl-card__image--placeholder" style="background: linear-gradient(135deg, <?php echo esc_attr( $cat_color ); ?>22, transparent)">
        <a href="<?php the_permalink(); ?>">
            <?php gtalobby_icon( 'icon-cat-mods', 36 ); ?>
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
            <?php if ( $mod_ver ) : ?>
                <span class="gl-card__meta-tag">v<?php echo esc_html( $mod_ver ); ?></span>
            <?php endif; ?>
            <?php if ( $mod_compat ) : ?>
                <span class="gl-card__meta-tag"><?php echo esc_html( $mod_compat ); ?></span>
            <?php endif; ?>
            <?php gtalobby_platform_icons(); ?>
        </div>
    </div>
</article>
