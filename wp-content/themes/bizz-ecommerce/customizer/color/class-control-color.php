<?php
/**
 * Customizer Control: oceanwp-color.
 *
 * @package wptexture
 * @subpackage  Bizz Ecommerce
 * @see   		https://github.com/BraadMartin/components
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       1.0
 */
// Exit if accessed directly.
if ( ! class_exists( 'WP_Customize_Control' ) ){
	return;
}
/**
 * Color control
 */
class Bizz_Ecommerce_Customizer_Color_Control extends WP_Customize_Control{
	public $type = 'alpha-color';
	/**
	 * Add support for palettes to be passed in.
	 *
	 * Supported palette values are true, false, or an array of RGBa and Hex colors.
	 */
	public $palette;
	/**
	 * Add support for showing the opacity value on the slider handle.
	 */
	public $show_opacity;
	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @access public
	 */
	public function enqueue(){
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'bizz-ecommerce-color', get_template_directory_uri() . '/customizer/color/color.js', array( 'jquery', 'customize-base', 'wp-color-picker' ), false, true );
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( 'bizz-ecommerce-color', get_template_directory_uri() . '/customizer/color/color.css', array( 'wp-color-picker' ), '1.0.0' );
		wp_localize_script( 'bizz-ecommerce-color', 'bizz_ecommerce_color_wpLocalize', array( 'colorPalettes' => bizz_ecommerce_default_color_palettes() ) );
	}
	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {
		parent::to_json();

		$this->json['default'] = $this->setting->default;
		$this->json['show_opacity'] = ( false === $this->show_opacity || 'false' === $this->show_opacity ) ? 'false' : 'true';
		$this->json['value']       = $this->value();
		$this->json['link']        = $this->get_link();
		$this->json['id']          = $this->id;

	}

	/**
	 * An Underscore (JS) template for this control's content (but not its container).
	 *
	 * Class variables for this control class are available in the `data` JS object;
	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
	 *
	 * @see WP_Customize_Control::print_template()
	 *
	 * @access protected
	 */
	protected function content_template() { ?>

		<label>
			<# if ( data.label ) { #>
				<span class="customize-control-title">{{{ data.label }}}</span>
			<# } #>
			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } #>
			<div>
				<input class="alpha-color-control" type="text"  value="{{ data.value }}" data-show-opacity="{{ data.show_opacity }}" data-default-color="{{ data.default }}" {{{ data.link }}} />
			</div>
		</label>
		<?php
	}
}