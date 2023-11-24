<?php
namespace Woolentor\Modules\Popup_Builder;

/**
 * Widgets class.
 */
class Widgets {

	/**
     * Widgets constructor.
     */
    public function __construct() {

        // Elementor Widget
        add_filter( 'woolentor_widget_list', [ $this, 'widget_list' ] );

        // Load Under Init Hook
        add_action( 'init', [ $this, 'init'] );

        // Guttenberg Block
        add_filter('woolentor_block_list', [ $this, 'block_list' ] );

    }

    /**
     * Load under WordPress init Hook
     *
     * @return void
     */
    public function init(){
        if( Helper::get_instance()->is_elementor_editor() ){
            add_filter( 'woolentor_load_widget_list', [ $this, 'load_widget_list' ], 999, 3 );
        }
    }

    /**
     * Widget list.
     */
    public function widget_list( $widget_list = [] ) {
        
        $widget_list['popup'] = [
            'wl_popup_trigger_button' => [
                'title'    => esc_html__('Popup Close Trigger Button','woolentor'),
                'location' => WIDGETS_PATH,
            ]
        ];

        return $widget_list;
    }

    /**
     * Load widget list.
     */
    public function load_widget_list( $widget_list = [], $widget_list_group = [], $tmpType = '' ) {

        $template_type = get_post_meta( get_the_id(), 'woolentor_template_meta_type', true );

        if ( 'popup' === $template_type ) {
            $is_builder = ( woolentor_get_option( 'enablecustomlayout', 'woolentor_woo_template_tabs', 'on' ) == 'on' ) ? true : false;
            $template_wise  = ( $is_builder == true && $tmpType !== '' && array_key_exists( $tmpType, $widget_list_group ) ) ? $widget_list_group[$tmpType] : [];

            if ( ! empty( $template_wise ) ) {
                $widget_list = $template_wise;
            }
        } else {
            foreach ( $widget_list as $key => $value ) {
                if ( false !== strpos( $key, 'wl_popup' ) ) {
                    unset( $widget_list[ $key ] );
                }
            }
        }

        return $widget_list;
    }

    /**
     * Block list.
     */
    public function block_list( $block_list = [] ){

        $block_list['popup_trigger_button'] = [
            'label'  => __('Popup Close Trigger Button','woolentor'),
            'name'   => 'woolentor/popup-close-trigger-button',
            'server_side_render' => true,
            'type'   => 'popup',
            'active' => true,
        ];

        return $block_list;
    }

}