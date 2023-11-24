<?php 
/**
 * Perform all main WooCommerce configurations for this theme
 *
 * @package  Bizz EcommerceWordPress theme
 */
// If plugin - 'WooCommerce' not exist then return.
if ( ! class_exists( 'WooCommerce' ) ){
	   return;
}

if ( ! function_exists( 'is_plugin_active' ) ){
  require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

/*******************************/
/** Sidebar Add Cart Product **/
/*******************************/
if ( ! function_exists( 'bizz_ecommerce_cart_total_item' ) ){
  /**
   * Cart Link
   * Displayed a link to the cart including the number of items present and the cart total
   */
 function bizz_ecommerce_cart_total_item(){
   global $woocommerce; 
  ?>
 <a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart','bizz-ecommerce' ); ?>">
  <i class="fa fa-shopping-basket"></i> 
  <?php if(WC()->cart->get_cart_contents_count()!='0'){ ?> 
  <span class="count-item"><?php echo WC()->cart->get_cart_contents_count();?></span>
  <span class="cart-total"><?php echo WC()->cart->get_cart_total(); ?></span>
<?php }?>
</a>
  <?php }
}
//cart view function
function bizz_ecommerce_menu_cart_view($cart_view){
	global $woocommerce;
    $cart_view= bizz_ecommerce_cart_total_item();
    return $cart_view;
}
add_action( 'open_cart_count','bizz_ecommerce_menu_cart_view');

function bizz_ecommerce_woo_cart_product(){
global $woocommerce;
?>
<div class="cart-overlay"></div>
<div id="open-cart" class="open-cart">
<div class="cart-widget-heading">
  <h4><?php _e('Shopping Cart','bizz-ecommerce');?></h4>
  <a class="cart-close-btn"><?php _e('close','bizz-ecommerce');?></a></div>  
<div class="open-quickcart-dropdown">
<?php 
woocommerce_mini_cart(); 
?>
</div>
<?php if ($woocommerce->cart->is_empty() ) : ?>
<a class="button return wc-backward" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>"> <?php _e( 'Return to shop', 'bizz-ecommerce' ); ?> </a>
<?php endif;?>
</div>
    <?php
}
add_action( 'bizz_ecommerce_woo_cart', 'bizz_ecommerce_woo_cart_product' );
add_filter('woocommerce_add_to_cart_fragments', 'bizz_ecommerce_add_to_cart_dropdown_fragment');
function bizz_ecommerce_add_to_cart_dropdown_fragment( $fragments ){
   global $woocommerce;
   ob_start();
   ?>
   <div class="open-quickcart-dropdown">
       <?php woocommerce_mini_cart(); ?>
   </div>
   <?php $fragments['div.open-quickcart-dropdown'] = ob_get_clean();
   return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'bizz_ecommerce_add_to_cart_fragment');
function bizz_ecommerce_add_to_cart_fragment($fragments) {
        ob_start();?>

        <a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart','bizz-ecommerce' ); ?>">
          <i class="fa fa-shopping-basket"></i> 
          <?php if(WC()->cart->get_cart_contents_count()!='0'){ ?> 
          <span class="count-item"><?php echo WC()->cart->get_cart_contents_count();?></span>
          <span class="cart-total"><?php echo WC()->cart->get_cart_total(); ?></span>
           <?php }?>
        </a>

       <?php  $fragments['a.cart-contents'] = ob_get_clean();

        return $fragments;
    }
/***********************************************/
//Sort section Woocommerce category filter show
/***********************************************/
function bizz_ecommerce_add_to_cart_url($product){
 $cart_url =  apply_filters( 'woocommerce_loop_add_to_cart_link',
    sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="button th-button %s %s"><span>%s</span></a>',
        esc_url( $product->add_to_cart_url() ),
        esc_attr( $product->get_id() ),
        esc_attr( $product->get_sku() ),
        esc_attr( isset( $quantity ) ? $quantity : 1 ),
        $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
        $product->is_purchasable() && $product->is_in_stock() && $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
        esc_html( $product->add_to_cart_text() )
    ),$product );
 return $cart_url;
}

/**********************************/
//Shop Product Markup
/**********************************/
if ( ! function_exists( 'bizz_ecommerce_product_meta_start' ) ){
  /**
   * Thumbnail wrap start.
   */
  function bizz_ecommerce_product_meta_start(){
    echo '<div class="texture-product-wrap"><div class="texture-product">';
  }
}
if ( ! function_exists( 'bizz_ecommerce_product_meta_end' ) ){

  /**
   * Thumbnail wrap start.
   */
  function bizz_ecommerce_product_meta_end(){

    echo '</div></div>';
  }
}
/**********************************/
//Shop Product Image Markup
/**********************************/
if ( ! function_exists( 'bizz_ecommerce_product_image_start' ) ){
  /**
   * Thumbnail wrap start.
   */
  function bizz_ecommerce_product_image_start(){
    echo '<div class="texture-product-image">';
  }
}
if ( ! function_exists( 'bizz_ecommerce_product_image_end' ) ){

  /**
   * Thumbnail wrap start.
   */
    function bizz_ecommerce_product_image_end(){
    
    echo '</div>';
  }
}

if ( ! function_exists( 'bizz_ecommerce_product_content_start' ) ){
  /**
   * Thumbnail wrap start.
   */
  function bizz_ecommerce_product_content_start(){
    echo '<div class="texture-product-content">';
  }
}
if ( ! function_exists( 'bizz_ecommerce_product_content_end' ) ){

  /**
   * Thumbnail wrap start.
   */
  function bizz_ecommerce_product_content_end(){

    echo '</div>';
  }
}
 /**
   * texture-product-hover start.
   */
 if ( ! function_exists( 'bizz_ecommerce_product_hover_start' ) ){
  function bizz_ecommerce_product_hover_start(){

    echo'<div class="texture-product-hover">';      
  }
}
if ( ! function_exists( 'bizz_ecommerce_product_hover_end' ) ){

  /**
   * Thumbnail wrap start.
   */
  function bizz_ecommerce_product_hover_end(){
    
    echo '</div>';
  }
}

if ( ! function_exists( 'bizz_ecommerce_shop_content_start' ) ){

  /**
   * Thumbnail wrap start.
   */
  function bizz_ecommerce_shop_content_start(){
    $viewshow = get_theme_mod('bizz_ecommerce_prd_view','grid-view');
    if($viewshow == 'grid-view'){
    echo '<div id="shop-product-wrap" class="texture-grid-view">';
    }else{
    echo '<div id="shop-product-wrap" class="texture-list-view">';
    }
  }
}

if ( ! function_exists( 'bizz_ecommerce_shop_content_end' ) ){

  /**
   * Thumbnail wrap start.
   */
  function bizz_ecommerce_shop_content_end(){
    
    echo '</div>';
  }
}

function bizz_ecommerce_quickview(){
do_action('quickview');
}
/**
* Shop customization.
*
* @return void
*/
add_action( 'woocommerce_before_shop_loop_item', 'bizz_ecommerce_product_meta_start', 10);
add_action( 'woocommerce_after_shop_loop_item', 'bizz_ecommerce_product_meta_end', 12 );
add_action( 'woocommerce_before_shop_loop_item_title', 'bizz_ecommerce_product_content_start',20);
add_action( 'woocommerce_after_shop_loop_item_title', 'bizz_ecommerce_product_content_end', 20 );
add_action( 'woocommerce_after_shop_loop_item_title', 'bizz_ecommerce_product_hover_start',50);
add_action( 'woocommerce_after_shop_loop_item', 'bizz_ecommerce_product_hover_end',20);
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open',20);
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open',0);
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_rating', 20);
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price',0);
add_action( 'woocommerce_before_shop_loop_item_title', 'bizz_ecommerce_product_image_start', 0);
add_action( 'woocommerce_before_shop_loop_item_title', 'bizz_ecommerce_product_image_end',10 );
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_show_product_sale_flash',4);
add_action( 'woocommerce_after_shop_loop_item', 'bizz_ecommerce_quickview',11);
add_action( 'woocommerce_after_shop_loop_item', 'bizz_ecommerce_whish_list_both',11);
add_action( 'woocommerce_after_shop_loop_item', 'bizz_ecommerce_add_to_compare_fltr_single',11);

add_action( 'woocommerce_before_shop_loop', 'bizz_ecommerce_shop_content_start',1);
add_action( 'woocommerce_after_shop_loop', 'bizz_ecommerce_shop_content_end',1);

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open');
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
/***************/
// single page
/***************/
if ( ! function_exists( 'bizz_ecommerce_single_summary_start' ) ){

  /**
   * Thumbnail wrap start.
   */
  function bizz_ecommerce_single_summary_start(){
    
    echo '<div class="texture-single-product-summary-wrap">';
  }
}
if( ! function_exists( 'bizz_ecommerce_single_summary_end' ) ){

  /**
   * Thumbnail wrap start.
   */
  function bizz_ecommerce_single_summary_end(){
    
    echo '</div>';
  }
}
add_action( 'woocommerce_before_single_product_summary', 'bizz_ecommerce_single_summary_start',0);
add_action( 'woocommerce_after_single_product_summary', 'bizz_ecommerce_single_summary_end',0);
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs',40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_filter( 'woocommerce_product_tabs', 'bizz_ecommerce_woocommerce_custom_product_tabs', 40 );
function bizz_ecommerce_woocommerce_custom_product_tabs( $tabs ) {
     $tabs['delivery_information'] = array(
        'title'     => __( 'Meta Information', 'bizz-ecommerce' ),
        'priority'  => 40,
        'callback'  => 'woocommerce_product_meta_tab'
    );
   return $tabs;
}
function woocommerce_product_meta_tab(){// this is where you indicate what appears in the description tab
wc_get_template( 'single-product/meta.php' ); // The meta content first
}

/**
 * Add next/prev buttons @ WooCommerce Single Product Page
 */
 
add_action( 'woocommerce_single_product_summary', 'bizz_ecommerce_prev_next_product',0 );
 
// and if you also want them at the bottom...
add_action( 'woocommerce_single_product_summary', 'bizz_ecommerce_prev_next_product',0 );
 
function bizz_ecommerce_prev_next_product(){
 
echo '<div class="prev_next_buttons">';
 
   // 'product_cat' will make sure to return next/prev from current category
   $previous = next_post_link('%link', '&larr;', TRUE, ' ', 'product_cat');
   $next = previous_post_link('%link', '&rarr;', TRUE, ' ', 'product_cat');
 
   echo $previous;
   echo $next;
    
echo '</div>';
         
}

/****************/
// add to compare
/****************/
function bizzecommerce_lite_plugin_get_version(){
if(is_plugin_active( 'testerwp-ecommerce-companion/testerwp-ecommerce-companion.php' )){  
$plugin_data = get_plugin_data(WP_PLUGIN_DIR . '/testerwp-ecommerce-companion/testerwp-ecommerce-companion.php');
$plugin_version = $plugin_data['Version'];
return $plugin_version;
}
}

function bizzecommerce_pro_plugin_get_version(){
if(is_plugin_active( 'bizz-ecommerce-pro/bizz-ecommerce-pro.php' )){    
$plugin_data = get_plugin_data(WP_PLUGIN_DIR . '/bizz-ecommerce-pro/bizz-ecommerce-pro.php');
$plugin_version = $plugin_data['Version'];
return $plugin_version;
}
}


/**********************/
/** whishlist and compare both **/
/**********************/
if ( ! function_exists('bizz_ecommerce_whish_list_both')){
 function bizz_ecommerce_whish_list_both($pid){
      if( class_exists( 'YITH_WCWL' )){
        bizz_ecommerce_whish_list($pid);
    }
    elseif( ( class_exists( 'WPCleverWoosw' ))){
     echo do_shortcode('[woosw id='.$pid.']');
    }
}
}

if ( ! function_exists('bizz_ecommerce_add_to_compare_fltr_both')){
function bizz_ecommerce_add_to_compare_fltr_both($pid){
  if( ( class_exists( 'YITH_Woocompare' ))){
             bizz_ecommerce_add_to_compare_fltr($pid);      
                }
                  elseif( ( class_exists( 'WPCleverWoosc' ))){
                     echo do_shortcode('[woosc id='.$pid.']');
                  }
}
}


/**********************/
/** compare **/
/**********************/

function bizz_ecommerce_add_to_compare_fltr_single($pid){
        if( is_plugin_active('yith-woocommerce-compare/init.php') ){
          echo '<div class="texture-compare"><span class="compare-list"><div class="woocommerce product compare-button"><a href="'.esc_url(home_url()).'?action=yith-woocompare-add-product&id='.esc_attr($pid).'" class="compare button" data-product_id="'.esc_attr($pid).'" rel="nofollow">Compare</a></div></span></div>';
           }
        }

function bizz_ecommerce_add_to_compare_fltr($pid){
        if( is_plugin_active('yith-woocommerce-compare/init.php') ){
          echo '<div class="texture-compare"><span class="compare-list"><div class="woocommerce product compare-button"><a href="'.esc_url(home_url()).'?action=yith-woocompare-add-product&id='.esc_attr($pid).'" class="compare button" data-product_id="'.esc_attr($pid).'" rel="nofollow">Compare</a></div></span></div>';
           }

           elseif( ( class_exists( 'WPCleverWoosc' ))){
                     echo do_shortcode('[woosc id='.$pid.']');
                  }
        }
/**********************/
/** wishlist **/
/**********************/

 function bizz_ecommerce_whish_list_single($pid){
       if( shortcode_exists( 'yith_wcwl_add_to_wishlist' ) ){
        echo '<div class="texture-wishlist"><span class="texture-wishlist-inner">'.do_shortcode('[yith_wcwl_add_to_wishlist  product_id='.$pid.' icon="fa fa-heart-o" label="wishlist" already_in_wishslist_text="Already" browse_wishlist_text="Added"]' ).'</span></div>';
     }
 } 

  function bizz_ecommerce_whish_list($pid){
       if( shortcode_exists( 'yith_wcwl_add_to_wishlist' ) ){
        echo '<div class="texture-wishlist"><span class="texture-wishlist-inner">'.do_shortcode('[yith_wcwl_add_to_wishlist  product_id='.$pid.' icon="fa fa-heart-o" label="wishlist" already_in_wishslist_text="Already" browse_wishlist_text="Added"]' ).'</span></div>';
     }
     elseif( ( class_exists( 'WPCleverWoosw' ))){
     echo do_shortcode('[woosw id='.$pid.']');
    }

 } 


/**********************/
/** wishlist url**/
/**********************/
function bizz_ecommerce_whishlist_url(){
$wishlist_page_id =  get_option( 'yith_wcwl_wishlist_page_id' );
$wishlist_permalink = get_the_permalink( $wishlist_page_id );
return $wishlist_permalink ;
} 
// shop open
/** My Account Menu **/
function bizz_ecommerce_account(){
 if ( is_user_logged_in() ){
  $return = '<a class="account" href="'.get_permalink( get_option('woocommerce_myaccount_page_id') ).'"><i class="fa fa-user-o" aria-hidden="true"></i><span class="tooltiptext">'.__('Account','bizz-ecommerce').'</span></a>';
  } 
 else {
  $return = '<a class="account" href="'.get_permalink( get_option('woocommerce_myaccount_page_id') ).'"><i class="fa fa-lock" aria-hidden="true"></i><span class="tooltiptext">'.__('Register','bizz-ecommerce').'</span></a>';
}
 echo $return;
 }

 // Plus Minus Quantity Buttons @ WooCommerce Single Product Page
add_action( 'woocommerce_before_add_to_cart_quantity', 'bizz_ecommerce_display_quantity_minus',10,2 );
function bizz_ecommerce_display_quantity_minus(){
    echo '<div class="bizz-ecommerce-quantity"><button type="button" class="minus" >-</button>';
}
add_action( 'woocommerce_after_add_to_cart_quantity', 'bizz_ecommerce_display_quantity_plus',10,2 );
function bizz_ecommerce_display_quantity_plus(){
    echo '<button type="button" class="plus" >+</button></div>';
}

//Woocommerce: How to remove page-title at the home/shop page but not category pages
add_filter( 'woocommerce_show_page_title', 'bizz_ecommerce_not_a_shop_page' );
function bizz_ecommerce_not_a_shop_page() {
    return boolval(!is_shop());
}

//***********************/
// product category list
//************************/
function bizz_ecommerce_product_list_categories( $args = '' ){
$term = get_theme_mod('bizz_ecommerce_exclde_category');
if(!empty($term[0])){
  $exclude_id = $term;
  }else{
  $exclude_id = '';
 }
$defaults = array(
        'child_of'            => 0,
        'current_category'    => 0,
        'depth'               => 5,
        'echo'                => 0,
        'exclude'             => $exclude_id,
        'exclude_tree'        => '',
        'feed'                => '',
        'feed_image'          => '',
        'feed_type'           => '',
        'hide_empty'          => 1,
        'hide_title_if_empty' => false,
        'hierarchical'        => true,
        'order'               => 'ASC',
        'orderby'             => 'menu_order',
        'separator'           => '<br />',
        'show_count'          => 0,
        'show_option_all'     => '',
        'show_option_none'    => __( 'No categories','bizz-ecommerce' ),
        'style'               => 'list',
        'taxonomy'            => 'product_cat',
        'title_li'            => '',
        'use_desc_for_title'  => 0,
    );
 $html = wp_list_categories($defaults);
        echo '<ul class="product-cat-list texture-product-cat-list" data-menu-style="vertical">'.$html.'</ul>';
  }
function bizz_ecommerce_product_list_categories_mobile( $args = '' ){
    $defaults = array(
        'child_of'            => 0,
        'current_category'    => 0,
        'depth'               => 5,
        'echo'                => 0,
        'exclude'             => '',
        'exclude_tree'        => '',
        'feed'                => '',
        'feed_image'          => '',
        'feed_type'           => '',
        'hide_empty'          => 1,
        'hide_title_if_empty' => false,
        'hierarchical'        => true,
        'order'               => 'ASC',
        'orderby'             => 'menu_order',
        'separator'           => '<br />',
        'show_count'          => 0,
        'show_option_all'     => '',
        'show_option_none'    => __( 'No categories','bizz-ecommerce' ),
        'style'               => 'list',
        'taxonomy'            => 'product_cat',
        'title_li'            => '',
        'use_desc_for_title'  => 0,
    );
 $html = wp_list_categories($defaults);
        echo '<ul class="texture-product-cat-list mobile" data-menu-style="accordion">'.$html.'</ul>';
  }