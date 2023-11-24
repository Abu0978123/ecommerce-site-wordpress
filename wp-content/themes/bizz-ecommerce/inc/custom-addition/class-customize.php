<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class bizz_ecommerce_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		require_once( trailingslashit( get_template_directory() ) . '/inc/custom-addition/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'bizz_ecommerce_Customize_Section_Pro' );

		// doc sections.
		$manager->add_section(
			new bizz_ecommerce_Customize_Section_Pro(
				$manager,
				'bizz-ecommerce',
				array(
					'title'    => esc_html__( 'Theme Doc', 'bizz-ecommerce' ),
					'pro_text' => esc_html__( 'Click Here', 'bizz-ecommerce' ),
					'pro_url'  => 'themes.php?page=texture_started',
					'priority'  => 0
				)
			)
		);
		
		$manager->add_section(
			new bizz_ecommerce_Customize_Section_Pro(
				$manager,
				'bizz-ecommerce-demo',
				array(
					'title'    => esc_html__( 'Theme Demo', 'bizz-ecommerce' ),
					'pro_text' => esc_html__( 'Theme Demo', 'bizz-ecommerce' ),
					'pro_url'  => 'https://testerwp.com/wp/bizz-ecommerce/',
					'priority'  => 1
				)
			)
		);
		
					// upgrade sections.
		$manager->add_section(
			new bizz_ecommerce_Customize_Section_Pro(
				$manager,
				'upgrade-pros',
				array(
					'title'    => esc_html__( 'Check Pro', 'bizz-ecommerce'),
					'pro_text' => esc_html__( 'Click Here', 'bizz-ecommerce' ),
					'pro_url'  => 'https://testerwp.com/lp/bizz-ecommerce-pro-preview/',
					'priority'  => 2
				)
			)
		);
	}
	public function enqueue_control_scripts() {
		wp_enqueue_script( 'bizblack-customize-controls', trailingslashit( get_template_directory_uri() ) . '/inc/custom-addition/customize-controls.js', array( 'customize-controls' ) );
		wp_enqueue_style( 'bizblack-customize-controls', trailingslashit( get_template_directory_uri() ) . '/inc/custom-addition/customize-controls.css' );
	}
}
bizz_ecommerce_Customize::get_instance();