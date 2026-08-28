<?php
/**
 * Title: Header
 * Slug: e-commerce_platform/header
 * Categories: e-commerce_platform
 *
 * @package E-Commerce Platform Theme
 * @since 1.0.0
 */
?>

<style id="cpm-header-style">
    header.wp-block-template-part,
    .wp-block-template-part-header,
    .cpm-main-header {
        position: sticky !important;
        top: 0 !important;
        margin-top: 0 !important;
        padding-top: 0 !important;
        z-index: 99999 !important;

        width: 100% !important;
        background: rgba(255, 255, 255, 0.98) !important;
        border-bottom: 1px solid #e5e7eb !important;

        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);

        font-family:
            -apple-system,
            BlinkMacSystemFont,
            "Segoe UI",
            Roboto,
            Arial,
            sans-serif;

        box-sizing: border-box !important;
    }

    .cpm-main-header *,
    .cpm-main-header *::before,
    .cpm-main-header *::after {
        box-sizing: border-box;
    }


    .cpm-header-container {
        width: 90%;
        max-width: 1250px;

        min-height: 110px;

        margin: 0 auto;

        display: flex;
        align-items: center;
        justify-content: space-between;

    }


    .cpm-logo {
        flex-shrink: 0;

        display: flex;
        align-items: center;
    }

    .cpm-logo a {
        display: flex;
        align-items: center;
        gap: 9px;

        text-decoration: none !important;

        color: #111827 !important;

        font-size: 20px;
        font-weight: 800;

        line-height: 1;

        transition: color 0.25s ease;
    }

    .cpm-logo a:hover {
        color: #f97316 !important;
    }

    .cpm-logo-icon {
        width: 38px;
        height: 38px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 11px;

        background: #fff7ed;

        font-size: 20px;

        transition:
            transform 0.25s ease,
            background 0.25s ease;
    }

    .cpm-logo a:hover .cpm-logo-icon {
        background: #ffedd5;
        transform: translateY(-2px);
    }


    /* =========================================
   NAVIGATION
========================================= */

    .cpm-navigation {
        display: flex;
        align-items: center;
        gap: 6px;

        flex-shrink: 0;
    }

    .cpm-navigation a {
        position: relative;

        display: flex;
        align-items: center;

        padding: 10px 13px;

        border-radius: 8px;

        text-decoration: none !important;

        color: #475569 !important;

        font-size: 14px;
        font-weight: 600;

        line-height: 1;

        transition:
            color 0.25s ease,
            background 0.25s ease;
    }

    .cpm-navigation a:hover {
        color: #f97316 !important;
        background: #fff7ed;
    }


    /* =========================================
   SEARCH
========================================= */

    .cpm-search {
        flex: 1;

        max-width: 420px;

        margin-left: auto;
    }

    .cpm-search form {
        position: relative;

        display: flex;
        align-items: center;

        width: 100%;
        margin: 0;
    }

    .cpm-search input[type="search"] {
        width: 100%;

        height: 42px;

        padding: 0 48px 0 17px;

        border: 1px solid #e2e8f0;
        border-radius: 999px;

        background: #f8fafc;

        color: #1e293b;

        font-family: inherit;
        font-size: 13px;

        outline: none;

        box-shadow: none;

        transition:
            background 0.25s ease,
            border-color 0.25s ease,
            box-shadow 0.25s ease;
    }

    .cpm-search input[type="search"]::placeholder {
        color: #94a3b8;
    }

    .cpm-search input[type="search"]:focus {
        background: #ffffff;

        border-color: #fb923c;

        box-shadow:
            0 0 0 3px rgba(249, 115, 22, 0.10);
    }

    .cpm-search button {
        position: absolute;

        right: 5px;
        top: 50%;

        transform: translateY(-50%);

        width: 33px;
        height: 33px;

        display: flex;
        align-items: center;
        justify-content: center;

        border: none;
        border-radius: 50%;

        background: #f97316;
        color: #ffffff;

        font-size: 13px;

        cursor: pointer;

        transition:
            background 0.25s ease,
            transform 0.25s ease;
    }

    .cpm-search button:hover {
        background: #ea580c;

        transform:
            translateY(-50%) scale(1.05);
    }


    /* =========================================
   AUTH / USER
========================================= */

    .cpm-user-area {
        display: flex;
        align-items: center;

        flex-shrink: 0;

        min-height: 40px;
    }

    /*
 * Hạn chế CSS ảnh hưởng tới widget
 * đăng nhập hiện tại của bạn.
 */

    .cpm-user-area a {
        text-decoration: none;
    }


    /* =========================================
   ADMIN BAR
========================================= */

    /* Admin Bar ở lề trên cùng 0px, Header ở vị trí 32px dưới Admin Bar */
    body.admin-bar .cpm-main-header,
    html.admin-bar .cpm-main-header {
        top: 32px !important;
    }

    @media screen and (max-width: 782px) {
        body.admin-bar .cpm-main-header,
        html.admin-bar .cpm-main-header {
            top: 46px !important;
        }
    }


    /* =========================================
   TABLET
========================================= */

    @media screen and (max-width: 1050px) {

        .cpm-header-container {
            gap: 18px;
        }

        .cpm-navigation {
            gap: 2px;
        }

        .cpm-navigation a {
            padding: 9px 9px;
            font-size: 13px;
        }

        .cpm-search {
            max-width: 300px;
        }

    }


    /* =========================================
   MOBILE
========================================= */

    @media screen and (max-width: 768px) {

        .cpm-header-container {
            width: 92%;

            min-height: 64px;

            padding: 10px 0;

            gap: 12px;
        }

        /* Logo */

        .cpm-logo a {
            font-size: 17px;
        }

        .cpm-logo-icon {
            width: 34px;
            height: 34px;

            font-size: 17px;
        }

        /* Ẩn navigation */

        .cpm-navigation {
            display: none;
        }

        /* Search */

        .cpm-search {
            max-width: none;
            margin-left: auto;
        }

        .cpm-search input[type="search"] {
            height: 38px;

            padding-left: 13px;
            padding-right: 43px;

            font-size: 12px;
        }

        .cpm-search button {
            width: 29px;
            height: 29px;

            right: 4px;
        }

    }


    /* =========================================
   SMALL MOBILE
========================================= */

    @media screen and (max-width: 520px) {

        .cpm-header-container {
            flex-wrap: wrap;

            padding: 9px 0;
        }

        .cpm-logo {
            order: 1;
        }

        .cpm-user-area {
            order: 2;
        }

        .cpm-search {
            order: 3;

            flex-basis: 100%;

            width: 100%;
        }

        .cpm-search input[type="search"] {
            height: 40px;
        }

    }


    /* =========================================
   REDUCE MOTION
========================================= */

    @media (prefers-reduced-motion: reduce) {

        .cpm-main-header *,
        .cpm-main-header *::before,
        .cpm-main-header *::after {
            transition: none !important;
        }

    }
</style>


<header class="cpm-main-header">

    <div class="cpm-header-container">


        <!-- =====================================
             LOGO
        ====================================== -->

        <div class="cpm-logo">

            <a href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">

                <span class="cpm-logo-icon">
                    🛍️
                </span>

                <span>
                    <?php bloginfo('name'); ?>
                </span>

            </a>

        </div>


        <!-- =====================================
             NAVIGATION
        ====================================== -->

        <nav class="cpm-navigation" aria-label="Menu chính">

            <a href="<?php echo esc_url(home_url('/')); ?>">
                Trang chủ
            </a>

            <a href="<?php echo esc_url(home_url('/san-pham/')); ?>">
                Sản phẩm
            </a>

            <a href="<?php echo esc_url(home_url('/lien-he/')); ?>">
                Liên hệ
            </a>

            <a href="<?php echo esc_url(home_url('/chinh-sach/')); ?>">
                Chính sách
            </a>

        </nav>





        <!-- =====================================
             USER / LOGIN
        ====================================== -->

        <div class="cpm-user-area">

            <?php

            if (function_exists('cpm_render_auth_modal')) {

                cpm_render_auth_modal();

            } else {

                echo do_shortcode('[custom_auth_box]');

            }

            ?>

        </div>


    </div>

</header>