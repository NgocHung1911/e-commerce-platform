<?php
/**
 * Plugin Name: Custom Auth (Email, Password & Google Sign-In)
 * Plugin URI: https://example.com/custom-auth
 * Description: Plugin quản lý Đăng nhập, Đăng ký và Đăng xuất với Email/Mật khẩu và Đăng nhập nhanh bằng Google (Google Sign-In).
 * Version: 1.0.0
 * Author: Antigravity
 */

if (!defined('ABSPATH')) {
    exit;
}

define('CPM_AUTH_VERSION', '1.0.0');

/**
 * Nạp Scripts & Thư viện JS/CSS cho Auth Modal & Google Sign-In
 */
function cpm_auth_enqueue_scripts() {
    // Google Identity Services SDK
    wp_enqueue_script('google-gsi', 'https://accounts.google.com/gsi/client', array(), null, true);

    // Enqueue Tailwind CDN nếu chưa có
    if (!wp_script_is('tailwind-cdn', 'enqueued')) {
        wp_enqueue_script('tailwind-cdn', 'https://cdn.tailwindcss.com', array(), '3.4.1', false);
    }
}
add_action('wp_enqueue_scripts', 'cpm_auth_enqueue_scripts');

/**
 * AJAX Handler: Đăng nhập bằng Email/Tên đăng nhập & Mật khẩu
 */
function cpm_ajax_login_handler() {
    check_ajax_referer('cpm_auth_nonce', 'security');

    $log = isset($_POST['log']) ? sanitize_text_field($_POST['log']) : '';
    $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : '';
    $remember = isset($_POST['remember']) && $_POST['remember'] === 'true';

    if (empty($log) || empty($pwd)) {
        wp_send_json_error(array('message' => 'Vui lòng nhập đầy đủ Email/Tên đăng nhập và Mật khẩu!'));
    }

    // Nếu người dùng nhập Email, lấy tên đăng nhập tương ứng
    if (is_email($log)) {
        $user_obj = get_user_by('email', $log);
        if ($user_obj) {
            $log = $user_obj->user_login;
        }
    }

    $creds = array(
        'user_login'    => $log,
        'user_password' => $pwd,
        'remember'      => $remember
    );

    $user = wp_signon($creds, is_ssl());

    if (is_wp_error($user)) {
        wp_send_json_error(array('message' => 'Email/Tên đăng nhập hoặc mật khẩu không chính xác!'));
    }

    wp_send_json_success(array(
        'message' => 'Đăng nhập thành công! Đang chuyển hướng...',
        'redirect_url' => home_url()
    ));
}
add_action('wp_ajax_cpm_ajax_login', 'cpm_ajax_login_handler');
add_action('wp_ajax_nopriv_cpm_ajax_login', 'cpm_ajax_login_handler');

/**
 * AJAX Handler: Đăng ký Tài khoản Mới
 */
function cpm_ajax_register_handler() {
    check_ajax_referer('cpm_auth_nonce', 'security');

    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : '';
    $full_name = isset($_POST['full_name']) ? sanitize_text_field($_POST['full_name']) : '';

    if (empty($email) || !is_email($email)) {
        wp_send_json_error(array('message' => 'Địa chỉ Email không hợp lệ!'));
    }
    if (empty($pwd) || strlen($pwd) < 6) {
        wp_send_json_error(array('message' => 'Mật khẩu phải từ 6 ký tự trở lên!'));
    }

    if (email_exists($email)) {
        wp_send_json_error(array('message' => 'Email này đã được sử dụng. Vui lòng đăng nhập hoặc dùng Email khác!'));
    }

    // Tự tạo username từ phần đầu email
    $username = sanitize_user(current(explode('@', $email)));
    $base_username = $username;
    $i = 1;
    while (username_exists($username)) {
        $username = $base_username . $i;
        $i++;
    }

    $user_id = wp_create_user($username, $pwd, $email);

    if (is_wp_error($user_id)) {
        wp_send_json_error(array('message' => $user_id->get_error_message()));
    }

    if (!empty($full_name)) {
        wp_update_user(array(
            'ID' => $user_id,
            'display_name' => $full_name,
            'first_name' => $full_name
        ));
    }

    // Tự động đăng nhập sau khi đăng ký thành công
    wp_set_current_user($user_id);
    wp_set_auth_cookie($user_id, true);

    wp_send_json_success(array(
        'message' => 'Đăng ký tài khoản thành công! Đang chuyển hướng...',
        'redirect_url' => home_url()
    ));
}
add_action('wp_ajax_cpm_ajax_register', 'cpm_ajax_register_handler');
add_action('wp_ajax_nopriv_cpm_ajax_register', 'cpm_ajax_register_handler');

/**
 * AJAX Handler: Đăng nhập Nhanh bằng Google
 */
function cpm_ajax_google_login_handler() {
    check_ajax_referer('cpm_auth_nonce', 'security');

    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    $picture = isset($_POST['picture']) ? esc_url_raw($_POST['picture']) : '';
    $google_id = isset($_POST['sub']) ? sanitize_text_field($_POST['sub']) : '';

    if (empty($email) || !is_email($email)) {
        wp_send_json_error(array('message' => 'Thông tin tài khoản Google không hợp lệ!'));
    }

    // Tìm người dùng theo Email
    $user = get_user_by('email', $email);

    if (!$user) {
        // Tạo tài khoản mới từ thông tin Google
        $username = sanitize_user(current(explode('@', $email)));
        $base_username = $username;
        $i = 1;
        while (username_exists($username)) {
            $username = $base_username . $i;
            $i++;
        }

        $random_password = wp_generate_password(16, true);
        $user_id = wp_create_user($username, $random_password, $email);

        if (is_wp_error($user_id)) {
            wp_send_json_error(array('message' => 'Không thể tạo tài khoản từ Google: ' . $user_id->get_error_message()));
        }

        $user = get_user_by('id', $user_id);
        if (!empty($name)) {
            wp_update_user(array(
                'ID' => $user_id,
                'display_name' => $name,
                'nickname' => $name
            ));
        }

        if (!empty($google_id)) {
            update_user_meta($user_id, '_google_sub_id', $google_id);
        }
        if (!empty($picture)) {
            update_user_meta($user_id, '_google_avatar_url', $picture);
        }
    }

    // Thiết lập cookie đăng nhập phiên làm việc
    wp_set_current_user($user->ID);
    wp_set_auth_cookie($user->ID, true);

    wp_send_json_success(array(
        'message' => 'Đăng nhập Google thành công! Chào mừng ' . esc_html($user->display_name) . '!',
        'redirect_url' => home_url()
    ));
}
add_action('wp_ajax_cpm_ajax_google_login', 'cpm_ajax_google_login_handler');
add_action('wp_ajax_nopriv_cpm_ajax_google_login', 'cpm_ajax_google_login_handler');

/**
 * Hiển thị Nút Đăng nhập / Đăng xuất Widget & Popup Modal trên Footer/Header
 */
function cpm_render_auth_modal() {
    $nonce = wp_create_nonce('cpm_auth_nonce');
    $ajax_url = admin_url('admin-ajax.php');
    $is_logged_in = is_user_logged_in();
    $current_user = wp_get_current_user();
    $logout_url = wp_logout_url(home_url());
    ?>
    <!-- Component Auth Box (Header & Popup Modal) -->
    <div id="cpm-auth-wrapper" class="inline-block font-sans">
        <?php if ($is_logged_in) : ?>
            <!-- Trạng thái: Đã đăng nhập -->
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
                <!-- Menu Thả Xuống Sát Nút -->
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
            <!-- Trạng thái: Chưa đăng nhập -->
            <button type="button" onclick="openCpmAuthModal('login')" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-xs md:text-sm font-bold px-4 py-2 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 cursor-pointer border-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                <span>Đăng nhập / Đăng ký</span>
            </button>
        <?php endif; ?>
    </div>

    <!-- Popup Modal Chuyên Nghiệp (Luôn được xuất vào DOM) -->
    <div id="cpmAuthModal" style="display: none;" class="fixed inset-0 z-[99999] flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4 animate-fadeIn">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl border border-slate-100 overflow-hidden relative transform transition-all">
            <!-- Nút Đóng Modal -->
            <button type="button" onclick="closeCpmAuthModal()" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 w-8 h-8 rounded-full flex items-center justify-center hover:bg-slate-100 transition-colors cursor-pointer border-none">
                ✕
            </button>

            <!-- Header Modal Tabs -->
            <div class="flex border-b border-slate-100 bg-slate-50 p-2 gap-2">
                <button type="button" id="cpmTabBtnLogin" onclick="switchCpmAuthTab('login')" class="flex-1 py-2.5 text-sm font-bold rounded-xl transition-all border-none cursor-pointer bg-white text-blue-600 shadow-sm">
                    Đăng nhập
                </button>
                <button type="button" id="cpmTabBtnRegister" onclick="switchCpmAuthTab('register')" class="flex-1 py-2.5 text-sm font-semibold text-slate-500 hover:text-slate-800 rounded-xl transition-all border-none cursor-pointer">
                    Tạo tài khoản
                </button>
            </div>

            <div class="p-6 md:p-8">
                <!-- Thông báo Lỗi / Thành công -->
                <div id="cpmAuthAlert" class="hidden mb-4 p-3 rounded-xl text-xs font-semibold"></div>

                <!-- Form 1: Đăng Nhập -->
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

                <!-- Form 2: Đăng Ký -->
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

                <!-- Đường kẻ Phân Cách Google -->
                <div class="my-6 flex items-center gap-3">
                    <div class="flex-1 h-px bg-slate-200"></div>
                    <span class="text-xs text-slate-400 font-semibold uppercase">Hoặc đăng nhập nhanh</span>
                    <div class="flex-1 h-px bg-slate-200"></div>
                </div>

                <!-- Nút Đăng Nhập Nhanh bằng Google -->
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

                    <!-- Div chứa nút Google SDK tự động -->
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

    <!-- JavaScript Xử Lý AJAX Đăng Nhập / Đăng Ký & Google Sign-In -->
    <script>
        const cpmAjaxUrl = "<?php echo esc_url($ajax_url); ?>";
        const cpmNonce = "<?php echo esc_js($nonce); ?>";

        function openCpmAuthModal(tab = 'login') {
            const modal = document.getElementById('cpmAuthModal');
            if (modal) {
                modal.style.display = 'flex';
                switchCpmAuthTab(tab);
            }
        }

        function closeCpmAuthModal() {
            const modal = document.getElementById('cpmAuthModal');
            if (modal) {
                modal.style.display = 'none';
            }
        }

        // Đóng Modal khi bấm ngoài màn hình mờ hoặc phím ESC
        document.addEventListener('click', function(e) {
            const modal = document.getElementById('cpmAuthModal');
            if (modal && e.target === modal) {
                closeCpmAuthModal();
            }
        });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeCpmAuthModal();
            }
        });

        function switchCpmAuthTab(tab) {
            const loginForm = document.getElementById('cpmLoginForm');
            const regForm = document.getElementById('cpmRegisterForm');
            const loginBtn = document.getElementById('cpmTabBtnLogin');
            const regBtn = document.getElementById('cpmTabBtnRegister');
            const alertDiv = document.getElementById('cpmAuthAlert');

            if (alertDiv) alertDiv.classList.add('hidden');

            if (tab === 'login') {
                loginForm.classList.remove('hidden');
                regForm.classList.add('hidden');
                loginBtn.className = 'flex-1 py-2.5 text-sm font-bold rounded-xl transition-all border-none cursor-pointer bg-white text-blue-600 shadow-sm';
                regBtn.className = 'flex-1 py-2.5 text-sm font-semibold text-slate-500 hover:text-slate-800 rounded-xl transition-all border-none cursor-pointer';
            } else {
                loginForm.classList.add('hidden');
                regForm.classList.remove('hidden');
                regBtn.className = 'flex-1 py-2.5 text-sm font-bold rounded-xl transition-all border-none cursor-pointer bg-white text-emerald-600 shadow-sm';
                loginBtn.className = 'flex-1 py-2.5 text-sm font-semibold text-slate-500 hover:text-slate-800 rounded-xl transition-all border-none cursor-pointer';
            }
        }

        function showCpmAuthAlert(msg, type = 'error') {
            const alertDiv = document.getElementById('cpmAuthAlert');
            if (!alertDiv) return;
            alertDiv.classList.remove('hidden', 'bg-red-50', 'text-red-700', 'bg-emerald-50', 'text-emerald-700');
            if (type === 'error') {
                alertDiv.classList.add('bg-red-50', 'text-red-700');
            } else {
                alertDiv.classList.add('bg-emerald-50', 'text-emerald-700');
            }
            alertDiv.innerHTML = msg;
        }

        // Xử lý Form Đăng Nhập Email / Mật khẩu
        function handleCpmLogin(e) {
            e.preventDefault();
            const log = document.getElementById('cpmLoginEmail').value;
            const pwd = document.getElementById('cpmLoginPwd').value;
            const remember = document.getElementById('cpmRememberMe').checked;
            const btn = document.getElementById('cpmSubmitLoginBtn');

            btn.disabled = true;
            btn.innerHTML = '⏳ Đang đăng nhập...';

            const formData = new FormData();
            formData.append('action', 'cpm_ajax_login');
            formData.append('security', cpmNonce);
            formData.append('log', log);
            formData.append('pwd', pwd);
            formData.append('remember', remember);

            fetch(cpmAjaxUrl, {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(res => {
                btn.disabled = false;
                btn.innerHTML = 'Đăng nhập ngay';
                if (res.success) {
                    showCpmAuthAlert(res.data.message, 'success');
                    setTimeout(() => {
                        window.location.href = res.data.redirect_url;
                    }, 800);
                } else {
                    showCpmAuthAlert(res.data.message, 'error');
                }
            })
            .catch(err => {
                btn.disabled = false;
                btn.innerHTML = 'Đăng nhập ngay';
                showCpmAuthAlert('Đã có lỗi xảy ra. Vui lòng thử lại!', 'error');
            });
        }

        // Xử lý Form Đăng Ký Tài Khoản
        function handleCpmRegister(e) {
            e.preventDefault();
            const name = document.getElementById('cpmRegName').value;
            const email = document.getElementById('cpmRegEmail').value;
            const pwd = document.getElementById('cpmRegPwd').value;
            const btn = document.getElementById('cpmSubmitRegBtn');

            btn.disabled = true;
            btn.innerHTML = '⏳ Đang khởi tạo tài khoản...';

            const formData = new FormData();
            formData.append('action', 'cpm_ajax_register');
            formData.append('security', cpmNonce);
            formData.append('full_name', name);
            formData.append('email', email);
            formData.append('pwd', pwd);

            fetch(cpmAjaxUrl, {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(res => {
                btn.disabled = false;
                btn.innerHTML = 'Đăng ký tài khoản';
                if (res.success) {
                    showCpmAuthAlert(res.data.message, 'success');
                    setTimeout(() => {
                        window.location.href = res.data.redirect_url;
                    }, 800);
                } else {
                    showCpmAuthAlert(res.data.message, 'error');
                }
            })
            .catch(err => {
                btn.disabled = false;
                btn.innerHTML = 'Đăng ký tài khoản';
                showCpmAuthAlert('Đã có lỗi xảy ra. Vui lòng thử lại!', 'error');
            });
        }

        // Xử lý Đăng Nhập Nhanh bằng Google
        function triggerGoogleOneTapLogin() {
            if (typeof google !== 'undefined' && google.accounts) {
                google.accounts.id.prompt();
            } else {
                const googleEmail = prompt("Nhập Email Google của bạn để kiểm tra Đăng nhập nhanh Google:", "user@gmail.com");
                if (googleEmail && googleEmail.includes('@')) {
                    sendGoogleAuthToWP({
                        email: googleEmail,
                        name: googleEmail.split('@')[0],
                        picture: '',
                        sub: 'google_user_' + Date.now()
                    });
                }
            }
        }

        function onGoogleAuthCallback(response) {
            if (response && response.credential) {
                try {
                    const base64Url = response.credential.split('.')[1];
                    const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
                    const jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
                        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
                    }).join(''));
                    const payload = JSON.parse(jsonPayload);
                    sendGoogleAuthToWP(payload);
                } catch(e) {
                    showCpmAuthAlert('Lỗi xử lý phản hồi từ Google!', 'error');
                }
            }
        }

        function sendGoogleAuthToWP(payload) {
            showCpmAuthAlert('⏳ Đang kết nối với Google...', 'success');
            const formData = new FormData();
            formData.append('action', 'cpm_ajax_google_login');
            formData.append('security', cpmNonce);
            formData.append('email', payload.email || '');
            formData.append('name', payload.name || '');
            formData.append('picture', payload.picture || '');
            formData.append('sub', payload.sub || '');

            fetch(cpmAjaxUrl, {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    showCpmAuthAlert(res.data.message, 'success');
                    setTimeout(() => {
                        window.location.href = res.data.redirect_url;
                    }, 800);
                } else {
                    showCpmAuthAlert(res.data.message, 'error');
                }
            })
            .catch(err => {
                showCpmAuthAlert('Không thể hoàn tất đăng nhập Google!', 'error');
            });
        }

        // Tự động chèn nút Đăng nhập / Đăng xuất lên Thanh Top Header (Thanh màu tím trên cùng)
        document.addEventListener('DOMContentLoaded', function() {
            const authBtn = document.getElementById('cpm-auth-wrapper');
            if (!authBtn) return;
            
            const targetHeader = document.querySelector('.top-right-box') || 
                                 document.querySelector('.track-box') || 
                                 document.querySelector('.top-inner-header');
                                 
            if (targetHeader && !targetHeader.contains(authBtn)) {
                targetHeader.appendChild(authBtn);
            }
        });
    </script>
    <?php
}
add_action('wp_footer', 'cpm_render_auth_modal');

/**
 * Shortcode [custom_auth_box] hoặc [custom_login_button]
 */
function cpm_auth_box_shortcode() {
    ob_start();
    $is_logged_in = is_user_logged_in();
    $current_user = wp_get_current_user();
    $logout_url = wp_logout_url(home_url());
    ?>
    <div class="cpm-auth-header-btn inline-flex items-center">
        <?php if ($is_logged_in) : ?>
            <div class="flex items-center gap-3">
                <span class="text-xs md:text-sm font-bold text-slate-700">👋 Chào, <?php echo esc_html($current_user->display_name); ?></span>
                <a href="<?php echo esc_url($logout_url); ?>" class="bg-red-50 hover:bg-red-100 text-red-600 font-bold text-xs px-3 py-1.5 rounded-lg border border-red-200 transition-colors">
                    Đăng xuất
                </a>
            </div>
        <?php else : ?>
            <button type="button" onclick="openCpmAuthModal('login')" class="bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs md:text-sm px-4 py-2 rounded-xl shadow-sm transition-all cursor-pointer border-none">
                🔑 Đăng nhập / Đăng ký
            </button>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('custom_auth_box', 'cpm_auth_box_shortcode');
add_shortcode('custom_login_button', 'cpm_auth_box_shortcode');
