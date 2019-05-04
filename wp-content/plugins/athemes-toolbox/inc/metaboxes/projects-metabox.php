<?php

/**
 * Metabox for the Projects custom post type
 *
 * @package    	Athemes_Toolbox
 * @link        http://athemes.com
 * Author:      aThemes
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */


function athemes_toolbox_projects_metabox() {
    new Athemes_Toolbox_Projects();
}

if ( is_admin() ) {
    add_action( 'load-post.php', 'athemes_toolbox_projects_metabox' );
    add_action( 'load-post-new.php', 'athemes_toolbox_projects_metabox' );
}

class Athemes_Toolbox_Projects {

	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
	}

	public function add_meta_box( $post_type ) {
        global $post;
		add_meta_box(
			'st_projects_metabox'
			,__( 'Project info', 'athemes_toolbox' )
			,array( $this, 'render_meta_box_content' )
			,'projects'
			,'advanced'
			,'high'
		);
	}

	public function save( $post_id ) {
	
		if ( ! isset( $_POST['athemes_toolbox_projects_nonce'] ) )
			return $post_id;

		$nonce = $_POST['athemes_toolbox_projects_nonce'];

		if ( ! wp_verify_nonce( $nonce, 'athemes_toolbox_projects' ) )
			return $post_id;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $post_id;

		if ( 'projects' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;
	
		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
		}

		$link 	= isset( $_POST['athemes_toolbox_projects_info'] ) ? esc_url_raw($_POST['athemes_toolbox_projects_info']) : false;
		update_post_meta( $post_id, 'wpcf-project-link', $link );

	}

	public function render_meta_box_content( $post ) {
		wp_nonce_field( 'athemes_toolbox_projects', 'athemes_toolbox_projects_nonce' );

		$link = get_post_meta( $post->ID, 'wpcf-project-link', true );

	?>
		<p><strong><label for="athemes_toolbox_projects_info"><?php _e( 'Project link', 'athemes_toolbox' ); ?></label></strong></p>
		<p><em><?php _e('Add an URL here to make this project link to another page (internal or external). Leave it empty and it will default to its own page.', 'sdyney_toolbox'); ?></em></p>
		<p><input type="text" class="widefat" id="athemes_toolbox_projects_info" name="athemes_toolbox_projects_info" value="<?php echo esc_url($link); ?>"></p>	

	<?php
	}
}
