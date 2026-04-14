<?php 
if ( ! defined( 'ABSPATH' ) ) exit;

/***Front Custom Style********/

function taiowc_style_pro($taiowc_custom_css=''){

if(taiowc_main()->taiowc_get_option( 'taiowc-show_cart' ) == true){

	$taiowc_custom_css.=".cart_fixed_2 .taiowc-content h4{display:block}";
}

// top cart 
$taiowc_tpcrt_prc_font_size    = taiowc_main()->taiowc_get_option( 'taiowc-prc_font_size' );
$taiowc_tpcrt_icon_size        = taiowc_main()->taiowc_get_option( 'taiowc-icon_size' );
$taiowc_tpcrt_bg_clr           = taiowc_main()->taiowc_get_option( 'taiowc-bg_clr' );
$taiowc_tpcrt_price_clr        = taiowc_main()->taiowc_get_option( 'taiowc-price_clr' );
$taiowc_tpcrt_quantity_bg_clr  = taiowc_main()->taiowc_get_option( 'taiowc-quantity_bg_clr' );
$taiowc_tpcrt_quantity_clr     = taiowc_main()->taiowc_get_option( 'taiowc-quantity_clr' );
$taiowc_tpcrt_cart_icon_clr    = taiowc_main()->taiowc_get_option( 'taiowc-cart_icon_clr' );

$taiowc_custom_css.=".taiowc-wrap{background-color:{$taiowc_tpcrt_bg_clr}} .taiowc-content .taiowc-total{color:{$taiowc_tpcrt_price_clr}; font-size:{$taiowc_tpcrt_prc_font_size}px;} .taiowc-wrap .cart-count-item{background-color:{$taiowc_tpcrt_quantity_bg_clr}; color:{$taiowc_tpcrt_quantity_clr};} .taiowc-icon img{width:{$taiowc_tpcrt_icon_size}px;} .taiowc-icon{color:{$taiowc_tpcrt_cart_icon_clr};} .taiowc-icon{width:{$taiowc_tpcrt_icon_size}px;}";

if(taiowc_main()->taiowc_get_option( 'taiowc-show_quantity' ) != true || taiowc_main()->taiowc_get_option( 'taiowc-show_quantity' ) == ''){

 $taiowc_custom_css.=".taiowc-wrap:not(.taiowc-fixed-cart) .cart-count-item{display:none;}";

}

if(taiowc_main()->taiowc_get_option( 'taiowc-icon_bold' )== true){

 $taiowc_custom_css.=".taiowc-icon .th-icon,.cart-heading .th-icon{font-weight:bold}"; 

}

// fixed cart 

$taiowc_fxcrt_icon_size      = taiowc_main()->taiowc_get_option( 'taiowc-fxcrt_icon_size' );
$taiowc_fxcrt_icon_brd_rds      = taiowc_main()->taiowc_get_option( 'taiowc-fxcrt_icon_brd_rds' );
$taiowc_fxcrt_cart_bg_clr       = taiowc_main()->taiowc_get_option( 'taiowc-fxcrt_cart_bg_clr' );
$taiowc_fxcrt_cart_icon_clr     = taiowc_main()->taiowc_get_option( 'taiowc-fxcrt_cart_icon_clr' );
$taiowc_fxcrt_cart_tle_clr     = taiowc_main()->taiowc_get_option( 'taiowc-fxcrt_cart_tle_clr' );
$taiowc_fxcrt_qnty_bg_clr       = taiowc_main()->taiowc_get_option( 'taiowc-fxcrt_qnty_bg_clr' );
$taiowc_fxcrt_qnty_clr          = taiowc_main()->taiowc_get_option( 'taiowc-fxcrt_qnty_clr' );

$taiowc_custom_css.=" 

.taiowc-fixed-cart .taiowc-icon,.cart_fixed_1 .taiowc-content .taiowc-icon img{width:{$taiowc_fxcrt_icon_size}px;} 
.cart_fixed_1 .taiowc-cart-item,.cart_fixed_2.taiowc-wrap{border-radius:{$taiowc_fxcrt_icon_brd_rds}px;} 
.cart_fixed_1 .taiowc-cart-item,.cart_fixed_2.taiowc-wrap{background-color:{$taiowc_fxcrt_cart_bg_clr};} 
.cart_fixed_1 .taiowc-icon,
.cart_fixed_2 .taiowc-icon{color:{$taiowc_fxcrt_cart_icon_clr};} 
.taiowc-fixed-cart .taiowc-total,.taiowc-fixed-cart .taiowc-content:hover{color:{$taiowc_fxcrt_cart_tle_clr};}
.cart_fixed_1 .cart-count-item{background-color:{$taiowc_fxcrt_qnty_bg_clr}; color:{$taiowc_fxcrt_qnty_clr};}";

if(taiowc_main()->taiowc_get_option( 'taiowc-fxcrt_show_quantity' ) != true){

 $taiowc_custom_css.=".cart_fixed_1 .cart-count-item,.cart_fixed_2 .cart-count-item{display:none;}";

}

// cart panel style

$taiowc_cart_pan_icon_shw    = taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_icon_shw' );
$taiowc_cart_pan_icon_clr    = taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_icon_clr' );
$taiowc_cart_pan_hd_clr      = taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_hd_clr' );
$taiowc_cart_pan_cls_clr     = taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_cls_clr' );
$taiowc_cart_pan_hdr_bg_clr  = taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_hdr_bg_clr' );

$taiowc_custom_css.=".cart-heading{background-color:{$taiowc_cart_pan_hdr_bg_clr};} .cart-heading svg{color:{$taiowc_cart_pan_icon_clr};} .cart-heading h4,.cart_fixed_2 .taiowc-content h4{color:{$taiowc_cart_pan_hd_clr};} .taiowc-cart-close:after{color:{$taiowc_cart_pan_cls_clr};}";

$taiowc_cart_pan_bg_clr   = taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_bg_clr' );
$taiowc_custom_css.=".taiowc-cart-model{background-color:{$taiowc_cart_pan_bg_clr};}";

$taiowc_cart_pan_prd_bg_clr   = taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_prd_bg_clr' );
$taiowc_cart_pan_prd_tle_clr  = taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_prd_tle_clr' );
$taiowc_cart_pan_prd_rat_clr  = taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_prd_rat_clr' );
$taiowc_cart_pan_prd_dlt_clr  = taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_prd_dlt_clr' );
$taiowc_cart_pan_prd_txt_clr  = taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_prd_txt_clr' );
$taiowc_cart_pan_prd_brd_clr  = taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_prd_brd_clr' );

$taiowc_custom_css.=".taiowc .taiowc-cart-model-body div.taiowc-woocommerce-mini-cart-item,input[type=number].taiowc-quantity{background-color:{$taiowc_cart_pan_prd_bg_clr};}.taiowc-cart-model-body .item-product-wrap .star-rating{color:{$taiowc_cart_pan_prd_rat_clr};} .quantity-text,input[type=number].taiowc-quantity,.quantity .amount{color:{$taiowc_cart_pan_prd_txt_clr};}input[type=number].taiowc-quantity{border:1px solid {$taiowc_cart_pan_prd_brd_clr};}";

// related product

$taiowc_cart_pan_rltd_hd_bg_clr   = taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_rltd_hd_bg_clr' );
$taiowc_cart_pan_rltd_hd_clr      = taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_rltd_hd_clr' );
$taiowc_cart_pan_rltd_prd_bg_clr  = taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_rltd_prd_bg_clr' );
$taiowc_cart_pan_rltd_prd_tle_clr      = taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_rltd_prd_tle_clr' );
$taiowc_cart_pan_rltd_prd_rat_clr      = taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_rltd_prd_rat_clr' );
$taiowc_cart_pan_rltd_prd_prc_clr      = taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_rltd_prd_prc_clr' );
$taiowc_cart_pan_rltd_prd_add_bg_clr   = taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_rltd_prd_add_bg_clr' );
$taiowc_cart_pan_rltd_prd_add_clr      = taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_rltd_prd_add_clr' );
$taiowc_custom_css.=".taiowc-related-product-title{background-color:{$taiowc_cart_pan_rltd_hd_bg_clr};} .taiowc-related-product-title{color:{$taiowc_cart_pan_rltd_hd_clr};} .taiowc-related-product-cont ul li{background-color:{$taiowc_cart_pan_rltd_prd_bg_clr};} .taiowc-related-product-right-area h4 a{color:{$taiowc_cart_pan_rltd_prd_tle_clr};} .taiowc-related-product-right-area .price{color:{$taiowc_cart_pan_rltd_prd_prc_clr};} .taiowc-related-product-right-area .star-rating{color:{$taiowc_cart_pan_rltd_prd_rat_clr};} .taiowc-related-product-right-area a.th-button{background-color:{$taiowc_cart_pan_rltd_prd_add_bg_clr}!important;color:{$taiowc_cart_pan_rltd_prd_add_clr}!important;}";

// payment color option

$taiowc_cart_pan_pay_hd_bg_clr   = taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_pay_hd_bg_clr' );
$taiowc_cart_pan_pay_hd_clr      = taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_pay_hd_clr' );
$taiowc_cart_pan_pay_bg_clr      = taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_pay_bg_clr' );
$taiowc_cart_pan_pay_txt_clr     = taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_pay_txt_clr' );
$taiowc_cart_pan_pay_link_clr    = taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_pay_link_clr' );
$taiowc_cart_pan_pay_btn_bg_clr     = taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_pay_btn_bg_clr' );
$taiowc_cart_pan_pay_btn_clr    = taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_pay_btn_clr' );

$taiowc_cart_pan_pay_cart_bg_clr     = taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_pay_cart_bg_clr' );
$taiowc_cart_pan_pay_cart_clr    = taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_pay_cart_clr' );

$taiowc_cart_pan_btn_brd_rds    = taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_btn_brd_rds' );


$taiowc_custom_css.="color:{$taiowc_cart_pan_pay_hd_clr};} .taiowc-cart-model{background-color:{$taiowc_cart_pan_pay_bg_clr};} .taiowc-total-wrap{color:{$taiowc_cart_pan_pay_txt_clr};} .taiowc-total-wrap a{color:{$taiowc_cart_pan_pay_link_clr};} .taiowc-cart-model-footer .cart-button .buttons .checkout,.taiowc-shptgl-cont .woocommerce-shipping-calculator .shipping-calculator-form button{background-color:{$taiowc_cart_pan_pay_btn_bg_clr}!important;color:{$taiowc_cart_pan_pay_btn_clr}!important; border-color:{$taiowc_cart_pan_pay_btn_bg_clr};} .taiowc-cart-model-footer .cart-button .button:first-child{color: {$taiowc_cart_pan_pay_btn_bg_clr}!important;}";

$taiowc_custom_css.=".taiowc-cart-model-footer .cart-button .buttons a:not(.checkout){background-color:{$taiowc_cart_pan_pay_cart_bg_clr}!important;
color:{$taiowc_cart_pan_pay_cart_clr}!important;}
.taiowc-cart-model-footer .cart-button .buttons a{border-radius:{$taiowc_cart_pan_btn_brd_rds}px!important;}";

if(taiowc_main()->taiowc_get_option( 'taiowc-cart_pan_cart_shw' ) == false){

 $taiowc_custom_css.=".taiowc-cart-model-footer .cart-button .buttons a:not(.checkout){display:none;}";

}

//Coupon Style
$taiowc_cart_coupon_box_bg_clr       = taiowc_main()->taiowc_get_option( 'taiowc-cart_coupon_box_bg_clr' );
$taiowc_cart_coupon_box_brd_clr       = taiowc_main()->taiowc_get_option( 'taiowc-cart_coupon_box_brd_clr' );
$taiowc_cart_coupon_box_txt_clr      = taiowc_main()->taiowc_get_option( 'taiowc-cart_coupon_box_txt_clr' );
$taiowc_cart_coupon_box_submt_clr    = taiowc_main()->taiowc_get_option( 'taiowc-cart_coupon_box_submt_clr' );
$taiowc_cart_coupon_box_view_clr     = taiowc_main()->taiowc_get_option( 'taiowc-cart_coupon_box_view_clr' );
$taiowc_cart_coupon_code_bg_clr      = taiowc_main()->taiowc_get_option( 'taiowc-cart_coupon_code_bg_clr' );
$taiowc_cart_coupon_code_brd_clr     = taiowc_main()->taiowc_get_option( 'taiowc-cart_coupon_code_brd_clr' );
$taiowc_cart_coupon_code_txt_clr     = taiowc_main()->taiowc_get_option( 'taiowc-cart_coupon_code_txt_clr' );
$taiowc_cart_coupon_code_ofr_clr     = taiowc_main()->taiowc_get_option( 'taiowc-cart_coupon_code_ofr_clr' );
$taiowc_cart_coupon_code_btn_bg_clr  = taiowc_main()->taiowc_get_option( 'taiowc-cart_coupon_code_btn_bg_clr' );
$taiowc_cart_coupon_code_btn_txt_clr    = taiowc_main()->taiowc_get_option( 'taiowc-cart_coupon_code_btn_txt_clr' );
$taiowc_cart_coupon_code_add_bg_clr     = taiowc_main()->taiowc_get_option( 'taiowc-cart_coupon_code_add_bg_clr' );
$taiowc_cart_coupon_code_add_txt_clr    = taiowc_main()->taiowc_get_option( 'taiowc-cart_coupon_code_add_txt_clr' );
$taiowc_cart_coupon_code_add_dlt_clr    = taiowc_main()->taiowc_get_option( 'taiowc-cart_coupon_code_add_dlt_clr' );

$taiowc_custom_css.=".taiowc-coupon-box{background:{$taiowc_cart_coupon_box_bg_clr};border-color:{$taiowc_cart_coupon_box_brd_clr};} .taiowc-coupon input#taiowc-coupon-code{color:{$taiowc_cart_coupon_box_txt_clr};} .taiowc-coupon input#taiowc-coupon-code::placeholder {color:{$taiowc_cart_coupon_box_txt_clr};} .taiowc-coupon-submit{color:{$taiowc_cart_coupon_box_submt_clr};} .taiowc-show-coupon{color:{$taiowc_cart_coupon_box_view_clr};} .coupon-list{background:{$taiowc_cart_coupon_code_bg_clr}; border-color:{$taiowc_cart_coupon_code_brd_clr};} .taiowc-coupon-list .code{color:{$taiowc_cart_coupon_code_txt_clr};border-color:{$taiowc_cart_coupon_code_txt_clr};} .coupon-list .desc,.taiowc-cart-model .taiowc-coupon-list .owl-carousel .owl-nav .owl-next,.taiowc-cart-model .taiowc-coupon-list .owl-carousel .owl-nav .owl-prev{color:{$taiowc_cart_coupon_code_txt_clr};} .coupon-list .off{color:{$taiowc_cart_coupon_code_ofr_clr};} .coupon-list .taiowc-coupon-apply-btn.button.added,.coupon-list .taiowc-coupon-apply-btn.button{border-color:{$taiowc_cart_coupon_code_btn_bg_clr}; background:{$taiowc_cart_coupon_code_btn_bg_clr}!important;color:{$taiowc_cart_coupon_code_btn_txt_clr};} .taiowc-coupon-remove-coupon{background:{$taiowc_cart_coupon_code_add_bg_clr};color:{$taiowc_cart_coupon_code_add_txt_clr};} .taiowc-coupon-remove-coupon span{color:{$taiowc_cart_coupon_code_add_dlt_clr};}";

//notification sound
$taiowc_success_mgs_bg_clr     = taiowc_main()->taiowc_get_option( 'taiowc-success_mgs_bg_clr' );
$taiowc_success_mgs_txt_clr    = taiowc_main()->taiowc_get_option( 'taiowc-success_mgs_txt_clr' );
$taiowc_error_mgs_bg_clr       = taiowc_main()->taiowc_get_option( 'taiowc-error_mgs_bg_clr' );
$taiowc_error_mgs_txt_clr      = taiowc_main()->taiowc_get_option( 'taiowc-error_mgs_txt_clr' );

$taiowc_custom_css.=".taiowc-notice-box .woocommerce-message,
.taiowc-notice-container .taiowc-notices li{color:{$taiowc_success_mgs_txt_clr};background:{$taiowc_success_mgs_bg_clr};} .taiowc-notice-box .woocommerce-error,
.taiowc-notices li.taiowc-notice-error{
color:{$taiowc_error_mgs_txt_clr};background:{$taiowc_error_mgs_bg_clr};}";


//fixed cart position
$taiowc_fxd_cart_position  = taiowc_main()->taiowc_get_option( 'taiowc-fxd_cart_position' );
$taiowc_fxd_cart_frm_right  = taiowc_main()->taiowc_get_option( 'taiowc-fxd_cart_frm_right' );
$taiowc_fxd_cart_frm_left  = taiowc_main()->taiowc_get_option( 'taiowc-fxd_cart_frm_left' );
$taiowc_fxd_cart_frm_btm  = taiowc_main()->taiowc_get_option( 'taiowc-fxd_cart_frm_btm' );

if($taiowc_fxd_cart_position == 'fxd-left'){

    $taiowc_custom_css.=".cart_fixed_1 .taiowc-content,.taiowc-wrap.cart_fixed_2{left:{$taiowc_fxd_cart_frm_left}px; bottom:{$taiowc_fxd_cart_frm_btm}px; right:auto} .cart_fixed_1 .cart-count-item{
       right: -18px;
       left:auto;
    }";
      
}

if($taiowc_fxd_cart_position == 'fxd-right'){

    $taiowc_custom_css.=".cart_fixed_1 .taiowc-content,.taiowc-wrap.cart_fixed_2{right:{$taiowc_fxd_cart_frm_right}px; bottom:{$taiowc_fxd_cart_frm_btm}px; left:auto} ";

}


if(taiowc_main()->taiowc_get_option('taiowc-show_floatingcart')==false){

 $taiowc_custom_css.=".cart_fixed_1 .taiowc_cart_empty, .cart_fixed_2 .taiowc_cart_empty{display:none;}";
  
}

//mobile disable option
if(wp_is_mobile()){

if(taiowc_main()->taiowc_get_option( 'taiowc-dsble_mnu_crt' )==true){

$taiowc_custom_css.=".taiowc-wrap:not(.cart_fixed_1){display:none;},.taiowc-wrap:not(.cart_fixed_2){display:none;}";

}

if(taiowc_main()->taiowc_get_option( 'taiowc-dsble_mnu_crt_qnty' )==true){

$taiowc_custom_css.=".taiowc-wrap:not(.cart_fixed_1) .cart-count-item{display:none;},.taiowc-wrap:not(.cart_fixed_2) .cart-count-item{display:none;}";

}

if(taiowc_main()->taiowc_get_option( 'taiowc-dsble_mnu_crt_price' )==true){

$taiowc_custom_css.=".taiowc-wrap:not(.cart_fixed_1) .taiowc-total{display:none;},.taiowc-wrap:not(.cart_fixed_2) .taiowc-total{display:none;}";

}

if(taiowc_main()->taiowc_get_option( 'taiowc-dsble_fxd_crt' )==true){

$taiowc_custom_css.=".taiowc-fixed-cart{display:none;}";

}

$taiowc_fxd_cart_mobile_position  = taiowc_main()->taiowc_get_option( 'taiowc-fxd_cart_mobile_position' );

if($taiowc_fxd_cart_mobile_position == 'fxd-left'){

    $taiowc_custom_css.=".cart_fixed_1.taiowc-fixed-cart .taiowc-content,.taiowc-content,.taiowc-fixed-cart.taiowc-wrap.cart_fixed_2{left:{$taiowc_fxd_cart_frm_left}px; bottom:{$taiowc_fxd_cart_frm_btm}px; right:auto} ";
      
}

if($taiowc_fxd_cart_mobile_position == 'fxd-right'){

    $taiowc_custom_css.=".cart_fixed_1.taiowc-fixed-cart .taiowc-content,.taiowc-fixed-cart.taiowc-wrap.cart_fixed_2{right:{$taiowc_fxd_cart_frm_right}px; bottom:{$taiowc_fxd_cart_frm_btm}px; left:auto}";

}

if(taiowc_main()->taiowc_get_option( 'taiowc-dsble_fxd_crt_qnty' )==true){

$taiowc_custom_css.=".taiowc-wrap.cart_fixed_1 .cart-count-item,.taiowc-wrap.cart_fixed_2 .cart-count-item{display:none;}";

}

if(taiowc_main()->taiowc_get_option( 'taiowc-dsble_mob_rel_prd_crt' )==true){

$taiowc_custom_css.=".taiowc-related-product-cont{display:none;}";

}

if(taiowc_main()->taiowc_get_option( 'taiowc-dsble_mob_ship' )==true){

$taiowc_custom_css.=".taiowc-shipping,.taiowc-shptgl-cont{display:none;}";

}

if(taiowc_main()->taiowc_get_option( 'taiowc-dsble_mob_coupan' )==true){

$taiowc_custom_css.=".taiowc-coupon,.taiowc-coupon-list-content{display:none;}";

}

}

return $taiowc_custom_css;
}