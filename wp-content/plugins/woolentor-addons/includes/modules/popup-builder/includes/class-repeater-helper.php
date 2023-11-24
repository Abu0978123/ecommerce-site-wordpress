<?php
namespace Woolentor\Modules\Popup_Builder;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Repeater_Helper{

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

    public function get_condition_type_options( $return = 'array' ) {
        $options = array(
            'entire_site'   => __( 'Entire Site', 'woolentor' ),
            'singular'      => __( 'Singular', 'woolentor' ),
            'archives'      => __( 'Archives (Pro)', 'woolentor' ),
            'woocommerce'   => __( 'WooCommerce (Pro)', 'woolentor' ),
        );
        $html    = '';

        $options = apply_filters( 'wlpb_condition_type_options', $options );

        if( $options && $return == 'html' ){
            $html .= '<select data-name="namee">';
            foreach ( $options as $key => $value ) {
                if (strpos($value, '(Pro)') !== false) {
                    $html .= '<option value="'. $key .'" disabled>'. $value .'</option>';
                } else {
                    $html .= '<option value="'. $key .'">'. $value .'</option>';
                }
            }
            $html .= '</select>';

            $options = $html;
        }

        return $options;
    }

    /**
     * Get sub_name options.
     * 
     * @param name based on name we will get options.
     * @param return type of the return value. array or html.
     * 
     * @return array|string
     */
    public function get_options_by_name( $name = 'entire_site', $return = 'array', $selected_vlaue = '' ) {
        $options = array();
        $html    = '';

        if( $name === 'archives' ){
            $options = $this->get_archive_options();
        } else if( $name == 'singular' ){
            $options = $this->get_singular_options();
        } else if( $name == 'woocommerce' ){
            $options = $this->get_woocommerce_options();
        }

        if( $options && $return == 'html' ){
            $html .= '<select data-name="sub_name">';
            foreach ( $options as $key => $value ) {
                if( is_array($value) ){
                    $html .= '<optgroup label="'. $key .'">';
                    foreach ( $value as $k => $v ) {
                        $html .= '<option value="'. $k .'" '. selected( $selected_vlaue, $k, false ) .'>'. $v .'</option>';
                    }
                    $html .= '</optgroup>';
                } else{
                    $html .= '<option value="'. $key .'">'. $value .'</option>';
                }
            }
            $html .= '</select>';

            $options = $html;
        }

        return $options;
    }

    /**
     * Get sub id options.
     * 
     * @param sub_name either string / post_type / taxonomy.
     * @param return type of the return value. array or html.
     * 
     * @return array|string
     */
    public function get_options_by_sub_name( $sub_name = '', $return = 'array', $selected_vlaue = '' ){
        $options    = array();
        $options[]  = __( 'All', 'woolentor');
        $html       = '';

        // Check iff sub name is a post type or taxonomy.
        if( post_type_exists( $sub_name ) ){
            $args = array(
                'post_type'         => $sub_name,
                'posts_per_page'    => apply_filters( 'wlpb_dropdown_posts_limit', 250 ),
                'post_status'       => 'publish',
                'fields'            => 'ids',
            );

            $posts = get_posts( $args );
            if( !empty($posts) ){
                foreach ( $posts as $post_id ) {
                    $options[$post_id] = get_the_title( $post_id );
                }
            }
        } else if( taxonomy_exists( $sub_name ) ){
            $args = array(
                'taxonomy'   => $sub_name,
                'hide_empty' => false,
            );

            $terms = get_terms( $args );
            if( !empty($terms) ){
                foreach ( $terms as $term ) {
                    $options[$term->term_id] = $term->name;
                }
            }
        }

        if( $return == 'html' ){
            $html .= '<select data-name="sub_id">';
            foreach ( $options as $key => $value ) {
                $selected_sub_id  = isset($popup_settings['conditions'][$key]['sub_id']) ? $popup_settings['conditions'][$key]['sub_id'] : '';

                // $html .= '<option value="'. $key .'"'. selected( $selected_sub_id, $value ) .'>'. $value .'</option>';
                $html .= '<option value="'. $key .'" '. selected( $selected_vlaue, $key, false ) .'>'. $value .'</option>';
            }
            $html .= '</select>';

            $options = $html;
        }

        return $options;
    }

    /**
     * Get archive options.
     * 
     * @return array
     */
    public function get_archive_options(){
        $options = array();

        // Default options.
        $options[] = __( 'All Archives', 'woolentor' );

        // Get post type options.
        $options = array_merge( $options, $this->get_post_types_archive_options() );
        
        return $options;
    }

    /**
     * Get all singular options.
     * 
     * @return array
     */
    public function get_singular_options(){
        $options = array();

        // Default options.
        $options[] = __( 'All Singular', 'woolentor' );
        $options['front_page'] = __( 'Front Page', 'woolentor' );

        // Get post type options.
        $options = array_merge( $options, $this->get_post_types_singular_options() );

        $options['404'] = __( '404 Page', 'woolentor' );
        
        return $options;
    }

    /**
     * Get WooCommerce options.
     * 
     * @return array
     */
    public function get_woocommerce_options(){
        $options = array();

        // Defatult options.
        $options[] = __( 'Entire Shop', 'woolentor' );

        // Archive options.
        $options = array_merge($options,  $this->get_post_types_archive_options( 'woocommerce' )); 

        // Singular options.
        $options = array_merge($options,  $this->get_post_types_singular_options( 'woocommerce' ));

        // Cart options. @todo add it later.
        // $options['Cart'] = $this->get_cart_options();

        return $options;
    }

    /**
     * Get only post types archive options for the dropdown.
     * @var type either general or woocommerce.
     * 
     * @return array
     */
    public function get_post_types_archive_options( $type = 'general' ){
        $options = array();

        $post_types = get_post_types( array( 'public' => true ), 'objects' );

        // Loop through all post types
        foreach ( $post_types as $post_type ) {

            // If type is general and post type is product then continue.
            if( $type == 'general' && $post_type->name == 'product' ){
                continue;
            }

            // If type is woocommerce and post type is not product then continue.
            if( $type == 'woocommerce' && $post_type->name != 'product' ){
                continue;
            }

            // If post type does not have archive.
            if ( !$post_type->has_archive ) {
                continue;
            }

            $archives = array();
            $optgroup_name = $post_type->label. ' Archive';

            $taxonomies = get_object_taxonomies( $post_type->name, 'objects' );
            if( !empty($taxonomies) ){
                $archives[$post_type->name. '_archive'] = $optgroup_name;

                foreach ( $taxonomies as $taxonomy ) {
                    if ( $taxonomy->public ) {
                        $archives[$taxonomy->name] = $taxonomy->label;
                    }
                }

                $options[$optgroup_name] = $archives;
            } else {
                $options[$post_type->name. '_archive'] = $optgroup_name;
            }
        }
        
        return $options;
    }

    /**
     * Get only post types singular options for the dropdown.
     * @var type either general or woocommerce.
     * 
     * @return array
     */
    public function get_post_types_singular_options( $type = 'general' ){
        $options = array();

        // Loop through all post types
        $post_types = get_post_types( array( 'public' => true ), 'objects' );
        foreach ( $post_types as $post_type ) {
            // Manually exclude the post types.
            if( in_array( $post_type->name, array( 'media' ) ) ){
                continue;
            }

            // Exclude the one which is not built in and not have archive.
            if( !$post_type->_builtin && !$post_type->has_archive ){
                continue;
            }

            // If type is general and post type is product then continue.
            if( $type == 'general' && $post_type->name == 'product' ){
                continue;
            }

            // If type is woocommerce and post type is not product then continue.
            if( $type == 'woocommerce' && $post_type->name != 'product' ){
                continue;
            }

            $arr = array();
     
            $optgroup_name = $post_type->labels->singular_name;
            $arr[$post_type->name] = $post_type->label;
            
            $taxonomies = get_object_taxonomies( $post_type->name, 'objects' );
            if( !empty($taxonomies) ){

                foreach ( $taxonomies as $taxonomy ) {
                    if ( $taxonomy->public ) {
                        $arr['in_'. $taxonomy->name] = 'In ' .$taxonomy->label;
                    }
                }
                
            }

            $options[$optgroup_name] = $arr;
        }

        return $options;
    }

    /**
     * Get cart options.
     * 
     * @return array
     */
    public function get_cart_options(){
        $options = array();

        $options['is_empty']                    = __( 'Is empty', 'woolentor' );
        $options['total_price_is_greater_than'] = __( 'Total price is greater than X ammount', 'woolentor' );
        $options['total_price_is_less_than']    = __( 'Total price is Less than X ammount', 'woolentor' );

        return $options;
    }
}