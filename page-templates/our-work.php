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

<?php
	 
	$args = array(
		'taxonomy' => 'category',
		'hide_empty' => 0
	);
	
	$categories = get_categories($args);
	$c_keep = array();
	
	foreach($categories as $category){
			$cat_type = get_field('category_type', 'category_'.$category->term_id);
		if ($cat_type=='case-studies') {
			$c_keep[] = $category;
		}
	}	 
	 
?>

<!-- CASE STUDIES -->
<section class="generic bg-white">
	<?php include_once (get_template_directory() . '/global-templates/template-parts/case-study-tabs.php'); ?>
	<div class='container'>		
		<?php
		    echo '<div class="tab-content">';
		    
		    echo "<div class='tab-pane active' id='all'>
		    		<div class='small-card-container all'>
		    ";
		    
		        $pageSlug = get_page_by_path( 'our-work' );
								
				$args = array(
				    'post_type'      => 'page', //write slug of post type
				    'posts_per_page' => -1,
				    'post_parent'    => $pageSlug->ID, //place here id of your parent page
				    'order'          => 'DESC',
				    'paged' => ( get_query_var('paged') ? get_query_var('paged') : 0)
				 );
				 
				$children = new WP_Query( $args );
				 
				if ( $children->have_posts() ) :
				 
				    while ( $children->have_posts() ) : $children->the_post();
					 	
						$cs_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' )[0];
						$categories = get_the_category();
						
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
		    
		    foreach($c_keep as $category) { 
			    			    
		        echo "
		        	<div class='tab-pane' id='". $category->slug."'>
			        	<div class='cs-pagination pagination-large pagination-".$category->slug."'>
			        		<ul class='pager-".$category->slug."' curr='0'></ul>
						</div>		
	        		<div class='small-card-container csc-".$category->slug."'>
		        ";
		        
				$pageSlug = get_page_by_path( 'our-work' );
								
				$args = array(
				    'post_type'      => 'page', //write slug of post type
				    'posts_per_page' => -1,
				    'post_parent'    => $pageSlug->ID, //place here id of your parent page
				    'order'          => 'DESC',
				    'category_name'  => $category->slug,
				    'paged' => ( get_query_var('paged') ? get_query_var('paged') : 0)
				 );
				 
				$children = new WP_Query( $args );
				 
				if ( $children->have_posts() ) :
				 
				    while ( $children->have_posts() ) : $children->the_post();
					 	
						$cs_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' )[0];
						$categories = get_the_category();
						
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
