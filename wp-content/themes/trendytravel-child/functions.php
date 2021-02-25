<?php
//add_action( 'wp_enqueue_scripts', 'trendytravel_child_enqueue_styles', 100);
//function trendytravel_child_enqueue_styles() {
	//wp_enqueue_style( 'trendytravel-parent', get_theme_file_uri('/style.css') );
//}


// Register Custom Post Type ( Itineraries )
add_action('init', 'register_custom_posts_itineraries_init');
function register_custom_posts_itineraries_init() {
    // Register itineraries
    $itineraries_labels = array(
        'name'               => 'Itineraries',
        'singular_name'      => 'Itinerary',
        'menu_name'          => 'Itineraries'
    );
    $itineraries_args = array(
        'labels'             => $itineraries_labels,
        'public'             => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
		'menu_icon'          => 'dashicons-location-alt',
        'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' )
    );
    register_post_type('itineraries', $itineraries_args);
}



// Register Custom Post Type ( Boats )
add_action('init', 'register_custom_posts_boats_init');
function register_custom_posts_boats_init() {
    // Register boats
    $boats_labels = array(
        'name'               => 'Boats',
        'singular_name'      => 'Boat',
        'menu_name'          => 'Boats'
    );
    $boats_args = array(
        'labels'             => $boats_labels,
        'public'             => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'menu_icon'          => 'dashicons-sos',
        'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' )
    );
    register_post_type('boats', $boats_args);
}

//////////////////////////////////////////////////////////////////
///////////////// Dive Sites Post Type & Taxonomy ////////////////
//////////////////////////////////////////////////////////////////

// Register Custom Post Type ( Dive Sites )
add_action('init', 'register_custom_posts_dive_sites_init');
function register_custom_posts_dive_sites_init() {
    // Register Dive Sites
    $dive_sites_labels = array(
        'name'               => 'Dive Sites',
        'singular_name'      => 'Dive Site',
        'menu_name'          => 'Dive Sites'
    );
    $dive_sites_args = array(
        'labels'             => $dive_sites_labels,
        'public'             => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'menu_icon'          => 'dashicons-location',
        'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
		'rewrite' => array( 'slug' => 'dive-sites/%dive-sites-category%', 'with_front' => false ),
        'has_archive' => 'dive-sites-category',
    );
    register_post_type('dive-sites', $dive_sites_args);
}

// create Taxonomy for Dive Sites Custom Post Category
add_action( 'init', 'create_dive_sites_custom_taxonomy', 0 );
function create_dive_sites_custom_taxonomy() {

  $labels = array(
    'name' => _x( 'Dive Sites Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Dive Sites Categories' ),
    'all_items' => __( 'All Dive Sites Categories' ),
    'parent_item' => __( 'Parent Category' ),
    'parent_item_colon' => __( 'Parent Category:' ),
    'edit_item' => __( 'Edit Category' ), 
    'update_item' => __( 'Update Category' ),
    'add_new_item' => __( 'Add New Category' ),
    'new_item_name' => __( 'New Category Name' ),
    'menu_name' => __( 'Dive Sites Categories' ),
  );    
 
  register_taxonomy('dive-sites-category',array('dive-sites'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
	'rewrite' => array('slug' => 'dive-sites-category' , 'with_front' => false),
  ));
}

function wm_dive_sites_permalinks( $post_link, $post ){
    if ( is_object( $post ) && $post->post_type == 'dive-sites' ){
        $terms = wp_get_object_terms( $post->ID, 'dive-sites-category' );
        if( $terms ){
            return str_replace( '%dive-sites-category%' , $terms[0]->slug , $post_link );
        }
    }
    return $post_link;
}
add_filter( 'post_type_link', 'wm_dive_sites_permalinks', 1, 2 );

/////////////////////////////////////////////////////////////////////////
///////////////// End of Dive Sites Post Type & Taxonomy ////////////////
/////////////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////////
///////////////// Courses Post Type & Taxonomy ////////////////
//////////////////////////////////////////////////////////////////

// Register Custom Post Type ( Courses )
add_action('init', 'register_custom_posts_courses_init');
function register_custom_posts_courses_init() {
    // Register Courses
    $courses_labels = array(
        'name'               => 'Courses',
        'singular_name'      => 'Courses',
        'menu_name'          => 'Courses'
    );
    $courses_args = array(
        'labels'             => $courses_labels,
        'public'             => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'menu_icon'          => 'dashicons-book-alt',
        'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
        'rewrite' => array( 'slug' => 'courses/%courses-category%', 'with_front' => false ),
        'has_archive' => 'courses-category',
    );
    register_post_type('courses', $courses_args);
}

// create Taxonomy for Courses Custom Post Category
add_action( 'init', 'create_courses_custom_taxonomy', 0 );
function create_courses_custom_taxonomy() {

    $labels = array(
        'name' => _x( 'Courses Categories', 'taxonomy general name' ),
        'singular_name' => _x( 'Category', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Courses Categories' ),
        'all_items' => __( 'All Courses Categories' ),
        'parent_item' => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item' => __( 'Edit Category' ),
        'update_item' => __( 'Update Category' ),
        'add_new_item' => __( 'Add New Category' ),
        'new_item_name' => __( 'New Category Name' ),
        'menu_name' => __( 'Courses Categories' ),
    );

    register_taxonomy('courses-category',array('courses'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'courses-category' , 'with_front' => false),
    ));
}

function wm_courses_permalinks( $post_link, $post ){
    if ( is_object( $post ) && $post->post_type == 'courses' ){
        $terms = wp_get_object_terms( $post->ID, 'courses-category' );
        if( $terms ){
            return str_replace( '%courses-category%' , $terms[0]->slug , $post_link );
        }
    }
    return $post_link;
}
add_filter( 'post_type_link', 'wm_courses_permalinks', 1, 2 );

/////////////////////////////////////////////////////////////////////////
///////////////// End of Courses Post Type & Taxonomy ////////////////
/////////////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////////
///////////////// Trips Post Type & Taxonomy ////////////////
//////////////////////////////////////////////////////////////////

// Register Custom Post Type ( Trips )
add_action('init', 'register_custom_posts_trips_init');
function register_custom_posts_trips_init() {
    // Register Trips
    $trips_labels = array(
        'name'               => 'Trips',
        'singular_name'      => 'Trips',
        'menu_name'          => 'Trips'
    );
    $trips_args = array(
        'labels'             => $trips_labels,
        'public'             => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'menu_icon'          => 'dashicons-smiley',
        'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
		'rewrite' => array( 'slug' => 'trips/%trips-category%', 'with_front' => false ),
        'has_archive' => 'trips-category',
    );
    register_post_type('trips', $trips_args);
}

// create Taxonomy for Trips Custom Post Category
add_action( 'init', 'create_trips_custom_taxonomy', 0 );
function create_trips_custom_taxonomy() {

  $labels = array(
    'name' => _x( 'Trips Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Trips Categories' ),
    'all_items' => __( 'All Trips Categories' ),
    'parent_item' => __( 'Parent Category' ),
    'parent_item_colon' => __( 'Parent Category:' ),
    'edit_item' => __( 'Edit Category' ), 
    'update_item' => __( 'Update Category' ),
    'add_new_item' => __( 'Add New Category' ),
    'new_item_name' => __( 'New Category Name' ),
    'menu_name' => __( 'Trips Categories' ),
  );    
 
  register_taxonomy('trips-category',array('trips'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
	'rewrite' => array('slug' => 'trips-category' , 'with_front' => false),
  ));
}

function wm_trips_permalinks( $post_link, $post ){
    if ( is_object( $post ) && $post->post_type == 'trips' ){
        $terms = wp_get_object_terms( $post->ID, 'trips-category' );
        if( $terms ){
            return str_replace( '%trips-category%' , $terms[0]->slug , $post_link );
        }
    }
    return $post_link;
}
add_filter( 'post_type_link', 'wm_trips_permalinks', 1, 2 );

add_action( 'init', 'trips_register_taxonomy_for_object_type' );
function trips_register_taxonomy_for_object_type() {
    register_taxonomy_for_object_type( 'post_tag', 'trips' );
};


/////////////////////////////////////////////////////////////////////////
///////////////// End of Trips Post Type & Taxonomy ////////////////
/////////////////////////////////////////////////////////////////////////



////////////////////////////////////////////////////////////
/////////// Fix Tags Issue with Custom Post Type//////////
////////////////////////////////////////////////////////////
add_action('pre_get_posts', function($query) {
  // This will target the queries used to generate the tag archive template.
  // You may remove the `is_main_query()` condition if you want to get posts
  // by tag outside the loop.
  if (!is_admin() && is_tag() && $query->is_main_query()) {
    // Will set to something like: Array( 'post', 'portfolio' )
    $types = get_taxonomy('post_tag')->object_type;

    // Alter the query to only use the types which are registered to the
    // `post_tag` taxonomy.
    $query->set('post_type', $types);
  }
});
//////////////////// End Fix Tags Issue ////////////////////




function wess_slider(){
    if( is_single()  ){
            wp_register_style( 'wmslider_carousel', get_theme_file_uri('/slider/owl.carousel.min.css') );
			wp_enqueue_style( 'wmslider_carousel' );
			
			wp_register_style( 'wmslider_theme', get_theme_file_uri('/slider/owl.theme.default.min.css') );
			wp_enqueue_style( 'wmslider_theme' );
			
			wp_register_style( 'wmslider_animate', get_theme_file_uri('/slider/animate.min.css') );
			wp_enqueue_style( 'wmslider_animate' );
			
			wp_register_script( 'wmslider_carousel_js', get_theme_file_uri('/slider/owl.carousel.min.js') , array(), false, true );
			wp_enqueue_script('wmslider_carousel_js');

			wp_register_script( 'wmslider_custom_carousel', get_theme_file_uri('/slider/custom_slider.js') , array(), false, true );
			wp_enqueue_script('wmslider_custom_carousel');
    }
}
add_action('wp_enqueue_scripts', 'wess_slider');

function wess_modal(){
    //if( is_single() && (get_post_type()=='trips') ){
        wp_register_style( 'wess_modal_css', get_theme_file_uri('/modal/jquery.modal.min.css') );
        wp_enqueue_style( 'wess_modal_css' );

        wp_register_script( 'wess_modal_js', get_theme_file_uri('/modal/jquery.modal.min.js') , array(), false, true );
        wp_enqueue_script('wess_modal_js');
    //}
}
add_action('wp_enqueue_scripts', 'wess_modal');












if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'The General Settings',
		'menu_title'	=> 'General Settings',
		'menu_slug' 	=> 'the-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Trips Settings',
		'menu_title'	=> 'Trips Settings',
		'parent_slug'	=> 'the-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	
}



function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');