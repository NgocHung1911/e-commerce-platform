<?php
/**
 * Module Hiển Thị Danh Sách Sản Phẩm Có Phân Trang (Shortcode [danh_sach_san_pham] & [custom_products])
 * Tích hợp Tailwind CSS v3 & 12 Sản phẩm / trang có Phân trang hiện đại
 * File: productList.php
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Nạp Tailwind CSS v3 & Bộ quy tắc Ép Căn Trái + 2 Nút Ngang Hàng
 */
function cpm_enqueue_tailwind_cdn() {
    ?>
    <!-- Tailwind CSS v3 CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style id="cpm-fix-layout-styles">
        /* Lưới sản phẩm căn giữa 4 cột đáp ứng (Responsive Grid) */
        .cpm-products-grid {
            display: grid !important;
            grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
            gap: 24px !important;
            margin: 24px 0 !important;
            width: 100% !important;
            box-sizing: border-box !important;
        }

        @media (max-width: 1024px) {
            .cpm-products-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
            }
        }
        @media (max-width: 768px) {
            .cpm-products-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            }
        }
        @media (max-width: 480px) {
            .cpm-products-grid {
                grid-template-columns: repeat(1, minmax(0, 1fr)) !important;
            }
        }

        /* Ép 2 nút Mua ngay & Thêm giỏ NẰM CÙNG 1 HÀNG NGANG */
        .cpm-product-actions {
            display: flex !important;
            flex-direction: row !important;
            align-items: center !important;
            gap: 8px !important;
            width: 100% !important;
            margin-top: auto !important;
            box-sizing: border-box !important;
        }

        .cpm-product-actions > .cpm-btn-buy,
        .cpm-product-actions > .cpm-btn-add-cart {
            flex: 1 1 50% !important;
            width: 50% !important;
            min-width: 0 !important;
            height: 38px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-size: 13px !important;
            font-weight: 700 !important;
            padding: 0 8px !important;
            border-radius: 10px !important;
            white-space: nowrap !important;
            box-sizing: border-box !important;
            text-align: center !important;
            transition: all 0.2s ease !important;
            cursor: pointer !important;
            text-decoration: none !important;
            gap: 4px !important;
        }

        .cpm-product-actions > .cpm-btn-buy {
            background-color: #2563eb !important;
            color: #ffffff !important;
            border: 1px solid #2563eb !important;
            box-shadow: 0 2px 4px rgba(37, 99, 235, 0.2) !important;
        }
        .cpm-product-actions > .cpm-btn-buy:hover {
            background-color: #1d4ed8 !important;
            border-color: #1d4ed8 !important;
            box-shadow: 0 4px 8px rgba(37, 99, 235, 0.3) !important;
            transform: translateY(-1px) !important;
        }

        .cpm-product-actions > .cpm-btn-add-cart {
            background-color: #f8fafc !important;
            color: #2563eb !important;
            border: 1px solid #cbd5e1 !important;
        }
        .cpm-product-actions > .cpm-btn-add-cart:hover {
            background-color: #eff6ff !important;
            border-color: #2563eb !important;
            transform: translateY(-1px) !important;
        }

        /* Phân trang Custom CSS */
        .cpm-pagination-link {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            min-width: 40px !important;
            height: 40px !important;
            padding: 0 14px !important;
            border-radius: 12px !important;
            font-size: 13px !important;
            font-weight: 700 !important;
            transition: all 0.2s ease !important;
            text-decoration: none !important;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05) !important;
        }
        .cpm-pagination-link.active {
            background: linear-gradient(135deg, #2563eb, #1d4ed8) !important;
            color: #ffffff !important;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3) !important;
        }
        .cpm-pagination-link.inactive {
            background-color: #ffffff !important;
            color: #334155 !important;
            border: 1px solid #e2e8f0 !important;
        }
        .cpm-pagination-link.inactive:hover {
            background-color: #f1f5f9 !important;
            color: #2563eb !important;
            border-color: #93c5fd !important;
            transform: translateY(-1px) !important;
        }
    </style>
    <?php
}
add_action('wp_head', 'cpm_enqueue_tailwind_cdn');

/**
 * Shortcode hiển thị danh sách sản phẩm có Phân Trang (Mặc định 12 sản phẩm / trang)
 */
function cpm_products_shortcode($atts) {
    static $already_rendered = false;
    if ($already_rendered && !is_admin() && !defined('REST_REQUEST')) {
        return '';
    }
    $already_rendered = true;

    $atts = shortcode_atts(array(
        'posts_per_page' => 12,
        'columns'        => 4,
        'orderby'        => 'date',
        'order'          => 'DESC'
    ), $atts, 'danh_sach_san_pham');

    $paged = (get_query_var('paged')) ? get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);

    $args = array(
        'post_type'      => array('custom_product', 'product'),
        'posts_per_page' => intval($atts['posts_per_page']),
        'paged'          => $paged,
        'orderby'        => sanitize_text_field($atts['orderby']),
        'order'          => sanitize_text_field($atts['order']),
        'post_status'    => 'publish'
    );

    $query = new WP_Query($args);

    ob_start();
    ?>

    <div class="max-w-[1200px] mx-auto my-8 px-4 font-sans box-border">
        <?php if ($query->have_posts()) : ?>
            <!-- Lưới Sản Phẩm Căn Giữa Chuẩn Layout -->
            <div class="cpm-products-grid">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <?php echo cpm_render_product_card(get_the_ID()); ?>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>

            <!-- Thanh Phân Trang (Pagination) -->
            <?php if ($query->max_num_pages > 1) : ?>
                <div class="cpm-pagination flex items-center justify-center gap-2 mt-10 mb-6 w-full flex-wrap">
                    <?php
                    $big = 999999999;
                    $pagination_links = paginate_links(array(
                        'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                        'format'    => '?paged=%#%',
                        'current'   => max(1, $paged),
                        'total'     => $query->max_num_pages,
                        'prev_text' => '← Trang trước',
                        'next_text' => 'Trang sau →',
                        'type'      => 'array',
                        'mid_size'  => 2
                    ));

                    if (!empty($pagination_links)) {
                        foreach ($pagination_links as $link) {
                            if (strpos($link, 'current') !== false) {
                                echo str_replace(
                                    'class="page-numbers current"',
                                    'class="cpm-pagination-link active"',
                                    $link
                                );
                            } else {
                                echo str_replace(
                                    'class="page-numbers',
                                    'class="cpm-pagination-link inactive',
                                    $link
                                );
                            }
                        }
                    }
                    ?>
                </div>
            <?php endif; ?>

            <!-- Toast Notification -->
            <div id="cpm-toast" class="cpm-toast-notification fixed top-6 right-6 bg-slate-900 text-white py-3 px-4 rounded-xl shadow-2xl z-[99999] text-sm font-medium flex items-center gap-2.5 opacity-0 -translate-y-4 pointer-events-none transition-all duration-300">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                <span id="cpm-toast-msg">Đã thêm sản phẩm vào giỏ hàng!</span>
            </div>
        <?php else : ?>
            <div class="p-8 bg-slate-50 border border-dashed border-slate-300 rounded-xl text-center text-slate-500 font-medium w-full">
                Chưa có sản phẩm nào. Hãy truy cập Trang quản trị (Admin) -> menu <strong>Sản phẩm</strong> để thêm sản phẩm mới.
            </div>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Đăng ký shortcode [danh_sach_san_pham] và [custom_products]
 */
add_shortcode('danh_sach_san_pham', 'cpm_products_shortcode');
add_shortcode('custom_products', 'cpm_products_shortcode');

/**
 * Tùy chỉnh bộ lọc hiển thị tóm tắt trang sản phẩm nếu cần
 */
add_filter('excerpt_more', function($more) {
    if (get_post_type() === 'custom_product') {
        return '';
    }
    return $more;
}, 999);
