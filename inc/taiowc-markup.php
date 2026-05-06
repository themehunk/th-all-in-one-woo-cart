<?php

if ( ! defined( 'ABSPATH' ) ) exit;


if ( ! class_exists( 'Taiowc_Markup_Pro' ) ):

    class Taiowc_Markup_Pro {
         /**
         * Member Variable
         *
         * @var object instance
         */
       
        private static $instance;

        /**
         * Initiator
         */

        public static function instance() {

            if ( ! isset( self::$instance ) ) {

                self::$instance = new self();

            }

            return self::$instance;

        }

        /**
         * Constructor
         */
        public function __construct(){
     
            add_action('taiowc_coupon_list_markup',array( $this,'taiowc_coupon_list_markup'));
            if(taiowc_main()->taiowc_get_option( 'taiowc-cart_style' ) !== 'style-2' && (taiowc_main()->taiowc_get_option( 'taiowc-cart_effect' )== 'taiowc-slide-right' || taiowc_main()->taiowc_get_option( 'taiowc-cart_effect' )== 'taiowc-slide-left')){
                add_action( 'wp_footer', [ $this, 'render_cart_modal_once' ],999 );
            }

        }

        public function render_cart_modal_once() {
        static $rendered = false;
        if ( $rendered ) {
            return;
        }
        $rendered = true;
        $iconstyle  = !empty($args['iconstyle'])  ? $args['iconstyle'] : '';
        // Output the modal HTML only once
        return $this->taiowc_cart_item_show($iconstyle);
        }

        public function taiowc_cart_show($iconstyle,$layoutType){
            $effect = taiowc_main()->taiowc_get_option( 'taiowc-cart_effect' );
            $cart_url = wc_get_cart_url();
            $href ='#';
            if (  isset(WC()->cart) && WC()->cart && ! WC()->cart->is_empty() ) { 
                $showCls = "taiowc_cart_not_empty";
                $href = ( $effect === 'taiowc-click-cart' ) ? $cart_url : '#';
            }else{
                $showCls = "taiowc_cart_empty";
                $href ='#';
            }
            if($layoutType == 'cart_fixed_2'){?>
            <a class="taiowc-content <?php echo esc_attr($showCls); ?>" href="<?php echo esc_url($href); ?>" aria-label="Cart">
                 <div class="taiowc-cart-count">
                    <?php if ( WC()->cart && ! WC()->cart->is_empty() ) {  ?>
                        <div class="cart-count-item">   
                        <?php echo wp_kses_post(taiowc_main()->taiowc_get_cart_count()); ?>     
                        </div>
                    <?php } ?>
                </div>
            <div class="taiowc-cart-item">
                    <div class="taiowc-icon">
                        <?php do_action('taiowc_cart_show_icon', $iconstyle); ?>
                    </div>

                        <div class="taiowc-cart-total-wrap">

                                 <?php if ( WC()->cart && ! WC()->cart->is_empty() ) {  

                                if(taiowc_main()->taiowc_get_option( 'taiowc-show_price' ) == true){ 

                                ?>

                                 <div class="taiowc-total">

                                    <span>
                                    
                                        <?php echo wp_kses_post(WC()->cart->get_cart_total()); ?>
                                            
                                    </span>

                                </div>

                                <?php } } ?>

                                </div>

                </div>
                <?php if(taiowc_main()->taiowc_get_option( 'taiowc-cart_hd' )!==''){ ?>
                 <h3><?php echo esc_html(taiowc_main()->taiowc_get_option( 'taiowc-cart_hd' ));?></h3>
                 <?php } ?>
                </a>
            <?php }else{ ?>  
               
                           <a class="taiowc-content <?php echo esc_attr($showCls); ?>" href="<?php echo esc_url($href); ?>" aria-label="Cart">
                           
                           <?php if(taiowc_main()->taiowc_get_option( 'taiowc-cart_hd' )!==''){ ?>

                           <h4><?php echo esc_html(taiowc_main()->taiowc_get_option( 'taiowc-cart_hd' ));?></h4>

                            <?php } ?>
                            <div class="taiowc-cart-count">
                            <?php if ( WC()->cart && ! WC()->cart->is_empty() ) {  ?>

                            <div class="cart-count-item">
                                
                            <?php echo wp_kses_post(taiowc_main()->taiowc_get_cart_count()); ?>
                                    
                            </div>

                            <?php } ?>
                            </div>
                           
                            <div class="taiowc-cart-item">

                                <div class="taiowc-icon">

                                    <?php do_action('taiowc_cart_show_icon', $iconstyle); ?>

                                 </div>

                                 <div class="taiowc-cart-total-wrap">

                                 <?php if ( WC()->cart && ! WC()->cart->is_empty() ) {  

                                if(taiowc_main()->taiowc_get_option( 'taiowc-show_price' ) == true){ 

                                ?>

                                 <div class="taiowc-total">

                                    <span>
                                    
                                        <?php echo wp_kses_post(WC()->cart->get_cart_total()); ?>
                                            
                                    </span>

                                </div>

                                <?php } } ?>

                                </div>

                            </div>
                        </a>

                               <?php  } ?>
        <?php }


        public function taiowc_cart_item_show($iconstyle){

        $popupstyle = '';
        $popupstyle = taiowc_main()->taiowc_get_option( 'taiowc-cart_mobile_effect' );

    if ( wp_is_mobile() && $popupstyle != 'mobiletopslide') {
        $popupstyle = taiowc_main()->taiowc_get_option( 'taiowc-cart_effect' );      
    }
    
         ?>

          <div class="taiowc-model-wrap <?php echo esc_attr($popupstyle); ?>">
            <div class="taiowc-model-overlay"></div>
            <div class="taiowc-cart-model">   
               <div class="taiowc-cart-model-wrap">
                    <?php $this->taiowc_cart_header($iconstyle);?>
                    <div class="taiowc-cart-model-body">
                        
                        <?php 

                        do_action('taiowc_mini_cart'); 

                        $this->taiowc_get_suggest_product();

                        ?>

                    </div>

                    <div class="taiowc-cart-model-footer">

                    <?php 

                     $this->taiowc_cart_footer(); 
                    
                    ?>
                       <?php if (taiowc_main()->taiowc_get_option( 'taiowc-show_copyright' )) { ?>
                     
                    <span class="copyright"><?php esc_html_e( 'Powered by ', 'th-all-in-one-woo-cart' ); ?><a href="<?php echo esc_url(taiowc_main()->taiowc_get_option( 'taiowc-custom_copyright_link' )); ?>"><?php echo esc_html(taiowc_main()->taiowc_get_option( 'taiowc-custom_copyright' )); ?> <svg xmlns="http://www.w3.org/2000/svg" width="7" height="7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-external-link group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" aria-hidden="true"><path d="M15 3h6v6"></path><path d="M10 14 21 3"></path><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path></svg></a></span>

                <?php } ?>

                   </div>
               </div>
              

                <!-- <div class="taiowc-notice-box">

                    <span class="taiowc-notice"></span>

                </div> -->

                <?php 
                
                taiowc_main()->taiowc_print_notices_html();
               
                ?>

            </div>
          </div>
        <?php }


        public function taiowc_cart_header($iconstyle){?>


                    <div class="taiowc-cart-model-header">

                        <div class="cart-heading">

                            <?php do_action('taiowc_cart_show_icon',$iconstyle);?>

                            <?php if(taiowc_main()->taiowc_get_option( 'taiowc-cart_hd' )!==''){ ?>

                          <h4>

                            <?php echo esc_html(taiowc_main()->taiowc_get_option( 'taiowc-cart_hd' ));?>
                                
                            </h4>

                           <?php } ?>

                           <?php if ( WC()->cart && ! WC()->cart->is_empty() ) {  ?>

                          <div class="taiowc-cart-count">
                            <div class="cart-count-item">                       
                            <?php echo wp_kses_post(taiowc_main()->taiowc_get_cart_count()); ?> </div>
                         </div>

                            <?php } ?>

                        </div> 

                        <a class="taiowc-cart-close"></a>

                    </div>


        <?php }


        public function taiowc_cart_footer(){ ?>

                    <?php   

                     $this->taiowc_cart_total();

                     $this->taiowc_add_coupon();

                     $this->taiowc_cart_button(); 

                    ?>
        <?php }
        
          public function taiowc_cart_total(){  

          if(WC()->cart){

           WC()->cart->calculate_totals();

           $tax_enabled  = wc_tax_enabled() && WC()->cart->get_cart_tax() !== '';

           $has_shipping = WC()->cart->needs_shipping() && WC()->cart->show_shipping();

           $has_discount = WC()->cart->has_discount();

           $taiowc_show_shipping = taiowc_main()->taiowc_get_option('taiowc-show_shipping');

           $taiowc_show_discount = taiowc_main()->taiowc_get_option('taiowc-show_discount');

            ?>
                <div class="cart-total">

                    <span class="taiowc-payment-title">

                        <?php echo esc_html(taiowc_main()->taiowc_get_option('taiowc-pay_hd')); ?>
                        
                    </span>

                     <div class="taiowc-total-wrap">
                                
                            <div class="taiowc-subtotal">

                                <span class="taiowc-label">

                                    <?php echo esc_html(taiowc_main()->taiowc_get_option('taiowc-sub_total')); ?>
                                        
                                    </span>

                                <span class="taiowc-value">

                                    <?php echo wp_kses_post( WC()->cart->get_cart_subtotal() ); ?>
                                        
                                    </span>

                              </div>

               
                  
                   <?php if( $has_shipping == 1 && $taiowc_show_shipping == true ): ?>

                   <?php $this->taiowc_shipping_markup();?>

                   <?php endif; ?>

                    <?php if( $has_discount && $taiowc_show_discount == true ): ?>

                    <div class="taiowc-discount">

                        <span class="taiowc-label">

                            <?php echo esc_html(taiowc_main()->taiowc_get_option('taiowc-discount_txt')); ?>
                                
                            </span>

                        <span class="taiowc-value">

                         <?php echo wp_kses_post(wc_price(WC()->cart->get_discount_total())); ?>
                                
                        </span>

                    </div>

                   <?php endif; ?>

                    <?php if($tax_enabled || $has_shipping || $has_discount): ?>

                        <div class="taiowc-total">

                            <span class="taiowc-label">

                                <?php echo esc_html(taiowc_main()->taiowc_get_option('taiowc-total_txt')); ?>
                                    
                                </span>

                            <span class="taiowc-value"><?php echo wp_kses_post(WC()->cart->get_total()); ?></span>

                        </div>

                    <?php endif; ?>

                   </div>

                </div>


       <?php } }

        
        public function taiowc_cart_button(){ ?>
                

                     <div class="cart-button">
                            
                        <p class="buttons normal">

                        <?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?>
                            
                        </p>
                              
                    </div>

       <?php  }


        public function taiowc_add_coupon(){ ?>
                
               <?php if(taiowc_main()->taiowc_get_option('taiowc-show_coupon')==true){

                if(wc_coupons_enabled()): ?>
                    
                        <div class="taiowc-coupon">

                           <div class="taiowc-coupon-box">

                           <input type="text" id="taiowc-coupon-code" placeholder="<?php echo esc_attr(taiowc_main()->taiowc_get_option('taiowc-coupon_plchdr_txt')); ?>">

                            <span class="taiowc-coupon-submit"><?php echo esc_html(taiowc_main()->taiowc_get_option('taiowc-coupon_aply_txt')); ?></span>

                           </div>

                            <?php if(!empty($this->taiowc_coupon_list()) && taiowc_main()->taiowc_get_option('taiowc-show_coupon_list')==true ) { ?>

                             <span class="taiowc-show-coupon"><?php echo esc_html(taiowc_main()->taiowc_get_option('taiowc-coupon_btn_txt')); ?></span>

                           <?php } ?>
 
                        </div>

                        <?php 

                        if(WC()->cart){
                            $coupons = WC()->cart->get_coupons();
                         }else{
                            $coupons = '';
                         }

                        

                        if(!empty($coupons) && taiowc_main()->taiowc_get_option('taiowc-show_added_coupon')== true): ?>

                        <ul class="taiowc-coupon-applied-coupons">

                            <?php foreach ($coupons as $code => $coupon): ?>

                                <li class="taiowc-coupon-remove-coupon" data-coupon="<?php echo esc_attr($code); ?>"><?php esc_html_e('Coupon :','th-all-in-one-woo-cart'); ?> <?php echo esc_html($code); ?>
                                    <span class="dashicons dashicons-no-alt"></span>
                                </li>

                            <?php endforeach; ?>

                        </ul>

                      <?php endif; 

                     ?> 

                <?php endif; 

                if(taiowc_main()->taiowc_get_option('taiowc-show_coupon_list')==true){ ?>

                <div class="taiowc-coupon-list-content">

                <?php do_action('taiowc_coupon_list_markup');?>

                </div>

               <?php } } }

             public function taiowc_coupon_list() {

                // array for coupons, was hoping for a sql query instead but don't know how
                $args = array(
                'posts_per_page'   => -1,
                'orderby'          => 'title',
                'order'            => 'asc',
                'post_type'        => 'shop_coupon',
                'post_status'      => 'publish',
                );

                $coupons = get_posts( $args );

                    $coupon_names = array();

                        foreach ( $coupons as $coupon ) {

                        $coupon_name = $coupon->post_title;

                          array_push( $coupon_names, $coupon_name);

                        }

                // display all available coupons on product page
                return $coupon_names;
            }

            //get available coupon markup

            public function taiowc_coupon_list_markup() {
                
                $cls ='apply';

                ?>

                <div class="taiowc-coupon-list valid">

                    <div class="taiowc-coupon-list-wrap owl-carousel"> 
                     
                     <?php foreach ( $this->taiowc_coupon_list() as $coupon ) {

                           $coupon_data = new WC_Coupon($coupon);

                        ?>
                        <div class="coupon-list">

                            <div class="code">

                                <code>
                                    <?php echo esc_html($coupon_data->get_code());?></code> 




                            </div>
                            
                            <?php  if( WC()->cart && !empty(WC()->cart->get_coupons())){
                                    
                                    foreach (WC()->cart->get_coupons() as $code => $coupon){

                                          if($coupon_data->get_code() == $code){

                                              $cls = 'added';

                                          }else{

                                              $cls = 'apply';
                                          }

                                    }
                        

                            }?>

                            <button class="taiowc-coupon-apply-btn button btn  <?php echo esc_attr($cls); ?>" value="<?php echo esc_attr($coupon_data->get_code()); ?>">

                            <?php printf( esc_html__( '%s', 'th-all-in-one-woo-cart' ), esc_html( $cls ) ); ?>
  

                            </button> 



                            <div class="off">

                                <?php echo esc_html($coupon_data->get_description());?>

                            </div>
                            


                        </div>

                    <?php } ?>


                    </div>

                </div>

                <script>
                    
                   jQuery(document).ready(function() {
                    "use strict";
                    jQuery('.taiowc-coupon-list-wrap').owlCarousel({

                                rtl:false,
                                items:1,
                                loop:true,
                                margin:0,
                                nav:true,  
                                navText: [
                                  "<span class='dashicons dashicons-arrow-left-alt'></span>",
                                  "<span class='dashicons dashicons-arrow-right-alt'></span>",
                                ], 
                                autoHeight:true,
                                loop:false,
                                dots:false,
                                smartSpeed:500,
                                autoplay:false,
                                autoplayTimeout:2000,
                                autoplayHoverPause: true,
                                touchDrag  : false,
                                mouseDrag  : false, 
                                
                             
                 });
            });
                </script>

         <?php   }

         
        // shipping
         public function taiowc_shipping_markup(){


                    $packages = WC()->shipping()->get_packages();


                    $package = $packages[0];

                    $index = 0;


                    // $chosen_method = isset( WC()->session->chosen_shipping_methods[ 0 ] ) ? WC()->session->chosen_shipping_methods[ 0 ] : '';

                    $chosen_methods = WC()->session->get( 'chosen_shipping_methods', array() );
                    $chosen_method  = isset( $chosen_methods[ $index ] ) ? $chosen_methods[ $index ] : '';

                    $product_names = array();

                    if ( count( $packages ) > 1 ) {

                        foreach ( $package['contents'] as $item_id => $values ) {

                            $product_names[ $item_id ] = $values['data']->get_name() . ' &times;' . $values['quantity'];

                        }

                        $product_names = apply_filters( 'woocommerce_shipping_package_details_array', $product_names, $package );
                    }

                    $args = array(
                        'package'                  => $package,
                        'available_methods'        => $package['rates'],
                        'show_package_details'     => count( $packages ) > 1,
                        'show_shipping_calculator' => apply_filters( 'woocommerce_shipping_show_shipping_calculator', true, 0, $package ),
                        'package_details'          => implode( ', ', $product_names ),
                        
                        'index'                    => 0,
                        'chosen_method'            => $chosen_method,
                        'formatted_destination'    => WC()->countries->get_formatted_address( $package['destination'], ', ' ),
                        'has_calculated_shipping'  => WC()->customer->has_calculated_shipping(),
                    );

                    extract($args);


                    $formatted_destination    = isset( $formatted_destination ) ? $formatted_destination : WC()->countries->get_formatted_address( $package['destination'], ', ' );

                    $has_calculated_shipping  = ! empty( $has_calculated_shipping );

                    $show_shipping_calculator = ! empty( $show_shipping_calculator );

                    $calculator_text          = '';

                    $toggle_html              = false;  

                    
                    ?>

                   <div class="taiowc-shipping">

                        <?php if( $available_methods ): ?>

                    <span class="taiowc-label"><?php echo esc_html(taiowc_main()->taiowc_get_option('taiowc-ship_txt')); ?>

                        <span class="dashicons dashicons-edit pencil"></span>

                    </span>

                     <span class="taiowc-value">

                        <?php echo wp_kses_post(WC()->cart->get_cart_shipping_total()); ?>

                      </span>

                        <?php else: ?>

                            <a href="#" class="taiowc-shp-tgle"><?php esc_html_e( 'Shipping Calculate', 'th-all-in-one-woo-cart' ); ?></a>

                        <?php endif; ?>

                    </div>

                    <div class="taiowc-shptgl-cont">

                        <?php if ( $available_methods ) : ?>

                            <ul id="shipping_method" class="woocommerce-shipping-methods">
                                <?php foreach ( $available_methods as $method ) : ?>
                                    <li>
                                        <?php
                                        if ( 1 < count( $available_methods ) ) {
                                            printf( '<input type="radio" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" %4$s />', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ), checked( $method->id, $chosen_method, false ) ); // WPCS: XSS ok.
                                        } else {
                                            printf( '<input type="hidden" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" />', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ) ); // WPCS: XSS ok.
                                        }
                                        printf( '<label for="shipping_method_%1$s_%2$s">%3$s</label>', $index, esc_attr( sanitize_title( $method->id ) ), wc_cart_totals_shipping_method_label( $method ) ); // WPCS: XSS ok.
                                        do_action( 'woocommerce_after_shipping_rate', $method, $index );
                                        ?>
                                    </li>

                                <?php endforeach; ?>

                            </ul>

                            <?php


                            if ( $formatted_destination ) {

                                $toggle_html .=  sprintf( esc_html__( 'Shipping to %s.', 'th-all-in-one-woo-cart' ) . ' ', '<strong>' . esc_html( $formatted_destination ) . '</strong>' );

                                $calculator_text = esc_html__( 'Change address', 'th-all-in-one-woo-cart' );

                            } else {

                                $toggle_html .= wp_kses_post( apply_filters( 'woocommerce_shipping_estimate_html', esc_html__( 'Shipping options will be updated during checkout.', 'th-all-in-one-woo-cart' ) ) );
                            }

                            ?>

                        <?php else: ?>

                            <?php

                            if ( ! $has_calculated_shipping || ! $formatted_destination ) :

                                if ( 'no' === get_option( 'woocommerce_enable_shipping_calc' ) ) {

                                    $toggle_html .= wp_kses_post( apply_filters( 'woocommerce_shipping_not_enabled_on_cart_html',esc_html__( 'Shipping costs are calculated during checkout.', 'th-all-in-one-woo-cart' ) ) );

                                } else {

                                    $toggle_html .= wp_kses_post( apply_filters( 'woocommerce_shipping_may_be_available_html',esc_html__( 'Enter your address to view shipping options.', 'th-all-in-one-woo-cart' ) ) );

                                }

                            else :
                                
                                $toggle_html .= wp_kses_post( apply_filters( 'woocommerce_cart_no_shipping_available_html', sprintf( esc_html__( 'No shipping options were found for %s.', 'th-all-in-one-woo-cart' ) . ' ', '<strong>' . esc_html( $formatted_destination ) . '</strong>' ) ) );

                                $calculator_text = esc_html__( 'Enter a different address', 'th-all-in-one-woo-cart' );

                            endif;

                            ?>

                        <?php endif; ?>


                        <?php if ( $show_shipping_calculator ) : ?>

                            <?php 

                            ob_start();

                            woocommerce_shipping_calculator( $calculator_text );

                            $toggle_html .= ob_get_clean();

                            ?>

                        <?php endif; ?>

                        <?php echo $toggle_html; ?>

                    </div>

      <?php   }


      // Get Suggeted product/

      public function taiowc_get_suggest_product(){

        global $product;

        if(taiowc_main()->taiowc_get_option( 'taiowc-show_rld_product' ) == true){
       
        $selected_slugs='';

        $enable = 1;

        if(taiowc_main()->taiowc_get_option( 'taiowc-dsble_mob_rel_prd_crt' ) == true){
            $enable_mobile = 0;
        }else{
            $enable_mobile = 1;
        }

        if($enable != 1 || ($enable_mobile != 1 && wp_is_mobile())) return;

        $type        = taiowc_main()->taiowc_get_option( 'taiowc-choose_prdct_like' );

        $items_count = 5;

        $title       = esc_html(taiowc_main()->taiowc_get_option( 'taiowcduct_may_like_tle' ));
        
        if ( WC()->cart ) {
        $cart        = WC()->cart->get_cart();
        }else{
        $cart = " "; 
        }
        if ( WC()->cart ) {
        $cart_is_empty = WC()->cart->is_empty();
        }else{
        $cart_is_empty = " ";  
        }

        $suggested_products = array();

        $exclude_ids = array();

        if(!$cart_is_empty){

            foreach ($cart as $cart_item) {
                $exclude_ids[] = $cart_item['product_id'];
            }

            switch ($type) {

            case 'cross-sell':

                $suggested_products = WC()->cart->get_cross_sells();

                break;

            case 'up-sell':

                $last_cart_item = end($cart);

                $product_id     = $last_cart_item['product_id'];

                $variation_id   = $last_cart_item['variation_id'];

                if($variation_id){

                    $product = wc_get_product($product_id);

                    $suggested_products = $product->get_upsell_ids();

                }
                else{

                    $suggested_products = $last_cart_item['data']->get_upsell_ids();
                }

            break;

            case 'related':

                $cart_rand = shuffle($cart);

                foreach ($cart as $cart_item) {

                    if(count($suggested_products) >= $items_count)
                        break;


                    $product_id = $cart_item['variation_id'] ? $cart_item['variation_id'] : $cart_item['product_id'];

                    $related_products   = wc_get_related_products($product_id,$items_count,$exclude_ids);

                    $suggested_products = array_merge($suggested_products,$related_products);

                }


            break;

            case 'product-by-slug':
                // Array of product slugs
                
                $selected_prd = taiowc_main()->taiowc_get_option( 'taiowcduct_may_like_id' );
                if($selected_prd !==''){
                    $selected_slugs = explode(",", $selected_prd);
                    // Get product IDs by slugs
                    foreach ($selected_slugs as $slug) {
                        $product_slug = $slug;
                        $product = get_page_by_path($product_slug, OBJECT, 'product');
                        if ($product) {
                            $suggested_products[] = $product->ID;
                        }
                    }
                   
                }
                
                break;

            default:
                break;

            }

        }

        $items_count = count($suggested_products) !== 0 ? count($suggested_products)  : $items_count;
        
        $args = array(
            'suggested_products' => $suggested_products,
            'items_count'        => $items_count,
            'exclude_ids'        => $exclude_ids,
            'title'              => $title
        );

        //$args = apply_filters( 'taiowc_suggested_product_args', $args );

        $args = array(
                    'post_type'             => 'product',
                    'post_status'           => 'publish',
                    'ignore_sticky_posts'   => 1,
                    'no_found_rows'         => 1,
                    'posts_per_page'        => $items_count,
                    'orderby'               => 'rand',
                    'meta_query'            => array(
                            array(
                            'key' => '_stock_status',
                            'value' => 'instock',
                            'compare' => '=',
                        )
                    )
                );

                if(!empty($suggested_products)){

                    $args['post__in'] = $suggested_products;

                }

                if(!empty($exclude_ids)){

                    $args['post__not_in'] = $exclude_ids;

                }

                $selected_prd = taiowc_main()->taiowc_get_option( 'taiowcduct_may_like_id' );
                
                if($selected_prd !==''){
                    
                    $args['post_name__in'] = $selected_slugs;  
                }
                
                $query = new WP_Query($args);

                if ($query->have_posts()) {

                ?>
                        <div class="taiowc-related-product-cont">

                            <span class="taiowc-related-product-title"><?php echo esc_html($title); ?></span>

                            <div class="taiowc-related-wrap">

                            <ul class="taiowc-related-product-products owl-carousel">

                                <?php 

                              while ($query->have_posts()) {
                                $query->the_post();
                               
                                $product = wc_get_product(get_the_ID());
                                $pid =  $product->get_id();
                                
                                ?>
                                <li id="<?php echo esc_attr($pid); ?>" class="taiowc-related-product-item product">

                                    <div class="taiowc-related-product-left-area">

                                        <div class="taiowc-product-image">

                                        <a href="<?php echo esc_url(get_permalink($pid)); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">

                                         <?php echo wp_kses_post(get_the_post_thumbnail( $pid, 'woocommerce_thumbnail' )); ?>

                                          </a>

                                       </div>

                                    </div>

                                    <div class="taiowc-related-product-right-area">
                                        <h4>

                                        <a href="<?php echo esc_url(get_permalink($pid)); ?>" class="woocommerce-LoopProduct-title woocommerce-loop-product__link"><?php echo esc_html($product->get_title()); ?></a>

                                       </h4>

                                        <?php

                                            $rat_product = wc_get_product($pid);

                                            $rating_count =  $rat_product->get_rating_count();

                                            $average =  $rat_product->get_average_rating();

                                            echo wp_kses_post(wc_get_rating_html( $average, $rating_count ));

                                           ?>
                                      <div class="price">

                                        <?php echo wp_kses_post($product->get_price_html()); ?></div>

                                       <?php echo wp_kses_post($this->taiowc_add_to_cart_url($product));

                                       ?>
                                      
                                    </div>   

                                </li>

                            <?php } ?>

                            </ul>

                          </div>

                        </div>

                   <script>
                    
                   jQuery(document).ready(function() {

                    "use strict";

                    jQuery('ul.taiowc-related-product-products').owlCarousel({

                                rtl:false,
                                items:1,
                                loop:true,
                                margin:0,
                                nav:true,  
                                navText: [
                                  "<span class='dashicons dashicons-arrow-left-alt'></span>",
                                  "<span class='dashicons dashicons-arrow-right-alt'></span>",
                                ], 
                                autoHeight:true,
                                loop:false,
                                dots:false,
                                smartSpeed:500,
                                autoplay:false,
                                autoplayTimeout:2000,
                                autoplayHoverPause: true,
                                touchDrag  : false,
                                mouseDrag  : false, 
                                
                             
                         });
                    });
                   
                </script>

                <?php } 
                // else{

                //           esc_html_e( 'No products found','th-all-in-one-woo-cart' );

                //         } 

           wp_reset_postdata(); 

       }

    }

    public function taiowc_add_to_cart_url($product){

    $quantity = 1;

    $html = sprintf(
        '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" quantity="%s" class="button th-button %s %s"><span class="dashicons dashicons-plus-alt2"></span></a>',
        esc_url( $product->add_to_cart_url() ),
        esc_attr( $product->get_id() ),
        esc_attr( $product->get_sku() ),
        esc_attr( $quantity ),
        $product->is_purchasable() && $product->is_in_stock() ? 'th-add_to_cart_button' : '',
        $product->is_purchasable() && $product->is_in_stock() && $product->supports( 'ajax_add_to_cart' ) ? 'th-ajax_add_to_cart' : ''
    );
    $cart_url = apply_filters(
        'woocommerce_loop_add_to_cart_link',
        $html,
        $product,
        array()
    );

    return $cart_url;
  }


}

function taiowc_markup_pro(){

  return Taiowc_Markup_Pro::instance();

}
endif; 


function cart_style_open_class( $classes ) {

    $effect = taiowc_main()->taiowc_get_option( 'taiowc-cart_effect' );
    $fxdpositon = taiowc_main()->taiowc_get_option( 'taiowc-fxd_cart_position' );
 
    if ( ! empty( $effect ) ) {
        $classes[] = sanitize_html_class( $effect );
    }
    if ( ! empty( $fxdpositon ) ) {
        $classes[] = sanitize_html_class( $fxdpositon );
    }


    return $classes;
}
add_filter( 'body_class', 'cart_style_open_class');