<?php
/**
 * Maintenance mode template that's shown to logged out users.
 *
 * @package maintenance-mode
 * @since radix 2.0
 *
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

header('HTTP/1.1 503 Service Temporarily Unavailable'); 
header('Status: 503 Service Temporarily Unavailable'); 
header('Retry-After: 600');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
	<meta name="viewport" content="width=device-width">
	<meta name='robots' content='noindex,follow' />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link href="<?php echo CSS_URI ?>/maintenance.css" rel="stylesheet" >
	<title><?php _e('Maintenance', 'wordflex') ?> | <?php echo get_bloginfo('name') ?></title>
</head>
<body id="error-page">
	<?php echo _wf_get_option('maintenance-text'); ?>
</body>
</html>