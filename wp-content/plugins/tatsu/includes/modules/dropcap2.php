<?php
/**************************************
			DROP CAPS - STYLE 2
**************************************/
if ( ! function_exists( 'tatsu_dropcap2' ) ) {
	function tatsu_dropcap2( $atts ) {
		extract( shortcode_atts( array(
	        'letter'=>'',
	        'icon'=>'',
	        'size' =>'60',
	        'color'=>'',
	        'dropcap_title'=>'',
	        'title_color' => '',
	        'title_font' => '',
			'animate'=>0,
	        'animation_type'=>'fadeIn',
	    ), $atts ) );
		$output="";
		if( !empty( $icon ) ) {
			$letter = '<span class="tatsu-dropcap" style="color:'.$color.';"><i class="tatsu-icon '.$icon.'" style="font-size:'.$size.'px;"></i></span>';
		}else{
			$letter = '<h6 class="tatsu-dropcap" style="color:'.$color.';font-size:'.$size.'px;" >'.$letter.'</h6>';
		}

		$size = ( isset( $size ) ) ? $size : "60" ;
		$color = ( isset( $color ) ) ? $color : "" ;
		$title_color = ( isset( $title_color ) ) ? $title_color : "" ; 
		$animate = ( isset( $animate ) && 1 == $animate ) ? 'tatsu-animate' : '' ;

		$title_tag = 'div';
		if ('body' == $title_font){
			$title_font_style = 'body-font';
		} elseif ('special' == $title_font){
			$title_font_style = 'special-subtitle';
		} else {
			$title_font_style = '';
			$title_tag = $title_font;
		}

		$output .= '<div class="tatsu-dropcap-wrap tatsu-module style2 '.$animate.'" data-animation="'.$animation_type.'">';
		$output .= $letter;
		$output .= !empty($dropcap_title) ? '<'.$title_tag.' class= "tatsu-dropcap-title '.$title_font_style.'" style="color:'.$title_color.';">'.$dropcap_title.'</'.$title_tag.'>' : '' ;
		$output .= '</div>';

		return $output;	
	}
	add_shortcode( 'tatsu_dropcap2', 'tatsu_dropcap2' );
}
?>