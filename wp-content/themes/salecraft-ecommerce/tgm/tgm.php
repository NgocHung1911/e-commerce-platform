<?php

require get_template_directory() . '/tgm/class-tgm-plugin-activation.php';
/**
 * Recommended plugins.
 */
function salecraft_ecommerce_register_recommended_plugins() {
	$plugins = array(
		array(
			'name'             => __( 'WooCommerce', 'salecraft-ecommerce' ),
			'slug'             => 'woocommerce',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'YITH WooCommerce Wishlist', 'salecraft-ecommerce' ),
			'slug'             => 'yith-woocommerce-wishlist',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'Currency Switcher for WooCommerce', 'salecraft-ecommerce' ),
			'slug'             => 'currency-switcher-woocommerce',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'GTranslate', 'salecraft-ecommerce' ),
			'slug'             => 'gtranslate',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'Essential Blocks', 'salecraft-ecommerce' ),
			'slug'             => 'essential-blocks',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		)
	);
	$config = array();
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'salecraft_ecommerce_register_recommended_plugins' );