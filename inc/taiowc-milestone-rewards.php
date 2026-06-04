<?php
/**
 * Milestone Rewards Engine
 *
 * Automatically applies discount, free gift, and free shipping
 * when cart subtotal crosses configured milestone thresholds.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Taiowc_Milestone_Rewards' ) ) :

class Taiowc_Milestone_Rewards {

    private static $instance;

    public static function instance() {
        if ( ! isset( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct() {
        // Discount: negative fee applied during totals calculation
        add_action( 'woocommerce_cart_calculate_fees', array( $this, 'apply_discount_fee' ) );

        // Free Shipping: zero out shipping rates when milestone met
        add_filter( 'woocommerce_package_rates', array( $this, 'apply_free_shipping' ), 100, 2 );

        // Free Gift: set tagged cart item price to 0 during totals
        add_action( 'woocommerce_before_calculate_totals', array( $this, 'set_free_gift_price' ), 99 );

        // Persist taiowc_free_gift_ms data when cart is loaded from session
        add_filter( 'woocommerce_get_cart_item_from_session', array( $this, 'restore_gift_session_data' ), 10, 2 );

        // Sync free gifts on every relevant cart event
        add_action( 'woocommerce_add_to_cart',                    array( $this, 'sync_free_gifts' ), 20 );
        add_action( 'woocommerce_cart_item_removed',              array( $this, 'sync_free_gifts' ), 20 );
        add_action( 'woocommerce_after_cart_item_quantity_update', array( $this, 'sync_free_gifts' ), 20 );
        add_action( 'woocommerce_cart_updated',                   array( $this, 'sync_free_gifts' ), 20 );
        // Initial page load (also covers WC AJAX wp_loaded context)
        add_action( 'wp_loaded', array( $this, 'sync_free_gifts' ), 99 );
    }

    /**
     * Read all configured milestones from settings.
     */
    private function get_milestones() {
        static $milestones = null;
        if ( $milestones !== null ) {
            return $milestones;
        }

        $milestones = array();
        for ( $i = 1; $i <= 3; $i++ ) {
            $amount = taiowc_main()->taiowc_get_option( "taiowc-milestone_{$i}_amount" );
            if ( $amount === '' || $amount === false || $amount === null ) {
                continue;
            }
            $amount = (float) $amount;
            if ( $amount <= 0 ) {
                continue;
            }
            $discount_pct    = taiowc_main()->taiowc_get_option( "taiowc-milestone_{$i}_discount_pct" );
            $gift_product_id = taiowc_main()->taiowc_get_option( "taiowc-milestone_{$i}_gift_product" );

            $milestones[] = array(
                'index'           => $i,
                'amount'          => $amount,
                'label'           => (string) taiowc_main()->taiowc_get_option( "taiowc-milestone_{$i}_label" ),
                'icon'            => (string) taiowc_main()->taiowc_get_option( "taiowc-milestone_{$i}_icon" ),
                'discount_pct'    => ( $discount_pct !== '' && $discount_pct !== false ) ? (float) $discount_pct : 0.0,
                'gift_product_id' => ( $gift_product_id !== '' && $gift_product_id !== false ) ? (int) $gift_product_id : 0,
            );
        }

        usort( $milestones, function( $a, $b ) {
            return $a['amount'] <=> $b['amount'];
        } );

        return $milestones;
    }

    /**
     * Returns cart subtotal (pre-discount, pre-fee).
     */
    private function get_cart_subtotal() {
        if ( ! WC()->cart ) {
            return 0.0;
        }
        return (float) WC()->cart->get_subtotal();
    }

    /**
     * Check whether milestone rewards are globally enabled.
     */
       private function is_enabled() {

    $taiowc_show_free_shipping_bar =
        taiowc_main()->taiowc_get_option(
            'taiowc-show_free_shipping_bar'
        );

    $taiowc_free_shipping_style_type =
        taiowc_main()->taiowc_get_option(
            'taiowc_free_shipping_style_type'
        );

    /*
    |--------------------------------------------------------------------------
    | Must be enabled + milestone mode selected
    |--------------------------------------------------------------------------
    */

    if (
        ! $taiowc_show_free_shipping_bar ||
        $taiowc_free_shipping_style_type !== 'milestone'
    ) {
        return false;
    }

    return true;
}

    /* ------------------------------------------------------------------ */
    /* DISCOUNT                                                             */
    /* ------------------------------------------------------------------ */

    /**
     * Add a negative fee for the highest unlocked discount milestone.
     * Only the best (highest) unlocked discount is applied so they don't stack.
     */
    public function apply_discount_fee( $cart ) {
        if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;
        if ( ! $this->is_enabled() ) return;

        $subtotal   = $this->get_cart_subtotal();
        $milestones = $this->get_milestones();

        $best = null;
        foreach ( $milestones as $ms ) {
            if ( $ms['icon'] === 'discount' && $ms['discount_pct'] > 0 && $subtotal >= $ms['amount'] ) {
                $best = $ms; // keep looping to get the highest one
            }
        }

        if ( ! $best ) {
            return;
        }

        $discount_amount = $subtotal * ( $best['discount_pct'] / 100.0 );

        $cart->add_fee(
            esc_html( $best['label'] ),
            -round( $discount_amount, wc_get_price_decimals() ),
            false // not taxable
        );
    }

    /* ------------------------------------------------------------------ */
    /* FREE SHIPPING                                                        */
    /* ------------------------------------------------------------------ */

    /**
     * When a shipping milestone is reached, zero out all shipping costs.
     */
    public function apply_free_shipping( $rates, $package ) {
        if ( ! $this->is_enabled() ) return $rates;
        if ( ! WC()->cart ) return $rates;

        $subtotal   = $this->get_cart_subtotal();
        $milestones = $this->get_milestones();

        $unlocked = false;
        foreach ( $milestones as $ms ) {
            if ( $ms['icon'] === 'shipping' && $subtotal >= $ms['amount'] ) {
                $unlocked = true;
                break;
            }
        }

        if ( ! $unlocked ) {
            return $rates;
        }

        foreach ( $rates as $rate_key => $rate ) {
            $rate->set_cost( 0 );
            $rate->set_taxes( array() );
        }

        return $rates;
    }

    /* ------------------------------------------------------------------ */
    /* FREE GIFT                                                            */
    /* ------------------------------------------------------------------ */

    /**
     * Ensure the gift item data is restored when the session is loaded.
     */
    public function restore_gift_session_data( $session_data, $values ) {
        if ( ! empty( $values['taiowc_free_gift_ms'] ) ) {
            $session_data['taiowc_free_gift_ms'] = (int) $values['taiowc_free_gift_ms'];
        }
        return $session_data;
    }

    /**
     * Set the price of gift items to 0 during totals calculation.
     */
    public function set_free_gift_price( $cart ) {
        if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;
        if ( ! $this->is_enabled() ) return;

        foreach ( $cart->get_cart() as $cart_item ) {
            if ( ! empty( $cart_item['taiowc_free_gift_ms'] ) ) {
                $cart_item['data']->set_price( 0 );
            }
        }
    }

    /**
     * Add or remove free gift products based on cart subtotal vs thresholds.
     * A static flag prevents re-entrant calls when add_to_cart() fires this hook again.
     */
    public function sync_free_gifts() {
        static $running = false;
        if ( $running ) return;

        if ( ! $this->is_enabled() ) return;
        if ( is_admin() ) return;
        if ( ! WC()->cart ) return;
        if ( ! WC()->session ) return;

        $running = true;

        $subtotal   = $this->get_cart_subtotal();
        $milestones = $this->get_milestones();

        // Build a map of which gift milestone indexes are currently in the cart
        // ms_index => cart_item_key
        $in_cart = array();
        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            if ( ! empty( $cart_item['taiowc_free_gift_ms'] ) ) {
                $in_cart[ (int) $cart_item['taiowc_free_gift_ms'] ] = $cart_item_key;
            }
        }

        foreach ( $milestones as $ms ) {
            if ( $ms['icon'] !== 'gift' ) continue;
            if ( $ms['gift_product_id'] <= 0 ) continue;

            $ms_index   = $ms['index'];
            $product_id = $ms['gift_product_id'];
            $is_unlocked = $subtotal >= $ms['amount'];
            $is_in_cart  = isset( $in_cart[ $ms_index ] );

            if ( $is_unlocked && ! $is_in_cart ) {
                // Verify product exists before adding
                $product = wc_get_product( $product_id );
                if ( $product && $product->exists() ) {
                    WC()->cart->add_to_cart(
                        $product_id,
                        1,
                        0,
                        array(),
                        array( 'taiowc_free_gift_ms' => $ms_index )
                    );
                }
            } elseif ( ! $is_unlocked && $is_in_cart ) {
                WC()->cart->remove_cart_item( $in_cart[ $ms_index ] );
            }
        }

        $running = false;
    }
}

// Instantiate after WooCommerce and plugin settings are ready
add_action( 'init', function() {
    if ( function_exists( 'taiowc_main' ) && class_exists( 'WooCommerce' ) ) {
        Taiowc_Milestone_Rewards::instance();
    }
}, 30 );

endif;
