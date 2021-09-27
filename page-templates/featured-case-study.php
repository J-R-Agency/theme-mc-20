<?php
/**
 * Template Name: Featured Case Study Template
 * Template Post Type: case-studies
 *
 * Template for displaying a page just with the header and footer area and a "naked" content area in between.
 * Good for landingpages and other types of pages where you want to add a lot of custom markup.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$bw = 'black';
$page_color = 'green';
$header_position = get_field('header_position');

include( locate_template( 'header.php', false, false ) );  ?>

<!-- Child Pages -->
<?php
	global $post;
	$current_id = $post->ID;

	if($post->post_parent > 0):
		$parentId = wp_get_post_parent_id( get_the_ID() );
		$args = array(
		    'post_parent'    => $parentId,
		    'posts_per_page' => -1,
		    'post_type' => 'case-studies',
		    );
	else:
		$args = array(
		    'post_parent' => $post->ID,
		    'posts_per_page' => -1,
		    'post_type' => 'case-studies',
		    );		
	endif;


	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) :
		echo "<section class='child-case-studies container'>";

		if($post->post_parent > 0):

			$page_icon = get_field('page_icon', $post->post_parent);
			$title = 'Landing Page';
			$permalink = get_the_permalink($post->post_parent);

			include (get_template_directory().'/global-templates/template-parts/child-case-study-card.php');

		endif;

		while ( $the_query->have_posts() ) : $the_query->the_post();
			$page_icon = get_field('page_icon');
			$title = get_the_title();
			$permalink = get_the_permalink();
			$current_class = ( $current_id == $post->ID ) ? ' current' : '';	

			include (get_template_directory().'/global-templates/template-parts/child-case-study-card.php');
			
		endwhile;

		echo "</section>";
	endif;
	wp_reset_postdata();
?>


<!-- Intro -->

<?php 
    $fcs_client = get_field('fcs_client');
    $fcs_challenge = get_field('fcs_challenge');	
?>

<?php ?>
<?php if( have_rows('services_and_impact') and $fcs_client and $fcs_challenge): ?>
	<section class = 'services-and-impact container generic bg-white'>
		<div class = 'cs-intro-container'>
			
			<div class='cs-intro-left'>
		    <?php while( have_rows('services_and_impact') ): the_row(); ?>
		    
		    	<!-- Services -->
				<?php if( have_rows('services') ): ?>
					<h3>Services</h3>
					<ul>
				    <?php while( have_rows('services') ): the_row();
					    $service = get_sub_field('service');
				    ?>
				       <li><?php echo $service; ?></li>
				    <?php endwhile; ?>
					</ul>
				<?php endif; ?>       
		
		    	<!-- Impact -->
				<?php if( have_rows('their_impact') ): ?>
					<h3>Their Impact</h3>
					<ul>
				    <?php while( have_rows('their_impact') ): the_row();
					    $impact = get_sub_field('impact');
				    ?>
				    	<li><?php echo $impact; ?></li>
				    <?php endwhile; ?>
					</ul>
				<?php endif; ?>  
		        
		    <?php endwhile; ?>
			</div>
			
			<div class='cs-intro-right'>
				
		    	<!-- Meet the Client -->
			       <h2>Meet The <span class='circle-green-2'>Client</span></h2>
			       <p><?php echo $fcs_client; ?></p>		       
				   <h2>The <span class='underline-green-1'>Challenge</span> At Hand</h2>
			       <p><?php echo $fcs_challenge; ?></p>			
				
			</div>
			
		</div>
	</section>
<?php endif; ?>

<!-- QUOTE -->
<?php if( have_rows('fcs_quote')): ?>
    <?php while( have_rows('fcs_quote') ): the_row(); 
		$fcsq_background_image = get_sub_field('fcsq_background_image');
		$fcsq_size = get_sub_field('fcsq_size');
		if (!$fcsq_size) {
			$fcsq_size = 'medium';
		}
        ?>
        
        <?php if( have_rows('fcsq_testimonials') ):
	        $i = 1;
        ?>
	        <section class='fcs-quote-block'
		        	 style='
			        	<?php
				        	if ($fcsq_background_image){
					        	echo 'background-image:url('.$fcsq_background_image['url'].');';
						    } else {
							    echo 'background-color: #0e182d;';
							}
						?>'>
		        <div class='container fcs-content'>
			        <div id='carouselExampleControls' class='carousel slide' data-ride='carousel'>
				        <div class='carousel-inner'>   
        
		        <?php while( have_rows('fcsq_testimonials') ): the_row(); ?>
		        
		        <?php
			        // Get sub field values.
			        $fcsq_quote = get_sub_field('fcsq_quote');
			        $fcsq_citation = get_sub_field('fcsq_citation');
			        $activeState;
					
					if($i == 1) {
						$activeState = 'active';
					} else {
						$activeState = '';
					}			        	        
			    ?>
						<div class='carousel-item <?php echo $activeState; ?> <?php echo $fcsq_size; ?>'>
							<div class='carousel-item-inner'>
				    			<blockquote><?php echo strip_tags($fcsq_quote); ?></blockquote>
								<p><?php echo strip_tags($fcsq_citation); ?></p>
							</div>
						</div>
	
						<?php $i++; ?>
		        <?php endwhile; ?>
				        </div>
				        <?php if ($i > 2): ?>
						  <a class='carousel-control-prev' href='#carouselExampleControls' role='button' data-slide='prev'>
					      <span class='carousel-control prev-icon white' aria-hidden='true'></span>
					      <span class='sr-only'>Previous</span>
						  </a>
						  <a class='carousel-control-next' href='#carouselExampleControls' role='button' data-slide='next'>
						    <span class='carousel-control next-icon white' aria-hidden='true'></span>
						    <span class='sr-only'>Next</span>
						  </a>
						<?php endif; ?>				        
			        </div>
		        </div>
	        </section>	        
        <?php endif; ?>
        
    <?php endwhile; ?>
<?php endif; ?>


<!-- CONTENT -->

<?php
if (have_posts() and !empty(get_the_content())) : while (have_posts()) : the_post();
		echo "
		<section class='container generic bg-white fcs-content-container'>
		";
		the_content();
	endwhile;
		echo "</section>";
endif;	
?>

<?php include (get_template_directory().'/global-templates/template-parts/more-projects.php'); ?>

<?php include( locate_template( 'footer.php', false, false ) ); ?>
