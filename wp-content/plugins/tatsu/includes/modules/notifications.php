<?php
if (!function_exists('tatsu_notifications')) {
	function tatsu_notifications( $atts, $content ) {
		extract(shortcode_atts( array(
	        'bg_color'=>'',
			'animate'=>0,
	        'animation_type'=>'fadeIn',
	    ), $atts ) );
	    $style = '';
	    $animate = ( isset( $animate ) && 1 == $animate ) ? ' tatsu-animate' : '' ;
		$style = ( ! empty( $bg_color ) ) ? 'background-color:'.$bg_color.';' : '' ;
		
		return '<div class="tatsu-module tatsu-notification '.$animate.'" style="'.$style.'" data-animation="'.$animation_type.'"><span class="close"><i class="tatsu-icon icon-icon_close"></i></span>'.do_shortcode( $content ).'</div>';
	}
	add_shortcode( 'tatsu_notifications', 'tatsu_notifications' );
	add_shortcode( 'notifications', 'tatsu_notifications' );
}

?>