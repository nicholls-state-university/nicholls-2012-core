<?php

// Define theme core file location and uri
define( NICHOLLS_CORE_DIR, WP_CONTENT_DIR . '/themes/nicholls-2011-core' );
define( NICHOLLS_CORE_URL, WP_CONTENT_URL . '/themes/nicholls-2011-core' );

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

/**
* Conditional includes for fuctions and classes in WordPress admin panels
* Set $nicholls_webmanager primary object instance
* @global object $nicholls_webmanager 
*/
if ( is_admin() ) {
	require_once( NICHOLLS_CORE_DIR . '/library/php/admin.php' );
}
// Function to setup Nicholls theme functions and options
function nicholls_setup() {
	// Custom Header Images
	define('NO_HEADER_TEXT', true );
	define('HEADER_TEXTCOLOR', '');
	define('HEADER_IMAGE', get_bloginfo('stylesheet_directory') . '/library/images/bg_1.jpg');
	define('HEADER_IMAGE_WIDTH', 760); // use width and height appropriate for your theme
	define('HEADER_IMAGE_HEIGHT', 86);
	
	add_custom_image_header('nicholls_header_style', 'nicholls_admin_header_style');
}
add_action( 'after_setup_theme', 'nicholls_setup' );


// gets included in the site header
function nicholls_header_style() {
    ?><style type="text/css">
        .header- {
            background: #000 url("<?php header_image(); ?>") no-repeat right top;
        }
    </style><?php 	

}

// gets included in the admin header
function nicholls_admin_header_style() {
    ?><style type="text/css">
        #headimg {
            width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
            height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
            background-repeat: no-repeat;
        }
    </style><?php
}

?>