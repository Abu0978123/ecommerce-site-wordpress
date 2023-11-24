<?php
/**
 * Buzz EcommerceTheme Customizer
 *
 * @package Buzz_Ecommerce
 */

 //Call All Panel Section
$buzz_ecommerce_panels   = array( 'header','general', 'home' );
$buzz_ecommerce_sections = array( 'woocommerce' );
$buzz_ecommerce_sub_sections = array(
    'home'       => buzz_ecommerce_customizer_section_register(),
    'general'    => array( 'basic','post-layout' ),
);

//woocommerce section
if( buzz_ecommerce_is_woocommerce_activated() ){
    foreach( $buzz_ecommerce_sections as $section ){
        require trailingslashit( get_template_directory() ) . 'spiderbuzz/customizer/sections/' . $section . '.php';
    }
}

foreach( $buzz_ecommerce_panels as $panel ){
   require trailingslashit( get_template_directory() ) . 'spiderbuzz/customizer/panels/' . $panel . '.php';
}

foreach( $buzz_ecommerce_sub_sections as $k => $v ){
    foreach( $v as $w ){        
        require trailingslashit( get_template_directory() ) . 'spiderbuzz/customizer/panels/' . $k . '/' . $w . '.php';
    }
}

/**
 * Basic Js File enqueue Section
 */
function buzz_ecommerce_customize_preview_js() {
	wp_enqueue_style( 'buzz-ecommerce-customizer', get_template_directory_uri() . '/spiderbuzz/customizer/css/customizer.css', array(), BUZZ_ECOMMERCE_THEME_VERSION );
    wp_enqueue_script( 'buzz_ecommerce_customizer', get_template_directory_uri() . '/spiderbuzz/customizer/js/customizer.js', array( 'jquery', 'customize-preview', 'customize-selective-refresh' ), BUZZ_ECOMMERCE_THEME_VERSION, true );
}
add_action( 'customize_preview_init', 'buzz_ecommerce_customize_preview_js' );


function buzz_ecommerce_customizer_scripts() {
    wp_enqueue_style( 'buzz-ecommerce-customize',get_template_directory_uri().'/spiderbuzz/customizer/css/customize.css', BUZZ_ECOMMERCE_THEME_VERSION, 'screen' );
    wp_enqueue_script( 'buzz-ecommerce-customize', get_template_directory_uri() . '/spiderbuzz/customizer/js/customize-homepage.js', array( 'jquery' ), BUZZ_ECOMMERCE_THEME_VERSION, true );
}
add_action( 'customize_controls_enqueue_scripts', 'buzz_ecommerce_customizer_scripts' );



/**
 * Sanitize callback for checkbox
*/
require trailingslashit( get_template_directory() ) . 'spiderbuzz/customizer/sanitization-functions.php';
require trailingslashit( get_template_directory() ) . 'spiderbuzz/customizer/customizer-callback.php';


/*****************************************************
 * Homepage Settings 
****************************************************/
function buzz_ecommerce_customizer_section_register(){

	//woocommerce class
	if( buzz_ecommerce_is_woocommerce_activated() ){
		$buzz_ecommerce_woocommerce_section_array = array('slider','product-categories','products-tabs','servicebox','banner','onsell-products','sort');
	}else{
		$buzz_ecommerce_woocommerce_section_array = array('slider');
	}

	//Retrurn Array File
	return $buzz_ecommerce_woocommerce_section_array ;
}