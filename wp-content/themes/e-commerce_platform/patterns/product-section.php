<?php
/**
 * Title: Product Section
 * Slug: e-commerce_platform/product-section
 * Categories: e-commerce_platform
 *
 * @package E-Commerce Platform Theme
 * @since 1.0.0
 */
?>
<div class="wp-block-group product-section max-w-[1200px] mx-auto px-4 py-6 box-border">
    <!-- Section Header Title -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 pb-4 border-b border-slate-200 gap-2">
        <div>
            <span class="text-xs font-black uppercase tracking-wider text-blue-600 bg-blue-50 px-3 py-1 rounded-full">Sản Phẩm Nổi Bật</span>
            <h2 class="text-2xl md:text-3xl font-black text-slate-900 mt-2">🛍️ Danh Sách Sản Phẩm Nổi Bật</h2>
        </div>
        <a href="<?php echo esc_url(home_url('/san-pham/')); ?>" class="text-xs md:text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors no-underline">
            Xem tất cả sản phẩm ➔
        </a>
    </div>

    <!-- Render Custom Product Shortcode -->
    <?php echo do_shortcode('[danh_sach_san_pham]'); ?>
</div>
