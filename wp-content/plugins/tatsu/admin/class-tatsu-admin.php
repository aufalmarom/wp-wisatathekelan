<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.brandexponents.com
 * @since      1.0.0
 *
 * @package    Tatsu
 * @subpackage Tatsu/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tatsu
 * @subpackage Tatsu/admin
 * @author     Brand Exponents Creatives Pvt Ltd <swami@brandexponents.com>
 */
class Tatsu_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tatsu_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tatsu_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tatsu-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tatsu_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tatsu_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tatsu-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function add_body_class( $classes ) {
		global $post_id;
		$edited_with = get_post_meta( $post_id, '_edited_with', true );
		if( empty( $edited_with ) ) {
			$edited_with = 'editor';
		}
		$classes .= ' edited_with_'.$edited_with;
		return $classes;
	}

	public function edit_with_tatsu_button() {
		global $post_id;
		$edited_with = get_post_meta( $post_id, '_edited_with', true );
		if( empty( $edited_with ) ) {
			$edited_with = 'editor';	
		}
		?>
		<input type="hidden" id="tatsu_edited_with" name="_edited_with" value="<?php echo $edited_with; ?>" /> 
		<div id="tatsu_buttons">
			<a href="<?php echo tatsu_edit_url( $post_id ); ?>" id="edit_with_tatsu_button" class="tatsu_edit_button">
				<svg class="tatsu-dragon" role="img">
					<use xlink:href="<?php echo esc_url( TATSU_PLUGIN_URL.'/builder/svg/tatsu.svg#icon-dragon' ); ?>"></use>
				</svg>
				Edit With Tatsu
			</a>
			<a href="#" id="edit_with_wordpress_editor" class="tatsu_edit_button">
				Switch To Wordpress Editor
			</a>
		</div>
		<div id="tatsu_edit_post_wrap">
			<a href="<?php echo tatsu_edit_url( $post_id ); ?>">
				<span id="tatsu_edit_dragon_wrap">
					<svg class="tatsu-dragon" role="img">
						<use xlink:href="<?php echo esc_url( TATSU_PLUGIN_URL.'/builder/svg/tatsu.svg#icon-dragon' ); ?>"></use>
					</svg>
					<span>Edit With Tatsu</span>
				</span>
			</a>			
		</div>	
	<?php	
	}

}
