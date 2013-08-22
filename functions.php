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
* FNBX Theme Support Filter
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
* Setup Nicholls Custom Headers.
*
* The first default is part of the filter, but we add other default headers here.
*
* @since 1.0
*/
function nicholls_custom_headers_setup() {
	register_default_headers( array (
			'nicholls_default_header_a' => array (
				'url' => FNBX_CORE_URL . '/library/images/headers/h-beauregard-1.jpg',
				'thumbnail_url' => FNBX_CORE_URL . '/library/images/headers/h-beauregard-1-thumbnail.jpg',
				'description' => __( 'Beauregard Hall 1', 'fnbx_lang' )
			),
			'nicholls_default_header_c' => array (
				'url' => FNBX_CORE_URL . '/library/images/headers/h-elkins-2.jpg',
				'thumbnail_url' => FNBX_CORE_URL . '/library/images/headers/h-elkins-2-thumbnail.jpg',
				'description' => __( 'Elkins Hall 2', 'fnbx_lang' )
			),
			'nicholls_default_header_d' => array (
				'url' => FNBX_CORE_URL . '/library/images/headers/h-elkins-3.jpg',
				'thumbnail_url' => FNBX_CORE_URL . '/library/images/headers/h-elkins-3-thumbnail.jpg',
				'description' => __( 'Elkins Hall 3', 'fnbx_lang' )
			),
			'nicholls_default_header_e' => array (
				'url' => FNBX_CORE_URL . '/library/images/headers/h-elkins-4.jpg',
				'thumbnail_url' => FNBX_CORE_URL . '/library/images/headers/h-elkins-4-thumbnail.jpg',
				'description' => __( 'Elkins Hall 4', 'fnbx_lang' )
			),
			'nicholls_default_header_f' => array (
				'url' => FNBX_CORE_URL . '/library/images/headers/h-elkins-5.jpg',
				'thumbnail_url' => FNBX_CORE_URL . '/library/images/headers/h-elkins-5-thumbnail.jpg',
				'description' => __( 'Elkins Hall 5', 'fnbx_lang' )
			),
			'nicholls_default_header_g' => array (
				'url' => FNBX_CORE_URL . '/library/images/headers/h-elkins-6.jpg',
				'thumbnail_url' => FNBX_CORE_URL . '/library/images/headers/h-elkins-6-thumbnail.jpg',
				'description' => __( 'Elkins Hall 6', 'fnbx_lang' )
			),
			'nicholls_default_header_h' => array (
				'url' => FNBX_CORE_URL . '/library/images/headers/h-elkins-7.jpg',
				'thumbnail_url' => FNBX_CORE_URL . '/library/images/headers/h-elkins-7-thumbnail.jpg',
				'description' => __( 'Elkins Hall 7', 'fnbx_lang' )
			),
			'nicholls_default_header_i' => array (
				'url' => FNBX_CORE_URL . '/library/images/headers/h-elkins-8.jpg',
				'thumbnail_url' => FNBX_CORE_URL . '/library/images/headers/h-elkins-8-thumbnail.jpg',
				'description' => __( 'Elkins Hall 8', 'fnbx_lang' )
			),
			'nicholls_default_header_j' => array (
				'url' => FNBX_CORE_URL . '/library/images/headers/h-ellender-1.jpg',
				'thumbnail_url' => FNBX_CORE_URL . '/library/images/headers/h-ellender-1-thumbnail.jpg',
				'description' => __( 'Ellender Library 1', 'fnbx_lang' )
			),
			'nicholls_default_header_k' => array (
				'url' => FNBX_CORE_URL . '/library/images/headers/h-lamps-1.jpg',
				'thumbnail_url' => FNBX_CORE_URL . '/library/images/headers/h-lamps-1-thumbnail.jpg',
				'description' => __( 'Lights', 'fnbx_lang' )
			),
			'nicholls_default_header_l' => array (
				'url' => FNBX_CORE_URL . '/library/images/headers/h-quad-1.jpg',
				'thumbnail_url' => FNBX_CORE_URL . '/library/images/headers/h-quad-1-thumbnail.jpg',
				'description' => __( 'Quad 1', 'fnbx_lang' )
			),
			'nicholls_default_header_m' => array (
				'url' => FNBX_CORE_URL . '/library/images/headers/h-ceiling-1.jpg',
				'thumbnail_url' => FNBX_CORE_URL . '/library/images/headers/h-ceiling-1-thumbnail.jpg',
				'description' => __( 'Student 1', 'fnbx_lang' )
			),
			'nicholls_default_header_n' => array (
				'url' => FNBX_CORE_URL . '/library/images/headers/h-white-1.jpg',
				'thumbnail_url' => FNBX_CORE_URL . '/library/images/headers/h-white-1-thumbnail.jpg',
				'description' => __( 'White Hall 1', 'fnbx_lang' )
			),
			'nicholls_default_header_o' => array (
				'url' => FNBX_CORE_URL . '/library/images/headers/h-elkins-azaleas-1.jpg',
				'thumbnail_url' => FNBX_CORE_URL . '/library/images/headers/h-elkins-azaleas-1-thumbnail.jpg',
				'description' => __( 'White Hall 1', 'fnbx_lang' )
			),
			'nicholls_default_header_n' => array (
				'url' => FNBX_CORE_URL . '/library/images/headers/h-fountain-1.jpg',
				'thumbnail_url' => FNBX_CORE_URL . '/library/images/headers/h-fountain-1-thumbnail.jpg',
				'description' => __( 'White Hall 1', 'fnbx_lang' )
			),
			'nicholls_default_header_n' => array (
				'url' => FNBX_CORE_URL . '/library/images/headers/h-wall-1.jpg',
				'thumbnail_url' => FNBX_CORE_URL . '/library/images/headers/h-wall-1-thumbnail.jpg',
				'description' => __( 'White Hall 1', 'fnbx_lang' )
			)
	) );
}
add_action( 'after_setup_theme', 'nicholls_custom_headers_setup' );

/*
* FNBX Theme Custom Header Filter
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
	$custom_header['header_image'] = FNBX_CORE_URL . '/library/images/headers/h-elkins-1.jpg';
	$custom_header['header_image_thumbnail'] = FNBX_CORE_URL . '/library/images/headers/h-elkins-1-thumbnail.jpg';
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
* FNBX Theme Custom Header Width Filter
*
* Modifies the width for the header so it will zoom.
*
* @since 1.0
*/
function fnbx_theme_custom_header_width_filter( $h_width ) {
	return false;
}
add_filter( 'fnbx_custom_header_css_background_width', 'fnbx_theme_custom_header_width_filter' );

/*
* Nicholls Jump To Links
*
* Add jump to links to help visitors move around page.
*
* @since 1.0
*/
function nicholls_html_go_to() {

	if ( is_active_sidebar( 'primary' ) == false ) {
		if ( is_active_sidebar( 'secondary' ) == false )
			return false;
		else
			$go_link_info = '#widgets-secondary';
	} else {
		$go_link_info = '#widgets-primary';
	}
	
?>
<div id="nicholls-nav-go-to-wrapper" class="nicholls-nav-go-wrapper- nicholls-nav-go-to-wrapper-">
	<div id="nicholls-nav-go-to" class="nicholls-nav-go- nicholls-nav-go-to-">
	
	<span>Go To &darr;</span>
	<span><a href="<?php echo $go_link_info; ?>">Navigation &amp; Information</a></span>
	<span><a href="#footer">Other Information</a></span>
	
	</div>
</div>

<?php
}
add_action( 'nicholls_header_end', 'nicholls_html_go_to', 99 );

/**
* Nicholls Google Anayltics Site JS
*
* Function to insert Google Analytics tracking javascript preferably in header
*
* @since 0.4
*/
function nicholls_js_google_analytics() {
?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-23854260-2']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<?php
}
add_action( 'fnbx_wp_head_after', 'nicholls_js_google_analytics' );