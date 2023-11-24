<?php
/**
 * General Settings Hear
 *
 * @package Buzz_Ecommerce
 */

function buzz_ecommerce_customize_general_settings( $wp_customize ) {
	
    /**
    * General Settings Panel
    */
    $wp_customize->get_section('header_image')->panel = 'general_setting';
    $wp_customize->get_section('header_image' )->priority = 4;

    $wp_customize->get_section('colors')->panel = 'general_setting';
    $wp_customize->get_section('title_tagline' )->priority = 3;

    $wp_customize->get_section('background_image')->panel = 'general_setting';
    
    $wp_customize->get_setting('header_textcolor' )->default = 'ffffff';

}
add_action( 'customize_register', 'buzz_ecommerce_customize_general_settings' );