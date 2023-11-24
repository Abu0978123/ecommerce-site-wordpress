<?php
namespace Woolentor\Modules\Popup_Builder;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Assets{
    private static $_instance = null;

    private $version;

    /**
     * Get Instance
     */
    public static function get_instance(){
        if( is_null( self::$_instance ) ){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor
     */
    function __construct(){
        add_action( 'wp_enqueue_scripts', array($this, 'frontend_scripts') );
        add_action( 'admin_enqueue_scripts', array($this, 'admin_scripts') );
        add_action( 'elementor/editor/after_enqueue_scripts', array($this, 'admin_scripts') );

        // Set time as the version for development mode.
        if( defined('WP_DEBUG') && WP_DEBUG ){
            $this->version = time();
        } else {
            $this->version = WOOLENTOR_VERSION;
        }
    }

    /**
     * Public assets.
     */
    public function frontend_scripts(){
        // Register frontend Scripts. Enqueued in the frontend, while rendering the popup markup.
        wp_register_style( 'wlpb-frontend', MODULE_ASSETS . '/css/frontend.css', array('woolentor-animate'), $this->version );
        wp_register_script( 'wlpb-frontend', MODULE_ASSETS . '/js/frontend.js', array( 'jquery' ), $this->version, true );
        wp_register_script( 'js-cookie', MODULE_ASSETS . '/js/js.cookie.js', array( 'jquery' ), $this->version, true );
    }

    /**
     * Admin assets.
     */
    public function admin_scripts(){
        // Dependencies.
        wp_enqueue_script( 'select2', WOOLENTOR_ADDONS_PL_URL . 'includes/admin/assets/lib/js/select2.min.js', array( 'jquery' ), $this->version, TRUE );
        wp_enqueue_style( 'woolentor-select2' );

        // Admin Style.
        wp_register_style( 'wlpb-admin', MODULE_ASSETS . '/css/admin.css', array(), $this->version );

        wp_register_script( 'js-cookie', MODULE_ASSETS . '/js/js.cookie.js', array( 'jquery' ), $this->version, true );

        // Admin Script.
        wp_register_script( 'wlpb-admin', MODULE_ASSETS . '/js/admin.js', array( 'jquery', 'wp-util' ), $this->version, true );

        if( $this->is_popup_admin_area() ){
            wp_enqueue_style( 'wlpb-admin' );
            wp_enqueue_script( 'wlpb-admin' );
        }

        if( $this->is_popup_post_edit_screen() ){
            // Dependencies for the admin popup settings design.
            // common for .updating-message class.
            wp_enqueue_style( 'woolentor-admin', WOOLENTOR_ADDONS_PL_URL . 'includes/admin/assets/css/woolentor-admin.css', array('common'), $this->version );
            wp_enqueue_style( 'woolentor-template-edit-manager', WOOLENTOR_ADDONS_PL_URL . 'includes/admin/assets/css/template_edit_manager.css', array(), $this->version );
        }

        // Localization.
        $localize_vars = array();
        $localize_vars['ajax_url']  = admin_url( 'admin-ajax.php' );
        $localize_vars['nonce']	    = wp_create_nonce('wlpb_nonce');
        $localize_vars['label_popup_settings']	    = __('Popup Settings', 'woolentor');
        wp_localize_script( 'wlpb-admin', 'wlpb_params', $localize_vars );
    }

    public function is_popup_post_edit_screen(){
        $screen         = get_current_screen();
        $template_type  = get_post_meta(get_the_id(), 'woolentor_template_meta_type', true);

        if( !empty( $_GET['post'] ) && $template_type == 'popup' ){
            return true;
        }

        return false;
    }

    public function is_popup_admin_area(){
        $screen         = get_current_screen();
        $template_type  = get_post_meta(get_the_id(), 'woolentor_template_meta_type', true);

        if( $screen->id == 'edit-woolentor-template' || $template_type == 'popup' ){
            return true;
        }

        return false;
    }
}