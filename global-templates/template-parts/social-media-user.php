<?php
$theme_path = get_template_directory_uri();
?>

<?php if( have_rows('social_media', 'option') ):
	$author_id = get_the_author_meta('ID');
?>
		
	    <?php while( have_rows('user_social_media', 'user_'. $author_id ) ): the_row(); 
			
	        $usm_type = get_sub_field('usm_type', 'user_'. $author_id );
	        $usm_link = get_sub_field('usm_link', 'user_'. $author_id );
	    ?>
					
			<a href="<?php echo $usm_link['url']; ?>" target="_blank">
				<img src="<?php echo $theme_path; ?>/assets/social-media/<?php echo $usm_type; ?>-grey.png">
			</a>
					
    <?php endwhile; ?>

<?php endif; ?>
