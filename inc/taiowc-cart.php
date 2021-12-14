<?php

if ( ! defined( 'ABSPATH' ) ) exit;


$uniqueID   = ++ taiowc()->cartInstances;

$layoutType = !empty($args['layout'])  ? $args['layout'] : '';

if($layoutType =='cart_fixed_1'){

		if(taiowc()->get_option( 'cart_effect' ) == 'taiowc-click-dropdown'){

          $cartStyle = '';

		}else{

          $cartStyle = taiowc()->get_option( 'cart_effect' );
          
		}


}else{

$cartStyle = taiowc()->get_option( 'cart_effect' );	

}


?>

<div id="<?php echo esc_attr($uniqueID); ?>" class="taiowc-wrap  <?php echo esc_attr($cartStyle); ?>  <?php echo esc_attr($layoutType); ?>">
			
			<?php 


            taiowc_markup()->taiowc_cart_show();
    
			
			taiowc_markup()->taiowc_cart_item_show();


			?>
</div>