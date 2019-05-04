<?php
/**************************************
			SPECIAL TITLE 5
**************************************/
if (!function_exists('be_special_heading5')) {
	function be_special_heading5( $atts, $content ) {
		extract( shortcode_atts( array(
	        'title_content' => '',
			'h_tag' => 'h3',
	        'title_color' => '',
	        'title_opacity' => '20',
	        'caption_content' => '',
	        'caption_font' => '',
	        'caption_color' => '',
	        'title_alignment' => 'center',
			'scroll_to_animate'=> 0,
			'animate'=>0,
	        'animation_type'=>'fadeIn',
	    ),$atts ) );
		$output ='';
		$animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : '' ; 
		$caption_color = ( ! empty( $caption_color ) ) ? 'color:'.$caption_color.';' : '' ;
		
		$caption_tag = 'div';
		if ('body' == $caption_font){
			$caption_font_style = 'body-font';
		} elseif ('special' == $caption_font){
			$caption_font_style = 'special-subtitle';
		} else {
			$caption_font_style = '';
			$caption_tag = $caption_font;
		}

		$output .='<div class="special-heading-wrap style5 oshine-module '.$animate.' align-'.$title_alignment.'" data-animation="'.$animation_type.'">';		
		$output .='<div class="special-heading "><'.$h_tag.' class="special-h-tag" style="color: '.$title_color.'; opacity: '.($title_opacity/100).';  ">'.$title_content.'</'.$h_tag.'></div>';
		$output .= ($caption_content) ? '<div class="caption-wrap"><'.$caption_tag.' style="'.$caption_color.'" class="caption '. $caption_font_style .'">'.$caption_content.'</'.$caption_tag.'></div>' : '' ;
		$output .='</div>';
		return $output;
	}
	add_shortcode( 'special_heading5', 'be_special_heading5' );
}
?>