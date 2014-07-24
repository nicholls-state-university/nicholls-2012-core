<?php
/*
Template Name: No Title
*/

// Remove Entry Title
function nicholls_remove_title() {
	// Entry title
	remove_action( 'fnbx_template_loop_entry_title', 'fnbx_entry_title' );
}
add_action( 'fnbx_child_init', 'nicholls_remove_title');

?>
<?php get_header() ?>

		<!-- START: template_page -->
		<?php do_action( 'fnbx_template_page_start', 'template_page' ) ?>

			<?php
			/* Run The Loop
			 *
			 * If you want to overload this in a child theme then include a file
			 * called fnbx-loop-page.php and that will be used instead.
			 * We also put the template part name 'page' into the global
			 * $fnbx->template_part_name so you can use it.
			 */

			 // Filter to catch this loop template part name into gloabal $fnbx
			 global $fnbx;
			 add_filter( 'get_template_part_fnbx-loop', array(&$fnbx, 'get_template_part_filter'), 1, 2 );
			 get_template_part( 'fnbx-loop', 'page' );
			 
			?>

		<?php do_action( 'fnbx_template_page_end', 'template_page' ) ?>
		<!-- END: template_page -->

<?php get_sidebar() ?>

<?php get_footer() ?>