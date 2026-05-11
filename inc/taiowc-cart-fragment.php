<?php

if ( ! defined( 'ABSPATH' ) ) exit;


if ( ! class_exists( 'Taiowc_Cart_Fragment' ) ):

    class Taiowc_Cart_Fragment {

        /**
         * Member Variable
         *
         * @var object instance
         */
        private static $instance;

        /**
         * Initiator
         */
        public static function get_instance() {

            if ( ! isset( self::$instance ) ) {

                self::$instance = new self();

            }

            return self::$instance;

        }

        /**
         * Constructor
         */

        public function __construct(){

            add_action( 'wc_ajax_get_refreshed_fragments', array( $this, 'taiowc_get_refreshed_fragments' ) );
            add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'taiowc_cart_count' ));
            add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'taiowc_cart_total' ));
            add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'taiowc_cart_mini_cart_product' ));
            add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'taiowc_cart_mini_cart_footer' ));
            add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'taiowc_cart_item_notice' ));
        }

        public function taiowc_get_refreshed_fragments(){
            
        WC_AJAX::get_refreshed_fragments();

        }

        public function taiowc_cart_count($fragments){

            ob_start();?>

            <div class="taiowc-cart-count">

            <?php  if ( WC()->cart && ! WC()->cart->is_empty() ) { ?>
               
                <div class="cart-count-item">
 
                <?php echo wp_kses_post(taiowc_main()->taiowc_get_cart_count()); ?>
                        
                </div>

                <?php } ?>

                </div>

               <?php $fragments['.taiowc-cart-count'] = ob_get_clean();  
            
               return $fragments;
        }

        public function taiowc_cart_total($fragments){
            ob_start(); 
            ?>
              <div class="taiowc-cart-total-wrap">

                <?php if ( WC()->cart && ! WC()->cart->is_empty() ) { 

                    if(taiowc_main()->taiowc_get_option( 'taiowc-show_price' ) == true){ 
                  ?>

                    <div class="taiowc-total">
                    <span>
                            <?php echo wp_kses_post( WC()->cart->get_cart_total() ); ?>
                    </span>
                    </div>

            <?php } } ?>
                    </div>

           <?php $fragments['.taiowc-cart-total-wrap'] = ob_get_clean();  
            return $fragments;
     }


     public function taiowc_cart_mini_cart_product($fragments){
        ob_start();
        ?>
        
        <div class="taiowc-cart-model-body">
                        
        <?php 

        do_action('taiowc_mini_cart'); 

        taiowc_markup_pro()->taiowc_get_suggest_product();

        ?>

        </div>

    <?php 

        $fragments['.taiowc-cart-model-body'] = ob_get_clean();  
        return $fragments;

    }


    public function taiowc_cart_mini_cart_footer($fragments){
        ob_start();
        ?>
        
        <div class="taiowc-cart-model-footer">

                     <?php 

                     if ( WC()->cart && ! WC()->cart->is_empty() ) {

                     WC()->cart->calculate_totals();

                     taiowc_markup_pro()->taiowc_cart_footer(); 

                     }
                    
                    ?>
                    <?php if (taiowc_main()->taiowc_get_option( 'taiowc-show_copyright' )) { ?>
                     
                    <span class="copyright"><?php esc_html_e( 'Powered by ', 'th-all-in-one-woo-cart' ); ?><a href="<?php echo esc_url(taiowc_main()->taiowc_get_option( 'taiowc-custom_copyright_link' )); ?>"><?php echo esc_html(taiowc_main()->taiowc_get_option( 'taiowc-custom_copyright' )); ?> <svg xmlns="http://www.w3.org/2000/svg" width="7" height="7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-external-link group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" aria-hidden="true"><path d="M15 3h6v6"></path><path d="M10 14 21 3"></path><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path></svg></a></span>

                <?php } ?>
        </div> 

    <?php 

        $fragments['.taiowc-cart-model-footer'] = ob_get_clean();  
        return $fragments;

    }

     public function taiowc_cart_item_notice($fragments){ 
              
               ob_start();   

               ?>
               <?php taiowc_main()->taiowc_print_notices_html('cart', true);?>

               <?php 

               $fragments['.taiowc-notice-container'] = ob_get_clean();
                    
               return $fragments;
            
        }

    }

endif; 

Taiowc_Cart_Fragment::get_instance();