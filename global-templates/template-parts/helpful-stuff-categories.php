<?php
/**
 * Helpful Stuff Categories
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$theme_path = get_template_directory_uri();
?>

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