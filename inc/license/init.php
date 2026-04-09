<?php
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Taiowc_License' ) ) {

class Taiowc_License {

    private static $_instance = null;

    const OPTION_KEY = 'taiowc_pro_lkey';

    public static function instance() {
        if ( ! isset( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        add_action( 'wp_ajax_th_taiowc_pro_site_key', array( $this, 'license_site_key' ) );
        add_action( 'rest_api_init',                   array( $this, 'register_routes' ) );
        add_action( 'admin_enqueue_scripts',           array( $this, 'enqueue_license_script' ) );
    }

    public function enqueue_license_script( $hook ) {
        if ( ! isset( $_GET['page'] ) || $_GET['page'] !== 'taiowc' ) {
            return;
        }
        wp_enqueue_script(
            'th-taiowc-license-js',
            plugin_dir_url( __FILE__ ) . 'license.js',
            array( 'jquery' ),
            TAIOWC_VERSION,
            true
        );
        wp_localize_script( 'th-taiowc-license-js', 'thTaiowcLicense', array(
            'ajaxUrl'    => admin_url( 'admin-ajax.php' ),
            'nonce'      => wp_create_nonce( 'taiowc_plugin_nonce' ),
            'siteURL'    => home_url( '/' ),
            'isActive'   => self::is_active() ? 1 : 0,
            'isExpired'  => self::is_expired() ? 1 : 0,
            'expireDate' => self::get_expire_date(),
            'i18n'       => array(
                'empty_key'          => __( 'Please enter a valid license key.', 'taiowc' ),
                'activated'          => __( 'License key activated successfully.', 'taiowc' ),
                'save_failed'        => __( 'Failed to save license key locally.', 'taiowc' ),
                'ajax_failed'        => __( 'AJAX request failed. Please try again.', 'taiowc' ),
                'server_unreachable' => __( 'Could not reach the license server. Please check your internet connection.', 'taiowc' ),
                'reset_confirm'      => __( 'Are you sure you want to reset the license key?', 'taiowc' ),
                'reset_success'      => __( 'License key reset successfully.', 'taiowc' ),
                'generic'            => __( 'Something went wrong. Please try again.', 'taiowc' ),
                'noverify'           => __( 'Invalid license key.', 'taiowc' ),
                'limit'              => __( 'Exceeded license key limit. Purchase more licenses.', 'taiowc' ),
                'upgrade'            => __( 'Your license has expired. Please upgrade your plan.', 'taiowc' ),
                'data'               => __( 'Server data issue. Please try again.', 'taiowc' ),
                'lock_title'         => __( 'License Required', 'taiowc' ),
                'lock_desc'          => __( 'Activate your license to unlock this section.', 'taiowc' ),
                'lock_btn'           => __( 'Activate License', 'taiowc' ),
                'expired_title'      => __( 'License Expired', 'taiowc' ),
                'expired_desc'       => __( 'Your license has expired. Please renew to access this section.', 'taiowc' ),
                'expired_btn'        => __( 'Renew License', 'taiowc' ),
            ),
        ) );
    }

    /* ------------------------------------------------------------------ */
    /* REST API Route                                                       */
    /* ------------------------------------------------------------------ */

    public function register_routes() {
        register_rest_route( 'wp/v1', 'th-all-in-one-woo-cart-pro-api', array(
            'methods'             => 'POST',
            'callback'            => array( $this, 'rest_api_init' ),
            'permission_callback' => '__return_true',
        ) );
    }

    public function rest_api_init( WP_REST_Request $request ) {
        return json_encode( $this->get_option_key() );
    }

    /* ------------------------------------------------------------------ */
    /* AJAX Handler                                                         */
    /* ------------------------------------------------------------------ */

    public function license_site_key() {

        if ( ! isset( $_POST['security'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['security'] ) ), 'taiowc_plugin_nonce' ) ) {
            wp_send_json_error( array( 'message' => 'Invalid nonce.' ) );
            wp_die();
        }

        if ( isset( $_POST['data'] ) && current_user_can( 'manage_options' ) ) {
            $data = stripslashes( $_POST['data'] );
            $data = json_decode( $data )->data;
            $this->get_key_data( $data );
            exit();
        }
    }

    /* ------------------------------------------------------------------ */
    /* License Key Operations                                               */
    /* ------------------------------------------------------------------ */

    public function get_key_data( $data ) {
        if ( is_string( $data ) ) {
            switch ( $data ) {
                case 'key':
                    wp_send_json_success( $this->get_option_key() );
                    return;
                case 'reset':
                    wp_send_json_success( $this->reset_option_key() );
                    return;
            }
            // plain string key — preserve existing expire_date
            $existing    = $this->get_option_key();
            $expire_date = ( $existing && isset( $existing['expire_date'] ) ) ? $existing['expire_date'] : '';
            $this->update_key( $data, $expire_date );
        } else {
            // object sent from JS with key + expire_date
            $key         = isset( $data->key )         ? sanitize_text_field( $data->key )         : '';
            $expire_date = isset( $data->expire_date )  ? sanitize_text_field( $data->expire_date )  : '';
            $this->update_key( $key, $expire_date );
        }
        wp_send_json_success( array( 'update' => true ) );
    }

    public static function is_active() {
        $option_value = get_option( self::OPTION_KEY, false );
        if ( ! $option_value ) return false;
        $data = maybe_unserialize( $option_value );
        if ( empty( $data['key'] ) ) return false;
        if ( ! empty( $data['expire_date'] ) && strtotime( $data['expire_date'] ) < time() ) return false;
        return true;
    }

    public static function is_expired() {
        $option_value = get_option( self::OPTION_KEY, false );
        if ( ! $option_value ) return false;
        $data = maybe_unserialize( $option_value );
        if ( empty( $data['key'] ) ) return false;
        if ( ! empty( $data['expire_date'] ) && strtotime( $data['expire_date'] ) < time() ) return true;
        return false;
    }

    public static function get_expire_date() {
        $option_value = get_option( self::OPTION_KEY, false );
        if ( ! $option_value ) return '';
        $data = maybe_unserialize( $option_value );
        return isset( $data['expire_date'] ) ? $data['expire_date'] : '';
    }

    public function get_option_key() {
        $option_value = get_option( self::OPTION_KEY, false );
        if ( $option_value ) {
            return maybe_unserialize( $option_value );
        }
        return false;
    }

    public function update_key( $key, $expire_date = '' ) {
        update_option( self::OPTION_KEY, maybe_serialize( array(
            'key'         => $key,
            'expire_date' => $expire_date,
        ) ) );
    }

    public function reset_option_key() {
        return delete_option( self::OPTION_KEY );
    }

} // end class

function taiowc_license_init() {
    Taiowc_License::instance();
}
add_action( 'init', 'taiowc_license_init', 6 );

} // end class_exists check
