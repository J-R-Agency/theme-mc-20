( function( $ ) {
	
	$(document).ready(function() {

		// Hide menu and close button on start
		$('.navbar--mobile').hide();

		/* MOBILE MENU TOGGLE */
		
		$('.nav-mobile > .menu-item-has-children > .sub-menu').hide();

		// Show arrow after menu links with submenus
		$('.nav-mobile > .menu-item-has-children').click(function() {
			$('> .sub-menu', this).toggle();
		});

		$('#toggle-button').click(function() {
			$('.navbar--mobile').toggle();
			$('#main-nav').toggleClass('navbar--mobile-expanded');
		});

		var showSubMenu = function() {
			$('.menu-item-has-children').toggleClass('show-sub-menu');

			if($(this).hasClass("show-sub-menu")) {
				$('> .sub-menu', this).addClass('submenu-visible');
			} else {
				$('> .sub-menu', this).removeClass('submenu-visible');
			}
		}

		$('.menu-item-has-children').click(showSubMenu);

		// Click on hamburger to show menu
		// $( ".hamburger" ).click(function() {
		// 	$( "#wrapper-navbar" ).css("background-color","#F5F5F5");
		// 	$( ".logo" ).hide("fast");
		// 	$( ".logo-mini" ).show("fast");
		// 	$( ".menu-container" ).show();
		// 	$( "#main-nav" ).css("position","relative");
		// 	$('html').animate({ scrollTop: 0 }, 'medium');
		// 	$('body').animate({ scrollTop: 0 }, 'medium');
			
		// 	$( "#mega-menu" ).slideDown( "slow", function() {
		// 		$( ".close-menu" ).show();
		// 		$( ".hamburger" ).hide();
				
		// 	});
		// });
		
		// // Click close to hide menu
		// $( ".close-menu" ).click(function() {
		// 	$( "#mega-menu" ).slideUp( "slow", function() {
		// 		$( ".close-menu" ).hide();
		// 		$( ".hamburger" ).show();
		// 		$( "#wrapper-navbar" ).css("background-color","transparent");
		// 				$( ".logo" ).show("fast");
		// 		$( ".logo-mini" ).hide("fast");
		// 		$( ".menu-container" ).hide();
		// 		$( "#main-nav" ).css("position", $('#header_pos').val());
		// 	});
		// });
	});
	
} )( jQuery );