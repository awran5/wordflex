<?php
/**
* Blog page Template
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package WordFlex
* @subpackage WordFlex Blog Page
* @since 1.0
* @version 1.0
*/
if ( ! defined( 'ABSPATH' ) ) exit; ?>

<?php get_header() ?>
<!-- Start site-body -->
<main id="content" class="site-body" role="main">
	<div class="container">
		<div class="row row-offcanvas row-offcanvas-right">
			<div id="primary" class="col-12 col-md-9 content-area">
				<p class="float-right d-md-none">
					<button type="button" class="btn btn-primary btn-sm" data-toggle="offcanvas"><?php echo esc_html__( 'Sidebar', 'wordflex' ); ?>
					</button>
				</p>
				<?php 
				$args = array(
					'post_type' 	 => 'post',
					'post_status' 	 => 'publish',
					'posts_per_page' => '4',
					'paged' 		 => 1,
				);
				$ajax_posts = new WP_Query( $args );
				if ( $ajax_posts->have_posts() ) : ?>
				<div class="ajax-posts">
					<?php while ( $ajax_posts->have_posts() ) : $ajax_posts->the_post() ?>
						<?php get_template_part( 'template-parts/post/content', get_post_format() ); ?>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
				<?php else : ?>
					<?php get_template_part( 'template-parts/post/content', 'none' ); ?>
				<?php endif ?>
				<div class="ajax-load-posts text-center mt-4">
					<button type="button" role="button" class="ajax-posts-btn btn btn-sm btn-success"><?php echo esc_html__('More Posts', 'wordflex') ?>
						<span class="pending-ajax"><i class="fas fa-spinner fa-spin"></i></span>
					</button>
				</div>
			</div>
			<?php get_sidebar() ?>
		</div>
	</div>
</main> 
<!-- End site-body -->
<?php get_footer() ?>