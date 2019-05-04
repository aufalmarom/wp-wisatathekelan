<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// check onces and wordpress rights, else DIE
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	if( !wp_verify_nonce($_POST['save_options_field'], 'save_options') || !current_user_can('publish_pages') ) {
		die('Sorry, but this request is invalid');
	}

    $translation = array(
        0 => array('id' => 0, 'string' => 'Seconds', 'translation' => sanitize_text_field( $_POST['niteoCS_translate_0'] ) ),
        1 => array('id' => 1, 'string' => 'Minutes', 'translation' => sanitize_text_field( $_POST['niteoCS_translate_1'] )),
        2 => array('id' => 2, 'string' => 'Hours', 'translation' => sanitize_text_field( $_POST['niteoCS_translate_2'] )),
        3 => array('id' => 3, 'string' => 'Days', 'translation' => sanitize_text_field( $_POST['niteoCS_translate_3'] )),
        4 => array('id' => 4, 'string' => 'Insert your email address.', 'translation' => sanitize_text_field( $_POST['niteoCS_translate_4'] )),
        5 => array('id' => 5, 'string' => 'This Email address has already been on our subscriber list.', 'translation' => sanitize_text_field( $_POST['niteoCS_translate_5'] )),
        6 => array('id' => 6, 'string' => 'Please insert valid Email address.', 'translation' => sanitize_text_field( $_POST['niteoCS_translate_6'] )),
        7 => array('id' => 7, 'string' => 'Thank you, your sign-up request was successful!', 'translation' => sanitize_text_field( $_POST['niteoCS_translate_7'] )),
        8 => array('id' => 8, 'string' => 'Submit', 'translation' => sanitize_text_field( $_POST['niteoCS_translate_8'] )),
        9 => array('id' => 9, 'string' => 'Scroll', 'translation' => sanitize_text_field( $_POST['niteoCS_translate_9'] )),
        10 => array('id' => 10, 'string' => 'First Name', 'translation' => sanitize_text_field( $_POST['niteoCS_translate_10'] )),
        11 => array('id' => 11, 'string' => 'Last Name', 'translation' => sanitize_text_field( $_POST['niteoCS_translate_11'] )),
    );

    update_option('niteoCS_translation', wp_json_encode($translation));
}

// Populate translation list, if not yet created
if ( !get_option('niteoCS_translation') ) {
    $translation = array(
        0 => array('id' => 0, 'string' => 'Seconds', 'translation' => 'Seconds' ),
        1 => array('id' => 1, 'string' => 'Minutes', 'translation' => 'Minutes' ),
        2 => array('id' => 2, 'string' => 'Hours', 'translation' => 'Hours' ),
        3 => array('id' => 3, 'string' => 'Days', 'translation' => 'Days' ),
        4 => array('id' => 4, 'string' => 'Insert your email address.', 'translation' => 'Insert your email address.' ),
        5 => array('id' => 5, 'string' => 'This Email address has already been on our subscriber list.', 'translation' => 'This Email address has already been on our subscriber list.'),
        6 => array('id' => 6, 'string' => 'Please insert valid Email address.', 'translation' => 'Please insert valid Email address.'),
        7 => array('id' => 7, 'string' => 'Thank you, your sign-up request was successful!', 'translation' => 'Thank you, your sign-up request was successful!'),
        8 => array('id' => 8, 'string' => 'Submit', 'translation' => 'Submit'),
        9 => array('id' => 9, 'string' => 'Scroll', 'translation' => 'Scroll'),
        10 => array('id' => 10, 'string' => 'First Name', 'translation' => 'First Name'),
        11 => array('id' => 11, 'string' => 'Last Name', 'translation' => 'Last Name'),
    );

    update_option('niteoCS_translation', wp_json_encode($translation));
}



// WP_List_Table is not loaded automatically so we need to load it in our application
if( ! class_exists( 'WP_List_Table' ) ) {
    require( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
// load WP_List_Table extension
if( ! class_exists( 'cmp_translate_table' ) ) {
    require( dirname(__FILE__).'/inc/class-cmp-translate.php' );
}

// create subscriber table
$cmp_translate_table = new cmp_translate_table();
$cmp_translate_table->prepare_items();
?>
	
<div class="wrap cmp-coming-soon-maintenance">
	<h1></h1>
	<div id="icon-users" class="icon32"></div>
	<div class="cmp-inputs-wrapper translate-settings">
		 <h2><?php _e('Edit Translation Variables', 'cmp-coming-soon-maintenance');?></h2>
		 <form name="cmp_translate_form" method="post" action="admin.php?page=cmp-translate&status=settings-saved">
			<?php $cmp_translate_table->display(); ?>
		<p class="cmp-submit">
			<?php wp_nonce_field('save_options','save_options_field'); ?>
			<input type="submit" name="Submit" class="button cmp-button submit" value="<?php _e('Save All Changes', 'cmp-coming-soon-maintenance'); ?>" id="submitChanges" />
		</p>
		</form>

	</div>
	<?php 
	// get sidebar with "widgets"
	if ( file_exists(dirname(__FILE__) . '/cmp-sidebar.php') ) {
		require (dirname(__FILE__) . '/cmp-sidebar.php');
	}

	?>
</div>
