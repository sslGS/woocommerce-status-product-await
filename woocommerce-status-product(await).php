<?php
/**
 * Plugin Name: WooCommerce Status Product(await)
 * Description: Плагин для кастомизации статуса наличия товара под все-пестициды.
 * Version: 1.1.6release1
 * Author: Yaroslav Burashnykov
 * @package     WC-Status-Product
 * @author      Yaroslav Burashnykov
 * @category    Plugin
 */
if (!defined('ABSPATH')) exit;

if (function_exists('is_multisite') && is_multisite()) {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    if ( !is_plugin_active( 'woocommerce/woocommerce.php' ) ) return;
} else {
    if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) return; 
}

require('includes/wc-status-product(await).php');
require('includes/wc-status-product-input.php');