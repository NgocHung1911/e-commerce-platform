<?php
/**
 * Title: Banner
 * Slug: e-commerce_platform/banner
 * Categories: e-commerce_platform
 *
 * @package E-Commerce Platform Theme
 * @since 1.0.0
 */
?>
<!-- wp:group {"className":"hero-banner-section","layout":{"type":"constrained","contentSize":"1200px"}} -->
<div class="wp-block-group hero-banner-section max-w-[1200px] mx-auto px-4 py-8 box-border">
    <div class="bg-gradient-to-r from-blue-900 via-indigo-900 to-slate-900 rounded-3xl p-8 md:p-12 text-white shadow-2xl relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-8">
        <div class="max-w-xl z-10">
            <span class="px-3.5 py-1.5 bg-blue-500/20 backdrop-blur-md rounded-full text-xs font-black uppercase tracking-wider text-blue-300 border border-blue-400/30">🔥 Ưu Đãi Đặc Biệt Hôm Nay</span>
            <h1 class="text-3xl md:text-5xl font-black mt-4 leading-tight text-white">Mua sắm dễ dàng,<br /><span class="bg-gradient-to-r from-blue-400 to-indigo-300 bg-clip-text text-transparent">Thanh toán SePay VietQR</span></h1>
            <p class="text-sm md:text-base text-slate-300 mt-3 mb-6">Khám phá hàng trăm sản phẩm công nghệ, thời trang và phụ kiện cao cấp với mức giá ưu đãi nhất thị trường. Tự động xác nhận thanh toán chỉ sau vài giây!</p>
            <div class="flex flex-wrap items-center gap-4">
                <a href="<?php echo esc_url(home_url('/san-pham/')); ?>" class="px-7 py-3.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-black text-sm md:text-base rounded-2xl shadow-xl hover:shadow-2xl hover:scale-105 transition-all no-underline inline-block">
                    🛍️ Khám phá sản phẩm ngay
                </a>
                <a href="<?php echo esc_url(home_url('/lien-he/')); ?>" class="px-6 py-3.5 bg-white/10 hover:bg-white/20 text-white font-bold text-sm md:text-base rounded-2xl backdrop-blur-md transition-all no-underline border border-white/20 inline-block">
                    📞 Liên hệ hỗ trợ
                </a>
            </div>
        </div>
        <div class="w-full md:w-auto flex justify-center z-10">
            <div class="w-72 h-72 md:w-80 md:h-80 bg-gradient-to-tr from-blue-600/30 to-indigo-500/30 rounded-3xl backdrop-blur-xl border border-white/20 p-6 flex flex-col justify-between shadow-2xl transform hover:rotate-2 transition-all">
                <div class="flex justify-between items-center">
                    <span class="text-2xl">📲</span>
                    <span class="px-2.5 py-1 bg-emerald-500/30 text-emerald-300 text-xs font-bold rounded-full border border-emerald-400/30">SePay Auto Pay</span>
                </div>
                <div class="text-center my-auto">
                    <div class="w-16 h-16 bg-white/10 rounded-2xl mx-auto flex items-center justify-center text-3xl mb-3 border border-white/20">⚡</div>
                    <p class="text-xs text-slate-300 font-medium">Tự động duyệt chuyển khoản</p>
                    <h3 class="text-lg font-black text-white mt-1">VietQR Tốc Độ Cao ⚡</h3>
                    <p class="text-[11px] text-slate-400 mt-1">Tự động tạo hóa đơn & gửi mã giao dịch chỉ sau 2 giây!</p>
                </div>
                <a href="<?php echo esc_url(home_url('/san-pham/')); ?>" class="w-full py-2.5 bg-white text-slate-900 font-bold text-xs rounded-xl text-center no-underline hover:bg-slate-100 transition-all shadow-md">
                    Xem danh mục ➔
                </a>
            </div>
        </div>
    </div>
</div>
