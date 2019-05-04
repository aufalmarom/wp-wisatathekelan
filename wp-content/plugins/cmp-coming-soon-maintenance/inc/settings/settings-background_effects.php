<?php 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if (isset($_POST['niteoCS_effect_'.$themeslug])) {
	update_option('niteoCS_effect['.$themeslug.']', sanitize_text_field($_POST['niteoCS_effect_'.$themeslug]));
}


if (isset($_POST['niteoCS_effect_blur_'.$themeslug]) && is_numeric($_POST['niteoCS_effect_blur_'.$themeslug])) {
	update_option('niteoCS_effect_blur['.$themeslug.']', sanitize_text_field($_POST['niteoCS_effect_blur_'.$themeslug]));
}


$background_effect  = get_option('niteoCS_effect['.$themeslug.']', 'disabled');
$effect_blur 		= get_option('niteoCS_effect_blur['.$themeslug.']', '0.5');

?>
		<div class="table-wrapper theme-setup background-effects">
			<h3><?php _e('Background Effects', 'cmp-coming-soon-maintenance');?></h3>
			<table class="theme-setup">
			<tbody>
				<tr>
					<th>
						<fieldset>
							<legend class="screen-reader-text">
								<span><?php _e('Background Effects', 'cmp-coming-soon-maintenance');?></span>
							</legend>

							<p>
								<label title="Blur">
								 	<input type="radio" class="background-effect" name="niteoCS_effect_<?php echo esc_attr( $themeslug );?>" value="blur" <?php checked( 'blur', $background_effect );?>>&nbsp;<?php _e('Blur', 'cmp-coming-soon-maintenance');?>
								</label>
							</p>

							<p>
								<label title="Disabled">
								 	<input type="radio" class="background-effect" name="niteoCS_effect_<?php echo esc_attr( $themeslug );?>" value="disabled" <?php checked( 'disabled', $background_effect );?>>&nbsp;<?php _e('Disabled', 'cmp-coming-soon-maintenance');?>
								</label>
							</p>

						</fieldset>
					</th>

					<td>
						<fieldset class="background-effect-switch disabled">
							<p><?php _e('Disabled', 'cmp-coming-soon-maintenance')?></p>

						</fieldset>

						<fieldset class="background-effect-switch blur">

							<label for="niteoCS_effect_blur_<?php echo esc_attr( $themeslug );?>"><?php _e('Blur amount', 'cmp-coming-soon-maintenance');?>: <span><?php echo esc_attr( $effect_blur ); ?></span>px</label></br>
							<input type="range" class="blur-range" name="niteoCS_effect_blur_<?php echo esc_attr( $themeslug );?>" min="0.5" max="10" step="0.5" value="<?php echo esc_attr( $effect_blur ); ?>" />
						</fieldset>

					</td>
				</tr>

				<?php echo $this->render_settings->submit(); ?>
				
				</tbody>
			</table>

		</div>