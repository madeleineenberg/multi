<?php
return function (): mixed {
    include_once WC_ABSPATH . 'includes/wc-cart-functions.php';
    include_once WC_ABSPATH . 'includes/class-wc-cart.php';

    if (is_null(\WC()->cart)) {
        wc_load_cart();
    }

    $quantity = 0;

    if (is_user_logged_in()) {
        $quantity = \WC()->cart->get_cart_contents_count();
    } else {
        $session_id = null;
        $values = null;

        foreach ($_COOKIE as $key => $value) {

            if (stripos($key, 'wp_woocommerce_session_') === false) {
                continue;
            }

            $values = explode('||', $value);
        }

        $session_id = $values[0];
        $session = new \WC_Session_Handler();
        $session_data = $session->get_session($session_id);
        $cart_data = unserialize($session_data['cart']);

        foreach ($cart_data as &$item) {
            $quantity += $item['quantity'];
        }
    }

    return $quantity;
};
