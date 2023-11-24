<?php
/**
 * Register customizer panels & sections.
 */
/*************************/
/*WordPress Default Panel*/
/*************************/
/**
 * Category Section Customizer Settings
 */
if(!function_exists('bizz_ecommerce_get_category_list')){
function bizz_ecommerce_get_category_list($arr='',$all=true){
    $cats = array();
    foreach ( get_categories($arr) as $categories => $category ){
       
        $cats[$category->slug] = $category->name;
     }
     return $cats;
  }
}

$bizz_ecommerce_shop_panel_default = new Bizz_Ecommerce_WP_Customize_Panel( $wp_customize,'bizz-ecommerce-panel-default', array(
    'priority' => 1,
    'title'    => __( 'WordPress Default', 'bizz-ecommerce' ),
  ));
$wp_customize->add_panel($bizz_ecommerce_shop_panel_default);
$wp_customize->get_section( 'title_tagline' )->panel = 'bizz-ecommerce-panel-default';
$wp_customize->get_section( 'static_front_page' )->panel = 'bizz-ecommerce-panel-default';
$wp_customize->get_section( 'custom_css' )->panel = 'bizz-ecommerce-panel-default';

$wp_customize->add_setting('bizz_ecommerce_home_page_setup', array(
    'sanitize_callback' => 'bizz_ecommerce_sanitize_text',
    ));
$wp_customize->add_control(new Bizz_Ecommerce_Misc_Control( $wp_customize, 'bizz_ecommerce_home_page_setup',
            array(
        'section'    => 'static_front_page',
        'type'      => 'doc-link',
        'url'       => '#',
        'description' => esc_html__( 'To know more go with this', 'bizz-ecommerce' ),
        'priority'   =>100,
    )));
/************************/
// Background option
/************************/
$bizz_ecommerce_shop_bg_option = new  Bizz_Ecommerce_WP_Customize_Section( $wp_customize, 'bizz-ecommerce-bg-option', array(
    'title' =>  __( 'Background', 'bizz-ecommerce' ),
    'panel' => 'bizz-ecommerce-panel-default',
    'priority' => 10,
  ));
$wp_customize->add_section($bizz_ecommerce_shop_bg_option);

/*************************/
/*Layout Panel*/
/*************************/

//blog
$bizz_ecommerce_section_blog_group = new  Bizz_Ecommerce_WP_Customize_Section( $wp_customize,'bizz-ecommerce-section-blog-group', array(
    'title' =>  __( 'Blog', 'bizz-ecommerce' ),
    'panel' => 'bizz-ecommerce-panel-layout',
    'priority' => 2,
  ));
$wp_customize->add_section($bizz_ecommerce_section_blog_group);

$bizz_ecommerce_section_footer_group = new  Bizz_Ecommerce_WP_Customize_Section( $wp_customize, 'bizz-ecommerce-section-footer-group', array(
    'title' =>  __( 'Footer', 'bizz-ecommerce' ),
    'panel' => 'bizz-ecommerce-panel-layout',
    'priority' => 3,
  ));
$wp_customize->add_section( $bizz_ecommerce_section_footer_group);
// sidebar
$bizz_ecommerce_section_sidebar_group = new  Bizz_Ecommerce_WP_Customize_Section( $wp_customize, 'bizz-ecommerce-section-sidebar-group', array(
    'title' =>  __( 'Sidebar', 'bizz-ecommerce' ),
    'panel' => 'bizz-ecommerce-panel-layout',
    'priority' => 3,
  ));
$wp_customize->add_section($bizz_ecommerce_section_sidebar_group);
// Scroll to top
$bizz_ecommerce_move_to_top = new  Bizz_Ecommerce_WP_Customize_Section( $wp_customize, 'bizz-ecommerce-move-to-top', array(
    'title' =>  __( 'Move To Top', 'bizz-ecommerce' ),
    'panel' => 'bizz-ecommerce-panel-layout',
    'priority' => 3,
  ));
$wp_customize->add_section($bizz_ecommerce_move_to_top);
//above-footer
$bizz_ecommerce_above_footer = new  Bizz_Ecommerce_WP_Customize_Section( $wp_customize, 'bizz-ecommerce-above-footer',array(
    'title'    => __( 'Above Footer','bizz-ecommerce' ),
    'panel'    => 'bizz-ecommerce-panel-layout',
        'section'  => 'bizz-ecommerce-section-footer-group',
        'priority' => 1,
));
$wp_customize->add_section( $bizz_ecommerce_above_footer);
//widget footer
$bizz_ecommerce_shop_widget_footer = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-widget-footer', array(
    'title'    => __('Widget Footer','bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-layout',
    'section'  => 'bizz-ecommerce-section-footer-group',
    'priority' => 5,
));
$wp_customize->add_section( $bizz_ecommerce_shop_widget_footer);
//Bottom footer
$bizz_ecommerce_shop_bottom_footer = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-bottom-footer', array(
    'title'    => __('Below Footer','bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-layout',
    'section'  => 'bizz-ecommerce-section-footer-group',
    'priority' => 5,
));
$wp_customize->add_section( $bizz_ecommerce_shop_bottom_footer);
// rtl
$bizz_ecommerce_rtl = new Bizz_Ecommerce_WP_Customize_Section( $wp_customize, 'bizz-ecommerce-rtl', array(
    'title' =>  __( 'RTL', 'bizz-ecommerce' ),
    'panel' => 'bizz-ecommerce-panel-layout',
    'priority' => 6,
));
$wp_customize->add_section($bizz_ecommerce_rtl);
/*************************/
/* Preloader */
/*************************/
$wp_customize->add_section( 'bizz-ecommerce-pre-loader' , array(
    'title'      => __('Preloader','bizz-ecommerce'),
    'priority'   => 30,
) );
/*************************/
/* Social   Icon*/
/*************************/
$bizz_ecommerce_social_header = new Bizz_Ecommerce_WP_Customize_Section( $wp_customize, 'bizz-ecommerce-social-icon', array(
    'title'    => __( 'Social Icon', 'bizz-ecommerce' ),
    'priority' => 30,
  ));
$wp_customize->add_section( $bizz_ecommerce_social_header );
/*************************/
/* Frontpage Panel */
/*************************/
$wp_customize->add_panel( 'bizz-ecommerce-panel-frontpage', array(
                'priority' => 5,
                'title'    => __( 'Frontpage Sections', 'bizz-ecommerce' ),
) );

$bizz_ecommerce_top_slider_section = new Bizz_Ecommerce_WP_Customize_Section( $wp_customize, 'bizz_ecommerce_top_slider_section', array(
    'title'    => __( 'Top Slider', 'bizz-ecommerce' ),
    'panel'    => 'bizz-ecommerce-panel-frontpage',
    'priority' => 4,
  ));
$wp_customize->add_section( $bizz_ecommerce_top_slider_section );

$bizz_ecommerce_feature_banner_section = new Bizz_Ecommerce_WP_Customize_Section( $wp_customize, 'bizz_ecommerce_feature_banner_section', array(
    'title'    => __( 'Featured Banner', 'bizz-ecommerce' ),
    'panel'    => 'bizz-ecommerce-panel-frontpage',
    'priority' => 4,
  ));
$wp_customize->add_section( $bizz_ecommerce_feature_banner_section );

$bizz_ecommerce_cat_slide_section = new Bizz_Ecommerce_WP_Customize_Section( $wp_customize, 'bizz_ecommerce_cat_slide_section', array(
    'title'    => __( 'Woo Category', 'bizz-ecommerce' ),
    'panel'    => 'bizz-ecommerce-panel-frontpage',
    'priority' => 4,
  ));
$bizz_ecommerce_category_tab_section = new Bizz_Ecommerce_WP_Customize_Section( $wp_customize, 'bizz_ecommerce_category_tab_section', array(
    'title'    => __( 'Tabbed Product Carousel', 'bizz-ecommerce' ),
    'panel'    => 'bizz-ecommerce-panel-frontpage',
    'priority' => 4,
  ));
$wp_customize->add_section( $bizz_ecommerce_category_tab_section );



$wp_customize->add_section( $bizz_ecommerce_cat_slide_section );
// ribbon
$bizz_ecommerce_ribbon = new Bizz_Ecommerce_WP_Customize_Section( $wp_customize, 'bizz_ecommerce_ribbon', array(
    'title'    => __( 'Ribbon', 'bizz-ecommerce' ),
    'panel'    => 'bizz-ecommerce-panel-frontpage',
    'priority' => 4,
  ));
$wp_customize->add_section( $bizz_ecommerce_ribbon );
$bizz_ecommerce_product_tab_image = new Bizz_Ecommerce_WP_Customize_Section( $wp_customize, 'bizz_ecommerce_product_tab_image', array(
    'title'    => __( 'Product Tab Image Carousel', 'bizz-ecommerce' ),
    'panel'    => 'bizz-ecommerce-panel-frontpage',
    'priority' => 4,
  ));
$wp_customize->add_section( $bizz_ecommerce_product_tab_image );

$bizz_ecommerce_product_slide_section = new Bizz_Ecommerce_WP_Customize_Section( $wp_customize, 'bizz_ecommerce_product_slide_section', array(
    'title'    => __( 'Product Carousel', 'bizz-ecommerce' ),
    'panel'    => 'bizz-ecommerce-panel-frontpage',
    'priority' => 4,
  ));
$wp_customize->add_section( $bizz_ecommerce_product_slide_section );

$bizz_ecommerce_banner = new Bizz_Ecommerce_WP_Customize_Section( $wp_customize, 'bizz_ecommerce_banner', array(
    'title'    => __( 'Banner', 'bizz-ecommerce' ),
    'panel'    => 'bizz-ecommerce-panel-frontpage',
    'priority' => 4,
  ));
$wp_customize->add_section( $bizz_ecommerce_banner );

$bizz_ecommerce_product_slide_list = new Bizz_Ecommerce_WP_Customize_Section( $wp_customize, 'bizz_ecommerce_product_slide_list', array(
    'title'    => __( 'News & Blogs', 'bizz-ecommerce' ),
    'panel'    => 'bizz-ecommerce-panel-frontpage',
    'priority' => 4,
  ));
$wp_customize->add_section( $bizz_ecommerce_product_slide_list );



$bizz_ecommerce_highlight = new Bizz_Ecommerce_WP_Customize_Section( $wp_customize, 'bizz_ecommerce_highlight', array(
    'title'    => __( 'Features', 'bizz-ecommerce' ),
    'panel'    => 'bizz-ecommerce-panel-frontpage',
    'priority' => 4,
  ));
$wp_customize->add_section( $bizz_ecommerce_highlight );

$bizz_ecommerce_brand = new Bizz_Ecommerce_WP_Customize_Section( $wp_customize, 'bizz_ecommerce_brand', array(
    'title'    => __( 'Brand', 'bizz-ecommerce' ),
    'panel'    => 'bizz-ecommerce-panel-frontpage',
    'priority' => 4,
  ));
$wp_customize->add_section( $bizz_ecommerce_brand );

$bizz_ecommerce_product_big_feature = new Bizz_Ecommerce_WP_Customize_Section( $wp_customize, 'bizz_ecommerce_product_big_feature', array(
    'title'    => __( 'Big Featured Product', 'bizz-ecommerce' ),
    'panel'    => 'bizz-ecommerce-panel-frontpage',
    'priority' => 4,
  ));
$wp_customize->add_section( $bizz_ecommerce_product_big_feature );
$bizz_ecommerce_product_cat_list = new Bizz_Ecommerce_WP_Customize_Section( $wp_customize, 'bizz_ecommerce_product_cat_list', array(
    'title'    => __( 'Tabbed Product List Carousel', 'bizz-ecommerce' ),
    'panel'    => 'bizz-ecommerce-panel-frontpage',
    'priority' => 4,
  ));
$wp_customize->add_section( $bizz_ecommerce_product_cat_list );
$bizz_ecommerce_1_custom_sec = new Bizz_Ecommerce_WP_Customize_Section( $wp_customize, 'bizz_ecommerce_1_custom_sec', array(
    'title'    => __( 'First Custom Section', 'bizz-ecommerce' ),
    'panel'    => 'bizz-ecommerce-panel-frontpage',
    'priority' => 4,
  ));
$wp_customize->add_section( $bizz_ecommerce_1_custom_sec );

$bizz_ecommerce_2_custom_sec = new Bizz_Ecommerce_WP_Customize_Section( $wp_customize, 'bizz_ecommerce_2_custom_sec', array(
    'title'    => __( 'Second Custom Section', 'bizz-ecommerce' ),
    'panel'    => 'bizz-ecommerce-panel-frontpage',
    'priority' => 4,
  ));
$wp_customize->add_section( $bizz_ecommerce_2_custom_sec );

$bizz_ecommerce_3_custom_sec = new Bizz_Ecommerce_WP_Customize_Section( $wp_customize, 'bizz_ecommerce_3_custom_sec', array(
    'title'    => __( 'Third Custom Section', 'bizz-ecommerce' ),
    'panel'    => 'bizz-ecommerce-panel-frontpage',
    'priority' => 4,
  ));
$wp_customize->add_section( $bizz_ecommerce_3_custom_sec );

$bizz_ecommerce_4_custom_sec = new Bizz_Ecommerce_WP_Customize_Section( $wp_customize, 'bizz_ecommerce_4_custom_sec', array(
    'title'    => __( 'Fourth Custom Section', 'bizz-ecommerce' ),
    'panel'    => 'bizz-ecommerce-panel-frontpage',
    'priority' => 4,
  ));
$wp_customize->add_section( $bizz_ecommerce_4_custom_sec );
//section ordering
$bizz_ecommerce_section_order = new Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-section-order', array(
    'title'    => __('Section Ordering', 'bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-frontpage',
    'priority' => 6,
));
$wp_customize->add_section($bizz_ecommerce_section_order);
/******************/
// Color Option
/******************/
$wp_customize->add_panel( 'bizz-ecommerce-panel-color-background', array(
        'priority' => 22,
        'title'    => __( 'Total Color & BG Options', 'bizz-ecommerce' ),
    ) );
// Section gloab color and background
$wp_customize->add_section('bizz-ecommerce-gloabal-color', array(
    'title'    => __('Global Colors', 'bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'priority' => 1,
));
//header
$bizz_ecommerce_header_color = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-header-color', array(
    'title'    => __('Header', 'bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'priority' => 1,
));
$wp_customize->add_section( $bizz_ecommerce_header_color );
$bizz_ecommerce_abv_header_clr = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-abv-header-clr', array(
    'title'    => __('Above Header','bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-header-color',
    'priority' => 1,
));
$wp_customize->add_section( $bizz_ecommerce_abv_header_clr);

$bizz_ecommerce_main_header_clr = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-main-header-clr', array(
    'title'    => __('Main Header','bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-header-color',
    'priority' => 2,
));
$wp_customize->add_section( $bizz_ecommerce_main_header_clr);

$bizz_ecommerce_below_header_clr = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-below-header-clr', array(
    'title'    => __('Below Header','bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-header-color',
    'priority' => 3,
));
$wp_customize->add_section( $bizz_ecommerce_below_header_clr);

$bizz_ecommerce_icon_header_clr = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-icon-header-clr', array(
    'title'    => __('Square Icon','bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-header-color',
    'priority' => 4,
));
$wp_customize->add_section( $bizz_ecommerce_icon_header_clr);
$bizz_ecommerce_menu_header_clr = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-menu-header-clr', array(
    'title'    => __('Main Menu','bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-header-color',
    'priority' => 4,
));
$wp_customize->add_section( $bizz_ecommerce_menu_header_clr);

$bizz_ecommerce_sticky_header_clr = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-sticky-header-clr', array(
    'title'    => __('Sticky Header','bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-header-color',
    'priority' => 2,
));
$wp_customize->add_section($bizz_ecommerce_sticky_header_clr);


$bizz_ecommerce_mobile_pan_clr = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-mobile-pan-clr', array(
    'title'    => __('Mobile','bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-header-color',
    'priority' => 2,
));
$wp_customize->add_section($bizz_ecommerce_mobile_pan_clr);

$bizz_ecommerce_canvas_pan_clr = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-canvas-pan-clr', array(
    'title'    => __('Off Canvas Sidebar','bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-header-color',
    'priority' => 2,
));
$wp_customize->add_section($bizz_ecommerce_canvas_pan_clr);

$bizz_ecommerce_main_header_header_clr = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-main-header-header-clr', array(
    'title'    => __('Header','bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-main-header-clr',
    'priority' => 2,
));
$wp_customize->add_section($bizz_ecommerce_main_header_header_clr);

// main-menu
$bizz_ecommerce_main_header_menu_clr = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-main-header-menu-clr', array(
    'title'    => __('Main Menu','bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-main-header-clr',
    'priority' => 2,
));
$wp_customize->add_section($bizz_ecommerce_main_header_menu_clr);

// header category
$bizz_ecommerce_main_header_cat_clr = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-main-header-cat-clr', array(
    'title'    => __('Category','bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-main-header-clr',
    'priority' => 3,
));
$wp_customize->add_section($bizz_ecommerce_main_header_cat_clr);
// header search
$bizz_ecommerce_main_header_srch_clr = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-main-header-srch-clr', array(
    'title'    => __('Search','bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-main-header-clr',
    'priority' => 4,
));
$wp_customize->add_section($bizz_ecommerce_main_header_srch_clr);
//Shop Icon
$bizz_ecommerce_main_header_shp_icon = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-main-header-shp-icon', array(
    'title'    => __('Shop Icon','bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-main-header-clr',
    'priority' => 5,
));
$wp_customize->add_section($bizz_ecommerce_main_header_shp_icon);
/****************/
//Sidebar
/****************/
$bizz_ecommerce_sidebar_color = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-sidebar-color', array(
    'title'    => __('Sidebar', 'bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'priority' => 1,
));
$wp_customize->add_section( $bizz_ecommerce_sidebar_color );
/****************/
//footer
/****************/
$bizz_ecommerce_footer_color = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-footer-color', array(
    'title'    => __('Footer', 'bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'priority' => 1,
));
$wp_customize->add_section( $bizz_ecommerce_footer_color );

$bizz_ecommerce_abv_footer_clr = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-abv-footer-clr', array(
    'title'    => __('Above Footer','bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-footer-color',
    'priority' => 1,
));
$wp_customize->add_section( $bizz_ecommerce_abv_footer_clr);

$bizz_ecommerce_footer_widget_clr = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-footer-widget-clr', array(
    'title'    => __('Footer Widget','bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-footer-color',
    'priority' => 2,
));
$wp_customize->add_section($bizz_ecommerce_footer_widget_clr);

$bizz_ecommerce_btm_footer_clr = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-btm-footer-clr', array(
    'title'    => __('Bottom Footer','bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-footer-color',
    'priority' => 3,
));
$wp_customize->add_section( $bizz_ecommerce_btm_footer_clr);

/****************/
//Woocommerce color
/****************/
$bizz_ecommerce_woo_color = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-woo-color', array(
    'title'    => __('Woocommerce', 'bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'priority' => 6,
));
$wp_customize->add_section( $bizz_ecommerce_woo_color );
// product
$bizz_ecommerce_woo_prdct_color = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-woo-prdct-color', array(
    'title'    => __('Product', 'bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-woo-color',
    'priority' => 1,
));
$wp_customize->add_section( $bizz_ecommerce_woo_prdct_color );
// shopping cart
$bizz_ecommerce_woo_cart_color = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-woo-cart-color', array(
    'title'    => __('Shopping Cart', 'bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-woo-color',
    'priority' => 1,
));
$wp_customize->add_section( $bizz_ecommerce_woo_cart_color );

// sale
$bizz_ecommerce_woo_prdct_sale_color = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-woo-prdct-sale-color', array(
    'title'    => __('Sale Badge', 'bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-woo-color',
    'priority' => 2,
));
$wp_customize->add_section( $bizz_ecommerce_woo_prdct_sale_color );
// single product
$bizz_ecommerce_woo_prdct_single_color = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-woo-prdct-single-color', array(
    'title'    => __('Single Product', 'bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-woo-color',
    'priority' => 3,
));
$wp_customize->add_section( $bizz_ecommerce_woo_prdct_single_color );

/*************************/
// Frontpage
/*************************/
$bizz_ecommerce_front_page_color = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-front-page-color', array(
    'title'    => __('Frontpage', 'bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'priority' => 4,
));
$wp_customize->add_section($bizz_ecommerce_front_page_color);

$bizz_ecommerce_top_slider_color = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-top-slider-color', array(
    'title'    => __('Top Slider', 'bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-front-page-color',
    'priority' => 1,
));
$wp_customize->add_section($bizz_ecommerce_top_slider_color);

$bizz_ecommerce_cat_slider_color = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-cat-slider-color', array(
    'title'    => __('Woo Category', 'bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-front-page-color',
    'priority' => 2,
));
$wp_customize->add_section($bizz_ecommerce_cat_slider_color);

$bizz_ecommerce_product_slider_color = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-product-slider-color', array(
    'title'    => __('Product Carousel', 'bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-front-page-color',
    'priority' => 3,
));
$wp_customize->add_section($bizz_ecommerce_product_slider_color);

$bizz_ecommerce_product_cat_slide_tab_color = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-product-cat-slide-tab-color', array(
    'title'    => __('Tabbed Product Carousel', 'bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-front-page-color',
    'priority' => 3,
));
$wp_customize->add_section($bizz_ecommerce_product_cat_slide_tab_color);

$bizz_ecommerce_product_list_slide_color = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-product-list-slide-color', array(
    'title'    => __('News & Blogs', 'bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-front-page-color',
    'priority' => 4,
));
$wp_customize->add_section($bizz_ecommerce_product_list_slide_color);

$bizz_ecommerce_product_list_tab_slide_color = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-product-list-tab-slide-color', array(
    'title'    => __('Tabbed Product List Carousel', 'bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-front-page-color',
    'priority' => 5,
));
$wp_customize->add_section($bizz_ecommerce_product_list_tab_slide_color);

$bizz_ecommerce_banner_color = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-banner-color', array(
    'title'    => __('Banner', 'bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-front-page-color',
    'priority' => 6,
));
$wp_customize->add_section($bizz_ecommerce_banner_color);

$bizz_ecommerce_ribbon_color = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-ribbon-color', array(
    'title'    => __('Ribbon', 'bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-front-page-color',
    'priority' => 6,
));
$wp_customize->add_section($bizz_ecommerce_ribbon_color);

$bizz_ecommerce_brand_color = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-brand-color', array(
    'title'    => __('Brand', 'bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-front-page-color',
    'priority' => 6,
));
$wp_customize->add_section($bizz_ecommerce_brand_color);

$bizz_ecommerce_highlight_color = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-highlight-color', array(
    'title'    => __('Highlight', 'bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-front-page-color',
    'priority' => 6,
));
$wp_customize->add_section($bizz_ecommerce_highlight_color);
$bizz_ecommerce_tabimgprd_color = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-tabimgprd-color', array(
    'title'    => __('Product Tab Image', 'bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-front-page-color',
    'priority' => 6,
));
$wp_customize->add_section($bizz_ecommerce_tabimgprd_color);
$bizz_ecommerce_big_featured_color = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-big-featured-color', array(
    'title'    => __('Big Featured Product', 'bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-front-page-color',
    'priority' => 6,
));
$wp_customize->add_section($bizz_ecommerce_big_featured_color);
/****************/
//custom section
/****************/
$bizz_ecommerce_custom_one_color = new Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-custom-one-color', array(
    'title'    => __('Custom Section', 'bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-front-page-color',
    'priority' => 6,
));
$wp_customize->add_section($bizz_ecommerce_custom_one_color);

$bizz_ecommerce_custom_two_color = new Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-custom-two-color', array(
    'title'    => __('Custom Section Two', 'bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-front-page-color',
    'priority' => 6,
));
$wp_customize->add_section($bizz_ecommerce_custom_two_color);

$bizz_ecommerce_custom_three_color = new Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-custom-three-color', array(
    'title'    => __('Custom Section Three', 'bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-front-page-color',
    'priority' => 6,
));
$wp_customize->add_section($bizz_ecommerce_custom_three_color);


$bizz_ecommerce_custom_four_color = new Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-custom-four-color', array(
    'title'    => __('Custom Section Four', 'bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'section'  => 'bizz-ecommerce-front-page-color',
    'priority' => 6,
));
$wp_customize->add_section($bizz_ecommerce_custom_four_color);

// pan color
$bizz_ecommerce_pan_color = new  Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-pan-color', array(
    'title'    => __('Pan / Mobile Menu Color', 'bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'priority' => 5,
));
$wp_customize->add_section( $bizz_ecommerce_pan_color);
/*********************/
// Page Content Color
/*********************/
$bizz_ecommerce_custom_page_content_color = new Bizz_Ecommerce_WP_Customize_Section($wp_customize,'bizz-ecommerce-page-content-color', array(
    'title'    => __('Content Color', 'bizz-ecommerce'),
    'panel'    => 'bizz-ecommerce-panel-color-background',
    'priority' => 2,
));
$wp_customize->add_section($bizz_ecommerce_custom_page_content_color);
/******************/
// Shop Page
/******************/
$bizz_ecommerce_woo_shop = new Bizz_Ecommerce_WP_Customize_Section( $wp_customize, 'bizz-ecommerce-woo-shop', array(
    'title'    => __( 'Product Style', 'bizz-ecommerce' ),
     'panel'    => 'woocommerce',
     'priority' => 2,
));
$wp_customize->add_section( $bizz_ecommerce_woo_shop );

$bizz_ecommerce_woo_single_product = new Bizz_Ecommerce_WP_Customize_Section( $wp_customize, 'bizz-ecommerce-woo-single-product', array(
    'title'    => __( 'Single Product', 'bizz-ecommerce' ),
     'panel'    => 'woocommerce',
     'priority' => 3,
));
$wp_customize->add_section($bizz_ecommerce_woo_single_product );

$bizz_ecommerce_woo_cart_page = new Bizz_Ecommerce_WP_Customize_Section( $wp_customize, 'bizz-ecommerce-woo-cart-page', array(
    'title'    => __( 'Cart Page', 'bizz-ecommerce' ),
     'panel'    => 'woocommerce',
     'priority' => 4,
));
$wp_customize->add_section($bizz_ecommerce_woo_cart_page);

$bizz_ecommerce_woo_shop_page = new Bizz_Ecommerce_WP_Customize_Section( $wp_customize, 'bizz-ecommerce-woo-shop-page', array(
    'title'    => __( 'Shop Page', 'bizz-ecommerce' ),
     'panel'    => 'woocommerce',
     'priority' => 4,
));
$wp_customize->add_section($bizz_ecommerce_woo_shop_page);