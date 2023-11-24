<?php
namespace Woolentor\Modules\Popup_Builder\Frontend;
use Woolentor\Modules\Popup_Builder\Helper;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Popup_Rules_Checker{

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
     * @return bool true if the popup should be shown, false otherwise
     */
    public function check_rules( $popup_id = 0, $popup_showing_rules = array() ){
        $return_value = false;

        // If a popup is being previewed, then show it regard less of the rules.
        if( $preview_id = Helper::get_preview_id() ){
            if( $preview_id == $popup_id ){
                return true;
            } else {
                return false; // Don't show any other popup if a popup is being previewed.
            }
        }

        // For elementor preview mode we should not check the rules.
        if( Helper::get_instance()->is_elementor_editor() ){
            return $return_value;
        }

        // If vising popup template type single page then show it regardless of the rules.
        if( is_singular('woolentor-template') && $popup_id == get_queried_object_id() ){
            return true;
        } elseif( is_singular('woolentor-template') ) {
            return false; // Don't show any other popup.
        }

        // Filter the rules.
        // If there is any rule like array('include', 'entire_site', 'all', '0') & array('exclude', 'entire_site', 'all', '0').
        // then skip/filter the boths include & exclude rules. We are treating this like 5 - 5 = 0.
        $filtered_rules = array();
        foreach( $popup_showing_rules as $key => $item ){
            $temp = $item;

            if( $item['type'] == 'include' ){
                $temp['type'] = 'exclude';
            } else {
                $temp['type'] = 'include';
            }
                
            if( !in_array($temp, $popup_showing_rules) ){
                $filtered_rules[] = $item;
            }
        }

        // Sort the rules by type, exclude rules first, include last
        $types = array_column($filtered_rules, 'type');
        array_multisort($types, SORT_ASC, $filtered_rules);

        if( Helper::get_instance()->wlpb_debug_status() ){
            echo '<pre>';
            echo 'filtered_rules';
            var_dump($filtered_rules);
            echo '</pre>';
        }

        // Loop through the rules
        foreach( $filtered_rules as $rule ){
            $matched = false;

            $rule_type     = $rule['type']; // include, exclude.
            $rule_name     = !empty($rule['name']) ? $rule['name'] : ''; // entire_site, singular, archives, woocommerce.
            $rule_sub_name = !empty($rule['sub_name']) ? $rule['sub_name'] : ''; // all, front_page, post_types(posts,in_categories, in_tags, in_taxonomies).
            $rule_sub_id   = !empty($rule['sub_id']) ? $rule['sub_id'] : ''; // 0, 1, 2, 3, 4, 5, 6, 7, 8, 9.

            // Check the rule with current page.
            // If the type is exclude and the rule is matched then the popup should not be shown and break the loop.
            // If the type is include and the rule is matched then the popup should be shown and continue the loop to check other rules if any other include rule is matched.
            switch( $rule_type ){
                case 'include':
                    $matched = $this->check_include_rule( $rule_name, $rule_sub_name, $rule_sub_id );

                    if( $matched ){
                        $return_value = true;
                    }

                    break; // break the switch

                case 'exclude':
                    $matched = $this->check_exclude_rule( $rule_name, $rule_sub_name, $rule_sub_id );

                    if( $matched ){
                        $return_value = false;
                        break 2; // break the loop
                    }

                    break;
            }
        }

        return $return_value;
    }

    /**
     * @return bool true if the include rule is matched(popup should be shown), false otherwise
     */
    public function check_include_rule( $rule_name, $rule_sub_name, $rule_sub_id ){
        $return_value = false;

        switch( $rule_name ){
            case 'entire_site':
                $return_value = $this->check_entire_site_rule();
                break;

            case 'singular':
                $return_value = $this->check_singular_rule( $rule_sub_name, $rule_sub_id );
                break;

            case 'archives':
                $return_value = $this->check_archives_rule( $rule_sub_name, $rule_sub_id );
                break;

            case 'woocommerce':
                $return_value = $this->check_woocommerce_rule( $rule_sub_name, $rule_sub_id );
                break;
        }

        return $return_value;
    }

    /**
     * @return bool true if the exclude rule is matched(popup should not be shown), false otherwise
     */
    public function check_exclude_rule( $rule_name, $rule_sub_name, $rule_sub_id ){
        $return_value = false;

        switch( $rule_name ){
            case 'entire_site':
                $return_value = $this->check_entire_site_rule();
                break;

            case 'singular':
                $return_value = $this->check_singular_rule( $rule_sub_name, $rule_sub_id );
                break;

            case 'archives':
                $return_value = $this->check_archives_rule( $rule_sub_name, $rule_sub_id );
                break;

            case 'woocommerce':
                $return_value = $this->check_woocommerce_rule( $rule_sub_name, $rule_sub_id );
                break;
        }

        return $return_value;
    }

    /**
     * @return bool true if the entire_site rule is matched, false otherwise
     */
    public function check_entire_site_rule(){
        $return_value = true;

        if( isset($_GET['action']) && $_GET['action'] == 'elementor' ){
            $return_value = false;
        }

        return $return_value;
    }

    /**
     * Check WooCommerce Rules.
     * 
     * @return bool
     */
    public function check_woocommerce_rule( $rule_sub_name, $rule_sub_id ){
        return false;
    }

    /**
     * Check Archives Rules (except WooCommerce).
     * 
     * @param string $rule_sub_name
     * @param string $rule_sub_id
     * 
     * @return bool
     */
    public function check_archives_rule( $rule_sub_name, $rule_sub_id ){
        return false;
    }

    /**
     * Check Singular Rules (except WooCommerce).
     * 
     * @param string $rule_sub_name
     * @param string $rule_sub_id
     * 
     * @return bool
     */
    public function check_singular_rule( $rule_sub_name, $rule_sub_id ){
        $return_value = false;

        // If the rule is for front page.
        if( $rule_sub_name == 'front_page' ){
            if( is_front_page() ){
                $return_value = true;
            }
        }

        // If the rule is for 404 page.
        if( $rule_sub_name == '404' ){
            if( is_404() ){
                $return_value = true;
            }
        }

        if( !is_singular() ){
            return $return_value;
        }

        // Exclude WooCommerce single pages since they are available in separated rule.
        if( function_exists('is_product') && is_product() ){
            return $return_value;
        }

        // All Singulars.
        if( empty($rule_sub_name) ){
            $return_value = true;
        }

        // Check if the post type is valid.
        if( post_type_exists($rule_sub_name) ){

            // All Singulars of a specific post type.
            if( empty($rule_sub_id) && is_singular($rule_sub_name) ){
                $return_value = true;

            // Specific Singulars of a specific post type.
            } else {
                if( is_singular($rule_sub_name) && in_array( get_queried_object_id(), explode(',', $rule_sub_id) ) ){
                    $return_value = true;
                }
            }
        }

        $current_post_id = get_queried_object_id(); // get_the_ID return the popup id so we need to use get_queried_object_id() instead.
        $current_post_terms = wp_get_post_terms( $current_post_id, $rule_sub_name, array( 'fields' => 'ids' ) );
        $current_post_terms = is_wp_error( $current_post_terms ) ? array() : $current_post_terms;

        // All Singulars of a specific taxonomy.

        // Check if in prefix is present in the sub_name.
        if( strpos( $rule_sub_name, 'in_' ) !== false ){
            $rule_sub_name = str_replace( 'in_', '', $rule_sub_name );

            // Check if the sub_name is any of the taxonomies.
            $taxonomies = get_taxonomies( array( 'public' => true ) );

            if( in_array( $rule_sub_name, $taxonomies ) ){
                if( $this->check_post_is_in_any_of_the_categories($rule_sub_name, $rule_sub_id, get_queried_object_id()) ){
                    $return_value = true;
                }
            }
        }

        return $return_value;
    }
    
    /**
     * Check if a post is in any of the categories.
     * 
     * @param string $selected_taxonomy The selected taxonomy (backend option).
     * @param string $selected_terms The selected term ids (backend option) separated by comma. If empty then it represents all terms.
     * @param int $current_post_id The current post id.
     * 
     * @return bool
     */
    public function check_post_is_in_any_of_the_categories( $selected_taxonomy, $selected_terms, $current_post_id ){
        $return_value = false;

        // Get categories/terms of the current post.
        $current_post_terms = wp_get_post_terms( $current_post_id, $selected_taxonomy, array( 'fields' => 'ids' ) );
        $current_post_terms = is_wp_error( $current_post_terms ) ? array() : $current_post_terms;
        
        // Get post type of the selected taxonomy.
        $taxonomies = get_taxonomies( array( 'public' => true ) );
        $post_type_of_selected_taxonomy = get_taxonomy( $selected_taxonomy ) ? get_taxonomy( $selected_taxonomy )->object_type : '';

        // If the selected taxonomy is a valid taxonomy.
        if( in_array( $selected_taxonomy, $taxonomies ) ){
            
            // Get posts of the $selected_terms in the $selected_taxonomy.
            // We will need to match the $current_post_terms with the $posts_of_selected_terms.
            $posts_of_selected_terms = get_posts( array(
                'post_type' => $post_type_of_selected_taxonomy,
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => $selected_taxonomy,
                        'field' => 'term_id',
                        'terms' => $selected_terms,
                    ),
                ),
                'fields' => 'ids',
            ) );
            
            // Get terms of the $selected_taxonomy.
            $terms_of_selected_taxonomy = get_terms( array(
                'taxonomy'   => $selected_taxonomy,
                'hide_empty' => false,
                'fields'     => 'ids',
            ) );
                    
            if( empty($selected_terms) ){

                // Check if the $current_post_terms is in the $terms.
                if( !empty($current_post_terms) && array_intersect( $current_post_terms, $terms_of_selected_taxonomy ) ){
                    $return_value = true;
                }

            // If the $sub_id has term ids then the popup should be shown on the posts with those term ids.
            }else{
                $selected_terms = explode( ',', $selected_terms );
                
                if( !empty( $selected_terms ) && in_array( $current_post_id, $posts_of_selected_terms ) ){
                    $return_value = true;
                }
            }
        }

        return $return_value;
    }
}