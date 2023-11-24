<?php
/**
 * Banner Sections
 *
 * @package Buzz_Ecommerce
 */


function buzz_ecommerce_customize_register_banner( $wp_customize ) {
    
    //Slider Section 
    $wp_customize->add_section( 'buzz_ecommerce_banner_images', array(
        'title'    => esc_html__( 'Banner', 'buzz-ecommerce' ),
        'priority' => 6,
        'panel'    =>'buzz_ecommerce_homepage_setting'
    ) );


    /*****************************************************
     * Custom Add Slider 
     *****************************************************/
    $wp_customize->add_setting( 
        new Buzz_Ecommerce_Repeater_Setting( 
            $wp_customize, 
            'buzz_ecommerce_homepage_banner', 
            array(
                'default' => array(
                    array(
                        'banner_image'     => esc_url(get_template_directory_uri().'/assets/images/mac-add.jpg'),
                        'banner_links'     => esc_url('#')                      
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
			'buzz_ecommerce_homepage_banner',
			array(
				'section' => 'buzz_ecommerce_banner_images',				
				'label'	  => esc_html__( 'Banner Images', 'buzz-ecommerce' ),
				'fields'  => array(
                    'banner_image' => array(
                        'type'        => 'image',
                        'label'       => esc_html__( 'Banner Image', 'buzz-ecommerce' ),
                        'description' => esc_html__( 'Select Banner Image.', 'buzz-ecommerce' ),
                    ),
                    'banner_links' => array(
                        'type'        => 'text',
                        'label'       => esc_html__( 'Banner Link', 'buzz-ecommerce' ),
                        'description' => esc_html__( 'Eg: https://www.spiderbuzz.com/banner-links.', 'buzz-ecommerce' ),
                    )
                ),
                'row_label' => array(
                    'type' => 'field',
                    'value' => esc_html__( 'Banner Image', 'buzz-ecommerce' ),
                    'field' => 'link'
                )                        
			)
		)
    );
    
    $wp_customize->selective_refresh->add_partial( 'buzz_ecommerce_homepage_banner', array (
        'selector' => '#buzz_ecommerce_banner_images',
        'container_inclusive' => true,
        'render_callback' => function () {
            return do_action( 'homepage_brand_logo' );
        }
    ));

}
add_action( 'customize_register', 'buzz_ecommerce_customize_register_banner' );