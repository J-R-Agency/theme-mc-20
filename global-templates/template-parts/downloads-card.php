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

        if( get_row_layout() == 'file_card' ):

			$fc_file_name = get_sub_field('fc_file_name');
			$fc_image = get_sub_field('fc_image');
			$fc_file = get_sub_field('fc_file');
			$fc_color = get_sub_field('fc_color');

			if (!$fc_image) {
				$fc_image['url'] = $theme_path."/assets/images/download-card-placeholder.jpg";
			}
			
			if (!$fc_link['target']) {
				$fc_link['target'] = '_self';
			}

			echo "
			<div class='download-card-container'>
				<a href='".$fc_file['url']."' download>
			";
			
			if ($fc_file_name) {
			echo "
				<div class='download-card-header ".$fc_color."'>
					<h3>".$fc_file_name."</h3>
				</div>			
			";
			}
			
			echo "
				<div class='download-card-img' style='background-image:url(".$fc_image['url'].")'></div>
				<div class='ribbon-wrapper'>
					<div class='download-card-ribbon ".$fc_color."'></div>
				</div>
			</a>
			";
			
        elseif( get_row_layout() == 'link_card' ): 

			// vars
			$lc_file_name = get_sub_field('lc_file_name');
			$lc_image = get_sub_field('lc_image');
			$lc_link = get_sub_field('lc_link');
			$lc_color = get_sub_field('lc_color');

			if (!$lc_image) {
				$lc_image['url'] = $theme_path."/assets/images/download-card-placeholder.jpg";
			}
			
			if (!$lc_link['target']) {
				$lc_link['target'] = '_self';
			}
						
			echo "
			<div class='download-card-container'>
				<a href='".$lc_link['url']."' target='".$lc_link['target']."'>
			";
			
			if ($lc_file_name) {
			echo "
				<div class='download-card-header ".$lc_color."'>
					<h3>".$lc_file_name."</h3>
				</div>			
			";
			}
			
			echo "
				<div class='download-card-img' style='background-image:url(".$lc_image['url'].")'></div>
				<div class='ribbon-wrapper'>
					<div class='download-card-ribbon ".$lc_color."'></div>
				</div>
			</a>
			";

        endif;
		?>
			
		</div> <!-- end download card container -->
		
	<?php endwhile; ?>
	</div> <!-- end downloads container -->
</section>	
<?php endif; ?>