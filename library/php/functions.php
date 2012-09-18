<?php
/**
* Core Theme Funtions
*
* Action hooks used by the Funbox Theme
*
* @package Theme Core
* @subpackage Hooks
*/

/**
* Get the root URL for this site.
*
* @since 0.4
*/
function fnbx_get_url_home() {
	global $current_site;
	
	return get_home_url();
}

/**
* Nicholls Core Admin Settings 
*
* Function used for an array to describe the options held in nicholls_core_theme_options
*
* @since 0.4
*/
function nicholls_core_admin_get_setting_config() {

	$setting[0] = array(
		'name' => 'address_location',
		'description' => 'Office Location and Building'
	);
	$setting[1] = array(
		'name' => 'address_mailing',
		'description' => 'Office Mailing Address'
	);
	$setting[2] = array(
		'name' => 'address_cityzip',
		'description' => 'Office Mailing City, State, and Zip Code'
	);
	$setting[3] = array(
		'name' => 'phone',
		'description' => 'Office Phone Number'
	);
	$setting[4] = array(
		'name' => 'fax',
		'description' => 'Office Fax Number'
	);
	$setting[5] = array(
		'name' => 'email_name',
		'description' => 'Office Contact Email Display Name'
	);
	$setting[6] = array(
		'name' => 'email_address',
		'description' => 'Office Contact Email Address'
	);
	$setting[7] = array(
		'name' => 'note',
		'description' => 'Office Hours or Short Note'
	);
	$setting[8] = array(
		'name' => 'title_prefix',
		'description' => 'Website Title Prefix (leave blank for NONE)'
	);	
	
	return $setting;
}

/**
* Get the root URL for this Nicholls site.
*
* @since 0.4
*/
function get_nicholls_core_url() {
	global $current_site;
	
	return 'http://' . $current_site->domain . $current_site->path;
}

/**
* Echo the form for the Nicholls Google Mini Search engine
*
* @since 0.4
*/
function nicholls_form_google_search() {
	echo nicholls_get_form_google_search();
}

/**
* Return the form for the Nicholls Google Mini Search engine
*
* @since 0.4
*/
function nicholls_get_form_google_search() {
	
	$form_google_search_content .= fnbx_form_input( array( 'type' => 'text', 'name' => 'q', 'size' => 13, 'maxlength' => 256, 'return' => true ) );
	$form_google_search_content .= fnbx_form_input( array( 'type' => 'hidden', 'name' => 'sort', 'value' => 'date:D:L:d1', 'return' => true ) );
	$form_google_search_content .= fnbx_form_input( array( 'type' => 'hidden', 'name' => 'output', 'value' => 'xml_no_dtd', 'return' => true ) );
	$form_google_search_content .= fnbx_form_input( array( 'type' => 'hidden', 'name' => 'oe', 'value' => 'UTF-8', 'return' => true ) );
	$form_google_search_content .= fnbx_form_input( array( 'type' => 'hidden', 'name' => 'ie', 'value' => 'UTF-8', 'return' => true ) );
	$form_google_search_content .= fnbx_form_input( array( 'type' => 'hidden', 'name' => 'client', 'value' => 'default_frontend', 'return' => true ) );
	$form_google_search_content .= fnbx_form_input( array( 'type' => 'hidden', 'name' => 'proxystylesheet', 'value' => 'default_frontend', 'return' => true ) );
	$form_google_search_content .= fnbx_form_input( array( 'type' => 'hidden', 'name' => 'numgm', 'value' => '5', 'return' => true ) );
	$form_google_search_content .= fnbx_form_input( array( 'type' => 'hidden', 'name' => 'site', 'value' => 'default_collection', 'return' => true ) );
	$form_google_search_content .= fnbx_form_button( array( 
		'type' => 'submit',
		'name' => 'search',
		'value' => 'search',
		'tag_content' => 'Search',
		'return' => true 
	), array(
		'onmouseover' => "this.className='button-search- button-search-hover-'",
		'onmouseout' => "this.className='button-search-'"	
	) );
	
	return fnbx_form( 'gs', 'http://search.nicholls.edu/search', 'get', $form_google_search_content, true );

}


/**
* Nicholls Get Logo
*
* Returns or echo's the logo based on style and size with relevant HTML class and id
*
* Style: ntype - Main Nicholls logotype reading Nicholls State University
* Sizes: tiny, small, medium, large, custom
*
* Style: nmark - Alternate simple N image 
* Sizes: tiny, small, medium, large, custom
*
* Style: nmark-nicholls - Alternate N image with Nicholls across it.
* Sizes: tiny, small, medium, large, custom
*
* @since 0.4
*/
function nicholls_get_logo( $logo_style, $logo_size, $link = false, $return = true ) {
	
	$default_logo_img = array(
		'tag' => 'img',
		'tag_type' => 'single',
		'id' => 'logo-' . $logo_style . '-' . $logo_size,
		'class' => 'logo-nicholls-medium-',		
		'src' => FNBX_CORE_URL . '/library/images/nicholls-logo.png',
		'title' => 'Nicholls State University',
		'alt' => 'Nicholls State University',
		'tag_content_after' => "\n",
		'return' => $return
	);
	
	if ( $link ) {
		$default_logo_img['return'] = true;
		
		$default_logo = array(
			'tag' => 'a',
			'class' => 'link-home',		
			'href' => get_nicholls_core_url(),
			'title' => 'Nicholls State University',
			'tag_content' => fnbx_html_tag( $default_logo_img ),
			'return' => $return
		);
	} else {
		$default_logo = $default_logo_img;
	}
	
	if ( $return )
		return fnbx_html_tag( $default_logo );
	else 
		fnbx_html_tag( $default_logo );
		
		
}

/**
* Nicholls Full Page
*
* Filter function to be used to disable sidebar widgets on page templates.
*
*
* @since 0.1
*/
function nicholls_template_core_full_page() {
	// Widget Sidebar Group
	add_filter( 'sidebars_widgets', 'nicholls_core_widget_disable_filter' );
	remove_action( 'fnbx_container_end', 'fnbx_default_widget_sidebar' );
}

// Remove Sidebars Widgets
if ( !function_exists( 'nicholls_core_widget_disable_filter' ) ) {
	function nicholls_core_widget_disable_filter( $widget_groups ) {
		$widget_groups['primary'] = array();
		$widget_groups['secondary'] = array();
		return $widget_groups;
	}
}

function nicholls_core_debug_info() {

	echo "<!--\n";
	
	echo "\n plugin_basename " . plugin_basename();
	echo "\n site_url " . site_url();
	echo "\n admin_url " . admin_url();
	echo "\n content_url " . content_url();
	echo "\n plugins_url " . plugins_url();
	echo "\n includes_url " . includes_url();
	echo "\n home_url " . home_url();
	echo "\n get_site_url " . get_site_url();
	echo "\n get_home_url " . get_home_url();
	echo "\n get_admin_url " . get_admin_url();
	echo "\n network_site_url " . network_site_url();
	echo "\n network_home_url " . network_home_url();
	echo "\n network_admin_url " . network_admin_url();
	echo "\n get_stylesheet_directory " . get_stylesheet_directory();
	echo "\n get_stylesheet_directory_uri " . get_stylesheet_directory_uri();
	echo "\n get_template_directory " . get_template_directory();
	echo "\n get_template_directory_uri " . get_template_directory_uri();
	
	echo "\n-->";


}
