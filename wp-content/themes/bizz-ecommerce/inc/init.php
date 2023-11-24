<?php 

get_template_part( 'inc/admin-function');

//custom-style
get_template_part( 'inc/bizz-ecommerce-custom-style');

// theme-option
get_template_part( 'lib/texture-option/texture-option');

// customizer
get_template_part('customizer/models/class-bizz-ecommerce-singleton');
get_template_part('customizer/models/class-bizz-ecommerce-defaults-models');
get_template_part('customizer/repeater/class-bizz-ecommerce-repeater');

/*customizer*/

get_template_part('customizer/extend-customizer/class-bizz-ecommerce-wp-customize-panel');
get_template_part('customizer/extend-customizer/class-bizz-ecommerce-wp-customize-section');
get_template_part('customizer/customizer-radio-image/class/class-bizz-ecommerce-customize-control-radio-image');
get_template_part('customizer/customizer-range-value/class/class-bizz-ecommerce-customizer-range-value-control');

get_template_part('customizer/color/class-control-color');
get_template_part('customizer/customize-buttonset/class-control-buttonset');

get_template_part('customizer/background/class-bizz-ecommerce-background-image-control');

get_template_part('customizer/customizer-toggle/class-bizz-ecommerce-toggle-control');

get_template_part('customizer/custom-customizer');
get_template_part('customizer/customizer');

/******************************/
// woocommerce
/******************************/
get_template_part( 'inc/woocommerce/woo-core');
get_template_part( 'inc/woocommerce/woo-function');
get_template_part('inc/woocommerce/woocommerce-ajax');