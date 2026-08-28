<?php
/**
 * Plugin Name: Quản lý Sản phẩm tùy chỉnh (Product Manager)
 * Plugin URI: https://example.com/
 * Description: Plugin quản lý sản phẩm tùy chỉnh cho WordPress, bao gồm Custom Post Type, Meta Box giá cả, chọn hình ảnh sản phẩm.
 * Version: 1.1.0
 * Author: Antigravity
 * Text Domain: product-manager
 */

if (!defined('ABSPATH')) {
    exit;
}

function cpm_admin_enqueue_scripts($hook) {
    global $post;
    if (($hook == 'post-new.php' || $hook == 'post.php') && get_post_type($post) == 'custom_product') {
        wp_enqueue_media();
    }
}
add_action('admin_enqueue_scripts', 'cpm_admin_enqueue_scripts');

function cpm_register_product_post_type() {
    $labels = array(
        'name'               => 'Sản phẩm',
        'singular_name'      => 'Sản phẩm',
        'menu_name'          => 'Sản phẩm',
        'name_admin_bar'     => 'Sản phẩm',
        'add_new'            => 'Thêm sản phẩm mới',
        'add_new_item'       => 'Thêm sản phẩm mới',
        'new_item'           => 'Sản phẩm mới',
        'edit_item'          => 'Chỉnh sửa sản phẩm',
        'view_item'          => 'Xem sản phẩm',
        'all_items'          => 'Tất cả sản phẩm',
        'search_items'       => 'Tìm kiếm sản phẩm',
        'not_found'          => 'Không tìm thấy sản phẩm nào',
        'not_found_in_trash' => 'Không có sản phẩm nào trong thùng rác'
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'san-pham'),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-cart',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'       => true,
    );

    register_post_type('custom_product', $args);

    if (get_option('cpm_flush_rewrite_v3') !== 'yes') {
        flush_rewrite_rules();
        update_option('cpm_flush_rewrite_v3', 'yes');
    }
}
add_action('init', 'cpm_register_product_post_type');

function cpm_add_product_meta_boxes() {
    add_meta_box(
        'cpm_product_details',
        'Thông tin chi tiết & Hình ảnh Sản phẩm',
        'cpm_product_details_meta_box_callback',
        'custom_product',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'cpm_add_product_meta_boxes');

function cpm_product_details_meta_box_callback($post) {
    wp_nonce_field('cpm_save_product_details', 'cpm_product_nonce');

    $price = get_post_meta($post->ID, '_product_price', true);
    $sale_price = get_post_meta($post->ID, '_product_sale_price', true);
    $sku = get_post_meta($post->ID, '_product_sku', true);
    $button_text = get_post_meta($post->ID, '_product_button_text', true);
    $image_url = get_post_meta($post->ID, '_product_image_url', true);

    if (empty($button_text)) {
        $button_text = 'Mua ngay';
    }
    ?>
    <style>
        .cpm-meta-field { margin-bottom: 18px; }
        .cpm-meta-field label { display: block; font-weight: 600; margin-bottom: 6px; }
        .cpm-meta-field input[type="text"], .cpm-meta-field input[type="number"] { width: 100%; max-width: 400px; padding: 6px 10px; border-radius: 4px; border: 1px solid #ccc; }
        .cpm-meta-desc { font-size: 12px; color: #666; margin-top: 4px; }
        .cpm-image-preview-container { display: flex; gap: 15px; align-items: center; }
        .cpm-image-preview-box { width: 120px; height: 120px; border: 2px dashed #cbd5e1; border-radius: 8px; overflow: hidden; display: flex; align-items: center; justify-content: center; background: #f8fafc; }
        .cpm-image-preview-box img { width: 100%; height: 100%; object-fit: cover; }
    </style>

    <div class="cpm-meta-field">
        <label>Hình ảnh sản phẩm:</label>
        <div class="cpm-image-preview-container">
            <div id="cpm_image_preview_box" class="cpm-image-preview-box">
                <?php if (!empty($image_url)) : ?>
                    <img src="<?php echo esc_url($image_url); ?>" alt="Preview" />
                <?php else : ?>
                    <span style="color: #94a3b8; font-size: 12px; text-align: center; padding: 5px;">Chưa chọn ảnh</span>
                <?php endif; ?>
            </div>
            <div>
                <input type="hidden" id="cpm_product_image_url" name="cpm_product_image_url" value="<?php echo esc_attr($image_url); ?>" />
                <button type="button" class="button button-primary" id="cpm_upload_image_btn">Chọn / Tải hình ảnh</button>
                <button type="button" class="button" id="cpm_remove_image_btn" style="<?php echo empty($image_url) ? 'display:none;' : ''; ?>">Xóa ảnh</button>
                <div class="cpm-meta-desc">Chọn hình ảnh sản phẩm từ Thư viện Media WordPress (hoặc tải ảnh từ máy tính).</div>
            </div>
        </div>
    </div>

    <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee;" />

    <div class="cpm-meta-field">
        <label for="cpm_product_price">Giá gốc (VNĐ):</label>
        <input type="number" id="cpm_product_price" name="cpm_product_price" value="<?php echo esc_attr($price); ?>" placeholder="Ví dụ: 500000" />
        <div class="cpm-meta-desc">Nhập số tiền tính theo VNĐ (ví dụ: 500000)</div>
    </div>

    <div class="cpm-meta-field">
        <label for="cpm_product_sale_price">Giá khuyến mãi (VNĐ - tùy chọn):</label>
        <input type="number" id="cpm_product_sale_price" name="cpm_product_sale_price" value="<?php echo esc_attr($sale_price); ?>" placeholder="Ví dụ: 390000" />
        <div class="cpm-meta-desc">Nếu nhập, giá khuyến mãi sẽ ưu tiên hiển thị và gắn nhãn Giảm giá.</div>
    </div>

    <div class="cpm-meta-field">
        <label for="cpm_product_sku">Mã sản phẩm (SKU):</label>
        <input type="text" id="cpm_product_sku" name="cpm_product_sku" value="<?php echo esc_attr($sku); ?>" placeholder="Ví dụ: SP-001" />
    </div>

    <div class="cpm-meta-field">
        <label for="cpm_product_button_text">Chữ trên nút mua hàng:</label>
        <input type="text" id="cpm_product_button_text" name="cpm_product_button_text" value="<?php echo esc_attr($button_text); ?>" placeholder="Mua ngay" />
    </div>

    <script>
    jQuery(document).ready(function($){
        var mediaUploader;
        $('#cpm_upload_image_btn').click(function(e) {
            e.preventDefault();
            if (mediaUploader) {
                mediaUploader.open();
                return;
            }
            mediaUploader = wp.media.frames.file_frame = wp.media({
                title: 'Chọn hình ảnh sản phẩm',
                button: { text: 'Sử dụng ảnh này' },
                multiple: false
            });
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#cpm_product_image_url').val(attachment.url);
                $('#cpm_image_preview_box').html('<img src="' + attachment.url + '" style="width: 100%; height: 100%; object-fit: cover;" />');
                $('#cpm_remove_image_btn').show();
            });
            mediaUploader.open();
        });

        $('#cpm_remove_image_btn').click(function(e) {
            e.preventDefault();
            $('#cpm_product_image_url').val('');
            $('#cpm_image_preview_box').html('<span style="color: #94a3b8; font-size: 12px; text-align: center; padding: 5px;">Chưa chọn ảnh</span>');
            $(this).hide();
        });
    });
    </script>
    <?php
}

function cpm_save_product_meta_data($post_id) {
    if (!isset($_POST['cpm_product_nonce']) || !wp_verify_nonce($_POST['cpm_product_nonce'], 'cpm_save_product_details')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['cpm_product_image_url'])) {
        update_post_meta($post_id, '_product_image_url', esc_url_raw($_POST['cpm_product_image_url']));
    }

    if (isset($_POST['cpm_product_price'])) {
        update_post_meta($post_id, '_product_price', sanitize_text_field($_POST['cpm_product_price']));
    }

    if (isset($_POST['cpm_product_sale_price'])) {
        update_post_meta($post_id, '_product_sale_price', sanitize_text_field($_POST['cpm_product_sale_price']));
    }

    if (isset($_POST['cpm_product_sku'])) {
        update_post_meta($post_id, '_product_sku', sanitize_text_field($_POST['cpm_product_sku']));
    }

    if (isset($_POST['cpm_product_button_text'])) {
        update_post_meta($post_id, '_product_button_text', sanitize_text_field($_POST['cpm_product_button_text']));
    }
}
add_action('save_post_custom_product', 'cpm_save_product_meta_data');

$plugins_dir = dirname(plugin_dir_path(__FILE__));

if (file_exists($plugins_dir . '/manager/moduleManager.php')) {
    require_once $plugins_dir . '/manager/moduleManager.php';
}
