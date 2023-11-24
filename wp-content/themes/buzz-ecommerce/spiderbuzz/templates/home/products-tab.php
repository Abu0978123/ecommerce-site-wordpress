<?php
/**
 * Front-page Products Tabs Section
 * 
 */

function buzz_ecommerce_homepage_products_tabs(){
    if(!buzz_ecommerce_is_woocommerce_activated()): return; endif;
    
    //products-tab Customizer Values
    $products_tabs_title = get_theme_mod( 'products_tabs_title','POPULAR PRODUCTS' );
    $products_tab_multiple_category = get_theme_mod( 'products_tabs_multiple_cat',array(buzz_ecommerce_get_default_products_categories()) );
    $products_tab_number_of_products = get_theme_mod( 'products_tab_number_of_products',8 );
    $buzz_commerce_products_tab_background_images = get_theme_mod('buzz_commerce_products_tab_background_images',get_template_directory_uri().'/assets/images/tab-background-img.png');
    ?>
    <section id="products_tab_section" class="product" <?php if( $buzz_commerce_products_tab_background_images != '' ): ?> style="background:url(<?php echo esc_url($buzz_commerce_products_tab_background_images); ?>)" <?php endif; ?>>
        <div class="container">
            <div class="row products-tab-wraper">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="product-tab-list clearfix">
                        <h4 id="products_tabs_title"  class="  text-uppercase"><?php echo esc_html( $products_tabs_title ); ?></h4>
                        
                        <!-- Tab Section Hear -->
                        <ul class="tabs ecommerce-shop-products-tab clearfix">
                                <?php
                                    //Woocommerce products Section
                                    $category_count = 1;
                                        if( !empty($products_tab_multiple_category )){
                                        foreach( $products_tab_multiple_category as $key => $products_id ){ 
                                            $term = get_term_by( 'id', $products_id, 'product_cat');
                                    
                                        //term links
                                        if($term == null){
                                            $products_id = buzz_ecommerce_woo_cat_id_by_slug('uncategorized');
                                            
                                            //multiple cat id
                                            $term = get_term_by( 'id', $products_id, 'product_cat');
                                        }
                                    ?>
                                    
                                    <li select_category_id = "<?php echo esc_attr( $products_id ); ?>"  tab_product_count = "<?php echo esc_attr( $products_tab_number_of_products ); ?>" class="ecommerce-shop-products-tabs-title tab-link  <?php if( $category_count == 1){ echo esc_attr('current'); }$category_count++; ?>"  data-tab="<?php echo esc_attr( $products_id ); ?>"><a href="#<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></a></li>
                                    
                                <?php  }}  ?>
                        </ul>

                    </div>
                </div>
                <?php if( $products_tab_multiple_category ): ?>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 products-tab-section">
                        
                        <div id="tab-bag" class="tab-content current">
                            <div class=" product-tab">
                                <div class="item"> 
                                    <div class="row">
                                <!-- Products Tab -->
                                <?php
                                    $product_args = array(
                                        'post_type' => 'product',
                                        'tax_query' => array(
                                            array(
                                                'taxonomy'  => 'product_cat',
                                                'field'     => 'term_id', 
                                                'terms'     => reset( $products_tab_multiple_category ) // First Element's Value                                                            
                                            ),
                                            array(
                                                'taxonomy' => 'product_visibility',
                                                'field' => 'name',
                                                'terms' => 'exclude-from-catalog',
                                                'operator'	=>	'NOT IN'
                                            )
                                        ),
                                        'posts_per_page' => $products_tab_number_of_products
                                    );
                                    $query = new WP_Query( $product_args );
                                    if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                                ?>
                                            
                                           
                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 products-tab">
                                                <?php echo wc_get_template_part( 'content', 'product' ); ?>
                                            </div>
                                          
                                <?php  } 
                                }else{
                                    //Default data
                                    ?>
                                    <div class="woocommerce-add-products item">
                                        <div class="row">
                                        <?php
                                            for ($x = 1; $x <= 8; $x++) {
                                                ?>
                                                <div class="new col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                                <?php
                                                buzz_ecommerce_default_products();
                                                ?>
                                                </div>
                                                <?php
                                            }
                                        ?>
                                            </div>
                                        </div>
                                    <?php

                                }
                                 wp_reset_postdata(); ?>

                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php
}
add_action( 'products_tab','buzz_ecommerce_homepage_products_tabs');