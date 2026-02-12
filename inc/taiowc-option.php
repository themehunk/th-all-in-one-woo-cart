<?php

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Taiowc_Options' ) ):

    class Taiowc_Options {

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

           add_action( 'init', array( $this,'taiowc_option_settings'), 2 );

        }

        public function taiowc_option_settings(){

            taiowc()->add_setting(

            'taiowc_integration', esc_html__( 'Integration', 'taiowcp' ),

            apply_filters(

            'taiowc_integration_settings_section', array(

                array(

                    'title'  => esc_html__( '', 'taiowcp' ),

                    'fields' => apply_filters(
                        'taiowcp_integration_setting_fields', array(

                            array(
                                'id'      => 'taiowc-how-to-integrate',
                                'type'    => 'html',
                                'title'   => esc_html__( 'How To Add', 'taiowcp' ),
                            ),  
                        )
                    )
                 )
              )
            ),apply_filters( 'taiowcp_integration_settings_default_active', true )
          );

          


          taiowc()->add_setting(

            'taiowcp_general', esc_html__( 'General', 'taiowcp' ), 

            apply_filters(

            'taiowcp_general_settings_section', array(

                array(
                    'title'  => esc_html__( 'Fixed Cart', 'taiowcp' ),
                    'fields' => apply_filters(
                        'taiowcp_general_setting_fields', array(

                            array(
                                'id'      => 'taiowc-show_cart',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Enable Cart', 'taiowcp' ),
                                'desc'    => esc_html__( 'Uncheck to disable Floating and Fixed cart. Still you can use "Shortcode" and "Menu" cart', 'taiowcp' ),
                                'default' => true
                            ),


                            array(
                                'id'      => 'cart_style',
                                'type'    => 'radio-image',
                                'title'   => esc_html__( 'Cart Style', 'th-all-in-one-woo-cart' ),
                                
                                'options' => array(
                                    'style-1' => esc_url( TAIOWC_IMAGES_URI.'floating-cart.png' ),
                                    'style-2' => esc_url( TAIOWC_IMAGES_URI.'fixed-cart.png' ),
                                    
                                ),

                                'default' => 'style-1'
                            ),
                            array(
                                'id'      => 'taiowc-fxd_cart_position',
                                'type'    => 'select',
                                'title'   => esc_html__( 'Fixed Cart Position', 'th-all-in-one-woo-cart' ),
                                'default' => 'fxd-right',
                                'options' => array(

                                    'fxd-right' => esc_html__( 'Right', 'th-all-in-one-woo-cart' ),
                                    'fxd-left'  => esc_html__( 'Left', 'th-all-in-one-woo-cart'),
                                    
                                ),
                                
                            ),

                            array(
                                'id'      => 'taiowc-fxd_cart_frm_right',
                                'type'    => 'number',
                                'title'   => esc_html__( 'Fixed Cart Position From Right', 'th-all-in-one-woo-cart' ),
                                'default' => 36,
                                'min'     => 1,
                                'max'     => 400,
                                'suffix'  => 'px',
                                
                            ),
                            array(
                                'id'      => 'taiowc-fxd_cart_frm_left',
                                'type'    => 'number',
                                'title'   => esc_html__( 'Fixed Cart Position From Left', 'th-all-in-one-woo-cart' ),
                                'default' => 36,
                                'min'     => 1,
                                'max'     => 400,
                                'suffix'  => 'px',
                                
                            ),

                             array(
                                'id'      => 'taiowc-fxd_cart_frm_btm',
                                'type'    => 'number',
                                'title'   => esc_html__( 'Fixed Cart Position From Bottom', 'th-all-in-one-woo-cart' ),
                                'default' => 36,
                                'min'     => 1,
                                'max'     => 400,
                                'suffix'  => 'px',

                            ),

                            
                            array(
                                'id'      => 'taiowc-cart_hd',
                                'type'    => 'text',
                                'title'   => esc_html__( 'Cart Heading', 'th-all-in-one-woo-cart' ),
                                
                                'default' => esc_html__( 'Cart', 'th-all-in-one-woo-cart' ),

                                
                                
                            ),

                            array(
                                'id'      => 'taiowc-empty_cart_txt',
                                'type'    => 'text',
                                'title'   => esc_html__( 'Empty Cart Button Text', 'th-all-in-one-woo-cart' ),
                                
                                'default' => esc_html__( 'Back To Shop', 'th-all-in-one-woo-cart' ),

                                
                                
                            ),

                            array(
                                'id'      => 'taiowc-empty_cart_url',
                                'type'    => 'text',
                                'title'   => esc_html__( 'Empty Cart Button URL', 'th-all-in-one-woo-cart' ),
                                'desc'   => esc_html__( 'Add URL to which you want to redirect user in case of empty cart. By default user will be redirected to shop page.', 'th-all-in-one-woo-cart' ),
                                
                                'default' =>'',
                                
                                
                            ),

                                array(
                                'id'      => 'taiowcp-cart_open',
                                'type'    => 'select',
                                'title'   => esc_html__( 'Cart Open With', 'taiowcp' ),
                                'default' =>'simple-open',
                                'options' => array(

                                    'simple-open'   => esc_html__( 'Auto Open with Ajax', 'taiowcp' ),
                                    'fly-image-open' => esc_html__( 'Auto Open with Image fly Effect', 'taiowcp' ),
                                    
                                    
                                ),
                                'desc'    => esc_html__( 'These options will open cart panel as soon as product added to the cart.', 'taiowcp' ),
                                
                            ),

                                array(
                                'id'      => 'taiowc-cart-icon',
                                'type'    => 'radio-image',
                                'title'   => esc_html__( 'Choose Cart Icon', 'taiowcp' ),
                                
                                'options' => array(
                                    'icon-1' => esc_url( TAIOWC_IMAGES_URI.'icon-1.png' ),
                                    'icon-2' => esc_url( TAIOWC_IMAGES_URI.'icon-2.png' ),
                                    'icon-3' => esc_url( TAIOWC_IMAGES_URI.'icon-3.png' ),
                                    'icon-4' => esc_url( TAIOWC_IMAGES_URI.'icon-4.png' ),
                                    'icon-5' => esc_url( TAIOWC_IMAGES_URI.'icon-5.png' ),
                                    'icon-6' => esc_url( TAIOWC_IMAGES_URI.'icon-6.png' ),
                                    'icon-7' => esc_url( TAIOWC_IMAGES_URI.'custom-icon.png' ),
                                ),

                                'default' => 'icon-1'
                            ),

                                    array(
                                'id'      => 'taiowcp-icon_url',
                                'type'    => 'file',
                                'title'   => esc_html__( 'Upload Icon Image', 'taiowcp' ),
                                'desc'    => esc_html__( 'Recommended cart image size 60 x 60px', 'taiowcp' ),
                                'default' => false
                                ),

                                array(
                                'id'      => 'taiowcp-show_floatingcart',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Enable floating cart Visibility', 'taiowcp' ),
                                'desc'    => esc_html__( 'Check when you want to enable floating cart when no product is in cart', 'taiowcp' ),
                                'default' => true
                            ),
                            
                            

                            

                            // array(
                            //  'id'      => 'taiowcp-basket_count',
                            //  'type'    => 'select',
                            //  'title'   => esc_html__( 'Cart Item Count', 'taiowcp' ),
                            //  'default' =>'numb_prd',
                            //  'options' => array(

                            //      'numb_prd'   => esc_html__( 'Number of Product', 'taiowcp' ),
                            //      'quant_prd' => esc_html__( 'Sum of quantity of all products', 'taiowcp' ),
                                    
                            //  ),
                                
                            // ),

                            array(
                                'id'      => 'taiowcp-cart_fxd_2_hd',
                                'type'    => 'text',
                                'title'   => esc_html__( 'Cart Title', 'taiowcp' ),
                                'default' => esc_html__( 'Cart', 'taiowcp' ),
                            ),

                        

        
                        
    
                        )
                     )
                 ),

               )
             ),
           );

taiowc()->add_setting(
            'taiowcp_menu_cart', esc_html__( 'Menu Cart', 'taiowcp' ), apply_filters(
            'taiowcp_menu_cart_section', array(
                array(
                    'title'  => esc_html__( 'Menu Cart Configuration', 'taiowcp' ),
                    'fields' => apply_filters(
                        'taiowcp_top_cart_setting_fields', array(

                            array(

                                'id'      => 'taiowcp-show_price',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Show Price', 'taiowcp' ),
                                'desc'    => '',
                                'default' => true
                              ),

                            array(

                                'id'      => 'taiowcp-show_quantity',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Show Quantity', 'taiowcp' ),
                                'desc'    => '',
                                'default' => true
                              ),
                             
                            
                        )
                    )
                 ),

                array(
                    'title'  => esc_html__( 'Sizing & Layout', 'taiowcp' ),
                    'fields' => apply_filters(
                        'taiowcp_top_cart_setting_fields', array(

                                 array(
                                'id'      => 'taiowcp-prc_font_size',
                                'type'    => 'number',
                                'title'   => esc_html__( 'Price Font Size', 'taiowcp' ),
                                'default' => 14,
                                'min'     => 1,
                                'max'     => 50,
                                'suffix'  => 'px'
                            ),

                             array(
                                'id'      => 'taiowcp-icon_size',
                                'type'    => 'number',
                                'title'   => esc_html__( 'Icon Size', 'taiowcp' ),
                                'default' => 24,
                                'min'     => 1,
                                'max'     => 24,
                                'suffix'  => 'px'
                            ),

                        )
                    )
                 ),

                array(
                    'title'  => esc_html__( 'Color Palette', 'taiowcp' ),
                    'fields' => apply_filters(
                        'taiowcp_top_cart_setting_fields', array(

                            array(
                                        'id'      => 'taiowcp-bg_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Background', 'taiowcp' ),
                                        'default' => ''
                                        
                                ),
                             array(
                                        'id'      => 'taiowcp-price_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Price', 'taiowcp' ),
                                        'default' => '#111'
                                        
                                ),
                             array(
                                        'id'      => 'taiowcp-quantity_bg_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Quantity Background', 'taiowcp' ),
                                        'default' => '#111'
                                        
                                ),
                              array(
                                        'id'      => 'taiowcp-quantity_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Quantity Text Color', 'taiowcp' ),
                                        'default' => '#fff'
                                        
                                ),
                               array(
                                        'id'      => 'taiowcp-cart_icon_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Cart Icon Color', 'taiowcp' ),
                                        'default' => '#111'
                                        
                                ),

                        )
                    )
                 ),

                )
            )
          );




         

        taiowc()->add_setting(
            'taiowcp_fixed_cart', esc_html__( 'Fixed Cart', 'taiowcp' ), apply_filters(
            'taiowcp_fixed_cart_section', array(
                array(
                    'title'  => esc_html__( 'Fixed Cart Configuration', 'taiowcp' ),
                    'fields' => apply_filters(
                        'taiowcp_top_cart_setting_fields', array(

                        array(
                                'id'      => 'taiowcp-cart_style',
                                'type'    => 'radio-image',
                                'title'   => esc_html__( 'Cart Style', 'taiowcp' ),
                                
                                'options' => array(
                                    'style-1' => esc_url( TAIOWC_IMAGES_URI.'floating-cart.png' ),
                                    'style-2' => esc_url( TAIOWC_IMAGES_URI.'fixed-cart.png' ),
                                    
                                ),

                                'default' => 'style-1'
                            ),

                        array(

                                'id'      => 'taiowcp-fxcrt_show_quantity',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Show Quantity', 'taiowcp' ),
                                'desc'    => '',
                                'default' => true
                              ),
                        
                            array(
                                'id'      => 'taiowcp-fxd_cart_position',
                                'type'    => 'select',
                                'title'   => esc_html__( 'Position', 'taiowcp' ),
                                'default' => 'fxd-right',
                                'options' => array(

                                    'fxd-right' => esc_html__( 'Right', 'taiowcp' ),
                                    'fxd-left'  => esc_html__( 'Left', 'taiowcp' ),
                                    
                                ),
                                
                            ),

                            array(
                                'id'      => 'taiowcp-fxd_cart_frm_right',
                                'type'    => 'number',
                                'title'   => esc_html__( 'From Right', 'taiowcp' ),
                                'default' => 29,
                                'min'     => 1,
                                'max'     => 400,
                                'suffix'  => 'px',
                                
                            ),
                            array(
                                'id'      => 'taiowcp-fxd_cart_frm_left',
                                'type'    => 'number',
                                'title'   => esc_html__( 'From Left', 'taiowcp' ),
                                'default' => 29,
                                'min'     => 1,
                                'max'     => 400,
                                'suffix'  => 'px',
                                
                            ),

                             array(
                                'id'      => 'taiowcp-fxd_cart_frm_btm',
                                'type'    => 'number',
                                'title'   => esc_html__( 'From Bottom', 'taiowcp' ),
                                'default' => 36,
                                'min'     => 1,
                                'max'     => 400,
                                'suffix'  => 'px',

                            ),
                            
                             
                            
                        )
                    )
                 ),

                array(
                    'title'  => esc_html__( 'Style Properties', 'taiowcp' ),
                    'fields' => apply_filters(
                        'taiowcp_top_cart_setting_fields', array(

                             array(
                                'id'      => 'taiowcp-fxcrt_icon_size',
                                'type'    => 'number',
                                'title'   => esc_html__( 'Icon Size', 'taiowcp' ),
                                'default' => 24,
                                'min'     => 1,
                                'max'     => 24,
                                'suffix'  => 'px'
                            ),

                             array(
                                'id'      => 'taiowcp-fxcrt_icon_brd_rds',
                                'type'    => 'number',
                                'title'   => esc_html__( 'Border Radius', 'taiowcp' ),
                                'default' => 100,
                                'min'     => 0,
                                'max'     => 100,
                                'suffix'  => 'px'
                            ),                          

                        )
                    )
                 ),

                array(
                    'title'  => esc_html__( 'Color Palette', 'taiowcp' ),
                    'fields' => apply_filters(
                        'taiowcp_top_cart_setting_fields', array(

                              array(
                                        'id'      => 'taiowcp-fxcrt_cart_bg_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Cart Background', 'taiowcp' ),
                                        'default' => '#ffffff70'
                                        
                                ),

                              array(
                                        'id'      => 'taiowcp-fxcrt_cart_icon_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Cart Icon Color', 'taiowcp' ),
                                        'default' => '#111'
                                        
                                ),
                            array(
                                        'id'      => 'taiowcp-fxcrt_cart_tle_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Price Text Color', 'taiowcp' ),
                                        'default' => '#111'
                                        
                                ),

                              array(
                                        'id'      => 'taiowcp-fxcrt_qnty_bg_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Quantity Background', 'taiowcp' ),
                                        'default' => '#111'
                                        
                                ),
                              array(
                                        'id'      => 'taiowcp-fxcrt_qnty_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Quantity Text Color', 'taiowcp' ),
                                        'default' => '#fff'
                                        
                                ),  
                            
                            

                        )
                    )
                 ),

                )
            )
          );
    

    taiowc()->add_setting(
            'taiowcp-cart_style_set', esc_html__( 'Cart Side Panel', 'taiowcp' ), apply_filters(
            'taiowcp-cart_style_settings_section', array(
                    array(
                    'title'  => esc_html__( 'FIXED CART / FLOATING CART', 'taiowcp' ),
                    'fields' => apply_filters(
                        'taiowcp_fix_cart_setting_fields', array(

                            

                            
                            
                        )
                    )
                 ),

                     array(
                    'title'  => esc_html__('Cart Panel Settings', 'taiowcp' ),
                    'fields' => apply_filters(
                        'taiowcp_related_product_setting_fields', array(

                             array(

                                'id'      => 'taiowcp-cart_pan_icon_shw',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Show Icon', 'taiowcp' ),
                                'desc'    => '',
                                'default' => true
                              ),

                            array(
                                'id'      => 'taiowcp-cart_effect',
                                'type'    => 'select',
                                'title'   => esc_html__( 'Open Style', 'taiowcp' ),
                                'default' =>'taiowcp-slide-right',
                                'options' => array(

                                    'taiowcp-slide-right'   => esc_html__( 'Slide Right', 'taiowcp' ),
                                    'taiowcp-slide-left' => esc_html__( 'Slide Left', 'taiowcp' ),
                                    'taiowcp-click-dropdown' => esc_html__( 'Dropdown on Click', 'taiowcp' ),
                                    'taiowcp-click-cart' => esc_html__( 'Cart Page', 'taiowcp' ),
                                    
                                ),
                                
                            ),

                            array(
                                'id'      => 'taiowcp-cart_hd',
                                'type'    => 'text',
                                'title'   => esc_html__( 'Heading', 'taiowcp' ),
                                'default' => esc_html__( 'Your Cart', 'taiowcp' ),
                            ),

                            array(
                                'id'      => 'taiowcp-cart_item_order',
                                'type'    => 'select',
                                'title'   => esc_html__( 'Product Order', 'taiowcp' ),
                                'default' =>'prd_first',
                                'options' => array(

                                    'prd_first' => esc_html__( 'Add Product at the Top', 'taiowcp' ),

                                    'prd_last'   => esc_html__( 'Add Product at the Bottom', 'taiowcp' ),
                                    
                                    
                                ),
                                
                            ),
                            
                            array(
                                'id'      => 'taiowcp-empty_cart_txt',
                                'type'    => 'text',
                                'title'   => esc_html__( 'Empty Cart Button Text', 'taiowcp' ),
                                
                                'default' => esc_html__( 'Start Shopping', 'taiowcp' ),

                                
                                
                            ),

                            array(
                                'id'      => 'taiowcp-empty_cart_url',
                                'type'    => 'text',
                                'title'   => esc_html__( 'Empty Cart Button URL', 'taiowcp' ),
                                'desc'   => esc_html__( 'Empty Cart Button URL- Add URL Where you want to redirect user in case of empty cart. By Default users will be redirected to Shop Page.', 'taiowcp' ),
                                'default' =>'',
                            ),

                            array(

                                'id'      => 'taiowcp-cart_pan_cart_shw',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Show Cart Button', 'taiowcp' ),
                                'desc'    => '',
                                'default' => true
                              ),

                            array(
                                'id'      => 'taiowcp-show_copyright',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Show Footer Text', 'taiowcp' ),
                                'default' => true
                            ),

                            array(
                                'id'      => 'taiowcp-custom_copyright',
                                'type'    => 'text',
                                'title'   => esc_html__( 'Footer Text', 'taiowcp' ),
                                
                                'default' => esc_html__( 'ThemeHunk', 'taiowcp' ),  
                                
                            ),

                            array(
                                'id'      => 'taiowcp-custom_copyright_link',
                                'type'    => 'text',
                                'title'   => esc_html__( 'Link', 'taiowcp' ),
                                
                                'default' => esc_html__( 'https://themehunk.com/', 'taiowcp' ), 
                                
                            ),

                        
                                
                        )
                    )
                 ),

                array(
                    'title'  => esc_html__( 'Cart Header Area', 'taiowcp' ),
                    'fields' => apply_filters(
                        'taiowcp_cart_pan_header', array(

                              array(
                                        'id'      => 'taiowcp-cart_pan_icon_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Icon Color', 'taiowcp' ),
                                        'default' => '#111'
                                        
                                ),
                               array(
                                        'id'      => 'taiowcp-cart_pan_hd_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Heading Color', 'taiowcp' ),
                                        'default' => '#111'
                                        
                                ),
                               array(
                                        'id'      => 'taiowcp-cart_pan_cls_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Close Color', 'taiowcp' ),
                                        'default' => '#111'
                                        
                                ),

                               array(
                                        'id'      => 'taiowcp-cart_pan_hdr_bg_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Header Background', 'taiowcp' ),
                                        'default' => ''
                                        
                                ),  
                              
                        )
                    )
                 ),

                array(
                    'title'  => esc_html__( 'Cart Content Area', 'taiowcp' ),
                    'fields' => apply_filters(
                        'taiowcp_cart_pan_setting_fields', array(

                               array(
                                        'id'      => 'taiowcp-cart_pan_bg_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Background', 'taiowcp' ),
                                        'default' => '#f9fafb'
                                        
                                ),  

                               array(
                                        'id'      => 'taiowcp-cart_pan_prd_bg_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Product Background', 'taiowcp' ),
                                        'default' => '#fff'
                                        
                                ),
                               array(
                                        'id'      => 'taiowcp-cart_pan_prd_tle_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Product Title Color', 'taiowcp' ),
                                        'default' => '#111'
                                        
                                ),
                                array(
                                        'id'      => 'taiowcp-cart_pan_prd_rat_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Product Rating Color', 'taiowcp' ),
                                        'default' => '#e5a632'
                                        
                                ),
                                array(
                                        'id'      => 'taiowcp-cart_pan_prd_dlt_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Product Delete Color', 'taiowcp' ),
                                        'default' => '#ef6238'
                                        
                                ),
                                array(
                                        'id'      => 'taiowcp-cart_pan_prd_txt_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Product Text Color', 'taiowcp' ),
                                        'default' => '#111'
                                        
                                ),
                                array(
                                        'id'      => 'taiowcp-cart_pan_prd_brd_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Product Border Color', 'taiowcp' ),
                                        'default' => '#ebebeb'
                                        
                                ),
                        )
                    )
                 ),

                array(
                    'title'  => esc_html__( 'Cart Panel order Area', 'taiowcp' ),
                    'fields' => apply_filters(
                        'taiowcp_cart_pan_pay_setting_fields', array(

                                array(
                                        'id'      => 'taiowcp-cart_pan_pay_bg_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Background Color', 'taiowcp' ),
                                        'default' => ''
                                        
                                ),
                                array(
                                        'id'      => 'taiowcp-cart_pan_pay_txt_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Text Color', 'taiowcp' ),
                                        'default' => '#111'
                                        
                                ),

                                array(
                                        'id'      => 'taiowcp-cart_pan_pay_hd_bg_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Heading Background', 'taiowcp' ),
                                        'default' => ''
                                        
                                ),
                                array(
                                        'id'      => 'taiowcp-cart_pan_pay_hd_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Heading Color', 'taiowcp' ),
                                        'default' => '#8b95a5'
                                        
                                ),

                                array(
                                        'id'      => 'taiowcp-cart_pan_pay_link_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Link Color', 'taiowcp' ),
                                        'default' => '#111'
                                        
                                ),

                                array(
                                        'id'      => 'taiowcp-cart_pan_pay_btn_bg_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Checkout Background', 'taiowcp' ),
                                        'default' => '#111'
                                        
                                ),
                                array(
                                        'id'      => 'taiowcp-cart_pan_pay_btn_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Checkout Button Color', 'taiowcp' ),
                                        'default' => '#fff'
                                        
                                ),

                                array(
                                        'id'      => 'taiowcp-cart_pan_pay_cart_bg_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Cart Background', 'taiowcp' ),
                                        'default' => ''
                                        
                                ),
                                array(
                                        'id'      => 'taiowcp-cart_pan_pay_cart_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Cart Button Color', 'taiowcp' ),
                                        'default' => '#111'
                                        
                                ),

                                array(
                                'id'      => 'taiowcp-cart_pan_btn_brd_rds',
                                'type'    => 'number',
                                'title'   => esc_html__( 'Border Radius', 'taiowcp' ),
                                'default' => 12,
                                'min'     => 0,
                                'max'     => 100,
                                'suffix'  => 'px'
                            ),
                    
                        
                                
                          )
                      )
                 ),


                array(
                    'title'  => esc_html__( 'Cart Panel May you like Style', 'taiowcp' ),
                    'fields' => apply_filters(
                        'taiowcp_cart_pan_rltd_setting_fields', array(

                                array(
                                        'id'      => 'taiowcp-cart_pan_rltd_hd_bg_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Heading Background', 'taiowcp' ),
                                        'default' => '#fff'
                                        
                                ),
                                array(
                                        'id'      => 'taiowcp-cart_pan_rltd_hd_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Heading Color', 'taiowcp' ),
                                        'default' => '#111'
                                        
                                ),
                                array(
                                        'id'      => 'taiowcp-cart_pan_rltd_prd_bg_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Product Background', 'taiowcp' ),
                                        'default' => '#fff'
                                        
                                ),
                                array(
                                        'id'      => 'taiowcp-cart_pan_rltd_prd_tle_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Product Title Color', 'taiowcp' ),
                                        'default' => '#111'
                                        
                                ),
                                array(
                                        'id'      => 'taiowcp-cart_pan_rltd_prd_rat_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Product Rating Color', 'taiowcp' ),
                                        'default' => '#e5a632'  
                                ),
                                array(
                                        'id'      => 'taiowcp-cart_pan_rltd_prd_prc_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Product Price Color', 'taiowcp' ),
                                        'default' => '#111' 
                                ),
                                array(
                                        'id'      => 'taiowcp-cart_pan_rltd_prd_add_bg_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Product Add to cart Background', 'taiowcp' ),
                                        'default' => '#111' 
                                ),
                                array(
                                        'id'      => 'taiowcp-cart_pan_rltd_prd_add_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Product Add to cart Color', 'taiowcp' ),
                                        'default' => '#fff' 
                                ),
                                
                          )
                      )
                 ),

                    array(
                    'title'  => esc_html__( 'Coupon Style', 'taiowcp' ),
                    'fields' => apply_filters(
                        'taiowcp_cart_coupon_setting_fields', array(
                                array(
                                        'id'      => 'taiowcp-cart_coupon_box_bg_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Coupon Box Background', 'taiowcp' ),
                                        'default' => '#f3f3f3'
                                        
                                ),
                                array(
                                        'id'      => 'taiowcp-cart_coupon_box_brd_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Coupon Box Border Color', 'taiowcp' ),
                                        'default' => '#f3f3f3'
                                        
                                ),
                                array(
                                        'id'      => 'taiowcp-cart_coupon_box_txt_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Coupon Box Text Color', 'taiowcp' ),
                                        'default' => '#111'
                                        
                                ),
                                array(
                                        'id'      => 'taiowcp-cart_coupon_box_submt_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Coupon Box Submit Color', 'taiowcp' ),
                                        'default' => ''
                                        
                                ),
                                array(
                                        'id'      => 'taiowcp-cart_coupon_box_view_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Coupon View Color', 'taiowcp' ),
                                        'default' => '#008000'
                                        
                                ),

                                array(
                                        'id'      => 'taiowcp-cart_coupon_code_bg_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Coupon Code Background', 'taiowcp' ),
                                        'default' => '#FFF'
                                        
                                ),
                                array(
                                        'id'      => 'taiowcp-cart_coupon_code_brd_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Coupon Code Border Color', 'taiowcp' ),
                                        'default' => 'rgba(129,129,129,.2)'
                                        
                                ),
                                array(
                                        'id'      => 'taiowcp-cart_coupon_code_txt_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Coupon Code Text Color', 'taiowcp' ),
                                        'default' => '#111'
                                        
                                ),
                                array(
                                        'id'      => 'taiowcp-cart_coupon_code_ofr_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Coupon Code Offer Color', 'taiowcp' ),
                                        'default' => '#9ca3af'
                                        
                                ),

                                array(
                                        'id'      => 'taiowcp-cart_coupon_code_btn_bg_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Coupon Code Button Background', 'taiowcp' ),
                                        'default' => '#111'
                                        
                                ),
                                array(
                                        'id'      => 'taiowcp-cart_coupon_code_btn_txt_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Coupon Code Button Text Color', 'taiowcp' ),
                                        'default' => '#fff'
                                        
                                ),
                                array(
                                        'id'      => 'taiowcp-cart_coupon_code_add_bg_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Added Coupon Background', 'taiowcp' ),
                                        'default' => '#f6f7f7'
                                        
                                ),
                                array(
                                        'id'      => 'taiowcp-cart_coupon_code_add_txt_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Added Coupon Text Color', 'taiowcp' ),
                                        'default' => '#111'
                                        
                                ),
                                array(
                                        'id'      => 'taiowcp-cart_coupon_code_add_dlt_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Added Coupon Cross Color', 'taiowcp' ),
                                        'default' => '#ef6238'
                                        
                                ),
                                
                    
                        
                                
                          )
                      )
                 ),

                array(
                    'title'  => esc_html__( 'Cart Panel Notification', 'taiowcp' ),
                    'fields' => apply_filters(
                        'taiowcp_cart_pan_notify_setting_fields', array(

                                array(

                                'id'      => 'taiowcp-cart_pan_notify_shw',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Show Notification', 'taiowcp' ),
                                'desc'    => '',
                                'default' => true
                              ),
                                array(
                                        'id'      => 'taiowcp-success_mgs_bg_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Success Background', 'taiowcp' ),
                                        'default' => '#4db359'
                                        
                                ),
                                array(
                                        'id'      => 'taiowcp-success_mgs_txt_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Success Text Color', 'taiowcp' ),
                                        'default' => '#fff'
                                        
                                ),
                                array(
                                        'id'      => 'taiowcp-error_mgs_bg_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Error Background', 'taiowcp' ),
                                        'default' => '#b73d3d'
                                        
                                ),
                                array(
                                        'id'      => 'taiowcp-error_mgs_txt_clr',
                                        'type'    => 'colorpkr',
                                        'title'   => esc_html__( 'Error Text Color', 'taiowcp' ),
                                        'default' => '#fff'
                                        
                                ),
                        
                                
                          )
                      )
                 ),
              )
            )
          );


          taiowc()->add_setting(
            'taiowcp_cart', esc_html__( 'Content Visibility', 'taiowcp' ), apply_filters(
            'taiowcp_cart_settings_section', array(
                array(
                    'title'  => esc_html__( 'Product List', 'taiowcp' ),
                    'fields' => apply_filters(
                        'taiowcp_cart_setting_fields', array(
                            array(
                                'id'      => 'taiowcp-show_prd_img',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Product Image', 'taiowcp' ),
                                'desc'    => esc_html__( 'Uncheck to hide product image from cart panel.', 'taiowcp' ),
                                'default' => true
                            ),  
                            array(
                                'id'      => 'taiowcp-show_prd_title',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Product Title', 'taiowcp' ),
                                'desc'    => esc_html__( 'Uncheck to hide product Title from cart panel.', 'taiowcp' ),
                                'default' => true
                            ),  
                            array(
                                'id'      => 'taiowcp-show_prd_price',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Product Price', 'taiowcp' ),
                                'desc'    => esc_html__( 'Uncheck to hide product Price from cart panel.', 'taiowcp' ),
                                'default' => true
                            ),  
                            array(
                                'id'      => 'taiowcp-show_prd_quantity',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Product Quantity', 'taiowcp' ),
                                'desc'    => esc_html__( 'Uncheck to hide product Quantity from cart panel.', 'taiowcp' ),
                                'default' => true
                            ),  
                            array(
                                'id'      => 'taiowcp-show_prd_rating',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Product Rating', 'taiowcp' ),
                                'desc'    => esc_html__( 'Uncheck to hide product Rating from cart panel.', 'taiowcp' ),
                                'default' => true
                            ),  
                            
                            
                        )
                    )
                 ),


                array(
                    'title'  => esc_html__('PRODUCTS YOU MAY ALSO LIKE', 'taiowcp' ),
                    'fields' => apply_filters(
                        'taiowcp_related_product_setting_fields', array(
                            array(
                                'id'      => 'taiowcp-show_rld_product',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Enable', 'taiowcp' ),
                                'desc'    => esc_html__( 'Enable/Disable “Product You May Also Like” Section on the Cart Panel Below Product List. (By Enabling this you will be able to display products from Cross Sell, Up Sell, Related or from Custom Products.)', 'taiowcp' ),
                                'default' => true
                            ),  

                            array(
                                'id'      => 'taiowcpduct_may_like_tle',
                                'type'    => 'text',
                                'title'   => esc_html__( 'Heading', 'taiowcp' ),
                                'default' => esc_html__( 'Products you may like', 'taiowcp' ),
                                    
                            ),

                            array(

                                'id'      => 'taiowcp-choose_prdct_like',
                                'type'    => 'select',
                                'title'   => esc_html__( 'Choose Product', 'taiowcp' ),
                                'default' =>'croos-sell',
                                'options' => array(
                                    'cross-sell'   => esc_html__( 'Cross Sell', 'taiowcp' ),
                                    'up-sell'      => esc_html__( 'Up Sell', 'taiowcp' ),
                                    'related'      => esc_html__( 'Related', 'taiowcp' ),
                                    'product-by-slug'     => esc_html__( 'Your Products', 'taiowcp' ),      
                                ),
                                
                            ),  

                            array(
                                'id'      => 'taiowcpduct_may_like_id',
                                'type'    => 'text',
                                'title'   => esc_html__( 'Product Slug', 'taiowcp' ),
                                'default' => '',
                                'desc'    => esc_html__( 'Use Product Slug separated by comma. For eg: product-1, product-2 ', 'taiowcp' ), 
                            ),
                            
                        )
                    )
                 ),


                    array(
                    'title'  => esc_html__( 'Payment Settings', 'taiowcp' ),
                    'fields' => apply_filters(
                        'taiowcp_payment_setting_fields', array(
                            array(
                                'id'      => 'taiowcp-pay_hd',
                                'type'    => 'text',
                                'title'   => esc_html__( 'Payment Heading', 'taiowcp' ),
                                'default' =>esc_html__( 'Payment Details', 'taiowcp' ), 
                                
                            ),
                            array(
                                'id'      => 'taiowcp-sub_total',
                                'type'    => 'text',
                                'title'   => esc_html__( 'Sub Total Text', 'taiowcp' ),
                                'default' =>esc_html__( 'Sub Total', 'taiowcp' ),   
                                
                            ),  

                            array(
                                'id'      => 'taiowcp-show_shipping',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Show Shipping', 'taiowcp' ),
                                'desc'    => esc_html__( 'Uncheck to hide shipping details from cart panel.', 'taiowcp' ),
                                'default' => true
                            ),
                            array(
                                'id'      => 'taiowcp-ship_txt',
                                'type'    => 'text',
                                'title'   => esc_html__( 'Shipping Text', 'taiowcp' ),
                                'default' =>esc_html__( 'Shipping', 'taiowcp' ),    
                                
                            ),

                            array(
                                'id'      => 'taiowcp-show_discount',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Show Discount', 'taiowcp' ),
                                'desc'    => esc_html__( 'Uncheck to hide product discount from cart panel.', 'taiowcp' ),
                                'default' => true
                            ),
                            array(
                                'id'      => 'taiowcp-discount_txt',
                                'type'    => 'text',
                                'title'   => esc_html__( 'Discount Text', 'taiowcp' ),
                                'default' =>esc_html__( 'Discount', 'taiowcp' ),    
                                
                            ),
                            array(
                                'id'      => 'taiowcp-total_txt',
                                'type'    => 'text',
                                'title'   => esc_html__( 'Total Text', 'taiowcp' ),
                                'default' =>esc_html__( 'Total', 'taiowcp' ),   
                                
                            )

                            
                        )
                    )
                 ),
                    array(
                    'title'  => esc_html__( 'COUPON SETTINGS', 'taiowcp' ),
                    'fields' => apply_filters(
                        'taiowcp_coupon_setting_fields', array(   
                              array(

                                'id'      => 'taiowcp-show_coupon',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Show Coupon', 'taiowcp' ),
                                'default' => true,
                                'desc'   => esc_html__( 'Uncheck to hide coupon details from cart panel.', 'taiowcp' ),
                              ),

                             array(

                                'id'      => 'taiowcp-coupon_plchdr_txt',
                                'type'    => 'text',
                                'title'   => esc_html__( 'Placeholder Text', 'taiowcp' ),
                                'default' =>esc_html__( 'Enter your Promo Code', 'taiowcp' ),   
                                
                              ),

                             array(

                                'id'      => 'taiowcp-coupon_aply_txt',
                                'type'    => 'text',
                                'title'   => esc_html__( 'Apply Coupon Button Text', 'taiowcp' ),
                                'default' =>esc_html__( 'Apply', 'taiowcp' ),   
                                
                              ),

                              array(

                                'id'      => 'taiowcp-show_coupon_list',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Show Coupon List', 'taiowcp' ),
                                'desc'    => esc_html__( 'Uncheck to hide coupon list from cart panel.', 'taiowcp' ),
                                'default' => true
                            ),

                              array(
                                'id'      => 'taiowcp-coupon_btn_txt',
                                'type'    => 'text',
                                'title'   => esc_html__( 'View Coupon Link Text', 'taiowcp' ),
                                'default' =>esc_html__( 'View Coupons', 'taiowcp' ),    
                                
                            ),

                               array(

                                'id'      => 'taiowcp-show_added_coupon',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Show Added Coupon', 'taiowcp' ),
                                'desc'    => esc_html__( 'Uncheck to hide applied coupons list.', 'taiowcp' ),
                                'default' => true
                              ),
                            
                         )
                      )
                  ),        


              )

            ),
          );

          taiowc()->add_setting(
            'taiowcp_hide_cart', esc_html__( 'Visibility Rules', 'taiowcp' ), apply_filters(
            'taiowcp_cart_hide_section', array(
                array(
                    'title'  => esc_html__( 'Page Exclusion List', 'taiowcp' ),
                    'fields' => apply_filters(
                        'taiowcp_cart_hide_fields', array(
                            array(
                                'id'      => 'taiowcp-hide-cartp',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Hide on Cart Page', 'taiowcp' ),  
                                'desc'    => esc_html__( 'Prevents the floating cart from appearing when the customer is viewing their cart summary.', 'taiowcp' ),
                                'default' => false
                            ),  
                            array(
                                'id'      => 'taiowcp-hide-checkoutp',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Hide on Checkout Page', 'taiowcp' ),
                                'desc'    => esc_html__( 'Disables the cart widget during the checkout process to minimize distractions and improve conversion.', 'taiowcp' ),  
                                'default' => false
                            ),  
                            array(
                                'id'      => 'taiowcp-hide-shopp',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Hide on Shop Page', 'taiowcp' ),
                                'desc'    => esc_html__( 'Hides the cart on the main product archive/shop directory pages.', 'taiowcp' ),   
                                'default' => false
                            ),
                            array(
                                'id'      => 'taiowcp-hide-accountp',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Hide on Account Page', 'taiowcp' ),   
                                'desc'    => esc_html__( 'Removes visibility from the customer dashboard and account management areas.', 'taiowcp' ),
                                'default' => false
                            ),
                            array(
                                'id'      => 'taiowcp-hide-singlep',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Hide on Single Product Page', 'taiowcp' ),
                                'desc'    => esc_html__( 'Hides the widget specifically on individual product landing pages.', 'taiowcp' ), 
                                'default' => false
                            ),  
                            array(
                                'id'      => 'taiowcp-hide-homep',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Hide on Home Page', 'taiowcp' ),
                                'desc'    => esc_html__( 'Keep your landing page clean by hiding the cart widget on your root domain home page.', 'taiowcp' ),  
                                'default' => false
                            ),
                            array(
                                'id'      => 'taiowcp-hide-blogp',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Hide on Blog Feed', 'taiowcp' ),
                                'desc'    => esc_html__( 'Hides the cart widget when users are reading your blog posts or news feed.', 'taiowcp' ), 
                                'default' => false
                            ),  
                            array(
                                'id'      => 'taiowc-not_showing_page',
                                'type'    => 'textarea',
                                'title'   => esc_html__( 'Hide Cart from Pages', 'taiowcp' ),
                                'desc'   => esc_html__( 'To Hide Cart from Selected Pages, Use Taxonomy/PageID/Slug Separated by Comma. For Eg: post,69,about-us.
                                To hide Cart from all Non WooCommerce Pages use no-woocommerce Same for Checkout Page use checkout, and for Cart page use cart', 'taiowcp' ),
                                'default' =>'',
                                
                                
                            ),
                
                        )
                    )
                 ),

                )
            )
          );



          taiowc()->add_setting(
            'taiowcp_mobile_cart', esc_html__( 'Mobile Experience', 'taiowcp' ), apply_filters(
            'taiowcp_mobile_cart_settings_section', array(
                array(
                    'title'  => esc_html__( 'Menu Cart / Shortcode Cart', 'taiowcp' ),
                    'fields' => apply_filters(
                        'taiowcp_mobile_menu_cart_setting_fields', array(           
                                array(
                                'id'      => 'taiowcp-dsble_mnu_crt',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Disable', 'taiowcp' ),
                                'desc'    => esc_html__( 'Disable Menu Cart/Shortcode Cart in mobile', 'taiowcp' ),
                                'default' => false
                                ),
                                array(
                                'id'      => 'taiowcp-dsble_mnu_crt_qnty',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Disable Cart Quantity', 'taiowcp' ),
                                'desc'    => '',
                                'default' => false
                                ),
                                array(
                                'id'      => 'taiowcp-dsble_mnu_crt_price',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Disable Cart Price', 'taiowcp' ),
                                'desc'    => '',
                                'default' => false
                                ),

                                
                          )
                      )
                 ),
                   array(
                    'title'  => esc_html__( 'FIXED CART / FLOATING CART', 'taiowcp' ),
                    'fields' => apply_filters(
                        'taiowcp_fxd_mobile_cart_setting_fields', array(            
                                array(
                                'id'      => 'taiowcp-dsble_fxd_crt',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Disable', 'taiowcp' ),
                                'desc'    => esc_html__( 'Disable Fixed Cart in mobile', 'taiowcp' ),
                                'default' => false
                                ),
                                array(
                                'id'      => 'taiowcp-dsble_fxd_crt_qnty',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Disable Quantity', 'taiowcp' ),
                                'desc'    => '',
                                'default' => false
                                ),  


                            array(
                                'id'      => 'taiowcp-fxd_cart_mobile_position',
                                'type'    => 'select',
                                'title'   => esc_html__( 'Position', 'taiowcp' ),
                                'desc'    => esc_html__( 'This will overide the Global Position Setting', 'taiowcp' ),
                                'default' => '',
                                'options' => array(

                                    'fxd-right' => esc_html__( 'Right', 'taiowcp' ),
                                    'fxd-left'  => esc_html__( 'Left', 'taiowcp' ),
                                    
                                ),
                                
                            ),  
                          )
                      )
                 ),
                   array(
                    'title'  => esc_html__( 'Cart Panel', 'taiowcp' ),
                    'fields' => apply_filters(
                        'taiowcp_mob_cart_pnl_setting_fields', array(
                                array(
                                'id'      => 'taiowcp-cart_mobile_effect',
                                'type'    => 'select',
                                'title'   => esc_html__( 'Open Style', 'taiowcp' ),
                                'default' =>'mobiletopslide',
                                'options' => array(

                                    'global'   => esc_html__( 'Global', 'taiowcp' ),
                                    'mobiletopslide' => esc_html__( 'Mobile Bottom', 'taiowcp' ),
                                    
                                ),
                                
                                ),          
                                array(
                                'id'      => 'taiowcp-dsble_mob_rel_prd_crt',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Disable Product you may like', 'taiowcp' ),
                                'desc'    => '',
                                'default' => false
                                ),
                                array(
                                'id'      => 'taiowcp-dsble_mob_ship',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Disable Shipping', 'taiowcp' ),
                                'desc'    => '',
                                'default' => false
                                ),
                                 array(
                                'id'      => 'taiowcp-dsble_mob_coupan',
                                'type'    => 'checkbox',
                                'title'   => esc_html__( 'Disable Coupon', 'taiowcp' ),
                                'desc'    => '',
                                'default' => false
                                ),
                                        
                          )
                      )
                 ),
              )
        ));

        taiowc()->add_setting(
            'taiowcp_cart_analyst', esc_html__( 'Cart Analytics', 'taiowcp' ),
            apply_filters(
            'taiowcp_cart_analyst_settings_section', array(
                array(
                    'title'  => esc_html__( 'Cart Analytics', 'taiowcp' ),
                    'fields' => apply_filters(
                        'taiowcp_cart_analyst_setting_fields', array(
                            array(
                                'id'      => 'taiowcp-cart-analyst',
                                'type'    => 'cart_analyst',
                                'title'   => esc_html__( 'Cart Analytics', 'taiowcp' ),
                            ),  
                         )
                    )
                 )
              )
            )
          );
         
         taiowc()->add_setting(
            'taiowcp_reset', esc_html__( 'Reset All Setting', 'taiowcp' ), apply_filters(
            'taiowcp_reset_settings_section', array(
                array(
                    'title'  => esc_html__( 'Reset All Your Custom Settings.', 'taiowcp' ),
                    'fields' => apply_filters(
                        'taiowcp_reset_setting_fields', array(
                            
                        )
                    )
                 )
              )
            )
          );

        }

    }
endif;  

Taiowc_Options::get_instance();