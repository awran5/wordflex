<?php
/**
 * Template Name: Full Width
 * The template for displaying full-width pages with no sidebar.
 *
 * @package WordFlex Full Width Template
 * @since 1.0
 */
// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

get_header(); ?>
<?php if ( have_posts() ) :  while ( have_posts() ) : the_post(); ?>
	
	<div class="container my-5"><?php the_content(); ?></div>
	<?php endwhile; ?>
	<?php endif; ?>
<?php get_footer(); ?>
