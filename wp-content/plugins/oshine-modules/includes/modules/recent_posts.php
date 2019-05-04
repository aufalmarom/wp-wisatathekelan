<?php
/**************************************
			RECENT POSTS
**************************************/
if ( ! function_exists( 'be_recent_posts' ) ) {
	function be_recent_posts( $atts, $content ) {
		extract( shortcode_atts( array (
			'number'=>'three',
			'hide_excerpt' => '',
	    ), $atts ) );
		if( $number == 'three' ) {
			$posts_per_page = 3;
			$column = 'third';
		} else {
			$posts_per_page = 4;
			$column = 'fourth';
		}
		$hide_excerpt = (isset($hide_excerpt) && ($hide_excerpt)) ? 'hide-excerpt' : '' ;
		$args=array (
			'post_type' => 'post',
			'posts_per_page'=> $posts_per_page,
			'orderby'=>'date',
			'ignore_sticky_posts'=>1,
			'tax_query' => array(
				array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array( 'post-format-quote' ),
					'operator' => 'NOT IN',
				)
			),
		);
		$output = '';
		global $meta_sep, $blog_attr;
		$my_query = new WP_Query( $args  );
		if( $my_query->have_posts() ) {
			$output .= '<div class="related-items oshine-recent-posts style3-blog '.$hide_excerpt.' oshine-module clearfix">';
			$blog_attr['style'] = 'shortcodes';
			$blog_attr['gutter_width'] = 0;
			while ( $my_query->have_posts() ) : $my_query->the_post(); 
				$output .= '<div class="'.$column.'-col recent-posts-col be-hoverlay">';
				ob_start();
				get_template_part( 'blog/loop', $blog_attr['style'] );
				$post_format_content = ob_get_clean();
				$output .= $post_format_content;
				$output .= '</div>'; // end column block
			endwhile;
			$output .= '</div>';
		}
		wp_reset_query();
		return $output;
	}
	add_shortcode( 'recent_posts', 'be_recent_posts' );
}
?>