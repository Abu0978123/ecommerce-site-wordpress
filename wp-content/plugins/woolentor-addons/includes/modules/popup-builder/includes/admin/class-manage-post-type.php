<?php
namespace Woolentor\Modules\Popup_Builder\Admin;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Manage_Post_Type{

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
        // Add Popup Template Type.
        add_filter('woolentor_template_types', array($this, 'add_popup_template_type'), 10, 1);

        // Add Popup Menu above of the post table list.
        add_filter('woolentor_template_menu_tabs', array($this, 'add_popup_menu'), 10, 1);
    }

    /**
     * Add Popup Template Type.
     */
    public function add_popup_template_type($types){

        $types = array_merge($types, array(
            'popup' => [
                'label'		=> __('Popup','woolentor'),
                'optionkey'	=> 'popup'
            ]
        ));

        return $types;
    }

    /**
     * Add Template Menu Tabs
     */
    public function add_popup_menu($tabs){

        $tabs = array_merge($tabs, array(
            'popup' => [
                'label' => __('Popup','woolentor')
            ]
        ));

        return $tabs;
    }
}