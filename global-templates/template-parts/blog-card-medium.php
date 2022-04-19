<?php
/**
 * Blog card - medium
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

<!-- Medium blog card -->

<div class='blog-card__medium <?php echo $category_color; ?>'>
	
	<div class='ribbon-container'>
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
	</div>
		
	<a href="<?php the_permalink(); ?>">
		<div class='blog-image'
			 style='background-image:
					url("<?php if ( has_post_thumbnail() ) {
			    		echo get_the_post_thumbnail_url(get_the_ID(),'large');
					} else { 
						echo get_template_directory_uri()."/assets/images/blog-card-placeholder.jpg";
					}
				?>");'>
		</div>	     
	</a> 
	
	<div class='blog-card-info <?php echo $card_color; ?>'>
		<a class='blog-title' href="<?php the_permalink(); ?>">
			<h3><?php echo wp_trim_words( get_the_title(), 15 ); ?></h3>
		</a>
		<p class='blog-author'>By <?php the_author(); ?></p>	
		
	</div>

</div>