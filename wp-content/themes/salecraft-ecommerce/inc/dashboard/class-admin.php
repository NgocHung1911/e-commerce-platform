<?php
/**
 * SaleCraft Ecommerce Admin Class.
 *
 * @package SaleCraft Ecommerce
 * @since   1.0.0
 */
if (!defined('ABSPATH')) {
    exit;
}
if (!class_exists('SaleCraft_Ecommerce_Admin')) :
    /**
     * SaleCraft_Ecommerce_Admin Class.
     */
    class SaleCraft_Ecommerce_Admin
    {
        /**
         * Constructor.
         */
        public function __construct()
        {
            add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
        }

        /**
         * Localize array for import button AJAX request.
         */
        public function enqueue_scripts()
        {
            wp_enqueue_style(
                'salecraft-ecommerce-admin-style',
                get_template_directory_uri() . '/inc/dashboard/css/admin.css',
                array(),
                SALECRAFT_ECOMMERCE_VERSION
            );

            wp_enqueue_script('salecraft-ecommerce-plugin-install-helper', get_template_directory_uri() . '/inc/dashboard/js/admin.js', array('jquery'), SALECRAFT_ECOMMERCE_VERSION);
            $salecraft_ecommerce_welcome_data = array(
                'uri' => esc_url(admin_url('/themes.php?page=salecraft-ecommerce&tab=starter-templates')),
                'btn_text' => esc_html__('Processing...', 'salecraft-ecommerce'),
                'nonce' => wp_create_nonce('salecraft_ecommerce_demo_import_nonce'),
                'admin_url' => esc_url(admin_url()),
                'ajaxurl' => admin_url('admin-ajax.php'), // Include this line for using admin-ajax.php
            );
            wp_localize_script('salecraft-ecommerce-plugin-install-helper', 'salecraftecommerceRedirectDemoPage', $salecraft_ecommerce_welcome_data);
        }

        
    }
endif;
return new SaleCraft_Ecommerce_Admin();
