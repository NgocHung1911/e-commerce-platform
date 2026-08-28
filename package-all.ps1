# PowerShell script to package all plugins and themes into installable ZIP packages
$distDir = "c:\xampp\htdocs\e_commerce_platform\dist_packages"
if (!(Test-Path $distDir)) {
    New-Item -ItemType Directory -Path $distDir
}

Write-Host "📦 Packaging E-Commerce Theme..." -ForegroundColor Cyan
Compress-Archive -Path "c:\xampp\htdocs\e_commerce_platform\wp-content\themes\salecraft-ecommerce" -DestinationPath "$distDir\theme-salecraft-ecommerce.zip" -Force

Write-Host "📦 Packaging E-Commerce Plugins..." -ForegroundColor Green
Compress-Archive -Path "c:\xampp\htdocs\e_commerce_platform\wp-content\plugins\cart" -DestinationPath "$distDir\plugin-cart-sepay.zip" -Force
Compress-Archive -Path "c:\xampp\htdocs\e_commerce_platform\wp-content\plugins\bill" -DestinationPath "$distDir\plugin-bill-invoices.zip" -Force
Compress-Archive -Path "c:\xampp\htdocs\e_commerce_platform\wp-content\plugins\product" -DestinationPath "$distDir\plugin-product-manager.zip" -Force
Compress-Archive -Path "c:\xampp\htdocs\e_commerce_platform\wp-content\plugins\component" -DestinationPath "$distDir\plugin-product-card.zip" -Force
Compress-Archive -Path "c:\xampp\htdocs\e_commerce_platform\wp-content\plugins\contact" -DestinationPath "$distDir\plugin-contact-page.zip" -Force
Compress-Archive -Path "c:\xampp\htdocs\e_commerce_platform\wp-content\plugins\policy" -DestinationPath "$distDir\plugin-policy-page.zip" -Force
Compress-Archive -Path "c:\xampp\htdocs\e_commerce_platform\wp-content\plugins\custom-auth" -DestinationPath "$distDir\plugin-custom-auth.zip" -Force
Compress-Archive -Path "c:\xampp\htdocs\e_commerce_platform\wp-content\plugins\manager" -DestinationPath "$distDir\plugin-module-manager.zip" -Force

Write-Host "✅ All 9 ZIP packages generated successfully in dist_packages/!" -ForegroundColor Yellow
Get-ChildItem $distDir
