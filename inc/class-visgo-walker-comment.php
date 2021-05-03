<?php

class Visgo_Walker_Comment extends Walker_Comment {

	protected function html5_comment( $comment, $depth, $args ) {
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
		?>
		<div class="row comment-layout">
			<<?php echo $tag; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?>
				id="comment-<?php comment_ID(); ?>"
				<?php comment_class( $this->has_children ? 'parent media border-bottom border-top pb-4 pt-4' : 'media border-bottom border-top pb-4 pt-4', $comment); ?>
			>
				<div class="media" id="comment-<?php comment_ID(); ?>">
					<?php
						$comment_author_url = get_comment_author_url( $comment );
						$comment_author     = get_comment_author( $comment );
						$avatar             = get_avatar( $comment, $args['avatar_size'], 'avatar_default', '', [ 'class' => 'd-flex mr-3 rounded-circle mr-4 align-self-start'] );
						if ( 0 !== $args['avatar_size'] ) {
							if ( empty( $comment_author_url ) ) {
								echo wp_kses_post( $avatar );
							} else {
								echo wp_kses_post( $avatar );
							}
						}
					?>

					<div class="media-body">
							<?php $comment_author = get_comment_author( $comment ); ?>
							<h5 class="mt-0"> <?php echo $comment_author; ?> </h5>
							<p class="comment-text pt-3">
								<?php comment_text();
									if ( '0' === $comment->comment_approved ) {
								?>
								<span class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentytwenty' ); ?></span>
								<?php } ?>
							</p>

							<div class="coments-meta pt-3">
								<?php echo get_simple_likes_button( get_the_ID(), 0 ); ?>
								<?php
									$comment_reply_link = get_comment_reply_link(
										array_merge(
											$args,
											array(
												'add_below' => 'div-comment',
												'depth'     => $depth,
												'max_depth' => $args['max_depth'],
												'before'    => '',
												'after'     => '',
												'class'     => 'pl-3'
											)
										)
									);

									if ( $comment_reply_link ) {
										echo $comment_reply_link;
									}
								?>
							</div>
					</div><!-- .comment-body -->
				</div><!-- .comment-body -->
		</div>
			<?php
		}
}