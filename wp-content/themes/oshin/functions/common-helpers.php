<?php
/* ---------------------------------------------  */
// Function for converting hex to rgb
/* ---------------------------------------------  */
if (!function_exists('be_themes_hexa_to_rgb')) {
	function be_themes_hexa_to_rgb( $color ) {

	  if ( isset( $color[0] ) && $color[0] == '#' ) {
	      $color = substr($color, 1);
	  }

	  if ( strlen( $color ) == 6 ) {
	      list( $r, $g, $b ) = array( $color[0].$color[1], $color[2].$color[3], $color[4].$color[5] );
	  } elseif (strlen($color) == 3) {
	      list( $r, $g, $b ) = array( $color[0].$color[0], $color[1].$color[1], $color[2].$color[2] );
	  } else {
	      return false;
	  }

	  $r = hexdec( $r ); $g = hexdec( $g ); $b = hexdec( $b );

	  return array( $r, $g, $b );
	}
}

/* ---------------------------------------------  */
// Function to prevent duplicate p and br tags
/* ---------------------------------------------  */
if (!function_exists('be_themes_formatter')) {
	function be_themes_formatter( $content ) {
		$new_content = '';
		$pattern_full = '{(\[raw\].*?\[/raw\])}is';
		$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
		$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

		foreach ( $pieces as $piece ) {
			$new_content .= ( 1 == preg_match( $pattern_contents, $piece, $matches ) ? $matches[1] : wptexturize( wpautop( $piece ) ) );
		}

		return $new_content;
	}
}

/* ---------------------------------------------  */
// Function to find youtube and Vimeo videos
/* ---------------------------------------------  */
if ( ! function_exists( 'be_themes_video_type' ) ) :
	function be_themes_video_type( $url ) {
		if (strpos( $url, 'youtube' ) > 0) {
			return 'youtube';
		} 
		elseif ( strpos( $url, 'vimeo' ) > 0) {
			return 'vimeo';
		} 
		else {
			return '';
		}
	}
endif;

/* ---------------------------------------------  */
// Function to print categories
/* ---------------------------------------------  */
if ( ! function_exists( 'be_themes_get_category_list' ) ) :
	function be_themes_get_category_list( $id ) {
		$numItems = count( get_the_category( $id ) );
		$i = 0;
		foreach( ( get_the_category( $id ) ) as $category ) {
			if( ++$i === $numItems ) {
				return '<a href="'.get_category_link( $category->cat_ID ).'" title="'.__('View all posts in','oshin').' '.$category->cat_name.'"> '.$category->cat_name.'</a>' ;
			} else {
				return '<a href="'.get_category_link( $category->cat_ID ).'" title="'.__('View all posts in','oshin').' '.$category->cat_name.'"> '.$category->cat_name.'</a>' ;
			}
		}
	}
endif;

/* ---------------------------------------------  */
//  Function to retrieve categories
/* ---------------------------------------------  */
if ( ! function_exists( 'get_be_themes_portfolio_category_list' ) ) :
	function get_be_themes_portfolio_category_list( $id, $link = false ) {
		$terms = wp_get_object_terms( $id, 'portfolio_categories' );
		$category = "";
		$taxonomies = get_the_term_list( $id, 'portfolio_categories', '', ' / ', '' );
		$taxonomies = strip_tags( $taxonomies );
		$term_count = count( $terms );
		$i = 0;
		if($link) {
			foreach ( $terms as $term ) {
				$term_link = get_term_link( $term );
				if( ++$i === $term_count ) {
					$category .= '<a href="'.$term_link.'" class="cat-list">'.$term->name.'</a>';
				}
				else {
					$category .= '<a href="'.$term_link.'" class="cat-list">'.$term->name.'</a><span> &middot; </span>';
				}
			}
		} else {
			foreach ( $terms as $term ) {
				if( ++$i === $term_count ) {
					$category .= $term->slug;
				}
				else {
					$category .= $term->slug." | ";
				}
			}
		}
		return $category;
	}
endif;

/* ---------------------------------------------  */
// Filter to generate slug for custom sidebars
/* ---------------------------------------------  */
if ( ! function_exists( 'generateSlug' ) ) :
	function generateSlug( $phrase, $maxLength ) {
		$result = strtolower($phrase);
		$result = preg_replace( "/[^a-z0-9\s-]/", "", $result );
		$result = trim( preg_replace( "/[\s-]+/", " ", $result ) );
		$result = trim( substr( $result, 0, $maxLength ) );
		$result = preg_replace( "/\s/", "-", $result );
		return $result;
	}
endif;

/* ---------------------------------------------  */
// Function to retrieve a portfolio image
/* ---------------------------------------------  */

if (!function_exists('get_portfolio_image')) {
	function get_portfolio_image($id, $column, $masonry) {
		$image = array();
		$width_wide = get_post_meta( $id, 'be_themes_width_wide', true );
		$height_wide = get_post_meta( $id, 'be_themes_height_wide', true );
		if($column == 'three' || $column == 'four' || $column == 'five') {
			if($masonry) {
				$image['size'] = 'portfolio-masonry';
			} else {
				if($width_wide && $height_wide) {
					$image['size'] = '3col-portfolio-wide-width-height';
				} else if($width_wide) {
					$image['size'] = '3col-portfolio-wide-width';
				} else if($height_wide) {
					$image['size'] = '3col-portfolio-wide-height';
				} else {
					$image['size'] = 'portfolio';
				}
			}
		} elseif($column == 'two') {
			if($masonry) {
				$image['size'] = '2col-portfolio-masonry';
			} else {
				$image['size'] = '2col-portfolio';
			}
		} elseif($column == 'one') { 
			$image['size'] = 'full';
		} else {
			$image['size'] = 'portfolio';
		}
		if($column != 'one'){
			if($width_wide) {
				$image['class'] = 'wide';
			} else {
				$image['class'] = 'not-wide';
			}
			if($width_wide && $height_wide) {
				$image['alt_class'] = 'wide-width-height';
			} else if($width_wide) {
				$image['alt_class'] = 'wide-width';
			} else if($height_wide) {
				$image['alt_class'] = 'wide-height';
			} else {
				$image['alt_class'] = 'no-wide-width-height';
			}
		}else{
			$image['class'] = 'not-wide';
			$image['alt_class'] = 'no-wide-width-height';
		}
		return $image;
	}
}

/* ---------------------------------------------  */
// Function to determine video source
/* ---------------------------------------------  */

if( ! function_exists('be_gal_video')) :
	function be_gal_video($url) {
		if (strpos($url, 'youtube') > 0) {
			return be_gallery_youtube($url);
		} elseif (strpos($url, 'vimeo') > 0) {
			return be_gallery_vimeo($url);
		} else {
			return be_gallery_youtube($url);
		}
	}
endif;

/* ---------------------------------------------  */
// Function to generate youtube video iframe 
/* ---------------------------------------------  */

if (!function_exists('be_gallery_youtube')) {
	function be_gallery_youtube( $url ) {
		$video_id = '';
		if( ! empty( $url ) ) {
			if ( preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match ) ) {
				$video_id = $match[1];
			}
			return '<iframe class="be-youtube-video gallery" src="https://www.youtube.com/embed/'.$video_id.'?rel=0&wmode=transparent" style="border: none;"></iframe>';		
		} else {
			return '';
		}
	}
}

/* ---------------------------------------------  */
// Function to generate vimeo video iframe 
/* ---------------------------------------------  */

if (!function_exists('be_gallery_vimeo')) {
	function be_gallery_vimeo( $url ) {
		$video_id = '';
		if( ! empty( $url ) ) {
			sscanf(parse_url($url, PHP_URL_PATH), '/%d', $video_id);
			return '<iframe class="be-vimeo-video gallery" src="https://player.vimeo.com/video/'.$video_id.'?api=1&title=0&byline=0&portrait=0" id="be-vimeo-'.$video_id.'" frameborder=0 width="500" height="281" style="border: none;" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
		} else {
			return '';
		}
	}
}

/* ---------------------------------------------  */
// Function to retrieve taxonomies from ID
/* ---------------------------------------------  */

if ( ! function_exists( 'be_themes_get_taxonomies_by_id' ) ) :
	function be_themes_get_taxonomies_by_id($id, $filteres_to_use) {
		return $terms=wp_get_object_terms( get_the_ID(), $filteres_to_use );
	}
endif;

/* ---------------------------------------------  */
// Function to publish share buttons
/* ---------------------------------------------  */

if ( ! function_exists( 'be_get_share_button' ) ) :
	function be_get_share_button($url, $title, $id, $stacked = false, $stack_direction = 'left', $class_names = '' ) {
		$output = '';
		$attachment = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full' );
		$media =  ( $attachment ) ? $attachment[0] : '';
		if( !$stacked ) {
			$output .= '<a href="https://www.facebook.com/sharer/sharer.php?u='.urlencode($url).'" class="custom-share-button" target="_blank"><i class="font-icon icon-social_facebook"></i></a>';
			$output .= '<a href="https://twitter.com/home?status='.urlencode($url.' '.$title).'" class="custom-share-button" target="_blank"><i class="font-icon icon-social_twitter"></i></a>';
			$output .= '<a href="https://plus.google.com/share?url='.urlencode($url).'" class="custom-share-button" target="_blank"><i class="font-icon icon-social_googleplus"></i></a>';
			$output .= '<a href="https://www.linkedin.com/shareArticle?mini=true&amp;url='.urlencode($url).'&amp;title='.urlencode($title).'" class="custom-share-button" target="_blank"><i class="font-icon icon-social_linkedin"></i></a>';
			$output .= '<a href="https://www.pinterest.com/pin/create/button/?url='.urlencode($url).'&media='.urlencode($media).'&description='.urlencode($title).'" class="custom-share-button" target="_blank"  data-pin-do="buttonPin" data-pin-config="above"><i class="font-icon icon-social_pinterest"></i></a>';
		}else {
			$output .= '<span class = "be-share-stack be-stack-' . $stack_direction . ' ' . $class_names .'" >';
			$output .= '<a href = "#" class = "be-share-trigger-placeholder"><i class = "font-icon icon-share"></i></a>';
			$output .= '<span class = "be-share-stack-mask">';
			$output .= '<a href = "#" class = "be-share-trigger"><i class = "font-icon icon-share"></i></a>';
			$output .= '<a href="https://www.facebook.com/sharer/sharer.php?u='.urlencode($url).'" class="custom-share-button" target="_blank"><i class="font-icon icon-social_facebook"></i></a>';
			$output .= '<a href="https://twitter.com/home?status='.urlencode($url.' '.$title).'" class="custom-share-button" target="_blank"><i class="font-icon icon-social_twitter"></i></a>';
			$output .= '<a href="https://plus.google.com/share?url='.urlencode($url).'" class="custom-share-button" target="_blank"><i class="font-icon icon-social_googleplus"></i></a>';
			$output .= '<a href="https://www.linkedin.com/shareArticle?mini=true&amp;url='.urlencode($url).'&amp;title='.urlencode($title).'" class="custom-share-button" target="_blank"><i class="font-icon icon-social_linkedin"></i></a>';
			$output .= '<a href="https://www.pinterest.com/pin/create/button/?url='.urlencode($url).'&media='.urlencode($media).'&description='.urlencode($title).'" class="custom-share-button" target="_blank"  data-pin-do="buttonPin" data-pin-config="above"><i class="font-icon icon-social_pinterest"></i></a>';			
			$output .= '</span>';
			$output .= '</span>';
		}
		return $output;
	}
endif;

/* ---------------------------------------------  */
// Function to get url of posts page 
/* ---------------------------------------------  */

if ( ! function_exists( 'be_get_posts_page_url' ) ) :
	function be_get_posts_page_url() {
  		if( 'page' == get_option( 'show_on_front' ) ) {
    		$posts_page_id = get_option( 'page_for_posts' );
    		$posts_page = get_page( $posts_page_id );
    		$posts_page_url = site_url( get_page_uri( $posts_page_id ) );
  		} else {
    		$posts_page_url = site_url();
  		}
  		return $posts_page_url;
	}
endif;

/* ---------------------------------------------  */
// Function to return pagination markup  */
/* ---------------------------------------------  */
if ( ! function_exists( 'get_be_themes_pagination' ) ) :
	function get_be_themes_pagination( $pages = '', $range = 3 ) {  
	    $showitems = ( $range * 2 ) + 1;  

	    global $paged;
	    if( empty( $paged ) ) $paged = 1;

	    if( $pages == '' ) {
	        global $wp_query;
	        $pages = $wp_query->max_num_pages;
	        if( !$pages ) {
	            $pages = 1;
			}
	    }      

	    if( 1 != $pages ){
	        $returnvalue='<div class="pagination secondary_text">';//Page '.$paged.' of '.$pages;
	        if( $paged > 2 && $paged > $range+1 && $showitems < $pages ) { 
	        	$returnvalue.="<a href='".get_pagenum_link(1)."' class='sec-bg sec-color'>&laquo; ".__('First','oshin')."</a>";
	        }
	        if( $paged > 1 && $showitems < $pages ) { 
	        	$returnvalue.="<a href='".get_pagenum_link($paged - 1)."' class='sec-bg sec-color'>&lsaquo; ".__('Prev','oshin')."</a>";
	        }
	        for ( $i=1; $i <= $pages; $i++ ) {
	            if (  1 != $pages && ( !( $i >= $paged+$range+1 || $i <= $paged-$range-1 ) || $pages <= $showitems ) ) {
	                $returnvalue.= ( $paged == $i ) ? "<span class='current alt-bg alt-bg-text-color'>".$i."</span>":"<a href='".get_pagenum_link( $i )."' class='inactive sec-bg sec-color' >".$i."</a>";
	            }
	        }
	        if ( $paged < $pages && $showitems < $pages ) { 
	        	$returnvalue.= "<a href='".get_pagenum_link( $paged + 1 )."' class='sec-bg sec-color'>".__( 'Next', 'oshin' )." &rsaquo;</a>";
	        }  
	        if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) { 
	        	$returnvalue.= "<a href='".get_pagenum_link($pages)."' class='sec-bg sec-color'>".__( 'Last', 'oshin' )." &raquo;</a>";
	        }
	        $returnvalue.= "</div>\n";
			return $returnvalue;
	    }
	}
endif;

/* ---------------------------------------------  */
// Function to get attachment image from ID 
/* ---------------------------------------------  */

if ( ! function_exists( 'be_wp_get_attachment' ) ) :
function be_wp_get_attachment( $attachment_id ) {
	$attachment = get_post( $attachment_id );
	if(isset($attachment) && !empty($attachment)) {
		$image_attributes = wp_get_attachment_image_src( $attachment->ID, 'full' );
		return array (
			'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
			'caption' => $attachment->post_excerpt,
			'description' => $attachment->post_content,
			'href' => get_permalink( $attachment->ID ),
			'src' => $attachment->guid,
			'title' => $attachment->post_title,
			//Changed for Photo Swipe Gallery
			'width' => $image_attributes[1],
			'height' => $image_attributes[2] 
			//End
		);
	}
}
endif;

/* ---------------------------------------------  */
// Function to print like button in portfolios
/* ---------------------------------------------  */

if ( ! function_exists( 'be_AlreadyLiked_post' ) ) {
	function be_AlreadyLiked_post( $post_id ) {
		if (isset($_COOKIE[$post_id."_liked"])) {
			return true;
		}
		return false;
	}
}
if ( ! function_exists( 'be_like_count' ) ) {
	function be_like_count( $post_id ) {
		$like_count = get_post_meta( $post_id, "_post_like_count", true );
		if(!isset($like_count) || empty($like_count))
			return "0";
		else
			return $like_count;
	}
}

if ( ! function_exists( 'be_get_like_button' ) ) {
	function be_get_like_button( $post_id ) {
		if(be_AlreadyLiked_post( $post_id ) ) {
			$liked = 'liked disable';
		} else {
			$liked = 'no-liked';
		}
		return '<a href="#" class="custom-like-button '.$liked.'" data-post-id="'.$post_id.'"><i class="font-icon icon-icon_heart"></i><span>'.be_like_count($post_id).'</span></a>';
	}
}

/* ---------------------------------------------  */
// Function to find links in tweets
/* ---------------------------------------------  */

if ( ! function_exists( 'be_tweet_autolink' ) ) :
	function be_tweet_autolink ($tweet) {
		require_once( get_template_directory().'/functions/twitter/Autolink.php' );
		$autolinked_tweet = Twitter_Autolink::create($tweet, false)
			->setNoFollow(false)->setExternal(false)->setTarget('')
			->setUsernameClass('')
			->setHashtagClass('')
			->setURLClass('')
			->addLinks();
		return $autolinked_tweet;
	}
endif;

/* ---------------------------------------------  */
// Function to format tweets 
/* ---------------------------------------------  */

if ( ! function_exists( 'be_tweet_format' ) ) :
	function be_tweet_format ($tweet) {
		$output = '';
		$utc_offset = $tweet->user->utc_offset;
		$tweet_time = strtotime($tweet->created_at) + $utc_offset;
		$format = str_replace('%O', date('S', $tweet_time), '%I:%M %p %b %d%O');
		$display_time = strftime($format, $tweet_time);
		$output .= be_tweet_autolink($tweet->text);
		$href = 'http://twitter.com/' . $tweet->user->screen_name . '/status/' . $tweet->id_str;
		$output .= '</span><h6><a class="meta" href="' . $href . '">@'.$tweet->user->screen_name.'</a></h6>';
		//$href = 'http://twitter.com/' . $tweet->user->screen_name . '/status/' . $tweet->id_str;
		//$output .= '</span><span class="meta"><a href="' . $href . '">'.$display_time.'</a></span>';
		return $output;
	}
endif;

/* ---------------------------------------------  */
// Function to retrieve twees using API
/* ---------------------------------------------  */

if ( ! function_exists( 'be_get_tweets' ) ) :
	function be_get_tweets( $query ) {
		require_once( get_template_directory().'/functions/twitter/class-wp-twitter-api.php' );
		$credentials = array(
			'consumer_key' => 'NzICpLcZh35wmxHbdxIPjA',
			'consumer_secret' => 'ragtPbz0eC2FpzBJL3CGy5sxgdNGhJ7f9nWw1nnkboo'
		);
		$twitter_api = new Wp_Twitter_Api( $credentials );
		return $twitter_api->query( $query );
	}
endif;

/* ---------------------------------------------  */
// Function to retrieve the SLUG
/* ---------------------------------------------  */

if (!function_exists( 'be_get_the_slug' )) {
	function be_get_the_slug( $post_id = null ) {
		if( empty( $post_id ) ) {
			global $post;
			if( empty($post) ) {
				return '';
			}
			$post_id = $post->ID;
		}
		$post_data = get_post($post_id, ARRAY_A);
		$slug = $post_data['post_name'];
		return $slug; 
	}
}

/* ---------------------------------------------------- */
// Function to retrieve gallery image based on source
/* ---------------------------------------------------- */

if ( ! function_exists( 'get_gallery_image_from_source' ) ) :
	function get_gallery_image_from_source($source, $images = false, $lightbox_type) {
		$media = $return = array();
		global $be_themes_data; 
		switch ($source['source']) {
			case 'instagram':
				$transient_var = 'transient_instagram_user_data_'.$source['account_name'].'_'.$source['count'];
				$transient_media = get_transient( $transient_var );
				if($transient_media && isset($transient_media) && !empty($transient_media)) {
					$media = unserialize($transient_media);
				} else {
					if (isset($be_themes_data['instagram_access_token']) && !empty($be_themes_data['instagram_access_token'] ) ){
						$instagram_access_token = $be_themes_data['instagram_access_token'];
						$instagram_media = wp_remote_get( 'https://api.instagram.com/v1/users/self/media/recent/?access_token='.$instagram_access_token.'&count='.$source['count'] );
						if(isset($instagram_media->error_message) || !empty($instagram_media->error_message)) {
							delete_transient( $transient_var );
							$return['error'] = '<b>'.__('Instagram Error : ', 'oshin').'</b>'.$instagram_media->error_message;
							return $return;
						}
						if($instagram_media && isset($instagram_media) && !empty($instagram_media)) {
							set_transient( $transient_var , serialize($instagram_media), 60 * 60 * 24 * 2 );
							$media = $instagram_media;
						}
					}else{
						delete_transient( $transient_var );
						$return['error'] = '<div class="be-notification error">'.__('Instagram Error : Access Token is not entered under OSHINE OPTIONS > GLOBAL SITE LAYOUT AND SETTINGS. Access Token for your account can be generated from http://instagram.pixelunion.net/', 'oshin').'</div>';
						return $return;
					}					
				}

				if($media && isset($media) && !empty($media)) {
					$images = json_decode($media["body"]);
					$images = $images->data;
					foreach ($images as $key => $value) {
						$temp_image_array = array();
						$temp_image_array = array (
							'thumbnail' => $value->images->standard_resolution->url,
							'full_image_url' => $value->images->standard_resolution->url,
							'mfp_class' => ($lightbox_type == 'photoswipe') ? '' : 'mfp-image',
							'caption' => !empty($value->caption->text) ? $value->caption->text : '',
							'description' => !empty($value->caption->text) ? $value->caption->text : '',
							'width' => $value->images->standard_resolution->width,
							'height' => $value->images->standard_resolution->height,
							'id' => '',
						);
						array_push($return, $temp_image_array);
					}
				}
				return $return;
				break;
			case 'flickr':
				delete_transient( 'transient_flickr_user_data_'.$source['account_name'].'_'.$source['count'] );
				$transient_media = get_transient( 'transient_flickr_user_data_'.$source['account_name'].'_'.$source['count'] );
				if($transient_media && isset($transient_media) && !empty($transient_media)) {
					$media = unserialize($transient_media);
				} else {
					$user_data = wp_remote_get( 'https://api.flickr.com/services/rest/?method=flickr.people.findByUsername&username='.$source['account_name'].'&format=php_serial&api_key=85145f20ba1864d8ff559a3971a0a033' );
					$user_data = unserialize($user_data["body"]);
					if(isset($user_data['stat']) && $user_data['stat'] == 'ok') {
						if(isset($user_data["user"]["nsid"]) && !empty($user_data["user"]["nsid"]) && $user_data["user"]["nsid"]) {
							$flickr_media = wp_remote_get( 'https://api.flickr.com/services/rest/?method=flickr.photos.search&user_id='.$user_data["user"]["nsid"].'&format=php_serial&api_key=85145f20ba1864d8ff559a3971a0a033&per_page='.$source['count'].'&page=1&extras=url_z,url_o' );
							$flickr_media = unserialize($flickr_media["body"]);
							if(isset($flickr_media['stat']) && $flickr_media['stat'] == 'ok') {
								set_transient( 'transient_flickr_user_data_'.$source['account_name'].'_'.$source['count'], serialize($flickr_media), 60 * 60 * 1 );
								$media = $flickr_media;
							} else {
								$return['error'] = '<b>'.__('Flickr Error : ', 'oshin').'</b>'.__("Unknown Error", 'oshin');
								return $return;
							}
						}
					} else {
						$return['error'] = '<b>'.__('Flickr Error : ', 'oshin').'</b>'.$user_data["message"];
						return $return;
					}
				}
				if($media && isset($media) && !empty($media)) {
					$images = $media['photos']['photo'];
					foreach ($images as $key => $value) {
						$temp_image_array = array();
						$temp_image_array = array (
							'thumbnail' => (isset($value["url_z"]) && !empty($value["url_z"])) ? $value["url_z"] : $value["url_o"],
							'full_image_url' => (isset($value["url_z"]) && !empty($value["url_z"])) ? $value["url_z"] : $value["url_o"],
							'mfp_class' => ($lightbox_type == 'photoswipe') ? '' : 'mfp-image',
							'caption' => !empty($value["title"]) ? $value["title"] : '',
							'description' => !empty($value["title"]) ? $value["title"] : '',
							'width' => (isset($value["width_z"]) && !empty($value["width_z"])) ? $value["width_z"] : $value["width_o"],
							'height' => (isset($value["height_z"]) && !empty($value["height_z"])) ? $value["height_z"] : $value["height_o"],
							'id' => '',
						);
						array_push($return, $temp_image_array);
					}
				}
				return $return;
			// case 'dribble':
			// 	$transient_media = get_transient( 'transient_dribble_user_data_'.$source['account_name'].'_'.$source['count'] );
			// 	if($transient_media && isset($transient_media) && !empty($transient_media)) {
			// 		$media = unserialize($transient_media);
			// 	} else {
			// 		$dribble_media = wp_remote_get( 'https://dribbble.com/'.$source['account_name'].'/shots.json' );
			// 		if(isset($dribble_media["response"]["message"]) && !empty($dribble_media["response"]["message"]) && $dribble_media["response"]["message"] == 'OK') {
			// 			$dribble_media = json_decode($dribble_media["body"]);
			// 			if($dribble_media && isset($dribble_media) && !empty($dribble_media)) {
			// 				set_transient( 'transient_dribble_user_data_'.$source['account_name'].'_'.$source['count'], serialize($dribble_media), 60 * 60 * 1 );
			// 				$media = $dribble_media;
			// 			}
			// 		} else {
			// 			$return['error'] = '<b>'.__('Dribble Error : ', 'oshin').'</b>'.$dribble_media["response"]["message"];
			// 			return $return;
			// 		}
			// 	}
			// 	if($media && isset($media) && !empty($media)) {
			// 		$images = $media->shots;
			// 		$i = 0;
			// 		foreach ($images as $key => $value) {
			// 			if($i < $source['count']) {
			// 				$temp_image_array = array();
			// 				$temp_image_array = array (
			// 					'thumbnail' => $value->image_400_url,
			// 					'full_image_url' => $value->image_url,
			// 					'mfp_class' => ($lightbox_type == 'photoswipe') ? '' : 'mfp-image',
			// 					'caption' => !empty($value->title) ? $value->title : '',
			// 					'description' => !empty($value->title) ? $value->title : '',
			// 					'width' => $value->width,
			// 					'height' => $value->height,
			// 					'id' => '',
			// 				);
			// 				array_push($return, $temp_image_array);
			// 				$i++;
			// 			}
			// 		}
			// 	}
			// 	return $return;
			// 	break;
			// case 'pintrest':
			// 	require_once( get_template_directory().'/functions/Pintrest/Pinterest.class.php' );
			// 	$pinterest = new Pinterest($source['account_name']);
			// 	$pinterest->itemsperpage = $source['count'];
			// 	$pinsresult = $pinterest->getPins();
			// 	foreach( $pinsresult["data"] as $pin ) {
   //      			$bigimage = str_replace("237x", "736x", $pin->images->{'237x'}->url);
   //      			$temp_image_array = array();
			// 		$temp_image_array = array (
			// 			'thumbnail' => $bigimage,
			// 			'full_image_url' => $bigimage,
			// 			'mfp_class' => 'mfp-image',
			// 			'caption' => '',
			// 			'id' => '',
			// 		);
			// 		array_push($return, $temp_image_array);
   //  			}
   //  			return $return;
			// 	break;
			default:
				if($images) {
					$images = explode(",", $images);
					foreach ($images as $image) {
						$temp_image_array = array();
						$image_atts = get_portfolio_image($image, $source['col'], $source['masonry']);
						$attachment_thumb = wp_get_attachment_image_src( $image, $image_atts['size']);
						$attachment_full = wp_get_attachment_image_src( $image, 'full');
						$attachment_thumb_url = $attachment_thumb[0];
						$attachment_full_url = $attachment_full[0];
						$video_url = get_post_meta( $image, 'be_themes_featured_video_url', true );
						$attachment_info = be_wp_get_attachment($image);
						$mfp_class = ($lightbox_type == 'photoswipe') ? '' : 'mfp-image';
						if( (! empty( $video_url )) && $lightbox_type != 'photoswipe' ) {
							$attachment_full_url = $video_url;
							$mfp_class = 'mfp-iframe';
						}
						$temp_image_array = array (
							'thumbnail' => $attachment_thumb_url,
							'full_image_url' => $attachment_full_url,
							'mfp_class' => $mfp_class,
							'caption' => $attachment_info['title'],
							'description' => $attachment_info['description'],
							'width' => $attachment_info['width'],
							'height' => $attachment_info['height'],
							'id' => $image,
						);
						array_push($return, $temp_image_array);
					}
					return $return;
				}
				break;
		}
	}
endif;

if( !function_exists( 'be_split_number_text' ) ) {
	function be_split_number_text( $string ) {
		$length = strlen( $string );
		if( $length <= 0 ) {
			return array('', '');
		} 
		$i = $length-1;
		$text = '';
		$number = '';
		while( $i >= 0 ) {
			if( !is_numeric( $string[$i] ) ) {
				$text = $string[$i].$text;
			} else {
				$number = substr( $string, 0, $i+1 );
				break;
			}
			$i--;
		} 
		return array(
			$text,
			$number
		);
	}
}

if( !function_exists( 'be_split_unit_value' ) ) {
	function be_split_unit_value( $string ) {
		$value = be_split_number_text( $string );
		return array(
			'unit' => $value[0],
			'value' => $value[1]
		);
	}
}

if( !function_exists( 'be_extract_font_weight' ) ) {
	function be_extract_font_weight( $variant ) {
		$weight = be_split_number_text( $variant );
		if( !empty( $weight[1] ) ) {
			return $weight[1];
		} else {
			return '400';
		}
	}
}

if( !function_exists( 'be_extract_font_style' ) ) {
	function be_extract_font_style( $variant ) {
		$style = be_split_number_text( $variant );
		if( !empty( $style[0] ) ) {
			return $style[0];
		} else {
			return 'normal';
		}
	}
}

if( !function_exists( 'be_standard_fonts' ) ) {
	function be_standard_fonts() {
		return array(
			"Arial"                     => "Arial, Helvetica, sans-serif",
			"Helvetica"                 => "Helvetica, sans-serif",    
			"Arial Black"               => "Arial Black, Gadget, sans-serif",
			"Bookman Old Style"         => "Bookman Old Style, serif",
			"Comic Sans MS"             => "Comic Sans MS, cursive",
			"Courier"                   => "Courier, monospace",
			"Garamond"                  => "Garamond, serif",
			"Georgia"                   => "Georgia, serif",
			"Impact"                    => "Impact, Charcoal, sans-serif",
			"Lucida Console"           => "Lucida Console, Monaco, monospace",
			"Lucida Sans Unicode"       => "Lucida Sans Unicode, Lucida Grande, sans-serif",
			"MS Sans Serif"             => "MS Sans Serif, Geneva, sans-serif",
			"MS Serif"                  => "MS Serif, New York, sans-serif",
			"Palatino Linotype"         => "Palatino Linotype, Book Antiqua, Palatino, serif",
			"Tahoma,Geneva"             => "Tahoma,Geneva, sans-serif",
			"Times New Roman"           => "Times New Roman, Times,serif",
			"Trebuchet MS"              => "Trebuchet MS, Helvetica, sans-serif",
			"Verdana"                   => "Verdana, Geneva, sans-serif",
			"System Font Stack"         => "-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen-Sans,Ubuntu,Cantarell,'Helvetica Neue',sans-serif",
		);
	}
}

if( !function_exists( 'be_get_font_family' ) ) {
	function be_get_font_family( $font ) {
		if( function_exists( 'typehub_get_store' ) ) {
			$store = typehub_get_store();
		}
		$font = explode( ':', $font );
		if( !empty( $font[1] ) ) {
			$family = $font[1];
		} else {
			$family = $font[0];
		}
		$font_schemes = !empty( $store['fontSchemes'] ) ? $store['fontSchemes'] : array();
		if( !empty( $font_schemes[$family] ) ) {
			$scheme_family = explode( ':', $font_schemes[$family]['fontFamily'] );
			if( !empty( $scheme_family[1] ) ) {
				$family = $scheme_family[1];
			} else {
				$family = $scheme_family[0];
			}
		}
		$standard_fonts = be_standard_fonts();
		if( array_key_exists( $family, $standard_fonts ) ) {
			$family = $standard_fonts[$family];
		}
		return $family;  
	}
}

?>