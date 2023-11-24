<?php
/**
 * Bizz Ecommerce manage the Customizer options of general panel.
 *
 * @subpackage bizz-ecommerce
 * @since 1.0 
 */
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'        => 'checkbox',
		'settings'    => 'bizz_ecommerce_home_posts',
		'label'       => esc_attr__( 'Checked to hide latest posts in homepage.', 'bizz-ecommerce' ),
		'section'     => 'static_front_page',
		'default'     => true,
	)
);

// Color Picker field for Primary Color
Kirki::add_field( 
	'bizz_ecommerce_config', array(
		'type'        => 'color',
		'settings'    => 'bizz_ecommerce_theme_color',
		'label'       => esc_html__( 'Primary Color', 'bizz-ecommerce' ),
		'section'     => 'colors',
		'default'     => '#f10e00',
	)
);