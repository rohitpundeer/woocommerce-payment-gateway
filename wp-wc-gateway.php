<?php
/**
 * Plugin Name: My Custom Gateway
 * Description: A WooCommerce payment gateway with block support.
 * Version: 1.0
 * Author: Your Name
 */

// Plugin bootstrap
if (!defined('ABSPATH')) exit;

// Load gateway class
add_action('plugins_loaded', 'my_custom_gateway_init', 11);
function my_custom_gateway_init() {
    if (!class_exists('WC_Payment_Gateway')) return;

    include_once __DIR__ . '/includes/class-my-gateway.php';

    add_filter('woocommerce_payment_gateways', function($gateways) {
        $gateways[] = 'WC_Gateway_My_Custom';
        return $gateways;
    });
}

// Register block support
add_action('woocommerce_blocks_payment_method_type_registration', 'my_custom_gateway_register_block');
function my_custom_gateway_register_block() {
    if (!class_exists('\Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType')) {
        return;
    }

    require_once __DIR__ . '/includes/class-my-gateway-blocks.php';

    add_action('woocommerce_blocks_loaded', function () {
        add_filter('woocommerce_blocks_payment_method_type_classes', function ($classes) {
            $classes[] = \MyCustom\Blocks\MyGatewayBlocks::class;
            return $classes;
        });
    });
}

// Enqueue JS block assets
add_action('enqueue_block_assets', 'enqueue_my_gateway_blocks_assets');
function enqueue_my_gateway_blocks_assets() {
    if (function_exists('is_checkout') && is_checkout()) {
        wp_register_script(
            'my-custom-gateway-blocks',
            plugins_url('build/blocks.js', __FILE__),
            ['wp-element', 'wc-blocks-registry'],
            '1.0',
            true
        );

        wp_enqueue_script('my-custom-gateway-blocks');
    }
}
