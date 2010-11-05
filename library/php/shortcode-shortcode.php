<?php

/*
* Shortcode disable shortcode
*
* Simple shortcode to disable shortcode parsing so we can display the shortcodes
*
* @since 1.0
*/
function n_shortcode_shortcode($atts, $content = null ){
	return $content;
}
add_shortcode('shortcode', 'n_shortcode_shortcode');

?>