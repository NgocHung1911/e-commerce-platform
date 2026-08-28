<?php
/**
 * Plugin Name: Quản lý Hóa Đơn & Lịch Sử Đơn Hàng (Bill Manager)
 * Plugin URI: https://example.com/
 * Description: Plugin quản lý Chi tiết Hóa Đơn bán hàng và Lịch sử tất cả đơn hàng cho khách hàng.
 * Version: 1.0.0
 * Author: Antigravity
 */

if (!defined('ABSPATH')) {
    exit;
}

function cpm_bill_create_pages() {
    if (get_option('cpm_bill_pages_created_v1') !== 'yes') {
        $invoice_slug = 'hoa-don';
        if (!get_page_by_path($invoice_slug)) {
            wp_insert_post(array(
                'post_title'   => 'Hóa đơn đơn hàng',
                'post_content' => '<!-- wp:shortcode -->[cpm_order_detail]<!-- /wp:shortcode -->',
                'post_status'  => 'publish',
                'post_type'    => 'page',
                'post_name'    => $invoice_slug
            ));
        }

        $history_slug = 'lich-su-don-hang';
        if (!get_page_by_path($history_slug)) {
            wp_insert_post(array(
                'post_title'   => 'Lịch sử đơn hàng',
                'post_content' => '<!-- wp:shortcode -->[cpm_my_orders]<!-- /wp:shortcode -->',
                'post_status'  => 'publish',
                'post_type'    => 'page',
                'post_name'    => $history_slug
            ));
        }

        update_option('cpm_bill_pages_created_v1', 'yes');
    }
}
add_action('init', 'cpm_bill_create_pages');

function cpm_render_my_orders_shortcode() {
    ob_start();

    if (!is_user_logged_in()) {
        ?>
        <div class="max-w-[800px] mx-auto my-12 p-8 bg-white rounded-2xl border border-slate-200 text-center shadow-md font-sans box-border">
            <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">🔒</div>
            <h3 class="text-xl font-extrabold text-slate-900 mb-2">Vui lòng đăng nhập</h3>
            <p class="text-sm text-slate-500 mb-6">Bạn cần đăng nhập tài khoản để xem toàn bộ lịch sử đơn hàng và hóa đơn của mình.</p>
            <button type="button" onclick="if(typeof openCpmAuthModal==='function'){openCpmAuthModal('login');}else{window.location.href='<?php echo esc_url(wp_login_url(get_permalink())); ?>';}" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl shadow-md border-none cursor-pointer">🔑 Đăng nhập ngay</button>
        </div>
        <?php
        return ob_get_clean();
    }

    global $wpdb;
    $user_id = get_current_user_id();
    $tbl_orders = $wpdb->prefix . 'cpm_orders';
    $tbl_items = $wpdb->prefix . 'cpm_order_items';

    $orders = $wpdb->get_results($wpdb->prepare("SELECT * FROM $tbl_orders WHERE user_id = %d ORDER BY created_at DESC", $user_id));

    $total_orders = count($orders);
    $completed_orders = 0;
    $pending_orders = 0;
    $total_spent = 0;

    foreach ($orders as $ord) {
        if ($ord->order_status === 'completed') {
            $completed_orders++;
            $total_spent += floatval($ord->total_amount);
        } else {
            $pending_orders++;
        }
    }
    ?>
    <div class="max-w-[1100px] mx-auto my-8 px-4 font-sans text-slate-800 box-border">
        <!-- Header Banner Lịch Sử Đơn Hàng -->
        <div class="bg-gradient-to-r from-blue-900 via-indigo-900 to-slate-900 rounded-3xl p-6 md:p-8 text-white shadow-xl mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <span class="px-3 py-1 bg-white/10 backdrop-blur-md rounded-full text-xs font-bold uppercase tracking-wider text-blue-200 border border-white/10">Quản lý mua sắm</span>
                <h1 class="text-2xl md:text-3xl font-black mt-2">📋 Lịch Sử Đơn Hàng & Hóa Đơn</h1>
                <p class="text-xs md:text-sm text-slate-300 mt-1">Theo dõi tất cả đơn hàng đã mua, trạng thái thanh toán SePay và in hóa đơn chi tiết.</p>
            </div>
            <a href="<?php echo esc_url(home_url('/san-pham/')); ?>" class="px-5 py-3 bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white font-bold text-xs md:text-sm rounded-xl shadow-lg no-underline transition-all whitespace-nowrap">
                🛍️ Mua sắm thêm
            </a>
        </div>

        <!-- Các Thẻ Thống Kê Tổng Quan -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl font-bold">📦</div>
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase">Tổng đơn hàng</span>
                    <h3 class="text-xl font-black text-slate-900 mt-0.5"><?php echo $total_orders; ?> đơn</h3>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl font-bold">✅</div>
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase">Đã thanh toán</span>
                    <h3 class="text-xl font-black text-emerald-600 mt-0.5"><?php echo $completed_orders; ?> đơn</h3>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl font-bold">⏳</div>
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase">Chờ thanh toán</span>
                    <h3 class="text-xl font-black text-amber-600 mt-0.5"><?php echo $pending_orders; ?> đơn</h3>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl font-bold">💰</div>
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase">Tổng chi tiêu</span>
                    <h3 class="text-lg md:text-xl font-black text-purple-600 mt-0.5"><?php echo number_format($total_spent, 0, ',', '.'); ?> đ</h3>
                </div>
            </div>
        </div>

        <?php if (empty($orders)) : ?>
            <div class="bg-white rounded-2xl p-10 text-center border border-slate-100 shadow-sm max-w-lg mx-auto">
                <div class="w-20 h-20 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">
                    📦
                </div>
                <h3 class="text-2xl font-black text-slate-900 mb-2">Bạn chưa có đơn hàng nào</h3>
                <p class="text-sm text-slate-500 mb-6">Hãy lựa chọn những món hàng yêu thích và tạo đơn hàng đầu tiên ngay nhé!</p>
                <a href="<?php echo esc_url(home_url('/san-pham/')); ?>" class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl shadow-md transition-all no-underline">
                    🛍️ Khám phá sản phẩm
                </a>
            </div>
        <?php else : ?>
            <!-- Danh Sách Đơn Hàng Card List -->
            <div class="space-y-4">
                <?php foreach ($orders as $ord) : 
                    $order_items = $wpdb->get_results($wpdb->prepare("SELECT * FROM $tbl_items WHERE order_id = %d", $ord->id));
                    $item_count = count($order_items);
                    $invoice_url = add_query_arg('order_code', $ord->order_code, home_url('/hoa-don/'));
                    $is_completed = ($ord->order_status === 'completed');
                ?>
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-all p-5 md:p-6">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 pb-4 border-b border-slate-100">
                            <div>
                                <div class="flex items-center gap-3">
                                    <a href="<?php echo esc_url($invoice_url); ?>" class="font-black text-slate-900 text-lg hover:text-blue-600 transition-colors no-underline">#<?php echo esc_html($ord->order_code); ?></a>
                                    <span class="text-xs text-slate-400 font-semibold">📅 <?php echo date('d/m/Y H:i', strtotime($ord->created_at)); ?></span>
                                </div>
                                <p class="text-xs text-slate-500 mt-1">
                                    👤 Người nhận: <strong class="text-slate-800"><?php echo esc_html($ord->customer_name); ?></strong> (<?php echo esc_html($ord->customer_phone); ?>)
                                </p>
                            </div>

                            <div class="flex items-center gap-3 w-full md:w-auto justify-between md:justify-end">
                                <span class="px-3 py-1 rounded-full text-xs font-bold <?php echo $is_completed ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200'; ?>">
                                    <?php echo $is_completed ? '✅ Đã thanh toán' : '⏳ Đang chờ thanh toán'; ?>
                                </span>
                                <span class="text-base md:text-lg font-black text-red-600">
                                    <?php echo number_format($ord->total_amount, 0, ',', '.'); ?> đ
                                </span>
                            </div>
                        </div>

                        <!-- Danh sách các món trong đơn -->
                        <div class="py-3 divide-y divide-slate-50">
                            <?php foreach (array_slice($order_items, 0, 3) as $itm) : ?>
                                <div class="py-1.5 flex justify-between text-xs text-slate-600">
                                    <span>▫️ <?php echo esc_html($itm->product_name); ?> <strong class="text-slate-800">x<?php echo $itm->quantity; ?></strong></span>
                                    <span class="font-semibold text-slate-700"><?php echo number_format($itm->subtotal, 0, ',', '.'); ?> đ</span>
                                </div>
                            <?php endforeach; ?>
                            <?php if ($item_count > 3) : ?>
                                <p class="text-[11px] text-slate-400 pt-1 font-semibold">+ Và <?php echo ($item_count - 3); ?> sản phẩm khác...</p>
                            <?php endif; ?>
                        </div>

                        <!-- Thao tác nút bấm -->
                        <div class="flex flex-wrap items-center justify-end gap-3 pt-3 border-t border-slate-100">
                            <a href="<?php echo esc_url($invoice_url); ?>" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl no-underline transition-all flex items-center gap-1.5">
                                📄 Xem hóa đơn chi tiết
                            </a>
                            <?php if (!$is_completed && $ord->payment_method === 'vietqr') : ?>
                                <button type="button" onclick="cpmOpenOrderQrModal('<?php echo esc_js($ord->order_code); ?>', <?php echo floatval($ord->total_amount); ?>)" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold text-xs rounded-xl shadow-md border-none cursor-pointer flex items-center gap-1.5 transition-all">
                                    📲 Thanh toán ngay
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <script>
        function cpmOpenOrderQrModal(orderCode, amount) {
            const bankId = 'MB';
            const accountNo = '0393465113';
            const accountName = 'TRAN NGOC HUNG';
            const memo = 'THANH TOAN ' + orderCode;
            const vietqrUrl = `https://img.vietqr.io/image/${bankId}-${accountNo}-compact2.png?amount=${amount}&addInfo=${encodeURIComponent(memo)}&accountName=${encodeURIComponent(accountName)}`;
            const invoiceUrl = "<?php echo esc_url(home_url('/hoa-don/')); ?>" + "?order_code=" + orderCode;

            const qrOrderCodeEl = document.getElementById('cpmQrOrderCode');
            if (qrOrderCodeEl) qrOrderCodeEl.innerText = orderCode;

            const qrImgEl = document.getElementById('cpmQrImage');
            if (qrImgEl) qrImgEl.src = vietqrUrl;

            const bankNameEl = document.getElementById('cpmBankName');
            if (bankNameEl) bankNameEl.innerText = 'Ngân hàng MBBank';

            const accountNoEl = document.getElementById('cpmAccountNo');
            if (accountNoEl) accountNoEl.innerText = accountNo;

            const accountNameEl = document.getElementById('cpmAccountName');
            if (accountNameEl) accountNameEl.innerText = accountName;

            const totalAmountEl = document.getElementById('cpmQrTotalAmount');
            if (totalAmountEl) totalAmountEl.innerText = new Intl.NumberFormat('vi-VN').format(amount) + ' đ';

            const qrMemoEl = document.getElementById('cpmQrMemo');
            if (qrMemoEl) qrMemoEl.innerText = memo;

            const modal = document.getElementById('cpmVietQRModal');
            if (modal) modal.style.display = 'flex';

            if (typeof cpmStartSepayPolling === 'function') {
                cpmStartSepayPolling(orderCode, invoiceUrl);
            }
        }
    </script>
    <?php
    return ob_get_clean();
}
if (!function_exists('cpm_my_orders_shortcode_init')) {
    add_shortcode('cpm_my_orders', 'cpm_render_my_orders_shortcode');
    add_shortcode('cpm_order_history', 'cpm_render_my_orders_shortcode');
    add_shortcode('order_history', 'cpm_render_my_orders_shortcode');
}

/**
 * 3. Giao diện Shortcode Trang Chi Tiết Hóa Đơn Đơn Hàng [cpm_order_detail]
 */
function cpm_render_order_detail_shortcode() {
    ob_start();

    $order_code = isset($_GET['order_code']) ? sanitize_text_field($_GET['order_code']) : '';
    $order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
    $view_all = isset($_GET['view']) ? sanitize_text_field($_GET['view']) : '';

    if (!is_user_logged_in()) {
        ?>
        <div class="max-w-[800px] mx-auto my-12 p-8 bg-white rounded-2xl border border-slate-200 text-center shadow-md font-sans">
            <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">🔒</div>
            <h3 class="text-xl font-extrabold text-slate-900 mb-2">Vui lòng đăng nhập</h3>
            <p class="text-sm text-slate-500 mb-6">Bạn cần đăng nhập để xem thông tin chi tiết hóa đơn đơn hàng của mình.</p>
            <button type="button" onclick="if(typeof openCpmAuthModal==='function'){openCpmAuthModal('login');}else{window.location.href='<?php echo esc_url(wp_login_url(get_permalink())); ?>';}" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl shadow-md border-none cursor-pointer">🔑 Đăng nhập ngay</button>
        </div>
        <?php
        return ob_get_clean();
    }

    if ($view_all === 'all' || (empty($order_code) && $order_id <= 0)) {
        return cpm_render_my_orders_shortcode();
    }

    global $wpdb;
    $user_id = get_current_user_id();
    $tbl_orders = $wpdb->prefix . 'cpm_orders';
    $tbl_items = $wpdb->prefix . 'cpm_order_items';

    if (!empty($order_code)) {
        $order = $wpdb->get_row($wpdb->prepare("SELECT * FROM $tbl_orders WHERE order_code = %s AND user_id = %d", $order_code, $user_id));
    } elseif ($order_id > 0) {
        $order = $wpdb->get_row($wpdb->prepare("SELECT * FROM $tbl_orders WHERE id = %d AND user_id = %d", $order_id, $user_id));
    } else {
        $order = $wpdb->get_row($wpdb->prepare("SELECT * FROM $tbl_orders WHERE user_id = %d ORDER BY created_at DESC LIMIT 1", $user_id));
    }

    if (!$order) {
        ?>
        <div class="max-w-[800px] mx-auto my-12 p-8 bg-white rounded-2xl border border-slate-200 text-center shadow-md font-sans">
            <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">❌</div>
            <h3 class="text-xl font-extrabold text-slate-900 mb-2">Không tìm thấy hóa đơn</h3>
            <p class="text-sm text-slate-500 mb-6">Đơn hàng không tồn tại hoặc bạn không có quyền xem hóa đơn này.</p>
            <a href="<?php echo esc_url(home_url('/san-pham/')); ?>" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl shadow-md no-underline inline-block">🛍️ Tiếp tục mua sắm</a>
        </div>
        <?php
        return ob_get_clean();
    }

    $order_items = $wpdb->get_results($wpdb->prepare("SELECT * FROM $tbl_items WHERE order_id = %d", $order->id));
    ?>
    <div id="cpm-invoice-print-area" class="max-w-[900px] mx-auto my-8 p-6 md:p-10 bg-white rounded-3xl border border-slate-200 shadow-xl font-sans text-slate-800 box-border">
        <!-- Header Hóa Đơn -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center pb-6 border-b-2 border-slate-100 gap-4">
            <div>
                <span class="text-xs font-black uppercase tracking-wider text-blue-600 bg-blue-50 px-3 py-1 rounded-full">Hóa Đơn Bán Hàng SePay</span>
                <h1 class="text-2xl md:text-3xl font-black text-slate-900 mt-2">Mã đơn: #<?php echo esc_html($order->order_code); ?></h1>
                <p class="text-xs text-slate-500 mt-1">Ngày đặt: <?php echo date('d/m/Y H:i', strtotime($order->created_at)); ?></p>
            </div>
            <div class="text-left md:text-right">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <?php echo ($order->order_status === 'completed') ? '✅ SePay Đã Xác Nhận Thanh Toán' : '⏳ Đang chờ thanh toán'; ?>
                </span>
            </div>
        </div>

        <!-- Thông Tin Khách Hàng & Giao Hàng -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 my-6 p-5 bg-slate-50 rounded-2xl border border-slate-100 text-xs md:text-sm">
            <div>
                <h4 class="font-black text-slate-900 uppercase text-xs text-slate-400 mb-2">Thông tin người nhận</h4>
                <p class="font-bold text-slate-900 text-base"><?php echo esc_html($order->customer_name); ?></p>
                <p class="text-slate-600 mt-1">📞 Số điện thoại: <span class="font-semibold text-slate-900"><?php echo esc_html($order->customer_phone); ?></span></p>
                <p class="text-slate-600 mt-0.5">✉️ Email: <span class="font-semibold text-slate-900"><?php echo esc_html($order->customer_email); ?></span></p>
            </div>
            <div>
                <h4 class="font-black text-slate-900 uppercase text-xs text-slate-400 mb-2">Địa chỉ & Thanh toán</h4>
                <p class="text-slate-600">🏠 Địa chỉ: <span class="font-semibold text-slate-900"><?php echo esc_html($order->shipping_address); ?></span></p>
                <p class="text-slate-600 mt-1">💳 Hình thức: <span class="font-bold text-blue-600"><?php echo ($order->payment_method === 'vietqr') ? 'Quét mã VietQR Tự Động (SePay)' : 'Thanh toán COD khi nhận hàng'; ?></span></p>
            </div>
        </div>

        <!-- Bảng Chi Tiết Món Hàng -->
        <div class="overflow-x-auto mb-6">
            <table class="w-full text-left border-collapse text-xs md:text-sm">
                <thead>
                    <tr class="border-b-2 border-slate-200 text-slate-400 uppercase text-[11px] font-bold">
                        <th class="py-3 px-2">Sản phẩm</th>
                        <th class="py-3 px-2 text-center">Đơn giá</th>
                        <th class="py-3 px-2 text-center">Số lượng</th>
                        <th class="py-3 px-2 text-right">Thành tiền</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php foreach ($order_items as $itm) : ?>
                        <tr>
                            <td class="py-3.5 px-2 font-bold text-slate-900"><?php echo esc_html($itm->product_name); ?></td>
                            <td class="py-3.5 px-2 text-center text-slate-700"><?php echo number_format($itm->price, 0, ',', '.'); ?> đ</td>
                            <td class="py-3.5 px-2 text-center font-bold text-slate-900">x<?php echo $itm->quantity; ?></td>
                            <td class="py-3.5 px-2 text-right font-black text-red-600"><?php echo number_format($itm->subtotal, 0, ',', '.'); ?> đ</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Khung Tổng Tiền -->
        <div class="flex flex-col md:flex-row justify-between items-center pt-4 border-t-2 border-slate-200 gap-4">
            <div class="text-xs text-slate-400">
                <p>Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi!</p>
                <p>Mọi thắc mắc xin vui lòng liên hệ Hotline: <strong class="text-slate-700">+84 393 465 113</strong></p>
            </div>
            <div class="w-full md:w-auto text-right space-y-1">
                <div class="flex justify-between md:justify-end gap-6 text-xs text-slate-500">
                    <span>Phí vận chuyển:</span>
                    <span class="font-bold text-emerald-600">Miễn phí 🚚</span>
                </div>
                <div class="flex justify-between md:justify-end gap-6 text-base md:text-xl font-black text-slate-900 pt-2">
                    <span>Tổng tiền thanh toán:</span>
                    <span class="text-red-600"><?php echo number_format($order->total_amount, 0, ',', '.'); ?> đ</span>
                </div>
            </div>
        </div>

        <!-- Các Nút Thao Tác -->
        <div class="flex flex-wrap items-center justify-end gap-3 mt-8 pt-6 border-t border-slate-100 print:hidden">
            <a href="<?php echo esc_url(home_url('/lich-su-don-hang/')); ?>" class="px-5 py-2.5 bg-blue-50 hover:bg-blue-100 text-blue-700 font-bold text-xs md:text-sm rounded-xl no-underline transition-all inline-flex items-center gap-2">
                📋 Tất cả hóa đơn & Lịch sử
            </a>
            <button type="button" onclick="window.print()" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs md:text-sm rounded-xl transition-all border-none cursor-pointer flex items-center gap-2">
                🖨️ In hóa đơn này
            </button>
            <a href="<?php echo esc_url(home_url('/san-pham/')); ?>" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs md:text-sm rounded-xl shadow-md no-underline transition-all inline-block">
                🛍️ Tiếp tục mua sắm
            </a>
        </div>
    </div>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #cpm-invoice-print-area, #cpm-invoice-print-area * {
                visibility: visible;
            }
            #cpm-invoice-print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                box-shadow: none;
                border: none;
            }
            .print\:hidden {
                display: none !important;
            }
        }
    </style>
    <?php
    return ob_get_clean();
}
if (!function_exists('cpm_order_detail_shortcode_init')) {
    add_shortcode('cpm_order_detail', 'cpm_render_order_detail_shortcode');
    add_shortcode('order_detail', 'cpm_render_order_detail_shortcode');
}
