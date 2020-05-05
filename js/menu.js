( function( $ ) {
	
$(document).ready(function() {

	// Hide menu and close button on start
	$( "#mega-menu" ).hide();
	$( ".close" ).hide();
	
	// Hover over hamburger to show menu
	$( ".hamburger" ).hover(function() {
		$( "#mega-menu" ).slideToggle( "slow", function() {
			$( ".close" ).show();
			$( ".hamburger" ).hide();
		});
	});
	
	// Click close to hide menu
	$( ".close" ).click(function() {
		$( "#mega-menu" ).slideToggle( "slow", function() {
			$( ".close" ).hide();
			$( ".hamburger" ).show();
		});
	});
});
	
} )( jQuery );