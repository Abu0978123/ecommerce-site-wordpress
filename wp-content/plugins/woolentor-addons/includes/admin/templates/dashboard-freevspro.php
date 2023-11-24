<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    $feature_list = [
        'icons'=>[
            'check' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="green" d="m10.6 16.6l7.05-7.05l-1.4-1.4l-5.65 5.65l-2.85-2.85l-1.4 1.4l4.25 4.25ZM12 22q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22Zm0-2q3.35 0 5.675-2.325T20 12q0-3.35-2.325-5.675T12 4Q8.65 4 6.325 6.325T4 12q0 3.35 2.325 5.675T12 20Zm0-8Z"/></svg>',
            'cross' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="red" d="m8.4 17l3.6-3.6l3.6 3.6l1.4-1.4l-3.6-3.6L17 8.4L15.6 7L12 10.6L8.4 7L7 8.4l3.6 3.6L7 15.6L8.4 17Zm3.6 5q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22Zm0-2q3.35 0 5.675-2.325T20 12q0-3.35-2.325-5.675T12 4Q8.65 4 6.325 6.325T4 12q0 3.35 2.325 5.675T12 20Zm0-8Z"/></svg>',
        ],
        'features'=>[
            [
                'name'   => esc_html__('WooCommerce Template Builder','woolentor'),
                'status' => 'limited'
            ],
            [
                'name'   => esc_html__('Single Product Individual Layout','woolentor'),
                'status' => 'pro'
            ],
            [
                'name'   => esc_html__('Individual Archive Page Builder','woolentor'),
                'status' => 'pro'
            ],
            [
                'name'   => esc_html__('Custom cart Page Builder','woolentor'),
                'status' => 'pro'
            ],
            [
                'name'   => esc_html__('Custom checkout Page Builder','woolentor'),
                'status' => 'pro'
            ],
            [
                'name'   => esc_html__('Custom thank You Page Builder','woolentor'),
                'status' => 'pro'
            ],
            [
                'name'   => esc_html__('Custom my account Page Builder','woolentor'),
                'status' => 'pro'
            ],
            [
                'name'   => esc_html__('Custom My Account Login and Register page Builder','woolentor'),
                'status' => 'pro'
            ],
            [
                'name'   => esc_html__('Template Library','woolentor'),
                'status' => 'limited'
            ],
            [
                'name'   => esc_html__('Product Slider','woolentor'),
                'status' => 'free'
            ],
            [
                'name'   => esc_html__('Product Tab','woolentor'),
                'status' => 'free'
            ],
            [
                'name'   => esc_html__('Special Day offer banner','woolentor'),
                'status' => 'free'
            ],
            [
                'name'   => esc_html__('Product Grid (Curvy)','woolentor'),
                'status' => 'free'
            ],
            [
                'name'   => esc_html__('Product Accordion Listing','woolentor'),
                'status' => 'free'
            ],
            [
                'name'   => esc_html__('Product Image Accordion','woolentor'),
                'status' => 'free'
            ],
            [
                'name'   => esc_html__('Ajax Add to Cart (In Product Detail Page)','woolentor'),
                'status' => 'free'
            ],
            [
                'name'   => esc_html__('Sale / Discount Schedule Counter','woolentor'),
                'status' => 'free'
            ],
            [
                'name'   => esc_html__('Sticky Add to cart','woolentor'),
                'status' => 'pro'
            ],
            [
                'name'   => esc_html__('Product Grid','woolentor'),
                'status' => 'pro'
            ],
            [
                'name'   => esc_html__('Product QR Code','woolentor'),
                'status' => 'pro'
            ]
        ],
        'module'=>[
            [
                'name'   => esc_html__('Rename Label','woolentor'),
                'status' => 'free'
            ],
            [
                'name'   => esc_html__('Sales Notification','woolentor'),
                'status' => 'free'
            ],
            [
                'name'   => esc_html__('Shopify Style Checkout','woolentor'),
                'status' => 'free'
            ],
            [
                'name'   => esc_html__('Flash Sale Countdown','woolentor'),
                'status' => 'free'
            ],
            [
                'name'   => esc_html__('Ajax Search Widget','woolentor'),
                'status' => 'free'
            ],
            [
                'name'   => esc_html__('Single Product Ajax Add To Cart','woolentor'),
                'status' => 'free'
            ],
            [
                'name'   => esc_html__('Product Compare','woolentor'),
                'status' => 'free'
            ],
            [
                'name'   => esc_html__('Wishlist','woolentor'),
                'status' => 'free'
            ],
            [
                'name'   => esc_html__('Backorder','woolentor'),
                'status' => 'free'
            ],
            [
                'name'   => esc_html__('Variation Swatches','woolentor'),
                'status' => 'free'
            ],
            [
                'name'   => esc_html__('Post Duplicator','woolentor'),
                'status' => 'free'
            ],
            [
                'name'   => esc_html__('Popup Builder','woolentor'),
                'status' => 'limited'
            ],
            [
                'name'   => esc_html__('Order Bump','woolentor'),
                'status' => 'pro'
            ],
            [
                'name'   => esc_html__('Product Filter','woolentor'),
                'status' => 'pro'
            ],
            [
                'name'   => esc_html__('Email Customizer','woolentor'),
                'status' => 'pro'
            ],
            [
                'name'   => esc_html__('Email Automation','woolentor'),
                'status' => 'pro'
            ],
            [
                'name'   => esc_html__('Partial Payment','woolentor'),
                'status' => 'pro'
            ],
            [
                'name'   => esc_html__('Pre Orders','woolentor'),
                'status' => 'pro'
            ],
            [
                'name'   => esc_html__('Product sticky Add to cart','woolentor'),
                'status' => 'pro'
            ],
            [
                'name'   => esc_html__('Side Mini Cart','woolentor'),
                'status' => 'pro'
            ],
            [
                'name'   => esc_html__('Redirect to Checkout','woolentor'),
                'status' => 'pro'
            ],
            [
                'name'   => esc_html__('Multi Step Checkout','woolentor'),
                'status' => 'pro'
            ],
            [
                'name'   => esc_html__('GTM Conversion Tracking','woolentor'),
                'status' => 'pro'
            ],
            [
                'name'   => esc_html__('Product Size Chart','woolentor'),
                'status' => 'pro'
            ],
            [
                'name'   => esc_html__('Checkout Fields Manager','woolentor'),
                'status' => 'pro'
            ],
        ]
    ];
?>
<div id="woolentor_freevspro_tabs" class="woolentor-admin-main-tab-pane">
    <div class="woolentor-admin-main-tab-pane-inner">
        <!-- Header Start -->
        <div class="woolentor-admin-header">
            <div class="woolentor-admin-header-content">
                <h6 class="woolentor-admin-header-title"><?php echo esc_html__('ShopLentor Free Vs Pro','woolentor');?></h6>
                <p class="woolentor-admin-header-text"><?php echo esc_html__('Discover all the differences between the free and premium versions.','woolentor');?></p>
            </div>
            <div class="woolentor-admin-header-actions">
                <a class="woolentor-admin-btn enable" href="https://woolentor.com/pricing/?utm_source=admin&utm_medium=notice&utm_campaign=free" target="_blank"><?php echo esc_html__('Upgrade Now','woolentor'); ?></a>
            </div>
        </div>
        <!-- Header End -->

        <div class="different-free-vs-pro">
            <table>
                <thead>
                    <tr>
                        <th><?php echo esc_html__('Features','woolentor');?></th>
                        <th><?php echo esc_html__('Free','woolentor');?></th>
                        <th><?php echo esc_html__('Pro','woolentor');?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach( $feature_list['features'] as $key => $feature ){
                            $free_status_text = $feature_list['icons']['cross'];
                            $pro_status_text  = $feature_list['icons']['check'];

                            if( $feature['status'] === 'limited' ){
                                $free_status_text = esc_html__('Limited Features','woolentor');
                                $pro_status_text = esc_html__('All Features','woolentor');
                            }else{
                                if( $feature['status'] === 'free'){
                                    $free_status_text = $feature_list['icons']['check'];
                                }
                            }
                            ?>
                                <tr>
                                    <td><?php echo esc_html( $feature['name'] ); ?></td>
                                    <td width="140px">
                                        <?php
                                            // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		                                    printf( '%s', $free_status_text );
                                        ?>
                                    </td>
                                    <td width="140px">
                                        <?php
                                            // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		                                    printf( '%s', $pro_status_text );
                                        ?>
                                    </td>
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="woolentor-admin-option-heading woolentor_heading_style_two"><h4 class="woolentor-admin-option-heading-title regular-title"><?php echo esc_html__('Module','woolentor'); ?></h4></div>
        <div class="different-free-vs-pro">
            <table>
                <thead>
                    <tr>
                        <th><?php echo esc_html__('Name','woolentor');?></th>
                        <th><?php echo esc_html__('Free','woolentor');?></th>
                        <th><?php echo esc_html__('Pro','woolentor');?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach( $feature_list['module'] as $key => $feature ){
                            $free_status_text = $feature_list['icons']['cross'];
                            $pro_status_text  = $feature_list['icons']['check'];

                            if( $feature['status'] === 'limited' ){
                                $free_status_text = esc_html__('Limited Features','woolentor');
                                $pro_status_text = esc_html__('All Features','woolentor');
                            }else{
                                if( $feature['status'] === 'free'){
                                    $free_status_text = $feature_list['icons']['check'];
                                }
                            }
                            ?>
                                <tr>
                                    <td><?php echo esc_html( $feature['name'] ); ?></td>
                                    <td width="140px">
                                        <?php
                                            // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		                                    printf( '%s', $free_status_text );
                                        ?>
                                    </td>
                                    <td width="140px">
                                        <?php
                                            // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		                                    printf( '%s', $pro_status_text );
                                        ?>
                                    </td>
                                </tr>
                            <?php
                        }
                    ?>
                    <tr class="explore-pro-features">
                        <td colspan="3">
                            <a href="https://woolentor.com/?utm_source=admin&utm_medium=notice&utm_campaign=free" target="_blank"><?php echo esc_html__('Explore the all features of ShopLentor Pro','woolentor'); ?><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M6.4 18L5 16.6L14.6 7H6V5h12v12h-2V8.4L6.4 18Z"/></svg></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    </div>
</div>