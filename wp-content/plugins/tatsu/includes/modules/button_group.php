<?php
if (!function_exists('tatsu_button_group')) {	
	function tatsu_button_group( $atts, $content ){
		extract( shortcode_atts( array (
			'alignment' => 'center'
		), $atts ) );
		$output = '<div class="tatsu-module tatsu-button-group align-'.$alignment.'" >'.do_shortcode( $content ).'</div>';		
		return $output;	
	}	
	add_shortcode( 'tatsu_button_group', 'tatsu_button_group' );
}

?>