<?php
/*
 * Plugin Name: PT Theme Addon
 * Version: 1.0.4
 * Plugin URI: http://wordpress.org/plugins/pt-theme-addon/
 * Description: Plugin to add team, testimonial portfolio and clients custom post type. Each post type has its widget and shortcode to use in theme. This addon is best to enhance features of themes as it is easy to use and highly secure.
 * Author: Promenade Themes
 * Author URI: https://promenadethemes.com/
 * License: GNU/GPL http://www.gnu.org/copyleft/gpl.html
 * Text Domain: pt-theme-addon
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PTTA_DIR', rtrim( plugin_dir_path( __FILE__ ), '/' ) );
define( 'PTTA_URL', rtrim( plugin_dir_url( __FILE__ ), '/' ) );

/**
 * Set up and initialize
 */
class PT_Theme_Addon_Init {

	private static $instance;

	/**
	 * Actions setup
	 */
	public function __construct() {

		add_action( 'plugins_loaded', array( $this, 'pt_theme_addon_post_types' ), 3 );

		add_action( 'wp_enqueue_scripts', array( $this, 'pt_theme_addon_load_frontend_scripts' ), 4 );

		add_action( 'admin_print_styles-post-new.php', array( $this, 'pt_theme_addon_portfolio_admin_style' ), 11 );

		add_action( 'admin_print_styles-post.php', array( $this, 'pt_theme_addon_portfolio_admin_style' ), 11 );

	}

	/**
	 * Include required post types
	 */
	function pt_theme_addon_post_types() {
		
		//For custom post type team
		require_once( PTTA_DIR . '/team/team.php' );

		//For widget team
		require_once( PTTA_DIR . '/team/team-widget.php' );

		//For custom post type testimonials
		require_once( PTTA_DIR . '/testimonials/testimonials.php' );

		//For widget testimonials
		require_once( PTTA_DIR . '/testimonials/testimonials-widget.php' );

		//For custom post type portfolio
		require_once( PTTA_DIR . '/portfolio/portfolio.php' );

		//For widget portfolio
		require_once( PTTA_DIR . '/portfolio/portfolio-widget.php' );

		//For custom post type clients
		require_once( PTTA_DIR . '/clients/clients.php' );

		//For widget clients
		require_once( PTTA_DIR . '/clients/clients-widget.php' );

	}

    function pt_theme_addon_load_frontend_scripts() {

    	wp_enqueue_style( 'font-awesome', PTTA_URL . '/assets/font-awesome/css/font-awesome.min.css', '', '4.7.0' );

    	wp_enqueue_style( 'pt-theme-addon-style', PTTA_URL . '/assets/pt-style.css' );
        
        wp_enqueue_script( 'jquery-mixitup', PTTA_URL . '/assets/jquery.mixitup.min.js', array( 'jquery' ), '1.5.5' );
        
        wp_enqueue_script( 'pt-theme-addon-filter', PTTA_URL . '/assets/filter.js', array( 'jquery-mixitup' ), '1.0.0' );

    }

    function pt_theme_addon_portfolio_admin_style() {

        global $post_type;

        if( 'pt-portfolio' == $post_type || 'pt-team' == $post_type || 'pt-testimonials' == $post_type ){

        	wp_enqueue_style( 'pt-theme-addon-admin-style', PTTA_URL . '/assets/pt-admin-style.css' );

        }

    }

	/**
	 * Returns the instance.
	 */
	public static function get_instance() {

		if ( !self::$instance )
			self::$instance = new self;

		return self::$instance;
	}
}

function pt_theme_addon_main() {

		return PT_Theme_Addon_Init::get_instance();
}

add_action( 'plugins_loaded', 'pt_theme_addon_main', 1 );