<?php
/**
* Template Name: Frontpage
*
* @package WordFlex Frontpage
* @since 1.0
*/

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;


get_header(); ?>

<?php 
	if ( have_posts() ) :  while ( have_posts() ) : the_post();
		the_content();
	endwhile;
	endif; 
?>


<?php get_footer(); ?>