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

<a href="<?php the_permalink(); ?>">
	<div class='cs-thumb-filter'>
		<h3><?php the_title(); ?></h3>
		<p>
		<?php foreach ( $categories as $i => $category ) {
			echo esc_html( $category->name );
		    if ( $i > -1 ) {
			    echo " <span class='separator'>/</span> ";
		    }
		} ?>
		</p>
	</div>
	<div class='cs-thumb-wrapper' style='background-image:url("<?php echo $cs_img; ?>");'></div>						     
</a> 