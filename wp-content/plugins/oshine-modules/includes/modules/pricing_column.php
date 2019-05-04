<?php
/**************************************
			PRICING TABLE
**************************************/
if ( ! function_exists( 'be_pricing_column' ) ) {
	function be_pricing_column( $atts, $content ) {
		global $be_themes_data;
		extract( shortcode_atts( array(
			'title'=>'',
			'h_tag'=>'h5',
			'price'=>'',
			'duration'=>'',
			'currency'=>'$',
			'button_text'=>'',
			'button_color'=> $be_themes_data['color_scheme'],
			'button_hover_color' => '',
			'button_bg_color' => '',
			'button_bg_hover_color' => '',
			'button_border_color' => $be_themes_data['color_scheme'],
			'button_border_hover_color' => '',
			'button_link'=>'',
			'highlight'=>'no',
			'style'=>'style-1',
			'header_bg_color' => $be_themes_data['color_scheme'],
			'header_color' => $be_themes_data['alt_bg_text_color'],
			'animate'=>0,
			'animation_type'=>'fadeIn',
	    ), $atts ) );

	    $output = '';
	    $animate = ( isset( $animate ) && 1 == $animate ) ? 'be-animate' : '' ;
		if($style == 'style-2'){
			$header_bg_color = ( isset($header_bg_color) && !empty($header_bg_color) ? $header_bg_color : $be_themes_data['color_scheme'] );	
			$header_color =  ( isset($header_color) && !empty($header_color) ? $header_color : $be_themes_data['alt_bg_text_color'] );	
		}
		else{
			$header_bg_color = '';
			$header_color = '';
		}
		
		$output .= '<ul class="pricing-table sec-border highlight-'.$highlight.' oshine-module '.$animate.'" data-animation="'.$animation_type.'">';
	    if( ! empty( $title ) ) {
	    	$output .= ( $style == 'style-1' ) ? '<li class="pricing-title" ><'.$h_tag.' class="sec-color">'.$title.'</'.$h_tag.'></li>' : '<li class="pricing-title" style="background-color:'.$header_bg_color.';"><'.$h_tag.' style="color:'.$header_color.'">'.$title.'</'.$h_tag.'></li>' ;
	    }
	    $output .= ( ! empty( $price ) ) ? '<li class="pricing-price"><h2 class="price"><span class="currency">'.$currency.'</span>'.$price.'</h2><span class="pricing-duration special-subtitle">'.$duration.'</span></li>' : '' ; 
	    $output .= do_shortcode( $content );
		$output .= 	( !empty( $button_text ) && !empty( $button_link ) ) ? '<li class="pricing-button">'.do_shortcode('[button button_text= "'.$button_text.'" type= "medium" gradient= "1" rounded= "1" icon= "" bg_color ="'.$button_bg_color.'" hover_bg_color = "'.$button_bg_hover_color.'"  border_width= "1" border_color = "'.$button_border_color.'" hover_border_color = "'.$button_border_hover_color.'" color= "'.$button_color.'" hover_color= "'.$button_hover_color.'" url="'.$button_link.'" ]').'</li>' : '' ;
	    $output .= '</ul>';

	    return $output;

	}
	add_shortcode( 'pricing_column', 'be_pricing_column' );
}

if ( ! function_exists( 'be_pricing_feature' ) ) {
	function be_pricing_feature( $atts, $column ) {
		extract( shortcode_atts( array(
			'feature' => '',
			'highlight' => '',
			'highlight_color' => '',
			'highlight_text_color' => ''
		), $atts ) );
		$output = '';
		if( ! empty( $feature ) ) {
			if($highlight) {
				$highlight_section = 'highlight';
				$highlight_color = (!$highlight_color) ? '#e5e5e5' : $highlight_color ; 
			} else {
				$highlight_section = 'no-highlight';
				$highlight_color = '';
				$highlight_text_color = '';
			}
			$output .='<li class="pricing-feature '.$highlight_section.'" style="background : '.$highlight_color.'; color : '.$highlight_text_color.'">'.$feature.'</li>';
		}
		return $output;
	}
	add_shortcode( 'pricing_feature', 'be_pricing_feature' );
}
?>