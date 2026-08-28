<?php
/**
 * SaleCraft Ecommerce functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package SaleCraft Ecommerce
 * @since SaleCraft Ecommerce 1.0
 */

if (!defined('SALECRAFT_ECOMMERCE_VERSION')) {
    // Replace the version number of the theme on each release.
    define('SALECRAFT_ECOMMERCE_VERSION', '1.0.1');
}

if ( ! function_exists( 'salecraft_ecommerce_support' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * @since 1.0.0
     *
     * @return void
     */

    function salecraft_ecommerce_support() {
        add_editor_style( get_stylesheet_directory_uri().'/assets/css/editor.css' );
        load_theme_textdomain( 'salecraft-ecommerce', get_template_directory() . '/languages' );
    }

endif;
add_action( 'after_setup_theme', 'salecraft_ecommerce_support' );

function salecraft_ecommerce_scripts() {
	wp_enqueue_script( 'salecraft-ecommerce-scripts', get_template_directory_uri() . '/assets/js/theme.js', array('jquery'),'' ,true );

	wp_style_add_data( 'salecraft-ecommerce-style', 'rtl', 'replace' );

	wp_enqueue_script( 'jquery-wow', esc_url(get_template_directory_uri()) . '/assets/js/wow.js', array('jquery') );
	
	wp_enqueue_style( 'animate-css', esc_url(get_template_directory_uri()).'/assets/css/animate.css' );
}
add_action( 'wp_enqueue_scripts', 'salecraft_ecommerce_scripts' );

function salecraft_ecommerce_styles() {
	wp_enqueue_style(
		'salecraft-ecommerce-style',
		get_stylesheet_uri(),
		[],
		wp_get_theme()->get( 'Version' )
	);

	wp_enqueue_style( 'dashicons' );
}
add_action( 'wp_enqueue_scripts', 'salecraft_ecommerce_styles' );

require_once get_template_directory() . '/tgm/tgm.php';

/**
 * Calling in the admin area for the Welcome Page as well as for the new theme notice too.
 */
if (is_admin()) {
    require get_template_directory() . '/inc/dashboard/class-admin.php';
    require get_template_directory() . '/inc/dashboard/class-dashboard.php';
    require get_template_directory() . '/inc/dashboard/welcome-notice.php';
}

require get_template_directory() . '/inc/dashboard/changelog.php';
require_once get_theme_file_path( '/inc/customizer.php' );