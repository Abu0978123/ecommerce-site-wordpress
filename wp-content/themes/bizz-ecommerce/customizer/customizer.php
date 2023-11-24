<?php 
/**
 * all customizer setting includeed
 *
 * @param  
 * @return mixed|string
 */
function bizz_ecommerce_front_customize_register( $wp_customize ){

//Registered panel and section
require BIZZ_ECOMMERCE_THEME_DIR . 'customizer/register-panels-and-sections.php';	
require BIZZ_ECOMMERCE_THEME_DIR . 'customizer/section/layout/header/main-header.php';
}

add_action('customize_register','bizz_ecommerce_front_customize_register');
