<?php
/**
 * Partial template for flexible content in templates
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
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
        elseif( get_row_layout() == 'module_content_block' ):

            $mcb_title = get_sub_field('mcb_title'); // Text
            $mcb_content = get_sub_field('mcb_content'); // WYSIWYG block
            $mcb_image = get_sub_field('mcb_image'); // Image
            $mcb_style = get_sub_field('mcb_style'); // Select 
			
					
		
          // -------------------------- //
         // --- CASE: ICON SET BLOCK --//
        // -------------------------- //
        elseif( get_row_layout() == 'icon_set_block' ):

            $isb_columns = get_sub_field('isb_columns'); // Text
            $isb_background_color = get_sub_field('isb_background_color'); // WYSIWYG block
            $isb_title = get_sub_field('isb_title'); // Image
            $isb_icons = get_sub_field('isb_icons'); // Select 
			
			
			echo "<section class='generic ".$isb_background_color." icon-set'>
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
					 <div class='button-navy'><a href='".$cta_link['url']."'>".$cta_link['title']."</a></div>";
				
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
			<section class='generic bg-white'>
				<h2>".$csb_title."</h2>
			
			</section>
			";

			
		endif; // Final endif

                    
    // End loop.
    endwhile;

// No value.
else :
    
endif;

?>