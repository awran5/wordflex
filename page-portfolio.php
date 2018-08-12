<?php
/**
 * Template Name: Portfolio kos
 * The template for displaying Portfolio page.
 *
 * @package WordFlex Portfolio Template
 * @since 1.0
 */

// Exit if accessed directly
if (! defined('ABSPATH'))  exit; ?>

<?php get_header(); ?>
<!-- Start site-body -->
<main id="content" class="site-body" role="main">
    

    <?php if ( have_posts() ) :  while ( have_posts() ) : the_post(); ?>
    <div class="container portfolio-container">
        <?php the_content(); ?>
    </div> <!-- container -->
    <?php endwhile; ?>
    <?php endif; ?>

</main>
<!-- End site-body -->
<?php get_footer() ?>

