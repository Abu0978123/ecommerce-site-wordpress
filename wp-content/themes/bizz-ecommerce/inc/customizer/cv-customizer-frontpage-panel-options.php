<?php
/**
 * Bizz Ecommerce manage the Customizer options of frontpage panel.
 *
 * @subpackage bizz-ecommerce
 * @since 1.0 
 */

/* top header section*/

// Toggle field for Enable/Disable top header
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'toggle',
		'settings' => 'bizz_ecommerce_enable_top_header_section',
		'label'    => __( 'Display Top Header', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_top_header_section_content',
		'default'  => '1',
		'priority' => 5,
	)
);

// Toggle field for Enable/Disable Social Icon
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'toggle',
		'settings' => 'bizz_ecommerce_enable_social_top_header_section',
		'label'    => __( 'Display Social Icons', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_top_header_section_content',
		'default'  => '1',
		'priority' => 10,
		'active_callback' => array(
			array(
				'setting'  => 'bizz_ecommerce_enable_top_header_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);

// facebook url
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'text',
		'settings' => 'bizz_ecommerce_social_fb_button_link',
		'label'    => __( 'Facebook URL', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_top_header_section_content',
		'default'  => '#',
		'priority' => 15,
		'active_callback' => array(
			array(
				'setting'  => 'bizz_ecommerce_enable_top_header_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);

// twitter url
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'text',
		'settings' => 'bizz_ecommerce_social_tw_button_link',
		'label'    => __( 'Twitter URL', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_top_header_section_content',
		'default'  => '#',
		'priority' => 20,
		'active_callback' => array(
			array(
				'setting'  => 'bizz_ecommerce_enable_top_header_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);

// instagram url
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'text',
		'settings' => 'bizz_ecommerce_social_insta_button_link',
		'label'    => __( 'Instagram URL', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_top_header_section_content',
		'default'  => '#',
		'priority' => 25,
		'active_callback' => array(
			array(
				'setting'  => 'bizz_ecommerce_enable_top_header_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);

// linkedin url
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'text',
		'settings' => 'bizz_ecommerce_social_lkdn_button_link',
		'label'    => __( 'Linkedin URL', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_top_header_section_content',
		'default'  => '#',
		'priority' => 30,
		'active_callback' => array(
			array(
				'setting'  => 'bizz_ecommerce_enable_top_header_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);

// pinterest url
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'text',
		'settings' => 'bizz_ecommerce_social_pint_button_link',
		'label'    => __( 'Pinterest URL', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_top_header_section_content',
		'default'  => '#',
		'priority' => 35,
		'active_callback' => array(
			array(
				'setting'  => 'bizz_ecommerce_enable_top_header_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);

// youtube url
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'text',
		'settings' => 'bizz_ecommerce_social_youtube_button_link',
		'label'    => __( 'Youtube URL', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_top_header_section_content',
		'default'  => '#',
		'priority' => 40,
		'active_callback' => array(
			array(
				'setting'  => 'bizz_ecommerce_enable_top_header_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);

// Toggle field for Enable/Disable new tab for social icon url
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'toggle',
		'settings' => 'bizz_ecommerce_enable_new_tab_top_header_section',
		'label'    => __( 'Display Social URL in new Window', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_top_header_section_content',
		'default'  => '1',
		'priority' => 45,
		'active_callback' => array(
			array(
				'setting'  => 'bizz_ecommerce_enable_top_header_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);

// Toggle field for Enable/Disable Contact Number
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'toggle',
		'settings' => 'bizz_ecommerce_enable_contact_top_header_section',
		'label'    => __( 'Display Contact Number', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_top_header_section_content',
		'default'  => '1',
		'priority' => 50,
		'active_callback' => array(
			array(
				'setting'  => 'bizz_ecommerce_enable_top_header_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);

// Text field for Contact Number
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'text',
		'settings' => 'bizz_ecommerce_contact_top_header_section',
		'label'    => __( 'Contact Number', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_top_header_section_content',
        'default'  => '+1-200-196-348-24',
		'priority' => 55,
		'active_callback' => array(
			array(
				'setting'  => 'bizz_ecommerce_enable_top_header_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);

// Toggle field for Enable/Disable Address
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'toggle',
		'settings' => 'bizz_ecommerce_enable_address_top_header_section',
		'label'    => __( 'Display Address', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_top_header_section_content',
		'default'  => '1',
		'priority' => 60,
		'active_callback' => array(
			array(
				'setting'  => 'bizz_ecommerce_enable_top_header_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);

// Text field for Address
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'text',
		'settings' => 'bizz_ecommerce_address_top_header_section',
		'label'    => __( 'Address', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_top_header_section_content',
        'default'  => '272 California, USA',
		'priority' => 65,
		'active_callback' => array(
			array(
				'setting'  => 'bizz_ecommerce_enable_top_header_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);

// Toggle field for Enable/Disable Timing
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'toggle',
		'settings' => 'bizz_ecommerce_enable_timing_top_header_section',
		'label'    => __( 'Display Timing', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_top_header_section_content',
		'default'  => '1',
		'priority' => 70,
		'active_callback' => array(
			array(
				'setting'  => 'bizz_ecommerce_enable_top_header_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);

// Text field for Timing
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'text',
		'settings' => 'bizz_ecommerce_timing_top_header_section',
		'label'    => __( 'Timing', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_top_header_section_content',
        'default'  => 'Mon - Sat: 8.00 - 18.00',
		'priority' => 75,
		'active_callback' => array(
			array(
				'setting'  => 'bizz_ecommerce_enable_top_header_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);

/* end of top header section*/

/* general options */

// Text field for general options
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'text',
		'settings' => 'bizz_ecommerce_readmore_general_section',
		'label'    => __( 'Read More Label', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_general_section_content',
		'default'  => 'Read More',	
		'priority' => 5,
	)
);

// excerpt length 
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'number',
		'settings' => 'bizz_ecommerce_excerpt_general_section',
		'label'    => __( 'Excerpt Length', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_general_section_content',
		'description' => __( '0 length will not show the excerpt.', 'bizz-ecommerce' ),
		'default'  => '55',	
		'priority' => 5,
	)
);

/* end of general options */

/* layout options */

// Select field for Theme Layout
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'select',
		'settings' => 'bizz_ecommerce_theme_layout_section',
		'label'    => __( 'Theme Layout', 'bizz-ecommerce' ),
		'description' => __( 'Box layout will be visible at minimum 1200px display', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_layout_section_content',
		'default'  => 'wide',	
		'priority' => 5,
		'choices'  => array(
			'wide' => __( 'Wide', 'bizz-ecommerce' ),
			'box'  => __( 'Box',  'bizz-ecommerce' ),
		),
	)
);

// Select field for sidebar position
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'select',
		'settings' => 'bizz_ecommerce_sidebar_layout_section',
		'label'    => __( 'Sidebar Position', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_layout_section_content',
		'default'  => 'right',	
		'priority' => 10,
		'choices'  => array(
			'right' => __( 'Right Sidebar', 'bizz-ecommerce'),
			'left'  => __( 'Left Sidebar',  'bizz-ecommerce'),
			'no'    => __( 'No Sidebar',  'bizz-ecommerce'),
		),
	)
);

/* end of layout options */

/* blog post options */

// Toggle field for Enable/Disable Author
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'toggle',
		'settings' => 'bizz_ecommerce_enable_author_blog_section',
		'label'    => __( 'Display Author', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_blog_post_section_content',
		'default'  => '1',
		'priority' => 5,
	)
);

// Toggle field for Enable/Disable Comment Count
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'toggle',
		'settings' => 'bizz_ecommerce_enable_comment_blog_section',
		'label'    => __( 'Display Comments Count', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_blog_post_section_content',
		'default'  => '1',
		'priority' => 10,
	)
);

// Toggle field for Enable/Disable Visit Count
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'toggle',
		'settings' => 'bizz_ecommerce_enable_vcount_blog_section',
		'label'    => __( 'Display Visit Count', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_blog_post_section_content',
		'default'  => '1',
		'priority' => 15,
	)
);

// Toggle field for Enable/Disable Date
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'toggle',
		'settings' => 'bizz_ecommerce_enable_date_blog_section',
		'label'    => __( 'Display Date on Image', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_blog_post_section_content',
		'default'  => '1',
		'priority' => 20,
	)
);

// Toggle field for Enable/Disable Featured Image
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'toggle',
		'settings' => 'bizz_ecommerce_enable_fimage_blog_section',
		'label'    => __( 'Display Featured Image', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_blog_post_section_content',
		'default'  => '1',
		'priority' => 25,
	)
);

/* end of blog post options */

/* single post options */

// Toggle field for Enable/Disable Author
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'toggle',
		'settings' => 'bizz_ecommerce_enable_author_single_section',
		'label'    => __( 'Display Author', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_single_post_section_content',
		'default'  => '1',
		'priority' => 5,
	)
);

// Toggle field for Enable/Disable Comment Count
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'toggle',
		'settings' => 'bizz_ecommerce_enable_comment_single_section',
		'label'    => __( 'Display Comments Count', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_single_post_section_content',
		'default'  => '1',
		'priority' => 10,
	)
);

// Toggle field for Enable/Disable Date
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'toggle',
		'settings' => 'bizz_ecommerce_enable_date_single_section',
		'label'    => __( 'Display Date', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_single_post_section_content',
		'default'  => '1',
		'priority' => 15,
	)
);

// Toggle field for Enable/Disable Visit Count
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'toggle',
		'settings' => 'bizz_ecommerce_enable_vcount_single_section',
		'label'    => __( 'Display Visit Count', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_single_post_section_content',
		'default'  => '1',
		'priority' => 18,
	)
);

// Toggle field for Enable/Disable Visit Count
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'toggle',
		'settings' => 'bizz_ecommerce_enable_tags_single_section',
		'label'    => __( 'Display Tags', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_single_post_section_content',
		'default'  => '1',
		'priority' => 20,
	)
);

// Toggle field for Enable/Disable Featured Image
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'toggle',
		'settings' => 'bizz_ecommerce_enable_fimage_single_section',
		'label'    => __( 'Display Featured Image', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_single_post_section_content',
		'default'  => '1',
		'priority' => 25,
	)
);

/* end of single post options */

/* footer options */

// Toggle field for Enable/Disable Copyright
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'toggle',
		'settings' => 'bizz_ecommerce_enable_cpright_footer_section',
		'label'    => __( 'Display Copyright Footer', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_footer_section_content',
		'default'  => '1',
		'priority' => 5,
	)
);

// Textarea field for Footer section content
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'textarea',
		'settings' => 'bizz_ecommerce_cpright_footer_section',
		'label'    => __( 'Team Title', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_footer_section_content',
		'default'  => 'Powered by WordPress',	
		'priority' => 10,
		'active_callback' => array(
			array(
				'setting'  => 'bizz_ecommerce_enable_cpright_footer_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);

// Toggle field for Enable/Disable Social Icon
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'toggle',
		'settings' => 'bizz_ecommerce_enable_logo_footer_section',
		'label'    => __( 'Display Logo', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_footer_section_content',
		'default'  => '1',
		'priority' => 15,
	)
);

Kirki::add_field( 'bizz_ecommerce_config', [
	'type'        => 'image',
	'settings'    => 'bizz_ecommerce_logo_footer_section',
	'label'       => __( 'Footer Logo', 'bizz-ecommerce' ),
	'description' => __( 'upload footer logo here', 'bizz-ecommerce' ),
	'section'     => 'bizz_ecommerce_footer_section_content',
	'default'     => '',
	'priority' => 20,
	'active_callback' => array(
			array(
				'setting'  => 'bizz_ecommerce_enable_logo_footer_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
] );

// Text field for Footer section title
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'text',
		'settings' => 'bizz_ecommerce_title_footer_section',
		'label'    => __( 'Footer Title', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_footer_section_content',
		'default'  => 'TAKE OWNERSHIP OF YOUR BRAND',	
		'priority' => 25,
	)
);

// Text field for Footer section description
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'text',
		'settings' => 'bizz_ecommerce_description_footer_section',
		'label'    => __( 'Footer Description', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_footer_section_content',
		'default'  => 'Finally, a partner that handles the heavy lifting for you.',	
		'priority' => 30,
	)
);

// Toggle field for Enable/Disable Social Icon
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'toggle',
		'settings' => 'bizz_ecommerce_enable_social_footer_section',
		'label'    => __( 'Display Social Icon', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_footer_section_content',
		'default'  => '1',
		'priority' => 35,
	)
);

// facebook url
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'text',
		'settings' => 'bizz_ecommerce_social_fb_button_link_footer',
		'label'    => __( 'Facebook URL', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_footer_section_content',
		'default'  => '#',
		'priority' => 40,
		'active_callback' => array(
			array(
				'setting'  => 'bizz_ecommerce_enable_social_footer_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);

// instagram url
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'text',
		'settings' => 'bizz_ecommerce_social_insta_button_link_footer',
		'label'    => __( 'Instagram URL', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_footer_section_content',
		'default'  => '#',
		'priority' => 45,
		'active_callback' => array(
			array(
				'setting'  => 'bizz_ecommerce_enable_social_footer_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);

// linkedin url
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'text',
		'settings' => 'bizz_ecommerce_social_lkdn_button_link_footer',
		'label'    => __( 'Linkedin URL', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_footer_section_content',
		'default'  => '#',
		'priority' => 50,
		'active_callback' => array(
			array(
				'setting'  => 'bizz_ecommerce_enable_social_footer_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);

// Toggle field for Enable/Disable new tab for social icon url
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'toggle',
		'settings' => 'bizz_ecommerce_enable_new_tab_footer_section',
		'label'    => __( 'Display Social URL in new Window', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_footer_section_content',
		'default'  => '1',
		'priority' => 55,
		'active_callback' => array(
			array(
				'setting'  => 'bizz_ecommerce_enable_social_footer_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);

// Text field for general options
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'text',
		'settings' => 'bizz_ecommerce_separator_title_footer_section',
		'label'    => __( 'Footer Separator Title', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_footer_section_content',
		'default'  => 'Start a conversation',	
		'priority' => 60,
	)
);

/* end of footer options */

/* advance options */

// Toggle field for Enable/Disable Sticky Header
Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'toggle',
		'settings' => 'bizz_ecommerce_enable_sticky_header',
		'label'    => __( 'Enable Sticky Header', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_advance_option_content',
		'default'  => '1',
		'priority' => 5,
	)
);

Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'toggle',
		'settings' => 'bizz_ecommerce_enable_preloader',
		'label'    => __( 'Enable Preloader', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_advance_option_content',
		'default'  => '1',
		'priority' => 10,
	)
);

Kirki::add_field(
	'bizz_ecommerce_config', array(
		'type'     => 'toggle',
		'settings' => 'bizz_ecommerce_enable_scroll_top',
		'label'    => __( 'Enable Scroll to Top', 'bizz-ecommerce' ),
		'section'  => 'bizz_ecommerce_advance_option_content',
		'default'  => '1',
		'priority' => 15,
	)
);
/* end of advance options */