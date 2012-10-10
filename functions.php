<?php
// Define child theme path constants.
if ( !defined( 'FNBX_CHILD_DIR' ) ) define( 'FNBX_CHILD_DIR', get_stylesheet_directory() );
if ( !defined( 'FNBX_CHILD_URL' ) ) define( 'FNBX_CHILD_URL', get_stylesheet_directory_uri() );

// Define theme core file location and uri using the current script file location
$fnbx_core_theme_dir = array_pop( explode( '/' , dirname( __FILE__ ) ) );
define( 'FNBX_CORE_DIR', get_theme_root() . '/' . $fnbx_core_theme_dir );
define( 'FNBX_CORE_URL', get_theme_root_uri() . '/' . $fnbx_core_theme_dir );

// Include core functions, actions, and filters.
require_once( FNBX_CORE_DIR . '/library/php/functions.php' );
require_once( FNBX_CORE_DIR . '/library/php/actions.php' );
require_once( FNBX_CORE_DIR . '/library/php/filters.php' );

// Include shortcodes
require_once( FNBX_CORE_DIR . '/library/php/shortcode-columns.php' );
require_once( FNBX_CORE_DIR . '/library/php/shortcode-list-pages.php' );
require_once( FNBX_CORE_DIR . '/library/php/shortcode-list-posts.php' );
require_once( FNBX_CORE_DIR . '/library/php/shortcode-list-events.php' );
require_once( FNBX_CORE_DIR . '/library/php/shortcode-shortcode.php' );

// Include widgets
if ( is_multisite() ) require_once( FNBX_CORE_DIR . '/library/php/widget-multisite-posts.php' );
require_once( FNBX_CORE_DIR . '/library/php/widget-form-login.php' );
require_once( FNBX_CORE_DIR . '/library/php/widget-nicholls-department-info.php' );

/**
* Conditional includes for specific WordPress and plugin settings
*/

// Use WP Admin Bar instead of BuddyPress
if ( !defined( 'BP_USE_WP_ADMIN_BAR' ) ) define('BP_USE_WP_ADMIN_BAR', true);

/**
* Conditional includes for fuctions and classes in WordPress admin panels 
*/
if ( is_admin() ) {
	require_once( FNBX_CORE_DIR . '/library/php/admin.php' );
}

/*
* Funbox Theme Support Filter
*
* Since this may be delpolyed on WordPress sites lacking some theme support features.
*
* @since 1.0
*/
function fnbx_theme_support_filter( $features ) {
	// Set and filter WordPress theme support features
	$features['post-formats'] = false;
	$features['custom-background'] = false;
	$features['custom-header'] = true;
	return $features;
}
add_filter( 'fnbx_theme_support', 'fnbx_theme_support_filter' );

/*
* Funbox Theme Custom Header Filter
*
* Modifies the output for custom header css.
*
* @since 1.0
*/
function fnbx_theme_custom_header_filter( $custom_header ) {
	global $fnbx;
	// Set and filter WordPress theme support features
	$custom_header['no_header_text'] = false;
	$custom_header['css_name'] = '.header-nicholls-wrapper-';
	$custom_header['header_image'] = FNBX_CORE_URL . '/library/images/backgrounds/bg-1.jpg';
	$custom_header['header_image_width'] = 1134;
	$custom_header['header_image_height'] = 449;
	$custom_header['header_image_flex_width'] = true;
	$custom_header['header_image_flex_height'] = true;
	$custom_header['css_repeat'] = 'repeat';
	$custom_header['css_position_x'] = 'right';
	$custom_header['css_position_y'] = 'center';
		
	return $custom_header;
}
add_filter( 'fnbx_custom_header', 'fnbx_theme_custom_header_filter' );

/*
* Funbox Theme Custom Header Width Filter
*
* Modifies the width for the header so it will zoom.
*
* @since 1.0
*/
function fnbx_theme_custom_header_width_filter( $h_width ) {
	return false;
}
add_filter( 'fnbx_custom_header_css_background_width', 'fnbx_theme_custom_header_width_filter' );
