<?php
/**
 * Single Mod Listing Template
 *
 * Displays a mod with download details, compatibility info,
 * installation steps, and screenshots gallery.
 *
 * @package GtaLobby
 */

get_header();
?>

<div class="gl-single gl-single--mod">

    <div class="gl-zone gl-zone--breadcrumb">
        <div class="gl-container">
            <?php gtalobby_breadcrumbs(); ?>
        </div>
    </div>

    <div class="gl-container gl-single__layout">

        <main class="gl-single__main" id="main-content">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class( 'gl-article gl-article--mod' ); ?>>

                    <header class="gl-article__header">
                        <?php gtalobby_post_type_badge(); ?>
                        <?php gtalobby_category_badge(); ?>
                        <h1 class="gl-article__title"><?php the_title(); ?></h1>
                        <?php gtalobby_post_meta(); ?>
                        <?php if ( gtalobby_is_gta6_content() ) gtalobby_confidence_badge(); ?>
                    </header>

                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="gl-article__hero">
                        <?php the_post_thumbnail( 'gl-hero', array( 'class' => 'gl-article__hero-img' ) ); ?>
                    </div>
                    <?php endif; ?>

                    <?php /* --- MOD DETAILS CARD --- */ ?>
                    <?php
                    $download_url = get_post_meta( get_the_ID(), 'mod_download_url', true );
                    $mod_version  = get_post_meta( get_the_ID(), 'mod_version', true );
                    $file_size    = get_post_meta( get_the_ID(), 'mod_file_size', true );
                    $mod_author   = get_post_meta( get_the_ID(), 'mod_author', true );
                    $compat       = get_post_meta( get_the_ID(), 'mod_compatibility', true );
                    ?>
                    <?php if ( $download_url || $mod_version || $file_size || $mod_author ) : ?>
                    <div class="gl-mod-details">
                        <h2 class="gl-mod-details__title"><?php esc_html_e( 'Mod Details', 'gtalobby' ); ?></h2>
                        <dl class="gl-mod-details__list">
                            <?php if ( $mod_version ) : ?>
                            <div class="gl-mod-details__row">
                                <dt><?php esc_html_e( 'Version', 'gtalobby' ); ?></dt>
                                <dd><?php echo esc_html( $mod_version ); ?></dd>
                            </div>
                            <?php endif; ?>
                            <?php if ( $file_size ) : ?>
                            <div class="gl-mod-details__row">
                                <dt><?php esc_html_e( 'File Size', 'gtalobby' ); ?></dt>
                                <dd><?php echo esc_html( $file_size ); ?></dd>
                            </div>
                            <?php endif; ?>
                            <?php if ( $mod_author ) : ?>
                            <div class="gl-mod-details__row">
                                <dt><?php esc_html_e( 'Author', 'gtalobby' ); ?></dt>
                                <dd><?php echo esc_html( $mod_author ); ?></dd>
                            </div>
                            <?php endif; ?>
                            <?php if ( $compat ) : ?>
                            <div class="gl-mod-details__row">
                                <dt><?php esc_html_e( 'Compatibility', 'gtalobby' ); ?></dt>
                                <dd><?php echo esc_html( $compat ); ?></dd>
                            </div>
                            <?php endif; ?>
                        </dl>
                        <?php if ( $download_url ) : ?>
                        <a href="<?php echo esc_url( $download_url ); ?>" class="gl-btn gl-btn--primary gl-mod-details__download" rel="nofollow noopener" target="_blank">
                            <?php esc_html_e( 'Download Mod', 'gtalobby' ); ?>
                        </a>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <?php gtalobby_render_ad_slot( 'ad_before_content' ); ?>

                    <?php
                    $toc = gtalobby_generate_toc( get_the_content() );
                    if ( $toc ) :
                    ?>
                    <div class="gl-article__toc">
                        <?php echo $toc; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    </div>
                    <?php endif; ?>

                    <div class="gl-article__content gl-typography">
                        <?php the_content(); ?>
                    </div>

                    <?php /* --- INSTALL STEPS --- */ ?>
                    <?php
                    $install_steps = get_post_meta( get_the_ID(), 'mod_install_steps', true );
                    if ( is_array( $install_steps ) && ! empty( $install_steps ) ) :
                    ?>
                    <div class="gl-install-steps">
                        <h2 class="gl-install-steps__title"><?php esc_html_e( 'Installation Guide', 'gtalobby' ); ?></h2>
                        <ol class="gl-install-steps__list">
                            <?php foreach ( $install_steps as $i => $step ) : ?>
                                <?php if ( ! empty( $step['step_title'] ) ) : ?>
                                <li class="gl-install-step">
                                    <h3 class="gl-install-step__title">
                                        <span class="gl-install-step__num"><?php echo esc_html( $i + 1 ); ?></span>
                                        <?php echo esc_html( $step['step_title'] ); ?>
                                    </h3>
                                    <?php if ( ! empty( $step['step_description'] ) ) : ?>
                                    <div class="gl-install-step__desc"><?php echo wp_kses_post( $step['step_description'] ); ?></div>
                                    <?php endif; ?>
                                </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ol>
                    </div>
                    <?php endif; ?>

                    <?php /* --- SCREENSHOTS GALLERY --- */ ?>
                    <?php
                    $screenshots = get_post_meta( get_the_ID(), 'mod_screenshots', true );
                    if ( is_array( $screenshots ) && ! empty( $screenshots ) ) :
                    ?>
                    <div class="gl-gallery">
                        <h2 class="gl-gallery__title"><?php esc_html_e( 'Screenshots', 'gtalobby' ); ?></h2>
                        <div class="gl-gallery__grid">
                            <?php foreach ( $screenshots as $img_id ) : ?>
                            <figure class="gl-gallery__item">
                                <?php echo wp_get_attachment_image( $img_id, 'gl-card', false, array( 'class' => 'gl-gallery__img', 'loading' => 'lazy' ) ); ?>
                            </figure>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php gtalobby_render_ad_slot( 'ad_after_content' ); ?>

                    <footer class="gl-article__footer">
                        <?php gtalobby_taxonomy_tags(); ?>
                        <?php gtalobby_platform_icons(); ?>
                        <?php gtalobby_hub_link(); ?>
                        <?php gtalobby_social_share(); ?>
                    </footer>

                </article>

                <?php gtalobby_author_box(); ?>
                <?php gtalobby_related_posts(); ?>
                <?php gtalobby_post_navigation(); ?>

                <?php
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
                ?>

            <?php endwhile; endif; ?>
        </main>

        <aside class="gl-single__sidebar" role="complementary">
            <?php get_sidebar(); ?>
        </aside>

    </div>
</div>

<?php get_footer(); ?>
