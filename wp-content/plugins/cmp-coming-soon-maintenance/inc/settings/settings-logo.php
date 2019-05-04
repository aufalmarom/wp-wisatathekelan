<?php 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
?>
<div class="table-wrapper theme-setup">
	<h3><?php _e('Logo Setup', 'cmp-coming-soon-maintenance');?></h3>
	<table class="theme-setup">
		<tbody>
		<tr>
			<th>
				<fieldset>
					<legend class="screen-reader-text">
						<span><?php _e('Logo setup', 'cmp-coming-soon-maintenance');?></span>
					</legend>

					<p>
						<label title="<?php _e('Text Logo', 'cmp-coming-soon-maintenance');?>">
						 	<input type="radio" class="cmp-logo" name="niteoCS_logo_type_<?php echo esc_attr($themeslug);?>" value="text"<?php if ( $niteoCS_logo_type == 'text') { echo ' checked="checked"'; } ?>>&nbsp;<?php _e('Text Logo', 'cmp-coming-soon-maintenance');?>
						</label>
					</p>

					<p>
						<label title="<?php _e('Graphic Logo', 'cmp-coming-soon-maintenance');?>">
						 	<input type="radio" class="cmp-logo" name="niteoCS_logo_type_<?php echo esc_attr($themeslug);?>" value="graphic"<?php if ( $niteoCS_logo_type == 'graphic') { echo ' checked="checked"'; } ?>>&nbsp;<?php _e('Graphic Logo', 'cmp-coming-soon-maintenance');?>
						</label>
					</p>

					<p>
						<label title="<?php _e('Disabled', 'cmp-coming-soon-maintenance');?>">
						 	<input type="radio" class="cmp-logo" name="niteoCS_logo_type_<?php echo esc_attr($themeslug);?>" value="disabled"<?php if ( $niteoCS_logo_type == 'disabled') { echo ' checked="checked"'; } ?>>&nbsp;<?php _e('Disabled', 'cmp-coming-soon-maintenance');?>
						</label>
					</p>

				</fieldset>
			</th>

			<td>
				<fieldset class="cmp-logo-switch text">
					<p>
						<input type="text" class="widefat" id="niteoCS-text-logo" name="niteoCS_text_logo_<?php echo esc_attr($themeslug);?>" type="text" placeholder="<?php _e('Click to set..', 'cmp-coming-soon-maintenance');?>" value="<?php echo esc_attr($niteoCS_text_logo); ?>" />
					</p>
				</fieldset>

				<fieldset class="cmp-logo-switch graphic">

			        <input type="hidden" class="widefat" id="niteoCS-logo-id" name="niteoCS_logo_id_<?php echo esc_attr($themeslug);?>" type="text" value="<?php echo esc_attr( $niteoCS_logo_id ); ?>" />
			        <input id="add-logo" type="button" class="button" value="Select Logo" />
			        
			        <div class="logo-wrapper">
			        	<?php 
			        	if ( isset($logo_url) && $logo_url !== '' ) {
			        		echo '<img src="'.esc_url($logo_url).'" alt="">';
			        	} ?>
			        </div>
			        <input id="delete-logo" type="button" class="button" value="Remove Logo" />

				</fieldset>

				<p class="cmp-logo-switch disabled"><?php _e('Logo is disabled', 'cmp-coming-soon-maintenance');?></p>
			</td>
		</tr>

		<?php echo $this->render_settings->submit(); ?>
		
		</tbody>
	</table>
</div>