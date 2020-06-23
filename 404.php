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

<section class='generic bg-white' style='text-align: center;'>
	<h1>404</h1>
	<?php echo the_field('404_page_content','option')?>
</section>	

<?php include( locate_template( 'footer.php', false, false ) ); ?>
