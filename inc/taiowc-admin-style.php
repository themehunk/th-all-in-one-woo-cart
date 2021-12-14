<?php 
if ( ! defined( 'ABSPATH' ) ) exit;

/***Admin Custom Style********/

function taiowc_admin_style(){?>

<style>
<?php 
if(taiowc()->get_option( 'show_cart' ) == false){ ?>

#cart_style-wrapper,#cart_open-wrapper,#taiowc_cart_styletaiowc_cart_style-section-1, .taiowc_cart_styletaiowc_cart_style-section-1{display:none;}

<?php }
?>

<?php 
if(taiowc()->get_option( 'cart_style' ) == 'style-2'){ ?>

#fxd_cart_frm_left-wrapper,#fxd_cart_frm_right-wrapper,#fxd_cart_frm_btm-wrapper{display:none;}

<?php }
?>

<?php 
if(taiowc()->get_option( 'fxd_cart_position' ) == 'fxd-left'){ ?>

#fxd_cart_frm_right-wrapper{display:none;}

<?php }
?>
<?php 
if(taiowc()->get_option( 'fxd_cart_position' ) == 'fxd-right'){ ?>

#fxd_cart_frm_left-wrapper{display:none;}

<?php }
?>


<?php 
if(taiowc()->get_option( 'cart-icon' ) == 'icon-7'){ ?>

#icon_url-wrapper{display:contents;}

<?php }
?>


<?php 
if(taiowc()->get_option( 'show_rld_product' ) == false){ ?>

#product_may_like_tle-wrapper, #choose_prdct_like-wrapper, #product_may_like_id-wrapper, #taiowc_cart_styletaiowc_cart_style-section-3,.taiowc_cart_styletaiowc_cart_style-section-3{display:none;}

<?php }
?>

<?php 
if(taiowc()->get_option( 'show_shipping' ) == false){ ?>

#ship_txt-wrapper{display:none;}

<?php }
?>

<?php 
if(taiowc()->get_option( 'show_discount' ) == false){ ?>

#discount_txt-wrapper{display:none;}

<?php }
?>

<?php 
if(taiowc()->get_option( 'show_coupon' ) == false){ ?>

#coupon_plchdr_txt-wrapper, #coupon_aply_txt-wrapper, #show_coupon_list-wrapper, #coupon_btn_txt-wrapper,#show_added_coupon-wrapper,#taiowc_cart_styletaiowc_cart_style-section-5, .taiowc_cart_styletaiowc_cart_style-section-5{display:none;}

<?php }
?>


<?php 

if(taiowc()->get_option( 'cart_pan_notify_shw' ) == false){ ?>

#success_mgs_bg_clr-wrapper, #success_mgs_txt_clr-wrapper, #error_mgs_bg_clr-wrapper, #error_mgs_txt_clr-wrapper{display:none;}

<?php }

?>

<?php 

if(taiowc()->get_option( 'cart_pan_icon_shw' ) == false){ ?>
	
#cart_pan_icon_clr-wrapper{display:none;}

<?php }

?>

</style>
	
<?php }

add_action('admin_head', 'taiowc_admin_style');