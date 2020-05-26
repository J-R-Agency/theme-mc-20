<?php
/**
 * Template Name: Content Template
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

<?php include( locate_template( 'loop-templates/content-flexible.php', false, false ) );  ?>

<section class='generic bg-light-grey'>
	<h2 style="text-align: center; padding-bottom: 2rem;">Gotta Love Dat Content</h2>
	<?php
		$content = get_cat_ID('content');
		
		$args = array(
		    'post_type'      => 'post', //write slug of post type
		    'posts_per_page' => 3,
		    'order'          => 'DESC',
		    'category__in'	 => $content
		 );
		 
		 $query = new WP_Query($args);
		 
		if ( $query->have_posts() ) :
		 
		    while ( $query->have_posts() ) : $query->the_post();
			 	
			 	$card_color = 'white';
				$categories = get_the_category();
				
				include (get_template_directory().'/global-templates/template-parts/blog-card.php');	
			
			endwhile;
		endif; 
		wp_reset_query();	
				
	?>	
</section>

<?php include( locate_template( 'footer.php', false, false ) ); ?>
