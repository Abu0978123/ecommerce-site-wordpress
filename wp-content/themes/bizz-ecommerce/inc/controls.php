<?php

/**
 * excerpt lenth.
 */
if (!function_exists('bizz_ecommerce_custom_excerpt_length')) :
    function bizz_ecommerce_custom_excerpt_length($length)
    {
        if (is_admin()) {
            return $length;
        }

        $excpt_length = get_theme_mod('bizz_ecommerce_excerpt_general_section','55');
        if (!empty($excpt_length)) {
            return $excpt_length;
        }
        return 55;
    }
endif;
add_filter('excerpt_length', 'bizz_ecommerce_custom_excerpt_length');

function bizz_ecommerce_excerpt_more( $more ) {
	if ( is_admin() ) {
		$more = '...';
   		return $more;
   	}
}
add_filter('excerpt_more', 'bizz_ecommerce_excerpt_more');

function bizz_ecommerce_get_post_view() {
    $count = get_post_meta( get_the_ID(), 'post_views_count', true );
    return "$count";
}
function bizz_ecommerce_set_post_view() {
    $key = 'post_views_count';
    $post_id = get_the_ID();
    $count = (int) get_post_meta( $post_id, $key, true );
    $count++;
    update_post_meta( $post_id, $key, $count );
}
?>