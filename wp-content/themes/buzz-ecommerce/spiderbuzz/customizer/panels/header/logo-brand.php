<?php
/**
 * Top Header Settings
 *
 * @package Buzz_Ecommerce
 */
function buzz_ecommerce_customize_register_logo_and_site_identites( $wp_customize ) {
	
    
    /** Enable/Disable Top Header Settings */
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    /** Buzz Ecommerce Logo Customizer */
    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial( 'blogname', array(
            'selector'        => '.site-title a',
            'render_callback' => 'buzz_ecommerce_customize_partial_blogname',
        ) );
        $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
            'selector'        => '.site-description',
            'render_callback' => 'buzz_ecommerce_customize_partial_blogdescription',
        ) );
    }

    //Buzz Ecommerce Logo Setting
    $wp_customize->get_section('title_tagline')->panel = 'header_setting';
    $wp_customize->get_section('title_tagline' )->priority = 1;
    

}
add_action( 'customize_register', 'buzz_ecommerce_customize_register_logo_and_site_identites' );