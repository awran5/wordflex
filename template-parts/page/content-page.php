<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordFlex
 * @subpackage WordFlex page content
 * @since 1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; ?>

<article role="article" id="post_<?php the_ID()?>" <?php post_class()?>>
	<?php the_title( '<h2 class="page-title" itemprop="headline">', '</h2>' )?>
	<div class="page-content" itemprop="text">
		<?php the_content()?>
	</div>
	<?php wp_link_pages(); ?>
</article>
