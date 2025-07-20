<?php
namespace MyCustom\Blocks;

use Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType;

class MyGatewayBlocks extends AbstractPaymentMethodType {

    protected $name = 'my_custom_gateway';

    public function initialize() {
        $this->settings = get_option('woocommerce_my_custom_gateway_settings', []);
    }

    public function get_payment_method_data() {
        return [
            'title'       => $this->settings['title'] ?? 'My Custom Gateway',
            'description' => 'Pay securely using My Custom Gateway.',
            'supports'    => ['products'],
        ];
    }
}
