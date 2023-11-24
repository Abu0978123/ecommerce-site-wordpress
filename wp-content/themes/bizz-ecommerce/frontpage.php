<?php 
/**
 * Template Name: Homepage Template
 * @package testerwp
 * @subpackage Bizz Ecommerce
 * @since 1.0.0
 */
get_header();?>

   <div class="bg-w">
         <div class="main-page">
            
               <?php
                    if( shortcode_exists( 'bizz-ecommerce' ) ){
                       do_shortcode("[bizz-ecommerce section='bizz_ecommerce_show_frontpage']");
                    }
               ?>
            
         </div>
   </div>

<?php get_footer();