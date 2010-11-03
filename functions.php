<?php

// Define theme core file location and uri
define( NICHOLLS_CORE_DIR, WP_CONTENT_DIR . '/themes/nicholls-core' );
define( NICHOLLS_CORE_URL, WP_CONTENT_URL . '/themes/nicholls-core' );

// Include core functions, actions, and filters.
require_once( NICHOLLS_CORE_DIR . '/library/php/functions.php' );
require_once( NICHOLLS_CORE_DIR . '/library/php/actions.php' );
require_once( NICHOLLS_CORE_DIR . '/library/php/filters.php' );

?>