<?php
/**************************************
			TESTIMONIALS
**************************************/
if (!function_exists('be_testimonials')) {	
	function be_testimonials( $atts, $content ){
		global $be_themes_data;
		extract( shortcode_atts( array (
			'testimonial_font_size' => '14',
			'author_role_font' => 'body',
			'alignment' => 'center',
			'slide_animation_type' => 'slide',
			'slide_show' => '0',
			'slide_show_speed' => 4000,
			'animate' => 0,
			'pagination' => 0,
			'animation_type' => 'fadeIn',
		), $atts ) );
		$GLOBALS['testimonial_font_size_global'] = 	$testimonial_font_size;
		$GLOBALS['author_role_font_global'] = $author_role_font;
		$animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : '' ;
		$slide_animation_type = ( isset( $slide_animation_type ) && !empty($slide_animation_type) ) ? $slide_animation_type : 'slide' ;
		$slide_show = ( !empty( $slide_show ) ) ? 1 : 0;
		$slide_show_speed = ( !empty( $slide_show_speed ) ) ? $slide_show_speed : 4000 ;
		$alignment = (isset( $alignment ) && !empty( $alignment )) ? $alignment : 'center';
		$pagination = (empty($pagination) || (!empty($pagination) && $pagination == 0)) ? '0' : '1' ; 
		$return = '<div class="testimonials_wrap oshine-module '.$animate.'" data-animation="'.$animation_type.'" ><div class="testimonials-slides"><div class="clearfix testimonial_module slides '.$alignment.'-content" data-slide-show="'.$slide_show.'" data-slide-show-speed="'.$slide_show_speed.'" data-slide-animation-type="'.$slide_animation_type.'" data-pagination="'.$pagination.'">'.do_shortcode( $content ).'</div></div></div>';		
		return $return;	
	}	
	add_shortcode( 'testimonials', 'be_testimonials' );
}

if (!function_exists('be_testimonial')) {	
	function be_testimonial( $atts, $content ) {
		extract( shortcode_atts( array (
			'author_image' => '',
			'quote_color'=> '',
			'author' => '',
			'author_color'=> '',
			'author_role' => '',
			'author_role_color' => ''
		), $atts ) );
		$content= do_shortcode($content);		
		extract($atts);
		if(isset($GLOBALS['author_role_font_global'])) {
			if ('h6' == $GLOBALS['author_role_font_global']){
				$author_role_font_style = 'h6-font';
			} elseif ('special' == $GLOBALS['author_role_font_global']){
				$author_role_font_style = 'special-subtitle';
			} else {
				$author_role_font_style = '';
			}
		} else {
			$author_role_font_style = '';
		}
		if(isset($GLOBALS['testimonial_font_size_global'])) {
			$global_testimonial_font_size = $GLOBALS['testimonial_font_size_global'];
		} else {
			$global_testimonial_font_size = '';
		}
		$output = '';
		$quote_color = (isset( $quote_color ) && !empty( $quote_color )) ? 'style="color:'.$quote_color.';"' : '';
		$author_color = (isset( $author_color ) && !empty( $author_color )) ? 'style="color:'.$author_color.';"' : '';
		$alt_text = $author;
		$author = (isset( $author ) && !empty( $author )) ? '<h6 class="testimonial-author" '.$author_color.'>'.$author.'</h6>' : '';
		$author_role_color = (isset( $author_role_color ) && !empty( $author_role_color )) ? 'style="color:'.$author_role_color.';"' : '';
		$author_role = (isset( $author_role ) && !empty( $author_role )) ? '<div class="testimonial-author-role '.$author_role_font_style.'"  '.$author_role_color.'>'.$author_role.'</div>' : '';
		if ( !empty( $author_image ) ) {
			//$attachment_info = wp_get_attachment_image_src( $author_image, 'thumbnail' );
			//$attachment_url = $attachment_info[0];
			//$attachment_url = oshine_get_image_from_url( $author_image, 'thumbnail' );
			//if( $attachment_url ) {
				$author_image =  '<div class="testimonial-author-img"><img src="'.$author_image.'" alt="'.$alt_text.'" /></div>';
			//}
		}
		$output .= '<div class="testimonial_slide slide clearfix"><div class="testimonial_slide_inner">';
		$output .= '<i class="font-icon icon-quote" '.$quote_color.'></i>';
		$output .= '<p style= "font-size: '.$global_testimonial_font_size.'px;" class="testimonial-content">'.$content.'</p>';
		$output .= '<div class="testimonial-author-info-wrap clearfix">';
		$output .= $author_image;
		$output .= '<div class="testimonial-author-info">';
		$output .= $author;
		$output .= $author_role;
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div></div>';
		return $output;
	}	
	add_shortcode( 'testimonial', 'be_testimonial' );
}

?>