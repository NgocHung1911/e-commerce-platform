<?php
/**
 * Plugin Name: Trình Quản Lý Module E-Commerce (Module Manager)
 * Plugin URI: https://example.com/
 * Description: Plugin Trình quản lý trung tâm tự động phát hiện và nạp tất cả các Sub-module hệ thống.
 * Version: 1.0.0
 * Author: Antigravity
 */

if (!defined('ABSPATH')) {
    exit;
}

$plugins_dir = dirname(plugin_dir_path(__FILE__));

if (file_exists($plugins_dir . '/component/productCard.php')) {
    require_once $plugins_dir . '/component/productCard.php';
}

if (file_exists($plugins_dir . '/product/productList.php')) {
    require_once $plugins_dir . '/product/productList.php';
}

if (file_exists($plugins_dir . '/product/productDetail.php')) {
    require_once $plugins_dir . '/product/productDetail.php';
    if (function_exists('cpm_render_single_product_detail')) {
        add_filter('the_content', 'cpm_render_single_product_detail');
    }
}

if (file_exists($plugins_dir . '/cart/cartList.php')) {
    require_once $plugins_dir . '/cart/cartList.php';
}

if (file_exists($plugins_dir . '/bill/billList.php')) {
    require_once $plugins_dir . '/bill/billList.php';
}

if (file_exists($plugins_dir . '/contact/contactPage.php')) {
    require_once $plugins_dir . '/contact/contactPage.php';
}

if (file_exists($plugins_dir . '/policy/policyPage.php')) {
    require_once $plugins_dir . '/policy/policyPage.php';
}
