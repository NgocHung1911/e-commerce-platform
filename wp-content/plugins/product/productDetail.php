<?php
/**
 * Giao diện Trang Chi Tiết Sản Phẩm (Single Product Detail View)
 * Tích hợp Tailwind CSS v3 & Fix Căn Giữa 1200px Chuẩn
 * File: productDetail.php
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Hàm hiển thị giao diện chi tiết sản phẩm dùng Tailwind CSS
 */
function cpm_render_single_product_detail($content = '')
{
    if (!is_singular('custom_product')) {
        return $content;
    }

    $post_id = get_the_ID();
    if (!$post_id) {
        return $content;
    }

    $price = get_post_meta($post_id, '_product_price', true);
    $sale_price = get_post_meta($post_id, '_product_sale_price', true);
    $sku = get_post_meta($post_id, '_product_sku', true);
    $button_text = get_post_meta($post_id, '_product_button_text', true);
    $custom_image_url = get_post_meta($post_id, '_product_image_url', true);

    // Tự động bóc tách thông tin từ văn bản mô tả nếu chưa nhập Meta Box
    $raw_content = get_the_content(null, false, $post_id);
    if (empty($price) && preg_match('/Giá gốc[^:\d]*[:\s]+([\d\.]+)/ui', $raw_content, $m_price)) {
        $price = str_replace('.', '', $m_price[1]);
    }
    if (empty($sale_price) && preg_match('/Giá khuyến mãi[^:\d]*[:\s]+([\d\.]+)/ui', $raw_content, $m_sale)) {
        $sale_price = str_replace('.', '', $m_sale[1]);
    }

    if (empty($button_text)) {
        $button_text = 'Mua ngay';
    }

    $has_sale = !empty($sale_price) && floatval($sale_price) < floatval($price);

    // Tính % giảm giá nếu có
    $discount_percent = 0;
    if ($has_sale && floatval($price) > 0) {
        $discount_percent = round(((floatval($price) - floatval($sale_price)) / floatval($price)) * 100);
    }

    // Inline SVG Placeholder nếu sản phẩm chưa được chọn ảnh
    $default_placeholder_svg = 'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="600" height="450" viewBox="0 0 600 450"><rect width="600" height="450" fill="%23f1f5f9"/><path d="M260 210L290 180L340 230L370 200L420 250H180L260 210Z" fill="%23cbd5e1"/><circle cx="230" cy="170" r="25" fill="%23cbd5e1"/><text x="50%" y="82%" font-family="sans-serif" font-size="22" font-weight="bold" fill="%2394a3b8" text-anchor="middle">Ch%C6%B0a%20ch%E1%BB%8Dn%20%E1%BA%A3nh%20s%E1%BA%A3n%20ph%E1%BA%A9m</text></svg>';

    // Chọn ảnh sản phẩm
    if (!empty($custom_image_url)) {
        $img_src = esc_url($custom_image_url);
    } elseif (has_post_thumbnail($post_id)) {
        $img_src = get_the_post_thumbnail_url($post_id, 'large');
    } else {
        $img_src = $default_placeholder_svg;
    }

    $display_desc = !empty(trim(strip_tags($content))) ? $content : $raw_content;

    ob_start();
    ?>
    <style>
        /* Container Căn Giữa 1200px Chuẩn cho Sản Phẩm */
        .cpm-main-container {
            max-width: 1200px !important;
            width: 100% !important;
            margin: 35px auto !important;
            padding: 0 15px !important;
            box-sizing: border-box !important;
            display: block !important;
            clear: both !important;
        }

        /* Ghi đè hủy bỏ giới hạn cột 66.66% của Theme/Gutenberg nếu có */
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

        /* Grid 2 Cột Đối Xứng (1fr 1.2fr) */
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
        <!-- Khung 1: Ảnh & Thông tin sản phẩm (2 Cột Grid 1fr 1.2fr) -->
        <div class="cpm-detail-grid bg-white rounded-2xl p-6 md:p-8 shadow-md border border-slate-100 w-full box-border">
            <!-- Cột trái (1fr): Ảnh sản phẩm + Badge -->
            <div class="relative bg-slate-50 rounded-2xl p-6 flex items-center justify-center border border-slate-200 overflow-hidden min-h-[350px] group w-full box-border">
                <?php if ($discount_percent > 0): ?>
                    <div class="absolute top-4 left-4 bg-gradient-to-r from-rose-500 to-red-600 text-white text-xs font-extrabold px-3.5 py-1 rounded-full shadow-md z-10">
                        Giảm <?php echo $discount_percent; ?>%
                    </div>
                <?php endif; ?>

                <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr(get_the_title($post_id)); ?>"
                    class="max-w-full max-h-[460px] object-contain transition-transform duration-300 group-hover:scale-105" />
            </div>

            <!-- Cột phải (1.2fr): Thông tin sản phẩm -->
            <div class="flex flex-col h-full justify-between w-full box-border">
                <div>
                    <!-- SKU & Tình trạng hàng -->
                    <div class="flex items-center gap-3 mb-3 flex-wrap">
                        <?php if (!empty($sku)): ?>
                            <span class="bg-slate-100 text-slate-600 text-xs font-semibold px-2.5 py-1 rounded-md">SKU: <?php echo esc_html($sku); ?></span>
                        <?php endif; ?>
                        <span class="bg-emerald-50 text-emerald-600 text-xs font-bold px-2.5 py-1 rounded-md">✓ Còn hàng sẵn có</span>
                    </div>

                    <!-- Tên sản phẩm -->
                    <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 leading-tight mb-4 tracking-tight">
                        <?php echo get_the_title($post_id); ?>
                    </h1>

                    <!-- Thẻ Giá Sản Phẩm -->
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

                    <!-- Quyền Lợi Đi Kèm -->
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

                <!-- Chọn Số Lượng & Nút Thao Tác -->
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
                        <!-- Nút Mua ngay (Thanh toán trực tiếp) -->
                        <button type="button"
                            class="flex-1 inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 via-indigo-600 to-violet-600 hover:from-blue-700 hover:to-violet-700 text-white font-extrabold text-base py-3.5 px-6 rounded-2xl shadow-lg shadow-indigo-500/25 hover:shadow-xl hover:shadow-indigo-500/35 hover:-translate-y-0.5 transition-all duration-200 border-none cursor-pointer"
                            onclick="cpmDetailBuyNow(<?php echo $post_id; ?>, '<?php echo esc_js(get_the_title($post_id)); ?>')">
                            <span>⚡ MUA NGAY</span>
                        </button>

                        <!-- Nút Thêm vào giỏ -->
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

        <!-- Khung 2: Mô tả chi tiết sản phẩm bên dưới (Cùng chiều rộng 1200px) -->
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

        <!-- Khung 3: Các sản phẩm tương tự trong hệ thống -->
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
    <?php
    return ob_get_clean();
}

/**
 * Ngăn chặn Theme cắt nuốt thẻ HTML (strip_tags) khi gọi get_the_excerpt()
 */
function cpm_override_single_product_excerpt($excerpt)
{
    if (is_singular('custom_product')) {
        return cpm_render_single_product_detail();
    }
    return $excerpt;
}
add_filter('get_the_excerpt', 'cpm_override_single_product_excerpt', 1);

/**
 * Đăng ký shortcode [chi_tiet_san_pham] để có thể dán vào bất cứ trang nào
 */
add_shortcode('chi_tiet_san_pham', 'cpm_render_single_product_detail');
add_shortcode('product_detail', 'cpm_render_single_product_detail');
