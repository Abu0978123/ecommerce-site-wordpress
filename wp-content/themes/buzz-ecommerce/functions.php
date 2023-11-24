<?php
/**
 * Buzz Ecommerce functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Buzz_Ecommerce
 */

if ( ! function_exists( 'buzz_ecommerce_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function buzz_ecommerce_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Buzz Ecommerce, use a find and replace
		 * to change 'buzz-ecommerce' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'buzz-ecommerce', get_template_directory() . '/languages' );

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
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'buzz-ecommerce' ),
		) );

		/**
		 * Registers an editor stylesheet for the theme.
		 */
		function buzz_ecommerce_add_editor_styles() {
			add_editor_style( 'buzz-ecommerce-style' );
		}
		add_action( 'admin_init', 'buzz_ecommerce_add_editor_styles' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'buzz_ecommerce_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 80,
			'width'       => 200,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'buzz_ecommerce_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function buzz_ecommerce_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'buzz_ecommerce_content_width', 640 );
}
add_action( 'after_setup_theme', 'buzz_ecommerce_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function buzz_ecommerce_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'buzz-ecommerce' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'buzz-ecommerce' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'buzz_ecommerce_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function buzz_ecommerce_scripts() {


	//Theme Version Check
	$buzz_ecommerce = wp_get_theme();
	$theme_version = $buzz_ecommerce->get( 'Version' );

	//Google Fonts Enqueue
	$buzz_ecommerce_google_fonts_list = array('Josefin+Sans','Merienda');
	foreach(  $buzz_ecommerce_google_fonts_list as $google_font ){
		wp_enqueue_style( 'buzz-ecommerce-google-fonts-'.$google_font, '//fonts.googleapis.com/css?family='.$google_font.':300italic,400italic,700italic,400,700,300', false ); 
	}

	// style file
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/library/bootstrap/css/bootstrap.min.css', array(), $theme_version );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/library/font-awesome/css/font-awesome.css', array(), $theme_version );
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/library/owl-carousel/css/owl.carousel.css', array(), $theme_version );
	wp_enqueue_style( 'buzz-ecommerce-custom', get_template_directory_uri() . '/assets/css/custom.css', array(), $theme_version );
	wp_enqueue_style( 'buzz-ecommerce-style', get_stylesheet_uri() );

	
	/**
	 * Enqueue Script
	 */
	wp_enqueue_script( 'jquery.matchHeight-min.js', get_template_directory_uri() . '/assets/library/jquery-match-height/jquery.matchHeight-min.js', array('jquery'), $theme_version , true );
	wp_enqueue_script( 'owl.carousel', get_template_directory_uri() . '/assets/library/owl-carousel/js/owl.carousel.min.js', array('jquery'), $theme_version , true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/library/bootstrap/js/bootstrap.min.js', array('jquery'), $theme_version , true );
	wp_enqueue_script( 'buzz-ecommerce-custom', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), $theme_version , true );
	wp_enqueue_script( 'buzz-ecommerce-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), $theme_version , true );
	wp_enqueue_script( 'buzz-ecommerce-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), $theme_version , true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	//Buzz Ecommerce Ajax Call
	wp_register_script('buzz-ecommerce-ajax-products-tab-js', get_template_directory_uri() . '/assets/js/buzz-ecommerce-ajax.js', array('jquery'), esc_attr( $theme_version), true );
	$localize = array(
		'ajaxurl' => admin_url('admin-ajax.php'),
	);
	wp_localize_script('buzz-ecommerce-ajax-products-tab-js', 'BuzzEcommerce', $localize);
	wp_enqueue_script('buzz-ecommerce-ajax-products-tab-js');

}
add_action( 'wp_enqueue_scripts', 'buzz_ecommerce_scripts' );

/**
 * Buzz Ecommerce Init File
 */
require trailingslashit( get_template_directory() ) . 'spiderbuzz/init.php';



/**==============================================================================
 * Custom Controls 
 *================================================================================*/
require trailingslashit( get_template_directory() ) . 'spiderbuzz/customizer/custom-controls/custom-control.php';
require trailingslashit( get_template_directory() ) . 'spiderbuzz/customizer/customizer.php';

//Woocommerce Activation
function buzz_ecommerce_is_woocommerce_activated() {
	return class_exists( 'woocommerce' ) ? true : false;
}

function sparkle_buzz_ecommerce_theme_support() {
    remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'sparkle_buzz_ecommerce_theme_support' );