<?php
/**************************************
			SPECIAL TITLE 3
**************************************/
if (!function_exists('be_special_heading3')) {
	function be_special_heading3( $atts, $content ) {
		extract( shortcode_atts( array(
	        'title_content' => '',
			'h_tag' => 'h3',
	        'title_color' => '',
	        'sub_title1' => '',
	        'sub_title2' => '',
	        'top_caption_color' => '',
	        'bottom_caption_color' => '',
	        'top_caption_size' => '14',
	        'bottom_caption_size' => '14',
	        'top_caption_font' => 'h6',
	        'bottom_caption_font' => 'h6',
	        'top_caption_separator_color' => '',
	        'bottom_caption_separator_color' => '',
			'scroll_to_animate'=> 0,
			'animate'=>0,
	        'animation_type'=>'fadeIn',
	    ),$atts ) );
		$output ='';
		$animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : '' ;
		$top_caption_separator_color = ( ! empty( $top_caption_separator_color ) ) ? 'style="background-color:'.$top_caption_separator_color.';"' : '' ; 
		$bottom_caption_separator_color = ( ! empty($bottom_caption_separator_color) ) ? 'style="background-color:'.$bottom_caption_separator_color.';"' : '' ; 
		$top_caption_color = ( ! empty( $top_caption_color ) ) ? 'color:'.$top_caption_color.';' : '' ;
		$bottom_caption_color = ( ! empty( $bottom_caption_color ) ) ? 'color:'.$bottom_caption_color.';' : '' ;
		if ('body' == $top_caption_font){
			$top_caption_font_style = 'body-font';
		} elseif ('special' == $top_caption_font){
			$top_caption_font_style = 'special-subtitle';
		} else {
			$top_caption_font_style = '';
		}
		if ('body' == $bottom_caption_font) {
			$bottom_caption_font_style = 'body-font';
		} elseif ('special' == $bottom_caption_font){
			$bottom_caption_font_style = 'special-subtitle';
		} else {
			$bottom_caption_font_style = '';
		}

		$output .='<div class="special-heading-wrap style3 oshine-module '.$animate.'" data-animation="'.$animation_type.'">';
		$output .= ($sub_title1) ? '<div class="caption-wrap"><h6 style="'.$top_caption_color.' font-size: '.$top_caption_size.'px;" class="caption '. $top_caption_font_style .'">'.$sub_title1.'<span class="caption-inner" '.$top_caption_separator_color.'></span></h6></div>' : '' ;
		$output .='<div class="special-heading align-center"><'.$h_tag.' class="special-h-tag" style="color: '.$title_color.'">'.$title_content.'</'.$h_tag.'></div>';
		$output .= ($sub_title2) ? '<div class="caption-wrap"><h6 style="'.$bottom_caption_color.' font-size: '.$bottom_caption_size.'px;" class="caption '. $bottom_caption_font_style .'">'.$sub_title2.'<span class="caption-inner" '.$bottom_caption_separator_color.'></span></h6></div>' : '' ;
		$output .='</div>';
		return $output;
	}
	add_shortcode( 'special_heading3', 'be_special_heading3' );
}
?>