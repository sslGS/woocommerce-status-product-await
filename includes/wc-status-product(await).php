<?php

if(!defined('ABSPATH')) exit;

add_filter( 'woocommerce_get_availability_class', 'filter_woocommerce_get_availability_class', 10, 2 );
function filter_woocommerce_get_availability_class($class, $product) {
    switch($product->get_stock_status()) {
        case 'await':
            $class = 'await'; 
        break;
    }

    return $class;
}

add_filter( 'woocommerce_product_stock_status_options', 'filter_woocommerce_product_stock_status_options', 10, 1 );
function filter_woocommerce_product_stock_status_options($status) {
    $status['await'] = "Ожидается";

    return $status;
}

add_filter('woocommerce_admin_stock_html', 'filter_woocommerce_admin_stock_html', 10, 2);
function filter_woocommerce_admin_stock_html($stock_html, $product) {
    $post = get_post();
    switch($product->get_stock_status()) {
        case 'await':
            $text = get_post_meta ($post->ID, "_await_text", true);
            $stock_html = "<mark class='outofstock'>Ожидается: {$text}</mark>"; 
        break;
    }   

    return $stock_html;
}

add_filter('woocommerce_is_purchasable', 'check_purchasable_product', 10, 2 );
function check_purchasable_product($is_purchasable, $product) {
	if( $product->get_stock_status() === 'await' ) {
		return false;
	}
	return $is_purchasable;
}

add_action( 'woocommerce_single_product_summary', 'unavailable_product_display_message', 30 );
function unavailable_product_display_message() {
    global $product;
    $post = get_post();
    switch( $product->get_stock_status() ) {
        case 'await':
            $text = get_post_meta ($post->ID, "_await_text", true);
            $availability = "<p class='stock out-of-stock'>Ожидается: {$text}</p>";
            echo $availability;
        break;
    }
}