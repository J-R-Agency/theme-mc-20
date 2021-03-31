<?php
/**
 *  Blog-card-large
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$theme_path = get_template_directory_uri();
$categories = get_the_category();

$featured_image_position = get_field('featured_image_position');
$category_color = get_field('category_color', $categories[0]);
?>

<!-- Large blog card -->
<div class='blog-card-container <?php echo $card_color; ?>'>
	
	<div class='blog-card-left'>
		<div class='ribbon blog-category ribbon-<?php echo $category_color; ?>'>
			<?php 
			if ( ! empty( $categories ) ) {
				echo 
				'<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">'
					. esc_html( $categories[0]->name ) .
				'</a>';
			}
			?>
		</div>
		
		<div class='blog-card-info'>
			<a class='blog-title' href="<?php the_permalink(); ?>">
				<h2><?php echo wp_trim_words( get_the_title(), 15 ); ?></h2>
			</a>
			<p class='blog-author'>By <?php the_author(); ?></p>	
			
			<a href="<?php the_permalink(); ?>">
				<div class='button-navy'>Tell me more</div>
			</a>
		</div>
	</div>
	
	<div class='blog-card-right'>
		<a href="<?php the_permalink(); ?>">
			<?php if ( has_post_thumbnail() ) {
		    		echo "<img src=\"" . get_the_post_thumbnail_url($post->ID, 'full') . "\"
		    				style='object-position:".$featured_image_position.";'>";
				} else { 
					echo "<img src='". get_template_directory_uri() ."/assets/images/blog-card-placeholder.jpg'>";
				}
			?>
		</a>
	</div>
</div>