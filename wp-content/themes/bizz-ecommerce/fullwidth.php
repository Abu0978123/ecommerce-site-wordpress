<?php
/**
Template Name: Full Width Page
**/
get_header();
?>

<?php
if ( have_posts() ) : ?>

<!-- blog detail start-->
<div class="sp-100 bg-w">
    <div class="container">
        <div class="row <?php echo esc_attr($sidebar_layout); ?>">
            <div class="col-sm-12">
                <?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/content', 'page' ); 
					if ( comments_open() || '0' != get_comments_number() ) :
					comments_template(); 
					endif; ?>
				<?php endwhile; ?>	
			</div>	
		</div>
	</div>
</div>

<?php else :

	get_template_part( 'template-parts/content', 'none' );

endif;
?>
	

<?php
get_footer();
?>