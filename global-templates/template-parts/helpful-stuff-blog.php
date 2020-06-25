<?php
/**
 * Helpful Stuff Blog
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$theme_path = get_template_directory_uri();
?>

<?php if( have_rows('blog_tabs') ): ?>
	<?php while( have_rows('blog_tabs') ): the_row(); 

		// vars
		$bt_title = get_sub_field('bt_title');
		$bt_subtitle = get_sub_field('bt_subtitle');
		$bt_link_text = get_sub_field('bt_link_text');
		
		?>

		<section class="generic bg-white">
			
			<!-- Blog tabs -->
			<div class='blog-posts-header'>
			<h2 id='bp-title'><?php echo $bt_title; ?></h2>
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
			
			<!-- Subtitle -->
			<p class='hs-subtitle'><?php echo $bt_subtitle; ?></p>
			
			<!-- Blog posts -->
			<div class='blog-posts-container'>		
				<?php
				    echo '<div class="tab-content">';
				    
				    echo "<div class='tab-pane active' id='all'>
				    		<div class='blog-posts-container all'>
				    ";
				    	//$female_founders = get_cat_ID('#FemaleFounders');
				    	//$excluded_cats = array( $female_founders );
				    	
						$args = array(
						    'post_type'      => 'post', //write slug of post type
						    'posts_per_page' => 2,
						    'order'          => 'DESC',
						    //'category__not_in' => $excluded_cats,
						 );
						 
						$query = new WP_Query( $args );
						 
						if ( $query->have_posts() ) :
						 
						    while ( $query->have_posts() ) : $query->the_post();
							 	
								$card_color = 'light-grey';
								$categories = get_the_category();
		
								include (get_template_directory().'/global-templates/template-parts/blog-card.php');	
								
								
							endwhile;
							
						endif; 
						wp_reset_query();
				        
				    echo "</div>
				    </div>";
				    
				    
				    $args = array(
				        'orderby' => 'name',
				        'order' => 'ASC'
				    );
				    $categories = get_categories($args);
				    
				    foreach($categories as $category) {
				        echo "<div class='tab-pane' id='". $category->slug."'>
				        		<div class='blog-posts-container case-studies-container bpc-".$category->slug."'>
				        ";
				        
				        $args = array(
						    'post_type'      => 'post', //write slug of post type
						    'posts_per_page' => 6,
						    'order'          => 'DESC',
						    'category_name' => $category->slug,
						 );
						 
						$query = new WP_Query( $args );
						 
						if ( $query->have_posts() ) :
						 
						    while ( $query->have_posts() ) : $query->the_post();
							 	
								$mc_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
								$hover_color = 'pink';
								$categories = get_the_category();
								
								include (get_template_directory().'/global-templates/template-parts/blog-card-small.php');	
								
							endwhile;
						endif;
						
						echo "</div>"; // End bpc
										
						wp_reset_query();	
						
				        
				        echo "</div>"; // End container
				    }
				    
				    echo "</div>"; // End tab pane
				?>		
			</div>
			
		</section>
		
		<section class='link-block bg-light-grey'>
			<a href='<?php echo site_url();?>/archive'><?php echo $bt_link_text; ?><div class='arrow-link-pink'></div></a>
		</section>

	<?php endwhile; ?>
<?php endif; ?>