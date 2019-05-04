<?php
/**************************************
			BUBBLE TESTIMONIAL
**************************************/
if (!function_exists('tatsu_testimonial')) {	
	function tatsu_testimonial( $atts ) {
		extract( shortcode_atts( array (
			'description' => '',
			'content_color' => '',
			'bg_color' => '',
			'author_image' => '',
			'author' => '',
			'author_color'=> '',
			'author_role' => '',
			'author_role_color' => '',
			'alignment' => 'center'
		), $atts ) );	
		$output = '';
		
		$bg_color_style = (isset( $bg_color ) && !empty( $bg_color )) ? 'background-color:'.$bg_color.';' : '';
		$content_color_style = (isset( $content_color ) && !empty( $content_color )) ? 'color:'.$content_color.';' : '';
		$bubble_color_style = (isset( $bg_color ) && !empty( $bg_color )) ? 'border-color:'.$bg_color.';' : '';
		$author_color = (isset( $author_color ) && !empty( $author_color )) ? 'style="color:'.$author_color.';"' : '';
		$alt_text = $author;
		$author = (isset( $author ) && !empty( $author )) ? '<h6 class="tatsu_testimonial_author" '.$author_color.'>'.$author.'</h6>' : '';
		$author_role_color = (isset( $author_role_color ) && !empty( $author_role_color )) ? 'style="color:'.$author_role_color.';"' : '';
		$author_role = (isset( $author_role ) && !empty( $author_role )) ? '<div class="tatsu_testimonial_role"  '.$author_role_color.'>'.$author_role.'</div>' : '';
		$alignment = (isset($alignment) && !empty($alignment)) ? $alignment : 'center';
		if ( !empty( $author_image ) ) {
			//$author_image = tatsu_get_image_from_url( $author_image, 'thumbnail' );
			$author_image =  '<div class="tatsu_testimonial_img"><img src="'.$author_image.'" alt="'.$alt_text.'" /></div>';
		}
		$output .= '<div class="tatsu_testimonial_wrap clearfix bubble_'.$alignment.'"><div class="tatsu_testimonial_wrap"><div class="tatsu_testimonial_inner_wrap" style="'.$bubble_color_style.'">';
		$output .= '<i style="'.$content_color_style.'" class="tatsu-icon icon-quote"></i>';
		$output .= '<p style="'.$bg_color_style.' '.$content_color_style.'" class="tatsu_testimonial_content">'.$description.'</p>';
		$output .= '</div></div>';
		$output .= '<div class="tatsu_testimonial_info_wrap clearfix">';
		$output .= $author_image;
		$output .= '<div class="tatsu_testimonial_info">';
		$output .= $author;
		$output .= $author_role;
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
		return $output;
	}	
	add_shortcode( 'tatsu_testimonial', 'tatsu_testimonial' );
}
?>