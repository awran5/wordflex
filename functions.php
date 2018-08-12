<?php
/**
 * WordFlex functions and definitions
 *
 * @package WordFlex
 * @subpackage Main functions page
 * @author Awran5
 * @copyright Copyright (c) 2017 - 2018, WordFlex
 * @license http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link 
 * 
 * @since 1.0
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;


// Constants
define('THEME_NAME', wp_get_theme()->get( 'Name' ) );
define('THEME_VER',  wp_get_theme()->get( 'Version' ) );
define('THEME_SLUG', strtolower( wp_get_theme()->get( 'Name' ) ) );

define('THEME_DIR', get_parent_theme_file_path() );
define('THEME_URI', get_theme_file_uri() );

define('JS_URI',  THEME_URI . '/assets/js');
define('JS_DIR',  THEME_DIR . '/assets/js');

define('CSS_URI', THEME_URI . '/assets/css');
define('CSS_DIR', THEME_DIR . '/assets/css');

define('IMG_URI', THEME_URI . '/assets/images');
define('IMG_DIR', THEME_DIR . '/assets/images');

// Define cache folder
$upload_dir    = wp_upload_dir();
$cache_folder  = '/WordFlex-cache';
$cache_dir     = $upload_dir['basedir'] . $cache_folder;
$cache_url     = $upload_dir['baseurl'] . $cache_folder;

define( 'CACHE_DIR', $cache_dir );
define( 'CACHE_URI', $cache_url );


if ( ! isset( $content_width ) ) $content_width = 900;

if ( ! function_exists( '_wf_theme_setup' ) ) {

	function _wf_theme_setup() {
		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on radix, use a find and replace
		 * to change 'radix' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'wordflex', THEME_DIR . '/languages' );

		// Theme Menus
		register_nav_menus( array(
			'primary'     => __( 'Primary', 'WordFlex' ),
			'footer-menu' => __( 'Footer Menu', 'WordFlex' ),
		) );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/**
		 * This feature enables Post Thumbnails support for a theme. Note that you can optionally pass a second argument, $args, with an
		 * array of the Post Types for which you want to enable this feature.
		 */
		add_theme_support( 'post-thumbnails', array( 'post' , 'portfolio' ) );
		
		/**
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * This feature allows the use of HTML5 markup for the search forms, comment forms, comment lists, gallery, and caption.
		 */
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary'     => __( 'Primary', 'wordflex' ),
			'footer-menu' => __( 'Footer Menu', 'wordflex' ),
		) );

		/**
		 * Registers an editor stylesheet for the theme.
		 */
		//add_editor_style( CSS_URI . '/editor-style.css' );
	}
}
add_action( 'after_setup_theme', '_wf_theme_setup' );



/**
 * Redux admin panel
 */
require_once THEME_DIR . '/admin/admin-init.php';
/** 
 * Enqueue styles, scripts
 */
require_once THEME_DIR . '/inc/enqueue.php';
/**
 * Widgets, Menu
 */
require_once THEME_DIR . '/inc/widgets.php';
/**
 * Template tags
 */
require_once THEME_DIR . '/inc/template-tags.php';
/**
 * Bootstrap Navwalker
 */
require_once THEME_DIR . '/inc/class-wp-bootstrap-navwalker.php';
/**
 * Load posts by Ajax
 */
require_once THEME_DIR . '/inc/ajax-posts.php';
/**
 * Post view count
 */
require_once THEME_DIR . '/inc/post-views.php';
/**
 * Post Feedback
 */
require_once THEME_DIR . '/inc/post-feedback.php';
/**
 * Bootstrap pagination
 */
require_once THEME_DIR . '/inc/bootstrap-pagination.php';
/**
 * Bootstrap breadcrumb
 */
require_once THEME_DIR . '/inc/bootstrap-breadcrumb.php';

/**
 * Schema Markup
 */
require_once THEME_DIR . '/inc/schema-markup.php';

/**
 * Add Extra Fields to WP profile page
 */
function extra_user_profile_fields( $user ) { ?>
	<!-- Start Extra fields -->
	<h3><?php _e("Social information", 'wordflex'); ?></h3>
	<table class="form-table">
		<tr>
			<th><label for="facebook"><?php _e("Facebook", 'wordflex'); ?></label></th>
			<td>
				<input name="author-facebook" id="author-facebook" value="<?php echo esc_attr( get_the_author_meta( 'author-facebook', $user->ID ) ); ?>" class="regular-text code" type="url">
				<?php wp_nonce_field( 'author-facebook', 'author_facebook_nonce' ); ?>
			</td>
		</tr>
		<tr>
			<th><label for="twitter"><?php _e("Twitter", 'wordflex'); ?></label></th>
			<td>
				<input name="author-twitter" id="author-twitter" value="<?php echo esc_attr( get_the_author_meta( 'author-twitter', $user->ID ) ); ?>" class="regular-text code" type="url">
				<?php wp_nonce_field( 'author-twitter', 'author_twitter_nonce' ) ?>
			</td>
		</tr>
		<tr>
			<th><label for="google"><?php _e("Google+", 'wordflex'); ?></label></th>
			<td>
				<input name="author-google" id="author-google" value="<?php echo esc_attr( get_the_author_meta( 'author-google', $user->ID ) ); ?>" class="regular-text code" type="url">
				<?php wp_nonce_field( 'author-google', 'author_google_nonce' ) ?>
			</td>
		</tr>
		<tr>
			<th><label for="linkedin"><?php _e("Linkedin", 'wordflex'); ?></label></th>
			<td>
				<input name="author-linkedin" id="author-linkedin" value="<?php echo esc_attr( get_the_author_meta( 'author-linkedin', $user->ID ) ); ?>" class="regular-text code" type="url">
				<?php wp_nonce_field( 'author-linkedin', 'author_linkedin_nonce' ) ?>
			</td>
		</tr>
		<tr>
			<th><label for="instagram"><?php _e("Instagram", 'wordflex'); ?></label></th>
			<td>
				<input name="author-instagram" id="author-instagram" value="<?php echo esc_attr( get_the_author_meta( 'author-instagram', $user->ID ) ); ?>" class="regular-text code" type="url">
				<?php wp_nonce_field( 'author-instagram', 'author_instagram_nonce' ) ?>
			</td>
		</tr>
	</table>
	<!-- End Extra fields -->
<?php }

add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

/**
 * [save_extra_user_profile_fields description]
 * @param  [int] $user_id [user ID]
 * @return save changes
 */
function save_extra_user_profile_fields( $user_id ) {
	if ( current_user_can('edit_user', $user_id) ) {
		// nonce check before save
		if ( check_admin_referer( 'author-facebook', 'author_facebook_nonce' ) ) {
			update_user_meta( $user_id, 'author-facebook', $_POST['author-facebook'] );
		}
		if( check_admin_referer( 'author-twitter', 'author_twitter_nonce' ) ) {
			update_user_meta( $user_id, 'author-twitter', $_POST['author-twitter'] );
		}
		if( check_admin_referer ('author-google', 'author_google_nonce') ) {
			update_user_meta( $user_id, 'author-google', $_POST['author-google'] );
		}
		if( check_admin_referer('author-linkedin', 'author_linkedin_nonce') ) {
			update_user_meta( $user_id, 'author-linkedin', $_POST['author-linkedin'] );
		}
		if( check_admin_referer('author-instagram', 'author_instagram_nonce') ) {
			update_user_meta( $user_id, 'author-instagram', $_POST['author-instagram'] );
		}
	}
}

add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );


/**
 * Posts feedback by Ajax
 * @return Ajax handle [inject to footer]
 */
function _wf_posts_feedback() { ?>
	<script>
		(function( $ ) {
			var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
			$(".btn-vote").click( function(e) {
				e.preventDefault();
				// Creat a new var to use it within the scope
				var btn = $(this);
				// Ajax data
				var data = {
					post_id: btn.data("id"),
					type: btn.data("type"),
					count: btn.data("count"),
					dataType: 'json',
					action: 'get_post_feedback',
					security: '<?php echo wp_create_nonce("feedback-nonce"); ?>'
				};

				var badge = btn.find('.badge');

				// Show pending icon
				$('.pending-ajax').show();
				$.post(ajaxurl, data, function(response) {
					// Hide pending icon
					$('.pending-ajax').hide();

					var result = $('.feedback-result').show();

					// If new person clicked it will return success
					if(response.success) {
						result.addClass('text-success').text(response.data);
						// Increment the vote counter
						badge.text(data.count + 1);					

						// If clicked add css classes
						if(data.type === 'positive') { 
							btn.addClass('voted-positive');
						}
						else {
							btn.addClass('voted-negative');
						}
					} 
					else {
						result.removeClass('text-success');
						result.addClass('text-danger').text(response.data);
					}
				});
				return false;
			});
		})( jQuery );
	</script>
<?php }
add_action('wp_footer', '_wf_posts_feedback', 20);


/**
 * Loading ajax posts
 * @return [script] [inject script to footer]
 */
function _wf_load_ajax_posts() { ?>
<script id="ajax_posts">
	(function( $ ) {
		var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
		var page = 2;
		$(".ajax-posts-btn").click( function() {
			var data = {
				'action': 'load_posts_by_ajax',
				'page': page,
				'security': '<?php echo wp_create_nonce("load_more_posts"); ?>'
			};
	        // Show pending icon
	        $('.pending-ajax').show();
	        $.post(ajaxurl, data, function(response) {
	            // Hide pending icon
	            $('.pending-ajax').hide();
	            $('.ajax-posts').append(response);
	            page++;
	            if ( $('.no-results').length > 0 ) $('.ajax-posts-btn').hide();
	        });
	    });
	})( jQuery );
</script>
<?php }
add_action( 'wp_footer', '_wf_load_ajax_posts', 21);


// add_filter('nav_menu_item_id', 'clear_nav_menu_item_id', 10, 3);
// function clear_nav_menu_item_id($id, $item, $args) {
//     return "";
// }

//    add_filter('nav_menu_css_class', 'discard_menu_classes', 10, 2);


// function discard_menu_classes($classes, $item) {
//     $classes = array_filter( 
//         $classes, 
//         create_function( '$class', 
//                  'return in_array( $class, 
//                       array( "current-menu-item", "current-menu-parent" ) );' )
//         );
//     return array_merge(
//         $classes,
//         (array)get_post_meta( $item->ID, '_menu_item_classes', true )
//         );
//     }


/*
 * Removes all wp_menu_nav classes EXCEPT 'current-menu-item'
 */
 
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
// function my_css_attributes_filter($var) {
//   return is_array($var) ? array('nav-item') : '';
// }
// 



// add_filter('nav_menu_css_class', 'discard_menu_classes', 10, 2);

// function discard_menu_classes($classes, $item) {
//     return (array)get_post_meta( $item->ID, '_menu_item_classes', true );
// }


/**
 * Load custom admin area scripts
 */
function radix_load_custom_admin_scripts() {
	wp_enqueue_style('radix-custom-admin', CSS_URI . '/custom-admin.css');
}
add_action('admin_enqueue_scripts', 'radix_load_custom_admin_scripts', 150);
