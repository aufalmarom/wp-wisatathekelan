<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// check onces and wordpress rights, else DIE
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	if( !wp_verify_nonce($_POST['save_options_field'], 'save_options') || !current_user_can('publish_pages') ) {
		die('Sorry, but this request is invalid');
	}
}


// get all wp pages to array(id->name);
$pages = $this->cmp_get_pages();


if ( isset( $_POST['niteoCS_page_filter'] ) ) {
	update_option('niteoCS_page_filter', sanitize_text_field( $_POST['niteoCS_page_filter'] ));
}

if ( isset( $_POST['niteoCS_bypass_id'] ) ) {
	if ( $_POST['niteoCS_bypass_id'] == '' ) {
		update_option('niteoCS_bypass_id', md5( get_home_url() ));
	} else {
		update_option('niteoCS_bypass_id', sanitize_text_field( $_POST['niteoCS_bypass_id'] ));
	}
	
}

if ( isset( $_POST['niteoCS_bypass'] ) && is_numeric($_POST['niteoCS_bypass']) ) {
	update_option('niteoCS_bypass', sanitize_text_field( $_POST['niteoCS_bypass'] ));
}



if ( isset( $_POST['niteoCS_bypass_expire'] ) ) {
	if ( $_POST['niteoCS_bypass_expire'] == '' ) {
		update_option('niteoCS_bypass_expire', 172800);
	} else {
		update_option('niteoCS_bypass_expire', filter_var( $_POST['niteoCS_bypass_expire'], FILTER_SANITIZE_NUMBER_INT ));
	}
	
}

// update page whitelist if set
if ( isset( $_POST['niteoCS_page-whitelist'] ) ) {

	$whitelist = $_POST['niteoCS_page-whitelist'];
	$sane = false;

	foreach ( $whitelist as $id ) {
		if ( !is_numeric( $id ) ) {
			break;
		} else {
			$sane = true;
		}
	}

	if ( $sane ) {
		$whitelist_json = json_encode( $whitelist );
	}

	update_option('niteoCS_page_whitelist', sanitize_text_field( $whitelist_json ));

} else if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){
	update_option('niteoCS_page_whitelist', '[]');
}

// update page blacklist if set
if ( isset( $_POST['niteoCS_page-blacklist'] ) ) {

	$blacklist = $_POST['niteoCS_page-blacklist'];
	$sane = false;

	foreach ( $blacklist as $id ) {
		if ( !is_numeric( $id ) ) {
			break;
		} else {
			$sane = true;
		}
	}

	if ( $sane ) {
		$blacklist_json = json_encode( $blacklist );
	}

	update_option('niteoCS_page_blacklist', sanitize_text_field( $blacklist_json ));

} else if ($_SERVER['REQUEST_METHOD'] == 'POST' ){
	update_option('niteoCS_page_blacklist', '[]');
}

// update cmp bypass roles if set
if ( isset( $_POST['niteoCS_roles'] ) ) {

	$roles = $_POST['niteoCS_roles'];
	$sane = false;

	foreach ( $roles as $id => $role ) {
		$roles[$id] = sanitize_text_field($role);
	}

	update_option('niteoCS_roles', json_encode( $roles ));
	
} else if ($_SERVER['REQUEST_METHOD'] == 'POST' ){
	update_option('niteoCS_roles', '[]');
}


// update cmp roles topbar access
if ( isset( $_POST['niteoCS_roles_topbar'] ) ) {

	$roles = $_POST['niteoCS_roles_topbar'];
	$sane = false;

	foreach ( $roles as $id => $role ) {
		$roles[$id] = sanitize_text_field($role);
	}

	update_option('niteoCS_roles_topbar', json_encode( $roles ));
	
} else if ($_SERVER['REQUEST_METHOD'] == 'POST' ){
	update_option('niteoCS_roles_topbar', '[]');
}

$niteoCS_page_filter 		= get_option('niteoCS_page_filter', '0');

$niteoCS_page_whitelist		= json_decode(get_option('niteoCS_page_whitelist', '[]'), true);

$niteoCS_page_blacklist		= json_decode(get_option('niteoCS_page_blacklist', '[]'), true);

$niteoCS_roles				= json_decode(get_option('niteoCS_roles', '[]'), true);

$niteoCS_roles_topbar		= json_decode(get_option('niteoCS_roles_topbar', '[]'), true);

$bypass						= get_option('niteoCS_bypass', '0');

$bypass_id 					= get_option('niteoCS_bypass_id', md5( get_home_url() ));

$bypass_expire 				= get_option('niteoCS_bypass_expire', '172800');

?>

<div class="wrap cmp-coming-soon-maintenance">

	<h1></h1>
	<div id="icon-users" class="icon32"></div>

	<form method="post"	action="admin.php?page=cmp-advanced&status=settings-saved" id="csoptions">

		<div class="cmp-advanced">

			<div class="cmp-inputs-wrapper">

				<div class="table-wrapper general">

					<h3 class="no-icon"><?php _e('CMP Page Whitelist and Blacklist Settings', 'cmp-coming-soon-maintenance');?></h3>
					<table class="general">
						<tbody>
						<tr>

							<th>
								<fieldset>
									<legend class="screen-reader-text">
										<span><?php _e('Whitelist Settings', 'cmp-coming-soon-maintenance');?></span>
									</legend>

									<p>
										<label title="Page Whitelist">
										 	<input type="radio" class="page-whitelist" name="niteoCS_page_filter" value="1" <?php checked('1', $niteoCS_page_filter);?>><?php _e('Page Whitelist', 'cmp-coming-soon-maintenance');?>
										</label>
									</p>

									<p>
										<label title="Page Blacklist">
										 	<input type="radio" class="page-whitelist" name="niteoCS_page_filter" value="2" <?php checked('2', $niteoCS_page_filter);?>><?php _e('Page Blacklist', 'cmp-coming-soon-maintenance');?>
										</label>
									</p>

									<p>
										<label title="Disabled">
										 	<input type="radio" class="page-whitelist" name="niteoCS_page_filter" value="0" <?php checked('0', $niteoCS_page_filter);?>><?php _e('Disabled', 'cmp-coming-soon-maintenance');?>
										</label>
									</p>

								</fieldset>
							</th>

							<td>
								<fieldset class="page-whitelist-switch x1" style="margin-top: 1em;">
									<h4><?php _e('CMP Whitelist - Select the specific page(s) to display CMP Landing Page.', 'cmp-coming-soon-maintenance');?></h4>
									<select name="niteoCS_page-whitelist[]" class="cmp-whitelist" multiple="multiple">
										<option value="-1" <?php echo in_array('-1', $niteoCS_page_whitelist) ? 'selected' : '';?>><?php _e('Homepage', 'cmp-coming-soon-maintenance');?></option>
										<?php
										foreach ( $pages as $page ) { ?>
											<option value="<?php echo esc_attr( $page['id'] );?>" <?php echo in_array($page['id'], $niteoCS_page_whitelist) ? 'selected' : ''; ?>><?php echo esc_attr( $page['name'] );?></option>
											<?php 
										} ?>
									</select>

									<p style="margin-top:0"><?php _e('By default CMP is enabled on all pages. Leave this field empty to use default settings.', 'cmp-coming-soon-maintenance');?></p>

								</fieldset>

								<fieldset class="page-whitelist-switch x2" style="margin-top: 1em;">
									<h4><?php _e('CMP Blacklist - Select the pages to NOT display CMP landing page.', 'cmp-coming-soon-maintenance');?></h4>
									<select name="niteoCS_page-blacklist[]" class="cmp-blacklist" multiple="multiple">
										<option value="-1" <?php echo in_array('-1', $niteoCS_page_blacklist) ? 'selected' : '';?>><?php _e('Homepage', 'cmp-coming-soon-maintenance');?></option>
										<?php
										foreach ( $pages as $page ) { ?>
											<option value="<?php echo esc_attr( $page['id'] );?>" <?php echo in_array($page['id'], $niteoCS_page_blacklist) ? 'selected' : '';?>><?php echo esc_attr( $page['name'] );?></option>
											<?php 
										} ?>
									</select>

									<p style="margin-top:0"><?php _e('If you want to exclude some pages from CMP you can select them here.', 'cmp-coming-soon-maintenance');?></p>

								</fieldset>

								<p class="page-whitelist-switch x0"><?php _e('CMP landing page is displayed on all pages by default. You can enable Page Whitelist to display CMP only on specific page(s) or Page Blacklist to exclude CMP landing page on specific page(s) by enabling Page Whitelist or Page Blacklist here.', 'cmp-coming-soon-maintenance');?></p>

							</td>
						</tr>

						<?php echo $this->render_settings->submit(); ?>

						</tbody>
					</table>

				</div>

				<div class="table-wrapper general">

					<h3 class="no-icon"><?php _e('CMP User Roles Settings', 'cmp-coming-soon-maintenance');?></h3>
					<table class="general">
						<tbody>
						<tr>
							<th>
								<fieldset>
									<legend class="screen-reader-text">
										<span><?php _e('User Roles Settings', 'cmp-coming-soon-maintenance');?></span>
									</legend>

									<p>
										<h4><?php _e('Bypass User Roles', 'cmp-coming-soon-maintenance');?></h4>
									</p>

								</fieldset>
							</th>

							<td>
								<fieldset style="margin-top: 1em;">
									<h4><?php _e('Select User Roles to bypass CMP landing page.', 'cmp-coming-soon-maintenance');?></h4>
									
									<select name="niteoCS_roles[]" class="cmp-user_roles" multiple="multiple">

										<?php 
										$roles = get_editable_roles();



										foreach ( $roles as $role => $details ) {

											if ( $role != 'administrator') { ?>
												<option value="<?php echo esc_attr($role);?>" <?php echo in_array($role, $niteoCS_roles) ? 'selected' : '';?>><?php echo esc_attr($details['name']);?></option>
												<?php 
											}
										} ?>

									</select>

									<p style="margin-top:0"><?php _e('Administrator role always bypass CMP by default.', 'cmp-coming-soon-maintenance');?></p>

								</fieldset>

							</td>
						</tr>

						<tr>
							<th>
								<fieldset>
									<legend class="screen-reader-text">
										<span><?php _e('Top Bar Switch Access', 'cmp-coming-soon-maintenance');?></span>
									</legend>

									<p>
										<h4><?php _e('Top Bar Switch Access', 'cmp-coming-soon-maintenance');?></h4>
									</p>

								</fieldset>
							</th>

							<td>
								<fieldset style="margin-top: 1em;">
									<h4><?php _e('Select User Roles which can access Top Bar CMP switch mode.', 'cmp-coming-soon-maintenance');?></h4>
									
									<select name="niteoCS_roles_topbar[]" class="cmp-user_roles" multiple="multiple">

										<?php 
										$roles = get_editable_roles();

										foreach ( $roles as $role => $details ) {

											if ( $role != 'administrator') { ?>
												<option value="<?php echo esc_attr($role);?>" <?php echo in_array( $role, $niteoCS_roles_topbar ) ? 'selected' : '';?>><?php echo esc_attr( $details['name'] );?></option>
												<?php 
											}
										} ?>

									</select>

									<p style="margin-top:0"><?php _e('Administrator role can always access Top Bar Switch.', 'cmp-coming-soon-maintenance');?></p>

								</fieldset>

							</td>
						</tr>
						<?php echo $this->render_settings->submit(); ?>

						</tbody>
					</table>

				</div>

				<div class="table-wrapper general">
					<h3 class="no-icon"><?php _e('CMP Bypass URL', 'cmp-coming-soon-maintenance');?></h3>
					<table class="general">
						<tbody>
						<tr>

							<th>
								<fieldset>
									<legend class="screen-reader-text">
										<span><?php _e('Whitelist Settings', 'cmp-coming-soon-maintenance');?></span>
									</legend>

									<p>
										<label title="Page Whitelist">
										 	<input type="radio" class="cmp-bypass" name="niteoCS_bypass" value="1" <?php checked('1', $bypass);?>><?php _e('Enabled', 'cmp-coming-soon-maintenance');?>
										</label>
									</p>

									<p>
										<label title="Disabled">
										 	<input type="radio" class="cmp-bypass" name="niteoCS_bypass" value="0" <?php checked('0', $bypass);?>><?php _e('Disabled', 'cmp-coming-soon-maintenance');?>
										</label>
									</p>

								</fieldset>
							</th>

							<td>

								<fieldset class="cmp-bypass-switch x1" style="margin-top: 1em;">
									
									<h4 style="margin-bottom:0.5em"><?php _e('Bypass URL', 'cmp-coming-soon-maintenance');?></h4>
									<code><?php echo get_home_url().'/?cmp_bypass=' . $bypass_id;?></code>

									<p><?php _e('You can use this URL to bypass CMP maintenance page. Once you access your website with this URL, CMP Cookie will be set with default expiration of 2 days. If the cookie expires, you need to access your website again with this URL.', 'cmp-coming-soon-maintenance');?></p>

									<h4><?php _e('Set Bypass Passphrase', 'cmp-coming-soon-maintenance');?></h4>
									<input type="text" name="niteoCS_bypass_id" value="<?php echo esc_attr( $bypass_id ); ?>" class="regular-text code"><br>

									<p style="margin-top:0"><?php _e('You can use passphrase which contains letters, numbers, underscores or dashes only.', 'cmp-coming-soon-maintenance');?></p>

									<h4><?php _e('Set bypass cookie Expiration Time in seconds', 'cmp-coming-soon-maintenance');?></h4>
									<input type="text" name="niteoCS_bypass_expire" value="<?php echo esc_attr( $bypass_expire ); ?>" class="regular-text code"><br>

									<p style="margin-top:0"><?php _e('You can set custom Bypass CMP Cookie expiration time in seconds (1hour = 3600). Default expiration time is 2 days (172800).', 'cmp-coming-soon-maintenance');?></p>

									<p><?php _e('Please note this solution is using browser cookies which might not work correctly if you are using caching plugins.', 'cmp-coming-soon-maintenance');?></p>

								</fieldset>

								<p class="cmp-bypass-switch x0"><?php _e('You can Enable CMP Bypass where you can set custom URL parameter to bypass CMP page. You can send this URL to anyone who would like to sneak peak into your Website while it is under development or maintanence.', 'cmp-coming-soon-maintenance');?></p>

							</td>
						</tr>

						<?php echo $this->render_settings->submit(); ?>

						</tbody>
					</table>

				</div>

			</div> <!-- <div class="cmp-inputs-wrapper"> -->

			<?php 
			// get sidebar with "widgets"
			if ( file_exists(dirname(__FILE__) . '/cmp-sidebar.php') ) {
				require (dirname(__FILE__) . '/cmp-sidebar.php');
			}

			?>

		</div> <!-- <div class="cmp-settings-wrapper"> -->

	</form>

</div> <!-- <div id="wrap"> -->

<script>
jQuery(document).ready(function($){
	toggle_settings('page-whitelist');
	toggle_settings('cmp-bypass');

	function toggle_settings ( classname ) {
		// Logo type inputs
		jQuery('.'+classname).change(function() {
			var value = jQuery('.'+classname+':checked' ).val();
			value = ( jQuery.isNumeric(value) ) ? 'x'+value : value;

			jQuery('.'+classname+'-switch.'+value).css('display','block');
			jQuery('.'+classname+'-switch:not(.'+value+')').css('display','none');
		});

		jQuery('.'+classname).first().trigger('change');
	}

	jQuery('.cmp-whitelist, .cmp-blacklist, .cmp-user_roles').select2({
		width: 'calc(100% - 1em)',
		placeholder: 'Click to select..',

	});
});
</script>
