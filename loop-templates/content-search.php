<?php
/**
 * Search results partial template
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<?php
		 	
	$card_color = 'light-grey';
	$categories = get_the_category();

	include (get_template_directory().'/global-templates/template-parts/blog-card-large.php');	

	
?>
