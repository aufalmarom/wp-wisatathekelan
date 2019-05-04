<?php 
if ( ! function_exists('pt_theme_addon_team') ) {

	// Register Custom Post Type
	function pt_theme_addon_team() {

		$labels = array(
			'name'                  => _x( 'Team', 'Post Type General Name', 'pt-theme-addon' ),
			'singular_name'         => _x( 'Team', 'Post Type Singular Name', 'pt-theme-addon' ),
			'menu_name'             => __( 'Team', 'pt-theme-addon' ),
			'name_admin_bar'        => __( 'Team', 'pt-theme-addon' ),
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
			'label'                 => __( 'Team', 'pt-theme-addon' ),
			'description'           => __( 'Post type to create team', 'pt-theme-addon' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'thumbnail', ),
			'hierarchical'          => false,
			'public'                => false,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 30,
			'menu_icon'             => 'dashicons-businessman',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,		
			'exclude_from_search'   => true,
			'publicly_queryable'    => false,
			'capability_type'       => 'page',
		);
		register_post_type( 'ptta-team', $args );

	}

}

add_action( 'init', 'pt_theme_addon_team', 0 );

if ( ! function_exists( 'pt_theme_addon_team_category' ) ) {

	// Add Category to Custom Post Type
	function pt_theme_addon_team_category() {
	   
	    $args = array( 
	        'label'                 => __( 'Categories', 'pt-theme-addon' ),
	        'public'                => false,
	        'show_in_nav_menus'     => true,
	        'show_ui'               => true,        
	        'show_admin_column'     => true,
	        'show_in_admin_bar'     => true,  
	        'hierarchical'          => true,
	        'rewrite'               => array('slug' => 'ptta-team-categories'),
	        'query_var'             => true
	    );

	    register_taxonomy( 'ptta-team-categories', 'ptta-team', $args );

	}

}

add_action( 'init', 'pt_theme_addon_team_category', 0 );


/**********************************************************
* Add Extra Custom Fields to the Post Type Add / Edit screen
* Plus Update Method
**********************************************************/

add_action( 'admin_init', 'pt_theme_addon_team_meta_init' );
add_action( 'save_post', 'pt_theme_addon_team_meta_save' );

function pt_theme_addon_team_meta_init() {

    add_meta_box("ptta-team-information", __( 'Additional Information', 'pt-theme-addon' ), "pt_theme_addon_meta_options", "ptta-team", "normal", "high");      
}

function pt_theme_addon_meta_options( $post ) {

    $values 	= get_post_custom( $post->ID );

    $position  	= isset( $values['position'] ) ? esc_html( $values['position'][0] ) : '';

    $email      = isset( $values['email'] ) ? esc_html( $values['email'][0] ) : '';

    $social_profiles  = array();
    
    for( $j=0; $j<5; $j++ ){
        $social_profiles[]   = isset( $values['social-'.$j] ) ? esc_url( $values['social-'.$j][0] ) : '';
    }

    wp_nonce_field( 'pt_theme_addon_meta_box_nonce', 'meta_box_nonce' );

    ?>

    <table id="pt-team-options" width="100%" border="0" class="options" cellspacing="5" cellpadding="5">
        <tr>
            <td width="1%">
                <label for="position"><?php _e('Position', 'pt-theme-addon'); ?></label>
            </td>
            <td width="10%">
                <input type="text" id="position" class="widefat" name="position" value="<?php echo esc_html( $position ); ?>" placeholder="<?php esc_attr_e('Enter position like Manager, Developer, Accountant', 'pt-theme-addon'); ?>"/>
            </td>          
        </tr>  
        <tr>
            <td width="1%">
                <label for="email"><?php _e('Email', 'pt-theme-addon'); ?></label>
            </td>
            <td width="10%">
                <input type="text" id="email" class="widefat" name="email" value="<?php echo esc_html( $email ); ?>" placeholder="<?php esc_attr_e('Enter email address', 'pt-theme-addon'); ?>"/>
            </td>          
        </tr>  
        <tr>
            <td width="1%">
                <label for="social"><strong><?php _e('Social Profile', 'pt-theme-addon'); ?></strong></label>
            </td>
            <td width="10%">
                <label for="social-info"><strong><?php _e('Enter Full URL (Ex: https://facebook.com/yourprofile)', 'pt-theme-addon'); ?></strong></label>
            </td>
        </tr>
        <?php for( $i=0; $i<5; $i++ ){ ?>
        <tr>
            <td width="1%"></td>
            <td width="10%">
                <input type="text" id="social-prfoile-<?php echo $i; ?>" class="widefat" name="social-<?php echo $i; ?>" value="<?php echo esc_url( $social_profiles[$i] ); ?>"/>
            </td>          
        </tr>
        <?php } ?>
       
    </table>   
    <?php   
}


function pt_theme_addon_team_meta_save( $post_id )
{
    global $post;  

    $custom_meta_fields = array( 'position', 'email', 'social-0', 'social-1', 'social-2', 'social-3', 'social-4' );

    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'pt_theme_addon_meta_box_nonce' ) ) return;
    
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;
    
    // now we can actually save the data
    $allowed = array( 
                'em' 		=> array(),
                'strong' 	=> array(),
                'span' 		=> array(),
            );    
 
    foreach( $custom_meta_fields as $custom_meta_field ){

        if( isset( $_POST[$custom_meta_field] ) )           

            update_post_meta($post->ID, $custom_meta_field, wp_kses( $_POST[$custom_meta_field], $allowed) );      
    }
        
   
}