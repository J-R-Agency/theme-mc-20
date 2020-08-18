<?php
/**
 * More Projects
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$theme_path = get_template_directory_uri();
?>

<!-- MORE PROJECTS -->
<section class='bg-light-grey'>
	<div class='container link-block '>
		<a href='<?php echo site_url(); ?>/contact'>Get in Touch<div class='arrow-link-<?php echo $page_color; ?>'></div></a>
	</div>
</section>

<section class='container generic bg-white'>
	<div class='more-projects-header'>
		<a class='link' href='<?php echo site_url(); ?>/our-work#cs-title'><div class='arrow-link-<?php echo $page_color; ?>-prev'></div>Back to all projects</a>
		<h2>More Projects</h2>
	</div>
	<div class='small-card-container'>
		<?php
			
		$pageSlug = get_page_by_path( 'our-work' );
		$currentID = get_the_ID();
			
		$args = array(
		    'post_type'      => 'page', //write slug of post type
		    'posts_per_page' => 2,
		    'post_parent'    => $pageSlug->ID, //place here id of your parent page
		    'order'          => 'DESC',
		    'post__not_in' => array($currentID)
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
		
		?>
	</div>
	
</section>