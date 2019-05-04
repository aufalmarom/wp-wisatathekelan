<?php

/**************************************
			TEAM
**************************************/
if ( ! function_exists( 'be_team' ) ) {
	function be_team( $atts, $content ) {
		global $be_themes_data;
		extract( shortcode_atts( array( 
			'title'=>'',
			'h_tag'=>'h6',
			'description'=>'',
			'designation'=>'',
			'image'=>'',
			'title_color'=> '',
			'description_color'=> '',
			'designation_color'=> '',			
			'facebook'=>'',
			'twitter'=>'',
			'dribbble'=>'',
			'google_plus'=>'',
			'linkedin'=>'',
			'youtube'=>'',
			'vimeo'=>'',
			'email'=> '',
			'icon_color'=> '',
			'icon_hover_color'=> '',
			'icon_bg_color'=> '',
			'icon_hover_bg_color'=> '',
			'hover_style' => 'style1-hover',
			'title_style' => 'style3',
			'smedia_icon_position' => 'over',
			'title_alignment_static' => '',
			'default_image_style' => 'color',
			'hover_image_style' => 'color',
			'image_effect' => 'none',
			'overlay_color' => $be_themes_data['color_scheme'],
			//'overlay_opacity' => '85',
			//'overlay_transparent' => 0,
			'animate'=>0,
	        'animation_type'=>'fadeIn',
		),$atts ) );

		$output = '';
		//$url = wp_get_attachment_image_src( $image, 'portfolio-masonry' );
		$animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : '';
		$style = 'style="';
		if( isset($icon_color) && !empty($icon_color) ) {
			$style .= 'color: '.$icon_color.';';
			$icon_default_color = 'data-color="'.$icon_color.'"';
		} else {
			$icon_default_color = 'data-color="inherit"';
			$icon_color = 'inherit';
		}
		if( isset($icon_bg_color) && !empty($icon_bg_color) ) {
			$style .= 'background-color: '.$icon_bg_color.';';
			$icon_default_bg_color = 'data-bg-color="'.$icon_bg_color.'"';
		} else {
			$icon_default_bg_color = 'data-bg-color="transparent"';
			$icon_bg_color = 'transparent';
		}
		$style .= '"';
		$hover_style = ((!isset($hover_style)) || empty($hover_style)) ? 'style1-hover' : $hover_style;
		$title_style = ((!isset($title_style)) || empty($title_style)) ? 'style3' : $title_style;
		$icon_hover_color = ( isset($icon_hover_color) && !empty($icon_hover_color) ) ? 'data-hover-color="'.$icon_hover_color.'"' : 'data-hover-color="'.$icon_color.'"' ;
		$icon_hover_bg_color = ( isset($icon_hover_bg_color) && !empty($icon_hover_bg_color) ) ? 'data-hover-bg-color="'.$icon_hover_bg_color.'"' : 'data-hover-bg-color="'.$icon_bg_color.'"' ;
		$designation_color = ( isset($designation_color) && !empty($designation_color) ) ? 'style="color: '.$designation_color.'"' : '' ;
		$description_color = ( isset($description_color) && !empty($description_color) ) ? 'style="color: '.$description_color.'"' : '' ;
		$title_color = ( $title_color ) ? 'style="color: '.$title_color.'"' : $title_color ;
		$image_effect = ((!isset($image_effect)) || empty($image_effect)) ? 'none' : $image_effect;
		$smedia_icon_position = ($title_style == 'style3') ? 'over' : $smedia_icon_position;
		if($default_image_style == 'black_white') {
			if($hover_image_style == 'black_white') {
				$img_grayscale = 'bw_to_bw';
			} else {
				$img_grayscale = 'bw_to_c';
			}
		} else {
			if($hover_image_style == 'black_white') {
				$img_grayscale = 'c_to_bw';
			} else {
				$img_grayscale = 'c_to_c';
			}
		}
		$thumb_overlay_color = '';
		if(isset($overlay_color) && !empty($overlay_color)) {
			//$overlay_color = be_themes_hexa_to_rgb( $overlay_color );
			$thumb_overlay_color =  $overlay_color; //'rgba('.$overlay_color[0].','.$overlay_color[1].','.$overlay_color[2].','.(intval($overlay_opacity) / 100 ).')';
		}
		//$thumb_overlay_color = ( isset( $overlay_transparent ) && 1 == $overlay_transparent ) ? 'transparent' : $thumb_overlay_color ;
		$thumb_img_overlay = ($title_style == 'style3') ? 'style="background: '.$thumb_overlay_color.'"' : '' ;
		$icon_overlay_bg = ($smedia_icon_position == 'over' && $title_style != 'style3') ? 'style="background: '.$thumb_overlay_color.'"' : '';
		$icon = '';
		if( ! empty( $facebook ) || ! empty( $twitter ) || ! empty( $dribbble ) || ! empty( $google_plus ) || ! empty( $linkedin ) || ! empty( $youtube ) || ! empty( $vimeo ) || ! empty( $email )){
			$icon ='<ul class="team-social clearfix '.$smedia_icon_position.'" '.$icon_overlay_bg.'>';
			$icon .= ( ! empty( $facebook ) ) ? '<li class="icon-shortcode"><a href="'.$facebook.'" class="font-icon tatsu-icon team_icons" target="_blank" '.$icon_default_bg_color.' '.$icon_default_color.' '.$icon_hover_color.' '.$icon_hover_bg_color.' '.$style.'><i class="icon-facebook"></i></a></li>' : '' ;
			$icon .= ( ! empty( $twitter ) ) ? '<li class="icon-shortcode"><a href="'.$twitter.'" class="font-icon tatsu-icon team_icons" target="_blank" '.$icon_default_bg_color.' '.$icon_default_color.' '.$icon_hover_color.' '.$icon_hover_bg_color.' '.$style.'><i class="icon-twitter"></i></a></li>' : '' ;
			$icon .= ( ! empty( $google_plus ) ) ? '<li class="icon-shortcode"><a href="'.$google_plus.'" class="font-icon tatsu-icon team_icons" target="_blank" '.$icon_default_bg_color.' '.$icon_default_color.' '.$icon_hover_color.' '.$icon_hover_bg_color.' '.$style.'><i class="icon-gplus"></i></a></li>' : '' ;
			$icon .= ( ! empty( $linkedin ) ) ? '<li class="icon-shortcode"><a href="'.$linkedin.'" class="font-icon tatsu-icon team_icons" target="_blank" '.$icon_default_bg_color.' '.$icon_default_color.' '.$icon_hover_color.' '.$icon_hover_bg_color.' '.$style.'><i class="icon-linkedin"></i></a></li>' : '' ;
			$icon .= ( ! empty( $youtube ) ) ? '<li class="icon-shortcode"><a href="'.$youtube.'" class="font-icon tatsu-icon team_icons" target="_blank" '.$icon_default_bg_color.' '.$icon_default_color.' '.$icon_hover_color.' '.$icon_hover_bg_color.' '.$style.'><i class="icon-youtube"></i></a></li>' : '' ;
			$icon .= ( ! empty( $dribbble ) ) ? '<li class="icon-shortcode"><a href="'.$dribbble.'" class="font-icon tatsu-icon team_icons" target="_blank" '.$icon_default_bg_color.' '.$icon_default_color.' '.$icon_hover_color.' '.$icon_hover_bg_color.' '.$style.'><i class="icon-dribbble"></i></a></li>' : '';
			$icon .= ( ! empty( $vimeo ) ) ? '<li class="icon-shortcode"><a href="'.$vimeo.'" class="font-icon tatsu-icon team_icons" target="_blank" '.$icon_default_bg_color.' '.$icon_default_color.' '.$icon_hover_color.' '.$icon_hover_bg_color.' '.$style.'><i class="icon-vimeo"></i></a></li>' : '';				
			$icon .= ( ! empty( $email ) ) ? '<li class="icon-shortcode"><a href="mailto:'.$email.'" class="font-icon tatsu-icon team_icons" target="_top" '.$icon_default_bg_color.' '.$icon_default_color.' '.$icon_hover_color.' '.$icon_hover_bg_color.' '.$style.'><i class="icon-email"></i></a></li>' : '';				
			$icon .='</ul>';
		}
		if($title_style == 'style5') {
			$hover_style = '';
		}
		if(isset($title_alignment_static) && !empty($title_alignment_static) && ($title_style == 'style5')) {
			$title_alignment_static = 'text-align: '.$title_alignment_static.';';
		} else {
			$title_alignment_static = '';
		}
		$output .= '<div class="team-shortcode-wrap oshine-module '.$animate.'" data-animation="'.$animation_type.'">';
			$output .= '<div class="element '.$hover_style.' '.$img_grayscale.' '.$title_style.'-title">';
				$output .= '<div class="element-inner">';
					$output .= '<div class="flip-wrap">';
						$output .= '<div class="flip-img-wrap '.$image_effect.'-effect">';
							if( !empty( $image ) ) {
								$output .= '<img src="'.$image.'" alt="'.$title.'" />';
							}
							if($smedia_icon_position == 'over' && $title_style != 'style3') {
								$output .= $icon;
							}
						$output .= '</div>';
					$output .= '</div>';
					$output .= '<div class="thumb-overlay">';
						$output .= '<div class="thumb-bg" '.$thumb_img_overlay.'>';
							$output .= '<div class="display-table"><div class="display-table-cell vertical-align-middle">';
								$output .= '<div class="team-wrap clearfix" style="'.$title_alignment_static.'">';
									$output .= '<'.$h_tag.' class="team-title" '.$title_color.'>'.$title.'</'.$h_tag.'>';
									$output .= '<p class="designation" '.$designation_color.'>'.$designation.'</p>';
									$output .= '<p class="team-description" '.$description_color.'>'.$description.'</p>';
									if($smedia_icon_position == 'below' || $title_style == 'style3') {
										$output .= $icon;
									}
								$output .= '</div>';
							$output .= '</div></div>';
						$output .= '</div>';
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>';			
		return $output;		
	}
	add_shortcode( 'team', 'be_team' );
}
?>