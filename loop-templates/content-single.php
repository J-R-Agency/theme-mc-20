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

	<header class="entry-header">

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
			
			<div class='jetpack-share'>
				<?php
					if ( function_exists( 'sharing_display' ) ) {
					    sharing_display( '', true );
					}	
				?>
			</div>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<div class="entry-content">

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

	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
