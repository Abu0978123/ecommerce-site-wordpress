<?php
/**
 * Header  Settings
 *
 * @package Buzz_Ecommerce
 */

function buzz_ecommerce_customize_register_header( $wp_customize ) {
    
    $wp_customize->add_panel( 'header_setting', array(
        'title'      => __( 'Logo & Header Settings', 'buzz-ecommerce' ),
        'priority'   => 1
    ) );
        
}
add_action( 'customize_register', 'buzz_ecommerce_customize_register_header' );
