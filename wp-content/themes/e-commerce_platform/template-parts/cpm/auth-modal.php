<?php
/**
 * Theme Template Part: Nút Đăng nhập / Đăng xuất Header & Popup Auth Modal
 * Path: template-parts/cpm/auth-modal.php
 */

if (!defined('ABSPATH')) {
    exit;
}
// Passed variables: $is_logged_in, $current_user, $logout_url, $ajax_url, $nonce
?>
<?php if (!doing_action('wp_footer') && empty($is_footer_context)) : ?>
<div id="cpm-auth-wrapper" class="flex items-center font-sans my-0">
    <?php if ($is_logged_in) : ?>
        <div class="relative inline-block text-left group">
            <button type="button" class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/90 hover:bg-white text-slate-800 text-xs md:text-sm font-semibold transition-all duration-200 cursor-pointer border border-slate-200 shadow-sm">
                <?php 
                $google_avatar = get_user_meta($current_user->ID, '_google_avatar_url', true);
                if (!empty($google_avatar)) {
                    echo '<img src="' . esc_url($google_avatar) . '" alt="Avatar" class="w-6 h-6 rounded-full object-cover border border-white" />';
                } else {
                    echo get_avatar($current_user->ID, 24, '', '', array('class' => 'rounded-full border border-white'));
                }
                ?>
                <span class="max-w-[120px] truncate"><?php echo esc_html($current_user->display_name); ?></span>
                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
            <div class="absolute right-0 top-full mt-1 w-52 bg-white rounded-xl shadow-2xl border border-slate-100 py-1.5 hidden group-hover:block z-[99999] before:content-[''] before:absolute before:-top-3 before:left-0 before:w-full before:h-3">
                <div class="px-4 py-2 border-b border-slate-100 bg-slate-50 rounded-t-xl">
                    <p class="text-[10px] uppercase font-bold text-slate-400">Tài khoản</p>
                    <p class="text-xs font-bold text-slate-800 truncate"><?php echo esc_html($current_user->user_email); ?></p>
                </div>
                <a href="<?php echo esc_url(home_url('/gio-hang/')); ?>" class="flex items-center gap-2 px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">🛒 Giỏ hàng của tôi</a>
                <a href="<?php echo esc_url(home_url('/lich-su-don-hang/')); ?>" class="flex items-center gap-2 px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">📋 Đơn hàng của tôi</a>
                <a href="<?php echo esc_url(admin_url('profile.php')); ?>" class="flex items-center gap-2 px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">⚙️ Quản lý tài khoản</a>
                <a href="<?php echo esc_url($logout_url); ?>" class="flex items-center gap-2 px-4 py-2 text-xs font-bold text-red-600 hover:bg-red-50 transition-colors border-t border-slate-100 mt-1">🚪 Đăng xuất</a>
            </div>
        </div>
    <?php else : ?>
        <button type="button" onclick="openCpmAuthModal('login')" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-xs md:text-sm font-bold px-4 py-2 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 cursor-pointer border-none">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
            <span>Đăng nhập / Đăng ký</span>
        </button>
    <?php endif; ?>
</div>
<?php endif; ?>

<div id="cpmAuthModal" style="display: none;" class="fixed inset-0 z-[99999] flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4 animate-fadeIn">
    <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl border border-slate-100 overflow-hidden relative transform transition-all my-auto mx-auto max-h-[90vh] overflow-y-auto">
        <button type="button" onclick="closeCpmAuthModal()" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 w-8 h-8 rounded-full flex items-center justify-center hover:bg-slate-100 transition-colors cursor-pointer border-none">
            ✕
        </button>

        <div class="flex border-b border-slate-100 bg-slate-50 p-2 gap-2">
            <button type="button" id="cpmTabBtnLogin" onclick="switchCpmAuthTab('login')" class="flex-1 py-2.5 text-sm font-bold rounded-xl transition-all border-none cursor-pointer bg-white text-blue-600 shadow-sm">
                Đăng nhập
            </button>
            <button type="button" id="cpmTabBtnRegister" onclick="switchCpmAuthTab('register')" class="flex-1 py-2.5 text-sm font-semibold text-slate-500 hover:text-slate-800 rounded-xl transition-all border-none cursor-pointer">
                Tạo tài khoản
            </button>
        </div>

        <div class="p-6 md:p-8">
            <div id="cpmAuthAlert" class="hidden mb-4 p-3 rounded-xl text-xs font-semibold"></div>

            <form id="cpmLoginForm" onsubmit="handleCpmLogin(event)">
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Email hoặc Tên đăng nhập</label>
                        <input type="text" id="cpmLoginEmail" required placeholder="example@gmail.com" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm outline-none transition-all box-border" />
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Mật khẩu</label>
                        <input type="password" id="cpmLoginPwd" required placeholder="••••••••" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm outline-none transition-all box-border" />
                    </div>
                    <div class="flex items-center justify-between text-xs">
                        <label class="flex items-center gap-1.5 text-slate-600 cursor-pointer">
                            <input type="checkbox" id="cpmRememberMe" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500" />
                            <span>Ghi nhớ tôi</span>
                        </label>
                    </div>
                    <button type="submit" id="cpmSubmitLoginBtn" class="w-full py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold text-sm rounded-xl shadow-lg hover:shadow-xl transition-all border-none cursor-pointer">
                        Đăng nhập ngay
                    </button>
                </div>
            </form>

            <form id="cpmRegisterForm" class="hidden" onsubmit="handleCpmRegister(event)">
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Họ và Tên</label>
                        <input type="text" id="cpmRegName" required placeholder="Nguyễn Văn A" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm outline-none transition-all box-border" />
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Địa chỉ Email (Gmail)</label>
                        <input type="email" id="cpmRegEmail" required placeholder="tenban@gmail.com" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm outline-none transition-all box-border" />
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Tạo Mật khẩu (tối thiểu 6 ký tự)</label>
                        <input type="password" id="cpmRegPwd" required minlength="6" placeholder="••••••••" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm outline-none transition-all box-border" />
                    </div>
                    <button type="submit" id="cpmSubmitRegBtn" class="w-full py-3 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold text-sm rounded-xl shadow-lg hover:shadow-xl transition-all border-none cursor-pointer">
                        Đăng ký tài khoản
                    </button>
                </div>
            </form>

            <div class="my-6 flex items-center gap-3">
                <div class="flex-1 h-px bg-slate-200"></div>
                <span class="text-xs text-slate-400 font-semibold uppercase">Hoặc đăng nhập nhanh</span>
                <div class="flex-1 h-px bg-slate-200"></div>
            </div>

            <div class="flex flex-col gap-2">
                <button type="button" onclick="triggerGoogleOneTapLogin()" class="w-full py-2.5 px-4 bg-white hover:bg-slate-50 text-slate-700 font-bold text-xs md:text-sm rounded-xl border border-slate-300 shadow-sm flex items-center justify-center gap-2.5 transition-all cursor-pointer">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="#EA4335" d="M12 5c1.6 0 3 .6 4.1 1.6l3.1-3.1C17.3 1.7 14.8 1 12 1 7.5 1 3.7 3.6 1.9 7.3l3.7 2.9C6.5 7.3 9 5 12 5z"/>
                        <path fill="#4285F4" d="M23.5 12.3c0-.8-.1-1.6-.2-2.3H12v4.5h6.5c-.3 1.5-1.1 2.8-2.4 3.7l3.7 2.9c2.2-2 3.7-5 3.7-8.8z"/>
                        <path fill="#FBBC05" d="M5.6 14.8c-.2-.7-.4-1.5-.4-2.3s.2-1.6.4-2.3L1.9 7.3C.7 9.7 0 10.8 0 12s.7 2.3 1.9 4.7l3.7-2.9z"/>
                        <path fill="#34A853" d="M12 23c3.2 0 6-1.1 8-3l-3.7-2.9c-1.1.7-2.5 1.2-4.3 1.2-3 0-5.5-2.3-6.4-5.2L1.9 16C3.7 19.7 7.5 23 12 23z"/>
                    </svg>
                    <span>Đăng nhập với Google</span>
                </button>

                <div id="g_id_onload"
                    data-client_id="YOUR_GOOGLE_CLIENT_ID.apps.googleusercontent.com"
                    data-context="signin"
                    data-ux_mode="popup"
                    data-callback="onGoogleAuthCallback"
                    data-auto_prompt="false">
                </div>
            </div>
        </div>
    </div>
</div>
