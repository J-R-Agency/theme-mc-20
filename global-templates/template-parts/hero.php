<?php
/**
 * Hero
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$theme_path = get_template_directory_uri();
?>

<?php if ( has_post_thumbnail() ): ?>
	<?php $thumb = get_the_post_thumbnail_url(); ?>
	<?php
		$featured_image_position = get_field('featured_image_position');
		$hero = get_field('hero');
	?>
	<div class='hero-filter <?php the_field('hero_filter');?>'>
		<h1><?php echo strip_tags($hero['hero_title'],'<span>'); ?></h1>
		<p><?php echo strip_tags($hero['hero_subtitle'],'<span>'); ?></p>
	</div>
	<div class="hero"
		 style="background-image: url('<?php echo $thumb; ?>');
				background-position:
				<?php if (!$featured_image_position)
						 { echo 'center'; }
					else { echo $featured_image_position; } ?>">									
	</div>
<?php endif ?>
