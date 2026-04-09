<?php 

if ( ! defined( 'ABSPATH' ) ) exit;

function taiowc_track_table() {

    global $wpdb; 

    $table_name = $wpdb->prefix . 'taiowc_cart_tracking';

    $charset_collate = $wpdb->get_charset_collate();

    if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {

    $sql = "CREATE TABLE $table_name (
        id int(11) NOT NULL AUTO_INCREMENT,
        user_id varchar(100) NOT NULL,
        ip_address varchar(100),
        product_id int(11) NOT NULL,
        quantity int(5) NOT NULL,
        product_remove int(5) NOT NULL,
        date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        server_request text,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    dbDelta($sql);

}
}

function user_track_cart_callback() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'taiowc_cart_tracking'; 
    $user_table = $wpdb->users; 
    $results = $wpdb->get_results("
    SELECT t.id, t.user_id, u.user_login,u.user_email,SUM(t.quantity) AS total_quantity, MAX(t.date) AS updated_date
    FROM $table_name AS t
    LEFT JOIN $user_table AS u ON t.user_id = u.ID
    GROUP BY t.user_id, u.user_login, u.user_email
    ", ARRAY_A);
    return rest_ensure_response($results);
}

function register_user_track_endpoint() {
    register_rest_route('taiowc/v1', '/usercart/', array(
        'methods' => 'GET',
        'callback' => 'user_track_cart_callback',
        'permission_callback' => function( $request ) {
            return current_user_can( 'manage_options' );
        } 
    ));
}
add_action('rest_api_init', 'register_user_track_endpoint');


// user detail
add_action('rest_api_init', function () {
    register_rest_route('taiowc/v1', '/user/(?P<id>[a-zA-Z0-9_-]+)', array(
        'methods' => 'GET',
        'callback' => 'get_user_chart_details',
        'permission_callback' => function( $request ) {
            return current_user_can( 'manage_options' );
        }, // Adjust this based on your permission needs
    ));
});

function get_user_chart_details($request) {

    $user_id = $request->get_param('id');

    if (empty($user_id)) {
        return new WP_Error('no_user', 'User ID not provided', array('status' => 400));
    }

    global $wpdb;

    $table_name = $wpdb->prefix . 'taiowc_cart_tracking'; 

    $query = $wpdb->prepare(
        "SELECT product_id, quantity, product_remove FROM $table_name WHERE user_id = %s",
        $user_id
    );
    $results = $wpdb->get_results($query, ARRAY_A);
    $user_cart = array();
    foreach ($results as $item) {
    $product_id = $item['product_id'];
    $product = wc_get_product($product_id);
    if ($product) {
        $image_id = $product->get_image_id();
        $image_url = wp_get_attachment_image_src($image_id, 'thumbnail');
        $product_data = array(
            'product_id' => $product_id,
            'quantity' => $item['quantity'],
            'product_remove' => $item['product_remove'],
            'name' => $product->get_name(),
            'price' => $product->get_price_html(),
            'image_url' => $image_url[0],
            'product_link' => $product->get_permalink(),  
          );
          $user_cart[] = $product_data;
      }

    }
    return rest_ensure_response($user_cart);

}

/*********************/
// user product detail
/*********************/

function product_user_track_cart_callback() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'taiowc_cart_tracking'; 
    $user_table = $wpdb->users; 

    $results = $wpdb->get_results("
    SELECT t.product_id, COUNT(DISTINCT t.user_id) AS total_users
    FROM $table_name AS t
    GROUP BY t.product_id
    ", ARRAY_A);
    $product_data = array();
    foreach ($results as $item) {
        $product_id = $item['product_id'];
        $product = wc_get_product($product_id);
        if ($product) {
            $image_id = $product->get_image_id();
            $image_url = wp_get_attachment_image_src($image_id, 'thumbnail');
            $product_data1 = array(
                'product_id'   => $product_id,
                'name'         => $product->get_name(),
                'image_url'    => $image_url[0],
                'product_link' => $product->get_permalink(),  
                'total_user'   => $item['total_users'],  
            );
            $product_data[] = $product_data1; 
        }
    }
    return rest_ensure_response($product_data);
}

function register_product_user_track_endpoint() {
    register_rest_route('taiowc/v1', '/productusercart/', array(
        'methods' => 'GET',
        'callback' => 'product_user_track_cart_callback',
        'permission_callback' => function( $request ) {
            return current_user_can( 'manage_options' );
        }, // Adjust permissions as needed
    ));
}
add_action('rest_api_init', 'register_product_user_track_endpoint');


// product user detail
add_action('rest_api_init', function () {
    register_rest_route('taiowc/v1', '/productuser/(?P<productid>[a-zA-Z0-9_-]+)', array(
        'methods' => 'GET',
        'callback' => 'get_user_product_details',
        'permission_callback' => function( $request ) {
            return current_user_can( 'manage_options' );
        }, // Adjust this based on your permission needs
    ));
});

function get_user_product_details($request) {

    $product_id = $request->get_param('productid');

    if (empty($product_id)) {
        return new WP_Error('no_product', 'product ID not provided', array('status' => 400));
    }

    global $wpdb;

    $table_name = $wpdb->prefix . 'taiowc_cart_tracking'; 
    $user_table = $wpdb->prefix . 'users';

    $query = $wpdb->prepare("
        SELECT 
            t.user_id, 
            u.user_login, 
            u.user_email, 
            SUM(t.quantity) AS total_quantity, 
            MAX(t.date) AS updated_date,
            t.server_request,
            t.ip_address
        FROM $table_name AS t
        LEFT JOIN $user_table AS u ON t.user_id = u.ID
        WHERE t.product_id = %d
        GROUP BY t.user_id, u.user_login, u.user_email, t.server_request, t.ip_address
    ", $product_id);

    $results = $wpdb->get_results($query, ARRAY_A);
    
    return rest_ensure_response($results);

}

// delete cart user record data
function register_delete_user_endpoint() {
    register_rest_route('taiowc/v1', '/deleteuser/(?P<userid>[a-zA-Z0-9_-]+)', array(
        'methods' => 'DELETE',
        'callback' => 'cart_handle_delete_user',
        'permission_callback' => 'is_user_logged_in_and_can_delete',
    ));
}
add_action('rest_api_init', 'register_delete_user_endpoint');

function is_user_logged_in_and_can_delete() {
    return current_user_can('delete_users');
}

function cart_handle_delete_user($data) {
    global $wpdb;

    $user_id = sanitize_text_field($data['userid']); // Sanitize input
    $table_name = $wpdb->prefix . 'taiowc_cart_tracking';

    // Delete records where user_id matches
    $deleted = $wpdb->delete(
        $table_name,
        array('user_id' => $user_id),
        array('%s') // Data format, %s represents a string
    );

    if ($deleted === false) {
        return new WP_Error('delete_failed', __('Failed to delete records', 'taiowc'), array('status' => 500));
    }

    return rest_ensure_response(array('message' => __('Records deleted successfully', 'taiowc')));
}


function taiowc_cart_tracking() { ?>
<div id="taiowc-track-root"></div>
<?php }

add_action('taiowc_cart_track', 'taiowc_cart_tracking');


// Track system enable or not 

// Register setting and REST API endpoints
add_action('rest_api_init', function() {
    // Register the setting
    register_setting('taiowc-tracking-system', 'taiowc_track_system_enabled', [
        'type' => 'boolean',
        'description' => 'Enable or disable the track system',
        'default' => true,
        'sanitize_callback' => 'rest_sanitize_boolean',
    ]);
    // Register GET endpoint to fetch the setting
    register_rest_route('taiowc/v1', '/taiowc-track-system-enabled', [
        'methods' => 'GET',
        'callback' => function() {
            return rest_ensure_response(get_option('taiowc_track_system_enabled', true));
        },
        'permission_callback' => '__return_true', // Add this line
    ]);

    // Register POST endpoint to update the setting
    register_rest_route('taiowc/v1', '/taiowc-track-system-enabled', [
        'methods' => 'POST',
        'callback' => function(WP_REST_Request $request) {
            $enabled = $request->get_param('enabled');
            update_option('taiowc_track_system_enabled', $enabled);
            return rest_ensure_response(true);
        },
        'permission_callback' => function() {
            return current_user_can('manage_options');
        }
    ]);
});