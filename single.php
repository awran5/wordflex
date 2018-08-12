<?php
/**
* Single Blog page Template
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package WordFlex
* @subpackage WordFlex Single Blog Page
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
		<div class="row row-offcanvas row-offcanvas-right">
			<div id="primary" class="content-area col-12 col-md-9">
				<p class="float-right d-md-none">
					<button type="button" class="btn btn-primary btn-sm" data-toggle="offcanvas"><?php echo esc_html__('Sidebar', 'wordflex'); ?>
					</button>
				</p>
				<?php if (have_posts()) : ?>
					<?php while (have_posts()) : the_post(); ?>
						<?php get_template_part('template-parts/post/content', 'single', get_post_format()); ?>
						<?php if (comments_open() || get_comments_number()) { 
							comments_template();
						} ?>
					<?php endwhile; ?>
				<?php else : ?>
					<?php get_template_part('template-parts/post/content', 'none'); ?>
				<?php endif; ?>
			</div>
			<?php get_sidebar() ?>
		</div>
	</div>
</main>
<!-- End site body -->
<?php get_footer() ?>
