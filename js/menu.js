( function( $ ) {

	// Hide menu and close button on start
	$( "#mega-menu" ).hide();
	$( ".close-menu" ).hide();
	$( ".logo-mini" ).hide();
	
$(document).ready(function() {

	
	// Click on hamburger to show menu
	$( ".hamburger" ).click(function() {
		$( "#wrapper-navbar" ).css("background-color","#F5F5F5");
		$( ".logo" ).hide("fast");
		$( ".logo-mini" ).show("fast");
		$( ".menu-container" ).show();
		$( "#main-nav" ).css("position","relative");
		$('html').animate({ scrollTop: 0 }, 'medium');
		$('body').animate({ scrollTop: 0 }, 'medium');
		
		$( "#mega-menu" ).slideDown( "slow", function() {
			$( ".close-menu" ).show();
			$( ".hamburger" ).hide();
			
		});
	});
	
	// Click close to hide menu
	$( ".close-menu" ).click(function() {
		$( "#mega-menu" ).slideUp( "slow", function() {
			$( ".close-menu" ).hide();
			$( ".hamburger" ).show();
			$( "#wrapper-navbar" ).css("background-color","transparent");
					$( ".logo" ).show("fast");
			$( ".logo-mini" ).hide("fast");
			$( ".menu-container" ).hide();
			$( "#main-nav" ).css("position", $('#header_pos').val());
		});
	});
});
	
} )( jQuery );