<?php
if ( ! function_exists( 'tatsu_dropcap' ) ) {
	function tatsu_dropcap( $atts, $content ) {
		extract( shortcode_atts( array(
	        'type'=>'circle',
	        'bg_color' => '',
	        'color'=>'',
	        'size' =>'small',
	        'letter'=>'',
	        'icon'=>'none',
			'animate'=>0,
	        'animation_type'=>'fadeIn',
	    ), $atts ) );
		$output = "";
		$style = "";
		$output .= '<div class="tatsu-module tatsu-clearfix">';
		$letter = ( $icon != '' ) ? '<i class="tatsu-icon '.$icon.'"></i>' : $letter ;
		$animate = ( isset( $animate ) && 1 == $animate ) ? ' tatsu-animate' : '' ; 
		
	 	if( 'rounded' == $type || 'circle' == $type ) {
	 		$color = ( !empty( $color ) ) ? 'color:'.$color.';' : '';
	 		$bg_color = ( !empty( $color ) ) ? 'background-color:'.$bg_color.';' : '';
	 		$style = ( !empty( $color ) || !empty( $bg_color ) )? 'style="'.$color.$bg_color.'"' : ''; 
	 		$output .= '<span class="tatsu-dropcap tatsu-dropcap-'.$type.' '.$size.$animate.'" '.$style.' data-animation="'.$animation_type.'">'.$letter.'</span>'.do_shortcode( $content );
	 	}
	 	if( 'letter' == $type) {
	 		$style .= ( !empty( $color ) )? 'style="color:'.$color.';"' : '' ;
			$output .= '<span class="tatsu-dropcap tatsu-dropcap-'.$type.' '.$size.'" '.$style.' data-animation="'.$animation_type.'">'.$letter.'</span>'.do_shortcode( $content );
		}
		$output .= '</div>';
		return $output;
	}
	add_shortcode( 'tatsu_dropcap', 'tatsu_dropcap' );
	add_shortcode( 'dropcap', 'tatsu_dropcap' );
}

?>