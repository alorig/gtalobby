<?php
/**
 * Comments Template — Enhanced
 *
 * @package GtaLobby
 */

if ( post_password_required() ) {
    return;
}

/**
 * Custom comment callback renderer.
 */
if ( ! function_exists( 'gtalobby_comment_callback' ) ) :
function gtalobby_comment_callback( $comment, $args, $depth ) {
    $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
    ?>
    <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( 'gl-comment' ); ?>>
        <article class="gl-comment__body">
            <header class="gl-comment__header">
                <div class="gl-comment__avatar">
                    <?php echo get_avatar( $comment, $args['avatar_size'], '', '', array( 'class' => 'gl-comment__avatar-img' ) ); ?>
                </div>
                <div class="gl-comment__meta">
                    <span class="gl-comment__author"><?php comment_author_link(); ?></span>
                    <time class="gl-comment__date" datetime="<?php comment_date( 'c' ); ?>">
                        <?php
                        printf(
                            esc_html__( '%1$s at %2$s', 'gtalobby' ),
                            get_comment_date(),
                            get_comment_time()
                        );
                        ?>
                    </time>
                </div>
            </header>
            <?php if ( '0' === $comment->comment_approved ) : ?>
                <p class="gl-comment__moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'gtalobby' ); ?></p>
            <?php endif; ?>
            <div class="gl-comment__content">
                <?php comment_text(); ?>
            </div>
            <div class="gl-comment__actions">
                <?php
                comment_reply_link( array_merge( $args, array(
                    'depth'     => $depth,
                    'max_depth' => $args['max_depth'],
                    'before'    => '<span class="gl-comment__reply">',
                    'after'     => '</span>',
                ) ) );
                edit_comment_link( esc_html__( 'Edit', 'gtalobby' ), '<span class="gl-comment__edit">', '</span>' );
                ?>
            </div>
        </article>
    <?php
}
endif;
?>

<section id="comments" class="gl-comments" data-animate="fade-up">

    <?php if ( have_comments() ) : ?>

        <h2 class="gl-comments__title">
            <?php esc_html_e( 'Comments', 'gtalobby' ); ?>
            <span class="gl-comments__count-badge"><?php echo number_format_i18n( get_comments_number() ); ?></span>
        </h2>

        <ol class="gl-comment-list" data-animate>
            <?php
            wp_list_comments( array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 48,
                'callback'    => 'gtalobby_comment_callback',
            ) );
            ?>
        </ol>

        <?php
        the_comments_navigation( array(
            'prev_text' => esc_html__( '&larr; Older Comments', 'gtalobby' ),
            'next_text' => esc_html__( 'Newer Comments &rarr;', 'gtalobby' ),
        ) );
        ?>

    <?php endif; ?>

    <?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
        <p class="gl-comments__closed"><?php esc_html_e( 'Comments are closed.', 'gtalobby' ); ?></p>
    <?php endif; ?>

    <div class="gl-comments__divider" aria-hidden="true"></div>

    <div class="gl-comment-form-wrapper" data-animate>
    <?php
    $commenter = wp_get_current_commenter();

    comment_form( array(
        'class_form'           => 'gl-comment-form',
        'title_reply'          => esc_html__( 'Leave a Comment', 'gtalobby' ),
        'title_reply_before'   => '<h3 id="reply-title" class="gl-comment-form__title">',
        'title_reply_after'    => '</h3>',
        'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s gl-comment-form__submit">%4$s</button>',
        'submit_field'         => '<div class="gl-comment-form__submit-wrap">%1$s %2$s</div>',
        'label_submit'         => esc_html__( 'Post Comment', 'gtalobby' ),

        'comment_field' =>
            '<div class="gl-comment-form__field gl-comment-form__field--textarea">'
            . '<label for="comment">' . esc_html__( 'Comment', 'gtalobby' ) . '</label>'
            . '<textarea id="comment" name="comment" cols="45" rows="6" required placeholder="' . esc_attr__( 'Share your thoughts...', 'gtalobby' ) . '"></textarea>'
            . '<span class="gl-comment-form__helper">' . esc_html__( 'Be respectful and constructive. HTML is not allowed.', 'gtalobby' ) . '</span>'
            . '</div>',

        'fields' => array(
            'author' =>
                '<div class="gl-comment-form__field">'
                . '<label for="author">' . esc_html__( 'Name', 'gtalobby' ) . ' <span class="required">*</span></label>'
                . '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ?? '' ) . '" required placeholder="' . esc_attr__( 'Your name', 'gtalobby' ) . '" />'
                . '</div>',

            'email' =>
                '<div class="gl-comment-form__field">'
                . '<label for="email">' . esc_html__( 'Email', 'gtalobby' ) . ' <span class="required">*</span></label>'
                . '<input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ?? '' ) . '" required placeholder="' . esc_attr__( 'your@email.com', 'gtalobby' ) . '" />'
                . '</div>',

            'url' =>
                '<div class="gl-comment-form__field">'
                . '<label for="url">' . esc_html__( 'Website', 'gtalobby' ) . '</label>'
                . '<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ?? '' ) . '" placeholder="' . esc_attr__( 'https://', 'gtalobby' ) . '" />'
                . '</div>',
        ),
    ) );
    ?>
    </div>

</section>
