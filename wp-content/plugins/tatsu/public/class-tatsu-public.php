<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.brandexponents.com
 * @since      1.0.0
 *
 * @package    Tatsu
 * @subpackage Tatsu/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tatsu
 * @subpackage Tatsu/public
 * @author     Brand Exponents Creatives Pvt Ltd <swami@brandexponents.com>
 */
class Tatsu_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}


	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
		if( !empty( $suffix ) ) {
			wp_enqueue_style( 'tatsu-main-css', plugin_dir_url( __FILE__ ) . 'css/tatsu.min.css', array(), $this->version, 'all' );
		}else{
			wp_enqueue_style( 'tatsu-main-css', plugin_dir_url( __FILE__ ) . 'css/tatsu.css', array(), $this->version, 'all' );
			wp_enqueue_style( 'tatsu-shortcodes', plugin_dir_url( __FILE__ ) . 'css/tatsu-shortcodes.css', array(), $this->version, 'all' );

			wp_register_style( 'tatsu-css-animations', plugin_dir_url( __FILE__ ) . 'css/tatsu-css-animations.css', array(), $this->version, 'all' );
			wp_enqueue_style( 'tatsu-css-animations' );

			wp_register_style( 'magnific-popup', plugin_dir_url( __FILE__ ) . 'css/magnific-popup.css' );
			wp_enqueue_style( 'magnific-popup' );
		}

		Tatsu_Icons::getInstance()->enqueue_styles();

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
		wp_enqueue_script( 'es6-promises-polyfill', plugin_dir_url( __FILE__ ) . 'js/vendor/es6-promise.auto' . $suffix . '.js', array(), false , true );

		wp_enqueue_script( 'asyncloader', plugin_dir_url( __FILE__ ) . 'js/vendor/asyncloader' . $suffix . '.js', array( 'jquery', 'es6-promises-polyfill' ), false , true );

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tatsu' . $suffix . '.js', array( 'jquery' ), $this->version, true );

		$needed_scripts = array();
		foreach( glob( TATSU_PLUGIN_DIR.'public/js/vendor/*'. $suffix .'.js') as $dependency ) {
			$current_index = basename( $dependency, $suffix . '.js' );
			$needed_scripts[ $current_index ] = esc_url( TATSU_PLUGIN_URL.'/public/js/vendor/' . basename( $dependency ) );
		}
		wp_localize_script(
			$this->plugin_name, 
			'tatsuFrontendConfig', 
			array(
				'pluginUrl' => esc_url( TATSU_PLUGIN_URL ), 
				'vendorScriptsUrl' => esc_url( TATSU_PLUGIN_URL.'/public/js/vendor/' ),
				'mapsApiKey' => Tatsu_Config::getInstance()->get_google_maps_api_key(),
				'dependencies' => $needed_scripts
			) 
		);

	}



}