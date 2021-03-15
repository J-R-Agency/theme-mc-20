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
	<!-- Google Analytics -->
	<?php the_field('google_analytics_script', 'option'); ?>
	<!-- Other scripts -->
	<?php the_field('other_scripts', 'option'); ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">
	
	<input type="hidden" id="header_pos" value="<?php echo $header_position; ?>">
	
	<!-- ******************* The Navbar Area ******************* -->
	<div id="wrapper-navbar">

		<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'understrap' ); ?></a>

		<nav id="main-nav" class="navbar navbar-expand-md navbar-dark <?php the_field('header_style')?> <?php echo $header_position; ?>" aria-labelledby="main-nav-label">

			<h2 id="main-nav-label" class="sr-only">
				<?php esc_html_e( 'Main Navigation', 'understrap' ); ?>
			</h2>
		
			<div class="container">
				
				<!-- Your site title as branding in the menu --> 
				<div class='site-logo'>
					<a href="<?php echo get_site_url(); ?>">
						<!-- Regular logo -->
						<img class="logo"
						src="<?php echo get_template_directory_uri(); ?>
						/assets/logos/logo-<?php echo $bw; ?>-<?php echo $page_color; ?>.png"
						alt="Matchstick Creative Logo">
						
						<!-- Mini logo -->
						<img class="logo-mini"
						src="<?php echo get_template_directory_uri(); ?>
						/assets/logos/logo-mini-<?php echo $page_color; ?>.png"
						alt="Matchstick Creative Logo">
					</a>
				</div>		
				
				<!-- Hamburger -->
				<button class="hamburger" type="button">
					<img class='menu-burger' src="<?php echo get_template_directory_uri(); ?>
						/assets/menu/menu-burger-<?php echo $page_color; ?>.png">
				</button>
				
				<!-- Close button -->
				<button class="close-menu" type="button">
					<img class='menu-close' src="<?php echo get_template_directory_uri(); ?>
						/assets/menu/menu-close-<?php echo $page_color; ?>.png">
				</button>
			
			</div><!-- .container -->
			
		</nav><!-- .site-navigation -->
			<div id='mega-menu' class='container mega-menu-<?php echo $page_color; ?>'>
				
				<div class='menu-container'>
					
					<div class='menu-container-left'>
						<!-- Main Menu -->
						<?php
						wp_nav_menu(
							array(
								'theme_location'  => 'primary',
								'menu_id'         => 'main-menu-'.$page_color,
								'link_before'	  => '<span class="menu-icon"></span>',
							)
						);
						?>

					</div>
					
					<div class='menu-container-center'>

						<!-- Highlight Menu -->
						<?php
						wp_nav_menu(
							array(
								'theme_location'  => 'highlight-menu',
								'menu_id'         => 'highlight-menu-'.$page_color,
							)
						);
						?>
						
					</div>
					
					<div class='menu-container-right'>

						<!-- Secondary Menu -->
						<?php
						wp_nav_menu(
							array(
								'theme_location'  => 'secondary-menu',
								'menu_id'         => 'secondary-menu-'.$page_color,
							)
						);
						?>
						
					</div>
					
				</div> <!-- end menu-container -->
				
				<div class='header-info'>
					<a class='header-phone-number' href='tel:<?php the_field('company_phone', 'option'); ?>'>
						<h5><?php the_field('company_phone', 'option'); ?></h5>
					</a>
					<a class='header-email' href='mailto:<?php the_field('company_email', 'option'); ?>'>
						<h5><?php the_field('company_email', 'option'); ?></h5>
					</a>
					<div class='header-social-media' style="background-image:url('<?php echo get_template_directory_uri();?>/assets/graphics/header-sm-bg-<?php echo $page_color;?>.png');">
						<?php include(get_template_directory() . '/global-templates/template-parts/social-media.php'); ?>
					</div>						
					
				</div>				
			</div> <!-- end $mega-menu -->
			<?php include( locate_template( 'global-templates/template-parts/hero.php', false, false ) ); ?>
	</div><!-- #wrapper-navbar end -->
