<?php
/**
 * Customizer
 * 
 * @package WordPress
 * @subpackage SaleCraft Ecommerce
 * @since SaleCraft Ecommerce 1.7
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function salecraft_ecommerce_customize_register( $wp_customize ) {
    // Check for existence of WP_Customize_Manager before proceeding
	if ( ! class_exists( 'WP_Customize_Manager' ) ) {
        return;
    }
    
	$wp_customize->add_section( new SaleCraft_Ecommerce_Customizer_Pro_Button( $wp_customize, 'upsell_premium_section', array(
		'title'       => __( 'SaleCraft Ecommerce Pro', 'salecraft-ecommerce' ),
		'button_text' => __( 'Buy Pro Theme', 'salecraft-ecommerce' ),
		'url'         => 'https://www.themebee.net/products/ecommerce-wordpress-theme/',
		'priority'    => 0,
	)));

}
add_action( 'customize_register', 'salecraft_ecommerce_customize_register' );

if ( class_exists( 'WP_Customize_Section' ) ) {
	class SaleCraft_Ecommerce_Customizer_Pro_Button extends WP_Customize_Section {
		public $type = 'salecraft-ecommerce-buynow';
		public $button_text = '';
		public $url = '';

		protected function render() {
			?>
			<li id="accordion-section-<?php echo esc_attr( $this->id ); ?>" class="salecraft_ecommerce_customizer_pro_button accordion-section control-section control-section-<?php echo esc_attr( $this->id ); ?> cannot-expand">
				<h3 class="accordion-section-title premium-details">
					<?php echo esc_html( $this->title ); ?>
					<a href="<?php echo esc_url( $this->url ); ?>" class="button button-secondary alignright" target="_blank" style="margin-top: -4px;"><?php echo esc_html( $this->button_text ); ?></a>
				</h3>
			</li>
			<?php
		}
	}
}

/**
 * Enqueue script for custom customize control.
 */
function salecraft_ecommerce_custom_control_scripts() {
	wp_enqueue_script( 'salecraft-ecommerce-custom-controls-js', get_template_directory_uri() . '/assets/js/custom-controls.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-sortable' ), '1.0', true );

    wp_enqueue_style( 'salecraft-ecommerce-customizer-css', get_template_directory_uri() . '/assets/css/customizer.css', array(), '1.0' );
}
add_action( 'customize_controls_enqueue_scripts', 'salecraft_ecommerce_custom_control_scripts' );
