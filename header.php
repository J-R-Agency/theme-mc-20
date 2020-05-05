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
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">

	<!-- ******************* The Navbar Area ******************* -->
	<div id="wrapper-navbar">

		<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'understrap' ); ?></a>

		<nav id="main-nav" class="navbar navbar-expand-md navbar-dark bg-primary" aria-labelledby="main-nav-label">

			<h2 id="main-nav-label" class="sr-only">
				<?php esc_html_e( 'Main Navigation', 'understrap' ); ?>
			</h2>

		<?php if ( 'container' === $container ) : ?>
			<div class="container">
		<?php endif; ?>

			<!-- Your site title as branding in the menu --> 
			<div class='site-logo'>
				<a href="<?php echo get_site_url(); ?>">
					<img class="logo-<?php echo $bw; ?>-<?php echo $page_color; ?>"
					src="<?php echo get_template_directory_uri(); ?>
					/assets/logos/logo-<?php echo $bw; ?>-<?php echo $page_color; ?>.png"
					alt="Matchstick Creative Logo">
				</a>
			</div>		
			
			<button class="hamburger" type="button">
				<img class='menu-burger-<?php echo $page_color; ?>' src="<?php echo get_template_directory_uri(); ?>
					/assets/menu/menu-burger-<?php echo $page_color; ?>.png">
			</button>
			<button class="close" type="button">
				<img class='menu-close-<?php echo $page_color; ?>' src="<?php echo get_template_directory_uri(); ?>
					/assets/menu/menu-close-<?php echo $page_color; ?>.png">
			</button>

			<?php if ( 'container' === $container ) : ?>
			</div><!-- .container -->
			<?php endif; ?>
			
		</nav><!-- .site-navigation -->
			<div id='mega-menu'>
						<!-- The WordPress Menu goes here -->
						<?php
						wp_nav_menu(
							array(
								'theme_location'  => 'primary',
								'fallback_cb'     => '',
								'menu_id'         => 'main-menu',
								'depth'           => 2,
								'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
							)
						);
						?>
			</div>
	</div><!-- #wrapper-navbar end -->
