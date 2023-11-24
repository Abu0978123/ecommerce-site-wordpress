<?php
/**
 * Buzz Ecommerce Plugin required
 *
 *
 * @package Buzz_Ecommerce
 */
function buzz_ecommerce_register_required_plugins() {
    /*
    * The list of Plugin Requird List
    */
    $plugins = array(

        array(
            'name' => esc_html__( "WooCommerce", 'buzz-ecommerce'),
            'slug' => 'woocommerce',
            'required' => false,
        ),
        array(
            'name' => esc_html__( 'YITH WooCommerce Quick View', 'buzz-ecommerce'),
            'slug' => 'yith-woocommerce-quick-view',
            'required' => false,
        ),
        array(
            'name' => esc_html__( 'YITH WooCommerce Compare', 'buzz-ecommerce'),
            'slug' => 'yith-woocommerce-compare',
            'required' => false,
        ),
        array(
            'name' => esc_html__( 'YITH WooCommerce Wishlist', 'buzz-ecommerce'),
            'slug' => 'yith-woocommerce-wishlist',
            'required' => false,
        ),
        array(
            'name' => esc_html__( 'Easy Google Fonts', 'buzz-ecommerce'),
            'slug' => 'easy-google-fonts',
            'required' => false,
        ),
         array(
            'name' => esc_html__( 'Contact Form 7', 'buzz-ecommerce'),
            'slug' => 'contact-form-7',
            'required' => false,
         ),
          array(
            'name' => esc_html__( 'One Click Demo Import', 'buzz-ecommerce'),
            'slug' => 'one-click-demo-import',
            'required' => false,
         ),
          array(
            'name' => esc_html__( 'Elementor Page Builder', 'buzz-ecommerce'),
            'slug' => 'elementor',
            'required' => false,
         ),

    );

    /*
        * Array of configuration settings. Amend each line as needed. 
    */
    $config = array(
        'id'           => 'buzz-ecommerce',                 
        'default_path' => '',                      
        'menu'         => 'tgmpa-install-plugins', 
        'has_notices'  => true,                    
        'dismissable'  => true,                    
        'dismiss_msg'  => '',                       
        'is_automatic' => false,                   
        'message'      => '',                      
        
    );

    tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register','buzz_ecommerce_register_required_plugins' );//Register
