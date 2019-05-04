<?php
if ( !function_exists('tatsu_video') ) {
	function tatsu_video( $atts, $content ) {
		extract(shortcode_atts( array(
			'source'=>'youtube',
	        'url'=>'',
			'animate'=>0,
	        'animation_type'=>'fadeIn',
	    ),$atts ) );
		$output ='';
	    switch ( $source ) {
	    	case 'youtube':
	    		$output .= ( isset( $animate ) && 1 == $animate ) ? '<div class="tatsu-animate" data-animation="'.$animation_type.'">' : '' ;
				$output .= '<div class="tatsu-module tatsu-video tatsu-youtube-wrap">'.tatsu_youtube( $url ).'</div>';
				$output .= ( isset( $animate ) && 1 == $animate ) ? '</div>' : '' ;
				
				return $output;
	    		break;
	    	default:
	    		$output .= ( isset( $animate ) && 1 == $animate ) ? '<div class="tatsu-animate" data-animation="'.$animation_type.'">' : '' ; 
				$output .= '<div class="tatsu-module tatsu-video tatsu-vimeo-wrap">'.tatsu_vimeo( $url ).'</div>';
				$output .= ( isset( $animate ) && 1 == $animate ) ? '</div>' : '' ;
				
				return $output;
	    		break;
	    }
	}
	add_shortcode( 'tatsu_video', 'tatsu_video' );
}
if ( !function_exists('tatsu_youtube') ) {
	function tatsu_youtube( $url ) {
		$video_id = '';
		if( ! empty( $url ) ) {
			$video_id = ( preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match ) ) ? $match[1] : '' ;		
			return '<iframe class="youtube" id="tatsu-youtube-'.$video_id.'" src="https://youtube.com/embed/'.$video_id.'?rel=0&wmode=transparent" allowfullscreen></iframe>';		
		} else {
			return '';
		}

	}
}

/**************************************
			VIDEO - VIMEO
**************************************/
if ( !function_exists( 'tatsu_vimeo' ) ) {
	function tatsu_vimeo( $url ) {
		$video_id = '';
		if( ! empty( $url ) ) {
			sscanf(parse_url($url, PHP_URL_PATH), '/%d', $video_id);
			return '<iframe src="https://player.vimeo.com/video/'.$video_id.'?api=1" id="tatsu-vimeo-'.$video_id.'" class="tatsu-vimeo-video" allowfullscreen></iframe>';
		} else {
			return '';
		}
	}
}

?>