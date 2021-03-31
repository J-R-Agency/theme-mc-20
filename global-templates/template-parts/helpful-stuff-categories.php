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


<?php if( have_rows('blog_category') ): ?>
	<?php while( have_rows('blog_category') ): the_row(); 

		// vars
		$bc_color = get_sub_field('bc_color');
		$bc_title = get_sub_field('bc_title');
		$bc_subtitle = get_sub_field('bc_subtitle');
		$bc_category = get_sub_field('bc_category');
		$bc_link_text = get_sub_field('bc_link_text');
		
		$bc_cat_object = get_category($bc_category);
		
		?>
		
		<section class='container generic bg-white'>
			<h2><?php echo $bc_title; ?></h2>
			<p class='hs-subtitle'><?php echo $bc_subtitle; ?></p>			
			
			<div class='small-card-container'>
			<?php		
				$args = array(
				    'post_type'      => 'post', //write slug of post type
				    'posts_per_page' => 3,
				    'order'          => 'DESC',
				    'category__in'   => $bc_category
				 );
				 
				$bcquery = new WP_Query( $args );
				 
				if ( $bcquery->have_posts() ) :
				 
				    while ( $bcquery->have_posts() ) : $bcquery->the_post();
					 	
						$mc_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
						$hover_color = $bc_color;
						$categories = get_the_category();
						
						include (get_template_directory().'/global-templates/template-parts/blog-card-small.php');	
					
					endwhile;
				endif; 
				wp_reset_query();						
								
			?>
			</div>
		</section>
		<section class='bg-light-grey'>
			<div class='container link-block '>
				<a href='<?php echo site_url();?>/category/<?php echo $bc_cat_object->slug; ?>'><?php echo $bc_link_text; ?><div class='arrow-link-<?php echo $bc_color; ?>'></div></a>
			</div>
		</section>
		
	<?php endwhile; ?>
<?php endif; ?>