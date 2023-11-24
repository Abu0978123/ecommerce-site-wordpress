<?php
if ( ! defined( 'ABSPATH' ) ) exit; 
/**
 * This file stores all functions that return default content.
 *
 * @package  Bizz Ecommerce
 */
/**
 * Class Bizz_Ecommere_Defaults_Models
 *
 * @package  Bizz Ecommerce
 */
class Bizz_Ecommerce_Defaults_Models extends Bizz_Ecommerce_Singleton{
/**
	 * Get default values for features section.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	
	/**
	 * Get default values for features section.

	 * @access public
	 */
	public function get_feature_default() {
		return apply_filters(
			'bizz_ecommerce_highlight_default_content', json_encode(
				array(
					array(
						'icon_value' => 'fa-shopping-bag',
						'title'      => esc_html__( 'Free Shipping Worldwide', 'bizz-ecommerce' ),
						'subtitle'   => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod.', 'bizz-ecommerce' ),
						
					),
					array(
						'icon_value' => 'fa-money',
						'title'      => esc_html__( 'Money Back Guarantee', 'bizz-ecommerce' ),
						'subtitle'   => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod.', 'bizz-ecommerce' ),
						
					),
					array(
						'icon_value' => 'fa-user-plus',
						'title'      => esc_html__( '24/7 Customer Service', 'bizz-ecommerce' ),
						'subtitle'   => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod.', 'bizz-ecommerce' ),
						
					),
				)
			)
		);
	}	
	
}