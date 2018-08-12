<?php
/**
 * Displays footer widgets if assigned
 *
 * @package WordFlex
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

<?php if (is_active_sidebar('sidebar-2') || is_active_sidebar('sidebar-3')) : ?>
	<!-- Start widget-area -->
	<aside class="widget-area" role="complementary">
		<?php
        if (is_active_sidebar('sidebar-2')) {
            ?>
			<div class="widget-column footer-widget-1">
				<?php dynamic_sidebar('sidebar-2'); ?>
			</div>
		<?php
        }
        if (is_active_sidebar('sidebar-3')) {
            ?>
			<div class="widget-column footer-widget-2">
				<?php dynamic_sidebar('sidebar-3'); ?>
			</div>
		<?php
        } ?>
	</aside>
	<!-- End widget-area -->
<?php endif; ?>
