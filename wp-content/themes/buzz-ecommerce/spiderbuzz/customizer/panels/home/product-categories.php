<?php
/**
 * Products Category Settings
 *
 * @package Buzz_Ecommerce
 */

function buzz_ecommerce_customize_register_product_category_section( $wp_customize ) {
    
    //Products Category
    $wp_customize->add_section( 'products_category_section', array(
        'title'    => esc_html__( 'Product Categories', 'buzz-ecommerce' ),
        'priority' => 3,
        'panel'    =>'buzz_ecommerce_homepage_setting'
	) );
	
    /** Category Section Hear */
    $wp_customize->add_setting(
		'products_categorys', 
		array(
			'default' => buzz_ecommerce_get_multiple_product_categories(),
			'sanitize_callback' => 'buzz_ecommerce_sanitize_multiple_check',
			'transport' => 'postMessage'						
		)
	);

	$wp_customize->add_control(
		new Buzz_Ecommerce_MultiCheck_Control(
			$wp_customize,
			'products_categorys',
			array(
				'section'     => 'products_category_section',
				'label'       => esc_html__( 'Product Categories', 'buzz-ecommerce' ),
                'description' => esc_html__( 'Select from the list of categories.', 'buzz-ecommerce' ),
				'choices'     => buzz_ecommerce_get_products_categories( )
			)
		)
	);

	$wp_customize->selective_refresh->add_partial( 'products_categorys', array(
        'selector' 			=> '#products_category_section',
		'container_inclusive' => true,
		'render_callback' => function () {
			return do_action( 'products-category' );
		}
    ));

}
add_action( 'customize_register', 'buzz_ecommerce_customize_register_product_category_section' );