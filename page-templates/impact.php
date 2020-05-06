<?php
/**
 * Template Name: Impact Template
 *
 * Template for displaying a page just with the header and footer area and a "naked" content area in between.
 * Good for landingpages and other types of pages where you want to add a lot of custom markup.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$bw = 'black';
$page_color = 'yellow';
$header_position = get_field('header_position');

include( locate_template( 'header.php', false, false ) );  ?>

<?php the_title(); ?>

<?php get_footer(); ?>
