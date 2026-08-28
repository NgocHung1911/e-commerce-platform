<?php
/**
 * Title: Product Section
 * Slug: salecraft-ecommerce/product-section
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

<!-- wp:group {"className":"product-section","style":{"spacing":{"padding":{"right":"0px","left":"0px"}}},"layout":{"type":"constrained","contentSize":"85%"}} -->
<div class="wp-block-group product-section" style="padding-right:0px;padding-left:0px"><!-- wp:group {"className":"product-sec-head-box","style":{"spacing":{"blockGap":"15px","margin":{"bottom":"45px"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group product-sec-head-box" style="margin-bottom:45px"><!-- wp:heading {"level":3,"className":"product-section-title wow zoomIn","style":{"typography":{"fontSize":"25px","fontStyle":"normal","fontWeight":"600","textTransform":"capitalize"},"spacing":{"margin":{"bottom":"0px"}}}} -->
<h3 class="wp-block-heading product-section-title wow zoomIn" style="margin-bottom:0px;font-size:25px;font-style:normal;font-weight:600;text-transform:capitalize"><?php echo esc_html__( 'deal of the day', 'salecraft-ecommerce' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:essential-blocks/countdown {"blockId":"eb-countdown-23ee4","blockMeta":{"desktop":".eb-countdown-23ee4.eb-cd-wrapper{max-width:600px;transition:background 0.5s,border 0.5s,border-radius 0.5s,box-shadow 0.5s}div.eb-countdown-23ee4.eb-cd-wrapper{margin-left:auto;margin-right:auto}.eb-countdown-23ee4.eb-cd-wrapper:before{transition:background 0.5s,opacity 0.5s,filter 0.5s}.eb-countdown-23ee4.eb-cd-wrapper .eb-cd-inner{flex-direction:row}.eb-countdown-23ee4.eb-cd-wrapper .eb-cd-inner .box{background-color:rgba(255,255,255,1);transition:background 0.5s,border 0.5s,border-radius 0.5s,box-shadow 0.5s;padding-top:12px;padding-bottom:12px;border-radius:10px;flex-direction:column;align-items:center}.eb-countdown-23ee4.eb-cd-wrapper .eb-cd-inner .box:hover{border-radius:10px}.eb-countdown-23ee4.eb-cd-wrapper .eb-cd-inner .box span.eb-cd-digit{font-size:64px;line-height:1.1em;color:rgba(75,75,75,1)}.eb-countdown-23ee4.eb-cd-wrapper .eb-cd-inner .box span.eb-cd-label{font-size:21px;text-transform:uppercase;color:rgba(75,75,75,1)}.eb-countdown-23ee4.eb-cd-wrapper .eb-cd-inner .box + .box{margin:0;margin-left:30px}.eb-countdown-23ee4.eb-cd-wrapper .eb-cd-inner .box.cd-box-day{border-color:rgba(0,194,232,1)}.eb-countdown-23ee4.eb-cd-wrapper .eb-cd-inner .box.cd-box-hour{border-color:rgba(255,107,211,1)}.eb-countdown-23ee4.eb-cd-wrapper .eb-cd-inner .box.cd-box-minute{border-color:rgba(153,102,13,1)}.eb-countdown-23ee4.eb-cd-wrapper .eb-cd-inner .box.cd-box-second{border-color:rgba(0,91,255,1)}","tab":"","mobile":""},"preset":"preset2","endTimeStamp":1780816704000,"digitsColor":"rgba(75,75,75,1)","labelsColor":"rgba(75,75,75,1)","dayBdrColor":"rgba(0,194,232,1)","hourBdrColor":"rgba(255,107,211,1)","minuteBdrColor":"rgba(153,102,13,1)","secondBdrColor":"rgba(0,91,255,1)","recurringCountdownEnd":1710924335631,"dg_FontSize":64,"dg_LineHeight":1.1,"lb_FontSize":21,"lb_TextTransform":"uppercase","sepRight_Range":20,"boxsBg_backgroundColor":"rgba(255,255,255,1)","boxsBds_borderStyle":"solid","boxsBds_Bdr_Top":"2","boxsBds_Bdr_Right":"2","boxsBds_Bdr_Bottom":"2","boxsBds_Bdr_Left":"2","boxsP_Top":"12","boxsP_Bottom":"12","className":"product-timer wow zoomIn","commonStyles":{"desktop":".eb-parent-eb-countdown-23ee4{display:block}.root-eb-countdown-23ee4{position:relative}.root-eb-countdown-23ee4.eb_liquid_glass-effect1{background-color:#FFFFFF1F;backdrop-filter:blur(24px)}.root-eb-countdown-23ee4.eb_liquid_glass-effect2{background-color:#FFFFFF1F;backdrop-filter:blur(24px) brightness(1)}.root-eb-countdown-23ee4.eb_liquid_glass_shadow-effect1{border-width:1px;border-color:#FFFFFF1F;border-style:solid;border-radius:24px}.root-eb-countdown-23ee4.eb_liquid_glass-effect1 \u003e .eb-parent-wrapper \u003e div{background:transparent}","tab":".eb-parent-eb-countdown-23ee4{display:block}","mobile":".eb-parent-eb-countdown-23ee4{display:block}"}} -->
<div class="wp-block-essential-blocks-countdown product-timer wow zoomIn  root-eb-countdown-23ee4"><div class="eb-parent-wrapper eb-parent-eb-countdown-23ee4 "><div class="eb-countdown-23ee4 eb-cd-wrapper preset2"><div class="eb-cd-inner" blockid="eb-countdown-23ee4" data-deadline-time="1780816704000" data-is-evergreen-time="false" data-evergreen-time-hours="11" data-evergreen-time-minutes="59" data-evergreen-recurring="false" data-evergreen-restart-time="0" data-evergreen-deadline-time="1710924335631"><div class="box cd-box-day"><span class="eb-cd-digit"><?php echo esc_html__( '00', 'salecraft-ecommerce' ); ?></span><span class="eb-cd-label"><?php echo esc_html__( 'Days', 'salecraft-ecommerce' ); ?></span></div><div class="box cd-box-hour"><span class="eb-cd-digit"><?php echo esc_html__( '00', 'salecraft-ecommerce' ); ?></span><span class="eb-cd-label"><?php echo esc_html__( 'Hours', 'salecraft-ecommerce' ); ?></span></div><div class="box cd-box-minute"><span class="eb-cd-digit"><?php echo esc_html__( '00', 'salecraft-ecommerce' ); ?></span><span class="eb-cd-label"><?php echo esc_html__( 'Minutes', 'salecraft-ecommerce' ); ?></span></div><div class="box cd-box-second"><span class="eb-cd-digit"><?php echo esc_html__( '00', 'salecraft-ecommerce' ); ?></span><span class="eb-cd-label"><?php echo esc_html__( 'Seconds', 'salecraft-ecommerce' ); ?></span></div></div></div></div></div>
<!-- /wp:essential-blocks/countdown --></div>
<!-- /wp:group -->

<!-- wp:woocommerce/product-collection {"queryId":1,"query":{"perPage":5,"pages":1,"offset":0,"postType":"product","order":"desc","orderBy":"date","search":"","exclude":[],"inherit":false,"taxQuery":{},"isProductCollectionBlock":true,"featured":false,"woocommerceOnSale":false,"woocommerceStockStatus":["instock","outofstock","onbackorder"],"woocommerceAttributes":[],"woocommerceHandPickedProducts":[],"timeFrame":{"operator":"in","value":"-7 days"},"filterable":false,"relatedBy":{"categories":true,"tags":true}},"tagName":"div","displayLayout":{"type":"flex","columns":5,"shrinkColumns":true},"dimensions":{"widthType":"fill"},"collection":"woocommerce/product-collection/new-arrivals","hideControls":["inherit","order","filterable"],"queryContextIncludes":["collection"],"__privatePreviewState":{"isPreview":false,"previewMessage":"Actual products will vary depending on the page being viewed."},"className":"product-boxes"} -->
<div class="wp-block-woocommerce-product-collection product-boxes"><!-- wp:woocommerce/product-template -->
<!-- wp:group {"className":"product-cards wow zoomIn","style":{"spacing":{"padding":{"top":"12px","bottom":"12px","left":"12px","right":"12px"}},"border":{"radius":"10px"}},"backgroundColor":"section-background","layout":{"type":"default"}} -->
<div class="wp-block-group product-cards wow zoomIn has-section-background-background-color has-background" style="border-radius:10px;padding-top:12px;padding-right:12px;padding-bottom:12px;padding-left:12px"><!-- wp:group {"className":"product-img-box","style":{"border":{"radius":"10px"},"spacing":{"padding":{"top":"20px","bottom":"20px","left":"20px","right":"20px"}}},"backgroundColor":"base","layout":{"type":"default"}} -->
<div class="wp-block-group product-img-box has-base-background-color has-background" style="border-radius:10px;padding-top:20px;padding-right:20px;padding-bottom:20px;padding-left:20px"><!-- wp:woocommerce/product-image {"showSaleBadge":false,"imageSizing":"thumbnail","isDescendentOfQueryLoop":true,"height":"150px","className":"product-img"} /-->

<!-- wp:post-terms {"term":"product_cat","className":"product-left-text","style":{"spacing":{"margin":{"top":"0px"},"padding":{"top":"3px","bottom":"3px","left":"10px","right":"10px"}},"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"border":{"radius":{"topLeft":"10px","bottomRight":"6px"}},"typography":{"fontSize":"14px"}},"backgroundColor":"primary","textColor":"base"} /-->

<!-- wp:group {"className":"product-right-box","style":{"spacing":{"margin":{"top":"0px"},"blockGap":"6px"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
<div class="wp-block-group product-right-box" style="margin-top:0px"><!-- wp:post-terms {"term":"product_tag","className":"product-right-text","style":{"spacing":{"padding":{"top":"3px","bottom":"3px","left":"10px","right":"10px"},"margin":{"top":"0px","bottom":"6px"}},"typography":{"fontSize":"14px"},"color":{"background":"#ff2929"},"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"border":{"radius":{"topRight":"10px","bottomLeft":"6px"}}},"textColor":"base"} /-->

<!-- wp:woocommerce/product-button {"textAlign":"center","isDescendentOfQueryLoop":true,"className":"product-cart-btn","fontSize":"small","style":{"spacing":{"padding":{"top":"0px","bottom":"0px","left":"0px","right":"0px"}}}} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"product-content","layout":{"type":"default"}} -->
<div class="wp-block-group product-content"><!-- wp:post-title {"textAlign":"left","isLink":true,"className":"product-card-title","style":{"spacing":{"margin":{"bottom":"5px","top":"0"}},"typography":{"lineHeight":"1.4","fontSize":"18px","fontStyle":"normal","fontWeight":"600"}},"__woocommerceNamespace":"woocommerce/product-collection/product-title"} /-->

<!-- wp:woocommerce/product-summary {"isDescendentOfQueryLoop":true,"showDescriptionIfEmpty":true,"summaryLength":15,"className":"product-card-desc","textColor":"contrast","style":{"typography":{"fontSize":"13px"},"elements":{"link":{"color":{"text":"var:preset|color|contrast"}}},"spacing":{"margin":{"top":"0px","bottom":"0px"}}}} /-->

<!-- wp:group {"className":"product-btm-box","style":{"spacing":{"margin":{"top":"8px"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group product-btm-box" style="margin-top:8px"><!-- wp:woocommerce/product-price {"isDescendentOfQueryLoop":true,"textAlign":"center","style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"700"}}} /-->

<!-- wp:woocommerce/product-rating {"isDescendentOfQueryLoop":true} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:woocommerce/product-template --></div>
<!-- /wp:woocommerce/product-collection --></div>
<!-- /wp:group -->

<!-- wp:spacer {"height":"35px"} -->
<div style="height:35px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<?php } else { ?>

<!-- wp:group {"className":"product-section","style":{"spacing":{"padding":{"right":"0px","left":"0px"}}},"layout":{"type":"constrained","contentSize":"85%"}} -->
<div class="wp-block-group product-section" style="padding-right:0px;padding-left:0px"><!-- wp:group {"className":"product-sec-head-box","style":{"spacing":{"blockGap":"15px","margin":{"bottom":"45px"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group product-sec-head-box" style="margin-bottom:45px"><!-- wp:heading {"level":3,"className":"product-section-title wow zoomIn","style":{"typography":{"fontSize":"25px","fontStyle":"normal","fontWeight":"600","textTransform":"capitalize"},"spacing":{"margin":{"bottom":"0px"}}}} -->
<h3 class="wp-block-heading product-section-title wow zoomIn" style="margin-bottom:0px;font-size:25px;font-style:normal;font-weight:600;text-transform:capitalize"><?php echo esc_html__( 'deal of the day', 'salecraft-ecommerce' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:essential-blocks/countdown {"blockId":"eb-countdown-23ee4","blockMeta":{"desktop":".eb-countdown-23ee4.eb-cd-wrapper{max-width:600px;transition:background 0.5s,border 0.5s,border-radius 0.5s,box-shadow 0.5s}div.eb-countdown-23ee4.eb-cd-wrapper{margin-left:auto;margin-right:auto}.eb-countdown-23ee4.eb-cd-wrapper:before{transition:background 0.5s,opacity 0.5s,filter 0.5s}.eb-countdown-23ee4.eb-cd-wrapper .eb-cd-inner{flex-direction:row}.eb-countdown-23ee4.eb-cd-wrapper .eb-cd-inner .box{background-color:rgba(255,255,255,1);transition:background 0.5s,border 0.5s,border-radius 0.5s,box-shadow 0.5s;padding-top:12px;padding-bottom:12px;border-radius:10px;flex-direction:column;align-items:center}.eb-countdown-23ee4.eb-cd-wrapper .eb-cd-inner .box:hover{border-radius:10px}.eb-countdown-23ee4.eb-cd-wrapper .eb-cd-inner .box span.eb-cd-digit{font-size:64px;line-height:1.1em;color:rgba(75,75,75,1)}.eb-countdown-23ee4.eb-cd-wrapper .eb-cd-inner .box span.eb-cd-label{font-size:21px;text-transform:uppercase;color:rgba(75,75,75,1)}.eb-countdown-23ee4.eb-cd-wrapper .eb-cd-inner .box + .box{margin:0;margin-left:30px}.eb-countdown-23ee4.eb-cd-wrapper .eb-cd-inner .box.cd-box-day{border-color:rgba(0,194,232,1)}.eb-countdown-23ee4.eb-cd-wrapper .eb-cd-inner .box.cd-box-hour{border-color:rgba(255,107,211,1)}.eb-countdown-23ee4.eb-cd-wrapper .eb-cd-inner .box.cd-box-minute{border-color:rgba(153,102,13,1)}.eb-countdown-23ee4.eb-cd-wrapper .eb-cd-inner .box.cd-box-second{border-color:rgba(0,91,255,1)}","tab":"","mobile":""},"preset":"preset2","endTimeStamp":1780816704000,"digitsColor":"rgba(75,75,75,1)","labelsColor":"rgba(75,75,75,1)","dayBdrColor":"rgba(0,194,232,1)","hourBdrColor":"rgba(255,107,211,1)","minuteBdrColor":"rgba(153,102,13,1)","secondBdrColor":"rgba(0,91,255,1)","recurringCountdownEnd":1710924335631,"dg_FontSize":64,"dg_LineHeight":1.1,"lb_FontSize":21,"lb_TextTransform":"uppercase","sepRight_Range":20,"boxsBg_backgroundColor":"rgba(255,255,255,1)","boxsBds_borderStyle":"solid","boxsBds_Bdr_Top":"2","boxsBds_Bdr_Right":"2","boxsBds_Bdr_Bottom":"2","boxsBds_Bdr_Left":"2","boxsP_Top":"12","boxsP_Bottom":"12","className":"product-timer wow zoomIn","commonStyles":{"desktop":".eb-parent-eb-countdown-23ee4{display:block}.root-eb-countdown-23ee4{position:relative}.root-eb-countdown-23ee4.eb_liquid_glass-effect1{background-color:#FFFFFF1F;backdrop-filter:blur(24px)}.root-eb-countdown-23ee4.eb_liquid_glass-effect2{background-color:#FFFFFF1F;backdrop-filter:blur(24px) brightness(1)}.root-eb-countdown-23ee4.eb_liquid_glass_shadow-effect1{border-width:1px;border-color:#FFFFFF1F;border-style:solid;border-radius:24px}.root-eb-countdown-23ee4.eb_liquid_glass-effect1 \u003e .eb-parent-wrapper \u003e div{background:transparent}","tab":".eb-parent-eb-countdown-23ee4{display:block}","mobile":".eb-parent-eb-countdown-23ee4{display:block}"}} -->
<div class="wp-block-essential-blocks-countdown product-timer wow zoomIn  root-eb-countdown-23ee4"><div class="eb-parent-wrapper eb-parent-eb-countdown-23ee4 "><div class="eb-countdown-23ee4 eb-cd-wrapper preset2"><div class="eb-cd-inner" blockid="eb-countdown-23ee4" data-deadline-time="1780816704000" data-is-evergreen-time="false" data-evergreen-time-hours="11" data-evergreen-time-minutes="59" data-evergreen-recurring="false" data-evergreen-restart-time="0" data-evergreen-deadline-time="1710924335631"><div class="box cd-box-day"><span class="eb-cd-digit"><?php echo esc_html__( '00', 'salecraft-ecommerce' ); ?></span><span class="eb-cd-label"><?php echo esc_html__( 'Days', 'salecraft-ecommerce' ); ?></span></div><div class="box cd-box-hour"><span class="eb-cd-digit"><?php echo esc_html__( '00', 'salecraft-ecommerce' ); ?></span><span class="eb-cd-label"><?php echo esc_html__( 'Hours', 'salecraft-ecommerce' ); ?></span></div><div class="box cd-box-minute"><span class="eb-cd-digit"><?php echo esc_html__( '00', 'salecraft-ecommerce' ); ?></span><span class="eb-cd-label"><?php echo esc_html__( 'Minutes', 'salecraft-ecommerce' ); ?></span></div><div class="box cd-box-second"><span class="eb-cd-digit"><?php echo esc_html__( '00', 'salecraft-ecommerce' ); ?></span><span class="eb-cd-label"><?php echo esc_html__( 'Seconds', 'salecraft-ecommerce' ); ?></span></div></div></div></div></div>
<!-- /wp:essential-blocks/countdown --></div>
<!-- /wp:group -->

<!-- wp:columns {"className":"product-boxes"} -->
<div class="wp-block-columns product-boxes"><!-- wp:column {"className":"product-cards wow zoomIn","style":{"border":{"radius":"10px"},"spacing":{"padding":{"top":"12px","bottom":"12px","left":"12px","right":"12px"}}},"backgroundColor":"section-background"} -->
<div class="wp-block-column product-cards wow zoomIn has-section-background-background-color has-background" style="border-radius:10px;padding-top:12px;padding-right:12px;padding-bottom:12px;padding-left:12px"><!-- wp:group {"className":"product-img-box","style":{"border":{"radius":"10px"},"spacing":{"padding":{"top":"20px","bottom":"20px","left":"20px","right":"20px"}}},"backgroundColor":"base","layout":{"type":"default"}} -->
<div class="wp-block-group product-img-box has-base-background-color has-background" style="border-radius:10px;padding-top:20px;padding-right:20px;padding-bottom:20px;padding-left:20px"><!-- wp:image {"id":135,"width":"auto","height":"150px","sizeSlug":"full","linkDestination":"none","align":"center","className":"product-img"} -->
<figure class="wp-block-image aligncenter size-full is-resized product-img"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/product1.png" alt="" class="wp-image-135" style="width:auto;height:150px"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"className":"product-left-text","style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"typography":{"fontSize":"14px","textTransform":"capitalize"},"spacing":{"padding":{"top":"3px","bottom":"3px","left":"10px","right":"10px"},"margin":{"top":"0px"}},"border":{"radius":{"topLeft":"10px","bottomRight":"6px"}}},"backgroundColor":"primary","textColor":"base"} -->
<p class="product-left-text has-base-color has-primary-background-color has-text-color has-background has-link-color" style="border-top-left-radius:10px;border-bottom-right-radius:6px;margin-top:0px;padding-top:3px;padding-right:10px;padding-bottom:3px;padding-left:10px;font-size:14px;text-transform:capitalize"><?php echo esc_html__( 'feature', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"product-right-box","style":{"spacing":{"margin":{"top":"0px"},"blockGap":"6px"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
<div class="wp-block-group product-right-box" style="margin-top:0px"><!-- wp:paragraph {"className":"product-right-text","style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"typography":{"fontSize":"14px","textTransform":"capitalize"},"spacing":{"padding":{"top":"3px","bottom":"3px","left":"10px","right":"10px"},"margin":{"top":"0px","bottom":"6px"}},"border":{"radius":{"topRight":"10px","bottomLeft":"6px"}},"color":{"background":"#ff2929"}},"textColor":"base"} -->
<p class="product-right-text has-base-color has-text-color has-background has-link-color" style="border-top-right-radius:10px;border-bottom-left-radius:6px;background-color:#ff2929;margin-top:0px;margin-bottom:6px;padding-top:3px;padding-right:10px;padding-bottom:3px;padding-left:10px;font-size:14px;text-transform:capitalize"><?php echo esc_html__( 'new', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:image {"id":169,"width":"auto","height":"16px","sizeSlug":"full","linkDestination":"none","className":"product-wishlist-btn"} -->
<figure class="wp-block-image size-full is-resized product-wishlist-btn"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/heart.png" alt="" class="wp-image-169" style="width:auto;height:16px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"id":170,"width":"auto","height":"16px","sizeSlug":"full","linkDestination":"none","className":"product-cart-btn"} -->
<figure class="wp-block-image size-full is-resized product-cart-btn"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/cart.png" alt="" class="wp-image-170" style="width:auto;height:16px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"product-content","layout":{"type":"default"}} -->
<div class="wp-block-group product-content"><!-- wp:heading {"level":6,"className":"product-card-title","style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"500","textTransform":"capitalize"}}} -->
<h6 class="wp-block-heading product-card-title" style="font-size:18px;font-style:normal;font-weight:500;text-transform:capitalize"><?php echo esc_html__( 'product name here', 'salecraft-ecommerce' ); ?></h6>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"product-card-desc","style":{"elements":{"link":{"color":{"text":"var:preset|color|contrast"}}},"typography":{"fontSize":"13px"},"spacing":{"margin":{"top":"5px"}}},"textColor":"contrast"} -->
<p class="product-card-desc has-contrast-color has-text-color has-link-color" style="margin-top:5px;font-size:13px"><?php echo esc_html__( 'Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry.', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"product-btm-box","style":{"spacing":{"margin":{"top":"5px"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group product-btm-box" style="margin-top:5px"><!-- wp:group {"className":"product-price-box","style":{"spacing":{"blockGap":"8px"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
<div class="wp-block-group product-price-box"><!-- wp:paragraph {"className":"product-sale","style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"600"}}} -->
<p class="product-sale" style="font-size:16px;font-style:normal;font-weight:600"><?php echo esc_html__( '$49.00', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"product-reg","style":{"typography":{"fontSize":"11px","textDecoration":"line-through","fontStyle":"normal","fontWeight":"600"}}} -->
<p class="product-reg" style="font-size:11px;font-style:normal;font-weight:600;text-decoration:line-through"><?php echo esc_html__( '$59.00', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:image {"id":150,"width":"auto","height":"16px","sizeSlug":"full","linkDestination":"none","className":"product-card-rating"} -->
<figure class="wp-block-image size-full is-resized product-card-rating"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/rating.png" alt="" class="wp-image-150" style="width:auto;height:16px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"product-cards wow zoomIn","style":{"border":{"radius":"10px"},"spacing":{"padding":{"top":"12px","bottom":"12px","left":"12px","right":"12px"}}},"backgroundColor":"section-background"} -->
<div class="wp-block-column product-cards wow zoomIn has-section-background-background-color has-background" style="border-radius:10px;padding-top:12px;padding-right:12px;padding-bottom:12px;padding-left:12px"><!-- wp:group {"className":"product-img-box","style":{"border":{"radius":"10px"},"spacing":{"padding":{"top":"20px","bottom":"20px","left":"20px","right":"20px"}}},"backgroundColor":"base","layout":{"type":"default"}} -->
<div class="wp-block-group product-img-box has-base-background-color has-background" style="border-radius:10px;padding-top:20px;padding-right:20px;padding-bottom:20px;padding-left:20px"><!-- wp:image {"id":182,"width":"auto","height":"150px","sizeSlug":"full","linkDestination":"none","align":"center","className":"product-img"} -->
<figure class="wp-block-image aligncenter size-full is-resized product-img"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/product2.png" alt="" class="wp-image-182" style="width:auto;height:150px"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"className":"product-left-text","style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"typography":{"fontSize":"14px","textTransform":"capitalize"},"spacing":{"padding":{"top":"3px","bottom":"3px","left":"10px","right":"10px"},"margin":{"top":"0px"}},"border":{"radius":{"topLeft":"10px","bottomRight":"6px"}}},"backgroundColor":"primary","textColor":"base"} -->
<p class="product-left-text has-base-color has-primary-background-color has-text-color has-background has-link-color" style="border-top-left-radius:10px;border-bottom-right-radius:6px;margin-top:0px;padding-top:3px;padding-right:10px;padding-bottom:3px;padding-left:10px;font-size:14px;text-transform:capitalize"><?php echo esc_html__( 'feature', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"product-right-box","style":{"spacing":{"margin":{"top":"0px"},"blockGap":"6px"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
<div class="wp-block-group product-right-box" style="margin-top:0px"><!-- wp:paragraph {"className":"product-right-text","style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"typography":{"fontSize":"14px","textTransform":"capitalize"},"spacing":{"padding":{"top":"3px","bottom":"3px","left":"10px","right":"10px"},"margin":{"top":"0px","bottom":"6px"}},"border":{"radius":{"topRight":"10px","bottomLeft":"6px"}},"color":{"background":"#ff2929"}},"textColor":"base"} -->
<p class="product-right-text has-base-color has-text-color has-background has-link-color" style="border-top-right-radius:10px;border-bottom-left-radius:6px;background-color:#ff2929;margin-top:0px;margin-bottom:6px;padding-top:3px;padding-right:10px;padding-bottom:3px;padding-left:10px;font-size:14px;text-transform:capitalize"><?php echo esc_html__( 'new', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:image {"id":169,"width":"auto","height":"16px","sizeSlug":"full","linkDestination":"none","className":"product-wishlist-btn"} -->
<figure class="wp-block-image size-full is-resized product-wishlist-btn"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/heart.png" alt="" class="wp-image-169" style="width:auto;height:16px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"id":170,"width":"auto","height":"16px","sizeSlug":"full","linkDestination":"none","className":"product-cart-btn"} -->
<figure class="wp-block-image size-full is-resized product-cart-btn"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/cart.png" alt="" class="wp-image-170" style="width:auto;height:16px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"product-content","layout":{"type":"default"}} -->
<div class="wp-block-group product-content"><!-- wp:heading {"level":6,"className":"product-card-title","style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"500","textTransform":"capitalize"}}} -->
<h6 class="wp-block-heading product-card-title" style="font-size:18px;font-style:normal;font-weight:500;text-transform:capitalize"><?php echo esc_html__( 'product name here', 'salecraft-ecommerce' ); ?></h6>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"product-card-desc","style":{"elements":{"link":{"color":{"text":"var:preset|color|contrast"}}},"typography":{"fontSize":"13px"},"spacing":{"margin":{"top":"5px"}}},"textColor":"contrast"} -->
<p class="product-card-desc has-contrast-color has-text-color has-link-color" style="margin-top:5px;font-size:13px"><?php echo esc_html__( 'Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry.', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"product-btm-box","style":{"spacing":{"margin":{"top":"5px"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group product-btm-box" style="margin-top:5px"><!-- wp:group {"className":"product-price-box","style":{"spacing":{"blockGap":"8px"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
<div class="wp-block-group product-price-box"><!-- wp:paragraph {"className":"product-sale","style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"600"}}} -->
<p class="product-sale" style="font-size:16px;font-style:normal;font-weight:600"><?php echo esc_html__( '$49.00', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"product-reg","style":{"typography":{"fontSize":"11px","textDecoration":"line-through","fontStyle":"normal","fontWeight":"600"}}} -->
<p class="product-reg" style="font-size:11px;font-style:normal;font-weight:600;text-decoration:line-through"><?php echo esc_html__( '$59.00', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:image {"id":150,"width":"auto","height":"16px","sizeSlug":"full","linkDestination":"none","className":"product-card-rating"} -->
<figure class="wp-block-image size-full is-resized product-card-rating"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/rating.png" alt="" class="wp-image-150" style="width:auto;height:16px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"product-cards wow zoomIn","style":{"border":{"radius":"10px"},"spacing":{"padding":{"top":"12px","bottom":"12px","left":"12px","right":"12px"}}},"backgroundColor":"section-background"} -->
<div class="wp-block-column product-cards wow zoomIn has-section-background-background-color has-background" style="border-radius:10px;padding-top:12px;padding-right:12px;padding-bottom:12px;padding-left:12px"><!-- wp:group {"className":"product-img-box","style":{"border":{"radius":"10px"},"spacing":{"padding":{"top":"20px","bottom":"20px","left":"20px","right":"20px"}}},"backgroundColor":"base","layout":{"type":"default"}} -->
<div class="wp-block-group product-img-box has-base-background-color has-background" style="border-radius:10px;padding-top:20px;padding-right:20px;padding-bottom:20px;padding-left:20px"><!-- wp:image {"id":183,"width":"auto","height":"150px","sizeSlug":"full","linkDestination":"none","align":"center","className":"product-img"} -->
<figure class="wp-block-image aligncenter size-full is-resized product-img"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/product3.png" alt="" class="wp-image-183" style="width:auto;height:150px"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"className":"product-left-text","style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"typography":{"fontSize":"14px","textTransform":"capitalize"},"spacing":{"padding":{"top":"3px","bottom":"3px","left":"10px","right":"10px"},"margin":{"top":"0px"}},"border":{"radius":{"topLeft":"10px","bottomRight":"6px"}}},"backgroundColor":"primary","textColor":"base"} -->
<p class="product-left-text has-base-color has-primary-background-color has-text-color has-background has-link-color" style="border-top-left-radius:10px;border-bottom-right-radius:6px;margin-top:0px;padding-top:3px;padding-right:10px;padding-bottom:3px;padding-left:10px;font-size:14px;text-transform:capitalize"><?php echo esc_html__( 'feature', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"product-right-box","style":{"spacing":{"margin":{"top":"0px"},"blockGap":"6px"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
<div class="wp-block-group product-right-box" style="margin-top:0px"><!-- wp:paragraph {"className":"product-right-text","style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"typography":{"fontSize":"14px","textTransform":"capitalize"},"spacing":{"padding":{"top":"3px","bottom":"3px","left":"10px","right":"10px"},"margin":{"top":"0px","bottom":"6px"}},"border":{"radius":{"topRight":"10px","bottomLeft":"6px"}},"color":{"background":"#ff2929"}},"textColor":"base"} -->
<p class="product-right-text has-base-color has-text-color has-background has-link-color" style="border-top-right-radius:10px;border-bottom-left-radius:6px;background-color:#ff2929;margin-top:0px;margin-bottom:6px;padding-top:3px;padding-right:10px;padding-bottom:3px;padding-left:10px;font-size:14px;text-transform:capitalize"><?php echo esc_html__( 'new', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:image {"id":169,"width":"auto","height":"16px","sizeSlug":"full","linkDestination":"none","className":"product-wishlist-btn"} -->
<figure class="wp-block-image size-full is-resized product-wishlist-btn"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/heart.png" alt="" class="wp-image-169" style="width:auto;height:16px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"id":170,"width":"auto","height":"16px","sizeSlug":"full","linkDestination":"none","className":"product-cart-btn"} -->
<figure class="wp-block-image size-full is-resized product-cart-btn"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/cart.png" alt="" class="wp-image-170" style="width:auto;height:16px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"product-content","layout":{"type":"default"}} -->
<div class="wp-block-group product-content"><!-- wp:heading {"level":6,"className":"product-card-title","style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"500","textTransform":"capitalize"}}} -->
<h6 class="wp-block-heading product-card-title" style="font-size:18px;font-style:normal;font-weight:500;text-transform:capitalize"><?php echo esc_html__( 'product name here', 'salecraft-ecommerce' ); ?></h6>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"product-card-desc","style":{"elements":{"link":{"color":{"text":"var:preset|color|contrast"}}},"typography":{"fontSize":"13px"},"spacing":{"margin":{"top":"5px"}}},"textColor":"contrast"} -->
<p class="product-card-desc has-contrast-color has-text-color has-link-color" style="margin-top:5px;font-size:13px"><?php echo esc_html__( 'Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry.', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"product-btm-box","style":{"spacing":{"margin":{"top":"5px"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group product-btm-box" style="margin-top:5px"><!-- wp:group {"className":"product-price-box","style":{"spacing":{"blockGap":"8px"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
<div class="wp-block-group product-price-box"><!-- wp:paragraph {"className":"product-sale","style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"600"}}} -->
<p class="product-sale" style="font-size:16px;font-style:normal;font-weight:600"><?php echo esc_html__( '$49.00', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"product-reg","style":{"typography":{"fontSize":"11px","textDecoration":"line-through","fontStyle":"normal","fontWeight":"600"}}} -->
<p class="product-reg" style="font-size:11px;font-style:normal;font-weight:600;text-decoration:line-through"><?php echo esc_html__( '$59.00', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:image {"id":150,"width":"auto","height":"16px","sizeSlug":"full","linkDestination":"none","className":"product-card-rating"} -->
<figure class="wp-block-image size-full is-resized product-card-rating"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/rating.png" alt="" class="wp-image-150" style="width:auto;height:16px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"product-cards wow zoomIn","style":{"border":{"radius":"10px"},"spacing":{"padding":{"top":"12px","bottom":"12px","left":"12px","right":"12px"}}},"backgroundColor":"section-background"} -->
<div class="wp-block-column product-cards wow zoomIn has-section-background-background-color has-background" style="border-radius:10px;padding-top:12px;padding-right:12px;padding-bottom:12px;padding-left:12px"><!-- wp:group {"className":"product-img-box","style":{"border":{"radius":"10px"},"spacing":{"padding":{"top":"20px","bottom":"20px","left":"20px","right":"20px"}}},"backgroundColor":"base","layout":{"type":"default"}} -->
<div class="wp-block-group product-img-box has-base-background-color has-background" style="border-radius:10px;padding-top:20px;padding-right:20px;padding-bottom:20px;padding-left:20px"><!-- wp:image {"id":184,"width":"auto","height":"150px","sizeSlug":"full","linkDestination":"none","align":"center","className":"product-img"} -->
<figure class="wp-block-image aligncenter size-full is-resized product-img"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/product4.png" alt="" class="wp-image-184" style="width:auto;height:150px"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"className":"product-left-text","style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"typography":{"fontSize":"14px","textTransform":"capitalize"},"spacing":{"padding":{"top":"3px","bottom":"3px","left":"10px","right":"10px"},"margin":{"top":"0px"}},"border":{"radius":{"topLeft":"10px","bottomRight":"6px"}}},"backgroundColor":"primary","textColor":"base"} -->
<p class="product-left-text has-base-color has-primary-background-color has-text-color has-background has-link-color" style="border-top-left-radius:10px;border-bottom-right-radius:6px;margin-top:0px;padding-top:3px;padding-right:10px;padding-bottom:3px;padding-left:10px;font-size:14px;text-transform:capitalize"><?php echo esc_html__( 'feature', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"product-right-box","style":{"spacing":{"margin":{"top":"0px"},"blockGap":"6px"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
<div class="wp-block-group product-right-box" style="margin-top:0px"><!-- wp:paragraph {"className":"product-right-text","style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"typography":{"fontSize":"14px","textTransform":"capitalize"},"spacing":{"padding":{"top":"3px","bottom":"3px","left":"10px","right":"10px"},"margin":{"top":"0px","bottom":"6px"}},"border":{"radius":{"topRight":"10px","bottomLeft":"6px"}},"color":{"background":"#ff2929"}},"textColor":"base"} -->
<p class="product-right-text has-base-color has-text-color has-background has-link-color" style="border-top-right-radius:10px;border-bottom-left-radius:6px;background-color:#ff2929;margin-top:0px;margin-bottom:6px;padding-top:3px;padding-right:10px;padding-bottom:3px;padding-left:10px;font-size:14px;text-transform:capitalize"><?php echo esc_html__( 'new', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:image {"id":169,"width":"auto","height":"16px","sizeSlug":"full","linkDestination":"none","className":"product-wishlist-btn"} -->
<figure class="wp-block-image size-full is-resized product-wishlist-btn"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/heart.png" alt="" class="wp-image-169" style="width:auto;height:16px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"id":170,"width":"auto","height":"16px","sizeSlug":"full","linkDestination":"none","className":"product-cart-btn"} -->
<figure class="wp-block-image size-full is-resized product-cart-btn"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/cart.png" alt="" class="wp-image-170" style="width:auto;height:16px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"product-content","layout":{"type":"default"}} -->
<div class="wp-block-group product-content"><!-- wp:heading {"level":6,"className":"product-card-title","style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"500","textTransform":"capitalize"}}} -->
<h6 class="wp-block-heading product-card-title" style="font-size:18px;font-style:normal;font-weight:500;text-transform:capitalize"><?php echo esc_html__( 'product name here', 'salecraft-ecommerce' ); ?></h6>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"product-card-desc","style":{"elements":{"link":{"color":{"text":"var:preset|color|contrast"}}},"typography":{"fontSize":"13px"},"spacing":{"margin":{"top":"5px"}}},"textColor":"contrast"} -->
<p class="product-card-desc has-contrast-color has-text-color has-link-color" style="margin-top:5px;font-size:13px"><?php echo esc_html__( 'Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry.', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"product-btm-box","style":{"spacing":{"margin":{"top":"5px"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group product-btm-box" style="margin-top:5px"><!-- wp:group {"className":"product-price-box","style":{"spacing":{"blockGap":"8px"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
<div class="wp-block-group product-price-box"><!-- wp:paragraph {"className":"product-sale","style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"600"}}} -->
<p class="product-sale" style="font-size:16px;font-style:normal;font-weight:600"><?php echo esc_html__( '$49.00', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"product-reg","style":{"typography":{"fontSize":"11px","textDecoration":"line-through","fontStyle":"normal","fontWeight":"600"}}} -->
<p class="product-reg" style="font-size:11px;font-style:normal;font-weight:600;text-decoration:line-through"><?php echo esc_html__( '$59.00', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:image {"id":150,"width":"auto","height":"16px","sizeSlug":"full","linkDestination":"none","className":"product-card-rating"} -->
<figure class="wp-block-image size-full is-resized product-card-rating"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/rating.png" alt="" class="wp-image-150" style="width:auto;height:16px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"product-cards wow zoomIn","style":{"border":{"radius":"10px"},"spacing":{"padding":{"top":"12px","bottom":"12px","left":"12px","right":"12px"}}},"backgroundColor":"section-background"} -->
<div class="wp-block-column product-cards wow zoomIn has-section-background-background-color has-background" style="border-radius:10px;padding-top:12px;padding-right:12px;padding-bottom:12px;padding-left:12px"><!-- wp:group {"className":"product-img-box","style":{"border":{"radius":"10px"},"spacing":{"padding":{"top":"20px","bottom":"20px","left":"20px","right":"20px"}}},"backgroundColor":"base","layout":{"type":"default"}} -->
<div class="wp-block-group product-img-box has-base-background-color has-background" style="border-radius:10px;padding-top:20px;padding-right:20px;padding-bottom:20px;padding-left:20px"><!-- wp:image {"id":185,"width":"auto","height":"150px","sizeSlug":"full","linkDestination":"none","align":"center","className":"product-img"} -->
<figure class="wp-block-image aligncenter size-full is-resized product-img"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/product5.png" alt="" class="wp-image-185" style="width:auto;height:150px"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"className":"product-left-text","style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"typography":{"fontSize":"14px","textTransform":"capitalize"},"spacing":{"padding":{"top":"3px","bottom":"3px","left":"10px","right":"10px"},"margin":{"top":"0px"}},"border":{"radius":{"topLeft":"10px","bottomRight":"6px"}}},"backgroundColor":"primary","textColor":"base"} -->
<p class="product-left-text has-base-color has-primary-background-color has-text-color has-background has-link-color" style="border-top-left-radius:10px;border-bottom-right-radius:6px;margin-top:0px;padding-top:3px;padding-right:10px;padding-bottom:3px;padding-left:10px;font-size:14px;text-transform:capitalize"><?php echo esc_html__( 'feature', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"product-right-box","style":{"spacing":{"margin":{"top":"0px"},"blockGap":"6px"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
<div class="wp-block-group product-right-box" style="margin-top:0px"><!-- wp:paragraph {"className":"product-right-text","style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"typography":{"fontSize":"14px","textTransform":"capitalize"},"spacing":{"padding":{"top":"3px","bottom":"3px","left":"10px","right":"10px"},"margin":{"top":"0px","bottom":"6px"}},"border":{"radius":{"topRight":"10px","bottomLeft":"6px"}},"color":{"background":"#ff2929"}},"textColor":"base"} -->
<p class="product-right-text has-base-color has-text-color has-background has-link-color" style="border-top-right-radius:10px;border-bottom-left-radius:6px;background-color:#ff2929;margin-top:0px;margin-bottom:6px;padding-top:3px;padding-right:10px;padding-bottom:3px;padding-left:10px;font-size:14px;text-transform:capitalize"><?php echo esc_html__( 'new', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:image {"id":169,"width":"auto","height":"16px","sizeSlug":"full","linkDestination":"none","className":"product-wishlist-btn"} -->
<figure class="wp-block-image size-full is-resized product-wishlist-btn"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/heart.png" alt="" class="wp-image-169" style="width:auto;height:16px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"id":170,"width":"auto","height":"16px","sizeSlug":"full","linkDestination":"none","className":"product-cart-btn"} -->
<figure class="wp-block-image size-full is-resized product-cart-btn"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/cart.png" alt="" class="wp-image-170" style="width:auto;height:16px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"product-content","layout":{"type":"default"}} -->
<div class="wp-block-group product-content"><!-- wp:heading {"level":6,"className":"product-card-title","style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"500","textTransform":"capitalize"}}} -->
<h6 class="wp-block-heading product-card-title" style="font-size:18px;font-style:normal;font-weight:500;text-transform:capitalize"><?php echo esc_html__( 'product name here', 'salecraft-ecommerce' ); ?></h6>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"product-card-desc","style":{"elements":{"link":{"color":{"text":"var:preset|color|contrast"}}},"typography":{"fontSize":"13px"},"spacing":{"margin":{"top":"5px"}}},"textColor":"contrast"} -->
<p class="product-card-desc has-contrast-color has-text-color has-link-color" style="margin-top:5px;font-size:13px"><?php echo esc_html__( 'Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry.', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"product-btm-box","style":{"spacing":{"margin":{"top":"5px"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group product-btm-box" style="margin-top:5px"><!-- wp:group {"className":"product-price-box","style":{"spacing":{"blockGap":"8px"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
<div class="wp-block-group product-price-box"><!-- wp:paragraph {"className":"product-sale","style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"600"}}} -->
<p class="product-sale" style="font-size:16px;font-style:normal;font-weight:600"><?php echo esc_html__( '$49.00', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"product-reg","style":{"typography":{"fontSize":"11px","textDecoration":"line-through","fontStyle":"normal","fontWeight":"600"}}} -->
<p class="product-reg" style="font-size:11px;font-style:normal;font-weight:600;text-decoration:line-through"><?php echo esc_html__( '$59.00', 'salecraft-ecommerce' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:image {"id":150,"width":"auto","height":"16px","sizeSlug":"full","linkDestination":"none","className":"product-card-rating"} -->
<figure class="wp-block-image size-full is-resized product-card-rating"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/rating.png" alt="" class="wp-image-150" style="width:auto;height:16px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:spacer {"height":"35px"} -->
<div style="height:35px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<?php } ?>