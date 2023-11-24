<?php
/**
 * Relic Fashion Store Products Tab Ajax Call Function Hear
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package Buzz Ecommerce
 */

add_action( "wp_ajax_nopriv_category_tab_products", 'buzz_ecommerce_category_tab_products' );
add_action( 'wp_ajax_category_tab_products','buzz_ecommerce_category_tab_products');
if ( ! function_exists( 'buzz_ecommerce_category_tab_products' ) ) {  
	function buzz_ecommerce_category_tab_products(){
		
        //Ajax Call Products Display Hear
		$tab_category_id = $_POST['post_id']; 
        $tab_product_count = $_POST['prduct_count']; 

        $html = ob_start();
        

	?>
        <!-- Products Tab -->
            <div id="<?php echo esc_attr($tab_category_id); ?>" class="tab-content current">
                <div id="products_tab_ajax" class="product-tab">
                    <div class="item"> 
                        <div class="row">
                            <!-- Start Products Wraper -->
                                <?php
                                    $products_count = 0;
                                    $product_args = array(
                                        'post_type' => 'product',
                                        'tax_query' => array(
                                            array(
                                                'taxonomy'  => 'product_cat',
                                                'field'     => 'term_id', 
                                                'terms'     => $tab_category_id // Ajax Category Id                                                            
                                            ),
                                            array(
                                                'taxonomy' => 'product_visibility',
                                                'field' => 'name',
                                                'terms' => 'exclude-from-catalog',
                                                'operator'	=>	'NOT IN'
                                            )
                                        ),
                                            
                                        'posts_per_page' => $tab_product_count
                                    );
                                    $query = new WP_Query($product_args);
                                    $total_products =  ($query->post_count)-1;
                                    if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                                ?>
                        
                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 products-tab">
                                    <?php echo wc_get_template_part( 'content', 'product' ); ?>
                                </div>
                                
                                
                            <?php $products_count++; } } wp_reset_postdata(); ?>
                            <!-- End Products Wrapper -->
                        </div>
                    </div>
                </div>
            </div>
            
        <!-- Products Tab End -->
     <?php
     
    $html = ob_get_contents();
    ob_end_clean();
    echo $html;
    	exit;
	}
}

