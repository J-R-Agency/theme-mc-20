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
	        'category__in'   => wp_get_post_categories( $post->ID ),
	        'post__not_in'   => array( $post->ID )
	 );
	 
	$categories = get_categories($args);
?>

<!-- CASE STUDIES -->
<section class="generic bg-white">
	<?php include_once (get_template_directory() . '/global-templates/template-parts/case-study-tabs.php'); ?>
	<div class='case-studies-container'>		
		<?php
		    echo '<div class="tab-content">';
		    
		    echo "<div class='tab-pane active' id='all'>
		    		<div class='case-studies-container all'>
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
					 	
						$cs_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
						$categories = get_the_category();
						
						include (get_template_directory().'/global-templates/template-parts/case-study-card.php');	
					
					endwhile;
					
				endif; 
				wp_reset_query();
		        
		    echo "
		    
		    	</div>
		    	<div class='cs-pagination pagination-large'>
			        <ul class='pager-all'></ul>
			    </div>
		    </div>";
		    
		    foreach($categories as $category) { 
		        echo "<div class='tab-pane' id='". $category->slug."'>
		        		<div>
		        		<div class='cs-pagination pagination-large pagination-".$category->slug."'>
			        		<ul class='pager-".$category->slug."'></ul>
						</div>
		        </div>
		        			<div class='case-studies-container csc-".$category->slug."'>
		        ";
		        
				$pageSlug = get_page_by_path( 'our-work' );
								
				$args = array(
				    'post_type'      => 'page', //write slug of post type
				    'posts_per_page' => -1,
				    'post_parent'    => $pageSlug->ID, //place here id of your parent page
				    'order'          => 'DESC',
				    'category_name' => $category->slug,
				    'paged' => ( get_query_var('paged') ? get_query_var('paged') : 0)
				 );
				 
				$children = new WP_Query( $args );
				 
				if ( $children->have_posts() ) :
				 
				    while ( $children->have_posts() ) : $children->the_post();
					 	
						$cs_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
						$categories = get_the_category();
						
						include (get_template_directory().'/global-templates/template-parts/case-study-card.php');	
						
					endwhile;
				endif;
				
				echo "</div>"; // End csc
				
				echo "";
				
				wp_reset_query();	
				
		        
		        echo "</div>"; // End container
		    }
		    
		    echo "</div>"; // End tab pane
		?>		
	</div>
	
</section>

<?php include( locate_template( 'footer.php', false, false ) ); ?>
