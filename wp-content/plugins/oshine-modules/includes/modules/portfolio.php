<?php
/**************************************
			PORTFOLIO
**************************************/
if (!function_exists('be_portfolio')) {
	function be_portfolio( $atts ) {
		global $be_themes_data;
		extract( shortcode_atts( array (
			'col' => 'three',
			'gutter_style' => 'style1',
			'gutter_width' => 40,
	        'show_filters' => '1',
	        'tax_name' => 'portfolio_categories',
	        'filter' => 'categories',        
	        'category' => '',
	        'items_per_page' => '-1',
			'masonry' => '0',
			'maintain_order' => '0',
			'gallery' => '0',
			'pagination' => 'none',
			'initial_load_style' => 'none',
			'item_parallax' => 0,
			'prebuilt_hover' => 0,
			'prebuilt_hover_style' => 'style1',
			'hover_style' => 'style1-hover',
			'title_alignment_static' => '',
			'overlay_color' => $be_themes_data['color_scheme'],
			'gradient_color' => $be_themes_data['color_scheme'],
			'gradient' => '0',
			'gradient_direction' => 'bottom',
			'overlay_opacity' => '85',
			'show_overlay' => '',
			'title_style' => 'style1',
			'title_color' => '',
			'cat_color' => '',
			'placeholder_color' => '',
			'cat_hide' => 0,
			'default_image_style' => 'color',
			'hover_image_style' => 'color',
			'title_animation_type' => 'none',
			'cat_animation_type' => 'none',
			'image_effect' => 'none',
			'lazy_load' => 0,
			'delay_load' => 0,
			'delay' => '200',
			'like_button' => 0,
	    ) , $atts ) );
		$lazy_load = (isset($lazy_load) && !empty($lazy_load) && intval($lazy_load) != 0) ? $lazy_load : 0;
		$prebuilt_hover_color_style1 = 'rgba(0, 0, 0, 0.5);';
		$delay_load = (isset($delay_load) && !empty($delay_load) && intval($delay_load) != 0) ? $delay_load : 0;
	    $delay_load_class = ( !empty( $delay_load ) ) ? 'portfolio-delay-load ' : '';
		$init_image_load = '';
	    $lazy_load_class = ( !empty( $lazy_load ) ) ? 'portfolio-lazy-load ' : '';
		$enable_data_src = ( ( !( wp_doing_ajax() || ( defined('REST_REQUEST') && REST_REQUEST ) ) && $lazy_load ) ) ? 1 : 0;
		$output = $global_thumb_overlay_color = $thumb_overlay_color = $global_gradient_style_color = $gradient_style_color = '';
		$col = ((!isset($col)) || empty($col)) ? 'three' : $col;
		$gutter_style = ((!isset($gutter_style)) || empty($gutter_style)) ? 'style1' : $gutter_style;
		$gutter_width = ( isset( $gutter_width ) ) ? intval( $gutter_width ) : intval(40);
		$masonry_enable = ((!isset($masonry)) || empty($masonry)) ? 'masonry_disable' : 'masonry_enable';
		$maintain_order = ( isset( $maintain_order ) && !empty( $maintain_order ) ) ? 1 : 0;
		$prebuilt_hover = (!isset($prebuilt_hover) || empty($prebuilt_hover)) ? intval(0) : intval(1);
		if( 1 != $prebuilt_hover ) {
			$prebuilt_hover_style = '';
		}else{
			$prebuilt_hover_style = (!isset($prebuilt_hover_style) || empty($prebuilt_hover_style)) ?  'style1' : $prebuilt_hover_style;
		}
		$show_filters = ( !empty( $show_filters ) ) ? 'yes' : 'no';
		$tax_name = ((!isset($tax_name)) || empty($tax_name)) ? 'portfolio_categories' : $tax_name;
		$filter_to_use = ((!isset($filter)) || empty($filter)) ? 'categories' : $filter;
		$items_per_page = ((!isset($items_per_page)) || empty($items_per_page)) ? '-1' : $items_per_page;
		$pagination = ( (!isset($pagination)) || empty($pagination) ) ? 'none' : $pagination;
		$default_image_style = ((!isset($default_image_style)) || empty($default_image_style)) ? 'color' : $default_image_style;
		$hover_image_style = ((!isset($hover_image_style)) || empty($hover_image_style)) ? 'color' : $hover_image_style;
		$title_animation_type = ((!isset($title_animation_type)) || empty($title_animation_type)) ? 'none' : $title_animation_type;
		$cat_animation_type = ((!isset($cat_animation_type)) || empty($cat_animation_type)) ? 'none' : $cat_animation_type;
		$image_effect = (!isset($image_effect) || empty($image_effect) || 1 == $prebuilt_hover) ? 'none' : $image_effect;
		$initial_load_style = ((!isset($initial_load_style)) || empty($initial_load_style)) ? 'none' : $initial_load_style;
		$gradient_direction = ((!isset($gradient_direction)) || empty($gradient_direction)) ? 'bottom' : $gradient_direction;
		$global_title_color = $title_color = (isset($title_color) && !empty($title_color)) ? $title_color : '';
		$global_cat_color = $cat_color = (isset($cat_color) && !empty($cat_color)) ? $cat_color : '';
		$placeholder_color = ( isset( $placeholder_color ) && !empty( $placeholder_color ) ) ? $placeholder_color : '';
		$cat_hide = (isset($cat_hide) && !empty($cat_hide) && intval($cat_hide) != 0) ? $cat_hide : 0;
		$item_parallax = (isset($item_parallax) && !empty($item_parallax) && intval($item_parallax) != 0) ? 'portfolio-item-parallax' : '';
		$show_overlay = ( !empty( $show_overlay ) ) ? 'force-show-thumb-overlay' : '';
		if( 1 == $prebuilt_hover ) {
			$title_style = '';
		}
		$hover_style = ((!isset($hover_style)) || empty($hover_style) )  ? 'style1-hover' : $hover_style;
		$hover_style = (($show_overlay == 'force-show-thumb-overlay') || ($title_style == 'style5') || ($title_style == 'style6') || ($title_style == 'style7') || (1 == $prebuilt_hover)) ? '' : $hover_style;
		$filter_style = (isset($be_themes_data['portfolio_filter_style']) && !empty($be_themes_data['portfolio_filter_style']) ) ? $be_themes_data['portfolio_filter_style'] : 'border' ;
		$filter_alignment = (isset($be_themes_data['portfolio_filter_alignment']) && !empty($be_themes_data['portfolio_filter_alignment']) ) ? $be_themes_data['portfolio_filter_alignment'] : 'center' ;
		if( $lazy_load && 'none' != $pagination ) {
			$pagination = 'none';
		}
		if( '' != $delay_load_class && 'none' != $initial_load_style ) {
			if( 'init-slide-left' == $initial_load_style ) {
				$init_image_load = 'fadeInLeft';
			}else if( 'init-slide-right' == $initial_load_style ) {
				$init_image_load = 'fadeInRight';
			}else if( 'init-slide-top' == $initial_load_style ) {
				$init_image_load = 'fadeInDown';
			}else if( 'init-slide-bottom'== $initial_load_style ) {
				$init_image_load = 'fadeInUp';
			}else if( 'init-scale' == $initial_load_style ){	
				$init_image_load = 'zoomIn';
			}else{
				$init_image_load = $initial_load_style;
			}
		}else if( '' != $delay_load_class && 'none' == $initial_load_style ) {
			$init_image_load = 'fadeIn';
			$initial_load_style = 'fadeIn';
		}
		if( 1 == $prebuilt_hover || $show_overlay != ''){
			$title_animation_type = 'none';
			$cat_animation_type = 'none';
		}
		if(isset($title_alignment_static) && !empty($title_alignment_static) && ($title_style == 'style5' || $title_style == 'style6')) {
			$title_alignment_static = 'text-align: '.$title_alignment_static.';';
		} else {
			$title_alignment_static = '';
		}
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
		if($gutter_style == 'style2') {
			$portfolio_wrap_style = 'style="margin-left: -'.$gutter_width.'px;"';
		} else {
			$portfolio_wrap_style = 'style="margin-right: '.$gutter_width.'px;"';
		}
		if(isset($overlay_opacity) && !empty($overlay_opacity)) {
			$global_overlay_opacity = $overlay_opacity = $overlay_opacity;
		} else {
			$global_overlay_opacity = $overlay_opacity = 85;
		}
		if(isset($overlay_color) && !empty($overlay_color)) {
			if( $gradient && 'style1' != $prebuilt_hover_style && 'style3' != $prebuilt_hover_style ) {
				if(!isset($gradient_color) && empty($gradient_color)) {
					$gradient_color = $overlay_color;
				} 
				$global_gradient_style_color = $gradient_style_color = 'background-image: -o-linear-gradient('.$gradient_direction.', '.$overlay_color.' 0%, '.$gradient_color.' 100%);background-image: -moz-linear-gradient('.$gradient_direction.', '.$overlay_color.' 0%, '.$gradient_color.' 100%);background-image: -webkit-linear-gradient('.$gradient_direction.', '.$overlay_color.' 0%, '.$gradient_color.' 100%);background-image: -ms-linear-gradient('.$gradient_direction.', '.$overlay_color.' 0%, '.$gradient_color.' 100%);background-image: linear-gradient(to '.$gradient_direction.', '.$overlay_color.' 0%, '.$gradient_color.' 100%);';
			} else {
				$global_gradient_style_color = $gradient_style_color = 'background:'.$overlay_color;
			}
		}
		$aspect_ratio = !empty( $be_themes_data['portfolio_aspect_ratio'] ) ? $be_themes_data['portfolio_aspect_ratio'] : '1.6';
		$placeholder_padding = ( 1/$aspect_ratio ) * 100;
		$output .= '<div class="portfolio-all-wrap oshine-portfolio-module"><div class="portfolio '. $delay_load_class .'full-screen '. ( ( 1 == $prebuilt_hover ) ? ( 'be-portfolio-prebuilt-hover-' . $prebuilt_hover_style . ' ' ) : ' ' ) . $lazy_load_class .'full-screen-gutter '.$masonry_enable.' '.$gutter_style.'-gutter '.$col.'-col " ' . ( '' != $init_image_load ? 'data-animation = "'.$init_image_load.'"' : '' ) . ' data-action="get_ajax_full_screen_gutter_portfolio" data-category="'.$category.'" data-aspect-ratio = "'.$aspect_ratio.'" data-enable-masonry="'.$masonry.'" ' . ( $maintain_order ? 'data-maintain-order = "1" ' : '' ) . 'data-showposts="'.$items_per_page.'" data-paged="2" data-col="'.$col.'" data-gallery="'.$gallery.'" data-filter="'.$filter_to_use.'" data-show_filters="'.$show_filters.'" data-thumbnail-bg-color="'.$global_thumb_overlay_color.'" data-thumbnail-bg-gradient="'.$gradient_style_color.'"' . ( ( '' != $title_style ) ? ( ' data-title-style="'.$title_style.'"' ) : '' ) . ( ( $lazy_load || $delay_load ) ? ( ' data-placeholder-color="' . $placeholder_color . '"' ) : '' ) . ' data-cat-color="'.$cat_color.'" data-title-color="'.$title_color.'"' . ( ( 'none' != $title_animation_type ) ? ( ' data-title-animation-type="'.$title_animation_type.'"' ) : '' ) . ( ( 'none' != $cat_animation_type ) ? ( ' data-cat-animation-type="'.$cat_animation_type.'"' ) : '' ) . ( ( '' != $hover_style ) ? ( ' data-hover-style="'.$hover_style.'"' ) : '' ) . ' data-gutter-width="'.$gutter_width.'" data-img-grayscale="'.$img_grayscale.'"' . ( ( 'none' != $image_effect ) ? ( ' data-image-effect="'.$image_effect.'"' ) : '' ) . ( ( '' != $prebuilt_hover_style ) ? ( ' data-prebuilt-hover-style="' . $prebuilt_hover_style . '"' ) : '' ) . '" data-gradient-style-color="'.$global_gradient_style_color.'" data-cat-hide="'.$cat_hide.'" data-like-indicator="'.$like_button.'" '.$portfolio_wrap_style.'>';
		$category = explode(',', $category);
		
		if($filter_to_use == 'portfolio_tags' || empty( $category ) ) {
			// $terms = get_terms( $filter_to_use , array( 'orderby' => 'count' , 'order' => 'DESC') );
			$terms = get_terms( $filter_to_use );
		} else {
	 	 	$args_cat = array( 'taxonomy' => 'portfolio_categories' ) ;
	 	 	
			$stack = array();
			foreach(get_categories( $args_cat ) as $single_category ) {
				if ( in_array( $single_category->slug, $category ) ) {
					array_push( $stack, $single_category->cat_ID );
				}
			}

			// $terms = get_terms($filter_to_use, array( 'orderby' => 'count' , 'order' => 'DESC', 'include' => $stack) );
			$terms = get_terms($filter_to_use, array( 'include' => $stack) );
		}
	    if(!empty( $terms ) && $show_filters == 'yes') {
	    	if( 0 < $gutter_width ) {
				$portfolio_filter_style = 'style="margin-left:'.$gutter_width.'px;"';
			}else {
				$portfolio_filter_style = '';
			} 

		    $output .= '<div class="filters clearfix '.$filter_style.' align-'.$filter_alignment.'" ' . $portfolio_filter_style . '>';
	    	$output .= '<div class="filter_item"><span class="sort current_choice" data-id="element">'.__( 'All', 'oshine-modules' ).'</span></div>';
	    	foreach ($terms as $term) {
	    		if( is_object( $term ) ) {
		    		$output .= '<div class="filter_item">';    		
		    		$output .= '<span class="sort" data-id="'.$term->slug.'">'.$term->name.'</span>';		
		    		$output .= '</div>';
		    	}
	    	}
	    	$output .= '</div>';
		}
		$output .= '<div class="portfolio-container clickable clearfix portfolio-shortcode '.$show_overlay.' '.$initial_load_style.' '.$item_parallax.'">';
		if( empty( $category[0] ) ) {
			$args = array(
				'post_type' => 'portfolio',
				'posts_per_page' => $items_per_page,
				'orderby'=> apply_filters('be_portfolio_order_by','date'),
				'order'=> apply_filters('be_portfolio_order','DESC'),
				'post_status'=> 'publish'
			);
		} else {
			$args = array (
				'post_type' => 'portfolio',
				'posts_per_page' => $items_per_page,
				'orderby'=> apply_filters('be_portfolio_order_by','date'),
				'order'=> apply_filters('be_portfolio_order','DESC'),
				'post_status'=> 'publish',
				'tax_query' => array (
					array (
						'taxonomy' => $tax_name,
						'field' => 'slug',
						'terms' => $category,
						'operator' => 'IN',
					),
				),
			);	
		}
		$the_query = new WP_Query( $args );
		$delay = 0;
		if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) : $the_query->the_post();
				if ( has_post_thumbnail( get_the_ID() ) ) :
					$delay += 200;
					$isdwdh = false;
					$filter_classes = $permalink = '';
					$mfp_class = 'mfp-image';
					$post_terms = get_the_terms( get_the_ID(), $filter_to_use );
					if( $show_filters == 'yes' && is_array( $post_terms ) ) {
						foreach ( $post_terms as  $term ) {
							$filter_classes .=$term->slug." ";
						}
					} else{
						$filter_classes='';
					}
					$attachment_id = get_post_thumbnail_id(get_the_ID());
					$image_atts = get_portfolio_image(get_the_ID(), $col, $masonry);
					$attachment_thumb = wp_get_attachment_image_src( $attachment_id, $image_atts['size']);
					$attachment_full = wp_get_attachment_image_src( $attachment_id, 'full');
					$attachment_thumb_url = $attachment_thumb[0];
					$attachment_full_url = $attachment_full[0];
					if( !$attachment_thumb || empty( $attachment_thumb ) || ( 'masonry_enable' == $masonry_enable && ( !$attachment_full || empty( $attachment_full ) ) ) ) {
						continue;
					}
					$video_url = get_post_meta( $attachment_id, 'be_themes_featured_video_url', true );
					$visit_site_url = get_post_meta( get_the_ID(), 'be_themes_portfolio_external_url', true );
					$link_to = get_post_meta( get_the_ID(), 'be_themes_portfolio_link_to', true );
					$open_with = get_post_meta( get_the_ID(), 'be_themes_portfolio_single_page_style', true );
					$single_overlay_color = get_post_meta( get_the_ID(), 'be_themes_single_overlay_color', true );
					$single_overlay_opacity = get_post_meta( get_the_ID(), 'be_themes_single_overlay_color_opacity', true );
					$single_title_color = get_post_meta( get_the_ID(), 'be_themes_single_overlay_title_color', true );
					$single_cat_color = get_post_meta( get_the_ID(), 'be_themes_single_overlay_cat_color', true );
					$attachment_info = be_wp_get_attachment($attachment_id);
					if(!isset($visit_site_url) || empty($visit_site_url)) {
						$visit_site_url = '#';
					}
					$permalink = ( $link_to == 'external_url' ) ? $visit_site_url : get_permalink();
					$target = ("1" == get_post_meta( get_the_ID(), 'be_themes_portfolio_open_new_tab', true )) ? 'target="_blank"' : '';
					if(isset($single_overlay_opacity) && !empty($single_overlay_opacity)) {
						$overlay_opacity = $single_overlay_opacity;
					} else {
						$overlay_opacity = 85;
					}
					if( 'masonry_disable' == $masonry_enable ) {
						if(  'wide-width-height' == $image_atts[ 'alt_class' ] ) {
							$wide_width = ( 1300 ) + $gutter_width;
							$wide_height = ( ( 650 / $aspect_ratio ) * 2 ) + $gutter_width;
							$new_aspect_ratio = $wide_width/$wide_height;
							$placeholder_padding = ( 1/$new_aspect_ratio ) * 100;
							$current_dwdh_aspect_ratio = round( $attachment_thumb[ 1 ]/$attachment_thumb[ 2 ], 2 );
							$isdwdh = true;
						}else if( 'wide-width' == $image_atts[ 'alt_class' ] ){
							$wide_width = ( 1300 ) + $gutter_width;
							$normal_height = ( 650 / $aspect_ratio );
							$new_aspect_ratio = $wide_width/$normal_height;

							$placeholder_padding = ( 1/$new_aspect_ratio ) * 100;
						}else if( 'wide-height' == $image_atts[ 'alt_class' ] ) {
							$wide_height = ( ( 650 / $aspect_ratio ) * 2 ) + $gutter_width;
							$new_aspect_ratio = 650/$wide_height;
							$placeholder_padding = ( 1/$new_aspect_ratio ) * 100;
						}else{
							$placeholder_padding = ( 1/$aspect_ratio ) * 100;
						}						
					}else{						
						$masonry_aspect_ratio = round( $attachment_full[ 1 ]/$attachment_full[ 2 ], 2 );
						$placeholder_padding = ( $attachment_full[ 2 ]/$attachment_full[ 1 ] ) * 100;
					}
					$current_flip_wrap_style = 'style = "padding-bottom:'.$placeholder_padding.'%;'.( ( $enable_data_src || $delay_load ) ?  ( 'background-color:'. $placeholder_color .';"' ) : '"' );
					if(isset($single_overlay_color) && !empty($single_overlay_color)) {
						$single_overlay_color = be_themes_hexa_to_rgb( $single_overlay_color );
						$thumb_overlay_color = 'rgba('.$single_overlay_color[0].','.$single_overlay_color[1].','.$single_overlay_color[2].','.(intval($overlay_opacity) / 100 ).')';
						$gradient_style_color = '';
					} else {
						$thumb_overlay_color = $global_thumb_overlay_color;
						$gradient_style_color = $global_gradient_style_color;
					}
					if(isset($single_title_color) && !empty($single_title_color)) {
						$title_color = $single_title_color;
					} else {
						$title_color = $global_title_color;
					}
					if(isset($single_cat_color) && !empty($single_cat_color)) {
						$cat_color = $single_cat_color;
					} else {
						$cat_color = $global_cat_color;
					}

					if(!empty( $video_url ) ) {
						$attachment_full_url = $video_url;
						$mfp_class = 'mfp-iframe';
					}
					if( ( $link_to != 'external_url' ) && isset($open_with) && $open_with == 'lightbox-gallery') {
						$thumb_class = 'be-lightbox-gallery';
					} else if( ( $link_to != 'external_url' ) && isset($open_with) && $open_with == 'lightbox') {
						$thumb_class = 'single-image';
					} else if( ( $link_to != 'external_url' ) && isset($open_with) && $open_with == 'none') {
						$thumb_class = 'no-link';
						$attachment_full_url = '#';
					} else {
						$thumb_class = '';
						$mfp_class = '';
						$attachment_full_url = $permalink;
					}
					if($title_style == 'style5' || $title_style == 'style6') {
						$trigger_animation  = '';
					} else {
						$trigger_animation  = 'animation-trigger';
					}
					
					$output .= '<div class="element be-hoverlay '.$image_atts['class'].' '.$image_atts['alt_class'].' '.$hover_style.' '.$img_grayscale . ( ( '' != $title_style ) ? ( ' '.$title_style.'-title"' ) : '"' ) . 'style="margin-bottom: '.$gutter_width.'px;" data-category-names = "'.$filter_classes.'">';
					$output .= '<div class="element-inner" style="margin-left: '.$gutter_width.'px;">';
					$output .= '<a href="'.$attachment_full_url.'" class=" thumb-wrap '.$thumb_class.' '.$mfp_class.'" title="'.$attachment_info['title'].'" '.$target.'>';
					$output .= '<div class="flip-wrap" ><div ' . ( "masonry_enable" == $masonry_enable ? ( 'data-aspect-ratio="'.$masonry_aspect_ratio.'"' )  : '' ) . '  style = "padding-bottom : '. $placeholder_padding .'%;background-color:'. $placeholder_color .';" class="flip-img-wrap' . ( ( 'none' != $image_effect ) ? ( ' '.$image_effect.'-effect"' ) : '"' ) .'><img '. ( $enable_data_src ? 'data-src="'.$attachment_thumb_url : 'src="'.$attachment_thumb_url ) .'" ' . ( $isdwdh ? ( 'data-aspect-ratio="'.$current_dwdh_aspect_ratio.'"' ) : '' ) . 'alt="'.$attachment_info['alt'].'"/></div></div>';
					$output .= '<div class="thumb-overlay "><div class="thumb-bg "' . ( ( 'style2' != $prebuilt_hover_style && 'style3' != $prebuilt_hover_style ) ? ( ' style="background-color:'. ( ('style1' == $prebuilt_hover_style) ? $prebuilt_hover_color_style1 : ( $thumb_overlay_color.';'.$gradient_style_color ) ) .'"' ) : '' ) . '>';
					$output .= ( ( 'style2' == $prebuilt_hover_style ) ? '<div class = "be-prebuilt-overlay-wrapper" style="background-color:'.$thumb_overlay_color.';'.$gradient_style_color.'"></div>' : '' );
					$output .=  ( 'style3' == $prebuilt_hover_style ) ? '<div class = "thumb-shadow-wrapper"></div><div style = "background-color:' . $thumb_overlay_color . ';' . $gradient_style_color . '" class = "be-thumb-overlay-wrap"></div>' : '';
					$output .= '<div class="thumb-title-wrap ">';
					$output .= '<div class="thumb-title '. ( ( 'style5' != $title_style && 'style6' != $title_style && 0 == $prebuilt_hover ) ? ( 'animated '. $trigger_animation .'"' ) : '"'  ) .  ( ( 0 == $prebuilt_hover ) ? ( ' data-animation-type="'.$title_animation_type.'"' ) : ' ' ) . 'style="color: '.$title_color.';' . ( ( 0 == $prebuilt_hover ) ? $title_alignment_static : '' ) . '">';
					$output .= ( 'style2' == $prebuilt_hover_style || 'style4' == $prebuilt_hover_style ) ? ( '<div class = "thumb-title-inner-wrap">' ) : '';
					$output .= get_the_title();
					$output .= ( 'style2' == $prebuilt_hover_style ) ? ( '</div><hr class = "be-portfolio-prebuilt-hover-separator"></hr></div>' ) :  ( ( 'style4' == $prebuilt_hover_style ) ? '</div></div>' : '</div>' );
					$terms = be_themes_get_taxonomies_by_id(get_the_ID(), 'portfolio_categories');
					if(!empty($terms) && (isset($cat_hide) && !($cat_hide) ) ) {	
						$output .= '<div class="portfolio-item-cats '. ( ( 'style5' != $title_style && 'style6' != $title_style && 0 == $prebuilt_hover ) ? ( 'animated '. $trigger_animation .'"' ) : '"'  ) . ( ( 0 == $prebuilt_hover ) ? ( ' data-animation-type="'.$cat_animation_type.'"' ) : ' ' ) . 'style="color: '.$cat_color.';'. ( ( 0 == $prebuilt_hover ) ? ( $title_alignment_static ) : '' ).'">';
						$length = 1;
						$output .= ( ( 'style2' == $prebuilt_hover_style || 'style4' == $prebuilt_hover_style ) ? '<div class = "portfolio-item-cats-inner-wrap">' : '' );
						foreach ($terms as $term) {
							if( is_object($term) ) {
								$output .= '<span>'.$term->name.'</span>';
								if(count($terms) != $length) {
									$output .= '<span> &middot; </span>';
								}
							}
							$length++;
						}
						$output .= ( ( 'style2' == $prebuilt_hover_style || 'style4' == $prebuilt_hover_style ) ? '</div></div>' : '</div>' );
					}
					$output .= '</div>';
					$output .= '</div>'; // End Thumb Bg
					$output .= ( ( 1 == $prebuilt_hover && 'style1' == $prebuilt_hover_style ) ? ( '<div class = "thumb-border-wrapper" style = "border-color:' . ( ( isset($thumb_overlay_color) && !empty($thumb_overlay_color) ) ? $thumb_overlay_color : $overlay_color ) . ';" ></div>' ) : '' ) . '</div>'; //End Thumb Bg & Thumb Overlay
					$output .= '</a>'; //End Thumb Wrap
					if(isset($open_with) && $open_with == 'lightbox-gallery') :
						$output .='<div class="popup-gallery">';
						$attachments = get_post_meta(get_the_ID(),'be_themes_single_portfolio_slider_images');
						if(!empty($attachments)) {
							foreach ( $attachments as $attachment_id ) {
								$attach_img = wp_get_attachment_image_src($attachment_id, 'full');
								$video_url = get_post_meta($attachment_id, 'be_themes_featured_video_url', true);
								$attachment_info = be_wp_get_attachment($attachment_id);
								if($video_url) {
									$url = $video_url;
									$mfp_class = 'mfp-iframe';
								} else {
									$url = $attach_img[0];
									$mfp_class ='mfp-image';
								}
								$output .='<a href="'.$url.'" class="'.$mfp_class.'" title="'.$attachment_info['title'].'"></a>';
							}
						}
						$output .= '</div>'; //End Gallery
					endif;
					$output .= ($like_button != 1) ? '<div class="like-button-wrap">'.be_get_like_button(get_the_ID()).'</div>' : '';
					$output .= '</div>'; //End Element Inner
					$output .= '</div>'; //End Element
				endif;	
			endwhile;
		endif;
		wp_reset_postdata();
		$output .='</div>'; //end portfolio-container
		if('-1' != $items_per_page && ($the_query->found_posts-$items_per_page)>0) {
			$items_initial_load = $items_per_page;
			if( $pagination == 'infinite' ) {
				$output .='<div class="trigger_infinite_scroll portfolio_infinite_scroll" data-type="portfolio"></div>';
			} elseif( $pagination == 'loadmore' ) {
				$output .='<div class="trigger_load_more portfolio_load_more" data-total-items="'.($the_query->found_posts-$items_initial_load).'" data-type="portfolio"><a class="be-shortcode mediumbtn be-button tatsu-button alt-bg alt-bg-text-color" href="#">'.__( 'Load More', 'oshine-modules' ).'</a></div>';
			}
		}
		$output .='</div></div>'; //end portfolio
		//double height/width script

		return $output;
	}
	add_shortcode( 'portfolio' , 'be_portfolio' );
}
?>