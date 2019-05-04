<?php
/**************************************
			COUNTDOWN
**************************************/
if (!function_exists('be_countdown')) {
	function be_countdown( $atts, $content ) {
			extract( shortcode_atts( array (
				'date_time' => '',
				'text_color' =>'',
		        'animate' => 0,
				'animation_type'=>'fadeIn',
	    	), $atts ));
	    	$animate = ( isset( $animate ) && 1 == $animate ) ? 'be-animate' : 0 ;
	    	$style = ( !empty( $text_color ) ) ? 'style="color:'.$text_color.';"' : '';
			$output = '';
	    	$output .= '<div class="be-countdown-wrap oshine-module '.$animate.' clearfix" '.$style.' data-animation="'.$animation_type.'">';
	    	$output .= '<div class="be-countdown clearfix" data-time="'.$date_time.'"></div>';
	        $output .= '</div>';
	        return $output;
	}
	add_shortcode( 'be_countdown', 'be_countdown' );
}
?>