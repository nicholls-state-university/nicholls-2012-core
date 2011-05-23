<?php

/*
* Columns shortcode
*
* Creates div separators to create columns from shortcodes
* [column width= padding= class= style=] content [/column]
* Use width and padding for style attribute columns
* Use style to control full div style attribute (default is below)
* eliminate all and use class to make custom css controled columns
*
* @since 1.0
*/
function column_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'width' => '0',
		'padding' => '0',
		'style' => false,
		'class' => 'column-'
		// ...etc
	), $atts ) );
	
	$content = column_clean_shortcode_content( $content );
	
	$column_defaults = array(
	   'tag' => 'div',
	   'tag_content' => $content,
	   'class' => $class,
	   'return' => true
	);
	
	if ( !$style ) 
		$column_defaults['style'] = 'width:' . $width . '; float: left; padding-right: '. $padding . '; display: inline;';
	else
		$column_defaults['style'] = $style;
	
	if ( $width == 0 && $padding == 0 ) {
		unset( $column_defaults['style'] );
	}
	
	return ftf_html_tag( $column_defaults );
}
add_shortcode('column', 'column_shortcode');

/*
* Columns end shortcode
*
* Creates a closed div to act as a clearing element.
* [column_clear]
* Default is use the CSS "clear" class which should be .clear{ clear: both}
*
* @since 1.0
*/
function end_column_shortcode(){
	return '<div class="clear"></div>';
}
add_shortcode('column_clear', 'end_column_shortcode');

// cleaning function from http://donalmacarthur.com/articles/cleaning-up-wordpress-shortcode-formatting/
function column_clean_shortcode_content( $content ) {

    /* Parse nested shortcodes and add formatting. */
    $content = trim( wpautop( do_shortcode( $content ) ) );

    /* Remove '</p>' from the start of the string. */
    if ( substr( $content, 0, 4 ) == '</p>' )
        $content = substr( $content, 4 );

    /* Remove '<p>' from the end of the string. */
    if ( substr( $content, -3, 3 ) == '<p>' )
        $content = substr( $content, 0, -3 );

    /* Remove any instances of '<p></p>'. */
    $content = str_replace( array( '<p></p>' ), '', $content );

    return $content;
}

?>