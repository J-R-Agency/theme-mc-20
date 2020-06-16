<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$bw = 'black';
$page_color = 'pink';
$header_position = get_field('header_position');

include( locate_template( 'header.php', false, false ) );  ?>

<section class='generic bg-white'>
	<h1>404 - Missing Page</h1>
	<p>Sorry, this page does not exist!</p>
	<p><a href="<?php echo get_home_url(); ?>">Click here to go to the homepage.</a></p>
</section>	

<?php include( locate_template( 'footer.php', false, false ) ); ?>
