<?php
/**
 * Function to load posts by ajax
 *
 * @package WordFlex
 * @subpackage WordFlex Posts by ajax
 * @since 1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'load_posts_by_ajax_callback' ) ) {

	function load_posts_by_ajax_callback() {
		check_ajax_referer('load_more_posts', 'security');	
		$paged = $_POST['page'];
		$args = array(
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => '4',
			'paged'          => $paged,
			);
		$ajax_posts = new WP_Query( $args );
		if ( $ajax_posts->have_posts() ) :
			while ( $ajax_posts->have_posts() ) : $ajax_posts->the_post();
		get_template_part( 'template-parts/post/content' );
		endwhile; 
		wp_reset_postdata();
		else : 
			get_template_part( 'template-parts/post/content', 'none' );
		endif;

		wp_die();
	}
	add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');
	add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback');
}