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
		
		<a class='take-back' href="javascript:history.back()">Take me back</a>
		
		<?php
		while ( have_posts() ) {
			the_post();
			get_template_part( 'loop-templates/content', 'single' );
		}
		?>

	</main><!-- #main -->
</section>
<!-- More Blog Posts -->
<section class='generic bg-light-grey'>
	<h2 style="text-align: center; padding-bottom: 2rem;">Tasty Blogging Things</h2>
	<?php
		
		$currentID = get_the_ID();
			
		$args = array(
		    'post_type'      => 'post', //write slug of post type
		    'posts_per_page' => 2,
		    'order'          => 'DESC',
		    'post__not_in' => array($currentID)
		 );
		 
		 $query = new WP_Query($args);
		 
		 
		if ( $query->have_posts() ) :
		 
		    while ( $query->have_posts() ) : $query->the_post();
			 	
			 	$card_color = 'white';
				$categories = get_the_category();
				
				include (get_template_directory().'/global-templates/template-parts/blog-card.php');	
			
			endwhile;
		endif; 
		wp_reset_query();	
				
	?>	
</section>

<section class='link-block bg-white'>
	<a href='<?php echo site_url();?>/helpful-stuff'>Take me to more helpful stuff<div class='arrow-link-pink'></div></a>
</section>

<?php include( locate_template( 'footer.php', false, false ) ); ?>
