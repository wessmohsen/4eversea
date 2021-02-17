<?php
if (! class_exists ( 'DTRoomPostType' )) {
	class DTRoomPostType {
		
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
				'dt_rooms_cs_metabox_options' 
			) );

			add_filter ( 'cs_framework_options', array (
				$this,
				'dt_rooms_cs_framework_options' 
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
		
			add_filter ( "manage_edit-dt_rooms_columns", array (
					$this,
					"dt_rooms_edit_columns" 
			) );
			
			add_action ( "manage_posts_custom_column", array (
					$this,
					"dt_rooms_columns_display" 
			), 10, 2 );
			
		}

		/**
		 */
		function createPostType() {
		
			$roomslug = trendytravel_cs_get_option( 'single-rooms-slug', 'dt_rooms' );
		
			$labels = array (
					'name' => __ ( 'Rooms', 'designthemes-core' ),
					'all_items' => __ ( 'All Rooms', 'designthemes-core' ),
					'singular_name' => __ ( 'Room', 'designthemes-core' ),
					'add_new' => __ ( 'Add New', 'designthemes-core' ),
					'add_new_item' => __ ( 'Add New Room', 'designthemes-core' ),
					'edit_item' => __ ( 'Edit Room', 'designthemes-core' ),
					'new_item' => __ ( 'New Room', 'designthemes-core' ),
					'view_item' => __ ( 'View Room', 'designthemes-core' ),
					'search_items' => __ ( 'Search Rooms', 'designthemes-core' ),
					'not_found' => __ ( 'No Rooms found', 'designthemes-core' ),
					'not_found_in_trash' => __ ( 'No Rooms found in Trash', 'designthemes-core' ),
					'parent_item_colon' => __ ( 'Parent Room:', 'designthemes-core' ),
					'menu_name' => __ ( 'Rooms', 'designthemes-core' ) 
			);
			
			$args = array (
					'labels' => $labels,
					'hierarchical' => false,
					'description' => 'This is custom post type rooms',
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
					'show_in_menu' => false,
					'menu_position' => 5,
					'menu_icon' => 'dashicons-admin-home',
					
					'show_in_nav_menus' => true,
					'publicly_queryable' => true,
					'exclude_from_search' => false,
					'has_archive' => true,
					'query_var' => true,
					'can_export' => true,
					'rewrite' => array( 'slug' => $roomslug ),
					'capability_type' => 'post' 
			);
			
			register_post_type ( 'dt_rooms', $args );
			
		}

		/**
		 */
		function dt_rooms_cs_metabox_options( $options ) {

			$options[]    = array(
			  'id'        => '_room_settings',
			  'title'     => esc_html__('Custom Rooms Options', 'designthemes-core'),
			  'post_type' => 'dt_rooms',
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
					  'id'      => 'room_occupancy',
					  'type'    => 'text',
					  'title'   => esc_html__('Occupancy', 'designthemes-core'),
					  'default'	=> '2 Person(s)',
					  'desc'    => '<p class="cs-text-muted">'.esc_html__('Put no.of persons occupancy for this room.', 'designthemes-core').'</p>',
					  'attributes' => array(
					  )
					),
					
					array(
					  'id'      => 'room_price',
					  'type'    => 'text',
					  'title'   => esc_html__('Price ($)', 'designthemes-core'),
					  'default'	=> '69.9',
					  'desc'    => '<p class="cs-text-muted">'.esc_html__('Put price of this room.', 'designthemes-core').'</p>',
					  'attributes' => array(
					  )
					),
					
					array(
					  'id'      => 'room_size',
					  'type'    => 'text',
					  'title'   => esc_html__('Room Size', 'designthemes-core'),
					  'default'	=> '55-66sqm / 425-475sqf',
					  'desc'    => '<p class="cs-text-muted">'.esc_html__('Put size of this room.', 'designthemes-core').'</p>',
					  'attributes' => array(
					  )
					),
					
					array(
					  'id'          => 'rooms-gallery',
					  'type'        => 'gallery',
					  'title'       => esc_html__('Room Images', 'designthemes-core'),
					  'desc'        => esc_html__('Simply add images to room items.', 'designthemes-core'),
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
		function dt_rooms_cs_framework_options( $options ) {
			
			$options[]      = array(
			  'name'        => 'room-types',
			  'title'       => esc_html__('Rooms', 'designthemes-core'),
			  'icon'        => 'fa fa-users',
			
			  'fields'      => array(

				array(
				  'type'    => 'subheading',
				  'content' => esc_html__( 'Rooms Detail Options', 'designthemes-core' ),
				),
				
				array(
				  'id'  		 => 'single-rooms-related',
				  'type'  		 => 'switcher',
				  'title' 		 => esc_html__('Show Related Rooms', 'designthemes-core'),
				  'label'		 => esc_html__('YES! to show related rooms items in single rooms.', 'designthemes-core')
				),
				
				array(
				  'id'           => 'single-rooms-related-style',
				  'type'         => 'select',
				  'title'        => esc_html__('Style', 'designthemes-core'),
				  'options'      => array(
					'type1'      => esc_html__('Modern Title', 'designthemes-core'),
					'type2'      => esc_html__('Title & Icons Overlay', 'designthemes-core'),
					'type3'      => esc_html__('Title Overlay', 'designthemes-core'),
					'type4'      => esc_html__('Icons Only', 'designthemes-core'),
					'type5'      => esc_html__('Classic', 'designthemes-core'),
					'type6'      => esc_html__('Minimal Icons', 'designthemes-core'),
					'type7'      => esc_html__('Presentation', 'designthemes-core'),
					'type8'      => esc_html__('Girly', 'designthemes-core'),
					'type9'      => esc_html__('Art', 'designthemes-core'),
				  ),
				  'class'        => 'chosen',
				  'default'      => 'type1',
				  'info'       	 => esc_html__('Choose post style to display related rooms items.', 'designthemes-core'),
				  'dependency'   => array( 'single-rooms-related', '==', 'true' ),
				),
				
				array(
				  'id'  		 => 'single-rooms-comments',
				  'type'  		 => 'switcher',
				  'title' 		 => esc_html__('Show Rooms Comment', 'designthemes-core'),
				  'label'		 => esc_html__('YES! to display comments in single rooms.', 'designthemes-core'),
				),
				
				array(
				  'type'    => 'subheading',
				  'content' => esc_html__( 'Rooms Archives Page Layout', 'designthemes-core' ),
				),
				
				array(
				  'id'      	 => 'rooms-archives-page-layout',
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
					'data-depend-id' => 'rooms-archives-page-layout',
				  ),
				),
				
				array(
				  'id'  		 => 'show-standard-left-sidebar-for-rooms-archives',
				  'type'  		 => 'switcher',
				  'title' 		 => esc_html__('Show Standard Left Sidebar', 'designthemes-core'),
				  'dependency'   => array( 'rooms-archives-page-layout', 'any', 'with-left-sidebar,with-both-sidebar' ),
				),
			
				array(
				  'id'  		 => 'show-standard-right-sidebar-for-rooms-archives',
				  'type'  		 => 'switcher',
				  'title' 		 => esc_html__('Show Standard Right Sidebar', 'designthemes-core'),
				  'dependency'   => array( 'rooms-archives-page-layout', 'any', 'with-right-sidebar,with-both-sidebar' ),
				),
				
				array(
				  'type'    => 'subheading',
				  'content' => esc_html__( 'Rooms Archives Post Layout', 'designthemes-core' ),
				),
				
				array(
				  'id'      	 => 'rooms-archives-post-layout',
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
				  'id'           => 'rooms-archives-post-style',
				  'type'         => 'select',
				  'title'        => esc_html__('Style', 'designthemes-core'),
				  'options'      => array(
					'type1'      => esc_html__('Modern Title', 'designthemes-core'),
					'type2'      => esc_html__('Title & Icons Overlay', 'designthemes-core'),
					'type3'      => esc_html__('Title Overlay', 'designthemes-core'),
					'type4'      => esc_html__('Icons Only', 'designthemes-core'),
					'type5'      => esc_html__('Classic', 'designthemes-core'),
					'type6'      => esc_html__('Minimal Icons', 'designthemes-core'),
					'type7'      => esc_html__('Presentation', 'designthemes-core'),
					'type8'      => esc_html__('Girly', 'designthemes-core'),
					'type9'      => esc_html__('Art', 'designthemes-core')
				  ),
				  'class'        => 'chosen',
				  'default'      => 'type1',
				  'info'       	 => esc_html__('Choose post style to display archive page rooms items.', 'designthemes-core')
				),
				
				array(
				  'id'  		 => 'rooms-allow-grid-space',
				  'type'  		 => 'switcher',
				  'title' 		 => esc_html__('Allow Grid Space', 'designthemes-core'),
				  'label'		 => esc_html__('YES! to allow grid space', 'designthemes-core')
				),

				array(
				  'id'  		 => 'rooms-allow-full-width',
				  'type'  		 => 'switcher',
				  'title' 		 => esc_html__('Allow Full Width', 'designthemes-core'),
				  'label'		 => esc_html__('YES! to allow full width', 'designthemes-core')
				),
				
				array(
				  'type'    => 'subheading',
				  'content' => esc_html__( 'Permalinks', 'designthemes-core' ),
				),
				
				array(
				  'id'      => 'single-rooms-slug',
				  'type'    => 'text',
				  'title'   => esc_html__('Single Rooms Slug', 'designthemes-core'),
				  'after' 	=> '<p class="cs-text-info">'.esc_html__('Do not use characters not allowed in links. Use, eg. rooms-item ', 'designthemes-core').'<br> <b>'.esc_html__('After made changes save permalinks.', 'designthemes-core').'</b></p>',
				),
			  ),
			);

			return $options;
		}

		/*function dt_rooms_wp_enqueue_scripts() {

			wp_enqueue_style( 'trendytravel-rooms',	  plugin_dir_url ( __FILE__ ) . 'css/rooms.css', false, TRENDYTRAVEL_THEME_VERSION, 'all' );
			wp_enqueue_script ( 'dt-sc-rooms-custom-script', plugin_dir_url ( __FILE__ ) . 'js/protfolio-custom.js', array ('jquery'), false, true );

		}*/

		/**
		 *
		 * @param unknown $columns        	
		 * @return multitype:
		 */
		function dt_rooms_edit_columns($columns) {

			$newcolumns = array (
				"cb" => "<input type=\"checkbox\" />",
				"dt_rooms_thumb" => esc_html__("Image", 'designthemes-core'),
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
		function dt_rooms_columns_display($columns, $id) {
		
			global $post;
			switch ($columns) {

				case "dt_rooms_thumb" :
				    $image = wp_get_attachment_image(get_post_thumbnail_id($id), array(75,75));
					if(!empty($image)):
					  	echo ($image);
				    else:
						$rooms_settings = get_post_meta ( $post->ID, '_rooms_settings', TRUE );
						$rooms_settings = is_array ( $rooms_settings ) ? $rooms_settings : array ();

						if( array_key_exists("rooms-gallery", $rooms_settings)) {
							$items = explode(',', $rooms_settings["rooms-gallery"]);
							echo wp_get_attachment_image( $items[0], array(75, 75) );
						}
					endif;
				break;
			}
		}

		/**
		 * To load rooms pages in front end
		 *
		 * @param string $template
		 * @return string
		 */
		function dt_template_include($template) {
			if (is_singular( 'dt_rooms' )) {
				if (! file_exists ( get_stylesheet_directory () . '/single-dt_rooms.php' )) {
					$template = plugin_dir_path ( __FILE__ ) . 'templates/single-dt_rooms.php';
				}			
			} 
			return $template;
		}

		function dt_header_footer_metabox_option( $post_types ) {

			array_push( $post_types, 'dt_rooms' );

			return $post_types;
		}
	}
}?>