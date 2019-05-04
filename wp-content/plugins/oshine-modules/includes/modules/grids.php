<?php
/**************************************
			GRID
**************************************/
if (!function_exists('be_grids')) {
	function be_grids( $atts, $content ) {
		extract( shortcode_atts( array (
			'column' => 1,
			'border_color' => '',
			'alignment' => 'center'
	    ), $atts ) );
		if(empty( $column )) {
			$column = 2;
		}
		$GLOBALS['be_grid_alignment'] = isset($alignment) ? 'align-'.$alignment : 'align-center';
	    $output = "";
	    $output .= '<div class="grid-wrap oshine-module" data-col="'.$column.'" style="border-color: '.$border_color.'; align-'.$alignment.'">';
	    $output .= do_shortcode( $content );
	    $output .= '</div>';
	    return $output;
	}
	add_shortcode( 'grids', 'be_grids' );
}

if (!function_exists('be_grid_content')) {
	function be_grid_content( $atts, $content ){
			extract( shortcode_atts( array (
				'icon' => '',
				'icon_size' => 'medium',
				'icon_color' => '',
		        'animate' => 0,
				'animation_type'=>'fadeIn',
	    	), $atts ));
	    	$animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : 0 ;
			$output = '';
	    	$output .= '<div class="grid-col '.$animate.' '.$GLOBALS['be_grid_alignment'].'" data-animation="'.$animation_type.'">';
			$output .= ($icon != '') ? '<i class="font-icon '.$icon.' '.$icon_size.' " style="color: '.$icon_color.';"></i>' : '' ;
			$output .= ($content != '') ? '<div class="grid-info">'.be_themes_formatter( do_shortcode( shortcode_unautop( $content ) ) ).'</div>' : '';
	        $output .= '</div>';
	        return $output;
	}
	add_shortcode( 'grid_content', 'be_grid_content' );
}
?>