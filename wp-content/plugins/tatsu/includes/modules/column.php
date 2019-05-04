<?php
if (!function_exists('tatsu_column')) {
	function tatsu_column( $atts, $content ) {
		//$column_atts = columns_extract($atts, $content);

		extract( shortcode_atts( array (
			'bg_color' => '',
			'bg_image' => '',
			'layout' =>'1/1',
			'gutter' => 'medium',
			'column_spacing' => '25px',
			'bg_repeat' => 'repeat',
			'bg_attachment' => 'scroll',
			'bg_position' => 'left top',
	        'bg_size' => 'initial',
			'padding' => '0px 0px 0px 0px',
			'custom_margin' => '0',
			'margin' => '',		
			'border'	=> '0 0 0 0',
			'border_color'	=> '',
			'enable_box_shadow' => 0,
			'box_shadow_custom' => '',	
			'bg_video' => 0,
	        'bg_video_mp4_src' => '',
	        'bg_video_ogg_src' => '',
	        'bg_video_webm_src' => '',
	        'bg_overlay' => 0,
			'overlay_color' => '',
			'animate_overlay' => 'none',
			'link_overlay' => '',
			'vertical_align' => 'none',
			'column_offset' => 0,
			'offset' 	=> '0px 0px',
			'z_index'	=> 0,
			'col_id' => '',
			'column_class' => '',
			'hide_in' => '',
			'animate' => 0,
	        'animation_type' => 'fadeIn',
			'animation_delay' => 0,
			'column_parallax' => 0,
		),$atts ) );
		$column_layouts = array(
			'1/1' => 'tatsu-one-col',
			'1/2' => 'tatsu-one-half',
			'1/3' => 'tatsu-one-third',
			'1/4' => 'tatsu-one-fourth',
			'1/5' => 'tatsu-one-fifth',
			'2/3' => 'tatsu-two-third',
			'3/4' => 'tatsu-three-fourth',
		);	

		$background = '';
	    $bg_video_markup = '';
	    $bg_video_class = '';
	    $bg_overlay_class = '';
	    $bg_overlay_markup = '';
		$bg_overlay_data = '';
		$column_shadow_value = '';
		$custom_gutter = '';
		$column_id = '';
	    $classes = '';
	    $output = '';


	    //Handle Styling Attributes

	    if( empty( $bg_image  ) ) {
	    	if( ! empty( $bg_color ) ) {
	    		$background = 'background-color: '.$bg_color.';';
	    	}	
	    } else {
    		$background = 'background:'.$bg_color.' url('.$bg_image.') '.$bg_repeat.' '.$bg_attachment.' '.$bg_position.';';
    		$background .= 'background-size:'.$bg_size.';';    	
	    }

	    $padding = 'padding:'.$padding.';';
	    if( !empty( $custom_margin ) && !empty( $margin ) ) {
	    	$margin = 'margin:'.$margin.';';
	    } else {
	    	$margin = '';
	    }

		$border = ( ! empty( $border_color ) ) ? 'border-width:'.$border.';border-color:'.$border_color.';border-style:solid;' : '';

		// Handle Custom Gutter

		if( 'custom' === $gutter ) {
			$column_spacing =  !empty( $column_spacing ) ? intval( $column_spacing ) : 0;
			$column_spacing = intval( $column_spacing / 2 );
			$custom_gutter = ' padding:0 '.$column_spacing.'px;';
		}	


	    // Handle BG Video
		if( isset( $bg_video ) && 1 == $bg_video ) {
			$classes .= ' tatsu-video-section';
			$bg_video_markup .= '<video class="tatsu-bg-video" autoplay="autoplay" loop="loop" muted="muted" preload="auto">';
			$bg_video_markup .=  ( !empty( $bg_video_mp4_src ) ) ? '<source src="'.$bg_video_mp4_src.'" type="video/mp4">' : '' ;
			$bg_video_markup .=  ( !empty( $bg_video_ogg_src ) ) ? '<source src="'.$bg_video_ogg_src.'" type="video/ogg">' : '' ;
			$bg_video_markup .=  ( !empty( $bg_video_webm_src ) ) ? '<source src="'.$bg_video_webm_src.'" type="video/webm">' : '' ;
			$bg_video_markup .= '</video>';
		}

		//Handle BG Overlay
		if( isset( $bg_overlay ) && 1 == $bg_overlay ) {
			$classes .= ' tatsu-bg-overlay';
			if( !empty( $animate_overlay ) ) {
				$animate_overlay = 'tatsu-animate-'.$animate_overlay;
			}
			if( empty( $overlay_color ) ) {
				$overlay_color = 'transparent';
			}
			$bg_overlay_markup .= '<div class="tatsu-overlay '.$animate_overlay.'" style="background:'.$overlay_color.';"></div>';
			$bg_overlay_markup .= !empty( $link_overlay ) ? '<a href="'.$link_overlay.'" class="tatsu-col-overlay-link"></a>': ''; 
		}

		// Background Indicator

		if( empty( $background ) && ( empty( $bg_overlay ) || 'transparent' === $overlay_color ) ) {
			$classes .= ' tatsu-column-no-bg';
		}

		if( empty( $content ) ) {
			$classes .= ' tatsu-column-empty';
		}

		if( array_key_exists( $layout , $column_layouts ) ) {
			$classes .= ' '.$column_layouts[$layout];
		}

		//Handle Column Offset 
		if( 1 == $column_offset ) {
			$offset = ( !empty( $offset ) ) ? $offset : '0px 0px';
			$col_offset_array = explode( ' ', $offset );
			$column_x_offset = isset( $col_offset_array ) && !empty( $col_offset_array[0] ) ? $col_offset_array[0] : '0px';
			$column_y_offset = isset( $col_offset_array ) && !empty( $col_offset_array[1] ) ? $col_offset_array[1] : '0px';
 			$col_offset = 'transform : translate3d(' . $column_x_offset . ',' . $column_y_offset . ',0);'; 
		}else{
			$col_offset = '';
		}

		//z-index;
		if( !empty( $z_index ) ) {
			$z_index_style = 'z-index:' . ( $z_index + 2 ) . ';';
		}else{
			$z_index_style = '';
		}

		//Column Animation 

		if( isset( $animate ) && 1 == $animate ) {
			$classes .= ' tatsu-animate';
		}

		//Column Alignment

		if( isset( $vertical_align ) && 'none' !== $vertical_align ) {
			$classes .= ' tatsu-column-align-'.$vertical_align;
		}

		//Handle Resposive Visibility controls
		if( !empty( $hide_in ) ) {
			$hide_in = explode(',', $hide_in);
			foreach ( $hide_in as $device ) {
				$classes .= ' tatsu-hide-'.$device;
			}
		}		
		
		//Column Parallax
		if( isset( $column_parallax ) && 0 != $column_parallax ){
			$classes .= ' tatsu-column-parallax';
		}

		//Column Shadow
		if( !(empty( $background ) && empty( $content )) && (isset( $enable_box_shadow ) && 1 == $enable_box_shadow) ){
			$column_shadow_value = 'box-shadow:'.$box_shadow_custom;	
		}

		//Append to custom classes 
		$column_class = !empty( $column_class ) ? str_replace(',', ' ', $column_class ) : '' ;
		$column_class = $classes.' '.$column_class;

		//Column ID
		if( !empty( $col_id ) ) {
			$column_id = 'id="'.$col_id.'"';
		}


		$output .= '<div '.$column_id.' class="tatsu-column '.$column_class.'" data-animation="'.$animation_type.'" data-animation-delay="'.$animation_delay.'" data-parallax-speed="'.$column_parallax.'" style="'.$margin.$custom_gutter.$col_offset.$z_index_style.'">';
		
		$output .= '<div class="tatsu-column-inner" style="'.$background.$border.$column_shadow_value.'">';
		$output .= '<div class="tatsu-column-pad-wrap">';
		$output .= '<div class="tatsu-column-pad" style="'.$padding.'">';
		$output .= do_shortcode( $content );
		$output .= '</div>';
		$output .= '</div>';
		$output .= $bg_video_markup.$bg_overlay_markup;			
		$output .= '</div>';
		$output .= '</div>';
		return $output;
	}


	add_shortcode( 'one_col', 'tatsu_column' );
	add_shortcode( 'tatsu_column', 'tatsu_column' );
	add_shortcode( 'tatsu_column1', 'tatsu_column' );

	add_shortcode( 'one_half', 'tatsu_column' );
	add_shortcode( 'one_third', 'tatsu_column' );
	add_shortcode( 'one_fourth', 'tatsu_column' );
	add_shortcode( 'one_fifth', 'tatsu_column' );
	add_shortcode( 'two_third', 'tatsu_column' );
	add_shortcode( 'three_fourth', 'tatsu_column' );
	add_shortcode( 'tatsu_inner_column', 'tatsu_column' );

}

?>