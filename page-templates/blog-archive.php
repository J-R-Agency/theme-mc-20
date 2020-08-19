<?php
/**
 * Template Name: Blog Archive Template
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
$header_position = 'relative';

include( locate_template( 'header.php', false, false ) ); ?>

<section class="generic bg-white">
	
	<a class='take-back' href="javascript:history.back()">Take me back</a>
	
	<h1>Blog Posts</h1>
	
	<?php
		//$masterclasses = get_cat_ID('masterclasses');
    	//$female_founders = get_cat_ID('female founders');
    	//$excluded_cats = array( $masterclasses, $female_founders );
    	
		$args = array(
		    'post_type'      => 'post', //write slug of post type
		    'posts_per_page' => 6,
		    'order'          => 'DESC',
		    'post_status'	 => 'publish',
		    //'category__not_in' => $excluded_cats,
		    'paged' => ( get_query_var('paged') ? get_query_var('paged') : 0)
		 );
		 
		$query = new WP_Query( $args );
		$wp_query = $query;
		 
		if ( $query->have_posts() ) :
		 
		    while ( $query->have_posts() ) : $query->the_post();
			 	
				$card_color = 'light-grey';
				$categories = get_the_category();
				
				include (get_template_directory().'/global-templates/template-parts/blog-card.php');	
				
				
			endwhile;
			
		endif; 
		wp_reset_postdata();
	?>
	
	<div class='understrap-pagination'>
		<?php understrap_pagination(); ?>
	</div>
	
</section>

<?php include( locate_template( 'footer.php', false, false ) ); ?>