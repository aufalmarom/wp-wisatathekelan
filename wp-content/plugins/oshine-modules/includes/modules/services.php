<?php
/**************************************
			SERVICES
**************************************/
if ( ! function_exists( 'be_services' ) ) {
	function be_services( $atts, $content ) {
		extract( shortcode_atts( array (
			'line_color' => '',
	    ),$atts ) );
		return '<div class="services-outer-wrap oshine-module"><ul class="be-services">'.do_shortcode( $content ).'</ul><span class="timeline" style="background: '.$line_color.'"></span></div>';
	}
	add_shortcode( 'services', 'be_services' );
}

if ( ! function_exists( 'be_service' ) ) {
	function be_service( $atts, $content ) {
		extract( shortcode_atts( array (
			'icon' => '',
			'icon_size' => 'small',
			'icon_bg_color' => '',
			'icon_hover_bg_color' => '',
			'icon_color' => '',
			'icon_hover_color' => '',
			'content_bg_color' => ''
	    ),$atts ) );
	    $icon_bg_color = (empty($icon_bg_color)) ? '#000' : $icon_bg_color ; 
		$icon_hover_bg_color = (empty($icon_hover_bg_color)) ? $icon_bg_color : $icon_hover_bg_color ; 
		$icon_color = (empty($icon_color)) ? '#fff' : $icon_color ; 
		$icon_hover_color = (empty($icon_hover_color)) ? $icon_color : $icon_hover_color ; 
		
		return '<li class="be-service"><div class="service-wrap" data-bg-color="'.$icon_bg_color.'" data-hover-bg-color="'.$icon_hover_bg_color.'" data-color="'.$icon_color.'" data-hover-color="'.$icon_hover_color.'"><i class="font-icon '.$icon.' icon-size-'.$icon_size.'" style="background: '.$icon_bg_color.';color: '.$icon_color.';"></i><div class="service-content" style="background-color:'.$content_bg_color.';">'.be_themes_formatter( do_shortcode( shortcode_unautop( $content ) ) ).'</div></div></li>';
	}
	add_shortcode( 'service', 'be_service' );
}

?>