<?php
/**************************************
			SKILlS
**************************************/
if ( ! function_exists( 'be_skills' ) ) {
	function be_skills( $atts, $content ) {
		extract( shortcode_atts( array( 
			'direction' => 'horizontal',
			'height' => 400
		),$atts ) );
		global $container_style;
		global $direction_global;
		$direction = ( isset($direction) && !empty($direction) ) ? $direction : 'horizontal' ;
		$direction_global = $direction;
		$height = ( isset($height) && !empty($height) ) ? $height : 400 ;
		$container_style = ($direction == 'vertical') ? 'height: '.$height.'px;' : '';
		return '<div class="skill_container oshine-module skill-'.$direction.'" '.$container_style.'><div class="skill clearfix">'.do_shortcode( $content ).'</div></div>';
	}
	add_shortcode( 'skills', 'be_skills' );
}

if ( ! function_exists( 'be_skill' ) ) {
	function be_skill( $atts, $content ) {
		global $be_themes_data;
		extract( shortcode_atts( array( 
			'title' => '',
			'value' => '',
			'fill_color' => $be_themes_data['color_scheme'],
			'bg_color' => '',
			'title_color' => '',
		),$atts ) );
		global $container_style;
		global $direction_global;
		$title_color = ( $title_color ) ? 'style="color: '.$title_color.'"' : '' ;
		$output = '<div class="skill-wrap">';
		if('horizontal' == $direction_global){
			$output .= '<span class="skill_name" '.$title_color.'>'.$title.'</span>';
			$output .= '<div class="skill-bar" style="background:'.$bg_color.'; '.$container_style.'"><span class="be-skill expand alt-bg alt-bg-text-color" data-skill-value="'.$value.'%" style="background:'.$fill_color.';"></span></div>';
		}
		if('vertical' == $direction_global){
			$output .= '<div class="skill-bar" style="background:'.$bg_color.'; '.$container_style.'"><span class="be-skill expand alt-bg alt-bg-text-color" data-skill-value="'.$value.'%" style="background:'.$fill_color.';"></span></div>';
			$output .= '<span class="skill_name" '.$title_color.'>'.$title.'</span>';
		}
		$output .= '</div>';
		return $output;
	}
	add_shortcode( 'skill', 'be_skill' );
}
?>