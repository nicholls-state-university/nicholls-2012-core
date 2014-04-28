<?php
// Load Stylesheet CSS as soon as possible;
// If a child theme is active we run the core init first.
if ( is_child_theme() ) add_action( 'wp', 'fnbx_stylesheet_core_init' );
// Don't load sheet twice for core theme - uncomment for sub-core themes.
// add_action( 'wp', 'fnbx_stylesheet_init' );
// BuddyPress? - uncomment for BuddyPress
// add_action( 'wp', 'fnbx_stylesheet_core_bp_init' );

/*
* FNBX Theme Default Actions
*
* Default actions for the FNBX Theme Framework are added by the fnbx_init
* located in the header.php file
* This allows child themes to override the entire group of of actions or 
* modify the actions individually.
*
* @since 1.0
*/
function fnbx_defaut_init_actions() {

	$n_options = get_option('nicholls_core_theme_options');
	
	// ISSUE: BuddyPress WPMU adminbar CSS needs to be loaded properly
	if ( is_user_logged_in() ) wp_enqueue_style( 'bp-admin-bar' );
	
	// Core JavaScript
	fnbx_javascript_enqueue_core();
	
	// Doctype
	add_action( 'fnbx_header_init', 'fnbx_doctype' );
	
	// Favicon
	add_action( 'fnbx_wp_head_before', 'fnbx_favicon_core' );

	// Head Meta
	add_action( 'fnbx_wp_head_before', 'fnbx_head_meta_content_type' );
	add_action( 'fnbx_wp_head_before', 'fnbx_head_meta_template' );
	add_action( 'fnbx_wp_head_before', 'fnbx_head_meta_robots' );
	add_action( 'fnbx_wp_head_before', 'fnbx_head_meta_author' );
	add_action( 'fnbx_wp_head_before', 'fnbx_head_meta_copyright' );
	add_action( 'fnbx_wp_head_before', 'fnbx_head_meta_revised' );
	// Bing verification meta
	add_action( 'fnbx_wp_head_before', 'nicholls_head_meta_bing_verification' );

	
	// Viewport
	add_action( 'fnbx_wp_head_before', 'fnbx_head_meta_viewport' );

	// Links
	add_action( 'fnbx_wp_head_before', 'fnbx_head_link_pingback' );
	add_action( 'fnbx_wp_head_before', 'fnbx_head_link_breadcrumb' );

	// Layout - Main
	add_action( 'fnbx_wrapper_start', 'fnbx_layout_element_open' );
	add_action( 'fnbx_wrapper_end', 'fnbx_layout_element_close' );	
	add_action( 'fnbx_header_start', 'fnbx_layout_element_open' );
	add_action( 'fnbx_header_end', 'fnbx_layout_element_close' );
	add_action( 'fnbx_container_start', 'fnbx_layout_element_open' );
	add_action( 'fnbx_container_end', 'fnbx_layout_element_close' );	
	add_action( 'fnbx_content_start', 'fnbx_layout_element_open' );
	add_action( 'fnbx_content_end', 'fnbx_layout_element_close' );	
	add_action( 'fnbx_footer_start', 'fnbx_layout_element_open' );
	add_action( 'fnbx_footer_end', 'fnbx_layout_element_close' );
	
	// Layout - Loop
	add_action( 'fnbx_template_loop_post_start', 'fnbx_layout_post_open' );
	add_action( 'fnbx_template_loop_post_end', 'fnbx_layout_post_close' );		
	add_action( 'fnbx_template_loop_content_start', 'fnbx_layout_element_open_class_only' );
	add_action( 'fnbx_template_loop_content_end', 'fnbx_layout_element_close' );

	// Website Title
	add_action( 'fnbx_header', 'fnbx_default_title' );

	// Website Description
	add_action( 'fnbx_header', 'fnbx_default_description' );
	
	// Add Accessiblity and Menu before nicholls-header if not home
	add_action( 'nicholls_header_start', 'fnbx_access_menu' );	
	
	// Nicholls Header - custom header.php - Layout
	add_action( 'nicholls_header_start', 'nicholls_layout_wrapper_element_open' );	
	add_action( 'nicholls_header_end', 'nicholls_layout_wrapper_element_close' );
	add_action( 'nicholls_header_start', 'fnbx_layout_element_open' );	
	add_action( 'nicholls_header_end', 'fnbx_layout_element_close' );
	
	// Nicholls Primary Menu
	add_action( 'nicholls_header_start', 'nicholls_megamenu_load' );	

	// Widget Sidebar Group
	add_action( 'fnbx_container_end', 'fnbx_default_widget_sidebar' );
	
	// Entry title
	add_action( 'fnbx_template_loop_entry_title', 'fnbx_entry_title' );
	
	// Entry date
	if ( !is_page() ) {
		if ( $n_options['site_remove_dates'] == false ) add_action( 'fnbx_template_loop_entry_title', 'fnbx_entry_date' );
	}

	// For all archives we put a page title, for author and categories we put desicription meta if available
	if ( is_archive() ) {
		// Loop template page title and description for some
		add_action( 'fnbx_template_loop_start', 'fnbx_page_title_default' );
		if ( is_author() || is_category() ) add_action( 'fnbx_template_loop_start', 'fnbx_page_description_default' );	
		// Loop template post thumbnail & content
		add_action( 'fnbx_template_loop_content_start', 'fnbx_the_post_thumbnail' );
	}
	
	// Home example adding a post thumbnail
	if ( is_home() ) add_action( 'fnbx_template_loop_content_start', 'fnbx_the_post_thumbnail' );

	// Nicholls theme options can disable all meta display
	if ( $n_options['site_remove_post_meta'] == false ) {
		// Content meta do we want brief or verbose, we could also filter or change with language files.
		if ( is_home() || ( is_archive() || is_search() ) ) 
			add_action( 'fnbx_template_loop_content_end', 'fnbx_post_meta_brief' );
		// This should cover is_single, is_attachement, is_image
		elseif ( !is_page() )
			add_action( 'fnbx_template_loop_content_end', 'fnbx_post_meta_verbose' );
	}
		
	// Put an edit link for pages since we don't show meta
	if ( is_page() ) add_action( 'fnbx_template_loop_content_end', 'fnbx_post_meta_edit' );		
		
	if ( is_attachment() ) {

		// Attachment parent
		add_action( 'fnbx_template_loop_start', 'fnbx_entry_parent_title' );

		/*
		Example for using the global $fnbx->template_part_name to set an action.
		For the attachement.php template it will be fnbx_template_loop_content_attachment_start
		For the image.php template fnbx_template_loop_content_image_start
		
		This will use specialized functions to pull the image or attachment to the top part of
		the loop template. This can also be done by making a respective fnbx-loop-image.php or
		fnbx-loop-attachment.php file in the child theme, yet using the action is very 
		interesting.
		*/
		
		// Attachment template content
		add_action( 'fnbx_template_loop_content_attachment_start', 'fnbx_attachment_content' );
		// Image template content
		add_action( 'fnbx_template_loop_content_image_start', 'fnbx_image_content' );
	}	

	// 404 Not Found page.
	if ( is_404() ) {
		// 404 template content (see: /library/php/404.php)
		add_action( 'fnbx_template_loop_content_404_end', 'nicholls_form_google_search' );
		add_action( 'fnbx_template_loop_content_404_end', 'fnbx_404_report' );
		add_action( 'fnbx_template_loop_content_404_end', 'fnbx_404_pagelist' );
		// 404 title shortcode replace filter (see: /library/php/404.php)
		add_filter( 'fnbx_entry_title_shortcode', 'fnbx_404_title_shortcode_filter' );
		// 404 Post Class error filter (see: /library/php/404.php)
		add_filter( 'fnbx_post_class', 'fnbx_404_post_class_filter' );
	}

	// Comments restricted to comment open, but could be switched on for other resons.
	if ( comments_open() ) {	
		// Comment Special Reply Javascripts for threaded comments
		add_action( 'fnbx_wp_head_before', 'fnbx_enqueue_script_comment_reply' );
		// Comment Layout
		add_action( 'fnbx_template_comments_start', 'fnbx_layout_element_open' );
		add_action( 'fnbx_template_comments_end', 'fnbx_layout_element_close' );
		// Comment Navigation
		add_action( 'fnbx_template_comments_comments_list_start', 'fnbx_comment_navigation_box_above' );
		// Standard Mixed Comments and Pings
		add_action( 'fnbx_template_comments_comments_list', 'fnbx_comment_list_default' );
		// Comment Navigation
		add_action( 'fnbx_template_comments_comments_list_end', 'fnbx_comment_navigation_box_below' );

		// Comments? We'll only add to the single post template using an action
		if ( is_single() ) add_action( 'fnbx_template_single_end', 'fnbx_comments_template_separate' );

		// Comments? We'll only add to the single post template using an action
		if ( is_page() ) add_action( 'fnbx_template_page_end', 'fnbx_comments_template_separate' );

		// Image template comments
		if ( is_attachment() ) add_action( 'fnbx_template_image_end', 'fnbx_comments_template_separate' );
	}
	
	// Nicholls MegaMenu
	// add_action( 'fnbx_footer', 'nicholls_megamenu_load' );
	
	// Nicholls Footer - custom footer.php - Layout
	add_action( 'nicholls_footer_start', 'nicholls_layout_wrapper_element_open' );	
	add_action( 'nicholls_footer_end', 'nicholls_layout_wrapper_element_close' );
	
	// The default actions get... an action. 
	do_action( 'fnbx_defaut_actions' );
}
// Default inits for header.php
add_action( 'fnbx_init', 'fnbx_defaut_init_actions' );

// Default init for adding post thumbnail & nav menu support to functions.php
add_action( 'fnbx_loaded', 'fnbx_post_thumbnails_default_setup' );
add_action( 'fnbx_loaded', 'fnbx_nav_menus_default_setup' );

/**
* FNBX Theme Centric Filters
*
* Adds various filters for WordPress and FNBX Theme functions.
*
* @since 1.0
*/
function fnbx_default_init_filters() {
	// Filter Header display tag
	add_filter( 'fnbx_default_title', 'fnbx_header_title_filter' );

	// Filter Main Titles
	add_filter( 'fnbx_entry_title', 'fnbx_entry_title_filter' );
	add_filter( 'fnbx_entry_title', 'fnbx_entry_title_filter' );
	add_filter( 'fnbx_entry_title_shortcode', 'fnbx_entry_title_shortcode_filter' );

	// Filter Post Classes
	add_filter( 'body_class', 'fnbx_body_class_filter' );

	// Filter Post Classes
	add_filter( 'post_class', 'fnbx_post_class_filter' );

	// Filter hfeed for non-pages
	add_filter( 'fnbx_content_class', 'fnbx_hfeed_class_filter' );

	// Filter entry for posts and pages
	add_filter( 'fnbx_entry_content_class', 'fnbx_entry_class_filter' );

	// Filter Comment Classes - ISSUE must get all the arguments mark non-users
	add_filter( 'comment_class', 'fnbx_comment_class_filter', 10, 4 );

	// The default filters get... an action. 
	do_action( 'fnbx_defaut_filters' );	
}
// FNBX Them Centric Default FIlters
add_action( 'fnbx_init', 'fnbx_default_init_filters' );

/*
* Nicholls Mega Menu
*
* Loader and stuff for megamenus
*
* @since 1.0
*/
function nicholls_megamenu_load() {
	load_template( FNBX_CORE_DIR . '/megamenu/megamenu-template.php' );
}
