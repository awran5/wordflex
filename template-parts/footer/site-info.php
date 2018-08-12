<?php
/**
 * Displays footer site info
 *
 * @package WordFlex
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

<div class="clearfix"></div>
<?php if (_wf_get_option('opt-copyright')) : ?>
	<!-- Start Footer -->
	<footer class="p-2 mt-5 small text-muted footer-area" itemtype="http://schema.org/WPFooter" itemscope="itemscope" role="contentinfo">
		<div class="container">
			<div class="row"> 
				<!-- Start copyrights-area -->
				<div class="col-lg-6 text-center text-lg-left p-1 copyrights-area">
					<?php echo __('Copyright &copy; ', 'wordflex'); ?>
					<span itemprop="copyrightYear">
						<?php echo date('Y'); ?>
					</span>
					<a href="<?php echo esc_url(home_url()); ?>" itemprop="url">
						<span itemprop="copyrightHolder"><?php echo esc_attr(get_bloginfo('name')); ?></span>
					</a>
					<?php echo esc_html__('All rights reserved. ', 'wordflex'); ?>
				</div>
				<!-- End copyrights-area -->
				<?php if (has_nav_menu('footer-menu') && _wf_get_option('opt-footer-menu')) : ?>
					<!-- Start Footer menu -->
					<div class="col-lg-6 ml-auto text-center text-lg-right p-1" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement" role="navigation">
						<?php _wf_footer_nav(); ?>
					</div>
					<!-- End Footer menu -->
				<?php endif; ?>
			</div>
		</div>
		<?php if (_wf_get_option('opt-scroll-totop')): ?>
			<!-- Start to Top -->
			<a href="#" class="to-top" role="button"><i class="fas fa-angle-up"></i></a>
			<!-- End to Top -->
		<?php endif; ?>
	</footer>
	<!-- End Footer -->
<?php endif; ?>
