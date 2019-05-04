<?php 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
?>

<div class="table-wrapper theme-setup wrapper-disabled closed">
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
						 	<input disabled type="radio" class="special-effect" name="niteoCS_special_effect_<?php echo esc_attr( $themeslug );?>" value="constellation">&nbsp;<?php _e('Constellation', 'cmp-coming-soon-maintenance');?>
						</label>
					</p>

					<p>
						<label title="Disabled">
						 	<input disabled type="radio" class="special-effect" name="niteoCS_special_effect_<?php echo esc_attr( $themeslug );?>" checked="checked" value="disabled">&nbsp;<?php _e('Disabled', 'cmp-coming-soon-maintenance');?>
						</label>
					</p>

				</fieldset>
			</th>

			<td>
				<fieldset class="special-effect-switch disabled">
					<p><?php _e('Special Effects are disabled or they are not supported by selected Theme.', 'cmp-coming-soon-maintenance')?></p>

				</fieldset>

			</td>
		</tr>

		<?php echo $this->render_settings->submit(); ?>
		
		</tbody>
	</table>
</div>