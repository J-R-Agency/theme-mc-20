<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-PTLSF8G');</script>
	<!-- End Google Tag Manager -->

	<!-- Other scripts -->
	<?php the_field('other_scripts', 'option'); ?>
	<!-- Lottie animations -->
	<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PTLSF8G"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<?php do_action( 'wp_body_open' ); ?>

<?php
	$header_style = get_field('header_style');

	if (!$page_color) { $page_color = pink; }

	if($header_style == 'transparent-light') {
		$bw = 'white';
	} else {
		$bw = 'black';
	}
?>

<div class="site color-scheme-<?php echo $page_color; ?>" id="page">
	
	<input type="hidden" id="header_pos" value="<?php echo $header_position; ?>">
	
	<!-- ******************* The Navbar Area ******************* -->
	<div id="wrapper-navbar">

		<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'understrap' ); ?></a>

		<nav id="main-nav" class="navbar navbar-expand-lg navbar-dark navbar--<?php echo $header_style; ?> navbar--<?php echo $header_position; ?>" aria-labelledby="main-nav-label">

			<h2 id="main-nav-label" class="sr-only">
				<?php esc_html_e( 'Main Navigation', 'understrap' ); ?>
			</h2>
		
			<!-- Top Menu -->
			<div class='navbar--large'>
				<div class='navbar__top'>
					<div class="container">
						
						<!-- Your site title as branding in the menu --> 
						<div class='navbar__site-logo'>
							<a href="<?php echo get_site_url(); ?>">

								<!-- Regular logo -->
								<img class="logo"
								src="<?php echo get_template_directory_uri(); ?>
								/assets/logos/logo-<?php echo $bw; ?>-<?php echo $page_color; ?>.png"
								alt="Matchstick Creative Logo">
								
							</a>
						</div>

						<!-- Header Info -->
						<?php include( locate_template( 'global-templates/template-parts/header-info.php', false, false ) ); ?>

					</div> <!-- .container -->
				</div>

				<!-- Navigation menu (bottom) -->
				<div class='navbar--<?php echo $page_color; ?> navbar__bottom'>
								
					<!-- Main Menu -->
					<div class='container'>
						<?php
						wp_nav_menu(
							array(
								'theme_location'  => 'primary',
								'add_li_class'    => 'menu-item--' . $page_color,
							)
						);
						?>
					</div>
									
				</div> <!-- end navbar__bottom -->
			</div>

			<div class='navbar--small'>
				<div class='container'>

					<!-- Your site title as branding in the menu --> 
					<div class='navbar__site-logo'>
						<a href="<?php echo get_site_url(); ?>">

							<!-- Regular logo -->
							<img class="logo"
							src="<?php echo get_template_directory_uri(); ?>
							/assets/logos/logo-<?php echo $bw; ?>-<?php echo $page_color; ?>.png"
							alt="Matchstick Creative Logo">
							
						</a>
					</div>

					<!-- Hamburger -->
					<button class="hamburger" id="toggle-button" type="button">
						<img class='navbar__burger' src="<?php echo get_template_directory_uri(); ?>
							/assets/menu/<?php echo $bw; ?>-menu-burger-<?php echo $page_color; ?>.png">
					</button>

					<!-- MOBILE NAV -->
					<div class='navbar--mobile'>
						<div class='container'>

							<!-- Main Menu -->
								<?php
								wp_nav_menu(
									array(
										'theme_location'  => 'primary',
									)
								);
								?>

								<!-- Header Info -->
								<?php include( locate_template( 'global-templates/template-parts/header-info.php', false, false ) ); ?>
						</div>
					</div> <!-- End mobile nav-->

				</div>
			</div>
			


		</nav><!-- .site-navigation -->

			<!-- HERO -->
			<?php include( locate_template( 'global-templates/template-parts/hero.php', false, false ) ); ?>
	</div><!-- #wrapper-navbar end -->
