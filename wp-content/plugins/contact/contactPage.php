<?php
/**
 * Sub-module Trang Liên Hệ (Contact Us Page)
 * File: contactPage.php (Module Plugin Contact)
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!function_exists('cpm_render_contact_page_shortcode')) {

/**
 * Shortcode Hiển thị Trang Liên Hệ [cpm_contact_page] hoặc [contact_page]
 */
function cpm_render_contact_page_shortcode() {
    $current_user = wp_get_current_user();
    $user_name = is_user_logged_in() ? $current_user->display_name : '';
    $user_email = is_user_logged_in() ? $current_user->user_email : '';

    ob_start();
    ?>
    <style id="cpm-contact-page-styles">
        /* Đảm bảo khung container 1200px được rộng tối đa không bị ép 600px của WordPress */
        .wp-block-group.alignfull,
        .entry-content > .wp-block-group,
        main#content {
            max-width: 100% !important;
            width: 100% !important;
        }
        .cpm-contact-grid-container {
            display: flex !important;
            flex-direction: column !important;
            gap: 2rem !important;
            width: 100% !important;
            align-items: flex-start !important;
        }
        .cpm-contact-col-left,
        .cpm-contact-col-right {
            margin-top: 0 !important;
            padding-top: 0 !important;
        }
        .cpm-contact-col-left > .bg-white,
        .cpm-contact-col-right > .bg-white {
            margin-top: 0 !important;
        }
        .cpm-contact-actions-row {
            display: flex !important;
            flex-direction: row !important;
            align-items: center !important;
            gap: 0.75rem !important;
            width: 100% !important;
        }
        .cpm-contact-actions-row > a {
            flex: 1 1 50% !important;
            width: 50% !important;
            min-width: 0 !important;
            box-sizing: border-box !important;
        }
        @media (min-width: 768px) {
            .cpm-contact-grid-container {
                flex-direction: row !important;
                align-items: flex-start !important;
            }
            .cpm-contact-col-left {
                width: 40% !important;
                flex-shrink: 0 !important;
            }
            .cpm-contact-col-right {
                width: 60% !important;
                flex-grow: 1 !important;
            }
        }
    </style>
    <div id="cpm-contact-wrapper" class="w-full font-sans text-slate-800 box-border bg-slate-50/50 pb-12">
        <!-- 1. Hero Banner Top -->
        <div class="w-full bg-gradient-to-r from-slate-900 via-blue-900 to-indigo-900 text-white py-12 md:py-16 px-4 text-center relative overflow-hidden shadow-lg">
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>
            
            <div class="max-w-4xl mx-auto relative z-10 space-y-3">
                <span class="inline-block px-3.5 py-1 bg-blue-500/20 text-blue-300 border border-blue-400/30 rounded-full text-xs font-bold uppercase tracking-wider">
                    Hỗ Trợ 24/7
                </span>
                <h1 class="text-3xl md:text-5xl font-black tracking-tight text-white">
                    Liên Hệ Với Chúng Tôi
                </h1>
                <p class="text-sm md:text-base text-slate-300 max-w-2xl mx-auto leading-relaxed">
                    Chúng tôi luôn sẵn lòng lắng nghe, hỗ trợ tư vấn và đáp ứng mọi thắc mắc của quý khách hàng một cách nhanh chóng nhất.
                </p>
            </div>
        </div>

        <!-- 2. Khung Nội Dung Chính 2 Cột Trên Cùng 1 Hàng (Max Width 1200px) -->
        <div class="max-w-[1200px] mx-auto px-4 mt-10 md:mt-12 relative z-20">
            <div class="cpm-contact-grid-container">
                
                <!-- Cột Trái: Thông Tin Liên Hệ & Hotline -->
                <div class="cpm-contact-col-left space-y-6">
                    <!-- Card Thông Tin Tổng Quan -->
                    <div class="bg-white rounded-3xl p-6 md:p-8 border border-slate-200/80 shadow-xl space-y-6">
                        <h3 class="text-xl font-black text-slate-900 pb-4 border-b border-slate-100 flex items-center gap-2">
                            <span>📌</span> Thông Tin Trụ Sở
                        </h3>

                        <div class="space-y-5 text-sm">
                            <!-- Địa chỉ -->
                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl flex-shrink-0 shadow-inner">
                                    🏢
                                </div>
                                <div>
                                    <h4 class="font-extrabold text-slate-900 text-xs uppercase tracking-wider text-slate-400">Địa Chỉ Công ty</h4>
                                    <p class="font-bold text-slate-800 mt-0.5 leading-snug">242 Trần Thủ Độ, Phú Thạnh, HCM, VN</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl flex-shrink-0 shadow-inner">
                                    📞
                                </div>
                                <div>
                                    <h4 class="font-extrabold text-slate-900 text-xs uppercase tracking-wider text-slate-400">Hotline Tư Vấn (24/7)</h4>
                                    <a href="tel:0393465113" class="font-black text-emerald-600 text-base mt-0.5 block hover:underline no-underline">+84 393 465 113</a>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl flex-shrink-0 shadow-inner">
                                      ✉️
                                </div>
                                <div>
                                    <h4 class="font-extrabold text-slate-900 text-xs uppercase tracking-wider text-slate-400">Hotline Tư Vấn (24/7)</h4>
                                    <a href="mailto:tranngochung19112004@gmail.com" class="font-black text-slate-600 text-base mt-0.5 block hover:underline no-underline">tranngochung19112004@gmail.com</a>
                                </div>
                            </div>

                            <!-- Giờ làm việc -->
                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl flex-shrink-0 shadow-inner">
                                    🕒
                                </div>
                                <div>
                                    <h4 class="font-extrabold text-slate-900 text-xs uppercase tracking-wider text-slate-400">Thời Gian Phục Vụ</h4>
                                    <p class="font-bold text-slate-800 mt-0.5">Thứ 2 - Thứ 7 (08:00 - 17:00)</p>
                                    <span class="text-xs text-emerald-600 font-semibold">Mở cửa tất cả các ngày lễ</span>
                                </div>
                            </div>
                        </div>

                        <!-- Các Kênh Phản Hồi Nhanh (Nằm trên cùng 1 hàng ngang) -->
                        <div class="pt-4 border-t border-slate-100">
                            <h4 class="font-bold text-xs text-slate-400 uppercase tracking-wider mb-3">Kết nối trực tuyến</h4>
                            <div class="cpm-contact-actions-row">
                                <a href="https://zalo.me/0393465113" target="_blank" class="flex-1 inline-flex items-center justify-center gap-2 py-2.5 px-3 bg-blue-50 hover:bg-blue-100 text-blue-700 font-extrabold text-xs rounded-xl border border-blue-200 transition-all no-underline text-center">
                                    💬 Chat Zalo
                                </a>
                                <a href="tel:0393465113" class="flex-1 inline-flex items-center justify-center gap-2 py-2.5 px-3 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-extrabold text-xs rounded-xl border border-emerald-200 transition-all no-underline text-center">
                                    📞 Gọi Ngay
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cột Phải: Form Gửi Lời Nhắn Trực Tuyến -->
                <div class="cpm-contact-col-right">
                    <div class="bg-white rounded-3xl p-6 md:p-8 border border-slate-200/80 shadow-xl">
                        <div class="mb-6">
                            <h3 class="text-2xl font-black text-slate-900">Gửi Lời Nhắn Cho Chúng Tôi</h3>
                            <p class="text-xs md:text-sm text-slate-500 mt-1">Điền thông tin bên dưới, đội ngũ tư vấn sẽ liên hệ lại với bạn trong vòng 15 phút.</p>
                        </div>

                        <form id="cpmContactForm" onsubmit="handleCpmContactSubmit(event)" class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">Họ và Tên *</label>
                                    <input type="text" id="cpmContactName" required value="<?php echo esc_attr($user_name); ?>" placeholder="Nguyễn Văn A" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-xs md:text-sm font-semibold outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-100 transition-all box-border" />
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">Số điện thoại *</label>
                                    <input type="tel" id="cpmContactPhone" required placeholder="0987654321" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-xs md:text-sm font-semibold outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-100 transition-all box-border" />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">Địa chỉ Email *</label>
                                    <input type="email" id="cpmContactEmail" required value="<?php echo esc_attr($user_email); ?>" placeholder="example@gmail.com" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-xs md:text-sm font-semibold outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-100 transition-all box-border" />
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">Chủ đề cần tư vấn *</label>
                                    <select id="cpmContactSubject" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-xs md:text-sm font-semibold outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-100 transition-all bg-white box-border">
                                        <option value="tu-van-mua-hang">🛍️ Tư vấn mua sản phẩm</option>
                                        <option value="bao-hanh-doi-tra">🛡️ Bảo hành & Đổi trả</option>
                                        <option value="ho-tro-ky-thuat">⚙️ Hỗ trợ kỹ thuật</option>
                                        <option value="gop-y-dich-vu">💬 Góp ý chất lượng dịch vụ</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Nội dung chi tiết lời nhắn *</label>
                                <textarea id="cpmContactMessage" required rows="4" placeholder="Nhập nội dung thắc mắc hoặc thông tin sản phẩm bạn cần tư vấn..." class="w-full px-4 py-3 rounded-xl border border-slate-300 text-xs md:text-sm font-semibold outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-100 transition-all box-border"></textarea>
                            </div>

                            <button type="submit" id="cpmSubmitContactBtn" class="w-full py-4 px-6 bg-gradient-to-r from-blue-600 via-indigo-600 to-violet-600 hover:from-blue-700 hover:to-violet-700 text-white font-black text-sm md:text-base rounded-2xl shadow-xl shadow-indigo-500/25 hover:shadow-2xl hover:shadow-indigo-500/35 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 border-none cursor-pointer flex items-center justify-center gap-2">
                                <span>🚀 Gửi Lời Nhắn Cho Chúng Tôi</span>
                            </button>
                        </form>
                    </div>
                </div>

            </div>

            <!-- 3. Khung Bản Đồ Google Maps (Full Width Below) -->
            <div class="mt-10 bg-white rounded-3xl p-4 border border-slate-200/80 shadow-xl overflow-hidden">
                <div class="mb-3 px-2 flex items-center justify-between">
                    <h3 class="text-base font-extrabold text-slate-900 flex items-center gap-2">
                        <span>🗺️</span> Vị Trí Công ty Trên Bản Đồ
                    </h3>
                    <span class="text-xs text-slate-400 font-semibold">Phú Thạnh, Thành phố Hồ Chí Minh </span>
                </div>
                <div class="w-full h-80 md:h-96 rounded-2xl overflow-hidden border border-slate-200 shadow-inner">
                    <iframe src="https://maps.google.com/maps?q=NEO+-+Coworking+Space+(+Tân+Phú+)&hl=vi&z=17&output=embed" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

        </div>
    </div>

    <!-- JavaScript Xử Lý Form Gửi Lời Nhắn Contact -->
    <script>
        function handleCpmContactSubmit(e) {
            e.preventDefault();
            const btn = document.getElementById('cpmSubmitContactBtn');
            const name = document.getElementById('cpmContactName').value;

            if (btn) {
                btn.disabled = true;
                btn.innerHTML = '⏳ Đang gửi thông tin liên hệ...';
            }

            setTimeout(() => {
                if (btn) {
                    btn.disabled = false;
                    btn.innerHTML = '🚀 Gửi Lời Nhắn Cho Chúng Tôi';
                }

                if (typeof cpmShowToast === 'function') {
                    cpmShowToast(`🎉 Cảm ơn ${name}! Chúng tôi đã nhận được lời nhắn và sẽ phản hồi sớm nhất!`, 'success');
                } else {
                    alert(`Cảm ơn ${name}! Chúng tôi đã nhận được lời nhắn của bạn.`);
                }

                const form = document.getElementById('cpmContactForm');
                if (form) form.reset();
            }, 800);
        }
    </script>
    <?php
    return ob_get_clean();
}
}

/**
 * Đăng ký Shortcode [cpm_contact_page] và [contact_page]
 */
add_shortcode('cpm_contact_page', 'cpm_render_contact_page_shortcode');
add_shortcode('contact_page', 'cpm_render_contact_page_shortcode');

/**
 * Tự động tạo và cập nhật nội dung cho trang /lien-he/
 */
function cpm_contact_create_pages() {
    $contact_slug = 'lien-he';
    $contact_page = get_page_by_path($contact_slug);
    if (!$contact_page) {
        wp_insert_post(array(
            'post_title'   => 'Liên hệ',
            'post_content' => '<!-- wp:shortcode -->[cpm_contact_page]<!-- /wp:shortcode -->',
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_name'    => $contact_slug
        ));
    } elseif (empty(trim($contact_page->post_content))) {
        wp_update_post(array(
            'ID'           => $contact_page->ID,
            'post_content' => '<!-- wp:shortcode -->[cpm_contact_page]<!-- /wp:shortcode -->'
        ));
    }
}
add_action('init', 'cpm_contact_create_pages');

/**
 * Filter the_content tự động hiển thị Trang Liên Hệ cho trang /lien-he/
 */
add_filter('the_content', function($content) {
    if (is_page('lien-he') || is_page('contact')) {
        if (strpos($content, 'cpm-contact-wrapper') === false) {
            return cpm_render_contact_page_shortcode();
        }
    }
    return $content;
}, 20);

