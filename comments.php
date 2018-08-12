<?php
/**
* The template for displaying Comments.
*
* The area of the page that contains both current comments
* and the comment form. The actual display of comments is
* handled by a callback to WordFlex_comment() which is
* located in the includes/template-tags.php file.
*
* @package WordFlex 
* @subpackage Comments template
* @since 1.0
* @version 1.0
*/

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit; ?>

<?php if ( post_password_required() ) return; ?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-header mb-4">
			<?php
			$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				/* translators: %s: post title */
				printf( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'wordflex' ), get_the_title() );
			} else {
				printf(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s Reply to &ldquo;%2$s&rdquo;',
						'%1$s Replies to &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'wordflex'
						),
					number_format_i18n( $comments_number ),
					get_the_title()
					);
			}
			?>
		</h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-above" class="comment-navigation" role="navigation">
				<h5 class="screen-reader-text"><?php echo esc_html__( 'Comment navigation', 'wordflex' ); ?></h5>
				<ul class="pager">
					<li class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'wordflex' ) ); ?></li>
					<li class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'wordflex' ) ); ?></li>
				</ul>
			</nav>
		<?php endif; ?>

		<div class="comment-list mb-5">
			<?php 
			wp_list_comments( array( 
				'callback' 		=> '_wf_comment', 
				'avatar_size'	=> 50 
				) 
			); 
			?>
		</div><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-below" class="comment-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php esc_html__( 'Comment navigation', 'wordflex' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'wordflex' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'wordflex' ) ); ?></div>
			</nav>
		<?php endif; ?>

	<?php endif; ?>

	<?php
	// If comments are closed and there are comments, let's leave a little note
	if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
	<p class="no-comments"><?php esc_html__( 'Comments are closed.', 'wordflex' ); ?></p>
	<?php endif; ?>

<?php 
comment_form( 
	$args = array(

		'class_submit'         	=> 'btn btn-primary',
		'title_reply'       	=> esc_html__( 'Leave a Reply', 'wordflex' ),
		'title_reply_to'    	=> esc_html__( 'Leave a Reply to %s', 'wordflex' ),
		'cancel_reply_link' 	=> esc_html__( 'Cancel Reply', 'wordflex' ),
		'label_submit'      	=> esc_html__( 'Post Comment', 'wordflex' ),
		'comment_field' 		=>  '<p class="textarea"><textarea placeholder="' . esc_html__('Start typing...', 'wordflex') . '" class="form-control" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
		'comment_notes_after' 	=> '<p class="form-allowed-tags">' . __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:', 'wordflex' ) . '</p><p class="comment-attr"><code>' . allowed_tags() . '</code></p>',					
		'fields' => apply_filters( 'comment_form_default_fields', 
			array(
				'author' => '
				<p class="author-name input-group">
				<span class="input-group-text"><i class="fas fa-user"></i></span>
				<input class="form-control" placeholder="Your name (*)" id="name" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" />
				</p>',

				'email' => '
				<p class="author-email input-group">
					<span class="input-group-text"><i class="fas fa-envelope"></i></span>
					<input class="form-control" placeholder="Your email (*)" id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-required="true" />
				</p>',

				'url' => '
				<p class="author-url input-group">
					<span class="input-group-text"><i class="fas fa-link"></i></span>
					<input class="form-control" placeholder="Your webstie" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" aria-required="false" />
				</p>'
				)
			),
		)
	);
	?>
</div><!-- #comments -->
