<?php
/**
* Page Template
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package WordFlex
* @subpackage WordFlex Page
* @since 1.0
* @version 1.0
*/

if ( ! defined( 'ABSPATH' ) ) exit; ?>

<?php get_header() ?>
<!-- Start site body -->
<main id="content" class="site-body" role="main">
	<div class="container">
		<?php if(have_posts()): ?>
			<?php while(have_posts()): the_post(); ?>
				<?php get_template_part( 'template-parts/page/content', 'page' ); ?>
				<?php if ( _wf_get_option('opt-page-comments') ) {
					if ( comments_open() || '0' != get_comments_number() ) comments_template();
				} ?>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</main>
<!-- End site body -->
<?php get_footer() ?>