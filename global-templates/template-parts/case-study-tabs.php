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

<div class='container case-studies-header'>
	<h2 id='cs-title'>More Inspiring Stories</h2>
	<?php
		
		echo '
		<ul class="nav nav-tabs cs-categories-list" role="tablist">
    		<li>
                <a class="tab" id="tab-all" class="active" href="#all" role="tab" data-toggle="tab">All</a>
            </li>
	    ';
	    
		// $args = array(
		// 	'taxonomy' => 'category',
		// 	'hide_empty' => 0
		// );
		
		$categories = get_terms(['taxonomy' => 'case-study-category', 'hide_empty' => false,]);
		// $c_keep = array();
		
		// foreach($categories as $category){
		// 	$cat_type = get_field('category_type', 'category_'.$category->term_id);
		// 	if ($cat_type=='case-studies') {
		// 	$c_keep[] = $category;
		// 	}
		// }
		
		foreach($categories as $category){
	        echo 
	            '<li>
	                <a id="tab-'.$category->slug.'" href="#'.$category->slug.'" data-toggle="tab">    
	                    '.$category->name.'
	                </a>
	            </li>';
		} 
	  
	    echo '</ul>';
	?>
</div>