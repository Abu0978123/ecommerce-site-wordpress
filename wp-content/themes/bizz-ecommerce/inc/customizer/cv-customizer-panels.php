<?php
/**
 * Bizz Ecommerce manage the Customizer panels.
 *
 * @subpackage bizz-ecommerce
 * @since 1.0 
 */

/**
 * General Settings Panel
 */
Kirki::add_panel( 'bizz_ecommerce_general_panel', array(
	'priority' => 10,
	'title'    => __( 'General Settings', 'bizz-ecommerce' ),
) );

/**
 * Bizz Ecommerce Options
 */
Kirki::add_panel( 'bizz_ecommerce_options_panel', array(
	'priority' => 20,
	'title'    => __( 'Bizz Ecommerce Theme Options', 'bizz-ecommerce' ),
) );