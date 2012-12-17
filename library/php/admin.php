<?php
/**
* Theme Administration
*
* These functions setup and control the theme interface
* @author Jess Planck
* @version 1.0
*/

// Setup admin area for Nicholls Theme - for the old stuff
function nicholls_common_admin_setup() {

	// Add Menu
	add_menu_page( 'Nicholls Theme Options', 'Nicholls Theme Options' , 'delete_others_posts' , 'nicholl_common', 'nicholls_common_admin', FNBX_CORE_URL . '/library/images/admin-icon.png');
	
	// Register Settings
	add_action( 'admin_init', 'nicholls_common_admin_settings_register' );
	
	if ( $_GET['page'] == 'nicholls_common' ) {

		// Use action to enqueue javascript
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'nicholls-admin-js' , FNBX_CORE_URL . '/library/js/nicholls-admin.js', array( 'jquery' ), '1.0' );		

	}	
	
}
add_action( 'admin_menu' , 'nicholls_common_admin_setup' );

function nicholls_common_admin_settings_register() {
	// Register Nicholls Settings
	register_setting( 'nicholls_core_theme_options', 'nicholls_core_theme_options', 'nicholls_core_theme_options_validate' );
	
	add_settings_section('nicholls_core_theme_admin_main', 'Department Contact Information', 'nicholls_core_theme_admin_section_text', 'nicholls_core_theme_admin');
		
	$nicholls_core_fields = nicholls_core_admin_get_setting_config();
	
	foreach( $nicholls_core_fields as $nicholls_core_field ) {

		$field_callback = 'nicholls_core_theme_admin_setting_string';
		
		if ( $nicholls_core_field['name'] == 'note' ) $field_callback = 'nicholls_core_theme_admin_setting_text';
		
		add_settings_field('nicholls_core_theme_admin_' . $nicholls_core_field['name'], $nicholls_core_field['description'], $field_callback, 'nicholls_core_theme_admin', 'nicholls_core_theme_admin_main', $nicholls_core_field['name'] );
	
	}

	if ( is_super_admin() )
		add_settings_field('nicholls_core_theme_admin_reset', 'Reset Front Page', 'nicholls_core_theme_admin_section_emergency_reset', 'nicholls_core_theme_admin', 'nicholls_core_theme_admin_main', $nicholls_core_field['name'] );
}


function nicholls_core_theme_admin_section_emergency_reset() {
	$reset_nonce= wp_create_nonce('emergency_reset');

	fnbx_html_tag( array(
		'tag' => 'p',
		'tag_content' => '<a href="' . site_url() . '/?emergency_reset=yes&_wpnonce=' . $reset_nonce . '">Reset Cache for Emergency Notices</a>'
	) );
	
}

function nicholls_core_theme_admin_section_text() {
	fnbx_html_tag( array(
		'tag' => 'p',
		'tag_content' => 'Contact information will be shown only if you have the Nicholls information widget in your sidebar.'
	) );
}

function nicholls_core_theme_admin_setting_string( $field_name ) {
	$options = get_option('nicholls_core_theme_options');

	fnbx_html_tag( array(
		'tag' => 'input',
		'tag_type' => 'single',
		'name' => 'nicholls_core_theme_options['. $field_name . ']',
		'value' => $options[ $field_name ]
	) );
}

function nicholls_core_theme_admin_setting_text( $field_name ) {
	$options = get_option('nicholls_core_theme_options');

	fnbx_html_tag( array(
		'tag' => 'textarea',
		'name' => 'nicholls_core_theme_options['. $field_name . ']',
		'tag_content' => $options[ $field_name ]
	) );
}

function nicholls_core_theme_options_validate( $input ) {
	$newinput = $input;

	return $newinput;
}

/**
* Write out a message to the admin screen
*
* $args are mixed arrays. First $args array should contain the following keys:
* - type: HTML input tag type.
* - name: String to be used for oject HTML class and id names
* - value: Default value for form element.
* - return: Boolean to return string or echo HTML
* - tag_content: for this case a button can have enclosed elements (defaults to value)
*
* @param array $args
* @since 0.4
* @return string|void
*/ 
function nicholls_common_admin_message( $message = '', $return = false ) {

	$args_default = array(
		'tag' => 'div',
		'id' => 'nicholls-admin-message',
		'class' => 'updated settings-error',
		'tag_content' => '<p>' . $message . '</p>',
		'return' => $return
	);
	
	if ( $args_default['return'] == true ) return fnbx_html_tag( $args_default );
	
	fnbx_html_tag( $args_default );	
}



function nicholls_common_admin() {
	fnbx_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'open',
		'class' => 'wrap'
	) );
	
	if ( $_REQUEST['saved'] ) nicholls_common_admin_message( 'Settings saved.' );
	if ( $_REQUEST['reset'] ) nicholls_common_admin_message( 'Settings reset.' );
	
	fnbx_html_tag( array(
		'tag' => 'h2',
		'tag_content' => 'Nicholls Theme Options'
	) );
	
	fnbx_html_tag( array(
		'tag' => 'p',
		'tag_content' => 'Options for your Nicholls Department website.'
	) );

	fnbx_html_tag( array(
		'tag' => 'form',
		'tag_type' => 'open',
		'action' => 'options.php',
		'method' => 'post'
	) );	
	
	// WordPress settings API
	settings_fields('nicholls_core_theme_options');
	do_settings_sections('nicholls_core_theme_admin');

	fnbx_html_tag( array(
		'tag' => 'p',
		'tag_type' => 'open',
		'class' => 'submit'
	) );
	
	fnbx_html_tag( array(
		'tag' => 'input',
		'tag_type' => 'single',
		'name' => 'Submit',
		'type' => 'submit',
		'class' => 'button-primary',
		'value' => esc_attr('Save Changes')
	) );
	
	fnbx_html_tag( array(
		'tag' => 'p',
		'tag_type' => 'close',
	) );	

	fnbx_html_tag( array(
		'tag' => 'form',
		'tag_type' => 'close'
	) );
	
	fnbx_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'close',
	) );
}
