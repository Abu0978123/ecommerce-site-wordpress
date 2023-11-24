<?php
/**
 * Display the slider section 
 * 
 */
 function buzz_ecommerce_homepage_slider_section(){
        /**
         *Slider Customizer Values Store in Variable 
         * @Customizer Value
         */
        $buzz_ecommerce_main_slider = get_theme_mod( 'buzz_ecommerce_main_slider', true ); 
        
        if( $buzz_ecommerce_main_slider == false ): return; endif;
        
        $buzz_ecommerce_slider_category_list_enable = get_theme_mod( 'buzz_ecommerce_slider_category_list_enable', true );


        /**
         * Slider Class Condtions Hear
         * @condtion
         */
        if( $buzz_ecommerce_slider_category_list_enable == true ){
            //is category section actiate
            if(buzz_ecommerce_is_woocommerce_activated()){
                $slider_show_class = 'col-lg-9 col-md-9 col-sm-12';
                $buzz_ecommerce_slider_container = 'container';
            }else{
                $slider_show_class = 'col-lg-12 col-md-12 col-sm-12';
                $buzz_ecommerce_slider_container = '';
            }
        }else{
            $buzz_ecommerce_slider_container = '';
            $slider_show_class = 'col-lg-12 col-md-12 col-sm-12';
        }


        // slider category title
       $buzz_ecommerce_slidercategory_title = get_theme_mod('buzz_ecommerce_slider_category_list_header_text', esc_html__('ALL CATEGORIES', 'buzz-ecommerce'));

    ?>
    <section id="frontpage_slider_section" >
        <div class="<?php echo esc_attr( $buzz_ecommerce_slider_container ); ?>">
            <div class="row">

                <?php if( $buzz_ecommerce_slider_category_list_enable == true && buzz_ecommerce_is_woocommerce_activated() ): ?>    
                    <!-- All Category Section -->
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="sidebar-content">
                            <div class="title">
                                <?php if( $buzz_ecommerce_slidercategory_title != '' ): ?><h5 id="buzz_ecommerce_slider_category_list_header_text" class="white"><?php echo esc_html( $buzz_ecommerce_slidercategory_title ); ?></h5><?php endif; ?>
                            </div>
                                    <!-- Category List -->
                                    <?php
                                    
                                        // Category List Programming
                                        $taxonomy     = 'product_cat';
                                        $orderby      = 'name';  
                                        $show_count   = 0;      // 1 for yes, 0 for no
                                        $pad_counts   = 0;      // 1 for yes, 0 for no
                                        $hierarchical = 1;      // 1 for yes, 0 for no  
                                        $title        = '';  
                                        $empty        = 0;
                                    
                                        $args = array(
                                            'taxonomy'     => $taxonomy,
                                            'orderby'      => $orderby,
                                            'show_count'   => $show_count,
                                            'pad_counts'   => $pad_counts,
                                            'hierarchical' => $hierarchical,
                                            'title_li'     => $title,
                                            'hide_empty'   => $empty
                                        );
                                    $all_categories = get_categories( $args ); 
                                ?>
                            <ul class="sidebar-menu">
                                <?php   
                                    foreach ( $all_categories as $cat ) {
                                        if($cat->category_parent == 0) {
                                            $category_id = $cat->term_id;       
                                            echo '<li><a href="'. esc_url(get_term_link( $cat->slug, 'product_cat' )) .'">'. esc_html($cat->name) .'</a>';

                                                //Sub Category Arguments 
                                                $sub_category_args = array(
                                                        'taxonomy'     => $taxonomy,
                                                        'child_of'     => 0,
                                                        'parent'       => $category_id,
                                                        'orderby'      => $orderby,
                                                        'show_count'   => $show_count,
                                                        'pad_counts'   => $pad_counts,
                                                        'hierarchical' => $hierarchical,
                                                        'title_li'     => $title,
                                                        'hide_empty'   => $empty
                                                );

                                                $sub_categories = get_categories( $sub_category_args );
                                                if( $sub_categories ) {
                                                    ?>
                                                    <div class="buzz-ecommerce-sub-cate">
                                                        <svg  width="15px" height="15px" viewBox="0 0 31 19" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <!-- Generator: Sketch 49.3 (51167) - http://www.bohemiancoding.com/sketch -->
                                                            <defs></defs>
                                                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                                                <g id="Desktop" transform="translate(-631.000000, -505.000000)" stroke="#fff" stroke-width="4">
                                                                    <polyline id="Path" points="633 507 646 522 660 507"></polyline>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                    <ul class="sub-category buzz-ecommerce-sub-category-sec">
                                                        <?php
                                                            foreach( $sub_categories as $sub_category) {
                                                                echo  '<li><a href="'. esc_url(get_term_link( $sub_category->slug, 'product_cat' )) .'">'.esc_html($sub_category->name).'</a></li>' ;
                                                            }
                                                        ?>
                                                    </ul>
                                                    <?php   
                                                }
                                            
                                            echo "</li>";
                                        }       
                                    }
                                ?>
                            </ul><!-- End the Category List Value -->

                            <!-- Category list End -->
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Slider Section Hear -->
                <?php
                    /**
                     * 
                     * @array Slider Default Value Array
                     */
                    $defaults = array(
                        array(
                            'slider_text'       => esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'buzz-ecommerce'),
                            'slider_links'      => esc_url('#'),
                            'slider_btn_text'   => esc_html__('Shop Now', 'buzz-ecommerce'),
                            'slider_image'      => esc_url( get_template_directory_uri().'/assets/images/slider-item.jpg' ),                       
                        )
                    );
                    $slider_section_items = get_theme_mod( 'homepage_slider_section', $defaults );
                
                    $new = get_theme_mod( 'homepage_slider_section');

                   
                ?>

                <!-- Start Slider Columns -->
                <div class="<?php echo esc_attr( $slider_show_class ); ?>">
                    <div class="sidebar-slider ">
                        <div class="owl-carousel ecommerce-slider">
                            <?php foreach( $slider_section_items as $slider_item ){ ?>
                                <?php 
                                    //Image size Default image 
                                    $img_id = $slider_item['slider_image']; 
                                    if( intval($img_id)){
                                        $slider_image = wp_get_attachment_url( $img_id );
                                    }else{
                                        $slider_image = get_template_directory_uri().'/assets/images/slider-item.jpg';  
                                    }
                                ?>
                                    
                                    <!-- Item Loop Start  -->
                                        <div class="item">
                                            <div class="item-img">
                                                <img src="<?php echo esc_url( $slider_image ); ?>" /> 
                                            </div>
                                            <div class="item-text">
                                                <h2 class="uppercase white"><?php echo esc_html( $slider_item['slider_text'] ); ?></h2>
                                                <?php if( !empty($slider_item['slider_links'] )) : ?>
                                                <a href="<?php echo esc_url( $slider_item['slider_links'] ); ?>" class="shop white slider_button_text_change"><?php echo esc_html(slider_button_text_change_callback()); ?></a> 
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <!-- End Items Loop -->

                            <?php } ?>
                        
                        </div>
                    </div>
                </div><!-- End Slider Section -->
               
            </div>
        </div>
    </section><!-- End Slider Section Hear -->

    <?php
}
add_action( 'slider-section','buzz_ecommerce_homepage_slider_section' );