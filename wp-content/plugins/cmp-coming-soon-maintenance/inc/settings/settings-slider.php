<?php 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// check onces and wordpress rights, else DIE
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	if( !wp_verify_nonce($_POST['save_options_field'], 'save_options') || !current_user_can('publish_pages') ) {
		die('Sorry, but this request is invalid');
	}
}

if (isset($_POST['niteoCS_slider_'.$themeslug]) && is_numeric($_POST['niteoCS_slider_'.$themeslug])) {
	update_option('niteoCS_slider['.$themeslug.']', sanitize_text_field($_POST['niteoCS_slider_'.$themeslug]));
}

if (isset($_POST['niteoCS_slider_count_'.$themeslug]) && is_numeric($_POST['niteoCS_slider_count_'.$themeslug])) {
	update_option('niteoCS_slider_count['.$themeslug.']', sanitize_text_field($_POST['niteoCS_slider_count_'.$themeslug]));
}

if (isset($_POST['niteoCS_slider_effect_'.$themeslug])) {
	update_option('niteoCS_slider_effect['.$themeslug.']', sanitize_text_field($_POST['niteoCS_slider_effect_'.$themeslug]));
}

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

	if (isset($_POST['niteoCS_slider_auto_'.$themeslug])) {
		update_option('niteoCS_slider_auto['.$themeslug.']', $this->sanitize_checkbox($_POST['niteoCS_slider_auto_'.$themeslug]));
	} else {
		update_option('niteoCS_slider_auto['.$themeslug.']', 'false');
	}
}

$niteoCS_slider			= get_option('niteoCS_slider['.$themeslug.']', '0');
$niteoCS_slider_count	= get_option('niteoCS_slider_count['.$themeslug.']', '3');
$niteoCS_slider_effect  = get_option('niteoCS_slider_effect['.$themeslug.']', 'true');
$niteoCS_banner 		= get_option('niteoCS_banner['.$themeslug.']', '0');
$niteoCS_slider_auto 	= get_option('niteoCS_slider_auto['.$themeslug.']', '1');


?>

<div class="table-wrapper theme-setup slider">
	<h3><?php _e('Image Slider Setup', 'cmp-coming-soon-maintenance');?></h3>
	<table class="theme-setup slider">
		<tr>
			<th>
				<fieldset>
					<legend class="screen-reader-text">
						<span><?php _e('Slider setup', 'cmp-coming-soon-maintenance');?></span>
					</legend>

					<p>
						<label title="Enabled">
						 	<input type="radio" <?php echo ( $niteoCS_banner == '1' || $niteoCS_banner == '0' ) ? '' : 'disabled';?> name="niteoCS_slider_<?php echo esc_attr($themeslug);?>" value="1"<?php checked ( 1, $niteoCS_slider ); ?>>&nbsp;<?php _e('Enabled', 'cmp-coming-soon-maintenance');?>
						</label>
					</p>

					<p>
						<label title="Disabled">
						 	<input type="radio" <?php echo ( $niteoCS_banner == '1' || $niteoCS_banner == '0' ) ? '' : 'disabled';?> name="niteoCS_slider_<?php echo esc_attr($themeslug);?>" value="0"<?php checked ( 0, $niteoCS_slider )?>;>&nbsp;<?php _e('Disabled', 'cmp-coming-soon-maintenance');?>
						</label>
					</p>

				</fieldset>
			</th>

			<td id="slider-disabled">
				<p><?php _e('Slider is disabled.', 'cmp-coming-soon-maintenance');?></p>
			</td>

			<td id="slider-enabled">
				<p><?php _e('To display Slider on CMP Landing page make sure you inserted two or more Custom Photos from Media Library. Slider is also disabled when Specific Unsplash photo or Default Media is selected.', 'cmp-coming-soon-maintenance');?></p>
				<fieldset>
					<legend class="screen-reader-text">
						<span><?php _e('Slider setup', 'cmp-coming-soon-maintenance');?></span>
					</legend>
					<p>
						<label for="niteoCS_slider_effect">Slider Effect</label><br>
						<label title="Slide Effect">
						 	<input type="radio" name="niteoCS_slider_effect_<?php echo esc_attr($themeslug);?>" <?php echo ( $niteoCS_banner == '1' || $niteoCS_banner == '0' ) ? '' : 'disabled';?> value="false"<?php checked ( 'false', $niteoCS_slider_effect );?>>&nbsp;<?php _e('Slide', 'cmp-coming-soon-maintenance');?>
						</label><br>

						<label title="Fade Effect">
						 	<input type="radio" name="niteoCS_slider_effect_<?php echo esc_attr($themeslug);?>" <?php echo ( $niteoCS_banner == '1' || $niteoCS_banner == '0' ) ? '' : 'disabled';?> value="true"<?php checked ( 'true', $niteoCS_slider_effect );?>>&nbsp;<?php _e('Fade', 'cmp-coming-soon-maintenance');?>
						</label>

						<?php
						 // include Slice option for slider 
						if ( $this->cmp_selectedTheme() == 'fifty' ) { ?>
							<br><label title="Slice Effect">
							 	<input type="radio" name="niteoCS_slider_effect_<?php echo esc_attr($themeslug);?>" <?php echo ( $niteoCS_banner == '1' || $niteoCS_banner == '0' ) ? '' : 'disabled';?> value="slice"<?php checked ( 'slice', $niteoCS_slider_effect );?>>>&nbsp;<?php _e('Slice', 'cmp-coming-soon-maintenance');?>
							</label>
							<?php
						} ?>

					</p>

					<p>
					<input type="checkbox" name="niteoCS_slider_auto_<?php echo esc_attr( $themeslug );?>" <?php echo ( $niteoCS_banner == '1' || $niteoCS_banner == '0' ) ? '' : 'disabled';?> id="niteoCS_slider_auto" value="1" <?php checked( '1', $niteoCS_slider_auto ); ?> class="regular-text code"><label for="niteoCS_slider_auto"><?php _e('Slider Autostart', 'cmp-coming-soon-maintenance');?></label><br>
					</p>

					<label for="niteoCS_slider_count"><?php _e('Number of Unplash media Slides (applies only for Unsplash photos)', 'cmp-coming-soon-maintenance');?></label></br>
					<select name="niteoCS_slider_count_<?php echo esc_attr($themeslug);?>" <?php echo ( $niteoCS_banner != '1' ) ? 'disabled' : '';?>>
						<option value="2" <?php if ( $niteoCS_slider_count == '2' ) { echo ' selected="selected"'; } ?>>2</option>
						<option value="3" <?php if ( $niteoCS_slider_count == '3' ) { echo ' selected="selected"'; } ?>>3</option>
						<option value="4" <?php if ( $niteoCS_slider_count == '4' ) { echo ' selected="selected"'; } ?>>4</option>
						<option value="5" <?php if ( $niteoCS_slider_count == '5' ) { echo ' selected="selected"'; } ?>>5</option>
					</select>
					

				</fieldset>
			</td>
		</tr>

		<?php echo $this->render_settings->submit(); ?>
		
	</table>
</div>

<script>
jQuery(document).ready(function($){
	// enable/disable slider
	$('#csoptions input[name="niteoCS_slider_<?php echo esc_attr($themeslug);?>"]').bind('change', function(){
		if ( jQuery('#csoptions input[name="niteoCS_slider_<?php echo esc_attr($themeslug);?>"]:checked' ).val() == 0 ) {
			jQuery('#slider-disabled').css('display','block');
			jQuery('#slider-enabled').css('display','none');

		} else if ( jQuery('#csoptions input[name="niteoCS_slider_<?php echo esc_attr($themeslug);?>"]:checked' ).val() == 1 ) {
			jQuery('#slider-disabled').css('display','none');
			jQuery('#slider-enabled').css('display','block');
		} 
	}).trigger('change');


	jQuery('#csoptions input[name="niteoCS_banner_<?php echo esc_attr($themeslug);?>"]').bind('change', function () {

		switch( jQuery('#csoptions input[name="niteoCS_banner_<?php echo esc_attr($themeslug);?>"]:checked' ).val() ) {
		    case '0':
		    	jQuery('.table-wrapper.slider input, .table-wrapper.slider select').prop('disabled', false);
		        jQuery('#csoptions select[name="niteoCS_slider_count_<?php echo esc_attr($themeslug);?>"]').attr('disabled', true);

		        break;
		    case '1':
		    	if (jQuery('select[name="unsplash_feed_<?php echo esc_attr($themeslug);?>"]').val() != 0 ) {
		    		jQuery('.table-wrapper.slider input, .table-wrapper.slider select').prop('disabled', false);
		    	}
		        break;
		        
		    default:
		        jQuery('.table-wrapper.slider input, .table-wrapper.slider select').prop('disabled', true);
		}
	}).trigger('change');


});
</script>
