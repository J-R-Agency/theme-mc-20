<?php
/**
 * Template Name: Helpful Stuff Template
 *
 * Template for displaying a page just with the header and footer area and a "naked" content area in between.
 * Good for landingpages and other types of pages where you want to add a lot of custom markup.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$bw = 'black';
$page_color = 'pink';
$header_position = get_field('header_position');

include( locate_template( 'header.php', false, false ) );  ?>


<!-- BLOG POSTS -->
<?php include (get_template_directory().'/global-templates/template-parts/helpful-stuff-blog.php'); ?>

<!-- BLOG CATEGORIES -->
<?php include (get_template_directory().'/global-templates/template-parts/helpful-stuff-categories.php'); ?>

<!-- FREE DOWNLOADS -->

<section class='generic bg-white'>
	<h2>Free <span class='underline-green-1'>Downloads</span></h2>
	<p class='hs-subtitle'>Essential Digital Marketing Resources</p>
	<div class='downloads-container'>
		<?php include (get_template_directory().'/global-templates/template-parts/downloads-card.php'); ?>
	</div>
</section>

<?php include( locate_template( 'footer.php', false, false ) ); ?>

<script>
	(function ($) {
		$("#tab-masterclasses").closest('li').remove();
		$("#tab-female-founders ").closest('li').remove();
		$("#tab-full-service ").closest('li').remove();
	})(jQuery);
</script>
