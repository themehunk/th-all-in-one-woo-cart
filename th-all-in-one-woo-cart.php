<?php
/**
 * Plugin Name:             TH All In One Woo Cart
 * Plugin URI:              https://themehunk.com
 * Description:             TH All in One Woo Cart is a perfect choice to display Cart on your website and improve your potential customer’s buying experience. This plugin will add Off canvas Cart in your website.  Your customers can update or remove products from the cart without reloading the cart continuously. It is mobile friendly and supports many advanced features with Color options for each elements.
 * Version:                 1.0.0
 * Author:                  ThemeHunk
 * Author URI:              https://themehunk.com
 * Requires at least:       4.8
 * Tested up to:            5.8.1
 * WC requires at least:    3.2
 * WC tested up to:         5.1
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

if (!class_exists('Taiowc')){
require_once("inc/taiowc.php");
}              