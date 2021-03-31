<?php
$theme_path = get_template_directory_uri();
?>

<?php if( have_rows('social_media', 'option') ): ?>

	    <?php while( have_rows('social_media', 'option') ): the_row(); 
	
	        $social_media_type = get_sub_field('social_media_type', 'option');
	        $social_media_link = get_sub_field('social_media_link', 'option');
	    ?>
					
			<a href="<?php echo $social_media_link['url']; ?>" target="_blank">
				<img src="<?php echo $theme_path; ?>/assets/social-media/<?php echo $social_media_type; ?>-navy.png">
			</a>
					
    <?php endwhile; ?>

<?php endif; ?>
