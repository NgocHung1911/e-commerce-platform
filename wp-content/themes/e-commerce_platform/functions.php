<?php
/**
 * E-Commerce Platform Theme Functions
 *
 * @package E-Commerce Platform Theme
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Đăng ký hỗ trợ các tính năng Theme WordPress
 */
function e_commerce_platform_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('editor-styles');
    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');
}
add_action('after_setup_theme', 'e_commerce_platform_setup');

/**
 * Enqueue Theme Stylesheet
 */
function e_commerce_platform_scripts()
{
    wp_enqueue_style('e-commerce-platform-style', get_stylesheet_uri(), array(), '1.0.0');
}
add_action('wp_enqueue_scripts', 'e_commerce_platform_scripts');
