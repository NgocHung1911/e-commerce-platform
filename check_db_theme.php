<?php
define('WP_USE_THEMES', false);
require_once __DIR__ . '/wp-load.php';

global $wpdb;

echo "=== CHECKING PRODUCTS IN DB ===\n";
$products = $wpdb->get_results("SELECT ID, post_title, post_type, post_status FROM {$wpdb->posts} WHERE post_type IN ('custom_product', 'product')");

echo "Count of products found: " . count($products) . "\n";
foreach ($products as $p) {
    echo "ID: {$p->ID} | Title: {$p->post_title} | Type: {$p->post_type} | Status: {$p->post_status}\n";
}
