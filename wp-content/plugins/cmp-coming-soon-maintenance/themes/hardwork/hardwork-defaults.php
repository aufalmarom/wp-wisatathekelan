<?php 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if (isset($_POST['niteoCS_font_color_'.$themeslug])) {
	update_option('niteoCS_font_color['.$themeslug.']', sanitize_hex_color($_POST['niteoCS_font_color_'.$themeslug]));
}


if (isset($_POST['niteoCS_overlay_color_'.$themeslug])) {
	update_option('niteoCS_overlay_color['.$themeslug.']', sanitize_hex_color($_POST['niteoCS_overlay_color_'.$themeslug]));
}

if (isset($_POST['niteoCS_overlay_opacity_'.$themeslug])) {
	update_option('niteoCS_overlay_opacity['.$themeslug.']', sanitize_text_field($_POST['niteoCS_overlay_opacity_'.$themeslug]));
}



$theme_supports = array(
	'logo' 				=> true,
	'slider' 			=> false,
	'counter' 			=> false,
	'subscribe' 		=> false,
	'social' 			=> true,
	'footer' 			=> false,
	'special_effects'	=> false,
);

$banner_type			= get_option('niteoCS_banner['.$themeslug.']', '4');

$banner_color			= get_option('niteoCS_banner_color['.$themeslug.']', '#e5e5e5');
$font_color				= get_option('niteoCS_font_color['.$themeslug.']', '#494949');
$overlay_color 			= get_option('niteoCS_overlay_color['.$themeslug.']', '#0a0a0a');
$overlay_opacity 		= get_option('niteoCS_overlay_opacity['.$themeslug.']', '0');


$heading_font = array(
    'family'        => get_option('niteoCS_font_headings['.$themeslug.']', 'Playfair Display'),
    'variant'       => get_option('niteoCS_font_headings_variant['.$themeslug.']', '700'),
    'size'          => get_option('niteoCS_font_headings_size['.$themeslug.']', '40'),
    'spacing'       => get_option('niteoCS_font_headings_spacing['.$themeslug.']', '0'),
);

$content_font = array(
    'family'        => get_option('niteoCS_font_content['.$themeslug.']', 'Montserrat'),
    'variant'       => get_option('niteoCS_font_content_variant['.$themeslug.']', 'regular'),
    'size'          => get_option('niteoCS_font_content_size['.$themeslug.']', '17'),
    'spacing'       => get_option('niteoCS_font_content_spacing['.$themeslug.']', '0'),
    'line-height'   => get_option('niteoCS_font_content_lineheight['.$themeslug.']', '1.5'),
);

$heading_font['variant'] = ($heading_font['variant'] =='regular')  ? '400' : $heading_font['variant'];
$heading_font['variant'] = ($heading_font['variant'] =='italic')   ? '400' : $heading_font['variant'];
$content_font['variant'] = ($content_font['variant'] =='regular') ? '400' : $content_font['variant'];
$content_font['variant'] = ($content_font['variant'] =='italic')  ? '400' : $content_font['variant'];
$heading_font_style =  preg_split('/(?<=[0-9])(?=[a-z]+)/i', $heading_font['variant']); 
$content_font_style =  preg_split('/(?<=[0-9])(?=[a-z]+)/i', $content_font['variant']);