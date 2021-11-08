<?php
/**
 * Blog card - small
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$theme_path = get_template_directory_uri();

$female_founder_description = get_field('female_founder_description');
$categories = get_the_category();
$category_color = get_field('category_color', $categories[0]);
?>

<!-- Small blog card -->
<a href="<?php the_permalink(); ?>" class='blog-card-small <?php echo $category_color; ?>'
		 style='background-image:
			 	linear-gradient(to bottom, rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0)),
				url("<?php if ( has_post_thumbnail() ) {
		    		echo get_the_post_thumbnail_url(get_the_ID(),'medium');
				} else { 
					echo get_template_directory_uri()."/assets/images/blog-card-placeholder.jpg";
				}
			?>");'>
		<h3><?php the_title(); ?></h3>
		<p><?php if ($female_founder_description) { echo $female_founder_description; } ?></p>
</a> 