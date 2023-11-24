<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
		            	<?php if( is_active_sidebar( 'main-sidebar' ) ){ ?>
								<div class="col-lg-8">
						<?php }else{ ?>
								<div class="col-lg-12">
						<?php } ?>	 	
			                <?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part( 'template-parts/content', get_post_type() ); ?>
							<?php endwhile; ?>	

							<div class="row">
		                        <div class="col-12 text-center">
		                            <div class="pagination mt-5">
		                                <?php echo paginate_links(); ?>
		                            </div>
		                        </div>
		                    </div>
							
						</div>	
						
						<?php
		                if (($sidebar_layout == 'has-left-sidebar') || ($sidebar_layout == 'has-right-sidebar')) { ?>
							<div class="col-lg-4">
								<?php get_sidebar(); ?>
							</div>
						<?php } ?>
					</div>
					</div>
				</div>
			</div>
		<?php
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

<?php
get_footer();
