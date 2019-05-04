<?php
if (!function_exists('tatsu_button')) {
	function tatsu_button( $atts, $content ) {
		extract( shortcode_atts( array (
			'button_text' => '',
			'icon' => 'none',
			'icon_alignment' => '',
			'url' => '',
			'new_tab'=> 'no',
			'type' => 'small',
			'alignment' => '',							 
			'bg_color' => '',
			'hover_bg_color' => '',
			'color'=> '',
			'hover_color'=> '',
			'border_width' => 0,			
			'border_color'=> '',
			'hover_border_color'=> '',
			'button_style' => 'none',
			'lightbox' => 0,	
			'image' => '',
			'video_url' => '',
			'background_animation' => '',
			'animate' => 0,
			'animation_type' => 'fadeIn',
			'animation_delay' => 0,
		), $atts ) );
		

		$mfp_class = '';
		$output = '';
		$new_tab = ( isset( $new_tab ) && 1 == $new_tab ) ? 'target="_blank"' : '' ;
		if( !empty( $bg_color ) ) {
			$data_bg_color = 'data-bg-color="'.$bg_color.'"';
		} else {
			$data_bg_color = 'data-bg-color="transparent"';
			$bg_color = 'transparent';
		}
		$data_hover_bg_color = ( !empty( $hover_bg_color ) ) ? 'data-hover-bg-color="'.$hover_bg_color.'"' : 'data-hover-bg-color="'.$bg_color.'"';
		if( !empty( $color ) ) {
			$data_color = 'data-color="'.$color.'"';
		} else {
			$data_color = 'data-color="inherit"';
			$color = 'inherit';
		}
		$data_hover_color = ( !empty( $hover_color ) ) ? 'data-hover-color="'.$hover_color.'"' : 'data-hover-color="'.$color.'"' ;
		if( !empty( $border_color ) ) {
			$data_border_color = 'data-border-color="'.$border_color.'"';
		} else {
			$data_border_color = 'data-border-color="transparent"';
			$border_color = 'transparent';
		}	
		$data_hover_border_color = ( !empty( $hover_border_color ) ) ? 'data-hover-border-color="'.$hover_border_color.'"' : 'data-hover-border-color="'.$border_color.'"';
		$background_animation = ( !empty( $background_animation ) && 'none' != $background_animation ) ? $background_animation : 'bg-animation-none';
		$border_width = ( empty( $border_width ) ) ? '0' : $border_width;
		$border_style = 'border-style: solid; border-width:'.$border_width.'px; border-color: '.$border_color;

		$alignment = ( "block" === $type ) ? 'center' : $alignment;
		if( isset( $alignment ) ){
			if( $alignment != 'none' ){
				$alignment = 'align-block block-'.$alignment;
			} else {
				$alignment = '';
			}
		}
		$animate = ( isset( $animate ) && 1 == $animate ) ? ' tatsu-animate' : ''; 
		// $rounded = ( $rounded == "1" && "block" != $type) ? "rounded" : '' ; 
		$button_style = ( isset( $button_style ) && !empty( $button_style ) ) ? $button_style : '';

		
		$url = ( empty( $url ) ) ? '#' : $url ;


		$image_wrap_class = '';

		if( $lightbox && 1 == $lightbox ) {
			if( !empty( $video_url ) ) {
				$mfp_class = 'mfp-iframe';
				$url = $video_url;
			} elseif ( !empty($image) ) {
				$mfp_class = 'mfp-image';
				$url = $image;
			}
		}

		if( 'none' === $button_style ) {
			$button_style = '';
		}

		$bg_animation_css = '';
		if($background_animation != 'bg-animation-none') {
			if($background_animation == 'bg-animation-slide-top' || $background_animation == 'bg-animation-slide-bottom') {
				$bg_animation_css = 'background-image: -moz-linear-gradient(top, '.$bg_color.' 50%, '.$hover_bg_color.' 50%);
					background-image: -webkit-linear-gradient(top, '.$bg_color.' 50%, '.$hover_bg_color.' 50%);
					background-image: -o-linear-gradient(top, '.$bg_color.' 50%, '.$hover_bg_color.' 50%);
					background-image: linear-gradient(to bottom, '.$bg_color.' 50%, '.$hover_bg_color.' 50%);';
			}
			if($background_animation == 'bg-animation-slide-left' || $background_animation == 'bg-animation-slide-right') {
				$bg_animation_css = 'background-image: -moz-linear-gradient(left, '.$bg_color.' 50%, '.$hover_bg_color.' 50%);
					background-image: -webkit-linear-gradient(left, '.$bg_color.' 50%, '.$hover_bg_color.' 50%);
					background-image: -o-linear-gradient(left, '.$bg_color.' 50%, '.$hover_bg_color.' 50%);
					background-image: linear-gradient(to right, '.$bg_color.' 50%, '.$hover_bg_color.' 50%);';
			}
		}
		$icon = ( isset($icon) && !empty($icon) && ($icon != 'none') ) ? '<i class="tatsu-icon '.$icon.'"></i>' : '' ;
		$icon_alignment = ( isset($icon_alignment) && !empty($icon_alignment) ) ? $icon_alignment : 'left' ;
		$button_text = ( $icon_alignment == 'right' ) ? $button_text.$icon : $icon.$button_text ;
		$output .= '<div class="tatsu-module tatsu-button-wrap '.$alignment.' '.$image_wrap_class.'">';
		$output .= '<a class="tatsu-shortcode '.$type.'btn tatsu-button '.$icon_alignment.'-icon '.$button_style.' '.$animate.' '.$mfp_class.' '.$background_animation.'" href="'.$url.'" style= "'.$border_style.';background-color: '.$bg_color.'; color: '.$color.'; '.$bg_animation_css.'" data-animation="'.$animation_type.'" data-animation-delay="'.$animation_delay.'" '.$data_bg_color.' '.$data_hover_bg_color.' '.$data_color.' '.$data_hover_color.' '.$data_border_color.' '.$data_hover_border_color.' '.$new_tab.'>'.$button_text.'</a>' ; 
		$output .= '</div>'; 
		
		return $output;
	}
	add_shortcode( 'tatsu_button', 'tatsu_button' );
	add_shortcode( 'button', 'tatsu_button' );
}
?>