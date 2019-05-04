<?php
// Change linebreak to tatsu_empty_space in parser
if (!function_exists('tatsu_empty_space')) {
	function tatsu_empty_space( $atts ) {
		extract(shortcode_atts( array(
	        'height'=>'50',
	        'hide_in' => 0
	    ),$atts ) );

	    $class = '';
		//Handle Resposive Visibility controls
		if( !empty( $hide_in ) ) {
			$hide_in = explode(',', $hide_in);
			foreach ( $hide_in as $device ) {
				$class .= ' tatsu-hide-'.$device;
			}
		}	
		$output = '';
		$output .='<div class="tatsu-empty-space '.$class.'" style="height:'.$height.'px;"></div>';
		return $output;
	}
	add_shortcode( 'tatsu_empty_space', 'tatsu_empty_space' );
	add_shortcode( 'linebreak', 'tatsu_empty_space' );
}

?>