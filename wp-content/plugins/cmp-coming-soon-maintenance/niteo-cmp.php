<?php
/*
 Plugin Name: 		CMP - Coming Soon & Maintenance Plugin
 Plugin URI: 		https://wordpress.org/plugins/cmp-coming-soon-maintenance/
 Description:       Display customizable landing page for Coming Soon, Maintenance & Under Construction page.
 Version:           2.7.1
 Author:            NiteoThemes
 Author URI:        https://www.niteothemes.com
 Text Domain:       cmp-coming-soon-maintenance
 Domain Path:		/languages
 License:           GPL-2.0+
 License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
*/


class niteo_cmp {

	public function __construct() {
		$this->author = 'NiteoThemes';
		$this->author_homepage = 'https://niteothemes.com';
		$this->version = '2.7.1';
		$this->dev = false;
		$this->plugins_dir_path = plugin_dir_path( __DIR__ );
		if ( $this->plugins_dir_path == './') {
			$this->plugins_dir_path  =  WP_PLUGIN_DIR . '/';
		}
		$this->premium_installed = array();
		// set array of themes with countdown
		$this->countdown_themes = array('frame', 'countdown', 'postery', 'countdown2', 'stylo', 'element');

		// get all installed themes [folder names under /themes] and put them to array
		$this->themes_standard = array_map('basename', glob( plugin_dir_path( __FILE__ ) . 'themes/*', GLOB_ONLYDIR));

		// check for installed premium themes
		if ( file_exists($this->plugins_dir_path . 'cmp-premium-themes/') ) {
	   		$this->premium_installed = array_map('basename', glob( $this->plugins_dir_path . 'cmp-premium-themes/*', GLOB_ONLYDIR));
	   		$this->theme_array = array_merge($this->themes_standard, $this->premium_installed);
		} else {
			$this->theme_array = $this->themes_standard;
		}

		// set remote server URL for updates
		$this->remoteServer = ($this->dev == true) ? 'https://niteothemes.com/updates-test/' : 'https://niteothemes.com/updates/';
		$this->minified = ($this->dev == true) ? '' : '.min';

		$this->init();

	}

	public function cmp() {
		$this->__construct();
	}

	public function init() {
		add_action( 'admin_notices', array($this, 'cmp_admin_notice') );
		add_action( 'template_redirect', array($this, 'cmp_displayPage') );
		add_action( 'wp_login', array($this, 'cmp_admin_override') );
		add_action( 'wp_before_admin_bar_render',array( $this, 'cmp_admin_bar' ));
		add_action( 'wp_ajax_niteo_themeinfo', array($this, 'niteo_themeinfo') );
		add_action( 'wp_ajax_niteo_unsplash', array($this, 'niteo_unsplash') );
		add_action( 'wp_ajax_niteo_export_csv', array($this, 'niteo_export_csv') );
		add_action( 'wp_ajax_cmp_theme_update_install', array($this, 'cmp_theme_update_install') );
		add_action( 'wp_ajax_cmp_toggle_activation', array($this, 'cmp_toggle_activation') );
		add_action( 'wp_ajax_nopriv_niteo_subscribe', array($this, 'niteo_subscribe') );
		add_action( 'wp_ajax_niteo_subscribe', array($this, 'niteo_subscribe') );
		add_action( 'wp_ajax_cmp_mailchimp_list_ajax', array($this, 'cmp_mailchimp_list_ajax') );
		add_action( 'plugins_loaded', array($this, 'cmp_textDomain') );
		add_action( 'admin_menu', array($this, 'cmp_adminMenu'), 10 );
		add_action( 'admin_init', array($this, 'cmp_adminInit') ) ;
		add_action( 'admin_init', array($this, 'cmp_admin_override') );
		add_action( 'admin_enqueue_scripts', array($this,'cmp_add_admin_style') ); 
		add_action( 'wp_enqueue_scripts', array($this,'cmp_add_admin_style') ); 
		add_action( 'upgrader_process_complete', array($this, 'cmp_plugin_update' ), 10, 2 );

		register_activation_hook( __FILE__, array($this, 'cmp_activate') );
		register_deactivation_hook( __FILE__, array($this, 'cmp_deactivate') );

		add_filter( 'style_loader_src',  array($this,'sdt_remove_ver_css_js'), 9999, 2 );
		add_filter( 'script_loader_src', array($this,'sdt_remove_ver_css_js'), 9999, 2 );
		add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array($this,'add_action_links') );

		// include feedback class
		require_once('inc/class-cmp-feedback.php');

	}
 
	public function cmp_adminInit() {

		if ( current_user_can('administrator') ) {
			// ini render-settings class
			require_once('inc/class-cmp-render_settings.php');
			$this->render_settings = new cmp_render_settings();

			if ( function_exists( 'wp_enqueue_code_editor' ) ) {
				wp_enqueue_code_editor( array( 'type' => 'text/css' ) );
			}
			
			wp_register_style( 'cmp-style',  plugins_url('/css/cmp-settings-style'.$this->minified.'.css', __FILE__),'', $this->version );
			wp_enqueue_style( 'cmp-style' );
			wp_register_style( 'font_awesome',  plugins_url('/css/font-awesome.min.css', __FILE__) );
			wp_register_style( 'countdown_flatpicker_css',  plugins_url('/css/flatpickr.min.css', __FILE__) );
			wp_register_style( 'animate-css',  plugins_url('/css/animate'.$this->minified.'.css', __FILE__) );
			wp_register_style( 'select2',  plugins_url('/css/select2.min.css', __FILE__) );
			
			wp_register_script( 'webfont', 'https://ajax.googleapis.com/ajax/libs/webfont/1.5.18/webfont.js', array(), false, true );
			wp_register_script( 'select2-js',  plugins_url('/js/select2.min.js', __FILE__) );
			wp_register_script( 'cmp-typography', plugins_url('/js/typography'.$this->minified.'.js', __FILE__), array('select2-js' ), $this->version );
			wp_register_script( 'cmp_settings_js',  plugins_url('/js/settings'.$this->minified.'.js', __FILE__), array('webfont', 'select2-js'), $this->version );
			wp_register_script( 'countdown_flatpicker_js',  plugins_url('/js/flatpickr.min.js', __FILE__) );
		}
		
	}

	// enqueue admin css and scripts only if admin is logged in
	public function cmp_add_admin_style() {

		$roles_topbar = json_decode( get_option('niteoCS_roles_topbar', '[]'), true );

		// push WP administrator to roles array, since it is default
		array_push( $roles_topbar, 'administrator' );

		// get current user
		$current_user = wp_get_current_user();

		// check for roles array length
		if ( count( $current_user->roles ) > 0 ) {
			// enqueue topbar script and style only, if current user is allowed to display topbar, or is admin
			foreach  ( $current_user->roles as $role ) {
				if ( in_array( $role, $roles_topbar ) ) {
					wp_register_style( 'cmp_admin_style',  plugins_url('/css/cmp-admin-head.css', __FILE__), '', $this->version);
					wp_enqueue_style( 'cmp_admin_style' );
					wp_register_script( 'cmp_admin_script',  plugins_url('/js/cmp-admin-head.js', __FILE__), array('jquery'), $this->version);
					wp_enqueue_script( 'cmp_admin_script' );
					break;
				}
			};

		// this one is for broken wp admin, where current user does not have any roles
		} else {
			wp_register_style( 'cmp_admin_style',  plugins_url('/css/cmp-admin-head.css', __FILE__), '', $this->version);
			wp_enqueue_style( 'cmp_admin_style' );
			wp_register_script( 'cmp_admin_script',  plugins_url('/js/cmp-admin-head.js', __FILE__), array('jquery'), $this->version);
			wp_enqueue_script( 'cmp_admin_script' );
		}

	}


	// remove default wp version from handles
	public function sdt_remove_ver_css_js( $src, $handle ) {
	    $handles_remove_ver = array('font_awesome', 'webfont', 'countdown_flatpicker_js', 'countdown_flatpicker_css', 'select2'); // <-- Adjust to your needs!
	    if ( in_array( $handle, $handles_remove_ver, true ) && strpos( $src, 'ver=' ) )
	        $src = remove_query_arg( 'ver', $src );

	    return $src;
	}


	//register scripts and load styles
	public function cmp_adminMenu() {
		/* Register our plugin page */
		$page = add_menu_page('CMP Settings', __('CMP Settings', 'cmp-coming-soon-maintenance'), 'activate_plugins', 'cmp-settings', array($this, 'cmp_settings_page'), plugins_url('/img/cmp.png', __FILE__));

		add_submenu_page('cmp-settings', 'Content Settings', __('Content Settings', 'cmp-coming-soon-maintenance'), 'manage_options', 'cmp-settings' );

		add_submenu_page('cmp-settings', 'Advanced Settings', 'Advanced Settings', 'manage_options', 'cmp-advanced', array($this, 'cmp_advanced_page') );

		add_submenu_page('cmp-settings', 'Subscribers', __('Subscribers', 'cmp-coming-soon-maintenance'), 'manage_options', 'cmp-subscribers', array($this, 'cmp_subs_page') );

		add_submenu_page('cmp-settings', 'Translation', __('Translation', 'cmp-coming-soon-maintenance'), 'manage_options', 'cmp-translate', array($this, 'cmp_translate_page') );

		add_submenu_page('cmp-settings', 'Upload New Theme', __('Upload New Theme', 'cmp-coming-soon-maintenance'), 'manage_options', 'cmp-upload-theme', array($this, 'cmp_upload_page') );

		add_submenu_page('cmp-settings', 'Help', __('Help', 'cmp-coming-soon-maintenance'), 'manage_options', 'cmp-help', array($this, 'cmp_help_page') );

		/* Using registered $page handle to hook script load */
		add_action('admin_print_scripts-'.$page, array($this, 'cmp_enqueueScripts'));

	}


	// enqueue styles and scripts when navigated to CMP Settings page
	public function cmp_enqueueScripts() {
	    	wp_localize_script( 'cmp-typography', 'fonts', array( 'google' => $this->cmp_get_google_fonts(), ) );
	        wp_enqueue_script('cmp_settings_js');
			wp_enqueue_script('cmp-typography');
			wp_enqueue_script( 'wp-color-picker');
			wp_enqueue_script( 'webfont' );
			wp_enqueue_script( 'select2-js');
			wp_enqueue_media();
			wp_enqueue_style( 'wp-color-picker');
			wp_enqueue_style( 'select2');
			wp_enqueue_style( 'font_awesome');
			if ( in_array( $this->cmp_selectedTheme(), $this->premium_installed ) ) {
				wp_enqueue_style('animate-css');
			}
	}

	public function cmp_settings_page() {
		// include default options page
		// check for them updates, not sure where else this to put
		$this->cmp_check_update( $this->cmp_selectedTheme() );
		require_once ('cmp-settings.php');
	}

	public function cmp_advanced_page() {
		wp_enqueue_script('select2-js');
		wp_enqueue_style('select2');
		require_once ('cmp-advanced.php');
	}

	public function cmp_subs_page() {
		require_once ('cmp-subscribers.php');
	}

	public function cmp_translate_page() {
		require_once ('cmp-translate.php');
	}

	public function cmp_upload_page() {
		require_once ('cmp-upload.php');
	}

	public function cmp_help_page() {
		require_once ('cmp-help.php');
	}


	public function cmp_asset_url( $filepath ) {
		return  plugins_url( $filepath, __FILE__ );
	}


	// override wp login page if cmp is enabled
	public function cmp_admin_override(){

		// if admin or CMP disabled, return
		if( current_user_can('administrator') || $this->cmp_status() == 0 ){
			return;
		}

		if( is_user_logged_in() ){

			// force redirect if logged-in user role is not set to bypass CMP
			if( !$this->cmp_roles_filter() ){
				wp_logout();
				wp_redirect( get_bloginfo('url') );
				exit();
			}
		}
	}

	// function to display CMP landing page
	public function cmp_displayPage() {

		// check if preview is set
		if ( isset($_GET['cmp_preview']) && $_GET['cmp_preview'] == 'true' )  {

			// register html class for rendering of HTML elements in Themes
			require ( dirname( __FILE__) . '/inc/class-cmp-render_html.php' );
			$html = new cmp_render_html();

		    // iframe preview with sidebar controls cmp_preview=true&selector=true - nt.com only
		    if ( isset($_GET['selector']) && $_GET['selector'] == 'true'  ) {
				if ( file_exists($this->plugins_dir_path . 'cmp-premium-themes/preview-selector.php') ) {
					require_once ($this->plugins_dir_path . 'cmp-premium-themes/preview-selector.php');
					die();
				}
		    }
		    
		    // preview for specific theme cmp_preview=true&theme=slug used in niteothemes
		    if ( isset($_GET['theme']) && !empty($_GET['theme']) ) {
		    	$theme_preview  = esc_attr($_GET['theme']);
		
				if ( file_exists( $this->cmp_themePath( $theme_preview ).$theme_preview.'/'.$theme_preview.'-theme.php') ) {
					require_once ( $this->cmp_themePath( $theme_preview) .$theme_preview.'/'.$theme_preview.'-theme.php' );
					die();
				}

		    }

		    // preview for specific theme cmp_preview=true&template=slug used in 
		    if ( isset($_GET['cmp_theme']) && !empty($_GET['cmp_theme']) ) {
		    	$theme_preview  = esc_attr($_GET['cmp_theme']);
		
				if ( file_exists( $this->cmp_themePath( $theme_preview ).$theme_preview.'/'.$theme_preview.'-theme.php') ) {
					require_once ( $this->cmp_themePath( $theme_preview) .$theme_preview.'/'.$theme_preview.'-theme.php' );
					die();
				}

		    }

		    //  finally render theme preview cmp_preview=true
		    if ( file_exists( $this->cmp_themePath( $this->cmp_selectedTheme() ).$this->cmp_selectedTheme().'/'.$this->cmp_selectedTheme().'-theme.php') ) {
				require_once ( $this->cmp_themePath( $this->cmp_selectedTheme() ).$this->cmp_selectedTheme().'/'.$this->cmp_selectedTheme().'-theme.php' );
				die();
			}
		}

		// bypass CMP and set cookie for user defined period of time, if bypass is enabled,  bypass ID is set, and match CMP bypass settings
		if ( isset($_GET['cmp_bypass']) && $_GET['cmp_bypass'] == get_option('niteoCS_bypass_id', md5( get_home_url() )) && get_option('niteoCS_bypass', '0') == '1' ) {
            nocache_headers();
            header('Cache-Control: max-age=0; private');
			setcookie('cmp_bypass', get_option('niteoCS_bypass_id', md5( get_home_url() ) ), time() + get_option('niteoCS_bypass_expire', '172800'));
			return;
		}

		// if bypass Cookie is set, return
		if ( isset($_COOKIE['cmp_bypass']) && $_COOKIE['cmp_bypass'] == get_option('niteoCS_bypass_id', md5( get_home_url() ) ) && get_option('niteoCS_bypass', '0') == '1' ) {
			return;
		}

		// Render CMP Theme mode if is activated and not in immediate redirect mode
		if ( $this->cmp_status() == 1 || $this->cmp_status() == 2 || ( $this->cmp_status() == 3 && get_option('niteoCS_redirect_time') != 0 ) ) {
			
			// check if user logged in, page filters and access role
			if ( !is_user_logged_in() && $this->cmp_page_filter() ) {

				// register html class for rendering of HTML elements in Themes
				require ( dirname( __FILE__) . '/inc/class-cmp-render_html.php' );
				$html = new cmp_render_html();

				// if themes with countdown timer
				if ( in_array($this->cmp_selectedTheme(), $this->countdown_themes) ){
					// if counter is enabled
					if ( get_option('niteoCS_counter', '1') == '1' ) {
						// if countdown date is set
						if ( get_option('niteoCS_counter_date' ) && get_option('niteoCS_counter_date' ) != '' ) {
							// if timer < timestamp do set action
							if ( get_option('niteoCS_counter_date' ) < time() ) {
								// if action set to disable cmp
								if ( get_option('niteoCS_countdown_action') == 'disable-cmp' ) {
									update_option('niteoCS_activation', '0');
								}

								// if action set to redirect
								if ( get_option('niteoCS_countdown_action') == 'redirect' ) {
									$redirect_url = esc_url(get_option('niteoCS_countdown_redirect'));
									header('Location: '.$redirect_url);
									die();
								}
							}
						}
					}
				}

		        // if maintanance mode send correct 503 headers
		        if ( $this->cmp_status() == '1' ){
		            header('HTTP/1.1 503 Service Temporarily Unavailable');
		            header('Status: 503 Service Temporarily Unavailable');
		            header('Retry-After: 86400'); // retry in a day
		        }

			    // render selected CMP theme
			    if ( file_exists( $this->cmp_themePath( $this->cmp_selectedTheme() ).$this->cmp_selectedTheme().'/'.$this->cmp_selectedTheme().'-theme.php') ) {
					require_once ( $this->cmp_themePath( $this->cmp_selectedTheme() ).$this->cmp_selectedTheme().'/'.$this->cmp_selectedTheme().'-theme.php' );
					die();
				}
			}
		}

		// if CMP in redirect mode with 0 timeout
		if ( $this->cmp_status() == 3 && get_option('niteoCS_redirect_time') == 0 && !is_user_logged_in() && $this->cmp_page_filter() ) {

			$redirect_url = get_option('niteoCS_URL_redirect');
			// redirect to URL
			if ( $redirect_url != '') {
				header('Location: '.esc_url( $redirect_url ));
				die();
			}
		}
	}


	// return CMP activation status and it`s states
	public function cmp_status() {

		if ( !get_option('niteoCS_status') ||
			get_option('niteoCS_status') == '' ||
			get_option('niteoCS_status') == false ) {
			return '0';

		} else {
			return get_option( 'niteoCS_activation', '2' );
		}
	}

    // function to toggle CMP activation for admin menu icon
    public function cmp_toggle_activation () {
		// check for ajax 
		if ( isset( $_POST['payload'] ) ) {
			// verify nonce
			check_ajax_referer( 'cmp-coming-soon-ajax-secret', 'security' );
			// verify user rights
			if( !current_user_can('publish_pages') ) {
				die('Sorry, but this request is invalid');
			}

	    	if ( get_option('niteoCS_status', '') == '' ) {
	    		update_option('niteoCS_status', '1');
	    	} else {
	    		update_option('niteoCS_status', '');
	    	}

	    	echo 'success';
	    	wp_die();
	    	return;
	    }
    }

	// check selected theme
	public function cmp_selectedTheme() {
		return get_option('niteoCS_theme', 'hardwork');
	}


	// return installed theme path
	public function cmp_themePath( $slug ) {
		if ( in_array($slug, $this->themes_standard) ) {
			return dirname(__FILE__) . '/themes/';

		} else {
			return $this->plugins_dir_path . 'cmp-premium-themes/';
		}
	}

	// return installed theme dir
	public function cmp_themeURL( $slug ) {
		if ( in_array($slug, $this->themes_standard) ) {
			return plugins_url( '/themes/', __FILE__ );

		} else {
			return plugins_url( '/cmp-premium-themes/');
			
		}
	}

	// older version of cmp_themeURL public function - migration after 1.9 version. 
	//can be deleted in future...
	public function cmp_themeDirPath() {
		if ( $this->niteo_in_array_r( $this->cmp_selectedTheme(), $this->cmp_premium_themes(), true ) ) {
			return plugins_url( '/cmp-premium-themes/');

		} else {
			return plugins_url( '/themes/', __FILE__ );
		}
	}

	// display admin topbar notice
    public function cmp_admin_bar(){

		// check onces and wordpress rights, else DIE
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' && (get_current_screen() && get_current_screen()->id == 'toplevel_page_cmp-settings' ) ) {

			//verify nonce and user rights
			if ( !wp_verify_nonce($_POST['save_options_field'], 'save_options') || !current_user_can('publish_pages') ) {
				die('Sorry, but this request is invalid');
			} 

			if ( isset($_POST['activate']) && is_numeric($_POST['activate']) ) {
				update_option('niteoCS_activation',  sanitize_text_field($_POST['activate']));
			}

			if ( isset($_POST['cmp_status']) ) {
				update_option('niteoCS_status', $this->sanitize_checkbox($_POST['cmp_status']) );
			} else {

				update_option('niteoCS_status', false);
			}

		}

    	require_once(ABSPATH . 'wp-admin/includes/screen.php');

		$roles_topbar = json_decode( get_option('niteoCS_roles_topbar', '[]'), true );

		// push WP administrator to roles array, since it is default
		array_push( $roles_topbar, 'administrator' );

		$current_user = wp_get_current_user();

		// if current user cannot access topbar, return
		foreach  ( $current_user->roles as $role ) {


			if ( !in_array( $role, $roles_topbar ) ) {
				return false;
			}
		};


        global $wp_admin_bar;

        $class = '';
        $msg= '';


        switch ( get_option( 'niteoCS_activation', '2' ) ) {
        	case '1':
	        	$msg = __('Maintenance Mode:','cmp-coming-soon-maintenance');
	        	$class = ' maintenance';
        		break;
        	case '2':
	        	$msg = __('Coming Soon Mode:','cmp-coming-soon-maintenance');
	        	$class = ' coming-soon';
        		break;
        	case '3':
	        	$msg = __('Redirect Mode:','cmp-coming-soon-maintenance');
	        	$class = ' redirect';
        		break;
        	default:
        		break;
        }

        $ajax_nonce = wp_create_nonce( 'cmp-coming-soon-ajax-secret' );

        $msg = '<img src="'.plugins_url('/img/cmp.png', __FILE__).'" alt="CMP Logo" class="cmp-logo"><span class="cmp-status-msg">'.$msg.'</span>';
        $msg .='<div class="toggle-wrapper">
								<input type="checkbox" id="cmp-status-menubar" class="toggle-checkbox"'.checked( '1', get_option('niteoCS_status', false), false ).' name="cmp_status_menu"  data-security="'. esc_attr($ajax_nonce).'">
								<label for="cmp-status-menubar" class="toggle"><span class="toggle_handler"></span></label>
							</div>';

    	//Add the main siteadmin menu item
        $wp_admin_bar->add_menu( array(
            'id'     => 'cmp-admin-notice',
            'href' => admin_url().'admin.php?page=cmp-settings',
            'parent' => 'top-secondary',
            'title'  => $msg,
            'meta'   => array( 'class' => 'cmp-notice'.$class ),
        ) );

        // Display CMP Settings in topbar only for administrator
		if ( user_can( $current_user, 'administrator' ) ) {
		    $wp_admin_bar->add_node( array(
		    	'id'     => 'cmp-settings',
		    	'title'  => __('CMP Settings', 'cmp-coming-soon-maintenancee'),
		    	'href'   => admin_url('admin.php?page=cmp-settings'),
		    	'parent' => 'cmp-admin-notice'
		    ));
		}

	    $wp_admin_bar->add_node( array(
	    	'id'    => 'cmp-preview',
	    	'title' => __('CMP Preview', 'cmp-coming-soon-maintenancee'),
	    	'href'  => get_site_url().'/?cmp_preview=true',
	    	'parent'=> 'cmp-admin-notice',
	    	'meta' => array('target' => '_blank' )
	    ));

    }

	public function cmp_activate() {

		if ( get_option('niteoCS_archive') ) {
			//get all the options back from the archive
			$options = get_option('niteoCS_archive');
			// update options
			foreach ($options as $option) {
				update_option($option['name'], $option['value']);
			}

			// delete archive
			delete_option('niteoCS_archive');
		}
	}

	// archive plugin stuff when plugin is deactivated
	public function cmp_deactivate() {
		//get all the options. store them in an array
		$options = array();

		global $wpdb;
		$saved_options = $wpdb->get_results( "SELECT * FROM $wpdb->options WHERE option_name LIKE 'niteoCS_%'", OBJECT );
		$i = 0;
		foreach ($saved_options as $option) {
			$options[$i] = array('name' => $option->option_name, 'value' => get_option( $option->option_name) );
			$i++;
		}

		//store the options all in one record, in case we ever reactivate the plugin
		update_option('niteoCS_archive', $options);

		//delete the separate ones
		foreach ( $options as $option ) {
			delete_option($option['name']);

		}

	}

	// clean plugin stuff when plugin is deleted
	public function cmp_plugin_delete() {
		delete_option('niteoCS_archive');
	}

	// returns list of premium themes => manually defined
	public function cmp_premium_themes() {
		
		$premium_themes = array();
		array_push( $premium_themes, array('name' => 'element', 'url' => 'https://niteothemes.com/?filter=cmp-plugin-themes&utm_source=cmp&utm_medium=referral&utm_campaign=element', 'price' => '10') );

		array_push( $premium_themes, array('name' => 'stylo', 'url' => 'https://niteothemes.com/?filter=cmp-plugin-themes&utm_source=cmp&utm_medium=referral&utm_campaign=stylo', 'price' => '10') );

		array_push( $premium_themes, array('name' => 'fifty', 'url' => 'https://niteothemes.com/?filter=cmp-plugin-themes&utm_source=cmp&utm_medium=referral&utm_campaign=fifty', 'price' => '10') );

		array_push( $premium_themes, array('name' => 'hardwork_premium', 'url' => 'https://niteothemes.com/?filter=cmp-plugin-themes&utm_source=cmp&utm_medium=referral&utm_campaign=hardwork_premium', 'price' => '10') );

		array_push( $premium_themes, array('name' => 'postery', 'url' => 'https://niteothemes.com/?filter=cmp-plugin-themes&utm_source=cmp&utm_medium=referral&utm_campaign=postery', 'price' => '10') );

		array_push( $premium_themes, array('name' => 'frame', 'url' => 'https://niteothemes.com/?filter=cmp-plugin-themes&utm_source=cmp&utm_medium=referral&utm_campaign=frame', 'price' => '10') );

		array_push( $premium_themes, array('name' => 'eclipse', 'url' => 'https://niteothemes.com/?filter=cmp-plugin-themes&utm_source=cmp&utm_medium=referral&utm_campaign=eclipse', 'price' =>'0') );

		array_push( $premium_themes, array('name' => 'orbit', 'url' => 'https://niteothemes.com/?filter=cmp-plugin-themes&utm_source=cmp&utm_medium=referral&utm_campaign=orbit', 'price' => '0') );
		
		// array_push( $premium_themes, array('name' => 'coder', 'url' => 'https://niteothemes.com/?filter=cmp-plugin-themes&utm_source=cmp&utm_medium=referral&utm_campaign=coder', 'price' => '0') );

		return $premium_themes;
	}

	/**
	 * Difference between Premium Themes installed and Premium Themes available sets in cmp_premium_themes() function.
	 *
	 * @since 2.2
	 * @access public
	 * @return array
	 */
	public function cmp_downloadable_themes() {
		$downloadable_themes = array();

		foreach ( $this->cmp_premium_themes() as $premium ) {
			if ( !in_array($premium['name'], $this->premium_installed) ) {
				array_push( $downloadable_themes, $premium );
			} 
		}

		return $downloadable_themes;
	}

	// theme updates function
	public function cmp_check_update( $theme_slug ) {

		if ( !in_array( $theme_slug, $this->premium_installed ) ) {
			return;
		}

		// check for current theme version
		$remote_version = '';
		$current_version = '';

		if ( $this->dev == true ) {
			delete_transient( $theme_slug.'_updatecheck' );
		}

		// check if update check transient is set
		if ( false === ( $updatecheck_transient = get_transient( $theme_slug.'_updatecheck' ) ) ) {
			
			$current_version = $this->cmp_theme_version($theme_slug);
			// get remote version from  remote server
			$request = wp_remote_post( $this->remoteServer.'?action=get_metadata&slug='.$theme_slug, array('body' => array('action' => 'version')) );
			
			// if no error, retrivee body
		    if ( !is_wp_error( $request ) ) {

		    	// decode to json
		        $remote_version = json_decode( $request['body'], true );

		        // get remove version key
		        if ( isset($remote_version['version']) ) {

		        	$remote_version = $remote_version['version'];

		        	// if remote version is bigger than current, display info about new version
		        	if ( (float)$remote_version > (float)$current_version ) {

		        		$title = ucwords(str_replace('_', ' ', $theme_slug));

		        		// create nonce
		        		$ajax_nonce = wp_create_nonce( 'cmp-coming-soon-ajax-secret' );

		        		// if admin screen is not in updating theme
		        		if (!isset($_GET['theme']) || (isset($_GET['theme']) && $_GET['theme'] != $theme_slug)) {

		        			$transient = '<div class="update-nag notice notice-warning"><p class="message">'.sprintf(__('There is a <b>recommended</b> update of <b>CMP Theme %s</b> available:', 'cmp-coming-soon-maintenance'), $title).' <a href="'.admin_url().'options-general.php?page=cmp-settings&action=update-cmp-theme&theme='.esc_attr($theme_slug).'&type=premium" class="update-theme" data-type="premium" data-security="'.esc_attr($ajax_nonce).'" data-slug="'.esc_attr($theme_slug).'" data-name="'.esc_attr($title).'" data-remote_url="'.esc_url($this->remoteServer).'" data-new_ver="'.esc_attr($remote_version).'">'.__(' update now','cmp-coming-soon-maintenance').'</a> or <a href="'.esc_url($this->remoteServer).'readme/'.esc_attr($theme_slug).'-readme.php" class="view-release">'.sprintf(__('view update %s notes.','cmp-coming-soon-maintenance'), $remote_version).'</a></p><div class="release-note"></div></div>';

		        			// set transient with 12 hour expire
		        			set_transient( $theme_slug.'_updatecheck', $transient, 60*60*12 );

		        			echo $transient;
		        		}

		        	} else {
		        		// set transient no update available with 12 hours expire
		        		set_transient( $theme_slug.'_updatecheck', '', 60*60*12 );
		        	}

		        }
		    }

		} else if ( $updatecheck_transient != '' ) {
			echo $updatecheck_transient;
		}

		return;
	}

	public function cmp_theme_upload($zip) {
		// allow zip file to upload
		add_filter('upload_mimes', array($this, 'niteo_allow_zip_mime'));

	    // load PHP WP FILE 
		if ( ! function_exists( 'wp_handle_upload' ) ) {
		    require_once realpath('../../../wp-admin/includes/file.php');
		}

		$uploadedfile	= $zip;
		$filename		= $uploadedfile['name'];
		/* You can use wp_check_filetype() public function to check the
		 file type and go on wit the upload or stop it.*/
		$filetype = wp_check_filetype( $filename );

		if ( $filetype['ext'] == 'zip' ) {
			// Upload file
			$movefile = wp_handle_upload( $uploadedfile, array('test_form' => FALSE) );

			if ( $movefile && !isset( $movefile['error'] ) ) {

				WP_Filesystem();
		        $source_path		= $movefile['file'];
		        $theme_name			= str_replace('.zip', '', $filename);
				$destination_path	= $this->plugins_dir_path . 'cmp-premium-themes/';

				// create new theme DIR
				if ( wp_mkdir_p( $destination_path ) ) {
					// Unzip FILE into that DIR
					$unzipfile = unzip_file( $source_path, $destination_path);
					   
					   if ( $unzipfile ) {
					   		// delete FILE
					   		wp_delete_file( $source_path );
					   		$this->premium_installed = array_map('basename', glob( $destination_path . '*', GLOB_ONLYDIR));
					   		$this->theme_array = array_merge( $this->themes_standard, $this->premium_installed );
							echo '<div class="notice notice-success is-dismissible"><p class="message">'.ucwords(str_replace('_', ' ', $theme_name)).' '.__(' theme was successfully installed!', 'cmp-coming-soon-maintenance').'</p></div>';
							return;

					   } else {
					   		echo '<div class="notice notice-error is-dismissible"><p>'.__('There was an error unzipping the file!', 'cmp-coming-soon-maintenance').'</p></div>';   
					   		return;
					   }

				} else {
					echo '<div class="notice notice-error is-dismissible"><p>'.__('Error creating Theme subdirectory!', 'cmp-coming-soon-maintenance').'</p></div>';   
					return;
				}

			} else {
			    /**
			     * Error generated by _wp_handle_upload()
			     * @see _wp_handle_upload() in wp-admin/includes/file.php
			     */
			    echo '<div class="notice notice-error is-dismissible"><p>'.$movefile['error'].'</p></div>'; 
			    return;
			}
		} else {
			echo '<div class="notice notice-error is-dismissible"><p>'.__('Unable to upload new Theme file .', 'cmp-coming-soon-maintenance'). strtoupper($filetype['ext']) .__(' file extension is not supported. Please upload ZIP file containing CMP Theme.', 'cmp-coming-soon-maintenance').'</p></div>';  
			return;
		}

		add_filter('upload_mimes', array($this, 'niteo_remove_zip_mime'));
		return;
	}

	public function cmp_theme_update_install( $file ) {
		$ajax = false;
		// check for ajax 
		if ( isset( $_POST['file'] ) ) {
			// verify nonce
			check_ajax_referer( 'cmp-coming-soon-ajax-secret', 'security' );
			// verify user rights
			if( !current_user_can('publish_pages') ) {
				die('Sorry, but this request is invalid');
			}

			// sanitize array
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			if ( !empty( $_POST['file'] ) ) {
				$file = $_POST['file'];
				$ajax   = true;
			}
	    }

	    // load PHP WP FILE 
		if ( ! empty( $file ) ) {
			// Download file to temp location.
			$file['tmp_name'] = download_url( $file['url'] );

			// If error storing temporarily, return the error.
			if ( !is_wp_error( $file['tmp_name'] ) ) {
				WP_Filesystem();

		        $source_path		= $file['tmp_name'];
		        $theme_name			= $file['name'];

		        $destination_path	= $this->plugins_dir_path . 'cmp-premium-themes/';

				// create new theme DIR
				if ( wp_mkdir_p( $destination_path ) ) {
					// Unzip FILE into that DIR
					$unzipfile = unzip_file( $source_path, $destination_path);
					   
					   if ( $unzipfile ) {
					   		
					   		// delete FILE
					   		wp_delete_file( $source_path );
					   		// reload premium installed themes
					   		$this->premium_installed = array_map('basename', glob( $destination_path . '*', GLOB_ONLYDIR));
					   		// add it to all installed themes array
					   		$this->theme_array = array_merge( $this->themes_standard, $this->premium_installed );
					   		// reply response 
			        		// set transient no update available with 24 hours expire
			        		set_transient( $theme_name.'_updatecheck', '', 60*60*24 );
							// die
							if ( $ajax ) {
								wp_die('success');
								return;
							} else {
								echo '<div class="notice notice-success is-dismissible"><p>'.ucwords(str_replace('_', ' ', $theme_name)).' '.__('theme was successfully updated to new version!', 'cmp-coming-soon-maintenance').'</p></div>';
								return;
							}
					   
					   } else {
					   		echo '<div class="notice notice-error is-dismissible"><p>'.__('There was an error unzipping the file!', 'cmp-coming-soon-maintenance').'</p></div>';   
							if ( $ajax ) {
								wp_die();
								return;
							} else {
								return;
							}
					   }

				} else {
					echo '<div class="notice notice-error is-dismissible"><p>'.__('Error creating Theme subdirectory!', 'cmp-coming-soon-maintenance').'</p></div>';   
					if ( $ajax ) {
						wp_die();
						return;
					} else {
						return;
					}
				}

			} else {
				echo '<div class="notice notice-error is-dismissible"><p>'.__('Error during updating Theme files:', 'cmp-coming-soon-maintenance').' '.$file['tmp_name']->get_error_message().'</p></div>'; 
				if ( $ajax === true ) {
					wp_die();
				} else {
					return;
				}
			}
		} else {

			echo '<div class="notice notice-error is-dismissible"><p>'.__('General Error during updating Theme files.', 'cmp-coming-soon-maintenance').'</p></div>';  
			if ( $ajax === true ) {
				wp_die();
			} else {
				return;
			}
		}
	}

	public function cmp_textDomain() {
		load_plugin_textdomain( 'cmp-coming-soon-maintenance', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	// build unsplash api
	public function cmp_unsplash_api ( $query ) {

		$api_url = 'https://api.unsplash.com/'.$query.'&client_id=41f043163758cf2e898e8a868bc142c20bc3f5966e7abac4779ee684088092ab' ;
		
		if ( function_exists( 'wp_remote_get' ) ) {

			$response = wp_remote_get( $api_url );

			if ( !is_object( $response ) && isset( $response['body'] ) ) {

				$body = $response['body'];
				$data = array( 'response' => $response['response']['code'], 'body' => $body );

			} else {
				$data = array( 'response' => 'Unplash API', 'body' => 'Not responding after 5000ms' );
			}

		} else {
		    $data = array( 'response' => '500', 'body' => 'You have neither cUrl installed nor allow_url_fopen activated. Ask your server hosting provider to allow on of those options.' );
		}

		return $data;
	}

	// prepare unsplash url and get unsplash photo via cmp_unsplash_api()
	public function niteo_unsplash( $params ) {
		$ajax = false;

		// check for ajax 
		if ( isset( $_POST['params'] ) ) {
			// verify nonce
			check_ajax_referer( 'cmp-coming-soon-ajax-secret', 'security' );
			// verify user rights
			if( !current_user_can('publish_pages') ) {
				die('Sorry, but this request is invalid');
			}

			// sanitize array
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			if ( !empty( $_POST['params'] ) ) {
				$params = $_POST['params'];
				$ajax   = true;
			}
	    }

	    array_key_exists ('feed', $params) 			? $feed 		= $params['feed'] 		: $feed = '';
	    array_key_exists ('url', $params)			? $url 			= $params['url'] 		: $url = '';
	    array_key_exists ('feat', $params)			? $feat 		= $params['feat'] 		: $feat = '';
	    array_key_exists ('custom_str', $params)	? $custom_str 	= $params['custom_str'] : $custom_str = '';
	    array_key_exists ('count', $params)			? $count 		= $params['count'] 		: $count = '1';

		switch ( $feed ) {
			// specific unsplash photo by url/id
			case '0':
				$id = '';
				// check if $query contains unsplash.com url
				if ( strpos( $url, 'unsplash.com' ) !== false ) {
					$parts = parse_url( $url );
					// check for photo parameter in URL
					if ( isset($parts['query'])) {
						parse_str($parts['query'], $query);
					    $id = $query['photo'];
					}
				    // if no ID found, get last part of URL containing ID
				    if ( $id == '' ) {

						$pathFragments = explode('/', $parts['path']);
						$id = end($pathFragments);
				    }

				// $query is ID
				} else {
					$id = $url;
				}

				// prepare query for single image
				$api_query = 'photos/'.$id.'?';
				break;

			// random from user
			case '1':

				if ( $custom_str[0] == '@' ) {
					$custom_str = substr($custom_str, 1);
				}

				// prepare query for random photo from collection
				$api_query = 'photos/random/?username='.$custom_str.'&count='.$count;
				break;

			// random from collection
			case '2':
				if ( is_numeric( $url ) ) {
					$collection = $url;
				} else {
					$collection = filter_var($url, FILTER_SANITIZE_NUMBER_INT);
					$collection = str_replace('-', '', $collection );
				}

				// prepare query for random photo from collection
				$api_query = 'photos/random/?collections='.$collection.'&count='.$count;
				break;

			// random photo
			case '3':

				// featured
				if ( $feat == '0' || $feat == '') {
					$featured = 'false';
				} else {
					$featured = 'true';
				}

				// category
				$search = str_replace(' ', ',', $url);

				if ( $search !== '' ) {
					$search = 'query='.$search.'&';
				}
				// prepare query for random photo
				$api_query = 'photos/random/?orientation=landscape&featured='.$featured.'&'.$search.'count='.$count;
				break;

			default:
				$api_query = 'photos/random/?orientation=landscape&count='.$count;
				break;
		}

		$unsplash_img = $this->cmp_unsplash_api( $api_query );

		if ( $ajax === true ) {
			echo json_encode($unsplash_img);
			wp_die();

		} else {
			return $unsplash_img;
		}
	}
	
	// check value in multidimensional array
	public function niteo_in_array_r($needle, $haystack, $strict = false) {
	    foreach ( $haystack as $item ) {
	        if ( ( $strict ? $item === $needle : $item == $needle ) || ( is_array( $item ) && $this->niteo_in_array_r( $needle, $item, $strict ) ) ) {
	            return true;
	        }
	    }

	    return false;
	}

	// save subscribe function
	// $check must be true, to avoid duplicated requests after update to 2.1
	public function niteo_subscribe( $check ) {

		$subscribe_method 			= get_option('niteoCS_subscribe_method', 'cmp');

		$response = '';
		$response_invalid = 'Please insert valid Email address.';
		$ajax = false;

		// check for ajax request
		if ( isset( $_POST['check'] ) && $_POST['check'] == true ) {
			$check = true;
			$ajax = true;
		}

		if ( $check === true ) :

	        if ( $_SERVER['REQUEST_METHOD'] == 'POST'
	            && isset( $_POST['form_honeypot'] )
	            && $_POST['form_honeypot'] === ''
	            && isset( $_POST['email'] ) )
	        {

	        	if ( is_email( $_POST['email'] ) ) {
	        		// email already passed is_email, no need to sanitize
	        		$email = $_POST['email'];

	        		// sanitize all inputs
	        		$ip_address = ( isset( $_POST['lastname'] ) ) ? sanitize_text_field($_SERVER['REMOTE_ADDR']) : '';
	        		$firstname = ( isset( $_POST['firstname'] ) ) ? sanitize_text_field( $_POST['firstname'] ) : '';
	        		$lastname = ( isset( $_POST['lastname'] ) ) ? sanitize_text_field( $_POST['lastname'] ) : '';
					$timestamp = time();

					// get translation lists
		            if ( get_option('niteoCS_translation') ) {
		                $translation    		= json_decode( get_option('niteoCS_translation'), true );
		                $response_ok    		= $translation[7]['translation'];
		                $response_duplicate 	= $translation[5]['translation'];
		                $response_invalid 		= $translation[6]['translation'];

		            } else {
		                $response_ok    		= 'Thank you, your sign-up request was successful!';
		                $response_duplicate		= 'This Email address has already been on our subscriber list.';
		                $response_invalid 		= 'Please insert valid Email address.';
		            } 

	        		switch ( $subscribe_method ) {
	        			// default custom CMP method
	        			case 'cmp':
							// get subscribe list 
							$subscribe_list = get_option('niteoCS_subscribers_list');

							// if no subscribe list yet, create first item and insert it into DB
							if ( !$subscribe_list ) {
								$new_list = array();
								$new_email = array( 'id' => '0', 'timestamp' => $timestamp, 'email' => $email, 'ip_address' => $ip_address, 'firstname' => $firstname, 'lastname' => $lastname );
								array_push( $new_list, $new_email );
								update_option( 'niteoCS_subscribers_list', $new_list );
								$response = array( 'status' => '1', 'message' => $response_ok);

							} else {
								// check if email don`t already exists
								if ( !$this->niteo_in_array_r( $email, $subscribe_list, true ) ) {
									$count = count( $subscribe_list );
									$new_email = array( 'id' => $count, 'timestamp' => $timestamp, 'email' => $email, 'ip_address' => $ip_address, 'firstname' => $firstname, 'lastname' => $lastname );
									array_push( $subscribe_list, $new_email );
									update_option('niteoCS_subscribers_list', $subscribe_list);
									$response = array( 'status' => '1', 'message' => $response_ok);
									
								// if email exists return duplicate response
								} else {
									$response = array( 'status' => '0', 'message' => $response_duplicate);
								}
							}
	        				break;

	        			// mailchimp API call
	        			case 'mailchimp':
							$api_key = esc_attr( get_option('niteoCS_mailchimp_apikey') );
							$list_id = esc_attr( get_option('niteoCS_mailchimp_list_selected') );
							$email = $_POST['email'];
							$status = 'subscribed'; // subscribed, cleaned, pending
							 
							$args = array(
								'method' => 'PUT',
							 	'headers' => array(
									'Authorization' => 'Basic ' . base64_encode( 'user:'. $api_key )
								),
								'body' => json_encode(array(
							    	'email_address' => $email,
									'status'        => $status
								))
							);

							$mailchimp = wp_remote_post( 'https://' . substr($api_key,strpos($api_key,'-')+1) . '.api.mailchimp.com/3.0/lists/'. $list_id .'/members/' . md5(strtolower($email)), $args );
							
							if ( !is_wp_error( $mailchimp ) ) {

								$body = json_decode( $mailchimp['body'] );

								if ( $mailchimp['response']['code'] == 200 && $body->status == $status ) {
									$response = array( 'status' => '1', 'message' => $response_ok);

								} else {
									$response = array( 'status' => '0', 'message' => 'Error ' . $mailchimp['response']['code'] . ' ' . $body->title . ': ' . $body->detail);
								}

							} else {
								$error = $mailchimp->get_error_message();
								$response = array( 'status' => '0', 'message' => $error);
							}

	        				break;

	        			default:
	        				break;
	        		}

				// if not email, set response invalid
				} else {
					$response = array( 'status' => '0', 'message' => $response_invalid);
				}
			} 

		endif; // $check !== true

		if ( $ajax === true ) {
			echo json_encode( $response );
			wp_die();

		} else {
			return ( $response == '' ) ? $response : json_encode( $response );
		}
		
	}

	public function niteo_export_csv() {
		// load subscribers array
		$subscribers = get_option('niteoCS_subscribers_list');

		if( !empty($subscribers) ) {
			$filename = 'subscribers-list-' . date('Y-m-d') . '.csv';
			header('Content-Type: text/csv');
			header('Content-Disposition: attachment;filename='.$filename);
			$fp = fopen('php://output', 'w');
			fputcsv($fp, array(__('Date','cmp-coming-soon-maintenance'),__('Email','cmp-coming-soon-maintenance')));
			foreach ($subscribers as $key => $value) {
				if ( isset( $value['ip_address'] ) ) {
					unset($subscribers[$key]['ip_address']);
				}
				if ( isset( $value['id'] ) ) {
					unset($subscribers[$key]['id']);
				}

				if ( isset( $value['timestamp'] ) )	{	
					$format="Y-m-d H:i:s";
					$subscribers[$key]['timestamp'] = date_i18n($format, $subscribers[$key]['timestamp']);
				}
			}

			foreach ( $subscribers as $key => $value ) {
				fputcsv($fp, $value, $delimiter = ',', $enclosure = '"' );
			}
			fclose($fp);
		}
		die();
	}

	public function niteo_allow_zip_mime( $existing_mimes = array() ) {
		// add your own extension here - as many as you like
		$existing_mimes['zip'] = 'application/zip'; 
		 
		// return amended array
		return $existing_mimes;
	}

	public function niteo_remove_zip_mime( $existing_mimes = array() ) {
		// remove zip mime
		unset ($existing_mimes['zip']); 
	 
		// return amended array
		return $existing_mimes;
	}


    public function cmp_admin_notice() {
		if ( isset($_GET['page']) && ($_GET['page'] == 'cmp-settings' || $_GET['page'] == 'cmp-translate' || $_GET['page'] == 'cmp-advanced') ) {
			if (isset($_GET['status']) && $_GET['status'] == 'settings-saved') {
				$status 	= 'success';
				$message 	= __('CMP Settings Saved', 'cmp-coming-soon-maintenance'); 

				echo '<div class="notice notice-'.$status.' is-dismissible"><p>'.$message.'.</p></div>';
			}
		}
		return;
    }

	// convert hex to rgba
	public function hex2rgba ( $hex, $opacity ) {
		list( $red, $green, $blue ) = sscanf( $hex, '#%02x%02x%02x' );

		$rgba = 'rgba(' . $red . ',' . $green . ',' . $blue . ',' . $opacity.')'; 

		return $rgba;
	}

	// convert hex to hsl css
	public function hex2hsl( $hex, $opacity ) {

		if ( $hex[0] != '#' ) {
			$rgba = explode( ',', $hex);
			$rgba[3] = str_replace(')', '', $rgba[3]);
			$rgba[3] = $rgba[3] - ( $opacity / 100 );
			$rgba = $rgba[0] . ',' . $rgba[1] . ',' . $rgba[2] . ',' . $rgba[3] . ')';
			return $rgba;
		}

		list( $red, $green, $blue ) = sscanf( $hex, '#%02x%02x%02x' );

		$r = $red / 255.0;
		$g = $green / 255.0;
		$b = $blue / 255.0;
		$H = 0;
		$S = 0;
		$V = 0;

		$min = min( $r, $g, $b );
		$max = max( $r, $g, $b );
		$delta = ( $max - $min );

		$L = ( $max + $min ) / 2.0;

		if( $delta == 0 ) {
			$H = 0;
			$S = 0;
		} else {
			$S = $L > 0.5 ? $delta / ( 2 - $max - $min ) : $delta / ( $max + $min );

			$dR = ( ( ( $max - $r ) / 6) + ( $delta / 2  ) ) / $delta;
			$dG = ( ( ( $max - $g ) / 6) + ( $delta / 2  ) ) / $delta;
			$dB = ( ( ( $max - $b ) / 6) + ( $delta / 2  ) ) / $delta;

			if ( $r == $max )
				$H = $dB - $dG;
			else if( $g == $max )
				$H = ( 1/3 ) + $dR - $dB;
			else
				$H = ( 2/3 ) + $dG - $dR;

			if ( $H < 0 )
				$H += 1;
			if ( $H > 1 )
				$H -= 1;
		}

		$HSL = array( 'hue' => round( ($H*360), 0 ), 'saturation'=> round( ($S*100), 0 ), 'luminosity' => round( ( $L*100 ), 0) );

		// if color is white {
		if ( $HSL['hue'] == 0 && $HSL['saturation'] == 0) {
			$requested_lumi = $HSL['luminosity'] + $opacity;
		} else {
			$requested_lumi = $HSL['luminosity'] - $opacity;
		}
	
		$requested_lumi = (int)round($requested_lumi);

		if ( $requested_lumi > 90 ) {
			
			$requested_lumi = 90;
		}

		$HSL = 'hsl( '. $HSL['hue'] .', '.( $HSL['saturation']) .'%, '. $requested_lumi . '%)';
		return $HSL;
	}

	// check if mobile 
	public function isMobile() {
		if ( isset($_SERVER["HTTP_USER_AGENT"]) ) {
			return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);

		} else {
			return false;
		}
	}

	// sanitize function
	public function sanitize_checkbox( $input ) {
		return ( ( isset( $input ) && true == $input ) ? '1' : '0' );
	}

	// sanitize function
	public function niteo_sanitize_html( $html ) {

		if ( !current_user_can( 'unfiltered_html' ) ) {
           	$allowed = wp_kses_allowed_html( 'post' );
           	$html = wp_kses( $html, $allowed );
        }

	    return $html;
	}

	// public function to sort social icons 
	public function sort_social($a, $b){
	    if ( $a['hidden'] == $b['hidden'] ) {
	        if( $a['order'] == $b['order'] ) {
	            return 0;
	        }
	        return $a['order'] < $b['order'] ? -1 : 1;
	    } else {
	         return $a['hidden'] > $b['hidden'] ? 1 : -1;
	    }
	 }

	 // public function to shift multidimensional array 
	public function customShift($array, $name){
		// var_dump($array);
	    foreach($array as $key => $val){     // loop all elements
	        if($val['name'] == $name){             // check for id $id
	            unset($array[$key]);         // unset the $array with id $id
	            array_unshift($array, $val); // unshift the array with $val to push in the beginning of array
	            return $array;               // return new $array
	        }
	    }
	}

	public function get_youtube_img( $youtube_url ) {
		$youtube = preg_match('/.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/', $youtube_url, $url);

		if ( isset( $url[7] ) &&  $url[7] != '') {
			$youtube_image = 'http://img.youtube.com/vi/' . $url[7] . '/hqdefault.jpg';
			return $youtube_image;
		}
	}

	public function cmp_get_pages() {
		$page_titles 	= array();
		$pages 			= array();
		$page_ids 		= get_all_page_ids();

		foreach ($page_ids as $page_id ) {
			array_push( $page_titles, get_the_title($page_id) );
		}

		foreach (array_combine( $page_ids, $page_titles ) as $id => $name) {
		    $pages[] = array('id' => $id, 'name' => $name);
		}

		return $pages;
	}

	// send json data for theme info overlay AJAX request
	public function niteo_themeinfo( ) {

		// check for ajax 
		if ( isset( $_POST['theme_slug'] ) ) {
			// verify nonce
			check_ajax_referer( 'cmp-coming-soon-ajax-secret', 'security' );
			// verify user rights
			if( !current_user_can('publish_pages') ) {
				die('Sorry, but this request is invalid');
			}


			// sanitize  $post
			$theme_slug = sanitize_text_field( $_POST['theme_slug'] );
			$data = array( 'result' => 'true', 'author_homepage' => $this->author_homepage, 'author' => $this->author );
			
			if ( !empty( $theme_slug ) ) {
				$headers  = array('Theme Name', 'Description');
				$theme_info = get_file_data(plugin_dir_path( __FILE__ ).'/themes/'. $theme_slug. '.txt', $headers, '');

				$screenshots = array_map( 'basename', glob( plugin_dir_path( __FILE__ ) . 'img/thumbnails/'.$theme_slug.'/*' ) );
				
				foreach ( $screenshots as $key => $screenshot ) {
					$screenshots[$key] = plugins_url('img/thumbnails/'.$theme_slug.'/'.$screenshot, __FILE__ );
				}

			 	$data['name'] = $theme_info[0];
			 	$data['description'] = $theme_info[1];
				$data['screenshots'] = $screenshots;		
			}

			echo json_encode ($data);
			wp_die();
	    }
	}

    // legacy function for premium themes redirect
    public function niteo_redirect() {
        return;
    }

    // returns array of google fonts from /inc/webfonts.php 
    public function cmp_get_google_fonts() {
    	$fonts = include_once wp_normalize_path( dirname( __FILE__ ) . '/inc/webfonts.php' );
		$google_fonts = json_decode( $fonts, true);

    	return $google_fonts;
    }

    public function cmp_google_variant_title( $variant ) {

		switch( $variant ) {
		    case '100':
		        return 'Thin 100';
		        break;
		    case '100italic':
		        return 'Thin 100 Italic';
		        break;
		    case '200':
		        return 'Extra-light 200';
		        break;
		    case '200italic':
		        return 'Extra-light 200 Italic';
		        break;
		    case '300':
		        return 'Light 300';
		        break;
		    case '300italic':
		        return 'Light 300 Italic';
		        break;
		    case '400':
		        return 'Regular 400';
		        break;
		    case '400italic':
		        return 'Regular 400 Italic';
		        break;
		    case '500':
		        return 'Medium 500';
		        break;
		    case '500italic':
		        return 'Meidum 500 Italic';
		        break;
		    case '600':
		        return 'Semi-Bold 600';
		        break;
		    case '600italic':
		        return 'Semi-Bold 600 Italic';
		        break;
		    case '700':
		        return 'Bold 700';
		        break;
		    case '700italic':
		        return 'Bold 700 Italic';
		        break;
		    case '800':
		        return 'Extra-Bold 800';
		        break;
		    case '800italic':
		        return 'Extra-Bold Italic';
		        break;
		    case '900':
		        return 'Black 900';
		        break;
		    case '900italic':
		        return 'Black 900 Italic';
		        break;
		    case 'regular':
		        return 'Regular 400';
		        break;
		    case 'italic':
		        return 'Regular 400 Italic';
		        break;
		    default:
		        break;
		}
	}

	// returns true if current page is in page array (blacklist or whitelist)
	// since 2.2
	public function cmp_page_filter() {
		$page_id = get_the_ID();

		// change manually page_id to -1 if homepage is displayed
		if ( is_home() || is_front_page() ) {
			$page_id = '-1';
		}

		switch ( get_option('niteoCS_page_filter', '0') ) {
			// disabled return true
			case '0':
				return true;
				break;

			// whitelist
			case '1':
				$page_list = json_decode( get_option('niteoCS_page_whitelist', '[]'), true );
				
				if ( empty( $page_list ) || in_array( $page_id, $page_list ) ){
					return true;

				} else {
					return false;
				}
				break;

			// blacklist
			case '2':
				$page_list = json_decode( get_option('niteoCS_page_blacklist', '[]'), true );

				
				if ( empty( $page_list ) || in_array( $page_id, $page_list ) ){
					return false;

				} else {
					return true;
				}

				break;

			default:
				return true;
				break;
		}

		return true;
	}

	// returns true if logged in user meet CMP roles filter
	// since 2.2
	public function cmp_roles_filter() {
		$roles = json_decode( get_option('niteoCS_roles', '[]'), true );
		// push WP administrator to roles array, since it is default
		array_push( $roles, 'administrator' );

		$current_user = wp_get_current_user();

		foreach  ( $current_user->roles as $role ) {
			if ( in_array( $role, $roles ) ) {
				return true;
			}
		};

		return false;
	}


	public function cmp_plugin_update(\WP_Upgrader $upgrader, array $hook_extra) {
	    if ( is_array($hook_extra) && array_key_exists('action', $hook_extra) && array_key_exists('type', $hook_extra) && array_key_exists('plugins', $hook_extra) ) {
	        if ($hook_extra['action'] == 'update' && $hook_extra['type'] == 'plugin' && is_array($hook_extra['plugins']) && !empty($hook_extra['plugins'])) {
	            $this_plugin = plugin_basename(__FILE__);
	            foreach ($hook_extra['plugins'] as $key => $plugin) {
	                if ($this_plugin == $plugin) {
	                    $this_plugin_updated = true;
	                    break;
	                }
	            }// endforeach;
	            unset($key, $plugin, $this_plugin);
	            if (isset($this_plugin_updated) && $this_plugin_updated === true) {

					// migrate google analytics options
					if ( get_option('niteoCS_analytics') && get_option('niteoCS_analytics') != '' ) {
						update_option('niteoCS_analytics_status', 'google');
					}

					// add social icons to social settings 
					if ( get_option('niteoCS_socialmedia') ) {
						$niteoCS_socialmedia = stripslashes( get_option('niteoCS_socialmedia') );
						$socialmedia = json_decode( $niteoCS_socialmedia, true );
						$update = false;

						// add soundcloud and phone social media in 2.2 update
						if ( !$this->niteo_in_array_r( 'soundcloud', $socialmedia, true ) ) {
							$soundcloud  = array(
								'name' 		=> 'soundcloud',
								'url' 		=> '',
								'active' 	=> '1',
								'hidden' 	=> '1',
								'order' 	=> '17',
							);
							array_push( $socialmedia, $soundcloud );
							$update = true;
						}

						// add whatsapp and phone social media in 2.3 update
						if ( !$this->niteo_in_array_r( 'whatsapp', $socialmedia, true ) ) {
							$whatsapp  = array(
								'name' 		=> 'whatsapp',
								'url' 		=> '',
								'active' 	=> '1',
								'hidden' 	=> '1',
								'order' 	=> '18',
							);
							array_push( $socialmedia, $whatsapp );

							$phone  = array(
								'name' 		=> 'phone',
								'url' 		=> '',
								'active' 	=> '1',
								'hidden' 	=> '1',
								'order' 	=> '19',
							);
							array_push( $socialmedia, $phone );
							$update = true;
						}

						// add telegram social media in 2.6.6 update
						if ( !$this->niteo_in_array_r( 'telegram', $socialmedia, true ) ) {
							$telegram  = array(
								'name' 		=> 'telegram',
								'url' 		=> '',
								'active' 	=> '1',
								'hidden' 	=> '1',
								'order' 	=> '20',
							);
							array_push( $socialmedia, $telegram );
							$update = true;
						}

						if ( $update == true ) {
							update_option('niteoCS_socialmedia', json_encode( $socialmedia) );
						}
					}

					// add new strings to translation
					if ( get_option('niteoCS_translation') ) {
					    $translation    = json_decode( get_option('niteoCS_translation'), true );
					    if ( !isset($translation[9]) ) {
					        array_push( $translation, array('id' => 9, 'string' => 'Scroll', 'translation' => 'Scroll') );
					    }

					    if ( !isset($translation[10]) ) {
					        array_push( $translation, array('id' => 10, 'string' => 'First Name', 'translation' => 'First Name') );
					    }

					    if ( !isset($translation[11]) ) {
					        array_push( $translation, array('id' => 11, 'string' => 'Last Name', 'translation' => 'Last Name') );
					    }

					    update_option('niteoCS_translation', wp_json_encode($translation));
					}


					// check for < 1.8 version where subscriber ID was not set
					if ( get_option('niteoCS_subscribers_list') ) {
						$subscribe_list = get_option('niteoCS_subscribers_list');

						if ( is_array($subscribe_list) && count($subscribe_list) > 0 && !array_key_exists ('id', $subscribe_list[0]) ) {
							$i = 1;
							foreach( $subscribe_list as &$sub ){
							    $sub['id'] = $i;
							    $sub = array('id' => $sub['id']) + $sub;
							    // check if ip address is set
							    if (!array_key_exists('ip_address', $sub)) {
							    	$sub['ip_address'] = 'nodata';
							    }
							    $i++;
							}
							update_option('niteoCS_subscribers_list', $subscribe_list);
						}
					}

					// delete transients for theme updates, to ensure the updates for latest cmp versions runs again
					foreach ( $this->premium_installed as $theme_slug ) {
						delete_transient( $theme_slug.'_updatecheck' );
					}
	            }// endif; $this_plugin_updated
	        }// endif update plugin and plugins not empty.
	    }// endif; $hook_extra
	}// updatePlugin


	public function add_action_links ( $links ) {
		 $settings = array(
		 	'<a href="' . admin_url( 'admin.php?page=cmp-settings' ) . '">CMP Settings</a>',
		 );
		return array_merge( $settings, $links );
	}


	// returns version of selected CMP theme
	public function cmp_theme_version( $theme_slug ) {
		// if premium theme style.css exists get its version

		if ( in_array( $theme_slug, $this->premium_installed ) ) {
			if ( file_exists($this->plugins_dir_path . 'cmp-premium-themes/'.$theme_slug.'/style.css') ) {
				$version = get_file_data( $this->plugins_dir_path . 'cmp-premium-themes/'.$theme_slug.'/style.css', array('Version'), '');
			}

		} else {
			$version = $this->version;
		}

		// if we have local version of theme and not in updating theme
		if ( is_array($version) ) {
			$version =  $version[0];
		}

		return $version;
	}

	/**
	 * Connect to Mailchimp via API and retrieve Mailchimp lists
	 *
	 * @since 2.6
	 * @access public
	 * @return Object
	 */
	public function cmp_mailchimp_list_ajax( $apikey ) {

		// check for ajax 
		if ( isset( $_POST['params'] ) ) {
			// verify nonce
			check_ajax_referer( 'cmp-coming-soon-ajax-secret', 'security' );
			// verify user rights
			if( !current_user_can('publish_pages') ) {
				die('Sorry, but this request is invalid');
			}

			// sanitize array
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			// check params
			if ( !empty( $_POST['params'] ) ) {
				$params = $_POST['params'];
			}

			$api_key = $params['apikey'];

			$dc = substr($api_key,strpos($api_key,'-')+1); // datacenter, it is the part of your api key - us5, us8 etc

			$args = array(
			 	'headers' => array(
					'Authorization' => 'Basic ' . base64_encode( 'user:'. $api_key )
				)
			);


			// retrieve response from mailchimp
			$response = wp_remote_get( 'https://'.$dc.'.api.mailchimp.com/3.0/lists/', $args );
			
			// if we have it, create new array with lists id and name, else push error messages into array
			if ( !is_wp_error( $response ) ) {
				$lists_array = array();

				$body = json_decode( $response['body'], true);

				if ( $response['response']['code'] == 200 ) { 
					$lists_array['response'] = 200;
					$i = 0;
					foreach ( $body['lists'] as $list ) {
						$lists_array['lists'][$i]['id'] = $list['id'];
						$lists_array['lists'][$i]['name'] = $list['name'];
						$i++;
					}

				} else {
					$lists_array['response'] = $response['response']['code'];
					$lists_array['message'] = $body['title'] . ': ' . $body['detail'];
				}

			} else {
				$lists_array['response'] = '500';
				$lists_array['message'] = $response->get_error_message();
			}

			// json encode response
			$lists_json = json_encode( $lists_array );

			// save it
			update_option('niteoCS_mailchimp_lists', $lists_json);

			// delete selected old mailchimp list because we do not want it
			delete_option('niteoCS_mailchimp_list_selected');

			// echo ajax result
			echo $lists_json;
			wp_die();

	    }

	}
}

$cmpPlugin = new niteo_cmp();

register_uninstall_hook( __FILE__, array('niteo_cmp', 'cmp_plugin_delete') );



