<?php
/**
 * Front Page Template
 * 
 * @link https://codex.wordpress.org/Template_Hierarchy
 * Template Name: Front Page Template
 * @package Buzz_Ecommerce
 */

get_header(); 


//Fontpage settings
if ( 'posts' == get_option( 'show_on_front' ) ) { //Show Static Blog Page
    include( get_home_template() );
}else{ 
    //Default slider section
    do_action('slider-section');
    //Default slider section
    if(buzz_ecommerce_is_woocommerce_activated()){
        foreach( get_theme_mod('buzz_ecommerce_home_page_sort',buzz_ecommerce_customizer_section()) as $homepage_item ){
            $homepage_function = $homepage_item;
            $homepage_function();
        }
    }
}

get_footer();