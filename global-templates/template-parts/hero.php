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
		$hero_size = get_field('hero_size');
		$title = get_the_title();
		$hero_link = $hero['hero_link'];
		
		if(!$hero_size) {
			$hero_size = 'big';
		}
		
		if(is_search() or is_category() or is_archive()) {
			$hero_size = 'none';
		}
	?>
	
	<?php if ($hero_size=='small'): ?>
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
		
	<?php elseif ($hero_size=='big'):?>	
		<div class='hero__content hero-filter <?php the_field('hero_filter');?>'>

			<!-- Title -->
			<h1><?php echo strip_tags($hero['hero_title'],'<span>'); ?></h1>

			<!-- Subtitle -->
			<p><?php echo strip_tags($hero['hero_subtitle'],'<span>'); ?></p>

			<!-- Link -->
			<?php if($hero_link): ?>
				<a class='hero__link button-navy' href='<?php echo $hero_link['link'] ?>' target='<?php echo $hero_link['target'] ?>'>
					<?php echo $hero_link['title'] ?>
				</a>
			<?php endif; ?>
			
			<a href='#contentstart' class='scroll-down' style='background-image:url("<?php echo $theme_path; ?>/assets/graphics/marker-background-graphic-<?php echo $page_color; ?>.svg");'>
				<img class='slide-bottom' src='<?php echo $theme_path; ?>/assets/graphics/down-arrow-black.svg' alt='Scroll down arrow'>
			</a>
		</div>
		<div class="hero"
			 style="background-image: url('<?php echo $thumb; ?>');
					background-position:
					<?php if (!$featured_image_position)
							 { echo 'center'; }
						else { echo $featured_image_position; } ?>">									
		</div>
		
	<?php elseif (is_page_template('page-templates/featured-case-study.php') or is_page_template('page-templates/case-study.php')):?>
	<div class='hero-filter small <?php the_field('hero_filter');?>'>
		<h1>
			<span class='underline-<?php echo $page_color; ?>-1' style='padding: 1rem 0;'>
				<?php echo strip_tags($hero['hero_title'],'<span>'); ?>
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
		
	<?php else: ?>
		<!-- No Hero -->
	<?php endif; ?>	
	
<?php endif; ?>
<span id='contentstart'></span>
