<?php
/**
 * Buzz eCommerce Import Options 
 * Demo Import File 
 */
function buzz_ecommerce_import_files() {
    return array(
      array(
        'import_file_name'           => 'Default',
        'categories'                 => array( 'eCommerce'),
        'import_file_url'            =>  'http://demo.spiderbuzz.com/deom-data/buzz-ecommerce/default/all-content.xml',
        'import_widget_file_url'     =>  'http://demo.spiderbuzz.com/deom-data/buzz-ecommerce/default/widget.wie',
        'import_customizer_file_url' =>  'http://demo.spiderbuzz.com/deom-data/buzz-ecommerce/default/customizer.dat',
        'import_preview_image_url'   =>  'http://demo.spiderbuzz.com/deom-data/buzz-ecommerce/default/screenshot.png',
        'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'buzz-ecommerce' ),
        'preview_url'                => 'http://demo.spiderbuzz.com/buzz-ecommerce/',
      ),
      array(
        'import_file_name'           => 'Musical',
        'categories'                 => array( 'eCommerce'),
        'import_file_url'            =>  'http://demo.spiderbuzz.com/deom-data/buzz-ecommerce/musical/all-content.xml',
        'import_widget_file_url'     =>  'http://demo.spiderbuzz.com/deom-data/buzz-ecommerce/musical/widget.wie',
        'import_customizer_file_url' =>  'http://demo.spiderbuzz.com/deom-data/buzz-ecommerce/musical/customizer.dat',
        'import_preview_image_url'   =>  'http://demo.spiderbuzz.com/deom-data/buzz-ecommerce/musical/screenshot.png',
        'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'buzz-ecommerce' ),
        'preview_url'                => 'http://demo.spiderbuzz.com/buzz-ecommerce/home2',
      ),
      array(
        'import_file_name'           => 'Fashion',
        'categories'                 => array( 'eCommerce'),
        'import_file_url'            =>  'http://demo.spiderbuzz.com/deom-data/buzz-ecommerce/fashion/all-content.xml',
        'import_widget_file_url'     =>  'http://demo.spiderbuzz.com/deom-data/buzz-ecommerce/fashion/widget.wie',
        'import_customizer_file_url' =>  'http://demo.spiderbuzz.com/deom-data/buzz-ecommerce/fashion/customizer.dat',
        'import_preview_image_url'   =>  'http://demo.spiderbuzz.com/deom-data/buzz-ecommerce/fashion/screenshot.png',
        'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'buzz-ecommerce' ),
        'preview_url'                => 'http://demo.spiderbuzz.com/buzz-ecommerce/home3',
      ),
      
      
    );
  }
  add_filter( 'pt-ocdi/import_files', 'buzz_ecommerce_import_files' );


  
/*****************************************************************
*         After demo import options
*************************************************************/
function buzz_ecommerce_after_import_setup() {
  // Assign menus to their locations.
  $main_menu = get_term_by( 'name', 'buzz-main-menu', 'nav_menu' );
  
  set_theme_mod( 'nav_menu_locations', array(
    'menu-1' => $main_menu->term_id,
    )
  );

  // Assign front page and posts page (blog page).
  $front_page = get_page_by_title( 'Sample Page ' );
  $blog_page_id  = get_page_by_title( 'Blog' );

  update_option( 'show_on_front', 'page' );
  update_option( 'page_on_front', $front_page->ID );
  //update page template 
  update_post_meta($front_page->ID, '_wp_page_template', 'buzz-ecommerce-frontpage.php');
  
  update_option( 'page_for_posts', $blog_page_id->ID );


  
}
add_action( 'pt-ocdi/after_import', 'buzz_ecommerce_after_import_setup' );