<?php
namespace Woolentor\Modules\Popup_Builder\Frontend;

use Woolentor\Modules\Popup_Builder\Helper;
use const Woolentor\Modules\Popup_Builder\MODULE_PATH;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Manage_Elementor_Editor {
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
        add_action( 'template_include', [ $this, 'set_elementor_editor_popup' ], 9999 );
    }

    /**
     * Set Elementor Editor Popup
     */
    public function set_elementor_editor_popup( $template ){
        $post_id       = get_the_ID();
        $template_type = get_post_meta( $post_id, 'woolentor_template_meta_type', true );

        // Check if elementor is editor mode not even preview mode.
        if ( !Helper::get_preview_id() && is_singular( 'woolentor-template' ) && $template_type == 'popup' ) {
            $template_file = MODULE_PATH . '/templates/single-woolentor-template.php';

            if( is_readable($template_file) ){
                $template = $template_file;
            }
        }   

        return $template;
    }
}