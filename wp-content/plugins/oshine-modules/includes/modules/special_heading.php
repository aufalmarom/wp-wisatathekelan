<?php
/**************************************
			SPECIAL TITLE 1
**************************************/
if (!function_exists('be_special_heading')) {
	function be_special_heading( $atts, $content ) {
		global $be_themes_data;
		extract( shortcode_atts( array (
			'title_align' => 'center',
			'title_content' => '',
			'h_tag' => 'h3',
			'title_color' => '',
			'subtitle_spl_font' => '',
			'disable_separator' => 0,
			'separator_style' => '1',
			'icon_name' => '',
			'default_icon' => 0,
			'icon_color' => $be_themes_data['color_scheme'] ,
			'separator_thickness' => '2' ,
			'separator_width' => '40' ,
			'separator_pos' => '0' ,
	        'separator_color' => '#323232',
			'scroll_to_animate'=> 0,
			'animate'=> 0,
	        'animation_type'=> 'fadeIn',
	    ),$atts ) );
	    $output ='';
	    $animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : '' ;
	    $subtitle_spl_font = ( isset( $subtitle_spl_font ) && 1 == $subtitle_spl_font ) ? ' special-subtitle' : '';
	    $title_align = ( isset( $title_align ) && !empty($title_align) ) ? $title_align : 'cemter';
		$icon_color = ( 'oshine_diamond' == $icon_name ) ? 'background-color:'.$icon_color : 'color:'.$icon_color ;
		
		if( !( $disable_separator ) ){
			if( !empty( $separator_style ) ){
				$separator_color =  'style="background-color:'.$separator_color.';border-color:'.$separator_color.';color:'.$separator_color.';height:'.$separator_thickness.'px;width:'.($separator_width/2).'px;"';
				$sep_output = '<div class="sep-with-icon-wrap margin-bottom"><span class="sep-with-icon" '.$separator_color.' ></span><i class="sep-icon font-icon '.$icon_name.'" style="'.$icon_color.';"></i><span class="sep-with-icon" '.$separator_color.' ></span></div>';
			} else {
				$separator_color =  'style="background-color:'.$separator_color.';border-color:'.$separator_color.';color:'.$separator_color.';height:'.$separator_thickness.'px;width:'.$separator_width.'px;"';
				$sep_output = '<hr class="separator margin-bottom " '.$separator_color.' />';
			}
		}
		else{
			$sep_output = '';
		}
		
		$output .='<div class="special-heading-wrap style1 oshine-module '.$animate.'" data-animation="'.$animation_type.'"><div class="special-heading align-'.$title_align.'">';
		$output .= ($title_content) ? '<'.$h_tag.' class="special-h-tag" style="color: '.$title_color.'">'.$title_content.'</'.$h_tag.'>' : '' ;
		if (isset($separator_pos) && 1 == $separator_pos) { //Place Divider Above Header
			$output .= $sep_output;
			$output .= ($content) ? '<div class="sub-title margin-bottom '.$subtitle_spl_font.'">'.$content.'</div>' : '' ;
		}
		else {
			$output .= ($content) ? '<div class="sub-title margin-bottom '.$subtitle_spl_font.'">'.$content.'</div>' : '' ;
			$output .= $sep_output;
		}
		$output .='</div></div>';
		return $output;
	}
	add_shortcode( 'special_heading', 'be_special_heading' );
}
?>