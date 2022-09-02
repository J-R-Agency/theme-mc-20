<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<section class='footer bg-navy'>
	<div class='container footer-container'>
		<div class='footer-container-left'>
			<?php //include(get_template_directory() . '/global-templates/template-parts/mailchimp-signup.php'); ?>
			<?php
				/*wp_nav_menu(
					array(
						'theme_location'  => 'secondary-footer-menu'
					)
				);*/
			?>
			
			<?php
				if( have_rows('company_badges', 'options') ):
					
					echo "<div class='company-badges'>";
					
				    while( have_rows('company_badges', 'options') ) : the_row();
				
				        $badge_image = get_sub_field('badge_image', 'options');
				        $badge_link = get_sub_field('badge_link', 'options');
						
						if ($badge_link) {
							echo "<a class='company-badge' href='".$badge_link['url']."' target='".$badge_link['target']."'>";
						}
						echo "<img src='".$badge_image['url']."' alt='".$badge_image['alt']."'>";
						
						if ($badge_link) {
							echo "</a>";	
						}
				
				    endwhile;
				    
				    echo "</div>";
				    
				endif;				
			?>
			
		</div>
		
		<div class='footer-container-center'>
			<!-- Logo -->
			<div class='site-logo'>
				<a href="<?php echo get_site_url(); ?>">
					<!-- Regular logo -->
					<img class="logo"
					src="<?php echo get_template_directory_uri(); ?>/assets/logos/logo-white-<?php echo $page_color; ?>.png"
					alt="Matchstick Creative Logo">
				</a>
			</div>
			
			<!-- Social media -->
			<div class='footer-social-media'>
				<?php include(get_template_directory() . '/global-templates/template-parts/social-media-footer.php'); ?>
			</div>
			
			<a href='tel:<?php the_field('company_phone', 'option'); ?>'>
				<h5 class='phone'><?php the_field('company_phone', 'option'); ?></h5>
			</a>
			<a href='mailto:<?php the_field('company_email', 'option'); ?>'>
				<h5 class='email'><?php the_field('company_email', 'option'); ?></h5>
			</a>	
		</div>
		
		<div class='footer-container-right'>
			<div class='footer-info'>
				<?php the_field('company_address', 'option'); ?>
			</div>
			
			<!-- Privacy Policy and Legal -->
			<div class='legal-pages'>
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'footer-menu'
					)
				);
				?>	
			</div>		
				
			<div class='company-no'>
				<span>Co No: <?php echo the_field('company_number', 'option');?></span>
			</div>
			
			<div class='vat-no'>
				<span>VAT No: <?php echo the_field('vat_number', 'option');?></span>
			</div>
						
		</div>
	</div>
</section>

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

