<?php
namespace Woolentor\Modules\Popup_Builder;

use Woolentor\Modules\Popup_Builder\Repeater_Helper;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Ajax_Actions{
    private static $_instance = null;

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
        // Generate sub_name options by name input value.
        add_action( 'wp_ajax_wlpb_generate_sub_name', array( $this, 'wlpb_generate_sub_name_cb' ) );
        add_action( 'wp_ajax_nopriv_wlpb_generate_sub_name', array( $this, 'wlpb_generate_sub_name_cb' ) );

        // Generate sub_id options by name and sub_name input value.
        add_action( 'wp_ajax_wlpb_generate_sub_id', array( $this, 'wlpb_generate_sub_id_cb' ) );
        add_action( 'wp_ajax_nopriv_wlpb_generate_sub_id', array( $this, 'wlpb_generate_sub_id_cb' ) );

        // Save popup data.
        add_action( 'wp_ajax_wlpb_save_popup_settings', array( $this, 'save_popup_settings' ) );
        add_action( 'wp_ajax_nopriv_wlpb_save_popup_settings', array( $this, 'save_popup_settings' ) );
    }

    public function wlpb_generate_sub_name_cb(){
        // Verify nonce
        check_ajax_referer( 'wlpb_nonce', 'nonce' );

        $post_data   = wp_unslash($_POST);
        $name        = $post_data['name'];
        $return_data = '';

        // Get sub_name options with html by name.
        if( $name != 'entire_site' ){
            $return_data = Repeater_Helper::get_instance()->get_options_by_name($name, 'html');
        }
    
        wp_send_json_success( $return_data );
    }

    public function wlpb_generate_sub_id_cb(){
        // Verify nonce
        check_ajax_referer( 'wlpb_nonce', 'nonce' );

        $post_data      = wp_unslash($_POST);
        $name           = sanitize_text_field($post_data['name']);
        $sub_name       = sanitize_text_field($post_data['sub_name']);
        $return_data    = '';

        // Remove prefix (in) from sub name.
        $sub_name = str_replace( 'in_', '', $sub_name );

        // Get sub_id options html from sub_name.
        if( post_type_exists( $sub_name ) || taxonomy_exists( $sub_name ) ){
            $return_data = Repeater_Helper::get_instance()->get_options_by_sub_name($sub_name, 'html');
        }
    
        wp_send_json_success( $return_data );
    }

    public function save_popup_settings(){
        // Verify nonce
        check_ajax_referer( 'wlpb_nonce', 'nonce' );

        $post_data   = wp_unslash($_POST);
        if( !isset($post_data['popup_id']) ){
            return;
        }
        $popup_id    = sanitize_text_field($post_data['popup_id']);

        // Remove these elements form $post_data array, because these are not popup settings.
        unset($post_data['action']);
        unset($post_data['popup_id']);
        unset($post_data['nonce']);

        if( !Helper::is_pro_version_active() ){
            $post_data['triggers']['on_click']        = '';
            $post_data['triggers']['on_click_element']  = '';
            $post_data['triggers']['on_click_selector'] = '';
            $post_data['triggers']['clicks_count']    = '';
            $post_data['triggers']['on_inactivity']   = '';
            $post_data['triggers']['inactivity_time'] = '';
            $post_data['triggers']['on_exit_intent']  = '';

            $post_data['dismiss_on_overlay_click']    = '';
            $post_data['disable_overlay']             = '';
            $post_data['close_after_page_scroll']     = '';
            $post_data['dismiss_automatically']       = '';
            $post_data['dismiss_automatically_delay'] = '';
            $post_data['animation_in_duration']       = '';

            $post_data['popup_vertical_position']           = 'center';
            $post_data['popup_horizontal_position']         = 'center';
            $post_data['close_button_vertical_position']    = '';
            $post_data['close_button_horizontal_position']  = '';

            // Advanced
            $post_data['advanced']['url_match']        = '';
            $post_data['advanced']['show_on_devices']  = '';
            $post_data['advanced']['show_on_browsers'] = '';
        }

        // Sanitize $post_data array.
        $post_data = Helper::get_instance()->wlpb_clean( $post_data );

        // Save popup data.
        $status = update_post_meta( $popup_id, '_wlpb_popup_seetings', $post_data );

        wp_send_json_success( $status );
    }

}