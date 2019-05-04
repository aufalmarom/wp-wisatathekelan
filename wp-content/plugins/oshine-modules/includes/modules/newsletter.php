<?php
if (!function_exists('oshine_newsletter')) {
	function oshine_newsletter( $atts, $content ) {
			extract( shortcode_atts( array (
				'api_key' => '',
				'id' => '',
				'width' => '50',
				'alignment' => 'left',			
				'button_text'=>'Submit',
				'bg_color'=> '',
				'hover_bg_color'=> '',
				'color'=> '',
				'hover_color'=> '',
				'border_width' => 0,			
				'border_color'=> '',
				'hover_border_color'=> '',
		        'animate' => 0,
				'animation_type'=>'fadeIn',
	    	), $atts ));
	    	$api_key = ( isset( $api_key ) && !empty( $api_key ) ) ? $api_key : '' ;
	    	$width  = (isset($width ) && !empty( $width ) ) ? $width : '100';
	    	$alignment  = (isset($alignment ) && !empty( $alignment ) ) ? $alignment : 'left';

			if(isset($bg_color) && !empty($bg_color)) {
				$data_bg_color = 'data-bg-color="'.$bg_color.'"';
			} else {
				$data_bg_color = 'data-bg-color="transparent"';
				$bg_color = 'transparent';
			}
			$data_hover_bg_color = (isset($hover_bg_color) && !empty($hover_bg_color)) ? 'data-hover-bg-color="'.$hover_bg_color.'"' : 'data-hover-bg-color="'.$bg_color.'"';
			if(isset($color) && !empty($color)) {
				$data_color = 'data-color="'.$color.'"';
			} else {
				$data_color = 'data-color="inherit"';
				$color = 'inherit';
			}
			$data_hover_color = (isset($hover_color) && !empty($hover_color)) ? 'data-hover-color="'.$hover_color.'"' : 'data-hover-color="'.$color.'"' ;
			if(isset($border_color) && !empty($border_color)) {
				$data_border_color = 'data-border-color="'.$border_color.'"';
			} else {
				$data_border_color = 'data-border-color="transparent"';
				$border_color = 'transparent';
			}	
			$data_hover_border_color = (isset($hover_border_color) && !empty($hover_border_color)) ? 'data-hover-border-color="'.$hover_border_color.'"' : 'data-hover-border-color="'.$border_color.'"';
			$border_width = (!isset($border_width) || empty($border_width) || $border_width == '0') ? 0 : $border_width;
			$border_style = 'border-style: solid; border-width:'.$border_width.'px; border-color: '.$border_color;

	    	$id = ( isset( $id ) && !empty( $id ) ) ? $id : '' ;
	    	$animate = ( isset( $animate ) && 1 == $animate ) ? 'tatsu-animate' : 0 ;
			$output = '';
	    	$output .= '<div class="oshine-mc-wrap oshine-module align-'.$alignment.' '.$animate.' clearfix" data-animation="'.$animation_type.'">';
	    	$output .= '<form method="POST" class="oshine-mc-form">';
	    	$output .= '<div class="clearfix">';
	    	$output .= '<input type="hidden" name="api_key" value="'.$api_key.'" /><input type="hidden" name="list_id" value="'.$id.'" />';
			$output .= '<fieldset class="contact_fieldset oshine-mc-field" style="width: '.$width.'%;"><input type="text" name="email" placeholder="'.__('Email','oshine-module').'" /><div class="clear"></div></fieldset>';
			$output .= '<fieldset class="contact_fieldset oshine-mc-submit-wrap"><input type="submit" name="submit" value="'.$button_text.'" class="oshine-mc-submit oshine-module tatsu-button" style= "'.$border_style.';background-color: '.$bg_color.'; color: '.$color.';" '.$data_bg_color.' '.$data_hover_bg_color.' '.$data_color.' '.$data_hover_color.' '.$data_border_color.' '.$data_hover_border_color.'/><div class="subscribe_loader"><div class="tatsu-icon loader-style4-wrap loader-icon"></div></div></fieldset>';
			$output .= '</div>';
			$output .= '<div class="subscribe_status tatsu-notification"></div>';
			$output .= '</form>';
	        $output .= '</div>';
	        return $output;
	}
	add_shortcode( 'newsletter', 'oshine_newsletter' );
}

?>