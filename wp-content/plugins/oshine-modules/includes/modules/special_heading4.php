<?php
/**************************************
			SPECIAL TITLE 4
**************************************/
if (!function_exists('be_special_heading4')) {
	function be_special_heading4( $atts, $content ) {
		extract( shortcode_atts( array(
	        'title_content' => '',
			'h_tag' => 'h3',
	        'title_color' => '',
	        'caption_content' => '',
	        'caption_font' => '',
	        'caption_color' => '',
	        'divider_style' => 'both',
	        'divider_color' => '',
			'scroll_to_animate'=> 0,
			'animate'=>0,
	        'animation_type'=>'fadeIn',
	    ),$atts ) );
		$output ='';
		$animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : '' ;
		$caption_color = ( ! empty( $caption_color ) ) ? 'color:'.$caption_color.';' : '' ;
		$divider_color = ( ! empty( $divider_color ) ) ? 'background-color:'.$divider_color.';' : '' ;
		$divider_style = ( ! empty( $divider_style ) ) ? $divider_style : 'both' ;
		$caption_tag = 'div';
		
		if ('body' == $caption_font){
			$caption_font_style = 'body-font';
		} elseif ('special' == $caption_font){
			$caption_font_style = 'special-subtitle';
		} else {
			$caption_font_style = '';
			$caption_tag = $caption_font;
		}

		$output .='<div class="special-heading-wrap style4 oshine-module '.$animate.'" data-animation="'.$animation_type.'">';
		$output .= ($divider_style == 'bottom') ? '' : '<div class="vertical-divider top" style="'.$divider_color.'"></div>' ;
		// $output .= ($caption_content) ? '<div class="caption-wrap"><'.$caption_tag.' style="'.$caption_color.'" class="caption '. $caption_font_style .'">'.$caption_content.'</'.$caption_tag.'></div>' : '' ;
		$output .= ($caption_content) ? '<'.$caption_tag.' style="'.$caption_color.'" class="caption '. $caption_font_style .'">'.$caption_content.'</'.$caption_tag.'>' : '' ;
		$output .='<div class="special-heading "><'.$h_tag.' class="special-h-tag" style="color: '.$title_color.'">'.$title_content.'</'.$h_tag.'></div>';
		$output .= ($divider_style == 'top') ? '' : '<div class="vertical-divider bottom" style="'.$divider_color.'"></div>' ;
		$output .='</div>';
		return $output;
	}
	add_shortcode( 'special_heading4', 'be_special_heading4' );
}
?>