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

<!-- QUOTE -->
<?php if( have_rows('cs_quote') ): ?>
    <?php while( have_rows('cs_quote') ): the_row(); 

        // Get sub field values.
        $csq_quote = get_sub_field('csq_quote');
        $csq_citation = get_sub_field('csq_citation');

        ?>
        <section class='cs-quote-block'>
	        <div class='cs-content'>
		    	<h3><?php echo strip_tags($csq_quote); ?></h3>
				<p><?php echo strip_tags($csq_citation); ?></p>
	        </div>
        </section>
        
    <?php endwhile; ?>
<?php endif; ?>

<?php include( locate_template( 'footer.php', false, false ) ); ?>
