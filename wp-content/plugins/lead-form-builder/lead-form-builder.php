<?php
/*
  Plugin Name: Lead Form Builder
  Description: Creating a contact form has never been so easy. Integrate forms anywhere at your website using easy shortcode and widget.
  Version: 1.3.6
  Author: ThemeHunk
  Text Domain: lead-form-builder
  Author URI: http://www.themehunk.com/
 */

  if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
  
// Version constant for easy CSS refreshes
define('LFB_VER', '1.0.0');

define('LFB_PLUGIN_URL', plugin_dir_url(__FILE__));

include_once( plugin_dir_path(__FILE__) . 'inc/lfb-constant.php' );

/**
 * Add the settings link to the Lead Form Plugin plugin row
 *
 * @param array $links - Links for the plugin
 * @return array - Links
 */
function lfb_plugin_action_links($links) {
  $settings_page = add_query_arg(array('page' => 'wplf-plugin-menu'), admin_url());
  $settings_link = '<a href="'.esc_url($settings_page).'">'.__('Settings', 'lead-form-builder' ).'</a>';
  array_unshift($links, $settings_link);

   $links['lfb_pro'] = sprintf( '<a style="color: #39b54a; font-weight: 700;" href="%s" target="_blank" class="lfb-plugins-gopro">%s</a>', 'https://themehunk.com/product/lead-form-builder-pro', __( 'Go Pro', 'lead-form-builder' ) );
  return $links;
}
add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'lfb_plugin_action_links', 10, 1);

include_once( plugin_dir_path(__FILE__) . 'inc/lf-db.php' );

register_activation_hook(__FILE__, 'lfb_plugin_activate');
if(!function_exists('lfb_include_file')) {
function lfb_include_file(){
include_once( plugin_dir_path(__FILE__) . 'inc/inc.php' );
}
add_action('init','lfb_include_file');
}
include_once( plugin_dir_path(__FILE__) . 'inc/lfb-widget.php' );

?>