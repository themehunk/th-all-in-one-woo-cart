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
            

        }

        public function taiowc_cart_show(){
                  

            ?>
               
                       <a class="taiowc-content" href="#">
                           
                        <?php if(taiowc()->get_option( 'cart_hd' )!==''){ ?>

                          <h4><?php echo esc_html(taiowc()->get_option( 'cart_hd' ));?></h4>

                           <?php } ?>

                           
                            <div class="cart-count-item">
                                
                                <?php echo taiowc()->get_cart_count(); ?>
                                    
                            </div>
                           
                            <div class="taiowc-cart-item">

                                <div class="taiowc-icon">
                                    <?php do_action('taiowc_cart_show_icon'); ?>
                                 </div>

                                 <?php if(taiowc()->get_option( 'tpcrt_show_price' ) == true){ ?>
                                 <div class="taiowc-total">

                                    <span><?php echo WC()->cart->get_cart_total(); ?></span>

                                </div>
                                <?php } ?>

                            </div>
                        </a>
                

        <?php }


        public function taiowc_cart_item_show(){ ?>

            <div class="taiowc-cart-model">   

               <div class="taiowc-cart-model-wrap">

                    <?php $this->taiowc_cart_header();?>

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

                   </div>

                   

               </div>
              

                    <div class="taiowc-notice-box">

                    <span class="taiowc-notice"></span>

                    </div>

             
            </div>

            

        <?php }


        public function taiowc_cart_header(){?>


                    <div class="taiowc-cart-model-header">

                        <div class="cart-heading">

                            <?php do_action('taiowc_cart_show_icon');?>

                           <?php if(taiowc()->get_option( 'cart_hd' )!==''){ ?>
                          <h4><?php echo esc_html(taiowc()->get_option( 'cart_hd' ));?></h4>
                           <?php } ?>

                          <a class="taiowc-cart-close"></a>

                        </div> 

                    </div>


        <?php }


        public function taiowc_cart_footer(){ ?>

                    <?php   

                     $this->taiowc_cart_total();

                     $this->taiowc_cart_button(); 

                    ?>
        <?php }
        
          public function taiowc_cart_total(){  
        

            ?>
                <div class="cart-total">
                    <span class="taiowc-payment-title"><?php echo esc_html(taiowc()->get_option('pay_hd')); ?></span>

                     <div class="taiowc-total-wrap">
                                
                            <div class="taiowc-subtotal">
                                <span class="taiowc-label"><?php echo esc_html(taiowc()->get_option('sub_total')); ?></span>
                                <span class="taiowc-value"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
                              </div>

                   </div>

                </div>


       <?php  }

        
        public function taiowc_cart_button(){ ?>
                

                     <div class="cart-button">
                            
                        <p class="buttons normal">

                        <?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?>
                            
                        </p>
                              
                     </div>

       <?php  }

       

      // Get Suggeted product/

      public function taiowc_get_suggest_product(){

        if(taiowc()->get_option( 'show_rld_product' ) == true){


        $enable = 1;
        $enable_mobile = 0;

        if($enable != 1 || ($enable_mobile != 1 && wp_is_mobile())) return;

        $type        = taiowc()->get_option( 'choose_prdct_like' );
        $items_count = 5;
        $title       = esc_html(taiowc()->get_option( 'product_may_like_tle' ));

        $cart        = WC()->cart->get_cart();

        $cart_is_empty = WC()->cart->is_empty();

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

            
            }

        }


        $items_count = count($suggested_products) !== 0 ? count($suggested_products)  : $items_count;
        
        $args = array(
            'suggested_products' => $suggested_products,
            'items_count'        => $items_count,
            'exclude_ids'        => $exclude_ids,
            'title'              => $title
        );


        $args = apply_filters( 'taiowc_suggested_product_args', $args );

        $args = array(
                    'post_type'             => 'product',
                    'post_status'           => 'publish',
                    'ignore_sticky_posts'   => 1,
                    'no_found_rows'         => 1,
                    'posts_per_page'        => $items_count,
                    'post__not_in'          => $exclude_ids,
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

                $products = wc_get_products( $args );

                if (!empty($products)) {

                ?>
                        <div class="taiowc-related-product-cont">
                            <span class="taiowc-related-product-title"><?php echo $title; ?></span>

                            <div class="taiowc-related-wrap">
                            <ul class="taiowc-related-product-products owl-carousel">

                                <?php 

                                foreach ($products as $product) {

                                $pid =  $product->get_id();
                     

                                ?>
                                <li id="<?php echo esc_attr($pid); ?>" class="taiowc-related-product-item product">

                                    <div class="taiowc-related-product-left-area">
                                        <div class="taiowcduct-image">
                                        <a href="<?php echo get_permalink($pid); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                                         <?php echo get_the_post_thumbnail( $pid, 'woocommerce_thumbnail' ); ?>
                                          </a>
                                       </div>
                                    </div>

                                    <div class="taiowc-related-product-right-area">
                                        <h4>
                                        <a href="<?php echo get_permalink($pid); ?>" class="woocommerce-LoopProduct-title woocommerce-loop-product__link"><?php echo $product->get_title(); ?></a>
                                       </h4>

                                        <?php
                                            $rat_product = wc_get_product($pid);
                                            $rating_count =  $rat_product->get_rating_count();
                                            $average =  $rat_product->get_average_rating();
                                            echo $rating_count = wc_get_rating_html( $average, $rating_count );
                                           ?>
                                      <div class="price"><?php echo $product->get_price_html(); ?></div>
                                       <?php echo $this->taiowc_add_to_cart_url($product);?>
                                      

                                    </div>   
                                </li>
                            <?php } ?>

                            </ul>
                          </div>
                        </div>

                        <script>
                    
                   jQuery(document).ready(function() {

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

                <?php }else{

                          echo __( 'No products found','taiowc' );

                        } 

           wp_reset_postdata(); 

       }

    }

    public function taiowc_add_to_cart_url($product){

         $cart_url =  apply_filters( 'woocommerce_loop_add_to_cart_link',
            sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" quantity="%s" class="button th-button %s %s"><span class="dashicons dashicons-plus-alt2"></span></a>',
                esc_url( $product->add_to_cart_url() ),
                esc_attr( $product->get_id() ),
                esc_attr( $product->get_sku() ),
                esc_attr( isset( $quantity ) ? $quantity : 1 ),
                $product->is_purchasable() && $product->is_in_stock() ? 'th-add_to_cart_button' : '',
                $product->is_purchasable() && $product->is_in_stock() && $product->supports( 'ajax_add_to_cart' ) ? 'th-ajax_add_to_cart' : '',
                esc_html( $product->add_to_cart_text() )
            ),$product );
         return $cart_url;
        }

        

}

function taiowc_markup(){

        return Taiowc_Markup_Pro::instance();

}
endif; 