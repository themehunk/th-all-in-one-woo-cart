<?php

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Taiowc' ) ):

    class Taiowc{
         /**
         * Member Variable
         *
         * @var object instance
         */

       
       private static $instance;
       private $_settings_api;
       public  $cartInstances = 0 ;
       public $notices = array();
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
        $this->includes();
        $this->hooks();


        }

        public function includes() {

            if ( $this->is_required_php_version() && $this->is_wc_active() ) {
                require_once TAIOWC_PLUGIN_PATH . '/inc/taiowc-setting.php';
                require_once TAIOWC_PLUGIN_PATH . '/inc/taiowc-option.php';
                require_once TAIOWC_PLUGIN_PATH . '/inc/taiowc-markup.php';
                require_once TAIOWC_PLUGIN_PATH . '/inc/taiowc-cart-fragment.php';
                require_once TAIOWC_PLUGIN_PATH . '/inc/taiowc-style.php';
                require_once TAIOWC_PLUGIN_PATH . '/inc/taiowc-admin-style.php';
            }

        }

        public function hooks() {

                add_action( 'init', array( $this, 'setImageSize' ));

                if($this->is_wc_active()){

                add_action( 'init', array( $this, 'settings_api' ), 5 );

                add_filter( 'body_class', array( $this, 'body_class' ) );

                add_shortcode( 'taiowc', array( $this, 'addBody' ), 5 );

                add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ), 1 );

                add_action('taiowc_cart_show_icon',array( $this,'taiowc_cart_icon'));

                add_action( 'wp_footer', array( $this, 'addcartBody' ) );

                add_action( 'taiowc_mini_cart', array( $this, 'taiowc_mini_cart_content' ) );

                add_action( 'taiowc_mini_cart_empty', array( $this, 'taiowc_mini_cart_empty_content' ) );
                
                add_action( 'wp_ajax_taiowc_create_nonces', array( $this,'taiowc_create_nonces'));
                add_action( 'wp_ajax_nopriv_taiowc_create_nonces', array( $this,'taiowc_create_nonces'));

                add_action( 'wc_ajax_taiowc_update_item_quantity', array( $this,'taiowc_update_item_quantity'));

                add_action( 'wc_ajax_taiowc_add_item_cart', array( $this,'taiowc_add_item_cart'));

                 add_action( 'wc_ajax_taiowc_undo_item', array( $this,'taiowc_undo_item'));

                
            }


        }

       
        
        public function is_wc_active() {
            return class_exists( 'WooCommerce' );
        }
        
       
        public function is_required_php_version() {
            return version_compare( PHP_VERSION, '5.6.0', '>=' );
        }

        public function settings_api() {

            if ( ! $this->_settings_api &&  $this->is_wc_active() ){
                $this->_settings_api = new Taiowc_Set();
            }

            return $this->_settings_api;
        }

        public function get_option( $id ) {
           
            if ( ! $this->_settings_api ) {
                $this->settings_api();
            }
            
            return $this->_settings_api->get_option( $id );
        }

        public function get_options() {
            return get_option( 'taiowc' );
        }

        public function body_class( $classes ) {
           
            $old_classes = $classes;
            if ( apply_filters( 'disable_taiowc_body_class', false ) ) {
                return $classes;
            }
            array_push( $classes, 'taiowc' );
            if ( wp_is_mobile() ) {
                array_push( $classes, 'taiowc-on-mobile' );
            }
            
            return apply_filters(  'taiowc_body_class', array_unique( $classes ), $old_classes );
        }

        public function scripts(){

              wp_enqueue_media();

              wp_enqueue_style( 'taiowc-style', TAIOWC_PLUGIN_URI. '/assets/css/style.css', array(), TAIOWC_VERSION );

             wp_enqueue_style( 'owl.carousel-style', TAIOWC_PLUGIN_URI. '/assets/css/owl.carousel.css', array(), TAIOWC_VERSION );

              wp_add_inline_style('taiowc-style', taiowc_style());

              wp_enqueue_script( 'taiowc-cart-script', TAIOWC_PLUGIN_URI. '/assets/js/taiowc-cart.js', array( 'jquery' ),true);

              wp_enqueue_script( 'owl.carousel-script', TAIOWC_PLUGIN_URI. '/assets/js/owl.carousel.js', array( 'jquery' ),true);


              $noticeMarkup = '<ul class="taiowc-notices-msg">%s</ul>'; 

              wp_localize_script(

                'taiowc-cart-script', 'taiowc_param', array(

                    'ajax_url'             => esc_url(admin_url( 'admin-ajax.php' )),

                    'wc_ajax_url'          => WC_Ajax::get_endpoint( "%%endpoint%%" ),

                    
                    'update_shipping_method_nonce' => wp_create_nonce( 'update-shipping-method' ),

                    'html'                  => array(
                        'successNotice' =>  sprintf( $noticeMarkup, $this->taiowc_notice_html('', 'success' ) ),
                        'errorNotice'   =>  sprintf( $noticeMarkup, $this->taiowc_notice_html('', 'error' ) ),
                    ),    

                    'cart_open' => esc_html(taiowc()->get_option('cart_open')),
                    
                )
            );
        }

        public function add_setting( $tab_id, $tab_title, $tab_sections, $active = false, $is_pro_tab = false, $is_new = false ) {
            add_filter(
                'taiowc_settings', function ( $fields ) use ( $tab_id, $tab_title, $tab_sections, $active, $is_pro_tab, $is_new ) {
                array_push(
                    $fields, array(
                        'id'       => $tab_id,
                        'title'    => esc_html( $tab_title ),
                        'active'   => $active,
                        'sections' => $tab_sections,
                        'is_pro'   => $is_pro_tab,
                        'is_new'   => $is_new
                    )
                );

                return $fields;
            }
          );
        }
       
      /*****************/
      // ADD SHORTCODE
      /*****************/
       public function addBody( $atts, $content, $tag ) {

        $crtArgs = shortcode_atts( array(
            'layout'         => '',
        ), $atts, $tag );

        $args = apply_filters( 'taiowc_shortcode_arg', $crtArgs );

        return self::getCart($args );

       }

       public function getCart( $args ) {

        if( !$this->HideCartPage() ) return;
       
        ob_start();

        $filename = apply_filters( 'taiowc_path', TAIOWC_PLUGIN_PATH . '/inc/taiowc-cart.php' );
        if ( file_exists( $filename ) ) {
            include $filename;

            if ( function_exists( 'opcache_invalidate' ) ) {
                @opcache_invalidate( $filename, true );
            }
        }
        $html = ob_get_clean();

        return apply_filters( 'taiowc_html', $html, $args );
       }


       /****************short code end**********************/

       public function setImageSize() {

        add_image_size( 'taiowc-thumb-img', 48, 0, true );
        
      }

       public function taiowc_cart_icon(){
              
              $icon_svg = taiowc()->get_option( 'cart-icon' );

              if($icon_svg=='icon-1'){?>
                 
                <svg xmlns="http://www.w3.org/2000/svg"  preserveAspectRatio="xMidYMid meet" viewBox="0 0 160 160" ><path d="m132 1340c-35-15-48-54-28-85 15-23 22-25 96-25h79l14-47c8-27 20-73 27-103s25-102 40-160 40-157 55-220c24-99 33-120 61-147 31-30 39-33 96-33h63l-32-20c-117-71-54-263 81-246 76 9 135 82 122 151-8 39-49 93-80 105-13 5 56 9 169 9 189 1 190 1 160-18-36-21-63-60-71-100-7-35 26-104 61-127 65-43 152-20 193 51 36 63 15 135-53 176l-30 19h60c92 0 117 25 149 145 8 33 31 116 49 185 19 69 44 161 56 205s24 88 27 98c5 16-8 17-170 17h-175l-3 42c-3 36-9 47-46 75-50 38-115 45-157 17-22-14-26-14-47 0-74 52-208-18-208-109 0-25-1-25-90-25-49 0-90-3-90-7 0-5 6-30 13-58l13-50 98-5c87-4 99-7 109-27 15-26 118-118 156-138 26-13 31-12 77 19 28 19 73 59 101 90l52 56h106 107l-4-27c-3-16-14-62-26-103-11-41-32-120-47-174-14-55-28-103-31-108-3-4-157-8-343-8h-338l-81 327c-90 358-93 366-168 383-49 12-142 12-172 0zm762-140c33-29 35-30 48-12 32 45 89 54 113 18 27-41 4-100-64-168-32-32-63-58-69-58-20 0-111 96-127 133-42 100 21 155 99 87z" transform="matrix(.1 0 0 -.1 0 160)"/></svg>

              <?php }        

         }


         public function addcartBody(){
            
            if(taiowc()->get_option( 'show_cart' ) == true){

                if(taiowc()->get_option( 'cart_style' ) == 'style-1'){

                     echo do_shortcode('[taiowc layout="cart_fixed_1"]');

                }

             }


         }


        public function get_cart_count(){

                if( taiowc()->get_option( 'basket_count' ) == 'numb_prd' ){

                    return count( WC()->cart->get_cart() );
                }
                else{

                    return WC()->cart->get_cart_contents_count();
                }

            }

        public function taiowc_mini_cart_content(){ ?>

        <?php if ( ! WC()->cart->is_empty() ) : ?>     

        <div class="woocommerce-mini-cart cart_list taiowc-mini-cart-list">

        <?php


        $get_cart_content =  array_reverse( WC()->cart->get_cart() );

            
        foreach ( $get_cart_content as $cart_item_key => $cart_item ) {

            $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                $thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                $product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );

                $rating_count   =  $_product->get_rating_count();
                $average        =  $_product->get_average_rating();
                $rating         = apply_filters( 'woocommerce_cart_item_rating', wc_get_rating_html( $average, $rating_count ), $cart_item, $cart_item_key );

                $quantity_text = __('Quantity','taiowc');

                ?>
                <div class="taiowc-woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
                    <div class="item-product-wrap">
                    <?php
                    echo apply_filters(
                        'woocommerce_cart_item_remove_link',
                        sprintf(
                            '<a class="taiowc-remove-item taiowc_remove_from_cart_button" aria-label="%s" data-product_id="%s" data-key="%s" data-product_sku="%s"> <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" alt="" title="" class="snipcart__icon"><path fill-rule="evenodd" clip-rule="evenodd" d="M22 4v6.47H12v3.236h40V10.47H42V4H22zm3.333 6.47V7.235H38.67v3.235H25.333zm20.001 9.707h3.333V59H15.334V20.177h3.333v35.588h26.667V20.177zm-15 29.116V23.412h3.334v25.881h-3.334z" fill="currentColor"></path></svg> </a>',
                            esc_attr__( 'Remove this item', 'woocommerce' ),
                            esc_attr( $product_id ),
                            esc_attr( $cart_item_key ),
                            esc_attr( $_product->get_sku() )
                        ),
                        $cart_item_key
                    );
                    ?>
                    <?php

                     if ( empty( $product_permalink ) ) : ?>

                        <?php echo sprintf('%1s %2s %3s',$thumbnail,$product_name,$rating);?>

                    <?php else : ?>

                        <a href="<?php echo esc_url( $product_permalink ); ?>">

                        <?php echo sprintf('%1s %2s %3s',$thumbnail,$product_name,$rating);?>
                        
                        </a>
                         <?php echo wc_get_formatted_cart_item_data( $cart_item );?>

                    <?php endif; 


                     ?>
                </div>
                <?php if(taiowc()->get_option( 'show_prd_quantity' ) == true){ ?>
                <div class="item-product-quantity">
                   
                    <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity"><span class="quantity-text">'.$quantity_text.'</span>' . sprintf( '%s  %s', $this->taiowc_mini_cart_add_quantity($_product,$cart_item_key,$cart_item), $product_price ) . '</span>', $cart_item, $cart_item_key ); 

                   ?>
               </div>
              <?php } ?>

            </div>

                <?php

            }
        }
        
        ?>
    </div>
     
    <?php else : 

    do_action('taiowc_mini_cart_empty');

    endif;

  }    
 
    public function taiowc_mini_cart_empty_content(){ 

             if(taiowc()->get_option( 'empty_cart_url' )){
              
              $empty_btn_url = taiowc()->get_option( 'empty_cart_url' );

             }else{

              $empty_btn_url = get_permalink( wc_get_page_id( 'shop' ) );

             }

        ?>
     
             <p class="woocommerce-mini-cart__empty-message"><?php esc_html_e( 'Your Cart is Empty', 'taiowc' ); ?></p>

             <a href="<?php echo esc_url($empty_btn_url);?>" class="woocommerce-back-to-shop"><?php echo esc_html(taiowc()->get_option( 'empty_cart_txt' )); ?></a>

    <?php }

    public function taiowc_mini_cart_add_quantity($_product,$cart_item_key,$cart_item){ 
                
                if ( $_product->is_sold_individually() ) {

                    $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );

                     } else {

                     $min = 0;

                     $max = $_product->get_max_purchase_quantity();

                    // Apply sanity to min/max args - min cannot be lower than 0.
                    $min = max( $min, 0 );

                    $max = 0 < $max ? $max : '';

                    // Max cannot be lower than min if defined.
                    if ( '' !== $max && $max < $min ) {

                      $max = $min;

                    }



                                    $input_id     = uniqid( 'quantity_' );
                                    $input_name   = "cart[{$cart_item_key}][qty]";
                                    $classes      = "taiowc-quantity input-text qty text";
                                    $input_value  = $cart_item['quantity'];
                                    $max_value    = $max;
                                    $min_value    = $min;
                                    $product_id   = $cart_item_key;
                                    

                            $product_quantity = sprintf( '<input type="number" id="%s" class="%s" name="%s" value="%s" step="1" max="%s" min="%s" data-key="%s"  title="Qty" size="4" placeholder="" inputmode="numeric">',$input_id, $classes, $input_name, $input_value, $max_value, $min_value , $product_id);

                            

                        }

                        return $product_quantity;

     }    


    public function taiowc_create_nonces(){

        $actions = array(
            'apply-coupon',
            'remove-coupon',
            'update-shipping-method'
        );

        $nonces = array();

        foreach ($actions as $action) {
            $nonces[$action] = wp_create_nonce( $action );
        }

        wp_send_json( $nonces );
    }

    //add item cart

        public function taiowc_add_item_cart(){

        $product_id   = sanitize_text_field( $_POST['product_id'] );

        $added = WC()->cart->add_to_cart( $product_id );

         if( $added ){

                $notice = __( 'Product Added', 'taiowc' );

                $this->set_notice( $notice, 'success' );
           }


        WC_AJAX::get_refreshed_fragments();

        die();

      }

     // update quantity

        public function taiowc_update_item_quantity(){

        $cart_key   = sanitize_text_field( $_POST['cart_key'] );
         $new_qty    = (float) $_POST['new_qty'];

        if( !is_numeric( $new_qty ) || $new_qty < 0 || !$cart_key ){
            //$this->set_notice( __( 'Something went wrong', 'taiowc' ) );
        }
        
        $validated = apply_filters( 'taiowc_update_quantity', true, $cart_key, $new_qty );

        if( $validated && !empty( WC()->cart->get_cart_item( $cart_key ) ) ){

            $updated = $new_qty == 0 ? WC()->cart->remove_cart_item( $cart_key ) : WC()->cart->set_quantity( $cart_key, $new_qty );

            if( $updated ){

                if( $new_qty == 0 ){

                    $notice = __( 'Product removed', 'taiowc' );

                    $notice .= ' <span class="taiowc-undo-item" data-key="'.esc_attr($cart_key).'">'.__('Undo?','taiowc').'</span>';  

                }
                else{
                    $notice = __( 'Cart Updated', 'taiowc' );
                }

                $this->set_notice( $notice, 'success' );
                
            }
        }

        WC_AJAX::get_refreshed_fragments();

        die();

      }

      //undo item

      public function taiowc_undo_item(){

            $cart_key = sanitize_text_field($_POST['cart_key']);

            if(!$cart_key) return;

            $cart_success = WC()->cart->restore_cart_item($cart_key);

            if($cart_success){

                $notice = __( 'Product restore', 'taiowc' );
                
                $this->set_notice( $notice, 'success' );

            }

            WC_AJAX::get_refreshed_fragments();
            
            die();

        }

        public function set_notice( $notice, $type = 'success' ){

        $this->notices[] = $this->taiowc_notice_html( $notice, $type );

        }


       public function taiowc_notice_html( $message, $notice_type = 'success' ){
        
        $classes = $notice_type === 'error' ? 'taiowc-notice-error' : 'taiowc-notice-success';
        
        $html = '<li class="'.esc_attr($classes).'">'.$message.'</li>';
        
        return apply_filters( 'taiowc_notice_html', $html, $message, $notice_type );

      }

     public function taiowc_print_notices_html( $section = 'cart', $wc_cart_notices = true ){

        if( isset( $_POST['noticeSection'] ) && $_POST['noticeSection'] !== $section ) return;

        if( $wc_cart_notices ){

            do_action( 'woocommerce_check_cart_items' );

            //Add WC notices
            $wc_notices = wc_get_notices( 'error' );

            foreach ( $wc_notices as $wc_notice ) {
                $this->set_notice( $wc_notice['notice'], 'error' );
            }

            wc_clear_notices();

        }

        $notices = apply_filters('taiowc_notices_before_print', $this->notices, $section );

        $notices_html = sprintf('<div class="taiowc-notice-container" data-section="%1$s"><ul class="taiowc-notices">%2$s</ul></div>', $section, implode( '' , $notices )  );

        echo apply_filters('taiowc_print_notices_html', $notices_html, $notices, $section );
        
        $this->notices = array();

    }


        public function HideCartPage(){

        if( isset( $this->HideCartPage ) ){
            return $this->HideCartPage;
        }

        if( !trim(taiowc()->get_option('not_showing_page')) ){

            $hidePages = array();

        }else{

            $hidePages = array_map( 'trim', explode( ',', taiowc()->get_option('not_showing_page') ) );
        }

        $this->isSideCartPage = !( !empty( $hidePages ) && ( ( in_array( 'no-woocommerce', $hidePages )  && !is_woocommerce() && !is_cart() && !is_checkout() ) || is_page( $hidePages ) ) || ( is_product() && in_array( get_the_id() , $hidePages ) ) );

        foreach ( $hidePages as $page_id ) {
            if( is_single( $page_id ) ){
                $this->isSideCartPage = false;
                break;
            }
        }
        
        return apply_filters( 'taiowc_is_sidecart_page', $this->isSideCartPage, $hidePages );
    }


  }

// Load Plugin

function taiowc(){

        return Taiowc::instance();
}
add_action( 'plugins_loaded', 'taiowc', 25 );

endif; 