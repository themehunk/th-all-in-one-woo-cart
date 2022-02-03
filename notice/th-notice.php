<?php

if (!defined('ABSPATH')){
    exit;
}

if ( ! class_exists( 'Taiowc_Notice' ) ){

class Taiowc_Notice{

    function __construct(){

        add_action( 'admin_enqueue_scripts', array($this,'taiowc_admin_enqueue_style') );
        add_action( 'admin_notices', array($this,'taiowc_admin_notice' ));

        
    }

    function taiowc_admin_enqueue_style(){

         wp_enqueue_style( 'taiowc-notice-style', TAIOWC_PLUGIN_URI.'notice/css/th-notice.css', array(), '1.0.0' );

    } 

    function taiowc_admin_notice() { ?>

    <div class="taiowc-notice notice notice-success is-dismissible">
        <div class="taiowc-notice-wrap">
            <div class="taiowc-notice-image"><img src="<?php echo esc_url( TAIOWC_PLUGIN_URI.'notice/img/cart-pro.png' );?>" alt="<?php _e('TH All In One Woo Cart Pro','taiowc'); ?>"></div>
            <div class="taiowc-notice-content-wrap">
                <div class="taiowc-notice-content">
                <p class="taiowc-heading"><?php _e('Increase your Woocommerce Store Usability With Th Menu Cart & Side Cart Premium','taiowc'); ?></p>
                <p><?php _e('Add Cross Sell , Related and Upsell products in the Cart to encourage the customer to add more products to the cart. You can also offer Coupon code in Cart','taiowc'); ?></p>
                </div>
                <a target="_blank" href="<?php echo esc_url('https://themehunk.com/th-all-in-one-woo-cart/');?>" class="upgradetopro-btn"><?php _e('Upgrade To Pro','taiowc');?> </a>
            </div>
        </div>
    </div>

    <?php }

    
}

$obj = New Taiowc_Notice();

 }
