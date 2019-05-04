<?php 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
?>
		<div class="table-wrapper theme-setup background-media">
			<h3><?php _e('Graphic Background', 'cmp-coming-soon-maintenance');?></h3>
			<table class="theme-setup">
			<tbody>
				<tr>
					<th>
						<fieldset>
							<legend class="screen-reader-text">
								<span><?php _e('Banner Settings', 'cmp-coming-soon-maintenance');?></span>
							</legend>

							<p>
								<label title="Default Banner">
								 	<input type="radio" class="niteoCS_banner" name="niteoCS_banner_<?php echo esc_attr($themeslug);?>" value="2"<?php if ( $banner_type == 2) { echo ' checked="checked"'; } ?>>&nbsp;<?php _e('Default Media', 'cmp-coming-soon-maintenance');?>
								</label>
							</p>

							<p>
								<label title="Custom banner">
								 	<input type="radio" class="niteoCS_banner" name="niteoCS_banner_<?php echo esc_attr($themeslug);?>" value="0"<?php if ( $banner_type == 0) { echo ' checked="checked"'; } ?>>&nbsp;<?php _e('Custom Images', 'cmp-coming-soon-maintenance');?>
								</label>
							</p>

							<p>
								<label title="Unsplash banner">
								 	<input type="radio" class="niteoCS_banner" name="niteoCS_banner_<?php echo esc_attr($themeslug);?>" value="1"<?php if ( $banner_type == 1) { echo ' checked="checked"'; } ?>>&nbsp;<?php _e('Unsplash library', 'cmp-coming-soon-maintenance');?>
								</label>
							</p>
							<p>
								<label title="Video Banner">
								 	<input type="radio" class="niteoCS_banner" name="niteoCS_banner_<?php echo esc_attr($themeslug);?>" value="5"<?php if ( $banner_type == 5) { echo ' checked="checked"'; } ?>>&nbsp;<?php _e('Video', 'cmp-coming-soon-maintenance');?>
								</label>
							</p>
							<p>
								<label title="Pattern Banner">
								 	<input type="radio" class="niteoCS_banner" name="niteoCS_banner_<?php echo esc_attr($themeslug);?>" value="3"<?php if ( $banner_type == 3) { echo ' checked="checked"'; } ?>>&nbsp;<?php _e('Graphic Pattern', 'cmp-coming-soon-maintenance');?>
								</label>
							</p>
							<p>
								<label title="Solid Color Banner">
								 	<input type="radio" class="niteoCS_banner" name="niteoCS_banner_<?php echo esc_attr($themeslug);?>" value="4"<?php if ( $banner_type == 4) { echo ' checked="checked"'; } ?>>&nbsp;<?php _e('Solid Color', 'cmp-coming-soon-maintenance');?>
								</label>
							</p>
							<p>
								<label title="Gradient Banner">
								 	<input type="radio" class="niteoCS_banner" name="niteoCS_banner_<?php echo esc_attr($themeslug);?>" value="6"<?php if ( $banner_type == 6) { echo ' checked="checked"'; } ?>>&nbsp;<?php _e('Gradient Color', 'cmp-coming-soon-maintenance');?>
								</label>
							</p>

						</fieldset>
					</th>

					<td class="theme_background">

						<fieldset id="custom_banner">
					        <input type="hidden" class="widefat" id="niteoCS-images-id" name="niteoCS_banner_id_<?php echo esc_attr($themeslug);?>" type="text" value="<?php echo esc_attr( $niteoCS_banner_custom_id ); ?>" />
					        <input id="add-images" type="button" class="button" value="Media Library" />
					        <p class="info"><?php _e('Pro Tip! You can select multiple Media from your library by holding CTRL+click (Command+click if you sit on MacOS) while selecting photos.','cmp-coming-soon-maintenance')?></p>
					        <div class="images-wrapper">
					        	<?php 
					        	if ( isset( $niteoCS_banner_custom_id ) && $niteoCS_banner_custom_id != '' ) {
					        		$ids = explode( ',', $niteoCS_banner_custom_id );
					        		foreach ( $ids as $id ) {
					        			$img = wp_get_attachment_image_src($id, 'large');
					        			if (isset($img[0])) {
					        				echo '<img src="'.$img[0].'" alt="">';
					        			}
					        		}
					        	}
					        	?>
					        </div>
					        <input id="delete-images" type="button" class="button" value="Delete Media" />
						</fieldset>

						<fieldset id="unsplash_banner">

							<label for="unsplash_feed_<?php echo esc_attr($themeslug);?>"><?php _e('Choose Unsplash Feed', 'cmp-coming-soon-maintenance');?></label><br>
							<select name="unsplash_feed_<?php echo esc_attr($themeslug);?>">

							  <option value="3" <?php if ( $niteoCS_unsplash_feed == '3' ) { echo ' selected="selected"'; } ?>><?php _e('Random Photo', 'cmp-coming-soon-maintenance');?></option>

							  <option value="0" <?php if ( $niteoCS_unsplash_feed == '0' ) { echo ' selected="selected"'; } ?>><?php _e('Specific Photo', 'cmp-coming-soon-maintenance');?></option>

							  <option value="2" <?php if ( $niteoCS_unsplash_feed == '2' ) { echo ' selected="selected"'; } ?>><?php _e('Random from Collection', 'cmp-coming-soon-maintenance');?></option>

							  <option value="1" <?php if ( $niteoCS_unsplash_feed == '1' ) { echo ' selected="selected"'; } ?>><?php _e('Random from User', 'cmp-coming-soon-maintenance');?></option>

							</select>
							
							<p class="unsplash-feed" id="unsplash-feed-0">
								<label for="niteoCS_unsplash_0_<?php echo esc_attr($themeslug);?>"><?php _e('Enter Unsplash Photo URL or Unsplash Photo ID', 'cmp-coming-soon-maintenance');?></label>
								<input type="text" class="widefat" id="niteoCS-unsplash-0" name="niteoCS_unsplash_0_<?php echo esc_attr($themeslug);?>" type="text" value="<?php echo esc_attr($niteoCS_unsplash_0); ?>" />
							</p>

							<p class="unsplash-feed" id="unsplash-feed-2">
								<label for="niteoCS_unsplash_2_<?php echo esc_attr($themeslug);?>"><?php printf(__('Enter <a href="%s">Unsplash Collection</a> URL or Collection ID.', 'cmp-coming-soon-maintenance'), 'https://unsplash.com/collections/');?></label>
								<input type="text" class="widefat" id="niteoCS-unsplash-2" name="niteoCS_unsplash_2_<?php echo esc_attr($themeslug);?>" type="text" value="<?php echo esc_attr($niteoCS_unsplash_2); ?>" />
							</p>

							<p><div class="unsplash-feed" id="unsplash-feed-3">
								<label for="niteoCS_unsplash_3_<?php echo esc_attr($themeslug);?>"><?php _e('Limit photos to specific keyword (fashion, nature, technology..)', 'cmp-coming-soon-maintenance');?></label>
								<input type="text" class="widefat" id="niteoCS-unsplash-3" name="niteoCS_unsplash_3_<?php echo esc_attr($themeslug);?>" type="text" value="<?php echo esc_attr($niteoCS_unsplash_3); ?>" />

								<br><br>

								<input type="checkbox" name="niteoCS_unsplash_feat_<?php echo esc_attr($themeslug);?>" id="niteoCS_unsplash_feat" value="1" <?php checked( '1', get_option( 'niteoCS_unsplash_feat['.esc_attr($themeslug).']', '0' ) ); ?> class="regular-text code"><label for="niteoCS_unsplash_feat"><?php _e('Only Unsplash Featured Photos', 'cmp-coming-soon-maintenance');?></label>
							</div></p>

							<p class="unsplash-feed" id="unsplash-feed-1">
								<label for="niteoCS_unsplash_1_<?php echo esc_attr($themeslug);?>"><?php _e('Enter Unsplash User ID', 'cmp-coming-soon-maintenance');?></label>
								<input type="text" class="widefat" id="niteoCS-unsplash-1" name="niteoCS_unsplash_1_<?php echo esc_attr($themeslug);?>" type="text" value="<?php echo esc_attr($niteoCS_unsplash_1); ?>" placeholder="@"/>
							</p>

							<button id="test-unsplash" class="button" data-security="<?php echo esc_attr($ajax_nonce);?>"><?php _e('Display Unsplash Photo', 'cmp-coming-soon-maintenance');?></button>
							
							<div id="unsplash-media"></div>
							
							<p class="unplash-description"><a href="http://unsplash.com" target="_blank">Unsplash</a> <?php _e('is a world leading source for free to use high quality stock images. All of the images that are submitted and published on Unsplash fall under under the <a href="https://unsplash.com/license"> Unsplash license</a>, which means you can use the image for any personal or commercial use.', 'cmp-coming-soon-maintenance');?></p>
							
						</fieldset>

						<fieldset id="default_banner">
					        	<img src="<?php echo esc_url($this->cmp_themeURL($this->cmp_selectedTheme()).$this->cmp_selectedTheme().'/img/'.$this->cmp_selectedTheme().'_banner_large.jpg');?>" alt="Default Media">
						</fieldset>

						<fieldset id="graphic_pattern">
								<label for="niteoCS_banner_pattern_<?php echo esc_attr($themeslug);?>"><?php _e('Select Pattern', 'cmp-coming-soon-maintenance');?></label><br>
								<select name="niteoCS_banner_pattern_<?php echo esc_attr($themeslug);?>" data-url="<?php echo esc_url(WP_PLUGIN_URL . '/cmp-coming-soon-maintenance/img/patterns/');?>">
									<?php 
									foreach ($patterns as $pattern) { ?>
										<option value="<?php echo esc_attr($pattern);?>" <?php if ( $niteoCS_banner_pattern == $pattern ) { echo ' selected="selected"'; } ?>><?php echo esc_html(ucfirst(str_replace('_', ' ', $pattern)));?></option>
										<?php 
									} ?>
									<option value="custom" <?php if ( $niteoCS_banner_pattern == 'custom' ) { echo ' selected="selected"'; } ?>><?php _e('Custom Pattern...', 'cmp-coming-soon-maintenance');?></option>
								</select><br>

						        <input type="hidden" class="widefat" id="niteoCS-pattern-id" name="niteoCS_banner_pattern_custom_<?php echo esc_attr($themeslug);?>" type="text" value="<?php echo esc_attr( $niteoCS_banner_pattern_custom ); ?>" />
								
						        <input id="add-pattern" type="button" class="button" value="Media Library" style="display:<?php echo ($niteoCS_banner_pattern == 'custom') ? 'block' : 'none'?>;"/>
					        
								<div class="pattern-wrapper" style="background-image: url('<?php echo esc_url($pattern_url);?>');"></div>
						</fieldset>

						<fieldset id="solid_color">
								<label for="niteoCS_banner_color_<?php echo esc_attr($themeslug);?>"><?php _e('Select Color', 'cmp-coming-soon-maintenance');?></label><br>
								<input type="text" name="niteoCS_banner_color_<?php echo esc_attr($themeslug);?>" id="niteoCS_banner_color" value="<?php echo esc_attr( $niteoCS_banner_color); ?>" data-default-color="#e5e5e5" class="regular-text code"><br>
								<div class="color-preview" style="background-color:<?php echo esc_attr( $niteoCS_banner_color); ?>"></div>		
						</fieldset>

						<fieldset id="video_banner">
								<label for="niteoCS_banner_video_<?php echo esc_attr($themeslug);?>"><?php _e('Select Video Source', 'cmp-coming-soon-maintenance');?></label><br>
								<select name="niteoCS_banner_video_<?php echo esc_attr($themeslug);?>" class="banner-video-source">
									<option value="YouTube" <?php if ( $niteoCS_banner_video == 'YouTube' ) { echo ' selected="selected"'; } ?>><?php _e('YouTube', 'cmp-coming-soon-maintenance');?></option>
									<option value="video/mp4" <?php if ( $niteoCS_banner_video == 'video/mp4' ) { echo ' selected="selected"'; } ?>><?php _e('Custom Video File', 'cmp-coming-soon-maintenance');?></option>
									<option disabled value="vimeo" <?php if ( $niteoCS_banner_video == 'vimeo' ) { echo ' selected="selected"'; } ?>><?php _e('Vimeo (coming soon...)', 'cmp-coming-soon-maintenance');?></option>
								</select><br>
	

								<p class="youtube-source-input">
									<label for="niteoCS_youtube_url_<?php echo esc_attr($themeslug);?>"><?php _e('Enter Youtube URL', 'cmp-coming-soon-maintenance');?></label>
									<input type="text" class="widefat" id="niteoCS-youtube-url" name="niteoCS_youtube_url_<?php echo esc_attr($themeslug);?>" type="text" value="<?php echo esc_attr($niteoCS_youtube_url); ?>" />

								</p>

								<p class="vimeo-source-input">
									<label for="niteoCS_vimeo_url_<?php echo esc_attr($themeslug);?>"><?php _e('Enter Vimeo URL', 'cmp-coming-soon-maintenance');?></label>
									<input type="text" class="widefat" id="niteoCS-vimeo-url" name="niteoCS_vimeo_url_<?php echo esc_attr($themeslug);?>" type="text" value="<?php echo esc_attr($niteoCS_vimeo_url); ?>" />
								</p>

								<p class="file-source-input">
									<label for="niteoCS_file_url_<?php echo esc_attr($themeslug);?>"><?php _e('Select or Upload custom Video file', 'cmp-coming-soon-maintenance');?></label>
									<input id="add-video" type="button" class="button" value="Media Library"/>
									<input type="hidden" class="widefat" id="niteoCS-video-id" name="niteoCS_video_file_url<?php echo esc_attr($themeslug);?>" type="text" value="<?php echo esc_attr( $niteoCS_video_file_url ); ?>"  data-url="<?php echo esc_url( wp_get_attachment_url($niteoCS_video_file_url) ); ?>"/>
								</p>

								<div class="video-wrapper"></div>

								<p class="file-source-input">
									<input id="delete-video" type="button" class="button" value="Remove Video" style="display:none"/>	
								</p>

								<p><?php _e('Video backgrounds doesn`t work on mobile devices therefore only thumbnail video image will be displayed on mobile devices. Upload custom thumbnail image by pressing button below. ', 'cmp-coming-soon-maintenance');?></p>
								<input type="hidden" class="widefat" id="niteoCS-video-thumb-id" name="niteoCS_video_thumb_<?php echo esc_attr($themeslug);?>" type="text" value="<?php echo esc_attr( $niteoCS_video_thumb ); ?>" />
					        	<input id="add-video-thumb" type="button" class="button" value="<?php _e('Media Library', 'cmp-coming-soon-maintenance');?>" /><br><br>

						        <div class="video-thumb-wrapper">
						        	<?php 
						        	if ( isset( $niteoCS_video_thumb ) && $niteoCS_video_thumb != '' ) {
						        		$img = wp_get_attachment_image_src($niteoCS_video_thumb, 'large');
					        			if (isset($img[0])) {
					        				echo '<img src="'.$img[0].'" alt="">';
					        			}

						        	}
						        	?>
						        </div>

						        <input id="delete-video-thumb" type="button" class="button" value="Remove Thumbnail" />
						</fieldset>

						<fieldset id="gradient_background">

								<label for="niteoCS_gradient_<?php echo esc_attr($themeslug);?>"><?php _e('Select Gradient Background', 'cmp-coming-soon-maintenance');?></label><br>

								<select name="niteoCS_gradient_<?php echo esc_attr($themeslug);?>" class="background-gradient">
									<option value="#d53369:#cbad6d" <?php if ( $niteoCS_gradient == '#d53369:#cbad6d' ) { echo ' selected="selected"'; } ?>><?php _e('Blury Beach', 'cmp-coming-soon-maintenance');?></option>
									<option value="#FC354C:#0ABFBC" <?php if ( $niteoCS_gradient == '#FC354C:#0ABFBC' ) { echo ' selected="selected"'; } ?>><?php _e('Miaka', 'cmp-coming-soon-maintenance');?></option>
									<option value="#C04848:#480048" <?php if ( $niteoCS_gradient == '#C04848:#480048' ) { echo ' selected="selected"'; } ?>><?php _e('Influenza', 'cmp-coming-soon-maintenance');?></option>
									<option value="#5f2c82:#49a09d" <?php if ( $niteoCS_gradient == '#5f2c82:#49a09d' ) { echo ' selected="selected"'; } ?>><?php _e('Calm Darya', 'cmp-coming-soon-maintenance');?></option>
									<option value="#5C258D:#4389A2" <?php if ( $niteoCS_gradient == '#5C258D:#4389A2' ) { echo ' selected="selected"'; } ?>><?php _e('Shroom Haze', 'cmp-coming-soon-maintenance');?></option>
									<option value="#1D2B64:#F8CDDA" <?php if ( $niteoCS_gradient == '#1D2B64:#F8CDDA' ) { echo ' selected="selected"'; } ?>><?php _e('Purlple Paradise', 'cmp-coming-soon-maintenance');?></option>
									<option value="#1A2980:#26D0CE" <?php if ( $niteoCS_gradient == '#1A2980:#26D0CE' ) { echo ' selected="selected"'; } ?>><?php _e('Aqua Marine', 'cmp-coming-soon-maintenance');?></option>
									<option value="#FF512F:#DD2476" <?php if ( $niteoCS_gradient == '#FF512F:#DD2476' ) { echo ' selected="selected"'; } ?>><?php _e('Bloody Mary', 'cmp-coming-soon-maintenance');?></option>
									<option value="#E55D87:#5FC3E4" <?php if ( $niteoCS_gradient == '#E55D87:#5FC3E4' ) { echo ' selected="selected"'; } ?>><?php _e('Rose Water', 'cmp-coming-soon-maintenance');?></option>
									<option value="#003973:#E5E5BE" <?php if ( $niteoCS_gradient == '#003973:#E5E5BE' ) { echo ' selected="selected"'; } ?>><?php _e('Horizon', 'cmp-coming-soon-maintenance');?></option>
									<option value="#e52d27:#b31217" <?php if ( $niteoCS_gradient == '#e52d27:#b31217' ) { echo ' selected="selected"'; } ?>><?php _e('Youtube', 'cmp-coming-soon-maintenance');?></option>
									<option value="#FC466B:#3F5EFB" <?php if ( $niteoCS_gradient == '#FC466B:#3F5EFB' ) { echo ' selected="selected"'; } ?>><?php _e('Sublime Vivid', 'cmp-coming-soon-maintenance');?></option>
									<option value="#ED5565:#D62739" <?php if ( $niteoCS_gradient == '#ED5565:#D62739' ) { echo ' selected="selected"'; } ?>><?php _e('Red', 'cmp-coming-soon-maintenance');?></option>
									<option value="#FC6E51:#DB391E" <?php if ( $niteoCS_gradient == '#FC6E51:#DB391E' ) { echo ' selected="selected"'; } ?>><?php _e('Orange', 'cmp-coming-soon-maintenance');?></option>
									<option value="#FFDA7C:#F6A742" <?php if ( $niteoCS_gradient == '#FFDA7C:#F6A742' ) { echo ' selected="selected"'; } ?>><?php _e('Yellow', 'cmp-coming-soon-maintenance');?></option>
									<option value="#A0D468:#6EAF26" <?php if ( $niteoCS_gradient == '#A0D468:#6EAF26' ) { echo ' selected="selected"'; } ?>><?php _e('Green', 'cmp-coming-soon-maintenance');?></option>
									<option value="#48CFAD:#19A784" <?php if ( $niteoCS_gradient == '#48CFAD:#19A784' ) { echo ' selected="selected"'; } ?>><?php _e('Green Pastel', 'cmp-coming-soon-maintenance');?></option>
									<option value="#4FC1E9:#0B9BD0" <?php if ( $niteoCS_gradient == '#4FC1E9:#0B9BD0' ) { echo ' selected="selected"'; } ?>><?php _e('Sky blue', 'cmp-coming-soon-maintenance');?></option>
									<option value="#5D9CEC:#0D65D8" <?php if ( $niteoCS_gradient == '#5D9CEC:#0D65D8' ) { echo ' selected="selected"'; } ?>><?php _e('Purple', 'cmp-coming-soon-maintenance');?></option>
									<option value="#EC87C0:#BF4C90" <?php if ( $niteoCS_gradient == '#EC87C0:#BF4C90' ) { echo ' selected="selected"'; } ?>><?php _e('Violet', 'cmp-coming-soon-maintenance');?></option>
									<option value="#EDF1F7:#C9D7E9" <?php if ( $niteoCS_gradient == '#EDF1F7:#C9D7E9' ) { echo ' selected="selected"'; } ?>><?php _e('Light grey', 'cmp-coming-soon-maintenance');?></option>
									<option value="#CCD1D9:#8F9AA8" <?php if ( $niteoCS_gradient == '#CCD1D9:#8F9AA8' ) { echo ' selected="selected"'; } ?>><?php _e('Grey', 'cmp-coming-soon-maintenance');?></option>
									<option value="#656D78:#2F3640" <?php if ( $niteoCS_gradient == '#656D78:#2F3640' ) { echo ' selected="selected"'; } ?>><?php _e('Dark grey', 'cmp-coming-soon-maintenance');?></option>
									<option value="custom" <?php if ( $niteoCS_gradient == 'custom' ) { echo ' selected="selected"'; } ?>><?php _e('Custom Gradient', 'cmp-coming-soon-maintenance');?></option>
								</select><br>

								<p class="custom-gradient" style="display:<?php echo ( $niteoCS_gradient == 'custom' ) ? 'block' : 'none'; ?>">
									<label for="niteoCS_banner_gradient_one_<?php echo esc_attr($themeslug);?>"><?php _e('Select first gradient color:', 'cmp-coming-soon-maintenance');?></label><br>
									<input type="text" name="niteoCS_banner_gradient_one_<?php echo esc_attr($themeslug);?>" id="niteoCS_gradient_one" value="<?php echo esc_attr( $niteoCS_gradient_one_custom); ?>" data-default-color="#e5e5e5" class="regular-text code"><br>
									<label for="niteoCS_banner_gradient_two_<?php echo esc_attr($themeslug);?>"><?php _e('Select second gradient color:', 'cmp-coming-soon-maintenance');?></label><br>
									<input type="text" name="niteoCS_banner_gradient_two_<?php echo esc_attr($themeslug);?>" id="niteoCS_gradient_two" value="<?php echo esc_attr( $niteoCS_gradient_two_custom); ?>" data-default-color="#e5e5e5" class="regular-text code"><br>
								</p>

								<div class="gradient-preview" style="background:-moz-linear-gradient(-45deg, <?php echo ( $niteoCS_gradient == 'custom' ) ? esc_attr( $niteoCS_gradient_one_custom ) : esc_attr( $niteoCS_gradient_one ); ?> 0%, <?php echo ( $niteoCS_gradient == 'custom' ) ? esc_attr( $niteoCS_gradient_two_custom ) : esc_attr( $niteoCS_gradient_two ); ?> 100%);background:-webkit-linear-gradient(-45deg, <?php echo ( $niteoCS_gradient == 'custom' ) ? esc_attr( $niteoCS_gradient_one_custom ) : esc_attr( $niteoCS_gradient_one ); ?> 0%, <?php echo ( $niteoCS_gradient == 'custom' ) ? esc_attr( $niteoCS_gradient_two_custom ) : esc_attr( $niteoCS_gradient_two ); ?> 100%);background:linear-gradient(135deg, <?php echo ( $niteoCS_gradient == 'custom' ) ? esc_attr( $niteoCS_gradient_one_custom ) : esc_attr( $niteoCS_gradient_one ); ?> 0%, <?php echo ( $niteoCS_gradient == 'custom' ) ? esc_attr( $niteoCS_gradient_two_custom ) : esc_attr( $niteoCS_gradient_two ); ?> 100%)"></div>		
						</fieldset>

					</td>
				</tr>

				<?php echo $this->render_settings->submit(); ?>
				
				</tbody>
			</table>

		</div>