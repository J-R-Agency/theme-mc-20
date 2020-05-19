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
				<section class='generic bg-white'>";
				
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
            			<h2>".strip_tags($cb_copy,'<span><p>')."</h2>
            		</section>
            	";
            elseif ($cb_style == 'secondary'):
            	echo "
            		<section class='generic bg-".$cb_background_color." content-".$cb_style."'>
            		
            			<h2>".strip_tags($cb_title,'<span>')."</h2>
            			
            			<div class='cb-container'>
	            			<div class='cb-left'>
	            				".$cb_column_left."
	            			</div>
	            			
	            			<div class='cb-right'>
	            				".$cb_column_right."
	            			</div>
	            		</div>
	            		
            		</section>
            	";
            elseif ($cb_style == 'tertiary'):
            	echo "
            		<section class='generic bg-".$cb_background_color." content-".$cb_style."'>
            			<img src='".$cb_image['url']."' alt='".$cb_image['alt']."'>
            			<h2>".strip_tags($cb_title,'<span>')."</h2>
            			<p>".strip_tags($cb_copy,'<span>')."</p>
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
			
			
			echo "<section class='generic bg-".$isb_background_color." icon-set'>
						<h2>".strip_tags($isb_title,'<span>')."</h2>
							<div class='icon-set-container'>";
						
							if( have_rows('isb_icons') ):
								while( have_rows('isb_icons') ): the_row(); 
							
									// vars
									$isb_icon = get_sub_field('isb_icon');
									$isb_caption = get_sub_field('isb_caption');
									$isb_description= get_sub_field('isb_description');
									
									echo "<div class='icon-set-wrapper ".$isb_columns."-columns'>
											<img src='".$isb_icon['url']."'>";
												if ($isb_caption) {
													echo "<h3>".$isb_caption."</h3>";
												}
												if ($isb_description) {
													echo "<p>".$isb_description."</p>";
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
            $cta_link = get_sub_field('cta_link');
			$cta_image = get_sub_field('cta_image');
			
				echo "
				<div class='cta-filter ".$cta_filter."'>";
				
				if ($cta_style == 'secondary'):
					echo "<div class='cta-post-it'>";
				endif;
				
				echo "<h1>".$cta_title."</h1>
					 <p>".$cta_intro."</p>
					 <div class='button-navy'><a href='".$cta_link['url']."' target='".$cta_link['target']."'>".$cta_link['title']."</a></div>";
				
				if ($cta_style == 'secondary'):
					echo "</div>";
				endif;
					 
				echo "
				</div>
				<div class='cta-block' style='background-image:url(".$cta_image['url'].")'>
					
				</div>
				";

          // --------------------------- //
         // - CASE: CASE STUDIES BLOCK -//
        // --------------------------- //
        elseif( get_row_layout() == 'case_studies_block' ):

            $csb_title = get_sub_field('csb_title');
			
			echo "
			<section class='generic bg-white case-studies-block'>
				<h2>".$csb_title."</h2>
				<div class='case-studies-container'>
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
					 	
						$cs_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
						$categories = get_the_category();
						
						include (get_template_directory().'/global-templates/template-parts/case-study-card.php');	
					
					endwhile;
				endif; 
				wp_reset_query();						
								
			echo "</div>
			</section>
			<section class='link-block bg-light-grey'>
				<a href='".site_url()."/our-work'>See more projects<div class='arrow-link-pink'></div></a>
			</section>
			";


          // --------------------------- //
         // ----- CASE: LINK BLOCK -----//
        // --------------------------- //
        elseif( get_row_layout() == 'link_block' ):

            $lb_link = get_sub_field('lb_link');
            $lb_background_color = get_sub_field('lb_background_color');
			
			echo "
			<section class='link-block bg-".$lb_background_color."'>
				<a href='".$lb_link['url']."'>".$lb_link['title']."<div class='arrow-link-".$page_color."'></div></a>
			</section>
			";
			
			
			
          // ---------------------------- //
         // --- CASE: PAGE LINK BLOCK ---//
        // ---------------------------- //
        elseif( get_row_layout() == 'page_links_block' ):

            $plb_title = get_sub_field('plb_title');
            $plb_pages = get_sub_field('plb_pages');
			
			echo "
			<section class='generic bg-white page-links-block'>
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
				<div class='ph-container'>
				
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
				<div class='tb-container'>";
							
					if( have_rows('tb_team_members') ):
					   while( have_rows('tb_team_members') ): the_row(); 
					
					        $team_member_portrait = get_sub_field('team_member_portrait');
					        $team_member_name = get_sub_field('team_member_name');
					        $team_member_position = get_sub_field('team_member_position');
									
							echo "
							<div class='tb-wrapper'>
								<img class='team-portrait' src='".$team_member_portrait['url']."' alt='".$team_member_portrait['alt']."'>
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
								<h3>".$quote."</h3>
								<p>".$citation."</p>
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
				
				<div class='icb-container'>
					<div class='icb-left'>
						<img src='".$icb_image['url']."' alt='".$icb_image['alt']."'>
					</div>
					<div class='icb-right'>
						<h2>".$icb_title."</h2>
						".$icb_content."
					</div>
				</div>
			</section>
			";			

		
		endif; // Final endif        
    // End loop.
    endwhile;
// No value.
else :
    
endif;

?>