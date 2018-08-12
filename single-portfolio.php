<?php
/**
* Single Blog portfolio Template
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package WordFlex
* @subpackage WordFlex Single Portfolio Page
* @since 1.0
* @version 1.0
*/

if (! defined('ABSPATH')) {
    exit;
} ?>

<?php get_header() ?>

<!-- Start site body -->
<main id="content" class="site-body" role="main">
	<div class="container">
		<?php bootstrap_breadcrumb(); ?>

		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<?php get_template_part('template-parts/post/content', 'portfolio', get_post_format()); ?>
			<?php endwhile; ?>
		<?php else : ?>
			<?php get_template_part('template-parts/post/content', 'none'); ?>
		<?php endif; ?>

	</div>
</main>
<!-- End site body -->
<?php get_footer() ?>
