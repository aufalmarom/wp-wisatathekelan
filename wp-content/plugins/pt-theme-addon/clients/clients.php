<?php 
if ( ! function_exists('pt_theme_addon_clients') ) {

	// Register Custom Post Type
	function pt_theme_addon_clients() {

		$labels = array(
			'name'                  => _x( 'Clients', 'Post Type General Name', 'pt-theme-addon' ),
			'singular_name'         => _x( 'Client', 'Post Type Singular Name', 'pt-theme-addon' ),
			'menu_name'             => __( 'Clients', 'pt-theme-addon' ),
			'name_admin_bar'        => __( 'Clients', 'pt-theme-addon' ),
			'archives'              => __( 'Item Archives', 'pt-theme-addon' ),
			'attributes'            => __( 'Item Attributes', 'pt-theme-addon' ),
			'parent_item_colon'     => __( 'Parent Item:', 'pt-theme-addon' ),
			'all_items'             => __( 'All Items', 'pt-theme-addon' ),
			'add_new_item'          => __( 'Add New Item', 'pt-theme-addon' ),
			'add_new'               => __( 'Add New', 'pt-theme-addon' ),
			'new_item'              => __( 'New Item', 'pt-theme-addon' ),
			'edit_item'             => __( 'Edit Item', 'pt-theme-addon' ),
			'update_item'           => __( 'Update Item', 'pt-theme-addon' ),
			'view_item'             => __( 'View Item', 'pt-theme-addon' ),
			'view_items'            => __( 'View Items', 'pt-theme-addon' ),
			'search_items'          => __( 'Search Item', 'pt-theme-addon' ),
			'not_found'             => __( 'Not found', 'pt-theme-addon' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'pt-theme-addon' ),
			'featured_image'        => __( 'Featured Image', 'pt-theme-addon' ),
			'set_featured_image'    => __( 'Set featured image', 'pt-theme-addon' ),
			'remove_featured_image' => __( 'Remove featured image', 'pt-theme-addon' ),
			'use_featured_image'    => __( 'Use as featured image', 'pt-theme-addon' ),
			'insert_into_item'      => __( 'Insert into item', 'pt-theme-addon' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'pt-theme-addon' ),
			'items_list'            => __( 'Items list', 'pt-theme-addon' ),
			'items_list_navigation' => __( 'Items list navigation', 'pt-theme-addon' ),
			'filter_items_list'     => __( 'Filter items list', 'pt-theme-addon' ),
		);
		$args = array(
			'label'                 => __( 'Clients', 'pt-theme-addon' ),
			'description'           => __( 'Post type to create clients', 'pt-theme-addon' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'thumbnail', ),
			'hierarchical'          => false,
			'public'                => false,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 30,
			'menu_icon'             => 'dashicons-groups',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,		
			'exclude_from_search'   => true,
			'publicly_queryable'    => false,
			'capability_type'       => 'page',
		);
		register_post_type( 'ptta-clients', $args );

	}

}

add_action( 'init', 'pt_theme_addon_clients', 0 );


/**********************************************************
* Add Extra Custom Fields to the Post Type Add / Edit screen
* Plus Update Method
**********************************************************/

add_action( 'admin_init', 'pt_theme_addon_clients_meta_init' );
add_action( 'save_post', 'pt_theme_addon_clients_meta_save' );

function pt_theme_addon_clients_meta_init() {

    add_meta_box("ptta-clients-information", __( 'Additional Information', 'pt-theme-addon' ), "pt_theme_addon_clients_meta_options", "ptta-clients", "normal", "high"); 

}

function pt_theme_addon_clients_meta_options( $post ) {

    $values 	= get_post_custom( $post->ID );

    $link  	    = isset( $values['link'] ) ? esc_html( $values['link'][0] ) : '';

    wp_nonce_field( 'pt_theme_addon_clients_meta_box_nonce', 'meta_box_nonce' );

    ?>

    <table id="ptta-clients-options" width="100%" border="0" class="options" cellspacing="5" cellpadding="5">
          
        <tr>
            <td width="1%">
                <label for="link"><?php _e('Link', 'pt-theme-addon'); ?></label>
            </td>
            <td width="10%">
                <input type="text" id="link" class="widefat" name="link" value="<?php echo esc_url( $link ); ?>" placeholder="<?php esc_attr_e('Enter link or leave empty if not required', 'pt-theme-addon'); ?>"/>
            </td>          
        </tr>  
       
    </table>   
    <?php   
}


function pt_theme_addon_clients_meta_save( $post_id )
{
    global $post;  

    $custom_meta_fields = array( 'link' );

    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'pt_theme_addon_clients_meta_box_nonce' ) ) return;
    
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;
    
    // now we can actually save the data
    $allowed = '';    
 
    foreach( $custom_meta_fields as $custom_meta_field ){

        if( isset( $_POST[$custom_meta_field] ) )           

            update_post_meta($post->ID, $custom_meta_field, esc_url_raw( $_POST[$custom_meta_field], $allowed) );      
    }
        
   
}