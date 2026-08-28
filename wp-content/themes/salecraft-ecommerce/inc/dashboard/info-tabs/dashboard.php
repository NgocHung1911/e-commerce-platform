<?php
$theme = wp_get_theme();
$salecraft_ecommerce_link_icon = '<span class="svg-external-link"><i class="dashicons dashicons-arrow-right-alt"></i></span>';

$salecraft_ecommerce_admin_ur = admin_url();
function import_button_html() {

    $salecraft_ecommerce_btn_texts = __('View Starter Templates', 'salecraft-ecommerce');
    $salecraft_ecommerce_button_url = '#'; // Replace with actual starter templates URL if needed

    $salecraft_ecommerce_html = '<a class="btn-get-started" href="' . esc_url($salecraft_ecommerce_button_url) . '"
        aria-label="' . esc_attr($salecraft_ecommerce_btn_texts) . '">' .
        esc_html($salecraft_ecommerce_btn_texts) .
        '</a>';

    return $salecraft_ecommerce_html;
}

?>
    <div class="salecraft-ecommerce-dashboard-content">
        <div class="dashboard-content-panel content-panel-upper">
            <div class="postbox">
                <div class="inside salecraft-ecommerce-dashboard-welcome">
                    <div class="salecraft-ecommerce-notice-left">
                        <h2 class="salecraft-ecommerce-notice-heading">
                            <?php esc_html_e('Build Your Site with ', 'salecraft-ecommerce'); ?>
                            <?php echo esc_html($theme); ?>
                            <?php echo esc_html('!'); ?>
                        </h2>
                        <p><?php esc_html_e('Easily build your website using blocks and explore all the settings and features in one place.', 'salecraft-ecommerce'); ?></p>
                        <div class="dashboard-button-group">
                            <?php if (!$this->salecraft_ecommerce_pro_status) { ?>
                                <a href="<?php echo esc_url($this->salecraft_ecommerce_pro_theme_url); ?>"
                                   class="button button-secondary dashboard-button dashboard-button-primary"
                                   target="_blank">
                                    <?php esc_html_e('Go Pro', 'salecraft-ecommerce'); ?>
                                </a>
                            <?php } ?>
                            <a href="<?php echo esc_url($this->salecraft_ecommerce_preview_url); ?>"
                               class="button button-secondary dashboard-button dashboard-button-secondary"
                               target="_blank">
                                <?php esc_html_e('View Demo', 'salecraft-ecommerce'); ?>
                            </a>
                            <a href="<?php echo esc_url($this->salecraft_ecommerce_bundle_url); ?>"
                               class="button button-secondary dashboard-button dashboard-button-primary"
                               target="_blank">
                                <?php esc_html_e('Get the Bundle', 'salecraft-ecommerce'); ?>
                            </a>
                        </div>
                    </div>
                    <div class="salecraft-ecommerce-notice-right">
                        <div class="salecraft-ecommerce-intro-image">
                            <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/screenshot.png" alt="SaleCraft Ecommerce WordPress Theme">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-content-panel content-panel-lower">
            <div class="dashboard-content-left">
                <div class="postbox salecraft-ecommerce-premium-settings">
                    <div class="postbox-header">
                        <h2 class="hndle ui-sortable-handle"><?php esc_html_e('Premium Features', 'salecraft-ecommerce'); ?></h2>
                        <?php if (!$this->salecraft_ecommerce_pro_status) { ?>
                            <a href="<?php echo esc_url($this->salecraft_ecommerce_pro_theme_url); ?>"
                               class="hndle-controller salecraft-ecommerce-link" target="_blank">
                                <?php echo 'Upgrade Now' . $salecraft_ecommerce_link_icon; ?>
                            </a>
                        <?php } ?>
                    </div>
                    <div class="pro-discount-content">
                        <p class="pro-discount-text">
                           <?php echo esc_html__('Upgrade To Premium Just at ', 'salecraft-ecommerce');  ?> <span class="discount-price"><?php echo esc_html__('$69 ', 'salecraft-ecommerce');  ?></span><span><?php echo esc_html__('$45 ', 'salecraft-ecommerce');  ?></span>
                        </p>
                    </div>
                    <div class="dashboard-button-group features-bottom-btn">
                        <?php if (!$this->salecraft_ecommerce_pro_status) { ?>
                            <a href="<?php echo esc_url($this->salecraft_ecommerce_pro_theme_url); ?>"
                            class="button button-secondary dashboard-button dashboard-button-secondary"
                            target="_blank">
                                <?php esc_html_e('Go Pro', 'salecraft-ecommerce'); ?>
                            </a>
                        <?php } ?>
                        <a href="<?php echo esc_url($this->salecraft_ecommerce_preview_url); ?>"
                        class="button button-secondary dashboard-button dashboard-button-secondary"
                        target="_blank">
                            <?php esc_html_e('View Demo', 'salecraft-ecommerce'); ?>
                        </a>
                        <a href="<?php echo esc_url($this->salecraft_ecommerce_pro_doc_url); ?>"
                        class="button button-secondary dashboard-button dashboard-button-secondary"
                        target="_blank">
                            <?php esc_html_e('Premium Documentation', 'salecraft-ecommerce'); ?>
                        </a>
                    </div>
                    <div class="pro-distails-content">
                        <p class="pro-distails-text">
                           <?php echo esc_html__('Limited Time Offer - Get 20% OFF on Premium ', 'salecraft-ecommerce'); ?>
                           <?php echo esc_html($theme); ?><?php echo esc_html(' WordPress Themes | Use Code "FLAT20OFF"','salecraft-ecommerce'); ?>
                        </p>
                    </div>
                    <div class="inside salecraft-ecommerce-unavailable-settings">
                        <?php
                        // Array of premium features items
                        $salecraft_ecommerce_premium_features = array(
                            array(
                                'title' => esc_html__('Advanced Typography Controls', 'salecraft-ecommerce'),
                            ),
                            array(
                                'title' => esc_html__('Extended Color Settings', 'salecraft-ecommerce'),
                            ),
                            array(
                                'title' => esc_html__('Enhanced WooCommerce Features', 'salecraft-ecommerce'),
                            ),
                            array(
                                'title' => esc_html__('Optimized Performance & Speed', 'salecraft-ecommerce'),
                            ),
                            array(
                                'title' => esc_html__('Dedicated Priority Support', 'salecraft-ecommerce'),
                            ),
                            array(
                                'title' => esc_html__('Social Sharing Integration', 'salecraft-ecommerce'),
                            ),
                        );
                        // Loop through the premium features items
                        foreach ($salecraft_ecommerce_premium_features as $salecraft_ecommerce_item) {
                            ?>
                            <div class="salecraft-ecommerce-features-list salecraft-ecommerce-premium-features">
                                <div class="item-content-left">
                                    <h4><?php echo esc_html($salecraft_ecommerce_item['title']); ?></h4>
                                </div>
                                <div class="item-content-right">
                                    <img class="salecraft-ecommerce-premium-badge"
                                         src="<?php echo esc_url(get_template_directory_uri() . '/inc/dashboard/images/pro-img.png'); ?>"
                                         alt="<?php esc_attr_e('SaleCraft Ecommerce', 'salecraft-ecommerce'); ?>">
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="postbox salecraft-ecommerce-quick-settings">
                    <div class="postbox-header">
                        <h2 class="hndle ui-sortable-handle"><?php esc_html_e('Quick Settings', 'salecraft-ecommerce'); ?></h2>
                        <a href="<?php echo esc_url(' ' . $salecraft_ecommerce_admin_ur . 'site-editor.php'); ?>"
                           class="hndle-controller salecraft-ecommerce-link" target="_blank">
                            <?php echo 'Visit Editor' . $salecraft_ecommerce_link_icon; ?>
                        </a>
                    </div>
                    <div class="inside salecraft-ecommerce-available-settings">
                        <?php
                        $salecraft_ecommerce_current_theme = wp_get_theme();
                        $theme_slug    = $salecraft_ecommerce_current_theme->get('TextDomain');

                        // Array of settings items (now mapped for Site Editor)
                        $salecraft_ecommerce_settings_items = array(
                            array(
                                'title' => esc_html__('Site Identity', 'salecraft-ecommerce'),
                                'url'   => admin_url('customize.php?autofocus[section]=title_tagline'),
                            ),
                            array(
                                'title' => esc_html__('Header Options', 'salecraft-ecommerce'),
                                'url'   => admin_url('site-editor.php?path=%2Fpatterns&postType=wp_template_part&categoryId=header'),
                            ),
                            array(
                                'title' => esc_html__('Footer Options', 'salecraft-ecommerce'),
                                'url'   => admin_url('site-editor.php?path=%2Fpatterns&postType=wp_template_part&categoryId=footer'),
                            ),
                            array(
                                'title' => esc_html__('Archive Template', 'salecraft-ecommerce'),
                                'url'   => admin_url('site-editor.php?p=%2Fwp_template%2F' . $theme_slug . '%2F%2Farchive&canvas=edit'),
                            ),
                            array(
                                'title' => esc_html__('Single Template', 'salecraft-ecommerce'),
                                'url'   => admin_url('site-editor.php?p=%2Fwp_template%2F' . $theme_slug . '%2F%2Fsingle-post-sidebar-on-right&canvas=edit'),
                            ),
                            array(
                                'title' => esc_html__('Page Template', 'salecraft-ecommerce'),
                                'url'   => admin_url('site-editor.php?p=%2Fwp_template%2F' . $theme_slug . '%2F%2Fpage&canvas=edit'),
                            ),
                            array(
                                'title' => esc_html__('404 Template', 'salecraft-ecommerce'),
                                'url'   => admin_url('site-editor.php?p=%2Fwp_template%2F' . $theme_slug . '%2F%2F404&canvas=edit'),
                            ),
                        );

                        // Loop
                        foreach ($salecraft_ecommerce_settings_items as $salecraft_ecommerce_item) {
                            ?>
                            <a href="<?php echo esc_url($salecraft_ecommerce_item['url']); ?>" class="theme-editor-card" target="_blank">
                                <h4><?php echo esc_html($salecraft_ecommerce_item['title']); ?></h4>
                                <span><?php echo esc_html__('Start Edit', 'salecraft-ecommerce'); ?></span>
                                <i class="dashicons dashicons-arrow-right-alt"></i>
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="dashboard-content-right">
                <div class="postbox salecraft-ecommerce-bundle-box">
                    <div class="postbox-header">
                        <div class="head-img">
                            <img class="salecraft-ecommerce-premium-badge"
                                    src="<?php echo esc_url(get_template_directory_uri() . '/inc/dashboard/images/pro-img.png'); ?>"
                                    alt="<?php esc_attr_e('SaleCraft Ecommerce', 'salecraft-ecommerce'); ?>">
                        </div>
                        <div class="head-content">
                            <h3 class="hndle ui-sortable-handle">
                                <?php esc_html_e('Best Value - Get More, Save More!', 'salecraft-ecommerce'); ?>
                            </h3>
                            <p><?php esc_html_e('Unlock all our premium themes with exclusive discount.', 'salecraft-ecommerce'); ?></p>
                        </div>
                    </div>
                    <div class="inside">
                        <div class="item-content-left">
                            <img class="salecraft-ecommerce-bundle-badge"
                                    src="<?php echo esc_url(get_template_directory_uri() . '/inc/dashboard/images/bundle-image.png'); ?>"
                                    alt="<?php esc_attr_e('SaleCraft Ecommerce', 'salecraft-ecommerce'); ?>">
                        </div>
                        <div class="item-content-right">
                            <ul>
                                <li>
                                    <img class="list-check" src="<?php echo esc_url(get_template_directory_uri() . '/inc/dashboard/images/circle-check.png'); ?>" alt="<?php esc_attr_e('SaleCraft Ecommerce', 'salecraft-ecommerce'); ?>">
                                    <?php echo esc_html__('All Premium Themes', 'salecraft-ecommerce'); ?>
                                </li>
                                <li>
                                    <img class="list-check" src="<?php echo esc_url(get_template_directory_uri() . '/inc/dashboard/images/circle-check.png'); ?>" alt="<?php esc_attr_e('SaleCraft Ecommerce', 'salecraft-ecommerce'); ?>">
                                    <?php echo esc_html__('One Year of Updates', 'salecraft-ecommerce'); ?>
                                </li>
                                <li>
                                    <img class="list-check" src="<?php echo esc_url(get_template_directory_uri() . '/inc/dashboard/images/circle-check.png'); ?>" alt="<?php esc_attr_e('SaleCraft Ecommerce', 'salecraft-ecommerce'); ?>">
                                    <?php echo esc_html__('Premium Support', 'salecraft-ecommerce'); ?>
                                </li>
                                <li>
                                    <img class="list-check" src="<?php echo esc_url(get_template_directory_uri() . '/inc/dashboard/images/circle-check.png'); ?>" alt="<?php esc_attr_e('SaleCraft Ecommerce', 'salecraft-ecommerce'); ?>">
                                    <?php echo esc_html__('Lifetime Domain Usage', 'salecraft-ecommerce'); ?>
                                </li>
                                <li>
                                    <img class="list-check" src="<?php echo esc_url(get_template_directory_uri() . '/inc/dashboard/images/circle-check.png'); ?>" alt="<?php esc_attr_e('SaleCraft Ecommerce', 'salecraft-ecommerce'); ?>">
                                    <?php echo esc_html__('Future Themes Included', 'salecraft-ecommerce'); ?>
                                </li>
                                <li>
                                    <img class="list-check" src="<?php echo esc_url(get_template_directory_uri() . '/inc/dashboard/images/circle-check.png'); ?>" alt="<?php esc_attr_e('SaleCraft Ecommerce', 'salecraft-ecommerce'); ?>">
                                    <?php echo esc_html__('Exclusive Bundle Discount', 'salecraft-ecommerce'); ?>
                                </li>
                            </ul>
                            <div class="save-box">
                                <p class="special-text"><?php echo esc_html__('Special Price', 'salecraft-ecommerce'); ?></p>
                                <p class="save-text"><?php echo esc_html__('Save 20%', 'salecraft-ecommerce'); ?></p>
                            </div>
                            <div class="price-box">
                                <p class="sale-text"><?php echo esc_html__('$79', 'salecraft-ecommerce'); ?></p>
                                <p class="regular-text"><?php echo esc_html__('$279', 'salecraft-ecommerce'); ?></p>
                            </div>
                            <a href="<?php echo esc_url($this->salecraft_ecommerce_bundle_url); ?>"
                            target="_blank" class="bundle-btn"><?php esc_html_e('Explore Bundles   ', 'salecraft-ecommerce'); ?></a>
                        </div>
                    </div>
                </div>
                
                <div class="postbox salecraft-ecommerce-postbox-documentation">
                    <div class="postbox-header">
                        <h3 class="hndle ui-sortable-handle">
                            <?php esc_html_e('User Guide', 'salecraft-ecommerce'); ?>
                        </h3>
                        <div class="hndle-controller">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20"
                                 fill="none">
                                <path d="M12.584 1.66602H5.50065C5.05862 1.66602 4.6347 1.84161 4.32214 2.15417C4.00958 2.46673 3.83398 2.89065 3.83398 3.33268V16.666C3.83398 17.108 4.00958 17.532 4.32214 17.8445C4.6347 18.1571 5.05862 18.3327 5.50065 18.3327H15.5006C15.9427 18.3327 16.3666 18.1571 16.6792 17.8445C16.9917 17.532 17.1673 17.108 17.1673 16.666V6.24935L12.584 1.66602Z"
                                      stroke="#2563EB" stroke-width="1.5" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M12.166 1.66602V6.66602H17.166" stroke="#2563EB" stroke-width="1.5"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M13.8327 10.833H7.16602" stroke="#2563EB" stroke-width="1.5"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M13.8327 14.166H7.16602" stroke="#2563EB" stroke-width="1.5"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8.83268 7.5H7.16602" stroke="#2563EB" stroke-width="1.5"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                    <div class="inside">
                        <p>
                            <?php
                            echo esc_html__('Having an issue? Check our documentation for clear steps and help with using blocks and settings.', 'salecraft-ecommerce');
                            ?>
                        </p>
                        <a href="<?php echo esc_url($this->salecraft_ecommerce_doc_url); ?>"
                           target="_blank"><?php esc_html_e('User Guide', 'salecraft-ecommerce'); ?></a>
                    </div>
                </div>

                <div class="postbox salecraft-ecommerce-postbox-support">
                    <div class="postbox-header">
                        <h3 class="hndle ui-sortable-handle">
                            <?php esc_html_e('Support', 'salecraft-ecommerce'); ?>
                        </h3>
                        <div class="hndle-controller">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20"
                                 fill="none">
                                <path d="M3 11.6667H5.5C5.94203 11.6667 6.36595 11.8423 6.67851 12.1548C6.99107 12.4674 7.16667 12.8913 7.16667 13.3333V15.8333C7.16667 16.2754 6.99107 16.6993 6.67851 17.0118C6.36595 17.3244 5.94203 17.5 5.5 17.5H4.66667C4.22464 17.5 3.80072 17.3244 3.48816 17.0118C3.17559 16.6993 3 16.2754 3 15.8333V10C3 8.01088 3.79018 6.10322 5.1967 4.6967C6.60322 3.29018 8.51088 2.5 10.5 2.5C12.4891 2.5 14.3968 3.29018 15.8033 4.6967C17.2098 6.10322 18 8.01088 18 10V15.8333C18 16.2754 17.8244 16.6993 17.5118 17.0118C17.1993 17.3244 16.7754 17.5 16.3333 17.5H15.5C15.058 17.5 14.634 17.3244 14.3215 17.0118C14.0089 16.6993 13.8333 16.2754 13.8333 15.8333V13.3333C13.8333 12.8913 14.0089 12.4674 14.3215 12.1548C14.634 11.8423 15.058 11.6667 15.5 11.6667H18"
                                      stroke="#2563EB" stroke-width="1.66667" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                    <div class="inside">
                        <p>
                            <?php
                            echo sprintf(
                            /* translators: %s: Theme Name */
                                esc_html__(
                                    'Need help? Visit the WordPress.org support forum where the community is ready to assist you. While we focus on premium support for Pro users, we’re happy to help with basic questions about the free theme.',
                                    'salecraft-ecommerce'
                                )
                            );
                            ?>
                        </p>
                        <a href="<?php echo esc_url($this->salecraft_ecommerce_community_url); ?>" target="_blank">
                            <?php esc_html_e('Get Help', 'salecraft-ecommerce'); ?>
                        </a>
                    </div>
                </div>

                <div class="postbox salecraft-ecommerce-postbox-review">
                    <div class="postbox-header">
                        <h3 class="hndle ui-sortable-handle">
                            <?php esc_html_e('Leave us a Review', 'salecraft-ecommerce'); ?>
                        </h3>
                        <div class="hndle-controller">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20"
                                 fill="none">
                                <path d="M10.5001 1.66699L13.0751 6.88366L18.8334 7.72533L14.6667 11.7837L15.6501 17.517L10.5001 14.8087L5.35008 17.517L6.33341 11.7837L2.16675 7.72533L7.92508 6.88366L10.5001 1.66699Z"
                                      stroke="#2563EB" stroke-width="1.66667" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                    <div class="inside">
                        <p>
                            <?php
                            echo sprintf(
                            /* translators: %s: Theme Name. */
                                esc_html__('How was your experience with our theme? Did it meet your expectations? Share your feedback to help us improve.', 'salecraft-ecommerce'),
                                $theme->Name
                            );
                            ?>
                        </p>
                        <a href="<?php echo esc_url($this->salecraft_ecommerce_review_url); ?>"
                           target="_blank"><?php esc_html_e('Submit a Review', 'salecraft-ecommerce'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
