<?php
/**
 * Slider Settings
 *
 * @package Buzz_Ecommerce
 */


function buzz_ecommerce_customize_register_service_box( $wp_customize ) {
    
    //Slider Section 
    $wp_customize->add_section( 'frontpage_service_box_section', array(
        'title'         => esc_html__( 'Service Box', 'buzz-ecommerce' ),
        'description'   => esc_html__('Service Box Section sets the service title, short description and fontawesome icon. Drag "Service Items" to sort their positions.','buzz-ecommerce'),
        'priority'      => 2,
        'panel'         =>'buzz_ecommerce_homepage_setting'
    ) );

    /*****************************************************
     * Custom Add Slider 
     *****************************************************/
    $wp_customize->add_setting( 
        new Buzz_Ecommerce_Repeater_Setting( 
            $wp_customize, 
            'homepage_service_box_section', 
            array(
                'default' => array(
                    array(
                        'service_icons'     => esc_html__('fa fa-ambulance','buzz-ecommerce'),
                        'service_title'     => esc_html__('FREE DELIVERY','buzz-ecommerce'),
                        'service_short_desc'=> esc_html__('From $59.89','buzz-ecommerce'),
                    ),
                ),
                'sanitize_callback' => array( 'Buzz_Ecommerce_Repeater_Setting', 'sanitize_repeater_setting' ),
                'transport' => 'postMessage',
            ) 
        ) 
    );
    
    $wp_customize->add_control(
		new Buzz_Ecommerce_Repeater_Control(
			$wp_customize,
			'homepage_service_box_section',
			array(
				'section' => 'frontpage_service_box_section',				
				'label'	  => esc_html__( 'Service Boxes', 'buzz-ecommerce' ),
				'fields'  => array(
                    'service_icons' => array(
                        'type'        => 'font',
                        'label'       => esc_html__( 'Box Icon', 'buzz-ecommerce' ),
                        'description' => esc_html__( 'Click box below and select the required fontawesome icon or input fontawesome class ( eg: fa fa-usd )', 'buzz-ecommerce' ),
                    ),
                    'service_title' => array(
                        'type'        => 'text',
                        'label'       => esc_html__( 'Box Title', 'buzz-ecommerce' ),
                        'description' => esc_html__( 'Type box title. Eg: BIG SAVING', 'buzz-ecommerce' ),
                    ),
                    'service_short_desc' => array(
                        'type'        => 'text',
                        'label'       => esc_html__( 'Box Short Description', 'buzz-ecommerce' ),
                        'description' => esc_html__( 'Type box short description. Eg: Online 24 hours', 'buzz-ecommerce' ),
                    )
                ),
                'row_label' => array(
                    'type' => 'field',
                    'value' => esc_html__( 'Service Item', 'buzz-ecommerce' ),
                    'field' => 'link'
                )                        
			)
		)
	);
 
	$wp_customize->selective_refresh->add_partial( 'homepage_service_box_section', array(
        'selector' 			=> '#frontpage_service_box_section',
        'container_inclusive' => true,
        'render_callback' => function () {
            return do_action( 'service-box' );
        }
    ));

}
add_action( 'customize_register', 'buzz_ecommerce_customize_register_service_box' );