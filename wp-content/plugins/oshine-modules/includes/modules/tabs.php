<?php
/**************************************
			TABS
**************************************/
if (!function_exists('be_tabs')) {
	function be_tabs( $atts, $content ) {
		$GLOBALS['tabs_cnt'] = 0;
		$tabs_cnt=0;
		$GLOBALS['tabs'] = array();
		$rand = rand();
		$content=do_shortcode( $content );
		if( is_array( $GLOBALS['tabs'] ) ) {
			foreach( $GLOBALS['tabs'] as $tab ) {
				extract($tab);
				$title_style = $content_style = '';
				$title_style .= ($title_color) ? 'color: '.$title_color.';' : '' ;				
				$tabs_cnt++;
				$class = ( ! empty($tab['icon']) && $tab['icon'] != 'none' ) ? "tab-icon ".$tab['icon'] : "" ;
				$tabs[] = '<li><a class="'.$class.'" href="#fragment-'.$tabs_cnt.'-'.$rand.'" style="'.$title_style.'">'.$tab['title'].'</a></li>';
				$panes[] = '<div id="fragment-'.$tabs_cnt.'-'.$rand.'" class="clearfix be-tab-content">'.$tab['content'].'</div>';
			}
			$return = ($panes || $tabs) ? "\n".'<div class="tabs oshine-module"><ul class="clearfix be-tab-header">'.implode( "\n", $tabs ).'</ul>'.implode( $panes ).'</div>'."\n" : '' ; 
		}
		return $return;
	}
	add_shortcode( 'tabs', 'be_tabs' );
}

if (!function_exists('be_tab')) {
	function be_tab( $atts, $content ){
		extract(shortcode_atts( array(
	        'icon' => '',
	        'title' => '',
			'title_color' => '',
	    ),$atts ) );
		$content= do_shortcode($content);
		$x = $GLOBALS['tabs_cnt'];
		$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tabs_cnt'] ), 'content' =>  $content, 'icon'=> $icon, 'title_color'=> $title_color );
		$GLOBALS['tabs_cnt']++;
	}
	add_shortcode( 'tab', 'be_tab' );
}
?>