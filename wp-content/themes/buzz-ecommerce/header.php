<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Buzz_Ecommerce
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php echo esc_html__( 'Skip to content', 'buzz-ecommerce' ); ?></a>

	<?php $buzz_ecommerce_header_image = esc_url( get_header_image()); ?>
	<header id="masthead" class="site-header" <?php if( !empty( $buzz_ecommerce_header_image ) ): ?> style="background:url(<?php echo esc_url($buzz_ecommerce_header_image); ?>)"  <?php endif; ?>>
			<div class="site-branding">
				<?php
				the_custom_logo();
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$buzz_ecommerce_description = get_bloginfo( 'description', 'display' );
				if ( $buzz_ecommerce_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $buzz_ecommerce_description; /* WPCS: xss ok. */ ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->
			<?php buzz_ecommerce_header_search(); ?>

			<nav id="site-navigation" class="main-navigation">
				<?php do_action( 'buzz_ecommerce_menu_toggle' ); ?>
				<div class="container">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						) );
					?>

					<?php if( buzz_ecommerce_is_woocommerce_activated() ): ?>
						<div class="buzz-ecommerce-header-cart">
							<?php
								$buzz_header_cart = new buzz_ecommerce_Woocommerce();
								//Header Add To Cart Section
								$buzz_header_cart->buzz_ecommerce_woocommerce_header_cart();
							?>
						</div>
					<?php endif; ?>
					
				</div>
				
			</nav><!-- #site-navigation -->
			
		</header><!-- #masthead -->

		<?php
			if( !is_front_page() ){
				if( !buzz_ecommerce_is_woocommerce_activated() ){
					buzz_ecommerce_breadcrumb();#breadcrub
				}else{
					$args = array();
					woocommerce_breadcrumb( $args );
				}
			}
		?>
		<div id="content" class="site-content">