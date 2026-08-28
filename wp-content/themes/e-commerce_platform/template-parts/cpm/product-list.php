<?php
/**
 * Theme Template Part: Danh Sách Sản Phẩm (Product List Grid & Pagination & Live AJAX Filter)
 * Path: template-parts/cpm/product-list.php
 */

if (!defined('ABSPATH')) {
    exit;
}
// Passed variables: $query, $paged
$search_term = isset($_GET['search_kw']) ? sanitize_text_field($_GET['search_kw']) : (get_search_query() ? get_search_query() : (isset($_GET['s']) ? sanitize_text_field($_GET['s']) : ''));
$sort_by = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : 'date_desc';
?>
<div class="max-w-[1200px] mx-auto my-8 px-4 font-sans box-border text-left">
    <!-- Khung Bộ Lọc & Tìm Kiếm Sản Phẩm Tức Thời AJAX -->
    <form id="cpm-filter-form" onsubmit="triggerCpmAjaxFilter(event)" class="mb-8 p-6 bg-white rounded-3xl border border-slate-200 shadow-sm flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4 box-border">
        <!-- 1. Ô Nhập Tìm Kiếm Tên Sản Phẩm -->
        <div class="flex-1 relative">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-base">🔍</span>
            <input type="search" id="cpm-search-input" name="search_kw" value="<?php echo esc_attr($search_term); ?>" oninput="debounceCpmAjaxFilter()" placeholder="Nhập tên sản phẩm cần tìm kiếm..." class="w-full pl-11 pr-4 py-3 rounded-2xl border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm outline-none transition-all box-border bg-slate-50/60" />
        </div>

        <!-- 2. Bộ Lọc Sắp Xếp Theo Giá & Thời Gian -->
        <div class="w-full md:w-60">
            <select id="cpm-sort-select" name="orderby" onchange="triggerCpmAjaxFilter(event)" class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm outline-none transition-all box-border bg-slate-50/60 cursor-pointer font-medium text-slate-700">
                <option value="date_desc" <?php selected($sort_by, 'date_desc'); ?>>📅 Sắp xếp: Mới nhất</option>
                <option value="date_asc" <?php selected($sort_by, 'date_asc'); ?>>📜 Sắp xếp: Cũ nhất</option>
                <option value="price_asc" <?php selected($sort_by, 'price_asc'); ?>>💰 Giá: Thấp đến Cao</option>
                <option value="price_desc" <?php selected($sort_by, 'price_desc'); ?>>💎 Giá: Cao đến Thấp</option>
                <option value="title_asc" <?php selected($sort_by, 'title_asc'); ?>>🔤 Tên sản phẩm A - Z</option>
            </select>
        </div>

        <!-- 3. Nút Thực Thi Lọc & Đặt Lại -->
        <div class="flex items-center gap-2">
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold text-sm rounded-2xl shadow-md hover:shadow-lg transition-all border-none cursor-pointer flex items-center justify-center gap-2 whitespace-nowrap">
                🔍 Tìm & Lọc
            </button>

            <button type="button" id="cpm-reset-btn" onclick="resetCpmAjaxFilter()" style="<?php echo (empty($search_term) && (empty($_GET['orderby']) || $_GET['orderby'] === 'date_desc')) ? 'display:none;' : 'display:inline-flex;'; ?>" class="px-4 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-sm rounded-2xl transition-all border-none cursor-pointer flex items-center justify-center whitespace-nowrap" title="Đặt lại bộ lọc">
                ✕ Đặt lại
            </button>
        </div>
    </form>

    <!-- Khung Danh Sách Sản Phẩm Nạp Động AJAX (Không load trang) -->
    <div id="cpm-product-grid-container" class="transition-all duration-300">
        <?php if ($query->have_posts()) : ?>
            <div class="cpm-products-grid text-left">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <?php echo cpm_render_product_card(get_the_ID()); ?>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>

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
        <?php else : ?>
            <div class="bg-white rounded-3xl p-10 md:p-14 text-center border border-slate-200 shadow-sm max-w-lg mx-auto my-6">
                <div class="w-16 h-16 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">🔍</div>
                <h3 class="text-xl font-extrabold text-slate-900 mb-2">Không tìm thấy sản phẩm nào</h3>
                <p class="text-sm text-slate-500 mb-6">
                    Rất tiếc, không tìm thấy sản phẩm nào phù hợp với bộ lọc đã chọn. Vui lòng thử lại với từ khóa hoặc tùy chọn khác!
                </p>
                <button type="button" onclick="resetCpmAjaxFilter()" class="inline-block px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold text-sm rounded-xl shadow-lg border-none cursor-pointer">
                    🛍️ Xem tất cả sản phẩm
                </button>
            </div>
        <?php endif; ?>
    </div>

    <!-- Toast Notification -->
    <div id="cpm-toast" class="cpm-toast-notification fixed top-6 right-6 bg-slate-900 text-white py-3 px-4 rounded-xl shadow-2xl z-[99999] text-sm font-medium flex items-center gap-2.5 opacity-0 -translate-y-4 pointer-events-none transition-all duration-300">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
        <span id="cpm-toast-msg">Đã thêm sản phẩm vào giỏ hàng!</span>
    </div>
</div>

<script>
    let cpmSearchDebounceTimer = null;

    function triggerCpmAjaxFilter(e, paged = 1) {
        if (e) e.preventDefault();

        const searchKw = document.getElementById('cpm-search-input').value.trim();
        const orderBy = document.getElementById('cpm-sort-select').value;
        const resetBtn = document.getElementById('cpm-reset-btn');
        const gridContainer = document.getElementById('cpm-product-grid-container');

        if (!gridContainer) return;

        // Toggle reset button
        if (resetBtn) {
            if (searchKw !== '' || orderBy !== 'date_desc') {
                resetBtn.style.display = 'inline-flex';
            } else {
                resetBtn.style.display = 'none';
            }
        }

        gridContainer.style.opacity = '0.4';
        gridContainer.style.pointerEvents = 'none';

        const formData = new FormData();
        formData.append('action', 'cpm_filter_products');
        formData.append('search_kw', searchKw);
        formData.append('orderby', orderBy);
        formData.append('paged', paged);

        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(res => {
            gridContainer.style.opacity = '1';
            gridContainer.style.pointerEvents = 'auto';
            if (res.success && res.data && res.data.html) {
                gridContainer.innerHTML = res.data.html;
            }
        })
        .catch(err => {
            gridContainer.style.opacity = '1';
            gridContainer.style.pointerEvents = 'auto';
        });
    }

    function debounceCpmAjaxFilter() {
        clearTimeout(cpmSearchDebounceTimer);
        cpmSearchDebounceTimer = setTimeout(function () {
            triggerCpmAjaxFilter();
        }, 300);
    }

    function resetCpmAjaxFilter() {
        const searchInput = document.getElementById('cpm-search-input');
        const sortSelect = document.getElementById('cpm-sort-select');
        if (searchInput) searchInput.value = '';
        if (sortSelect) sortSelect.value = 'date_desc';
        triggerCpmAjaxFilter();
    }
</script>
