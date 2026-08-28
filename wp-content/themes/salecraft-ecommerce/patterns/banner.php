<?php
/**
 * Title: Banner
 * Slug: salecraft-ecommerce/banner
 * Categories: salecraft-ecommerce
 *
 * @package SaleCraft Ecommerce
 * @since 1.0.0
 */

$salecraft_ecommerce_pluginsList = get_option( 'active_plugins' );
$salecraft_ecommerce_plugin = 'woocommerce/woocommerce.php';
$salecraft_ecommerce_results = in_array( $salecraft_ecommerce_plugin , $salecraft_ecommerce_pluginsList);
if ( $salecraft_ecommerce_results )  {
?>

<!-- wp:group {"className":"main-banner-section","style":{"spacing":{"padding":{"right":"0px","left":"0px"}}},"layout":{"type":"constrained","contentSize":"85%"}} -->
<div class="wp-block-group main-banner-section" style="padding-right:0px;padding-left:0px"><!-- wp:columns {"className":"banner-outer-boxes","style":{"spacing":{"blockGap":{"top":"15px","left":"15px"}}}} -->
<div class="wp-block-columns banner-outer-boxes"><!-- wp:column {"width":"60%","className":"banner-left-box wow zoomIn","style":{"spacing":{"padding":{"top":"0px","bottom":"0px","left":"0px","right":"0px"}}}} -->
<div class="wp-block-column banner-left-box wow zoomIn" style="padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;flex-basis:60%"><!-- wp:cover {"overlayColor":"primary-light","isUserOverlayColor":true,"minHeight":550,"isDark":false,"className":"banner-left-bg","style":{"spacing":{"padding":{"top":"0px","bottom":"0px","left":"0px","right":"0px"}},"border":{"radius":"15px"}},"layout":{"type":"constrained","contentSize":"90%"}} -->
<div class="wp-block-cover is-light banner-left-bg" style="border-radius:15px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;min-height:550px"><span aria-hidden="true" class="wp-block-cover__background has-primary-light-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:woocommerce/product-collection {"queryId":3,"query":{"perPage":1,"pages":1,"offset":0,"postType":"product","order":"desc","orderBy":"date","search":"","exclude":[],"inherit":false,"taxQuery":{},"isProductCollectionBlock":true,"featured":false,"woocommerceOnSale":false,"woocommerceStockStatus":["instock","outofstock","onbackorder"],"woocommerceAttributes":[],"woocommerceHandPickedProducts":[],"timeFrame":{"operator":"in","value":"-7 days"},"filterable":false,"relatedBy":{"categories":true,"tags":true}},"tagName":"div","displayLayout":{"type":"flex","columns":1,"shrinkColumns":true},"dimensions":{"widthType":"fill"},"collection":"woocommerce/product-collection/new-arrivals","hideControls":["inherit","order","filterable"],"queryContextIncludes":["collection"],"__privatePreviewState":{"isPreview":false,"previewMessage":"Actual products will vary depending on the page being viewed."}} -->
<div class="wp-block-woocommerce-product-collection"><!-- wp:woocommerce/product-template -->
<!-- wp:columns {"className":"banner-cont-boxes"} -->
<div class="wp-block-columns banner-cont-boxes"><!-- wp:column {"width":"40%","className":"banner-left-cont"} -->
<div class="wp-block-column banner-left-cont" style="flex-basis:40%"><!-- wp:post-terms {"term":"product_tag","className":"banner-sm-title"} /-->

<!-- wp:post-title {"isLink":true,"className":"banner-main-title","style":{"typography":{"fontSize":"40px","fontStyle":"normal","fontWeight":"500"},"spacing":{"margin":{"bottom":"15px","top":"8px"}}},"__woocommerceNamespace":"woocommerce/product-query/product-title"} /-->

<!-- wp:paragraph {"className":"bnr-price-text","style":{"elements":{"link":{"color":{"text":"var:preset|color|contrast"}}},"typography":{"fontSize":"14px","fontStyle":"normal","fontWeight":"400"},"spacing":{"margin":{"top":"5px"}}},"textColor":"contrast"} -->
<p class="bnr-price-text has-contrast-color has-text-color has-link-color" style="margin-top:5px;font-size:14px;font-style:normal;font-weight:400"><?php echo esc_html__( 'Starting at', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:woocommerce/product-price {"isDescendentOfQueryLoop":true,"isDescendentOfSingleProductBlock":true,"className":"bnr-price","style":{"spacing":{"margin":{"top":"10px"}},"typography":{"fontSize":"25px","fontStyle":"normal","fontWeight":"600"}}} /-->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"banner-left-btn","style":{"typography":{"fontStyle":"normal","fontWeight":"400","textTransform":"capitalize"},"border":{"radius":"4px"},"spacing":{"padding":{"left":"30px","right":"30px","top":"8px","bottom":"8px"}}}} -->
<div class="wp-block-button banner-left-btn"><a class="wp-block-button__link wp-element-button" href="#" style="border-radius:4px;padding-top:8px;padding-right:30px;padding-bottom:8px;padding-left:30px;font-style:normal;font-weight:400;text-transform:capitalize"><?php echo esc_html__( 'shop now', 'salecraft-ecommerce' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"60%","className":"banner-right-img"} -->
<div class="wp-block-column banner-right-img" style="flex-basis:60%"><!-- wp:woocommerce/product-image {"showSaleBadge":false,"isDescendentOfQueryLoop":true,"height":"450px","className":"banner-product-img"} /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
<!-- /wp:woocommerce/product-template --></div>
<!-- /wp:woocommerce/product-collection --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"stretch","width":"40%","className":"banner-right-box","style":{"spacing":{"blockGap":"15px"}}} -->
<div class="wp-block-column is-vertically-aligned-stretch banner-right-box" style="flex-basis:40%"><!-- wp:cover {"overlayColor":"secondary","isUserOverlayColor":true,"minHeight":270,"isDark":false,"className":"bnr-right-top-box wow zoomIn","style":{"border":{"radius":"15px"},"spacing":{"padding":{"top":"0px","bottom":"0px","left":"0px","right":"0px"}}},"layout":{"type":"default"}} -->
<div class="wp-block-cover is-light bnr-right-top-box wow zoomIn" style="border-radius:15px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;min-height:270px"><span aria-hidden="true" class="wp-block-cover__background has-secondary-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:columns {"verticalAlignment":"center","className":"bnr-right-top-cont"} -->
<div class="wp-block-columns are-vertically-aligned-center bnr-right-top-cont"><!-- wp:column {"verticalAlignment":"center","width":"50%","className":"bnr-right-left-box","style":{"spacing":{"padding":{"left":"40px","right":"15px"}}}} -->
<div class="wp-block-column is-vertically-aligned-center bnr-right-left-box" style="padding-right:15px;padding-left:40px;flex-basis:50%"><!-- wp:paragraph {"className":"banner-sm-title","style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"bottom":"8px"}}}} -->
<p class="banner-sm-title" style="margin-bottom:8px;font-size:14px"><?php echo esc_html__( 'Up to 15% Off', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"className":"bnr-top-title","style":{"typography":{"fontSize":"22px","fontStyle":"normal","fontWeight":"500"},"spacing":{"margin":{"top":"0px"}}}} -->
<h3 class="wp-block-heading bnr-top-title" style="margin-top:0px;font-size:22px;font-style:normal;font-weight:500"><?php echo esc_html__( 'New MacBook Air13-inch, M2 chip', 'salecraft-ecommerce' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"26px"}}}} -->
<div class="wp-block-buttons" style="margin-top:26px"><!-- wp:button {"className":"bnr-top-btn","style":{"typography":{"fontSize":"14px","textTransform":"capitalize","fontStyle":"normal","fontWeight":"400"},"spacing":{"padding":{"left":"30px","right":"30px","top":"8px","bottom":"8px"}}}} -->
<div class="wp-block-button bnr-top-btn"><a class="wp-block-button__link has-custom-font-size wp-element-button" href="#" style="padding-top:8px;padding-right:30px;padding-bottom:8px;padding-left:30px;font-size:14px;font-style:normal;font-weight:400;text-transform:capitalize"><?php echo esc_html__( 'shop now', 'salecraft-ecommerce' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"50%","className":"bnr-right-img-box"} -->
<div class="wp-block-column is-vertically-aligned-center bnr-right-img-box" style="flex-basis:50%"><!-- wp:image {"id":59,"width":"auto","height":"280px","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/banner-img1.png" alt="" class="wp-image-59" style="width:auto;height:280px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div></div>
<!-- /wp:cover -->

<!-- wp:columns {"verticalAlignment":"center","className":"bnr-bottom-boxes","style":{"spacing":{"margin":{"top":"0px","bottom":"0px"},"blockGap":{"top":"15px","left":"15px"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center bnr-bottom-boxes" style="margin-top:0px;margin-bottom:0px"><!-- wp:column {"verticalAlignment":"center","className":"bnr-bottom-box wow zoomIn","style":{"border":{"radius":"15px"},"spacing":{"padding":{"right":"20px","left":"20px","top":"25px"}}},"backgroundColor":"section-background"} -->
<div class="wp-block-column is-vertically-aligned-center bnr-bottom-box wow zoomIn has-section-background-background-color has-background" style="border-radius:15px;padding-top:25px;padding-right:20px;padding-left:20px"><!-- wp:paragraph {"align":"center","className":"banner-sm-title","style":{"typography":{"fontSize":"14px"}}} -->
<p class="has-text-align-center banner-sm-title" style="font-size:14px"><?php echo esc_html__( 'Gear VR', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":5,"className":"bnr-bottom-title","style":{"typography":{"fontSize":"20px","fontStyle":"normal","fontWeight":"500"},"spacing":{"margin":{"top":"6px"}}}} -->
<h5 class="wp-block-heading has-text-align-center bnr-bottom-title" style="margin-top:6px;font-size:20px;font-style:normal;font-weight:500"><?php echo esc_html__( 'Oculas Gear VE', 'salecraft-ecommerce' ); ?></h5>
<!-- /wp:heading -->

<!-- wp:image {"id":66,"width":"auto","height":"150px","sizeSlug":"full","linkDestination":"none","align":"center","className":"bnr-bottom-img","style":{"spacing":{"margin":{"top":"25px"}}}} -->
<figure class="wp-block-image aligncenter size-full is-resized bnr-bottom-img" style="margin-top:25px"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/banner-img2.png" alt="" class="wp-image-66" style="width:auto;height:150px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","className":"bnr-bottom-box wow zoomIn","style":{"border":{"radius":"15px"},"spacing":{"padding":{"right":"20px","left":"20px","top":"25px"}}},"backgroundColor":"section-background"} -->
<div class="wp-block-column is-vertically-aligned-center bnr-bottom-box wow zoomIn has-section-background-background-color has-background" style="border-radius:15px;padding-top:25px;padding-right:20px;padding-left:20px"><!-- wp:paragraph {"align":"center","className":"banner-sm-title","style":{"typography":{"fontSize":"14px"}}} -->
<p class="has-text-align-center banner-sm-title" style="font-size:14px"><?php echo esc_html__( 'Phones', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":5,"className":"bnr-bottom-title","style":{"typography":{"fontSize":"20px","fontStyle":"normal","fontWeight":"500"},"spacing":{"margin":{"top":"6px"}}}} -->
<h5 class="wp-block-heading has-text-align-center bnr-bottom-title" style="margin-top:6px;font-size:20px;font-style:normal;font-weight:500"><?php echo esc_html__( 'Iphone 17Pro Max', 'salecraft-ecommerce' ); ?></h5>
<!-- /wp:heading -->

<!-- wp:image {"id":81,"width":"auto","height":"150px","sizeSlug":"full","linkDestination":"none","align":"center","className":"bnr-bottom-img","style":{"spacing":{"margin":{"top":"25px"}}}} -->
<figure class="wp-block-image aligncenter size-full is-resized bnr-bottom-img" style="margin-top:25px"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/banner-img3.png" alt="" class="wp-image-81" style="width:auto;height:150px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:group {"className":"banner-btm-row","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group banner-btm-row"><!-- wp:group {"className":"banner-btm-box wow zoomIn","layout":{"type":"constrained"}} -->
<div class="wp-block-group banner-btm-box wow zoomIn"><!-- wp:columns {"verticalAlignment":"center","className":"banner-btm-icon-boxes","style":{"spacing":{"blockGap":{"top":"15px","left":"18px"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center banner-btm-icon-boxes"><!-- wp:column {"verticalAlignment":"center","width":"20%","className":"banner-btm-icon"} -->
<div class="wp-block-column is-vertically-aligned-center banner-btm-icon" style="flex-basis:20%"><!-- wp:image {"id":91,"width":"auto","height":"45px","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/icon1.png" alt="" class="wp-image-91" style="width:auto;height:45px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"80%","className":"banner-icon-info"} -->
<div class="wp-block-column is-vertically-aligned-center banner-icon-info" style="flex-basis:80%"><!-- wp:heading {"level":6,"className":"banner-icon-title","style":{"typography":{"fontSize":"17px","fontStyle":"normal","fontWeight":"600","textTransform":"capitalize"},"spacing":{"margin":{"bottom":"3px"}}}} -->
<h6 class="wp-block-heading banner-icon-title" style="margin-bottom:3px;font-size:17px;font-style:normal;font-weight:600;text-transform:capitalize"><?php echo esc_html__( 'free delivery', 'salecraft-ecommerce' ); ?></h6>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"banner-icon-text","style":{"typography":{"fontSize":"12px","textTransform":"capitalize"},"spacing":{"margin":{"top":"0px"}}}} -->
<p class="banner-icon-text" style="margin-top:0px;font-size:12px;text-transform:capitalize"><?php echo esc_html__( 'free shipping on all order', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"banner-btm-box wow zoomIn","layout":{"type":"constrained"}} -->
<div class="wp-block-group banner-btm-box wow zoomIn"><!-- wp:columns {"verticalAlignment":"center","className":"banner-btm-icon-boxes","style":{"spacing":{"blockGap":{"top":"15px","left":"18px"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center banner-btm-icon-boxes"><!-- wp:column {"verticalAlignment":"center","width":"20%","className":"banner-btm-icon"} -->
<div class="wp-block-column is-vertically-aligned-center banner-btm-icon" style="flex-basis:20%"><!-- wp:image {"id":118,"width":"auto","height":"45px","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/icon2.png" alt="" class="wp-image-118" style="width:auto;height:45px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"80%","className":"banner-icon-info"} -->
<div class="wp-block-column is-vertically-aligned-center banner-icon-info" style="flex-basis:80%"><!-- wp:heading {"level":6,"className":"banner-icon-title","style":{"typography":{"fontSize":"17px","fontStyle":"normal","fontWeight":"600","textTransform":"capitalize"},"spacing":{"margin":{"bottom":"3px"}}}} -->
<h6 class="wp-block-heading banner-icon-title" style="margin-bottom:3px;font-size:17px;font-style:normal;font-weight:600;text-transform:capitalize"><?php echo esc_html__( 'big saving shop', 'salecraft-ecommerce' ); ?></h6>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"banner-icon-text","style":{"typography":{"fontSize":"12px","textTransform":"capitalize"},"spacing":{"margin":{"top":"0px"}}}} -->
<p class="banner-icon-text" style="margin-top:0px;font-size:12px;text-transform:capitalize"><?php echo esc_html__( 'save vig every order guarantee', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"banner-btm-box wow zoomIn","layout":{"type":"constrained"}} -->
<div class="wp-block-group banner-btm-box wow zoomIn"><!-- wp:columns {"verticalAlignment":"center","className":"banner-btm-icon-boxes","style":{"spacing":{"blockGap":{"top":"15px","left":"18px"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center banner-btm-icon-boxes"><!-- wp:column {"verticalAlignment":"center","width":"20%","className":"banner-btm-icon"} -->
<div class="wp-block-column is-vertically-aligned-center banner-btm-icon" style="flex-basis:20%"><!-- wp:image {"id":119,"width":"auto","height":"45px","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/icon3.png" alt="" class="wp-image-119" style="width:auto;height:45px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"80%","className":"banner-icon-info"} -->
<div class="wp-block-column is-vertically-aligned-center banner-icon-info" style="flex-basis:80%"><!-- wp:heading {"level":6,"className":"banner-icon-title","style":{"typography":{"fontSize":"17px","fontStyle":"normal","fontWeight":"600","textTransform":"capitalize"},"spacing":{"margin":{"bottom":"3px"}}}} -->
<h6 class="wp-block-heading banner-icon-title" style="margin-bottom:3px;font-size:17px;font-style:normal;font-weight:600;text-transform:capitalize"><?php echo esc_html__( 'online support 24/7', 'salecraft-ecommerce' ); ?></h6>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"banner-icon-text","style":{"typography":{"fontSize":"12px","textTransform":"capitalize"},"spacing":{"margin":{"top":"0px"}}}} -->
<p class="banner-icon-text" style="margin-top:0px;font-size:12px;text-transform:capitalize"><?php echo esc_html__( 'support online 24 hours & 7 days', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"banner-btm-box wow zoomIn","layout":{"type":"constrained"}} -->
<div class="wp-block-group banner-btm-box wow zoomIn"><!-- wp:columns {"verticalAlignment":"center","className":"banner-btm-icon-boxes","style":{"spacing":{"blockGap":{"top":"15px","left":"18px"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center banner-btm-icon-boxes"><!-- wp:column {"verticalAlignment":"center","width":"20%","className":"banner-btm-icon"} -->
<div class="wp-block-column is-vertically-aligned-center banner-btm-icon" style="flex-basis:20%"><!-- wp:image {"id":120,"width":"auto","height":"45px","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/icon4.png" alt="" class="wp-image-120" style="width:auto;height:45px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"80%","className":"banner-icon-info"} -->
<div class="wp-block-column is-vertically-aligned-center banner-icon-info" style="flex-basis:80%"><!-- wp:heading {"level":6,"className":"banner-icon-title","style":{"typography":{"fontSize":"17px","fontStyle":"normal","fontWeight":"600","textTransform":"capitalize"},"spacing":{"margin":{"bottom":"3px"}}}} -->
<h6 class="wp-block-heading banner-icon-title" style="margin-bottom:3px;font-size:17px;font-style:normal;font-weight:600;text-transform:capitalize"><?php echo esc_html__( 'money back return', 'salecraft-ecommerce' ); ?></h6>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"banner-icon-text","style":{"typography":{"fontSize":"12px","textTransform":"capitalize"},"spacing":{"margin":{"top":"0px"}}}} -->
<p class="banner-icon-text" style="margin-top:0px;font-size:12px;text-transform:capitalize"><?php echo esc_html__( 'Back Guarantee Under 7 Day', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:spacer {"height":"35px"} -->
<div style="height:35px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<?php } else { ?>

<!-- wp:group {"className":"main-banner-section","style":{"spacing":{"padding":{"right":"0px","left":"0px"}}},"layout":{"type":"constrained","contentSize":"85%"}} -->
<div class="wp-block-group main-banner-section" style="padding-right:0px;padding-left:0px"><!-- wp:columns {"className":"banner-outer-boxes","style":{"spacing":{"blockGap":{"top":"15px","left":"15px"}}}} -->
<div class="wp-block-columns banner-outer-boxes"><!-- wp:column {"width":"60%","className":"banner-left-box wow zoomIn","style":{"spacing":{"padding":{"top":"0px","bottom":"0px","left":"0px","right":"0px"}}}} -->
<div class="wp-block-column banner-left-box wow zoomIn" style="padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;flex-basis:60%"><!-- wp:cover {"overlayColor":"primary-light","isUserOverlayColor":true,"minHeight":550,"isDark":false,"className":"banner-left-bg","style":{"spacing":{"padding":{"top":"0px","bottom":"0px","left":"0px","right":"0px"}},"border":{"radius":"15px"}},"layout":{"type":"constrained","contentSize":"90%"}} -->
<div class="wp-block-cover is-light banner-left-bg" style="border-radius:15px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;min-height:550px"><span aria-hidden="true" class="wp-block-cover__background has-primary-light-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:columns {"className":"banner-cont-boxes"} -->
<div class="wp-block-columns banner-cont-boxes"><!-- wp:column {"width":"40%","className":"banner-left-cont"} -->
<div class="wp-block-column banner-left-cont" style="flex-basis:40%"><!-- wp:paragraph {"className":"banner-sm-title","style":{"elements":{"link":{"color":{"text":"var:preset|color|contrast"}}},"typography":{"fontSize":"14px","fontStyle":"normal","fontWeight":"400"},"spacing":{"margin":{"bottom":"8px"}}},"textColor":"contrast"} -->
<p class="banner-sm-title has-contrast-color has-text-color has-link-color" style="margin-bottom:8px;font-size:14px;font-style:normal;font-weight:400"><?php echo esc_html__( '25% off', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"banner-main-title","style":{"typography":{"fontSize":"40px","textTransform":"capitalize","fontStyle":"normal","fontWeight":"500"},"elements":{"link":{"color":{"text":"var:preset|color|contrast"}}},"spacing":{"margin":{"top":"0px"}}},"textColor":"contrast"} -->
<h2 class="wp-block-heading banner-main-title has-contrast-color has-text-color has-link-color" style="margin-top:0px;font-size:40px;font-style:normal;font-weight:500;text-transform:capitalize"><?php echo esc_html__( 'limited weekly discount!', 'salecraft-ecommerce' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"bnr-price-text","style":{"elements":{"link":{"color":{"text":"var:preset|color|contrast"}}},"typography":{"fontSize":"14px","fontStyle":"normal","fontWeight":"400"},"spacing":{"margin":{"top":"5px"}}},"textColor":"contrast"} -->
<p class="bnr-price-text has-contrast-color has-text-color has-link-color" style="margin-top:5px;font-size:14px;font-style:normal;font-weight:400"><?php echo esc_html__( 'Starting at', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"bnr-price","style":{"elements":{"link":{"color":{"text":"var:preset|color|contrast"}}},"typography":{"fontStyle":"normal","fontWeight":"600","fontSize":"25px"},"spacing":{"margin":{"top":"5px"}}},"textColor":"contrast"} -->
<p class="bnr-price has-contrast-color has-text-color has-link-color" style="margin-top:5px;font-size:25px;font-style:normal;font-weight:600"><?php echo esc_html__( '$99.00', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"banner-left-btn","style":{"typography":{"fontStyle":"normal","fontWeight":"400","textTransform":"capitalize"},"border":{"radius":"4px"},"spacing":{"padding":{"left":"30px","right":"30px","top":"8px","bottom":"8px"}}}} -->
<div class="wp-block-button banner-left-btn"><a class="wp-block-button__link wp-element-button" href="#" style="border-radius:4px;padding-top:8px;padding-right:30px;padding-bottom:8px;padding-left:30px;font-style:normal;font-weight:400;text-transform:capitalize"><?php echo esc_html__( 'shop now', 'salecraft-ecommerce' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"bottom","width":"60%","className":"banner-right-img"} -->
<div class="wp-block-column is-vertically-aligned-bottom banner-right-img" style="flex-basis:60%"><!-- wp:image {"id":83,"width":"auto","height":"450px","sizeSlug":"large","linkDestination":"none","className":"banner-product-img"} -->
<figure class="wp-block-image size-large is-resized banner-product-img"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/banner-product.png" alt="" class="wp-image-83" style="width:auto;height:450px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"stretch","width":"40%","className":"banner-right-box","style":{"spacing":{"blockGap":"15px"}}} -->
<div class="wp-block-column is-vertically-aligned-stretch banner-right-box" style="flex-basis:40%"><!-- wp:cover {"overlayColor":"secondary","isUserOverlayColor":true,"minHeight":270,"isDark":false,"className":"bnr-right-top-box wow zoomIn","style":{"border":{"radius":"15px"},"spacing":{"padding":{"top":"0px","bottom":"0px","left":"0px","right":"0px"}}},"layout":{"type":"default"}} -->
<div class="wp-block-cover is-light bnr-right-top-box wow zoomIn" style="border-radius:15px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;min-height:270px"><span aria-hidden="true" class="wp-block-cover__background has-secondary-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:columns {"verticalAlignment":"center","className":"bnr-right-top-cont"} -->
<div class="wp-block-columns are-vertically-aligned-center bnr-right-top-cont"><!-- wp:column {"verticalAlignment":"center","width":"50%","className":"bnr-right-left-box","style":{"spacing":{"padding":{"left":"40px","right":"15px"}}}} -->
<div class="wp-block-column is-vertically-aligned-center bnr-right-left-box" style="padding-right:15px;padding-left:40px;flex-basis:50%"><!-- wp:paragraph {"className":"banner-sm-title","style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"bottom":"8px"}}}} -->
<p class="banner-sm-title" style="margin-bottom:8px;font-size:14px"><?php echo esc_html__( 'Up to 15% Off', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"className":"bnr-top-title","style":{"typography":{"fontSize":"22px","fontStyle":"normal","fontWeight":"500"},"spacing":{"margin":{"top":"0px"}}}} -->
<h3 class="wp-block-heading bnr-top-title" style="margin-top:0px;font-size:22px;font-style:normal;font-weight:500"><?php echo esc_html__( 'New MacBook Air 13-inch, M2 chip', 'salecraft-ecommerce' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"26px"}}}} -->
<div class="wp-block-buttons" style="margin-top:26px"><!-- wp:button {"className":"bnr-top-btn","style":{"typography":{"fontSize":"14px","textTransform":"capitalize","fontStyle":"normal","fontWeight":"400"},"spacing":{"padding":{"left":"30px","right":"30px","top":"8px","bottom":"8px"}}}} -->
<div class="wp-block-button bnr-top-btn"><a class="wp-block-button__link has-custom-font-size wp-element-button" href="#" style="padding-top:8px;padding-right:30px;padding-bottom:8px;padding-left:30px;font-size:14px;font-style:normal;font-weight:400;text-transform:capitalize"><?php echo esc_html__( 'shop now', 'salecraft-ecommerce' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"50%","className":"bnr-right-img-box"} -->
<div class="wp-block-column is-vertically-aligned-center bnr-right-img-box" style="flex-basis:50%"><!-- wp:image {"id":59,"width":"auto","height":"280px","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/banner-img1.png" alt="" class="wp-image-59" style="width:auto;height:280px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div></div>
<!-- /wp:cover -->

<!-- wp:columns {"verticalAlignment":"center","className":"bnr-bottom-boxes","style":{"spacing":{"margin":{"top":"0px","bottom":"0px"},"blockGap":{"top":"15px","left":"15px"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center bnr-bottom-boxes" style="margin-top:0px;margin-bottom:0px"><!-- wp:column {"verticalAlignment":"center","className":"bnr-bottom-box wow zoomIn","style":{"border":{"radius":"15px"},"spacing":{"padding":{"right":"20px","left":"20px","top":"25px"}}},"backgroundColor":"section-background"} -->
<div class="wp-block-column is-vertically-aligned-center bnr-bottom-box wow zoomIn has-section-background-background-color has-background" style="border-radius:15px;padding-top:25px;padding-right:20px;padding-left:20px"><!-- wp:paragraph {"align":"center","className":"banner-sm-title","style":{"typography":{"fontSize":"14px"}}} -->
<p class="has-text-align-center banner-sm-title" style="font-size:14px"><?php echo esc_html__( 'Gear VR', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":5,"className":"bnr-bottom-title","style":{"typography":{"fontSize":"20px","fontStyle":"normal","fontWeight":"500"},"spacing":{"margin":{"top":"6px"}}}} -->
<h5 class="wp-block-heading has-text-align-center bnr-bottom-title" style="margin-top:6px;font-size:20px;font-style:normal;font-weight:500"><?php echo esc_html__( 'Oculas Gear VE', 'salecraft-ecommerce' ); ?></h5>
<!-- /wp:heading -->

<!-- wp:image {"id":66,"width":"auto","height":"150px","sizeSlug":"full","linkDestination":"none","align":"center","className":"bnr-bottom-img","style":{"spacing":{"margin":{"top":"25px"}}}} -->
<figure class="wp-block-image aligncenter size-full is-resized bnr-bottom-img" style="margin-top:25px"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/banner-img2.png" alt="" class="wp-image-66" style="width:auto;height:150px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","className":"bnr-bottom-box wow zoomIn","style":{"border":{"radius":"15px"},"spacing":{"padding":{"right":"20px","left":"20px","top":"25px"}}},"backgroundColor":"section-background"} -->
<div class="wp-block-column is-vertically-aligned-center bnr-bottom-box wow zoomIn has-section-background-background-color has-background" style="border-radius:15px;padding-top:25px;padding-right:20px;padding-left:20px"><!-- wp:paragraph {"align":"center","className":"banner-sm-title","style":{"typography":{"fontSize":"14px"}}} -->
<p class="has-text-align-center banner-sm-title" style="font-size:14px"><?php echo esc_html__( 'Phones', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":5,"className":"bnr-bottom-title","style":{"typography":{"fontSize":"20px","fontStyle":"normal","fontWeight":"500"},"spacing":{"margin":{"top":"6px"}}}} -->
<h5 class="wp-block-heading has-text-align-center bnr-bottom-title" style="margin-top:6px;font-size:20px;font-style:normal;font-weight:500"><?php echo esc_html__( 'Iphone 17Pro Max', 'salecraft-ecommerce' ); ?></h5>
<!-- /wp:heading -->

<!-- wp:image {"id":81,"width":"auto","height":"150px","sizeSlug":"full","linkDestination":"none","align":"center","className":"bnr-bottom-img","style":{"spacing":{"margin":{"top":"25px"}}}} -->
<figure class="wp-block-image aligncenter size-full is-resized bnr-bottom-img" style="margin-top:25px"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/banner-img3.png" alt="" class="wp-image-81" style="width:auto;height:150px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:group {"className":"banner-btm-row","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group banner-btm-row"><!-- wp:group {"className":"banner-btm-box wow zoomIn","layout":{"type":"constrained"}} -->
<div class="wp-block-group banner-btm-box wow zoomIn"><!-- wp:columns {"verticalAlignment":"center","className":"banner-btm-icon-boxes","style":{"spacing":{"blockGap":{"top":"15px","left":"18px"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center banner-btm-icon-boxes"><!-- wp:column {"verticalAlignment":"center","width":"20%","className":"banner-btm-icon"} -->
<div class="wp-block-column is-vertically-aligned-center banner-btm-icon" style="flex-basis:20%"><!-- wp:image {"id":91,"width":"auto","height":"45px","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/icon1.png" alt="" class="wp-image-91" style="width:auto;height:45px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"80%","className":"banner-icon-info"} -->
<div class="wp-block-column is-vertically-aligned-center banner-icon-info" style="flex-basis:80%"><!-- wp:heading {"level":6,"className":"banner-icon-title","style":{"typography":{"fontSize":"17px","fontStyle":"normal","fontWeight":"600","textTransform":"capitalize"},"spacing":{"margin":{"bottom":"3px"}}}} -->
<h6 class="wp-block-heading banner-icon-title" style="margin-bottom:3px;font-size:17px;font-style:normal;font-weight:600;text-transform:capitalize"><?php echo esc_html__( 'free delivery', 'salecraft-ecommerce' ); ?></h6>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"banner-icon-text","style":{"typography":{"fontSize":"12px","textTransform":"capitalize"},"spacing":{"margin":{"top":"0px"}}}} -->
<p class="banner-icon-text" style="margin-top:0px;font-size:12px;text-transform:capitalize"><?php echo esc_html__( 'free shipping on all order', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"banner-btm-box wow zoomIn","layout":{"type":"constrained"}} -->
<div class="wp-block-group banner-btm-box wow zoomIn"><!-- wp:columns {"verticalAlignment":"center","className":"banner-btm-icon-boxes","style":{"spacing":{"blockGap":{"top":"15px","left":"18px"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center banner-btm-icon-boxes"><!-- wp:column {"verticalAlignment":"center","width":"20%","className":"banner-btm-icon"} -->
<div class="wp-block-column is-vertically-aligned-center banner-btm-icon" style="flex-basis:20%"><!-- wp:image {"id":118,"width":"auto","height":"45px","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/icon2.png" alt="" class="wp-image-118" style="width:auto;height:45px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"80%","className":"banner-icon-info"} -->
<div class="wp-block-column is-vertically-aligned-center banner-icon-info" style="flex-basis:80%"><!-- wp:heading {"level":6,"className":"banner-icon-title","style":{"typography":{"fontSize":"17px","fontStyle":"normal","fontWeight":"600","textTransform":"capitalize"},"spacing":{"margin":{"bottom":"3px"}}}} -->
<h6 class="wp-block-heading banner-icon-title" style="margin-bottom:3px;font-size:17px;font-style:normal;font-weight:600;text-transform:capitalize"><?php echo esc_html__( 'big saving shop', 'salecraft-ecommerce' ); ?></h6>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"banner-icon-text","style":{"typography":{"fontSize":"12px","textTransform":"capitalize"},"spacing":{"margin":{"top":"0px"}}}} -->
<p class="banner-icon-text" style="margin-top:0px;font-size:12px;text-transform:capitalize"><?php echo esc_html__( 'save vig every order guarantee', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"banner-btm-box wow zoomIn","layout":{"type":"constrained"}} -->
<div class="wp-block-group banner-btm-box wow zoomIn"><!-- wp:columns {"verticalAlignment":"center","className":"banner-btm-icon-boxes","style":{"spacing":{"blockGap":{"top":"15px","left":"18px"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center banner-btm-icon-boxes"><!-- wp:column {"verticalAlignment":"center","width":"20%","className":"banner-btm-icon"} -->
<div class="wp-block-column is-vertically-aligned-center banner-btm-icon" style="flex-basis:20%"><!-- wp:image {"id":119,"width":"auto","height":"45px","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/icon3.png" alt="" class="wp-image-119" style="width:auto;height:45px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"80%","className":"banner-icon-info"} -->
<div class="wp-block-column is-vertically-aligned-center banner-icon-info" style="flex-basis:80%"><!-- wp:heading {"level":6,"className":"banner-icon-title","style":{"typography":{"fontSize":"17px","fontStyle":"normal","fontWeight":"600","textTransform":"capitalize"},"spacing":{"margin":{"bottom":"3px"}}}} -->
<h6 class="wp-block-heading banner-icon-title" style="margin-bottom:3px;font-size:17px;font-style:normal;font-weight:600;text-transform:capitalize"><?php echo esc_html__( 'online support 24/7', 'salecraft-ecommerce' ); ?></h6>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"banner-icon-text","style":{"typography":{"fontSize":"12px","textTransform":"capitalize"},"spacing":{"margin":{"top":"0px"}}}} -->
<p class="banner-icon-text" style="margin-top:0px;font-size:12px;text-transform:capitalize"><?php echo esc_html__( 'support online 24 hours & 7 days', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"banner-btm-box wow zoomIn","layout":{"type":"constrained"}} -->
<div class="wp-block-group banner-btm-box wow zoomIn"><!-- wp:columns {"verticalAlignment":"center","className":"banner-btm-icon-boxes","style":{"spacing":{"blockGap":{"top":"15px","left":"18px"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center banner-btm-icon-boxes"><!-- wp:column {"verticalAlignment":"center","width":"20%","className":"banner-btm-icon"} -->
<div class="wp-block-column is-vertically-aligned-center banner-btm-icon" style="flex-basis:20%"><!-- wp:image {"id":120,"width":"auto","height":"45px","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/icon4.png" alt="" class="wp-image-120" style="width:auto;height:45px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"80%","className":"banner-icon-info"} -->
<div class="wp-block-column is-vertically-aligned-center banner-icon-info" style="flex-basis:80%"><!-- wp:heading {"level":6,"className":"banner-icon-title","style":{"typography":{"fontSize":"17px","fontStyle":"normal","fontWeight":"600","textTransform":"capitalize"},"spacing":{"margin":{"bottom":"3px"}}}} -->
<h6 class="wp-block-heading banner-icon-title" style="margin-bottom:3px;font-size:17px;font-style:normal;font-weight:600;text-transform:capitalize"><?php echo esc_html__( 'money back return', 'salecraft-ecommerce' ); ?></h6>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"banner-icon-text","style":{"typography":{"fontSize":"12px","textTransform":"capitalize"},"spacing":{"margin":{"top":"0px"}}}} -->
<p class="banner-icon-text" style="margin-top:0px;font-size:12px;text-transform:capitalize"><?php echo esc_html__( 'Back Guarantee Under 7 Day', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:spacer {"height":"35px"} -->
<div style="height:35px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<?php } ?>