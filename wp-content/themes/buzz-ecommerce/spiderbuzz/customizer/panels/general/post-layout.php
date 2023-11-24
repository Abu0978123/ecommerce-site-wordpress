<?php
/**
 * General Settings Hear
 *
 * @package buzz ecommerce
 */

function buzz_ecommerce_layout_settings( $wp_customize ) {
	
    //Products Category
    $wp_customize->add_section( 'buzz_ecommerce_layout_section', array(
        'title'    => esc_html__( 'Sidebar Layout', 'buzz-ecommerce' ),
        'priority' => 3,
        'panel'    =>'general_setting'
	) );
    
    /******************************************************************************
	 * 					 Sidebar Layout Options
	 ***************************************************************************/
    //Enable  Slider
    $wp_customize->add_setting( 
        'buzz_ecommerce_sidebar_layout_settings', 
        array(
            'sanitize_callback' => 'buzz_ecommerce_sanitize_select',
            'default'           => 'right-sidebar',
        )
    );
    $wp_customize->add_control( 
        'buzz_ecommerce_sidebar_layout_settings', 
        array(
            'label' => esc_html__( 'Sidebar Layout', 'buzz-ecommerce' ),
            'section' => 'buzz_ecommerce_layout_section',
            'type' => 'select',
            'choices' => array(
                            'left-sidebar'      => esc_html__( 'Left Sidebar', 'buzz-ecommerce' ),
                            'right-sidebar'     => esc_html__( 'Right Sidebar', 'buzz-ecommerce' ),
                            'full-width'        => esc_html__( 'No Sidebar', 'buzz-ecommerce' ),
            ),
            'priority'          => 3,
        )
    ); 

	
}
add_action( 'customize_register', 'buzz_ecommerce_layout_settings' );