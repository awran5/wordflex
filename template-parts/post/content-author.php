<?php
/**
* Single author content
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package WordFlex
* @subpackage WordFlex author content Page
* @since 1.0
* @version 1.0
*/

if ( ! defined( 'ABSPATH' ) ) exit; ?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/Blog">
	<div class="post-title" itemprop="headline">
		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
	</div><!-- post-title -->
	<div class="entry-content text-muted small">
		<?php the_excerpt(); ?>
	</div><!-- .entry-content -->
	<hr>
</article><!-- #post -->