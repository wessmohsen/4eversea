<?php
if (! class_exists ( 'DTPlacePostType' )) {
	class DTPlacePostType {
		
		/**
		 * A function constructor calls initially
		 */
		function __construct() {
			// Add Hook into the 'init()' action
			add_action ( 'init', array (
				$this,
				'dt_init' 
			) );
			
			// Add Hook into the 'admin_init()' action
			add_action ( 'admin_init', array (
				$this,
				'dt_admin_init' 
			) );
			
			// Add Hook into the 'template_include' filter
			add_filter ( 'template_include', array (
				$this,
				'dt_template_include' 
			) );
			
			add_filter ( 'cs_metabox_options', array (
				$this,
				'dt_places_cs_metabox_options' 
			) );

			add_filter ( 'cs_framework_options', array (
				$this,
				'dt_places_cs_framework_options' 
			) );

			add_filter( 'trendytravel_header_footer_default_cpt', array(
				$this,
				'dt_header_footer_metabox_option'
			) );
		}

		/**
		 * A function hook that the WordPress core launches at 'init' points
		 */
		function dt_init() {
			$this->createPostType ();
		}

		/**
		 * A function hook that the WordPress core launches at 'admin_init' points
		 */
		function dt_admin_init() {
		
			add_filter ( "manage_edit-dt_places_columns", array (
					$this,
					"dt_places_edit_columns" 
			) );
			
			add_action ( "manage_posts_custom_column", array (
					$this,
					"dt_places_columns_display" 
			), 10, 2 );
			
		}

		/**
		 */
		function createPostType() {
		
			$placeslug = trendytravel_cs_get_option( 'single-places-slug', 'dt_places' );
			$placetaxslug = trendytravel_cs_get_option( 'places-category-slug', 'place_entries' );
		
			$labels = array (
					'name' => __ ( 'Places', 'designthemes-core' ),
					'all_items' => __ ( 'All Places', 'designthemes-core' ),
					'singular_name' => __ ( 'Place', 'designthemes-core' ),
					'add_new' => __ ( 'Add New', 'designthemes-core' ),
					'add_new_item' => __ ( 'Add New Place', 'designthemes-core' ),
					'edit_item' => __ ( 'Edit Place', 'designthemes-core' ),
					'new_item' => __ ( 'New Place', 'designthemes-core' ),
					'view_item' => __ ( 'View Place', 'designthemes-core' ),
					'search_items' => __ ( 'Search Places', 'designthemes-core' ),
					'not_found' => __ ( 'No Places found', 'designthemes-core' ),
					'not_found_in_trash' => __ ( 'No Places found in Trash', 'designthemes-core' ),
					'parent_item_colon' => __ ( 'Parent Place:', 'designthemes-core' ),
					'menu_name' => __ ( 'Places', 'designthemes-core' ) 
			);
			
			$args = array (
					'labels' => $labels,
					'hierarchical' => false,
					'description' => 'This is custom post type places',
					'supports' => array (
							'title',
							'editor',
							'excerpt',
							'comments',
							'thumbnail',
							'revisions'
					),
					
					'public' => true,
					'show_in_rest' => true,
					'show_ui' => true,
					'show_in_menu' => true,
					'menu_position' => 4,
					'menu_icon' => 'dashicons-admin-home',
					
					'show_in_nav_menus' => true,
					'publicly_queryable' => true,
					'exclude_from_search' => false,
					'has_archive' => true,
					'query_var' => true,
					'can_export' => true,
					'rewrite' => array( 'slug' => $placeslug ),
					'capability_type' => 'post' 
			);
			
			register_post_type ( 'dt_places', $args );
			
			register_taxonomy ( "place_entries", array (
					"dt_places"
			), array (
					"hierarchical" => true,
					"label" => "Categories",
					"singular_label" => "Category",
					"show_admin_column" => true,
					'show_in_rest' => true,
					"rewrite" => array( 'slug' => $placetaxslug ),
					"query_var" => true
			) );
			
		}

		/**
		 */
		function dt_places_cs_metabox_options( $options ) {

			$options[]    = array(
			  'id'        => '_place_settings',
			  'title'     => esc_html__('Custom Places Options', 'designthemes-core'),
			  'post_type' => 'dt_places',
			  'context'   => 'normal',
			  'priority'  => 'default',
			  'sections'  => array(
			
				array(
					'name'  => 'general_section',
					'title' => esc_html__('General Options', 'designthemes-core'),
					'icon'  => 'fa fa-cogs',
					'fields' => array(

						array(
							'id'      => 'enable-sub-title',
							'type'    => 'switcher',
							'title'   => esc_html__('Show Breadcrumb', 'designthemes-core' ),
							'default' => true
						),

						array(
							'id'	  => 'breadcrumb_position',
							'type'    => 'select',
							'title'   => esc_html__('Position', 'designthemes-core' ),
							'options' => array(
								'header-top-absolute'    => esc_html__('Behind the Header','designthemes-core'),
								'header-top-relative' 	   => esc_html__('Default','designthemes-core'),
							),
							'default'    => 'header-top-relative',
							'dependency'  => array( 'enable-sub-title', '==', 'true' ),
						), 

			
					array(
					  'id'    => 'breadcrumb_background',
					  'type'  => 'background',
					  'title' => esc_html__('Background', 'designthemes-core'),
					  'desc'  => esc_html__('Choose background options for breadcrumb title section.', 'designthemes-core'),
					  'dependency'   => array( 'enable-sub-title', '==', 'true' ),
					),
					
					array(
					  'id'  	=> 'place_add',
					  'type'  	=> 'textarea',
					  'title' 	=> esc_html__('Address of Hotel', 'designthemes-core'),
					  'info'	=> esc_html__('Add / Edit Hotel Address as you like here', 'designthemes-core'),
					  'default'	=> '272 Boylston St, Boston, MA 02116',
					  'attributes' => array(
						'rows'  => 3,
						'style'	=> 'min-height:75px;'
					  )
					),
					
					array(
					  'id'      => 'place_lat',
					  'type'    => 'text',
					  'title'   => esc_html__('Latitude', 'designthemes-core'),
					  'default'	=> '42.353068',
					  'desc'    => '<p class="cs-text-muted">'.esc_html__('Put the location latitude value. ( Use finder: https://ctrlq.org/maps/address/ ) ', 'designthemes-core').'</p>',
					  'attributes' => array(
					  )
					),
					
					array(
					  'id'      => 'place_long',
					  'type'    => 'text',
					  'title'   => esc_html__('Longitude', 'designthemes-core'),
					  'default'	=> '-71.0765188',
					  'desc'    => '<p class="cs-text-muted">'.esc_html__('Put the location longitude value. ( Use finder: https://ctrlq.org/maps/address/ ) ', 'designthemes-core').'</p>',
					  'attributes' => array(
					  )
					),
					
					array(
					  'id'      	 => 'layout',
					  'type'         => 'image_select',
					  'title'        => esc_html__('Layout', 'designthemes-core'),
					  'options'      => array(
						'content-full-width'   => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/without-sidebar.png',
						'with-left-sidebar'    => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/left-sidebar.png',
						'with-right-sidebar'   => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/right-sidebar.png',
						'with-both-sidebar'   => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/both-sidebar.png',
					  ),
					  'default'      => 'content-full-width',
					  'attributes'   => array(
						'data-depend-id' => 'layout',
					  ),
					),
					
					array(
					  'id'  		 => 'show-standard-sidebar-left',
					  'type'  		 => 'switcher',
					  'title' 		 => esc_html__('Show Standard Left Sidebar', 'designthemes-core'),
					  'dependency'   => array( 'layout', 'any', 'with-left-sidebar,with-both-sidebar' ),
					  'default' => true
					),

					array(
					  'id'  		 => 'widget-area-left',
					  'type'  		 => 'select',
					  'title' 		 => esc_html__('Choose Widget Area - Left Sidebar', 'designthemes-core'),
					  'class'		 => 'chosen',
					  'options'   	 => trendytravel_custom_widgets(),
					  'attributes'   => array(
					  	'multiple'  	   => 'multiple',
						'data-placeholder' => esc_attr__('Select Widget Areas', 'designthemes-core'),
					    'style' 		   => 'width: 400px;'
					  ),
					  'dependency'   => array( 'layout', 'any', 'with-left-sidebar,with-both-sidebar' ),
					),

					array(
					  'id'  		 => 'show-standard-sidebar-right',
					  'type'  		 => 'switcher',
					  'title' 		 => esc_html__('Show Standard Right Sidebar', 'designthemes-core'),
					  'dependency'   => array( 'layout', 'any', 'with-right-sidebar,with-both-sidebar' ),
					  'default' 	=> true
					),
					
					array(
					  'id'  		 => 'widget-area-right',
					  'type'  		 => 'select',
					  'title' 		 => esc_html__('Choose Widget Area - Right Sidebar', 'designthemes-core'),
					  'class'		 => 'chosen',
					  'options'   	 => trendytravel_custom_widgets(),
					  'attributes'   => array(
					  	'multiple'  	   => 'multiple',
						'data-placeholder' => esc_attr__('Select Widget Areas', 'designthemes-core'),
					    'style' 		   => 'width: 400px;'
					  ),
					  'dependency'   => array( 'layout', 'any', 'with-right-sidebar,with-both-sidebar' ),
					),
					
					array(
							'id'      => 'show-hotels-list',
							'type'    => 'switcher',
							'title'   => esc_html__('Show Hotels & Dest', 'designthemes-core' ),
							'desc'    => '<p class="cs-text-muted">'.esc_html__('Would you like to show the hotels list & popular destinations', 'designthemes-core').'</p>',
							'default' => true
						),
						
					array(
					  'id'             => 'place-hotels-list',
					  'type'           => 'select',
					  'title'          => esc_html__('Choose Hotels','designthemes-core'),
					  'options'        => 'posts',
					  'class'          => 'chosen',
					  'query_args'     => array(
						'post_type'         => 'dt_hotels',
						'orderby'      => 'post_date',
						'order'        => 'DESC',
					  ),
					  'attributes'         => array(
						'data-placeholder' => esc_html__('Select Hotels','designthemes-core'),
						'multiple'         => 'only-key',
						'style'            => 'width: 300px;'
					  ),
					  'info'           => esc_html__('You can choose place under a hotel in the booking page.','designthemes-core'),
					),
					
					array(
					  'id'             => 'place-destinations-list',
					  'type'           => 'select',
					  'title'          => esc_html__('Choose Destinations','designthemes-core'),
					  'options'        => 'posts',
					  'class'          => 'chosen',
					  'query_args'     => array(
						'post_type'         => 'dt_places',
						'orderby'      => 'post_date',
						'order'        => 'DESC',
					  ),
					  'attributes'         => array(
						'data-placeholder' => esc_html__('Select Destinations','designthemes-core'),
						'multiple'         => 'only-key',
						'style'            => 'width: 300px;'
					  ),
					  'info'           => esc_html__('You can choose destinations to show in this place page.','designthemes-core'),
					),
						
					array(
						'id'      => 'show-reviews',
						'type'    => 'switcher',
						'title'   => esc_html__('Show Reviews', 'designthemes-core' ),
						'desc'    => '<p class="cs-text-muted">'.esc_html__('Would you like to show the reviews & ratings', 'designthemes-core').'</p>',
						'default' => true
					),
						
					array(
						'id'      => 'show-recommends',
						'type'    => 'switcher',
						'title'   => esc_html__('Show Recommends', 'designthemes-core' ),
						'desc'    => '<p class="cs-text-muted">'.esc_html__('Would you like to show the recommendations', 'designthemes-core').'</p>',
						'default' => true
					),
					
					array(
					  'id'          => 'places-gallery',
					  'type'        => 'gallery',
					  'title'       => esc_html__('Place Images', 'designthemes-core'),
					  'desc'        => esc_html__('Simply add images to place items.', 'designthemes-core'),
					  'add_title'   => esc_html__('Add Images', 'designthemes-core'),
					  'edit_title'  => esc_html__('Edit Images', 'designthemes-core'),
					  'clear_title' => esc_html__('Remove Images', 'designthemes-core')
					),
					
				  ), // end: fields
				), // end: a section

			  ),
			);
			
			return $options;
		}			

		/**
		 */
		function dt_places_cs_framework_options( $options ) {
			
			$options[]      = array(
			  'name'        => 'place-types',
			  'title'       => esc_html__('Places', 'designthemes-core'),
			  'icon'        => 'fa fa-map-marker',
			
			  'fields'      => array(

				array(
				  'type'    => 'subheading',
				  'content' => esc_html__( 'Places Archives Page Layout', 'designthemes-core' ),
				),
				
				array(
				  'id'      	 => 'places-archives-page-layout',
				  'type'         => 'image_select',
				  'title'        => esc_html__('Page Layout', 'designthemes-core'),
				  'options'      => array(
					'content-full-width'   => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/without-sidebar.png',
					'with-left-sidebar'    => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/left-sidebar.png',
					'with-right-sidebar'   => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/right-sidebar.png',
					'with-both-sidebar'    => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/both-sidebar.png',
				  ),
				  'default'      => 'content-full-width',
				  'attributes'   => array(
					'data-depend-id' => 'places-archives-page-layout',
				  ),
				),
				
				array(
				  'id'  		 => 'show-standard-left-sidebar-for-places-archives',
				  'type'  		 => 'switcher',
				  'title' 		 => esc_html__('Show Standard Left Sidebar', 'designthemes-core'),
				  'dependency'   => array( 'places-archives-page-layout', 'any', 'with-left-sidebar,with-both-sidebar' ),
				  'default' => true
				),
			
				array(
				  'id'  		 => 'show-standard-right-sidebar-for-places-archives',
				  'type'  		 => 'switcher',
				  'title' 		 => esc_html__('Show Standard Right Sidebar', 'designthemes-core'),
				  'dependency'   => array( 'places-archives-page-layout', 'any', 'with-right-sidebar,with-both-sidebar' ),
				  'default' => true
				),
				
				array(
				  'type'    => 'subheading',
				  'content' => esc_html__( 'Places Archives Post Layout', 'designthemes-core' ),
				),
				
				array(
				  'id'      	 => 'places-archives-post-layout',
				  'type'         => 'image_select',
				  'title'        => esc_html__('Post Layout', 'designthemes-core'),
				  'options'      => array(
					'one-half-column'   => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/one-half-column.png',
					'one-third-column'  => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/one-third-column.png',
					'one-fourth-column' => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/one-fourth-column.png',
				  ),
				  'default'      => 'one-half-column',
				),
				
				array(
				  'type'    => 'subheading',
				  'content' => esc_html__( 'Permalinks', 'designthemes-core' ),
				),
				
				array(
				  'id'      => 'single-places-slug',
				  'type'    => 'text',
				  'title'   => esc_html__('Single Places Slug', 'designthemes-core'),
				  'after' 	=> '<p class="cs-text-info">'.esc_html__('Do not use characters not allowed in links. Use, eg. places-item ', 'designthemes-core').'<br> <b>'.esc_html__('After made changes save permalinks.', 'designthemes-core').'</b></p>',
				),
				
				array(
				  'id'      => 'places-category-slug',
				  'type'    => 'text',
				  'title'   => esc_html__('Places Category Slug', 'designthemes-core'),
				  'after' 	=> '<p class="cs-text-info">'.esc_html__('Do not use characters not allowed in links. Use, eg. places-types ', 'designthemes-core').'<br> <b>'.esc_html__('After made changes save permalinks.', 'designthemes-core').'</b></p>',
				),

			  ),
			);

			return $options;
		}

		/*function dt_places_wp_enqueue_scripts() {

			wp_enqueue_style( 'trendytravel-places',	  plugin_dir_url ( __FILE__ ) . 'css/places.css', false, TRENDYTRAVEL_THEME_VERSION, 'all' );
			wp_enqueue_script ( 'dt-sc-places-custom-script', plugin_dir_url ( __FILE__ ) . 'js/protfolio-custom.js', array ('jquery'), false, true );

		}*/

		/**
		 *
		 * @param unknown $columns        	
		 * @return multitype:
		 */
		function dt_places_edit_columns($columns) {

			$newcolumns = array (
				"cb" => "<input type=\"checkbox\" />",
				"dt_places_thumb" => esc_html__("Image", 'designthemes-core'),
				"title" => esc_html__("Title", 'designthemes-core'),
				"author" => esc_html__("Author", 'designthemes-core')
			);
			$columns = array_merge ( $newcolumns, $columns );
			return $columns;
		}

		/**
		 *
		 * @param unknown $columns
		 * @param unknown $id
		 */
		function dt_places_columns_display($columns, $id) {
		
			global $post;
			switch ($columns) {

				case "dt_places_thumb" :
				    $image = wp_get_attachment_image(get_post_thumbnail_id($id), array(75,75));
					if(!empty($image)):
					  	echo ($image);
				    else:
						$places_settings = get_post_meta ( $post->ID, '_places_settings', TRUE );
						$places_settings = is_array ( $places_settings ) ? $places_settings : array ();

						if( array_key_exists("places-gallery", $places_settings)) {
							$items = explode(',', $places_settings["places-gallery"]);
							echo wp_get_attachment_image( $items[0], array(75, 75) );
						}
					endif;
				break;
			}
		}

		/**
		 * To load places pages in front end
		 *
		 * @param string $template
		 * @return string
		 */
		function dt_template_include($template) {
		
			if (is_singular( 'dt_places' )) {
				if (! file_exists ( get_stylesheet_directory () . '/single-dt_places.php' )) {
					$template = plugin_dir_path ( __FILE__ ) . 'templates/single-dt_places.php';
				}			
			} elseif (is_tax ( 'place_entries' )) {
				if (! file_exists ( get_stylesheet_directory () . '/taxonomy-place_entries.php' )) {
					$template = plugin_dir_path ( __FILE__ ) . 'templates/taxonomy-place_entries.php';
				}
			} elseif (is_post_type_archive ( 'dt_places' )) {
				if (! file_exists ( get_stylesheet_directory () . '/archive-dt_places.php' )) {
					$template = plugin_dir_path ( __FILE__ ) . 'templates/archive-dt_places.php';
				}					
			}
			return $template;
		}

		function dt_header_footer_metabox_option( $post_types ) {

			array_push( $post_types, 'dt_places' );

			return $post_types;
		}
	}
}?>