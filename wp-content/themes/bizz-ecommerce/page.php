<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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

            <?php 
			if ( class_exists( 'WooCommerce' ) ) {
				if( (is_account_page() || is_cart() || is_checkout() || is_shop()) && is_active_sidebar( 'woocommerce-widgets' )) {
					echo '<div class="col-lg-8">'; 
				}
				else if(is_account_page() || is_cart() || is_checkout() || is_shop() || is_page( 'wishlist' ) ){ 
					echo '<div class="col-lg-12">';
				}
				else if(!is_active_sidebar( 'woocommerce-widgets' ) && is_product_category()){
					echo '<div class="col-lg-12">';
				}
				else if( is_active_sidebar( 'main-sidebar' )) {
					echo '<div class="col-lg-8">';
				}
				else{
					echo '<div class="col-lg-12">';
				}

			}
			else if( is_active_sidebar( 'main-sidebar' )){ 
				echo '<div class="col-lg-8">';
				}
				else{
					echo '<div class="col-lg-12">';
			}
			?>

	                <?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'template-parts/content', 'page' ); 
						if ( comments_open() || '0' != get_comments_number() ) :
						comments_template(); 
						endif; ?>
					<?php endwhile; ?>	
				</div>	
		
				
                <?php
                if (($sidebar_layout == 'has-left-sidebar') || ($sidebar_layout == 'has-right-sidebar') && !is_page( 'wishlist' )) { ?>
					<div class="col-lg-4">
						<?php 
						if ( class_exists( 'WooCommerce' ) ) {
							if( is_account_page() || is_cart() || is_checkout() || is_shop() || is_product_category()) {
									dynamic_sidebar('woocommerce-widgets'); 
							}
							else{ 
								get_sidebar();
							}
						}
						else{ 
							get_sidebar(); 
						}
						?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>

	<?php else :

		get_template_part( 'template-parts/content', 'none' );

	endif;
	?>

<?php
get_footer();