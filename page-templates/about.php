<?php
/**
 * Template Name: About Template
 *
 * Template for displaying a page just with the header and footer area and a "naked" content area in between.
 * Good for landingpages and other types of pages where you want to add a lot of custom markup.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$bw = 'white';
$page_color = 'green';
$header_position = 'absolute';

include( locate_template( 'header.php', false, false ) );  ?>

<input type="hidden" id="header_pos" value="<?php echo $header_position; ?>">

<?php the_title(); ?>

<?php get_footer(); ?>
