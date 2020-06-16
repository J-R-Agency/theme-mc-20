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
	<p class='hs-subtitle'>Be the storyteller everyone listens to </p>
	<div class='blog-posts-container'>		
		<?php
		    echo '<div class="tab-content">';
		    
		    echo "<div class='tab-pane active' id='all'>
		    		<div class='blog-posts-container all'>
		    ";
		    	$masterclasses = get_cat_ID('masterclasses');
		    	$female_founders = get_cat_ID('female founders');
		    	$excluded_cats = array( $masterclasses, $female_founders );
		    	
				$args = array(
				    'post_type'      => 'post', //write slug of post type
				    'posts_per_page' => 2,
				    'order'          => 'DESC',
				    'category__not_in' => $excluded_cats,
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
	<a href='<?php echo site_url();?>/archive'>Read more blogs<div class='arrow-link-pink'></div></a>
</section>

<!-- MASTERCLASS SERIES -->
<section class='generic bg-white'>
	<h2>Masterclass <span class='circle-green-1'>Series</span></h2>
	<p class='hs-subtitle'>Expert guides for non-experts</p>
	
	<div class='case-studies-container'>
	<?php		
		$args = array(
		    'post_type'      => 'post', //write slug of post type
		    'posts_per_page' => 3,
		    'order'          => 'DESC',
		    'category__in'   => $masterclasses
		 );
		 
		$mquery = new WP_Query( $args );
		 
		if ( $mquery->have_posts() ) :
		 
		    while ( $mquery->have_posts() ) : $mquery->the_post();
			 	
				$mc_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
				$hover_color = 'green';
				$categories = get_the_category();
				
				include (get_template_directory().'/global-templates/template-parts/blog-card-small.php');	
			
			endwhile;
		endif; 
		wp_reset_query();						
						
	?>
	</div>
</section>
<section class='link-block bg-light-grey'>
	<a href='<?php echo site_url();?>/category/masterclasses'>Read more masterclasses<div class='arrow-link-green'></div></a>
</section>

<!-- FEMALE FOUNDERS -->
<section class='generic bg-white'>
	<h2>Meet our <span class='underline-cyan-2' style='padding-bottom: 15px;'>#Femalefounders</span></h2>
	<p class='hs-subtitle'>Incredible businesses, organisations and projects run by women</p>
	
	<div class='case-studies-container'>
	<?php		
		$args = array(
		    'post_type'      => 'post', //write slug of post type
		    'posts_per_page' => 3,
		    'order'          => 'DESC',
		    'category__in'   => $female_founders
		 );
		 
		$ffquery = new WP_Query( $args );
		 
		if ( $ffquery->have_posts() ) :
		 
		    while ( $ffquery->have_posts() ) : $ffquery->the_post();
			 	
				$mc_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
				$hover_color = 'cyan';
				$categories = get_the_category();
				
				include (get_template_directory().'/global-templates/template-parts/blog-card-small.php');	
			
			endwhile;
		endif; 
		wp_reset_query();						
						
	?>
	</div>
</section>
<section class='link-block bg-light-grey'>
	<a href='<?php echo site_url();?>/category/female-founders'>Meet more #femalefounders<div class='arrow-link-cyan'></div></a>
</section>


<!-- FREE DOWNLOADS -->

<section class='generic bg-white'>
	<h2>Free <span class='underline-green-1'>Downloads</span></h2>
	<p class='hs-subtitle'>Essential Digital Marketing Resources</p>
	<div class='downloads-container'>
		<?php include (get_template_directory().'/global-templates/template-parts/downloads-card.php'); ?>
	</div>
</section>

<?php include( locate_template( 'footer.php', false, false ) ); ?>

<script>
	(function ($) {
		$("#tab-masterclasses").closest('li').remove();
		$("#tab-female-founders ").closest('li').remove();
		$("#tab-full-service ").closest('li').remove();
	})(jQuery);
</script>
