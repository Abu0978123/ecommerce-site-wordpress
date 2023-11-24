<?php
namespace Woolentor\Modules\Popup_Builder;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Shortcodes{

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
        // Add the shortcode
        add_shortcode('wlpb_trigger_button', array($this, 'wlpb_trigger_button_shortcode_cb'));
    }

    public function wlpb_trigger_button_shortcode_cb( $atts ) {
        // Default attribute values.
        $atts = shortcode_atts( array(
            'action'        => 'close_popup', // close_popup, go_back_to_previous_page
            'redirect_url'  => '',
            'button_text'   => __( 'Close', 'woolentor' ),
            'button_icon'   => '',
            'icon_position' => 'left',
            'button_align'  => 'center',
        ), $atts );

        // Sanitize and extract attributes.
        $action        = sanitize_text_field($atts['action']);
        $redirect_url  = esc_url( $atts['redirect_url'] );
        $button_text   = sanitize_text_field($atts['button_text']);
        $button_icon   = $atts['button_icon'];
        $icon_position = sanitize_text_field($atts['icon_position']);
        $button_align  = sanitize_text_field($atts['button_align']);

        // Check if $button_icon is a plain class or an HTML.
        if (strpos($button_icon, '&lt;') !== false) {
            $button_icon = html_entity_decode($button_icon);
        } elseif( $button_icon ) {
            $button_icon = '<i class="' . $button_icon . '"></i>';
        }

        ob_start();
        ?>
        
        <div class="wlpb-trigger-button-wrapper wlpb-trigger-button-align-<?php echo esc_attr($button_align) ?>">
            <span class="wlpb-trigger-button wlpb-trigger-close" data-action="<?php echo esc_attr($action); ?>" data-redirect_url="<?php echo esc_url($redirect_url); ?>">
                <?php if ($icon_position === 'left' && !empty($button_icon)): ?>
                    <?php echo wp_kses_post($button_icon); ?>
                <?php endif; ?>

                <span class="wlpb-trigger-button-text"><?php echo wp_kses_post($button_text); ?></span>

                <?php if ($icon_position === 'right' && !empty($button_icon)): ?>
                    <?php echo wp_kses_post($button_icon); ?>
                <?php endif; ?>
            </span>
        </div><!-- .wlpb-trigger-button-wrapper -->
        

        <?php
        return ob_get_clean();
    }
}