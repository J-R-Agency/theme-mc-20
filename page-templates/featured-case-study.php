<?php
/**
 * Template Name: Featured Case Study Template
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

<!-- Intro -->
<?php if( have_rows('services_and_impact') ): ?>
	<section class = 'generic bg-white'>
		<div class='cs-intro-container'>
			
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
				
		    	<!-- Intro -->
				<?php if( have_rows('fcs_intro') ): ?>
				    <?php while( have_rows('fcs_intro') ): the_row();
				    ?>
				    
						<?php if( have_rows('fcs_intro_block') ): ?>
						    <?php while( have_rows('fcs_intro_block') ): the_row();
							    $fcs_title = get_sub_field('fcs_title');
							    $fcs_content = get_sub_field('fcs_content');
						    ?>
						       <h2><?php echo strip_tags($fcs_title, '<span>'); ?></h2>
						       <p><?php echo strip_tags($fcs_content); ?></p>
						    <?php endwhile; ?>
						<?php endif; ?>  
										       
				    <?php endwhile; ?>
				<?php endif; ?>  				
				
			</div>
			
		</div>
	</section>
<?php endif; ?>

<!-- QUOTE -->
<?php if( have_rows('fcs_quote') ): ?>
    <?php while( have_rows('fcs_quote') ): the_row(); 

        // Get sub field values.
        $fcsq_quote = get_sub_field('fcsq_quote');
        $fcsq_citation = get_sub_field('fcsq_citation');

        ?>
        <section class='fcs-quote-block'>
	        <div class='fcs-content'>
		    	<h3><?php echo strip_tags($fcsq_quote); ?></h3>
				<p><?php echo strip_tags($fcsq_citation); ?></p>
	        </div>
        </section>
        
    <?php endwhile; ?>
<?php endif; ?>



<section class='generic bg-white fcs-content-container'>
<h2>Our <span class='underline-green-1'>Response</span></h2>
<?php
	if (have_posts()) : while (have_posts()) : the_post();
			the_content();
		endwhile;
	endif;	
?>
</section>

<?php include( locate_template( 'footer.php', false, false ) ); ?>
