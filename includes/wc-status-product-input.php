<?php

if(!defined('ABSPATH')) exit;

add_action( 'woocommerce_product_options_stock_status', 'input_await_text' );
function input_await_text() {
    $id = get_the_ID();
    woocommerce_wp_text_input( array(
        'id'          => '_await_text',
		'value'       => get_post_meta( $id, '_await_text', true ),
		'label'       => 'Текст',
		'desc_tip'    => true,
		'description' => 'Текст для статуса "Ожидается"',
    ));
}

add_action( 'woocommerce_process_product_meta', 'input_await_text_save', 10, 2 );
function input_await_text_save( $id, $post ){
	if( !empty( $_POST['_await_text'] ) ) {
		update_post_meta( $id, '_await_text', $_POST['_await_text'] );
	} else {
		delete_post_meta( $id, '_await_text' );
	}
}