<?php
/**
 * The Contact Section
 *
 * @package Hestia
 */

/**
 * Class Hestia_Contact_Section
 */
class Hestia_Contact_Section extends Hestia_Abstract_Main {
	/**
	 * Initialize section.
	 */
	public function init() {
		$this->hook_section();
	}

	/**
	 * Hook section in.
	 */
	private function hook_section() {
		$section_priority = apply_filters( 'hestia_section_priority', 65, 'hestia_contact' );
		$this->loader->add_action( 'hestia_sections', $this, 'render_section', absint( $section_priority ) );
	}

	/**
	 * Contact section content.
	 * This function can be called from a shortcode too.
	 * When it's called as shortcode, the title and the subtitle shouldn't appear and it should be visible all the time,
	 * it shouldn't matter if is disable on front page.
	 *
	 * @since Hestia 1.0
	 * @modified 1.1.51
	 */
	function render_section( $is_shortcode = false ) {

		/**
		 * Don't show section if Disable section is checked.
		 * Show it if it's called as a shortcode.
		 */
		$hide_section  = get_theme_mod( 'hestia_contact_hide', false );
		$section_style = '';
		if ( $is_shortcode === false && (bool) $hide_section === true ) {
			if ( is_customize_preview() ) {
				$section_style .= 'display: none;';
			} else {
				return;
			}
		}

		/**
		 * Gather data to display the section.
		 */
		if ( current_user_can( 'edit_theme_options' ) ) {
			/* translators: 1 - link to customizer setting. 2 - 'customizer' */
			$hestia_contact_subtitle = get_theme_mod( 'hestia_contact_subtitle', sprintf( __( 'Change this subtitle in %s.', 'hestia' ), sprintf( '<a href="%1$s" class="default-link">%2$s</a>', esc_url( admin_url( 'customize.php?autofocus&#91;control&#93;=hestia_contact_subtitle' ) ), __( 'customizer', 'hestia' ) ) ) );
		} else {
			$hestia_contact_subtitle = get_theme_mod( 'hestia_contact_subtitle' );
		}
		$hestia_contact_title      = get_theme_mod( 'hestia_contact_title', esc_html__( 'Get in Touch', 'hestia' ) );
		$hestia_contact_area_title = get_theme_mod( 'hestia_contact_area_title', esc_html__( 'Contact Us', 'hestia' ) );

		$hestia_contact_background = get_theme_mod( 'hestia_contact_background', apply_filters( 'hestia_contact_background_default', get_template_directory_uri() . '/assets/img/contact.jpg' ) );
		if ( ! empty( $hestia_contact_background ) ) {
			$section_style .= 'background-image: url(' . esc_url( $hestia_contact_background ) . ');';
		}
		$section_style = 'style="' . $section_style . '"';

		/**
		 * In case this function is called as shortcode, we remove the container and we add 'is-shortcode' class.
		 */
		$class_to_add  = $is_shortcode === true ? 'is-shortcode' : '';
		$class_to_add .= ! empty( $hestia_contact_background ) ? 'section-image' : '';

		hestia_before_contact_section_trigger(); ?>
		<section class="hestia-contact contactus <?php echo esc_attr( $class_to_add ); ?>" id="contact"
				data-sorder="hestia_contact" <?php echo wp_kses_post( $section_style ); ?>>
			<?php
			hestia_before_contact_section_content_trigger();
			if ( $is_shortcode === false ) {
				hestia_display_customizer_shortcut( 'hestia_contact_hide', true );
			}
			?>
			<div class="container">
				<?php hestia_top_contact_section_content_trigger(); ?>
				<div class="row">
					<div class="col-md-5 hestia-contact-title-area" <?php echo hestia_add_animationation( 'fade-right' ); ?>>
						<?php
						hestia_display_customizer_shortcut( 'hestia_contact_title' );
						if ( ! empty( $hestia_contact_title ) || is_customize_preview() ) :
							?>
							<h2 class="hestia-title"><?php echo wp_kses_post( $hestia_contact_title ); ?></h2>
						<?php endif; ?>
						<?php if ( ! empty( $hestia_contact_subtitle ) || is_customize_preview() ) : ?>
							<h5 class="description"><?php echo hestia_sanitize_string( $hestia_contact_subtitle ); ?></h5>
						<?php endif; ?>
						<?php

						$contact_content_default = '';
						if ( current_user_can( 'edit_theme_options' ) ) {
							$contact_content_default = $this->content_default();
						}

						$hestia_contact_content = get_theme_mod( 'hestia_contact_content_new', wp_kses_post( $contact_content_default ) );
						if ( ! empty( $hestia_contact_content ) ) {
							echo '<div class="hestia-description">';
							echo wp_kses_post( force_balance_tags( $hestia_contact_content ) );
							echo '</div>';
						}

						?>
					</div>
					<?php
					$hestia_contact_form_shortcode_default = '[pirate_forms]';
					$hestia_contact_form_shortcode         = get_theme_mod( 'hestia_contact_form_shortcode', $hestia_contact_form_shortcode_default );
					if ( defined( 'PIRATE_FORMS_VERSION' ) || ( $hestia_contact_form_shortcode != $hestia_contact_form_shortcode_default ) ) {
						?>
						<div class="col-md-5 col-md-offset-2 hestia-contact-form-col" <?php echo hestia_add_animationation( 'fade-left' ); ?>>
							<div class="card card-contact">
								<?php if ( ! empty( $hestia_contact_area_title ) || is_customize_preview() ) : ?>
									<div class="header header-raised header-primary text-center">
										<h4 class="card-title"><?php echo esc_html( $hestia_contact_area_title ); ?></h4>
									</div>
								<?php endif; ?>
								<div class="content">
									<?php
									$this->render_contact_form();
									?>
								</div>
							</div>
						</div>
						<?php

					} elseif ( is_customize_preview() ) {
						$this->form_placeholder();
					}
					?>
				</div>
				<?php hestia_bottom_contact_section_content_trigger(); ?>
			</div>
			<?php hestia_after_contact_section_content_trigger(); ?>
		</section>
		<?php
		hestia_after_contact_section_trigger();
	}

	/**
	 * Get the contact default content
	 *
	 * @return string
	 */
	public function content_default() {
		$html = '<div class="hestia-info info info-horizontal">
			<div class="icon icon-primary">
				<i class="fa fa-map-marker"></i>
			</div>
			<div class="description">
				<h4 class="info-title"> Find us at the office </h4>
				<p>Bld Mihail Kogalniceanu, nr. 8,7652 Bucharest, Romania</p>
			</div>
		</div>
		<div class="hestia-info info info-horizontal">
			<div class="icon icon-primary">
				<i class="fa fa-mobile"></i>
			</div>
			<div class="description">
				<h4 class="info-title">Give us a ring</h4>
				<p>Michael Jordan <br> +40 762 321 762<br>Mon - Fri, 8:00-22:00</p>
			</div>
		</div>';

		return apply_filters( 'hestia_contact_content_default', $html );
	}

	/**
	 * Render contact form via shortcode input.
	 */
	private function render_contact_form() {
		$contact_form_shortcode = get_theme_mod( 'hestia_contact_form_shortcode', '[pirate_forms]' );

		if ( empty( $contact_form_shortcode ) ) {
			echo do_shortcode( '[pirate_forms]' );
			return;
		}

		echo do_shortcode( wp_kses_post( $contact_form_shortcode ) );
	}

	/**
	 * Render the contact form placeholder for the contact section.
	 *
	 * @since 1.1.31
	 * @access public
	 */
	private function form_placeholder() {
		echo '
<div class="col-md-5 col-md-offset-2 pirate-forms-placeholder">
    <div class="card card-contact">
        <div class="header header-raised header-primary text-center">
            <h4 class="hestia-title">' . esc_html__( 'Contact Us', 'hestia' ) . '</h4>
        </div>
        <div class="pirate-forms-placeholder-overlay">
        	<div class="pirate-forms-placeholder-align">
            	<h4 class="placeholder-text"> ' . esc_html__( 'In order to add a contact form to this section, you need to install the Pirate Forms plugin.', 'hestia' ) . ' </h4>
            </div>
		</div>
        <div class="content">
        	
	        <div class="pirate_forms_wrap">
	            <form class="pirate_forms ">
	                <div class="pirate_forms_three_inputs_wrap">
	                    <div class="col-sm-4 col-lg-4 form_field_wrap contact_name_wrap pirate_forms_three_inputs  ">
	                        <label for="pirate-forms-contact-name"></label>
					        <input id="pirate-forms-contact-name" class="form-control" type="text" value="" placeholder="Your Name">
                        </div>
                        <div class="col-sm-4 col-lg-4 form_field_wrap contact_email_wrap pirate_forms_three_inputs">
                            <label for="pirate-forms-contact-email"></label>
                            <input id="pirate-forms-contact-email" class="form-control" type="email" value="" placeholder="Your Email">
					    </div>
					    <div class="col-sm-4 col-lg-4 form_field_wrap contact_subject_wrap pirate_forms_three_inputs">
					        <label for="pirate-forms-contact-subject"></label>
					        <input id="pirate-forms-contact-subject" class="form-control" type="text" value="" placeholder="Subject">
                        </div>
                    </div>
                </form>
                <div class="col-sm-12 col-lg-12 form_field_wrap contact_message_wrap">
    					<textarea id="pirate-forms-contact-message" required="" class="form-control" placeholder="Your message"></textarea>
                    </div>
                <div class="col-xs-12 form_field_wrap contact_submit_wrap">
					    <button id="pirate-forms-contact-submit" class="pirate-forms-submit-button" type="submit">Send Message</button>
                    </div>
                <div class="pirate_forms_clearfix"></div>
            </div>
        </div>
    </div>
</div>';
	}
}
