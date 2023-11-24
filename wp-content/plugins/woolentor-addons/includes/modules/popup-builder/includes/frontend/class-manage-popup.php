<?php
namespace Woolentor\Modules\Popup_Builder\Frontend;

use Woolentor\Modules\Popup_Builder\Helper;
use Woolentor\Modules\Popup_Builder\Admin\Manage_Metabox;
use Woolentor\Modules\Popup_Builder_Pro\Frontend\Popup_Rules_Checker_Pro;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Manage_Popup {

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
        add_action( 'wp_footer', array($this, 'render_modal_markup_template') );
    }

    /**
     * Render modal markup template.
     */
    public function render_modal_markup_template(){
        global $post;
	
        $popups = $this->get_popups();

        if( empty($popups) ){
            return;
        }

        foreach( $popups as $popup_id ){
            $post = get_post( $popup_id );
            setup_postdata( $post );
            
            if( get_post_status($popup_id) == 'publish' ||
                ( get_post_status($popup_id) == 'private' && current_user_can('administrator') ) || 
                ( get_post_status($popup_id) == 'draft' && is_preview() )
            ){
                if( $this->check_popup_display_rules( $popup_id ) ){
                    $this->render_single_popup( $popup_id );
                }
            }
        }

        wp_reset_postdata();
    }

    public function check_popup_display_rules( $popup_id ){
        $popup_meta     = get_post_meta( $popup_id, '_wlpb_popup_seetings', true );
        $return_value = false;

        $popup_condition_status      = false;
        $popup_advanced_rules_status = null;

        // Check the popup display status. If any rule matched with current page then display the popup.
        $popup_conditions  = isset($popup_meta['conditions']) ? $popup_meta['conditions'] : array(
            array(
                'type'      => 'include',
                'name'      => 'entire_site',
                'sub_name'  => '',
                'sub_id'    => '',
            )
        );

        if( Helper::is_pro_version_active() && class_exists('Woolentor\Modules\Popup_Builder_Pro\Frontend\Popup_Rules_Checker_Pro') ){
            if( method_exists(Popup_Rules_Checker_Pro::get_instance(),'check_rules') ){
                $popup_condition_status      = Popup_Rules_Checker_Pro::get_instance()->check_rules( $popup_id, $popup_conditions );
            }
            
            if( method_exists(Popup_Rules_Checker_Pro::get_instance(),'check_advanced_rules') ){
                $popup_advanced_rules_status = Popup_Rules_Checker_Pro::get_instance()->check_advanced_rules( $popup_id );
            }
        } else {
            $popup_condition_status      = Popup_Rules_Checker::get_instance()->check_rules( $popup_id, $popup_conditions );
        }

        // Check $popup_condition_status first and then $popup_advanced_rules_status.
        if( $popup_condition_status && is_bool($popup_advanced_rules_status) ){
            $return_value = $popup_advanced_rules_status;
        } else {
            $return_value = $popup_condition_status;
        }
        
        $args = array(
            'popup_id'  => $popup_id,
        );

        return apply_filters( 'wlpb_popup_display_status', $return_value, $args );
    }

    /**
     * Render single popup.
     * 
     * @param int $popup_id
     * @param array $args (optional) If not passed then it will get the popup settings from the metabox.
     * 
     * @return void
     */
    public function render_single_popup( $popup_id = 0, $args = array() ){
        if( empty($popup_id) ){
            return;
        }

        $popup_meta     = get_post_meta( $popup_id, '_wlpb_popup_seetings', true );

        // Prepare default values so we don't need to check isset() for each value.
        $popup_default_settings = array();
        $popup_default_settings = array_merge($popup_default_settings, Manage_Metabox::get_instance()->get_default_values('general_fields'));
        $popup_default_settings = array_merge($popup_default_settings, Manage_Metabox::get_instance()->get_default_values('customization_fields'));

        // @todo: add the below options later.
        $popup_default_settings['popup_display_as']   = 'modal';
        $popup_default_settings['popup_bar_float']    = '';
        $popup_default_settings['popup_bar_position'] = 'top';
        $popup_default_settings['css_class']          = '';

        // Merge default values with saved values.
        $popup_settings = wp_parse_args($popup_meta, $popup_default_settings);
        $popup_close_button_inline_css = Helper::generate_inline_css($popup_id, $popup_settings, 'popup_close_button');

        // Override popup settings if passed.
        if( !empty($args) ){
            $popup_settings = wp_parse_args($args, $popup_settings);
        }

        // Make the disable_overlay option with default value for free users.
        if( !Helper::is_pro_version_active() ){
            $popup_settings['disable_overlay'] = '';
            $popup_close_button_inline_css     = '';
        }

        wp_enqueue_style( 'wlpb-frontend' );
        wp_enqueue_script( 'wlpb-frontend' );
        wp_enqueue_script( 'js-cookie' );

        if( method_exists('\WooLentorBlocks\Manage_Styles','generate_inline_css') ){
            \WooLentorBlocks\Manage_Styles::instance()->generate_inline_css($popup_id);
        }
        ?>

        <?php $popup_area_inline_css = Helper::generate_inline_css($popup_id, $popup_settings, 'popup_area');  ?>
        <div id="wlpb-popup-id-<?php echo esc_attr($popup_id) ?>" class="wlpb-popup <?php echo esc_attr($this->get_popup_classes($popup_id, $popup_settings)) ?>" data-wlpb_popup_id="<?php echo esc_attr($popup_id) ?>" data-settings=<?php echo json_encode($this->get_data_settings( $popup_id, $popup_settings )) ?> style="<?php echo esc_attr($popup_area_inline_css) ?>">
            <div class="wlpb-popup-inner <?php echo esc_attr($this->get_popup_inner_classes($popup_id, $popup_settings)) ?>">

                <?php if( !$popup_settings['disable_overlay']): ?>
                <div class="wlpb-popup-overlay"></div>
                <?php endif; ?>

                <!-- Any style for popup modal will apply here in the .wlpb-popup-container -->
                <?php $popup_container_inline_css = Helper::generate_inline_css($popup_id, $popup_settings, 'popup_container'); ?>
                <div class="wlpb-popup-container" style="<?php echo esc_attr($popup_container_inline_css) ?>">

                    <?php  ?>
                    <span class="wlpb-popup-close-btn <?php echo esc_attr($popup_settings['disable_close_button'] == false ? '' : 'wlpb-d-none') ?>" style="<?php echo esc_attr($popup_close_button_inline_css) ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><rect x="0" fill="none" width="20" height="20"></rect><g><path d="M14.95 6.46L11.41 10l3.54 3.54-1.41 1.41L10 11.42l-3.53 3.53-1.42-1.42L8.58 10 5.05 6.47l1.42-1.42L10 8.58l3.54-3.53z"></path></g></svg>
                    </span>

                    <?php $popup_container_inner_inline_css = Helper::generate_inline_css($popup_id, $popup_settings, 'popup_container_inner'); ?>
                    <div class="wlpb-popup-container-inner ps" style="<?php echo esc_attr($popup_container_inner_inline_css) ?>">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }

    public function get_popups(){
        return get_posts( array(
            'post_type'         => 'woolentor-template',
            'post_status'       => array('publish', 'private', 'draft'),
            'posts_per_page'    => Helper::get_instance()->get_dropdown_posts_limit(),
            'fields'            => 'ids',
            // Include templates where key = woolentor_template_meta_type,vlaue = popup.
            // and key = _wlpb_popup_seetings,value = not empty.
            'meta_query' => array(
                array(
                    'key'     => 'woolentor_template_meta_type',
                    'value'   => 'popup',
                    'compare' => '='
                ),
            )
        ) );
    }

    public function get_popup_classes( $popup_id, $popup_settings ){
        $popup_classes = array(
            'wlpb-popup-' . $popup_id,
            'wlpb-popup-' . $popup_settings['popup_display_as'], // modal, bar
            'wlpb-popup-pv-' . $popup_settings['popup_vertical_position'], // top, center, bottom
            'wlpb-popup-ph-' . $popup_settings['popup_horizontal_position'], // left, center, right
            'wlpb-popup-' . $popup_settings['css_class'], // custom css class
        );

        // Add the wlpb-popup-bar class if the popup is a bar.
        if( $popup_settings['popup_display_as'] == 'bar' ){
            $popup_classes[] = 'wlpb-popup-bar-' . $popup_settings['popup_bar_position']; // top, bottom
        }

        // Add the wlpb-popup-bar-float class if the popup is a bar and the float option is enabled.
        if( $popup_settings['popup_display_as'] == 'bar' && $popup_settings['popup_bar_float'] ){
            $popup_classes[] = 'wlpb-popup-bar-float';
        }

        return implode(' ', $popup_classes);
    }

    public function get_popup_inner_classes( $popup_id, $popup_settings ){
        $popup_inner_classes = array(
            'wlpb-popup-pv-' . $popup_settings['popup_vertical_position'], // top, center, bottom
            'wlpb-popup-ph-' . $popup_settings['popup_horizontal_position'], // left, center, right
        );

        return implode(' ', $popup_inner_classes);
    }

    public function get_data_settings( $popup_id, $popup_settings ){
        $data_settings = array();

        // ID.
        $data_settings['id']        = $popup_id;

        // Loop through each group of the fields
        foreach( Manage_Metabox::get_instance()->get_fields() as $group_name => $group_fields ){

            // Loop through each fields of the current group
            foreach( $group_fields as $field ){
                $field_name   = $field['name'];
                $is_pro_field = ( isset($field['wlpb_is_pro']) && $field['wlpb_is_pro'] ) ? true : false;
                $field_value  = '';

                // For root level fields
                if( in_array( $group_name, array('general_fields', 'customization_fields') ) ){
                    $field_value  = isset($popup_settings[$field_name]) ? $popup_settings[$field_name] : $field['default'];

                    if( Helper::is_pro_version_active() || !$is_pro_field ){
                        $data_settings[$field_name] = $field_value;
                    } elseif(  $is_pro_field ){
                        $data_settings[$field_name] = $field['default'];
                    }
                }

                // Fields under the group
                if( in_array( $group_name, array('trigger_fields', 'advanced_fields') ) ){
                    $group = $group_name == 'trigger_fields' ? 'triggers' : 'advanced';

                    $field_value  = isset($popup_settings[$group][$field_name]) ? $popup_settings[$group][$field_name] : $field['default'];
                    if( Helper::is_pro_version_active() || !$is_pro_field ){
                        $data_settings[$group][$field_name] = $field_value;
                    } elseif(  $is_pro_field ){
                        $data_settings[$group][$field_name] = $field['default'];
                    }
                }
            }
        }

        return $data_settings;
    }
}