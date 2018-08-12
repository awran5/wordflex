<?php
/**
* The header for our theme
*
* This is the template that displays all of the <head> section and everything up until <div id="content">
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package WordFlex
* @subpackage Twenty_Seventeen
* @since 1.0
* @version 1.0
*/
if ( ! defined( 'ABSPATH' ) ) exit; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<!-- Strat head -->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="description" content="<?php if ( is_single() ) {
        single_post_title('', true); 
    } else {
        bloginfo('name'); echo " - "; bloginfo('description');
    }
    ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php endif; ?>
    <link rel='dns-prefetch' href='//fonts.googleapis.com'>
    <!-- Favicons -->
    <link rel="icon" href="<?php echo IMG_URI ?>/favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo IMG_URI ?>/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="<?php echo IMG_URI ?>/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="<?php echo IMG_URI ?>/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="mask-icon" href="<?php echo IMG_URI ?>/safari-pinned-tab.svg">
    <?php wp_head() ?>
</head>
<!-- End head -->
<!-- Strat body -->
<body <?php body_class(); ?> <?php _wf_schema() ?>>
<a class="skip-link screen-reader-text" href="#content"><?php __( 'Skip to content', 'wordflex' ); ?></a>

    <?php
    if ( _wf_get_option('opt-header-layout') === '2') {
        get_template_part( 'template-parts/header/header-classic' );
    }
    elseif ( _wf_get_option('opt-header-layout') === '3') {
        get_template_part( 'template-parts/header/header-transparent' );
    }
    else {
        get_template_part( 'template-parts/header/header-inline' );
    } 