<?php

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Taiowc_Set' ) ):

	class Taiowc_Set {

        private $setting_name = 'taiowc';
		private $setting_reset_name = 'reset';
		private $theme_feature_name = 'taiowc';
		private $slug;
		private $plugin_class;
		private $defaults = array();
		private $fields = array();
		private $reserved_key = '';
		private $reserved_fields = array();
		
             public function __construct() {

			 $this->setting_name = apply_filters( 'taiowc_settings_name', $this->setting_name );

             $this->fields          = apply_filters( 'taiowc_settings', $this->fields );

             $this->reserved_key    = sprintf( '%s_reserved', $this->setting_name );

		     $this->reserved_fields = apply_filters( 'taiowc_reserved_fields', array() );
 
             add_action( 'admin_menu', array( $this, 'taiowc_add_menu' ) );

             add_action( 'init', array( $this, 'taiowc_set_defaults' ), 8 );

             add_action( 'admin_init', array( $this, 'taiowc_settings_init' ), 90 );

             add_action( 'admin_enqueue_scripts', array( $this, 'taiowc_script_enqueue' ) );

             add_action('wp_ajax_taiowc_form_setting', array($this, 'taiowc_form_setting'));

			 // add_action( 'wp_ajax_nopriv_taiowc_form_setting', array($this, 'taiowc_form_setting'));

            }
        

        public function taiowc_add_menu(){

						$page_title = esc_html__( 'AIO Woo Cart', 'th-all-in-one-woo-cart' );

						// $menu_title = esc_html__( 'TH All In One Woo Cart', 'th-all-in-one-woo-cart' );

						// add_menu_page( $page_title, $menu_title, 'edit_theme_options', 'taiowc', array(
						// 	$this,
						// 	'taiowc_settings_form'
						// ),  esc_url(TAIOWC_IMAGES_URI.'/taiowc-icon.png'), 59 );

						add_submenu_page( 'themehunk-plugins', $page_title,$page_title, 'manage_options', 'taiowc', array($this, 'taiowc_settings_form'),10 );

					
		 }

		public function taiowc_settings_form() {

			if ( ! current_user_can( 'manage_options' ) ) {

				wp_die( esc_html__( 'You do not have sufficient permissions to access this page.','th-all-in-one-woo-cart' ) );

			}

			if( ! class_exists( 'WooCommerce' ) ){

				   printf('<h2 class="requirement-notice">%s</h2>',esc_html__('TH All In One Woo Cart requires WooCommerce to work. Make sure that you have installed and activated WooCommerce Plugin.','th-all-in-one-woo-cart' ) );

             return;

			}
		
			?>
			<div id="taiowc" class="settings-wrap thwc-plugin-common-wrap">
				
				 <?php $this->taiowc_options_tabs(); ?>

                   <div class="setting-wrap">
                   <div class="setting-content">
					<div class="top-header">
                <h2 class="tabheading"><?php esc_html_e("Integration", 'th-all-in-one-woo-cart'); ?></h2>
               
               		 <a class="upgradebutton" href="<?php echo esc_url( 'https://themehunk.com/th-all-in-one-woo-cart/' ); ?>"
					   title="<?php esc_attr_e( 'Upgrade', 'th-all-in-one-woo-cart' ); ?>"
					   target="_blank">
						<?php esc_html_e( 'Upgrade', 'th-all-in-one-woo-cart' ); ?>
					</a>
					<p class="submit taiowc-button-wrapper th-save-btn">
						
						<span class="reset" href="#">
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-refresh-cw" aria-hidden="true"><path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"></path><path d="M21 3v5h-5"></path><path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"></path><path d="M8 16H3v5"></path></svg><?php esc_html_e( 'Reset all', 'th-all-in-one-woo-cart' ); ?>
						</span>

						 <button disabled id="submit" class="button button-primary" value="<?php esc_html_e( 'Save Changes', 'th-all-in-one-woo-cart' ) ?>"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save transition-transform group-hover:scale-110" aria-hidden="true"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"></path><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"></path><path d="M7 3v4a1 1 0 0 0 1 1h7"></path></svg></span><span class="text"><?php esc_html_e( 'Save All Changes', 'th-all-in-one-woo-cart' ) ?></span>
						 </button>
					</p> 
					</div>
					
				   <form method="post" action="" enctype="multipart/form-data" class="taiowc-setting-form">
                   <input type="hidden" name="action" value="taiowc_form_setting">
					<div id="settings-tabs">
						<?php foreach ( $this->fields as $tab ):
							if ( ! isset( $tab['active'] ) ) {
								$tab['active'] = false;
							}
							$is_active = ( $this->taiowc_get_last_active_tab() == $tab['id'] );
							?>
							<div id="<?php echo esc_attr($tab['id']); ?>"
								 class="settings-tab taiowc-setting-tab"
								 style="<?php echo ! esc_attr($is_active) ? 'display: none' : '' ?>">
								 
								<?php foreach ( $tab['sections'] as $section ):

					        	$this->taiowc_do_settings_sections( $tab['id'] . $section['id'] );

								endforeach; ?>

							</div>

						<?php endforeach; ?>

					</div>
					
					<?php

					$this->taiowc_last_tab_input();
					
					?>
					<?php 
					require_once TAIOWC_PLUGIN_PATH . '/inc/taiowc-live-menu-cart.php';
					require_once TAIOWC_PLUGIN_PATH . '/inc/taiowc-live-fixed-cart.php';
					require_once TAIOWC_PLUGIN_PATH . '/inc/taiowc-live-cart-panel.php';
					require_once TAIOWC_PLUGIN_PATH . '/inc/taiowc-live-mobile.php';
					require_once TAIOWC_PLUGIN_PATH . '/inc/taiowc-reset.php';
					require_once TAIOWC_PLUGIN_PATH . '/inc/taiowc-help.php';
					?> 
					
					</form>
			</div> 

			<div id="taiowc_cart_analys" class="taiowc-cart-track-wrapper">
				<?php 
					// taiowc_track_table();
					// do_action('taiowc_cart_track'); 
				?>
				<div class="th-woo-analtics-wrapper">
				<img src="<?php echo esc_url( TAIOWC_PLUGIN_URI . '/images/woo-analytics.png' ); ?>">
				</div>
			</div>

			
            
            </div>

            <div class="taiowc-notes-wrap">
            	
            	<div class="taiowc-wrap-doc"><h4 class="wrp-title"><?php esc_html_e( 'Documentation', 'th-all-in-one-woo-cart' ) ?></h4><p><?php esc_html_e( 'Want to know how this plugin works. Read our Documentation.', 'th-all-in-one-woo-cart' ) ?></p><a target="_blank" href="<?php echo esc_url('https://themehunk.com/docs/th-all-in-one-woo-cart/');?>"><?php esc_html_e( 'Check Doc', 'th-all-in-one-woo-cart' ) ?></a>
            	</div>
           
            	<div class="taiowc-wrap-doc"><h4 class="wrp-title"><?php esc_html_e( 'Spread the News', 'th-all-in-one-woo-cart' ) ?></h4><p><?php esc_html_e( 'Enjoying this plugin? Help spread the the creation and show off your amazing website with such amazing functionality.', 'th-all-in-one-woo-cart' ) ?></p><a href="https://twitter.com/intent/tweet?url=https://themehunk.com/th-all-in-one-woo-cart//&text=Hey, I just tried this amazing WordPress Plugin for <?php echo esc_url(home_url()); ?> to inetgrate cart in it. Show off your amazing website with such amazing functionality with this awesome plugin: TH All In One Woo Cart Pro By 
@ThemeHunk %20%23WooCommerce%20%23WordPress" target="_blank" rel="external noreferrer noopener" class="x-gropup is-link">
        <span class="x-image"><img src="<?php echo esc_url(TAIOWC_PLUGIN_URI . 'images/x.png'); ?>" /></span>
        <span><?php esc_html_e(' Click to Tweet','th-all-in-one-woo-cart'); ?></span></a>
            	</div>
            	
            	<div class="taiowc-wrap-doc"><h4 class="wrp-title"><?php esc_html_e( 'Contact Support', 'th-all-in-one-woo-cart' ) ?></h4><p><?php esc_html_e( 'If you need any help you can contact to our support team', 'th-all-in-one-woo-cart' ) ?></p><a target="_blank" href="<?php echo esc_url('https://themehunk.com/contact-us/');?>"><?php esc_html_e( 'Need Help ?', 'th-all-in-one-woo-cart' ) ?></a>
            	</div>
            	
            	<div class="taiowc-wrap-doc"><h4 class="wrp-title"><?php esc_html_e( 'Review', 'th-all-in-one-woo-cart' ) ?></h4><p><?php esc_html_e( 'Give us your valuable feedback', 'th-all-in-one-woo-cart' ) ?></p><a target="_blank" href="<?php echo esc_url('https://www.trustpilot.com/review/themehunk.com');?>"><?php esc_html_e( 'Submit a review', 'th-all-in-one-woo-cart' ) ?></a>
            	</div>

            </div>
           
				
			</div>
			<?php
			
		}

	    public function taiowc_form_setting(){  

	    	if ( ! current_user_can( 'manage_options' ) ) {

		            wp_die( - 1, 403 );
		            
		      } 

		      check_ajax_referer( 'taiowc_plugin_nonce','_wpnonce');


	             if( isset($_POST['taiowc']) && is_array( $_POST['taiowc'] ) ){

	                      $sanitize_data_array = $this->taiowc_form_sanitize( wp_unslash($_POST['taiowc'] ));

	                      update_option('taiowc',$sanitize_data_array); 

		            }

		            die();  
	    }
        
	    public function taiowc_form_sanitize( $input ){

				$new_input = array();

				foreach ( $input as $key => $val ){

					$new_input[ $key ] = ( isset( $input[ $key ] ) ) ? sanitize_text_field( $val ) :'';

		   }

		   return $new_input;

	    }

		public function taiowc_options_tabs() {
			?>

			<div class="nav-tab-wrapper wp-clearfix">

				<div class="top-wrap"><div id="logo"><a href="<?php echo esc_url('https://themehunk.com/'); ?>" target="_blank"><img src='<?php echo esc_url(TAIOWC_IMAGES_URI.'/th-logo.png') ?>' alt="th-logo"/></a>
				</div>

				  <h1><?php echo get_admin_page_title() ?></h1>

			     </div>

				<?php foreach ( $this->fields as $tabs ): 
					?>
							
					<a data-target="<?php echo esc_attr($tabs['id']); ?>"  class="taiowc-setting-nav-tab nav-tab <?php echo esc_html($this->taiowc_get_options_tab_css_classes( $tabs )); ?> " href="#<?php echo esc_attr($tabs['id']); ?>">
					<span><?php echo $this->icon_list($tabs['id']); ?></span><?php echo esc_html($tabs['title']); ?></a>

				<?php endforeach; ?>

				<div class="taiowc-collapse-sidebar">
				    <button id="taiowc-toggle-sidebar">
				        <span class="dashicons dashicons-arrow-left-alt2"></span>
				        <span class="collapse-text"><?php esc_html_e('Collapse Sidebar','th-all-in-one-woo-cart'); ?></span>
				    </button>
				</div>

			</div>

			<?php

		}

		function icon_list($id ='dashicons-menu'){
			$icon = array(
			'taiowc_integration'=>'<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-code-xml" aria-hidden="true"><path d="m18 16 4-4-4-4"></path><path d="m6 8-4 4 4 4"></path><path d="m14.5 4-5 16"></path></svg>',

			'taiowc_general' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings" aria-hidden="true"><path d="M9.671 4.136a2.34 2.34 0 0 1 4.659 0 2.34 2.34 0 0 0 3.319 1.915 2.34 2.34 0 0 1 2.33 4.033 2.34 2.34 0 0 0 0 3.831 2.34 2.34 0 0 1-2.33 4.033 2.34 2.34 0 0 0-3.319 1.915 2.34 2.34 0 0 1-4.659 0 2.34 2.34 0 0 0-3.32-1.915 2.34 2.34 0 0 1-2.33-4.033 2.34 2.34 0 0 0 0-3.831A2.34 2.34 0 0 1 6.35 6.051a2.34 2.34 0 0 0 3.319-1.915"></path><circle cx="12" cy="12" r="3"></circle></svg>',

			'taiowc_menu_cart' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag" aria-hidden="true"><path d="M16 10a4 4 0 0 1-8 0"></path><path d="M3.103 6.034h17.794"></path><path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"></path></svg>',

			'taiowc_fixed_cart' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mouse-pointer2 lucide-mouse-pointer-2" aria-hidden="true"><path d="M4.037 4.688a.495.495 0 0 1 .651-.651l16 6.5a.5.5 0 0 1-.063.947l-6.124 1.58a2 2 0 0 0-1.438 1.435l-1.579 6.126a.5.5 0 0 1-.947.063z"></path></svg>',

			'taiowc-cart_style_set'=>'<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-panels-top-left" aria-hidden="true"><rect width="18" height="18" x="3" y="3" rx="2"></rect><path d="M3 9h18"></path><path d="M9 21V9"></path></svg>',

			'taiowc_cart'=>'<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text" aria-hidden="true"><path d="M6 22a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h8a2.4 2.4 0 0 1 1.704.706l3.588 3.588A2.4 2.4 0 0 1 20 8v12a2 2 0 0 1-2 2z"></path><path d="M14 2v5a1 1 0 0 0 1 1h5"></path><path d="M10 9H8"></path><path d="M16 13H8"></path><path d="M16 17H8"></path></svg>',

			
			'taiowc_mobile_cart'=>'<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-smartphone" aria-hidden="true"><rect width="14" height="20" x="5" y="2" rx="2" ry="2"></rect><path d="M12 18h.01"></path></svg>',

			'taiowc_hide_cart'=>'<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-off" aria-hidden="true"><path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49"></path><path d="M14.084 14.158a3 3 0 0 1-4.242-4.242"></path><path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143"></path><path d="m2 2 20 20"></path></svg>',

			'taiowc_cart_analyst'=>'<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chart-column" aria-hidden="true"><path d="M3 3v16a2 2 0 0 0 2 2h16"></path><path d="M18 17V9"></path><path d="M13 17V5"></path><path d="M8 17v-3"></path></svg>',

			'taiowc_reset'=>'<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-refresh-ccw" aria-hidden="true"><path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"></path><path d="M3 3v5h5"></path><path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"></path><path d="M16 16h5v5"></path></svg>',

			'taiowc_help'=>'<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                <path d="M12 17h.01"></path>
            </svg>',

		);

			return $icon[$id];

		}

		private function taiowc_get_last_active_tab() {

			$last_option_tab = '';

			$last_tab        = $last_option_tab;

			if ( isset( $_GET['tab'] ) && ! empty( $_GET['tab'] ) ) {

				$last_tab = trim( sanitize_key(wp_unslash($_GET['tab'])) );

			}

			if ( $last_option_tab ) {

				$last_tab = $last_option_tab;

			}

			$default_tab = '';

			foreach ( $this->fields as $tabs ) {

				if ( isset( $tabs['active'] ) && $tabs['active'] ) {

					$default_tab = sanitize_key($tabs['id']);

					break;

				}

			}

			return ! empty( $last_tab ) ? esc_html( $last_tab ) : esc_html( $default_tab );

		}

		private function taiowc_do_settings_sections( $page ) {

			global $wp_settings_sections, $wp_settings_fields;

			if ( ! isset( $wp_settings_sections[ $page ] ) ) {
				return;
			}

			foreach ( (array) $wp_settings_sections[ $page ] as $section ) {

				// if ( $section['title'] ) {

				// 	echo "<h2 class=".esc_attr($section['id']).">".esc_html($section['title'])."</h2>";

				// }
                
				if ( $section['callback'] ) {

					call_user_func( $section['callback'], $section );

				}

				if ( ! isset( $wp_settings_fields ) || ! isset( $wp_settings_fields[ $page ] ) || ! isset( $wp_settings_fields[ $page ][ $section['id'] ] ) ) {

					continue;

				}

				echo '<div class="form-table taiowc-form-table" 
					       id="'.esc_attr($section['id']).'" 
					       data-layout="form-table">';

				if ( $section['title'] ) {

					echo '<h2 class="heading ' . esc_attr($section['id']) . '">' . esc_html($section['title']) . '</h2>';


				}

				$this->taiowc_do_settings_fields( $page, $section['id'] );

				echo '</div>';

			}
		}

		private function taiowc_last_tab_input() {

			printf( '<input type="hidden" id="_last_active_tab" name="%s[_last_active_tab]" value="%s">', $this->setting_name, $this->taiowc_get_last_active_tab() );

		}

		private function taiowc_get_options_tab_css_classes( $tabs ) {

			$classes = array();

			$classes[] = ( $this->taiowc_get_last_active_tab() == $tabs['id'] ) ? 'nav-tab-active' : '';

			return implode( ' ', array_unique( apply_filters( 'taiowc_get_options_tab_css_classes', $classes ) ) );

		}

		private function taiowc_do_settings_fields( $page, $section ) {

			global $wp_settings_fields;

			if ( ! isset( $wp_settings_fields[ $page ][ $section ] ) ) {
				return;
			}

			foreach ( (array) $wp_settings_fields[ $page ][ $section ] as $field ) {
				
				$custom_attributes = $this->taiowc_array2html_attr( isset( $field['args']['attributes'] ) ? $field['args']['attributes'] : array() );

				$wrapper_id = ! empty( $field['args']['id'] ) ? esc_attr( $field['args']['id'] ) . '-wrapper' : '';
				$dependency = ! empty( $field['args']['require'] ) ? $this->taiowc_build_dependency( $field['args']['require'] ) : '';

				printf('<div id="%s" class="taiowc-settings-row" data-row="setting"%s %s>',
				  		esc_attr($wrapper_id),
				  		$custom_attributes,
				  		$dependency
				);

				
					echo '<div class="taiowc-settings-label" data-col="label">';
					if ( ! empty( $field['args']['label_for'] ) ) {
						echo '<label for="' . esc_attr( $field['args']['label_for'] ) . '">' . esc_html($field['title']). '</label>';
					} else {
						echo esc_html($field['title']);
					}

					echo '</div>';
					echo '<div class="taiowc-settings-field-content" data-col="field">';
					call_user_func( $field['callback'], $field['args'] );
					echo '</div>';
				
				   echo '</div>';
			}
		}

        public function taiowc_array2html_attr( $attributes, $do_not_add = array() ) {

			$attributes = wp_parse_args( $attributes, array() );

			if ( ! empty( $do_not_add ) and is_array( $do_not_add ) ) {

				foreach ( $do_not_add as $att_name ) {

					unset( $attributes[ $att_name ] );

				}

			}


			$attributes_array = array();

			foreach ( $attributes as $key => $value ) {

				if ( is_bool( $attributes[ $key ] ) and $attributes[ $key ] === true ) {

					return $attributes[ $key ] ? $key : '';

				} elseif ( is_bool( $attributes[ $key ] ) and $attributes[ $key ] === false ) {

					$attributes_array[] = '';

				} else {

					$attributes_array[] = $key . '="' . esc_attr($value) . '"';

				}
			}

			return implode( ' ', $attributes_array );
		}

		 private function taiowc_build_dependency( $require_array ) {

			$b_array = array();

			foreach ( $require_array as $k => $v ) {

				$b_array[ '#' . esc_attr($k) . '-field' ] = $v;
			}

			return 'data-taiowcdepends="[' . esc_attr( wp_json_encode( $b_array ) ) . ']"';
		}

		 public function taiowc_make_implode_html_attributes( $attributes, $except = array( 'type', 'id', 'name', 'value' ) ) {

			$attrs = array();

			foreach ( $attributes as $name => $value ) {

				if ( in_array( $name, $except, true ) ) {

					continue;

				}

				$attrs[] = esc_attr( $name ) . '="' . esc_attr( $value ) . '"';

			}

			return implode( ' ', array_unique( $attrs ) );

		}

		/***************/
		// Field call back function
		/***************/

		public function taiowc_field_callback( $field ) {

			switch ( $field['type'] ) {


				case 'checkbox':
					$this->taiowc_checkbox_field_callback( $field );
					break;

				case 'select':
					$this->taiowc_select_field_callback( $field );
					break;

				case 'number':
					$this->taiowc_number_field_callback( $field );
					break;

			    case 'colorpkr':
					$this->taiowc_colorpkr_field_callback( $field );
					break;		

				case 'html':
						$this->taiowc_cart_analyst_field_callback( $field );
						break;
			    case 'file':
					$this->taiowc_file_field_callback( $field );
					break;	

				case 'radio-image':
					$this->taiowc_radio_image_field_callback( $field );
					break;

			    case 'textarea':
					$this->taiowc_textarea_field_callback( $field );
					break;						

				default:
					$this->taiowc_text_field_callback( $field );
					break;
			}

			do_action( 'taiowc_settings_field_callback', $field );

		}

     
      public function taiowc_checkbox_field_callback( $args ) {
               
			$value = (bool)( $this->taiowc_get_option( $args['id'] ) );

			$attrs = isset( $args['attrs'] ) ? $this->taiowc_make_implode_html_attributes( $args['attrs'] ) : '';?>

            <fieldset>
            	<label class="th-toggle">
            		<input <?php echo esc_attr($attrs); ?> type="checkbox" id="<?php echo esc_attr($args['id']); ?>-field" name="<?php echo esc_attr($this->setting_name);?>[<?php echo esc_attr($args['id']);?>]" value="1" <?php echo esc_attr(checked( $value, true, false ));?>> <?php if ( ! empty( $args['desc'] ) ) {  echo esc_html($args['desc']); } ?>
            	</label>     
            </fieldset>
			
		<?php }


		public function taiowc_select_field_callback( $args ) {

			$options = apply_filters( "taiowc_settings_{$args[ 'id' ]}_select_options", $args['options'] );

			$valuee   = $this->taiowc_get_option( $args['id'] );

		
			$size    = isset( $args['size'] ) && ! is_null( $args['size'] ) ? $args['size'] : 'regular';

			$attrs = isset( $args['attrs'] ) ? $this->taiowc_make_implode_html_attributes( $args['attrs'] ) : '';
			?>

			<select <?php echo esc_attr($attrs); ?> class="<?php echo esc_attr($size); ?>-text" id="<?php echo esc_attr($args['id']); ?>-field" name="<?php echo esc_attr($this->setting_name);?>[<?php echo esc_attr($args['id']);?>]">

				<?php foreach($options as $key => $value){ ?>

                <option <?php echo esc_attr(selected( $key, $valuee, false )) ;?> value="<?php echo esc_attr($key);?>">
                	
                	<?php echo esc_html($value);?> 	

                </option> 

               <?php } ?>

			</select>

			<?php if ( ! empty( $args['desc'] ) ) { ?>
            <p class="description"><?php echo esc_html($args['desc']);?></p>
		    <?php } }


        public function taiowc_text_field_callback( $args ) {

			$value =  $this->taiowc_get_option( $args['id'] );

			$size  = isset( $args['size'] ) && ! is_null( $args['size'] ) ? $args['size'] : 'regular';

			$attrs = isset( $args['attrs'] ) ? $this->taiowc_make_implode_html_attributes( $args['attrs'] ) : '';?>

            <input type="text" class="<?php echo esc_attr($size); ?>-text" id="<?php echo esc_attr($args['id']); ?>-field" name="<?php echo esc_attr($this->setting_name);?>[<?php echo esc_attr($args['id']);?>]" value="<?php echo esc_attr($value); ?>"/>

            <?php if ( ! empty( $args['desc'] ) ) { ?>

            <p class="description"><?php echo esc_html($args['desc']);?></p>

	        <?php 

	           }
				
		}

		
		public function taiowc_textarea_field_callback( $args ) {

			$value = $this->taiowc_get_option( $args['id'] );

			$size  = isset( $args['size'] ) && ! is_null( $args['size'] ) ? $args['size'] : 'regular';

			$attrs = isset( $args['attrs'] ) ? $this->taiowc_make_implode_html_attributes( $args['attrs'] ) : '';
			?>

           <textarea class="<?php echo esc_attr($size); ?>-text" id="<?php echo esc_attr($args['id']); ?>-field" name="<?php echo esc_attr($this->setting_name);?>[<?php echo esc_attr($args['id']);?>]"><?php echo esc_attr($value); ?></textarea>

          <?php if ( ! empty( $args['desc'] ) ) { ?>

           <p class="description"><?php echo esc_html($args['desc']);?></p>

	      <?php 
	           }
				
		}

		public function taiowc_file_field_callback( $args ) {

        $value = $this->taiowc_get_option( $args['id'] );

        $size = ( isset( $args['size'] ) && !is_null( $args['size'] ) ? $args['size'] : 'regular' );

        $attrs = isset( $args['attrs'] ) ? $this->taiowc_make_implode_html_attributes( $args['attrs'] ) : '';

        $label = ( isset( $args['options']['button_label'] ) ? $args['options']['button_label'] : esc_html__( 'Choose File','th-all-in-one-woo-cart' ) );?>

        <div class="taiowc-upload-wrap">

  <!-- Preview box -->
  <div class="taiowc-upload-preview">
    <span class="taiowc-preview-label"><?php esc_html_e('PREVIEW','th-all-in-one-woo-cart'); ?></span>
    <img src="<?php echo esc_url($value); ?>" alt="" />
  </div>

  <!-- Upload drop area -->
  <div class="taiowc-upload-drop">
    <div class="taiowc-upload-icon">
      ↑
    </div>
    <p><strong><?php esc_html_e('Click to upload','th-all-in-one-woo-cart'); ?></strong> <?php esc_html_e('or drag and drop','th-all-in-one-woo-cart'); ?></p>
    <small><?php esc_html_e('SVG, PNG, JPG (max. 500kb)','th-all-in-one-woo-cart'); ?></small>
  </div>


  <!-- 🔒 ORIGINAL INPUTS (DO NOT TOUCH) -->
  <input %5$s
    type="text"
    class="<?php echo esc_attr($size); ?>-text <?php echo esc_attr($args['id']); ?>"
    id="<?php echo esc_attr($args['id']); ?>-field"
    name="<?php echo esc_attr($this->setting_name); ?>[<?php echo esc_attr($args['id']); ?>]"
    value="<?php echo esc_attr($value); ?>"
  />

  <input
    type="button"
    class="button taiowc_upload_image_button <?php echo esc_attr($this->setting_name); ?> browse"
    value="<?php echo esc_attr($label); ?>"
  />

  <?php if ( ! empty( $args['desc'] ) ) { ?>
    <p class="description"><?php echo esc_html($args['desc']); ?></p>
  <?php } ?>

  <button type="button" class="taiowc-remove-image button">
  <?php esc_html_e('Remove','th-all-in-one-woo-cart'); ?>
</button>

</div>


      <?php }

        public function taiowc_number_field_callback( $args ) {

			$value = $this->taiowc_get_option( $args['id'] );

			$size  = isset( $args['size'] ) && ! is_null( $args['size'] ) ? $args['size'] : 'small';

			$attrs = isset( $args['attrs'] ) ? $this->taiowc_make_implode_html_attributes( $args['attrs'] ) : '';
            ?>

			<input type="number"  <?php echo esc_attr($attrs); ?> class="<?php echo esc_attr($size); ?>-text" id="<?php echo esc_attr($args['id']); ?>-field" name="<?php echo esc_attr($this->setting_name);?>[<?php echo esc_attr($args['id']);?>]" value="<?php echo esc_attr($value); ?>"  min="<?php echo esc_attr($args['min']); ?>" max="<?php echo esc_attr($args['max']); ?>" step="<?php  if ( ! empty($args['step']) ) { 
				echo esc_attr($args['step']); } ?>" />

              <?php if(isset( $args['suffix'] ) && ! is_null( $args['suffix'] ) ){ ?>

			<span><?php echo esc_attr($args['suffix']); ?></span>
         
             <?php

               }

           if ( ! empty( $args['desc'] ) ) { ?>

           <p class="description"><?php echo esc_html($args['desc']);?></p>    

		<?php 	

	         } 
		}

		public function taiowc_colorpkr_field_callback( $args ){

			$value = $this->taiowc_get_option( $args['id'] );
			
			?>

		  <input type="text" class="color_picker" id="<?php echo esc_attr($args['id']);?>" name="<?php echo esc_attr($this->setting_name);?>[<?php echo esc_attr($args['id']);?>]" value="<?php echo esc_attr($value); ?>" style="background:<?php echo esc_attr($value); ?>" />
          
          <?php if ( ! empty( $args['desc'] ) ) { ?>

           <p class="description"><?php echo esc_html($args['desc']);?></p>      

		<?php
	        }

		}


		public function taiowc_radio_image_field_callback( $args ) {

			$options = apply_filters( "taiowc_settings_{$args[ 'id' ]}_radio_options", $args['options'] );
			$value   = esc_attr( $this->taiowc_get_option( $args['id'] ) );

			$attrs = isset( $args['attrs'] ) ? $this->taiowc_make_implode_html_attributes( $args['attrs'] ) : '';

			return implode( '', array_map( function ( $key, $option ) use ( $attrs, $args, $value ) {
				echo sprintf( '<label class="radio-image"><input id="%2$s" %1$s type="radio"  name="%4$s[%2$s]" value="%3$s" %5$s/> <img src="%6$s"/> </label>', esc_attr($attrs), esc_attr($args['id']), esc_attr($key), esc_attr($this->setting_name), checked( esc_attr($value), esc_attr($key), false ), esc_attr($option));
			}, array_keys( $options ), $options ) );

		}
        
		public function taiowc_cart_analyst_field_callback( $args ) {

			if($args[ 'id' ]=='taiowc-how-to-integrate'):
   
				$taiowc_karr = array( 
			   'br' => array(),
			   'strong' => array(),
			   'code' => array(),
			   'a' => array( 
					  'href' => array(),
					  'target' => array(),
					 )
			   );
   
			   ?>
			   
			 <div class="taiowc-guide">

  <!-- STEP 1 -->
  <div class="taiowc-card">
    <div class="taiowc-step">
      <span class="step-number">1</span>
      <div class="step-header">
        <h3><?php esc_html_e('Display cart in the header menu','th-all-in-one-woo-cart'); ?></h3>
        <span class="badge pro"><?php esc_html_e('PRO FEATURE','th-all-in-one-woo-cart'); ?></span>
        <span class="badge success"><?php esc_html_e('VISUAL EDITOR READY','th-all-in-one-woo-cart'); ?></span>
      </div>
    </div>

    <p class="step-desc">
      <?php esc_html_e('Recommended for standard WordPress themes.','th-all-in-one-woo-cart'); ?>
    </p>

    <p class="step-text">
      <?php esc_html_e('Navigate to your dashboard','th-all-in-one-woo-cart'); ?> <b><?php esc_html_e('Appearance → Menus','th-all-in-one-woo-cart'); ?></b>.  
       <b><?php esc_html_e('Locate the TH All In One Woo Cart','th-all-in-one-woo-cart'); ?></b> <?php esc_html_e('item in the left panel and click','th-all-in-one-woo-cart'); ?>
      <b><?php esc_html_e('Add to Menu','th-all-in-one-woo-cart'); ?></b>.
    </p>

    <div class="note-box">
      <strong><?php esc_html_e('NOTE','th-all-in-one-woo-cart'); ?></strong><br>
      <?php esc_html_e('Position the cart element as the last item in your primary navigation for optimal UI balance.','th-all-in-one-woo-cart'); ?>
    </div>
  </div>

  <!-- STEP 2 -->
  <div class="taiowc-card">
    <div class="taiowc-step">
      <span class="step-number">2</span>
      <div class="step-header">
        <h3><?php esc_html_e('Use Shortcode Component','th-all-in-one-woo-cart'); ?></h3>
        <span class="badge universal"><?php esc_html_e('UNIVERSAL','th-all-in-one-woo-cart'); ?></span>
      </div>
    </div>

    <p class="step-text">
      <?php esc_html_e('Inject the cart into any page builder (Elementor, Divi, Gutenberg) or standard text block.','th-all-in-one-woo-cart'); ?>
    </p>

    <div class="shortcode-box">
      <code>[taiowc]</code>
      <button type="button"
          class="taiowc-copy-btn"
          aria-label="Copy shortcode"
          data-copy-target="code">
    <?php esc_html_e('Copy','th-all-in-one-woo-cart'); ?>
  </button>
      <span class="shortcode-label"><?php esc_html_e('SHORTCODE','th-all-in-one-woo-cart'); ?></span>
    </div>

    <div class="supported">
      <span><?php esc_html_e('✔ Widgets','th-all-in-one-woo-cart'); ?></span>
      <span><?php esc_html_e('✔ Blocks','th-all-in-one-woo-cart'); ?></span>
      <span><?php esc_html_e('✔ Elementor','th-all-in-one-woo-cart'); ?></span>
    </div>
  </div>

  <!-- STEP 3 -->
<div class="taiowc-card">
  <div class="taiowc-step">
    <span class="step-number">3</span>
    <div class="step-header">
      <h3><?php esc_html_e('Direct Template Integration','th-all-in-one-woo-cart'); ?></h3>
      <span class="badge advanced"><?php esc_html_e('ADVANCED','th-all-in-one-woo-cart'); ?></span>
    </div>
  </div>

  <p class="step-desc">
      <span><?php esc_html_e('For theme developers. Paste this snippet directly into your header.php or custom template files.','th-all-in-one-woo-cart'); ?></span>
 
  </p>

  <div class="shortcode-box php">
    <code>&lt;?php echo do_shortcode('[taiowc]'); ?&gt;</code>
     <button type="button"
          class="taiowc-copy-btn"
          aria-label="Copy PHP code"
          data-copy-target="code">
      <span><?php esc_html_e('Copy','th-all-in-one-woo-cart'); ?></span>
    
  </button>
    <span class="shortcode-label"><?php esc_html_e('PHP','th-all-in-one-woo-cart'); ?></span>
  </div>

</div>


</div>

   
   
		   <?php 	
   
			   endif;
   
		   }

	 
	//*********************************/	
    // add ,delete ,get , reset, option
    /**********************************/

    public function taiowc_set_defaults() {

			foreach ( $this->fields as $tab_key => $tab ) {

				$tab = apply_filters( 'taiowc_settings_tab', $tab );

				foreach ( $tab['sections'] as $section_key => $section ) {

					$section = apply_filters( 'taiowc_settings_section', $section, $tab );

					$section['id'] = ! isset( $section['id'] ) ? $tab['id'] . '-section' : $section['id'];

					$section['fields'] = apply_filters( 'taiowc_settings_fields', $section['fields'], $section, $tab );

					foreach ( $section['fields'] as $field ) {

						if ( isset( $field['pro'] ) ) {
							continue;
						}

						$field['default'] = isset( $field['default'] ) ? $field['default'] : null;

						$this->taiowc_set_default( $field['id'], $field['type'], $field['default'] );
					}
				}
			}
		}


		public function taiowc_sanitize_callback( $options ) {

			foreach ( $this->taiowc_get_defaults() as $opt ) {
				if ( $opt['type'] === 'checkbox' && ! isset( $options[ $opt['id'] ] ) ){
					$options[ $opt['id'] ] = 0;
				}
			}

			return $options;
		}

		public function taiowc_settings_init() {

			if ( $this->taiowc_is_reset_all() ) {

				 $this->taiowc_delete_settings();

				 wp_redirect(esc_url($this->taiowc_settings_url()));

			}
              
		  register_setting( $this->setting_name, $this->setting_name, array( $this, 'taiowc_sanitize_callback' ) );

			foreach ( $this->fields as $tab_key => $tab ) {

				$tab = apply_filters( 'taiowc_settings_tab', $tab );

				foreach ( $tab['sections'] as $section_key => $section ) {

					$section = apply_filters( 'taiowc_settings_section', $section, $tab );

					$section['id'] = ! isset( $section['id'] ) ? $tab['id'] . '-section-' . $section_key : $section['id'];

					// Adding Settings section id
					$this->fields[ $tab_key ]['sections'][ $section_key ]['id'] = $section['id'];

					add_settings_section( $tab['id'] . $section['id'], $section['title'], function () use ( $section ) {
						if ( isset( $section['desc'] ) && ! empty( $section['desc'] ) ) {
							echo '<div class="inside">' . esc_html($section['desc']) . '</div>';
						}
					}, $tab['id'] . $section['id'] );

					$section['fields'] = apply_filters( 'taiowc_settings_fields', $section['fields'], $section, $tab );

					foreach ( $section['fields'] as $field ) {

						$field['label_for'] = $field['id'] . '-field';
						$field['default']   = isset( $field['default'] ) ? $field['default'] : null;

						if ( $field['type'] == 'checkbox' || $field['type'] == 'radio' ) {
							unset( $field['label_for'] );
						}

						add_settings_field( $this->setting_name . '[' . $field['id'] . ']', $field['title'], array(
							$this,
							'taiowc_field_callback'
						), $tab['id'] . $section['id'], $tab['id'] . $section['id'], $field );

					}
				}
			}
		}

		public function taiowc_reset_url(){

			return add_query_arg( array( 'page' => 'taiowc', 'reset' => 'reset','delete_wpnonce' => wp_create_nonce('delete_nonce') ), admin_url( 'admin.php' ) );

		}

		public function taiowc_settings_url(){

			return add_query_arg( array( 'page' => 'taiowc' ), admin_url( 'admin.php' ) );

		}

        private function taiowc_set_default( $key, $type, $value ) {
		$this->defaults[ $key ] = array( 'id' => $key, 'type' => $type, 'value' => $value );
		}

		private function taiowc_get_default( $key ) {
			return isset( $this->defaults[ $key ] ) ? $this->defaults[ $key ] : null;
		}

		public function taiowc_get_defaults() {
			return $this->defaults;
		}


        public function taiowc_is_reset_all() {
			return isset( $_GET['page'] ) && ( sanitize_text_field( wp_unslash( $_GET['page'] ) ) == 'taiowc' ) && isset( $_GET[ $this->setting_reset_name ] );
		}  

		public function taiowc_delete_settings() {

		    if ( ! current_user_can( 'manage_options' ) ) {
		        wp_die( -1, 403 );
		    }

		    if ( ! isset($_REQUEST['delete_wpnonce']) ) {
		        wp_die( 'Nonce missing', 403 );
		    }

		    if ( ! wp_verify_nonce($_REQUEST['delete_wpnonce'], 'delete_nonce') ) {
		        wp_die( 'Invalid nonce', 403 );
		    }

		    do_action( sprintf( 'delete_%s_settings', $this->setting_name ), $this );

		    return delete_option( $this->setting_name );
		}

		public function taiowc_get_option( $option ) {

			$default = $this->taiowc_get_default( $option );

			$options = get_option( $this->setting_name );

			$is_new = ( ! is_array( $options ) && is_bool( $options ) );

			// Theme Support

			if ( current_theme_supports( $this->theme_feature_name ) ) {

				$theme_support    = get_theme_support( $this->theme_feature_name );

				$default['value'] = isset( $theme_support[0][ $option ] ) ? $theme_support[0][ $option ] : $default['value'];

			}

			$default_value = isset( $default['value'] ) ? $default['value'] : null;

			if ( ! is_null( $this->taiowc_get_reserved( $option ) ) ) {

				$default_value = $this->taiowc_get_reserved( $option );

			}

			if ( $is_new ) {
			
				return $default_value;

			} else {
			
				return isset( $options[ $option ] ) ? $options[ $option ] : $default_value;

			}

		}

		public function taiowc_get_options(){

			return taiowc_get_option( $this->setting_name );

		}

		public function taiowc_get_reserved( $key = false ){

			$data = (array) get_option( $this->reserved_key );
			if ( $key ) {
				return isset( $data[ $key ] ) ? $data[ $key ] : null;
			} else {
				return $data;
			}
		}
		
        public function taiowc_script_enqueue(){
        
        	    // STYEL

			    if (isset($_GET['page']) && sanitize_text_field( wp_unslash( $_GET['page'] ) ) == 'taiowc') {

				wp_enqueue_style( 'taiowc-admin', TAIOWC_PLUGIN_URI. '/assets/css/taiowc-admin.css', array(), TAIOWC_VERSION );

				wp_enqueue_style( 'taiowc-pickr-nano-css', TAIOWC_PLUGIN_URI. '/assets/css/nano.min.css', array(), TAIOWC_VERSION );

				//SCRIPT

				wp_enqueue_script( 'tapsp-selectize-script', TAIOWC_PLUGIN_URI. '/assets/js/selectize.min.js', array('jquery'),true);

				wp_enqueue_style( 'tapsp-selectize-css', TAIOWC_PLUGIN_URI. '/assets/css/selectize.min.css', array(), TAIOWC_VERSION );

				wp_enqueue_script( 'taiowc-pickr-script', TAIOWC_PLUGIN_URI. '/assets/js/pickr.min.js', array('jquery'),TAIOWC_VERSION, true);

				wp_enqueue_script( 'taiowc-setting-script', TAIOWC_PLUGIN_URI. '/assets/js/taiowc-setting.js', array('jquery'),'1.1.2', true);

				wp_enqueue_media();

				wp_localize_script(
					'taiowc-setting-script', 'taiowcluginObject', array(
						'media_title'   => esc_html__( 'Choose an Image', 'th-all-in-one-woo-cart' ),
						'button_title'  => esc_html__( 'Use Image', 'th-all-in-one-woo-cart' ),
						'add_media'     => esc_html__( 'Add Media', 'th-all-in-one-woo-cart' ),
						'ajaxurl'       => esc_url( admin_url( 'admin-ajax.php', 'relative' ) ),
						'taiowc_nonce' => wp_create_nonce( 'taiowc_plugin_nonce' ),
					)
				);
				
			}
			
		}

}

endif;