<?php
/**
 * Front-page Products Tabs Section
 * 
 */
function buzz_ecommerce_homepage_products_upsell(){
    if(!buzz_ecommerce_is_woocommerce_activated()): return; endif;
    
    //products-tab Customizer Values
    $onsell_products_title = get_theme_mod( 'onsell_products_title','Onsell Products' );
    
    ?>
    <section id="products_upsell_options"  class="product">
        <div class="container">
            <div class="row products-tab-wraper">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="product-tab-list clearfix">
                        <h4 id="onsale_products_title"  class="  text-uppercase"><?php echo esc_html( $onsell_products_title); ?></h4>
                         <!-- Tab Section Hear -->
                    </div>
                </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 products-tab-section">
                        
                        <div id="tab-bag" class="tab-content current">
                            <div class="product-tab">
                            <div class="item"> 
                                <div class="row buzz_ecommerce_masonry_layout">
                                <!-- Products Tab -->
                                        <?php
                                            $on_sale = array(
                                                'post_type'      => 'product',
                                                'posts_per_page' => get_theme_mod('products_onsell_number_of_products',8),
                                                'tax_query' => array(
                                                                    array(
                                                                        'taxonomy' => 'product_visibility',
                                                                        'field' => 'name',
                                                                        'terms' => 'exclude-from-catalog',
                                                                        'operator'	=>	'NOT IN'
                                                                    )
                                                                ),
                                                'meta_query'     => array(
                                                    'relation' => 'OR',
                                                        array( // Simple products type
                                                            'key'           => '_sale_price',
                                                            'value'         => 0,
                                                            'compare'       => '>',
                                                            'type'          => 'numeric'
                                                        ),
                                                        array( // Variable products type
                                                            'key'           => '_min_variation_sale_price',
                                                            'value'         => 0,
                                                            'compare'       => '>',
                                                            'type'          => 'numeric'
                                                        ),
                                                        
                                                    )
                                                );
                
                                            $query = new WP_Query($on_sale);
                                            if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                                        ?>
                                            
                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 products-tab ">
                                                <?php echo wc_get_template_part( 'content', 'product' ); ?>
                                            </div>
                                                
                                                
                                        <?php 
                                    } 
                                        }else{
                                            //Default data
                                            ?>
                                            <div class="woocommerce-add-products item">
                                                <div class="row ">
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
        </div>
    </section>
    <?php
}
add_action( 'products_upsell','buzz_ecommerce_homepage_products_upsell');