<?php
/**
 * Home page Panel Settings
 *
 * @package Buzz_Ecommerce
 */

function buzz_ecommerce_customize_register_homepage( $wp_customize ) {
    
    $wp_customize->add_panel( 'buzz_ecommerce_homepage_setting', array(
        'title'      => __( 'Front Page Settings', 'buzz-ecommerce' ),
        'priority'   => 35
    ) );
        
}
add_action( 'customize_register', 'buzz_ecommerce_customize_register_homepage' );
