<?php
/**
 * Home Page Sort Settings
 *
 * @package Buzz Ecommerce
 */
function buzz_ecommerce_homepage_short( $wp_customize ){
    
    /** Homepage Sort Section */   
    $wp_customize->add_section( 'buzz_ecommerce_homepage_short', array(
        'title'    => esc_html__( 'Sort Home Page Sections', 'buzz-ecommerce' ),
        'priority' => 10,
        'panel'    => 'buzz_ecommerce_homepage_setting',
    ) ); 
    
    /** Homepage Sort Settings*/
    $wp_customize->add_setting(
		'buzz_ecommerce_home_page_sort', 
		array(
			'default' => buzz_ecommerce_customizer_section(),
			'sanitize_callback' => 'buzz_ecommerce_sanitize_sortable',						
		)
	);

    /** Homepage Sort Controls */
	$wp_customize->add_control(
		new Buzz_Ecommerce_Drag_Section_Control(
			$wp_customize,
			'buzz_ecommerce_home_page_sort',
			array(
				'section'     => 'buzz_ecommerce_homepage_short',
				'label'       => esc_html__( 'Sort Home Page Sections', 'buzz-ecommerce' ),
				'choices'     => array(
            		'buzz_ecommerce_homepage_service_section'       	=> esc_html__( 	'Service Box Section', 'buzz-ecommerce' ),
					'buzz_ecommerce_homepage_products_category' 		=> esc_html__( 	'Products Category Section', 'buzz-ecommerce' ),
					'buzz_ecommerce_homepage_banner_sections'			=> esc_html__(  'Banner Section','buzz-ecommerce'),
					'buzz_ecommerce_homepage_products_tabs'      		=> esc_html__( 	'Products Tab Section', 'buzz-ecommerce' ),
					'buzz_ecommerce_homepage_products_upsell' 			=> esc_html__( 	'Onsell Products Section', 'buzz-ecommerce' ),
				),
			)
		)
	);
    
}
add_action( 'customize_register', 'buzz_ecommerce_homepage_short' );

/*****************************************************
 * Homepage Settings 
****************************************************/
function buzz_ecommerce_customizer_section(){

	//woocommerce class
	if( buzz_ecommerce_is_woocommerce_activated() ){
		$buzz_ecommerce_woocommerce_section_array = array('buzz_ecommerce_homepage_products_category','buzz_ecommerce_homepage_products_tabs','buzz_ecommerce_homepage_products_upsell');
	}else{
		$buzz_ecommerce_woocommerce_section_array = array();
	}

	//Retrurn Array File
	return $buzz_ecommerce_woocommerce_section_array ;
}