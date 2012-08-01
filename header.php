<?php
/**
* Header Template
*
* Template for standard Header.
*
* @package FNBX Theme
* @subpackage Template
*/

do_action( 'fnbx_init'); // Default action and filter initialization
do_action( 'fnbx_child_init'); // Child init override or enhance defaults
do_action( 'fnbx_header_init'); // Typically used for doctype

?>
<html <?php language_attributes('html'); ?>>
<head>

	<title><?php fnbx_document_title() ?></title>

<link href='http://fonts.googleapis.com/css?family=Cabin:400,500,600,700,400italic,500italic,600italic,700italic|Crimson+Text:400,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>

<?php do_action( 'fnbx_wp_head_before', 'wp_head' ) ?>
<?php wp_head() // For plugins ?>
<?php do_action( 'fnbx_wp_head_after', 'wp_head' ) ?>

</head>

<body <?php body_class() ?>>
<!-- START: body -->
<?php do_action( 'fnbx_body_start', 'body' ) ?>

<div class="nav-top-wrapper-">
	<div class="nav-top-">
		<div class="form-gs-container-" id="form-gs-container">
		<form method="get" action="http://search.nicholls.edu/search" enctype="application/x-www-form-urlencoded" name="gs" id="gs">
			<fieldset>
				<label for="q">Search</label>
				<input type="text" value="Search..." class="input-q-" name="q" id="q">
				<input type="hidden" value="date:D:L:d1" class="input-sort-" name="sort" id="sort">
				<input type="hidden" value="xml_no_dtd" class="input-output-" name="output" id="output">
				<input type="hidden" value="UTF-8" class="input-oe-" name="oe" id="oe">
				<input type="hidden" value="UTF-8" class="input-ie-" name="ie" id="ie">
				<input type="hidden" value="default_frontend" class="input-client-" name="client" id="client">
				<input type="hidden" value="default_frontend" class="input-proxystylesheet-" name="proxystylesheet" id="proxystylesheet">
				<input type="hidden" value="5" class="input-numgm-" name="numgm" id="numgm">
				<input type="hidden" value="default_collection" class="input-site-" name="site" id="site">
				<input type="submit" value="Search" class="input-site-" name="search" id="search-">
			</fieldset>
		</form>
		</div>
	</div>
</div>

<?php do_action( 'nicholls_header_start', 'header-nicholls' ) ?> <!-- START: nicholls-header -->

	<!-- START: header -->
	<?php do_action( 'fnbx_header_start', 'header' ) ?>

		<?php do_action( 'fnbx_header', 'header' ) ?>

	<?php do_action( 'fnbx_header_end', 'header' ) ?>
	<!-- END: header -->

<?php do_action( 'nicholls_header_end', 'header-nicholls' ) ?> <!-- END: nicholls-header -->

<!-- START: wrapper -->
<?php do_action( 'fnbx_wrapper_start', 'wrapper' ) ?>

	<!-- START: container -->
	<?php do_action( 'fnbx_container_start', 'container' ) ?>

		<!-- START: content -->
		<?php do_action( 'fnbx_content_start', 'content' ) ?>