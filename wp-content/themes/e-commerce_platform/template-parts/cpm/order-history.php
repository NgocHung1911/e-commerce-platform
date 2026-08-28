<?php
/**
 * Theme Template Part: Trang Lịch Sử Đơn Hàng & Tất Cả Hóa Đơn
 * Path: wp-content/themes/e-commerce_platform/template-parts/cpm/order-history.php
 */

if (!defined('ABSPATH')) {
    exit;
}
// Passed variables: $orders, $total_orders, $completed_orders, $pending_orders, $total_spent, $tbl_items, $wpdb
?>
<div class="max-w-[1100px] mx-auto my-8 px-4 font-sans text-slate-800 box-border">
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
            <div class="w-20 h-20 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">📦</div>
            <h3 class="text-2xl font-black text-slate-900 mb-2">Bạn chưa có đơn hàng nào</h3>
            <p class="text-sm text-slate-500 mb-6">Hãy lựa chọn những món hàng yêu thích và tạo đơn hàng đầu tiên ngay nhé!</p>
            <a href="<?php echo esc_url(home_url('/san-pham/')); ?>" class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl shadow-md transition-all no-underline">
                🛍️ Khám phá sản phẩm
            </a>
        </div>
    <?php else : ?>
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
