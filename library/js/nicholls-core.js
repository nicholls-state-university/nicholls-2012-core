/*
 * Nicholls Core Javascript
 *
 * version 1.0 
 *
 * by James Planck <james.planck@nicholls.edu>
 *
 * Core javascript functionality for the Nicholls website. Part of the Nicholls Core website
 * theme. Dependent on jQuery and some jQuery plugins.
 */

						
function the_resize(thewindowwidth) {
	if ( thewindowwidth < 964 ) {
		jQuery('body').addClass('screen-narrow');
	} else {
		jQuery('body').removeClass('screen-narrow');
	}
	return;
}

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

	jQuery.browser.msie6 = jQuery.browser.msie && parseInt(jQuery.browser.version) == 6 && typeof window['XMLHttpRequest'] != "object";
	
	if ( jQuery.browser.safari == true ) jQuery('body').addClass('safari');
	if ( jQuery.browser.msie == true ) jQuery('body').addClass('msie');
	if ( jQuery.browser.msie6 == true ) {
		jQuery('body').addClass('msie6');
		// Fix PNG for IE6
		jQuery('.menu-top-').pngFix( { blankgif:'./images/blank.gif' } );
		jQuery('.logo-container-').pngFix( { blankgif:'./images/blank.gif' } );
		jQuery('.header-').pngFix( { blankgif:'./images/blank.gif' } );		
	}
	
	if( jQuery.browser.msie && parseFloat( jQuery.browser.version ) < 7) {
		jQuery('body').addClass('msie-depreciated');
	}
	
	var thewindowwidth = jQuery(window).width();
	if ( jQuery.browser.msie6 != true ) the_resize(thewindowwidth);

});

jQuery(function() {
	
	// Set classes for windo resizing.
	jQuery(window).resize(function() {
		var thewindowwidth = jQuery(window).width();
		if ( jQuery.browser.msie6 != true ) the_resize(thewindowwidth);
	});

	// Load Nicholls menus via ajax
	function nicholls_menu_loader() {
	
		jQuery('#footer').append( '<div id="nicholls-menu-loader"></div>' );
		
		jQuery('#nicholls-menu-list').children().each( function() {
			// We stop if the item has no menu. Using the .each() using 'return true' is like 'continue'
			if ( jQuery(this).hasClass('nicholls-menu-no' ) ) return true;
		    
		    // We get the class of the moused over object
			var menu_load_id = jQuery(this).attr('id');

			// Perorm all the heavy lifting ajax because menu_load_id should be clean by now
			var menu_data = jQuery( '#'+menu_load_id+'-source' ).html();

			jQuery('#nicholls-menu-content').append( '<div id="'+menu_load_id+'-contents" class="nicholls-menu-contents">'+menu_data+'</div>' );
		
		});
	
	}
    nicholls_menu_loader();

	var hideDelay = 200;
	var hideTimer = null;
	
	var hideFunction = function() {
		if (hideTimer) clearTimeout(hideTimer);
		hideTimer = setTimeout( function() {
			// We get the class of the moused over object
			var menu_loader_id = jQuery('.nicholls-menu-selected').attr('id');
			var nicholls_menu = jQuery( '#'+menu_loader_id+'-contents' );
			// Get the real menu id
						
			// On hovering out slide subnav menus back up
			jQuery('#nicholls-menu-content-wrapper').slideUp(200);
			jQuery( '.nicholls-menu-selected' ).removeClass('nicholls-menu-selected');
			jQuery('#nicholls-menu-content-container').removeClass( menu_loader_id + '-container' );
			jQuery('#nicholls-menu-content-wrapper').removeClass('nicholls-menu-content-wrapper-open');	
			nicholls_menu.css('display', 'none');
		}, hideDelay);
	};


	jQuery('#menu-primary .nicholls-menu-item').live('mouseover', function() {
		// We get the class of the moused over object
		var menu_loader_id = jQuery(this).attr('id');
		
		// We test to make sure that the data we hover over is not some other menu
		if ( jQuery(this).data('hoverIntentAttached') != menu_loader_id ) {
			
			// We save the current hovered over menu as data
			jQuery(this).data('hoverIntentAttached', menu_loader_id);
			jQuery(this).hoverIntent(
				// hoverIntent mouseOver
				function() {
					if (hideTimer) clearTimeout(hideTimer);
			
					var nicholls_menu = jQuery( '#'+menu_loader_id+'-contents' );
								
					if ( !menu_loader_id ) return;
					// We stop if the item has no menu
					if ( jQuery(this).hasClass('nicholls-menu-no' ) ) return;
					if ( jQuery('#nicholls-menu-content-wrapper').hasClass('nicholls-menu-content-wrapper-open') ) return;
						
					// Perorm all the heavy lifting ajax because this_id should be clean by now
					
					jQuery( '#' + menu_loader_id ).addClass('nicholls-menu-selected');
					jQuery( '#nicholls-menu-content-container' ).addClass( menu_loader_id + '-container' );
					jQuery('#nicholls-menu-content-wrapper').addClass('nicholls-menu-content-wrapper-open');
					nicholls_menu.css('display', 'block');
					jQuery('#nicholls-menu-content-wrapper').slideDown(400);
				},
				// hoverIntent mouseOut
				hideFunction
			);
			// Fire mouseover so hoverIntent can start doing its magic
			jQuery(this).trigger('mouseover');
		}
	});

	// Allow mouse over of details without hiding details
	jQuery('#nicholls-menu-content-container').mouseover(function() {
		if (hideTimer) clearTimeout(hideTimer);
	});

	// Hide after mouseout
	jQuery('#nicholls-menu-content-container').mouseout( hideFunction );
	
	// Hide on click
	jQuery('.nicholls-menu-item-link').click( hideFunction );

});

