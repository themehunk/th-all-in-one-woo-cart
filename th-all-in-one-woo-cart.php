<?php
/**
 * Plugin Name:             All In One Advance Cart
 * Requires Plugins:        woocommerce
 * Plugin URI:              https://themehunk.com/th-all-in-one-woo-cart/
 * Description:             TH All In One Woo Cart is a perfect choice to display Cart on your website and improve your potential customer’s buying experience. This plugin will add Floating Cart in your website.  Customers can update or remove products from the cart without reloading the cart continuously. It is a fully Responsive, mobile friendly plugin and supports many advanced features.
 * Version:                 2.3.2
 * Author:                  ThemeHunk
 * License:                 GPL-2.0+
 * License URI:             http://www.gnu.org/licenses/gpl-2.0.txt
 * Author URI:              https://themehunk.com
 * Requires at least:       5.5
 * Tested up to:            6.9
 * WC requires at least:    3.2
 * WC tested up to:         9.9
 * Domain Path:             /languages
 * Text Domain:             th-all-in-one-woo-cart
 * Tags: floating cart,ajax,cart,woocommerce,advance cart,slider
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

    