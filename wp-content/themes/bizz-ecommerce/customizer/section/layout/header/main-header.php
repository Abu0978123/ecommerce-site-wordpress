<?php
// main header


/***************************************/
// Disable product category search box
/****************************************/




$wp_customize->add_setting( 'bizz_ecommerce_cat_search_disable', array(
                'default'               => false,
                'sanitize_callback'     => 'bizz_ecommerce_sanitize_checkbox',
            ) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bizz_ecommerce_cat_search_disable', array(
                'label'                 => esc_html__('Check to disable Category in Search Box', 'bizz-ecommerce'),
                'type'                  => 'checkbox',
                //'section'               => 'bizz-ecommerce-main-header',
				'section'               => 'bizz-ecommerce-main-header',
                'settings'              => 'bizz_ecommerce_cat_search_disable',
                'priority'   => 1,
            ) ) );


// choose col layout


/***********************************/  
// menu alignment
/***********************************/ 
$wp_customize->add_setting('bizz_ecommerce_menu_alignment', array(
                'default'               => 'center',
                'sanitize_callback'     => 'bizz_ecommerce_sanitize_select',
            ) );
$wp_customize->add_control( new Bizz_Ecommerce_Customizer_Buttonset_Control( $wp_customize, 'bizz_ecommerce_menu_alignment', array(
                'label'                 => esc_html__( 'Menu Alignment', 'bizz-ecommerce' ),
                'section'               => 'bizz-ecommerce-main-header',
                'settings'              => 'bizz_ecommerce_menu_alignment',
                'choices'               => array(
                    'left'              => esc_html__( 'Left', 'bizz-ecommerce' ),
                    'center'            => esc_html__( 'center', 'bizz-ecommerce' ),
                    'right'             => esc_html__( 'Right', 'bizz-ecommerce' ),
                ),
                'priority'   => 2,
        ) ) );
//Main menu option
$wp_customize->add_setting('bizz_ecommerce_main_header_option', array(
        'default'        => 'none',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'bizz_ecommerce_sanitize_select',
    ));
$wp_customize->add_control( 'bizz_ecommerce_main_header_option', array(
        'settings' => 'bizz_ecommerce_main_header_option',
        'label'    => __('Right Column','bizz-ecommerce'),
        'section'  => 'bizz-ecommerce-main-header',
        'type'     => 'select',
        'choices'    => array(
        'none'       => __('None','bizz-ecommerce'),
        'callto'     => __('Call-To','bizz-ecommerce'),
        'button'     => __('Button (Pro)','bizz-ecommerce'),
        
        'widget'     => __('Widget (Pro)','bizz-ecommerce'),     
        ),
        'priority'   => 3,
    ));
//**************/
// BUTTON TEXT //
//**************/
$wp_customize->add_setting('bizz_ecommerce_main_hdr_btn_txt', array(
        'default' => __('Button Text','bizz-ecommerce'),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'bizz_ecommerce_sanitize_text',
        'transport'         => 'postMessage',
));
$wp_customize->add_control( 'bizz_ecommerce_main_hdr_btn_txt', array(
        'label'    => __('Button Text', 'bizz-ecommerce'),
        'section'  => 'bizz-ecommerce-main-header',
         'type'    => 'text',
         'priority'   => 4,
));

$wp_customize->add_setting('bizz_ecommerce_main_hdr_btn_lnk', array(
        'default' => __('#','bizz-ecommerce'),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'bizz_ecommerce_sanitize_text',
        
));
$wp_customize->add_control( 'bizz_ecommerce_main_hdr_btn_lnk', array(
        'label'    => __('Button Link', 'bizz-ecommerce'),
        'section'  => 'bizz-ecommerce-main-header',
         'type'    => 'text',
         'priority'   => 5,
));
/*****************/
// Call-to
/*****************/
$wp_customize->add_setting('bizz_ecommerce_main_hdr_calto_txt', array(
        'default' => __('Call To','bizz-ecommerce'),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'bizz_ecommerce_sanitize_text',
        'transport'         => 'postMessage',
));
$wp_customize->add_control( 'bizz_ecommerce_main_hdr_calto_txt', array(
        'label'    => __('Call To Text', 'bizz-ecommerce'),
        'section'  => 'bizz-ecommerce-main-header',
         'type'    => 'text',
         'priority'   => 6,
));

$wp_customize->add_setting('bizz_ecommerce_main_hdr_calto_nub', array(
        'default' => __('+1800090098','bizz-ecommerce'),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'bizz_ecommerce_sanitize_text',
        'transport'         => 'postMessage',
));
$wp_customize->add_control( 'bizz_ecommerce_main_hdr_calto_nub', array(
        'label'    => __('Call To Number', 'bizz-ecommerce'),
        'section'  => 'bizz-ecommerce-main-header',
         'type'    => 'text',
         'priority'   => 7,
));

// col1 widget redirection
if (class_exists('Bizz_Ecommerce_Widegt_Redirect')){ 
$wp_customize->add_setting(
            'bizz_ecommerce_main_header_widget_redirect', array(
            'sanitize_callback' => 'sanitize_text_field',
     )
);
$wp_customize->add_control(
            new Bizz_Ecommerce_Widegt_Redirect(
                $wp_customize, 'bizz_ecommerce_main_header_widget_redirect', array(
                    'section'      => 'bizz-ecommerce-main-header',
                    'button_text'  => esc_html__( 'Go To Widget', 'bizz-ecommerce' ),
                    'button_class' => 'focus-customizer-widget-redirect',  
                    'priority'   => 8,
                )
            )
        );
} 
/***********************************/  
// menu alignment
/***********************************/ 
$wp_customize->add_setting('bizz_ecommerce_mobile_menu_open', array(
                'default'               => 'left',
                'sanitize_callback'     => 'bizz_ecommerce_sanitize_select',
            ) );
$wp_customize->add_control( new Bizz_Ecommerce_Customizer_Buttonset_Control( $wp_customize, 'bizz_ecommerce_mobile_menu_open', array(
                'label'                 => esc_html__( 'Mobile Menu', 'bizz-ecommerce' ),
                'section'               => 'bizz-ecommerce-main-header',
                'settings'              => 'bizz_ecommerce_mobile_menu_open',
                'choices'               => array(
                    'left'              => esc_html__( 'Left', 'bizz-ecommerce' ),
                    // 'overcenter'        => esc_html__( 'center', 'bizz-ecommerce' ),
                    'right'             => esc_html__( 'Right', 'bizz-ecommerce' ),
                ),
                'priority'   => 9,
        ) ) );

  $wp_customize->add_setting( 'bizz_ecommerce_shadow_header', array(
    'default'           => false,
    'sanitize_callback' => 'bizz_ecommerce_sanitize_checkbox',
  ) );
  $wp_customize->add_control( new Bizz_Ecommerce_Toggle_Control( $wp_customize, 'bizz_ecommerce_shadow_header', array(
    'label'       => esc_html__( 'Header Shadow', 'bizz-ecommerce' ),
    'section'     => 'bizz-ecommerce-main-header',
    'type'        => 'toggle',
    'settings'    => 'bizz_ecommerce_shadow_header',
    'priority'   => 10,
  ) ) );
/***********************************/  
// Sticky Header
/***********************************/ 
  $wp_customize->add_setting( 'bizz_ecommerce_sticky_header', array(
    'default'           => false,
    'sanitize_callback' => 'bizz_ecommerce_sanitize_checkbox',
  ) );
  $wp_customize->add_control( new Bizz_Ecommerce_Toggle_Control( $wp_customize, 'bizz_ecommerce_sticky_header', array(
    'label'       => esc_html__( 'Sticky Header', 'bizz-ecommerce' ),
    'section'     => 'bizz-ecommerce-main-header',
    'type'        => 'toggle',
    'settings'    => 'bizz_ecommerce_sticky_header',
    'priority'   => 10,
  ) ) );

  $wp_customize->add_setting('bizz_ecommerce_sticky_header_effect', array(
        'default'        => 'scrldwmn',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'bizz_ecommerce_sanitize_select',
    ));
$wp_customize->add_control( 'bizz_ecommerce_sticky_header_effect', array(
        'settings' => 'bizz_ecommerce_sticky_header_effect',
        'label'    => __('Sticky Header Effect','bizz-ecommerce'),
        'section'  => 'bizz-ecommerce-main-header',
        'type'     => 'select',
        'choices'    => array(
        'scrldwmn'    => __('Effect One','bizz-ecommerce'),
        'scrltop'     => __('Effect Two','bizz-ecommerce'),
        
        ),
        'priority'   => 11,
    ));
/******************/
// Disable in Mobile
/******************/
$wp_customize->add_setting( 'bizz_ecommerce_whislist_mobile_disable', array(
                'default'               => false,
                'sanitize_callback'     => 'bizz_ecommerce_sanitize_checkbox',
            ) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bizz_ecommerce_whislist_mobile_disable', array(
                'label'                 => esc_html__('Check to disable whislist icon in mobile device', 'bizz-ecommerce'),
                'type'                  => 'checkbox',
                'section'               => 'bizz-ecommerce-main-header',
                'settings'              => 'bizz_ecommerce_whislist_mobile_disable',
                'priority'   => 12,
            ) ) );

$wp_customize->add_setting( 'bizz_ecommerce_account_mobile_disable', array(
                'default'               => false,
                'sanitize_callback'     => 'bizz_ecommerce_sanitize_checkbox',
            ) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bizz_ecommerce_account_mobile_disable', array(
                'label'                 => esc_html__('Check to disable account icon in mobile device', 'bizz-ecommerce'),
                'type'                  => 'checkbox',
                'section'               => 'bizz-ecommerce-main-header',
                'settings'              => 'bizz_ecommerce_account_mobile_disable',
                'priority'   => 13,
            ) ) );

$wp_customize->add_setting( 'bizz_ecommerce_cart_mobile_disable', array(
                'default'               => false,
                'sanitize_callback'     => 'bizz_ecommerce_sanitize_checkbox',
            ) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bizz_ecommerce_cart_mobile_disable', array(
                'label'                 => esc_html__('Check to disable cart icon in mobile device', 'bizz-ecommerce'),
                'type'                  => 'checkbox',
                'section'               => 'bizz-ecommerce-main-header',
                'settings'              => 'bizz_ecommerce_cart_mobile_disable',
                'priority'   => 14,
            ) ) );

/****************/
//doc link
/****************/
$wp_customize->add_setting('bizz_ecommerce_main_header_doc_learn_more', array(
    'sanitize_callback' => 'bizz_ecommerce_sanitize_text',
    ));
$wp_customize->add_control(new Bizz_Ecommerce_Misc_Control( $wp_customize, 'bizz_ecommerce_main_header_doc_learn_more',
            array(
        'section'    => 'bizz-ecommerce-main-header',
        'type'      => 'doc-link',
        'url'       => '#',
        'description' => esc_html__( 'To know more go with this', 'bizz-ecommerce' ),
        'priority'   =>100,
    )));

// exclude header category
function bizz_ecommerce_get_category_id($arr='',$all=true){
    $cats = array();
    foreach ( get_categories($arr) as $categories => $category ){
       
        $cats[$category->term_id] = $category->name;
     }
     return $cats;
  }
$wp_customize->add_setting('bizz_ecommerce_main_hdr_cat_txt', array(
        'default' => __('Category','bizz-ecommerce'),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'bizz_ecommerce_sanitize_text',
        'transport'         => 'postMessage',
));
$wp_customize->add_control( 'bizz_ecommerce_main_hdr_cat_txt', array(
        'label'    => __('Category Text', 'bizz-ecommerce'),
        'section'  => 'bizz_ecommerce_exclde_cat_header',
         'type'    => 'text',
));
 if (class_exists( 'Bizz_Ecommerce_Customize_Control_Checkbox_Multiple')) {
   $wp_customize->add_setting('bizz_ecommerce_exclde_category', array(
        'default'           => '',
        'sanitize_callback' => 'bizz_ecommerce_checkbox_explode'
    ));
    $wp_customize->add_control(new Bizz_Ecommerce_Customize_Control_Checkbox_Multiple(
            $wp_customize,'bizz_ecommerce_exclde_category', array(
        'settings'=> 'bizz_ecommerce_exclde_category',
        'label'   => __( 'Choose Categories To Exclude', 'bizz-ecommerce' ),
        'section' => 'bizz_ecommerce_exclde_cat_header',
        'choices' => bizz_ecommerce_get_category_id(array('taxonomy' =>'product_cat'),true),
        ) 
    ));

}  