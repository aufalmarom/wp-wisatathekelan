<?php
/**************************************
			LIGHTBOX IMAGE
**************************************/
if ( ! function_exists( 'be_lightbox_image' ) ) {
	function be_lightbox_image( $atts, $content ){
		extract( shortcode_atts( array(
			'image'=>'',
			'link'=>'',
		), $atts ) );

		$output = '';
		$full = wp_get_attachment_image_src( $image, 'full' );
		$attachment_thumb_url = $full[0];
		$attachment_full_url = $full[0];
		$video_url = get_post_meta( $image, 'be_themes_featured_video_url', true );
		$mfp_class='mfp-image';
		if( ! empty( $video_url ) ) {
			$attachment_full_url = $video_url;
			$mfp_class = 'mfp-iframe';
		}	
		$output .= '<div class="element-inner oshine-module">';
		$output .='<div class="thumb-wrap"><img src="'.$attachment_thumb_url.'" alt />';
						$output .='<div class="thumb-overlay"><div class="thumb-bg">';
						$output .='<div class="thumb-icons">';
						$output .= ( ! empty( $link ) ) ? '<a href="'.$link.'"><i class="font-icon icon-link"></i></a>' : '' ;
						$output .='<a href="'.$attachment_full_url.'" class="image-popup-vertical-fit '.$mfp_class.'"><i class="font-icon icon-search"></i></a>';
						$output .= '</div>'; // end thumb icons								
						$output .='</div></div>';//end thumb overlay & bg
						$output .='</div>';//end thumb wrap
						$output .='</div>';
		return $output;
	}
	add_shortcode('lightbox_image','be_lightbox_image');
}
?>