<?php
/**
 * Header info
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

	?>
<div class='navbar--<?php echo $page_color; ?> navbar__info'>

<!-- Email -->
<a class='navbar__email' href='mailto:<?php the_field('company_email', 'option'); ?>'>
	<h5><?php the_field('company_email', 'option'); ?></h5>
</a>

<!-- Phone number -->
<a class='navbar__phone-number' href='tel:<?php the_field('company_phone', 'option'); ?>'>
	<h5><?php the_field('company_phone', 'option'); ?></h5>
</a>

<!-- Social media -->
<div class='navbar__social-media' style="background-image:url('<?php echo get_template_directory_uri();?>/assets/graphics/header-sm-bg-<?php echo $page_color;?>.png');">
	<?php include(get_template_directory() . '/global-templates/template-parts/social-media.php'); ?>
</div>
</div>		
