<?php
/**
 * Theme Template Part: Trang Giỏ Hàng & Form Thanh Toán VietQR SePay
 * Path: wp-content/themes/e-commerce_platform/template-parts/cpm/cart-page.php
 */

if (!defined('ABSPATH')) {
    exit;
}
// Passed variables: $cart_items, $current_user, $grand_total, $ajax_url, $nonce
?>
<div id="cpm-cart-wrapper" class="max-w-[1200px] mx-auto my-8 px-4 font-sans text-slate-800 box-border">
    <?php if (!is_user_logged_in()) : ?>
        <div class="bg-white rounded-2xl p-8 text-center border border-slate-200 shadow-md max-w-md mx-auto">
            <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">🔒</div>
            <h3 class="text-xl font-extrabold text-slate-900 mb-2">Vui lòng đăng nhập</h3>
            <p class="text-sm text-slate-500 mb-6">Bạn cần đăng nhập tài khoản để xem và quản lý danh sách sản phẩm trong giỏ hàng.</p>
            <button type="button" onclick="if(typeof openCpmAuthModal==='function'){openCpmAuthModal('login');}else{window.location.href='<?php echo esc_url(wp_login_url(get_permalink())); ?>';}" class="w-full py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold text-sm rounded-xl shadow-lg transition-all border-none cursor-pointer">
                🔑 Đăng nhập / Đăng ký ngay
            </button>
        </div>
    <?php else : 
        if (empty($cart_items)) : ?>
            <div id="cpm-cart-empty-state" class="bg-white rounded-2xl p-10 text-center border border-slate-100 shadow-sm max-w-lg mx-auto">
                <div class="w-20 h-20 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">🛒</div>
                <h3 class="text-2xl font-black text-slate-900 mb-2">Giỏ hàng của bạn đang trống</h3>
                <p class="text-sm text-slate-500 mb-6">Hãy khám phá danh sách sản phẩm và lựa chọn những món hàng ưng ý nhé!</p>
                <a href="<?php echo esc_url(home_url('/san-pham/')); ?>" class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl shadow-md transition-all no-underline">
                    🛍️ Tiếp tục mua sắm
                </a>
            </div>
        <?php else : ?>
            <div id="cpm-cart-main-content">
                <h1 id="cpm-cart-header-title" class="text-2xl md:text-3xl font-black text-slate-900 mb-6 pb-3 border-b-2 border-slate-200">
                    Giỏ hàng của bạn (<span id="cpm-cart-distinct-count"><?php echo count($cart_items); ?></span> sản phẩm)
                </h1>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                    <div id="cpm-cart-items-list" class="lg:col-span-2 space-y-4">
                        <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-sm flex items-center justify-between">
                            <label class="flex items-center gap-3 text-sm font-bold text-slate-800 cursor-pointer">
                                <input type="checkbox" id="cpm-cart-select-all" checked onchange="cpmToggleCartSelectAll(this.checked)" class="w-5 h-5 text-blue-600 rounded cursor-pointer accent-blue-600" />
                                <span>Chọn tất cả (<span id="cpm-selected-items-count"><?php echo count($cart_items); ?></span> / <?php echo count($cart_items); ?> sản phẩm)</span>
                            </label>
                        </div>

                        <?php 
                        $default_placeholder_svg = 'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="%23f1f5f9"/><text x="50%" y="55%" font-size="12" fill="%2394a3b8" text-anchor="middle">No Image</text></svg>';

                        foreach ($cart_items as $item) : 
                            $post_id = $item->product_id;
                            $product = get_post($post_id);
                            if (!$product || $product->post_status !== 'publish') {
                                continue;
                            }

                            $title = get_the_title($post_id);
                            $price = get_post_meta($post_id, '_product_price', true);
                            $sale_price = get_post_meta($post_id, '_product_sale_price', true);
                            $sku = get_post_meta($post_id, '_product_sku', true);
                            $custom_img = get_post_meta($post_id, '_product_image_url', true);

                            $unit_price = (!empty($sale_price) && floatval($sale_price) < floatval($price)) ? floatval($sale_price) : floatval($price);
                            $item_subtotal = $unit_price * $item->quantity;

                            if (!empty($custom_img)) {
                                $img_src = esc_url($custom_img);
                            } elseif (has_post_thumbnail($post_id)) {
                                $img_src = get_the_post_thumbnail_url($post_id, 'thumbnail');
                            } else {
                                $img_src = $default_placeholder_svg;
                            }
                        ?>
                            <div id="cpm-cart-row-<?php echo $item->id; ?>" class="bg-white rounded-2xl p-4 md:p-5 border border-slate-100 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4 transition-all hover:shadow-md">
                                <div class="flex items-center gap-3 w-full sm:w-auto">
                                    <input type="checkbox" class="cpm-cart-item-select w-5 h-5 text-blue-600 rounded cursor-pointer accent-blue-600 flex-shrink-0" data-cart-id="<?php echo $item->id; ?>" data-product-id="<?php echo $post_id; ?>" data-subtotal="<?php echo $item_subtotal; ?>" data-qty="<?php echo $item->quantity; ?>" checked onchange="cpmRecalculateSelectedCartTotals()" />
                                    <img src="<?php echo $img_src; ?>" alt="<?php echo esc_attr($title); ?>" class="w-16 h-16 md:w-20 md:h-20 object-contain rounded-xl bg-slate-50 border border-slate-200 p-2 flex-shrink-0" />
                                    <div>
                                        <a href="<?php echo get_permalink($post_id); ?>" class="text-sm md:text-base font-bold text-slate-900 hover:text-blue-600 transition-colors no-underline block line-clamp-2">
                                            <?php echo esc_html($title); ?>
                                        </a>
                                        <?php if (!empty($sku)) : ?>
                                            <span class="text-xs text-slate-400 font-semibold">SKU: <?php echo esc_html($sku); ?></span>
                                        <?php endif; ?>
                                        <p class="text-sm font-extrabold text-blue-600 mt-1 sm:hidden">
                                            <?php echo number_format($unit_price, 0, ',', '.'); ?> đ
                                        </p>
                                    </div>
                                </div>

                                <div class="hidden sm:block text-right">
                                    <span class="text-xs text-slate-400 block font-semibold">Đơn giá</span>
                                    <span class="text-sm font-bold text-slate-800"><?php echo number_format($unit_price, 0, ',', '.'); ?> đ</span>
                                </div>

                                <div class="flex items-center border border-slate-300 rounded-xl overflow-hidden bg-slate-50">
                                    <button type="button" onclick="cpmChangeCartQty(<?php echo $item->id; ?>, -1)" class="w-8 h-8 flex items-center justify-center text-slate-600 hover:bg-slate-200 font-bold border-none cursor-pointer">-</button>
                                    <input type="number" id="cpm-qty-input-<?php echo $item->id; ?>" min="1" value="<?php echo $item->quantity; ?>" onchange="cpmSetCartQty(<?php echo $item->id; ?>, this.value)" class="w-12 text-center text-sm font-bold bg-transparent border-none outline-none" />
                                    <button type="button" onclick="cpmChangeCartQty(<?php echo $item->id; ?>, 1)" class="w-8 h-8 flex items-center justify-center text-slate-600 hover:bg-slate-200 font-bold border-none cursor-pointer">+</button>
                                </div>

                                <div class="flex items-center justify-between sm:justify-end gap-4 w-full sm:w-auto pt-2 sm:pt-0 border-t sm:border-t-0 border-slate-100">
                                    <div class="text-right">
                                        <span class="text-xs text-slate-400 block font-semibold sm:hidden">Thành tiền</span>
                                        <span id="cpm-item-subtotal-<?php echo $item->id; ?>" class="text-base font-black text-red-600">
                                            <?php echo number_format($item_subtotal, 0, ',', '.'); ?> đ
                                        </span>
                                    </div>
                                    <button type="button" onclick="cpmRemoveCartItem(<?php echo $item->id; ?>)" title="Xóa sản phẩm" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-red-100 text-slate-400 hover:text-red-600 flex items-center justify-center transition-colors border-none cursor-pointer">✕</button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-md sticky top-6">
                        <h3 class="text-lg font-black text-slate-900 mb-4 pb-3 border-b border-slate-100">Thông tin đặt hàng</h3>
                        
                        <form id="cpmCheckoutForm" onsubmit="handleCpmCheckoutSubmit(event)">
                            <div class="space-y-3 text-xs mb-5">
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Họ và Tên người nhận *</label>
                                    <input type="text" id="cpmOrderName" required value="<?php echo esc_attr($current_user->display_name); ?>" placeholder="Nguyễn Văn A" class="w-full px-3 py-2 rounded-xl border border-slate-300 text-xs font-semibold outline-none focus:border-blue-500 box-border" />
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Số điện thoại giao hàng *</label>
                                    <input type="tel" id="cpmOrderPhone" required placeholder="0987654321" class="w-full px-3 py-2 rounded-xl border border-slate-300 text-xs font-semibold outline-none focus:border-blue-500 box-border" />
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Địa chỉ nhận hàng *</label>
                                    <textarea id="cpmOrderAddress" required rows="2" placeholder="Số nhà, Đường, Phường/Xã, Quận/Huyện..." class="w-full px-3 py-2 rounded-xl border border-slate-300 text-xs font-semibold outline-none focus:border-blue-500 box-border"></textarea>
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Phương thức thanh toán *</label>
                                    <div class="space-y-2 pt-1">
                                        <label class="flex items-center gap-2 p-2.5 rounded-xl border border-blue-200 bg-blue-50/50 cursor-pointer font-bold text-blue-900">
                                            <input type="radio" name="cpmPaymentMethod" value="vietqr" checked class="text-blue-600 focus:ring-blue-500" />
                                            <span>📲 Quét mã SePay VietQR (Tự Động)</span>
                                        </label>
                                        <label class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200 bg-slate-50/50 cursor-pointer font-bold text-slate-700">
                                            <input type="radio" name="cpmPaymentMethod" value="cod" class="text-blue-600 focus:ring-blue-500" />
                                            <span>🚚 Thanh toán khi nhận hàng (COD)</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-2 mb-5 text-xs">
                                <div class="flex justify-between text-slate-600">
                                    <span>Tạm tính (<span id="cpm-summary-item-count"><?php echo count($cart_items); ?></span> món):</span>
                                    <span id="cpm-summary-subtotal" class="font-bold text-slate-800"><?php echo number_format($grand_total, 0, ',', '.'); ?> đ</span>
                                </div>
                                <div class="flex justify-between text-slate-600">
                                    <span>Phí vận chuyển:</span>
                                    <span class="font-bold text-emerald-600">Miễn phí 🚚</span>
                                </div>
                                <div class="flex justify-between text-sm font-black text-slate-900 pt-2 border-t border-slate-100">
                                    <span>Tổng thanh toán:</span>
                                    <span id="cpm-summary-grand-total" class="text-lg text-red-600"><?php echo number_format($grand_total, 0, ',', '.'); ?> đ</span>
                                </div>
                            </div>

                            <button type="submit" id="cpmSubmitCheckoutBtn" class="w-full py-4 px-5 bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-600 hover:from-emerald-700 hover:to-teal-700 text-white font-black text-sm md:text-base rounded-2xl shadow-xl shadow-teal-500/25 hover:shadow-2xl hover:shadow-teal-500/35 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 border-none cursor-pointer flex items-center justify-center gap-2 mb-3">
                                <span>🚀 Thanh toán SePay VietQR Ngay</span>
                            </button>
                            <a href="<?php echo esc_url(home_url('/san-pham/')); ?>" class="block text-center text-xs font-bold text-blue-600 hover:text-blue-800 transition-colors no-underline">
                                ← Chọn thêm sản phẩm khác
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
