<?php
/**
 * The template for displaying all single posts
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$bw = 'black';
$page_color = 'pink';
$header_position = get_field('header_position');

include( locate_template( 'header.php', false, false ) ); 
?>


<section class="generic bg-white">
	
	<main class="site-main" id="main">

		<?php
		while ( have_posts() ) {
			the_post();
			get_template_part( 'loop-templates/content', 'single' );
		}
		?>

	</main><!-- #main -->
</section>


<?php if (is_singular('post')): ?>
<!-- More Blog Posts -->
<section class='bg-light-grey'>
	<div class='container'>
		<h2 style="text-align: center; padding-bottom: 2rem;">Even more Helpful Stuff</h2>
		<div class='small-card-container'>
			<?php
				
				$currentID = get_the_ID();
					
				$args = array(
				    'post_type'      => 'post', //write slug of post type
				    'posts_per_page' => 3,
				    'order'          => 'DESC',
				    'orderby'		 => 'rand',
				    'ignore_sticky_posts' => 1,
				    'post__not_in' => array($currentID)
				 );
				 
				 $query = new WP_Query($args);
				 
				 
				if ( $query->have_posts() ) :
				 
				    while ( $query->have_posts() ) : $query->the_post();
					 	
					 	$card_color = 'white';
						$categories = get_the_category();
						
						include (get_template_directory().'/global-templates/template-parts/blog-card-small.php');	
					
					endwhile;
				endif; 
				wp_reset_query();	
						
			?>	
		</div>
	</div>
</section>

<section class='link-block bg-white'>
	<div class='container'>
		<a href='<?php echo site_url();?>/helpful-stuff'>Take me to more helpful stuff<div class='arrow-link__pink'></div></a>
	</div>
</section>

<?php endif; ?>

<script>
	(function ($) {
		$(".hero-filter").remove();
		$(".hero").remove();
		$(".sd-content").append("<img class='share-icon' src='<?=get_template_directory_uri()?>/assets/social-media/share-icon.png'>");
	})(jQuery); 
</script>

<?php include( locate_template( 'footer.php', false, false ) ); ?>
