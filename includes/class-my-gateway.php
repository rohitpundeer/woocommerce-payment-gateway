<?php

class WC_Gateway_My_Custom extends WC_Payment_Gateway {
    
    protected $name = 'my_custom_gateway';

    public function __construct() {
        $this->id = 'my_custom_gateway';
        $this->has_fields = false;
        $this->method_title = 'My Custom Gateway';
        $this->method_description = 'Custom payment gateway supporting block checkout.';

        $this->init_form_fields();
        $this->init_settings();

        $this->enabled = $this->get_option('enabled');
        $this->title = $this->get_option('title');

        add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
    }

    public function process_payment($order_id) {
        $order = wc_get_order($order_id);
        $order->payment_complete();
        return ['result' => 'success', 'redirect' => $this->get_return_url($order)];
    }
}
