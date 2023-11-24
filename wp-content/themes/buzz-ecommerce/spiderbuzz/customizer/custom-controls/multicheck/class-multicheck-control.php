<?php
/**
 * Customizer Control: multicheck.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Buzz_Ecommerce_MultiCheck_Control' ) ) {

	/**
	 * Adds a multicheck control.
	 */
	class Buzz_Ecommerce_MultiCheck_Control extends Wp_Customize_Control {

		public $type = 'spiderbuzz-multicheck';
        
        public $tooltip = '';
        
        public function to_json() {
			parent::to_json();
			
            if ( isset( $this->default ) ) {
				$this->json['default'] = $this->default;
			} else {
				$this->json['default'] = $this->setting->default;
			}
			
            $this->json['value']   = $this->value();
            $this->json['choices'] = $this->choices;			
            $this->json['tooltip'] = $this->tooltip;
						
            $this->json['inputAttrs'] = '';
			foreach ( $this->input_attrs as $attr => $value ) {
				$this->json['inputAttrs'] .= $attr . '="' . esc_attr( $value ) . '" ';
			}
		}
        
        public function enqueue() {            
            wp_enqueue_script( 'spiderbuzz-multicheck', get_template_directory_uri() . '/spiderbuzz/customizer/custom-controls/multicheck/multicheck.js', array( 'jquery' ), false, true ); //for slider        
        }
        
		protected function content_template() {
			?>

			<# if ( ! data.choices ) { return; } #>

			<# if ( data.tooltip ) { #>
				<a href="#" class="tooltip hint--left" data-hint="{{ data.tooltip }}"><span class='dashicons dashicons-info'></span></a>
			<# } #>

			<# if ( data.label ) { #>
				<span class="customize-control-title">{{ data.label }}</span>
			<# } #>

			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } #>

			<ul>
				<# for ( key in data.choices ) { #>
					<li>
						<label>
							<input {{{ data.inputAttrs }}} type="checkbox" value="{{ key }}"<# if ( _.contains( data.value, key ) ) { #> checked<# } #> />
							{{ data.choices[ key ] }}
						</label>
					</li>
				<# } #>
			</ul>
			<?php
		}
	}
}
