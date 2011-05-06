<?php

// Define theme core file location and uri
define( 'NICHOLLS_CORE_DIR', get_theme_root() . '/nicholls-2011-core' );
define( 'NICHOLLS_CORE_URL', content_url() . '/themes/nicholls-2011-core' );

// Include core functions, actions, and filters.
require_once( NICHOLLS_CORE_DIR . '/library/php/functions.php' );
require_once( NICHOLLS_CORE_DIR . '/library/php/actions.php' );
require_once( NICHOLLS_CORE_DIR . '/library/php/filters.php' );

// Include shortcodes
require_once( NICHOLLS_CORE_DIR . '/library/php/shortcode-columns.php' );
require_once( NICHOLLS_CORE_DIR . '/library/php/shortcode-list-pages.php' );
require_once( NICHOLLS_CORE_DIR . '/library/php/shortcode-list-posts.php' );
require_once( NICHOLLS_CORE_DIR . '/library/php/shortcode-list-events.php' );
require_once( NICHOLLS_CORE_DIR . '/library/php/shortcode-shortcode.php' );

// Include widgets
require_once( NICHOLLS_CORE_DIR . '/library/php/widget-nicholls-department-info.php' );
require_once( NICHOLLS_CORE_DIR . '/library/php/widget-multisite-posts.php' );

/**
* Conditional includes for fuctions and classes in WordPress admin panels
* Set $nicholls_webmanager primary object instance
* @global object $nicholls_webmanager 
*/
if ( is_admin() ) {
	require_once( NICHOLLS_CORE_DIR . '/library/php/admin.php' );
}

?>