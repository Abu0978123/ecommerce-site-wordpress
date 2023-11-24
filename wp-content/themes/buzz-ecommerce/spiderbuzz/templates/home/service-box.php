<?php
/**
 * Service Box all Settings Hear
 * 
 */
 function buzz_ecommerce_homepage_service_section(){
    //Service Section Default Value
    $defaults = array(
        array(
            'service_icons'     => esc_html__('fa fa-ambulance','buzz-ecommerce'),
            'service_title'     => esc_html__('FREE DELIVERY','buzz-ecommerce'),
            'service_short_desc'=> esc_html__('From $59.89','buzz-ecommerce'),
        )
    );

    //Service Box Section
    $service_box_items = get_theme_mod( 'homepage_service_box_section', $defaults );
    
     ?>
        <section id="frontpage_service_box_section" class="container">
            <div class="support">
                <div class="row">
                    <?php foreach( $service_box_items as $service_item ){ ?>
                        <div class="col-lg-3 col-md-6 col-sm-6 xs-12 service-box">
                            <div class="feature-box">
                                <div class="service-icon">
                                    <i class="<?php echo esc_attr( $service_item['service_icons'] ); ?> fa-3x"  aria-hidden="true"></i>
                                </div>
                                <div class="service-text">
                                    <div class="ser-title"><?php echo esc_html( $service_item['service_title'] ); ?></div>
                                    <div class="ser-subtitle"><?php echo esc_html( $service_item['service_short_desc'] ); ?></div>   
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    
                </div>
            </div>
        </section>

    <?php
}
add_action('service-box','buzz_ecommerce_homepage_service_section');