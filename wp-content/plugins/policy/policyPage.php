<?php
/**
 * Sub-module Trang Chính Sách Hệ Thống (System Policy Page)
 * File: policyPage.php
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!function_exists('cpm_render_policy_page_shortcode')) {
    /**
     * Shortcode Hiển thị Trang Chính Sách [cpm_policy_page] hoặc [chinh_sach_page]
     */
    function cpm_render_policy_page_shortcode() {
        ob_start();
        ?>
        <style id="cpm-policy-page-styles">
            .wp-block-group.alignfull,
            .entry-content > .wp-block-group,
            main#content {
                max-width: 100% !important;
                width: 100% !important;
            }
            .cpm-policy-card {
                scroll-margin-top: 100px;
            }
            .no-scrollbar::-webkit-scrollbar {
                display: none;
            }
            .no-scrollbar {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
        </style>
        <div id="cpm-policy-wrapper" class="w-full font-sans text-slate-800 box-border bg-slate-50/60 pb-16">
            <!-- 1. Hero Banner Top -->
            <div class="w-full bg-gradient-to-r from-slate-900 via-indigo-950 to-blue-950 text-white py-14 md:py-20 px-4 text-center relative overflow-hidden shadow-xl">
                <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="max-w-4xl mx-auto relative z-10 space-y-3">
                    <span class="inline-block px-4 py-1.5 bg-blue-500/20 text-blue-300 border border-blue-400/30 rounded-full text-xs font-bold uppercase tracking-wider">
                        Cam Kết Chất Lượng & Minh Bạch
                    </span>
                    <h1 class="text-3xl md:text-5xl font-black tracking-tight text-white">
                        Điều Khoản & Chính Sách Hệ Thống
                    </h1>
                    <p class="text-sm md:text-base text-slate-300 max-w-2xl mx-auto leading-relaxed">
                        Chúng tôi cam kết bảo vệ tuyệt đối quyền lợi khách hàng, minh bạch trong giao dịch và đảm bảo chất lượng dịch vụ tốt nhất.
                    </p>
                </div>
            </div>

            <!-- 2. Thanh Điều Hướng Nhanh (Anchor Tabs) -->
            <div class="max-w-[1200px] mx-auto px-4 -mt-7 relative z-20">
                <div class="bg-white rounded-2xl p-3 border border-slate-200/80 shadow-lg flex items-center justify-start md:justify-center gap-2 overflow-x-auto no-scrollbar scroll-smooth">
                    <a href="#doi-tra" class="flex-shrink-0 px-4 py-2.5 rounded-xl text-xs md:text-sm font-bold text-slate-700 hover:text-blue-600 hover:bg-blue-50 transition-all no-underline flex items-center gap-2">
                        <span>🔄</span> Đổi Trả & Mua Hàng
                    </a>
                    <a href="#giao-hang" class="flex-shrink-0 px-4 py-2.5 rounded-xl text-xs md:text-sm font-bold text-slate-700 hover:text-blue-600 hover:bg-blue-50 transition-all no-underline flex items-center gap-2">
                        <span>🚚</span> Vận Chuyển
                    </a>
                    <a href="#bao-mat" class="flex-shrink-0 px-4 py-2.5 rounded-xl text-xs md:text-sm font-bold text-slate-700 hover:text-blue-600 hover:bg-blue-50 transition-all no-underline flex items-center gap-2">
                        <span>🔒</span> Bảo Mật Thông Tin
                    </a>
                    <a href="#thanh-toan" class="flex-shrink-0 px-4 py-2.5 rounded-xl text-xs md:text-sm font-bold text-slate-700 hover:text-blue-600 hover:bg-blue-50 transition-all no-underline flex items-center gap-2">
                        <span>💳</span> Thanh Toán & Hoàn Tiền
                    </a>
                    <a href="#bao-hanh" class="flex-shrink-0 px-4 py-2.5 rounded-xl text-xs md:text-sm font-bold text-slate-700 hover:text-blue-600 hover:bg-blue-50 transition-all no-underline flex items-center gap-2">
                        <span>🛡️</span> Bảo Hành
                    </a>
                </div>
            </div>

            <!-- 3. Nội Dung Chi Tiết Các Chính Sách -->
            <div class="max-w-[1200px] mx-auto px-4 mt-10 space-y-8">
                
                <!-- Section 1: Đổi Trả -->
                <div id="doi-tra" class="cpm-policy-card bg-white rounded-3xl p-6 md:p-8 border border-slate-200/80 shadow-lg space-y-4">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                        <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl shadow-inner">
                            🔄
                        </div>
                        <div>
                            <h2 class="text-xl md:text-2xl font-black text-slate-900">1. Chính Sách Mua Hàng & Đổi Trả</h2>
                            <p class="text-xs md:text-sm text-slate-500">Đổi trả dễ dàng trong vòng 30 ngày nếu phát sinh lỗi từ nhà sản xuất.</p>
                        </div>
                    </div>
                    <div class="space-y-3 text-xs md:text-sm text-slate-600 leading-relaxed">
                        <p><strong>• Thời gian đổi trả:</strong> Quý khách được quyền đổi trả sản phẩm trong vòng <strong>7 đến 30 ngày</strong> kể từ ngày nhận hàng thành công.</p>
                        <p><strong>• Điều kiện sản phẩm đổi trả:</strong> Sản phẩm còn nguyên tem mác, nguyên hộp bao bì, chưa qua sử dụng và đầy đủ phụ kiện, quà tặng kèm theo (nếu có).</p>
                        <p><strong>• Chi phí đổi trả:</strong> Miễn phí 100% chi phí vận chuyển đổi trả nếu sản phẩm giao sai mẫu, bị vỡ hỏng trong quá trình vận chuyển hoặc gặp lỗi kỹ thuật từ nhà sản xuất.</p>
                    </div>
                </div>

                <!-- Section 2: Vận Chuyển -->
                <div id="giao-hang" class="cpm-policy-card bg-white rounded-3xl p-6 md:p-8 border border-slate-200/80 shadow-lg space-y-4">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl shadow-inner">
                            🚚
                        </div>
                        <div>
                            <h2 class="text-xl md:text-2xl font-black text-slate-900">2. Chính Sách Giao Hàng & Phí Vận Chuyển</h2>
                            <p class="text-xs md:text-sm text-slate-500">Giao hàng tận nơi toàn quốc, hỗ trợ theo dõi hành trình đơn hàng realtime.</p>
                        </div>
                    </div>
                    <div class="space-y-3 text-xs md:text-sm text-slate-600 leading-relaxed">
                        <p><strong>• Phí giao hàng:</strong> <strong>Miễn phí vận chuyển (FREE SHIPPING)</strong> cho tất cả đơn hàng có giá trị từ 500.000 đ trở lên trên toàn quốc.</p>
                        <p><strong>• Thời gian giao hàng dự kiến:</strong></p>
                        <ul class="list-disc pl-5 space-y-1">
                            <li>Nội thành Hà Nội & TP. Hồ Chí Minh: Giao hỏa tốc trong <strong>2 - 4 giờ</strong> hoặc nhận trong ngày.</li>
                            <li>Các tỉnh thành khác: Giao hàng tiêu chuẩn trong <strong>2 - 4 ngày làm việc</strong>.</li>
                        </ul>
                        <p><strong>• Đồng kiểm khi nhận hàng:</strong> Khách hàng được quyền mở hộp kiểm tra đúng sản phẩm trước khi thanh toán cho nhân viên giao hàng.</p>
                    </div>
                </div>

                <!-- Section 3: Bảo Mật Thông Tin -->
                <div id="bao-mat" class="cpm-policy-card bg-white rounded-3xl p-6 md:p-8 border border-slate-200/80 shadow-xl space-y-4">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-2xl shadow-inner">
                            🔒
                        </div>
                        <div>
                            <h2 class="text-xl md:text-2xl font-black text-slate-900">3. Chính Sách Bảo Mật Thông Tin (Privacy Policy)</h2>
                            <p class="text-xs md:text-sm text-slate-500">Cam kết bảo vệ 100% dữ liệu cá nhân & thông tin giao dịch của khách hàng.</p>
                        </div>
                    </div>
                    <div class="space-y-3 text-xs md:text-sm text-slate-600 leading-relaxed">
                        <p><strong>• Thu thập thông tin:</strong> Chúng tôi chỉ thu thập các thông tin cần thiết gồm: Họ tên, Số điện thoại, Email và Địa chỉ giao hàng để phục vụ việc xử lý đơn hàng.</p>
                        <p><strong>• Sử dụng thông tin:</strong> Thông tin cá nhân của bạn chỉ được sử dụng nội bộ để thông báo trạng thái đơn hàng, gửi mã vận đơn và hỗ trợ kỹ thuật khi cần thiết.</p>
                        <p><strong>• Cam kết bảo mật:</strong> Tuyệt đối <strong>KHÔNG</strong> chia sẻ, bán hoặc trao đổi thông tin khách hàng cho bất kỳ bên thứ ba nào vì mục đích thương mại.</p>
                    </div>
                </div>

                <!-- Section 4: Thanh Toán & Hoàn Tiền -->
                <div id="thanh-toan" class="cpm-policy-card bg-white rounded-3xl p-6 md:p-8 border border-slate-200/80 shadow-lg space-y-4">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                        <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl shadow-inner">
                            💳
                        </div>
                        <div>
                            <h2 class="text-xl md:text-2xl font-black text-slate-900">4. Chính Sách Thanh Toán & Hoàn Tiền</h2>
                            <p class="text-xs md:text-sm text-slate-500">Hỗ trợ đa dạng phương thức thanh toán an toàn, quét mã SePay VietQR tự động.</p>
                        </div>
                    </div>
                    <div class="space-y-3 text-xs md:text-sm text-slate-600 leading-relaxed">
                        <p><strong>• Phương thức thanh toán linh hoạt:</strong></p>
                        <ul class="list-disc pl-5 space-y-1">
                            <li><strong>Quét mã VietQR SePay Tự Động:</strong> Hệ thống kiểm tra tiền về tài khoản ngân hàng và xác nhận đơn ngay lập tức 24/7.</li>
                            <li><strong>Thanh toán COD:</strong> Nhận hàng, kiểm tra hàng xong mới trả tiền mặt cho shipper.</li>
                        </ul>
                        <p><strong>• Chính sách hoàn tiền:</strong> Trường hợp đơn hàng hủy hợp lệ hoặc sản phẩm trả lại đúng quy định, tiền sẽ được hoàn trả tự động về tài khoản ngân hàng của bạn trong vòng <strong>24 giờ làm việc</strong>.</p>
                    </div>
                </div>

                <!-- Section 5: Bảo Hành -->
                <div id="bao-hanh" class="cpm-policy-card bg-white rounded-3xl p-6 md:p-8 border border-slate-200/80 shadow-lg space-y-4">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                        <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center text-2xl shadow-inner">
                            🛡️
                        </div>
                        <div>
                            <h2 class="text-xl md:text-2xl font-black text-slate-900">5. Chính Sách Bảo Hành & Hỗ Trợ Kỹ Thuật</h2>
                            <p class="text-xs md:text-sm text-slate-500">Bảo hành chính hãng uy tín, hỗ trợ xử lý sự cố trong suốt quá trình sử dụng.</p>
                        </div>
                    </div>
                    <div class="space-y-3 text-xs md:text-sm text-slate-600 leading-relaxed">
                        <p><strong>• Thời hạn bảo hành:</strong> Bảo hành chính hãng từ <strong>12 đến 24 tháng</strong> theo tiêu chuẩn của nhà sản xuất.</p>
                        <p><strong>• Phương thức bảo hành:</strong> Bảo hành điện tử theo Số điện thoại đặt hàng / Mã đơn hàng. Quý khách không lo thất lạc phiếu bảo hành giấy.</p>
                        <p><strong>• Hotline tiếp nhận bảo hành:</strong> Gọi ngay <strong>+84 393 465 113</strong> hoặc nhắn tin qua Zalo để được kỹ thuật viên hỗ trợ nhanh nhất.</p>
                    </div>
                </div>

            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}

/**
 * Đăng ký Shortcode [cpm_policy_page] và [chinh_sach_page]
 */
add_shortcode('cpm_policy_page', 'cpm_render_policy_page_shortcode');
add_shortcode('chinh_sach_page', 'cpm_render_policy_page_shortcode');

/**
 * Tự động tạo và cập nhật trang /chinh-sach/ trong WordPress Database
 */
if (!function_exists('cpm_policy_create_pages')) {
    function cpm_policy_create_pages() {
        $policy_slug = 'chinh-sach';
        $policy_page = get_page_by_path($policy_slug);
        if (!$policy_page) {
            wp_insert_post(array(
                'post_title'   => 'Chính sách hệ thống',
                'post_content' => '<!-- wp:shortcode -->[cpm_policy_page]<!-- /wp:shortcode -->',
                'post_status'  => 'publish',
                'post_type'    => 'page',
                'post_name'    => $policy_slug
            ));
        } elseif (empty(trim($policy_page->post_content)) || strpos($policy_page->post_content, 'cpm_policy_page') === false) {
            wp_update_post(array(
                'ID'           => $policy_page->ID,
                'post_content' => '<!-- wp:shortcode -->[cpm_policy_page]<!-- /wp:shortcode -->'
            ));
        }
    }
}
add_action('init', 'cpm_policy_create_pages');

/**
 * Filter the_content tự động hiển thị Trang Chính Sách cho trang /chinh-sach/ và /policy/
 */
add_filter('the_content', function($content) {
    if (is_page('chinh-sach') || is_page('policy')) {
        if (strpos($content, 'cpm-policy-wrapper') === false) {
            return cpm_render_policy_page_shortcode();
        }
    }
    return $content;
}, 20);
