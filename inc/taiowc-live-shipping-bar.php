<?php if ( ! defined( 'ABSPATH' ) ) exit;
$openStyle = taiowc_main()->taiowc_get_option( 'taiowc-cart_effect' );
?>
<!-- preview wrapper -->
			<div class="setting-preview-wrap cart-panel-preview" data-tab="taiowc-shipping_bar_set">
				    <div class="page-wrapper">
        <header class="site-header">
            <!-- Logo -->
            <div class="logo">
                <span class="logo-icon"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-panels-top-left" aria-hidden="true"><rect width="18" height="18" x="3" y="3" rx="2"></rect><path d="M3 9h18"></path><path d="M9 21V9"></path></svg></span>
                <span class="logo-text"><?php esc_html_e('MEGASTORE','th-all-in-one-woo-cart');  ?></span>
            </div>

            <!-- Navigation -->
            <nav class="main-nav">
                <a href="#"><?php esc_html_e('Home','th-all-in-one-woo-cart');  ?></a>
                <a href="#"><?php esc_html_e('Shop','th-all-in-one-woo-cart');  ?></a>
                <a href="#"><?php esc_html_e('Categories','th-all-in-one-woo-cart');  ?></a>
            </nav>

            <!-- Cart -->
            <div class="cart">
                <div id="3" class="taiowc-wrap taiowc-slide-right fxd-right" data-th-bg="taiowc-bg_clr">
    <a class="taiowc-content" href="#">
        <div class="taiowc-cart-item">

            <div class="taiowc-icon-wrapper">
                <div class="taiowc-icon" data-th-color="taiowc-cart_icon_clr"  data-th-width="taiowc-icon_size-field">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-shopping-bag">
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                        <path d="M3.103 6.034h17.794"></path>
                        <path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"></path>
                    </svg>
                </div>

                <div class="cart-count-item"  data-th-bg="taiowc-quantity_bg_clr"
                      data-th-color="taiowc-quantity_clr"
                      data-th-border="taiowc-price_clr" data-th-shadow="taiowc-quantity_shadow_clr" data-th-shadow-val="0 0 10px {color}">2</div>
            </div>

            <div class="taiowc-total" data-th-color="taiowc-price_clr" data-th-font-size="taiowc-prc_font_size-field" data-th-unit="px">
                <span class="woocommerce-Price-amount amount">
                    <?php echo wp_kses_post( wc_price( 1008 ) ); ?>
                </span>
            </div>

        </div>
    </a>
</div>

            </div>
        </header>

        <!-- Empty content area -->
        <div class="content-area">
            
            <div class="cart-wrapper <?php echo esc_attr($openStyle); ?>" data-th-bg="taiowc-cart_pan_bg_clr">
    <div class="cart-header" data-th-bg="taiowc-cart_pan_hdr_bg_clr">
        <div class="cart-title" data-th-color="taiowc-cart_pan_icon_clr">
            <div  data-th-toggle="taiowc-cart_pan_icon_shw-field">
             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag">
                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                            <path d="M3.103 6.034h17.794"></path>
                            <path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"></path>
                        </svg>
            </div>
             <span data-th-color="taiowc-cart_pan_hd_clr" data-th-text-html="taiowc-cart_hd-field"><?php echo esc_html($cartStyle); ?></span>
            <span class="cart-count"><?php esc_html_e( '3', 'th-all-in-one-woo-cart' ); ?></span>
        </div>
        <button type="button" class="close-btn" data-th-color="taiowc-cart_pan_cls_clr"><?php esc_html_e( '✕', 'th-all-in-one-woo-cart' ); ?></button>
    </div>

    <div class="taiowc-free-shipping-wrap style-1">

            <div class="taiowc-free-shipping-bar">

                <div class="taiowc-free-shipping-fill" style="width:74.404761904762%">
                </div>

                <div class="taiowc-free-shipping-icon" style="left:calc(74.404761904762% - 5px)">

                    <img draggable="false" role="img" class="emoji" alt="🚚" src="<?php echo esc_url('https://s.w.org/images/core/emoji/17.0.2/svg/1f69a.svg'); ?>">

                </div>

            </div>

            <div class="taiowc-free-shipping-msg">

                <?php esc_html_e('Spend','th-all-in-one-woo-cart'); ?> <span class="woocommerce-Price-amount amount"> <?php esc_html_e('$258.00','th-all-in-one-woo-cart'); ?></span> <?php esc_html_e('more for free shipping','th-all-in-one-woo-cart'); ?>
            </div>

    </div>


    <div class="taiowc-milestones-wrap">

            <div class="taiowc-milestones-message" data-th-text-html="taiowc-milestone_unlock_text_dummy-field">
                All rewards unlocked! Congrats!            </div>

            <div class="taiowc-milestones-track-area">

                <div class="taiowc-milestones-rail">
                    <div class="taiowc-milestones-fill" style="width:100%"></div>

                                        <div class="taiowc-milestones-marker unlocked" style="left:0.296296296296%">
                        <div class="taiowc-ms-icon-wrap">
                            <span class="taiowc-ms-icon-inner icon-1 taiowc-ms-discount">$</span>                        </div>
                    </div>
                                        <div class="taiowc-milestones-marker unlocked" style="left:51.592592592593%">
                        <div class="taiowc-ms-icon-wrap">
                            <span class="taiowc-ms-icon-inner icon-2 taiowc-ms-shipping"><img draggable="false" role="img" class="emoji" alt="🚚" src="https://s.w.org/images/core/emoji/17.0.2/svg/1f69a.svg"></span>                        </div>
                    </div>
                                        <div class="taiowc-milestones-marker unlocked" style="left:100%">
                        <div class="taiowc-ms-icon-wrap">
                            <span class="taiowc-ms-icon-inner icon-3 taiowc-ms-gift"><img draggable="false" role="img" class="emoji" alt="🎁" src="https://s.w.org/images/core/emoji/17.0.2/svg/1f381.svg"></span>                        </div>
                    </div>
                                    </div>

                <div class="taiowc-milestones-label-row" style="top:20px">
                                        <div class="taiowc-milestones-label-item" style="left:7.296296296296%">
                        <div>
                        <span class="woocommerce-Price-amount amount" data-th-text-html="taiowc-milestone_1_amount_dummy-field">50.00</span></div>
                        <span class="taiowc-ms-label" data-th-text-html="taiowc-milestone_1_label_dummy-field">10% Discount</span>                    </div>
                                        <div class="taiowc-milestones-label-item" style="left:51.592592592593%">
                       <div>
                        <span class="woocommerce-Price-amount amount" data-th-text-html="taiowc-milestone_2_amount_dummy-field">75.00</span></div>
                        <span class="taiowc-ms-label" data-th-text-html="taiowc-milestone_2_label_dummy-field"> Free Shipping    </span>  
                                       </div>
                                        <div class="taiowc-milestones-label-item" style="left:95%">
                        <div>
                        <span class="woocommerce-Price-amount amount" data-th-text-html="taiowc-milestone_3_amount_dummy-field">150.00</span></div>
                        <span class="taiowc-ms-label" data-th-text-html="taiowc-milestone_3_label_dummy-field">Free Gift </span>        
                                           </div>
                                    </div>

            </div>

        </div>

    <div class="cart-items">
       <div class="cart-item skeleton-item">
    <div class="skeleton skeleton-img"></div>

    <div class="item-info">
        <div class="skeleton skeleton-title"></div>
        <div class="skeleton skeleton-rating"></div>

        <div class="qty">
            <div class="skeleton skeleton-btn"></div>
            <div class="skeleton skeleton-count"></div>
            <div class="skeleton skeleton-btn"></div>
        </div>
    </div>

    <div class="skeleton skeleton-price"></div>
</div>

        <div class="cart-item skeleton-item">
    <div class="skeleton skeleton-img"></div>

    <div class="item-info">
        <div class="skeleton skeleton-title"></div>
        <div class="skeleton skeleton-rating"></div>

        <div class="qty">
            <div class="skeleton skeleton-btn"></div>
            <div class="skeleton skeleton-count"></div>
            <div class="skeleton skeleton-btn"></div>
        </div>
    </div>

    <div class="skeleton skeleton-price"></div>
</div>

    <div class="cart-item skeleton-item">
    <div class="skeleton skeleton-img"></div>

    <div class="item-info">
        <div class="skeleton skeleton-title"></div>
        <div class="skeleton skeleton-rating"></div>

        <div class="qty">
            <div class="skeleton skeleton-btn"></div>
            <div class="skeleton skeleton-count"></div>
            <div class="skeleton skeleton-btn"></div>
        </div>
    </div>

    <div class="skeleton skeleton-price"></div>
</div>

    </div>
    <div class="th-preview-button">
        <div class="skeleton skeleton-button"></div>
        <div class="skeleton skeleton-button"></div>
    </div>

    
</div>

     <div id="3" class="taiowc-wrap taiowc-slide-right taiowc-fixed-cart cart_fixed_1 <?php echo esc_attr($cartPosition); ?> <?php echo esc_attr($cartStyle); ?>" data-th-right="taiowc-fxd_cart_frm_right-field" data-th-bottom="taiowc-fxd_cart_frm_btm-field" data-th-left="taiowc-fxd_cart_frm_left-field">

    <a class="taiowc-content" href="#">

        <div class="cart-count-item" data-th-bg="taiowc-fxcrt_qnty_bg_clr" data-th-color="taiowc-fxcrt_qnty_clr" data-th-toggle="taiowc-fxcrt_show_quantity-field">
            2
        </div>

        <div class="taiowc-cart-item" data-th-bg="taiowc-fxcrt_cart_bg_clr" data-th-radius="taiowc-fxcrt_icon_brd_rds-field">
            
            <div class="taiowc-icon" data-th-color="taiowc-fxcrt_cart_icon_clr" data-th-width="taiowc-fxcrt_icon_size-field">
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

            <div class="taiowc-total" data-th-color="taiowc-fxcrt_cart_tle_clr" data-th-toggle="taiowc-show_price-field">
                <span>
                    <span class="woocommerce-Price-amount amount">
                    <?php echo wp_kses_post( wc_price( 1008 ) ); ?>
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