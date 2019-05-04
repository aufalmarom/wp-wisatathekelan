<?php
/**************************************
			Process Style
**************************************/
if (!function_exists('be_process_style1')) {
	function be_process_style1( $atts, $content ) {
		extract( shortcode_atts( array (
			'column' => 1,
			'border_color' => '',
	    ), $atts ) );
		if(empty( $column )) {
			$column = 2;
		}
	    $output = "";
	    $output .= '<div class="process-style1 oshine-module" data-col="'.$column.'" style="border-color: '.$border_color.';">';
	    $output .= do_shortcode( $content );
	    $output .= '</div>';
	    return $output;
	}
	add_shortcode( 'process_style1', 'be_process_style1' );
}

if (!function_exists('be_process_col')) {
	function be_process_col( $atts, $content ){
			extract( shortcode_atts( array (
				'icon' => '',
				'icon_color' => '',
				'icon_size'	=> '60',
		        'animate' => 0,
				'animation_type'=>'fadeIn',
	    	), $atts ));
	    	$animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : 0 ;
			$output = '';
	    	$output .= '<div class="process-col '.$animate.' align-center" data-animation="'.$animation_type.'">';
			$output .= '<i class="font-icon '.$icon.'" style="font-size: '.$icon_size.'px; color: '.$icon_color.';"></i>';
			$output .= '<div class="process-info">'.do_shortcode( $content ).'</div>';
	        //$output .= '</div><div class="process-divider" style="height: '.intval($icon_size/2).'px;"></div>';
	        $output .= '<div class="process-sep" style="top: '.intval($icon_size/2).'px;"></div>';
	        $output .= '</div>';
	        return $output;
	}
	add_shortcode( 'process_col', 'be_process_col' );
}
?>