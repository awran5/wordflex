<?php
/**
 * WordFlex post view count
 *
 * @package WordFlex
 * @subpackage Post view count
 * @link https://wordpress.stackexchange.com/questions/65222/views-count-with-time-limit-per-ip
 * @see content-single.php
 * @see temlpate-tags.php _wf_entry_footer()
 * 
 * @since 1.0
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;


class PostViewCount {
    /**
     * [$post_id] Post ID
     * @var integer
     */
    private $post_id = 0;
    /**
     * [$count] Counter
     * @var integer
     */
    private $count = 0;
    /**
     * [$ip] user IP
     * @var null
     */
    private $ip = null;
    /**
     * [$timer] Time limit per ip 
     * @var array
     */
    private $timer = array();

    function __construct() {
        $this->post_id  = get_the_ID();
        $this->ip       = ip2long( $_SERVER['REMOTE_ADDR'] );
    }

    /**
     * Set meta post count
     * @param [string] $key meta key to count
     * @param integer $duration set the count cooldown (in minutes)
     */
    public function setCount($key, $duration = 1) {
        $this->count = (int) get_post_meta( $this->post_id, $key, true );
        
        if( $this->count === '0' ) {
            delete_post_meta( $this->post_id, $this->count );
            delete_post_meta( $this->post_id, $ip_key );
            // Add new post meta
            add_post_meta( $this->post_id, $this->count, '0' );
            add_post_meta( $this->post_id, $ip_key, '0' );
        }
        else {
            $ip_key      = $key . '_ip';
            $ip_meta     = get_post_meta( $this->post_id, $ip_key);
            $this->timer = isset( $ip_meta[0] ) ? $ip_meta[0] : array();
            $countTime   = array();
            // Check if not counted already and not users can manage options
            if( !current_user_can('manage_options') && !$this-> isCount($duration) ) {
                $this->timer[$this->ip] = time();
                update_post_meta( $this->post_id, $ip_key, $this->timer );
                update_post_meta( $this->post_id, $key, ++$this->count );
            }    
        }
    }

    /**
     * Get the Counted post meta value
     * @param  [string] $key meta key 
     * @param  string $label show next to count when printed
     * @return [int] Key counter
     */
    public function getCount($key, $label = '') {
        return (int) get_post_meta( $this->post_id, $key, true ) . ' ' . $label;
    }

    /**
     * Check if the key is already counted and set the cooldown
     * @param  integer $duration in minutes
     * @return boolean
     */
    private function isCount($duration = 1) {
        if( in_array( $this->ip, array_keys( $this->timer ) ) ) {
            $countTime = $this->timer[$this->ip];
            $currentTime = time();
            // Compare between current time and vote time
            if( round( ($currentTime - $countTime) / 60 ) > $duration )
                return false;
            return true;
        }
        return false;
    }
}



























// /**
//  *  function to display number of posts views
//  * @param  [int] $postID [post ID]
//  * @return posts views
//  */
// function _wf_getPostViews( $postID ) {
// 	$count_key = 'post_views_count';
// 	$count = (int) get_post_meta($postID, $count_key, true);
// 	if( $count == '' ) {
// 		delete_post_meta($postID, $count_key);
// 		add_post_meta($postID, $count_key, '0');
// 		return esc_html__('0 View', 'wordflex');
// 	}
// 	return $count . esc_html__(' Views', 'wordflex');
// }

// /**
//  * function to set number of posts views
//  * @param  [int] $postID [post ID]
//  * @see https://code.tutsplus.com/articles/how-to-create-a-simple-post-rating-system-with-wordpress-and-jquery--wp-24474
//  * @return Post count
//  */
// function _wf_setPostViews( $postID ) {

//     // Retrieve user IP address
//     $ip = $_SERVER['REMOTE_ADDR'];

//     // Get voters'IPs for the current post
//     $meta_IP   = get_post_meta($postID, "viewer_IP");
//     $viewer_IP = $meta_IP[0];

//     if( !is_array( $viewer_IP ) ) $viewer_IP = array();

//     // Get votes count for the current post
//     $meta_count = get_post_meta( $postID, "post_views_count", true );

//     $duration = 360; // 24 hours
//     $viewTime = 0;

//     // If user has already voted
//     if( in_array( $ip, array_keys( $viewer_IP ) ) ) {
//         $viewTime = $viewer_IP[$ip];
//         $timeNow  = time();

//         // Compare between current time and vote time
//         if( round( ($timeNow - $viewTime) / 60 ) > $duration ) {
            
//            $viewer_IP[$ip] = time();
//             // Save IP and increase votes count
//             update_post_meta( $postID, "viewer_IP", $viewer_IP );
//             update_post_meta( $postID, "post_views_count", ++$meta_count );
//         }
//     }
// }



// /**
//  * Add a column for posts views in WP-Admin (optional)
//  * @param  [string] $defaults
//  * @return Post Views column name
//  */
// function _wf_posts_column_views( $defaults ) {
// 	$defaults['post_views'] = esc_html__('Post Views', 'wordflex');
// 	return $defaults;
// }
// add_filter('manage_posts_columns', '_wf_posts_column_views');

// /**
//  * Add the post views count to the new column
//  * @param  [string] $column_name
//  * @param  [int] $id  post ID
//  * @return Post view count
//  */
// function _wf_posts_custom_column_views( $column_name, $id ) {
// 	if($column_name === 'post_views'){
// 		echo _wf_getPostViews( get_the_ID() );
// 	}
// } 
// add_action('manage_posts_custom_column', '_wf_posts_custom_column_views', 5, 2);