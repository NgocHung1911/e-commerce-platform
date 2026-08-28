<?php
/**
 * Script Đóng Gói Packages Zip Chuẩn WordPress (Đã fix lỗi đường dẫn Windows Unzip)
 * Nén tất cả Plugin & Theme vào thư mục dist_packages/
 */

$baseDir = __DIR__;
$distDir = $baseDir . '/dist_packages';

if (!file_exists($distDir)) {
    mkdir($distDir, 0777, true);
}

function zipFolderCustom($sourceFolder, $outZipPath, $rootFolderName) {
    if (!extension_loaded('zip')) {
        die("Lỗi: Đã thiếu extension PHP 'zip'.\n");
    }

    $zip = new ZipArchive();
    if ($zip->open($outZipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
        echo "❌ Không thể tạo file zip: $outZipPath\n";
        return false;
    }

    $sourcePath = realpath($sourceFolder);
    if (!$sourcePath || !is_dir($sourcePath)) {
        echo "❌ Thư mục nguồn không tồn tại: $sourceFolder\n";
        return false;
    }

    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($sourcePath, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );

    foreach ($files as $file) {
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($sourcePath) + 1);
        $zipRelativePath = $rootFolderName . '/' . str_replace('\\', '/', $relativePath);

        if ($file->isDir()) {
            $zip->addEmptyDir($zipRelativePath);
        } else if ($file->isFile()) {
            $zip->addFile($filePath, $zipRelativePath);
        }
    }

    $zip->close();
    return true;
}

$itemsToPackage = [
    // Themes
    [
        'source' => $baseDir . '/wp-content/themes/e-commerce_platform',
        'zipName' => 'theme-e-commerce-platform.zip',
        'rootFolder' => 'e-commerce_platform'
    ],
    [
        'source' => $baseDir . '/wp-content/themes/salecraft-ecommerce',
        'zipName' => 'theme-salecraft-ecommerce.zip',
        'rootFolder' => 'salecraft-ecommerce'
    ],
    // Plugins
    [
        'source' => $baseDir . '/wp-content/plugins/cart',
        'zipName' => 'plugin-cart-sepay.zip',
        'rootFolder' => 'cart'
    ],
    [
        'source' => $baseDir . '/wp-content/plugins/bill',
        'zipName' => 'plugin-bill-invoices.zip',
        'rootFolder' => 'bill'
    ],
    [
        'source' => $baseDir . '/wp-content/plugins/product',
        'zipName' => 'plugin-product-manager.zip',
        'rootFolder' => 'product'
    ],
    [
        'source' => $baseDir . '/wp-content/plugins/component',
        'zipName' => 'plugin-product-card.zip',
        'rootFolder' => 'component'
    ],
    [
        'source' => $baseDir . '/wp-content/plugins/contact',
        'zipName' => 'plugin-contact-page.zip',
        'rootFolder' => 'contact'
    ],
    [
        'source' => $baseDir . '/wp-content/plugins/policy',
        'zipName' => 'plugin-policy-page.zip',
        'rootFolder' => 'policy'
    ],
    [
        'source' => $baseDir . '/wp-content/plugins/custom-auth',
        'zipName' => 'plugin-custom-auth.zip',
        'rootFolder' => 'custom-auth'
    ],
    [
        'source' => $baseDir . '/wp-content/plugins/manager',
        'zipName' => 'plugin-module-manager.zip',
        'rootFolder' => 'manager'
    ]
];

echo "📦 Đang tạo gói ZIP Theme & Plugins chuẩn WordPress...\n";

foreach ($itemsToPackage as $item) {
    $zipPath = $distDir . '/' . $item['zipName'];
    if (file_exists($item['source'])) {
        if (zipFolderCustom($item['source'], $zipPath, $item['rootFolder'])) {
            echo "✅ Đã đóng gói thành công: {$item['zipName']}\n";
        }
    }
}

echo "🎉 Hoàn tất đóng gói toàn bộ gói ZIP trong dist_packages/!\n";
