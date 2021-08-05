<?php
/**
 * The template for displaying all eventbrite events
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$bw = 'black';
$page_color = 'pink';
$header_position = get_field('header_position');

include( locate_template( 'header.php', false, false ) ); 
?>


<section class="generic bg-white">
	
	<main class="site-main" id="main">

		<?php
		while ( have_posts() ) {
			the_post();
			get_template_part( 'loop-templates/content', 'single' );
		}
		?>

	</main><!-- #main -->
</section>



<script>
	(function ($) {
		$(".hero-filter").remove();
		$(".hero").remove();
		$(".sd-content").append("<img class='share-icon' src='<?=get_template_directory_uri()?>/assets/social-media/share-icon.png'>");
	})(jQuery); 
</script>

<?php include( locate_template( 'footer.php', false, false ) ); ?>
