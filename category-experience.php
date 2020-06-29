<?php /**
 * Template Name: Experience Archive Template
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
	
	<h1>
		<?php foreach((get_the_category()) as $category){
        echo $category->name;
        }	?>
    </h1>
	
	<div class='case-studies-container'>
		<?php
			$experience = get_cat_ID('experience');
			
			$args = array(
			    'post_type'      => 'post', //write slug of post type
			    'posts_per_page' => 6,
			    'order'          => 'DESC',
			    'category__in'   => $experience,
			    'paged'=>( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1
			 );
			 
			$mquery = new WP_Query( $args );
			 
			if ( $mquery->have_posts() ) :
			 
			    while ( $mquery->have_posts() ) : $mquery->the_post();
				 	
					$mc_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
					$hover_color = 'pink';
					$categories = get_the_category();
					
					include (get_template_directory().'/global-templates/template-parts/blog-card-small.php');	
				
				endwhile;
			endif; 
			wp_reset_postdata();						
							
		?>
	</div>
	<div class='understrap-pagination'>
		<?php understrap_pagination(); ?>
	</div>
			
</section>

<?php include( locate_template( 'footer.php', false, false ) ); ?>
