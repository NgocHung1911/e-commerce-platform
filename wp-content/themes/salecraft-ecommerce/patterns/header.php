<?php
/**
 * Title: Header
 * Slug: salecraft-ecommerce/header
 * Categories: salecraft-ecommerce
 *
 * @package SaleCraft Ecommerce
 * @since 1.0.0
 */

?>
<!-- wp:group {"className":"main-header wow fadeInDown","layout":{"type":"default"}} -->
<div class="wp-block-group main-header wow fadeInDown"><!-- wp:group {"className":"top-info-header","style":{"spacing":{"padding":{"right":"0px","left":"0px","top":"8px","bottom":"8px"}}},"backgroundColor":"primary","layout":{"type":"constrained","contentSize":"85%"}} -->
<div class="wp-block-group top-info-header has-primary-background-color has-background" style="padding-top:8px;padding-right:0px;padding-bottom:8px;padding-left:0px"><!-- wp:group {"className":"top-inner-header","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group top-inner-header"><!-- wp:paragraph {"className":"topbar-text","style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"typography":{"fontSize":"15px","fontStyle":"normal","fontWeight":"400"}},"textColor":"base"} -->
<p class="topbar-text has-base-color has-text-color has-link-color" style="font-size:15px;font-style:normal;font-weight:400"><?php echo esc_html__( 'Tell a friend about electronics Gadgets & get 30% off your next order.', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"top-right-box","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group top-right-box"><!-- wp:group {"className":"track-box","layout":{"type":"default"}} -->
<div class="wp-block-group track-box"><!-- wp:paragraph {"className":"track-text","style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"typography":{"fontSize":"15px","textTransform":"capitalize"}},"textColor":"base"} -->
<p class="track-text has-base-color has-text-color has-link-color" style="font-size:15px;text-transform:capitalize"><?php echo esc_html__( 'tracking order', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->[custom_auth_box]<!-- /wp:shortcode --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"middle-header","style":{"spacing":{"padding":{"right":"0px","left":"0px"}}},"layout":{"type":"constrained","contentSize":"85%"}} -->
<div class="wp-block-group middle-header" style="padding-right:0px;padding-left:0px"><!-- wp:columns {"className":"middle-inner-header"} -->
<div class="wp-block-columns middle-inner-header"><!-- wp:column {"verticalAlignment":"center","width":"20%","className":"header-logo-box"} -->
<div class="wp-block-column is-vertically-aligned-center header-logo-box" style="flex-basis:20%"><!-- wp:site-title /--></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"40%","className":"header-search-box"} -->
<div class="wp-block-column is-vertically-aligned-center header-search-box" style="flex-basis:40%"><!-- wp:search {"label":"Search","showLabel":false,"placeholder":"Search For Anytings","buttonText":"Search","buttonPosition":"button-inside","buttonUseIcon":true,"query":{"post_type":"product"},"style":{"border":{"radius":"6px","width":"0px","style":"none"}},"backgroundColor":"contrast","namespace":"woocommerce/product-search"} /--></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"25%","className":"header-info-box"} -->
<div class="wp-block-column is-vertically-aligned-center header-info-box" style="flex-basis:25%"><!-- wp:group {"className":"header-inner-info","style":{"spacing":{"blockGap":"25px"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
<div class="wp-block-group header-inner-info"><!-- wp:paragraph {"className":"header-info-text","style":{"typography":{"fontSize":"15px","textTransform":"capitalize","fontStyle":"normal","fontWeight":"400"}}} -->
<p class="header-info-text" style="font-size:15px;font-style:normal;font-weight:400;text-transform:capitalize"><img class="wp-image-60" style="width: 60px;" src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/header-img-1.png" alt=""><?php echo esc_html__( 'today deals', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"header-info-text","style":{"typography":{"fontSize":"15px","textTransform":"capitalize","fontStyle":"normal","fontWeight":"400"}}} -->
<p class="header-info-text" style="font-size:15px;font-style:normal;font-weight:400;text-transform:capitalize"><img class="wp-image-65" style="width: 60px;" src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/header-img-2.png" alt=""><?php echo esc_html__( 'special offer', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"15%","className":"top-contact-box"} -->
<div class="wp-block-column is-vertically-aligned-center top-contact-box" style="flex-basis:15%"><!-- wp:columns {"verticalAlignment":"center","className":"top-contact-in-box"} -->
<div class="wp-block-columns are-vertically-aligned-center top-contact-in-box"><!-- wp:column {"verticalAlignment":"center","width":"80%","className":"contact-info"} -->
<div class="wp-block-column is-vertically-aligned-center contact-info" style="flex-basis:80%"><!-- wp:paragraph {"align":"right","className":"contact-text","style":{"typography":{"fontSize":"13px","fontStyle":"normal","fontWeight":"400","textTransform":"capitalize"},"elements":{"link":{"color":{"text":"var:preset|color|primary"}}}},"textColor":"primary"} -->
<p class="has-text-align-right contact-text has-primary-color has-text-color has-link-color" style="font-size:13px;font-style:normal;font-weight:400;text-transform:capitalize"><?php echo esc_html__( 'contact now', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"right","className":"contact-num","style":{"elements":{"link":{"color":{"text":"var:preset|color|contrast"}}},"typography":{"fontSize":"17px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0px","bottom":"0px"}}},"textColor":"contrast"} -->
<p class="has-text-align-right contact-num has-contrast-color has-text-color has-link-color" style="margin-top:0px;margin-bottom:0px;font-size:17px;font-style:normal;font-weight:600"><a href="tel:123456789123"><?php echo esc_html__( '+12 3456789123', 'salecraft-ecommerce' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"20%","className":"contact-img-box"} -->
<div class="wp-block-column is-vertically-aligned-center contact-img-box" style="flex-basis:20%"><!-- wp:image {"id":70,"width":"auto","height":"20px","sizeSlug":"full","linkDestination":"none","className":"phone-img"} -->
<figure class="wp-block-image size-full is-resized phone-img"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/phone.png" alt="" class="wp-image-70" style="width:auto;height:20px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"bottom-header","style":{"spacing":{"padding":{"right":"0px","left":"0px","top":"10px","bottom":"10px"}}},"backgroundColor":"section-background","layout":{"type":"constrained","contentSize":"85%"}} -->
<div class="wp-block-group bottom-header has-section-background-background-color has-background" style="padding-top:10px;padding-right:0px;padding-bottom:10px;padding-left:0px"><!-- wp:columns {"verticalAlignment":"center","className":"header-btm-inner"} -->
<div class="wp-block-columns are-vertically-aligned-center header-btm-inner"><!-- wp:column {"verticalAlignment":"center","width":"25%","className":"header-btm-left"} -->
<div class="wp-block-column is-vertically-aligned-center header-btm-left" style="flex-basis:25%"><!-- wp:woocommerce/product-categories {"isDropdown":true} /--></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"50%","className":"header-btm-mid"} -->
<div class="wp-block-column is-vertically-aligned-center header-btm-mid" style="flex-basis:50%"><!-- wp:navigation {"textColor":"contrast","overlayBackgroundColor":"primary","overlayTextColor":"base","metadata":{"ignoredHookedBlocks":["woocommerce/mini-cart"]},"style":{"typography":{"fontSize":"15px","fontStyle":"normal","fontWeight":"500"},"spacing":{"blockGap":"40px"}},"layout":{"type":"flex","justifyContent":"center"}} --><!-- wp:navigation-link {"label":"Home","url":"#","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"About Us","url":"#","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"Pages","url":"#","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"Blogs","url":"#","kind":"custom","isTopLevelLink":true} /-->
	
<!-- /wp:navigation --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"25%","className":"header-btm-right"} -->
<div class="wp-block-column is-vertically-aligned-center header-btm-right" style="flex-basis:25%"><!-- wp:group {"className":"header-btm-in-right","style":{"spacing":{"blockGap":"20px"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"right"}} -->
<div class="wp-block-group header-btm-in-right">

<!-- wp:buttons {"className":"header-wishlist-btn"} -->
<div class="wp-block-buttons header-wishlist-btn"><!-- wp:button {"style":{"color":{"background":"#00000000"},"spacing":{"padding":{"left":"0px","right":"0px","top":"0px","bottom":"0px"}}}} -->
<div class="wp-block-button"><a class="wp-block-button__link has-background wp-element-button" href="#" style="background-color:#00000000;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><img class="wp-image-101" style="width: 56px;" src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/wishlist-btn.png" alt=""></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:woocommerce/cart-link {"content":"","className":"header-cart-btn"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->