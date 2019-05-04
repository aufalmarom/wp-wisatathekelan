<?php
if ( !function_exists('tatsu_lists') ) {
	function tatsu_lists( $atts, $content ) {
		return '<ul class="tatsu-module tatsu-list">'.do_shortcode( $content ).'</ul>';
	}
	add_shortcode( 'tatsu_lists', 'tatsu_lists' );
	add_shortcode( 'lists', 'tatsu_lists' );
}
if ( !function_exists( 'tatsu_list' ) ) {
	function tatsu_list( $atts, $content ) {
		global $be_themes_data;
		extract(shortcode_atts( array( 
			'icon' => '',
			'circled' => '',
			'icon_bg' => $be_themes_data['color_scheme'], 
			'icon_color' => $be_themes_data['alt_bg_text_color'], 
		), $atts ) );
		if( $icon != 'none' ) { 
		 	if( 1 == $circled ) {
		 		$circled = 'circled';
		 		$background_color = 'background-color:'.$icon_bg.';';
		 	} else {
		 		$circled = '';
		 		$background_color = ''; 		
		 	}
		} 
		return '<li class="tatsu-list-content"><i class="tatsu-icon '.$icon.' '.$circled.'" style="'.$background_color.'color:'.$icon_color.';"></i><span class="tatsu-list-inner">'.$content.'</span></li>';
	}
	add_shortcode( 'tatsu_list', 'tatsu_list' );
	add_shortcode( 'list', 'tatsu_list' );
}

?>