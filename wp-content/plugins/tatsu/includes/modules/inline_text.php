<?php 
if ( !function_exists( 'tatsu_inline_text' ) ) {
	function tatsu_inline_text( $atts, $content ) {
		extract( shortcode_atts( array (
            'margin' => '0',
			'animate' => '0',
			'animation_type' => 'none',
			'animation_delay' => '0',
			'max_width' => 100,
			'wrap_alignment' => 'center',        
	    ),$atts ) );

		$animate = ( isset( $animate ) && !empty( $animate ) ) ? 1 : 0;
		$animation_delay = ( isset( $animation_delay ) && !empty( $animation_delay ) && 1 == $animate ) ? $animation_delay : '';
		$animation_type = ( isset( $animation_type ) && !empty( $animation_type ) && 1 == $animate ) ? $animation_type : '';
		if( $max_width < 100 ){
			if( $wrap_alignment == 'left' ){
				$inner_margin = 'margin-right: 0; margin-left:0;';
			}
			if( $wrap_alignment == 'center' ){
				$inner_margin = 'margin-right:auto; margin-left:auto;';
			}
			if( $wrap_alignment == 'right' ){
				$inner_margin = 'margin-right: 0;margin-left:auto;';
			}
		}
		else{
			$inner_margin = ''; //'margin-right:auto; margin-left:auto;';
		}	    

	    $output = '';
		$output .= '<div class="tatsu-module tatsu-inline-text clearfix' . ( ( 1 == $animate ) ? ' tatsu-animate' : '' )  . '" style="margin:'.$margin.';"' . ( ( '' != $animation_type ) ? ( ' data-animation="'. $animation_type .'"' ) : '' ) . ( ( '' != $animation_delay ) ? ( ' data-animation-delay="'. $animation_delay .'"' ) : '' )  . ' >';
		$output .= '<div class="tatsu-inline-text-inner" style="width: '.$max_width.'%; '.$inner_margin.'">';
		$output .= do_shortcode(  $content );
		$output .= '</div>';
		$output .= '</div>';
	    return $output;
	}
	add_shortcode( 'tatsu_inline_text', 'tatsu_inline_text' );
}
?>