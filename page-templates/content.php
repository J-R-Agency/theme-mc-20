<?php
/**
 * Template Name: Service Nav Template
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
	
	<?php
		
	$currentID = get_the_ID();
		
	$args = array(
	    'post_type'      => 'page', //write slug of post type
	    'posts_per_page' => -1,
	    'post_parent'    => $post->ID, //place here id of your parent page
	    'order'          => 'ASC'
	 );
	 
	$children = new WP_Query( $args );
	 
	if ( $children->have_posts() ) :
	 	echo "
	 	<section class='generic bg-light-grey'>
	 		<div class='container icon-set-container service-nav-page'>";
	    while ( $children->have_posts() ) : $children->the_post();
		 	
		 	$page_icon = get_field('page_icon');
		 	
		 	echo "
			 	<div class='icon-set-wrapper three-columns'>
			 		<a href='",the_permalink(),"'>
			 	";
			 	if ($page_icon) {
				 	echo "<img class='medium' src='".$page_icon['url']."' alt='".$page_icon['alt']."'>";
			 	} else {
				 	echo "<img class='medium' src='".get_template_directory_uri()."/assets/graphics/placeholder-icon.png'>";
			 	}
			 	the_title("<h5>","</h5>");
			 	
			 	echo "</a>
		 	</div>";
		
		endwhile;
		echo "</div>
		</section>";
	endif; 
	wp_reset_query();	
	
	?>

<?php include( locate_template( 'loop-templates/content-flexible.php', false, false ) );  ?>

<?php include( locate_template( 'footer.php', false, false ) ); ?>
