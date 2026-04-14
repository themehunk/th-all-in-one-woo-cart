<?php
/**
 * Plugin Name:             All In One Advance Cart
 * Plugin URI:              https://themehunk.com
 * Version:                 3.3.4
 * Description:             TH All In One Woo Cart is a perfect choice to display Cart on your WooCommerce website to improve your potential customer’s buying experience. This plugin will add Floating Cart in your website.  Customers can update or remove products from the cart without reloading the cart continuously. It is a fully Responsive, mobile friendly plugin and supports many advanced features.
 * Author:                  ThemeHunk
 * Author URI:              https://themehunk.com
 * Requires at least:       4.8
 * Tested up to:            6.9
 * WC requires at least:    3.3
 * WC tested up to:         9.9
 * Domain Path:             /languages
 * Text Domain:             taiowc
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if (!defined('TAIOWC_PLUGIN_FILE')) {
    define('TAIOWC_PLUGIN_FILE', __FILE__);
}

if (!defined('TAIOWC_PLUGIN_URI')) {
    define( 'TAIOWC_PLUGIN_URI', plugin_dir_url( __FILE__ ) );
}

if (!defined('TAIOWC_PLUGIN_PATH')) {
    define( 'TAIOWC_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
}

if (!defined('TAIOWC_PLUGIN_DIRNAME')) {
    define( 'TAIOWC_PLUGIN_DIRNAME', dirname( plugin_basename( __FILE__ ) ) );
}

if (!defined('TAIOWC_PLUGIN_BASENAME')) {
    define( 'TAIOWC_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
}

if (!defined('TAIOWC_IMAGES_URI')) {
define( 'TAIOWC_IMAGES_URI', trailingslashit( plugin_dir_url( __FILE__ ) . 'images' ) );
}

if (!defined('TAIOWC_VERSION')) {

$plugin_data = get_file_data(__FILE__, array('version' => 'Version'), false);

define('TAIOWC_VERSION', $plugin_data['version']);

} 

/**
 * Declare the woo HPOS compatibility.
*/
function taiowc_hpos_compatibility() {
        if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
            \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', TAIOWC_PLUGIN_FILE, true );
        }
}
add_action( 'before_woocommerce_init', 'taiowc_hpos_compatibility');

require_once TAIOWC_PLUGIN_PATH . 'inc/taiowc-block.php';
require_once TAIOWC_PLUGIN_PATH . 'inc/themehunk-menu/admin-menu.php';
require_once TAIOWC_PLUGIN_PATH . '/inc/taiowc-option.php';
require_once TAIOWC_PLUGIN_PATH . '/inc/taiowc-nav-menu.php';
require_once TAIOWC_PLUGIN_PATH . '/inc/taiowc-admin-style.php';
require_once TAIOWC_PLUGIN_PATH . '/inc/taiowc-setting.php';
require_once TAIOWC_PLUGIN_PATH . '/inc/taiowc.php';
require_once TAIOWC_PLUGIN_PATH . '/inc/cart-tracking/taiowc-cart-track.php';
require_once TAIOWC_PLUGIN_PATH . '/inc/cart-tracking/taiowc-cart-track-front.php';     
register_activation_hook( __FILE__, 'taiowc_track_table');

    