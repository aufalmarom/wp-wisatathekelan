<?php 

if (!function_exists('tatsu_text')) {
	function tatsu_text( $atts, $content ) {
		extract( shortcode_atts( array (
			'max_width' => 100,
			'wrap_alignment' => 'center',
	        'scroll_to_animate' => 0,
	        'animate' => 0,
	        'animation_type' => 'fadeIn',
			'animation_delay' => 0,
	    ),$atts ) );

	    $output = '';
	    $bool = false;
		if( isset( $animate ) && 1 == $animate ) {
			$animate = 'tatsu-animate';
			$bool = true;
		} else {
			$animate = '';
		}
		if( isset( $scroll_to_animate ) && 1 == $scroll_to_animate ) {
	    	$scroll_to_animate = 'scrollToFade';
	    	$bool = true;
	    } else {
			$scroll_to_animate = '';
		}
		
		if($max_width < 100){
			if($wrap_alignment == 'left'){
				$margin = 'margin-right: 0; margin-left:0;';
			}
			if($wrap_alignment == 'center'){
				$margin = 'margin-right:auto; margin-left:auto;';
			}
			if($wrap_alignment == 'right'){
				$margin = 'margin-right: 0;margin-left:auto;';
			}
		}
		else{
			$margin = ''; 
		}

		$output .= '<div class="tatsu-module tatsu-text-inner '.$animate.' '.$scroll_to_animate.' clearfix" style="width: '.$max_width.'%; '.$margin.'" data-animation="'.$animation_type.'" data-animation-delay="'.$animation_delay.'">';
		$output .= do_shortcode(  $content );
		$output .= '</div>';
	    return $output;
	}
	add_shortcode( 'tatsu_text', 'tatsu_text' );
	add_shortcode( 'text', 'tatsu_text' );
}

?>