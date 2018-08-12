<?php
/**
* Redux option panel functions
*
*
* @link 
*
* @package WordFlex
* @subpackage Redux
* @since 1.0
* @version 1.0
*/
if ( ! defined( 'ABSPATH' ) ) exit;



/**
 * Set Redux option global var
 * @param  option
 * @return Redux Global var
 */
function _wf_get_option($option) {
	global $wf_settings;
	
	if( isset($wf_settings[$option]) ) {
		return $wf_settings[$option];
	} else {
		return false;
	}
}


/**
 * cridet to crunchify
 * @link http://crunchify.com/how-to-create-social-sharing-button-without-any-plugin-and-script-loading-wordpress-speed-optimization-goal/
 * @package post socials share
 */
if( _wf_get_option ('opt-post-socials') ) {
	function _wf_posts_social_sharing($content) {
		global $post;

		if( is_singular() && !is_page() ) {

			// Share text 
			$postText =  esc_html__("Share this: ", 'wordflex');
			// Get current page URL 
			$postURL = urlencode( get_permalink() );
			// Get post Author
			$postAuthor = get_the_author();
			// Get current page title
			$shareTitle = str_replace( ' ', '%20', get_the_title());
			
			// Get Post Thumbnail for pinterest
			$postThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

			// Construct sharing URL without using any script
			$twitterURL  = 'https://twitter.com/intent/tweet?text=' . $shareTitle . '&amp;url=' . $postURL . '&amp;via=' . $postAuthor . '';
			$facebookURL = 'https://www.facebook.com/sharer.php?m2w&s=100&p&url='. $postURL;
			$googleURL   = 'https://plus.google.com/share?url=' . $postURL;
			$whatsappURL = 'whatsapp://send?text=' . $shareTitle . ' ' . $postURL;
			$linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $postURL . '&amp;title=' . $shareTitle;

			// Based on popular demand added Pinterest too
			$pinterestURL = 'https://pinterest.com/pin/create/button/?url=' . $postURL . '&amp;media=' . $postThumbnail[0] .'&amp;description=' . $shareTitle;

			// Add sharing button at the end of page/page content
			$content .= '<div class="mt-5 text-center text-md-left post-social top-link-break">';
			$content .= '<div class="my-2 sharing-text">' . $postText . '</div>';

			$content .= '<ul class="list-inline text-center text-md-left gallery-social">
    <li class="list-inline-item">
        <a class="twitter" itemprop="url" title="twitter" href="' . $twitterURL . '" target="blank">
            <i class="fab fa-twitter"></i><span class="screen-reader-text">Twitter</span>
        </a>
    </li>
    <li class="list-inline-item">
        <a class="facebook" itemprop="url" title="facebook" href="' . $facebookURL . '" target="blank">
            <i class="fab fa-facebook-f"></i><span class="screen-reader-text">Facebook</span>
        </a>
    </li>
    <li class="list-inline-item">
        <a class="google" itemprop="url" title="google+" href="' . $googleURL . '" target="blank">
            <i class="fab fa-google-plus-g"></i><span class="screen-reader-text">Google+</span>
        </a>
    </li>
    <li class="list-inline-item">
        <a class="linkedin" itemprop="url" title="linkedin" href="'. $linkedInURL . '" target="blank">
            <i class="fab fa-linkedin-in"></i><span class="screen-reader-text">LinkedIn</span>
        </a>
    </li>
    <li class="list-inline-item">
        <a class="pinterest" itemprop="url" title="pinterest" href="' . $pinterestURL . '" target="blank">
            <i class="fab fa-pinterest"></i><span class="screen-reader-text">Pinterest</span>
        </a>
    </li>
</ul>';

			
			$content .= '</div>';
			
			return $content;
		} 
		else {
		// if not a post/page then don't include sharing button
			return $content;
		}
	}
	add_filter( 'the_content', '_wf_posts_social_sharing');
}

/**
 * Disable WordPress emoji
 */
if( _wf_get_option('opt-disable-emoji') ) {
	/**
	 * Disable the emoji's
	 */
	function disable_emojis() {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
		add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
	}
	add_action( 'init', 'disable_emojis' );

	/**
	 * Filter function used to remove the tinymce emoji plugin.
	 * 
	 * @param array $plugins 
	 * @return array Difference betwen the two arrays
	 */
	function disable_emojis_tinymce( $plugins ) {
		if ( is_array( $plugins ) ) {
			return array_diff( $plugins, array( 'wpemoji' ) );
		} else {
			return array();
		}
	}

	/**
	 * Remove emoji CDN hostname from DNS prefetching hints.
	 *
	 * @param array $urls URLs to print for resource hints.
	 * @param string $relation_type The relation type the URLs are printed for.
	 * @return array Difference betwen the two arrays.
	 */
	function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
		if ( 'dns-prefetch' == $relation_type ) {
			/** This filter is documented in wp-includes/formatting.php */
			$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

			$urls = array_diff( $urls, array( $emoji_svg_url ) );
		}

		return $urls;
	}
}

/**
 * Change login page logo & background
 * @return login_head hook
 */
function _wf_login_logo() {

	$logo   = _wf_get_option( 'opt-login-logo');
	$width  = _wf_get_option( 'opt-login-logo-width' ); 
	$height = _wf_get_option( 'opt-login-logo-height' ); 
	$bg     = _wf_get_option( 'opt-login-bg');

	if( !empty($logo['url']) ) { ?>
		<style id="custom_login_logo">
			#login h1 a, .login h1 a {
				background-image: url( '<?php echo $logo['url'] ?>' );
				background-size: <?php echo $width ?>px;
				height: <?php echo $height ?>px;
				background-position: center center;
				width: <?php echo $width ?>px;
				margin: 3rem auto 
			}
		</style>
	<?php }
	if( !empty( $bg['url'] ) ) { ?>

	<style id="custom_login_bg">
		body {
			background-image: url('<?php echo $bg['url'] ?>');
			background-position: center center;
			background-repeat: no-repeat;
			background-attachment: fixed;
			-webkit-background-size: cover;
			background-size: cover;
		}
	</style>
	<?php } ?>
<?php }
add_action( 'login_head', '_wf_login_logo' );

/**
 * Change login page logo url
 * @return login_headerurl hook
 */
function _wf_login_logo_url() {
	return home_url();
}
add_filter( 'login_headerurl', '_wf_login_logo_url' );

/**
 * Change login page logo title
 * @return login_headertitle hook
 */
function _wf_login_logo_url_title() {
	return get_bloginfo( 'name' );
}
add_filter( 'login_headertitle', '_wf_login_logo_url_title' );


/* Maintenance mode.*/
function _wf_maintenance_mode() {
	if ( file_exists( ABSPATH . '.maintenance' ) || wp_installing() )
		return;

	global $upgrading;

	if ( ! _wf_get_option ('opt-maintenance-mode') ) {
		return;
	}

	if ( ! is_user_logged_in() ) {
		require_once THEME_DIR . '/admin/maintenance.php';
		die();
	}
}
add_action('get_header', '_wf_maintenance_mode');


/**
 * [radix_generate_option_to_head description]
 * @return [type] [add favicons and custom css]
 */
function _wf_option_to_head() {
	// Custom CSS
	$custom_css = trim(preg_replace( '/\s+/', ' ', _wf_get_option('opt-custom-css')));
	if(!empty( $custom_css) ) {
		echo '<style media="all">' . $custom_css . '</style>';
	}
}
add_action('wp_head', '_wf_option_to_head', 150);



/* Get image option url */
function _wf_get_option_media_url($option) {
	$media = _wf_get_option($option);
	if( isset($media['url'] ) && !empty($media['url']) ) {
		return $media['url'];
	}
	return false;
}


/**
 * Additional JS output into theme footer if specified in theme options
 * @return [string] [custom js code]
 */
function _wf_additional_js() {
	/* Additional JS */
	$custom_js = trim(preg_replace( '/\s+/', ' ', _wf_get_option('opt-custom-js')));
	if(!empty($custom_js)) {
		echo '
		<script id="custom_js">
		/* <![CDATA[ */ ' . $custom_js . '; /* ]]> */
		</script>';
	}
	/* Google Analytics (tracking) */
	if($ga = _wf_get_option('ga')) {
		echo $ga;
	}
}
add_action('wp_footer', '_wf_additional_js', 110);

/**
 * Excerpt Length Control
 */
function set_excerpt_length($length) {
	return _wf_get_option('opt-excerpt-length');
}
add_filter('excerpt_length', 'set_excerpt_length');


/**
 * Author Socials 
 * @param  [string] $classes [Adding custom css classes]
 * @return
 */
function _wf_author_socials ($classes) {

	$twitter    = get_the_author_meta( 'author-twitter' );
	$facebook   = get_the_author_meta( 'author-facebook' ); 
	$google     = get_the_author_meta( 'author-google' );
	$instagram  = get_the_author_meta( 'author-instagram' );
	$linkedin   = get_the_author_meta( 'author-linkedin' );
	?>
	<!-- Start author-social-bar -->
	<ul class="list-inline <?php echo $classes ?> auther-social">
		<?php if( !empty($twitter) ) { ?>
		<li class="list-inline-item">
			<a class="twitter" itemprop="url" title="twitter" href="<?php echo $twitter ?>" target="blank">
				<i class="fab fa-twitter"></i><span class="screen-reader-text"><?php echo esc_html__('Twitter') ?></span>
			</a>
		</li>
		<?php } ?>
		<?php if( !empty($facebook) ) { ?>
		<li class="list-inline-item">
			<a class="facebook" itemprop="url" title="facebook" href="<?php echo $facebook ?>" target="blank">
				<i class="fab fa-facebook-f"></i><span class="screen-reader-text"><?php echo esc_html__('Facebook') ?></span>
			</a>
		</li>
		<?php } ?>
		<?php if( !empty($google) ) { ?>
		<li class="list-inline-item">
			<a class="google" itemprop="url" title="google+" href="<?php echo $google ?>" target="blank">
				<i class="fab fa-google-plus-g"></i><span class="screen-reader-text"><?php echo esc_html__('Google+') ?></span>
			</a>
		</li>
		<?php } ?>
		<?php if( !empty($linkedin) ) { ?>
		<li class="list-inline-item">
			<a class="linkedin" itemprop="url" title="linkedin" href="<?php echo $linkedin ?>" target="blank">
				<i class="fab fa-linkedin-in"></i><span class="screen-reader-text"><?php echo esc_html__('LinkedIn') ?></span>
			</a>
		</li>
		<?php } ?>
		<?php if( !empty($instagram) ) { ?>
		<li class="list-inline-item">
			<a class="instagram" itemprop="url" title="instagram" href="<?php echo $instagram ?>">
				<i class="fab fa-instagram"></i></i><span class="screen-reader-text"><?php echo esc_html__('Instagram') ?></span>
			</a>
		</li>
		<?php } ?>
	</ul>
	<!-- End author-social-bar -->
	<?php
}


function _wf_header_contacts ($classes = '') { ?>
	<ul class="list-inline text-center <?php echo $classes ?> m-1 header-contact">
	    <?php
	        $phone_text = _wf_get_option('opt-phone-text');
	        $header_email = _wf_get_option('opt-email-text');
	        $header_html = _wf_get_option('opt-header-html');

	        if ( !empty ($phone_text) ) { ?>
	        <li class="list-inline-item header-phone" itemprop="telephone">
	            <a href="tel:+1<?php echo $phone_text ?>"><i class="fas fa-phone"></i> <?php echo $phone_text ?></a>
	        </li> 
	        <?php } 

	        if( !empty($header_email) ) { ?>
	        <li class="list-inline-item header-email" itemprop="email">
	            <a href="<?php echo $header_email ?>"><i class="fas fa-envelope"></i> <?php echo $header_email ?></a> 
	        </li>
	        <?php }

	        if( !empty($header_html) ) { ?>
	        <li class="list-inline-item header-html">
	            <?php echo $header_html ?>
	        </li>
	        <?php }
	    ?>
	</ul>
	<?php
}

function _wf_header_socials ($classes = '') {

	$twitter    = _wf_get_option('header-twitter');
	$facebook   = _wf_get_option('header-facebook'); 
	$google     = _wf_get_option('header-google-plus');
	$pinterest  = _wf_get_option('header-pinterest');
	$instagram  = _wf_get_option('header-instagram');
	$linkedin   = _wf_get_option('header-linkedin');
	?>

	<ul class="list-inline text-center <?php echo $classes ?> m-1 header-social">
	   <?php if( !empty($twitter) ) { ?>
	    <li class="list-inline-item">
	        <a class="twitter" itemprop="url" title="twitter" href="<?php echo $twitter ?>">
	            <i class="fab fa-twitter"></i><span class="screen-reader-text"><?php echo esc_html__('Twitter') ?></span>
	        </a>
	    </li>
	    <?php } ?>
	    <?php if( !empty($facebook) ) { ?>
	    <li class="list-inline-item">
	        <a class="facebook" itemprop="url" title="facebook" href="<?php echo $facebook ?>">
	            <i class="fab fa-facebook-f"></i><span class="screen-reader-text"><?php echo esc_html__('Facebook') ?></span>
	        </a>
	    </li>
	    <?php } ?>
	    <?php if( !empty($google) ) { ?>
	    <li class="list-inline-item">
	        <a class="google" itemprop="url" title="google+" href="<?php echo $google ?>">
	            <i class="fab fa-google-plus-g"></i><span class="screen-reader-text"><?php echo esc_html__('Google+') ?></span>
	        </a>
	    </li>
	    <?php } ?>
	    <?php if( !empty($pinterest) ) { ?>
	    <li class="list-inline-item">
	        <a class="pinterest" itemprop="url" title="pinterest" href="<?php echo $pinterest ?>">
	            <i class="fab fa-pinterest"></i><span class="screen-reader-text"><?php echo esc_html__('Pinterest') ?></span>
	        </a>
	    </li>
	    <?php } ?>
	    <?php if( !empty($instagram) ) { ?>
	    <li class="list-inline-item">
	        <a class="instagram" itemprop="url" title="instagram" href="<?php echo $instagram ?>">
	            <i class="fab fa-instagram"></i></i><span class="screen-reader-text"><?php echo esc_html__('Instagram') ?></span>
	        </a>
	    </li>
	    <?php } ?>
	    <?php if( !empty($linkedin) ) { ?>
	    <li class="list-inline-item">
	        <a class="linkedin" itemprop="url" title="linkedin" href="<?php echo $linkedin ?>">
	            <i class="fab fa-linkedin-in"></i><span class="screen-reader-text"><?php echo esc_html__('LinkedIn') ?></span>
	        </a>
	    </li>
	    <?php } ?>
	</ul>
	<?php 
}


/**
 * Add this to the functions.php file of your WordPress theme
 * It filters the mime types using the upload_mimes filter hook
 * Add as many keys/values to the $mimes Array as needed
 * @param  array  $mimes [description]
 * @return [type]        [description]
 */
function _wf_custom_upload_mimes($mimes = array()) {

	// Add a key and value for the svg file type
	$mimes['svg'] = "image/svg+xml";

	return $mimes;
}

add_action('upload_mimes', '_wf_custom_upload_mimes');