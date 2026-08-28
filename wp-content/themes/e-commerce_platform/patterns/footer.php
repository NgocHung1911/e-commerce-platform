<?php
/**
 * Title: Footer
 * Slug: e-commerce_platform/footer
 * Categories: e-commerce_platform
 *
 * @package E-Commerce Platform Theme
 * @since 1.0.0
 */
?>
<style id="cpm-footer-style">
.footer-section {
    width: 100% !important;
    background-color: #111827 !important;
    color: #ffffff !important;
    padding: 60px 0 25px !important;
    margin: 0 !important;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif !important;
    box-sizing: border-box !important;
}

.footer-section *,
.footer-section *::before,
.footer-section *::after {
    box-sizing: border-box !important;
}

.footer-boxes {
    width: 85% !important;
    max-width: 1200px !important;
    margin: 0 auto 50px auto !important;
    display: grid !important;
    grid-template-columns: 1.7fr 1fr 1fr !important;
    gap: 50px !important;
}

.footer-column {
    margin: 0 !important;
}

.footer-title {
    margin: 0 0 18px !important;
    font-size: 24px !important;
    font-weight: 800 !important;
    line-height: 1.3 !important;
    color: #ffffff !important;
}

.footer-description {
    max-width: 430px !important;
    margin: 0 0 25px !important;
    font-size: 14px !important;
    line-height: 1.7 !important;
    color: #cbd5e1 !important;
}

.footer-contact {
    display: flex !important;
    flex-direction: column !important;
    gap: 12px !important;
}

.footer-contact p {
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
    margin: 0 !important;
    font-size: 13px !important;
    color: #cbd5e1 !important;
}

.footer-heading {
    position: relative !important;
    margin: 0 0 20px !important;
    padding-bottom: 10px !important;
    font-size: 17px !important;
    font-weight: 700 !important;
    color: #ffffff !important;
}

.footer-heading::after {
    content: "" !important;
    position: absolute !important;
    left: 0 !important;
    bottom: 0 !important;
    width: 32px !important;
    height: 3px !important;
    border-radius: 10px !important;
    background: #f97316 !important;
}

.footer-links {
    display: flex !important;
    flex-direction: column !important;
    gap: 12px !important;
    list-style: none !important;
    margin: 0 !important;
    padding: 0 !important;
}

.footer-links li {
    margin: 0 !important;
    padding: 0 !important;
}

.footer-links a {
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
    text-decoration: none !important;
    font-size: 14px !important;
    color: #cbd5e1 !important;
    transition: all 0.2s ease !important;
}

.footer-links a:hover {
    color: #f97316 !important;
    transform: translateX(4px) !important;
}

.footer-bottom {
    width: 85% !important;
    max-width: 1200px !important;
    margin: 0 auto !important;
    padding-top: 20px !important;
    border-top: 1px solid rgba(255, 255, 255, 0.12) !important;
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    gap: 20px !important;
}

.footer-bottom p {
    margin: 0 !important;
    font-size: 12px !important;
    color: #94a3b8 !important;
}

.footer-bottom strong {
    color: #ffffff !important;
}

@media (max-width: 850px) {
    .footer-boxes {
        grid-template-columns: 1fr 1fr !important;
        gap: 30px !important;
    }
    .footer-brand {
        grid-column: 1 / -1 !important;
    }
}

@media (max-width: 600px) {
    .footer-boxes {
        grid-template-columns: 1fr !important;
    }
    .footer-bottom {
        flex-direction: column !important;
        align-items: flex-start !important;
    }
}
</style>

<div class="wp-block-group footer-section">
    <div class="footer-boxes">
        <!-- CỘT 1 -->
        <div class="footer-column footer-brand">
            <h3 class="footer-title">E-Commerce Platform</h3>
            <p class="footer-description">
                Nền tảng thương mại điện tử trực tuyến hiện đại, mang đến trải nghiệm mua sắm nhanh chóng, tiện lợi và an toàn.
            </p>
            <div class="footer-contact">
                <p><span>📍</span> NEO - Coworking Space Tân Phú, TP. Hồ Chí Minh</p>
                <p><span>📞</span> +84 393 465 113</p>
                <p><span>✉️</span> contact@ecommerce-platform.com</p>
            </div>
        </div>

        <!-- CỘT 2 -->
        <div class="footer-column">
            <h4 class="footer-heading">Liên kết nhanh</h4>
            <ul class="footer-links">
                <li><a href="<?php echo esc_url(home_url('/')); ?>"><span>🏠</span> Trang chủ</a></li>
                <li><a href="<?php echo esc_url(home_url('/san-pham/')); ?>"><span>🛍️</span> Danh sách sản phẩm</a></li>
                <li><a href="<?php echo esc_url(home_url('/gio-hang/')); ?>"><span>🛒</span> Giỏ hàng của tôi</a></li>
                <li><a href="<?php echo esc_url(home_url('/lich-su-don-hang/')); ?>"><span>📋</span> Lịch sử đơn hàng</a></li>
            </ul>
        </div>

        <!-- CỘT 3 -->
        <div class="footer-column">
            <h4 class="footer-heading">Hỗ trợ khách hàng</h4>
            <ul class="footer-links">
                <li><a href="<?php echo esc_url(home_url('/lien-he/')); ?>"><span>📞</span> Liên hệ & Bản đồ</a></li>
                <li><a href="<?php echo esc_url(home_url('/chinh-sach/')); ?>"><span>🛡️</span> Chính sách & Bảo mật</a></li>
                <li><a href="<?php echo esc_url(home_url('/hoa-don/')); ?>"><span>📄</span> Tra cứu hóa đơn</a></li>
            </ul>
        </div>
    </div>

    <!-- COPYRIGHT -->
    <div class="footer-bottom">
        <p>© <?php echo date('Y'); ?> <strong>E-Commerce Platform</strong>. All rights reserved.</p>
        <p class="footer-payment">🔒 Thanh toán an toàn · 🚚 Giao hàng nhanh</p>
    </div>
</div>