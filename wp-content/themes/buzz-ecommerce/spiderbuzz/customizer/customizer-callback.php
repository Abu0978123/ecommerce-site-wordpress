<?php
/** Products Tab Title */
if( ! function_exists( 'buzz_ecommerce_products_tabs_title' ) ) {
    /**
     * Display product tab
    */
    function buzz_ecommerce_products_tabs_title(){
        return get_theme_mod( 'products_tabs_title', esc_html__( 'POPULAR PRODUCTS', 'buzz-ecommerce' ) );
    }
}

/** Slider All Category Section */
if( ! function_exists( 'buzz_ecommerce_slider_category_list_header_text' ) ) {
    /**
     * Display product tab
    */
    function buzz_ecommerce_slider_category_list_header_text(){
        return get_theme_mod( 'buzz_ecommerce_slider_category_list_header_text', esc_html__( 'ALL CATEGORIES', 'buzz-ecommerce' ) );
    }
}


/** Slider All Category Section */
if( ! function_exists( 'slider_button_text_change_callback' ) ) {
    /**
     * Display product tab
    */
    function slider_button_text_change_callback(){
        return get_theme_mod( 'slider_button_text_change', esc_html__( 'Buy Now', 'buzz-ecommerce' ) );
    }
}
