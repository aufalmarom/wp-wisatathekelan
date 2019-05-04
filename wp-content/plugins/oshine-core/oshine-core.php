<?php
/**
 * Plugin Name: Oshine Core
 * Description: The plugin handles the demo import functionality to make it easy to get started with the theme. 
 * Plugin URI: http://brandexponents.com
 * Author: brandexponents team
 * Author URI: http://brandexponents.com
 * Version: 1.3
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: be-functions
 */
defined( 'ABSPATH' ) or exit;

define( 'BE_URL', plugins_url('', __FILE__) );
define( 'BE_PATH', dirname(__FILE__) );

require_once BE_PATH . '/inc/importer/importer/BEImporter.php'; 
require_once BE_PATH . '/inc/importer/init.php';
require_once BE_PATH . '/inc/BECore.php';

/*
 *
 */
function be_init() {
    global $BECore;
    $BECore               = new BECore();
    $BECore['path']       = realpath( plugin_dir_path( __FILE__ ) ). DIRECTORY_SEPARATOR;
    $BECore['url']        = plugin_dir_url( __FILE__ );
    $BECore['version']    = '1.0';
    $BECore['BEThemeDemoImporter'] = new BEThemeDemoImporter();
    apply_filters( 'be/config', $BECore );
    $BECore->run();
}
add_action( 'init', 'be_init', 10, 1 );

//add_action( 'typehub_activation', 'gen_typehub_import_files' );
function gen_typehub_import_files() {
    $demo_files_path = BE_PATH.'/inc/importer/demo-files';
    foreach( glob( $demo_files_path.'/*' ) as $demo_folder ) {
        $redux_options_file = $demo_folder.'/theme_options.json';
        if( file_exists( $redux_options_file ) ) {
            $redux_data = json_decode( file_get_contents( $redux_options_file ), true );
            $typehub_data = parse_to_typehub( $redux_data );
            file_put_contents( $demo_folder.'/typehub.json', json_encode( $typehub_data ) );
        }  
    }
}

function parse_to_typehub( $redux_data ) {
	$parsed_to_typehub = get_option( 'oshine_redux_to_typehub' );
//	if( empty( $parsed_to_typehub ) ) {
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

		$standard_fonts = array(
			"Arial"                     => "Arial, Helvetica, sans-serif",
			"Helvetica"                 => "Helvetica, sans-serif",    
			"Arial Black"               => "Arial Black, Gadget, sans-serif",
			"Bookman Old Style"         => "Bookman Old Style, serif",
			"Comic Sans MS"             => "Comic Sans MS, cursive",
			"Courier"                   => "Courier, monospace",
			"Garamond"                  => "Garamond, serif",
			"Georgia"                   => "Georgia, serif",
			"Impact"                    => "Impact, Charcoal, sans-serif",
			"Lucida Console"           => "Lucida Console, Monaco, monospace",
			"Lucida Sans Unicode"       => "Lucida Sans Unicode, Lucida Grande, sans-serif",
			"MS Sans Serif"             => "MS Sans Serif, Geneva, sans-serif",
			"MS Serif"                  => "MS Serif, New York, sans-serif",
			"Palatino Linotype"         => "Palatino Linotype, Book Antiqua, Palatino, serif",
			"Tahoma,Geneva"             => "Tahoma,Geneva, sans-serif",
			"Times New Roman"           => "Times New Roman, Times,serif",
			"Trebuchet MS"              => "Trebuchet MS, Helvetica, sans-serif",
			"Verdana"                   => "Verdana, Geneva, sans-serif",
			"System Font Stack"         => "-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen-Sans,Ubuntu,Cantarell,'Helvetica Neue',sans-serif",
		);

		$google_fonts = include get_template_directory().'/ReduxFramework/ReduxCore/inc/fields/typography/googlefonts.php';

		$be_themes_data = $redux_data;
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
							$value = 'custom:'.$value;
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
            'meta' => 'typehub-data',
			'savedValues' => $typehub_saved_values
		);

        return $typehub_data;
//	}

}

function be_stat_display() {
    require_once BE_PATH . '/inc/system-status.php';
    return BE_system_status_tpl();
}
add_action( 'be_systatus_tpl', 'be_stat_display', 10, 1 );

require BE_PATH. '/plugin-update-checker/plugin-update-checker.php';
$oshine_modules_update_checker = new PluginUpdateChecker_3_1 (
    'http://brandexponents.com/oshin-plugins/oshine-core.json',
    __FILE__,
    'oshine-core'
);