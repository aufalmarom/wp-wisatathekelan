<?php
/**************************************
			Animated Box Style1
**************************************/
if ( ! function_exists( 'be_animate_icons_style1' ) ) {
	function be_animate_icons_style1( $atts, $content ) {
		extract( shortcode_atts( array (
			'height' => '300',
			'gutter' => '',
	    ),$atts ) );
	    $height = ( isset( $height ) && !empty( $height ) ) ? $height : 300 ;
	    $GLOBALS['be_animate_icon_style1_gutter']  = $gutter = ( isset( $gutter ) && !empty( $gutter ) && $gutter != '0' ) ? $gutter : '0' ;
		$output = '';
		$output .= '<div class="oshine-module oshine-am-fh display-block"><div class="animate-icon-module-style1-wrap-container"><div class="animate-icon-module-style1-wrap clearfix" style="height: '.$height.'px;" data-gutter-width="'.$gutter.'">'.do_shortcode($content).'</div></div></div>';
		return $output;
	}
	add_shortcode( 'animate_icons_style1', 'be_animate_icons_style1' );
}

if ( ! function_exists( 'be_animate_icon_style1' ) ) {
	function be_animate_icon_style1( $atts, $content ) {
		extract( shortcode_atts( array (
			'icon' => 'none',
			'title' => '',
			'title_font' => 'h6',
			'size' => 30,
			'icon_color' => '',
			'link_to_url' => '',
			'height' => '',
			'bg_image' => '',
			'bg_color' => '',
			'hover_bg_color' => '',
			'bg_overlay' => 0,
			'overlay_color' => '',
			//'overlay_opacity' => '',
			'hover_overlay_color' => '',
			'hover_overlay_opacity' => '',
			'animate_direction' => 'top'
	    ),$atts ) );
		$link_to_url = ( isset( $link_to_url ) && !empty( $link_to_url ) ) ? $link_to_url : '#' ;
	    $bg_color = ( !empty( $bg_color ) ) ? $bg_color : 'transparent' ;
	    $hover_bg_color = ( isset( $hover_bg_color ) && !empty( $hover_bg_color ) ) ? $hover_bg_color : $bg_color ;
	    $animate_direction = ( isset( $animate_direction ) && !empty( $animate_direction ) ) ? $animate_direction : 'top';
	    $bg_overlay_class = ( isset( $bg_overlay ) && 1 == $bg_overlay ) ? 'ai-has-overlay' : '' ;
	    $title_font = ( isset( $title_font ) && !empty($title_font) ) ? $title_font : 'h6' ;
	    $margin_bottom = $GLOBALS['be_animate_icon_style1_gutter'];
	    if( !empty( $bg_image ) ) {
	    	//$attachment_info = wp_get_attachment_image_src( $bg_image, 'full' );
			//$attachment_url = $attachment_info[0];
	    	$bg_image = 'background: url('.$bg_image.');';
	    } 
	    $output = '';
	    $output .= '<a href="'.$link_to_url.'" class="animate-icon-module-style1 be-bg-cover animate-icon-module '.$bg_overlay_class.' '.$animate_direction.'-animate" data-bg-color="'.$bg_color.'" data-hover-bg-color="'.$hover_bg_color.'" style="margin-bottom: '.$margin_bottom.'px;'.$bg_image.'background-color:'.$bg_color.';">';
		$output .= '<div class="animate-icon-module-normal-content"><div class="display-table"><div class="display-table-cell vertical-align-middle"><i class="font-icon '.$icon.'" style="font-size: '.$size.'px;color: '.$icon_color.';"></i>';
		$output .= !empty($title) ? '<'.$title_font.' class="title_content" style="color: '.$icon_color.';">'.$title.'</'.$title_font.'>' : '';
		$output .= '</div></div></div>'; //closing tags for Normal Content
		$output .= '<div class="animate-icon-module-hover-content"><div class="display-table"><div class="display-table-cell vertical-align-middle">'.$content.'</div></div></div>';
		if( isset( $bg_overlay ) && 1 == $bg_overlay && !empty( $bg_image ) ) {
			// $opacity = '';
			// if(isset($overlay_color) && !empty( $overlay_color )) {
			// 	$global_overlay_color = $overlay_color = be_themes_hexa_to_rgb( $overlay_color );
			// } else {
			// 	$global_overlay_color = $overlay_color = be_themes_hexa_to_rgb( '#000000' );
			// 	$overlay_opacity = 0;
			// }
			// $overlay_opacity = (isset($overlay_opacity)) ? $overlay_opacity : '80';
			// $overlay_color = 'rgba('.$overlay_color[0].','.$overlay_color[1].','.$overlay_color[2].', '.floatval($overlay_opacity/100).')';
			// $hover_overlay_color = (isset($hover_overlay_color) && !empty( $hover_overlay_color )) ?  be_themes_hexa_to_rgb( $hover_overlay_color ) : $global_overlay_color;
			// $hover_overlay_opacity = (isset($hover_overlay_opacity)) ? $hover_overlay_opacity : $overlay_opacity;
			// $hover_overlay_color = 'rgba('.$hover_overlay_color[0].','.$hover_overlay_color[1].','.$hover_overlay_color[2].', '.floatval($hover_overlay_opacity/100).')';
			$output .= '<div class="ai-overlay" style="background: '.$overlay_color.';" data-bg-color="'.$overlay_color.'" data-hover-bg-color="'.$hover_overlay_color.'"></div>';
		}
		$output .= '</a>';
		return $output;
	}
	add_shortcode( 'animate_icon_style1', 'be_animate_icon_style1' );
}
?>