<?php

namespace App;

add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'App\\woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'App\\woocommerce_ajax_add_to_cart');

function woocommerce_ajax_add_to_cart()
{
    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : \wc_stock_amount($_POST['quantity']);
    $variation_id = absint($_POST['variation_id']);
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);

    if ($passed_validation && \WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {
        do_action('woocommerce_ajax_added_to_cart', $product_id);

        $product = \wc_get_product($product_id);

        echo wp_send_json([
            'cart_count' => \WC()->cart->cart_contents_count,
            'product_name' => $product->get_title()
        ]);
    } else {
        echo wp_send_json([
            'error' => true,
        ]);
    }

    wp_die();
}
