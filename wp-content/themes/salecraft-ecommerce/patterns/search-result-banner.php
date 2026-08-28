<?php
/**
 * Title: Search Result Banner
 * Slug: salecraft-ecommerce/search-result-banner
 * Categories: salecraft-ecommerce
 *
 * @package SaleCraft Ecommerce
 * @since 1.0.0
 */

?>

<!-- wp:cover {"url":"<?php echo esc_url( get_template_directory_uri() );?>/assets/images/image-banner.png","id":8,"dimRatio":70,"overlayColor":"black","isUserOverlayColor":true,"focalPoint":{"x":0.51,"y":0.38},"minHeight":300,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover" style="margin-top:0;margin-bottom:0;min-height:300px"><img class="wp-block-cover__image-background wp-image-8" alt="" src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/image-banner.png" style="object-position:51% 38%" data-object-fit="cover" data-object-position="51% 38%"/><span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim-70 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:query-title {"type":"search","textAlign":"center","showPrefix":false,"align":"wide"} /--></div></div>
<!-- /wp:cover -->