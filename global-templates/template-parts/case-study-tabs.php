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
	    
		$args = array(
			'taxonomy' => 'category',
			'hide_empty' => 0
		);
		
		$c = get_categories($args);
		$c_keep = array();
		
		foreach($c as  $cat){
			$cat_type = get_field('category_type', 'category_'.$cat->term_id);
			if ($cat_type=='case-studies') {
			$c_keep[] = $cat;
			}
		}
		
		foreach($c_keep as $cat){
	        echo 
	            '<li>
	                <a id="tab-'.$cat->slug.'" href="#'.$cat->slug.'" data-toggle="tab">    
	                    '.$cat->name.'
	                </a>
	            </li>';
		} 
	  
	    echo '</ul>';
	?>
</div>