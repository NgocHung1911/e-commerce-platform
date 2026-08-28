<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
class SaleCraft_Ecommerce_Dashboard
{
    private static $salecraft_ecommerce_instance;
    /**
     * The pro_status of theme.
     *
     * @var string $salecraft_ecommerce_pro_status The pro_status.
     */
    public $salecraft_ecommerce_pro_status = false;
    public static function instance()
    {
        if (is_null(self::$salecraft_ecommerce_instance)) {
            self::$salecraft_ecommerce_instance = new self();
        }
        return self::$salecraft_ecommerce_instance;
    }
    private function __construct()
    {
        $this->setup_hooks();
    }
    private function setup_hooks()
    {
        add_action('admin_menu', array($this, 'create_menu'));
        add_action('in_admin_header', array($this, 'hide_admin_notices'));
    }

    private function theme_name_function()
    {
        $theme_name = wp_get_theme()->get('Name');
    }

    /**
     * Theme Url
     *
     * @access private
     * @var string $theme_url
     * @since 1.0.0
     */
    private $salecraft_ecommerce_theme_url = 'https://www.themebee.net/products/salecraft-ecommerce/';
    /**
     * Pro Theme Url
     *
     * @access private
     * @var string $salecraft_ecommerce_pro_theme_url
     * @since 1.0.0
     */
    private $salecraft_ecommerce_pro_theme_url = 'https://www.themebee.net/products/ecommerce-wordpress-theme/';
    /**
     * Documentation Url
     *
     * @access private
     * @var string $salecraft_ecommerce_doc_url
     * @since 1.0.0
     */
    private $salecraft_ecommerce_doc_url = 'https://preview.themebee.net/guide/salecraft-ecommerce-free/';
    /**
     * Premium Documentation Url
     *
     * @access private
     * @var string $salecraft_ecommerce_pro_doc_url
     * @since 1.0.0
     */
    private $salecraft_ecommerce_pro_doc_url = 'https://preview.themebee.net/guide/salecraft-ecommerce-pro/';
    /**
     * Preview Url
     *
     * @access private
     * @var string $salecraft_ecommerce_preview_url
     * @since 1.0.0
     */
    private $salecraft_ecommerce_preview_url = 'https://preview.themebee.net/salecraft-ecommerce-pro/';
    /**
     * Bundle Url
     *
     * @access private
     * @var string $salecraft_ecommerce_bundle_url
     * @since 1.0.0
     */
    private $salecraft_ecommerce_bundle_url = 'https://www.themebee.net/products/wordpress-theme-bundle/';
    /**
     * Misc Support Url
     *
     * @access private
     * @since 1.0.0
     */
    private $salecraft_ecommerce_community_url = 'https://wordpress.org/support/theme/salecraft-ecommerce/';
    /**
     * Misc Review Url
     *
     * @access private
     * @since 1.0.0
     */
    private $salecraft_ecommerce_review_url = 'https://wordpress.org/support/theme/salecraft-ecommerce/reviews';
    public function create_menu()
    {
        if (!is_child_theme()) {
            $theme = wp_get_theme();
        } else {
            $theme = wp_get_theme()->parent();
        }
        /* translators: %s: Theme Name. */
        $theme_page_name = sprintf(esc_html__('%s', 'salecraft-ecommerce'), $theme->Name);
        add_theme_page(
            $theme_page_name,
            $theme_page_name,
            'edit_theme_options',
            'salecraft-ecommerce',
            array(
                $this,
                'dashboard_page',
            )
        );
    }
    /**
     * Hide admin notices from BlockArt admin pages.
     *
     * @since 1.0.0
     */
    public function hide_admin_notices()
    {
        // Bail if we're not on a SaleCraft Ecommerce screen or page.
        if (empty($_REQUEST['page']) || false === strpos(sanitize_text_field(wp_unslash($_REQUEST['page'])), 'salecraft-ecommerce')) { // phpcs:ignore WordPress.Security.NonceVerification
            return;
        }
        global $wp_filter;
        $ignore_notices = apply_filters('salecraft_ecommerce_ignore_hide_admin_notices', array());
        foreach (array('user_admin_notices', 'admin_notices', 'all_admin_notices') as $wp_notice) {
            if (empty($wp_filter[$wp_notice])) {
                continue;
            }
            $hook_callbacks = $wp_filter[$wp_notice]->callbacks;
            if (empty($hook_callbacks) || !is_array($hook_callbacks)) {
                continue;
            }
            foreach ($hook_callbacks as $priority => $hooks) {
                foreach ($hooks as $name => $callback) {
                    if (!empty($name) && in_array($name, $ignore_notices, true)) {
                        continue;
                    }
                    if (
                        !empty($callback['function']) &&
                        !is_a($callback['function'], '\Closure') &&
                        isset($callback['function'][0], $callback['function'][1]) &&
                        is_object($callback['function'][0]) &&
                        in_array($callback['function'][1], $ignore_notices, true)
                    ) {
                        continue;
                    }
                    unset($wp_filter[$wp_notice]->callbacks[$priority][$name]);
                }
            }
        }
    }
    public function dashboard_page()
    {
        if (!is_child_theme()) {
            $theme = wp_get_theme();
        } else {
            $theme = wp_get_theme()->parent();
        }
        $salecraft_ecommerce_admin_ur = admin_url();
        $tabs = apply_filters(
            'salecraft_ecommerce_dashboard_tabs',
            array(
                'dashboard' => array(
                    'name' => esc_html__('Dashboard', 'salecraft-ecommerce'),
                    'callback' => function () {
                        include __DIR__ . '/info-tabs/dashboard.php';
                    },
                ),
                'free-vs-pro' => array(
                    'name' => esc_html__('Free Vs Pro', 'salecraft-ecommerce'),
                    'callback' => function () {
                        include __DIR__ . '/info-tabs/free-vs-pro.php';
                    },
                ),
                'help' => array(
                    'name' => esc_html__('Help Center', 'salecraft-ecommerce'),
                    'callback' => function () {
                        include __DIR__ . '/info-tabs/help-center.php';
                    },
                ),
            )
        )
        ?>
        <div class="wrap">
            <div class="salecraft-ecommerce-dashboard-area">
                <div class="salecraft-ecommerce-dashboard-header">
                    <a class="salecraft-ecommerce-logo" href="<?php echo esc_url($this->salecraft_ecommerce_theme_url); ?>"
                       target="_blank">
                        <img class="salecraft-ecommerce-premium-badge"
                             src="<?php echo esc_url(get_template_directory_uri() . '/inc/dashboard/images/salecraft-ecommerce-logo.png'); ?>"
                             alt="<?php esc_attr_e('logo image', 'salecraft-ecommerce'); ?>">
                        <span class="salecraft-ecommerce-theme-version">
                            <?php
                                $salecraft_ecommerce_active_theme = wp_get_theme();
                                echo esc_html( $salecraft_ecommerce_active_theme->get( 'Version' ) );
                            ?>
                        </span>
                    </a>
                    <nav class="dashboard-header-nav">
                        <ul class="dashboard-primary-menu">
                            <?php
                            foreach ($tabs as $id => $tab) :
                                if (!is_callable($tab['callback'])) {
                                    continue;
                                }
                                ?>
                                <li class="menu-item menu-item-<?php echo esc_attr($id); ?>">
                                    <a id="<?php echo esc_attr($id); ?>"
                                       href=<?php echo esc_url("{$salecraft_ecommerce_admin_ur}themes.php?page=salecraft-ecommerce&tab=$id"); ?>><?php echo esc_html($tab['name']); ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                    <div class="dashboard-header-extras">
                        <div class="dashboard-button-group">
                            <?php if (!$this->salecraft_ecommerce_pro_status) { ?>
                                <a href="<?php echo esc_url($this->salecraft_ecommerce_pro_theme_url); ?>" class="button button-secondary dashboard-button dashboard-button-primary" target="_blank">
                                    <?php esc_html_e('Go Pro', 'salecraft-ecommerce'); ?>
                                </a>
                            <?php } ?>
                            <button type="button" id="dashboard-changelog-button" class="button button-secondary dashboard-button dashboard-button-secondary">
                                <?php esc_html_e('Changelog', 'salecraft-ecommerce'); ?>
                            </button>
                        </div>
                    </div>
                </div>
                <?php
                $current_tab = isset($_GET['tab']) ? sanitize_text_field(wp_unslash($_GET['tab'])) : 'dashboard';
                $current_tab = in_array($current_tab, array_keys($tabs), true) ? $current_tab : 'dashboard';
                $callback = $tabs[$current_tab]['callback'];
                call_user_func($callback);
                ?>
            </div>
        </div>
        <div id="salecraft-ecommerce-dashboard-offcanvas" class="salecraft-ecommerce-dashboard-offcanvas">
            <div class="dialog-head">
                <h3><?php esc_html_e('Latest Updates', 'salecraft-ecommerce'); ?></h3>
                <div id="dialog-close" class="dialog-close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M10.052 9.34082L16.277 3.11582C16.577 2.81582 16.577 2.36582 16.277 2.06582C15.977 1.76582 15.5269 1.76582 15.227 2.06582L9.00195 8.29082L2.77695 2.06582C2.47695 1.76582 2.02695 1.76582 1.72695 2.06582C1.42695 2.36582 1.42695 2.81582 1.72695 3.11582L7.95195 9.34082L1.72695 15.5658C1.42695 15.8658 1.42695 16.3158 1.72695 16.6158C1.87695 16.7658 2.02695 16.8408 2.25195 16.8408C2.47695 16.8408 2.62695 16.7658 2.77695 16.6158L9.00195 10.3908L15.227 16.6158C15.377 16.7658 15.602 16.8408 15.752 16.8408C15.902 16.8408 16.127 16.7658 16.277 16.6158C16.577 16.3158 16.577 15.8658 16.277 15.5658L10.052 9.34082Z" fill="#999999"/>
                    </svg>
                </div>
            </div>
            <div class="dialog-content">
    <?php
    // Get the currently active theme directory.
    $salecraft_ecommerce_theme_dir = get_stylesheet_directory();

    // Get the active theme's readme.txt.
    $salecraft_ecommerce_readme_file = $salecraft_ecommerce_theme_dir . '/readme.txt';

    if ( file_exists( $salecraft_ecommerce_readme_file ) ) {

        $salecraft_ecommerce_readme = file_get_contents(
            $salecraft_ecommerce_readme_file
        );

        $salecraft_ecommerce_changelog_data = array();

        /*
         * Get everything after "== Changelog =="
         */
        if ( preg_match(
            '/==\s*Changelog\s*==\s*(.*?)(?=\n==|\z)/is',
            $salecraft_ecommerce_readme,
            $salecraft_ecommerce_changelog_match
        ) ) {

            $salecraft_ecommerce_changelog_content =
                trim( $salecraft_ecommerce_changelog_match[1] );

            /*
             * Find each version.
             */
            preg_match_all(
                '/=\s*([0-9.]+)\s*=\s*(.*?)(?=\n=\s*[0-9.]+\s*=|\z)/is',
                $salecraft_ecommerce_changelog_content,
                $salecraft_ecommerce_versions,
                PREG_SET_ORDER
            );

            foreach ( $salecraft_ecommerce_versions as $salecraft_ecommerce_version ) {

                $salecraft_ecommerce_version_number =
                    trim( $salecraft_ecommerce_version[1] );

                $salecraft_ecommerce_changes =
                    trim( $salecraft_ecommerce_version[2] );

                $salecraft_ecommerce_change_lines = array();

                foreach (
                    preg_split(
                        '/\r\n|\r|\n/',
                        $salecraft_ecommerce_changes
                    ) as $salecraft_ecommerce_line
                ) {

                    $salecraft_ecommerce_line = trim(
                        $salecraft_ecommerce_line
                    );

                    if ( empty( $salecraft_ecommerce_line ) ) {
                        continue;
                    }

                    $salecraft_ecommerce_line = ltrim(
                        $salecraft_ecommerce_line,
                        '*- '
                    );

                    $salecraft_ecommerce_change_lines[] = array(
                        $salecraft_ecommerce_line
                    );
                }

                $salecraft_ecommerce_changelog_data[] = array(
                    'version' => $salecraft_ecommerce_version_number,
                    'date'    => '',
                    'changes' => $salecraft_ecommerce_change_lines,
                );
            }
        }


        if ( $salecraft_ecommerce_changelog_data ) {

            echo '<div class="salecraft-ecommerce-changelog">';

            foreach (
                $salecraft_ecommerce_changelog_data
                as $salecraft_ecommerce_entry
            ) {

                echo '<div class="salecraft-ecommerce-changelog-list-item">';

                echo '<div class="salecraft-ecommerce-changelog-list-head">';

                echo '<h4 class="salecraft-ecommerce-changelog-version">';
                echo 'Version: ' .
                    esc_html(
                        $salecraft_ecommerce_entry['version']
                    );
                echo '</h4>';

                if ( ! empty( $salecraft_ecommerce_entry['date'] ) ) {
                    echo '<p class="salecraft-ecommerce-changelog-date">';
                    echo esc_html(
                        $salecraft_ecommerce_entry['date']
                    );
                    echo '</p>';
                }

                echo '</div>';

                echo '<div class="salecraft-ecommerce-changelog-change">';

                foreach (
                    $salecraft_ecommerce_entry['changes']
                    as $salecraft_ecommerce_changes
                ) {

                    echo '<div class="salecraft-ecommerce-changelog-change-item">';

                    echo '<div class="salecraft-ecommerce-changelog-change-list">';

                    foreach (
                        $salecraft_ecommerce_changes
                        as $salecraft_ecommerce_change
                    ) {

                        echo '<p class="salecraft-ecommerce-changelog-change-desc">';
                        echo esc_html( $salecraft_ecommerce_change );
                        echo '</p>';
                    }

                    echo '</div>';
                    echo '</div>';
                }

                echo '</div>';
                echo '</div>';
            }

            echo '</div>';

        } else {

            echo '<p>No changelog data available.</p>';
        }

    } else {

        echo '<p>Readme.txt file not found.</p>';
    }
    ?>
</div>
        </div>
        <?php
    }
}
SaleCraft_Ecommerce_Dashboard::instance();
