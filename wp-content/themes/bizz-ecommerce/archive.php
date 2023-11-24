<?php
/**
 * The template for displaying archive pages
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

	<div class="sp-100 bg-w">
        <div class="container">
            <div class="row <?php echo esc_attr($sidebar_layout); ?>">
            	<?php 
            	if( is_active_sidebar( 'main-sidebar' )) {
					echo '<div class="col-lg-8">';
				}
				else{
					echo '<div class="col-lg-12">';
				}?>
                

					<header class="page-header">
						<?php
						if ( have_posts() ) :
							the_archive_title( '<h1 class="page-title">', '</h1>' );
							the_archive_description( '<div class="archive-description">', '</div>' );
						else :
							printf( '<h1 class="page-title">%1$s</h1>', esc_html__( 'Nothing Found', 'bizz-ecommerce' ) );
						endif;
						?>
					</header><!-- .page-header -->

					<?php if ( have_posts() ) : ?>

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
						

					<?php else : ?>

						<?php get_template_part( 'template-parts/content', 'none' ); ?>

					<?php endif;?>

				</div>
				
				<?php
		        if (($sidebar_layout == 'has-left-sidebar') || ($sidebar_layout == 'has-right-sidebar') && is_active_sidebar( 'main-sidebar' )) { ?>
					<div class="col-lg-4">
						<aside class="sidebar mt-5 mt-lg-0">
                        	<?php get_sidebar(); ?>
                    	</aside>
					</div>
				<?php } ?>
				
			</div> 
		</div> 
	</div>

<?php
get_footer();