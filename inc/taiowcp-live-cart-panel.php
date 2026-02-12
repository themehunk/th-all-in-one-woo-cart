<?php if ( ! defined( 'ABSPATH' ) ) exit;
$openStyle = taiowc()->get_option( 'taiowcp-cart_effect' );
?>
<!-- preview wrapper -->
			<div class="setting-preview-wrap cart-panel-preview" data-tab="taiowcp-cart_style_set">
				    <div class="page-wrapper">
        <header class="site-header">
            <!-- Logo -->
            <div class="logo">
                <span class="logo-icon"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-panels-top-left" aria-hidden="true"><rect width="18" height="18" x="3" y="3" rx="2"></rect><path d="M3 9h18"></path><path d="M9 21V9"></path></svg></span>
                <span class="logo-text"><?php esc_html_e('MEGASTORE','taiowcp');  ?></span>
            </div>

            <!-- Navigation -->
            <nav class="main-nav">
                <a href="#"><?php esc_html_e('Home','taiowcp');  ?></a>
                <a href="#"><?php esc_html_e('Shop','taiowcp');  ?></a>
                <a href="#"><?php esc_html_e('Categories','taiowcp');  ?></a>
            </nav>

            <!-- Cart -->
            <div class="cart">
                <div id="3" class="taiowc-wrap taiowc-slide-right fxd-right" data-th-bg="taiowcp-bg_clr">
    <a class="taiowc-content" href="#">
        <div class="taiowc-cart-item">

            <div class="taiowc-icon-wrapper">
                <div class="taiowc-icon" data-th-color="taiowcp-cart_icon_clr"  data-th-width="taiowcp-icon_size-field">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-shopping-bag">
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                        <path d="M3.103 6.034h17.794"></path>
                        <path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"></path>
                    </svg>
                </div>

                <div class="cart-count-item"  data-th-bg="taiowcp-quantity_bg_clr"
                      data-th-color="taiowcp-quantity_clr"
                      data-th-border="taiowcp-price_clr" data-th-shadow="taiowcp-quantity_shadow_clr" data-th-shadow-val="0 0 10px {color}">2</div>
            </div>

            <div class="taiowc-total" data-th-color="taiowcp-price_clr" data-th-font-size="taiowcp-prc_font_size-field" data-th-unit="px">
                <span class="woocommerce-Price-amount amount">
                    <span class="woocommerce-Price-currencySymbol"> <?php esc_html_e( '$', 'taiowcp' ); ?></span> <?php esc_html_e( '1008.00', 'taiowcp' ); ?>
                </span>
            </div>

        </div>
    </a>
</div>

            </div>
        </header>

        <!-- Empty content area -->
        <div class="content-area">
            
            <div class="cart-wrapper <?php echo esc_attr($openStyle); ?>" data-th-bg="taiowcp-cart_pan_bg_clr">
    <div class="cart-header" data-th-bg="taiowcp-cart_pan_hdr_bg_clr">
        <div class="cart-title" data-th-color="taiowcp-cart_pan_icon_clr">
            <div  data-th-toggle="taiowcp-cart_pan_icon_shw-field">
             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag">
                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                            <path d="M3.103 6.034h17.794"></path>
                            <path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"></path>
                        </svg>
            </div>
             <span data-th-color="taiowcp-cart_pan_hd_clr" data-th-text-html="taiowcp-cart_hd-field"><?php echo esc_html($cartStyle); ?></span>
            <span class="cart-count"><?php esc_html_e( '3', 'taiowcp' ); ?></span>
        </div>
        <button type="button" class="close-btn" data-th-color="taiowcp-cart_pan_cls_clr"><?php esc_html_e( '✕', 'taiowcp' ); ?></button>
    </div>

    <div class="cart-items">
        <div class="cart-item" data-th-bg="taiowcp-cart_pan_prd_bg_clr" data-th-color="taiowcp-cart_pan_prd_txt_clr" data-th-border="taiowcp-cart_pan_prd_brd_clr">
            <img src="<?php echo TAIOWC_PLUGIN_URI.'/images/product.jpg'; ?>" alt="">
            <div class="item-info">
                <h4 data-th-color="taiowcp-cart_pan_prd_tle_clr"><?php esc_html_e( 'Classic Red Sneakers', 'taiowcp' ); ?></h4>
                <div class="rating" data-th-color="taiowcp-cart_pan_prd_rat_clr"><?php esc_html_e( '★★★★★', 'taiowcp' ); ?></div>
                <div class="qty">
                <span><?php esc_html_e( '-', 'taiowcp' ); ?></span>
                <span><?php esc_html_e( '1', 'taiowcp' ); ?></span>
                <span><?php esc_html_e( '+', 'taiowcp' ); ?></span>
                </div>
            </div>
            <div class="price"><?php esc_html_e( '₹400.00', 'taiowcp' ); ?></div>
        </div>

        <div class="cart-item" data-th-bg="taiowcp-cart_pan_prd_bg_clr" data-th-color="taiowcp-cart_pan_prd_txt_clr" data-th-border="taiowcp-cart_pan_prd_brd_clr">
            <img src="<?php echo TAIOWC_PLUGIN_URI.'/images/product2.jpg'; ?>" alt="">
            <div class="item-info">
                <h4 data-th-color="taiowcp-cart_pan_prd_tle_clr"><?php esc_html_e( 'Minimalist White Tee', 'taiowcp' ); ?></h4>
                <div class="rating" data-th-color="taiowcp-cart_pan_prd_rat_clr"><?php esc_html_e( '★★★★★', 'taiowcp' ); ?></div>
                <div class="qty">
                <span><?php esc_html_e( '-', 'taiowcp' ); ?></span>
                <span><?php esc_html_e( '1', 'taiowcp' ); ?></span>
                <span><?php esc_html_e( '+', 'taiowcp' ); ?></span>
                </div>
            </div>
            <div class="price"><?php esc_html_e( '₹250.00', 'taiowcp' ); ?></div>
        </div>
    </div>

    <div class="summary" data-th-bg="taiowcp-cart_pan_pay_bg_clr" data-th-color="taiowcp-cart_pan_pay_txt_clr">
        <p class="summary-title" data-th-bg="taiowcp-cart_pan_pay_hd_bg_clr" data-th-color="taiowcp-cart_pan_pay_hd_clr"><?php esc_html_e( 'ORDER SUMMARY', 'taiowcp' ); ?></p>

        <div class="row">
            <span><?php esc_html_e( 'Subtotal', 'taiowcp' ); ?></span>
            <span><?php esc_html_e( '₹1,220.00', 'taiowcp' ); ?></span>
        </div>

        <div class="row total">
            <span><?php esc_html_e( 'ORDER TOTAL', 'taiowcp' ); ?></span>
            <span><?php esc_html_e( '₹720.00', 'taiowcp' ); ?></span>
        </div>

        <div class="btn-wrapper">
        <button type="button"class="cart btn" data-th-bg="taiowcp-cart_pan_pay_cart_bg_clr" data-th-color="taiowcp-cart_pan_pay_cart_clr" data-th-radius="taiowcp-cart_pan_btn_brd_rds-field" data-th-toggle="taiowcp-cart_pan_cart_shw-field">
        View Cart
    </button>
    <button type="button"class="checkout btn" data-th-bg="taiowcp-cart_pan_pay_btn_bg_clr" data-th-color="taiowcp-cart_pan_pay_btn_clr" data-th-radius="taiowcp-cart_pan_btn_brd_rds-field">
       <?php esc_html_e( 'Checkout →', 'taiowcp' ); ?> 
    </button>
    </div>

    </div>

    
</div>

     <div id="3" class="taiowc-wrap taiowc-slide-right taiowc-fixed-cart cart_fixed_1 <?php echo esc_attr($cartPosition); ?> <?php echo esc_attr($cartStyle); ?>" data-th-right="taiowcp-fxd_cart_frm_right-field" data-th-bottom="taiowcp-fxd_cart_frm_btm-field" data-th-left="taiowcp-fxd_cart_frm_left-field">

    <a class="taiowc-content" href="#">

        <div class="cart-count-item" data-th-bg="taiowcp-fxcrt_qnty_bg_clr" data-th-color="taiowcp-fxcrt_qnty_clr" data-th-toggle="taiowcp-fxcrt_show_quantity-field">
            2
        </div>

        <div class="taiowc-cart-item" data-th-bg="taiowcp-fxcrt_cart_bg_clr" data-th-radius="taiowcp-fxcrt_icon_brd_rds-field">
            
            <div class="taiowc-icon" data-th-color="taiowcp-fxcrt_cart_icon_clr" data-th-width="taiowcp-fxcrt_icon_size-field">
                <svg xmlns="http://www.w3.org/2000/svg"
                     width="24"
                     height="24"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     stroke-linecap="round"
                     stroke-linejoin="round"
                     class="lucide lucide-shopping-bag w-6 h-6 stroke-[1.5px]"
                     aria-hidden="true">
                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                    <path d="M3.103 6.034h17.794"></path>
                    <path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"></path>
                </svg>
            </div>

            <div class="taiowc-total" data-th-color="taiowcp-fxcrt_cart_tle_clr" data-th-toggle="taiowcp-show_price-field">
                <span>
                    <span class="woocommerce-Price-amount amount">
                        <span class="woocommerce-Price-currencySymbol"><?php esc_html_e( '$', 'taiowcp' ); ?> </span>
                        <?php esc_html_e( '63.00', 'taiowcp' ); ?> 
                    </span>
                </span>
            </div>

        </div>

    </a>

</div>
        </div>
    </div>
				
			   </div>
<!-- preview wrapper -->  