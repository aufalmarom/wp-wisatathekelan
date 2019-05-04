<?php
/**************************************
			SPECIAL SUB TITLE 1
**************************************/
if (!function_exists('be_special_subtitle')) {
	function be_special_subtitle( $atts ) {
		global $be_themes_data;
		extract( shortcode_atts( array(
			'title_content' => '',
			'font_size' => '18',
			'title_color' => '',
	        'title_alignment' => 'center',
			'scroll_to_animate'=> 0,
			'max_width' => 100,
			'margin_bottom' => 30,
			'animate'=> 0,
	        'animation_type'=> 'fadeIn',
	    ),$atts ) );
	    $output ='';
	    $animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : '' ;
	    $max_width = (isset($max_width) && !empty($max_width)) ? 'width: '.$max_width.'%' : '';
		$scroll_to_animate = ( isset( $scroll_to_animate ) && 1 == $scroll_to_animate ) ? 'scrollToFade' : $scroll_to_animate ;
		$output .='<div class="special-subtitle-wrap '.$animate.'" style="margin-bottom: '.$margin_bottom.'px;" data-animation="'.$animation_type.'"><div class="align-'.$title_alignment.'">';
		$output .= ($title_content) ? '<span class="special-subtitle" style="color: '.$title_color.'; font-size: '.$font_size.'px ; '.$max_width.'" >'.$title_content.'</span>' : '' ;
		$output .='</div></div>';
		return $output;
	}
	add_shortcode( 'special_sub_title', 'be_special_subtitle' );
}
?>