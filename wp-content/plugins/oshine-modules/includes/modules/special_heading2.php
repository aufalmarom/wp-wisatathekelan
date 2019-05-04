<?php

/**************************************
			SPECIAL TITLE 2
**************************************/
if (!function_exists('be_special_heading2')) {
	function be_special_heading2( $atts, $content ) {
		extract( shortcode_atts( array(
			'title_content' => '',
			'h_tag' => 'h3',
			'title_color' => '',
	        'border_color' => '',
	        'border_thickness' => '2',
	        'title_padding_vertical' => '20px',
	        'title_padding_horizontal' => '20px',
	        'padding_value' => 'px',
	        'title_alignment' => 'center',
			'scroll_to_animate'=> 0,
			'animate'=> 0,
	        'animation_type'=> 'fadeIn',
	    ),$atts ) );
	    $output ='';
	    $animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : '' ;
		$output .='<div class="special-heading-wrap style2 oshine-module align-'.$title_alignment.' '.$animate.'" data-animation="'.$animation_type.'"><div class="special-heading" style="border-width:'.$border_thickness.'px; border-color: '.$border_color.'; padding: '.$title_padding_vertical . $padding_value .' '. $title_padding_horizontal . $padding_value .' ;">';
		$output .= ($title_content) ? '<'.$h_tag.' class="special-h-tag" style="color: '.$title_color.';" >'.$title_content.'</'.$h_tag.'>' : '' ;
		$output .='</div></div>';
		return $output;
	}
	add_shortcode( 'special_heading2', 'be_special_heading2' );
}
?>