<?php
// Change separator to divider in parser
if ( ! function_exists( 'tatsu_divider' ) ) {
	function tatsu_divider( $atts ) {
		extract( shortcode_atts( array(
	        'height' => '1',
	        'width' => '20',
	        'units' => '%',
	        'alignment' => '',
	        'color' => '#dedede',
	    ),$atts ) );
		$output = '';
		$style = '';
		$units = (isset($units) && !empty($units) && 'percentage' == $units) ? '%' : $units;
		$style = ( ! empty( $color ) ) ? 'background-color:'.$color.';color:'.$color.';' : $style ;
		$style .= ( ! empty( $height ) ) ? 'height:'.$height.'px;' : '' ;
		$style .= ( ! empty( $width ) ) ? 'width:'.$width.$units.';' : '' ;
		$class = ( !empty( $alignment ) ) ? 'align-'.$alignment: '';
		
		$output .='<hr class="tatsu-module tatsu-divider '.$alignment.'" style="'.$style.'" />'; 
		return $output;
	}
	add_shortcode( 'tatsu_divider', 'tatsu_divider' );
}

?>