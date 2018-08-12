<?php
/**
 * WordFlex enqueue
 *
 * @package WordFlex
 * @subpackage Enqueue scripts
 * @author awran5
 * @copyright Copyright (c) 2017, WordFlex
 * @license http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link 
 * 
 * @since 1.0
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

define('BOOTSTRAP_VER', '4.1.3');
define('FONTAWESOME_VER', '5.2.0');
define('ANIMATE_VER', '3.7.0');
define('ISOTOPE_VER', '3.0.6');

/**
 * Just to load jQuery in footer
 * 
 */
if ( ! function_exists( '_wf_load_jquery' ) ) {
	
	add_action( 'wp_enqueue_scripts', '_wf_load_jquery' );

	function _wf_load_jquery() {
		wp_deregister_script('jquery');

		wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), array(), '', true );
		wp_register_script( 'jquery-migrate', includes_url( '/js/jquery/jquery-migrate.min.js' ), array(), '', true );
		wp_enqueue_script ( 'jquery' );
		wp_enqueue_script ( 'jquery-migrate' );
	}
}

if( !function_exists( '_wf_theme_scripts' ) ) {

	add_action( 'wp_enqueue_scripts', '_wf_theme_scripts' );
	/**
	 * bootstrap with (popper)
	 * FontAwesome
	 * Animate.css
	 * 
	 * @return [type] [description]
	 */
	function _wf_theme_scripts() {
		// scripts
		wp_enqueue_script( 'popper', 	   JS_URI . '/popper.min.js', array(), BOOTSTRAP_VER, true );
		wp_enqueue_script( 'bootstrap',    JS_URI . '/bootstrap.min.js', array(), BOOTSTRAP_VER, true );
		wp_enqueue_script( 'font-awesome', JS_URI . '/font-awesome.min.js', array(), FONTAWESOME_VER, true );
		wp_enqueue_script( 'isotope', 	   JS_URI . '/isotope.min.js', array(), ISOTOPE_VER, true );
		wp_enqueue_script( 'main', 	  	   JS_URI . '/main.js', array(), THEME_VER, true );
		if ( is_singular() ) wp_enqueue_script( "comment-reply" );
		// styles
		wp_enqueue_style( 'bootstrap', 	  CSS_URI . '/bootstrap.min.css', array(), BOOTSTRAP_VER );
		wp_enqueue_style( 'animate',	  CSS_URI . '/animate.min.css', array(), ANIMATE_VER );
		wp_enqueue_style( 'wordflex', 	  CSS_URI . '/main.css', array(), THEME_VER );
	}
}