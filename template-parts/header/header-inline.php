<?php
/**
* The header for our theme
*
* This is the template that displays all of the <head> section and everything up until <div id="content">
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package WordFlex Header
* @subpackage Header Inline
* @since 1.0
* @version 1.0
*/
if (! defined('ABSPATH')) {
    exit;
} ?>

<?php if ( _wf_get_option('opt-top-header') ) : ?>
    <!-- Strat top Header -->
    <div class="top-header top-header-inline" itemscope itemtype="http://schema.org/Organization">
        <div class="container">
            <div class="d-flex flex-column flex-md-row small">
                <?php if( _wf_get_option('opt-header-quick-contacts') ) _wf_header_contacts(); ?>
                <?php if( _wf_get_option('opt-header-quick-socials') ) _wf_header_socials('ml-md-auto'); ?>
            </div>
        </div>
    </div>
    <!-- End top Header -->
<?php endif; ?>

<!-- Strat Header -->
<?php $nav_style = _wf_get_option('opt-sticky-nav') ? ' sticky-top' : ''; ?>
<header class="site-header<?php echo $nav_style ?> bg-dark header-inline" role="banner" itemtype="http://schema.org/WPHeader">
    <div class="container">
        <?php 
        $logo   = _wf_get_option('opt-logo');
        $width  = _wf_get_option('opt-logo-width');
        $height = _wf_get_option('opt-logo-height');
        ?>
        <!-- Start Sticky navbar -->
        <nav class="navbar navbar-expand-md navbar-dark bg-dark megamenu">
            <?php if (!empty($logo['url'])) : ?>
                <!-- Start Navbar brand -->
                <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>" itemprop="url" title="<?php echo esc_attr(get_bloginfo('name')); ?>" rel="home">
                    <img src="<?php echo esc_url($logo['url']); ?>" width="<?php echo $width ?>" height="<?php echo $height ?>" itemprop="logo" alt="<?php echo bloginfo('name') ?>-logo">
                </a>
                <!-- End Navbar brand -->
            <?php else: ?>
                <!-- Start Navbar brand -->
                <h2 class="navbar-brand" itemprop="name">
                    <a href="<?php echo esc_url(home_url('/')); ?>" itemprop="utl" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?>
                    </a>
                </h2>
                <!-- End Navbar brand -->
            <?php endif; ?>

            <a class="navbar-toggler mobile-menu-toggle collapsed" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="hamburger"></span>
            </a>

            <div class="collapse navbar-collapse" id="navbarCollapse" itemscope itemtype="http://schema.org/SiteNavigationElement">
                <?php _wf_main_menu() ?>
                <!-- Start Nav search -->
                <a href="#" class="ml-auto d-none d-lg-inline-block nav-search">
                    <i class="fas fa-search"></i>
                </a>
                <div class="top-search">
                    <form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
                        <div class="input-group">
                            <input type="text" name="s" id="search" placeholder="<?php esc_html_e("Search", 'wordflex'); ?>" value="<?php the_search_query(); ?>" class="form-control" />
                        </div>
                    </form>
                </div>
                <!-- End Nav search -->
            </div>
        </nav>
        <!-- End Sticky navbar -->
    </div>
</header>
<!-- End Header -->