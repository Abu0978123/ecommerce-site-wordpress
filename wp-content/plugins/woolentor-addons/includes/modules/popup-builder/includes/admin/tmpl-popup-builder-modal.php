<?php
/**
 * Template Popup Builder Modal
 */
use Woolentor\Modules\Popup_Builder\Repeater_Helper;
use Woolentor\Modules\Popup_Builder\Admin\Manage_Metabox;
use Woolentor\Modules\Popup_Builder\Helper;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$popup_meta     = get_post_meta(get_the_id(), '_wlpb_popup_seetings', true);

$conditions       = isset($popup_meta['conditions']) ? $popup_meta['conditions'] : array(
    array(
        'type'     => 'include',
        'name'     => 'entire_site',
        'sub_name' => '',
        'sub_id'   => ''
    )
);

$trigger_settings = !empty($popup_meta['triggers']) ? wp_parse_args($popup_meta['triggers'],Manage_Metabox::get_instance()->get_default_values('trigger_fields') ) : Manage_Metabox::get_instance()->get_default_values('trigger_fields');

$advanced_settings = !empty($popup_meta['advanced']) ? wp_parse_args($popup_meta['advanced'],Manage_Metabox::get_instance()->get_default_values('advanced_fields') ) : Manage_Metabox::get_instance()->get_default_values('advanced_fields');

$customization_fields = Manage_Metabox::get_instance()->get_fields('customization_fields');
$general_fields       = Manage_Metabox::get_instance()->get_fields('general_fields');

// Initialize variables
$pro_adv_class      = 'wlpb-pro-adv';
$opacity_class      = 'wlpb-pro-opacity';
$on_click           = '';
$clicks_count       = '';
$on_click_element   = '';
$on_click_selector  = '';
$on_inactivity      = '';
$inactivity_time    = '';
$on_exit_intent     = '';

// Url match
$url_match          = '';
$url_match_type     = '';
$url_match_input    = '';
$url_match_value    = '';

// Show on devices
$show_on_devices    = '';
$allowed_devices    = array('desktop', 'tablet', 'mobile');

// Alow Browsers
$show_on_browsers   = '';
$allowed_browsers   = array('chrome', 'firefox', 'safari', 'opera', 'ie', 'edge');

if( Helper::is_pro_version_active() ){
    $pro_adv_class      = '';
    $opacity_class      = '';

    // General Fields
    $on_click           = $trigger_settings['on_click'];
    $clicks_count       = $trigger_settings['clicks_count'];
    $on_click_element   = $trigger_settings['on_click_element'];
    $on_click_selector  = $trigger_settings['on_click_selector'];
    $on_inactivity      = $trigger_settings['on_inactivity'];
    $inactivity_time    = $trigger_settings['inactivity_time'];
    $on_exit_intent     = $trigger_settings['on_exit_intent'];

    // Advanced Rule - URL Match Field
    $url_match       = $advanced_settings['url_match'];
    $url_match_type  = $advanced_settings['url_match_type'];
    $url_match_input = $advanced_settings['url_match_input'];
    $url_match_value = $advanced_settings['url_match_value'];

    // Advanced Rule - Show on Devices
    $show_on_devices = $advanced_settings['show_on_devices'];
    if (!empty($advanced_settings['devices']) ){
        $allowed_devices = (array) $advanced_settings['devices'];
    }

    // Advanced Rule - Show on Browsers
    $show_on_browsers = $advanced_settings['show_on_browsers'];
    if( !empty($advanced_settings['browsers']) ){
        $allowed_browsers = (array) $advanced_settings['browsers'];
    }
}

wp_enqueue_script('js-cookie');
?>
<script type="text/template" id="tmpl-wlpb-modal">
<div class="woolentor-template-edit-popup-area wlpb-modal">
    <div class="woolentor-body-overlay"></div>
    <div class="woolentor-template-edit-popup">
        <div class="woolentor-template-edit-header">
            <h3 class="woolentor-template-edit-setting-title">
                <span class="woolentor-template-edit-setting-image dashicons dashicons-admin-generic"></span>
                <?php _e('Popup Settings', 'woolentor') ?>
            </h3>
            <span class="woolentor-template-edit-cross">
                <svg version="1.1" width="18" height="28" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 496.096 496.096" style="enable-background:new 0 0 496.096 496.096;" xml:space="preserve">
                <path d="M259.41,247.998L493.754,13.654c3.123-3.124,3.123-8.188,0-11.312c-3.124-3.123-8.188-3.123-11.312,0L248.098,236.686 L13.754,2.342C10.576-0.727,5.512-0.639,2.442,2.539c-2.994,3.1-2.994,8.015,0,11.115l234.344,234.344L2.442,482.342 c-3.178,3.07-3.266,8.134-0.196,11.312s8.134,3.266,11.312,0.196c0.067-0.064,0.132-0.13,0.196-0.196L248.098,259.31 l234.344,234.344c3.178,3.07,8.242,2.982,11.312-0.196c2.995-3.1,2.995-8.016,0-11.116L259.41,247.998z" fill="#ddd" data-original="#000000"/></svg>
            </span>
        </div>

        <div class="woolentor-template-edit-body">
            <div class="wlpb-tab-container">
                <div class="wlpb-tab-nav-wrap">
                    <span class="wlpb-tab-border"></span>
                    <ul class="wlpb-tab-nav">
                        <li class="wlpb-active"><a href="#wlpb-conditions"><?php _e('Conditions', 'woolentor') ?></a></li>
                        <li><a href="#wlpb-triggers"><?php _e('Triggers', 'woolentor') ?></a></li>
                        <li><a href="#wlpb-general"><?php _e('General', 'woolentor') ?></a></li>
                        <li><a href="#wlpb-advanced"><?php _e('Advanced', 'woolentor') ?></a></li>
                        <li><a href="#wlpb-customize"><?php _e('Customize', 'woolentor') ?></a></li>
                    </ul>
                </div>
                <div class="wlpb-tab-content">
                    <div id="wlpb-conditions" class="wlpb-tab-pane wlpb-active">
                        <div class="wlpb-field">
                            <div class="wlpb-repeater-fields-wrapper">
                                <div class="wlpb-repeater-fields">
                                    <?php
                                        foreach( $conditions as $condition ){
                                            if( !Helper::is_pro_version_active() && ( $condition['name'] == 'woocommerce' || $condition['name'] == 'archives' ) ){
                                                continue; // Don't render the pro fields
                                            }
                                            ?>
                                            <div class="wlpb-repeater-conditions-repeater-row-controls">                
                                                <div class="wlpb-repeater-controls-wrapper">
                                                    <div class="woolentor-admin-select">
                                                        <select data-name="type" id="">
                                                            <option value="include" <?php selected($condition['type'], 'include') ?>><?php echo esc_html__('Include', 'woolentor') ?></option>
                                                            <option value="exclude" <?php selected($condition['type'], 'exclude') ?>><?php echo esc_html__('Exclude', 'woolentor') ?></option>
                                                        </select>
                                                    </div>

                                                    <?php if( Helper::is_pro_version_active() ): ?>
                                                    <div class="woolentor-admin-select wlpb-name">
                                                        <select data-name="namee" id="">
                                                            <option value="entire_site" <?php selected($condition['name'], 'entire_site') ?>><?php _e('Entire Site', 'woolentor') ?></option>
                                                            <option value="archives" <?php selected($condition['name'], 'archives') ?>><?php _e('Archives', 'woolentor') ?></option>
                                                            <option value="singular" <?php selected($condition['name'], 'singular') ?>><?php _e('Singular', 'woolentor') ?></option>
                                                            <option value="woocommerce" <?php selected($condition['name'], 'woocommerce') ?>> <?php _e('WooCommerce', 'woolentor') ?></option>
                                                        </select>
                                                    </div>

                                                    <?php else: ?>

                                                    <div class="woolentor-admin-select wlpb-name">
                                                        <select data-name="namee" id="">
                                                            <option value="entire_site" <?php selected($condition['name'], 'entire_site') ?>><?php _e('Entire Site', 'woolentor') ?></option>
                                                            <option value="singular" <?php selected($condition['name'], 'singular') ?>><?php _e('Singular', 'woolentor') ?></option>
                                                            <option value="entire_site" disabled><?php _e('Archives (Pro)', 'woolentor') ?></option>
                                                            <option value="entire_site" disabled><?php _e('WooCommerce (Pro)', 'woolentor') ?></option>
                                                        </select>
                                                    </div>
                                                    <?php endif; ?>
                                                    
                                                    <!-- Generate sub_name -->
                                                    <?php
                                                        if( $condition['name'] && $condition['name'] != 'entire_site' ){
															echo '<div class="woolentor-admin-select wlpb-sub_name">';
                                                            echo Repeater_Helper::get_instance()->get_options_by_name( $condition['name'], 'html', $condition['sub_name'] );
															echo '</div>';
                                                        }
                                                    ?>

                                                    <!-- Generate sub_id -->
                                                    <?php
                                                        if( $condition['sub_name'] ){
															echo '<div class="woolentor-admin-select wlpb-sub_id">';
                                                            echo Repeater_Helper::get_instance()->get_options_by_sub_name( $condition['sub_name'], 'html', $condition['sub_id'] );	
															echo '</div>';
                                                        }
                                                    ?>
                                                </div>

                                                <div class="wlpb-repeater-fields-remove">
                                                    <i class="dashicons dashicons-trash"></i>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="wlpb-button-wrapper">
                                <button class="wlpb-repeater-fields-add" type="button"><?php _e('+ Add Condition', 'woolentor') ?></button>
                            </div>
                        </div>
                    </div>

                    <div id="wlpb-triggers" class="wlpb-tab-pane">
                        <div class="wplb-composite-field">
                            <div class="wplb-composite-field-switcher wlpb-field">
                                <input type="checkbox" name="on_page_load" id="on_page_load" <?php checked( $trigger_settings['on_page_load'], 1) ?>>
                            </div>
                            <div class="wplb-composite-field-label">
								<label for="on_page_load"><?php echo esc_html__('On Page Load', 'woolentor') ?></label>
                            </div>
                            <div class="wplb-composite-field-inner-controls">
                                <div class="wplb-composite-field-inner-control wlpb-field">
                                    <label for=""><?php echo esc_html__('Within (sec)', 'woolentor') ?></label>
                                    <div class="wplb-input-wrapper">
                                        <input type="number" name="page_load_delay" placeholder="0" min="0" step="1" id="" value="<?php echo esc_attr($trigger_settings['page_load_delay']) ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="wplb-composite-field">
                            <div class="wplb-composite-field-switcher wlpb-field">
                                <input type="checkbox" name="on_scroll" id="on_scroll" <?php checked( $trigger_settings['on_scroll'], 1) ?>>
                            </div>

                            <div class="wplb-composite-field-label">
								<label for="on_scroll"><?php echo esc_html__('On Scroll', 'woolentor') ?></label>
                            </div>

                            <div class="wplb-composite-field-inner-controls">

                                <div class="wplb-composite-field-inner-control wlpb-field">
                                    <label for=""><?php echo esc_html__('Direction', 'woolentor') ?></label>
                                    <div class="wplb-input-wrapper">
                                        <select name="scroll_direction" id="">
                                            <option value="up" <?php selected( $trigger_settings['scroll_direction'], 'up') ?>>Up</option>
                                            <option value="down" <?php selected( $trigger_settings['scroll_direction'], 'down') ?>>Down</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="wplb-composite-field-inner-control wlpb-field">
                                    <label for=""><?php echo esc_html__('Within (%)', 'woolentor') ?></label>
                                    <div class="wplb-input-wrapper">
                                        <input type="number" name="scroll_percentage" min="1" max="100" placeholder="50" value="<?php echo esc_attr($trigger_settings['scroll_percentage']) ?>">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <?php 
                            if(!Helper::is_pro_version_active()):
                        ?>
                        <fieldset>
                            <legend><?php _e('Pro', 'woolentor') ?></legend>
                        <?php endif; ?>

                            <div class="wplb-composite-field <?php echo esc_attr($opacity_class) ?>">
                                <div class="wplb-composite-field-switcher wlpb-field">
                                    <input type="checkbox" name="on_click" id="on_click" <?php checked( $on_click, 1) ?>>
                                </div>
                                <div class="wplb-composite-field-label">
                                    <label for="on_click"><?php echo esc_html__('On Click', 'woolentor') ?></label>
                                </div>
                                <div class="wplb-composite-field-inner-controls">
                                    <div class="wplb-composite-field-inner-control wlpb-field">
                                        <label for=""><?php echo esc_html__('Click Count', 'woolentor') ?></label>
                                        <div class="wplb-composite-field-inner-control wlpb-field">
                                            <input type="number" name="clicks_count" min="1" placeholder="1" value="<?php echo esc_attr($clicks_count) ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="wplb-composite-field <?php echo esc_attr($opacity_class) ?>">
                                <div class="wplb-composite-field-switcher wlpb-field">
                                    <input type="checkbox" name="on_click_element" id="on_click_element" <?php checked( $on_click_element, 1) ?>>
                                </div>
                                <div class="wplb-composite-field-label">
                                    <label for="on_click_selector"><?php echo esc_html__('On Click Specific Element', 'woolentor') ?></label>
                                </div>
                                <div class="wplb-composite-field-inner-controls">
                                    <div class="wplb-composite-field-inner-control wlpb-field wlpb-field-on_click_selector">
                                        <label for=""><?php echo esc_html__('Element Class/ID', 'woolentor') ?></label>
                                        <div class="wplb-composite-field-inner-control wlpb-field">
                                            <input type="text" name="on_click_selector" placeholder="#example-id" value="<?php echo esc_attr($on_click_selector) ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="wplb-composite-field <?php echo esc_attr($opacity_class) ?>">
                                <div class="wplb-composite-field-switcher wlpb-field">
                                    <input type="checkbox" name="on_inactivity" id="on_inactivity" <?php checked( $on_inactivity, 1) ?>>
                                </div>
                                <div class="wplb-composite-field-label">
                                    <label for="on_inactivity"><?php echo esc_html__('After Inactivity', 'woolentor') ?></label>
                                </div>
                                <div class="wplb-composite-field-inner-controls">
                                    <div class="wplb-composite-field-inner-control wlpb-field">
                                        <label for=""><?php echo esc_html__('Within (sec)', 'woolentor') ?></label>
                                        <div class="wplb-composite-field-inner-control wlpb-field">
                                            <input type="number" name="inactivity_time" min="0" step="1" placeholder="10" value="<?php echo esc_attr($inactivity_time) ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="wplb-composite-field <?php echo esc_attr($opacity_class) ?>">
                                <div class="wplb-composite-field-switcher wlpb-field">
                                    <input type="checkbox" name="on_exit_intent" id="on_exit_intent" <?php checked( $on_exit_intent, 1) ?>>
                                </div>
                                <div class="wplb-composite-field-label">
                                    <label for="on_exit_intent"><?php echo esc_html__('On Page Exit Intent', 'woolentor') ?></label>
                                </div>
                            </div>
                        
                        <?php 
                            if( !Helper::is_pro_version_active() ){
                                echo '</fieldset>';
                            }
                        ?>

                    </div>

                    <div id="wlpb-general" class="wlpb-tab-pane">
						<?php
							foreach( $general_fields as $key => $field ){
                                $value  = '';
                                $meta_value = isset( $popup_meta[$field['name']] ) ? $popup_meta[$field['name']] : '';
                                if( $meta_value ){
                                    $value = $meta_value;
                                }

								if( $field['type'] == 'checkbox' ){
									$value = $value == 1 ? 'on' : $value;
								}
                                
                                if( !Helper::is_pro_version_active() && isset($field['wlpb_is_pro']) && $field['wlpb_is_pro'] ){
                                    $value = '';
                                }

                                $field['value'] = $value;
								
								Woolentor_Admin_Fields_Manager::instance()->add_field( $field, '' );
							}
						?>
                    </div>

                    <!-- Advanced -->
                    <div id="wlpb-advanced" class="wlpb-tab-pane">
                        <div class="wplb-composite-field">
                            <div class="wplb-composite-field-switcher wlpb-field">
                                <input type="checkbox" name="do_not_show_again" id="do_not_show_again" <?php checked( $advanced_settings['do_not_show_again'], 1) ?>>
                            </div>
                            <div class="wplb-composite-field-label">
								<label for="do_not_show_again"><?php echo esc_html__('Do not show again', 'woolentor') ?></label>
                            </div>

                            <div class="wplb-composite-field-inner-controls wlpb-do-not-show-again-timespan">
                                <div class="wplb-composite-field-inner-control wlpb-field">
                                    <label for="do_not_show_again_timespan"><?php echo esc_html__('For (days)', 'woolentor') ?></label>
                                    <div class="wplb-input-wrapper">
                                        <input type="number" name="do_not_show_again_timespan" min="1" step="1" id="do_not_show_again_timespan" value="<?php echo esc_attr($advanced_settings['do_not_show_again_timespan']) ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="wplb-composite-field-inner-controls wlpb-do-not-show-again-close-count">
                                <div class="wplb-composite-field-inner-control wlpb-field">
                                    <label for="do_not_show_again_closecount"><?php echo esc_html__('If closed (times)', 'woolentor') ?></label>
                                    <div class="wplb-input-wrapper">
                                        <input type="number" name="do_not_show_again_closecount" min="1" step="1" id="do_not_show_again_closecount" data-close_count="<?php echo esc_attr($advanced_settings['do_not_show_again_closecount']) ?>" value="<?php echo esc_attr($advanced_settings['do_not_show_again_closecount']) ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <?php 
                            if(!Helper::is_pro_version_active()):
                        ?>
                        <fieldset>
                            <legend><?php _e('Pro', 'woolentor') ?></legend>
                        <?php endif; ?>

                            <!-- url_match -->
                            <div class="wplb-composite-field <?php echo esc_attr($opacity_class) ?>">
                                <div class="wplb-composite-field-switcher wlpb-field">
                                    <input type="checkbox" name="url_match" id="url_match" <?php checked( $url_match, 1) ?>>
                                </div>
                                <div class="wplb-composite-field-label">
                                    <label for="url_match"><?php echo esc_html__('Show Only if the URL', 'woolentor') ?></label>
                                </div>
                                
                                <div class="wplb-composite-field-inner-controls">
                                    <div class="wplb-composite-field-inner-control wlpb-field">
                                        <div class="wplb-input-wrapper">
                                            <select name="url_match_type" id="url_match_type">
                                                <option value="parameter" <?php selected( $url_match_type, 'parameter') ?>><?php _e('Parameter ', 'woolentor') ?></option>
                                                <option value="query_string" <?php selected( $url_match_type, 'query_string') ?>><?php _e('Query String Is', 'woolentor') ?></option>                     
                                                <option value="exact_match" <?php selected( $url_match_type, 'exact_match') ?>><?php _e('Is Exactly Matched', 'woolentor') ?></option>
                                                <option value="contains" <?php selected( $url_match_type, 'contains') ?>><?php _e('Contains', 'woolentor') ?></option>
                                                <option value="starts_with" <?php selected( $url_match_type, 'starts_with') ?>><?php _e(' Starts With', 'woolentor') ?></option>
                                                <option value="ends_with" <?php selected( $url_match_type, 'ends_with') ?>><?php _e('Ends With', 'woolentor') ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="wplb-composite-field-inner-controls wlpb-url-match-input">
                                    <div class="wplb-composite-field-inner-control wlpb-field">
                                        <label for="url_match_input"><?php echo esc_html__('Is', 'woolentor') ?></label>
                                        <div class="wplb-input-wrapper">
                                            <input type="text" name="url_match_input" id="url_match_input" data-close_count="<?php echo esc_attr($url_match_input) ?>" value="<?php echo esc_attr($url_match_input) ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="wplb-composite-field-inner-controls wlpb-url-match-value">
                                    <div class="wplb-composite-field-inner-control wlpb-field">
                                        <label for="url_match_value"><?php echo esc_html__('Value', 'woolentor') ?></label>
                                        <div class="wplb-input-wrapper">
                                            <input type="text" name="url_match_value" id="url_match_value" data-close_count="<?php echo esc_attr($url_match_value) ?>" value="<?php echo esc_attr($url_match_value) ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Devices -->
                            <div class="wplb-composite-field <?php echo esc_attr($opacity_class) ?>">
                                <div class="wplb-composite-field-switcher wlpb-field">
                                    <input type="checkbox" name="show_on_devices" id="show_on_devices" <?php checked( $show_on_devices, 1) ?>> 
                                </div>
                                <div class="wplb-composite-field-label">
                                    <label for="show_on_devices"><?php echo esc_html__('Show Only on Devices', 'woolentor') ?></label>
                                </div>
                                
                                <div class="wplb-composite-field-inner-controls wlpb-device-types">
                                    <div class="wplb-composite-field-inner-control wlpb-field">
                                        <div class="wplb-input-wrapper">
                                            <select name="devices[]" multiple="multiple">
                                                <option value="desktop" <?php echo in_array('desktop', $allowed_devices) ? 'selected': '' ?>><?php _e('Desktop ', 'woolentor') ?></option>
                                                <option value="tablet" <?php echo in_array('tablet', $allowed_devices) ? 'selected': '' ?>><?php _e('Tablet', 'woolentor') ?></option>
                                                <option value="mobile" <?php echo in_array('mobile', $allowed_devices) ? 'selected': '' ?>><?php _e('Mobile', 'woolentor') ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- browsers -->
                            <div class="wplb-composite-field <?php echo esc_attr($opacity_class) ?>">
                                <div class="wplb-composite-field-switcher wlpb-field">
                                        <input type="checkbox" name="show_on_browsers" id="show_on_browsers" <?php checked( $show_on_browsers, 1) ?>> 
                                </div>
                                <div class="wplb-composite-field-label">
                                    <label for="show_on_browsers"><?php echo esc_html__('Show Only on Browsers', 'woolentor') ?></label>
                                </div>

                                <div class="wplb-composite-field-inner-controls wlpb-browsers">
                                    <div class="wplb-composite-field-inner-control wlpb-field">
                                        <div class="wplb-input-wrapper">
                                            <select name="browsers[]" multiple="multiple">
                                                <option value="chrome" <?php echo in_array('chrome', $allowed_browsers) ? 'selected': '' ?>><?php _e('Chrome ', 'woolentor') ?></option>
                                                <option value="firefox" <?php echo in_array('firefox', $allowed_browsers) ? 'selected': '' ?>><?php _e('Firefox', 'woolentor') ?></option>
                                                <option value="safari" <?php echo in_array('safari', $allowed_browsers) ? 'selected': '' ?>><?php _e('Safari', 'woolentor') ?></option>
                                                <option value="opera" <?php echo in_array('opera', $allowed_browsers) ? 'selected': '' ?>><?php _e('Opera', 'woolentor') ?></option>
                                                <option value="ie" <?php echo in_array('ie', $allowed_browsers) ? 'selected': '' ?>><?php _e('IE', 'woolentor') ?></option>
                                                <option value="edge" <?php echo in_array('edge', $allowed_browsers) ? 'selected': '' ?>><?php _e('Edge', 'woolentor') ?></option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php 
                            if( !Helper::is_pro_version_active() ){
                                echo '</fieldset>';
                            }
                        ?>

                    </div>

                    <!-- Custmize Tab -->
                    <div id="wlpb-customize" class="wlpb-tab-pane">
						<?php
							foreach( $customization_fields as $key => $field ){
                                $value  = '';
                                $global_value = '';
                                if( $field['name'] == 'width' ){
                                    $global_value = woolentor_get_option( 'width', 'woolentor_popup_builder_settings', '600px' );
                                } else if( $field['name'] == 'height' ){
                                    $global_value = woolentor_get_option( 'height', 'woolentor_popup_builder_settings', '' );
                                } elseif( $field['name'] == 'z_index' ){
                                    $global_value = woolentor_get_option( 'z_index', 'woolentor_popup_builder_settings', '999999' );
                                }

                                $meta_value = isset( $popup_meta[$field['name']] ) ? $popup_meta[$field['name']] : '';
                                if( $meta_value ){
                                    $value = $meta_value;
                                }

								if( $field['type'] == 'checkbox' ){
									$value = $value == 1 ? 'on' : $value;
								}

                                if( !Helper::is_pro_version_active() && isset($field['wlpb_is_pro']) && $field['wlpb_is_pro'] ){
                                    $value = '';
                                }

                                $field['value']       = $value;
                                $field['placeholder'] =  $field['type'] == 'checkbox' ? '' : $global_value;
								
								Woolentor_Admin_Fields_Manager::instance()->add_field( $field, '' );
							}
						?>
                    </div>
                    <!-- /Custmize Tab -->
                </div>
            </div>
        </div>

        <div class="woolentor-template-edit-footer">

            <div class="woolentor-template-button-group">
                <div class="woolentor-template-button-item">
                    <button class="button button-primary" disabled="disabled" data-popup_id="<?php echo get_the_id() ?>"><?php _e('Save Settings', 'woolentor') ?></button>
                </div>
            </div>

        </div>
    </div>

    <div class="wlpb-repeater-clone-field">
        <div class="wlpb-repeater-conditions-repeater-row-controls">                
            <div class="wlpb-repeater-controls-wrapper">
                <div class="woolentor-admin-select wlpb-type">
                    <select data-name="type" id="">
                        <option value="include"><?php _e('Include', 'woolentor') ?></option>
                        <option value="exclude"><?php _e('Exclude', 'woolentor') ?></option>
                    </select>
                </div>

                <div class="woolentor-admin-select wlpb-name">
                    <?php echo Repeater_Helper::get_instance()->get_condition_type_options( 'html' ) ?>
                </div>
            </div>

            <div class="wlpb-repeater-fields-remove">
                <i class="dashicons dashicons-trash"></i>
            </div>
        </div>
    </div>
</div>
</script>