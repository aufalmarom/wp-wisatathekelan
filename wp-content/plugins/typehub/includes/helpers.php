<?php
/**
 * Helper functions used by the plugin.
 *
 * @link       http://brandexponents.com
 * @since      1.0.0
 *
 * @package    Typehub
 * @subpackage Typehub/public
 */

/*
// Function to minify dynamic css
// Ref : https://raw.githubusercontent.com/GaryJones/Simple-PHP-CSS-Minification/master/minify.php
*/
if( !function_exists( 'be_minify_css' ) ) {
	function be_minify_css( $css ) {

	// Normalize whitespace
	$css = preg_replace( '/\s+/', ' ', $css );

	// Remove spaces before and after comment
	$css = preg_replace( '/(\s+)(\/\*(.*?)\*\/)(\s+)/', '$2', $css );

	// Remove comment blocks, everything between /* and */, unless
	// preserved with /*! ... */ or /** ... */
	$css = preg_replace( '~/\*(?![\!|\*])(.*?)\*/~', '', $css );

	// Remove ; before }
	$css = preg_replace( '/;(?=\s*})/', '', $css );

	// Remove space after , : ; { } */ >
	$css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );

	// Remove space before , ; { } ) > 
	$css = preg_replace( '/ (,|;|\{|}|\)|>)/', '$1', $css );

	// Strips leading 0 on decimal values (converts 0.5px into .5px)
	$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );

	// Strips units if value is 0 (converts 0px to 0)
	$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );

	// Converts all zeros value into short-hand
	$css = preg_replace( '/0 0 0 0/', '0', $css );

	// Shortern 6-character hex color codes to 3-character where possible
	$css = preg_replace( '/#([a-f0-9])\\1([a-f0-9])\\2([a-f0-9])\\3/i', '#\1\2\3', $css );

	return trim( $css );

	}
}

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


function typehub_google_fonts_url( $config ) {
    $font_url = '';
    
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'typehub' ) ) {
        $font_url = add_query_arg( 'family', $config, "//fonts.googleapis.com/css" );
    }
    return $font_url;
}

?>