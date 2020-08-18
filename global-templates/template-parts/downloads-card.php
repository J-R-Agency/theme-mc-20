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
		$link = get_sub_field('link');
		$color = get_sub_field('color');

		?>
		
		<div class="download-card-container">
			<?php
				if ($file) {
					echo "<a href='".$file['url']."' download>";
				} else {
				}
				
				if ($link) {
					echo "<a href='".$link['url']."' target='".$link['target']."'>";
				} else {
				}
			?>
			
				<?php if ($file_name):?>
				<div class='download-card-header <?php echo $color; ?>'>
					<h3><?php echo $file_name; ?></h3>
				</div>
				<?php endif; ?>
				
				<div class='download-card-img' style="background-image:url(<?php echo $image['url']; ?>)"></div>
				
				<div class='ribbon-wrapper'>
					<div class='download-card-ribbon <?php echo $color; ?>'></div>
				</div>
			</a>
		</div>
		
	<?php endwhile; ?>
<?php endif; ?>