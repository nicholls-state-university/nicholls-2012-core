/*
 * Nicholls Core Javascript
 *
 * version 1.0 
 *
 * by James Planck <jess@funroe.net>
 *
 * Core javascript functionality. Dependent on jQuery and some jQuery plugins.
 */

// Depreciated: But still a useful function to do regular expression search on a set of classes
// Find and return the menu id in a mess of classes
function nicholls_get_menu_from_class( menu_class ) {
	
	// We remove the common nicholls-menu-item if it in the class string
	menu_class = menu_class.replace( /\s+/g, '');
	menu_class = menu_class.replace( 'nicholls-menu-item', '');
	menu_class = menu_class.replace( 'nicholls-menu-item-link', '');
	menu_class = menu_class.replace( 'nicholls-menu-selected', '');
	
	// We remove the last character because it should be '-'
	menu_class = menu_class.substring(0, menu_class.length - 1);
	
	return menu_class;
}

jQuery(document).ready( function() {
	
	// Set Transparency
	jQuery('.header-').addClass('transparent-black-50');
	
	// Corners 
	// jQuery('.info-primary-').corner('tl');
	// jQuery('.header-nicholls-').corner('br');
	// jQuery('.header-nicholls-').corner('tr');

	// jQuery('.header-').corner('bl');
	// jQuery('.header-').corner('br');
	// jQuery('.header-').corner('tr');
	
});

jQuery(function(){
	jQuery("#nicholls-menu-list").megamenu( { 'show_method':'simple', 'hide_method': 'simple' } );	
});