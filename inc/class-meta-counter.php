<?php
/**
 * WordFlex post meta count class
 *
 * @package WordFlex
 * @subpackage post meta count class
 * @link https://wordpress.stackexchange.com/questions/65222/views-count-with-time-limit-per-ip
 * @see single.php, temlpate-tags.php
 * @author awran5
 * 
 * @since 1.0
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

class PostMetaCounter {

    public $count_key  = 'views_count';
    public $duration   = 1;  // set to 24 hours (in minutes)
    public $post_id    = null;
    public $ip         = null;
    public $ip_meta    = array();
    public $timer      = array();
    public $count      = 0;

    public function __construct() {
        $this->post_id  = get_the_ID();
        $this->ip       = ip2long( $_SERVER['REMOTE_ADDR'] );
        $this->count    = (int) get_post_meta( $this->post_id, $this->count_key, true );
    }
    /**
     * Set the post meta key counter
     */
    public function setCount() {
        // Set the ip meta key 
        $ip_key = $this->count_key . '_ip';
        // Get the ip meta data
        $this->ip_meta = get_post_meta( $this->post_id, $ip_key );
        $this->timer   = isset( $this->ip_meta[0] ) ?  $this->ip_meta[0] : array();
        // Check if ip is already exists
        if( !$this->isCount() ) {
            $this->timer[$this->ip] = time();
            // Save IP and increase votes count
            update_post_meta( $this->post_id, $ip_key, $this->timer );
            update_post_meta( $this->post_id, $this->count_key, ++$this->count );
        }
    }
    
    /**
     * This will echo out the count when called
     * @return string Post meta key count
     */
    public function getCount() {
        if( $this->count == '' ) {
            delete_post_meta( $this->post_id, $this->count_key );
            add_post_meta   ( $this->post_id, $this->count_key, '0' );
            return esc_html__('0 View', 'wordflex');
        }
        return $this->count . esc_html__(' Views', 'wordflex');
    }

    /**
     * Check if user ip is recorded
     * @return boolean true/false
     */
    public function isCount() {
        if( in_array( $this->ip, array_keys( $this->timer ) ) ) {
            $countTime = $this->timer[$this->ip];
            $currentTime = time();
            // Compare between current time and vote time
            if( round( ($currentTime - $countTime) / 60 ) > $this->duration )
                return false;
            return true;
        }
        return false;
    }
}