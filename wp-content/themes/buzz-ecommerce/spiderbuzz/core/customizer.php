<?php
/**
 * Buzz Ecommerce Theme Customizer
 *
 * @package Buzz_Ecommerce
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function buzz_ecommerce_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

}
add_action( 'customize_register', 'buzz_ecommerce_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function buzz_ecommerce_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function buzz_ecommerce_customize_partial_blogdescription() {
	bloginfo( 'description' );
}