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
<section class='container generic bg-white'>
	<h2>Free <span class='underline-green-1'>Downloads</span></h2>
	<p class='hs-subtitle'>Essential Digital Marketing Resources</p>
	<div class='downloads-container'>
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
				if (!$image) {
					$image['url'] = $theme_path."/assets/images/download-card-placeholder.jpg";
				}
				
			?>
			
			<?php if ($file): ?>
			<a href='<?php echo $file['url']; ?>' download>
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
			<?php endif; ?>
			
			<? if ($link): ?>
			<a href='<?php echo $link['url']; ?>' target='<?php echo $link['target']; ?>'>
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
			<?php endif; ?>
			
		</div> <!-- end download card container -->
		
	<?php endwhile; ?>
	</div> <!-- end downloads container -->
</section>	
<?php endif; ?>