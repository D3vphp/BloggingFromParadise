<?php
function better_comments( $comment, $args, $depth ) {
	global $post;
	$author_id = $post->post_author;
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments. ?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="pingback-entry"><span class="pingback-heading"><?php esc_html_e( 'Pingback:', 'BFPUltimate' ); ?></span> <?php comment_author_link(); ?></div>
	<?php
		break;
		default :
		// Proceed with normal comments. ?>
	<li id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" <?php comment_class('clr'); ?>>
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, 80 ); ?>
			</div><!-- .comment-author -->
			<div class="comment-details clr">
				<header class="comment-meta">
					<cite class="fn"><?php comment_author_link(); ?></cite>
				</header><!-- .comment-meta -->
				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'BFPUltimate' ); ?></p>
				<?php endif; ?>
				<div class="comment-content entry clr">
					<?php comment_text(); ?>
				</div><!-- .comment-content -->
				<div class="reply comment-reply-link">
					<?php comment_reply_link( array_merge( $args, array(
						'reply_text' => esc_html__( 'Reply to this message', 'BFPUltimate' ),
						'depth'      => $depth,
						'max_depth'	 => $args['max_depth'] )
					) ); ?>
				</div><!-- .reply -->
			</div><!-- .comment-details -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // End comment_type check.
}