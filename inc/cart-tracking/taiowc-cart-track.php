<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class WooCommerce_Cart_Tracker {

    public function __construct() {

        if(get_option('taiowc_track_system_enabled') == true){
            add_action('woocommerce_add_to_cart', array($this, 'track_add_to_cart'), 10, 6);
            add_action('woocommerce_after_cart_item_quantity_update', array($this, 'track_cart_item_quantity_update'), 10, 3);
            add_action('woocommerce_remove_cart_item', array($this, 'track_remove_from_cart'), 10, 2);
        }
        
        add_action( 'admin_enqueue_scripts', array( $this, 'taiowc_cart_script_enqueue' ) );
    }
    

    public function taiowc_cart_script_enqueue(){

        $asset_file = require TAIOWC_PLUGIN_PATH .'build/taiowc-cart-track.asset.php';

        wp_enqueue_script(
            'taiowcCarttrack',
            TAIOWC_PLUGIN_URI . 'build/taiowc-cart-track.js',
            array_merge(
                $asset_file['dependencies']
            ),
            TAIOWC_VERSION,
            true
        );
    }

    public function track_add_to_cart($cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data) {
       
        global $wpdb;
    
        $table_name = $wpdb->prefix . 'taiowc_cart_tracking';
    
        $user_id = 0;
        $user_ip = '';
        $product_remove = 0;
    
        if (is_user_logged_in()) {
            $user_id = get_current_user_id();
        } else {
            // Check if the session exists
            if (WC()->session) {
                // Try to get the unique ID from the session
                $user_id = WC()->session->get('th_unique_user_id');
    
                // If the unique ID doesn't exist, create it and store it in the session
                if (!$user_id) {
                    $user_id = $this->generate_short_unique_id();
                    WC()->session->set('th_unique_user_id', $user_id);
                }
            } else {
                // Initialize the session and set the unique ID
                if (!WC()->session->has_session()) {
                    WC()->session->set_customer_session_cookie(true);
                }
                $user_id = $this->generate_short_unique_id();
                WC()->session->set('th_unique_user_id', $user_id);
            }
    
            $user_ip = $this->get_user_ip_addres();
        }
        
        $server_request = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null;
        $date = current_time('mysql');
    
        $wpdb->query(
            $wpdb->prepare(
                "INSERT INTO $table_name (user_id, ip_address, product_id, quantity, product_remove, date, server_request) 
                 VALUES (%s, %s, %d, %d, %d, %s, %s)",
                $user_id,
                $user_ip,
                $product_id,
                $quantity,
                $product_remove,
                $date,
                $server_request
            )
        );
    }
    

    public function track_cart_item_quantity_update($cart_item_key, $quantity, $old_quantity) {
       
        global $wpdb;

        $table_name = $wpdb->prefix . 'taiowc_cart_tracking';

        $cart = WC()->cart->get_cart()[$cart_item_key];
        $product_id = $cart['product_id'];

        $user_id = 0;
        
        if (is_user_logged_in()) {
            $user_id = get_current_user_id();
        } else {
            // Check if the session exists
            if (WC()->session) {
                // Try to get the unique ID from the session
                $user_id = WC()->session->get('th_unique_user_id');
    
                // If the unique ID doesn't exist, create it and store it in the session
                if (!$user_id) {
                    $user_id = $this->generate_short_unique_id();
                    WC()->session->set('th_unique_user_id', $user_id);
                }
            } else {
                // Initialize the session and set the unique ID
                if (!WC()->session->has_session()) {
                    WC()->session->set_customer_session_cookie(true);
                }
                $user_id = $this->generate_short_unique_id();
                WC()->session->set('th_unique_user_id', $user_id);
            }
    
            // $user_ip = $this->get_user_ip_addres();
        }

        $date = current_time('mysql');

        $wpdb->query(
            $wpdb->prepare(
                "UPDATE $table_name 
                 SET quantity = %d, date = %s 
                 WHERE user_id = %s AND product_id = %d",
                $quantity,
                $date,
                $user_id,
                $product_id,
            )
          );
        
    }

    public function track_remove_from_cart($cart_item_key, $cart) {

        global $wpdb;

        $table_name = $wpdb->prefix . 'taiowc_cart_tracking';

        $cart_item  = $cart->removed_cart_contents[$cart_item_key];
        $product_id = $cart_item['product_id'];
        $quantity   = $cart_item['quantity'];
        $Rquantity  = $quantity;

        $date = current_time('mysql');

        $user_id = 0;
        
        if (is_user_logged_in()) {
            $user_id = get_current_user_id();
        } else {
            // Check if the session exists
            if (WC()->session) {
                // Try to get the unique ID from the session
                $user_id = WC()->session->get('th_unique_user_id');
    
                // If the unique ID doesn't exist, create it and store it in the session
                if (!$user_id) {
                    $user_id = $this->generate_short_unique_id();
                    WC()->session->set('th_unique_user_id', $user_id);
                }
            } else {
                // Initialize the session and set the unique ID
                if (!WC()->session->has_session()) {
                    WC()->session->set_customer_session_cookie(true);
                }
                $user_id = $this->generate_short_unique_id();
                WC()->session->set('th_unique_user_id', $user_id);
            }
    
            $user_ip = $this->get_user_ip_addres();
        }

        $wpdb->query(
            $wpdb->prepare(
              "UPDATE $table_name 
               SET product_remove = %d, date = %s WHERE user_id = %s AND product_id = %d",
              $Rquantity,
              $date,
              $user_id,
              $product_id, 
            )
          );
        
    }

    public function get_user_ip_addres(){
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = esc_html__('UNKNOWN','taiowc');
        return $ipaddress;
     }

     public function generate_short_unique_id() {
        // Generate a unique ID with prefix 'th_guest_' and microseconds
        $unique_id = uniqid();
        // Remove dots from the generated ID
        $unique_id = str_replace('.', '', $unique_id);

        return substr($unique_id, 0, 15);
    }


}
new WooCommerce_Cart_Tracker();         