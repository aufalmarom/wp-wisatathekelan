<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// check onces and wordpress rights, else DIE
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	if( !wp_verify_nonce($_POST['save_options_field'], 'save_options') || !current_user_can('publish_pages') ) {
		die('Sorry, but this request is invalid');
	}
}

if ( isset($_POST['select_theme']) && in_array($_POST['select_theme'], $this->theme_array)) {
	update_option('niteoCS_theme', sanitize_text_field($_POST['select_theme']));
}


$themeslug 				= $this->cmp_selectedTheme();
$downloadable_themes 	= $this->cmp_downloadable_themes();
$font_animation 		= array('hardwork_premium', 'fifty', 'orbit', 'stylo');
$ajax_nonce 			= wp_create_nonce( 'cmp-coming-soon-ajax-secret' );

if (isset($_POST['niteoCS_logo_id_'.$themeslug]) && ( is_numeric($_POST['niteoCS_logo_id_'.$themeslug]) || empty($_POST['niteoCS_logo_id_'.$themeslug]))) {
	update_option('niteoCS_logo_id['.$themeslug.']', sanitize_text_field($_POST['niteoCS_logo_id_'.$themeslug]));
}

if (isset($_POST['niteoCS_logo_type_'.$themeslug])) {
	update_option('niteoCS_logo_type['.$themeslug.']', sanitize_text_field($_POST['niteoCS_logo_type_'.$themeslug]));
} 

if (isset($_POST['niteoCS_text_logo_'.$themeslug])) {
	update_option('niteoCS_text_logo['.$themeslug.']', sanitize_text_field($_POST['niteoCS_text_logo_'.$themeslug]));
}

if (isset($_POST['niteoCS_font_headings_'.$themeslug])) {
	update_option('niteoCS_font_headings['.$themeslug.']', sanitize_text_field($_POST['niteoCS_font_headings_'.$themeslug]));
}

if (isset($_POST['niteoCS_font_headings_variant_'.$themeslug])) {
	update_option('niteoCS_font_headings_variant['.$themeslug.']', sanitize_text_field($_POST['niteoCS_font_headings_variant_'.$themeslug]));
}

if (isset($_POST['niteoCS_font_headings_size_'.$themeslug])) {
	update_option('niteoCS_font_headings_size['.$themeslug.']', sanitize_text_field($_POST['niteoCS_font_headings_size_'.$themeslug]));
}


if (isset($_POST['niteoCS_font_headings_spacing_'.$themeslug])) {
	update_option('niteoCS_font_headings_spacing['.$themeslug.']', sanitize_text_field($_POST['niteoCS_font_headings_spacing_'.$themeslug]));
}

if (isset($_POST['niteoCS_font_content_'.$themeslug])) {
	update_option('niteoCS_font_content['.$themeslug.']', sanitize_text_field($_POST['niteoCS_font_content_'.$themeslug]));
}

if (isset($_POST['niteoCS_font_content_variant_'.$themeslug])) {
	update_option('niteoCS_font_content_variant['.$themeslug.']', sanitize_text_field($_POST['niteoCS_font_content_variant_'.$themeslug]));
}

if (isset($_POST['niteoCS_font_content_size_'.$themeslug])) {
	update_option('niteoCS_font_content_size['.$themeslug.']', sanitize_text_field($_POST['niteoCS_font_content_size_'.$themeslug]));
}

if (isset($_POST['niteoCS_font_content_lineheight_'.$themeslug])) {
	update_option('niteoCS_font_content_lineheight['.$themeslug.']', sanitize_text_field($_POST['niteoCS_font_content_lineheight_'.$themeslug]));
}

if (isset($_POST['niteoCS_font_content_spacing_'.$themeslug])) {
	update_option('niteoCS_font_content_spacing['.$themeslug.']', sanitize_text_field($_POST['niteoCS_font_content_spacing_'.$themeslug]));
}

if (isset($_POST['niteoCS_heading_animation_'.$themeslug])) {
	update_option('niteoCS_heading_animation['.$themeslug.']', sanitize_text_field($_POST['niteoCS_heading_animation_'.$themeslug]) );
}

if (isset($_POST['niteoCS_content_animation_'.$themeslug])) {
	update_option('niteoCS_content_animation['.$themeslug.']', sanitize_text_field($_POST['niteoCS_content_animation_'.$themeslug]) );
}


if (isset($_POST['niteoCS_banner_'.$themeslug]) && is_numeric($_POST['niteoCS_banner_'.$themeslug])) {
	update_option('niteoCS_banner['.$themeslug.']', sanitize_text_field($_POST['niteoCS_banner_'.$themeslug]));
}

if (isset($_POST['niteoCS_banner_color_'.$themeslug])) {
	update_option('niteoCS_banner_color['.$themeslug.']', sanitize_text_field($_POST['niteoCS_banner_color_'.$themeslug]));
}


if (isset($_POST['niteoCS_gradient_'.$themeslug])) {
	update_option('niteoCS_gradient['.$themeslug.']', sanitize_text_field($_POST['niteoCS_gradient_'.$themeslug]));
}

if (isset($_POST['niteoCS_banner_gradient_one_'.$themeslug])) {
	update_option('niteoCS_banner_gradient_one['.$themeslug.']', sanitize_text_field($_POST['niteoCS_banner_gradient_one_'.$themeslug]));
}

if (isset($_POST['niteoCS_banner_gradient_two_'.$themeslug])) {
	update_option('niteoCS_banner_gradient_two['.$themeslug.']', sanitize_text_field($_POST['niteoCS_banner_gradient_two_'.$themeslug]));
}

if (isset($_POST['niteoCS_banner_pattern_'.$themeslug])) {
	update_option('niteoCS_banner_pattern['.$themeslug.']', sanitize_text_field($_POST['niteoCS_banner_pattern_'.$themeslug]));
}

if (isset($_POST['niteoCS_banner_pattern_custom_'.$themeslug])) {
	update_option('niteoCS_banner_pattern_custom['.$themeslug.']', sanitize_text_field($_POST['niteoCS_banner_pattern_custom_'.$themeslug]));
}

if (isset($_POST['niteoCS_banner_video_'.$themeslug])) {
	update_option('niteoCS_banner_video['.$themeslug.']', sanitize_text_field($_POST['niteoCS_banner_video_'.$themeslug]));
}

if (isset($_POST['niteoCS_youtube_url_'.$themeslug])) {
	update_option('niteoCS_youtube_url['.$themeslug.']', sanitize_text_field($_POST['niteoCS_youtube_url_'.$themeslug]));
}

if (isset($_POST['niteoCS_vimeo_url_'.$themeslug])) {
	update_option('niteoCS_vimeo_url['.$themeslug.']', sanitize_text_field($_POST['niteoCS_vimeo_url_'.$themeslug]));
}

if (isset($_POST['niteoCS_video_thumb_'.$themeslug])) {
	update_option('niteoCS_video_thumb['.$themeslug.']', sanitize_text_field($_POST['niteoCS_video_thumb_'.$themeslug]));
}

if (isset($_POST['niteoCS_video_file_url'.$themeslug])) {
	update_option('niteoCS_video_file_url['.$themeslug.']', sanitize_text_field($_POST['niteoCS_video_file_url'.$themeslug]));
}

if (isset($_POST['niteoCS_banner_id_'.$themeslug])) {
		$allnums = true;
		
		$ids = explode( ',', $_POST['niteoCS_banner_id_'.$themeslug] );
		foreach ( $ids as $id ) {

			if ( !is_numeric($id) ) {
				$allnums = false;
			}
		}

	if ( $allnums === true || $_POST['niteoCS_banner_id_'.$themeslug] == '' ) {
		update_option('niteoCS_banner_id['.$themeslug.']', sanitize_text_field($_POST['niteoCS_banner_id_'.$themeslug]));
	}

}

if (isset($_POST['unsplash_feed_'.$themeslug]) && is_numeric($_POST['unsplash_feed_'.$themeslug])) {
	update_option('niteoCS_unsplash_feed['.$themeslug.']', sanitize_text_field($_POST['unsplash_feed_'.$themeslug]));
}

if (isset($_POST['niteoCS_unsplash_0_'.$themeslug])) {
	$url = $_POST['niteoCS_unsplash_0_'.$themeslug];
	// if we have url sanitize url
	if (strpos($url, 'http://') !== false || strpos($url, 'https://') !== false) {
		update_option('niteoCS_unsplash_0['.$themeslug.']', esc_url_raw($_POST['niteoCS_unsplash_0_'.$themeslug]));
	} else {
		// sanitize string
		update_option('niteoCS_unsplash_0['.$themeslug.']', sanitize_text_field($_POST['niteoCS_unsplash_0_'.$themeslug]));
	}
}

if (isset($_POST['niteoCS_unsplash_2_'.$themeslug])) {
	$url = $_POST['niteoCS_unsplash_2_'.$themeslug];
	// if we have url sanitize url
	if (strpos($url, 'http://') !== false || strpos($url, 'https://') !== false) {
		update_option('niteoCS_unsplash_2['.$themeslug.']', esc_url_raw($_POST['niteoCS_unsplash_2_'.$themeslug]));
	} else {
		// sanitize string
		update_option('niteoCS_unsplash_2['.$themeslug.']', sanitize_text_field($_POST['niteoCS_unsplash_2_'.$themeslug]));
	}
}

if (isset($_POST['niteoCS_unsplash_3_'.$themeslug])) {
	update_option('niteoCS_unsplash_3['.$themeslug.']', sanitize_text_field($_POST['niteoCS_unsplash_3_'.$themeslug]));
}

if (isset($_POST['niteoCS_unsplash_1_'.$themeslug])) {
	update_option('niteoCS_unsplash_1['.$themeslug.']', sanitize_text_field($_POST['niteoCS_unsplash_1_'.$themeslug]));
}

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

	if (isset($_POST['niteoCS_unsplash_feat_'.$themeslug])) {
		update_option('niteoCS_unsplash_feat['.$themeslug.']', $this->sanitize_checkbox($_POST['niteoCS_unsplash_feat_'.$themeslug]));
	} else {
		update_option('niteoCS_unsplash_feat['.$themeslug.']', false);
	}
}

if (isset($_POST['niteoCS_favicon_id']) && ( is_numeric($_POST['niteoCS_favicon_id']) || empty($_POST['niteoCS_favicon_id']))) {
	update_option('niteoCS_favicon_id', sanitize_text_field($_POST['niteoCS_favicon_id']));
}


if (isset($_POST['niteoCS_title'])) {
	update_option('niteoCS_title', sanitize_text_field($_POST['niteoCS_title']));
}

if (isset($_POST['niteoCS_descr'])) {
	update_option('niteoCS_descr', sanitize_text_field($_POST['niteoCS_descr']));
}

if (isset($_POST['niteoCS_analytics'])) {
	update_option('niteoCS_analytics', sanitize_text_field($_POST['niteoCS_analytics']));
}

if (isset($_POST['niteoCS_analytics_status'])) {
	update_option('niteoCS_analytics_status', sanitize_text_field($_POST['niteoCS_analytics_status']));
}


if (isset($_POST['niteoCS_analytics_other'])) {
	$replace = array('<script>', '</script>');
	$js_code = str_replace($replace, '', $_POST['niteoCS_analytics_other']);
	update_option('niteoCS_analytics_other', sanitize_text_field($js_code));
}


if (isset($_POST['niteoCS_custom_css'])) {
	update_option('niteoCS_custom_css', $_POST['niteoCS_custom_css']);
}


if (isset($_POST['niteoCS_soc_title'])) {
	update_option('niteoCS_soc_title', sanitize_text_field($_POST['niteoCS_soc_title']));
}

if (isset($_POST['niteoCS_socialmedia'])) {
	update_option('niteoCS_socialmedia', sanitize_text_field($_POST['niteoCS_socialmedia']));
}


if (isset($_POST['niteoCS_body_title'])) {
	update_option('niteoCS_body_title', sanitize_text_field($_POST['niteoCS_body_title']));
}

if (isset($_POST['niteoCS_body'])) {
	update_option('niteoCS_body', $this->niteo_sanitize_html( $_POST['niteoCS_body']));
}


if (isset($_POST['niteoCS_copyright'])) {
	update_option('niteoCS_copyright', $this->niteo_sanitize_html( $_POST['niteoCS_copyright']));
}

if (isset($_POST['niteoCS_URL_redirect'])) {
	update_option('niteoCS_URL_redirect', esc_url_raw( $_POST['niteoCS_URL_redirect']));
}

if (isset($_POST['niteoCS_redirect_time'])) {
	update_option('niteoCS_redirect_time', sanitize_text_field( $_POST['niteoCS_redirect_time']));
}


// get Settings TAB
$niteoCS_URL_redirect 		= get_option('niteoCS_URL_redirect');
$niteoCS_redirect_time 		= get_option('niteoCS_redirect_time', '0');

// get Content Settings
$niteoCS_body_title 		= stripslashes(get_option('niteoCS_body_title', 'SOMETHING IS HAPPENING!'));
$niteoCS_body 				= stripslashes(get_option('niteoCS_body'));
$niteoCS_copyright			= stripslashes(get_option('niteoCS_copyright', 'Copyright '.date("Y").' NiteoThemes. All rights reserved.'));
$niteoCS_soc_title			= stripslashes(get_option('niteoCS_soc_title', 'GET SOCIAL WITH US'));


// get SEO 
$niteoCS_favicon_id 		= get_option('niteoCS_favicon_id');
$niteoCS_title 				= stripslashes(get_option('niteoCS_title', get_bloginfo('name').' is coming soon!'));
$niteoCS_descr				= stripslashes(get_option('niteoCS_descr', 'Just another Coming Soon Page'));
$niteoCS_analytics_status 	= get_option('niteoCS_analytics_status', 'disabled');
$niteoCS_analytics 			= stripslashes(get_option('niteoCS_analytics', ''));
$niteoCS_analytics_other 	= get_option('niteoCS_analytics_other', '');

// get Custom CSS
$niteoCS_custom_css 		= stripslashes(get_option('niteoCS_custom_css', ''));

//get theme specific settings
$niteoCS_logo_type 				= get_option('niteoCS_logo_type['.$themeslug.']', 'text');
$niteoCS_logo_id				= get_option('niteoCS_logo_id['.$themeslug.']');
$niteoCS_text_logo 				= stripslashes(get_option('niteoCS_text_logo['.$themeslug.']', get_bloginfo( 'name', 'display' )));
$niteoCS_heading_animation 		= get_option('niteoCS_heading_animation['.$themeslug.']', 'fadeInDown');
$niteoCS_content_animation 		= get_option('niteoCS_content_animation['.$themeslug.']', 'fadeInUp');

$niteoCS_banner_custom_id		= get_option('niteoCS_banner_id['.$themeslug.']');
$niteoCS_unsplash_feed			= get_option('niteoCS_unsplash_feed['.$themeslug.']', '3');
$niteoCS_unsplash_0				= get_option('niteoCS_unsplash_0['.$themeslug.']');
$niteoCS_unsplash_1				= get_option('niteoCS_unsplash_1['.$themeslug.']');
$niteoCS_unsplash_2				= get_option('niteoCS_unsplash_2['.$themeslug.']');
$niteoCS_unsplash_3				= get_option('niteoCS_unsplash_3['.$themeslug.']');
$niteoCS_unsplash_category		= get_option('niteoCS_unsplash_category['.$themeslug.']', 'buildings');
$niteoCS_cat_keyword    		= get_option('niteoCS_cat_keyword['.$themeslug.']');
$niteoCS_banner_color			= get_option('niteoCS_banner_color['.$themeslug.']', '#e5e5e5');
$niteoCS_gradient 				= get_option('niteoCS_gradient['.$themeslug.']', '#ED5565:#D62739');
$niteoCS_gradient_one_custom 	= get_option('niteoCS_banner_gradient_one['.$themeslug.']', '#e5e5e5');
$niteoCS_gradient_two_custom	= get_option('niteoCS_banner_gradient_two['.$themeslug.']', '#e5e5e5');

if ( $niteoCS_gradient != 'custom' ) {
	$gradient = explode(":", $niteoCS_gradient);
	$niteoCS_gradient_one 			= $gradient[0];
	$niteoCS_gradient_two 			= $gradient[1];	
} else {
	$niteoCS_gradient_one 			= '';
	$niteoCS_gradient_two 			= '';
}

$niteoCS_banner_pattern     	= get_option('niteoCS_banner_pattern['.$themeslug.']', 'sakura');
$niteoCS_banner_pattern_custom  = get_option('niteoCS_banner_pattern_custom['.$themeslug.']');
$niteoCS_banner_video 			= get_option('niteoCS_banner_video['.$themeslug.']');
$niteoCS_youtube_url 			= get_option('niteoCS_youtube_url['.$themeslug.']');
$niteoCS_vimeo_url 				= get_option('niteoCS_vimeo_url['.$themeslug.']');
$niteoCS_video_thumb 			= get_option('niteoCS_video_thumb['.$themeslug.']');
$niteoCS_video_file_url 		= get_option('niteoCS_video_file_url['.$themeslug.']');


// create default social media if they do not exists
if ( !get_option('niteoCS_socialmedia') ) {
	$social_icons = array('facebook', 'google-plus', 'twitter', 'instagram', 'skype', '500px', 'deviantart', 'behance', 'dribbble', 'pinterest', 'linkedin', 'tumblr', 'youtube', 'vimeo', 'flickr', 'soundcloud', 'vk','envelope-o', 'whatsapp', 'phone', 'telegram');
	$i = 0;
	$socialmedia  = array();
	foreach ( $social_icons as $social ) {
		
		$social_field = get_option('niteoCS_'.$social);

		$socialmedia[$i]['name']  	= $social;
		$socialmedia[$i]['url']  	= $social_field;
		$socialmedia[$i]['active']  = '1';
		$socialmedia[$i]['hidden']  = $social_field ? '0' : '1';
		$socialmedia[$i]['order']  	= $i;
		$i++;
	}

	$niteoCS_socialmedia = json_encode( $socialmedia);

} else {
	$niteoCS_socialmedia = stripslashes(get_option('niteoCS_socialmedia'));
	$socialmedia = json_decode( $niteoCS_socialmedia, true );
}


//include theme defaults
if (file_exists($this->cmp_themePath($this->cmp_selectedTheme()).$this->cmp_selectedTheme().'/'.$this->cmp_selectedTheme().'-defaults.php')) {
	include ( $this->cmp_themePath($this->cmp_selectedTheme()).$this->cmp_selectedTheme().'/'.$this->cmp_selectedTheme().'-defaults.php' );
} 


// get logo url from id
if ( $niteoCS_logo_id != '' ) {
	$logo_url = wp_get_attachment_image_src($niteoCS_logo_id, 'medium');
	if ( isset($logo_url[0]) ){
		$logo_url = $logo_url[0];
	}
}


// get favicon url from id
if ( $niteoCS_favicon_id != '' ) {
	$niteoCS_favicon_url = wp_get_attachment_image_src($niteoCS_favicon_id, 'thumbnail');
	if ( isset($niteoCS_favicon_url[0]) ){
		$niteoCS_favicon_url = $niteoCS_favicon_url[0];
	}
}

// get logo url from id
if ( $niteoCS_banner_pattern == 'custom' && $niteoCS_banner_pattern_custom != '' ) {
	$pattern_url = wp_get_attachment_image_src($niteoCS_banner_pattern_custom, 'thumbnail');
	if ( isset($pattern_url[0]) ){
		$pattern_url = $pattern_url[0];
	}


} else {
	$pattern_url = plugins_url('/img/patterns/'.esc_attr($niteoCS_banner_pattern).'.png', __FILE__);
}

// define patterns array
$patterns = array('fabric', 'gray_sand', 'green_dust_scratch', 'mirrored_squares', 'noisy', 'photography', 'playstation', 'sakura', 'white_sand', 'white_texture');

// Handle ZIP UPLOAD
if( isset($_POST['submit_theme']) ) {
	$this->cmp_theme_upload($_FILES['fileToUpload']);
}

// Handle Theme update
if( isset($_GET['action']) && $_GET['action'] == 'update-cmp-theme' && isset($_GET['theme'])) {
	$slug = sanitize_text_field($_GET['theme']);
	$theme_url = $this->remoteServer.'?action=download&slug='.$slug;
	$update  = array(
		'name' 		=> $slug,
		'tmp_name' 	=> '',
		'type' 		=> 'application/x-zip-compressed',
		'url' 		=> $theme_url,
	);

	$this->cmp_theme_update_install($update);
}

add_thickbox();

?>

<noscript>
	<div class='updated'>
		<p class="error"><?php _e('JavaScript appears to be disabled in your browser. For this plugin to work correctly, please enable JavaScript or switch to a more modern browser.', 'cmp-coming-soon-maintenance');?></p>
	</div>
	<style>
		.themes{display: :none;}
	</style>
</noscript>



<div class="wrap cmp-coming-soon-maintenance">

	<h1></h1>
	
	<div id="icon-options-general" class="icon32">
		<br />
	</div>
	<form method="post"	action="admin.php?page=cmp-settings&status=settings-saved" id="csoptions">

		<h2 class="nav-tab-wrapper">
			<a class="nav-tab nav-tab-active general" href="<?php echo admin_url(); ?>admin.php?page=cmp-settings" data-tab="general"><i class="fa fa-cog" aria-hidden="true"></i><?php _e('Settings', 'cmp-coming-soon-maintenance');?></a>

			<a class="nav-tab content" href="<?php echo admin_url(); ?>admin.php?page=cmp-settings" data-tab="content"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><?php _e('Global Content', 'cmp-coming-soon-maintenance');?></a>

			<a class="nav-tab theme-setup" href="<?php echo admin_url(); ?>admin.php?page=cmp-settings" data-tab="theme-setup"><i class="fa fa-wrench" aria-hidden="true"></i><?php _e('Theme Setup', 'cmp-coming-soon-maintenance');?></a>

			<a class="nav-tab seo" href="<?php echo admin_url(); ?>admin.php?page=cmp-settings" data-tab="seo"><i class="fa fa-line-chart" aria-hidden="true"></i><?php _e('SEO', 'cmp-coming-soon-maintenance');?></a>

			<a class="nav-tab custom_css" href="<?php echo admin_url(); ?>admin.php?page=cmp-settings" data-tab="custom_css"><i class="fa fa-code" aria-hidden="true"></i><?php _e('Custom CSS', 'cmp-coming-soon-maintenance');?></a>

			<a class="nav-tab theme-preview" href="<?php echo get_home_url(); ?>?cmp_preview=true" data-tab="theme-preview" target="_blank" ><i class="fa fa-external-link" aria-hidden="true"></i><?php _e('Preview', 'cmp-coming-soon-maintenance');?></a>

		</h2>

		<div class="cmp-settings-wrapper">

		<div class="cmp-inputs-wrapper">

		<div class="table-wrapper general">
			<h3><?php _e('General Settings', 'cmp-coming-soon-maintenance');?></h3>
			<table class="general">
				<tbody>
				<tr>
					<th><h4><?php _e('Status', 'cmp-coming-soon-maintenance');?></h4></th>
					<td>
						<fieldset class="cmp-status">

							<div class="toggle-wrapper">
								<input type="checkbox" id="cmp-status" class="toggle-checkbox" <?php checked( '1', get_option('niteoCS_status', false) ); ?> name="cmp_status">
								<label for="cmp-status" class="toggle"><span class="toggle_handler"></span></label>
							</div>

						</fieldset>
					</td>
				</tr>

				<tr>
					<th><h4><?php _e('Mode', 'cmp-coming-soon-maintenance');?></h4></th>
					<td>
						<fieldset class="cmp-status">

							<legend title="cmp" <?php echo ($this->cmp_status() == 2) ? 'class="active"' : '';?>>
							 	<input type="radio" name="activate" value="2" <?php checked( '2', get_option('niteoCS_activation', '2') ); ?> <?php disabled( '', get_option('niteoCS_status', '') ); ?>>&nbsp;<?php _e('Coming Soon & Landing Page', 'cmp-coming-soon-maintenance');?><br>
								<span class="info"><?php _e('Returns standard 200 HTTP OK response code to indexing robots. Set this option if you want to use our plugin as "Coming Soon" page.','cmp-coming-soon-maintenance')?></span>
							</legend><br> 

							<legend title="maintanance" <?php echo ( $this->cmp_status() == 1 ) ? 'class="active"' : '';?>>
							  <input type="radio" name="activate" value="1" <?php checked( '1', get_option('niteoCS_activation', '2') ); ?> <?php disabled( '', get_option('niteoCS_status', '') ); ?>>&nbsp;<?php _e('Maintanance Mode', 'cmp-coming-soon-maintenance');?><br>
								<span class="info"><?php _e('Returns 503 HTTP Service unavailable code to indexing robots. Set this option if your site is down due to maintanance and you want to display Maintanance page.','cmp-coming-soon-maintenance')?></span>
							 </legend><br>

							<legend title="maintanance" <?php echo ( $this->cmp_status() == 3 ) ? 'class="active"' : '';?>>
							  <input type="radio" name="activate" value="3" <?php checked( '3', get_option('niteoCS_activation', '2') ); ?> <?php disabled( '', get_option('niteoCS_status', '') ); ?>>&nbsp;<?php _e('Redirect Mode', 'cmp-coming-soon-maintenance');?><br>
								<span class="info redirect"><?php _e('Choose Redirect Mode if you want to redirect your website to another URL.','cmp-coming-soon-maintenance')?></span>
								<div class="redirect-inputs" <?php echo ( $this->cmp_status() == 3 ) ? 'style="display: block"' : 'style="display: none"';?>>
									<input type="text" id="niteoCS_URL_redirect" name="niteoCS_URL_redirect" value="<?php echo esc_url( $niteoCS_URL_redirect ); ?>" class="regular-text code"><br> 
									<label for="niteoCS_redirect_time"><?php _e('Delay Time in Seconds', 'cmp-coming-soon-maintenance');?></label>
									<input type="text" id="niteoCS_redirect_time" name="niteoCS_redirect_time" value="<?php echo esc_attr( $niteoCS_redirect_time ); ?>" class="regular-text code"><br> 
								</div>
							 </legend>
							 
						</fieldset>
					</td>
				</tr>

				<?php echo $this->render_settings->submit(); ?>

				</tbody>
			</table>

		</div>

		<div class="table-wrapper general">
			<h3><?php _e('Available Themes', 'cmp-coming-soon-maintenance');?></h3>
			<table class="general theme-selector">
				<tr>
				<td class="theme-selector">
					<fieldset>
						<legend class="screen-reader-text">
							<span><?php _e('Free Themes', 'cmp-coming-soon-maintenance');?> </span>
						</legend>
						<?php
						// move active theme to beginning
						$key = array_search ($this->cmp_selectedTheme(), $this->theme_array);
						if ( $key ) {
							$active = $this->theme_array[$key];
							unset($this->theme_array[$key]);
							array_unshift($this->theme_array, $active);
						}

						// define what attribute we want from style.css header
						$headers  = array('Version');
						
						foreach ( $this->theme_array as $theme_slug ) {
							$version = $this->cmp_theme_version( $theme_slug );
							$type = 'standard';

							// if premium get theme version 
							if ( in_array( $theme_slug, $this->premium_installed ) ) {
								$type = 'premium';
							}

							// get thumbnail
							$thumbnail = plugins_url('/img/thumbnails/'. $theme_slug . '_thumbnail.jpg', __FILE__); ?>

							<div class="theme-wrapper<?php if ( $this->cmp_selectedTheme() == $theme_slug ) { echo ' active'; } ?>" data-security="<?php echo esc_attr($ajax_nonce);?>" data-type="<?php echo esc_attr($type);?>" data-purchased="1" data-slug="<?php echo esc_attr($theme_slug);?>" data-version="<?php echo esc_html($version);?>" data-remote_url="<?php echo esc_url($this->remoteServer);?>">
								<div class="thumbnail-holder theme-details" style="background-image:url('<?php echo esc_url( $thumbnail ); ?>')"></div>
								
								<div class="buttons-wrapper">

									<div class="button theme-select hide<?php echo ( $this->cmp_selectedTheme() == $theme_slug ) ? ' activated' : '';?>">
										<input type="radio" name="select_theme" value="<?php echo esc_attr($theme_slug);?>" id="displayOption-<?php echo esc_attr($theme_slug);?>"<?php if ( $this->cmp_selectedTheme() == $theme_slug ) { echo ' checked="checked"'; } ?>>
										<span class="input-label"><?php if ( $this->cmp_selectedTheme() == $theme_slug ) { _e('Active', 'cmp-coming-soon-maintenance'); } else { _e('Select', 'cmp-coming-soon-maintenance'); }?></span>
									</div>

									<a href="<?php echo get_site_url().'?cmp_preview=true&selector=true&cmp_theme='.$theme_slug;?>" target="_blank" class="theme-preview button hide"><i class="fa fa-external-link" aria-hidden="true"></i><?php _e('PREVIEW', 'cmp-coming-soon-maintenance');?></a>
									
									<button type="button" class="theme-details button hide"><i class="fa fa-eye" aria-hidden="true"></i><?php _e('DETAILS', 'cmp-coming-soon-maintenance');?></button>
								</div>

								<div class="theme-inputs">

									<span class="theme-title"><?php echo ucwords(esc_html(str_replace('_', ' ', $theme_slug)));?></span>

									<?php echo ( $this->cmp_selectedTheme() == $theme_slug ) ? ' <span class="italic">'.__('Active', 'cmp-coming-soon-maintenance').'</span>' : '';?>

									<span class="theme-version">ver. <?php echo esc_html( $version );?></span>

								</div> <!-- theme-inputs -->
							</div> <!-- theme-wrapper -->

						  	<?php
						} ?>
					</fieldset>
				</td>
			</tr>
			
			<?php echo $this->render_settings->submit(); ?>

			</tbody>
			</table>
			<div class="theme-overlay cmp"></div>
		</div>

		<?php
		if ( !empty( $downloadable_themes ) ) { ?>

		<div class="table-wrapper general">
			<h3><?php _e('Download more CMP Themes', 'cmp-coming-soon-maintenance');?></h3>
			<table class="general theme-selector">
			<tbody>
				<tr>
				<td class="theme-selector">
					<fieldset>
						<legend class="screen-reader-text">
							<span><?php _e('Premium Themes', 'cmp-coming-soon-maintenance');?> </span>
						</legend>
						<?php 

						// build previews for downloadable themes
						foreach ( $downloadable_themes as $premium_theme ) {
							$theme_slug = $premium_theme['name'];
							$thumbnail = plugins_url('/img/thumbnails/'. $theme_slug . '_thumbnail.jpg', __FILE__); ?>

							<div class="theme-wrapper premium" data-security="<?php echo esc_attr($ajax_nonce);?>" data-slug="<?php echo esc_attr($theme_slug);?>" data-type="premium">

								<div class="thumbnail-holder theme-details" style="background-image:url('<?php echo esc_url( $thumbnail ); ?>')"></div>
								
								<div class="buttons-wrapper">

									<a href="<?php echo esc_url ($premium_theme['url'] );?>" target="_blank" class="theme-purchase button hide"><i class="fa fa-download" aria-hidden="true"></i><?php _e('Get Theme', 'cmp-coming-soon-maintenance');?></a>

									<a href="<?php echo 'http://cmp.niteothemes.com/?cmp_preview=true&selector=true&theme='.$theme_slug.'&utm_source=cmp&utm_medium=referral&utm_campaign='.$theme_slug.'';?>" target="_blank" class="theme-preview button hide"><i class="fa fa-external-link" aria-hidden="true"></i><?php _e('PREVIEW', 'cmp-coming-soon-maintenance');?></a>

									<button type="button" class="theme-details button hide"><i class="fa fa-eye" aria-hidden="true"></i><?php _e('DETAILS', 'cmp-coming-soon-maintenance');?></button>

								</div>

								<div class="theme-inputs">
									
									<span class="theme-title"><?php echo ucwords( esc_html( str_replace('_', ' ', $theme_slug) ) );?></span>
								</div>
							</div>

							<?php
						}  ?>
					</fieldset>
				</td>
			</tr>

			<?php echo $this->render_settings->submit(); ?>

			</tbody>
			</table>
		</div>

		<?php 
		} // if !empty($premium_themes ?> 

		<div class="table-wrapper content">
			<h3><?php _e('Content', 'cmp-coming-soon-maintenance');?></h3>
			<table class="content">
				<tbody>
				<tr class="body-title">
					<th><h4><?php _e('Title', 'cmp-coming-soon-maintenance');?></h4></th>
					<td>
						<fieldset>
							<input type="text" name="niteoCS_body_title" id="niteoCS_body_title" value="<?php echo esc_attr( $niteoCS_body_title ); ?>" class="regular-text code" placeholder="<?php _e('Leave empty to disable', 'cmp-coming-soon-maintenance');?>">
						</fieldset>
					</td>
				</tr>

				<tr>
					<th><h4><?php _e('Message', 'cmp-coming-soon-maintenance');?></h4></th>
					<td>
						<?php wp_editor( $this->niteo_sanitize_html( $niteoCS_body ), 'niteoCS_body', $settings = array('textarea_name'=>'niteoCS_body', 'editor_height'=>'300') ); ?>
					</td>
				</tr>

				<?php echo $this->render_settings->submit(); ?>

				</tbody>
			</table>

		</div>

		<?php 
		// get counter settings
		if ( isset( $theme_supports['counter'] ) && $theme_supports['counter'] ) {
			if ( file_exists(dirname(__FILE__) . '/inc/settings/settings-counter.php') ) {
				require (dirname(__FILE__) . '/inc/settings/settings-counter.php');
			}

		} else { 
			if ( file_exists(dirname(__FILE__) . '/inc/settings/settings-counter-disabled.php') ) {
				require (dirname(__FILE__) . '/inc/settings/settings-counter-disabled.php');
			}

		}

		// get subscribe settings
		if ( isset( $theme_supports['subscribe'] ) && $theme_supports['subscribe'] ) {
			if ( file_exists(dirname(__FILE__) . '/inc/settings/settings-subscribe.php') ) {
				require (dirname(__FILE__) . '/inc/settings/settings-subscribe.php');
			}

		} else { 
			if ( file_exists(dirname(__FILE__) . '/inc/settings/settings-subscribe-disabled.php') ) {
				require (dirname(__FILE__) . '/inc/settings/settings-subscribe-disabled.php');
			}

		}

		// get contact form settings
		if ( isset( $theme_supports['contact-form'] ) && $theme_supports['contact-form'] ) {
			if ( file_exists(dirname(__FILE__) . '/inc/settings/settings-contact_form.php') ) {
				require (dirname(__FILE__) . '/inc/settings/settings-contact_form.php');
			}

		} else { 
			if ( file_exists(dirname(__FILE__) . '/inc/settings/settings-contact_form-disabled.php') ) {
				require (dirname(__FILE__) . '/inc/settings/settings-contact_form-disabled.php');
			}

		}

		?>

		<div class="table-wrapper content" id="social-section">
			<h3><?php _e('Social Media', 'cmp-coming-soon-maintenance');?></h3>
			<table class="content">
			<tbody>
			<tr>
				<th><h4><?php _e('Social Section Title', 'cmp-coming-soon-maintenance');?></h4></th>
				<td>
					<fieldset>
						<input type="text" name="niteoCS_soc_title" id="niteoCS_soc_title" value="<?php echo esc_attr( $niteoCS_soc_title); ?>" class="regular-text code">
					</fieldset>
				</td>
			</tr>

			<tr>
				<th><h4><?php _e('Social Media Icons', 'cmp-coming-soon-maintenance');?></h4></th>
				<td>
					<p class="social-description"><?php _e('Click on Social Icons below to enable Social Media settings.', 'cmp-coming-soon-maintenance');?></p>
					<ul class="social-media">
						<?php 
						uasort( $socialmedia, array($this,'sort_social') );

						// render icons
						foreach ( $socialmedia as $social ) {

							// push soundcloud if missing - pre version 1.13

							$social_active = '';
							
							if ($social['hidden'] == '0') {
								$social_active = 'active';
							}

							switch ($social['name']) {
								case 'envelope-o':
									$title = __('Email Address', 'cmp-coming-soon-maintenance');
									break;
								case 'phone':
									$title = __('Phone Number', 'cmp-coming-soon-maintenance');
									break;
								case 'whatsapp':
									$title = __('Phone Number', 'cmp-coming-soon-maintenance');
									break;
								default:
									$title = ucfirst( esc_attr($social['name'] ) );
									break;
							} ?>

							<li>
								<i class="fa fa-<?php echo esc_attr($social['name']) . ' '. $social_active;?>" title="<?php echo esc_attr($title);?>" data-name="<?php echo esc_attr($social['name']);?>" aria-hidden="true"></i>
							</li>
							<?php
						} ?>
					</ul>
				
					<ul class="social-inputs">
						<span class="label"><?php _e('Position', 'cmp-coming-soon-maintenance');?></span><span class="label"><?php _e('Active', 'cmp-coming-soon-maintenance');?></span><span class="label"><?php _e('Website URL', 'cmp-coming-soon-maintenance');?></span>
						<?php
						foreach ( $socialmedia as $social ) {

							($social['hidden'] == '0') ? $active = 'active ' : $active = '';
							
							($social['active'] == '0') ? $disabled = 'disabled ' : $disabled = '';

							switch ( $social['name'] ) {
								case 'envelope-o':
									$title 	= __('Email Address', 'cmp-coming-soon-maintenance');
									$url 	= 'email@example.com';
									break;
								case 'google-plus':
									$title 	= ucfirst( $social['name'] );
									$url 	= 'https://plus.google.com/profile';
									break;
								case 'behance':
									$title 	= ucfirst( $social['name'] );
									$url 	= 'https://behance.net/profile';
									break;
								case 'phone':
									$title 	= __('Phone Number', 'cmp-coming-soon-maintenance');
									$url 	= '+123456789';
									break;
								case 'whatsapp':
									$title 	= __('Whatsapp Phone Number', 'cmp-coming-soon-maintenance');
									$url 	= '+123456789';
									break;
								case 'telegram':
									$title 	= ucfirst( $social['name'] );
									$url 	= 'https://telegram.me/username';
									break;
								default:
									$title 	= ucfirst( $social['name'] );
									$url 	= 'https://'.$social['name'].'.com/profile';
									break;
							} ?>
							<li class="<?php echo esc_attr($active).esc_attr($social['name']);?>">
								<p>	<i class="fa fa-sort" aria-hidden="true"></i>
									<label for="niteoCS_<?php echo esc_attr($social['name']);?>" class="<?php echo esc_attr($social['name']);?>"><?php echo esc_html($title);?></label>

									<input type="text" <?php echo $disabled;?>name="niteoCS_<?php echo esc_attr($social['name']);?>" id="niteoCS_<?php echo esc_attr($social['name']);?>" value="<?php echo esc_attr( $social['url'] ); ?>" class="regular-text code <?php echo esc_attr($social['name']);?>" data-name="<?php echo esc_attr($social['name']);?>" placeholder="<?php echo $url;?>">

									<input type="checkbox" name="niteoCS_<?php echo esc_attr($social['name']);?>_checkbox" id="niteoCS_<?php echo esc_attr($social['name']);?>_checkbox" class="<?php echo esc_attr($social['name']);?>" data-name="<?php echo esc_attr($social['name']);?>" <?php checked( '1', $social['active']  ); ?>>
								</p>
							</li>
							<?php
						} ?>

					</ul>

					<input type="hidden" name="niteoCS_socialmedia" id="niteoCS_socialmedia" value="<?php echo esc_attr( $niteoCS_socialmedia ); ?>" class="regular-text code active">
				</td>
			</tr>

			<?php 

			// include social special settings
			if (file_exists($this->cmp_themePath($this->cmp_selectedTheme()).$this->cmp_selectedTheme().'/'.$this->cmp_selectedTheme().'-social_settings.php')) {
				include ( $this->cmp_themePath($this->cmp_selectedTheme()).$this->cmp_selectedTheme().'/'.$this->cmp_selectedTheme().'-social_settings.php' );
			}
			?>
			<?php echo $this->render_settings->submit(); ?>

			</tbody>
			</table>
		</div>
		<?php 
		// get footer
		if ( isset( $theme_supports['footer'] ) && $theme_supports['footer'] ) {
			if ( file_exists( dirname(__FILE__) . '/inc/settings/settings-footer.php') ) {
				require_once ( dirname(__FILE__) . '/inc/settings/settings-footer.php' );
			}

		} else { 
			if ( file_exists(dirname(__FILE__) . '/inc/settings/settings-footer-disabled.php' ) ) {
				require_once ( dirname(__FILE__) . '/inc/settings/settings-footer-disabled.php' );
			}

		} 
		
		// get logo settings
		if ( isset( $theme_supports['logo'] ) && $theme_supports['logo'] ) {
			if ( file_exists(dirname(__FILE__) . '/inc/settings/settings-logo.php' ) ) {
				require ( dirname(__FILE__) . '/inc/settings/settings-logo.php' );
			}

		} else { 
			if ( file_exists(dirname(__FILE__) . '/inc/settings/settings-logo-disabled.php' ) ) {
				require ( dirname(__FILE__) . '/inc/settings/settings-logo-disabled.php' );
			}

		} 

		// get background settings
		if ( file_exists(dirname(__FILE__) . '/inc/settings/settings-background.php' ) ) {
			require ( dirname(__FILE__) . '/inc/settings/settings-background.php' );
		}

		// get background effects settings
		if ( file_exists(dirname(__FILE__) . '/inc/settings/settings-background_effects.php')  ) {
			require ( dirname(__FILE__) . '/inc/settings/settings-background_effects.php' );
		}

		// special effects for premium themes
		if ( in_array( $this->cmp_selectedTheme(), $this->premium_installed ) || ( isset( $theme_supports['special_effects'] )  && $theme_supports['special_effects'] ) )  { 

			// get background effects settings
			if ( file_exists(dirname(__FILE__) . '/inc/settings/settings-special_effects.php' ) ) {
				require  (dirname(__FILE__) . '/inc/settings/settings-special_effects.php' );
			}

		} else {

			if ( file_exists(dirname(__FILE__) . '/inc/settings/settings-special_effects-disabled.php' ) ) {
				require ( dirname(__FILE__) . '/inc/settings/settings-special_effects-disabled.php' );
			}	
		}

		// get slider settings 
		if ( isset( $theme_supports['slider'] ) && $theme_supports['slider'] ) {
			if ( file_exists(dirname(__FILE__) . '/inc/settings/settings-slider.php' ) ) {
				require  (dirname(__FILE__) . '/inc/settings/settings-slider.php' );
			}

		} else { 
			if ( file_exists(dirname(__FILE__) . '/inc/settings/settings-slider-disabled.php' ) ) {
				require ( dirname(__FILE__) . '/inc/settings/settings-slider-disabled.php' );
			}

		} 

		// include theme related settings
		if ( file_exists( $this->cmp_themePath( $this->cmp_selectedTheme() ).$this->cmp_selectedTheme().'/'.$this->cmp_selectedTheme().'-settings.php' ) ) {
			require ( $this->cmp_themePath( $this->cmp_selectedTheme() ).$this->cmp_selectedTheme().'/'.$this->cmp_selectedTheme().'-settings.php' );
		}
		?>

		<div class="table-wrapper theme-setup font-selector">
			<h3><?php _e('Customize Fonts', 'cmp-coming-soon-maintenance');?></h3>
			<table class="theme-setup">
			<tbody>
			<tr>
				<th><h4><?php _e('Headings Font', 'cmp-coming-soon-maintenance');?></h4></th>
				<td>
					<fieldset>
						<label for="niteoCS_font_headings_<?php echo esc_attr( $themeslug );?>"><?php _e('Font Family from ', 'cmp-coming-soon-maintenance');?><a href="https://fonts.google.com" target="_blank">Google Fonts</a></label></br>
						<select class="headings-google-font" name ="niteoCS_font_headings_<?php echo esc_attr( $themeslug );?>">
							<option value="<?php echo esc_attr( $heading_font['family'] ); ?>" selected="selected"><?php echo esc_html( $heading_font['family'] ); ?></option>
						</select>
					</fieldset>

					<fieldset>
						<label for="niteoCS_font_headings_variant_<?php echo esc_attr( $themeslug );?>"><?php _e('Variant', 'cmp-coming-soon-maintenance');?></label></br>
						<select class="headings-google-font-variant" name ="niteoCS_font_headings_variant_<?php echo esc_attr( $themeslug );?>">
							<option value="<?php echo esc_attr( $heading_font['variant'] ); ?>" selected="selected"><?php echo esc_html( $this->cmp_google_variant_title( $heading_font['variant'] ) ); ?></option>
						</select>
					</fieldset>

					<fieldset>
						<label for="niteoCS_font_headings_size_<?php echo esc_attr( $themeslug );?>"><?php _e('Font Size', 'cmp-coming-soon-maintenance');?>: <span><?php echo esc_attr( $heading_font['size'] ); ?></span>px</label></br>
						<input type="range" name="niteoCS_font_headings_size_<?php echo esc_attr( $themeslug );?>" min="10" max="75" step="1" value="<?php echo esc_attr( $heading_font['size'] ); ?>" data-css="font-size" data-type="heading" />
					</fieldset>

					<fieldset>
						<label for="niteoCS_font_headings_spacing_<?php echo esc_attr( $themeslug );?>"><?php _e('Letter Spacing', 'cmp-coming-soon-maintenance');?>: <span><?php echo esc_attr( $heading_font['spacing'] ); ?></span>px</label></br>
						<input type="range" name="niteoCS_font_headings_spacing_<?php echo esc_attr( $themeslug );?>" min="0" max="10" step="0.5" value="<?php echo esc_attr( $heading_font['spacing'] ); ?>" data-css="letter-spacing" data-type="heading" />
					</fieldset>

					<?php 
					// include theme animation settings
					if ( in_array($this->cmp_selectedTheme(), $font_animation) ) { ?>

						<fieldset>
							<label for="niteoCS_heading_animation_<?php echo esc_attr( $themeslug );?>"><?php _e('Animation', 'cmp-coming-soon-maintenance');?></label></br>
							<select name="niteoCS_heading_animation_<?php echo esc_attr( $themeslug );?>" class="heading-animation">
								<option value="none" <?php if ( $niteoCS_heading_animation == 'none' ) { echo ' selected="selected"'; } ?>><?php _e('No animation', 'cmp-coming-soon-maintenance');?></option>
								<option value="fadeInDown" <?php if ( $niteoCS_heading_animation == 'fadeInDown' ) { echo ' selected="selected"'; } ?>><?php _e('Fade In Down', 'cmp-coming-soon-maintenance');?></option>
								<option value="fadeInUp" <?php if ( $niteoCS_heading_animation == 'fadeInUp' ) { echo ' selected="selected"'; } ?>><?php _e('Fade In Up', 'cmp-coming-soon-maintenance');?></option>
								<option value="fadeInLeft" <?php if ( $niteoCS_heading_animation == 'fadeInLeft' ) { echo ' selected="selected"'; } ?>><?php _e('Fade In Left', 'cmp-coming-soon-maintenance');?></option>
								<option value="fadeInRight" <?php if ( $niteoCS_heading_animation == 'fadeInRight' ) { echo ' selected="selected"'; } ?>><?php _e('Fade In Right', 'cmp-coming-soon-maintenance');?></option>
							</select><br>
						</fieldset>
					<?php 
					} ?>

				</td>
			</tr>

			<tr>
				<th><h4><?php _e('Content Font', 'cmp-coming-soon-maintenance');?></h4></th>
				<td>

					<fieldset>
						<label for="niteoCS_font_content_<?php echo esc_attr( $themeslug );?>"><?php _e('Select Font Family from ', 'cmp-coming-soon-maintenance');?><a href="https://fonts.google.com" target="_blank">Google Fonts</a></label></br>

						<select class="content-google-font" name ="niteoCS_font_content_<?php echo esc_attr( $themeslug );?>">
							<option value="<?php echo esc_attr( $content_font['family'] ); ?>" selected="selected"><?php echo esc_html( $content_font['family'] ); ?></option>
						</select>
					</fieldset>

					<fieldset>
						<label for="niteoCS_font_content_variant_<?php echo esc_attr( $themeslug );?>"><?php _e('Variant', 'cmp-coming-soon-maintenance');?></label></br>
						<select class="content-google-font-variant" name ="niteoCS_font_content_variant_<?php echo esc_attr( $themeslug );?>">
							<option value="<?php echo esc_attr( $content_font['variant'] ); ?>" selected="selected"><?php echo esc_html( $this->cmp_google_variant_title( $content_font['variant'] ) ); ?></option>
						</select>
					</fieldset>

					<fieldset>
						<label for="niteoCS_font_content_size_<?php echo esc_attr( $themeslug );?>"><?php _e('Font Size', 'cmp-coming-soon-maintenance');?>: <span><?php echo esc_attr( $content_font['size'] ); ?></span>px</label></br>
						<input type="range" name="niteoCS_font_content_size_<?php echo esc_attr( $themeslug );?>" min="10" max="50" step="1" value="<?php echo esc_attr( $content_font['size'] ); ?>" data-css="font-size" data-type="content" />
					</fieldset>

					<fieldset>
						<label for="niteoCS_font_content_spacing_<?php echo esc_attr( $themeslug );?>"><?php _e('Letter Spacing', 'cmp-coming-soon-maintenance');?>: <span><?php echo esc_attr( $content_font['spacing'] ); ?></span>px</label></br>
						<input type="range" name="niteoCS_font_content_spacing_<?php echo esc_attr( $themeslug );?>" min="0" max="10" step="0.5" value="<?php echo esc_attr( $content_font['spacing'] ); ?>" data-css="letter-spacing" data-type="content" />
					</fieldset>

					<fieldset>
						<label for="niteoCS_font_content_lineheight_<?php echo esc_attr( $themeslug );?>"><?php _e('Line Height', 'cmp-coming-soon-maintenance');?>: <span><?php echo esc_attr( $content_font['line-height'] ); ?></span></label></br>
						<input type="range" name="niteoCS_font_content_lineheight_<?php echo esc_attr( $themeslug );?>" min="1.3" max="3" step="0.1" value="<?php echo esc_attr( $content_font['line-height'] ); ?>" data-css="line-height" data-type="content" />
					</fieldset>
					<?php 
					// include theme animation settings
					if ( in_array($this->cmp_selectedTheme(), $font_animation) ) { ?>

						<fieldset>
							<label for="niteoCS_content_animation_<?php echo esc_attr( $themeslug );?>"><?php _e('Select Animation', 'cmp-coming-soon-maintenance');?></label></br>
							<select name="niteoCS_content_animation_<?php echo esc_attr( $themeslug );?>" class="content-animation">
								<option value="none" <?php if ( $niteoCS_content_animation == 'none' ) { echo ' selected="selected"'; } ?>><?php _e('No animation', 'cmp-coming-soon-maintenance');?></option>
								<option value="fadeInDown" <?php if ( $niteoCS_content_animation == 'fadeInDown' ) { echo ' selected="selected"'; } ?>><?php _e('Fade In Down', 'cmp-coming-soon-maintenance');?></option>
								<option value="fadeInUp" <?php if ( $niteoCS_content_animation == 'fadeInUp' ) { echo ' selected="selected"'; } ?>><?php _e('Fade In Up', 'cmp-coming-soon-maintenance');?></option>
								<option value="fadeInLeft" <?php if ( $niteoCS_content_animation == 'fadeInLeft' ) { echo ' selected="selected"'; } ?>><?php _e('Fade In Left', 'cmp-coming-soon-maintenance');?></option>
								<option value="fadeInRight" <?php if ( $niteoCS_content_animation == 'fadeInRight' ) { echo ' selected="selected"'; } ?>><?php _e('Fade In Right', 'cmp-coming-soon-maintenance');?></option>
							</select><br>
						</fieldset>
					<?php 
					} ?>

					<p style="margin-bottom:0">Fonts preview</p>
					<div id="font-example-wrapper">
						<h3 id="heading-example" class="animated <?php echo esc_attr($niteoCS_heading_animation);?>" style="font-size:<?php echo esc_attr( $heading_font['size'] );?>px;letter-spacing:<?php echo esc_attr( $heading_font['spacing'] );?>px">Hello, I am your Headings font!</h3>
						<p id="content-example" class="animated <?php echo esc_attr($niteoCS_content_animation);?>" style="font-size:<?php echo esc_attr( $content_font['size'] );?>px;letter-spacing:<?php echo esc_attr( $content_font['spacing']  );?>px;line-height:<?php echo esc_attr( $content_font['line-height'] );?>">And this is a long paragraph. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					</div>

				</td>
				
			</tr>

			<?php echo $this->render_settings->submit(); ?>

			</tbody>
			</table>

		</div>

		<div class="table-wrapper seo">
			<h3><?php _e('SEO Settings', 'cmp-coming-soon-maintenance');?></h3>
			<table class="seo">
			<tbody>

			<tr>
				<th><h4><?php _e('Favicon', 'cmp-coming-soon-maintenance');?></h4></th>
				<td>
					<fieldset>
				        <input type="hidden" class="widefat" id="niteoCS-favicon-id" name="niteoCS_favicon_id" type="text" value="<?php echo esc_attr( $niteoCS_favicon_id ); ?>" />
				        <input id="add-favicon" type="button" class="button" value="Select Favicon" />
				        
				        <div class="favicon-wrapper">
				        	<?php 
				        	if ( isset($niteoCS_favicon_url) && $niteoCS_favicon_url !== '' ) {
				        		echo '<img src="'.esc_url($niteoCS_favicon_url).'" alt="">';
				        	} ?>
				        </div>
				        <input id="delete-favicon" type="button" class="button" value="Remove Favicon" />

					</fieldset>
				</td>
			</tr>

			<tr class="seo-title">
				<th><h4><?php _e('Header Title', 'cmp-coming-soon-maintenance');?></h4></th>
				<td>
					<fieldset>
						<input type="text" name="niteoCS_title" id="niteoCS_title" value="<?php echo esc_attr( $niteoCS_title); ?>" class="regular-text code">
					</fieldset>
				</td>
			</tr>

			<tr>
				<th><h4><?php _e('Description', 'cmp-coming-soon-maintenance');?></h4></th>
				<td>
					<fieldset>
						<textarea name="niteoCS_descr" id="niteoCS_descr" class="code"><?php echo esc_attr( $niteoCS_descr); ?></textarea>
					</fieldset>
				</td>
			</tr>

			<?php echo $this->render_settings->submit(); ?>

			</tbody> 
			</table>
		</div>

		<div class="table-wrapper seo">
			<h3><?php _e('Website Analytics', 'cmp-coming-soon-maintenance');?></h3>
			<table class="seo">
			<tbody>

				<tr>
					<th>
						<fieldset>
							<legend class="screen-reader-text">
								<span><?php _e('Analytics', 'cmp-coming-soon-maintenance');?></span>
							</legend>

							<p>
								<label title="<?php _e('Disabled', 'cmp-coming-soon-maintenance');?>">
								 	<input type="radio" class="analytics" name="niteoCS_analytics_status" value="disabled"<?php if ( $niteoCS_analytics_status == 'disabled') { echo ' checked="checked"'; } ?>>&nbsp;<?php _e('Disabled', 'cmp-coming-soon-maintenance');?>
								</label>
							</p>

							<p>
								<label title="<?php _e('Google Analytics', 'cmp-coming-soon-maintenance');?>">
								 	<input type="radio" class="analytics" name="niteoCS_analytics_status" value="google"<?php if ( $niteoCS_analytics_status == 'google') { echo ' checked="checked"'; } ?>>&nbsp;<?php _e('Google Analytics', 'cmp-coming-soon-maintenance');?>
								</label>
							</p>

							<p>
								<label title="<?php _e('Other', 'cmp-coming-soon-maintenance');?>">
								 	<input type="radio" class="analytics" name="niteoCS_analytics_status" value="other"<?php if ( $niteoCS_analytics_status == 'other') { echo ' checked="checked"'; } ?>>&nbsp;<?php _e('Other', 'cmp-coming-soon-maintenance');?>
								</label>
							</p>

						</fieldset>
					</th>

					<td>
						<fieldset>
						<p class="analytics-switch disabled"><?php _e('Analytics is disabled', 'cmp-coming-soon-maintenance');?></p>

						<p class="analytics-switch google">
							<label for="niteoCS_analytics"><?php _e('Insert Google Analytics Tracking ID', 'cmp-coming-soon-maintenance');?></label><br>
							
							<input type="text" name="niteoCS_analytics" value="<?php echo esc_attr( $niteoCS_analytics ); ?>" class="regular-text code" placeholder="UA-xxxxxx-xx"/>
							
						</p>

						<p class="analytics-switch other">
							<label for="niteoCS_analytics_other"><?php _e('Insert your Analytics Javascript code', 'cmp-coming-soon-maintenance');?></label><br>
							<textarea name="niteoCS_analytics_other" rows="5" class="code"><?php echo stripslashes( esc_js( $niteoCS_analytics_other ) ); ?></textarea>
						</p>
						</fieldset>

					</td>

				</tr>

			<?php echo $this->render_settings->submit(); ?>

			</tbody>
			</table>
		</div>



		<div class="table-wrapper-css custom_css">
			<h3><?php _e('Enter Custom CSS', 'cmp-coming-soon-maintenance');?></h3>
			

			<textarea name="niteoCS_custom_css" rows="20" id="niteoCS_custom_css" class="code"><?php echo esc_attr( $niteoCS_custom_css ); ?></textarea>

			<?php echo $this->render_settings->submit(); ?>
		</div>

		

		
	</form>


	</div> <!-- <div class="cmp-settings-wrapper"> -->

		<?php 
		// get sidebar with "widgets"
		if ( file_exists(dirname(__FILE__) . '/cmp-sidebar.php') ) {
			require (dirname(__FILE__) . '/cmp-sidebar.php');
		}

		?>

	</div> <!-- <div class="cmp-inputs-wrapper"> -->

</div> <!-- <div id="wrap"> -->

