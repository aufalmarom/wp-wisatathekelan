<?php 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if ( isset( $_POST['niteoCS_special_effect_'.$themeslug] ) ) {
	update_option( 'niteoCS_special_effect['.$themeslug.']', sanitize_text_field($_POST['niteoCS_special_effect_'.$themeslug]) );
}

if ( isset( $_POST['niteoCS_constellation_color_'.$themeslug] ) ) {
	update_option( 'niteoCS_special_effect['.$themeslug.'][constellation][color]', sanitize_text_field($_POST['niteoCS_constellation_color_'.$themeslug]) );
}

$special_effect  		= get_option('niteoCS_special_effect['.$themeslug.']', 'disabled');
$constellation_color 	= get_option('niteoCS_special_effect['.$themeslug.'][constellation][color]', '#ffffff');

?>

	<div class="table-wrapper theme-setup special-effects">
			<h3><?php _e('Special Effects', 'cmp-coming-soon-maintenance');?></h3>
			<table class="theme-setup">
			<tbody>
				<tr>
					<th>
						<fieldset>
							<legend class="screen-reader-text">
								<span><?php _e('Special Effects', 'cmp-coming-soon-maintenance');?></span>
							</legend>

							<p>
								<label title="Constellation">
								 	<input type="radio" class="special-effect" name="niteoCS_special_effect_<?php echo esc_attr( $themeslug );?>" value="constellation" <?php checked( 'constellation', $special_effect );?>>&nbsp;<?php _e('Constellation', 'cmp-coming-soon-maintenance');?>
								</label>
							</p>

							<p>
								<label title="Disabled">
								 	<input type="radio" class="special-effect" name="niteoCS_special_effect_<?php echo esc_attr( $themeslug );?>" value="disabled" <?php checked( 'disabled', $special_effect );?>>&nbsp;<?php _e('Disabled', 'cmp-coming-soon-maintenance');?>
								</label>
							</p>

						</fieldset>
					</th>

					<td>
						<fieldset class="special-effect-switch disabled">
							<p><?php _e('Disabled', 'cmp-coming-soon-maintenance')?></p>

						</fieldset>

						<fieldset class="special-effect-switch constellation">
						<label for="niteoCS_constellation_color_<?php echo esc_attr( $themeslug );?>"><?php _e('Constellation color', 'cmp-coming-soon-maintenance');?></label><br><br>
						<input type="text" name="niteoCS_constellation_color_<?php echo esc_attr( $themeslug );?>" id="niteoCS_constellation_color" value="<?php echo esc_attr( $constellation_color ); ?>" data-default-color="#ffffff" class="regular-text code"><br>


						</fieldset>

					</td>
				</tr>

				<?php echo $this->render_settings->submit(); ?>
				
				</tbody>
			</table>

		</div>

		<script>
		jQuery(document).ready(function($){
			// ini color picker
			jQuery('#niteoCS_constellation_color').wpColorPicker();
		});
		</script>
