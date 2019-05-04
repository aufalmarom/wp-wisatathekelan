<?php 
if (isset($_POST['niteoCS_contact_email_'.$themeslug])) {
	update_option('niteoCS_contact_email['.$themeslug.']', sanitize_text_field($_POST['niteoCS_contact_email_'.$themeslug]));
}

$niteoCS_contact_email 		= get_option('niteoCS_contact_email['.$themeslug.']', 'john.doe@email.com');
?>



			<div class="table-wrapper content" id="copyright-section">
				<h3><?php _e('Footer Content', 'cmp-coming-soon-maintenance');?></h3>
				<table class="content">
				<tbody>
					<tr>
						<th><h4><?php _e('Copyright', 'cmp-coming-soon-maintenance');?></h4></th>
						<td>
							<fieldset>
								<input type="text" name="niteoCS_copyright" id="niteoCS_copyright" value="<?php echo esc_attr( $this->niteo_sanitize_html($niteoCS_copyright)); ?>" class="regular-text code">
							</fieldset>
						</td>
					</tr>

					<?php if ( $this->cmp_selectedTheme() == 'stylo' ): ?>
					<tr>
						<th><h4><?php _e('Contact Email', 'cmp-coming-soon-maintenance');?></h4></th>
						<td>
							<fieldset>
								<input type="text" name="niteoCS_contact_email_<?php echo esc_attr($themeslug);?>" value="<?php echo esc_attr( $niteoCS_contact_email );?>" class="regular-text code">
							</fieldset>
						</td>
					</tr>
					<?php endif;?>
					
					<?php echo $this->render_settings->submit(); ?>

				</tbody>
				</table>
			</div>

			<?php if ( $this->cmp_selectedTheme() == 'eclipse' ):
				if (isset($_POST['niteoCS_contact_content_'.$themeslug])) {
					update_option('niteoCS_contact_content['.$themeslug.']', sanitize_text_field($_POST['niteoCS_contact_content_'.$themeslug]));
				}

				if (isset($_POST['niteoCS_contact_title_'.$themeslug])) {
					update_option('niteoCS_contact_title['.$themeslug.']', sanitize_text_field($_POST['niteoCS_contact_title_'.$themeslug]));
				}

				if (isset($_POST['niteoCS_contact_title_'.$themeslug])) {
					update_option('niteoCS_contact_title['.$themeslug.']', sanitize_text_field($_POST['niteoCS_contact_title_'.$themeslug]));
				}

				if (isset($_POST['niteoCS_contact_phone_'.$themeslug])) {
					update_option('niteoCS_contact_phone['.$themeslug.']', sanitize_text_field($_POST['niteoCS_contact_phone_'.$themeslug]));
				}

				$niteoCS_contact_content 	= stripslashes(get_option('niteoCS_contact_content['.$themeslug.']', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'));
				$niteoCS_contact_title 		= get_option('niteoCS_contact_title['.$themeslug.']', 'Quick Contacts');
				$niteoCS_contact_phone 		= get_option('niteoCS_contact_phone['.$themeslug.']', '+123456789'); ?>

				<div class="table-wrapper content">
					<h3><?php _e('Extended Footer Content', 'cmp-coming-soon-maintenance');?></h3>
					<table class="theme-setup">

					<tr>
						<th><h4><?php _e('Content', 'cmp-coming-soon-maintenance');?></h4></th>
						<td>
							<fieldset>
								<textarea name="niteoCS_contact_content_<?php echo esc_attr($themeslug);?>" rows="5"><?php echo esc_attr( $niteoCS_contact_content ); ?></textarea>
							</fieldset>
						</td>
					</tr>

					<tr>
						<th><h4><?php _e('Contacts Title', 'cmp-coming-soon-maintenance');?></h4></th>
						<td>
							<fieldset>
								<input type="text" name="niteoCS_contact_title_<?php echo esc_attr($themeslug);?>" value="<?php echo esc_attr( $niteoCS_contact_title );?>" class="regular-text code">
							</fieldset>
						</td>
					</tr>

					<tr>
						<th><h4><?php _e('Contact Email', 'cmp-coming-soon-maintenance');?></h4></th>
						<td>
							<fieldset>
								<input type="text" name="niteoCS_contact_email_<?php echo esc_attr($themeslug);?>" value="<?php echo esc_attr( $niteoCS_contact_email );?>" class="regular-text code">
							</fieldset>
						</td>
					</tr>

					<tr>
						<th><h4><?php _e('Contact Phone', 'cmp-coming-soon-maintenance');?></h4></th>
						<td>
							<fieldset>
								<input type="text" name="niteoCS_contact_phone_<?php echo esc_attr($themeslug);?>" value="<?php echo esc_attr( $niteoCS_contact_phone );?>" class="regular-text code">
							</fieldset>
						</td>
					</tr>

					<?php echo $this->render_settings->submit(); ?>
					
					</table>
				</div>
			<?php endif;?>