<?php
if ( ! function_exists( 'tatsu_title_icon' ) ){
	function tatsu_title_icon( $atts, $content ) {
		extract(shortcode_atts(array(
			'icon'=>'none',
			'size' => 'small',
			'alignment'=>'left',	
			'style'=>'circled',
			'icon_bg'=> '',
			'icon_color'=> '',
			'icon_border_color'=> '',
			'animate'=> 0,
			'animation_type'=>'fadeIn',
			'animation_delay' => 0,
		),$atts));
		$output ='';
		$background_color = ( $style == 'circled' || $style == 'rounded' ) ? 'background-color:'.$icon_bg.';' : '' ;
		$animate = ( isset( $animate ) && 1 == $animate ) ? ' tatsu-animate' : 0 ;
		$output .= '<div class="tatsu-module tatsu-title-icon '.$animate.'" data-animation="'.$animation_type.'" data-animation-delay="'.$animation_delay.'">';
		$output .= '<i class="'.$icon.' tatsu-ti '.$style.' '.$size.' align-'.$alignment.'" style="'.$background_color.'color:'.$icon_color.';border-color: '.$icon_border_color.'"></i>';
		$output .= '<div class="tatsu-tc '.$size.' '.$style.' align-'.$alignment.'">'.do_shortcode( $content ).'</div>'; 
		$output .= '</div>';   		
		
		return $output; 
	}
	add_shortcode('tatsu_title_icon','tatsu_title_icon');
	add_shortcode('title_icon','tatsu_title_icon');
}

?>