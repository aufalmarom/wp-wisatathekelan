<?php
/**************************************
			MENU CARD
**************************************/
if (!function_exists('be_menu_cards')) {
	function be_menu_cards( $atts, $content ) {
			extract( shortcode_atts( array (
				'title' => '',
				'ingredients' => '',
				'price' => '',
				'title_color' => '',
				'ingredients_color' => '',
				'price_color' => '',
				'highlight' => '',
				'highlight_color' => '',
				'star' => '',
				'star_color' => '',
				'border_color' => '',
		        'animate' => 0,
				'animation_type'=>'fadeIn',
	    	), $atts ));
	    	$title_color = ( isset( $title_color ) && !empty( $title_color ) ) ? $title_color : '' ;
	    	$ingredients_color = ( isset( $ingredients_color ) && !empty( $ingredients_color ) ) ? $ingredients_color : '' ;
	    	$price_color = ( isset( $price_color ) && !empty( $price_color ) ) ? $price_color : '' ;
	    	$highlight = ( isset( $highlight ) && 1 == $highlight ) ? 'highlight-menu-item' : '' ;
	    	$highlight_color = ( isset( $highlight_color ) && !empty( $highlight_color ) && $highlight == 'highlight-menu-item') ? $highlight_color : '' ;
	    	$star_color = ( isset( $star_color ) && !empty( $star_color ) ) ? $star_color : '' ;
	    	$border_color = ( isset( $border_color ) && !empty( $border_color ) ) ? $border_color : '' ;
	    	$animate = ( isset( $animate ) && 1 == $animate ) ? 'be-animate' : 0 ;
			$output = '';
	    	$output .= '<div class="menu-card-item oshine-module '.$animate.' clearfix '.$highlight.'" data-animation="'.$animation_type.'" style="background-color: '.$highlight_color.'; border-color: '.$border_color.'">';
			$output .= '<div class="menu-card-item-info">';
			$output .= '<span class="h6-font menu-card-title" style="color: '.$title_color.';">'.$title.'</span>';
			$output .= '<span class="menu-card-ingredients special-subtitle" style="color: '.$ingredients_color.';">'.$ingredients.'</span>';
			$output .= '<span class="menu-card-item-price" style="color: '.$price_color.';">'.$price.'</span>';
			if( isset( $star ) && 1 == $star ) {
				$output .= '<i class="icon-icon_star menu-card-item-stared alt-color" style="color: '.$star_color.';"></i>';
			}
			$output .= '</div>';
	        $output .= '</div>';
	        return $output;
	}
	add_shortcode( 'menu_card', 'be_menu_cards' );
}
?>