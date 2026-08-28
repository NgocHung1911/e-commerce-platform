<?php
$theme = wp_get_theme();
?>
<div class="salecraft-ecommerce-dashboard-content salecraft-ecommerce-help-panel">
    <div class="dashboard-content-panel content-panel-lower">
        <div class="dashboard-content-left">
            <div class="salecraft-ecommerce-support-channels">
                <div class="postbox">
                    <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33" fill="none">
                        <path d="M19.833 3.00977H8.49967C7.79243 3.00977 7.11415 3.29072 6.61406 3.79081C6.11396 4.29091 5.83301 4.96919 5.83301 5.67643V27.0098C5.83301 27.717 6.11396 28.3953 6.61406 28.8954C7.11415 29.3955 7.79243 29.6764 8.49967 29.6764H24.4997C25.2069 29.6764 25.8852 29.3955 26.3853 28.8954C26.8854 28.3953 27.1663 27.717 27.1663 27.0098V10.3431L19.833 3.00977Z"
                              stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M19.1665 3.00977V11.0098H27.1665" stroke="#2563EB" stroke-width="2"
                              stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M21.8332 17.6758H11.1665" stroke="#2563EB" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round"/>
                        <path d="M21.8332 23.0098H11.1665" stroke="#2563EB" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round"/>
                        <path d="M13.8332 12.3428H11.1665" stroke="#2563EB" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                    <h3><?php esc_html_e('Explore Documentation', 'salecraft-ecommerce'); ?></h3>
                    <p><?php esc_html_e('Go through the documentation to understand how to use', 'salecraft-ecommerce'); ?> <?php echo esc_html($theme); ?> <?php echo esc_html('easily.','salecraft-ecommerce'); ?></p>

                    <a href="<?php echo esc_url($this->salecraft_ecommerce_doc_url); ?>" class="button button-secondary dashboard-button dashboard-button-primary" target="_blank">
                        <?php esc_html_e('View Now', 'salecraft-ecommerce'); ?>
                    </a>
                </div>
                <div class="postbox">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 33 33" fill="none">
                        <path d="M19.1667 20.3428V23.0094C19.1667 23.3631 19.0262 23.7022 18.7761 23.9523C18.5261 24.2023 18.187 24.3428 17.8333 24.3428H8.5L4.5 28.3428V15.0094C4.5 14.6558 4.64048 14.3167 4.89052 14.0666C5.14057 13.8166 5.47971 13.6761 5.83333 13.6761H8.5M28.5 19.0094L24.5 15.0094H15.1667C14.813 15.0094 14.4739 14.869 14.2239 14.6189C13.9738 14.3689 13.8333 14.0297 13.8333 13.6761V5.67611C13.8333 5.32248 13.9738 4.98335 14.2239 4.7333C14.4739 4.48325 14.813 4.34277 15.1667 4.34277H27.1667C27.5203 4.34277 27.8594 4.48325 28.1095 4.7333C28.3595 4.98335 28.5 5.32248 28.5 5.67611V19.0094Z" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <h3><?php esc_html_e('Support', 'salecraft-ecommerce'); ?></h3>
                    <p><?php esc_html_e('Need help? We’re happy to assist you with any queries related to ', 'salecraft-ecommerce'); ?><?php echo esc_html($theme); ?><?php esc_html_e('.', 'salecraft-ecommerce'); ?></p>
                    <a href="<?php echo esc_url($this->salecraft_ecommerce_community_url); ?>" class="button button-secondary dashboard-button dashboard-button-primary" target="_blank">
                        <?php esc_html_e('Get Help', 'salecraft-ecommerce'); ?>
                    </a>
                </div>
                <div class="postbox">
                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
                        <path d="M10.5001 1.66699L13.0751 6.88366L18.8334 7.72533L14.6667 11.7837L15.6501 17.517L10.5001 14.8087L5.35008 17.517L6.33341 11.7837L2.16675 7.72533L7.92508 6.88366L10.5001 1.66699Z"
                                stroke="#2563EB" stroke-width="1.66667" stroke-linecap="round"
                                stroke-linejoin="round"/>
                    </svg>
                    <h3><?php esc_html_e('Write a Review', 'salecraft-ecommerce'); ?></h3>
                    <p>
                        <?php
                        echo sprintf(
                            esc_html__('Share your feedback to help us improve your experience and make our theme more useful, user-friendly, and better suited to your needs.', 'salecraft-ecommerce'),
                            $theme->Name
                        );
                        ?>
                    </p>
                    <a href="<?php echo esc_url($this->salecraft_ecommerce_review_url); ?>" class="button button-secondary dashboard-button dashboard-button-primary" target="_blank"><?php esc_html_e('Submit a Review', 'salecraft-ecommerce'); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>