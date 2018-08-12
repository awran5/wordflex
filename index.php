<?php
/**
* The main template file
*
* This is the most generic template file in a WordPress theme
* and one of the two required files for a theme (the other being style.css).
* It is used to display a page when nothing more specific matches a query.
* E.g., it puts together the home page when no home.php file exists.
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package WordFlex
* @subpackage WordFlex index.php
* @since 1.0
* @version 1.0
*/

if (! defined('ABSPATH')) {
    exit;
} ?>

<?php get_header() ?>
<!-- Start site-body -->
<main id="content" class="site-body" role="main">
    <div class="container">
        <div class="row row-offcanvas row-offcanvas-right">
            <div id="primary" class="col-12 col-md-9 content-area">
                <p class="float-right d-md-none">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="offcanvas">
                        <?php esc_html_e('Sidebar', 'wordflex'); ?>
                    </button>
                </p>

                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post() ?>
                        <?php get_template_part('template-parts/post/content', get_post_format()); ?>
                    <?php endwhile; ?>
                <?php else : ?>
                    <?php get_template_part('template-parts/post/content', 'none'); ?>
                <?php endif ?>

            </div><!--primary-->
            <?php get_sidebar() ?>
        </div><!--/row-->
    </div> <!-- container -->
</main>
<!-- End site-body -->
<?php get_footer() ?>
