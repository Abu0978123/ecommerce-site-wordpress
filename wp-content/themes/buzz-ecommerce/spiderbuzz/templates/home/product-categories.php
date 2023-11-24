<?php
/**
 * Products Category Section
 * @Buzz_Ecommerce 
 */
function buzz_ecommerce_homepage_products_category(){
    if( !buzz_ecommerce_is_woocommerce_activated() ) return;
    //Products Category Default Values
    $products_categorys = get_theme_mod( 'products_categorys',buzz_ecommerce_get_multiple_product_categories() );
    
    ?>
        <section id="products_category_section" class="catagory-pro">
            <div class="container">
                <div class="row">
                    
                        <?php
                    
                            //Shift the First Category
                            $products_categorys_first = array_shift( $products_categorys );#category section
                    
                            //Products Categorys Section
                            $first_category_term = get_term_by( 'id', $products_categorys_first, 'product_cat');
                            
                            //term links hear
                            if($first_category_term == null){
                                $products_categorys_first = buzz_ecommerce_woo_cat_id_by_slug('uncategorized');
                                
                                $first_category_term = get_term_by( 'id', $products_categorys_first, 'product_cat');
                                
                            }


                            //Category Image
                            $thumbnail_id = get_term_meta( $products_categorys_first, 'thumbnail_id', true );
                            $image = wp_get_attachment_url( $thumbnail_id ); 

                            //default image set
                            if( $image == ''){
                                $image = esc_url( get_template_directory_uri() . '/assets/images/category-img.jpg' );
                            }

                        ?>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="catagory-img">
                                <figure>
                                    <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $first_category_term->name ); ?>">
                                    <figcaption>
                                        <h3><?php echo esc_html( $first_category_term->name ); ?></h3>
                                        <a href="<?php echo esc_url( get_category_link( $first_category_term )); ?>" class="btn text-uppercase"><?php echo esc_html__('Buy Now','buzz-ecommerce'); ?></a>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="row">
                                <?php
                                    $products_category_count = 1;
                                    foreach( $products_categorys as $cat_key => $category_id ){ 
                                    
                                        if( $products_category_count < 3 ){
                                            //Products Categorys Section
                                            $term = get_term_by( 'id', $category_id, 'product_cat');

                                            //term links hear
                                            if($term == null){
                                                $category_id = buzz_ecommerce_woo_cat_id_by_slug('uncategorized');
                                                
                                                $term = get_term_by( 'id', $category_id, 'product_cat');
                                                
                                            }
                                            
                                            //Category Image
                                            $thumbnail_id = get_term_meta( $category_id, 'thumbnail_id', true );
                                            $image = wp_get_attachment_url( $thumbnail_id );

                                            //default image set
                                            if( $image == ''){
                                                $image = esc_url( get_template_directory_uri() . '/assets/images/category-img.jpg' );
                                            } 
                                        ?>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="catagory-img category-small-img">
                                                    <figure>
                                                        <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $term->name ); ?>">
                                                        <figcaption>
                                                            <h3><?php echo esc_html( $term->name ); ?></h3>
                                                            <a href="<?php echo esc_url( get_category_link( $category_id )); ?>" class="btn text-uppercase"><?php echo esc_html__('Buy Now','buzz-ecommerce'); ?></a>
                                                        </figcaption>
                                                    </figure>
                                                </div>
                                            </div>

                                        <?php }#End Products Count Section

                                        $products_category_count++; 
                                        } 
                                    ?>

                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                        <?php
                            //Shift the Last Category
                            $products_categorys_last = end( $products_categorys );#category Section
                    
                            //Products Categorys Section
                            $first_category_term_last = get_term_by( 'id', $products_categorys_last, 'product_cat');
                            
                            //term links hear
                            if($first_category_term_last == null){
                                $products_categorys_last = buzz_ecommerce_woo_cat_id_by_slug('uncategorized');
                                $first_category_term_last = get_term_by( 'id', $products_categorys_last, 'product_cat');
                            }

                            //Category Image
                            $thumbnail_id_last = get_term_meta( $products_categorys_last, 'thumbnail_id', true );
                            $image_last = wp_get_attachment_url( $thumbnail_id_last ); 

                            //default image set
                            if( $image_last == ''){
                                $image_last = esc_url( get_template_directory_uri() . '/assets/images/category-img.jpg' );
                            }

                        ?>
                            <div class="catagory-img">
                                <figure>
                                    <img src="<?php echo esc_url( $image_last ); ?>" alt="<?php echo esc_attr( $first_category_term_last->name ); ?>">
                                    <figcaption>
                                        <h3><?php echo esc_html( $first_category_term_last->name ); ?></h3>
                                        <a href="<?php echo esc_url( get_category_link( $first_category_term_last )); ?>" class="btn text-uppercase"><?php echo esc_html__('Buy Now' ,'buzz-ecommerce' ); ?></a>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>


                </div><!-- End Row -->
            </div><!-- End Container Class -->
        </section><!-- End Products Category section --> 
    <?php
}
add_action( 'products-category','buzz_ecommerce_homepage_products_category' );