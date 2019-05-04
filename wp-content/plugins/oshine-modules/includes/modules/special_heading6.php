<?php
/**************************************
			SPECIAL TITLE 6
**************************************/
if (!function_exists('be_special_heading6')) {
	function be_special_heading6( $atts, $content ) { 

        extract( shortcode_atts( array(
            'title_content'        => '',
            'border_style'         => 'style1',
            'font_size'            => '14px',
            'letter_spacing'       => '0em',
            'margin'               => '0px 0px 0px 0px',
            'title_color'          => '',
            'border_color'         => '',
            'title_hover_color'    => '',
            'alignment'            => 'left',
            'expand_border'        => 0,
            'animate'              => 0,
            'animation_type'       => 'none'
        ), $atts ) );
        $font_size = ( isset($font_size) && !empty($font_size) ) ? $font_size : '14px';
        $border_style = ( isset($border_style) && !empty($border_style) ) ? $border_style : 'style1';
        $letter_spacing = ( isset($letter_spacing) && !empty($letter_spacing) ) ? $letter_spacing : '0em';
        $margin = ( isset($margin) && !empty($margin) ) ? $margin : '0px 0px 0px 0px';
        $title_color = ( isset($title_color) && !empty($title_color) ) ? $title_color : '';
        $border_color = ( isset($border_color) && !empty($border_color) ) ? $border_color : '';
        $title_hover_color = ( isset($title_hover_color) && !empty($title_hover_color) ) ? $title_hover_color : '';
        $alignment = ( isset($alignment) && !empty($alignment) ) ? $alignment : 'left';
        $expand_border = ( isset($expand_border) && !empty($expand_border) ) ? 1 : 0;
        $output ='';
		$animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate"' : '"' ; 
        $animation_type = ( isset($animation_type) && !empty($animation_type) && !empty($animate) ) ? $animation_type : 'none';
        $output .= '<div class = "oshine-module special-heading-wrap style6' . $animate . ' style = "font-size :' . $font_size .';text-align:' . $alignment . ';margin:'. $margin . ';" data-animation="' . $animation_type . '">';
        $output .= '<div class = "special-heading-inner-wrap be-border-' . $border_style .  ( ( 1 == $expand_border ) ? ' be-expand"' : '"' ) . ' data-hover-title-color="'. $title_hover_color . '" data-title-color="'. $title_color . '" >';
        $output .= '<div class = "be-border" style = "background :' . $border_color . ';">';
        $output .= '</div>'; //End be-border
        $output .= '<h6 class = "be-title" style = "color:' . $title_color . ';font-size:inherit;letter-spacing:'. $letter_spacing .';">';
        $output .= $title_content;
        $output .= '</h6>';//End be-title 
        $output .= '</div>'; // End special-heading-inner-wrap
        $output .= '</div>'; //End special-heading-wrap
        return $output;
    }
    add_shortcode( 'be_special_heading6','be_special_heading6' );
}
?>