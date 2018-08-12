<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WordFlex
 * @subpackage WordFlex template tags
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( '_wf_comment' ) ) :
/**
* Template for comments and pingbacks.
*
* Used as a callback by wp_list_comments() for displaying the comments.
*/
function _wf_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
		if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>
			<li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'media' ); ?>>
				<div class="comment-body">
					<?php esc_html__( 'Pingback:', 'wordflex' ); ?> 
					<?php comment_author_link(); ?>
					<?php edit_comment_link( esc_html__( 'Edit', 'wordflex' ), '<span class="edit-link">', '</span>' ); ?>
				</div>
			</li>
		<?php else : ?>
		<div class="media mb-4 content-box-shadow" itemscope itemtype="http://schema.org/UserComments">
			<a class="d-flex mr-3" href="#">
				<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
			</a>
			<div class="media-body">
				<?php 
				$comment_class = $comment->user_id == 1 ? ' post-author' : ' guest-comment';
				?>
				<h5 class="small<?php echo esc_attr($comment_class) ?>"><?php printf( __( '%s <span class="says">says:</span>', 'wordflex' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'wordflex' ), get_comment_date(), get_comment_time() ); ?>
						</time>
					</a>
				</h5>
				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php __( 'Your comment is awaiting moderation.', 'wordflex'); ?></p>

				<?php else : ?>
					<div class="comment-body">
						<?php comment_text(); ?>
					</div>
					<?php comment_reply_link(
						array_merge(
							$args, array(
								'add_below' => 'div-comment',
								'depth' 	=> $depth,
								'max_depth' => $args['max_depth'],
								'before' 	=> '<div class="comment-footer small"><i class="fas fa-reply"></i>',
								'after' 	=> '</div>'
							)
						)
					); 
					?>
				<?php endif; ?>	
			</div>
		</div>
		<?php endif; ?>

<?php } ?>
<?php endif;


if ( ! function_exists( '_wf_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function _wf_posted_on() {

	// echo sticky icon for sticky posts
	if ( is_sticky() && is_home() ) {
		printf( '<span class="sticky-post"><i class="fas fa-star"></i> %s </span>', __( 'Featured', 'wordflex' ) );
	}

	// Get post date and time
	$time_string = '<time class="entry-date published" itemprop="datePublished" datetime="%1$s">%2$s</time>';
	$time_string = sprintf( $time_string, 
		esc_attr( get_the_date( 'c' ) ), 
		esc_html( get_the_date() )
	);

	//	Get date modified if any
	// if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
	// 	$time_string_update = '<time class="updated" itemprop="dateModified" datetime="%1$s">%2$s </time>';
	// 	$time_string_update = sprintf( $time_string_update,
	// 		esc_attr( get_the_modified_date( 'c' ) ),
	// 		esc_html( get_the_modified_date() )
	// 		);
	// 	$time_string .= '<span class="updated-on"><i class="fa fa-refresh" aria-hidden="true"></i>' . __(' - and Updated ', 'wordflex') . $time_string_update . '</span>';
	// }

	// Get author info
	$author_string = sprintf( '<span class="author vcard" itemprop="name"><a class="url fn" rel="author" href="%1$s" title="%2$s"> %3$s</a></span> ',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'wordflex' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);

	// Final output
	printf( '<span class="posted-on"><i class="fas fa-clock"></i>' . __(' Posted %1$s', 'wordflex') . '</span><span class="byline" itemtype="http://schema.org/Person" itemscope="itemscope" itemprop="author"><i class="fas fa-user"></i>' . __( ' by' , 'wordflex') . '%2$s</span>', 
		$time_string, $author_string . ' '
	);

	// echo edit link 
	edit_post_link( __( ' edit', 'wordflex' ), '  <span class="post-edit float-md-right"><i class="fas fa-pencil-alt"></i>', '</span>' );
}
endif;


if ( ! function_exists( '_wf_post_thumbnail' ) ) :
/**
* Display an optional post thumbnail.
*
* Wraps the post thumbnail in an anchor element on index views, or a div
* element when on single views.
*
* @package From Twenty Fifteen 1.0
* @since 1.0
*/
function _wf_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) 
		return;

	$full_img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full-size');
	$img_src = $full_img[0]; 

	if ( is_singular() ) : ?>

	<a href="<?php echo $img_src; ?>" title="<?php the_title_attribute(); ?>" >
		<?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'single-featured img-fluid', 'itemprop' => 'image' ) ); ?>
	</a>

<?php else : ?>
	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		<?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'home-featured img-fluid', 'itemprop' => 'image' ) ); ?>
	</a>
<?php endif;
}
endif;


if ( ! function_exists( '_wf_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function _wf_entry_footer() {
	if ( 'post' == get_post_type() ) {

		if ( is_single() && has_tag() ) { ?>
		<span class="tags-links d-block" itemprop="keywords">
			<i class="fas fa-tags"></i>
			<?php the_tags( __( ' Tags: ', 'wordflex' ) ); ?>
		</span>
		<?php } ?>
		<?php
		$post_views = _wf_get_option('opt-post-views');
		if ($post_views) { ?>
		<span class="post-views d-block" itemprop="interactionCount">
			<i class="fas fa-eye"></i>
			<?php
			$counter = new PostViewCount;
			echo $counter->getCount('views_count', 'views');
			?>
		</span>
		<?php } ?>

		<?php if ( ! is_single() ) { ?>
		<span class="post-liked d-inline" itemprop="interactionCount">
			<i class="far fa-thumbs-up"></i>
			<?php echo (int) get_post_meta( get_the_ID(), 'positive', true ); ?>
		</span>
		<span class="post-unliked d-inline ml-2" itemprop="interactionCount">
			<i class="far fa-thumbs-down"></i>
			<?php echo (int) get_post_meta( get_the_ID(), 'negative', true ); ?>
		</span>
		<?php }
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) { ?>
		<span class="comments-link d-block" itemprop="interactionCount"><i class="fas fa-comment"></i>
			<?php comments_popup_link( __( 'No comments', 'wordflex' ), __( '1 Comment', 'wordflex' ), __( '% Comments ', 'wordflex' ) ); ?>
		</span>
		<?php } ?>
		<?php }
	}
endif;

if ( ! function_exists( '_wf_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @since 1.0
 */
function _wf_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	} ?>
	<!-- Start post-navigation -->
	<nav class="my-4 post-navigation">
		<span class="screen-reader-text"><?php __( 'Post navigation', 'wordflex' ); ?></span>
		<div class="d-flex nav-links">
			<?php
			previous_post_link( 
				'<div class="previous page-link"> %link</div>', 
				'<i class="fas fa-chevron-left"></i> %title'
			);
			next_post_link( 
				'<div class="next page-link ml-auto">%link</div>', 
				'%title <i class="fas fa-chevron-right"></i>'
			);
			?>
		</div>
	</nav>
	<!-- End post-navigation -->
	<?php
}
endif;


if ( ! function_exists( '_wf_edit_link' ) ) :
/**
 * Returns an accessibility-friendly link to edit a post or page.
 *
 * This also gives us a little context about what exactly we're editing
 * (post or page?) so that users understand a bit more where they are in terms
 * of the template hierarchy and their content. Helpful when/if the single-page
 * layout with multiple posts/pages shown gets confusing.
 */
function _wf_edit_link() {
	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			__( 'Edit<span class="screen-reader-text">"%s"</span>', 'wordflex' ),
			get_the_title()
		),
		'<span class="edit-link float-md-right">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function _wf_categorized_blog() {
	$category_count = get_transient( '_wf_categories' );

	if ( false === $category_count ) {
		// Create an array of all the categories that are attached to posts.
		$categories = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$category_count = count( $categories );

		set_transient( '_wf_categories', $category_count );
	}

	// Allow viewing case of 0 or 1 categories in post preview.
	if ( is_preview() ) {
		return true;
	}

	return $category_count > 1;
}


/**
 * Flush out the transients used in _wf_categorized_blog.
 */
function _wf_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( '_wf_categories' );
}
add_action( 'edit_category', '_wf_category_transient_flusher' );
add_action( 'save_post',     '_wf_category_transient_flusher' );
