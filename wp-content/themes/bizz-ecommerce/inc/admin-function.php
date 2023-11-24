<?php 
/**
 * Common Function for Bizz EcommerceTheme.
 *
 * @package     Bizz Ecommerce
 * @author      wptexture
 * @copyright   Copyright (c) 2019, bizz ecommerce
 * @since       bizz ecommcerce 1.0.0
 */
 if ( ! function_exists( 'bizz_ecommerce_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 * Does nothing if the custom logo is not available.
 */
function bizz_ecommerce_custom_logo(){
    if ( function_exists( 'the_custom_logo' ) ){?>
    	<div class="texture-logo">
        <?php the_custom_logo();?>
        </div>
   <?php  }
}
endif;
/*********************/
// Menu 
/*********************/
function bizz_ecommerce_header_menu_style(){
 $bizz_ecommerce_main_header_layout = get_theme_mod('bizz_ecommerce_main_header_layout');
        	$menustyle='horizontal';	
        	return $menustyle;
		}
function bizz_ecommerce_add_classes_to_page_menu( $ulclass ){
  return preg_replace( '/<ul>/', '<ul class="bizz-ecommerce-menu" data-menu-style='.esc_attr(bizz_ecommerce_header_menu_style()).'>', $ulclass, 1 );
}
add_filter( 'wp_page_menu', 'bizz_ecommerce_add_classes_to_page_menu' );		
     
	  // MAIN MENU
           function bizz_ecommerce_main_nav_menu(){
              wp_nav_menu( array(
              'theme_location' => 'bizz-ecommerce-main-menu', 
              'container'      => false, 
              'link_before'    =>'<span class="bizz-ecommerce-menu-link">',
              'link_after'     => '</span>',
              'items_wrap'     => '<ul id="bizz-ecommerce-menu" class="bizz-ecommerce-menu" data-menu-style='.esc_attr(bizz_ecommerce_header_menu_style()).'>%3$s</ul>',
             ));
         }
          
function bizz_ecommerce_add_classes_to_page_menu_default( $ulclass ){
return preg_replace( '/<ul>/', '<ul class="bizz-ecommerce-menu" data-menu-style="horizontal">', $ulclass, 1 );
}
add_filter( 'wp_page_menu', 'bizz_ecommerce_add_classes_to_page_menu_default' );
/************************/
// description Menu
/************************/
function bizz_ecommerce_nav_description( $item_output, $item, $depth, $args ){
    if ( !empty( $item->description ) ) {
        $item_output = str_replace( $args->link_after . '</a>', '<p class="menu-item-description">' . esc_html($item->description) . '</p>' . $args->link_after . '</a>', $item_output );
    }
 
    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'bizz_ecommerce_nav_description', 10, 4 );

/*********************/
/**
 * Function to check if it is Internet Explorer
 */
if ( ! function_exists( 'bizz_ecommerce_check_is_ie' ) ) :
	/**
	 * Function to check if it is Internet Explorer.
	 *
	 * @return true | false boolean
	 */
	function bizz_ecommerce_check_is_ie() {

		$is_ie = false;

		$ua = htmlentities( $_SERVER['HTTP_USER_AGENT'], ENT_QUOTES, 'UTF-8' );
		if ( strpos( $ua, 'Trident/7.0' ) !== false ) {
			$is_ie = true;
		}

		return apply_filters( 'bizz_ecommerce_check_is_ie', $is_ie );
	}

endif;
/**
 * ratia image
 */
if ( ! function_exists( 'bizz_ecommerce_replace_header_attr' ) ) :
	/**
	 * Replace header logo.
	 *
	 * @param array  $attr Image.
	 * @param object $attachment Image obj.
	 * @param sting  $size Size name.
	 *
	 * @return array Image attr.
	 */
	function bizz_ecommerce_replace_header_attr( $attr, $attachment, $size ){
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		if ( $custom_logo_id == $attachment->ID ){
			$attach_data = array();
			if ( ! is_customize_preview() ){
				$attach_data = wp_get_attachment_image_src( $attachment->ID, 'open-logo-size' );


				if ( isset( $attach_data[0] ) ) {
					$attr['src'] = $attach_data[0];
				}
			}

			$file_type      = wp_check_filetype( $attr['src'] );
			$file_extension = $file_type['ext'];
			if ( 'svg' == $file_extension ) {
				$attr['class'] = 'open-logo-svg';
			}
			$retina_logo = get_theme_mod( 'bizz_ecommerce_header_retina_logo' );
			$attr['srcset'] = '';
			if ( apply_filters( 'open_main_header_retina', true ) && '' !== $retina_logo ) {
				$cutom_logo     = wp_get_attachment_image_src( $custom_logo_id, 'full' );
				$cutom_logo_url = $cutom_logo[0];

				if (bizz_ecommerce_check_is_ie() ){
					// Replace header logo url to retina logo url.
					$attr['src'] = $retina_logo;
				}

				$attr['srcset'] = $cutom_logo_url . ' 1x, ' . $retina_logo . ' 2x';

			}
		}

		return apply_filters( 'bizz_ecommerce_replace_header_attr', $attr );
	}

endif;

add_filter( 'wp_get_attachment_image_attributes', 'bizz_ecommerce_replace_header_attr', 10, 3 );

/********************************/
// responsive slider function
/*********************************/
if ( ! function_exists( 'bizz_ecommerce_responsive_slider_funct' ) ) :
function bizz_ecommerce_responsive_slider_funct($control_name,$function_name){
  $custom_css='';
           $control_value = get_theme_mod( $control_name );
           if ( empty( $control_value ) ){
                return '';
             }  
        if ( bizz_ecommerce_is_json( $control_value ) ){
    $control_value = json_decode( $control_value, true );
    if ( ! empty( $control_value ) ) {

      foreach ( $control_value as $key => $value ){
        $custom_css .= call_user_func( $function_name, $value, $key );
      }
    }
    return $custom_css;
  }  
}
endif;
/********************************/
// responsive slider function add media query
/********************************/
if ( ! function_exists( 'bizz_ecommerce_add_media_query' ) ) :
function bizz_ecommerce_add_media_query( $dimension, $custom_css ){
  switch ($dimension){
      case 'desktop':
      $custom_css = '@media (min-width: 769px){' . $custom_css . '}';
      break;
      break;
      case 'tablet':
      $custom_css = '@media (max-width: 768px){' . $custom_css . '}';
      break;
      case 'mobile':
      $custom_css = '@media (max-width: 550px){' . $custom_css . '}';
      break;
  }

      return $custom_css;
}
endif;
/**
 * Display Sidebars
 */
if ( ! function_exists( 'bizz_ecommerce_get_sidebar' ) ){
	/**
	 * Get Sidebar
	 *
	 * @since 1.0.1.1
	 * @param  string $sidebar_id   Sidebar Id.
	 * @return void
	 */
	function bizz_ecommerce_get_sidebar( $sidebar_id ){
		 return $sidebar_id;
	}
}


/**********************/
// Top Slider Function
/**********************/
//Slider ontent output function layout 1
function bizz_ecommerce_top_slider_content( $bizz_ecommerce_slide_content_id, $default ){
//passing the seeting ID and Default Values
	$bizz_ecommerce_slide_content = get_theme_mod( $bizz_ecommerce_slide_content_id, $default );
		if ( ! empty( $bizz_ecommerce_slide_content ) ) :
			$bizz_ecommerce_slide_content = json_decode( $bizz_ecommerce_slide_content );
			if ( ! empty( $bizz_ecommerce_slide_content) ) {
				foreach ( $bizz_ecommerce_slide_content as $slide_item ) :
					$image = ! empty( $slide_item->image_url ) ? apply_filters( 'bizz-ecommerce_translate_single_string', $slide_item->image_url, 'Top Slider section' ) : '';
					$logo_image = ! empty( $slide_item->logo_image_url ) ? apply_filters( 'bizz-ecommerce_translate_single_string', $slide_item->logo_image_url, 'Top Slider section' ) : '';
					$title  = ! empty( $slide_item->title ) ? apply_filters( 'bizz-ecommerce_translate_single_string', $slide_item->title, 'Top Slider section' ) : '';
					$subtitle  = ! empty( $slide_item->subtitle ) ? apply_filters( 'bizz-ecommerce_translate_single_string', $slide_item->subtitle, 'Top Slider section' ) : '';
					$text   = ! empty( $slide_item->text ) ? apply_filters( 'bizz-ecommerce_translate_single_string', $slide_item->text, 'Top Slider section' ) : '';
					$link   = ! empty( $slide_item->link ) ? apply_filters( 'bizz-ecommerce_translate_single_string', $slide_item->link, 'Top Slider section' ) : '';
			?>	
			<?php if($image!==''):?>
		                    <div>
                            <img data-u="image" src="<?php echo esc_url($image); ?>" />
                               <div class="slide-content-wrap">
                                <div class="slide-content">
                                  <div class="logo">
                                  	<a href="<?php echo esc_url($link); ?>"><img src="<?php echo esc_url($logo_image); ?>"></a>
                                  </div>
                                  <h2><?php echo esc_html($title); ?></h2>
                                  <p><?php echo esc_html($subtitle); ?></p>
                                  <?php if($text!==''): ?>
                                  <a class="slide-btn" href="<?php echo esc_url($link); ?>"><?php echo esc_html($text); ?></a>
                                  <?php endif; ?>
                                </div>
                              </div>
                            </div>
	
			<?php	
				endif;
				endforeach;			
			} // End if().
		
	endif;	
}
//Single Slider ontent output function layout 5
function bizz_ecommerce_top_single_slider_content( $bizz_ecommerce_slide_content_id, $default ){
//passing the seeting ID and Default Values
	$bizz_ecommerce_slide_content = get_theme_mod( $bizz_ecommerce_slide_content_id, $default );
		if ( ! empty( $bizz_ecommerce_slide_content ) ) :
			$bizz_ecommerce_slide_content = json_decode( $bizz_ecommerce_slide_content );
			if ( ! empty( $bizz_ecommerce_slide_content) ) {
				foreach ( $bizz_ecommerce_slide_content as $slide_item ) :
					$image = ! empty( $slide_item->image_url ) ? apply_filters( 'bizz-ecommerce_translate_single_string', $slide_item->image_url, 'Top Slider section' ) : '';
					$link   = ! empty( $slide_item->link ) ? apply_filters( 'bizz-ecommerce_translate_single_string', $slide_item->link, 'Top Slider section' ) : '';
			?>	
			<?php if($image!==''):?>
		                    <div>
                              <img data-u="image" src="<?php echo esc_url($image); ?>" />
                               <a  href="<?php echo esc_url($link); ?>"></a>
                            </div>
	
			<?php	
				endif;
				endforeach;			
			} // End if().
		
	endif;	
}
// slider layout 2
function bizz_ecommerce_top_slider_2_content( $bizz_ecommerce_slide_content_id, $default ){
//passing the seeting ID and Default Values
	$bizz_ecommerce_slide_content = get_theme_mod( $bizz_ecommerce_slide_content_id, $default );
		if ( ! empty( $bizz_ecommerce_slide_content ) ) :
			$bizz_ecommerce_slide_content = json_decode( $bizz_ecommerce_slide_content );
			if ( ! empty( $bizz_ecommerce_slide_content) ) {
				foreach ( $bizz_ecommerce_slide_content as $slide_item ) :
					$image = ! empty( $slide_item->image_url ) ? apply_filters( 'bizz-ecommerce_translate_single_string', $slide_item->image_url, 'Top Slider section' ) : '';
					$logo_image = ! empty( $slide_item->logo_image_url ) ? apply_filters( 'bizz-ecommerce_translate_single_string', $slide_item->logo_image_url, 'Top Slider section' ) : '';
					$title  = ! empty( $slide_item->title ) ? apply_filters( 'bizz-ecommerce_translate_single_string', $slide_item->title, 'Top Slider section' ) : '';
					$subtitle  = ! empty( $slide_item->subtitle ) ? apply_filters( 'bizz-ecommerce_translate_single_string', $slide_item->subtitle, 'Top Slider section' ) : '';
					$text   = ! empty( $slide_item->text ) ? apply_filters( 'bizz-ecommerce_translate_single_string', $slide_item->text, 'Top Slider section' ) : '';
					$link   = ! empty( $slide_item->link ) ? apply_filters( 'bizz-ecommerce_translate_single_string', $slide_item->link, 'Top Slider section' ) : '';
			?>	
			<?php if($image!==''):?>
                   <div class="texture-to2-slide-list">
                    <img src="<?php echo esc_url($image); ?>">
                    <div class="slider-content-caption">
                        <h2 class="animated delay-0.5s" data-animation-in="fadeInLeft" data-animation-out="animate-out fadeInRight"><a href="<?php echo esc_url($link); ?>"><?php echo esc_html($title); ?></a></h2>
                        <p class="animated delay-0.8s" data-animation-in="fadeInLeft" data-animation-out="animate-out fadeInRight"><?php echo esc_html($subtitle); ?></p>
                         <?php if($text!==''): ?>
                       <a class="slide-btn animated delay-0.8s" data-animation-in="fadeInLeft" data-animation-out="animate-out fadeInRight" href="<?php echo esc_url($link); ?>"><?php echo esc_html($text); ?></a>
                        <?php endif;?>
                    </div>
                  </div>
			<?php	
				endif;
			endforeach;			
			} // End if().
		
	endif;	
}

//*********************//
// Highlight feature
//*********************//
function bizz_ecommerce_highlight_content($bizz_ecommerce_highlight_content_id,$default){
	$bizz_ecommerce_highlight_content= get_theme_mod( $bizz_ecommerce_highlight_content_id, $default );
//passing the seeting ID and Default Values

	if ( ! empty( $bizz_ecommerce_highlight_content ) ) :

		$bizz_ecommerce_highlight_content = json_decode( $bizz_ecommerce_highlight_content );
		if ( ! empty( $bizz_ecommerce_highlight_content ) ) {
			foreach ( $bizz_ecommerce_highlight_content as $ship_item ) :
               $icon   = ! empty( $ship_item->icon_value ) ? apply_filters( 'bizz_ecommerce_translate_single_string', $ship_item->icon_value, '' ) : '';
				$title    = ! empty( $ship_item->title ) ? apply_filters( 'bizz_ecommerce_translate_single_string', $ship_item->title, '' ) : '';
				$subtitle    = ! empty( $ship_item->subtitle ) ? apply_filters( 'bizz_ecommerce_translate_single_string', $ship_item->subtitle, '' ) : '';
					?>
         <div class="texture-highlight-col">
          	<div class="texture-hglt-box">
          		<div class="content">
          		<div class="texture-hglt-icon"><i class="<?php echo "fa ".esc_attr($icon); ?>"></i></div>
          			<h6><?php echo esc_html($title);?></h6>
          			<p><?php echo esc_html($subtitle);?></p>
          		</div>
          	</div>
          </div>
    			<?php
			endforeach;
		}
	endif;
}
 
// Mobile Menu Wrapper Add.
function bizz_ecommerce_mobile_menu_wrap(){
echo '<div class="bizz-ecommerce-mobile-menu-wrapper"></div>';
}
add_action( 'wp_footer', 'bizz_ecommerce_mobile_menu_wrap' );

// section is_customize_preview
/**
 * This function display a shortcut to a customizer control.
 *
 * @param string $class_name        The name of control we want to link this shortcut with.
 */
function bizz_ecommerce_display_customizer_shortcut( $class_name ){
	if ( ! is_customize_preview() ) {
		return;
	}
	$icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M13.89 3.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58s7.6-7.63 7.99-8.03c.39-.39 1.22-.39 1.68.07zm-2.73 2.79l-5.59 5.61 1.11 1.11 5.54-5.65zm-2.97 8.23l5.58-5.6-1.07-1.08-5.59 5.6z"></path>
        </svg>';
	echo'<span class="open-focus-section customize-partial-edit-shortcut customize-partial-edit-shortcut-' . esc_attr( $class_name ) . '">
            <button class="customize-partial-edit-shortcut-button">
                ' . $icon . '
            </button>
        </span>';
}

/*****************************/

// default size in upload image
function bizz_ecommerce_attachment_display_settings() {
    update_option( 'image_default_size', 'large' );
}
add_action( 'after_setup_theme', 'bizz_ecommerce_attachment_display_settings' );