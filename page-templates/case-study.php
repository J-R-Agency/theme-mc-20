<?php
/**
 * Template Name: Case Study Template
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

<!-- SERVICE, IMPACT AND EMPATHY -->
<?php if( have_rows('service_impact_empathy') ): ?>
	<section class='container sie-container'>
    <?php while( have_rows('service_impact_empathy') ): the_row();
	    $sie_title = get_sub_field('sie_title');
	    $sie_image = get_sub_field('sie_image');
    ?>
		<div class='sie-wrapper'>
			<div class='sie-image'>
				<img src='<?php echo $sie_image['url']; ?>'>
				<h2><?php echo strip_tags($sie_title); ?></h2>
			</div>
		<?php if( have_rows('sie_list') ): ?>
			<ul>
			 <?php while( have_rows('sie_list') ): the_row();
			    $sie_list_item = get_sub_field('sie_list_item');
		    ?>
		    	<li><?php echo $sie_list_item; ?></li>
		    <?php endwhile; ?>
			</ul>
		<?php endif; ?>
		</div>
    <?php endwhile; ?>
    </section>
<?php endif; ?>	    
	    
<!-- QUOTE -->
<?php if( have_rows('cs_quote') ): ?>
    <?php while( have_rows('cs_quote') ): the_row(); 

        // Get sub field values.
        $csq_quote = get_sub_field('csq_quote');
        $csq_citation = get_sub_field('csq_citation');
		$csq_background_image = get_sub_field('csq_background_image');
				
        ?>
        
        <?php if($csq_quote): ?>
	        <section class='fcs-quote-block'
		        	 style='background-image:url(
			        	 
			        	<?php
				        	if ($csq_background_image){
					        	echo $csq_background_image['url'];
						    } else {
							    echo get_template_directory_uri().'/assets/images/quote-bg-img.jpg';
							}
						?>);'>
		        <div class='container fcs-content'>
			    	<h3><?php echo strip_tags($csq_quote); ?></h3>
					<p><?php echo strip_tags($csq_citation); ?></p>
		        </div>
	        </section>
        <?php endif; ?>
        
    <?php endwhile; ?>
<?php endif; ?>

<!-- WP CONTENT -->
<section class='container cs-content-container generic'>
<?php
	if (have_posts()) : while (have_posts()) : the_post();
			the_content();
		endwhile;
	endif;	
?>
</section>

<?php include (get_template_directory().'/global-templates/template-parts/more-projects.php'); ?>

<?php include( locate_template( 'footer.php', false, false ) ); ?>
