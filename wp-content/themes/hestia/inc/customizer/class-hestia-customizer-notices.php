<?php
/**
 * The customizer notices manager.
 *
 * @package Hestia
 */

/**
 * Class Hestia_Customizer_Notices
 */
class Hestia_Customizer_Notices extends Hestia_Register_Customizer_Controls {

	/**
	 * Initialize.
	 */
	public function init() {
		parent::init();
		$this->loader->add_action( 'wp_ajax_dismissed_notice_handler', $this, 'ajax_notice_handler' );
		$this->loader->add_action( 'wp_ajax_nopriv_dismissed_notice_handler', $this, 'ajax_notice_handler' );
		$this->loader->add_action( 'customize_controls_enqueue_scripts', $this, 'enqueue_notices_handler', 0 );
	}

	/**
	 * AJAX handler to store the state of dismissible notices.
	 */
	final public function ajax_notice_handler() {
		$control_id = sanitize_text_field( wp_unslash( $_POST['control'] ) );
		if ( empty( $control_id ) ) {
			die();
		}
		update_option( 'dismissed-' . $control_id, true );
		die();
	}

	/**
	 * Enqueue the controls script.
	 */
	public function enqueue_notices_handler() {
		wp_register_script( 'hestia-customizer-notices-handler', trailingslashit( get_template_directory_uri() ) . 'assets/js/admin/customizer-notices-handler.js', array( 'customize-controls' ), HESTIA_VERSION );
		wp_localize_script(
			'hestia-customizer-notices-handler', 'dismissNotices', array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'cacat'   => 'gigel',
			)
		);

		wp_enqueue_script( 'hestia-customizer-notices-handler' );
	}

	/**
	 * Add customizer controls.
	 */
	public function add_controls() {
		$this->register_types();
		$this->add_docs_link_section();
		$this->maybe_add_woo_notice();
		$this->maybe_add_main_notice();
	}

	/**
	 * Register customizer controls type.
	 */
	private function register_types() {
		$this->register_type( 'Hestia_Section_Docs', 'section' );
		$this->register_type( 'Hestia_Generic_Notice_Section', 'section' );
		$this->register_type( 'Hestia_Main_Notice_Section', 'section' );
	}

	/**
	 * Add docs link section.
	 */
	private function add_docs_link_section() {
		$this->add_section(
			new Hestia_Customizer_Section(
				'hestia_docs_section',
				array(
					'theme_info_title' => esc_html__( 'Hestia', 'hestia' ),
					'label_url'        => esc_url( 'http://docs.themeisle.com/article/569-hestia-documentation' ),
					'label_text'       => esc_html__( 'Documentation', 'hestia' ),
				),
				'Hestia_Section_Docs'
			)
		);
		$this->add_control(
			new Hestia_Customizer_Control(
				'hestia_control_to_enable_docs_section',
				array(
					'sanitize_callback' => 'sanitize_text_field',
				),
				array(
					'section' => 'hestia_docs_section',
					'type'    => 'hidden',
				)
			)
		);
	}

	/**
	 * Maybe add WooCommerce notice.
	 */
	private function maybe_add_woo_notice() {
		if ( class_exists( 'WooCommerce' ) ) {
			return;
		}
		$this->add_section(
			new Hestia_Customizer_Section(
				'hestia_info_woocommerce',
				array(
					'section_text' =>
						sprintf(
							/* translators: %1$s is Plugin Name */
							esc_html__( 'To have access to a shop section please install and configure %1$s.', 'hestia' ),
							esc_html__( 'WooCommerce plugin', 'hestia' )
						),
					'slug'         => 'woocommerce',
					'panel'        => 'hestia_frontpage_sections',
					'priority'     => 451,
					'capability'   => 'install_plugins',
					'hide_notice'  => (bool) get_option( 'dismissed-hestia_info_woocommerce', false ),
				),
				'Hestia_Generic_Notice_Section'
			)
		);
		$this->add_control(
			new Hestia_Customizer_Control(
				'hestia_control_to_enable_woo_recommendation',
				array(
					'sanitize_callback' => 'sanitize_text_field',
				),
				array(
					'section' => 'hestia_info_woocommerce',
					'type'    => 'hidden',
				)
			)
		);
	}

	/**
	 * Check for OBFX and add main notice if needed.
	 */
	private function maybe_add_main_notice() {
		if ( class_exists( 'Orbit_Fox' ) ) {
			return;
		}

		$this->add_section(
			new Hestia_Customizer_Section(
				'hestia_info_obfx',
				array(
					'slug'        => 'themeisle-companion',
					'priority'    => 0,
					'capability'  => 'install_plugins',
					'hide_notice' => (bool) get_option( 'dismissed-hestia_info_obfx', false ),
					'title'       => __( 'Recommended Plugins', 'hestia' ),
					/* translators: Orbit Fox Companion */
					'description' => sprintf( esc_html__( 'If you want to take full advantage of the options this theme has to offer, please install and activate %s.', 'hestia' ), sprintf( '<strong>%s</strong>', 'Orbit Fox Companion' ) ),
				),
				'Hestia_Main_Notice_Section'
			)
		);

		$this->add_control(
			new Hestia_Customizer_Control(
				'hestia_control_to_enable_obfx_recommendation',
				array(
					'sanitize_callback' => 'sanitize_text_field',
				),
				array(
					'section' => 'hestia_info_obfx',
					'type'    => 'hidden',
				)
			)
		);
	}

}
