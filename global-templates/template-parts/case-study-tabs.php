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
	    
	    $content = get_cat_ID('content');
	    $experience = get_cat_ID('experience');
	    $full_service = get_cat_ID('full service');
	    $identity = get_cat_ID('identity');
	    
	    $included_cats = array( $content, $experience, $full_service, $identity );
	    
	    $args = array(
	        'orderby' => 'name',
	        'order' => 'ASC',
	        'include' => $included_cats
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