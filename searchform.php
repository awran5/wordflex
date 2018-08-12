<?php
/**
 * WordFlex search from
 *
 * @package WordFlex
 * @subpackage search from
 *
 * @since 1.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
} ?>

<form method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>" role="search">
	<label for="s" class="screen-reader-text"><?php echo esc_html__('Search', 'wordflex'); ?></label>
	<div class="input-group">
		<input class="field form-control" id="s" name="s" type="text" placeholder="<?php echo esc_html__('Search &hellip;', 'wordflex'); ?>">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">
				<i class="fas fa-search"></i>
			</button>
		</span>
	</div>
</form>