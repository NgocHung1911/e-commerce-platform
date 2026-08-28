<?php
/**
 * Theme Template Part: Chi Tiết Sản Phẩm (Single Product Detail View)
 * Path: template-parts/cpm/product-detail.php
 */

if (!defined('ABSPATH')) {
    exit;
}
// Passed variables: $post_id, $price, $sale_price, $sku, $button_text, $custom_image_url, $has_sale, $discount_percent, $img_src, $display_desc
?>
<style>
    .cpm-main-container {
        max-width: 1200px !important;
        width: 100% !important;
        margin: 35px auto !important;
        padding: 0 15px !important;
        box-sizing: border-box !important;
        display: block !important;
        clear: both !important;
    }
    .col-content,
    .sidebar-variation .col-content,
    div[style*="flex-basis:66.66%"],
    div[style*="flex-basis: 66.66%"] {
        flex-basis: 100% !important;
        max-width: 100% !important;
        width: 100% !important;
    }
    .sidebar-variation {
        display: block !important;
    }
    .cpm-detail-grid {
        display: grid !important;
        grid-template-columns: 1fr 1.2fr !important;
        gap: 32px !important;
        width: 100% !important;
        box-sizing: border-box !important;
        align-items: start !important;
    }
    @media (max-width: 768px) {
        .cpm-detail-grid {
            grid-template-columns: 1fr !important;
            gap: 20px !important;
        }
    }
</style>

<div class="cpm-main-container font-sans text-slate-800">
    <div class="cpm-detail-grid bg-white rounded-2xl p-6 md:p-8 shadow-md border border-slate-100 w-full box-border">
        <div class="relative bg-slate-50 rounded-2xl p-6 flex items-center justify-center border border-slate-200 overflow-hidden min-h-[350px] group w-full box-border">
            <?php if ($discount_percent > 0): ?>
                <div class="absolute top-4 left-4 bg-gradient-to-r from-rose-500 to-red-600 text-white text-xs font-extrabold px-3.5 py-1 rounded-full shadow-md z-10">
                    Giảm <?php echo $discount_percent; ?>%
                </div>
            <?php endif; ?>

            <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr(get_the_title($post_id)); ?>"
                class="max-w-full max-h-[460px] object-contain transition-transform duration-300 group-hover:scale-105" />
        </div>

        <div class="flex flex-col h-full justify-between w-full box-border">
            <div>
                <div class="flex items-center gap-3 mb-3 flex-wrap">
                    <?php if (!empty($sku)): ?>
                        <span class="bg-slate-100 text-slate-600 text-xs font-semibold px-2.5 py-1 rounded-md">SKU: <?php echo esc_html($sku); ?></span>
                    <?php endif; ?>
                    <span class="bg-emerald-50 text-emerald-600 text-xs font-bold px-2.5 py-1 rounded-md">✓ Còn hàng sẵn có</span>
                </div>

                <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 leading-tight mb-4 tracking-tight">
                    <?php echo get_the_title($post_id); ?>
                </h1>

                <div class="bg-slate-50 rounded-xl p-4 md:p-5 mb-6 flex items-baseline gap-3.5 border border-slate-200 flex-wrap">
                    <?php if ($has_sale): ?>
                        <span class="text-3xl font-black text-red-600"><?php echo number_format(floatval($sale_price), 0, ',', '.'); ?> đ</span>
                        <span class="text-lg font-medium text-slate-400 line-through"><?php echo number_format(floatval($price), 0, ',', '.'); ?> đ</span>
                    <?php elseif (!empty($price)): ?>
                        <span class="text-2xl font-black text-blue-600"><?php echo number_format(floatval($price), 0, ',', '.'); ?> đ</span>
                    <?php else: ?>
                        <span class="text-2xl font-black text-slate-500">Liên hệ đặt hàng</span>
                    <?php endif; ?>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-6 p-4 bg-white rounded-xl border border-dashed border-slate-300">
                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-700">
                        <span class="w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xs flex-shrink-0">🚚</span>
                        Giao hàng miễn phí 24/7
                    </div>
                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-700">
                        <span class="w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xs flex-shrink-0">🛡️</span>
                        Cam kết chính hãng 100%
                    </div>
                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-700">
                        <span class="w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xs flex-shrink-0">🔄</span>
                        Đổi trả trong 7 ngày
                    </div>
                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-700">
                        <span class="w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xs flex-shrink-0">⭐</span>
                        Bảo hành 12 tháng
                    </div>
                </div>
            </div>

            <div class="space-y-4 mt-auto pt-4 border-t border-slate-100">
                <div class="flex items-center gap-4">
                    <span class="text-sm font-bold text-slate-700">Số lượng:</span>
                    <div class="flex items-center border border-slate-300 rounded-xl overflow-hidden bg-slate-50 shadow-inner">
                        <button type="button" onclick="cpmDetailChangeQty(-1)" class="w-9 h-9 flex items-center justify-center text-slate-600 hover:bg-slate-200 font-black text-lg border-none cursor-pointer">
                            -
                        </button>
                        <input type="number" id="cpmDetailQtyInput" min="1" value="1" class="w-12 text-center text-base font-extrabold bg-transparent border-none outline-none text-slate-900" />
                        <button type="button" onclick="cpmDetailChangeQty(1)" class="w-9 h-9 flex items-center justify-center text-slate-600 hover:bg-slate-200 font-black text-lg border-none cursor-pointer">
                            +
                        </button>
                    </div>
                </div>

                <div class="flex gap-3.5 flex-col sm:flex-row">
                    <button type="button"
                        class="flex-1 inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 via-indigo-600 to-violet-600 hover:from-blue-700 hover:to-violet-700 text-white font-extrabold text-base py-3.5 px-6 rounded-2xl shadow-lg shadow-indigo-500/25 hover:shadow-xl hover:shadow-indigo-500/35 hover:-translate-y-0.5 transition-all duration-200 border-none cursor-pointer"
                        onclick="cpmDetailBuyNow(<?php echo $post_id; ?>, '<?php echo esc_js(get_the_title($post_id)); ?>')">
                        <span>⚡ MUA NGAY</span>
                    </button>

                    <button type="button"
                        class="flex-1 inline-flex items-center justify-center gap-2 bg-slate-900 hover:bg-slate-800 text-white font-bold text-base py-3.5 px-6 rounded-2xl shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 border-none cursor-pointer"
                        onclick="cpmDetailAddToCart(<?php echo $post_id; ?>, '<?php echo esc_js(get_the_title($post_id)); ?>')">
                        <span>🛒 Thêm vào giỏ</span>
                    </button>
                </div>
            </div>

            <script>
            function cpmDetailChangeQty(delta) {
                const input = document.getElementById('cpmDetailQtyInput');
                if (!input) return;
                let qty = parseInt(input.value) || 1;
                qty = Math.max(1, qty + delta);
                input.value = qty;
            }

            function cpmDetailAddToCart(productId, title) {
                const input = document.getElementById('cpmDetailQtyInput');
                const qty = input ? (parseInt(input.value) || 1) : 1;
                if (typeof cpmAddToCart === 'function') {
                    cpmAddToCart(title, productId, qty);
                }
            }

            function cpmDetailBuyNow(productId, title) {
                const input = document.getElementById('cpmDetailQtyInput');
                const qty = input ? (parseInt(input.value) || 1) : 1;
                if (typeof cpmBuyNow === 'function') {
                    cpmBuyNow(title, productId, qty);
                }
            }
            </script>
        </div>
    </div>

    <div class="mt-8 bg-white rounded-2xl p-6 md:p-8 border border-slate-100 shadow-sm w-full box-border">
        <h2 class="text-xl font-extrabold text-slate-900 mb-4 pb-3 border-b-2 border-slate-200">Mô tả sản phẩm</h2>
        <div class="text-sm md:text-base leading-relaxed text-slate-700 space-y-4">
            <?php
            if (!empty(trim(strip_tags($display_desc)))) {
                echo wpautop($display_desc);
            } else {
                echo '<p>Sản phẩm chất lượng cao, mẫu mã hiện đại. Vui lòng liên hệ trực tiếp để nhận tư vấn và giá ưu đãi tốt nhất.</p>';
            }
            ?>
        </div>
    </div>

    <?php
    $related_args = array(
        'post_type'      => 'custom_product',
        'posts_per_page' => 4,
        'post__not_in'   => array($post_id),
        'orderby'        => 'rand',
    );
    $related_query = new WP_Query($related_args);
    if ($related_query->have_posts()):
    ?>
    <div class="mt-8 bg-white rounded-2xl p-6 md:p-8 border border-slate-100 shadow-sm w-full box-border">
        <div class="flex items-center justify-between mb-6 pb-3 border-b-2 border-slate-200 flex-wrap gap-2">
            <h2 class="text-xl font-extrabold text-slate-900 flex items-center gap-2">
                <span>🛍️</span> Sản phẩm tương tự
            </h2>
            <span class="text-xs text-slate-500 font-medium">Gợi ý dành riêng cho bạn</span>
        </div>

        <div class="cpm-products-grid">
            <?php while ($related_query->have_posts()): $related_query->the_post(); ?>
                <?php echo cpm_render_product_card(get_the_ID()); ?>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
    <?php endif; ?>
</div>
