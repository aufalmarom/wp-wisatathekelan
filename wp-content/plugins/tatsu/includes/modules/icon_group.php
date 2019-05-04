<?php
if ( !function_exists( 'tatsu_icon_group' ) ) {	
	function tatsu_icon_group( $atts, $content ){
		extract( shortcode_atts( array (
			'alignment' => 'center'
		), $atts ) );
		$output = '<div class="tatsu-module tatsu-icon-group align-'.$alignment.'" >'.do_shortcode( $content ).'</div>';		
		return $output;	
	}	
	add_shortcode( 'tatsu_icon_group', 'tatsu_icon_group' );
	add_shortcode( 'icon_group', 'tatsu_icon_group' );
}

?>