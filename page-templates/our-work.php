<?php
/**
 * Template Name: Our Work Template
 *
 * Template for displaying a page just with the header and footer area and a "naked" content area in between.
 * Good for landingpages and other types of pages where you want to add a lot of custom markup.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$bw = 'white';
$page_color = 'pink';
$header_position = get_field('header_position');

include( locate_template( 'header.php', false, false ) );  ?>

<?php include( locate_template( 'loop-templates/content-flexible.php', false, false ) );  ?>

<!-- CASE STUDIES -->
<section id='case-studies-list' class="generic bg-white">
	<?php include_once (get_template_directory() . '/global-templates/template-parts/case-study-tabs.php'); ?>
	<div class='container'>		
		<?php
		    echo '<div class="tab-content">';
		    
		    //----------------//
		    //------ALL------//
		    //--------------//
		    echo "<div class='tab-pane active' id='all'>
		    		<div class='small-card-container all'>
		    ";
		    
								
				$args = array(
				    'post_type'      => 'case-studies', //write slug of post type
				    'posts_per_page' => -1,
				    'order'          => 'DESC',
				    'post_parent' => 0,
				    'paged' => ( get_query_var('paged') ? get_query_var('paged') : 0)
				 );
				 
				$catPosts = new WP_Query( $args );
				 
				if ( $catPosts->have_posts() ) :
				 
				    while ( $catPosts->have_posts() ) : $catPosts->the_post();
					 	
						$cs_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' )[0];
						$categories = get_the_terms( $post->ID, 'case-study-category' );
						
						include (get_template_directory().'/global-templates/template-parts/case-study-card.php');	
					
					endwhile;
					
				endif; 
				wp_reset_query();
		        
		    echo "
		    
		    	</div>
		    	<div class='cs-pagination pagination-large'>
			        <ul class='pager-all' curr='0'></ul>
			    </div>
		    </div>";

		    //-----------------//
		    //---CATEGORIES---//
		    //---------------//

		    $categories = get_terms(['taxonomy' => 'case-study-category', 'hide_empty' => false,]);
		    
		    foreach($categories as $category) { 
		        echo "
		        	<div class='tab-pane' id='". $category->slug."'>
			        	<div class='cs-pagination pagination-large pagination-".$category->slug."'>
			        		<ul class='pager-".$category->slug."' curr='0'></ul>
						</div>		
	        		<div class='small-card-container csc-".$category->slug."'>
		        ";
		        
								
				$args = array(
				    'post_type'      => 'case-studies', //write slug of post type
				    'posts_per_page' => -1,
				    'order'          => 'DESC',
				    'post_parent' => 0,
				    'tax_query' => array(
				        array (
				            'taxonomy' => 'case-study-category',
				            'field' => 'slug',
				            'terms' => $category->slug,
				        )
				    ),
				    'paged' => ( get_query_var('paged') ? get_query_var('paged') : 0)
				 );
				 
				$catPosts = new WP_Query( $args );
				 
				if ( $catPosts->have_posts() ) :
				 
				    while ( $catPosts->have_posts() ) : $catPosts->the_post();
					 	
						$cs_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' )[0];
						$categories = get_the_terms( $post->ID, 'case-study-category' );
						
						include (get_template_directory().'/global-templates/template-parts/case-study-card.php');	
						
					endwhile;
					
				endif;
				
				echo "</div>";
				
				wp_reset_query();	
				
		        echo "</div>"; // End container
		    }
		    
		    echo "</div>"; // End tab pane
		?>		
	</div>
	
</section>

<?php include( locate_template( 'footer.php', false, false ) ); ?>
