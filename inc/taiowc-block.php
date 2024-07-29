<?php if ( ! defined( 'ABSPATH' ) ) exit;

/****************/
//Block registered
/****************/

function taiowc_register_blocks() {
    $blocks = array(
        array(
            'name'           => 'taiowc/taiowc',
            'script_handle'  => 'taiowc',
            'editor_style'   => 'taiowc-editor-style',
            'frontend_style' => 'taiowc-frontend-style',
            'render_callback' => 'taiowc_blocks_render_callback',
            'localize_data'  => array(
                'adminUrltaiowc' => admin_url('admin.php?page=taiowc'),
            ),
        ),
    );
  
    foreach ( $blocks as $block ) {
        // Register JavaScript file
        wp_register_script(
            $block['script_handle'],
            TAIOWC_PLUGIN_URI . 'build/' . $block['script_handle'] . '.js',
            array( 'wp-blocks', 'wp-element', 'wp-editor' ),
            filemtime( TAIOWC_PLUGIN_PATH . '/build/' . $block['script_handle'] . '.js' )
        );
  
        // Register editor style
        wp_register_style(
            $block['editor_style'],
            TAIOWC_PLUGIN_URI . 'build/' . $block['script_handle'] . '.css',
            array( 'wp-edit-blocks' ),
            filemtime( TAIOWC_PLUGIN_PATH . '/build/' . $block['script_handle'] . '.css' )
        );
  
        // Register front end block style
        wp_register_style(
            $block['frontend_style'],
            TAIOWC_PLUGIN_URI . 'build/style-' . $block['script_handle'] . '.css',
            array(),
            filemtime( TAIOWC_PLUGIN_PATH . '/build/style-' . $block['script_handle'] . '.css' )
        );
  
        // Localize the script with data
        if ( isset( $block['localize_data'] ) && ! is_null( $block['localize_data'] ) ) {
            wp_localize_script(
                $block['script_handle'],
                'ThBlockDatataiowc',
                $block['localize_data']
            );
        }
  
        // Prepare the arguments for registering the block
        $block_args = array(
            'editor_script'   => $block['script_handle'],
            'editor_style'    => $block['editor_style'],
            'style'           => $block['frontend_style'],
        );
  
        // Check if the render callback is set and not null
        if ( isset( $block['render_callback'] ) && ! is_null( $block['render_callback'] ) ) {
            $block_args['render_callback'] = $block['render_callback'];
           
        }
  
        // Register each block
        register_block_type( $block['name'], $block_args );
    }
    
  }
  
  add_action( 'init', 'taiowc_register_blocks' );
  
  function taiowc_blocks_categories( $categories ) {
    return array_merge(
        $categories,
        [
            [
                'slug'  => 'taiowc',
                'title' => __( 'All In One Woo Cart', 'taiowc' ),
            ],
        ]
    );
  }
  add_filter( 'block_categories_all', 'taiowc_blocks_categories', 11, 2);
  
  function taiowc_blocks_editor_assets(){

  wp_enqueue_script(
    'taiowc-data-block',
    TAIOWC_PLUGIN_URI . 'build/taiowc-data.js',
    array(),
    TAIOWC_VERSION,
    true
  );
    wp_localize_script(
        'taiowc-data-block',
        'thnkblock',
        array(
            'homeUrl' => plugins_url( '/', __FILE__ ),
            'showOnboarding' => '',
        )
    );
    wp_enqueue_style(
        'taiowc-th-icon-css',
        TAIOWC_PLUGIN_URI . 'th-icon/style.css',
        array(),
        TAIOWC_VERSION
    );
      
  }
  add_action( 'enqueue_block_assets', 'taiowc_blocks_editor_assets' );
  
  
   function taiowc_blocks_render_callback( $attr ) {
  
   if ( function_exists( 'get_current_screen' ) && get_current_screen()->is_block_editor() ) {
      return;
   } 
    // class
    if (!isset($attr['cartPrice'])) {
        $taiowcPriceShow = "th-showprice";
    }else{
        $taiowcPriceShow = "";
    }
    if (!isset($attr['cartCount'])) {
    $taiowcCountShow = "th-showcount";
    }  else{
        $taiowcCountShow = "";   
    }
    
    $countPosition    = isset($attr['countPosition']) ? $attr['countPosition'] : 'left';
   
     
    $block_content = '<div id="wp-block-taiowc-' . esc_attr($attr['uniqueID']) . '"  class="wp-block-taiowc ' . esc_attr($taiowcPriceShow) . ' ' . esc_attr($taiowcCountShow) . '  '.esc_attr($countPosition).'">';
    
    $cartStyle = isset($attr['cartStyle']) ? $attr['cartStyle'] : '[taiowc]';
  
    $block_content .= ''.do_shortcode($cartStyle).'</div>';
    
    return $block_content;
    
  }
  