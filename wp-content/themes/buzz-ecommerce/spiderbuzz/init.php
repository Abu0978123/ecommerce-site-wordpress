<?php
/**
 * The spiderbuzz enqueu file for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package Buzz Ecommerce
 */

 if( !function_exists('buzz_ecommerce_file_directory') ){

    function buzz_ecommerce_file_directory( $file_path ){
        if( file_exists( trailingslashit( get_stylesheet_directory() ) . $file_path) ) {
            return trailingslashit( get_stylesheet_directory() ) . $file_path;
        }
        else{
            return trailingslashit( get_template_directory() ) . $file_path;
        }//end condtion
    }
}

/**============================================================================
 * =                        Init Buzz Ecommerce 
 * =============================================================================*/
require buzz_ecommerce_file_directory('spiderbuzz/mobile-menu/init.php');


/*=========================================================================
=                         Core File Require
==========================================================================*/
require buzz_ecommerce_file_directory('spiderbuzz/core/custom-header.php');
require buzz_ecommerce_file_directory('spiderbuzz/core/template-tags.php');
require buzz_ecommerce_file_directory('spiderbuzz/core/template-functions.php');
require buzz_ecommerce_file_directory('spiderbuzz/core/customizer.php');
require buzz_ecommerce_file_directory('spiderbuzz/core/class-tgm-plugin-activation.php');

 

/*=========================================================================
=                           Load WooCommerce compatibility file.
===========================================================================*/ 
if ( class_exists( 'WooCommerce' ) ) {
    require buzz_ecommerce_file_directory('spiderbuzz/hooks/woocommerce.php');
}

require buzz_ecommerce_file_directory('spiderbuzz/hooks/buzz-ecommerce-functions.php');



 /**============================================================================
 * =                             Settings 
 * =============================================================================*/
require buzz_ecommerce_file_directory('spiderbuzz/settings/plugin-required-list.php');

/**============================================================================
 * =                        define theme version
 * =============================================================================*/
if ( ! defined( 'BUZZ_ECOMMERCE_THEME_VERSION' ) ) {
	$theme_data = wp_get_theme();	
	define ( 'BUZZ_ECOMMERCE_THEME_VERSION', $theme_data->get( 'Version' ) );
}

/**============================================================================
 * =                      Homepage Section 
 * =============================================================================*/
require buzz_ecommerce_file_directory('spiderbuzz/templates/home/products-tab/ajax-products-tab.php');
require buzz_ecommerce_file_directory('spiderbuzz/templates/home/products-tab.php');

/**============================================================================
 * =                      Products section 
 * =============================================================================*/
require buzz_ecommerce_file_directory('spiderbuzz/templates/home/slider-section.php');
require buzz_ecommerce_file_directory('spiderbuzz/templates/home/service-box.php');
require buzz_ecommerce_file_directory('spiderbuzz/templates/home/banner.php');
require buzz_ecommerce_file_directory('spiderbuzz/templates/home/product-categories.php');
require buzz_ecommerce_file_directory('spiderbuzz/templates/home/onsell-products.php');

/**============================================================================
 * =                      Demo Import
 * =============================================================================*/
require buzz_ecommerce_file_directory('spiderbuzz/demo-import/demo-import.php');

/**============================================================================
 * =                      Admin Section
 * =============================================================================*/
require buzz_ecommerce_file_directory('spiderbuzz/admin/class-buzz-ecommerce-admin.php');

