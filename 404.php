<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package WordFlex
 * @since   1.0
 *
 */
get_header();?>
<!-- Start 404 page -->
<div class="text-center page-404" style="margin-top: 8rem">
    <div class="container">
        <h1 class="display-4 text-uppercase error-heading">404</h1>
        <p class="lead">
            <strong>
                <?php _e('Page Not Found!', 'wordflex');?>
            </strong>
        </p>
        <p class="lead my-4">
            <?php _e(' The site configured at this address does not contain the requested file.', 'wordflex');?>
        </p>
        <button class="btn btn-danger btn-lg btn-shadow" type="button" onclick="history.back(-1)">
            <?php _e('Go Back', 'wordflex');?>
        </button>
        <hr class="my-5">
        <p class="lead">
            <?php _e('Or maybe try a search?', 'wordflex');?>
        </p>
        <p>
            <?php get_search_form();?>
        </p>
    </div>
</div>
<!-- End 404 page -->
<?php get_footer();?>