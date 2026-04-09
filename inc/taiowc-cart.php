<?php

if ( ! defined( 'ABSPATH' ) ) exit;

$uniqueID   = ++ taiowc_main()->taiowc_cartInstances;

$layoutType = !empty($args['layout'])  ? $args['layout'] : '';
$iconstyle  = !empty($args['iconstyle'])  ? $args['iconstyle'] : '';

if($layoutType =='cart_fixed_2'){

$cartStyle = '';

}elseif($layoutType =='cart_fixed_1'){

		if(taiowc_main()->taiowc_get_option( 'taiowc-cart_effect' ) == 'taiowc-click-dropdown'){

          $cartStyle = '';

		}else{

          $cartStyle = taiowc_main()->taiowc_get_option( 'taiowc-cart_effect' );
          
		}


}else{

$cartStyle = taiowc_main()->taiowc_get_option( 'taiowc-cart_effect' );	

}

$fixedcart_class = '';
if ($layoutType == 'cart_fixed_1' || $layoutType == 'cart_fixed_2' ) {
	$fixedcart_class = 'taiowc-fixed-cart';
}

$taiowc_fxd_cart_position  = esc_html(taiowc_main()->taiowc_get_option( 'taiowc-fxd_cart_position' ));

// Append position class with space
if (!empty($taiowc_fxd_cart_position)) {
    $fixedcart_class .= ' ' . $taiowc_fxd_cart_position;
}

?>
<div id="<?php echo esc_attr($uniqueID); ?>" class="taiowc-wrap  <?php echo esc_attr($cartStyle); ?> <?php echo esc_attr($fixedcart_class); ?> <?php echo esc_attr($layoutType); ?>">
			
			<?php
			if($layoutType =='cart_fixed_2' && $cartStyle == ''){
                taiowc_markup_pro()->taiowc_cart_show($iconstyle, $layoutType);
		      taiowc_markup_pro()->taiowc_cart_item_show($iconstyle);
			 }else{
			 taiowc_markup_pro()->taiowc_cart_show($iconstyle, $layoutType);
			 }
			?>
</div>
