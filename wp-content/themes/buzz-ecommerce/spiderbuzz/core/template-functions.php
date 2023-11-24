<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Buzz_Ecommerce
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function buzz_ecommerce_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	
	//add the sidebar control on body class
	$buzz_ecommerce_sidebar_layout_settings = get_theme_mod('buzz_ecommerce_sidebar_layout_settings','right-sidebar');
	$classes[] = $buzz_ecommerce_sidebar_layout_settings;

	return $classes;
}
add_filter( 'body_class', 'buzz_ecommerce_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function buzz_ecommerce_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'buzz_ecommerce_pingback_header' );
