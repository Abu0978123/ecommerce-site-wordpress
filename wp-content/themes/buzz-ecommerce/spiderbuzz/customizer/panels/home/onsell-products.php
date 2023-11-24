<?php
/**
 * Onsell Products  Settings
 *
 * @package Buzz_Ecommerce
 */
function buzz_ecommerce_customize_register_onsell_products( $wp_customize ) {
   
    //Products Category
    $wp_customize->add_section( 'onsell_products_section', array(
        'title'    => esc_html__( 'OnSale Products', 'buzz-ecommerce' ),
        'priority' => 5,
        'panel'    =>'buzz_ecommerce_homepage_setting'
	));

	//Products Tab Title
    $wp_customize->add_setting(
        'onsell_products_title',
        array(
            'default'           => esc_html__( 'ONSALE PRODUCTS', 'buzz-ecommerce' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'			=>	'postMessage',
        )
    );
    
    $wp_customize->add_control(
		'onsell_products_title',
		array(
			'section'	  => 'onsell_products_section',
			'label'		  => esc_html__( 'Title', 'buzz-ecommerce' ),
            'type'        => 'text'
		)		
	);
	
	$wp_customize->add_setting(
        'products_onsell_number_of_products',
        array(
            'default'           => 8,
            'sanitize_callback' => 'absint',
            'transport' => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
		'products_onsell_number_of_products',
		array(
			'section'	  => 'onsell_products_section',
			'label'		  => esc_html__( 'Number of Products', 'buzz-ecommerce' ),
            'type'        => 'number'
		)		
    );

    $wp_customize->selective_refresh->add_partial( 'buzz_ecommerce_onsale_products', array (
        'settings' => array( 'products_onsell_number_of_products' ),
        'selector' => '#products_upsell_options',
        'container_inclusive' => true,
        'render_callback' => function () {
            return do_action( 'products_upsell' );
        }
    ));
    
}
add_action( 'customize_register', 'buzz_ecommerce_customize_register_onsell_products' );