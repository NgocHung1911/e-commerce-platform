<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

class SaleCraft_Ecommerce_Welcome_Notice {
    private $salecraft_ecommerce_pro_theme_url = 'https://www.themebee.net/products/ecommerce-wordpress-theme/';
    private $salecraft_ecommerce_doc_url = 'https://preview.themebee.net/guide/salecraft-ecommerce-free/';
    private $theme_name;
    private $theme_version;
    private $theme_slug;

    public function __construct() {
        add_action('wp_loaded', [$this, 'show_welcome_notice'], 20);
        add_action('wp_loaded', [$this, 'handle_hide_notice'], 15);

        // ✅ Reset notice when theme is activated
        add_action('after_switch_theme', [$this, 'set_welcome_notice']);
    }

    /**
     * Enable notice on theme activation
     */
    public function set_welcome_notice() {
        update_option('salecraft_ecommerce_admin_notice_welcome', 0);
    }

    public function show_welcome_notice() {
        // ✅ Show only if not dismissed
        if (get_option('salecraft_ecommerce_admin_notice_welcome') != 1) {
            add_action('admin_notices', [$this, 'render_welcome_notice']);
        }
    }

    public function render_welcome_notice() {
        $salecraft_ecommerce_dismiss_url = wp_nonce_url(
            remove_query_arg(['activated'], add_query_arg('salecraft-ecommerce-hide-notice', 'welcome')),
            'salecraft_ecommerce_hide_notices_nonce',
            '_salecraft_ecommerce_notice_nonce'
        );

        $salecraft_ecommerce_current_user = wp_get_current_user();
        $theme = wp_get_theme();
        $this->theme_name = $theme->get('Name');
        $this->theme_version = $theme->get('Version');
        $this->theme_slug = $theme->get_template();
        ?>

        <div id="message" class="notice notice-success salecraft-ecommerce-notice">
            <a class="salecraft-ecommerce-message-close notice-dismiss" href="<?php echo esc_url($salecraft_ecommerce_dismiss_url); ?>"></a>
            <div class="salecraft-ecommerce-notice-wrapper">
                <div class="salecraft-ecommerce-notice-welcome">
                    <div class="salecraft-ecommerce-notice-left">
                        <div class="salecraft-ecommerce-notice-subheading">
                            <?php printf(esc_html__('Welcome!', 'salecraft-ecommerce'), $salecraft_ecommerce_current_user->user_login); ?>
                        </div>
                        <h2 class="salecraft-ecommerce-notice-heading">
                            <?php esc_html_e('Thank you for choosing', 'salecraft-ecommerce'); ?>
                            <?php echo esc_html($theme); ?>
                        </h2>
                    </div>
                </div>
                <div class="salecraft-ecommerce-notice-content">
                    <div class="salecraft-ecommerce-notice-item salecraft-ecommerce-notice-theme-dashboard">
                        <h3><?php esc_html_e('Getting Started ', 'salecraft-ecommerce'); ?></h3>
                        <p><?php esc_html_e("Explore the links below to get detailed guidance and make the most out of all the features our theme provides.", 'salecraft-ecommerce'); ?></p>
                        <div class="dashboard-button-group">
                            <a href="<?php echo esc_url(admin_url('themes.php?page=' . $this->theme_slug)); ?>" class="button button-secondary dashboard-button dashboard-button-secondary">
                                <?php esc_html_e('Theme Panel', 'salecraft-ecommerce'); ?>
                            </a>
                            <a href="<?php echo esc_url($this->salecraft_ecommerce_doc_url); ?>" class="button button-secondary dashboard-button dashboard-button-secondary" target="_blank">
                                <?php esc_html_e('User Guide', 'salecraft-ecommerce'); ?>
                            </a>
                            <a href="<?php echo esc_url($this->salecraft_ecommerce_pro_theme_url); ?>" class="button button-secondary dashboard-button dashboard-button-primary" target="_blank">
                                <?php esc_html_e('Go Pro', 'salecraft-ecommerce'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    public function handle_hide_notice() {
        if (isset($_GET['salecraft-ecommerce-hide-notice']) && isset($_GET['_salecraft_ecommerce_notice_nonce'])) {
            if (!wp_verify_nonce(wp_unslash($_GET['_salecraft_ecommerce_notice_nonce']), 'salecraft_ecommerce_hide_notices_nonce')) {
                wp_die(__('Action failed. Please refresh the page and retry.', 'salecraft-ecommerce'));
            }
            if (!current_user_can('manage_options')) {
                wp_die(__('Cheatin&#8217; huh?', 'salecraft-ecommerce'));
            }
            $salecraft_ecommerce_hide_notice = sanitize_text_field(wp_unslash($_GET['salecraft-ecommerce-hide-notice']));
            update_option('salecraft_ecommerce_admin_notice_' . $salecraft_ecommerce_hide_notice, 1);
        }
    }
}
new SaleCraft_Ecommerce_Welcome_Notice();