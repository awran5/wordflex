<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordFlex
 * @subpackage Blog Sidebar
 * @since 1.0
 *
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

if (! is_active_sidebar('sidebar')) {
    return;
} ?>
<!-- Start sidebar-area -->
<div class="col-6 col-md-3 sidebar-offcanvas sidebar-area" id="sidebar" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
    <?php dynamic_sidebar('sidebar'); ?>
</div>
<!-- End sidebar-area -->