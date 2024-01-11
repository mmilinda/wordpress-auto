<?php

require get_template_directory() . '/inc/class-tgm-plugin-activation.php';

function product_affiliate_recommended_plugins() {
	$plugins = array(
		array(
			'name'             => __( 'GTranslate', 'product-affiliate' ),
			'slug'             => 'gtranslate',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'YITH WooCommerce Wishlist', 'product-affiliate' ),
			'slug'             => 'yith-woocommerce-wishlist',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'FOX – Currency Switcher Professional for WooCommerce', 'product-affiliate' ),
			'slug'             => 'woocommerce-currency-switcher',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		),
	);
	$config = array();
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'product_affiliate_recommended_plugins' );