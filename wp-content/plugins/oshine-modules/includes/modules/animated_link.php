<?php
/**************************************
			ANIMATED LINK
**************************************/
if (!function_exists('oshine_animated_link')) {
    function oshine_animated_link( $atts, $content ) {
        extract( shortcode_atts( array (
			'link_text' => '',
			'url' => '',
            'font_size' => '13',
            'link_style' => 'style1',
			'alignment' => '',
			'color'=> '',
			'hover_color'=> '',
			'line_color'=> '',
			'line_hover_color' => '',
			'animate' => 0,
			'animation_type' => 'fadeIn',
			'animation_delay' => 0,
		), $atts ) );
		
		$output = '';
        if( !empty( $color ) ) {
			$data_color = 'data-color="'.$color.'"';
		} else {
			$data_color = 'data-color="inherit"';
			$color = 'inherit';
		}
		$data_line_hover_color = ( !empty( $line_hover_color ) ) ? 'data-line-hover-color="'.$line_hover_color.'"' : 'data-line-hover-color="'. ( ( !empty( $line_color ) ) ? $line_color : $hover_color ).'"' ;
		if( !empty( $line_color ) ) {
			$data_line_color = 'data-line-color="'.$line_color.'"';
		} else {
			$data_line_color = 'data-line-color="'. $color .'"';
			$line_color = $color;
		}
		$data_hover_color = ( !empty( $hover_color ) ) ? 'data-hover-color="'.$hover_color.'"' : 'data-hover-color="'.$color.'"' ;
		$animate = ( isset( $animate ) && 1 == $animate ) ? ' tatsu-animate' : '';
		
		$output .= '<div class="oshine-animated-link oshine-module align-'. $alignment .'"><a class = "animated-link-'. $link_style .' '. $animate .'" href = "'. $url .'" style = "color : '. $line_color .'; font-size : '. $font_size .'px" data-animation="'. $animation_type .'" data-animation-delay="'.$animation_delay.'" '. $data_line_color .' '. $data_line_hover_color .' >';
		$output .= '<span class = "link-text" style="color : '. $color .';" '. $data_color .' '. $data_hover_color .'>'.$link_text.'</span>';
        if( $link_style == 'style4' || $link_style == 'style5' ){
            $output .= '<div class = "next-arrow"><span class="arrow-line-one" style="background-color: '. $line_color .'"></span><span class="arrow-line-two" style="background-color: '. $line_color .'"></span><span class="arrow-line-three" style="background-color: '. $line_color .'"></span></div>';
        }
        $output .= '</a></div>';
		return $output;
	}
	add_shortcode( 'oshine_animated_link', 'oshine_animated_link' );
}
?>