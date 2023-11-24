<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Buzz_Ecommerce
 */

?>
		</div>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		
		<div class="site-info">
			<a href="<?php echo esc_url( 'https://wordpress.org/' ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'buzz-ecommerce' ), 'WordPress' );
				?>
			</a>
			<span class="sep">|</span>
			<a href="<?php echo esc_url('http://www.spideruzz.com'); ?>">
				<?php
					/* translators: 1: Theme name, 2: Theme author. */
					printf( esc_html__( 'Theme: %1$s by %2$s.', 'buzz-ecommerce' ), 'Buzz Ecommerce', 'Spiderbuzz' );
				?>
			<!-- .site-info -->
			</a>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
