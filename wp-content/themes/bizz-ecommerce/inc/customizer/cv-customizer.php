<?php
/**
 * Bizz Ecommerce Theme Customizer
 *
 * @subpackage bizz-ecommerce
 * @since 1.0 
 */
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bizz_ecommerce_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	$wp_customize->get_section( 'title_tagline' )->panel        = 'bizz_ecommerce_general_panel';
    $wp_customize->get_section( 'title_tagline' )->priority     = '5';
    $wp_customize->get_section( 'colors' )->panel               = 'bizz_ecommerce_general_panel';
    $wp_customize->get_section( 'colors' )->priority            = '10';
    $wp_customize->get_section( 'static_front_page' )->panel    = 'bizz_ecommerce_general_panel';
    $wp_customize->get_section( 'static_front_page' )->priority = '20';


	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'bizz_ecommerce_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'bizz_ecommerce_customize_partial_blogdescription',
		) );
	}



}
add_action( 'customize_register', 'bizz_ecommerce_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */

function bizz_ecommerce_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function bizz_ecommerce_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
/*--------------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue required scripts/styles for customizer panel
 *
 * @since 1.0.0
 */

 /**
  * Add Kirki customizer library file
  */
 require get_template_directory() . '/inc/kirki/kirki.php';

 /**
  * Configuration for Kirki Framework
  */
 function bizz_ecommerce_kirki_configuration() {
 	return array(
 		'url_path' => get_template_directory_uri() . '/inc/kirki/',
 	);
 }

 add_filter( 'kirki/config', 'bizz_ecommerce_kirki_configuration' );


/**
 * Bizz Ecommerce Kirki Config
 */
Kirki::add_config( 'bizz_ecommerce_config', array(
	'capability'  => 'edit_theme_options',
	'option_type' => 'theme_mod',
) );

/**
 * Add Kirki required file for custom fields
 */
require get_template_directory() . '/inc/customizer/cv-customizer-panels.php';
require get_template_directory() . '/inc/customizer/cv-customizer-sections.php';
require get_template_directory() . '/inc/customizer/cv-customizer-general-panel-options.php';
require get_template_directory() . '/inc/customizer/cv-customizer-frontpage-panel-options.php';