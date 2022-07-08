<?php
/**
 * UnderStrap functions and definitions
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/jetpack.php',                         // Load Jetpack compatibility file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/understrap/understrap/issues/567.
	'/woocommerce.php',                     // Load WooCommerce functions.
	'/editor.php',                          // Load Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
);

foreach ( $understrap_includes as $file ) {
	require_once get_template_directory() . '/inc' . $file;
}

/*-- ADD ACF OPTIONS --*/

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	acf_add_options_sub_page("Header");
	acf_add_options_sub_page("Company Info");
	acf_add_options_sub_page("404 Page");
}

// Enqueue javascript
function my_theme_scripts() {
    wp_enqueue_script( 'menu', get_template_directory_uri() . '/js/menu.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'changePage', get_template_directory_uri() . '/js/changePage.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'scrollDown', get_template_directory_uri() . '/js/scrollDown.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'my_theme_scripts' );

// Register Menus
function register_my_menu() {
	register_nav_menu('secondary-menu',__( 'Secondary Menu' ));
	register_nav_menu('footer-menu',__( 'Footer Menu' ));
	register_nav_menu('secondary-footer-menu',__( 'Secondary Footer Menu' ));
	register_nav_menu('highlight-menu',__( 'Highlight Menu' ));
}
add_action( 'init', 'register_my_menu' );

//Add categories to pages
function add_taxonomies_to_pages() {
 register_taxonomy_for_object_type( 'post_tag', 'page' );
 register_taxonomy_for_object_type( 'category', 'page' );
 }
add_action( 'init', 'add_taxonomies_to_pages' );

// Custom search form
function custom_search_form( $form, $form_placeholder, $value = "Search", $post_type = 'post' ) {
    $form_value = (isset($value)) ? $value : attribute_escape(apply_filters('the_search_query', get_search_query()));
    $form = '<form method="get" id="searchform" action="' . get_home_url() . '/" >
    <div>
        <input type="hidden" name="post_type" value="'.$post_type.'" />
        <input type="text" placeholder="'.$form_placeholder.'" value="' . $form_value . '" name="s" id="s" />
        <input type="submit" id="searchsubmit" value="'.attribute_escape(__('Search')).'" />
    </div>
    </form>';
    return $form;
}

//Add read time
function prefix_estimated_reading_time( $content = '', $wpm = 300 ) {
	$clean_content = strip_shortcodes( $content );
	$clean_content = strip_tags( $clean_content );
	$word_count = str_word_count( $clean_content );
	$time = ceil( $word_count / $wpm );
	return $time;
}

// Hide jetpack
function sv_remove_jp_sharing() {
    if (function_exists( 'sharing_display' ) ) {
        remove_filter( 'the_content', 'sharing_display', 19 );
        remove_filter( 'the_excerpt', 'sharing_display', 19 );
    }
}
add_action( 'loop_start', 'sv_remove_jp_sharing' );

// Fix category page pagination 404 error
add_action( 'init', 'wpa58471_category_base' );
function wpa58471_category_base() {
    add_rewrite_rule(
        'blog/([^/]+)/page/(\d+)/?$',
        'index.php?category_name=$matches[1]&paged=$matches[2]',
        'top' 
    );
    add_rewrite_rule( 
        'blog/([^/]+)/(feed|rdf|rss|rss2|atom)/?$',
        'index.php?category_name=$matches[1]&feed=$matches[2]', 
        'top' 
    );
}

// Add menu item custom fields
add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

function my_wp_nav_menu_objects( $items, $args ) {
	
	foreach( $items as &$item ) {
		
		//$menu_icon = get_field('menu_icon', $item);
		$menu_caption = get_field('menu_caption', $item);
		
/*
		if( $menu_icon ) {
			$item->title = "<div class='test'></div>" . $item->title;
		}
*/
		
		if ($menu_caption) {
			$item->title = '<strong>'.$item->title.'</strong>';
			$item->title .= '<span>'.$menu_caption.'</span>';
		}
		
	}
	return $items;
}

// START Stop removing div tags from WordPress - Linklay
function ikreativ_tinymce_fix( $init )
{
    // html elements being stripped
    $init['extended_valid_elements'] = 'div[*]';

    // pass back to wordpress
    return $init;
}
add_filter('tiny_mce_before_init', 'ikreativ_tiny_mce_fix');

// END Stop removing div tags from WordPress - Linklay


//-------------------------------------------------------//
//----------------- CUSTOM POST TYPES ------------------//
//-----------------------------------------------------//


// TEAM MEMBERS

function team_members() {
 
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Team Members', 'Post Type General Name'),
        'singular_name'       => _x( 'Team Member', 'Post Type Singular Name'),
        'menu_name'           => __( 'Team Members'),
        'parent_item_colon'   => __( 'Parent Team Member'),
        'all_items'           => __( 'All Team Members'),
        'view_item'           => __( 'View Team Member'),
        'add_new_item'        => __( 'Add New Team Member'),
        'add_new'             => __( 'Add New'),
        'edit_item'           => __( 'Edit Team Member'),
        'update_item'         => __( 'Update Team Member'),
        'search_items'        => __( 'Search Team Member'),
        'not_found'           => __( 'Not Found'),
        'not_found_in_trash'  => __( 'Not found in Trash'),
    );
     
// Set other options for Custom Post Type
     
    $args = array(
        'label'               => __( 'Team Members'),
        'description'         => __( 'The team at Matchstick Creative'),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'revisions', 'custom-fields', 'menu_order', 'page-attributes'),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'menu_icon'			  => 'dashicons-buddicons-buddypress-logo',
        'capability_type'     => 'post',
        'show_in_rest' => true,
 
    );
     
    // Registering your Custom Post Type
    register_post_type( 'team-members', $args );
 
}
 
add_action( 'init', 'team_members', 0 );

// CASE STUDIES
function case_studies() {
 
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Case Studies', 'Post Type General Name'),
        'singular_name'       => _x( 'Case Study', 'Post Type Singular Name'),
        'menu_name'           => __( 'Case Studies'),
        'parent_item_colon'   => __( 'Parent Case Study'),
        'all_items'           => __( 'All Case Studies'),
        'view_item'           => __( 'View Case Study'),
        'add_new_item'        => __( 'Add New Case Study'),
        'add_new'             => __( 'Add New'),
        'edit_item'           => __( 'Edit Case Study'),
        'update_item'         => __( 'Update Case Study'),
        'search_items'        => __( 'Search Case Study'),
        'not_found'           => __( 'Not Found'),
        'not_found_in_trash'  => __( 'Not found in Trash'),
    );
     
// Set other options for Custom Post Type
     
    $args = array(
        'label'               => __( 'Case Studies'),
        'description'         => __( 'Collection of our work'),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'revisions', 'custom-fields', 'menu_order', 'thumbnail', 'page-attributes'),
        'taxonomies'          => array( 'case-study-category' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => true,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 6,
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'menu_icon'           => 'dashicons-portfolio',
        'capability_type'     => 'post',
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'our-work')
    );
     
    // Registering your Custom Post Type
    register_post_type( 'case-studies', $args );
 
}
 
add_action( 'init', 'case_studies', 0 );


// ================================= Custom Post Type Taxonomies =================================
function create_case_study_taxonomy() {  
    register_taxonomy(  
        'case-study-category',             // This is a name of the taxonomy. Make sure it's not a capital letter and no space in between
        'case-studies',                   //post type name
        array(  
            'hierarchical' => true,  
            'label' => 'Categories',   //Display name
            'query_var' => true,
            'has_archive' => false,
            "show_ui" => true,
            'show_admin_column' => true
        )  
    );  
}  
add_action( 'init', 'create_case_study_taxonomy');
