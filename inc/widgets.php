<?php
/**
 * WordFlex Widgets
 *
 * @package WordFlex
 * @subpackage Widgets Register
 * @author awran5
 * @copyright Copyright (c) 2017, WordFlex
 * @license http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link 
 * 
 * @since 1.0
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;


// Primary menu
function _wf_main_menu() {
    wp_nav_menu( array(
        'menu'              => esc_html__('Primary', 'wordflex'),
        'theme_location'    => 'primary',
        'depth'             => 3,
        'container'         => false,
        'menu_class'        => 'navbar-nav mr-auto',
        'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
        'walker'            => new WP_Bootstrap_Navwalker()
    )
);
}

// Footer menu
function _wf_footer_nav() {
    wp_nav_menu(array(
        'menu'              => esc_html__('Footer Menu', 'wordflex'),
        'theme_location'    => 'footer-menu',
        'container'         => false,
        'menu_class'        => 'footer-menu list-inline m-0',
    ) 
);
}

/**
 * Register sidebars
 */
class WordFlex_sidebar {

    public $name;
    public $id;

    public function __construct() {
        add_action( 'widgets_init', array(&$this, 'set_sidebars') );
    }

    public function set_sidebars() {

        if ( function_exists('register_sidebar') ) {
            register_sidebar(array(
                'name'          => $this->name,
                'id'            => $this->id,
                'before_widget' => '<div id="%1$s" class="sidebar-module %2$s p-3">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-titles mb-4">',
                'after_title'   => '</h3>',
            )
        );
        }   
    }
}

$sidebar = new WordFlex_sidebar();
$sidebar->name  = 'Sidebar';
$sidebar->id    = 'sidebar';

