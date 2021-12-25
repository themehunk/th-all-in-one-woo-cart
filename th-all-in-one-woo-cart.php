<?php
/**
 * Plugin Name:             TH All In One Woo Cart
 * Plugin URI:              https://themehunk.com/th-all-in-one-woo-cart/
 * Description:             TH All in One Woo Cart is a perfect choice to display Cart on your website and improve your potential customer’s buying experience. This plugin will add Off canvas Cart in your website.  Your customers can update or remove products from the cart without reloading the cart continuously. It is mobile friendly and supports many advanced features with Color options for each elements.
 * Version:                 1.0.1
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

/**
* Add the settings link to plugin row
*
* @param array $links - Links for the plugin
* @return array - Links
 */

function taiowc_plugin_action_links($links){
          $settings_page = add_query_arg(array('page' => 'taiowc'), admin_url());
          $settings_link = '<a href="'.esc_url($settings_page).'">'.__('Settings', 'taiowc' ).'</a>';
          array_unshift($links, $settings_link);
          return $links;
        }
add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'taiowc_plugin_action_links', 10, 1);

/**
   * Add links to plugin's description in plugins table
   *
   * @param array  $links  Initial list of links.
   * @param string $file   Basename of current plugin.
   *
   * @return array
   */
if ( ! function_exists( 'taiowc_plugin_meta_links' ) ){

  function taiowc_plugin_meta_links($links, $file){

    if ($file !== plugin_basename(__FILE__)) {
      return $links;
    }

    $demo_link = '<a target="_blank" href="#" title="' . __('Live Demo', 'taiowc') . '"><span class="dashicons  dashicons-laptop"></span>' . __('Live Demo', 'taiowc') . '</a>';

    $doc_link = '<a target="_blank" href="#" title="' . __('Documentation', 'taiowc') . '"><span class="dashicons  dashicons-search"></span>' . __('Documentation', 'taiowc') . '</a>';

    $support_link = '<a target="_blank" href="#" title="' . __('Support', 'taiowc') . '"><span class="dashicons  dashicons-admin-users"></span>' . __('Support', 'taiowc') . '</a>';

    $pro_link = '<a target="_blank" href="#" title="' . __('Premium Version', 'taiowc') . '"><span class="dashicons  dashicons-cart"></span>' . __('Premium Version', 'taiowc') . '</a>';


    $links[] = $demo_link;
    $links[] = $doc_link;
    $links[] = $support_link;
    $links[] = $pro_link;

    return $links;

  } // plugin_meta_links

}
add_filter('plugin_row_meta', 'taiowc_plugin_meta_links', 10, 2);