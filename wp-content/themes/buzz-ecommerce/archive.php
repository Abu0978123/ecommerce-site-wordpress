<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Buzz_Ecommerce
 */

get_header();
?>
<div class="container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			?>
				<div class="pagination wraper-pagination">
					<?php the_posts_pagination( array(
							'mid_size' => 2,
							'prev_text' => __( '<i class="fa fa-angle-double-left" aria-hidden="true"></i>', 'buzz-ecommerce' ),
							'next_text' => __( '<i class="fa fa-angle-double-right" aria-hidden="true"></i>', 'buzz-ecommerce' ),
						) ); 
					?>
				</div>
			<?php

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
if( get_theme_mod('buzz_ecommerce_sidebar_layout_settings','right-sidebar') != 'full-width' ){
	get_sidebar();
}
get_footer();
