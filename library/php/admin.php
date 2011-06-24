<?php
/**
* Nicholls Theme Administration
*
* These functions setup and control the theme interface
* @package nicholls_webmanager
* @author Jess Planck
* @version 1.0
*/

// Migration from old theme!
global $pagenow;

if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
     // When theme is activated this code runs.
     // Still be defensive if you need to be, and check if
     // your baby is already born

     // No turning back!
     nicholls_core_theme_upgrade();
  
}

function nicholls_core_theme_upgrade() {
	$nicholls_old_settings = array(
		'nicholls_headerImage',
		'nicholls_headerImageURL',
		'nicholls_location',
		'nicholls_mailing',
		'nicholls_cityzip',
		'nicholls_phone',
		'nicholls_fax',
		'nicholls_emailname',
		'nicholls_email',
		'nicholls_note',
		'nicholls_sidebar_categories',
		'nicholls_sidebar_archives',
		'nicholls_post_display',
		'nicholls_news_heading'
	);
	
	$nicholls_new_settings = array();
	
	foreach ( $nicholls_old_settings as $nicholls_old_setting ) {

			switch ( $nicholls_old_setting ) {
				case 'nicholls_location':
					$old_option = get_option( $nicholls_old_setting );
					$nicholls_new_settings['address_location'] = $old_option;
				case 'nicholls_mailing':
					$old_option = get_option( $nicholls_old_setting );
					$nicholls_new_settings['address_mailing'] = $old_option;
				case 'nicholls_cityzip':
					$old_option = get_option( $nicholls_old_setting );
					$nicholls_new_settings['address_cityzip'] = $old_option;
				case 'nicholls_phone':
					$old_option = get_option( $nicholls_old_setting );
					$nicholls_new_settings['phone'] = $old_option;	
				case 'nicholls_fax':
					$old_option = get_option( $nicholls_old_setting );
					$nicholls_new_settings['fax'] = $old_option;
				case 'nicholls_emailname':
					$old_option = get_option( $nicholls_old_setting );
					$nicholls_new_settings['email_name'] = $old_option;
				case 'nicholls_email':
					$old_option = get_option( $nicholls_old_setting );
					$nicholls_new_settings['email_address'] = $old_option;
				case 'nicholls_note':
					$old_option = get_option( $nicholls_old_setting );
					$nicholls_new_settings['note'] = $old_option;					
			}
			delete_option( $nicholls_old_setting );
	}
	update_option( 'nicholls_core_theme_options', $nicholls_new_settings );

}

// Setup admin area for Nicholls Theme - for the old stuff
function nicholls_common_admin_setup() {

	// Add Menu
	add_menu_page( 'Nicholls Theme Options', 'Nicholls Theme Options' , 'delete_others_posts' , 'nicholl_common', 'nicholls_common_admin', NICHOLLS_CORE_URL . '/library/images/admin-icon.png');
	
	// Register Settings
	add_action( 'admin_init', 'nicholls_common_admin_settings_register' );
	
	if ( $_GET['page'] == 'nicholls_common' ) {

		// Use action to enqueue javascript
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'nicholls-admin-js' , NICHOLLS_CORE_URL . '/library/js/nicholls-admin.js', array( 'jquery' ), '1.0' );		

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

?>

