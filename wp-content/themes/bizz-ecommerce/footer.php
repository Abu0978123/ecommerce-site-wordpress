<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bizz-ecommerce
 */

?>
</div><!-- #main -->

<?php 
$display_copyright = get_theme_mod('bizz_ecommerce_enable_cpright_footer_section',true);
$enable_scrolltop = get_theme_mod('bizz_ecommerce_enable_scroll_top',true);
$copyright_content = get_theme_mod('bizz_ecommerce_cpright_footer_section','Powered by WordPress');
$display_logo = get_theme_mod('bizz_ecommerce_enable_logo_footer_section',true);
$logo_image_url = get_theme_mod('bizz_ecommerce_logo_footer_section','');

$footer_title = get_theme_mod('bizz_ecommerce_title_footer_section','TAKE OWNERSHIP OF YOUR BRAND');
$footer_description = get_theme_mod('bizz_ecommerce_description_footer_section','Finally, a partner that handles the heavy lifting for you.');
$display_fsocial = get_theme_mod('bizz_ecommerce_enable_social_footer_section',true);
$facebook_link = get_theme_mod('bizz_ecommerce_social_fb_button_link_footer','#');
$instagram_link = get_theme_mod('bizz_ecommerce_social_insta_button_link_footer','#');
$linkedin_link = get_theme_mod('bizz_ecommerce_social_lkdn_button_link_footer','#');
$social_icon_target = get_theme_mod('bizz_ecommerce_enable_new_tab_footer_section',true);
$separator_title = get_theme_mod('bizz_ecommerce_separator_title_footer_section','Start a conversation');
?>

	<footer class="footer footer-one">
        <div class="foot-top">
            <div class="container">
                <div class="row">
                  <div class="col-md-6">
                    <?php if($display_logo && $logo_image_url) { ?>
                    <div class="logo">
                      
                      <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <img src="<?php echo esc_url($logo_image_url); ?>" alt="logo" class="img-fluid">
                      </a>

                    </div>
                    <?php } ?>
                  </div>
                  <div class="col-md-6 text-right">
                    <h2><?php echo esc_html($footer_title); ?></h2>
                    <p class="desc"><?php echo esc_html($footer_description); ?></p>
                  </div>
                  <div class="col-md-8 menu-link">
                    <?php if(has_nav_menu('footer-menu')) { ?>
                      <?php
                      wp_nav_menu(
                          array(
                              'theme_location' => 'footer-menu',
                              'menu_id'        => 'footer-menu',
                          )
                      );
                      ?>
                  <?php } ?>
                  </div>
                  <div class="col-md-4 social-icon text-right">
                    <?php if($display_fsocial) { ?>
                    <ul>
                      <?php if($facebook_link != "") { ?>
                      <li>
                        <a href="<?php echo esc_url($facebook_link); ?>" <?php if($social_icon_target) { ?> target="_blank" <?php } ?>><i class="fa fa-facebook-official"></i></a>
                      </li>
                      <?php } ?>

                      <?php if($instagram_link != "") { ?>
                      <li>
                        <a href="<?php echo esc_url($instagram_link); ?>" <?php if($social_icon_target) { ?> target="_blank" <?php } ?>><i class="fa fa-instagram"></i></a>
                      </li>
                      <?php } ?>

                      <?php if($linkedin_link != "") { ?>
                      <li>
                        <a href="<?php echo esc_url($linkedin_link); ?>" <?php if($social_icon_target) { ?> target="_blank" <?php } ?>><i class="fa fa-linkedin-square"></i></a>
                      </li>
                      <?php } ?>
                    </ul>
                    <?php } ?>
                  
                  <?php if($display_copyright) { ?>
                    <div class="footer-credits">

                        <p class="footer-copyright">&copy;
                          <?php
                          echo esc_html(date_i18n(
                            /* translators: Copyright date format, see https://www.php.net/manual/datetime.format.php */
                            _x( 'Y', 'copyright date format', 'bizz-ecommerce' )
                          ));
                          ?>
                          <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                        </p><!-- .footer-copyright -->

                        <p class="powered-by">
                          <?php if($copyright_content == ""){ ?>
                          <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'bizz-ecommerce' ) ); ?>">
                            <?php esc_html_e( 'Powered by WordPress', 'bizz-ecommerce' ); ?>
                          </a>
                        <?php } else { ?>
                          <?php echo esc_html($copyright_content); ?>
                        <?php } ?>
                        </p><!-- .powered-by -->

                    </div><!-- .footer-credits -->
                  <?php } ?>  

                  </div>
                  <div class="col-md-12">
                    <h1 class="heading-con">
                      <?php echo esc_html($separator_title); ?>
                    </h1>
                  </div>
                  
                  <?php if ( is_active_sidebar( 'footer-widgets' ) ) { ?>
                  
                    <div class="footer-top">
                        <div class="row clearfix">
                            <?php dynamic_sidebar('footer-widgets'); ?>      
                        </div>
                    </div>
                  
                  <?php } ?>

                </div>
            </div>
        </div>
    </footer>

    <!-- ====== Go to top ====== -->
    <?php if($enable_scrolltop) { ?>
    <a id="c-scroll" title="Go to top" href="javascript:void(0)">
      TOP
    </a>
    <?php } ?>
    
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
