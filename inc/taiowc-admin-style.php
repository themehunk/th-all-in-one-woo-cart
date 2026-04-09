<?php 
if ( ! defined( 'ABSPATH' ) ) exit;

/***Admin Custom Style********/

function taiowc_admin_style_pro(){ ?>

<style>

<?php 

if(taiowc_main()->taiowc_get_option( 'taiowc-show_cart' ) == false){ ?>

#taiowc-cart_style-wrapper,#taiowc-cart_open-wrapper,#taiowc-cart_styletaiowc-cart_style-section-1, .taiowc-cart_styletaiowc-cart_style-section-1{display:none;}

<?php }
?>

<?php 

if(taiowc_main()->taiowc_get_option( 'taiowc-cart_style' ) == 'style-2'){ ?>

#taiowc-fxd_cart_frm_left-wrapper,#taiowc-fxd_cart_frm_right-wrapper,#taiowc-fxd_cart_frm_btm-wrapper{display:none;}

<?php }
?>

<?php 

if(taiowc_main()->taiowc_get_option( 'taiowc-fxd_cart_position' ) == 'fxd-left'){ ?>

#taiowc-fxd_cart_frm_right-wrapper{display:none;}

<?php }
?>
<?php 

if(taiowc_main()->taiowc_get_option( 'taiowc-fxd_cart_position' ) == 'fxd-right'){ ?>

#taiowc-fxd_cart_frm_left-wrapper{display:none;}

<?php }
?>


<?php 

if(taiowc_main()->taiowc_get_option( 'taiowc-cart-icon' ) == 'icon-7'){ ?>

#taiowc-icon_url-wrapper{display:grid;}

<?php }
?>


<?php 

if(taiowc_main()->taiowc_get_option( 'taiowc-show_rld_product' ) == false){ ?>

#taiowc-product_may_like_tle-wrapper, #taiowc-choose_prdct_like-wrapper, #taiowc-product_may_like_id-wrapper, #taiowc-cart_styletaiowc-cart_style-section-3,.taiowc-cart_styletaiowc-cart_style-section-3{display:none;}

<?php }
?>

<?php 

if(taiowc_main()->taiowc_get_option( 'taiowc-show_shipping' ) == false){ ?>

#taiowc-ship_txt-wrapper{display:none;}

<?php }
?>

<?php 

if(taiowc_main()->taiowc_get_option( 'taiowc-show_discount' ) == false){ ?>

#taiowc-discount_txt-wrapper{display:none;}

<?php }

?>

<?php 

if(taiowc_main()->taiowc_get_option( 'taiowc-show_coupon' ) == false){ ?>

#taiowc-coupon_plchdr_txt-wrapper, #taiowc-coupon_aply_txt-wrapper, #taiowc-show_coupon_list-wrapper, #taiowc-coupon_btn_txt-wrapper,#taiowc-show_added_coupon-wrapper,#taiowc-cart_styletaiowc-cart_style-section-5, .taiowc-cart_styletaiowc-cart_style-section-5{display:none;}

<?php }
?>


<?php 

if(taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_notify_shw' ) == false){ ?>

#taiowc-success_mgs_bg_clr-wrapper, #taiowc-success_mgs_txt_clr-wrapper, #taiowc-error_mgs_bg_clr-wrapper, #taiowc-error_mgs_txt_clr-wrapper{display:none;}

<?php }

?>

<?php 

if(taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_icon_shw' ) == false){ ?>
	
#taiowc-cart_pan_icon_clr-wrapper{display:none;}

<?php }

?>

</style>
	
<?php }

add_action('admin_head', 'taiowc_admin_style_pro');