
<div class="menu-modal header-mobile-menu cover-modal header-footer-group" data-modal-target-string=".menu-modal">
    <div class="menu-modal-inner modal-inner">
        <div class="menu-wrapper section-inner">
            <div class="menu-top">

                <button class="toggle close-nav-toggle" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".menu-modal">
                    <span class="toggle-text"><?php esc_html_e( 'Close', 'buzz-ecommerce' ); ?></span>
                    <i class="fa fa-times"></i>
                </button><!-- .nav-toggle -->

                <div class="menu-search-form widget_search">
                    <?php get_search_form(); ?>
                </div>

                <div class='buzz-ecommerce-tab-wrap'>
                    <div class="buzz-ecommerce-tabs we-tab-area">
                        <button class="buzz-ecommerce-tab-menu active" id="buzz-ecommerce-tab-menu1">
                            <span><?php echo esc_html( 'Menu','buzz-ecommerce' ) ?></span>
                        </button>
                    </div>

                    <div class="buzz-ecommerce-tab-content we-tab-content">
                        <div class="buzz-ecommerce-tab-menu-content tab-content" id="buzz-ecommerce-content-menu1">
                            <nav class="mobile-menu" aria-label="<?php esc_attr_e( 'Mobile', 'buzz-ecommerce' ); ?>" role="navigation">
                                <ul class="modal-menu">
                                    <?php
                                        if ( has_nav_menu( 'menu-1' ) ) {
                                            wp_nav_menu(
                                                array(
                                                    'container'      => '',
                                                    'items_wrap'     => '%3$s',
                                                    'show_toggles'   => true,
                                                    'theme_location' => 'menu-1',
                                                )
                                            );
                                       }
                                    ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>