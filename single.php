<?php
/**
 * The template for displaying all single posts
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
		
		<a class='take-back' href="javascript:history.back()">Take me back</a>
		
		<?php
		while ( have_posts() ) {
			the_post();
			get_template_part( 'loop-templates/content', 'single' );
		}
		?>

	</main><!-- #main -->
</section>

<?php
get_footer();
