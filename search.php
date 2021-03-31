<?php
/**
 * The template for displaying search results pages
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$bw = 'black';
$page_color = 'pink';
$header_position = get_field('header_position');


include( locate_template( 'header.php', false, false ) );  ?>

<section class="container generic bg-white" id="search-wrapper">

	<div id="content" tabindex="-1">
		<a class='take-back pink' href="<?php site_url(); ?>/helpful-stuff">Take me back to Helpful Stuff</a>

		<?php if ( have_posts() ) : ?>

			<header class="page-header">

					<h1 class="page-title">
						<?php
						printf(
							/* translators: %s: query term */
							esc_html__( 'Search results for: %s', 'understrap' ),
							'<span>' . get_search_query() . '</span>'
						);
						?>
					</h1>

			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php
			while ( have_posts() ) :
				the_post();

				/*
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'loop-templates/content', 'search' );
			endwhile;
			?>

			<?php else : ?>

				<?php get_template_part( 'loop-templates/content', 'none' ); ?>

			<?php endif; ?>

		<!-- The pagination component -->
		<div class='understrap-pagination'>
			<?php understrap_pagination(); ?>
		</div>

	</div><!-- #content -->

</section><!-- #search-wrapper -->

<?php
get_footer();
