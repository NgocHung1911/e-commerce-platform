<?php
/**
 * Theme Template Part: Chi Tiết Hóa Đơn Bán Hàng
 * Path: wp-content/themes/e-commerce_platform/template-parts/cpm/invoice-detail.php
 */

if (!defined('ABSPATH')) {
    exit;
}
// Passed variables: $order, $order_items
?>
<div id="cpm-invoice-print-area" class="max-w-[900px] mx-auto my-8 p-6 md:p-10 bg-white rounded-3xl border border-slate-200 shadow-xl font-sans text-slate-800 box-border">
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
