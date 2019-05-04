<?php
/**
 * Generic Tweaks to change various things in the theme.
 *
 * @package Hestia
 */

/**
 * Class Hestia_Tweaks
 */
class Hestia_Tweaks extends Hestia_Abstract_Main {

	/**
	 * Initialize Tweaks.
	 */
	public function init() {
		$this->loader->add_filter( 'body_class', $this, 'body_classes' );
		$this->loader->add_filter( 'excerpt_length', $this, 'change_excerpt_length', 999 );
		$this->loader->add_filter( 'excerpt_more', $this, 'change_excerpt_more' );
		$this->loader->add_filter( 'comment_form_fields', $this, 'comment_message' );
		$this->loader->add_filter( 'comment_form_default_fields', $this, 'comment_form_args' );
		$this->loader->add_filter( 'repeater_input_labels_filter', $this, 'slider_repeater_labels', 10, 3 );
		$this->loader->add_filter( 'hestia_repeater_input_types_filter', $this, 'repeater_input_types', 10, 3 );
	}

	/**
	 * Add appropriate classes to body tag.
	 *
	 * @param string $classes body classes.
	 *
	 * @return string
	 * @since Hestia 1.0
	 */
	public function body_classes( $classes ) {
		if ( is_singular() ) {
			$classes[] = 'blog-post';
		}

		return $classes;
	}

	/**
	 * Define excerpt length.
	 *
	 * @since Hestia 1.0
	 * @return string
	 */
	function change_excerpt_length() {
		if ( ( 'page' === get_option( 'show_on_front' ) && is_front_page() ) || is_single() ) {
			return 35;
		}
		if ( is_home() ) {
			if ( is_active_sidebar( 'sidebar-1' ) ) {
				return 40;
			} else {
				return 75;
			}
		} else {
			return 50;
		}
	}

	/**
	 * Replace excerpt "Read More" text with a link.
	 *
	 * @param  string $more [...].
	 *
	 * @return string
	 * @since Hestia 1.0
	 */
	public function change_excerpt_more( $more ) {
		global $post;
		if ( ( ( 'page' === get_option( 'show_on_front' ) ) && is_front_page() ) || is_single() || is_archive() || is_home() ) {
			return '<a class="moretag" href="' . esc_url( get_permalink( $post->ID ) ) . '"> ' . esc_html__( 'Read more&hellip;', 'hestia' ) . '</a>';
		}

		return $more;
	}


	/**
	 * Move comment field above user details.
	 *
	 * @param array $fields comment form fields.
	 *
	 * @return array
	 * @since Hestia 1.0
	 */
	public function comment_message( $fields ) {

		if ( array_key_exists( 'comment', $fields ) ) {
			$comment_field = $fields['comment'];
			unset( $fields['comment'] );
			$fields['comment'] = $comment_field;
		}

		if ( array_key_exists( 'cookies', $fields ) ) {
			$cookie_field = $fields['cookies'];
			unset( $fields['cookies'] );
			$fields['cookies'] = $cookie_field;
		}

		return $fields;
	}

	/**
	 * Add markup to comment form fields.
	 *
	 * @param array $fields Comment form fields.
	 *
	 * @return array
	 */
	public function comment_form_args( $fields ) {
		$req      = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

		$fields['author'] = '<div class="row"> <div class="col-md-4"> <div class="form-group label-floating is-empty"> <label class="control-label">' . esc_html__( 'Name', 'hestia' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label><input id="author" name="author" class="form-control" type="text"' . $aria_req . ' /> <span class="hestia-input"></span> </div> </div>';
		$fields['email']  = '<div class="col-md-4"> <div class="form-group label-floating is-empty"> <label class="control-label">' . esc_html__( 'Email', 'hestia' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label><input id="email" name="email" class="form-control" type="email"' . $aria_req . ' /> <span class="hestia-input"></span> </div> </div>';
		$fields['url']    = '<div class="col-md-4"> <div class="form-group label-floating is-empty"> <label class="control-label">' . esc_html__( 'Website', 'hestia' ) . '</label><input id="url" name="url" class="form-control" type="url"' . $aria_req . ' /> <span class="hestia-input"></span> </div> </div> </div>';
		return $fields;
	}


	/**
	 * Filter to modify input label in repeater control
	 * You can filter by control id and input name.
	 *
	 * @param string $string  Input label.
	 * @param string $id      Input id.
	 * @param string $control Control name.
	 *
	 * @modified 1.1.41
	 *
	 * @return string
	 */
	public function slider_repeater_labels( $string, $id, $control ) {

		if ( $id === 'hestia_slider_content' ) {
			if ( $control === 'customizer_repeater_text_control' ) {
				return esc_html__( 'Button Text', 'hestia' );
			}

			if ( $control === 'customizer_repeater_color_control' ) {
				return esc_html__( 'Button', 'hestia' ) . ' ' . esc_html__( 'Color', 'hestia' );
			}

			if ( $control === 'customizer_repeater_color2_control' ) {
				return esc_html__( 'Second', 'hestia' ) . ' ' . esc_html__( 'Button', 'hestia' ) . ' ' . esc_html__( 'Color', 'hestia' );
			}

			if ( $control === 'customizer_repeater_text2_control' ) {
				return esc_html__( 'Second', 'hestia' ) . ' ' . esc_html__( 'Button text', 'hestia' );
			}

			if ( $control === 'customizer_repeater_link2_control' ) {
				return esc_html__( 'Second', 'hestia' ) . ' ' . esc_html__( 'Link', 'hestia' );
			}
		}

		return $string;
	}


	/**
	 * Filter to modify input type in repeater control
	 * You can filter by control id and input name.
	 *
	 * @param string $string Input label.
	 * @param string $id Input id.
	 * @param string $control Control name.
	 *
	 * @modified 1.1.41
	 *
	 * @return string
	 */
	public function repeater_input_types( $string, $id, $control ) {

		if ( $id === 'hestia_slider_content' ) {
			if ( $control === 'customizer_repeater_text_control' ) {
				return '';
			}
			if ( $control === 'customizer_repeater_text2_control' ) {
				return '';
			}
			if ( $control === 'customizer_repeater_subtitle_control' ) {
				return 'textarea';

			}
		}

		return $string;
	}

}
