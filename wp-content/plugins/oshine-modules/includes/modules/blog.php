<?php
/**************************************
		BLOG MASONRY
**************************************/
if (!function_exists('be_blog')) {
	function be_blog( $atts ) {
		global $be_themes_data;
		extract( shortcode_atts( array (
			'col' => 'three',
			'gutter_style' => 'style1',
			'gutter_width' => 40,
		) , $atts ) );
		$output = '';
		global $paged, $blog_attr;
		$col = ((!isset($col)) || empty($col)) ? 'three' : $col;
		$blog_attr['gutter_style'] = ((!isset($gutter_style)) || empty($gutter_style)) ? 'style1' : $gutter_style;
		$blog_attr['gutter_width'] = ((!isset($gutter_width)) || empty($gutter_width)) ? intval(40) : intval( $gutter_width );
		$blog_attr['style'] = 'shortcodes';
		if($blog_attr['gutter_style'] == 'style2') {
			$portfolio_wrap_style = 'style="margin-left: -'.$blog_attr['gutter_width'].'px;"';
		} else {
			$portfolio_wrap_style = 'style="margin-right: '.$blog_attr['gutter_width'].'px;"';
		}
		$output .= '<div class="portfolio-all-wrap">';
		$output .= '<div class="portfolio full-screen full-screen-gutter '.$gutter_style.'-gutter '.$col.'-col" data-gutter-width="'.$blog_attr['gutter_width'].'" '.$portfolio_wrap_style.' data-col="'.$col.'">';
		$output .= '<div class="style3-blog portfolio-container clickable clearfix">';
		$blog_attr['gutter_width'] = $gutter_width;
		$args = array( 'post_type' => 'post', 'paged' => $paged );
		$the_query = new WP_Query( $args );
			if ( $the_query->have_posts() ) : 
				while ( $the_query->have_posts() ) : $the_query->the_post();
					ob_start();  
					get_template_part( 'blog/loop', 'shortcodes' );
					$output .= ob_get_contents();  
					ob_end_clean();
				endwhile;
			else:
				$output .= '<p class="inner-content">'.__( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'oshine-modules' ).'</p>';
			endif;
		$output .= '</div>'; //end portfolio-container
		$output .= ($the_query->max_num_pages > 1) ? '<div class="pagination_parent" style="margin-left: '.$blog_attr['gutter_width'].'px">'.get_be_themes_pagination($the_query->max_num_pages).'</div>' : '' ;
		$output .= '</div>';
		$output .= '</div>'; //end portfolio
		wp_reset_postdata();
		return $output;
	}
	add_shortcode( 'blog' , 'be_blog' );
}
?>