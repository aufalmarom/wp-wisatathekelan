<?php
if (!function_exists('tatsu_icon')) {
	function tatsu_icon( $atts, $content ) {
		extract(shortcode_atts(array(
			'name' => '',
			'size'=> 'medium',
			'style'=> 'circle',
			'bg_color'=> '',
			'hover_bg_color'=> '',
			'color'=> '',
			'hover_color'=> '',
			'border_width' => 1,
			'border_color'=> '#323232',
			'hover_border_color'=> '#323232',
			'href'=> '#',
			'alignment' => 'none',
			'lightbox' => 0,
			'image' => '',
			'video_url' => '',
			'new_tab' => 0,
			'animate' => 0,
			'animation_type'=>'fadeIn',
			'animation_delay' => 0,
		),$atts));

		$mfp_class = '';
		$output = '';
		if($bg_color) {
			$data_bg_color = 'data-bg-color="'.$bg_color.'"';
		} else {
			$data_bg_color = 'data-bg-color="inherit"';
			$bg_color = 'inherit';
		}
		$data_hover_bg_color = ($hover_bg_color) ? 'data-hover-bg-color="'.$hover_bg_color.'"' : 'data-hover-bg-color="'.$bg_color.'"' ; 
		if($color) {
			$data_color = 'data-color="'.$color.'"';
		} else {
			$data_color = 'data-color=""';
			$color = '';
		}
		$data_hover_color = ($hover_color) ? 'data-hover-color="'.$hover_color.'"' : 'data-hover-color="'.$color.'"' ; 
		if($border_color) {
			$data_border_color = 'data-border-color="'.$border_color.'"';
		} else {
			$data_border_color = 'data-border-color="transparent"';
			$border_color = 'transparent';
		}
		$data_hover_border_color = ($hover_border_color) ? 'data-hover-border-color="'.$hover_border_color.'"' : 'data-hover-border-color="'.$border_color.'"' ; 
		$animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : '' ;
		$new_tab = ( isset( $new_tab ) && 1 == $new_tab ) ? 'target="_blank"' : '' ;
		$href = ( empty( $href ) ) ? '#' : $href ;

		if( isset( $lightbox ) && 1 == $lightbox ) {
			if( !empty( $video_url ) ) {
				$mfp_class = 'mfp-iframe';
				$href = $video_url;
			} elseif ( !empty($image) ) {
				$mfp_class = 'mfp-image';
				$href = $image;
			}
		}

		
		$output .= '<div class="tatsu-module tatsu-icon-shortcode align-'.$alignment.'">'; 
		$output .= '<a href="'.$href.'" class="icon-'.$style.' '.$animate.' '.$mfp_class.'" data-animation="'.$animation_type.'" data-animation-delay="'.$animation_delay.'" '.$new_tab.'>';
		$output .= ( $style == 'plain' ) ? '<i class="tatsu-icon '.$name.' '.$size.' '.$style.'" style="color:'.$color.';" data-color="'.$color.'" data-hover-color="'.$hover_color.'"></i></a>' : '<i class="tatsu-icon '.$name.' '.$size.' '.$style.'" style="border-style: solid; border-width: '.$border_width.'px; border-color: '.$border_color.'; background-color: '.$bg_color.'; color: '.$color.';" data-animation="'.$animation_type.'" data-animation-delay="'.$animation_delay.'" '.$data_bg_color.' '.$data_hover_bg_color.' '.$data_color.' '.$data_hover_color.' '.$data_border_color.' '.$data_hover_border_color.'></i></a>' ;
		
		$output .= '</div>';
		
		return $output;
	}
	add_shortcode( 'tatsu_icon', 'tatsu_icon' );
	add_shortcode( 'icon', 'tatsu_icon' );
}

?>