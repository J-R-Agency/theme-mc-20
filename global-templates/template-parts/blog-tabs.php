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

<div class='blog-posts-header'>
	<h2 id='bp-title'>Helpful Stuff</h2>
	<?php
		echo '<ul class="nav nav-tabs bp-categories-list" role="tablist">
	    		<li>
	                <a class="tab" id="tab-all" class="active" href="#all" role="tab" data-toggle="tab">All</a>
	            </li>
	    
	    ';
	    $args = array(
	        'orderby' => 'name',
	        'order' => 'ASC'
	    );
	    $categories = get_categories($args);
	    foreach($categories as $category) { 
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