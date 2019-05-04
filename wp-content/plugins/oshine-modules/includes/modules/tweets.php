<?php
/**************************************
			TWEET
**************************************/
if (!function_exists('be_tweet')) {
	function be_tweet( $atts, $content ) {
		extract( shortcode_atts( array (
			'account_name' => '',
			'count' => 5,
			'color' => '',
			'content_size' => '12',
			'tweet_bird_color' => '',
			'alignment' => 'center',
			'slide_show' => '0',
			'slide_show_speed' => 4000,
			'pagination' => 0,
			'animate' => 0,
			'animation_type' =>'slide-up',
		), $atts ) );
		$animate = ( isset( $animate ) && 1 == $animate ) ? 'be-animate' : '';
		$alignment = (isset( $alignment ) && !empty( $alignment )) ? $alignment : 'center';
		$color = (!isset($color) || empty($color)) ? '' : $color;
		$tweet_bird_color = (!isset($tweet_bird_color) || empty($tweet_bird_color)) ? '' : $tweet_bird_color;
		$pagination = (empty($pagination) || (!empty($pagination) && $pagination == 0)) ? '0' : '1' ; 
	    $slide_show = ( !empty( $slide_show ) ) ? 1 : 0 ;
		$slide_show_speed = ( !empty( $slide_show_speed ) ) ? $slide_show_speed : 4000 ;

		$output = '';
		if($account_name) {
			$query = 'count='.$count.'&include_entities=true&include_rts=true&screen_name='.$account_name;
			$tweets = be_get_tweets( $query );
			if( $tweets ) {
				$output .= '<div class="tweet-slides oshine-module ' .$animate.'" data-animation="'.$animation_type.'" ><ul class="twitter_module slides '.$alignment.'-content" data-slide-show="'.$slide_show.'" data-slide-show-speed="'.$slide_show_speed.'" data-pagination="'.$pagination.'">';
				foreach($tweets as $tweet) {
					$output .= '<li class="tweet_list"><div class="testimonial_slide_inner"><i class="font-icon icon-twitter" style="color: '.$tweet_bird_color.'"></i><span class="tweet-content status" style="font-size: '.$content_size.'px; color: '.$color.'">';
					$output .= be_tweet_format($tweet);
					$output .= '</div></li>';
				}
				$output .= '</ul></div>';
			}
		}
		return $output;
	}
	add_shortcode( 'tweets', 'be_tweet' );
}
?>