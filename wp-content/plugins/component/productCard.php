<?php
/**
 * Component Card Sản Phẩm Tái Sử Dụng (Reusable Product Card Component)
 * File: productCard.php (Module Plugin Component)
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (function_exists('cpm_render_product_card')) {
    return;
}

/**
 * Hàm render 1 Card sản phẩm tái sử dụng thống nhất ở mọi nơi
 *
 * @param int|WP_Post $post_id ID hoặc đối tượng bài viết sản phẩm
 * @param bool $echo Có in trực tiếp ra hay không (Mặc định false: trả về string HTML)
 * @return string HTML của Card sản phẩm
 */
function cpm_render_product_card($post_id = null, $echo = false) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    if (is_a($post_id, 'WP_Post')) {
        $post_id = $post_id->ID;
    }
    if (!$post_id) {
        return '';
    }

    $title = get_the_title($post_id);
    $permalink = get_permalink($post_id);
    $price = get_post_meta($post_id, '_product_price', true);
    $sale_price = get_post_meta($post_id, '_product_sale_price', true);
    $button_text = get_post_meta($post_id, '_product_button_text', true);
    $custom_image_url = get_post_meta($post_id, '_product_image_url', true);

    $content = get_post_field('post_content', $post_id);
    if (empty($price) && preg_match('/Giá gốc[^:\d]*[:\s]+([\d\.]+)/ui', $content, $m_price)) {
        $price = str_replace('.', '', $m_price[1]);
    }
    if (empty($sale_price) && preg_match('/Giá khuyến mãi[^:\d]*[:\s]+([\d\.]+)/ui', $content, $m_sale)) {
        $sale_price = str_replace('.', '', $m_sale[1]);
    }

    $has_sale = !empty($sale_price) && floatval($sale_price) < floatval($price);

    $default_svg = 'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="400" height="400" viewBox="0 0 400 400"><rect width="400" height="400" fill="%23f8fafc"/><path d="M170 180L190 150L230 200L250 170L290 220H110L170 180Z" fill="%23cbd5e1"/><circle cx="150" cy="140" r="20" fill="%23cbd5e1"/><text x="50%" y="78%" font-family="sans-serif" font-size="18" font-weight="bold" fill="%2394a3b8" text-anchor="middle">S%E1%BA%A3n%20ph%E1%BA%A9m</text></svg>';

    if (!empty($custom_image_url)) {
        $img_src = esc_url($custom_image_url);
    } elseif (has_post_thumbnail($post_id)) {
        $img_src = get_the_post_thumbnail_url($post_id, 'medium');
    } else {
        $img_src = $default_svg;
    }

    if (empty($button_text)) {
        $button_text = 'Mua ngay';
    }

    ob_start();
    ?>
    <!-- Card Sản Phẩm Tái Sử Dụng -->
    <div class="cpm-card-item group relative flex flex-col h-full bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-200 box-border">
        <?php if (!empty($has_sale)) : ?>
            <!-- Badge Giảm Giá -->
            <span class="absolute top-2 right-2 z-10 bg-rose-500 text-white text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded shadow-sm">Giảm giá</span>
        <?php endif; ?>

        <!-- 1. Ảnh sản phẩm (Tỉ lệ 4:3) -->
        <div class="w-full aspect-[4/3] bg-slate-50 overflow-hidden relative flex items-center justify-center p-2">
            <a href="<?php echo esc_url($permalink); ?>" class="w-full h-full flex items-center justify-center">
                <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr($title); ?>" class="max-w-full max-h-full object-contain transition-transform duration-300 group-hover:scale-105" />
            </a>
        </div>

        <!-- Thân Card -->
        <div class="flex flex-col flex-1 p-3">
            <!-- 2. Tên sản phẩm -->
            <h3 class="text-sm font-semibold text-slate-800 line-clamp-2 h-[2.7em] mb-1.5 leading-snug">
                <a href="<?php echo esc_url($permalink); ?>" class="hover:text-blue-600 transition-colors"><?php echo esc_html($title); ?></a>
            </h3>

            <!-- 3. Giá sản phẩm -->
            <div class="flex items-baseline gap-1.5 min-h-[20px] mt-auto mb-2.5 flex-wrap">
                <?php if (!empty($has_sale)) : ?>
                    <span class="text-base font-bold text-red-600"><?php echo number_format(floatval($sale_price), 0, ',', '.'); ?> đ</span>
                    <span class="text-xs text-slate-400 line-through"><?php echo number_format(floatval($price), 0, ',', '.'); ?> đ</span>
                <?php elseif (!empty($price)) : ?>
                    <span class="text-sm font-bold text-slate-900"><?php echo number_format(floatval($price), 0, ',', '.'); ?> đ</span>
                <?php else : ?>
                    <span class="text-sm font-semibold text-slate-500">Liên hệ</span>
                <?php endif; ?>
            </div>

            <!-- 4. Nút thao tác (Ép 2 nút nằm cùng 1 hàng ngang) -->
            <div class="cpm-product-actions">
                <button type="button" class="cpm-btn-buy inline-flex items-center justify-center text-center bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl py-2.5 px-3 text-xs border border-blue-600 cursor-pointer shadow-sm hover:shadow transition-all" onclick="cpmBuyNow('<?php echo esc_js($title); ?>', <?php echo $post_id; ?>)">
                    <span><?php echo esc_html($button_text); ?></span>
                </button>
                <button type="button" class="cpm-btn-add-cart inline-flex items-center justify-center text-center bg-slate-50 hover:bg-blue-50 text-blue-600 font-bold rounded-xl py-2.5 px-3 text-xs border border-slate-300 hover:border-blue-600 cursor-pointer transition-all flex items-center justify-center gap-1" onclick="cpmAddToCart('<?php echo esc_js($title); ?>')">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                    <span>Thêm giỏ</span>
                </button>
            </div>
        </div>
    </div>
    <?php
    $output = ob_get_clean();

    if ($echo) {
        echo $output;
    }
    return $output;
}

/**
 * Shortcode kết quả tìm kiếm sản phẩm: [cpm_search_results]
 */
function cpm_search_results_shortcode() {
    $search_term = get_search_query();
    if (empty($search_term) && isset($_GET['s'])) {
        $search_term = sanitize_text_field($_GET['s']);
    }

    $args = array(
        'post_type'      => array('custom_product', 'product'),
        'posts_per_page' => 16,
        'post_status'    => 'publish'
    );

    if (!empty($search_term)) {
        $args['s'] = $search_term;
    }

    $query = new WP_Query($args);
    ob_start();
    ?>
    <div class="w-full font-sans box-border">
        <?php if ($query->have_posts()) : ?>
            <div class="cpm-products-grid">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <?php echo cpm_render_product_card(get_the_ID()); ?>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        <?php else : ?>
            <div class="bg-white rounded-2xl p-10 text-center border border-slate-200 shadow-sm max-w-lg mx-auto my-8">
                <div class="w-16 h-16 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                    🔍
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Không tìm thấy sản phẩm</h3>
                <p class="text-sm text-slate-500 mb-6">Không tìm thấy sản phẩm nào khớp với từ khóa "<strong><?php echo esc_html($search_term); ?></strong>". Thử tìm kiếm với từ khóa khác xem sao!</p>
                <a href="<?php echo esc_url(home_url('/san-pham/')); ?>" class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl shadow-md transition-all no-underline">
                    🛍️ Xem toàn bộ sản phẩm
                </a>
            </div>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('cpm_search_results', 'cpm_search_results_shortcode');
