<?php
if (!function_exists('tatsu_animated_numbers')) {
	function tatsu_animated_numbers( $atts, $content ) {
		extract( shortcode_atts( array(
			'number' => '',
			'caption' => '',
	        'number_size' => '45',
	        'number_color' => '#141414',
	        'caption_size' => '13',
	        'caption_color' => '#141414',
	        'alignment' => 'center'
	    ), $atts ) );
		$output = '';
		$output = '<div class="tatsu-module tatsu-an-wrap align-'.$alignment.'">';
		$output .= '<div class="tatsu-an animate" data-number="'.$number.'" style="color:'.$number_color.';font-size:'.$number_size.'px;line-height:1.3"></div>';
		$output .= '<h6><span class="tatsu-an-caption" style="color:'.$caption_color.';font-size:'.$caption_size.'px;">'.$caption.'</span></h6>';
		$output .= '</div>';
		return $output;
	}
	add_shortcode( 'tatsu_animated_numbers', 'tatsu_animated_numbers' );
	add_shortcode( 'animated_numbers', 'tatsu_animated_numbers' );
}

?>