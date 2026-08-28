<?php
if (!is_child_theme()) {
    $theme = wp_get_theme();
} else {
    $theme = wp_get_theme()->parent();
}
$salecraft_ecommerce_tick_mark = '<span class="compare-checkmark"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M5.37994 11.5537L5.7335 11.9073L6.08705 11.5537L13.887 3.75375C13.9296 3.71119 13.9703 3.7002 14.0002 3.7002C14.03 3.7002 14.0707 3.71119 14.1133 3.75375C14.1558 3.79631 14.1668 3.83698 14.1668 3.86686C14.1668 3.89675 14.1558 3.93742 14.1133 3.97998L5.84661 12.2466C5.80946 12.2838 5.79218 12.2918 5.78876 12.2933L5.7886 12.2934C5.78668 12.2943 5.7738 12.3002 5.7335 12.3002C5.6932 12.3002 5.68032 12.2943 5.67839 12.2934L5.67823 12.2933C5.67482 12.2918 5.65753 12.2838 5.62038 12.2466L1.88705 8.51331C1.84449 8.47075 1.8335 8.43008 1.8335 8.4002C1.8335 8.37031 1.84449 8.32964 1.88705 8.28708L1.54017 7.9402L1.88705 8.28708C1.92961 8.24452 1.97028 8.23353 2.00016 8.23353C2.03005 8.23353 2.07072 8.24452 2.11328 8.28708L5.37994 11.5537Z" stroke="#ffffff"/></svg></span>';
$salecraft_ecommerce_cross_mark = '<span class="compare-crossmark"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M12.7071 4.70711C13.0976 4.31658 13.0976 3.68342 12.7071 3.29289C12.3166 2.90237 11.6834 2.90237 11.2929 3.29289L8 6.58579L4.70711 3.29289C4.31658 2.90237 3.68342 2.90237 3.29289 3.29289C2.90237 3.68342 2.90237 4.31658 3.29289 4.70711L6.58579 8L3.29289 11.2929C2.90237 11.6834 2.90237 12.3166 3.29289 12.7071C3.68342 13.0976 4.31658 13.0976 4.70711 12.7071L8 9.41421L11.2929 12.7071C11.6834 13.0976 12.3166 13.0976 12.7071 12.7071C13.0976 12.3166 13.0976 11.6834 12.7071 11.2929L9.41421 8L12.7071 4.70711Z" fill="#ffffff"/></svg></span>';
?>
<div class="salecraft-ecommerce-dashboard-content free-vs-pro-page">
    <table class="salecraft-ecommerce-compare-table">
        <tbody>
        <?php
        $salecraft_ecommerce_show_free_pro = true;
        $salecraft_ecommerce_features = array(
            'General Features' => array(
                'showFreePro' => true,
                'items' => array(
                    array('Responsive', $salecraft_ecommerce_tick_mark, $salecraft_ecommerce_tick_mark),
                    array('Styling for all sections', $salecraft_ecommerce_tick_mark, $salecraft_ecommerce_tick_mark),
                    array('Social Icons Links', 'Limited', $salecraft_ecommerce_tick_mark),
                    array('Full Width Slider', $salecraft_ecommerce_tick_mark, $salecraft_ecommerce_tick_mark),
                    array('Woocommerce Supported', $salecraft_ecommerce_tick_mark, $salecraft_ecommerce_tick_mark),
                    array('Full Documentation', $salecraft_ecommerce_tick_mark, $salecraft_ecommerce_tick_mark),
                    array('Exclusive functionalities', $salecraft_ecommerce_cross_mark, $salecraft_ecommerce_tick_mark),
                    array('Google Fonts Support', $salecraft_ecommerce_cross_mark, $salecraft_ecommerce_tick_mark),
                    array('Photo Gallery Section', $salecraft_ecommerce_tick_mark, $salecraft_ecommerce_tick_mark),
                    array('Latest WordPress Compatibility', $salecraft_ecommerce_tick_mark, $salecraft_ecommerce_tick_mark),
                    array('Supports 3rd Party Plugins', $salecraft_ecommerce_tick_mark, $salecraft_ecommerce_tick_mark),
                    array('Secure and Optimized Code', $salecraft_ecommerce_cross_mark, $salecraft_ecommerce_tick_mark),
                    array('Simple Menu Option', $salecraft_ecommerce_cross_mark, $salecraft_ecommerce_tick_mark),
                    array('Custom CSS/JS', $salecraft_ecommerce_cross_mark, $salecraft_ecommerce_tick_mark),
                    array('All Acess Theme pass', $salecraft_ecommerce_cross_mark, $salecraft_ecommerce_tick_mark),
                    array('Shortcodes', $salecraft_ecommerce_cross_mark, $salecraft_ecommerce_tick_mark),
                    array('Google Map', $salecraft_ecommerce_cross_mark, $salecraft_ecommerce_tick_mark),
                    array('Newsletter Section', $salecraft_ecommerce_cross_mark, $salecraft_ecommerce_tick_mark),
                    array('Priority error Fixing', $salecraft_ecommerce_cross_mark, $salecraft_ecommerce_tick_mark),
                    array('Access to multiple theme design', $salecraft_ecommerce_cross_mark, $salecraft_ecommerce_tick_mark),
                    array('Seamless customer support', $salecraft_ecommerce_cross_mark, $salecraft_ecommerce_tick_mark),
                    array('Premium membership for 1 Year', $salecraft_ecommerce_cross_mark, $salecraft_ecommerce_tick_mark),
                    array('','' ,'<div class="dashboard-button-group">
                                                            <a href="https://www.themebee.net/products/ecommerce-wordpress-theme/" class="button button-secondary dashboard-button dashboard-button-primary" target="_blank">
                                    Go Pro                                </a>
                        </div>' ),
                ),
            ),
        );
        foreach ($salecraft_ecommerce_features as $salecraft_ecommerce_category => $salecraft_ecommerce_feature) :
            $salecraft_ecommerce_show_free_pro = $salecraft_ecommerce_feature['showFreePro'];
            ?>
            <tr class="compare-table-head">
                <td><?php $salecraft_ecommerce_category; ?></td>
                <?php if ($salecraft_ecommerce_show_free_pro) : ?>
                    <td><?php esc_html_e('Free', 'salecraft-ecommerce'); ?></td>
                    <td><?php esc_html_e('Pro', 'salecraft-ecommerce'); ?></td>
                <?php endif; ?>
            </tr>
            <?php foreach ($salecraft_ecommerce_feature['items'] as $salecraft_ecommerce_item) : ?>
            <tr>
                <td><?php echo esc_html($salecraft_ecommerce_item[0]); ?></td>
                <td><?php echo $salecraft_ecommerce_item[1]; ?></td>
                <td><?php echo $salecraft_ecommerce_item[2]; ?></td>
            </tr>
        <?php endforeach; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
