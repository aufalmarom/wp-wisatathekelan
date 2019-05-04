<?php
if (!function_exists('tatsu_section')) {
	function tatsu_section( $atts, $content ) {
		extract( shortcode_atts( array(
	        'bg_color' => '',
	        'bg_image' => '',
	        'bg_repeat' => 'repeat',
	        'bg_attachment' => 'scroll',
	        'bg_position' => 'left top',
	        'bg_size' => 'initial',
	        'bg_animation' => 'none',
	        'border' => '0px 0px 0px 0px',
	        'border_color' => '',
	        'padding' => '0px 0px 0px 0px',
	        'margin' => '0px 0px 0px 0px',
	        'offset_section' => 0,
	        'offset_value' => '',
	        'bg_video' => 0,
	        'bg_video_mp4_src' => '',
	        'bg_video_ogg_src' => '',
	        'bg_video_webm_src' => '',
			'bg_overlay' => 0,
			'overlay_color' => '',
			'overlay_opacity' => '',
			'section_id' => '',
			'section_class' => '',
			'section_title' => '',
			'full_screen' => 0,
			'full_screen_header_scheme' => 'background--dark',
			'hide_in' => '',
	    ),$atts));

	    $background = '';
	    $bg_video_markup = '';
	    $bg_video_class = '';
	    $bg_overlay_class = '';
	    $bg_overlay_markup = '';
	    $fullscreen_wrap_start = '';
	    $fullscreen_wrap_end = '';
	    $fullscreen_class = '';
		$offset_section_class = '';
	    $offset_wrapper_start = '';
	    $offset_wrapper_end = '';
	    $parallax_markup = '';
	    $hover_3d_wrap_start = '';
	    $hover_3d_wrap_end = ''; 
	    $classes = '';	    
	    $output = '';

	    //$hide_mobile = (isset($hide_mobile) && $hide_mobile == 1) ? 'hide-mobile' : '';

	    if( !isset($bg_animation) || empty($bg_animation) || $bg_animation == 'none' ) {
	    	$bg_animation = '';
	    } else {
	    	$classes .= ' '.$bg_animation;
	    }

		if( 'tatsu-parallax' == $bg_animation ) {
			$bg_repeat = 'no-repeat';
			$bg_size = 'cover';
			$bg_attachment = 'scroll';
			$bg_position = 'center center';
		}  

	    //Handle Styling Attributes
		
		$bg_color_value = computeCSSfromArg($bg_color);
	    if( empty( $bg_image  ) ) {
	    	// if( ! empty( $bg_color_value ) ) {
	    		$background = 'background: '.$bg_color_value[0].';';
	    	// }	
	    } else {
    		$background = 'background:'.$bg_color_value[1].' url('.$bg_image.') '.$bg_repeat.' '.$bg_attachment.' '.$bg_position.';';
    		$background .= 'background-size:'.$bg_size.';';    	
	    }
		
	    $border = ( ! empty( $border_color ) ) ? 'border-width:'.$border.';border-color:'.$border_color.';border-style:solid;' : '';
	    if( !empty( $margin ) ) {
	    	$margin = 'margin:'.$margin.';';
	    }	    
	    $padding_top = explode(' ', $padding );
	    $padding = 'padding:'.$padding.';';
	    

	    //Handle Parallax
	    if( 'tatsu-parallax' == $bg_animation ) {
	    	//$classes .= ' tatsu-parallax';
	    	$parallax_markup = '<div class="tatsu-parallax-element-wrap"><div class="tatsu-parallax-element" style="'.$background.'"></div></div>';
	    	$background = '';
	    }

	    if( 'tatsu-3d-hover' == $bg_animation ) {
	    	$hover_3d_wrap_start = '<div class="tilter">';
	    	$hover_3d_wrap_end = '</div>';
	    	$classes .= ' tilter__figure';
	    }


	    //Handle Full Screen Section
	    if( ( isset( $full_screen ) && 1 == $full_screen ) ) {
	    	$classes .= ' tatsu-fullscreen';
	    	$fullscreen_wrap_start = '<div class="tatsu-fullscreen-wrap">';
	    	$fullscreen_wrap_end = '</div>';
	    }

	    // Handle Section Offset
	    if( isset($offset_section) && 1 == $offset_section && !empty( $offset_value ) ){
	    	$classes .= ' tatsu-section-offset';
	    	$padding_array = explode(' ', $padding );
	    	$padding = 'padding-right:'.$padding_array[1].';padding-left:'.$padding_array[3].';';
	    	$offset_value = "transform:translateY(-".$offset_value.") ; -moz-transform: translateY(-".$offset_value."px); -ms-transform: translateY(-".$offset_value."px);  -o-transform:translateY(-".$offset_value."px); -webkit-transform:translateY(-".$offset_value."px);";
	    	$offset_wrapper_start = '<div class="tatsu-section-offset-wrap" style="'.$offset_value.'" >';
	    	$offset_wrapper_end = '</div>';
	    }


	    // Handle BG Video
		if( isset( $bg_video ) && 1 == $bg_video ) {
			$classes .= ' tatsu-video-section';
			$bg_video_markup .= '<video class="tatsu-bg-video" autoplay="autoplay" loop="loop" muted="muted" preload="auto">';
			$bg_video_markup .=  ($bg_video_mp4_src) ? '<source src="'.$bg_video_mp4_src.'" type="video/mp4">' : '' ;
			$bg_video_markup .=  ($bg_video_ogg_src) ? '<source src="'.$bg_video_ogg_src.'" type="video/ogg">' : '' ;
			$bg_video_markup .=  ($bg_video_webm_src) ? '<source src="'.$bg_video_webm_src.'" type="video/webm">' : '' ;
			$bg_video_markup .= '</video>';
		}

		//Handle BG Overlay
		if( isset( $bg_overlay ) && 1 == $bg_overlay ) {
			$classes .= ' tatsu-bg-overlay';
			$overlay_color_value = computeCSSfromArg($overlay_color);
			$bg_overlay_markup .= '<div class="tatsu-overlay" style="background: '.$overlay_color_value[0].';"></div>';
		}

		//Handle Resposive Visibility controls
		if( !empty( $hide_in ) ) {
			$hide_in = explode(',', $hide_in);
			foreach ( $hide_in as $device ) {
				$classes .= ' tatsu-hide-'.$device;
			}
		}
					

		//Append to custom classes 
		$section_class = !empty($section_class) ? str_replace(',', ' ', $section_class) : '' ;
		$section_class = $classes.' '.$section_class;

		if( !empty( $section_id ) ) {
			$section_id = 'id="'.$section_id.'"';
		}

		$output .= $hover_3d_wrap_start;
	    $output .= '<div '.$section_id.' class="tatsu-section '.$section_class.' tatsu-clearfix" style="'.$background.$border.$margin.'" data-title="'.$section_title.'" data-headerscheme="'.$full_screen_header_scheme.'">';
	    $output .= $fullscreen_wrap_start;   
	    $output .= '<div class="tatsu-section-pad clearfix" style="'.$padding.'" data-padding-top="'.$padding_top[0].'">';
	    $output .= $offset_wrapper_start;	
	    $output .= do_shortcode( $content );
		$output .= $offset_wrapper_end;
		$output .= '</div>';
		$output .= $parallax_markup;
		$output .= $bg_video_markup;				
		$output .= $bg_overlay_markup;		
		$output .= $fullscreen_wrap_end;
	    $output .= '</div>';
	    $output .= $hover_3d_wrap_end;
	    return $output;
	}
	add_shortcode( 'tatsu_section', 'tatsu_section' );
	add_shortcode( 'section', 'tatsu_section' );
}
?>