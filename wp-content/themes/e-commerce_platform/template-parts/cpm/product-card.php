<?php
/**
 * Theme Template Part: Thẻ sản phẩm (Product Card Component)
 * Path: wp-content/themes/e-commerce_platform/template-parts/cpm/product-card.php
 */

if (!defined('ABSPATH')) {
    exit;
}

// Variables passed: $post_id, $title, $permalink, $img_src, $price, $sale_price, $has_sale, $button_text
?>
<div class="cpm-card-item group relative flex flex-col h-full bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-200 box-border">
    <?php if (!empty($has_sale)) : ?>
        <span class="absolute top-2 right-2 z-10 bg-rose-500 text-white text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded shadow-sm">Giảm giá</span>
    <?php endif; ?>

    <div class="w-full aspect-[4/3] bg-slate-50 overflow-hidden relative flex items-center justify-center p-2">
        <a href="<?php echo esc_url($permalink); ?>" class="w-full h-full flex items-center justify-center">
            <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr($title); ?>" class="max-w-full max-h-full object-contain transition-transform duration-300 group-hover:scale-105" />
        </a>
    </div>

    <div class="flex flex-col flex-1 p-3">
        <h3 class="text-sm font-semibold text-slate-800 line-clamp-2 h-[2.7em] mb-1.5 leading-snug">
            <a href="<?php echo esc_url($permalink); ?>" class="hover:text-blue-600 transition-colors"><?php echo esc_html($title); ?></a>
        </h3>

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
