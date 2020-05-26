<?php
/**
 * Template Name: Helpful Stuff Template
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


<!-- BLOG POSTS -->
<section class="generic bg-white">
	<?php include_once (get_template_directory() . '/global-templates/template-parts/blog-tabs.php'); ?>
	<div class='blog-posts-container'>		
		<?php
		    echo '<div class="tab-content">';
		    
		    echo "<div class='tab-pane active' id='all'>
		    		<div class='blog-posts-container all'>
		    ";
		    								
				$args = array(
				    'post_type'      => 'post', //write slug of post type
				    'posts_per_page' => 2,
				    'order'          => 'DESC'
				 );
				 
				$query = new WP_Query( $args );
				 
				if ( $query->have_posts() ) :
				 
				    while ( $query->have_posts() ) : $query->the_post();
					 	
						$card_color = 'light-grey';
						$categories = get_the_category();
						
						include (get_template_directory().'/global-templates/template-parts/blog-card.php');	
					
					endwhile;
					
				endif; 
				wp_reset_query();
		        
		    echo "</div>
		    </div>";
		    
		    
		    $args = array(
		        'orderby' => 'name',
		        'order' => 'ASC'
		    );
		    $categories = get_categories($args);
		    
		    foreach($categories as $category) {
		        echo "<div class='tab-pane' id='". $category->slug."'>
		        		<div class='blog-posts-container bpc-".$category->slug."'>
		        ";
		        
		        $args = array(
				    'post_type'      => 'post', //write slug of post type
				    'posts_per_page' => 2,
				    'order'          => 'DESC',
				    'category_name' => $category->slug,
				 );
				 
				$query = new WP_Query( $args );
				 
				if ( $query->have_posts() ) :
				 
				    while ( $query->have_posts() ) : $query->the_post();
					 	
						$card_color = 'light-grey';
						$categories = get_the_category();
						
						include (get_template_directory().'/global-templates/template-parts/blog-card.php');	
						
					endwhile;
				endif;
				
				echo "</div>"; // End bpc
								
				wp_reset_query();	
				
		        
		        echo "</div>"; // End container
		    }
		    
		    echo "</div>"; // End tab pane
		?>		
	</div>
	
</section>

<section class='link-block bg-light-grey'>
	<a href='<?php echo site_url();?>/helpful-stuff'>Read more blogs<div class='arrow-link-pink'></div></a>
</section>


<?php include( locate_template( 'footer.php', false, false ) ); ?>

<script>
	(function ($) {
		$("#tab-masterclasses").closest('li').remove();
		$("#tab-female-founders ").closest('li').remove();
	})(jQuery);
</script>
