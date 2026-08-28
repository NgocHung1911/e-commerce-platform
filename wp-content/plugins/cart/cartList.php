<?php
/**
 * Sub-module Quản lý Giỏ hàng & Form Thanh Toán VietQR SePay
 */

if (!defined('ABSPATH')) {
    exit;
}

function cpm_cart_and_orders_install_tables()
{
    global $wpdb;
    $table_cart = $wpdb->prefix . 'cpm_cart';
    $table_orders = $wpdb->prefix . 'cpm_orders';
    $table_items = $wpdb->prefix . 'cpm_order_items';
    $charset_collate = $wpdb->get_charset_collate();

    $sql_cart = "CREATE TABLE IF NOT EXISTS $table_cart (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        user_id bigint(20) NOT NULL,
        product_id bigint(20) NOT NULL,
        quantity int(11) NOT NULL DEFAULT 1,
        created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
        PRIMARY KEY  (id),
        KEY user_id (user_id),
        KEY product_id (product_id)
    ) $charset_collate;";

    $sql_orders = "CREATE TABLE IF NOT EXISTS $table_orders (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        order_code varchar(50) NOT NULL,
        user_id bigint(20) NOT NULL,
        customer_name varchar(255) NOT NULL,
        customer_phone varchar(50) NOT NULL,
        customer_email varchar(255) NOT NULL,
        shipping_address text NOT NULL,
        payment_method varchar(50) NOT NULL DEFAULT 'vietqr',
        order_status varchar(50) NOT NULL DEFAULT 'pending',
        total_amount decimal(15,2) NOT NULL DEFAULT 0.00,
        created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        PRIMARY KEY  (id),
        UNIQUE KEY order_code (order_code)
    ) $charset_collate;";

    $sql_items = "CREATE TABLE IF NOT EXISTS $table_items (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        order_id bigint(20) NOT NULL,
        product_id bigint(20) NOT NULL,
        product_name varchar(255) NOT NULL,
        price decimal(15,2) NOT NULL DEFAULT 0.00,
        quantity int(11) NOT NULL DEFAULT 1,
        subtotal decimal(15,2) NOT NULL DEFAULT 0.00,
        PRIMARY KEY  (id),
        KEY order_id (order_id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_cart);
    dbDelta($sql_orders);
    dbDelta($sql_items);
}
cpm_cart_and_orders_install_tables();

/**
 * 2. Tự động khởi tạo Trang "Giỏ hàng" (/gio-hang/)
 */
function cpm_cart_create_pages()
{
    if (get_option('cpm_cart_pages_created_v9') !== 'yes') {
        $cart_slug = 'gio-hang';
        if (!get_page_by_path($cart_slug)) {
            wp_insert_post(array(
                'post_title' => 'Giỏ hàng',
                'post_content' => '<!-- wp:shortcode -->[cpm_cart]<!-- /wp:shortcode -->',
                'post_status' => 'publish',
                'post_type' => 'page',
                'post_name' => $cart_slug
            ));
        }
        update_option('cpm_cart_pages_created_v9', 'yes');
    }
}
add_action('init', 'cpm_cart_create_pages');

/**
 * 3. SePay Webhook Listener (Dành cho Server thường hoặc Ngrok)
 */
function cpm_sepay_webhook_listener()
{
    if (isset($_GET['cpm_sepay_webhook']) || (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], 'cpm-sepay-webhook') !== false)) {
        $json_data = file_get_contents('php://input');
        $data = json_decode($json_data, true);

        if (!$data) {
            $data = $_POST;
        }

        if (!empty($data)) {
            $content = isset($data['content']) ? sanitize_text_field($data['content']) : '';
            $transfer_amount = isset($data['transferAmount']) ? floatval($data['transferAmount']) : 0;

            if (preg_match('/DH\d{6}/i', $content, $matches)) {
                $order_code = strtoupper($matches[0]);

                global $wpdb;
                $tbl_orders = $wpdb->prefix . 'cpm_orders';
                $order = $wpdb->get_row($wpdb->prepare("SELECT * FROM $tbl_orders WHERE order_code = %s", $order_code));

                if ($order && floatval($transfer_amount) >= floatval($order->total_amount)) {
                    $wpdb->update(
                        $tbl_orders,
                        array('order_status' => 'completed'),
                        array('id' => $order->id),
                        array('%s'),
                        array('%d')
                    );

                    wp_send_json(array(
                        'success' => true,
                        'message' => 'SePay Webhook: Đã xác nhận đơn hàng ' . $order_code . ' thanh toán thành công!'
                    ));
                    exit;
                }
            }
        }
        wp_send_json(array('success' => false, 'message' => 'SePay Webhook: Chưa khớp mã đơn hàng hoặc số tiền!'));
        exit;
    }
}
add_action('init', 'cpm_sepay_webhook_listener');
add_action('wp_ajax_nopriv_cpm_sepay_webhook', 'cpm_sepay_webhook_listener');

/**
 * 4. AJAX Handler: Đánh dấu đơn hàng đã thanh toán (Gọi từ nút "Tôi đã thanh toán")
 */
function cpm_ajax_mark_order_paid_handler()
{
    $order_code = isset($_GET['order_code']) ? sanitize_text_field($_GET['order_code']) : '';
    if (empty($order_code)) {
        wp_send_json_error(array('message' => 'Mã đơn hàng không hợp lệ.'));
    }

    global $wpdb;
    $tbl_orders = $wpdb->prefix . 'cpm_orders';
    $order = $wpdb->get_row($wpdb->prepare("SELECT * FROM $tbl_orders WHERE order_code = %s", $order_code));

    if ($order) {
        $wpdb->update(
            $tbl_orders,
            array('order_status' => 'completed'),
            array('id' => $order->id),
            array('%s'),
            array('%d')
        );
        $invoice_url = add_query_arg('order_code', $order_code, home_url('/hoa-don/'));
        wp_send_json_success(array('is_paid' => true, 'invoice_url' => $invoice_url));
    }

    wp_send_json_error(array('message' => 'Không tìm thấy đơn hàng.'));
}
add_action('wp_ajax_cpm_mark_order_paid', 'cpm_ajax_mark_order_paid_handler');
add_action('wp_ajax_nopriv_cpm_mark_order_paid', 'cpm_ajax_mark_order_paid_handler');

/**
 * 4.5. AJAX Handler: Kiểm tra trạng thái thanh toán đơn hàng
 */
function cpm_ajax_check_payment_status_handler()
{
    $order_code = isset($_GET['order_code']) ? sanitize_text_field($_GET['order_code']) : '';
    $force_check = isset($_GET['force_check']) ? intval($_GET['force_check']) : 0;

    if (empty($order_code)) {
        wp_send_json_error(array('is_paid' => false, 'message' => 'Mã đơn hàng không hợp lệ.'));
    }

    global $wpdb;
    $tbl_orders = $wpdb->prefix . 'cpm_orders';
    $order = $wpdb->get_row($wpdb->prepare("SELECT * FROM $tbl_orders WHERE order_code = %s", $order_code));

    if (!$order) {
        wp_send_json_error(array('is_paid' => false, 'message' => 'Không tìm thấy đơn hàng.'));
    }

    if ($order->order_status === 'completed') {
        $invoice_url = add_query_arg('order_code', $order_code, home_url('/hoa-don/'));
        wp_send_json_success(array('is_paid' => true, 'invoice_url' => $invoice_url));
    }

    if ($force_check === 1) {
        wp_send_json_success(array('is_paid' => false, 'message' => 'Đang kiểm tra với SePay...'));
    }

    wp_send_json_success(array('is_paid' => false));
}
add_action('wp_ajax_cpm_check_payment_status', 'cpm_ajax_check_payment_status_handler');
add_action('wp_ajax_nopriv_cpm_check_payment_status', 'cpm_ajax_check_payment_status_handler');

/**
 * 5. Lưu Cấu Hình SePay API Token trong WP Admin / Settings
 */
function cpm_save_sepay_token_option()
{
    if (isset($_POST['cpm_save_sepay_token_nonce']) && wp_verify_nonce($_POST['cpm_save_sepay_token_nonce'], 'cpm_save_sepay_token_action')) {
        if (isset($_POST['cpm_sepay_api_token'])) {
            $token = sanitize_text_field($_POST['cpm_sepay_api_token']);
            update_option('cpm_sepay_api_token', $token);
        }
    }
}
add_action('admin_init', 'cpm_save_sepay_token_option');

/**
 * 6. Thêm Menu "Cấu hình SePay" trong WP Admin
 */
function cpm_add_sepay_admin_menu()
{
    add_options_page(
        'Cấu hình SePay API Token',
        'Cấu hình SePay',
        'manage_options',
        'cpm-sepay-settings',
        'cpm_render_sepay_admin_page'
    );
}
add_action('admin_menu', 'cpm_add_sepay_admin_menu');

function cpm_render_sepay_admin_page()
{
    $current_token = get_option('cpm_sepay_api_token', '');
    ?>
    <div class="wrap"
        style="max-width: 800px; background: #fff; padding: 25px; border-radius: 12px; border: 1px solid #ccd0d4; margin-top: 20px;">
        <h2>⚙️ Cấu hình API Token SePay.vn</h2>
        <p>Để vượt qua tường lửa chống Robot của Hosting miễn phí (InfinityFree/iFastNet Firewall), bạn chỉ cần dán mã API
            Token SePay vào đây:</p>

        <?php if (isset($_POST['cpm_sepay_api_token'])): ?>
            <div class="notice notice-success is-dismissible" style="padding: 10px; margin-bottom: 15px;">
                <p><strong>✅ Đã lưu SePay API Token thành công!</strong> Hệ thống sẽ tự động quét thông tin chuyển khoản từ
                    SePay.</p>
            </div>
        <?php endif; ?>

        <form method="post" action="">
            <?php wp_nonce_field('cpm_save_sepay_token_action', 'cpm_save_sepay_token_nonce'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="cpm_sepay_api_token">SePay API Token / Key:</label></th>
                    <td>
                        <input type="text" id="cpm_sepay_api_token" name="cpm_sepay_api_token"
                            value="<?php echo esc_attr($current_token); ?>" class="regular-text" style="width: 100%;"
                            placeholder="SPTOKEN_xxxxxxxxxxxxxxxxx" />
                        <p class="description">Lấy mã API Token tại: <a href="https://my.sepay.vn/user/api-key"
                                target="_blank">https://my.sepay.vn/user/api-key</a></p>
                    </td>
                </tr>
            </table>
            <?php submit_button('Lưu Cấu Hình SePay'); ?>
        </form>
    </div>
    <?php
}

/**
 * 7. Nạp Scripts cho Giỏ Hàng & Thanh Toán
 */
function cpm_cart_enqueue_scripts()
{
    if (!wp_script_is('tailwind-cdn', 'enqueued')) {
        wp_enqueue_script('tailwind-cdn', 'https://cdn.tailwindcss.com', array(), '3.4.1', false);
    }
}
add_action('wp_enqueue_scripts', 'cpm_cart_enqueue_scripts');

/**
 * 8. AJAX Handler: Thêm sản phẩm vào giỏ (wp_ajax_cpm_add_to_cart)
 */
function cpm_ajax_add_to_cart_handler()
{
    check_ajax_referer('cpm_cart_nonce', 'security');

    if (!is_user_logged_in()) {
        wp_send_json_error(array(
            'require_login' => true,
            'message' => 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng!',
            'redirect_url' => wp_login_url(get_permalink())
        ));
    }

    $user_id = get_current_user_id();
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $quantity = isset($_POST['quantity']) ? max(1, intval($_POST['quantity'])) : 1;

    if ($product_id <= 0 && !empty($_POST['product_title'])) {
        $product_title = sanitize_text_field($_POST['product_title']);
        $product_post = get_page_by_title($product_title, OBJECT, 'custom_product');
        if ($product_post) {
            $product_id = $product_post->ID;
        }
    }

    if ($product_id <= 0) {
        wp_send_json_error(array('message' => 'Sản phẩm không hợp lệ!'));
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'cpm_cart';

    $existing = $wpdb->get_row($wpdb->prepare(
        "SELECT id, quantity FROM $table_name WHERE user_id = %d AND product_id = %d",
        $user_id,
        $product_id
    ));

    if ($existing) {
        $new_qty = $existing->quantity + $quantity;
        $wpdb->update(
            $table_name,
            array('quantity' => $new_qty, 'updated_at' => current_time('mysql')),
            array('id' => $existing->id),
            array('%d', '%s'),
            array('%d')
        );
    } else {
        $wpdb->insert(
            $table_name,
            array(
                'user_id' => $user_id,
                'product_id' => $product_id,
                'quantity' => $quantity,
                'created_at' => current_time('mysql'),
                'updated_at' => current_time('mysql')
            ),
            array('%d', '%d', '%d', '%s', '%s')
        );
    }

    $cart_count = $wpdb->get_var($wpdb->prepare(
        "SELECT SUM(quantity) FROM $table_name WHERE user_id = %d",
        $user_id
    ));

    wp_send_json_success(array(
        'message' => 'Đã thêm sản phẩm vào giỏ hàng thành công!',
        'cart_count' => intval($cart_count)
    ));
}
add_action('wp_ajax_cpm_add_to_cart', 'cpm_ajax_add_to_cart_handler');
add_action('wp_ajax_nopriv_cpm_add_to_cart', 'cpm_ajax_add_to_cart_handler');

/**
 * 9. AJAX Handler: Cập nhật số lượng sản phẩm (update_cart)
 */
function cpm_ajax_update_cart_handler()
{
    check_ajax_referer('cpm_cart_nonce', 'security');

    if (!is_user_logged_in()) {
        wp_send_json_error(array('message' => 'Bạn cần đăng nhập để thao tác!'));
    }

    $user_id = get_current_user_id();
    $cart_id = isset($_POST['cart_id']) ? intval($_POST['cart_id']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    global $wpdb;
    $table_name = $wpdb->prefix . 'cpm_cart';

    $cart_item = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM $table_name WHERE id = %d AND user_id = %d",
        $cart_id,
        $user_id
    ));

    if (!$cart_item) {
        wp_send_json_error(array('message' => 'Món hàng không tồn tại trong giỏ!'));
    }

    $is_removed = false;
    if ($quantity <= 0) {
        $wpdb->delete($table_name, array('id' => $cart_id, 'user_id' => $user_id), array('%d', '%d'));
        $is_removed = true;
    } else {
        $wpdb->update(
            $table_name,
            array('quantity' => $quantity, 'updated_at' => current_time('mysql')),
            array('id' => $cart_id, 'user_id' => $user_id),
            array('%d', '%s'),
            array('%d', '%d')
        );
    }

    $product_id = $cart_item->product_id;
    $price = get_post_meta($product_id, '_product_price', true);
    $sale_price = get_post_meta($product_id, '_product_sale_price', true);
    $unit_price = (!empty($sale_price) && floatval($sale_price) < floatval($price)) ? floatval($sale_price) : floatval($price);
    $item_subtotal = $unit_price * max(0, $quantity);

    $all_items = $wpdb->get_results($wpdb->prepare(
        "SELECT product_id, quantity FROM $table_name WHERE user_id = %d",
        $user_id
    ));

    $grand_total = 0;
    $total_quantity = 0;
    foreach ($all_items as $itm) {
        $p_price = get_post_meta($itm->product_id, '_product_price', true);
        $p_sale = get_post_meta($itm->product_id, '_product_sale_price', true);
        $u_price = (!empty($p_sale) && floatval($p_sale) < floatval($p_price)) ? floatval($p_sale) : floatval($p_price);
        $grand_total += ($u_price * $itm->quantity);
        $total_quantity += $itm->quantity;
    }

    wp_send_json_success(array(
        'message' => $is_removed ? 'Đã xóa sản phẩm khỏi giỏ hàng!' : 'Đã cập nhật số lượng thành công!',
        'cart_id' => $cart_id,
        'quantity' => $quantity,
        'is_removed' => $is_removed,
        'item_subtotal_raw' => $item_subtotal,
        'item_subtotal_formatted' => number_format($item_subtotal, 0, ',', '.') . ' đ',
        'grand_total_formatted' => number_format($grand_total, 0, ',', '.') . ' đ',
        'cart_count' => intval($total_quantity),
        'item_count' => count($all_items),
        'is_empty' => (count($all_items) === 0)
    ));
}
add_action('wp_ajax_cpm_update_cart', 'cpm_ajax_update_cart_handler');

/**
 * 10. AJAX Handler: Xóa sản phẩm khỏi giỏ (remove_from_cart)
 */
function cpm_ajax_remove_from_cart_handler()
{
    check_ajax_referer('cpm_cart_nonce', 'security');

    if (!is_user_logged_in()) {
        wp_send_json_error(array('message' => 'Bạn cần đăng nhập để thao tác!'));
    }

    $user_id = get_current_user_id();
    $cart_id = isset($_POST['cart_id']) ? intval($_POST['cart_id']) : 0;

    global $wpdb;
    $table_name = $wpdb->prefix . 'cpm_cart';

    $deleted = $wpdb->delete(
        $table_name,
        array('id' => $cart_id, 'user_id' => $user_id),
        array('%d', '%d')
    );

    if (!$deleted) {
        wp_send_json_error(array('message' => 'Không thể xóa sản phẩm. Vui lòng thử lại!'));
    }

    $all_items = $wpdb->get_results($wpdb->prepare(
        "SELECT product_id, quantity FROM $table_name WHERE user_id = %d",
        $user_id
    ));

    $grand_total = 0;
    $total_quantity = 0;
    foreach ($all_items as $itm) {
        $p_price = get_post_meta($itm->product_id, '_product_price', true);
        $p_sale = get_post_meta($itm->product_id, '_product_sale_price', true);
        $u_price = (!empty($p_sale) && floatval($p_sale) < floatval($p_price)) ? floatval($p_sale) : floatval($p_price);
        $grand_total += ($u_price * $itm->quantity);
        $total_quantity += $itm->quantity;
    }

    wp_send_json_success(array(
        'message' => 'Đã xóa sản phẩm khỏi giỏ hàng!',
        'cart_id' => $cart_id,
        'grand_total_formatted' => number_format($grand_total, 0, ',', '.') . ' đ',
        'cart_count' => intval($total_quantity),
        'item_count' => count($all_items),
        'is_empty' => (count($all_items) === 0)
    ));
}
add_action('wp_ajax_cpm_remove_from_cart', 'cpm_ajax_remove_from_cart_handler');

/**
 * 11. AJAX Handler: Tạo Đơn Hàng & Chuẩn bị Mã QR VietQR SePay
 */
function cpm_ajax_checkout_handler()
{
    check_ajax_referer('cpm_cart_nonce', 'security');

    if (!is_user_logged_in()) {
        wp_send_json_error(array('message' => 'Vui lòng đăng nhập để tiến hành đặt hàng!'));
    }

    $user_id = get_current_user_id();
    $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $address = isset($_POST['address']) ? sanitize_textarea_field($_POST['address']) : '';
    $payment_method = isset($_POST['payment_method']) ? sanitize_text_field($_POST['payment_method']) : 'vietqr';

    if (empty($name) || empty($phone) || empty($address)) {
        wp_send_json_error(array('message' => 'Vui lòng nhập đầy đủ Họ tên, Số điện thoại và Địa chỉ giao hàng!'));
    }

    global $wpdb;
    $tbl_cart = $wpdb->prefix . 'cpm_cart';
    $tbl_orders = $wpdb->prefix . 'cpm_orders';
    $tbl_items = $wpdb->prefix . 'cpm_order_items';

    $selected_ids = isset($_POST['selected_cart_ids']) ? sanitize_text_field($_POST['selected_cart_ids']) : '';
    $cart_items = array();
    $ids_array = array();

    if (!empty($selected_ids)) {
        $raw_ids = explode(',', $selected_ids);
        foreach ($raw_ids as $rid) {
            $val = intval(trim($rid));
            if ($val > 0) {
                $ids_array[] = $val;
            }
        }
    }

    if (!empty($ids_array)) {
        $placeholders = implode(',', array_fill(0, count($ids_array), '%d'));
        $query_params = array_merge(array($user_id), $ids_array);
        $cart_items = $wpdb->get_results($wpdb->prepare(
            "SELECT * FROM $tbl_cart WHERE user_id = %d AND id IN ($placeholders)",
            $query_params
        ));
    } else {
        $cart_items = $wpdb->get_results($wpdb->prepare(
            "SELECT * FROM $tbl_cart WHERE user_id = %d",
            $user_id
        ));
    }

    if (empty($cart_items)) {
        wp_send_json_error(array('message' => 'Vui lòng chọn ít nhất 1 sản phẩm để tiến hành thanh toán!'));
    }

    $grand_total = 0;
    $order_items_data = array();

    foreach ($cart_items as $item) {
        $post_id = $item->product_id;
        $title = get_the_title($post_id);
        $price = get_post_meta($post_id, '_product_price', true);
        $sale_price = get_post_meta($post_id, '_product_sale_price', true);
        $unit_price = (!empty($sale_price) && floatval($sale_price) < floatval($price)) ? floatval($sale_price) : floatval($price);

        $subtotal = $unit_price * $item->quantity;
        $grand_total += $subtotal;

        $order_items_data[] = array(
            'product_id' => $post_id,
            'product_name' => $title,
            'price' => $unit_price,
            'quantity' => $item->quantity,
            'subtotal' => $subtotal
        );
    }

    $order_code = 'DH' . rand(1000, 9999) . rand(10, 99);

    $inserted_order = $wpdb->insert(
        $tbl_orders,
        array(
            'order_code' => $order_code,
            'user_id' => $user_id,
            'customer_name' => $name,
            'customer_phone' => $phone,
            'customer_email' => $email,
            'shipping_address' => $address,
            'payment_method' => $payment_method,
            'order_status' => ($payment_method === 'cod') ? 'completed' : 'pending',
            'total_amount' => $grand_total,
            'created_at' => current_time('mysql')
        ),
        array('%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%f', '%s')
    );

    if (!$inserted_order) {
        wp_send_json_error(array('message' => 'Không thể tạo đơn hàng. Vui lòng thử lại!'));
    }

    $order_id = $wpdb->insert_id;

    foreach ($order_items_data as $itm) {
        $wpdb->insert(
            $tbl_items,
            array(
                'order_id' => $order_id,
                'product_id' => $itm['product_id'],
                'product_name' => $itm['product_name'],
                'price' => $itm['price'],
                'quantity' => $itm['quantity'],
                'subtotal' => $itm['subtotal']
            ),
            array('%d', '%d', '%s', '%f', '%d', '%f')
        );
    }

    if (!empty($ids_array)) {
        $placeholders = implode(',', array_fill(0, count($ids_array), '%d'));
        $delete_params = array_merge(array($user_id), $ids_array);
        $wpdb->query($wpdb->prepare(
            "DELETE FROM $tbl_cart WHERE user_id = %d AND id IN ($placeholders)",
            $delete_params
        ));
    } else {
        $wpdb->delete($tbl_cart, array('user_id' => $user_id), array('%d'));
    }

    $bank_id = 'MB';
    $account_no = '0393465113';
    $account_name = 'TRAN NGOC HUNG';
    $qr_memo = 'THANH TOAN ' . $order_code;

    $vietqr_url = "https://img.vietqr.io/image/{$bank_id}-{$account_no}-compact2.png?amount={$grand_total}&addInfo=" . urlencode($qr_memo) . "&accountName=" . urlencode($account_name);
    $invoice_url = add_query_arg('order_code', $order_code, home_url('/hoa-don/'));

    wp_send_json_success(array(
        'message' => 'Đặt hàng thành công!',
        'order_code' => $order_code,
        'order_id' => $order_id,
        'total_amount_formatted' => number_format($grand_total, 0, ',', '.') . ' đ',
        'payment_method' => $payment_method,
        'vietqr_url' => $vietqr_url,
        'bank_id' => $bank_id,
        'bank_name' => 'Ngân hàng MBBank',
        'account_no' => $account_no,
        'account_name' => $account_name,
        'qr_memo' => $qr_memo,
        'invoice_url' => $invoice_url
    ));
}
add_action('wp_ajax_cpm_checkout', 'cpm_ajax_checkout_handler');

/**
 * 12. Hiển thị Toast, Modal Xác Nhận Xóa, Floating Widgets & Modal SePay VietQR ở Footer
 */
function cpm_render_cart_footer_widgets()
{
    if (is_admin())
        return;

    $nonce = wp_create_nonce('cpm_cart_nonce');
    $ajax_url = admin_url('admin-ajax.php');
    $cart_url = home_url('/gio-hang/');
    $history_url = home_url('/lich-su-don-hang/');

    $cart_count = 0;
    if (is_user_logged_in()) {
        global $wpdb;
        $user_id = get_current_user_id();
        $table_name = $wpdb->prefix . 'cpm_cart';
        $cart_count = $wpdb->get_var($wpdb->prepare(
            "SELECT SUM(quantity) FROM $table_name WHERE user_id = %d",
            $user_id
        ));
    }
    $cart_count = intval($cart_count);
    ?>
    <!-- Toast Notification Container -->
    <div id="cpm-toast-container" class="fixed top-5 right-5 z-[999999] flex flex-col gap-3 pointer-events-none font-sans">
    </div>

    <!-- Floating Cart Button -->
    <a href="<?php echo esc_url($cart_url); ?>" id="cpm-floating-cart-btn"
        class="fixed bottom-6 right-6 z-[9999] flex items-center gap-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold text-xs md:text-sm px-4 py-3 rounded-full shadow-2xl hover:scale-105 transition-all duration-200 no-underline border border-white/20">
        <span class="text-base md:text-lg">🛒</span>
        <span>Giỏ hàng</span>
        <span id="cpm-cart-badge-count"
            class="bg-red-500 text-white text-xs font-black px-2 py-0.5 rounded-full min-w-[20px] text-center shadow-inner">
            <?php echo $cart_count; ?>
        </span>
    </a>

    <!-- Modal Xác Nhận Xóa Sản Phẩm Custom -->
    <div id="cpmDeleteConfirmModal" style="display: none;"
        class="fixed inset-0 z-[999999] flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4 animate-fadeIn font-sans">
        <div
            class="bg-white w-full max-w-sm rounded-2xl shadow-2xl border border-slate-100 p-6 text-center transform transition-all relative">
            <button type="button" onclick="closeCpmDeleteConfirmModal()"
                class="absolute top-3 right-3 text-slate-400 hover:text-slate-600 w-8 h-8 rounded-full flex items-center justify-center hover:bg-slate-100 transition-colors border-none cursor-pointer">
                ✕
            </button>
            <div
                class="w-14 h-14 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl shadow-inner">
                🗑️
            </div>
            <h3 class="text-lg font-black text-slate-900 mb-2">Xóa khỏi giỏ hàng?</h3>
            <p class="text-xs md:text-sm text-slate-500 mb-6">Bạn có chắc chắn muốn xóa sản phẩm này ra khỏi giỏ hàng của
                mình không?</p>

            <div class="flex items-center gap-3">
                <button type="button" onclick="closeCpmDeleteConfirmModal()"
                    class="flex-1 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs md:text-sm rounded-xl transition-all border-none cursor-pointer">
                    Hủy bỏ
                </button>
                <button type="button" onclick="executeCpmDeleteCartItem()"
                    class="flex-1 py-2.5 bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 text-white font-bold text-xs md:text-sm rounded-xl shadow-md hover:shadow-lg transition-all border-none cursor-pointer">
                    Đồng ý xóa
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Popup Quét Mã QR SePay / VietQR Tự Động Xác Nhận -->
    <div id="cpmVietQRModal" style="display: none;"
        class="fixed inset-0 z-[999999] flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4 animate-fadeIn font-sans">
        <div
            class="bg-white w-full max-w-md rounded-2xl shadow-2xl border border-slate-100 overflow-hidden relative transform transition-all">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-4 text-white flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="text-xl">📲</span>
                    <div>
                        <h3 class="text-base font-black leading-tight">Thanh toán SePay VietQR Tự Động</h3>
                        <p class="text-[11px] opacity-90">Mã đơn hàng: <span id="cpmQrOrderCode"
                                class="font-mono font-bold uppercase underline"></span></p>
                    </div>
                </div>
                <button type="button" onclick="closeCpmVietQRModal()"
                    class="text-white/80 hover:text-white w-8 h-8 rounded-full flex items-center justify-center hover:bg-white/20 transition-colors border-none cursor-pointer">
                    ✕
                </button>
            </div>

            <div class="p-6 text-center">
                <div id="cpmSepayStatusBox"
                    class="flex items-center justify-center gap-2 py-2 px-3 bg-blue-50 text-blue-700 rounded-xl text-xs font-bold border border-blue-100 mb-3 animate-pulse">
                    <span class="w-2 h-2 rounded-full bg-blue-600 animate-ping"></span>
                    <span>SePay đang tự động chờ chuyển khoản ngân hàng...</span>
                </div>

                <div class="inline-block p-3 bg-white rounded-2xl border-2 border-dashed border-blue-200 shadow-md mb-4">
                    <img id="cpmQrImage" src="" alt="Mã QR VietQR Thanh Toán"
                        class="w-60 h-60 object-contain mx-auto rounded-lg" />
                </div>

                <div class="bg-slate-50 rounded-xl p-4 text-left space-y-2 text-xs border border-slate-200 mb-2">
                    <div class="flex justify-between border-b border-slate-200 pb-1.5">
                        <span class="text-slate-500">Ngân hàng:</span>
                        <span id="cpmBankName" class="font-bold text-slate-900">MBBank (Ngân hàng Quân Đội)</span>
                    </div>
                    <div class="flex justify-between border-b border-slate-200 pb-1.5">
                        <span class="text-slate-500">Số tài khoản:</span>
                        <span id="cpmAccountNo" class="font-mono font-bold text-blue-600 text-sm">0393465113</span>
                    </div>
                    <div class="flex justify-between border-b border-slate-200 pb-1.5">
                        <span class="text-slate-500">Chủ tài khoản:</span>
                        <span id="cpmAccountName" class="font-bold text-slate-900 uppercase">TRAN NGOC HUNG</span>
                    </div>
                    <div class="flex justify-between border-b border-slate-200 pb-1.5">
                        <span class="text-slate-500">Số tiền thanh toán:</span>
                        <span id="cpmQrTotalAmount" class="font-black text-red-600 text-sm">0 đ</span>
                    </div>
                    <div class="flex justify-between pt-0.5">
                        <span class="text-slate-500">Nội dung chuyển khoản:</span>
                        <span id="cpmQrMemo" class="font-mono font-bold text-emerald-600">THANH TOAN...</span>
                    </div>
                </div>

                <button type="button" onclick="cpmManualCheckPayment()"
                    class="w-full mt-3 py-3.5 px-4 bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-600 hover:from-emerald-700 hover:to-teal-700 text-white font-black text-xs md:text-sm rounded-xl shadow-lg border-none cursor-pointer flex items-center justify-center gap-2 transition-all">
                    <span>✅ Tôi đã thanh toán (Xem hóa đơn ngay)</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Global JavaScript Helper -->
    <script>
        window.cpmCartGlobalAjaxUrl = window.cpmCartGlobalAjaxUrl || "<?php echo esc_url($ajax_url); ?>";
        window.cpmCartGlobalNonce = window.cpmCartGlobalNonce || "<?php echo esc_js($nonce); ?>";
        window.cpmSepayToken = window.cpmSepayToken || "<?php echo esc_js(trim(get_option('cpm_sepay_api_token', ''))); ?>";
        var cpmCartGlobalAjaxUrl = window.cpmCartGlobalAjaxUrl;
        var cpmCartGlobalNonce = window.cpmCartGlobalNonce;
        var cpmSepayToken = window.cpmSepayToken;

        let pendingCartIdToDelete = null;
        let cpmRedirectInvoiceUrl = "";
        let cpmCurrentOrderCode = "";
        let cpmPaymentPollingInterval = null;

        window.cpmManualCheckPayment = function () {
            if (!cpmCurrentOrderCode) return;
            if (cpmPaymentPollingInterval) {
                clearInterval(cpmPaymentPollingInterval);
            }

            if (typeof cpmShowToast === 'function') {
                cpmShowToast('⏳ Đang cập nhật trạng thái đơn hàng...', 'info');
            }

            fetch(cpmCartGlobalAjaxUrl + '?action=cpm_mark_order_paid&order_code=' + encodeURIComponent(cpmCurrentOrderCode))
                .then(res => res.json())
                .then(res => {
                    if (res.success) {
                        if (typeof cpmShowToast === 'function') {
                            cpmShowToast('🎉 Xác nhận thanh toán thành công! Đang chuyển đến Hóa đơn...', 'success');
                        }
                        setTimeout(() => {
                            window.location.href = res.data.invoice_url || cpmRedirectInvoiceUrl;
                        }, 500);
                    } else {
                        window.location.href = cpmRedirectInvoiceUrl;
                    }
                })
                .catch(err => {
                    window.location.href = cpmRedirectInvoiceUrl;
                });
        };

        window.cpmRemoveCartItem = function (cartId) {
            pendingCartIdToDelete = cartId;
            const modal = document.getElementById('cpmDeleteConfirmModal');
            if (modal) {
                modal.style.display = 'flex';
            }
        };

        window.closeCpmDeleteConfirmModal = function () {
            pendingCartIdToDelete = null;
            const modal = document.getElementById('cpmDeleteConfirmModal');
            if (modal) {
                modal.style.display = 'none';
            }
        };

        window.executeCpmDeleteCartItem = function () {
            if (!pendingCartIdToDelete) return;
            const cartId = pendingCartIdToDelete;
            closeCpmDeleteConfirmModal();

            const formData = new FormData();
            formData.append('action', 'cpm_remove_from_cart');
            formData.append('security', cpmCartGlobalNonce);
            formData.append('cart_id', cartId);

            fetch(cpmCartGlobalAjaxUrl, {
                method: 'POST',
                body: formData
            })
                .then(res => res.json())
                .then(res => {
                    if (res.success) {
                        const row = document.getElementById('cpm-cart-row-' + cartId);
                        if (row) row.remove();

                        if (res.data.is_empty) {
                            cpmRenderEmptyCartUI();
                        } else {
                            cpmUpdateCartDOMTotals(res.data);
                        }

                        if (typeof cpmShowToast === 'function') {
                            cpmShowToast(res.data.message, 'success');
                        }
                    } else {
                        if (typeof cpmShowToast === 'function') {
                            cpmShowToast(res.data.message || 'Lỗi xóa sản phẩm!', 'error');
                        }
                    }
                });
        };

        window.closeCpmVietQRModal = function () {
            if (cpmPaymentPollingInterval) {
                clearInterval(cpmPaymentPollingInterval);
            }
            const modal = document.getElementById('cpmVietQRModal');
            if (modal) modal.style.display = 'none';
        };

        window.cpmStartSepayPolling = function (orderCode, invoiceUrl) {
            cpmCurrentOrderCode = orderCode;
            cpmRedirectInvoiceUrl = invoiceUrl;

            if (cpmPaymentPollingInterval) {
                clearInterval(cpmPaymentPollingInterval);
            }

            cpmPaymentPollingInterval = setInterval(() => {
                fetch(cpmCartGlobalAjaxUrl + '?action=cpm_check_payment_status&order_code=' + encodeURIComponent(orderCode))
                    .then(res => res.json())
                    .then(res => {
                        if (res.success && res.data.is_paid) {
                            clearInterval(cpmPaymentPollingInterval);
                            if (typeof cpmShowToast === 'function') {
                                cpmShowToast('🎉 SePay báo nhận tiền thành công! Đang chuyển đến Hóa đơn...', 'success');
                            }
                            setTimeout(() => {
                                window.location.href = res.data.invoice_url || invoiceUrl;
                            }, 500);
                        }
                    })
                    .catch(err => { });
            }, 3000);
        };

        window.cpmShowToast = function (message, type = 'success') {
            const container = document.getElementById('cpm-toast-container');
            if (!container) return;

            const toast = document.createElement('div');
            toast.className = `pointer-events-auto flex items-center gap-3 px-4 py-3.5 rounded-2xl shadow-2xl text-xs md:text-sm font-bold text-white border border-white/20 animate-slideInRight transition-all ${type === 'success' ? 'bg-gradient-to-r from-emerald-600 to-teal-600' :
                type === 'error' ? 'bg-gradient-to-r from-rose-600 to-red-600' :
                    'bg-gradient-to-r from-blue-600 to-indigo-600'
            }`;

            const icon = type === 'success' ? '🎉' : type === 'error' ? '⚠️' : 'ℹ️';
            toast.innerHTML = `
                <span class="text-base">${icon}</span>
                <span>${message}</span>
            `;

            container.appendChild(toast);

            setTimeout(() => {
                toast.classList.remove('animate-slideInRight');
                toast.classList.add('animate-fadeOutRight');
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.parentNode.removeChild(toast);
                    }
                }, 350);
            }, 3000);
        };

        window.cpmAddToCart = function (productTitle, productId = 0, quantity = 1) {
            const formData = new FormData();
            formData.append('action', 'cpm_add_to_cart');
            formData.append('security', cpmCartGlobalNonce);
            formData.append('product_title', productTitle);
            formData.append('product_id', productId);
            formData.append('quantity', Math.max(1, parseInt(quantity) || 1));

            fetch(cpmCartGlobalAjaxUrl, {
                method: 'POST',
                body: formData
            })
                .then(res => res.json())
                .then(res => {
                    if (res.success) {
                        cpmShowToast(res.data.message, 'success');
                        const badge = document.getElementById('cpm-cart-badge-count');
                        if (badge && res.data.cart_count !== undefined) {
                            badge.innerText = res.data.cart_count;
                        }
                    } else {
                        if (res.data && res.data.require_login) {
                            cpmShowToast(res.data.message, 'error');
                            if (typeof openCpmAuthModal === 'function') {
                                openCpmAuthModal('login');
                            } else {
                                window.location.href = res.data.redirect_url;
                            }
                        } else {
                            cpmShowToast(res.data.message || 'Lỗi thêm sản phẩm!', 'error');
                        }
                    }
                })
                .catch(err => {
                    cpmShowToast('Không thể kết nối đến máy chủ. Vui lòng thử lại!', 'error');
                });
        };

        window.cpmBuyNow = function (productTitle, productId = 0, quantity = 1) {
            const reqQty = Math.max(1, parseInt(quantity) || 1);
            const formData = new FormData();
            formData.append('action', 'cpm_add_to_cart');
            formData.append('security', cpmCartGlobalNonce);
            formData.append('product_title', productTitle);
            formData.append('product_id', productId);
            formData.append('quantity', reqQty);

            if (typeof cpmShowToast === 'function') {
                cpmShowToast('⏳ Đang xử lý Mua ngay...', 'info');
            }

            fetch(cpmCartGlobalAjaxUrl, {
                method: 'POST',
                body: formData
            })
                .then(res => res.json())
                .then(res => {
                    if (res.success) {
                        const cartUrl = "<?php echo esc_url(home_url('/gio-hang/')); ?>";
                        window.location.href = cartUrl + '?buy_now=1&product_id=' + (productId || 0);
                    } else {
                        if (res.data && res.data.require_login) {
                            cpmShowToast(res.data.message, 'error');
                            if (typeof openCpmAuthModal === 'function') {
                                openCpmAuthModal('login');
                            } else {
                                window.location.href = res.data.redirect_url;
                            }
                        } else {
                            cpmShowToast(res.data.message || 'Lỗi xử lý Mua ngay!', 'error');
                        }
                    }
                })
                .catch(err => {
                    cpmShowToast('Không thể kết nối máy chủ!', 'error');
                });
        };
    </script>
    <?php
}
add_action('wp_footer', 'cpm_render_cart_footer_widgets');

/**
 * 13. Giao diện Shortcode Giỏ Hàng & Form Thanh Toán SePay VietQR [cpm_cart]
 */
function cpm_render_cart_shortcode()
{
    $nonce = wp_create_nonce('cpm_cart_nonce');
    $ajax_url = admin_url('admin-ajax.php');
    $current_user = wp_get_current_user();

    ob_start();
    ?>
    <div id="cpm-cart-wrapper" class="max-w-[1200px] mx-auto my-8 px-4 font-sans text-slate-800 box-border">
        <?php if (!is_user_logged_in()): ?>
            <!-- Trạng thái chưa đăng nhập -->
            <div class="bg-white rounded-2xl p-8 text-center border border-slate-200 shadow-md max-w-md mx-auto">
                <div
                    class="w-16 h-16 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                    🔒
                </div>
                <h3 class="text-xl font-extrabold text-slate-900 mb-2">Vui lòng đăng nhập</h3>
                <p class="text-sm text-slate-500 mb-6">Bạn cần đăng nhập tài khoản để xem và quản lý danh sách sản phẩm trong
                    giỏ hàng.</p>
                <button type="button"
                    onclick="if(typeof openCpmAuthModal==='function'){openCpmAuthModal('login');}else{window.location.href='<?php echo esc_url(wp_login_url(get_permalink())); ?>';}"
                    class="w-full py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold text-sm rounded-xl shadow-lg transition-all border-none cursor-pointer">
                    🔑 Đăng nhập / Đăng ký ngay
                </button>
            </div>
        <?php else:
            global $wpdb;
            $user_id = get_current_user_id();
            $table_name = $wpdb->prefix . 'cpm_cart';

            $cart_items = $wpdb->get_results($wpdb->prepare(
                "SELECT * FROM $table_name WHERE user_id = %d ORDER BY created_at DESC",
                $user_id
            ));

            if (empty($cart_items)): ?>
                <!-- Trạng thái Giỏ hàng Trống -->
                <div id="cpm-cart-empty-state"
                    class="bg-white rounded-2xl p-10 text-center border border-slate-100 shadow-sm max-w-lg mx-auto">
                    <div
                        class="w-20 h-20 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">
                        🛒
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-2">Giỏ hàng của bạn đang trống</h3>
                    <p class="text-sm text-slate-500 mb-6">Hãy khám phá danh sách sản phẩm và lựa chọn những món hàng ưng ý nhé!</p>
                    <a href="<?php echo esc_url(home_url('/san-pham/')); ?>"
                        class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl shadow-md transition-all no-underline">
                        🛍️ Tiếp tục mua sắm
                    </a>
                </div>
            <?php else: ?>
                <!-- Bảng Danh sách Giỏ hàng & Form Đặt Hàng -->
                <div id="cpm-cart-main-content">
                    <h1 id="cpm-cart-header-title"
                        class="text-2xl md:text-3xl font-black text-slate-900 mb-6 pb-3 border-b-2 border-slate-200">
                        Giỏ hàng của bạn (<span id="cpm-cart-distinct-count"><?php echo count($cart_items); ?></span> sản phẩm)
                    </h1>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                        <!-- Cột danh sách sản phẩm (2/3) -->
                        <div id="cpm-cart-items-list" class="lg:col-span-2 space-y-4">
                            <!-- Thanh Chọn tất cả sản phẩm -->
                            <div
                                class="bg-white rounded-2xl p-4 border border-slate-100 shadow-sm flex items-center justify-between">
                                <label class="flex items-center gap-3 text-sm font-bold text-slate-800 cursor-pointer">
                                    <input type="checkbox" id="cpm-cart-select-all" checked
                                        onchange="cpmToggleCartSelectAll(this.checked)"
                                        class="w-5 h-5 text-blue-600 rounded cursor-pointer accent-blue-600" />
                                    <span>Chọn tất cả (<span id="cpm-selected-items-count"><?php echo count($cart_items); ?></span>
                                        / <?php echo count($cart_items); ?> sản phẩm)</span>
                                </label>
                            </div>

                            <?php
                            $grand_total = 0;
                            $default_placeholder_svg = 'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="%23f1f5f9"/><text x="50%" y="55%" font-size="12" fill="%2394a3b8" text-anchor="middle">No Image</text></svg>';

                            foreach ($cart_items as $item):
                                $post_id = $item->product_id;
                                $product = get_post($post_id);
                                if (!$product || $product->post_status !== 'publish') {
                                    continue;
                                }

                                $title = get_the_title($post_id);
                                $price = get_post_meta($post_id, '_product_price', true);
                                $sale_price = get_post_meta($post_id, '_product_sale_price', true);
                                $sku = get_post_meta($post_id, '_product_sku', true);
                                $custom_img = get_post_meta($post_id, '_product_image_url', true);

                                $unit_price = (!empty($sale_price) && floatval($sale_price) < floatval($price)) ? floatval($sale_price) : floatval($price);
                                $item_subtotal = $unit_price * $item->quantity;
                                $grand_total += $item_subtotal;

                                if (!empty($custom_img)) {
                                    $img_src = esc_url($custom_img);
                                } elseif (has_post_thumbnail($post_id)) {
                                    $img_src = get_the_post_thumbnail_url($post_id, 'thumbnail');
                                } else {
                                    $img_src = $default_placeholder_svg;
                                }
                                ?>
                                <div id="cpm-cart-row-<?php echo $item->id; ?>"
                                    class="bg-white rounded-2xl p-4 md:p-5 border border-slate-100 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4 transition-all hover:shadow-md">
                                    <!-- Checkbox chọn sản phẩm & Ảnh & Tên sản phẩm -->
                                    <div class="flex items-center gap-3 w-full sm:w-auto">
                                        <input type="checkbox"
                                            class="cpm-cart-item-select w-5 h-5 text-blue-600 rounded cursor-pointer accent-blue-600 flex-shrink-0"
                                            data-cart-id="<?php echo $item->id; ?>" data-product-id="<?php echo $post_id; ?>"
                                            data-subtotal="<?php echo $item_subtotal; ?>" data-qty="<?php echo $item->quantity; ?>"
                                            checked onchange="cpmRecalculateSelectedCartTotals()" />

                                        <img src="<?php echo $img_src; ?>" alt="<?php echo esc_attr($title); ?>"
                                            class="w-16 h-16 md:w-20 md:h-20 object-contain rounded-xl bg-slate-50 border border-slate-200 p-2 flex-shrink-0" />
                                        <div>
                                            <a href="<?php echo get_permalink($post_id); ?>"
                                                class="text-sm md:text-base font-bold text-slate-900 hover:text-blue-600 transition-colors no-underline block line-clamp-2">
                                                <?php echo esc_html($title); ?>
                                            </a>
                                            <?php if (!empty($sku)): ?>
                                                <span class="text-xs text-slate-400 font-semibold">SKU: <?php echo esc_html($sku); ?></span>
                                            <?php endif; ?>
                                            <p class="text-sm font-extrabold text-blue-600 mt-1 sm:hidden">
                                                <?php echo number_format($unit_price, 0, ',', '.'); ?> đ
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Giá đơn vị (Desktop) -->
                                    <div class="hidden sm:block text-right">
                                        <span class="text-xs text-slate-400 block font-semibold">Đơn giá</span>
                                        <span class="text-sm font-bold text-slate-800">
                                            <?php echo number_format($unit_price, 0, ',', '.'); ?> đ
                                        </span>
                                    </div>

                                    <!-- Bộ tăng giảm số lượng -->
                                    <div class="flex items-center border border-slate-300 rounded-xl overflow-hidden bg-slate-50">
                                        <button type="button" onclick="cpmChangeCartQty(<?php echo $item->id; ?>, -1)"
                                            class="w-8 h-8 flex items-center justify-center text-slate-600 hover:bg-slate-200 font-bold border-none cursor-pointer">
                                            -
                                        </button>
                                        <input type="number" id="cpm-qty-input-<?php echo $item->id; ?>" min="1"
                                            value="<?php echo $item->quantity; ?>"
                                            onchange="cpmSetCartQty(<?php echo $item->id; ?>, this.value)"
                                            class="w-12 text-center text-sm font-bold bg-transparent border-none outline-none" />
                                        <button type="button" onclick="cpmChangeCartQty(<?php echo $item->id; ?>, 1)"
                                            class="w-8 h-8 flex items-center justify-center text-slate-600 hover:bg-slate-200 font-bold border-none cursor-pointer">
                                            +
                                        </button>
                                    </div>

                                    <!-- Thành tiền & Nút Xóa -->
                                    <div
                                        class="flex items-center justify-between sm:justify-end gap-4 w-full sm:w-auto pt-2 sm:pt-0 border-t sm:border-t-0 border-slate-100">
                                        <div class="text-right">
                                            <span class="text-xs text-slate-400 block font-semibold sm:hidden">Thành tiền</span>
                                            <span id="cpm-item-subtotal-<?php echo $item->id; ?>"
                                                class="text-base font-black text-red-600">
                                                <?php echo number_format($item_subtotal, 0, ',', '.'); ?> đ
                                            </span>
                                        </div>
                                        <button type="button" onclick="cpmRemoveCartItem(<?php echo $item->id; ?>)" title="Xóa sản phẩm"
                                            class="w-8 h-8 rounded-full bg-slate-100 hover:bg-red-100 text-slate-400 hover:text-red-600 flex items-center justify-center transition-colors border-none cursor-pointer">
                                            ✕
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Cột Thông Tin Giao Hàng & Đặt Hàng Thanh Toán SePay (1/3) -->
                        <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-md sticky top-6">
                            <h3 class="text-lg font-black text-slate-900 mb-4 pb-3 border-b border-slate-100">Thông tin đặt hàng
                            </h3>

                            <form id="cpmCheckoutForm" onsubmit="handleCpmCheckoutSubmit(event)">
                                <div class="space-y-3 text-xs mb-5">
                                    <div>
                                        <label class="block font-bold text-slate-700 mb-1">Họ và Tên người nhận *</label>
                                        <input type="text" id="cpmOrderName" required
                                            value="<?php echo esc_attr($current_user->display_name); ?>" placeholder="Nguyễn Văn A"
                                            class="w-full px-3 py-2 rounded-xl border border-slate-300 text-xs font-semibold outline-none focus:border-blue-500 box-border" />
                                    </div>
                                    <div>
                                        <label class="block font-bold text-slate-700 mb-1">Số điện thoại giao hàng *</label>
                                        <input type="tel" id="cpmOrderPhone" required placeholder="0987654321"
                                            class="w-full px-3 py-2 rounded-xl border border-slate-300 text-xs font-semibold outline-none focus:border-blue-500 box-border" />
                                    </div>
                                    <div>
                                        <label class="block font-bold text-slate-700 mb-1">Địa chỉ nhận hàng *</label>
                                        <textarea id="cpmOrderAddress" required rows="2"
                                            placeholder="Số nhà, Đường, Phường/Xã, Quận/Huyện..."
                                            class="w-full px-3 py-2 rounded-xl border border-slate-300 text-xs font-semibold outline-none focus:border-blue-500 box-border"></textarea>
                                    </div>
                                    <div>
                                        <label class="block font-bold text-slate-700 mb-1">Phương thức thanh toán *</label>
                                        <div class="space-y-2 pt-1">
                                            <label
                                                class="flex items-center gap-2 p-2.5 rounded-xl border border-blue-200 bg-blue-50/50 cursor-pointer font-bold text-blue-900">
                                                <input type="radio" name="cpmPaymentMethod" value="vietqr" checked
                                                    class="text-blue-600 focus:ring-blue-500" />
                                                <span>📲 Quét mã SePay VietQR (Tự Động)</span>
                                            </label>
                                            <label
                                                class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200 bg-slate-50/50 cursor-pointer font-bold text-slate-700">
                                                <input type="radio" name="cpmPaymentMethod" value="cod"
                                                    class="text-blue-600 focus:ring-blue-500" />
                                                <span>🚚 Thanh toán khi nhận hàng (COD)</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-2 mb-5 text-xs">
                                    <div class="flex justify-between text-slate-600">
                                        <span>Tạm tính (<span id="cpm-summary-item-count"><?php echo count($cart_items); ?></span>
                                            món):</span>
                                        <span id="cpm-summary-subtotal"
                                            class="font-bold text-slate-800"><?php echo number_format($grand_total, 0, ',', '.'); ?>
                                            đ</span>
                                    </div>
                                    <div class="flex justify-between text-slate-600">
                                        <span>Phí vận chuyển:</span>
                                        <span class="font-bold text-emerald-600">Miễn phí 🚚</span>
                                    </div>
                                    <div
                                        class="flex justify-between text-sm font-black text-slate-900 pt-2 border-t border-slate-100">
                                        <span>Tổng thanh toán:</span>
                                        <span id="cpm-summary-grand-total"
                                            class="text-lg text-red-600"><?php echo number_format($grand_total, 0, ',', '.'); ?>
                                            đ</span>
                                    </div>
                                </div>

                                <button type="submit" id="cpmSubmitCheckoutBtn"
                                    class="w-full py-4 px-5 bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-600 hover:from-emerald-700 hover:to-teal-700 text-white font-black text-sm md:text-base rounded-2xl shadow-xl shadow-teal-500/25 hover:shadow-2xl hover:shadow-teal-500/35 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 border-none cursor-pointer flex items-center justify-center gap-2 mb-3">
                                    <span>🚀 Thanh toán SePay VietQR Ngay</span>
                                </button>
                                <a href="<?php echo esc_url(home_url('/san-pham/')); ?>"
                                    class="block text-center text-xs font-bold text-blue-600 hover:text-blue-800 transition-colors no-underline">
                                    ← Chọn thêm sản phẩm khác
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <script>
        window.cpmCartTableAjaxUrl = window.cpmCartTableAjaxUrl || "<?php echo esc_url($ajax_url); ?>";
        window.cpmCartTableNonce = window.cpmCartTableNonce || "<?php echo esc_js($nonce); ?>";
        window.cpmUserEmail = window.cpmUserEmail || "<?php echo esc_js($current_user->user_email); ?>";
        var cpmCartTableAjaxUrl = window.cpmCartTableAjaxUrl;
        var cpmCartTableNonce = window.cpmCartTableNonce;
        var cpmUserEmail = window.cpmUserEmail;

        function handleCpmCheckoutSubmit(e) {
            e.preventDefault();
            const checkedBoxes = document.querySelectorAll('.cpm-cart-item-select:checked');
            if (checkedBoxes.length === 0) {
                if (typeof cpmShowToast === 'function') {
                    cpmShowToast('Vui lòng chọn ít nhất 1 sản phẩm để tiến hành thanh toán!', 'error');
                }
                return;
            }

            const selectedCartIds = Array.from(checkedBoxes).map(cb => cb.dataset.cartId).join(',');
            const name = document.getElementById('cpmOrderName').value;
            const phone = document.getElementById('cpmOrderPhone').value;
            const address = document.getElementById('cpmOrderAddress').value;
            const payMethodEl = document.querySelector('input[name="cpmPaymentMethod"]:checked');
            const payMethod = payMethodEl ? payMethodEl.value : 'vietqr';
            const btn = document.getElementById('cpmSubmitCheckoutBtn');

            btn.disabled = true;
            btn.innerHTML = '⏳ Đang khởi tạo đơn hàng SePay...';

            const formData = new FormData();
            formData.append('action', 'cpm_checkout');
            formData.append('security', cpmCartTableNonce);
            formData.append('selected_cart_ids', selectedCartIds);
            formData.append('name', name);
            formData.append('phone', phone);
            formData.append('email', cpmUserEmail);
            formData.append('address', address);
            formData.append('payment_method', payMethod);

            fetch(cpmCartTableAjaxUrl, {
                method: 'POST',
                body: formData
            })
                .then(res => res.json())
                .then(res => {
                    btn.disabled = false;
                    btn.innerHTML = '🚀 Thanh toán SePay VietQR Ngay';

                    if (res.success) {
                        cpmRedirectInvoiceUrl = res.data.invoice_url;

                        if (res.data.payment_method === 'vietqr') {
                            document.getElementById('cpmQrOrderCode').innerText = res.data.order_code;
                            document.getElementById('cpmQrImage').src = res.data.vietqr_url;
                            document.getElementById('cpmBankName').innerText = res.data.bank_name;
                            document.getElementById('cpmAccountNo').innerText = res.data.account_no;
                            document.getElementById('cpmAccountName').innerText = res.data.account_name;
                            document.getElementById('cpmQrTotalAmount').innerText = res.data.total_amount_formatted;
                            document.getElementById('cpmQrMemo').innerText = res.data.qr_memo;

                            const modal = document.getElementById('cpmVietQRModal');
                            if (modal) modal.style.display = 'flex';

                            if (typeof cpmStartSepayPolling === 'function') {
                                cpmStartSepayPolling(res.data.order_code, res.data.invoice_url);
                            }
                        } else {
                            if (typeof cpmShowToast === 'function') {
                                cpmShowToast('🎉 Đặt hàng thành công! Đang chuyển đến Hóa đơn...', 'success');
                            }
                            setTimeout(() => {
                                window.location.href = res.data.invoice_url;
                            }, 800);
                        }
                    } else {
                        if (typeof cpmShowToast === 'function') {
                            cpmShowToast(res.data.message || 'Lỗi đặt hàng!', 'error');
                        }
                    }
                })
                .catch(err => {
                    btn.disabled = false;
                    btn.innerHTML = '🚀 Thanh toán SePay VietQR Ngay';
                    if (typeof cpmShowToast === 'function') {
                        cpmShowToast('Không thể kết nối đến máy chủ!', 'error');
                    }
                });
        }

        function cpmChangeCartQty(cartId, delta) {
            const input = document.getElementById('cpm-qty-input-' + cartId);
            if (!input) return;
            let currentQty = parseInt(input.value) || 1;
            let newQty = currentQty + delta;
            if (newQty <= 0) {
                if (typeof cpmRemoveCartItem === 'function') {
                    cpmRemoveCartItem(cartId);
                }
                return;
            }
            cpmSetCartQty(cartId, newQty);
        }

        function cpmSetCartQty(cartId, newQty) {
            const input = document.getElementById('cpm-qty-input-' + cartId);
            const targetQty = parseInt(newQty) || 0;

            if (targetQty <= 0) {
                if (typeof cpmRemoveCartItem === 'function') {
                    cpmRemoveCartItem(cartId);
                }
                return;
            }

            const formData = new FormData();
            formData.append('action', 'cpm_update_cart');
            formData.append('security', cpmCartTableNonce);
            formData.append('cart_id', cartId);
            formData.append('quantity', targetQty);

            fetch(cpmCartTableAjaxUrl, {
                method: 'POST',
                body: formData
            })
                .then(res => res.json())
                .then(res => {
                    if (res.success) {
                        if (res.data.is_empty) {
                            cpmRenderEmptyCartUI();
                        } else if (res.data.is_removed) {
                            const row = document.getElementById('cpm-cart-row-' + cartId);
                            if (row) row.remove();
                            cpmUpdateCartDOMTotals(res.data);
                        } else {
                            if (input) input.value = res.data.quantity;
                            const subtotalEl = document.getElementById('cpm-item-subtotal-' + cartId);
                            if (subtotalEl) subtotalEl.innerText = res.data.item_subtotal_formatted;

                            const cb = document.querySelector(`.cpm-cart-item-select[data-cart-id="${cartId}"]`);
                            if (cb) {
                                cb.dataset.qty = res.data.quantity;
                                if (res.data.item_subtotal_raw !== undefined) {
                                    cb.dataset.subtotal = res.data.item_subtotal_raw;
                                }
                            }

                            cpmUpdateCartDOMTotals(res.data);
                        }
                        if (typeof cpmShowToast === 'function') {
                            cpmShowToast(res.data.message, 'success');
                        }
                    } else {
                        if (typeof cpmShowToast === 'function') {
                            cpmShowToast(res.data.message || 'Lỗi cập nhật số lượng!', 'error');
                        }
                    }
                })
                .catch(err => {
                    if (typeof cpmShowToast === 'function') {
                        cpmShowToast('Không thể kết nối đến máy chủ!', 'error');
                    }
                });
        }

        function cpmUpdateCartDOMTotals(data) {
            const distinctCount = document.getElementById('cpm-cart-distinct-count');
            const badgeCount = document.getElementById('cpm-cart-badge-count');

            if (distinctCount) distinctCount.innerText = data.item_count;
            if (badgeCount) badgeCount.innerText = data.cart_count;

            cpmRecalculateSelectedCartTotals();
        }

        window.cpmRecalculateSelectedCartTotals = function () {
            const checkboxes = document.querySelectorAll('.cpm-cart-item-select');
            const checkedBoxes = document.querySelectorAll('.cpm-cart-item-select:checked');
            const selectAllCb = document.getElementById('cpm-cart-select-all');

            if (selectAllCb) {
                selectAllCb.checked = (checkboxes.length > 0 && checkedBoxes.length === checkboxes.length);
            }

            let grandTotal = 0;
            let selectedItemCount = 0;

            checkedBoxes.forEach(cb => {
                const subtotal = parseFloat(cb.dataset.subtotal) || 0;
                grandTotal += subtotal;
                selectedItemCount++;
            });

            const summarySubtotal = document.getElementById('cpm-summary-subtotal');
            const summaryGrandTotal = document.getElementById('cpm-summary-grand-total');
            const summaryItemCount = document.getElementById('cpm-summary-item-count');
            const selectedItemsCount = document.getElementById('cpm-selected-items-count');
            const submitBtn = document.getElementById('cpmSubmitCheckoutBtn');

            const formattedTotal = new Intl.NumberFormat('vi-VN').format(grandTotal) + ' đ';

            if (summarySubtotal) summarySubtotal.innerText = formattedTotal;
            if (summaryGrandTotal) summaryGrandTotal.innerText = formattedTotal;
            if (summaryItemCount) summaryItemCount.innerText = selectedItemCount;
            if (selectedItemsCount) selectedItemsCount.innerText = selectedItemCount;

            if (submitBtn) {
                if (selectedItemCount === 0) {
                    submitBtn.disabled = true;
                    submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
                    submitBtn.innerText = '⚠️ Chọn sản phẩm để thanh toán';
                } else {
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                    submitBtn.innerText = '🚀 Thanh toán SePay VietQR Ngay (' + formattedTotal + ')';
                }
            }
        };

        window.cpmToggleCartSelectAll = function (isChecked) {
            const checkboxes = document.querySelectorAll('.cpm-cart-item-select');
            checkboxes.forEach(cb => {
                cb.checked = isChecked;
            });
            cpmRecalculateSelectedCartTotals();
        };

        document.addEventListener('DOMContentLoaded', function () {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('buy_now') === '1' && urlParams.get('product_id')) {
                const targetProdId = urlParams.get('product_id');
                const checkboxes = document.querySelectorAll('.cpm-cart-item-select');
                let targetFound = false;
                checkboxes.forEach(cb => {
                    if (cb.dataset.productId === targetProdId) {
                        cb.checked = true;
                        targetFound = true;
                    } else {
                        cb.checked = false;
                    }
                });
                if (targetFound) {
                    cpmRecalculateSelectedCartTotals();
                    const formBox = document.getElementById('cpmCheckoutForm');
                    if (formBox) {
                        formBox.scrollIntoView({ behavior: 'smooth' });
                    }
                }
            } else {
                cpmRecalculateSelectedCartTotals();
            }
        });

        function cpmRenderEmptyCartUI() {
            const wrapper = document.getElementById('cpm-cart-wrapper');
            const badgeCount = document.getElementById('cpm-cart-badge-count');
            if (badgeCount) badgeCount.innerText = '0';
            if (wrapper) {
                wrapper.innerHTML = `
                    <div id="cpm-cart-empty-state" class="bg-white rounded-2xl p-10 text-center border border-slate-100 shadow-sm max-w-lg mx-auto animate-slideInRight">
                        <div class="w-20 h-20 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">
                            🛒
                        </div>
                        <h3 class="text-2xl font-black text-slate-900 mb-2">Giỏ hàng của bạn đang trống</h3>
                        <p class="text-sm text-slate-500 mb-6">Hãy khám phá danh sách sản phẩm và lựa chọn những món hàng ưng ý nhé!</p>
                        <a href="<?php echo esc_url(home_url('/san-pham/')); ?>" class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl shadow-md transition-all no-underline">
                            🛍️ Tiếp tục mua sắm
                        </a>
                    </div>
                `;
            }
        }
    </script>
    <?php
    return ob_get_clean();
}

/**
 * 14. Đăng ký Shortcode Giỏ Hàng [cpm_cart] và [cart_list]
 */
add_shortcode('cpm_cart', 'cpm_render_cart_shortcode');
add_shortcode('cart_list', 'cpm_render_cart_shortcode');
