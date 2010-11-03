<?php
/**
* Header Template
*
* Template for standard Header.
*
* @package Funbox Theme
* @subpackage Template
*/

do_action( 'ftf_init'); // Default action and filter initialization
do_action( 'ftf_child_init'); // Child init override or enhance defaults
do_action( 'ftf_header_init'); // Typically used for doctype

?>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes('xhtml'); ?>>
<head profile="http://gmpg.org/xfn/11">

	<title><?php ftf_document_title() ?></title>

<?php do_action( 'ftf_wp_head_before', 'wp_head' ) ?>
<?php wp_head() // For plugins ?>
<?php do_action( 'ftf_wp_head_after', 'wp_head' ) ?>

</head>

<body <?php body_class() ?>>

<?php do_action( 'nicholls_header_start', 'header-nicholls' ) ?> <!-- START: nicholls-header -->

	<?php do_action( 'ftf_header_start', 'header' ) ?> <!-- START: header -->

		<?php do_action( 'ftf_header', 'header' ) ?>

	<?php do_action( 'ftf_header_end', 'header' ) ?> <!-- END: header -->

<?php do_action( 'nicholls_header_end', 'header-nicholls' ) ?> <!-- END: nicholls-header -->

<?php do_action( 'ftf_wrapper_start', 'wrapper' ) ?> <!-- START: wrapper -->

	<?php do_action( 'ftf_container_start', 'container' ) ?> <!-- START: container -->

		<?php do_action( 'ftf_content_start', 'content' ) ?> <!-- START: content -->