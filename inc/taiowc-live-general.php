<?php if ( ! defined( 'ABSPATH' ) ) exit;

// Build icon map for PHP-side initial render
$_gen_icon_map = array(
	'icon-1' => TAIOWC_IMAGES_URI . 'icon-1.png',
	'icon-2' => TAIOWC_IMAGES_URI . 'taiowc-icon-2.png',
	'icon-3' => TAIOWC_IMAGES_URI . 'taiowc-icon-3.png',
	'icon-4' => TAIOWC_IMAGES_URI . 'taiowc-icon-4.png',
	'icon-5' => TAIOWC_IMAGES_URI . 'taiowc-icon-5.png',
	'icon-6' => TAIOWC_IMAGES_URI . 'taiowc-icon-6.png',
	'icon-7' => TAIOWC_IMAGES_URI . 'taiowc-custom-icon.png',
	'icon-8' => TAIOWC_IMAGES_URI . 'taiowc-icon-1.png',
);

$_gen_saved_val     = taiowc_main()->taiowc_get_option( 'taiowc-cart-icon' );
$_gen_custom_url    = taiowc_main()->taiowc_get_option( 'taiowc-icon_url' );

if ( $_gen_saved_val === 'icon-7' && ! empty( $_gen_custom_url ) ) {
	$_gen_icon_map['icon-7'] = $_gen_custom_url;
}

$_gen_current_icon = ! empty( $_gen_icon_map[ $_gen_saved_val ] )
	? $_gen_icon_map[ $_gen_saved_val ]
	: $_gen_icon_map['icon-1'];
?>
<!-- preview wrapper -->
<div class="setting-preview-wrap" data-tab="taiowc_general">
	<div class="page-wrapper">

		<header class="site-header">
			<!-- Logo -->
			<div class="logo">
				<span class="logo-icon"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-panels-top-left" aria-hidden="true"><rect width="18" height="18" x="3" y="3" rx="2"></rect><path d="M3 9h18"></path><path d="M9 21V9"></path></svg></span>
				<span class="logo-text"><?php esc_html_e( 'MEGASTORE', 'th-all-in-one-woo-cart' ); ?></span>
			</div>

			<!-- Navigation -->
			<nav class="main-nav">
				<a href="#"><?php esc_html_e( 'Home', 'th-all-in-one-woo-cart' ); ?></a>
				<a href="#"><?php esc_html_e( 'Shop', 'th-all-in-one-woo-cart' ); ?></a>
				<a href="#"><?php esc_html_e( 'Categories', 'th-all-in-one-woo-cart' ); ?></a>
			</nav>

			<!-- Cart -->
			<div class="cart">
				<div id="gen-cart-preview" class="taiowc-wrap taiowc-slide-right fxd-right" data-th-bg="taiowc-bg_clr">
					<a class="taiowc-content" href="#">
						<div class="taiowc-cart-item">

							<div class="taiowc-icon-wrapper">
								<div class="taiowc-icon" data-th-color="taiowc-cart_icon_clr" data-th-width="taiowc-icon_size-field">
									<img class="general-cart-icon-img"
										src="<?php echo esc_url( $_gen_current_icon ); ?>"
										alt="cart icon"
										style="width:24px;height:24px;object-fit:contain;display:block;">
								</div>

								<div class="cart-count-item"
									data-th-bg="taiowc-quantity_bg_clr"
									data-th-color="taiowc-quantity_clr"
									data-th-border="taiowc-price_clr"
									data-th-shadow="taiowc-quantity_shadow_clr"
									data-th-shadow-val="0 0 10px {color}"
									data-th-toggle="taiowc-show_quantity-field">2</div>
							</div>

							<div class="taiowc-total"
								data-th-color="taiowc-price_clr"
								data-th-font-size="taiowc-prc_font_size-field"
								data-th-unit="px"
								data-th-toggle="taiowc-show_price-field">
								<span class="woocommerce-Price-amount amount">
									<?php echo wp_kses_post( wc_price( 1008 ) ); ?>
								</span>
							</div>

						</div>
					</a>
				</div>
			</div>
		</header>

		<!-- Product grid -->
		<div class="content-area">
			<div class="grid">

				<div class="card">
					<img src="<?php echo esc_url( TAIOWC_PLUGIN_URI . '/images/product-1.jpg' ); ?>" alt="">
					<span class="add">+</span>
					<div class="card-product-info">
						<p class="card-product-title"><?php esc_html_e( 'Classic Red Sneakers', 'th-all-in-one-woo-cart' ); ?></p>
						<p class="card-product-price"><?php echo wp_kses_post( wc_price( 900 ) ); ?></p>
					</div>
				</div>

				<div class="card">
					<img src="<?php echo esc_url( TAIOWC_PLUGIN_URI . '/images/product-2.jpg' ); ?>" alt="">
					<span class="add">+</span>
					<div class="card-product-info">
						<p class="card-product-title"><?php esc_html_e( 'Minimalist White Tee', 'th-all-in-one-woo-cart' ); ?></p>
						<p class="card-product-price"><?php echo wp_kses_post( wc_price( 108 ) ); ?></p>
					</div>
				</div>

				<div class="card">
					<img src="<?php echo esc_url( TAIOWC_PLUGIN_URI . '/images/product-3.jpg' ); ?>" alt="">
					<span class="add">+</span>
					<div class="card-product-info">
						<p class="card-product-title"><?php esc_html_e( 'Summer Dress', 'th-all-in-one-woo-cart' ); ?></p>
						<p class="card-product-price"><?php echo wp_kses_post( wc_price( 250 ) ); ?></p>
					</div>
				</div>

				<div class="card">
					<img src="<?php echo esc_url( TAIOWC_PLUGIN_URI . '/images/product-4.jpg' ); ?>" alt="">
					<span class="add">+</span>
					<div class="card-product-info">
						<p class="card-product-title"><?php esc_html_e( 'Leather Bag', 'th-all-in-one-woo-cart' ); ?></p>
						<p class="card-product-price"><?php echo wp_kses_post( wc_price( 499 ) ); ?></p>
					</div>
				</div>

			</div>
		</div>

	</div>
</div>
<!-- preview wrapper -->

