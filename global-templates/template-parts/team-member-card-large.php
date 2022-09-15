<?php
/**
 *  Blog-card-large
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$theme_path = get_template_directory_uri();
?>

<?php
	echo "
	<div class='team-card--large'>
		<div class='team-card__info'>
				<h3>".$team_name."</h3>
				<p>".$team_position."</p>
		</div>
		<img class='team-portrait' src='".$team_portrait['sizes']['large']."' alt='".$team_portrait['alt']."'>
		";
			
			if( have_rows('team_social_media', $team_member->ID)):
			
				echo "<div class='team-card__social-media'>";
				while( have_rows('team_social_media', $team_member->ID)): the_row();
				
				$social_media_type = get_sub_field('social_media_type');
				$social_media_link = get_sub_field('social_media_link');
				
				echo "
					<a href='".$social_media_link['url']."' target='_blank'>
						<img src='".$theme_path."/assets/social-media/".$social_media_type."-cyan.png'>
					</a>";
				endwhile;
				echo "</div>";
			endif;
		
	echo "</div>";
?>