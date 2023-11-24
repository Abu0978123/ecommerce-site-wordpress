<?php
/**
 * bizz-ecommerce functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package bizz-ecommerce
 */

if ( ! defined( 'BIZZ_ECOMMERCE_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'BIZZ_ECOMMERCE_VERSION', '1.0.2' );
	define( 'BIZZ_ECOMMERCE_THEME_DIR', get_template_directory() . '/' );
	define( 'BIZZ_ECOMMERCE_THEME_URI', get_template_directory_uri() . '/' );
}

if ( ! function_exists( 'bizz_ecommerce_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function bizz_ecommerce_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on bizz-ecommerce, use a find and replace
		 * to change 'bizz-ecommerce' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'bizz-ecommerce', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary-menu' => esc_html__( 'Primary Menu', 'bizz-ecommerce' ),
				'footer-menu' => esc_html__( 'Footer Menu', 'bizz-ecommerce' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'bizz_ecommerce_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'bizz_ecommerce_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bizz_ecommerce_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bizz_ecommerce_content_width', 640 );
}
add_action( 'after_setup_theme', 'bizz_ecommerce_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bizz_ecommerce_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'bizz-ecommerce' ),
			'id'            => 'main-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'bizz-ecommerce' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widgets', 'bizz-ecommerce' ),
			'id'            => 'footer-widgets',
			'description'   => esc_html__( 'Add widgets here.', 'bizz-ecommerce' ),
			'before_widget' => '<div class="%2$s footer-widget col-md-3 col-sm-6 col-xs-12">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	if ( class_exists( 'WooCommerce' ) ) {
		register_sidebar(
		array(
			'name'          => esc_html__( 'WooCommerce Sidebar', 'bizz-ecommerce' ),
			'id'            => 'woocommerce-widgets',
			'description'   => esc_html__( 'Add widgets here.', 'bizz-ecommerce' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	}
}
add_action( 'widgets_init', 'bizz_ecommerce_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bizz_ecommerce_scripts() {
	
	wp_enqueue_style('dashicons');
	wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.css');
	wp_enqueue_style('animate-css', get_template_directory_uri() . '/assets/css/animate.css');
	wp_enqueue_style('bizz-ecommerce-header-css', get_template_directory_uri() . '/assets/css/header.css');
	wp_enqueue_style('magnific-popup-css', get_template_directory_uri() . '/assets/css/magnific-popup.css');
	wp_enqueue_style('owl-carousel-css', get_template_directory_uri() . '/assets/css/owl.carousel.css');
	wp_enqueue_style('owl-theme-default-css', get_template_directory_uri() . '/assets/css/owl.theme.default.css');
	wp_enqueue_style('font-awesome-css', get_template_directory_uri() . '/assets/css/font-awesome.css');
	wp_enqueue_style('bizz-ecommerce-responsive-css', get_template_directory_uri() . '/assets/css/responsive.css');
	wp_enqueue_style('bizz-ecommerce-skin-css', get_template_directory_uri() . '/assets/css/skin-2.css');
	wp_enqueue_style('select-css', get_template_directory_uri() . '/assets/css/select2.css');
	wp_enqueue_style('bizz-ecommerce-homestyle-css', get_template_directory_uri() . '/assets/css/home7style.css');
	wp_enqueue_style('bizz-ecommerce-front-css', get_template_directory_uri() . '/assets/css/front-style.css');
	wp_enqueue_style('bizz-ecommerce-custom-css', get_template_directory_uri() . '/assets/css/bizz-ecommerce-custom.css');
	wp_enqueue_style('bizz-ecommerce-woocommerce-css', get_template_directory_uri() . '/assets/css/bizz-ecommerce-woocommerce.css');

	wp_enqueue_style( 'bizz-ecommerce-style', get_stylesheet_uri(), array(), BIZZ_ECOMMERCE_VERSION );
	wp_add_inline_style('bizz-ecommerce-style', bizz_ecommerce_custom_style());
	wp_style_add_data( 'bizz-ecommerce-style', 'rtl', 'replace' );

	wp_enqueue_script( 'bizz-ecommerce-navigation', get_template_directory_uri() . '/js/navigation.js', array(), BIZZ_ECOMMERCE_VERSION, true );

	wp_enqueue_script( 'bizz-ecommerce-theme-js', get_template_directory_uri() . '/assets/js/theme.js',array('jquery'), BIZZ_ECOMMERCE_VERSION, true );

	wp_enqueue_script( 'jquery-ui-js', get_template_directory_uri() . '/assets/js/jquery-ui.js',array(), BIZZ_ECOMMERCE_VERSION, true );

 	wp_enqueue_script( 'popper-js', get_template_directory_uri() . '/assets/js/popper.js',array(), BIZZ_ECOMMERCE_VERSION, true );

    wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.js',array(), BIZZ_ECOMMERCE_VERSION, true );

  	wp_enqueue_script( 'owl-carouel-js', get_template_directory_uri() . '/assets/js/owl.carousel.js',array(), BIZZ_ECOMMERCE_VERSION, true );

  	wp_enqueue_script( 'jquery-magnific-popup-js', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.js',array(), BIZZ_ECOMMERCE_VERSION, true );
  	
  	wp_enqueue_script( 'wow-js', get_template_directory_uri() . '/assets/js/wow.js',array(), BIZZ_ECOMMERCE_VERSION, true );
  	
  	wp_enqueue_script( 'select2-js', get_template_directory_uri() . '/assets/js/select2.js',array(), BIZZ_ECOMMERCE_VERSION, true );

    wp_enqueue_script( 'bizz-ecommerce-custom-slider-js', get_template_directory_uri() . '/assets/js/custom-slider.js',array(), BIZZ_ECOMMERCE_VERSION, true ); 

    wp_enqueue_script( 'bizz-ecommerce-custom-js', get_template_directory_uri() . '/assets/js/custom.js',array(), BIZZ_ECOMMERCE_VERSION, true );  

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'bizz_ecommerce_scripts' );

/**
 * Nav Walker fo Bootstrap Dropdown Menu.
 */
require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/* breadcrumb */
require get_template_directory() . '/inc/bizz-ecommerce-breadbrumb.php';
require get_template_directory() . '/inc/breadcrumbs.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/controls.php';

/**
 * Add feature in Customizer  
 */
require get_template_directory() . '/inc/customizer/cv-customizer.php';

/*Plugin Recommendation*/
require get_template_directory()  . '/inc/tgm/class-tgm-plugin-activation.php';
require get_template_directory(). '/inc/tgm/hook-tgm.php';

/*Testerwp Ecommerce Companion*/

/**
 * Load init.
 */
require_once trailingslashit(BIZZ_ECOMMERCE_THEME_DIR).'inc/init.php';

//custom function conditional check for blog page
function bizz_ecommerce_is_blog (){
    return ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag()) && 'post' == get_post_type();
}

// Recommend plugins
add_theme_support( 'recommend-plugins', array(

	'testerwp-ecommerce-companion' => array(
        'name' => esc_html__( 'Testerwp Ecommerce Companion (Highly Recommended)', 'bizz-ecommerce' ),
        'img' => 'icon-128x128.png',
        'active_filename' => 'testerwp-ecommerce-companion/testerwp-ecommerce-companion.php',
    ),
    'one-click-demo-import' => array(
        'name' => esc_html__( 'One Click Demo Import', 'bizz-ecommerce' ),
        'img' => 'icon-128x128.png',
        'active_filename' => 'one-click-demo-import/one-click-demo-import.php',
    ),
    'woocommerce' => array(
        'name' => esc_html__( 'Woocommerce', 'bizz-ecommerce' ),
         'img' => 'icon-128x128.png',
        'active_filename' => 'woocommerce/woocommerce.php',
    ),

    'yith-woocommerce-wishlist' => array(
         'name' => esc_html__( 'YITH WooCommerce Wishlist', 'bizz-ecommerce' ),
          'img' => 'icon-128x128.jpg',
         'active_filename' => 'yith-woocommerce-wishlist/init.php',
     ),
) );

/**
 * Customizer additional settings.
 */
require_once( trailingslashit( get_template_directory() ) . '/inc/custom-addition/class-customize.php' );