<?php
/**
 * Partial template for flexible content in templates
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$theme_path = get_template_directory_uri();
?>

<?php

// Check value exists.
if( have_rows('flexible_content_block') ):

    // Loop through rows.
    while ( have_rows('flexible_content_block') ) : the_row();


 	   	  // -------------------------- //
         // -- CASE: WP CONTENT BLOCK -//
        // -------------------------- //
       if( get_row_layout() == 'wp_content' ):
       		
       		echo "<!-- WP Content Block -->
				<section class='container generic bg-white'>";
				
			if (have_posts()) : while (have_posts()) : the_post();
					the_content();
				endwhile;
			endif;
										
			echo "</section>
       		"; 
       			

          // -------------------------- //
         // --- CASE: CONTENT BLOCK ---//
        // -------------------------- //
        elseif( get_row_layout() == 'content_block' ):

            $cb_title = get_sub_field('cb_title'); // Text
            $cb_image = get_sub_field('cb_image'); // Image
            $cb_style = get_sub_field('cb_style'); // Select
            $cb_image = get_sub_field('cb_image');
            $cb_background_color = get_sub_field('cb_background_color');
            $cb_copy = get_sub_field('cb_copy');
            $cb_column_left = get_sub_field('cb_column_left');
            $cb_column_right = get_sub_field('cb_column_right');
            
            if ($cb_style == 'primary'):
            	echo "
            		<section class='generic bg-".$cb_background_color." content-".$cb_style."'>
            			<div class='container'>
            				<h2>".strip_tags($cb_copy,'<span><p>')."</h2>
            			</div>
            		</section>
            	";
            elseif ($cb_style == 'secondary'):
            	echo "
            		<section class='generic bg-".$cb_background_color." content-".$cb_style."'>
            			<div class='container'>
	            			<h2>".strip_tags($cb_title,'<span>')."</h2>
	            			
	            			<div class='cb-container'>
		            			<div class='cb-left'>
		            				".$cb_column_left."
		            			</div>
		            			
		            			<div class='cb-right'>
		            				".$cb_column_right."
		            			</div>
		            		</div>
	            		</div>
            		</section>
            	";
            elseif ($cb_style == 'tertiary'):
            	echo "
            		<section class='generic bg-".$cb_background_color." content-".$cb_style."'>
            			<div class='container'>
	            			<img src='".$cb_image['url']."' alt='".$cb_image['alt']."'>
	            			<h2>".strip_tags($cb_title,'<span>')."</h2>
	            			<p>".strip_tags($cb_copy,'<span>')."</p>
	            		</div>
            		</section>
            	";
            endif;
			
					
		
          // -------------------------- //
         // --- CASE: ICON SET BLOCK --//
        // -------------------------- //
        elseif( get_row_layout() == 'icon_set_block' ):

            $isb_columns = get_sub_field('isb_columns'); // Text
            $isb_background_color = get_sub_field('isb_background_color'); // WYSIWYG block
            $isb_title = get_sub_field('isb_title'); // Image
            $isb_icons = get_sub_field('isb_icons'); // Select 
            $isb_page = sanitize_title(get_the_title());
			
			
			echo "<section class='container generic bg-".$isb_background_color." icon-set'>
						<h2>".strip_tags($isb_title,'<span>')."</h2>
							<div class='icon-set-container'>";
						
							if( have_rows('isb_icons') ):
								while( have_rows('isb_icons') ): the_row(); 
							
									// vars
									$isb_icon = get_sub_field('isb_icon');
									$isb_caption = get_sub_field('isb_caption');
									$isb_description= get_sub_field('isb_description');
									$isb_link = get_sub_field('isb_link');
									
									echo "<div class='icon-set-wrapper ".$isb_columns."-columns'>";
									
									if ($isb_link) {
										echo "<a href='".$isb_link['url']."' target='".$isb_link['target']."'>";
									}
									
									echo "<img src='".$isb_icon['sizes']['medium']."'>";										
											
										if ($isb_caption) {
											echo "<h5>".$isb_caption."</h5>";
										}
										if ($isb_description) {
											echo "<p>".$isb_description."</p>";
										}
										
									if ($isb_link) {
										echo "</a>";
									}										
										
									echo "</div>";
									
								endwhile;
							endif;
							
			echo	"</div>
				  </section>";	



          // -------------------------- //
         // ----- CASE: CTA BLOCK -----//
        // -------------------------- //
        elseif( get_row_layout() == 'cta_block' ):

            $cta_style = get_sub_field('cta_style');
            $cta_filter = get_sub_field('cta_filter');
            $cta_title = get_sub_field('cta_title');
            $cta_intro = get_sub_field('cta_intro');
            $cta_link_type = get_sub_field('cta_link_type');
            $cta_file = get_sub_field('cta_file');
            $cta_link = get_sub_field('cta_link');
			$cta_image = get_sub_field('cta_image');
			$cta_image_position = get_sub_field('cta_image_position');
			
			if (!$cta_image_position) {
				$cta_image_position = 'center';
			}
			
			echo "
			<section class='cta-block ".$cta_style." ".$cta_filter."' style='background-image:url(".$cta_image['url']."); background-position:".$cta_image_position."'>
				<div class='container'>
			";
					
					// POST IT
					if ($cta_style == 'secondary'):
						echo "<div class='cta-post-it'>";
					endif;
					
					// TITLE & INTRO
					echo "<h1>".$cta_title."</h1>
						 <p>".$cta_intro."</p>";
						 
					// LINK
					if ($cta_link_type == "link") {
						echo "<a href='".$cta_link['url']."' target='".$cta_link['target']."'><div class='button-navy'>".$cta_link['title']."</div></a>";
					} elseif ($cta_link_type == "file") {
						echo "<a href='".$cta_file['url']."' download><div class='button-navy'>Tell me more</div></a>";
					}
					
					// END POST-IT
					if ($cta_style == 'secondary'):
						echo "</div>";
					endif;
						 
					echo "
				</div> <!-- end container -->
			</section>
			";

          // --------------------------- //
         // - CASE: CASE STUDIES BLOCK -//
        // --------------------------- //
        elseif( get_row_layout() == 'case_studies_block' ):

            $csb_title = get_sub_field('csb_title');
			
			echo "
			<section class='container generic bg-white case-studies-block'>
				<h2>".$csb_title."</h2>
				<div class='small-card-container'>
				";		
				$pageSlug = get_page_by_path( 'our-work' );
								
				$args = array(
				    'post_type'      => 'page', //write slug of post type
				    'posts_per_page' => 3,
				    'post_parent'    => $pageSlug->ID, //place here id of your parent page
				    'order'          => 'DESC',
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
								
			echo "</div>
			</section>
			<section class='bg-light-grey'>
				<div class='container link-block '>
					<a href='".site_url()."/our-work'>See more projects<div class='arrow-link-pink'></div></a>
				</div>
			</section>
			";


          // --------------------------- //
         // ----- CASE: LINK BLOCK -----//
        // --------------------------- //
        elseif( get_row_layout() == 'link_block' ):

            $lb_link = get_sub_field('lb_link');
            $lb_background_color = get_sub_field('lb_background_color');
			
			echo "
			<section class='bg-".$lb_background_color."'>
				<div class='container link-block '>
					<a href='".$lb_link['url']."'>".$lb_link['title']."<div class='arrow-link-".$page_color."'></div></a>
				</div>
			</section>
			";
			
			
			
          // ---------------------------- //
         // --- CASE: PAGE LINK BLOCK ---//
        // ---------------------------- //
        elseif( get_row_layout() == 'page_links_block' ):

            $plb_title = get_sub_field('plb_title');
            $plb_pages = get_sub_field('plb_pages');
			
			echo "
			<section class='container generic bg-white page-links-block'>
				<h2>".$plb_title."</h2>
				<div class='plb-container'>";
				
					if( have_rows('plb_pages') ):
					   while( have_rows('plb_pages') ): the_row(); 
					
					        $plb_icon = get_sub_field('plb_icon');
					        $plb_page = get_sub_field('plb_page');
									
							echo "
							<div class='plb-wrapper'>
								<a href='".$plb_page['url']."'>
									<img class='plb-icon' src='".$plb_icon['url']."' alt='".$plb_icon['alt']."'>
									<h3>".$plb_page['title']."</h3>
									<div class='arrow-link-".$page_color."'></div>
								</a>
							</div>";
									
						endwhile;
					endif;	
									
			echo "</div>
			</section>
			";			
			

          // ------------------------------- //
         // - CASE: PERSON HIGHLIGHT BLOCK -//
        // ------------------------------- //
        elseif( get_row_layout() == 'person_highlight_block' ):

            $phb_title = get_sub_field('phb_title');
            $phb_image = get_sub_field('phb_image');
            $phb_content = get_sub_field('phb_content');
            $phb_social_media = get_sub_field('phb_social_media');
			
			echo "
			<section class='slant bg-light-grey'>
				<div class='container ph-container'>
				
					<div class='ph-left'>
						<h2>".$phb_title."</h2>
						<img class='portrait' src='".$phb_image['url']."'>
						<div class='ph-social-media' style='background-image:url(".$theme_path."/assets/graphics/header-sm-bg-".$page_color.".png);'>";
							
						if( have_rows('phb_social_media') ):
						   while( have_rows('phb_social_media') ): the_row(); 
						
						        $phb_sm_type = get_sub_field('phb_sm_type');
						        $phb_sm_link = get_sub_field('phb_sm_link');
										
								echo "<a href='".$phb_sm_link['url']."' target='_blank'>
									<img src='".$theme_path."/assets/social-media/".$phb_sm_type."-navy.png'>
								</a>";
										
							endwhile;
						endif;
							
			echo "		</div>
					</div>
					<div class='ph-right'>
						".$phb_content."
					</div>
					
				</div>
			</section>
			";			
			

          // ---------------------------- //
         // ----- CASE: TEAM BLOCK ----- //
        // ---------------------------- //
        elseif( get_row_layout() == 'team_block' ):

            $tb_title = get_sub_field('tb_title');
            $tb_team_members = get_sub_field('tb_team_members');
			
			echo "
			<section class='slant-top bg-navy team-block'>
				<h2>".$tb_title."</h2>
				<div class='container tb-container'>";
							
					if( have_rows('tb_team_members') ):
					   while( have_rows('tb_team_members') ): the_row(); 
					
					        $team_member_portrait = get_sub_field('team_member_portrait');
					        $team_member_name = get_sub_field('team_member_name');
					        $team_member_position = get_sub_field('team_member_position');
									
							echo "
							<div class='tb-wrapper'>
								<img class='team-portrait' src='".$team_member_portrait['sizes']['large']."' alt='".$team_member_portrait['alt']."'>
								<h3>".$team_member_name."</h3>
								<p>".$team_member_position."</p>
							</div>";
									
						endwhile;
					endif;
							
			echo "
				</div>
			</section>
			";			
			

          // ----------------------------- //
         // -- CASE: TESTIMONIAL BLOCK -- //
        // ----------------------------- //
        elseif( get_row_layout() == 'testimonials_block' ):

            $testimonials = get_sub_field('testimonials');
            		
				if( have_rows('testimonials') ):
					$i = 1; // Set the increment variable
					echo "
					<section class='generic bg-navy testimonials-block'>
						<div class='container'>
							<div id='carouselExampleControls' class='carousel slide' data-ride='carousel'>
								<div class='carousel-inner'>
						";
					    while( have_rows('testimonials') ): the_row(); 
					
					        $quote = get_sub_field('quote');
					        $citation = get_sub_field('citation');
					        $activeState;
							
							if($i == 1) {
								$activeState = 'active';
							} else {
								$activeState = '';
							}
								
							echo "
								<div class='carousel-item ".$activeState."'>
									<img class='quote-icon' src='".$theme_path."/assets/graphics/left-quote-pink.svg'>
									<blockquote class='testimonial-quote'>".$quote."</blockquote>
									<p class='testimonial-citation'>".$citation."</p>
								</div>
							";
							$i++;
						endwhile;
						echo "
							</div>
							<a class='carousel-control-prev' href='#carouselExampleControls' role='button' data-slide='prev'>
						    <span class='carousel-control-prev-icon' aria-hidden='true'></span>
						    <span class='sr-only'>Previous</span>
						  </a>
						  <a class='carousel-control-next' href='#carouselExampleControls' role='button' data-slide='next'>
						    <span class='carousel-control-next-icon' aria-hidden='true'></span>
						    <span class='sr-only'>Next</span>
						  </a>
						</div>
					</div>
				</section>
				";	
				endif;



          // --------------------------------- //
         // -- CASE: IMAGE & CONTENT BLOCK -- //
        // --------------------------------- //
        elseif( get_row_layout() == 'image_and_content_block' ):

            $icb_image = get_sub_field('icb_image');
            $icb_title = get_sub_field('icb_title');
            $icb_content = get_sub_field('icb_content');
			
			echo "
			<section class='slant-bottom bg-light-grey image-content-block'>
				
				<div class='container icb-container'>
					<div class='icb-left'>
						<img src='".$icb_image['sizes']['large']."' alt='".$icb_image['alt']."'>
					</div>
					<div class='icb-right'>
						<h2>".$icb_title."</h2>
						".$icb_content."
					</div>
				</div>
			</section>
			";			
          // --------------------------------- //
         // ----- CASE: BLOG POSTS BLOCK ---- //
        // --------------------------------- //
        elseif( get_row_layout() == 'blog_posts_block' ):
			
			$bpb_background_color = get_sub_field('bpb_background_color');
            $bpb_title = get_sub_field('bpb_title');
			$bpb_category = get_sub_field('bpb_category');
								
				$args = array(
				    'post_type'      => 'post', //write slug of post type
				    'posts_per_page' => 3,
				    'order'          => 'DESC',
				    'category__in'	 => $bpb_category
				 );
				 
				 $query = new WP_Query($args);
				 
				if ( $query->have_posts() ) :
					echo "
					<section class='generic bg-".$bpb_background_color."'>
						<div class='container'>
							<h2 style='text-align: center; padding-bottom: 2rem;'>".$bpb_title."</h2>";				 
					    while ( $query->have_posts() ) : $query->the_post();
						 						 	
						 	if ($bpb_background_color == "white") {
							 	$card_color = 'light-grey';
						 	} elseif ($bpb_background_color == "light-grey") {
							 	$card_color = 'white';
						 	}
						 	
							$categories = get_the_category();
							
							include (get_template_directory().'/global-templates/template-parts/blog-card.php');	
						
						endwhile;
					echo "</div>
					</section>";
				endif; 
				wp_reset_query();
		
		endif; // Final endif        
    // End loop.
    endwhile;
// No value.
else :
    
endif;

?>