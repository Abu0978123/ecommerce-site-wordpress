<?php
/**
 * General  Settings
 *
 * @package Buzz_Ecommerce
 */

function buzz_ecommerce_customize_register_general( $wp_customize ) {
    
    $wp_customize->add_panel( 'general_setting', array(
        'title'      => __( 'General Settings', 'buzz-ecommerce' ),
        'priority'   => 35
    ) );
        
}
add_action( 'customize_register', 'buzz_ecommerce_customize_register_general' );
