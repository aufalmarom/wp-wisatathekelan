<?php 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

?>

<style>
	#social-section tr:first-of-type {display: none!important;}
</style>

<div class="table-wrapper theme-setup">
	<h3><?php _e('Customize Colors', 'cmp-coming-soon-maintenance');?></h3>
	<table class="theme-setup">

	<tr>
		<th><h4><?php _e('Font Color', 'cmp-coming-soon-maintenance');?></h4></th>
		<td>
			<fieldset>
				<input type="text" name="niteoCS_font_color_<?php echo esc_attr($themeslug);?>" id="niteoCS_font_color" value="<?php echo esc_attr( $font_color); ?>" data-default-color="#494949" class="regular-text code"><br>
			</fieldset>
		</td>
	</tr>
	<tr>
		<th><h4><?php _e('Overlay Color', 'cmp-coming-soon-maintenance');?></h4></th>
		<td>
			<fieldset id="overlay-color">
				<input type="text" name="niteoCS_overlay_color_<?php echo esc_attr($themeslug);?>" id="niteoCS_overlay_color" value="<?php echo esc_attr( $overlay_color); ?>" data-default-color="#0a0a0a" class="regular-text code"><br>
			</fieldset>

			<fieldset>
				<label for="niteoCS_overlay_opacity_<?php echo esc_attr($themeslug);?>"><?php _e('Overlay Opacity', 'cmp-coming-soon-maintenance');?>: <span>: <?php echo esc_attr( $overlay_opacity); ?></span></label><br>
				<input type="range" class="overlay-opacity" name="niteoCS_overlay_opacity_<?php echo esc_attr($themeslug);?>" min="0" max="1" step="0.1" value="<?php echo esc_attr( $overlay_opacity); ?>" />
			</fieldset>	
		</td>
	</tr>
	<tr><th>
		<p class="cmp-submit">
			<?php wp_nonce_field('save_options','save_options_field'); ?>
			<input type="submit" name="Submit" class="button cmp-button submit" value="<?php _e('Save All Changes', 'cmp-coming-soon-maintenance'); ?>" id="submitChanges" />
		</p>
	</th></tr>
	</table>

</div>


<script>
jQuery(document).ready(function($){
	// ini color picker
	jQuery('#niteoCS_font_color').wpColorPicker();
	jQuery('#niteoCS_overlay_color').wpColorPicker();

	// hiding subscribe from on change
    jQuery('#niteoCS_overlay_checkbox').change(function() {

        if( jQuery(this)[0].checked ) {
            jQuery('#overlay-color').css('display','block')
        } else {
        	jQuery('#overlay-color').css('display','none')
        }
    });
});
</script>
