<?php
/**
* Core Theme Actions
*
* Action hooks used by the Funbox Theme
*
* @package Core
* @subpackage Hooks
*/

/**
* Core Actions 
*
* An action fired on fnbx_child_init to perform some initializations.
*
* @since 0.4
*/
function fnbx_core_actions() {
		
	// ISSUE: Remove FNBX BuddyPress search & login bar because we don't need it yet
	remove_action( 'fnbx_header_start', 'fnbx_bp_search_login_bar' );
	
}
add_action( 'fnbx_child_init', 'fnbx_core_actions' );

/**
* Core Favicon 
*
* Function used to add HTML to head for favicon stored in images directory.
*
* @since 0.4
*/
function fnbx_favicon_core() {
	$favicon_default = array(
		'tag' => 'link',
		'tag_type' => 'single',
		'href' => FNBX_CORE_URL . '/library/images/logos/favicon.ico',
		'type' => 'image/x-icon'
	);
	
	$favicon_default['rel'] = 'icon';
	fnbx_html_tag( $favicon_default );
	
	$favicon_default['rel'] = 'shortcut icon';
	fnbx_html_tag( $favicon_default );

}

/**
* Nicholls Open Wrapper Element
*
* Uses fnbx_layout_element_open() to open a div adding -wrapper to the element name
*
*/
function nicholls_layout_wrapper_element_open( $element = '' ) {
	if ( $element == '' ) return;
		
	fnbx_layout_element_open( $element . '-wrapper' );
}

/**
* Nicholls Close Wrapper Element
*
* Uses fnbx_layout_element_close() to open a div adding -wrapper to the element name
*
*/
function nicholls_layout_wrapper_element_close( $element = '' ) {
	if ( $element == '' ) return;
		
	fnbx_layout_element_close( $element . '-wrapper' );
}

/**
* Core Stylesheet Setup
*
* Used to setup the CSS Style sheet link for wp_head(). 
*
* @since 1.0
*/
function fnbx_stylesheet_core_init() {
    if ( !is_admin() ) {
		$theme  = wp_get_theme();	
		
		wp_register_style( 'style-core', FNBX_CORE_URL . '/style.css', false, $theme->version );
		wp_enqueue_style( 'style-core' );
    }
 }

/**
* BuddyPress CSS Stylesheet
*
* Load the core stylesheet CSS
*
*/
function fnbx_stylesheet_core_bp_init() {
    if ( !is_admin() ) {
		$theme  = get_theme( get_current_theme() );
		wp_register_style( 'style-bp', FNBX_CORE_URL . '/library/css/bp.css', false, $theme['Version'] );
		wp_enqueue_style( 'style-bp' );
    }
}

// Use action to enqueue javascript
function fnbx_javascript_enqueue_core() {
	wp_enqueue_script( 'modernizr' , FNBX_CORE_URL . '/library/js/modernizr.mostly-all.js', array( 'jquery' ), '2.0.6' );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-hoverintent' , FNBX_CORE_URL . '/library/js/jquery.hoverIntent.minified.js', array( 'jquery' ), 'r5' );
	wp_enqueue_script( 'jquery-pngfix' , FNBX_CORE_URL . '/library/js/jquery.pngFix.js', array( 'jquery' ), '1.2' );
	wp_enqueue_script( 'jquery-responsenav' , FNBX_CORE_URL . '/library/js/jquery.responsinav.js', array( 'jquery' ), '1.0' );
	wp_enqueue_script( 'core-js' , FNBX_CORE_URL . '/library/js/core.js', array( 'jquery' ), '1.0' );	
		
	//wp_enqueue_script( 'jquery-corner' , FNBX_CORE_URL . '/library/js/jquery.corner.js', array( 'jquery' ), '2.01' );
	//wp_enqueue_script( 'jquery-megamenu' , FNBX_CORE_URL . '/library/js/jquery.megamenu.js', array( 'jquery' ), '2.1a' );
	//wp_enqueue_script( 'jquery-anystretch' , FNBX_CORE_URL . '/library/js/jquery.anystretch.min.js', array( 'jquery' ), '1.1' );

}

