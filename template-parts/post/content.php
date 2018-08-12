<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordFlex
 * @subpackage WordFlex Content
 * @since 1.0
 * @version 1.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/Blog">
	<h2 class="post-title" itemprop="headline">
		<a href="<?php the_permalink() ?>" rel="bookmark" itemprop="url" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
	</h2><!-- post-title -->

	<div class="entry-header text-muted small">
		<?php if ( 'post' === get_post_type() ) { ?>
		<?php _wf_posted_on(); ?>
		<?php } ?>
	</div><!-- .entry-header -->
<hr>
	<?php if(has_post_thumbnail()) : ?>
		<div class="entry-thumbnail">
			<?php _wf_post_thumbnail(); ?>
		</div><!-- entry-thumbnail -->
	<?php endif; ?>

	<div class="entry-content" itemprop="text">
		<?php the_excerpt(); ?>
	</div><!-- .entry-content -->
<hr>
	<div class="entry-footer text-muted small">
		<?php _wf_entry_footer(); ?>
	</div><!-- .entry-footer -->
</article><!-- #post -->