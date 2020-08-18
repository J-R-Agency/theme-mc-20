<?php
/**
 * Single post partial template
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="container entry-header">
		
		<a class='take-back pink' href="<?php site_url(); ?>/helpful-stuff">Take me back</a>
		
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			
			<div class='author-meta'>
				<div class='author-avatar'>
					<?php echo get_avatar(get_the_author_meta( 'ID' ), 64); ?>
				</div>
				<div class='meta-info'>
					<b>By <?php the_author(); ?></b>
					<div class='usm-wrapper'>
						<?php include(get_template_directory() . '/global-templates/template-parts/social-media-user.php'); ?>
					</div>
					<?php echo prefix_estimated_reading_time( get_the_content() ); ?> min read
				</div>
			</div>
			
			<div class='share-btns'>
				<?php if ( function_exists( 'sharing_display' ) ) { echo sharing_display(); } ?>
			</div>
			
		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->
	
	<?php
		$thumb = get_the_post_thumbnail_url();
		$featured_image_position = get_field('featured_image_position');
	?>
	
	<?php if (has_post_thumbnail()): ?>
	<div class='container post-hero-container'>
		<div class='post-hero-filter <?php the_field('hero_filter');?>'></div>
		<div class='post-hero' style="
						background-image: url('<?php echo $thumb; ?>');
						background-position:
						<?php if (!$featured_image_position)
								 { echo 'center'; }
							else { echo $featured_image_position; } ?>
						">
		</div>
	</div>
	<?php endif; ?>
	
	<div class="container entry-content">

		<?php the_content(); ?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			)
		);
		?>

	</div><!-- .entry-content -->

	<footer class="container entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
