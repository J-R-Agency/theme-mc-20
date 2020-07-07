<?php
/**
 * Case study card
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

<a href="<?php the_permalink(); ?>">
	<div class='cs-thumb-filter <?php echo $category_color; ?>'>
		<h3><?php the_title(); ?></h3>
		<p><?php if ($female_founder_description) { echo $female_founder_description; } ?></p>
	</div>
	<div class='cs-thumb-wrapper' style='background-image:url("<?php if ( has_post_thumbnail() ) {
		    		echo get_the_post_thumbnail_url();
				} else { 
					echo get_template_directory_uri()."/assets/images/blog-card-placeholder.jpg";
				}
			?>");'>
	</div>						     
</a> 