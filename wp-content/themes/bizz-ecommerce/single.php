<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bizz-ecommerce
 */

get_header();
?>
<?php
    $sidebar_layout = get_theme_mod('bizz_ecommerce_sidebar_layout_section', 'right');
    if ($sidebar_layout == 'left') {
        $sidebar_layout = 'has-left-sidebar';
    } elseif ($sidebar_layout == 'right') {
        $sidebar_layout = 'has-right-sidebar';
    } elseif ($sidebar_layout == 'no') {
        $sidebar_layout = 'no-sidebar';
    }
?>
    <!-- Page Breadcrumb Start -->
    <?php  bizz_ecommerce_breadbrumb(); ?>
    <!-- Page Breadcrumb Ends -->

    <?php
    if ( have_posts() ) : ?>

	<!-- blog detail start-->
    <div class="sp-100 bg-w">
        <div class="container">
            <div class="row <?php echo esc_attr($sidebar_layout); ?>">
                
                <?php if( class_exists( 'WooCommerce' ) && is_product() ){ ?>
                        <div class="col-lg-12">
                <?php } else if(is_active_sidebar( 'main-sidebar' )){ ?>
                        <div class="col-lg-8">
                <?php } else { ?>
                    <div class="col-lg-12">
                <?php } ?>



                    <?php while ( have_posts() ) : the_post(); bizz_ecommerce_set_post_view(); ?>
						<?php get_template_part( 'template-parts/content', 'single' ); 
						if ( (comments_open() || '0' != get_comments_number()) && class_exists( 'WooCommerce') && !is_product() ) :
						comments_template(); 
						endif;?>
						
					<?php endwhile; ?>

                </div>
                
                    <?php
                    if (($sidebar_layout == 'has-left-sidebar') || ($sidebar_layout == 'has-right-sidebar') && class_exists( 'WooCommerce') && !is_product() && is_active_sidebar( 'main-sidebar' )) { ?>
                        <div class="col-lg-4">
    	                    <aside class="sidebar mt-5 mt-lg-0">
    	                        <?php get_sidebar(); ?>
    	                    </aside>
                    	</div>
                    <?php } ?>    
                
            </div>
        </div>
    </div>
    <!-- blog detail ends-->

<?php 	
endif;
?>		

<?php
get_footer();
