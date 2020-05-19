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
	<div class='case-studies-header'>
		<h2>More Inspiring Stories</h2>
		<?php
			echo '<ul class="nav nav-tabs cs-categories-list" role="tablist">
		    		<li>
		                <a class="active" href="#all" role="tab" data-toggle="tab">All</a>
		            </li>
		    
		    ';
		    $args = array(
		        'orderby' => 'name',
		        'order' => 'ASC'
		    );
		    $categories = get_categories($args);
		    foreach($categories as $category) { 
		        echo 
		            '<li>
		                <a href="#'.$category->slug.'" data-toggle="tab">    
		                    '.$category->name.'
		                </a>
		            </li>';
		    }
		    echo '</ul>';
		?>
	</div>
	<div class='case-studies-container'>		
		<?php
		    
		
		    echo '<div class="tab-content">';
		    
		    echo "<div class='tab-pane active' id='all'>
		    		<div class='case-studies-container'>
		    ";
		    
		        $pageSlug = get_page_by_path( 'our-work' );
								
				$args = array(
				    'post_type'      => 'page', //write slug of post type
				    'posts_per_page' => 6,
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
		        
		    echo "</div>
		    </div>";
		    
		    foreach($categories as $category) { 
		        echo "<div class='tab-pane' id='". $category->slug."'>
		        		<div class='case-studies-container'>
		        ";
				$pageSlug = get_page_by_path( 'our-work' );
								
				$args = array(
				    'post_type'      => 'page', //write slug of post type
				    'posts_per_page' => 6,
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
				wp_reset_query();	
				
		        echo '</div>
		        </div>';
		    } 
		    echo '</div>';
		?>		
	</div>
	
	<!-- Pagination -->
	<div class="row">
		<div class="col-12">
			<?php understrap_pagination(); ?>
		</div>
	</div>
	
</section>

<?php include( locate_template( 'footer.php', false, false ) ); ?>
