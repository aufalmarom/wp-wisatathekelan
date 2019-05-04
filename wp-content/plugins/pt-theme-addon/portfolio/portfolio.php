<?php 
if ( ! function_exists('pt_theme_addon_portfolio') ) {

	// Register Custom Post Type
	function pt_theme_addon_portfolio() {

		$labels = array(
			'name'                  => _x( 'Portfolio', 'Post Type General Name', 'pt-theme-addon' ),
			'singular_name'         => _x( 'Portfolio', 'Post Type Singular Name', 'pt-theme-addon' ),
			'menu_name'             => __( 'Portfolio', 'pt-theme-addon' ),
			'name_admin_bar'        => __( 'Portfolio', 'pt-theme-addon' ),
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
			'label'                 => __( 'Portfolio', 'pt-theme-addon' ),
			'description'           => __( 'Post type to create portfolio', 'pt-theme-addon' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 30,
			'menu_icon'             => 'dashicons-external',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,		
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'ptta-portfolio', $args );

	}

}

add_action( 'init', 'pt_theme_addon_portfolio', 0 );

if ( ! function_exists( 'pt_theme_addon_portfolio_category' ) ) {

	// Add Category to Custom Post Type
	function pt_theme_addon_portfolio_category() {
	   
	    $args = array( 
	        'label'                 => __( 'Categories', 'pt-theme-addon' ),
	        'public'                => true,
	        'show_in_nav_menus'     => true,
	        'show_ui'               => true,        
	        'show_admin_column'     => true,
	        'show_in_admin_bar'     => true,  
	        'hierarchical'          => true,
	        'rewrite'               => array('slug' => 'ptta-portfolio-categories'),
	        'query_var'             => true
	    );

	    register_taxonomy( 'ptta-portfolio-categories', 'ptta-portfolio', $args );

	}

}

add_action( 'init', 'pt_theme_addon_portfolio_category', 0 );


/**********************************************************
* Add Extra Custom Fields to the Post Type Add / Edit screen
* Plus Update Method
**********************************************************/

add_action( 'admin_init', 'pt_theme_addon_portfolio_meta_init' );
add_action( 'save_post', 'pt_theme_addon_portfolio_meta_save' );

function pt_theme_addon_portfolio_meta_init() {

    add_meta_box("ptta-portfolio-information", __( 'Portfolio Details', 'pt-theme-addon' ), "pt_theme_addon_portfolio_meta_options", "ptta-portfolio", "normal", "high");      
}

function pt_theme_addon_portfolio_meta_options( $post ) {

    $values 		= get_post_custom( $post->ID );

    $portfolio_type = isset( $values['portfolio_type'] ) ? esc_html( $values['portfolio_type'][0] ) : '';

    $project_link  	= isset( $values['project_link'] ) ? esc_html( $values['project_link'][0] ) : '';


    wp_nonce_field( 'pt_theme_addon_portfolio_meta_box_nonce', 'meta_box_nonce' );

    ?>

    <table id="pt-portfolio-options" width="100%" border="0" class="options" cellspacing="5" cellpadding="5">
        <tr>
            <td width="1%">
                <label for="portfolio_type"><?php _e('Portfolio Type', 'pt-theme-addon'); ?></label>
            </td>
            <td width="10%">
                <select id="portfolio_type" class="widefat" name="portfolio_type">
                	<option value="new_window" <?php selected( $portfolio_type, 'new_window' ); ?>><?php _e('On a separate portfolio page', 'pt-theme-addon'); ?></option>
                	<option value="external" <?php selected( $portfolio_type, 'external' ); ?>><?php _e('On an external website', 'pt-theme-addon'); ?></option>
                </select>
                
            </td>          
        </tr>  
        <tr>
            <td width="1%">
                <label for="project_link"><?php _e('Project Link', 'pt-theme-addon'); ?></label>
            </td>
            <td width="10%">
                <input type="text" id="project_link" class="widefat" name="project_link" value="<?php echo esc_url( $project_link ); ?>" placeholder="<?php esc_attr_e('Enter link of project', 'pt-theme-addon'); ?>"/>
            </td>          
        </tr>          
    </table>   
    <?php  
}


function pt_theme_addon_portfolio_meta_save( $post_id )
{
    global $post;  

    $custom_meta_fields = array( 'portfolio_type', 'project_link' );

    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'pt_theme_addon_portfolio_meta_box_nonce' ) ) return;
    
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