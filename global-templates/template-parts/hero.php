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
		$title = get_the_title();
	?>
	
	<?php if (is_page_template('page-templates/our-work.php') or is_page_template('page-templates/content.php')):?>
		<div class='hero-filter small <?php the_field('hero_filter');?>'></div>
		<div class="hero small"
			 style="background-image: url('<?php echo $thumb; ?>');
					background-position:
					<?php if (!$featured_image_position)
							 { echo 'center'; }
						else { echo $featured_image_position; } ?>">									
		</div>
		<div class='hero-standfirst'>
			<h1 class='hero-title <?php echo sanitize_title($title); ?>'><?php echo strip_tags($hero['hero_title'],'<span>'); ?></h1>
			<h3><?php echo strip_tags($hero['hero_subtitle'],'<span>'); ?></h3>
		</div>
		
	<?php elseif (is_page_template('page-templates/featured-case-study.php') or is_page_template('page-templates/case-study.php')):?>
		<div class='hero-filter small <?php the_field('hero_filter');?>'>
			<h1>
				<span class='underline-<?php echo $page_color; ?>-1' style='padding: 1.5rem 0;'>
					<?php echo the_title(); ?>
				</span>
			</h1>
			<p><?php echo strip_tags($hero['hero_subtitle'],'<span>'); ?></p>
		</div>
		<div class="hero small"
			 style="background-image: url('<?php echo $thumb; ?>');
					background-position:
					<?php if (!$featured_image_position)
							 { echo 'center'; }
						else { echo $featured_image_position; } ?>">									
		</div>
	<?php elseif (is_category()):?>
		
	<?php else:?>	
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
	<?php endif; ?>
<?php endif; ?>
