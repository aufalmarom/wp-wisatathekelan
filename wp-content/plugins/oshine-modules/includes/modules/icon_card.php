<?php

/**************************************
			ICON CARD
**************************************/
if ( ! function_exists( 'be_icon_card' ) ) {
	function be_icon_card($atts,$content) {
		global $be_themes_data;
		extract(shortcode_atts(array(
			'icon'=>'none',
			'size' => 'small',	
			'style'=>'circled',
			'icon_bg'=> '',
			'icon_color'=> '',
			'icon_border_color'=> '',
			'title' => '',
			'title_font' => '',
			'title_color' => '',
			'caption' => '',
			'caption_font' => '',
			'caption_color' => '',
			'animate'=> 0,
			'animation_type'=>'fadeIn',
		),$atts));
		$output = '';
		$background_color = ( $style == 'circled' ) ? 'background-color:'.$icon_bg.';' : '' ;
		$icon_border_color = ( $style == 'circled' && isset($icon_border_color) && !empty($icon_border_color) ) ? 'border: 1px solid '.$icon_border_color : '';		
		$animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : '' ;

		$caption_tag = 'div';
		if ('body' == $caption_font){
			$caption_font_style = 'body-font';
		} elseif ('special' == $caption_font){
			$caption_font_style = 'special-subtitle';
		} else {
			$caption_font_style = '';
			$caption_tag = $caption_font;
		}
		$output .= '<div class="be_icon_card_wrap oshine-module '.$size.' '.$style.' '.$animate.'" data-animation="'.$animation_type.'">';
		$output .= '<i class="font-icon '.$icon.'  " style="'.$background_color.'color:'.$icon_color.'; '.$icon_border_color.';"></i>';
		$output .= '<div class="title-with-icon-card" >';
		$output .= !empty($title) ? '<'.$title_font.' style="color: '.$title_color.'">'.$title.'</'.$title_font.'>' : '';
		$output .= !empty($caption) ? '<'.$caption_tag.' class="'.$caption_font_style.'" style="color: '.$caption_color.'">'.$caption.'</'.$caption_tag.'>' : '';
		$output .= '</div>';    		
		$output .= '</div>';

		return $output; 
	}
	add_shortcode('icon_card','be_icon_card');
}
?>