<?php
/**
 * Child case study card
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$theme_path = get_template_directory_uri();

?>

<a class='child-case-study-card<?php echo $current_class; ?>' href="<?php echo $permalink; ?>">
	<!-- image -->		
	<?php if($page_icon): ?>
		<img class='child-case-study-card__icon' src='<?php echo $page_icon['url'] ?>' alt='<?php echo $page_icon['alt'] ?>'>
	<?php else: ?>
		<img class='child-case-study-card__icon' src='<?php echo $theme_path ?>/assets/images/case-study-icon.svg' alt='Case study icon'>
	<?php endif; ?>
	<p class='child-case-study-card__title'><?php echo $title; ?></p>				     
</a> 