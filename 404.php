<?php
/**
* 404 Error Template
*
* Template for content not found 404 errors
*
* @package FNBX Theme
* @subpackage Template
*/
?>

<?php

/*
* Filters and actions for 404 error page
*
* This was in an include, but I'm making it part of the template because you may not want it.
*
*/

/*
* Custom Nicholls 404 search form
*/
function nicholls_404_search_form() {
?>
	<div class="form-gs-container-404-" id="form-gs-container-404">
		<form method="get" action="http://www.nicholls.edu/search" enctype="application/x-www-form-urlencoded" name="gs" id="gs">
			<fieldset>
				<label for="q">Search</label>
				<input tabindex="1" type="text" value="Search..." class="input-q-" name="q" id="q">
				<input type="submit" value="Search" class="input-site-" name="search" id="search-">
			</fieldset>
		</form>
	</div>
<?php
}

/**
* FNBX 404 init we load this early in fnbx_init so we can override later if we want.
*/
function fnbx_404_init() {
	// Doublecheck 404 Not Found page.
	if ( is_404() ) {
		// 404 template content (see: /library/php/404.php)
		add_action( 'fnbx_template_loop_content_404_end', 'nicholls_404_search_form' );
		add_action( 'fnbx_template_loop_content_404_end', 'fnbx_404_report' );
		add_action( 'fnbx_template_loop_content_404_end', 'fnbx_404_pagelist' );
		// 404 title shortcode replace filter (see: /library/php/404.php)
		add_filter( 'fnbx_entry_title_shortcode', 'fnbx_404_title_shortcode_filter' );
		// 404 Post Class error filter (see: /library/php/404.php)
		add_filter( 'fnbx_post_class', 'fnbx_404_post_class_filter' );
	}
}
add_action( 'fnbx_init', 'fnbx_404_init' );

/**
* Title Shortcode filter for 404 pages
*/
function fnbx_404_title_shortcode_filter( $shortcode_defaults ) {
	$shortcode_defaults = __( 'Error: Not Found', 'fnbx_lang' );
	return $shortcode_defaults;
}

/**
* List pages function to give visitor places to go for 404 pages
*/
function fnbx_404_pagelist() {
	$heading = __( 'Try another page at ', 'fnbx_lang' ) . get_bloginfo('name');
	$description =  __( 'Here is a list of pages for this Web site where you may find the information you were originally seeking.', 'fnbx_lang' );
	fnbx_pagelist_box( 'sort_column=menu_order&title_li=', $heading, $description );
}

/**
* Post class filter for 404 pages to add error elements
*/
function fnbx_404_post_class_filter( $element_classes ) {
	$element_classes[] = 'post';
	$element_classes[] = 'error-404';
	$element_classes[] = 'not-found';
	return $element_classes;
}

/*
* Specialized function for handling 404 bad link reports by sending e-mail to administrators
*/
function fnbx_404_report() {

	$bad_link = true;
	$report_do = false;
	$report_success = false;
	$show_message = false;
	$message_classes = array();

	if ( $_SERVER['HTTP_REFERER'] == '' || !isset( $_SERVER['HTTP_REFERER']) ) $bad_link = false;

	if ( isset(  $_POST['report-404-action'] ) && ( $_POST['report-404-action'] == 'report' ) ) 
		$report_do = true;
	else
		return false;

	if ( !$bad_link ) return;

	if ( $report_do ) {
		if ( !is_email( $_POST['report-404-email'] ) ) {
			$report_do = false;
			$show_message = true;
			$report_success = false;
			$report_message = __( 'Invalid E-mail Address!', 'fnbx_lang');
		}
	}

	if ( $report_do ) {

		$text_subject = __( '[Broken Link] ', 'fnbx_lang') . get_bloginfo( 'blogname' );

		$text_body  = get_bloginfo( 'blogname' ) . __( ' Broken Link Report', 'fnbx_lang') . "\n\n";
		$text_body .= __( 'A broken link to: ', 'fnbx_lang') . site_url() . $_POST['report-404-uri'] . "\n";
		$text_body .= __( 'This broken link was found at: ', 'fnbx_lang') . $_POST['report-404-referrer'] . "\n\n";
		$text_body .= __( 'Reported by E-mail: ', 'fnbx_lang') . $_POST['report-404-email'] . "\n";

		$report_users = get_users();
		foreach ( (array) $report_users as $report_user ) {
			$report_user_roles = unserialize( $report_user->meta_value );
			if ( array_key_exists('administrator', $report_user_roles ) ) {
				if ( !wp_mail( $report_user->user_email, $text_subject, $text_body ) ) {
					$show_message = true;
					$report_success = false;
					$report_message .= __( 'Error Sending Message!', 'fnbx_lang');
				} else {
					$report_success = true;
					$show_message = true;
					$report_message .= __( 'Thank you for your error report!', 'fnbx_lang');
				}
			}
		}

	}

	fnbx_html_tag( array(
		'tag' => 'h3',
		'tag_content' => __( 'Report this broken link!', 'fnbx_lang' )
	) );

	if ( !$report_success ) {

		$form_404_content .= fnbx_form_input( array( 'type' => 'hidden', 'name' => 'report-404-referrer', 'value' => $_SERVER['HTTP_REFERER'], 'return' => true ) );
		$form_404_content .= fnbx_form_input( array( 'type' => 'hidden', 'name' => 'report-404-uri', 'value' => $_SERVER['REQUEST_URI'], 'return' => true ) );
		$form_404_content .= fnbx_form_input( array( 'type' => 'hidden', 'name' => 'report-404-action', 'value' => 'report', 'return' => true ) );
		$form_404_content .= fnbx_form_input_row( array( 'label' => __( 'E-mail Address', 'fnbx_lang' ), 'type' => 'text', 'name' => 'report-404-email', 'value' => '', 'return' => true ) );

		$form_404_content .= fnbx_form_input( array( 'type' => 'submit', 'name' => 'report-404-submit', 'value' => __( 'Send Error Report', 'fnbx_lang' ), 'return' => true ) );

		$form_contents = fnbx_fieldset( __( 'Personal Information', 'fnbx_lang' ), $form_404_content, true );

		$container_only = false;
	}

	if ( $show_message ) {
		if ( $report_success == false ) $message_classes[] = 'error';
		if ( $report_success == true ) {
			$message_classes = array( 'success' );
			$container_only = true;
		}
		$form_contents = fnbx_message( $report_message, true, $message_classes ) . $form_contents;
	}

	fnbx_form( 'report-404', $_SERVER['REQUEST_URI'], 'post', $form_contents );

}

?>

<?php get_header() ?>

		<!-- START: template_404 -->
		<?php do_action( 'fnbx_template_404_start', 'template_404' ) ?>


			<?php
			/* Run The Loop
			 *
			 * If you want to overload this in a child theme then include a file
			 * called fnbx-loop-404.php and that will be used instead.
			 * We also put the template part name '404' into the global
			 * $fnbx->template_part_name so you can use it.
			 */

			 // Filter to catch this loop template part name into gloabal $fnbx
			 global $fnbx;
			 add_filter( 'get_template_part_fnbx-loop', array(&$fnbx, 'get_template_part_filter'), 1, 2 );
			 get_template_part( 'fnbx-loop', '404' );
			 
			?>

		<?php do_action( 'fnbx_template_404_end', 'template_404' ) ?>
		<!-- END: template_404 -->

<?php get_sidebar() ?>

<?php get_footer() ?>