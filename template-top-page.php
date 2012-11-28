<?php
/*
Template Name: Top Page, Moved title - No Sidebars
*/

// Add function to remove sidebars
add_action( 'fnbx_child_init', 'nicholls_full_page');

// Move the titles around
function nicholls_move_title() {
	// Website Title
	remove_action( 'fnbx_header', 'fnbx_default_title' );
	// Website Description
	remove_action( 'fnbx_header', 'fnbx_default_description' );
	// Entry title
	remove_action( 'fnbx_template_loop_entry_title', 'fnbx_entry_title' );
	// Move the entry-title
	add_action( 'fnbx_header', 'fnbx_entry_title' );
}
add_action( 'fnbx_child_init', 'nicholls_move_title');

?>

<?php get_header() ?>

		<?php do_action( 'fnbx_template_page_start', 'template_page' ) ?><!-- START: template_page -->

			<?php
			/* Run The Loop
			 *
			 * If you want to overload this in a child theme then include a file
			 * called funbox-loop-page.php and that will be used instead.
			 * We also put the template part name 'page' into the global
			 * $fnbx->template_part_name so you can use it.
			 */

			 // Filter to catch this loop template part name into gloabal $fnbx
			 add_filter( 'get_template_part_funbox-loop', array(&$fnbx, 'get_template_part_filter'), 1, 2 );
			 get_template_part( 'funbox-loop', 'page' );
			 
			?>

		<?php do_action( 'fnbx_template_page_end', 'template_page' ) ?><!-- END: template_page -->

<?php get_sidebar() ?>

<?php get_footer() ?>