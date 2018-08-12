<?php
/**
 * WordFlex post Feedback
 *
 * @package WordFlex
 * @subpackage Post Feedback
 * @link 
 * @see single.php
 * 
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Post feedback function
 * Saves voter IP into post_meta
 * @return retrieve post feedback count
 * 
 */
function _wf_get_post_feedback() {
    // Check nonce
    check_ajax_referer( 'feedback-nonce', 'security');
    
    // Retrieve user IP address
    $ip = $_SERVER['REMOTE_ADDR'];
    $postID   = (int) $_POST['post_id'];

    // Get voters'IPs for the current post
    $meta_IP  = get_post_meta($postID, "voter_IP");
    $voter_IP = $meta_IP[0];

    if( !is_array( $voter_IP ) ) $voter_IP = array();

    // Get post type 
    $post_type = in_array( $_POST['type'], array( 'positive', 'negative' ) ) ? $_POST['type'] : false;

    // Get votes count for the current post
    $meta_count = 0;
    if( $post_type ) $meta_count = (int) get_post_meta( $postID, $post_type, true );

    $message  = '';

    // Use has already voted ?
    if( !hasVoted( $postID ) ) {
        $voter_IP[$ip] = time();

        // Save IP and increase votes count
        update_post_meta( $postID, "voter_IP", $voter_IP );
        update_post_meta( $postID, $post_type, ++$meta_count );
        $message = esc_html__( 'Thanks for your feedback!', 'wordflex' );
        wp_send_json_success( $message );
    }
    else {
        $message = esc_html__( 'You have already recorded your feedback!', 'wordflex' );
        wp_send_json_error( $message );
    }
    wp_die();
}
add_action( 'wp_ajax_get_post_feedback', '_wf_get_post_feedback' );
add_action( 'wp_ajax_nopriv_get_post_feedback', '_wf_get_post_feedback' );


/**
 * Check if the user has already voted
 * Set time to 1 week @see $voteTime
 * @param  int $postID 
 * @return boolean true/false
 */
function hasVoted( $postID ) {
    $voteTime  =  10080; // 1 Week
    // Retrieve post votes IPs
    $meta_IP   = get_post_meta( $postID, "voter_IP" );
    $voter_IP  = $meta_IP[0];

    if( !is_array( $voter_IP) ) $voter_IP = array();

    // Retrieve current user IP
    $ip = $_SERVER['REMOTE_ADDR'];

    // If user has already voted
    if( in_array( $ip, array_keys( $voter_IP ) ) ) {
        $time = $voter_IP[$ip];
        $now = time();

        // Compare between current time and vote time
        if( round( ($now - $time) / 60 ) > $voteTime )
            return false;
        return true;
    }
    return false;
}
