<?php
namespace Woolentor\Modules\Popup_Builder;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Helper{

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
     * Check if elementor is editor mode.
     * 
     * @return bool
     */
    public function is_elementor_editor(){
        if( !class_exists('\Elementor\Plugin') ){
            return false;
        }

        // Elementor is preview mode
        if( \Elementor\Plugin::$instance->preview->is_preview_mode() ){
            return true;
        }

        // For ajax support
        $server       = wp_unslash( $_SERVER );

        $referer          = !empty($server['HTTP_REFERER']) ? $server['HTTP_REFERER'] : '';
        $request_uri      = !empty($server['REQUEST_URI']) ? $server['REQUEST_URI'] : '';

        parse_str($referer, $query_str_arr);
        parse_str($request_uri, $request_uri_arr);

        if( !empty($query_str_arr['action']) && $query_str_arr['action'] == 'elementor' ||
            !empty($request_uri_arr['action']) && $request_uri_arr['action'] == 'elementor'
        ){
            return true;
        }

        return false;
    }

    /**
     * Get the preview popup id if previewing a popup.
     * 
     * @return int|string Preview popup id or empty sting.
     */
    public static function get_preview_id(){
        $preview_id = '';

        // For Native preview.
        if( isset($_GET['preview']) && !empty($_GET['preview']) ){
            $preview_id = get_queried_object_id();
        }

        // For elementor preview.
        if( isset($_GET['preview_id']) && !empty($_GET['preview_id']) ){
            $preview_id = sanitize_text_field($_GET['preview_id']);
        }

        return $preview_id;
    }
    
    /**
     * Check if current page is popup edit page.
     * Woolentor template type popup and elementor editor is popup edit page.
     * 
     * @return bool
     */
    public function is_popup_edit_page(){
        $template_type = get_post_meta(get_the_id(), 'woolentor_template_meta_type', true);
        $action = isset($_GET['action']) ? sanitize_text_field($_GET['action']) : '';

        if( in_array($action, array('edit', 'elementor')) && $template_type == 'popup' && ( is_admin() || Helper::get_instance()->is_elementor_editor() ) ){
            return true;
        }

        return false;
    }

    /**
     * Sanitize data.
     * 
     * @param var data to sanitize. Either array or string.
     * 
     * @return string
     */
    public function wlpb_clean( $var ) {
        if ( is_array( $var ) ) {
            return array_map( 'wc_clean', $var );
        } else {
            return is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
        }
    }

    /**
     * Get custom debug status for this module.
     * 
     * @return bool
     */
    public function wlpb_debug_status(){
        $debug_status = apply_filters( 'wlpb_debug', false );
        
        if( isset($_GET['wlpb_debug']) && sanitize_text_field($_GET['wlpb_debug']) ){
            $debug_status = true;
        }

        return $debug_status;
    }

    /**
     * Get dropdown posts limit.
     * 
     * @return int
     */
    public function get_dropdown_posts_limit(){
        return apply_filters( 'wlpb_dropdown_posts_limit', 250 );
    }

    public static function generate_inline_css( $popup_id, $popup_settings, $place ){
        $inline_css = '';

        $popup_area_inline_css_arr            = array();
        $popup_container_inline_css_arr       = array();
        $popup_container_inner_inline_css_arr = array();
        $popup_close_button_inline_css_arr    = array();

        if( $place == 'popup_area' ){
            if( !empty($popup_settings['z_index']) ){
                $popup_area_inline_css_arr[] = 'z-index:' . $popup_settings['z_index'];
            } else {
                $popup_area_inline_css_arr[] = 'z-index:' . woolentor_get_option( 'z_index', 'woolentor_popup_builder_settings', '999999' );
            }

            $inline_css = implode(';', $popup_area_inline_css_arr);
        }
        
        if( $place == 'popup_container' ){
            if( !empty($popup_settings['width']) ){
                $popup_container_inline_css_arr[] = 'width:' . $popup_settings['width'];
            } else {
                $popup_container_inline_css_arr[] = 'width:' . woolentor_get_option( 'width', 'woolentor_popup_builder_settings', '600px' );
            }
    
            if( !empty($popup_settings['height']) ){
                $popup_container_inline_css_arr[] = 'height:' . $popup_settings['height'];
            } else {
                $popup_container_inline_css_arr[] = 'height:' . woolentor_get_option( 'height', 'woolentor_popup_builder_settings', '600px' );
            }
    
            if( !empty($popup_settings['margin']) ){
                $popup_container_inline_css_arr[] = 'margin:' . $popup_settings['margin'];
            }

            $inline_css = implode(';', $popup_container_inline_css_arr);
        }

        if( $place == 'popup_container_inner' ){
            if( !empty($popup_settings['padding']) ){
                $popup_container_inner_inline_css_arr[] = 'padding:' . $popup_settings['padding'];
            }

            $inline_css = implode(';', $popup_container_inner_inline_css_arr);
        }

        if( $place == 'popup_close_button' ){
            if( is_array($popup_settings['close_button_vertical_position']) 
                && !empty($popup_settings['close_button_vertical_position']['amount'])
                && !empty($popup_settings['close_button_vertical_position']['unit'])
            ){
                $popup_close_button_inline_css_arr[] = 'right:' . $popup_settings['close_button_vertical_position']['amount'] . $popup_settings['close_button_vertical_position']['unit'];
            }

            if( is_array($popup_settings['close_button_horizontal_position']) 
                && !empty($popup_settings['close_button_horizontal_position']['amount'])
                && !empty($popup_settings['close_button_horizontal_position']['unit'])
            ){
                $popup_close_button_inline_css_arr[] = 'top:' . $popup_settings['close_button_horizontal_position']['amount'] . $popup_settings['close_button_horizontal_position']['unit'];
            }

            $inline_css = implode(';', $popup_close_button_inline_css_arr);
        }

        return $inline_css;
    }

    
    /**
     * Check if pro version is active.
     * 
     * @return bool
     */
    public static function is_pro_version_active(){
        $is_pro = is_plugin_active('woolentor-addons-pro/woolentor_addons_pro.php') ? true : false;

        if( $is_pro && defined( "WOOLENTOR_VERSION_PRO" ) && version_compare( WOOLENTOR_VERSION_PRO, '2.2.4', '>=' )){
            return true;
        }

        return false;
    }
}