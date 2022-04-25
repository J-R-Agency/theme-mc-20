<?php
/**
 * Partial template for flexible content in templates
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$theme_path = get_template_directory_uri();
$default_padding = 3;
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
				<section class='container bg-white'>";
				
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
			$cb_id = get_sub_field('cb_id');
            $cb_background_color = get_sub_field('cb_background_color');
            $cb_copy = get_sub_field('cb_copy');
            $cb_column_left = get_sub_field('cb_column_left');
            $cb_column_right = get_sub_field('cb_column_right');
			$cb_padding_top = get_sub_field('cb_padding_top');
            $cb_padding_bottom = get_sub_field('cb_padding_bottom');

			$cb_padding_top = $cb_padding_top ? $cb_padding_top : $default_padding;
			$cb_padding_bottom = $cb_padding_bottom ? $cb_padding_bottom : $default_padding;

            // PRIMARY
            if ($cb_style == 'primary'):
            	echo "
            		<section style='padding-top: ".$cb_padding_top."rem; padding-bottom: ".$cb_padding_bottom."rem;'
							 id='".$cb_id."'
							 class='bg-".$cb_background_color." content-".$cb_style."'>
            			<div class='container'>
            				".$cb_copy."
            			</div>
            		</section>
            	";

            // SECONDARY
            elseif ($cb_style == 'secondary'):
            	echo "
            		<section style='padding-top: ".$cb_padding_top."rem; padding-bottom: ".$cb_padding_bottom."rem;'
							 id='".$cb_id."'
							 class='bg-".$cb_background_color." content-".$cb_style."'>
            			<div class='container'>";
            			
            	if ($cb_title) {
	            	echo "<h2>".strip_tags($cb_title,'<span>')."</h2>";	
            	}
	            			
	            echo		"<div class='cb-container'>
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
            endif;
			
					
		
          // -------------------------- //
         // --- CASE: ICON SET BLOCK --//
        // -------------------------- //
        elseif( get_row_layout() == 'icon_set_block' ):

            $isb_columns = get_sub_field('isb_columns'); // Text
            $isb_icon_size = get_sub_field('isb_icon_size'); // Text
            $isb_background_color = get_sub_field('isb_background_color'); // WYSIWYG block
            $isb_title = get_sub_field('isb_title'); // Image
            $isb_icons = get_sub_field('isb_icons'); // Select 
            $isb_icon_style = get_sub_field('isb_icon_style'); // Select 
            $isb_page = sanitize_title(get_the_title());
            $isb_id = get_sub_field('isb_id'); // Select 

            if (!$isb_icon_size) {
	            $isb_icon_size = 'medium';
            }
            
            if (!$isb_icon_style) {
	            $isb_icon_style = 'none';
            }
			echo "<section id='".$isb_id."' class='icon-set-block bg-".$isb_background_color."'>";
			echo $isb_title;
			echo		"<div class='container icon-set-container'>";
							
						
							if( have_rows('isb_icons') ):
								while( have_rows('isb_icons') ): the_row(); 
							
									// vars
									$isb_icon = get_sub_field('isb_icon');
									$isb_caption = get_sub_field('isb_caption');
									$isb_description= get_sub_field('isb_description');
									$isb_link = get_sub_field('isb_link');
									$isb_lottie_animation = get_sub_field('isb_lottie_animation');									
									echo "<div class='icon-set-wrapper icon-size-".$isb_icon_size." ".$isb_columns."-columns icon-set style-".$isb_icon_style."'>";
									
									// Begin Link
									if ($isb_link) {
										echo "<a href='".$isb_link['url']."' target='".$isb_link['target']."'>";
									}
									
									// Lottie Animation/Image
									if ($isb_lottie_animation) {
										echo $isb_lottie_animation;
									} else {
										echo "<img class='".$isb_icon_size."' src='".$isb_icon['sizes']['medium']."' alt='".$isb_icon['alt']."'>";
									}
									
									// End Link
									if ($isb_link) {
										echo "</a>";
									}										
									
									// Caption
									if ($isb_caption) {
										echo "<p class='caption'>".$isb_caption."</p>";
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
            $cta_link_type = get_sub_field('cta_link_type');
            $cta_file = get_sub_field('cta_file');
            $cta_link = get_sub_field('cta_link');
			$cta_image = get_sub_field('cta_image');
			$cta_image_position = get_sub_field('cta_image_position');
			$cta_video = get_sub_field('cta_video');
			
			if (!$cta_image_position) {
				$cta_image_position = 'center';
			}
			
			if ($cta_style == 'tertiary') {
				echo "
				<section class='cta-block ".$cta_style."' style='background-image:url(".$cta_image['url'].")'>";		
			} elseif ($cta_style == 'video') {
				echo "
				<section class='cta-block ".$cta_style."'>
				<video autoplay muted loop>
					<source src='".$cta_video['url']."' type='video/mp4'>
				</video>
				";
			} else {
				echo "
				<section class='cta-block ".$cta_style." ".$cta_filter."' style='background-image:url(".$cta_image['url']."); background-position:".$cta_image_position."'>
				";					
			}
			
			echo "<div class='container'>";
					
					echo "<div class='cta-content ".$cta_style."'>";
					
					
					// TITLE & INTRO
					if ($cta_title) {
						echo "<h1>".$cta_title."</h1>";
					}
					
					if ($cta_intro) {
						echo "<p>".$cta_intro."</p>";
					}
					
						 
					// LINK
					if ($cta_link_type == "link" and $cta_link) {
						echo "<a class='button-navy' href='".$cta_link['url']."' target='".$cta_link['target']."'>".$cta_link['title']."</a>";
					} elseif ($cta_link_type == "file" and $cta_file) {
						echo "<a class='button-navy' href='".$cta_file['url']."' download>Tell me more</a>";
					}
					
					echo "</div>";
					
					echo "</div>";
						 
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
			<section class='container bg-white case-studies-block'>
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
			<section class='link-block bg-light-grey'>
				<div class='container'>
					<a href='".site_url()."/our-work'>See more projects<div class='arrow-link__pink'></div></a>
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
			<section class='link-block bg-".$lb_background_color."'>
				<div class='container'>
					<a href='".$lb_link['url']."'>".$lb_link['title']."<div class='arrow-link__".$page_color."'></div></a>
				</div>
			</section>
			";
			
			
			
          // ---------------------------- //
         // --- CASE: PAGE LINK BLOCK ---//
        // ---------------------------- //
        elseif( get_row_layout() == 'page_links_block' ):

            $plb_title = get_sub_field('plb_title');
            $plb_pages = get_sub_field('plb_pages');
			$plb_icon_size = get_sub_field('plb_icon_size');

			echo "
			<section class='page-links-block bg-white'>
				<div class='container'>
				<h2>".$plb_title."</h2>
				<div class='page-links-block__links'>";
				
					if( have_rows('plb_pages') ):
					   while( have_rows('plb_pages') ): the_row(); 
					
					        $plb_icon = get_sub_field('plb_icon');
					        $plb_page = get_sub_field('plb_page');
									
							echo "
							<a class='page-links-block__page' href='".$plb_page['url']."'>
								<img class='plb-icon plb-icon--".$plb_icon_size."'
									 src='".$plb_icon['url']."'
									 alt='".$plb_icon['alt']."'>
								<h3 class='page-links-block__title page-links-block--".$page_color."'>"
									.$plb_page['title'].
								"</h3>
								<div class='arrow-link__".$page_color."'></div>
							</a>
							";
									
						endwhile;
					endif;	
									
			echo "</div>
				</div>
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
            $phb_background_style = get_sub_field('phb_background_style');

            if(!$phb_background_style) {
            	$phb_background_style = 'white';
            }
			
			echo "
			<section class='person-highlight-block bg-".$phb_background_style."'>
				<div class='container ph-container'>
				
					<div class='ph-left'>
						<h2>".$phb_title."</h2>
						<img class='portrait' src='".$phb_image['url']."' alt='".$phb_image['alt']."'>
						<div class='ph-social-media' style='background-image:url(".$theme_path."/assets/graphics/header-sm-bg-".$page_color.".png);'>";
							
						if( have_rows('phb_social_media') ):
						   while( have_rows('phb_social_media') ): the_row(); 
						
						        $phb_sm_type = get_sub_field('phb_sm_type');
						        $phb_sm_link = get_sub_field('phb_sm_link');
										
								echo "<a href='".$phb_sm_link['url']."' target='_blank'>
									<img src='".$theme_path."/assets/social-media/".$phb_sm_type."-navy.png' alt='".$phb_sm_type."'>
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
			$tb_background_style = get_sub_field('tb_background_style');
			$tb_display_socials = get_sub_field('tb_display_socials');

			if (!$tb_display_socials) {
				$card_size = 'small';
				$columns = 'three';
			} else {
				$card_size = 'large';
				$columns = 'two';
			}

			if (!$tb_background_style) {
				$tb_background_style = 'navy-slant-top';
			}

			echo "
			<section class='bg-".$tb_background_style." team-block'>
				".$tb_title."
				<div class='container grid-".$columns."'>";
							
					if( $tb_team_members ):

						foreach( $tb_team_members as $team_member ):					
					        $team_portrait = get_field('team_portrait', $team_member->ID);
					        $team_name = get_field('team_name', $team_member->ID);
					        $team_position = get_field('team_position', $team_member->ID);
									
					        include (get_template_directory().'/global-templates/template-parts/team-member-card-'.$card_size.'.php');
									
						endforeach;
						wp_reset_postdata();
					else:

						$args = array('post_type'=>'team-members','post_status'=>'publish', 'orderby'=>'menu_order date', 'order'=>'ASC');
						$query = new WP_Query($args);

						if($query->have_posts()) {
						    while($query->have_posts())
						    {
						    	$query->the_post();

						        $team_portrait = get_field('team_portrait');
						        $team_name = get_field('team_name');
						        $team_position = get_field('team_position');
										
								include (get_template_directory().'/global-templates/template-parts/team-member-card-'.$card_size.'.php');
						    }
						    wp_reset_postdata();
						}				
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
            $testimonials_size = get_sub_field('testimonials_size');
            $testimonials_count = count($testimonials);
            $testimonials_background_image = get_sub_field('testimonials_background_image');
            
            if (!$testimonials_size) {
	            $testimonials_size = 'medium';
            }
            
				if( have_rows('testimonials') ):
					$i = 1; // Set the increment variable
					echo "
			        <section class='testimonials-block' style='
			        ";
			        	if ($testimonials_background_image){
				        	echo 'background-image:url('.$testimonials_background_image['url'].');';
					    } else {
						    echo 'background-color: #0e182d;';
						}
					echo "'>

						<div class='container'>";
					if($testimonials_count > 1):
						echo	"<div id='carouselExampleControls' class='carousel slide' data-ride='carousel'>";
					endif;
					echo		"<div class='carousel-inner'>
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
								<div class='carousel-item ".$activeState." ".$testimonials_size."'>
									<div class='testimonial-block'>
										<img class='quote-icon' src='".$theme_path."/assets/graphics/left-quote-".$page_color.".svg' alt=''>
										<blockquote class='testimonial-quote'>".$quote."</blockquote>
										<p class='testimonial-citation'>".$citation."</p>
									</div>
								</div>
							";
							$i++;
						endwhile;
						echo "</div>";

						if($testimonials_count > 1):
							echo "
								<a class='carousel-control-prev' href='#carouselExampleControls' role='button' data-slide='prev'>
							    <span class='carousel-control prev-icon ".$page_color."' aria-hidden='true'></span>
							    <span class='sr-only'>Previous</span>
							  </a>
							  <a class='carousel-control-next' href='#carouselExampleControls' role='button' data-slide='next'>
							    <span class='carousel-control next-icon ".$page_color."' aria-hidden='true'></span>
							    <span class='sr-only'>Next</span>
							  </a>
							</div>";
						endif;
				echo "
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
            $icb_background_style = get_sub_field('$icb_background_style');

            if(!$icb_background_style) {
            	$icb_background_style = "light-grey-slant-bottom";
            }
			
			echo "
			<section class='bg-".$icb_background_style." image-content-block'>
				
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
            $bpb_blog_card_size = get_sub_field('bpb_blog_card_size');
			$bpb_category = get_sub_field('bpb_category');
						
			if (!$bpb_blog_card_size) {
				$bpb_blog_card_size = 'small';
			}
						
			if (!$bpb_title) {
				$bpb_title = 'Our Blog Posts';
			}
			
			if ($bpb_blog_card_size == 'medium') {
				$number_of_posts = 4;
			} else {
				$number_of_posts = 6;
			}
								
				$args = array(
				    'post_type'      => 'post', //write slug of post type
				    'posts_per_page' => $number_of_posts,
				    'order'          => 'DESC',
				    'category__in'	 => $bpb_category,
				    'ignore_sticky_posts' => 1
				 );
				 
				 $query = new WP_Query($args);
				 
				if ( $query->have_posts() ) :
				
					echo "
					<section class='bg-".$bpb_background_color."'>
						<div class='container'>
							<h2 style='text-align: center; padding-bottom: 2rem;'>".$bpb_title."</h2>
								<div class='blog-posts-container ".$bpb_blog_card_size."-card-container'>";				 
							    while ( $query->have_posts() ) : $query->the_post();
								 	
								 	if ($bpb_background_color == "white") {
									 	$card_color = 'light-grey';
								 	} elseif ($bpb_background_color == "light-grey") {
									 	$card_color = 'white';
								 	}
								 	
									$categories = get_the_category();
									
									include (get_template_directory().'/global-templates/template-parts/blog-card-'.$bpb_blog_card_size.'.php');	
								
								endwhile;
					echo "</div>
						</div>
					</section>";
				endif; 
				wp_reset_query();

          // ---------------------------------------- //
         // ----- CASE: RESPONSIVE IMAGE BLOCK ----- //
        // ---------------------------------------- //
        elseif( get_row_layout() == 'responsive_image_block' ):
        
	        $rib_image_large_screens = get_sub_field('rib_image_large_screens');
	        $rib_image_small_screens = get_sub_field('rib_image_small_screens');
			
			echo "
			<section class='responsive-image-block'>
				<div class='container'>
					<img class='responsive-image-block__large'
						 src='".$rib_image_large_screens['url']."'
						 alt='".$rib_image_large_screens['alt']."'>

					<img class='responsive-image-block__small'
						 src='".$rib_image_small_screens['url']."'
						 alt='".$rib_image_small_screens['alt']."'>						 
				</div>
			</section>				
			";

          // --------------------------------- //
         // ----- CASE: SHORTCODE BLOCK ----- //
        // --------------------------------- //
        elseif( get_row_layout() == 'shortcode_block' ):
        
	        $shortcode = get_sub_field('shortcode');
	        $shortcode_id = get_sub_field('shortcode_id');
	        $shortcode_background_color = get_sub_field('shortcode_background_color');
	        $shortcode_supporting_text = get_sub_field('shortcode_supporting_text');

	        if($shortcode_id) {
	        	$id = "id='".get_sub_field('shortcode_id')."'";
	        } else {
	        	$id = '';
	        }

	        echo "
	        <section class='shortcode-block bg-".$shortcode_background_color."' ".$id.">
	        	<div class='container'>
	        ";

	        echo $shortcode_supporting_text;

	        echo do_shortcode($shortcode);

	        echo "
	        	</div>
	        </section>";

          // ----------------------------- //
         // ----- CASE: QUOTE BLOCK ----- //
        // ----------------------------- //
        elseif( get_row_layout() == 'quote_block' ):
        
	        $qb_quote = get_sub_field('qb_quote');
	        $qb_citation = get_sub_field('qb_citation');
			$qb_background_image = get_sub_field('qb_background_image');
			
			if($qb_quote) {
				echo "
		        <section class='fcs-quote-block' style='
		        ";
		        	if ($qb_background_image){
			        	echo 'background-image:url('.$qb_background_image['url'].');';
				    } else {
					    echo 'background-color: #0e182d;';
					}
				echo "'>
			        <div class='container fcs-content'>
				    	<h3>".strip_tags($qb_quote)."</h3>
						<p>".strip_tags($qb_citation)."</p>
			        </div>
		        </section>				
				";
			}		
		
		endif; // Final endif        
    // End loop.
    endwhile;
// No value.
else :
    
endif;

?>