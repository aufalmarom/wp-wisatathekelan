<?php
/**************************************
			ANIMATED CHARTS
**************************************/
if (!function_exists('be_chart')) {
	function be_chart( $atts, $content ) {
		extract( shortcode_atts( array (
			'percentage' => '70',
			'caption' => '',
			'caption_size' => '',
			'percentage_color' => '',
			'percentage_font_size' => '',
			'caption_color' => '',
			'percentage_bar_color' => '',
			'percentage_track_color' => '',
			'percentage_scale_color' => '',
			'size' => 120,
			'linewidth' => 5,
			'icon' => 'none'
		),$atts ));
		$style = '';
		$style = ($size) ? 'style="width: '.$size.'px;height: '.$size.'px;line-height: '.$size.'px;"' : $style ;
		if(isset($icon) && !empty($icon) && $icon != 'none') {
			$icon = '<icon class="font-icon '.$icon.'"></i>';
		} else {
			$icon = '<span class="percentage">0</span>%';
		}
		return '<div class="chart-wrap oshine-module"><div class="chart" data-percent="'.$percentage.'" data-bar-color="'.$percentage_bar_color.'" data-track-color="'.$percentage_track_color.'" data-scale-color="'.$percentage_scale_color.'" data-size="'.$size.'" data-line-width="'.$linewidth.'" '.$style.'><span style="color: '.$percentage_color.'; font-size: '.$percentage_font_size.'px;">'.$icon.'</span></div><div><span style="color: '.$caption_color.'; font-size: '.$caption_size.'px;">'.$caption.'</span></div></div>';
	}
	add_shortcode( 'chart', 'be_chart' );
}

?>