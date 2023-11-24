<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package bizz-ecommerce
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function bizz_ecommerce_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'main-sidebar' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Theme Layout (wide|box)
	$classes[] = 'has-' . get_theme_mod('bizz_ecommerce_theme_layout_section') . '-layout';

	if(class_exists( 'WooCommerce' )):
	$classes[] = 'woocommerce';
	endif;
	$bizz_ecommerce_color_scheme = get_theme_mod( 'bizz_ecommerce_color_scheme','opn-light' );
	        
	if( shortcode_exists( 'yith_wcwl_add_to_wishlist' ) ){
	    $classes[] = 'bizz-ecommerce-wishlist-activate';
	} 

	return $classes;
}
add_filter( 'body_class', 'bizz_ecommerce_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function bizz_ecommerce_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'bizz_ecommerce_pingback_header' );