<?php
/**
 * Recommended plugins
 *
 * @package bizz-ecommerce
 */

if ( ! function_exists( 'bizz_ecommerce_recommended_plugins' ) ) :

    /**
     * Recommend plugins.
     *
     * @since 1.0.0
     */
    function bizz_ecommerce_recommended_plugins() {

        $plugins = array(              
          
            array(
                'name'     => esc_html__( 'Testerwp Ecommerce Companion', 'bizz-ecommerce' ),
                'slug'     => 'testerwp-ecommerce-companion',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'One Click Demo Import', 'bizz-ecommerce' ),
                'slug'     => 'one-click-demo-import',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'WooCommerce', 'bizz-ecommerce' ),
                'slug'     => 'woocommerce',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'YITH WooCommerce Wishlist', 'bizz-ecommerce' ),
                'slug'     => 'yith-woocommerce-wishlist',
                'required' => false,
            ),
        );

        tgmpa( $plugins );

    }

endif;

add_action( 'tgmpa_register', 'bizz_ecommerce_recommended_plugins' );