<?php
/**************************************
			SVG ICON
**************************************/
if (!function_exists('oshine_svg_icon')) {
    function oshine_svg_icon( $atts, $content ) {
        extract( shortcode_atts( array (
            'size'                  => 'medium',
            'width'                 => 200,
            'height'                => 200,
            'alignment'             => '',
            'color'                 => '',
            'line_animate'          => 0,
            'path_animation_type'   => 'LINEAR',
            'svg_animation_type'    => 'LINEAR',
            'animation_duration'    => 0,
            'animation_delay'       => 0,
        ), $atts ));
       
        $style = 'style = "';
        if( !empty( $color ) ){
            $style .= 'color : '. $color .';';
        }
        $line_animate_class = ( isset( $line_animate ) && 1 == $line_animate ) ? 'svg-line-animate' : '' ;
        if( 'custom' == $size ){
            $style .= 'width : '. $width .'px; height : '. $height .'px;';
        } else {
            $style .= '"'; //Close the style tag
        }
        $output = '';
        if( !empty($content) ) {
            $output .= '<div class="oshine-svg-icon oshine-module align-'. $alignment .' '.$line_animate_class.' '.$size.'" '.$style.' data-path-animation="'.$path_animation_type.'" data-svg-animation="'.$svg_animation_type.'" data-animation-delay="'.$animation_delay.'" data-animation-duration="'.$animation_duration.'" >';
            $output .= '<object type="image/svg+xml" class = "oshine-svg-object" data="'. shortcode_unautop( $content ) .'"></object>';
            $output .= '</div>';
        }
        return $output;
	}
	add_shortcode( 'oshine_svg_icon', 'oshine_svg_icon' );
}
?>