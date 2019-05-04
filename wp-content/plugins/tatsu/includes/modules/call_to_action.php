<?php
if ( ! function_exists( 'tatsu_call_to_action' ) ) {
	function tatsu_call_to_action( $atts, $content ) {
		extract( shortcode_atts( array(
			'bg_color'=> '',
			'title' => '',
			'h_tag' => 'h5',
			'title_color' => '',
			'button_text'=>'Click Here',
			'button_link'=> '',			
			'new_tab'=> 'no',
			'button_bg_color'=> '',
			'hover_bg_color'=> '',
			'color'=> '',
			'hover_color'=> '',
			'border_width' => 0,			
			'border_color'=> '',
			'hover_border_color'=> '',
			'lightbox' => 0,
			'image' => '',
			'video_url' => '',
			'animate'=> 0,
			'animation_type'=> 'fadeIn',
	    ), $atts ) );

		$output = '';
		$mfp_class = '';
		if($button_bg_color) {
			$data_bg_color = 'data-bg-color="'.$button_bg_color.'"';
		} else {
			$data_bg_color = 'data-bg-color="inherit"';
			$button_bg_color = 'inherit';
		}

		$data_hover_bg_color = ($hover_bg_color) ? 'data-hover-bg-color="'.$hover_bg_color.'"' : 'data-hover-bg-color="'.$button_bg_color.'"' ; 
		
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
		//$button_link = ( empty( $button_link ) ) ? '#' : $button_link ;	 
		$new_tab = ( isset( $new_tab ) && 1 == $new_tab ) ? 'target="_blank"' : '' ;

		if( $lightbox && 1 == $lightbox ) {
			if( !empty( $video_url ) ) {
				$mfp_class = 'mfp-iframe';
				$button_link = $video_url;
			} elseif ( !empty($image) ) {
				$mfp_class = 'mfp-image';
				$button_link = $image;
			}
		}



		$animate = ( isset( $animate ) && 1 == $animate ) ? ' tatsu-animate' : '' ; 
		$output .= '<div class="tatsu-module tatsu-call-to-action tatsu-clearfix '.$animate.'" data-animation="'.$animation_type.'" style="background: '.$bg_color.'">';
		$output .= '<'.$h_tag.' class="tatsu-action-content" style="color:'.$title_color.';">'.$title.'</'.$h_tag.'>';
		$output .= ( !empty( $button_link ) ) ? '<a class="mediumbtn tatsu-button rounded tatsu-action-button '.$mfp_class.'" href="'.$button_link.'" '.$new_tab.' style="border-style: solid; border-width: '.$border_width.'px; border-color: '.$border_color.'; background-color: '.$button_bg_color.'; color: '.$color.';" '.$data_bg_color.' '.$data_hover_bg_color.' '.$data_color.' '.$data_hover_color.' '.$data_border_color.' '.$data_hover_border_color.'>'.$button_text.'</a>' : '' ;
		$output .= '</div>';
		return $output;	
	}
	add_shortcode( 'tatsu_call_to_action', 'tatsu_call_to_action' );
	add_shortcode( 'call_to_action', 'tatsu_call_to_action' );
}

?>