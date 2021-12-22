<?php

if(!defined('ABSPATH')) exit;

add_filter( 'woocommerce_product_stock_status_options', 'filter_woocommerce_product_stock_status_options', 10, 1 );
function filter_woocommerce_product_stock_status_options( $status ) {
    $status['await'] = "Ожидается";

    return $status;
}

add_filter( 'woocommerce_get_availability_text', 'filter_woocommerce_get_availability_text', 10, 2 );
function filter_woocommerce_get_availability_text( $availability, $product ) {
    $order_id = $product->get_id();
    switch( $product->get_stock_status() ) {
        case 'await':
            $text = get_post_meta ( $order_id, "_await_text", true);
            $availability = "Ожидается: {$text}";
        break;
    }

    return $availability; 
}

add_filter( 'woocommerce_get_availability_class', 'filter_woocommerce_get_availability_class', 10, 2 );
function filter_woocommerce_get_availability_class( $class, $product ) {
    switch( $product->get_stock_status() ) {
        case 'await':
            $class = 'await'; 
        break;
    }

    return $class;
}

add_filter( 'woocommerce_admin_stock_html', 'filter_woocommerce_admin_stock_html', 10, 2 );
function filter_woocommerce_admin_stock_html( $stock_html, $product ) {
    $order_id = $product->get_id();
    switch( $product->get_stock_status() ) {
        case 'await':
            $text = get_post_meta ( $order_id, "_await_text", true);
            $stock_html = "<mark class='outofstock'>Ожидается: {$text}</mark>"; 
        break;
    }   

    return $stock_html;
}