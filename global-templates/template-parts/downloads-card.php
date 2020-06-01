<?php
/**
 * Case study card
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$theme_path = get_template_directory_uri();
?>

<?php if( have_rows('downloads') ): ?>
	<?php while( have_rows('downloads') ): the_row(); 

		// vars
		$file_name = get_sub_field('file_name');
		$image = get_sub_field('image');
		$file = get_sub_field('file');
		$color = get_sub_field('color');
		
		?>
		
		<div class="download-card-container">
			<a href="<?php echo $file['url']; ?>" download>
				<div class='download-card-header <?php echo $color; ?>'>
					<h3><?php echo $file_name; ?></h3>
				</div>
				<div class='download-card-img' style="background-image:url(<?php echo $image['url']; ?>)"></div>
				
				<div class='ribbon-wrapper'>
					<div class='download-card-ribbon <?php echo $color; ?>'></div>
				</div>
			</a>
		</div>
		
		

	<?php endwhile; ?>
<?php endif; ?>