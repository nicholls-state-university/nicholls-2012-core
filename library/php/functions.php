<?php
/**
* Nicholls Core Theme Funtions
*
* Action hooks used by the Funbox Theme
*
* @package Nicholls Core
* @subpackage Hooks
*/

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
* Return the form for the Nicholls Google Mini Search engine
*
* @since 0.4
*/
function nicholls_form_google_search() {
	
	$form_google_search_content .= ftf_form_input( array( 'type' => 'text', 'name' => 'q', 'size' => 13, 'maxlength' => 256, 'return' => true ) );
	$form_google_search_content .= ftf_form_input( array( 'type' => 'hidden', 'name' => 'sort', 'value' => 'date:D:L:d1', 'return' => true ) );
	$form_google_search_content .= ftf_form_input( array( 'type' => 'hidden', 'name' => 'output', 'value' => 'xml_no_dtd', 'return' => true ) );
	$form_google_search_content .= ftf_form_input( array( 'type' => 'hidden', 'name' => 'oe', 'value' => 'UTF-8', 'return' => true ) );
	$form_google_search_content .= ftf_form_input( array( 'type' => 'hidden', 'name' => 'ie', 'value' => 'UTF-8', 'return' => true ) );
	$form_google_search_content .= ftf_form_input( array( 'type' => 'hidden', 'name' => 'client', 'value' => 'default_frontend', 'return' => true ) );
	$form_google_search_content .= ftf_form_input( array( 'type' => 'hidden', 'name' => 'proxystylesheet', 'value' => 'default_frontend', 'return' => true ) );
	$form_google_search_content .= ftf_form_input( array( 'type' => 'hidden', 'name' => 'numgm', 'value' => '5', 'return' => true ) );
	$form_google_search_content .= ftf_form_input( array( 'type' => 'hidden', 'name' => 'site', 'value' => 'default_collection', 'return' => true ) );
	$form_google_search_content .= ftf_form_button( array( 'type' => 'submit', 'name' => 'search', 'value' => 'search', 'tag_content' => 'Search', 'return' => true ) );
	
	return ftf_form( 'gs', 'http://search.nicholls.edu/search', 'get', $form_google_search_content, true );

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
		'src' => NICHOLLS_CORE_URL . '/library/images/nicholls-logo.png',
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
			'tag_content' => ftf_html_tag( $default_logo_img ),
			'return' => $return
		);
	} else {
		$default_logo = $default_logo_img;
	}
	
	if ( $return )
		return ftf_html_tag( $default_logo );
	else 
		ftf_html_tag( $default_logo );
		
		
}


// The main top menu
function nicholls_top_menu() {

	$url_nicholls_home = 'http://www.nicholls.edu';
	
	$nicholls_menu_items = array( 
		0 => array(
			'name' => 'nicholls-menu-home',
			'contents' => 'Home',
			'link' => $url_nicholls_home
		),	
		1 => array(
			'name' => 'nicholls-menu-about',
			'contents' => 'About Nicholls',
			'link' => $url_nicholls_home . '/about'
		),	
		2 => array(
			'name' => 'nicholls-menu-future',
			'contents' => 'Future Students',
			'link' => $url_nicholls_home . '/future-students'
		),		
		3 => array(
			'name' => 'nicholls-menu-current',
			'contents' => 'Current Students',
			'link' => $url_nicholls_home . '/current-students'
			
		),
		4 => array(
			'name' => 'nicholls-menu-administration',
			'contents' => 'Administration & Faculty',
			'link' => $url_nicholls_home . '/faculty-staff'
		),
		5 => array(
			'name' => 'nicholls-menu-friends',
			'contents' => 'Alumni, Donors, & Friends',
			'link' => $url_nicholls_home . '/alumni-donors-friends'
		),
		6 => array(
			'name' => 'nicholls-menu-search',
			'contents' => nicholls_form_google_search(),
			'link' => false
		),		
		
	);

		
	$box_clear = ftf_html_tag( array(
		'tag' => 'div',
		'class' => 'box-0x0 clear-both',
		'tag_content' => '',
		'tag_content_after' => "\n",
		'return' => true
	) );	
	
	ftf_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'open',
		'id' => 'menu-primary-container',
		'class' => 'menu-primary-container-',
		'tag_content_after' => "\n",
	) );
	
	ftf_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'open',		
		'id' => 'menu-primary',
		'class' => 'menu-primary-',		
		'tag_content_after' => "\n",
	) );	
	
	foreach( $nicholls_menu_items as $item ) {

		$menu_content_defaults = array(
			'tag' => 'li',
			'id' => $item['name'],			
			'class' => 'nicholls-menu-item ' . $item['name'] . '-',
			'tag_content' => $menu_link,
			'tag_content_after' => "\n",
			'return' => true
		);
				
		// This get complicated because some items are links and some aren't
		if ( $item['link'] != false ) {
		
			$menu_link_defaults = array(
				'tag' => 'a',
				'href' => $item['link'],
				'class' => 'nicholls-menu-item-link ' . $item['name'] . '-',
				'tag_content' => '<span>' . $item['contents'] . '</span>',
				'tag_content_after' => "\n",
				'return' => true
			);
			
			// Add nicholls-no-menu to home link because it's quicker than jscript
			if ( $item['name'] == 'nicholls-menu-home' ) $menu_link_defaults['class'] .= ' nicholls-menu-no';
		
			$menu_content_defaults['tag_content'] = ftf_html_tag( $menu_link_defaults );
		} else {
			if ( $item['name'] != 'nicholls-menu-search' ) $item['contents'] = '<span>' . $item['contents'] . '</span>';
			
			$menu_content_defaults['tag_content'] = $item['contents'];
		}
		
		// Last chance to do something beforw the menu is printed
		if ( $item['name'] == 'nicholls-menu-search' ) $menu_content_defaults['class'] .= ' nicholls-menu-no';
		// Add nicholls-no-menu to home link because it's quicker than jscript
		if ( $item['name'] == 'nicholls-menu-home' ) $menu_content_defaults['class'] .= ' nicholls-menu-no';

		$menu_content .= ftf_html_tag( $menu_content_defaults );
	}

	ftf_html_tag( array(
		'tag' => 'ul',
		'id' => 'nicholls-menu-list',
		'class' => 'nicholls-menu-list-',
		'tag_content' => $menu_content,
		'tag_content_after' => "\n",
	) );
	
	$menu_content = ftf_html_tag( array(
		'tag' => 'div',
		'id' => 'nicholls-menu-content',
		'class' => 'nicholls-menu-content-',
		'tag_content_after' => "\n",
		'return' => true
	) );

	$menu_content_container = ftf_html_tag( array(
		'tag' => 'div',
		'id' => 'nicholls-menu-content-container',
		'class' => 'nicholls-menu-content-container-',
		'tag_content' => $menu_content,
		'tag_content_after' => "\n",
		'return' => true
	) );
	
	ftf_html_tag( array(
		'tag' => 'div',
		'id' => 'nicholls-menu-content-wrapper',
		'class' => 'nicholls-menu-content-wrapper-',
		'tag_content' => $menu_content_container,
		'tag_content_after' => "\n",
	) );
	
	// Close menu-primary
	ftf_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'close',
		'tag_content_after' => "\n",
	) );	

	// Close menu-primary-container
	ftf_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'close',
		'tag_content_after' => "\n",
	) );

}

function nicholls_core_header() {
		
	$box_clear = ftf_html_tag( array(
		'tag' => 'div',
		'class' => 'box-0x0 clear-both',
		'tag_content' => '',
		'tag_content_after' => "\n",
		'return' => true
	) );	
	
	ftf_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'open',
		'id' => 'info-primary',
		'class' => 'info-primary-',
		'tag_content_after' => "\n",
	) );
	
	$logo = ftf_html_tag( array(
		'tag' => 'img',
		'tag_type' => 'single',
		'id' => 'logo-nicholls-medium',
		'class' => 'logo-nicholls-medium-',		
		'src' => NICHOLLS_CORE_URL . '/library/images/nicholls-logo.png',
		'title' => 'Nicholls State University',
		'alt' => 'Nicholls State University',
		'tag_content_after' => "\n",
		'return' => true
	) );

	ftf_html_tag( array(
		'tag' => 'div',
		'id' => 'logo-container',
		'class' => 'logo-container-',
		'tag_content' => $logo,
		'tag_content_after' => "\n",
	) );

	$nicholls_menu_items = array( 
		0 => array(
			'class' => 'contact',
			'contents' => '1-877-NICHOLLS <span class="type-normal"> - <a href="' . get_nicholls_core_url() . '/contact">Contact Us</a></span>'
		),		
		1 => array(
			'class' => 'programs',
			'contents' => '<a href="' . get_nicholls_core_url() . '/programs">Majors &amp; Programs of Study</a>'
		),
		2 => array(
			'class' => 'request',
			'contents' => '<a href="/">Request Admission Information</a>'
		)

	);
	
	foreach( $nicholls_menu_items as $item ) {
		$menu_content .= ftf_html_tag( array(
			'tag' => 'li',
			'class' => 'info-' . $item['class'],
			'tag_content' => $item['contents'],
			'tag_content_after' => "\n",
			'return' => true
		) );
	}

	ftf_html_tag( array(
		'tag' => 'ul',
		'tag_content' => $menu_content,
		'tag_content_after' => "\n",
	) );

	// Close info-primary
	ftf_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'close',
		'tag_content_after' => "\n",
	) );

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

?>