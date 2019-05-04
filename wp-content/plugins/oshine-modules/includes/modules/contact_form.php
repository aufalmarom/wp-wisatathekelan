<?php
/**************************************
		Contact Form
**************************************/
if ( ! function_exists( 'be_contact_form' ) ) {
	function be_contact_form($atts,$content) {
		extract( shortcode_atts( array (
			'form_style' => 'style1',
			'input_bg_color' => '',
			'input_color' => '',
		    'input_border_color' => '',
		    'border_width' => '',
		    'input_height' => '',
		    'input_style' => 'style1',
		    'input_button_style' => 'medium',
		    'bg_color' => '',
		    'color' => '',
	    ), $atts ) );
		$output = '';
		$styles = 'style="';
		$styles .= ( isset( $input_bg_color ) && !empty( $input_bg_color) ) ? 'background-color: '.$input_bg_color.';' : 'background-color: transparent;';
		$styles .= ( isset( $input_color ) && !empty( $input_color) ) ? 'color: '.$input_color.';' : '';
		$styles .= ( isset( $border_width ) ) ? 'border-width: '.$border_width.'px; border-style: solid;' : '';
		$styles .= ( isset( $input_border_color ) && !empty( $input_border_color) ) ? 'border-color: '.$input_border_color.';' : '';

		$styles_height = ( isset( $input_height ) && !empty( $input_height) ) ? 'height: '.$input_height.'px;' : '';
		$button_styles = 'style="';
		$button_styles .= ( isset( $bg_color ) && !empty( $bg_color) ) ? 'background-color: '.$bg_color.';' : '';
		$button_styles .= ( isset( $color ) && !empty( $color) ) ? 'color: '.$color.';' : '';
		$button_styles .= '"';
		$form_style =  ( isset( $form_style ) && !empty( $form_style) ) ? $form_style : 'style1';
		$input_style = ( isset( $input_style ) && !empty( $input_style) ) ? $input_style : 'style1';
		$input_button_style = ( isset( $input_button_style ) && !empty( $input_button_style) ) ? $input_button_style : 'medium';
		$output .= '<div class="contact_form contact_form_module oshine-module '.$form_style.' '.$input_style.'-input">
						<form method="post" class="contact">
							<fieldset class="field_name contact_fieldset">
								<input type="text" name="contact_name" class="txt autoclear" placeholder="'.__('Name','oshine-modules').'" '.$styles.' '.$styles_height.'" />
							</fieldset>
							<fieldset class="field_email contact_fieldset">
								<input type="text" name="contact_email" class="txt autoclear" placeholder="'.__('Email','oshine-modules').'" '.$styles.' '.$styles_height.'" />
							</fieldset>';
		if($form_style != 'style2'){
			$output .= '<fieldset class="field_subject contact_fieldset">
								<input type="text" name="contact_subject" class="txt autoclear" placeholder="'.__('Subject','oshine-modules').'" '.$styles.' '.$styles_height.'" />
						</fieldset>';
		}							
		$output .= '<fieldset class="field_comment contact_fieldset">
								<textarea name="contact_comment" class="txt_area autoclear" placeholder="'.__('Message','oshine-modules').'" '.$styles.'" ></textarea>
							</fieldset>
							<fieldset class="contact_fieldset submit-fieldset">
								<input type = "hidden" name = "contact_style" value = "'. $form_style .'"/> 
								<input type="submit" name="contact_submit" value="'.__('Submit','oshine-modules').'" class="contact_submit tatsu-button rounded '.$input_button_style.'btn" '.$button_styles.'/>
								<div class="contact_loader"><div class="font-icon loader-style4-wrap loader-icon"></div></div>
							</fieldset>
							<div class="contact_status be-notification"></div>
						</form>
					</div>';
		return $output; 
	}
	add_shortcode('contact_form','be_contact_form');
}
?>