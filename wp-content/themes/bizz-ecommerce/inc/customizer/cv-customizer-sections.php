<?php
/**
 * Bizz Ecommerce manage the Customizer sections.
 *
 * @subpackage bizz-ecommerce
 * @since 1.0 
 */

/**
 * Top Header Options
 */
Kirki::add_section( 'bizz_ecommerce_top_header_section_content', array(
	'title'    => __( 'Top Header Options', 'bizz-ecommerce' ),
	'panel'    => 'bizz_ecommerce_options_panel',
	'description' => __( 'Personalize the settings top header.', 'bizz-ecommerce' ),
	'priority' => 5,
) );

/**
 * General Options
 */
Kirki::add_section( 'bizz_ecommerce_general_section_content', array(
	'title'    => __( 'General Options', 'bizz-ecommerce' ),
	'panel'    => 'bizz_ecommerce_options_panel',
	'description' => __( 'Personalize the settings of your theme.', 'bizz-ecommerce' ),
	'priority' => 8,
) );

/**
 * Layout Options
 */
Kirki::add_section( 'bizz_ecommerce_layout_section_content', array(
	'title'    => __( 'Layout Options', 'bizz-ecommerce' ),
	'panel'    => 'bizz_ecommerce_options_panel',
	'description' => __( 'Personalize the layout settings of your theme.', 'bizz-ecommerce' ),
	'priority' => 10,
) );

/**
 * Blog Post Options
 */
Kirki::add_section( 'bizz_ecommerce_blog_post_section_content', array(
	'title'    => __( 'Blog Post Options', 'bizz-ecommerce' ),
	'panel'    => 'bizz_ecommerce_options_panel',
	'description' => __( 'Setting will also apply on archieve and search page.', 'bizz-ecommerce' ),
	'priority' => 12,
) );

/**
 * Single Post Options
 */
Kirki::add_section( 'bizz_ecommerce_single_post_section_content', array(
	'title'    => __( 'Single Post Options', 'bizz-ecommerce' ),
	'panel'    => 'bizz_ecommerce_options_panel',
	'description' => __( 'Setting will apply on the content of single posts.', 'bizz-ecommerce' ),
	'priority' => 14,
) );

/**
 * Footer Options
 */
Kirki::add_section( 'bizz_ecommerce_footer_section_content', array(
	'title'    => __( 'Footer Options', 'bizz-ecommerce' ),
	'panel'    => 'bizz_ecommerce_options_panel',
	'description' => __( 'Personalize the footer settings of your theme.', 'bizz-ecommerce' ),
	'priority' => 16,
) );

/**
 * Advance Options
 */
Kirki::add_section( 'bizz_ecommerce_advance_option_content', array(
	'title'    => __( 'Advance Options', 'bizz-ecommerce' ),
	'panel'    => 'bizz_ecommerce_options_panel',
	'description' => __( 'Personalize the Advance settings of your theme.', 'bizz-ecommerce' ),
	'priority' => 18,
) );