<?php
/**************************************
			Animated Box Style2
**************************************/
if ( ! function_exists( 'be_animate_icons_style2' ) ) {
	function be_animate_icons_style2( $atts, $content ) {
		$output = '';
		$output .= '<div class="oshine-module oshine-am-vh animate-icon-module-style2-wrap clearfix">'.be_themes_formatter( do_shortcode( shortcode_unautop( $content ) ) ).'</div>';
		return $output;
	}
	add_shortcode( 'animate_icons_style2', 'be_animate_icons_style2' );
}

if ( ! function_exists( 'be_animate_icon_style2' ) ) {
	function be_animate_icon_style2( $atts, $content ) {
		extract( shortcode_atts( array (
			'icon' => 'none',
			'size' => 30,
			'icon_color' => '',
			'icon_color_hover_state' => '',
			'title' => '',
			'h_tag' => 'h6',
			'title_color' => '',
			'title_color_hover_state' => '',
			'bg_color' => '',
			'hover_bg_color' => '',
	    ),$atts ) );
	    $h_tag = ( isset( $h_tag ) && !empty( $h_tag ) ) ? $h_tag : 'h6';
	    $icon_color = ( isset( $icon_color ) && !empty( $icon_color ) ) ? $icon_color : 'initial' ;
	    $icon_color_hover_state = ( isset( $icon_color_hover_state ) && !empty( $icon_color_hover_state ) ) ? $icon_color_hover_state : $icon_color ;
	    $title_color = ( isset( $title_color ) && !empty( $title_color ) ) ? $title_color : 'initial' ;
	    $title_color_hover_state = ( isset( $title_color_hover_state ) && !empty( $title_color_hover_state ) ) ? $title_color_hover_state : $title_color ;
	    $title = ( isset( $title ) && !empty( $title ) ) ? '<'.$h_tag.' class="animate-icon-title" style="color: '.$title_color.'; ">'.$title.'</'.$h_tag.'>' : '';
	    $bg_color = ( isset( $bg_color ) && !empty( $bg_color ) ) ? $bg_color : 'transparent' ;
	    $hover_bg_color = ( isset( $hover_bg_color ) && !empty( $hover_bg_color ) ) ? $hover_bg_color : $bg_color ;
	    $output = '';
	    $output .= '<div class="animate-icon-module-style2" data-bg-color="'.$bg_color.'" data-hover-bg-color="'.$hover_bg_color.'" data-title-color="'.$title_color.'" data-hover-title-color="'.$title_color_hover_state.'" data-icon-color="'.$icon_color.'" data-hover-icon-color="'.$icon_color_hover_state.'" style="background-color: '.$bg_color.';">';
	    $output .= '<div class="animate-icon-module-style2-inner-wrap">';
		$output .= '<div class="animate-icon-module-style2-normal-content clearfix"><i class="animate-icon-icon font-icon '.$icon.'" style="font-size: '.$size.'px;color: '.$icon_color.';"></i>'.$title.'</div>';
		$output .= '<div class="animate-icon-module-style2-hover-content clearfix">'.be_themes_formatter( do_shortcode( shortcode_unautop( $content ) ) ).'</div>';
		$output .= '</div></div>';
		return $output;
	}
	add_shortcode( 'animate_icon_style2', 'be_animate_icon_style2' );
}
?>