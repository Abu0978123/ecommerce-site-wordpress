<?php
/**
 * Banner Sections
 * Front-page Brand Logo Functions Hear
 * 
 */
 function buzz_ecommerce_homepage_banner_sections(){
    //default value
    $banner_default = array(
            array(
                'banner_image'     => esc_url(get_template_directory_uri().'/assets/images/mac-add.jpg'),
                'banner_links'     => esc_url('#')                      
            ),
        );

    $buzz_ecommerce_homepage_banner = get_theme_mod( 'buzz_ecommerce_homepage_banner',$banner_default );
    ?>
        <section id="buzz_ecommerce_banner_images" class="buzz-ecommerce-product-ads">
            <div class="container">
                <div class="row">
                    
                    <?php 
                    if(  $buzz_ecommerce_homepage_banner ){
                        $banner_count = 1;
                        foreach( $buzz_ecommerce_homepage_banner as $banner_images ){
                            
                            //Image size Default image 
                            $brand_logo_slider_image_id = $banner_images['banner_image']; 
                            if( intval($brand_logo_slider_image_id)){
                                $brand_logo_slider_image = wp_get_attachment_url( $brand_logo_slider_image_id );
                            }else{
                                $brand_logo_slider_image = $banner_images['banner_image'];
                            }

                            if( ($banner_count%3) == 0){
                              $banner_class =  'col-lg-12 col-md-12 col-sm-12 col-xs-12';
                            }else{
                                $banner_class =  'col-lg-6 col-md-6 col-sm-6 col-xs-12';
                            }$banner_count++;
                        
                        ?>
                        <!-- loop the banner images options-->
                        <div class="<?php echo esc_attr($banner_class); ?>">
                            <div class="buzz-ecommerce-product-ads-item">
                                <a href="<?php echo  esc_url( $banner_images['banner_links'] ); ?>">
                                    <img src="<?php echo esc_url( $brand_logo_slider_image ); ?>" >
                                </a>
                            </div>
                        </div>
                        <!--# End loop the banner images options -->
                    <?php }} ?>

                </div>
            </div>
        </section>
    <?php
}
add_action( 'homepage_brand_logo','buzz_ecommerce_homepage_banner_sections' );