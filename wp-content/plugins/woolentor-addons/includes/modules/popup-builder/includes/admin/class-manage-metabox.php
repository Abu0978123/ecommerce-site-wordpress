<?php
namespace Woolentor\Modules\Popup_Builder\Admin;

use Woolentor\Modules\Popup_Builder as Popup_Builder;
use Woolentor\Modules\Popup_Builder\Helper;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Manage_Metabox{

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
        // Add Popup settings button for classic & gutenber editor.
        add_action( 'add_meta_boxes', array($this, 'add_meta_box') );

        // Render modal markup for the popup settings.
        add_action( 'admin_footer', array($this, 'render_modal_markup_template') );

        // Render modal markup for the elementor editor.
        add_action( 'elementor/editor/footer', array($this, 'render_modal_markup_template') );
    }

    /**
     * Add metabox
     */
    public function add_meta_box(){
        if( Helper::get_instance()->is_popup_edit_page() ){
            add_meta_box(
                'wlpb-metabox-button-side',
                __( 'Popup Builder', 'woolentor' ),
                array($this, 'render_meta_box'),
                'woolentor-template',
                'side',
                'core'
            );
        }
    }

    /**
     * Render metabox
     */
    public function render_meta_box(){
        $post_id  = get_the_ID();
        ?>
        <div class="wlpb-metabox-button-wrapper">
            <button type="button" class="button button-primary components-button is-primary" data-post_id="<?php echo esc_attr($post_id) ?>"><?php _e( 'Popup Settings', 'woolentor' ) ?></button>
            <!-- button button-primary classes for the Clssic editor support -->
        </div>
        <?php
    }

    /**
     * Render modal
     */
    public function render_modal_markup_template(){
        if( Helper::get_instance()->is_popup_edit_page() ){
            ob_start();
            include_once( Popup_Builder\MODULE_PATH. '/includes/admin/tmpl-popup-builder-modal.php' );

            echo ob_get_clean();

            // Pro upgrade.
            $dashboard_popup_file = WOOLENTOR_ADDONS_PL_PATH . '/includes/admin/templates/dashboard-popup.php';
            if( !Helper::is_pro_version_active() && file_exists( $dashboard_popup_file ) ){
                ob_start();
                include_once( $dashboard_popup_file );
    
                echo ob_get_clean();
            }
        }
    }
    /**
     * Render modal
     */
    public function get_fields( $group = '' ){
        $fields = array();

        $fields['trigger_fields'] = array(
            array(
                'name'  => 'on_page_load',
                'label' => __('On Page Load', 'woolentor'),
                'type'  => 'checkbox',
                'class' => 'wlpb-field',
                'default' => '1'
            ),

            array(
                'name'  => 'page_load_delay',
                'label' => __('Page Load Delay (ms)', 'woolentor'),
                'type'  => 'number',
                'class' => 'wlpb-field',
                'default' => '0'
            ),

            array(
                'name'  => 'on_scroll',
                'label' => __('On Scroll', 'woolentor'),
                'type'  => 'checkbox',
                'class' => 'wlpb-field',
                'default' => ''
            ),

            array(
                'name'  => 'scroll_percentage',
                'label' => __('Scroll Percentage (%)', 'woolentor'),
                'type'  => 'number',
                'class' => 'wlpb-field',
                'default' => '50',
            ),

            array(
                'name'  => 'scroll_direction',
                'label' => __('Scroll Direction', 'woolentor'),
                'type'  => 'select',
                'class' => 'wlpb-field',
                'default' => 'down',
                'options' => array(
                    'down' => __('Down', 'woolentor'),
                    'up'   => __('Up', 'woolentor'),
                )
            ),

            array(
                'name'  => 'on_click',
                'label' => __('On Click', 'woolentor'),
                'type'  => 'checkbox',
                'class' => 'wlpb-field',
                'default' => '',
                'wlpb_is_pro'  => true
            ),

            array(
                'name'  => 'clicks_count',
                'label' => __('Clicks Count', 'woolentor'),
                'type'  => 'number',
                'class' => 'wlpb-field',
                'default' => '1',
                'wlpb_is_pro'  => true
            ),

            array(
                'name'  => 'on_click_element',
                'label' => __('Click Element', 'woolentor'),
                'type'  => 'text',
                'class' => 'wlpb-field',
                'default' => '',
                'wlpb_is_pro'  => true
            ),

            array(
                'name'  => 'on_click_selector',
                'label' => __('Click Element Selector', 'woolentor'),
                'type'  => 'text',
                'class' => 'wlpb-field',
                'default' => '',
                'wlpb_is_pro'  => true
            ),

            array(
                'name'  => 'on_inactivity',
                'label' => __('On Inactivity', 'woolentor'),
                'type'  => 'checkbox',
                'class' => 'wlpb-field',
                'default' => '',
                'wlpb_is_pro'  => true
            ),

            array(
                'name'  => 'inactivity_time',
                'label' => __('Inactivity Time (ms)', 'woolentor'),
                'type'  => 'number',
                'class' => 'wlpb-field',
                'default' => '10',
                'wlpb_is_pro'  => true
            ),

            array(
                'name'  => 'on_exit_intent',
                'label' => __('On Exit Intent', 'woolentor'),
                'type'  => 'checkbox',
                'class' => 'wlpb-field',
                'default' => '',
                'wlpb_is_pro'  => true
            ),
        );

        $fields['general_fields'] = array(
            array(
                'name'  => 'disable_page_scroll',
                'label' => __('Disable Page Scroll', 'woolentor'),
                'type'  => 'checkbox',
                'class' => 'wlpb-field',
                'default' => ''
            ),
            array(
                'name'  => 'disable_close_button',
                'label' => __('Disable Close Button', 'woolentor'),
                'type'  => 'checkbox',
                'class' => 'wlpb-field',
                'default' => '',
            ),
            array(
                'name'  => 'dismiss_on_esc_key',
                'label' => __('Dismiss on Esc Key', 'woolentor'),
                'type'  => 'checkbox',
                'class' => 'wlpb-field',
                'default' => 'on'
            ),
            array(
                'name'  => 'dismiss_on_overlay_click',
                'label' => __('Dismiss on Overlay Click', 'woolentor'),
                'type'  => 'checkbox',
                'class' => 'wlpb-field wlpb-pro-adv',
                'default' => '',
                'wlpb_is_pro'  => true,
            ),
            array(
                'name'  => 'disable_overlay',
                'label' => __('Disable Popup Overlay', 'woolentor'),
                'type'  => 'checkbox',
                'class' => 'wlpb-field wlpb-pro-opacity',
                'default' => '',
                'wlpb_is_pro'  => true,
            ),
            array(
                'name'  => 'close_after_page_scroll',
                'label' => __('Close After Page Scroll', 'woolentor'),
                'type'  => 'checkbox',
                'class' => 'wlpb-field wlpb-pro-opacity',
                'default' => '',
                'wlpb_is_pro'  => true,
            ),
            array(
                'name'  => 'dismiss_automatically',
                'label' => __('Dismiss Automatically', 'woolentor'),
                'type'  => 'checkbox',
                'class' => 'wlpb-field wlpb-pro-opacity',
                'default' => '',
                'wlpb_is_pro'  => true,
            ),
            array(
                'name'  => 'dismiss_automatically_delay',
                'label' => __('Dismiss Automatically Delay (sec)', 'woolentor'),
                'type'  => 'number',
                'min'  	=> 0,
                'step'  => .5,
                'class' => 'wlpb-field wlpb-pro-opacity',
                'default' => '',
                'placeholder' => '10',
                'wlpb_is_pro'  => true,
            ),

            array(
                'name'    => 'animation_section_title',
                'headding'=> esc_html__( 'Animation', 'woolentor' ),
                'type'    => 'title',
                'size'    => 'margin_0 regular',
                'class'   => 'element_section_title_area',
                'default' => ''
            ),

            array(
                'name'    => 'animation_in',
                'label'   => esc_html__( 'Open Animation', 'woolentor' ),
                'desc'    => esc_html__( 'Choose open/entrance animation.', 'woolentor' ),
                'type'    => 'select',
                'default' => '',
                'options' => array(
                    ''                  => esc_html__( 'Default','woolentor' ),
                    'bounce'            => esc_html__( 'bounce','woolentor' ),
                    'flash'             => esc_html__( 'flash','woolentor' ),
                    'pulse'             => esc_html__( 'pulse','woolentor' ),
                    'rubberBand'        => esc_html__( 'rubberBand','woolentor' ),
                    'shake'             => esc_html__( 'shake','woolentor' ),
                    'swing'             => esc_html__( 'swing','woolentor' ),
                    'tada'              => esc_html__( 'tada','woolentor' ),
                    'wobble'            => esc_html__( 'wobble','woolentor' ),
                    'jello'             => esc_html__( 'jello','woolentor' ),
                    'heartBeat'         => esc_html__( 'heartBeat','woolentor' ),
                    'bounceIn'          => esc_html__( 'bounceIn','woolentor' ),
                    'bounceInDown'      => esc_html__( 'bounceInDown','woolentor' ),
                    'bounceInLeft'      => esc_html__( 'bounceInLeft','woolentor' ),
                    'bounceInRight'     => esc_html__( 'bounceInRight','woolentor' ),
                    'bounceInUp'        => esc_html__( 'bounceInUp','woolentor' ),
                    'fadeIn'            => esc_html__( 'fadeIn','woolentor' ),
                    'fadeInDown'        => esc_html__( 'fadeInDown','woolentor' ),
                    'fadeInDownBig'     => esc_html__( 'fadeInDownBig','woolentor' ),
                    'fadeInLeft'        => esc_html__( 'fadeInLeft','woolentor' ),
                    'fadeInLeftBig'     => esc_html__( 'fadeInLeftBig','woolentor' ),
                    'fadeInRight'       => esc_html__( 'fadeInRight','woolentor' ),
                    'fadeInRightBig'    => esc_html__( 'fadeInRightBig','woolentor' ),
                    'fadeInUp'          => esc_html__( 'fadeInUp','woolentor' ),
                    'fadeInUpBig'       => esc_html__( 'fadeInUpBig','woolentor' ),
                    'flip'              => esc_html__( 'flip','woolentor' ),
                    'flipInX'           => esc_html__( 'flipInX','woolentor' ),
                    'flipInY'           => esc_html__( 'flipInY','woolentor' ),
                    'lightSpeedIn'      => esc_html__( 'lightSpeedIn','woolentor' ),
                    'rotateIn'          => esc_html__( 'rotateIn','woolentor' ),
                    'rotateInDownLeft'  => esc_html__( 'rotateInDownLeft','woolentor' ),
                    'rotateInDownRight' => esc_html__( 'rotateInDownRight','woolentor' ),
                    'rotateInUpLeft'    => esc_html__( 'rotateInUpLeft','woolentor' ),
                    'rotateInUpRight'   => esc_html__( 'rotateInUpRight','woolentor' ),
                    'slideInUp'         => esc_html__( 'slideInUp','woolentor' ),
                    'slideInDown'       => esc_html__( 'slideInDown','woolentor' ),
                    'slideInLeft'       => esc_html__( 'slideInLeft','woolentor' ),
                    'slideInRight'      => esc_html__( 'slideInRight','woolentor' ),
                    'zoomIn'            => esc_html__( 'zoomIn','woolentor' ),
                    'zoomInDown'        => esc_html__( 'zoomInDown','woolentor' ),
                    'zoomInLeft'        => esc_html__( 'zoomInLeft','woolentor' ),
                    'zoomInRight'       => esc_html__( 'zoomInRight','woolentor' ),
                    'zoomInUp'          => esc_html__( 'zoomInUp','woolentor' ),
                    'hinge'             => esc_html__( 'hinge','woolentor' ),
                    'jackInTheBox'      => esc_html__( 'jackInTheBox','woolentor' ),
                    'rollIn'            => esc_html__( 'rollIn','woolentor' ),
                    'rollOut'           => esc_html__( 'rollOut','woolentor' ),
                ),
                'class' => 'wlpb-field',
            ),
            array(
                'name'    => 'animation_out',
                'label'   => esc_html__( 'Close Animation', 'woolentor' ),
                'desc'    => esc_html__( 'Choose close/exit animation.', 'woolentor' ),
                'type'    => 'select',
                'default' => '',
                'options' => array(
                    ''                   => esc_html__( 'Default','woolentor' ),
                    'bounce'             => esc_html__( 'bounce','woolentor' ),
                    'flash'              => esc_html__( 'flash','woolentor' ),
                    'pulse'              => esc_html__( 'pulse','woolentor' ),
                    'rubberBand'         => esc_html__( 'rubberBand','woolentor' ),
                    'shake'              => esc_html__( 'shake','woolentor' ),
                    'swing'              => esc_html__( 'swing','woolentor' ),
                    'tada'               => esc_html__( 'tada','woolentor' ),
                    'wobble'             => esc_html__( 'wobble','woolentor' ),
                    'jello'              => esc_html__( 'jello','woolentor' ),
                    'heartBeat'          => esc_html__( 'heartBeat','woolentor' ),
                    'bounceOut'          => esc_html__( 'bounceOut','woolentor' ),
                    'bounceOutDown'      => esc_html__( 'bounceOutDown','woolentor' ),
                    'bounceOutLeft'      => esc_html__( 'bounceOutLeft','woolentor' ),
                    'bounceOutRight'     => esc_html__( 'bounceOutRight','woolentor' ),
                    'bounceOutUp'        => esc_html__( 'bounceOutUp','woolentor' ),
                    'fadeOut'            => esc_html__( 'fadeOut','woolentor' ),
                    'fadeOutDown'        => esc_html__( 'fadeOutDown','woolentor' ),
                    'fadeOutDownBig'     => esc_html__( 'fadeOutDownBig','woolentor' ),
                    'fadeOutLeft'        => esc_html__( 'fadeOutLeft','woolentor' ),
                    'fadeOutLeftBig'     => esc_html__( 'fadeOutLeftBig','woolentor' ),
                    'fadeOutRight'       => esc_html__( 'fadeOutRight','woolentor' ),
                    'fadeOutRightBig'    => esc_html__( 'fadeOutRightBig','woolentor' ),
                    'fadeOutUp'          => esc_html__( 'fadeOutUp','woolentor' ),
                    'fadeOutUpBig'       => esc_html__( 'fadeOutUpBig','woolentor' ),
                    'flip'               => esc_html__( 'flip','woolentor' ),
                    'flipOutX'           => esc_html__( 'flipOutX','woolentor' ),
                    'flipOutY'           => esc_html__( 'flipOutY','woolentor' ),
                    'lightSpeedOut'      => esc_html__( 'lightSpeedOut','woolentor' ),
                    'rotateOut'          => esc_html__( 'rotateOut','woolentor' ),
                    'rotateOutDownLeft'  => esc_html__( 'rotateOutDownLeft','woolentor' ),
                    'rotateOutDownRight' => esc_html__( 'rotateOutDownRight','woolentor' ),
                    'rotateOutUpLeft'    => esc_html__( 'rotateOutUpLeft','woolentor' ),
                    'rotateOutUpRight'   => esc_html__( 'rotateOutUpRight','woolentor' ),
                    'slideOutUp'         => esc_html__( 'slideOutUp','woolentor' ),
                    'slideOutDown'       => esc_html__( 'slideOutDown','woolentor' ),
                    'slideOutLeft'       => esc_html__( 'slideOutLeft','woolentor' ),
                    'slideOutRight'      => esc_html__( 'slideOutRight','woolentor' ),
                    'zoomOut'            => esc_html__( 'zoomOut','woolentor' ),
                    'zoomOutDown'        => esc_html__( 'zoomOutDown','woolentor' ),
                    'zoomOutLeft'        => esc_html__( 'zoomOutLeft','woolentor' ),
                    'zoomOutRight'       => esc_html__( 'zoomOutRight','woolentor' ),
                    'zoomOutUp'          => esc_html__( 'zoomOutUp','woolentor' ),
                    'hinge'              => esc_html__( 'hinge','woolentor' ),
                ),
                'class' => 'wlpb-field',
            ),
            array(
                'name'  => 'animation_in_duration',
                'label' => __('Animation Duration (sec)', 'woolentor'),
                'type'  => 'number',
                'class' => 'wlpb-field wlpb-pro-adv',
                'default' => '1',
                'wlpb_is_pro'  => true,
            ),
        );

        $fields['customization_fields'] = array(
            array(
                'name'    => 'popup_customization_tab_section_title',
                'headding'=> esc_html__( 'Popup Area', 'woolentor' ),
                'type'    => 'title',
                'size'    => 'margin_0 regular',
                'class'   => 'element_section_title_area',
                'default' => ''
            ),
            array(
                'name'  => 'popup_vertical_position',
                'label' => __('Position Vertical', 'woolentor'),
                'type'  => 'select',
                'options' => array(
                    'top' => __('Top', 'woolentor'),
                    'center' => __('Center', 'woolentor'),
                    'bottom' => __('Bottom', 'woolentor'),
                ),
                'class' => 'wlpb-field wlpb-pro-adv',
                'default' => 'center',
                'wlpb_is_pro' => true
            ),
            array(
                'name'  => 'popup_horizontal_position',
                'label' => __('Position Horizontal', 'woolentor'),
                'type'  => 'select',
                'options' => array(
                    'left' => __('Left', 'woolentor'),
                    'center' => __('Center', 'woolentor'),
                    'right' => __('Right', 'woolentor'),
                ),
                'class' => 'wlpb-field wlpb-pro-opacity',
                'default' => 'center',
                'wlpb_is_pro' => true
            ),
            array(
                'name'  => 'width',
                'label' => __('Width', 'woolentor'),
                'type'  => 'text',
                'desc' 	=> __('Example: 500px', 'woolentor'),
                'class' => 'wlpb-field',
                'default' => ''
            ),
            array(
                'name'  => 'height',
                'label' => __('Height', 'woolentor'),
                'type'  => 'text',
                'desc' 	=> __('Example: 500px', 'woolentor'),
                'class' => 'wlpb-field',
                'default' => ''
            ),
            array(
                'name'  => 'z_index',
                'label' => __('Z-Index', 'woolentor'),
                'type'  => 'number',
                'desc' 	=> __('Example: 9999', 'woolentor'),
                'class' => 'wlpb-field',
                'default' => ''
            ),
            array(
                'name'  => 'margin',
                'label' => __('Margin', 'woolentor'),
                'type'  => 'text',
                'desc' 	=> __('Example: <code>10px</code> or <code>10px 20px 10px 20px</code>', 'woolentor'),
                'class' => 'wlpb-field',
                'default' => ''
            ),
            array(
                'name'  => 'padding',
                'label' => __('Padding', 'woolentor'),
                'type'  => 'text',
                'desc' 	=> __('Example: <code>10px</code> or <code>10px 20px 10px 20px</code>', 'woolentor'),
                'class' => 'wlpb-field',
                'default' => ''
            ),
            
            array(
                'name'    => 'close_button_section_title',
                'headding'=> esc_html__( 'Close Button', 'woolentor' ),
                'type'    => 'title',
                'size'    => 'margin_0 regular',
                'class'   => 'element_section_title_area',
                'default' => ''
            ),
            array(
                'name'    => 'close_button_vertical_position',
                'label'   => esc_html__( 'Vertical Position', 'woolentor' ),
                'type'    => 'dimensions',
                'options' => [
                    'amount'  => esc_html__( '', 'woolentor' ),
                    'unit'    => esc_html__( '', 'woolentor' ),
                ],
                'default' => array(
                    'unit' => 'px'
                ),
                'class'         => 'woolentor-action-field-left wlpb-close_button_vertical_position wlpb-pro-adv',
                'wlpb_is_pro'   => true
            ),

            array(
                'name'    => 'close_button_horizontal_position',
                'label'   => esc_html__( 'Horizontal Position', 'woolentor' ),
                'type'    => 'dimensions',
                'options' => [
                    'amount'  => esc_html__( '', 'woolentor' ),
                    'unit'    => esc_html__( '', 'woolentor' ),
                ],
                'default' => array(
                    'unit' => 'px'
                ),
                'class'         => 'woolentor-action-field-left wlpb-pro-opacity',
                'wlpb_is_pro'   => true
            ),
        );

        // Advanced fields
        $fields['advanced_fields'] = array(
            array(
                'name'  => 'do_not_show_again',
                'label' => __('Do Not Show Again', 'woolentor'),
                'type'  => 'checkbox',
                'class' => 'wlpb-field',
                'default' => '0'
            ),
            // do_not_show_again_timespan
            array(
                'name'  => 'do_not_show_again_timespan',
                'label' => __('For (days)', 'woolentor'),
                'type'  => 'number',
                'min'  	=> 0,
                'step'  => 1,
                'class' => 'wlpb-field',
                'default' => '30',
                'placeholder' => __('Lifetime', 'woolentor')
            ),
            // do_not_show_again_closecount
            array(
                'name'  => 'do_not_show_again_closecount',
                'label' => __('If closed (times)', 'woolentor'),
                'type'  => 'number',
                'min'  	=> 0,
                'step'  => 1,
                'class' => 'wlpb-field',
                'default' => '1',
                'placeholder' => ''
            ),
            // url_match
            array(
                'name'  => 'url_match',
                'label' => __('Only show if the URL has specific keyword', 'woolentor'),
                'type'  => 'text',
                'class' => 'wlpb-field',
                'default' => '',
                'wlpb_is_pro' => true
            ),
            // url_match_type
            array(
                'name'  => 'url_match_type',
                'label' => __('Type', 'woolentor'),
                'type'  => 'text',
                'class' => 'wlpb-field',
                'default' => '',
                'wlpb_is_pro' => true
            ),
            // url_match_input
            array(
                'name'  => 'url_match_input',
                'label' => __('Name', 'woolentor'),
                'type'  => 'text',
                'class' => 'wlpb-field',
                'default' => '',
                'wlpb_is_pro' => true
            ),
            // url_match_value
            array(
                'name'  => 'url_match_value',
                'label' => __('Keyword Value', 'woolentor'),
                'type'  => 'text',
                'class' => 'wlpb-field',
                'default' => '',
                'wlpb_is_pro' => true
            ),
            // show_on_devices checkbox
            array(
                'name'  => 'show_on_devices',
                'label' => __('Show on Devices', 'woolentor'),
                'type'  => 'checkbox',
                'class' => 'wlpb-field',
                'default' => '',
                'wlpb_is_pro' => true
            ),
            // devices
            array(
                'name'  => 'devices',
                'label' => __('Device Types', 'woolentor'),
                'type'  => 'select2',
                'class' => 'wlpb-field',
                'options' => array(
                    'desktop' => __('Desktop', 'woolentor'),
                    'tablet' => __('Tablet', 'woolentor'),
                    'mobile' => __('Mobile', 'woolentor'),
                ),
                'default' => '',
                'wlpb_is_pro' => true
            ),
            // show_on_brosers
            array(
                'name'  => 'show_on_browsers',
                'label' => __('Show on Browsers', 'woolentor'),
                'type'  => 'checkbox',
                'class' => 'wlpb-field',
                'default' => '',
                'wlpb_is_pro' => true
            ),
            // browsers
            array(
                'name'  => 'browsers',
                'label' => __('Browsers', 'woolentor'),
                'type'  => 'select2',
                'class' => 'wlpb-field',
                'options' => array(
                    'chrome' => __('Chrome', 'woolentor'),
                    'firefox' => __('Firefox', 'woolentor'),
                    'safari' => __('Safari', 'woolentor'),
                    'opera' => __('Opera', 'woolentor'),
                    'ie' => __('IE', 'woolentor'),
                    'edge' => __('Edge', 'woolentor'),
                ),
                'default' => '',
                'wlpb_is_pro' => true
            ),
            
        );

        $fields = apply_filters( 'wlpb_module_fields', $fields );

        if( $group && isset($fields[$group]) ){
            return $fields[$group];
        }

        return $fields;
    }

    /**
     * Get default values for the fields.
     * 
     * @param string $group possible values: trigger_fields, general_fields, customization_fields, advanced_fields
     * 
     * @return array
     */
    public function get_default_values( $group = '' ){
        $defaults = array(
            'trigger_fields' => array(),
            'general_fields' => array(),
            'customization_fields' => array(),
        );

        $fields = $this->get_fields();

        // Trigger Fields.
        foreach ($fields['trigger_fields'] as $field) {
            $defaults['trigger_fields'][$field['name']] = $field['default'];
        }

        // General Fields.
        foreach ($fields['general_fields'] as $field) {
            $defaults['general_fields'][$field['name']] = $field['default'];
        }

        // Customization Fields.
        foreach ($fields['customization_fields'] as $field) {
            $defaults['customization_fields'][$field['name']] = $field['default'];
        }

        // Advanced Fields.
        foreach ($fields['advanced_fields'] as $field) {
            $defaults['advanced_fields'][$field['name']] = $field['default'];
        }

        if( $group ){
            return $defaults[$group];
        }

        // Merge all fields.
        return array_merge($defaults['trigger_fields'], $defaults['general_fields'], $defaults['customization_fields']);
    }
}