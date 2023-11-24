<?php

namespace WooLentor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* Widgets Control
*/
class Widgets_Control{
    
    private static $instance = null;
    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    function __construct(){
        $this->init();
    }

    public function init() {

        // Register custom category
        add_action( 'elementor/elements/categories_registered', [ $this, 'add_category' ] );

        // Init Widgets
        add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );

    }

    // Add custom category.
    public function add_category( $elements_manager ) {
        
        $elements_manager->add_category(
            'woolentor-addons',
            [
               'title'  => __( 'ShopLentor','woolentor'),
                'icon' => 'fa fa-plug',
            ]
        );

        $elements_manager->add_category(
            'woolentor-addons-pro',
            [
               'title'  => __( 'ShopLentor Pro','woolentor-pro'),
                'icon' => 'fa fa-plug',
            ]
        );

        // Register In top panel if exist woolentor post type
        if( get_post_type() === 'woolentor-template' ){
            $reorder_cats = function( $categories ){
                uksort( $this->categories, function( $keyOne, $keyTwo ){
                    if( substr( $keyOne, 0, 10 ) == 'woolentor-'){
                        return -1;
                    }
                    if( substr( $keyTwo, 0, 10 ) == 'woolentor-'){
                        return 1;
                    }
                    return 0;
                });

            };
            $reorder_cats->call( $elements_manager, [ 'woolentor-addons', 'woolentor-addons-pro' ] );
        }

    }

    // Widgets Register
    public function init_widgets(){

        if( get_post_type() === 'woolentor-template' ){
            $tmpType  = $this->get_template_type( get_post_meta( get_the_ID(), 'woolentor_template_meta_type', true ) );
        }else{
            $tmpType = '';
        }

        foreach ( $this->widget_list_manager( $tmpType ) as $element_key => $element ){

            if ( isset( $element['location'] ) ) {
                $widget_file = trailingslashit( $element['location'] ) . $element_key . '.php';
            } else {
                $widget_path = ( $element['is_pro'] == true ) ? WOOLENTOR_ADDONS_PL_PATH_PRO : WOOLENTOR_ADDONS_PL_PATH;
                $widget_file = $widget_path.'includes/addons/'.$element_key.'.php';
            }

            if (  ( woolentor_get_option( $element_key, 'woolentor_elements_tabs', 'on' ) === 'on' ) && file_exists( $widget_file ) ){
                require_once( $widget_file );

                $widget_class = '\Elementor\\Woolentor_'. self::generate_classname( $element_key ) .'_Widget';
                if ( class_exists( $widget_class ) ) {

                    if ( woolentor_is_elementor_version( '>=', '3.5.0' ) ) {
                        woolentor_elementor()->widgets_manager->register( new $widget_class() );
                    }else{
                        woolentor_elementor()->widgets_manager->register_widget_type( new $widget_class() );
                    }

                }

            }

        }
        
    }

    // Generate Class name
    public static function generate_classname( $element_key ) {
		$class_name = explode( '_', $element_key );
		$class_name = array_map( 'ucfirst', $class_name );
		$class_name = implode( '_', $class_name );

		return $class_name;
	}

    /* Widget list generate */
    public function widget_list_manager( $tmpType ){

        $is_builder = ( woolentor_get_option( 'enablecustomlayout', 'woolentor_woo_template_tabs', 'on' ) == 'on' ) ? true : false;

        $common_widget  = $this->widget_list()['common'];
        $builder_common = ( $is_builder == true ) ? $this->widget_list()['builder_common'] : [];
        $template_wise  = ( $is_builder == true && $tmpType !== '' && array_key_exists( $tmpType, $this->widget_list() ) ) ? $this->widget_list()[$tmpType] : [];

        $generate_list = [];

        if( $tmpType === '' ){
            foreach( $this->widget_list() as $widget_list_key => $widget_list ){

                if( $is_builder == false ){
                    $generate_list = $common_widget;
                }else{
                    $generate_list += $widget_list;
                }
                
            }
        }else{
            $generate_list = array_merge( $template_wise, $common_widget, $builder_common );
        }

        return apply_filters( 'woolentor_load_widget_list', $generate_list, $this->widget_list(), $tmpType );

    }

    /* Manage Template type */
    public function get_template_type( $type ){

        switch ( $type ) {

            case 'single':
            case 'quickview':
                $template_type = 'single';
                break;

            case 'shop':
            case 'archive':
                $template_type = 'shop';
                break;

            case 'cart':
                $template_type = 'cart';
                break;

            case 'emptycart':
                $template_type = 'emptycart';
                break;

            case 'minicart':
                $template_type = 'minicart';
                break;

            case 'checkout':
            case 'checkouttop':
                $template_type = 'checkout';
                break;

            case 'myaccount':
            case 'myaccountlogin':
            case 'dashboard':
            case 'orders':
            case 'downloads':
            case 'edit-address':
            case 'edit-account':
                $template_type = 'myaccount';
                break;
            
            case 'lost-password':
            case 'reset-password':
                $template_type = 'lostpassword';
                break;

            case 'thankyou':
                $template_type = 'thankyou';
                break;

            default:
                $template_type = '';

        }

        if ( 0 === strpos($type, 'email') ) {
            $template_type = 'emails';
        }

        return $template_type;

    }

    /* Widget List */
    public function widget_list(){

        $is_pro = is_plugin_active('woolentor-addons-pro/woolentor_addons_pro.php') ? true : false;

        $widget_list = [
            'common' => [
                'universal_product' => [
                    'title'    => esc_html__('Universal Product','woolentor'),
                    'is_pro'   => $is_pro,
                ],
                'product_tabs' => [
                    'title'    => esc_html__('Product Tabs','woolentor'),
                    'is_pro'   => false,
                ],
                'add_banner' => [
                    'title'     => esc_html__('Adds Banner','woolentor'),
                    'is_pro'    => false,
                ],
                'special_day_offer' => [
                    'title'     => esc_html__('Special Day Offer','woolentor'),
                    'is_pro'    => false,
                ],
                'wb_image_marker' => [
                    'title'     => esc_html__('Image Marker','woolentor'),
                    'is_pro'    => false,
                ],
                'wl_store_features' => [
                    'title'     => esc_html__('Store Features','woolentor'),
                    'is_pro'    => false,
                ],
                'wl_faq' => [
                    'title'     => esc_html__('Faq','woolentor'),
                    'is_pro'    => false,
                ],
                'wl_category_grid' => [
                    'title'     => esc_html__('Category Grid','woolentor'),
                    'is_pro'    => false,
                ],
                'wl_onepage_slider' => [
                    'title'     => esc_html__('One Page Slider','woolentor'),
                    'is_pro'    => false,
                ],
                'product_curvy' => [
                    'title'     => esc_html__('Product Curvy','woolentor'),
                    'is_pro'    => false,
                ],
                'product_image_accordion' => [
                    'title'     => esc_html__('Product Image Accordion','woolentor'),
                    'is_pro'    => false,
                ],
                'product_accordion' => [
                    'title'     => esc_html__('Product Accordion'),
                    'is_pro'    => false,
                ],
                'wl_archive_title' => [
                    'title'    => esc_html__('Archive Title','woolentor'),
                    'is_pro'   => false,
                ],
                'wl_breadcrumbs' => [
                    'title'    => esc_html__('Breadcrumbs','woolentor'),
                    'is_pro'   => false,
                ],
                'wl_recently_viewed_products' => [
                    'title'    => esc_html__('Recently Viewed Products','woolentor'),
                    'is_pro'   => false,
                ],
                'wl_category' => [
                    'title'    => esc_html__('Category','woolentor'),
                    'is_pro'   => $is_pro,
                ],
                'wl_brand' => [
                    'title'    => esc_html__('Brand','woolentor'),
                    'is_pro'   => $is_pro,
                ],
                'wb_customer_review' => [
                    'title'    => esc_html__('Customer Review','woolentor'),
                    'is_pro'   => $is_pro,
                ],
                'wl_testimonial' => [
                    'title'    => esc_html__('Testimonial','woolentor'),
                    'is_pro'   => $is_pro,
                ]

            ],

            'builder_common' => [

                'wl_product_filter' => [
                    'title'    => esc_html__('Product Filter','woolentor'),
                    'is_pro'   => $is_pro,
                ],
                'wl_product_horizontal_filter' => [
                    'title'    => esc_html__('Horizontal Product Filter','woolentor'),
                    'is_pro'   => $is_pro,
                ],
                'wb_product_call_for_price' => [
                    'title'    => esc_html__('Product Call for Price','woolentor'),
                    'is_pro'   => false,
                ],
                'wb_product_suggest_price' => [
                    'title'    => esc_html__('Product suggest price','woolentor'),
                    'is_pro'   => false,
                ],

            ],

            'single' => [
                'wb_product_title' => [
                    'title'    => esc_html__('Product Title','woolentor'),
                    'is_pro'   => false,
                ],
                'wb_product_related' => [
                    'title'    => esc_html__('Related Product','woolentor'),
                    'is_pro'   => false,
                ],
                'wb_product_add_to_cart'=>[
                    'title'    => esc_html__('Product Add To Cart','woolentor'),
                    'is_pro'   => false,
                ],
                'wb_product_additional_information' => [
                    'title'    => esc_html__('Product Additional Info','woolentor'),
                    'is_pro'   => false,
                ],
                'wb_product_data_tab' => [
                    'title'    => esc_html__('Product Data tabs','woolentor'),
                    'is_pro'   => false,
                ],
                'wb_product_description' => [
                    'title'    => esc_html__('Product Description','woolentor'),
                    'is_pro'   => false,
                ],
                'wb_product_short_description' => [
                    'title'    => esc_html__('Product short description','woolentor'),
                    'is_pro'   => false,
                ],
                'wb_product_price' => [
                    'title'    => esc_html__('Product Price','woolentor'),
                    'is_pro'   => false,
                ],
                'wb_product_rating' => [
                    'title'    => esc_html__('Product rating','woolentor'),
                    'is_pro'   => false,
                ],
                'wb_product_reviews' => [
                    'title'    => esc_html__('Product reviews','woolentor'),
                    'is_pro'   => false,
                ],
                'wb_product_image' => [
                    'title'    => esc_html__('Product Image','woolentor'),
                    'is_pro'   => false,
                ],
                'wl_product_video_gallery' => [
                    'title'    => esc_html__('Product Video Gallery','woolentor'),
                    'is_pro'   => false,
                ],
                'wb_product_upsell' => [
                    'title'    => esc_html__('Product Upsell','woolentor'),
                    'is_pro'   => false,
                ],
                'wb_product_stock' => [
                    'title'    => esc_html__('Product Stock','woolentor'),
                    'is_pro'   => false,
                ],
                'wb_product_meta' => [
                    'title'    => esc_html__('Product Meta','woolentor'),
                    'is_pro'   => false,
                ],
                'wb_product_sku' => [
                    'title'    => esc_html__('Product SKU','woolentor'),
                    'is_pro'   => false,
                ],
                'wb_product_tags' => [
                    'title'    => esc_html__('Product Tags','woolentor'),
                    'is_pro'   => false,
                ],
                'wb_product_categories' => [
                    'title'    => esc_html__('Product Categories','woolentor'),
                    'is_pro'   => false,
                ],
                'wb_product_qr_code' => [
                    'title'    => esc_html__('Product QR Code','woolentor'),
                    'is_pro'   => false,
                ],
            ],

            'shop' => [
                'wb_archive_product' => [
                    'title'    => esc_html__('Archive Layout Default','woolentor'),
                    'is_pro'   => false,
                ],
                'wb_archive_result_count' => [
                    'title'    => esc_html__('Archive Result Count','woolentor'),
                    'is_pro'   => false,
                ],
                'wb_archive_catalog_ordering' => [
                    'title'    => esc_html__('Archive Catalog Ordering','woolentor'),
                    'is_pro'   => false,
                ],
            ]

        ];

        if( woolentor_get_option('enable', 'woolentor_flash_sale_settings') == 'on' ){
            $widget_list['common']['product_flash_sale'] = [
                'title'    => esc_html__('WL: Product Flash Sale','woolentor'),
                'is_pro'   => false,
            ];
        }

        if( class_exists('WishSuite_Base') || class_exists('Woolentor_WishSuite_Base') ){
            $widget_list['common']['wb_wishsuite_table'] = [
                'title'    => esc_html__('WishSuite Table','woolentor'),
                'is_pro'   => false,
            ];
            $widget_list['common']['wb_wishsuite_counter'] = [
                'title'    => esc_html__('WishSuite Counter','woolentor'),
                'is_pro'   => false,
            ];
        }

        if( class_exists('Ever_Compare') || class_exists('Woolentor_Ever_Compare') ){
            $widget_list['common']['wb_ever_compare_table'] = [
                'title'    => esc_html__('EverCompare','woolentor'),
                'is_pro'   => false,
            ];
        }

        if( is_plugin_active('just-tables/just-tables.php') || is_plugin_active('just-tables-pro/just-tables-pro.php') ){
            $widget_list['common']['wb_just_table'] = [
                'title'    => esc_html__('JustTable','woolentor'),
                'is_pro'   => false,
            ];
        }

        if( is_plugin_active('whols/whols.php') || is_plugin_active('whols-pro/whols-pro.php') ){
            $widget_list['common']['wb_whols'] = [
                'title'    => esc_html__('Whols','woolentor'),
                'is_pro'   => false,
            ];
        }

        if( is_plugin_active('wc-multi-currency/wcmilticurrency.php') || is_plugin_active('multicurrencypro/multicurrencypro.php') ){
            $widget_list['common']['wb_wc_multicurrency'] = [
                'title'    => esc_html__('WC Multicurrency','woolentor'),
                'is_pro'   => false,
            ];
        }

        return apply_filters( 'woolentor_widget_list', $widget_list );


    }

    /**
     * Promotional Widget List
     *
     * @return void
     */
    public static function promotional_widget_list(){
        $action_url = 'https://woolentor.com/pricing/?utm_source=admin&utm_medium=notice&utm_campaign=free';

        $promotional_widgets = [
            [
                'name'  => 'woolentor-product-grid',
                'title' => __('WL: Product Grid','woolentor'),
                'icon'  => 'eicon-products',
                'action_url' => $action_url,
            ],
            [
                'name'  => 'woolentor-product-expanding-grid',
                'title' => __('WL: Product Expanding Grid','woolentor'),
                'icon'  => 'eicon-products',
                'action_url' => $action_url,
            ],
            [
                'name'  => 'woolentor-product-filterable-grid',
                'title' => __( 'WL: Filterable Product Grid', 'woolentor' ),
                'icon'  => 'eicon-products',
                'action_url' => $action_url,
            ],
            [
                'name'  => 'woolentor-advance-filter',
                'title' => __( 'WL: Advance Product Filter', 'woolentor' ),
                'icon'  => 'eicon-user-preferences',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your shop/archive page template filter widget.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-product-archive-custom',
                'title' => __( 'WL: Product Archive Layout (Custom)', 'woolentor' ),
                'icon'  => 'eicon-products',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your shop page template.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-advance-product-image',
                'title' => __( 'WL: Advance Product Image', 'woolentor' ),
                'icon'  => 'eicon-product-images',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your single product page template image widget.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-product-image-with-zoom',
                'title' => __( 'WL: Product Image With Zoom', 'woolentor' ),
                'icon'  => 'eicon-product-images',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your single product page template image.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-product-social-share',
                'title' => __( 'WL: Product Social Share', 'woolentor' ),
                'icon'  => 'eicon-social-icons',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your single product page template.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-product-stock-progressbar',
                'title' => __( 'WL: Available Stock Progressbar', 'woolentor' ),
                'icon'  => 'eicon-skill-bar',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your single product page template.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-product-sale-schedule',
                'title' => __( 'WL: Product Sale Schedule', 'woolentor' ),
                'icon'  => 'eicon-countdown',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your single product page template.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-related-product-custom',
                'title' => __( 'WL: Related Product layout(Custom)', 'woolentor' ),
                'icon'  => 'eicon-cart-light',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your single product page template related product widget.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-upsell-product-custom',
                'title' => __( 'WL: Upsell Product layout(Custom)', 'woolentor' ),
                'icon'  => 'eicon-cart-light',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your single product page template upsell product widget.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-product-navigation',
                'title' => __( 'WL: Single Product Navigation', 'woolentor' ),
                'icon'  => 'eicon-post-navigation',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your single product page template.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-cart-table',
                'title' => __( 'WL: Cart Table', 'woolentor' ),
                'icon'  => 'eicon-product-breadcrumbs',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your cart page.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-cart-table-list',
                'title' => __( 'WL: Cart Table(List Style)', 'woolentor' ),
                'icon'  => 'eicon-product-breadcrumbs',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your cart page.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-cart-total',
                'title' => __( 'WL: Cart Total', 'woolentor' ),
                'icon'  => 'eicon-woocommerce',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your cart page.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-cart-cross-sell',
                'title' => __( 'WL: Cross Sell', 'woolentor' ),
                'icon'  => 'eicon-woocommerce',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your cart page.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-cart-empty-message',
                'title' => __( 'WL: Empty Cart Message', 'woolentor' ),
                'icon'  => 'eicon-woocommerce',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your empty cart page.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-return-to-shop',
                'title' => __( 'WL: Return To Shop Button', 'woolentor' ),
                'icon'  => 'eicon-woocommerce',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your cart / empty cart page.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-checkout-billing-form',
                'title' => __( 'WL: Checkout Billing Form', 'woolentor' ),
                'icon'  => 'eicon-form-horizontal',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your checkout page.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-checkout-shipping-form',
                'title' => __( 'WL: Checkout Shipping Form', 'woolentor' ),
                'icon'  => 'eicon-form-horizontal',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your checkout page.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-checkout-additional-form',
                'title' => __( 'WL: Checkout Additional info Form', 'woolentor' ),
                'icon'  => 'eicon-form-horizontal',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your checkout page.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-checkout-coupon-form',
                'title' => __( 'WL: Coupon Form', 'woolentor' ),
                'icon'  => 'eicon-form-horizontal',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your checkout page.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-checkout-login-form',
                'title' => __( 'WL: Login Form', 'woolentor' ),
                'icon'  => 'eicon-form-horizontal',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your checkout page.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-checkout-payment-method',
                'title' => __( 'WL: Checkout Payment Method', 'woolentor' ),
                'icon'  => 'eicon-woocommerce',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your checkout page.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-checkout-shipping-method',
                'title' => __( 'WL: Checkout Shipping Method', 'woolentor' ),
                'icon'  => 'eicon-editor-list-ul',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your checkout page.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-checkout-multi-step',
                'title' => __( 'WL: Multi Step Checkout', 'woolentor' ),
                'icon'  => 'eicon-form-horizontal',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your checkout page.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-myaccount',
                'title' => __( 'WL: My Account', 'woolentor' ),
                'icon'  => 'eicon-elementor',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your myaccount page.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-myaccount-dashboard',
                'title' => __( 'WL: My Account Dashboard', 'woolentor' ),
                'icon'  => 'eicon-elementor',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your myaccount page.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-myaccount-address',
                'title' => __( 'WL: My Account Address', 'woolentor' ),
                'icon'  => 'eicon-woocommerce',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your myaccount page.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-myaccount-download',
                'title' => __( 'WL: My Account Download', 'woolentor' ),
                'icon'  => 'eicon-download-button',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your myaccount page.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-myaccount-edit-account',
                'title' => __( 'WL: My Account Edit', 'woolentor' ),
                'icon'  => 'eicon-edit',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your myaccount page.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-myaccount-login-form',
                'title' => __( 'WL: My Account Login Form', 'woolentor' ),
                'icon'  => 'eicon-form-horizontal',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your myaccount page.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-myaccount-logout',
                'title' => __( 'WL: My Account Logout', 'woolentor' ),
                'icon'  => 'eicon-sign-out',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your myaccount page.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-myaccount-lost-password-form',
                'title' => __( 'WL: My Account Lost Password Form', 'woolentor' ),
                'icon'  => 'eicon-form-horizontal',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your myaccount page.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-myaccount-navigation',
                'title' => __( 'WL: My Account Navigation', 'woolentor' ),
                'icon'  => 'eicon-elementor',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your myaccount page.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-myaccount-order',
                'title' => __( 'WL: My Account Order', 'woolentor' ),
                'icon'  => 'eicon-woocommerce',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your myaccount page.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-myaccount-register-form',
                'title' => __( 'WL: My Account Register Form', 'woolentor' ),
                'icon'  => 'eicon-form-horizontal',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your myaccount page.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-myaccount-reset-password-form',
                'title' => __( 'WL: My Account Reset Password Form', 'woolentor' ),
                'icon'  => 'eicon-form-horizontal',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your myaccount page.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-thankyou-customer-address',
                'title' => __( 'WL: Customer Address Details', 'woolentor' ),
                'icon'  => 'eicon-woocommerce',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your thankyou page.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-thankyou-order-details',
                'title' => __( 'WL: Order Details', 'woolentor' ),
                'icon'  => 'eicon-woocommerce',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your thankyou page.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-thankyou-order',
                'title' => __( 'WL: Thank You Order', 'woolentor' ),
                'icon'  => 'eicon-woocommerce',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of your thankyou page.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-mini-cart',
                'title' => __( 'WL: Mini Cart', 'woolentor' ),
                'icon'  => 'eicon-cart-light',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of build side mini cart template.', 'woolentor' ),
            ],
            [
                'name'  => 'woolentor-quickview-image',
                'title' => __( 'WL: Quickview Product Image', 'woolentor' ),
                'icon'  => 'eicon-product-images',
                'action_url' => $action_url,
                'description' => __( 'Use %s widget and numerous advanced features to enhance the functionality of build quickview.', 'woolentor' ),
            ],
        ];

        return apply_filters('woolentor_promotional_widget_list', $promotional_widgets );
    }


}

Widgets_Control::instance();