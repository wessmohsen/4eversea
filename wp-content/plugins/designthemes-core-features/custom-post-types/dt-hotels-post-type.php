<?php
if (! class_exists ( 'DTHotelPostType' )) {
	class DTHotelPostType {
		
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
				'dt_hotel_cs_metabox_options' 
			) );

			add_filter ( 'cs_framework_options', array (
				$this,
				'dt_hotel_cs_framework_options' 
			) );

			add_action( 'wp_enqueue_scripts', array(
				$this,
				'dt_hotel_wp_enqueue_scripts'
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
		
			add_filter ( "manage_edit-dt_hotels_columns", array (
					$this,
					"dt_hotels_edit_columns" 
			) );
			
			add_action ( "manage_posts_custom_column", array (
					$this,
					"dt_hotels_columns_display" 
			), 10, 2 );
			
		}

		/**
		 */
		function createPostType() {
		
			$hotelslug = trendytravel_cs_get_option( 'single-hotel-slug', 'dt_hotels' );
			$hoteltaxslug = trendytravel_cs_get_option( 'hotel-category-slug', 'hotel_entries' );
			
		
			$labels = array (
					'name' => __ ( 'Hotels', 'designthemes-core' ),
					'all_items' => __ ( 'All Hotels', 'designthemes-core' ),
					'singular_name' => __ ( 'Hotel', 'designthemes-core' ),
					'add_new' => __ ( 'Add New', 'designthemes-core' ),
					'add_new_item' => __ ( 'Add New Hotel', 'designthemes-core' ),
					'edit_item' => __ ( 'Edit Hotel', 'designthemes-core' ),
					'new_item' => __ ( 'New Hotel', 'designthemes-core' ),
					'view_item' => __ ( 'View Hotel', 'designthemes-core' ),
					'search_items' => __ ( 'Search Hotels', 'designthemes-core' ),
					'not_found' => __ ( 'No Hotels found', 'designthemes-core' ),
					'not_found_in_trash' => __ ( 'No Hotels found in Trash', 'designthemes-core' ),
					'parent_item_colon' => __ ( 'Parent Hotel:', 'designthemes-core' ),
					'menu_name' => __ ( 'Hotels Booking', 'designthemes-core' ) 
			);
			
			$args = array (
					'labels' => $labels,
					'hierarchical' => false,
					'description' => 'This is custom post type hotels',
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
					'menu_position' => 5,
					'menu_icon' => 'dashicons-calendar',
					
					'show_in_nav_menus' => true,
					'publicly_queryable' => true,
					'exclude_from_search' => false,
					'has_archive' => true,
					'query_var' => true,
					'can_export' => true,
					'rewrite' => array( 'slug' => $hotelslug ),
					'capability_type' => 'post' 
			);
			
			register_post_type ( 'dt_hotels', $args );
			
			register_taxonomy ( "hotel_entries", array (
					"dt_hotels" 
			), array (
					"hierarchical" => true,
					"label" => "Categories",
					"singular_label" => "Category",
					"show_admin_column" => true,
					"rewrite" => array( 'slug' => $hoteltaxslug ),
					'show_in_rest' => true,
					"query_var" => true 
			) );
			
			$labels = array(
				'name'              => _x( 'Locations', 'designthemes-core' ),
				'singular_name'     => _x( 'Location', 'designthemes-core' ),
				'search_items'      => __( 'Search Locations', 'designthemes-core' ),
				'all_items'         => __( 'All Locations', 'designthemes-core' ),
				'parent_item'       => __( 'Parent Location', 'designthemes-core' ),
				'parent_item_colon' => __( 'Parent Location:', 'designthemes-core' ),
				'edit_item'         => __( 'Edit Location', 'designthemes-core' ),
				'update_item'       => __( 'Update Location', 'designthemes-core' ),
				'add_new_item'      => __( 'Add New Location', 'designthemes-core' ),
				'new_item_name'     => __( 'New Location Name', 'designthemes-core' ),
				'menu_name'         => __( 'Locations', 'designthemes-core' ),
			);

			$args = array(
				'hierarchical'      => true,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'show_in_rest' 		=> true,
				'rewrite'           => true
			);

			register_taxonomy( 'hotel_locations', array( 'dt_hotels' ), $args );
		}

		/**
		 */
		function dt_hotel_cs_metabox_options( $options ) {
			
			$options[]    = array(
			  'id'        => '_hotel_settings',
			  'title'     => esc_html__('Custom Hotel Options', 'designthemes-core'),
			  'post_type' => 'dt_hotels',
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
					  'id'  	=> 'hotel_add',
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
					  'id'      => 'hotel_lat',
					  'type'    => 'text',
					  'title'   => esc_html__('Latitude', 'designthemes-core'),
					  'default'	=> '42.353068',
					  'desc'    => '<p class="cs-text-muted">'.esc_html__('Put the location latitude value. ( Use finder: https://ctrlq.org/maps/address/ ) ', 'designthemes-core').'</p>',
					  'attributes' => array(
					  )
					),
					
					array(
					  'id'      => 'hotel_long',
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
					  'id'      => 'starting_price',
					  'type'    => 'text',
					  'title'   => esc_html__('Starting Price', 'designthemes-core'),
					  'default'	=> '199.99',
					  'desc'    => '<p class="cs-text-muted">'.esc_html__('Put the value of starting pricing. ', 'designthemes-core').'</p>',
					  'attributes' => array(
					  )
					),
					
					array(
					  'id'      => 'offer_value',
					  'type'    => 'text',
					  'title'   => esc_html__('Special Offer', 'designthemes-core'),
					  'default'	=> '10% Special Offer',
					  'desc'    => '<p class="cs-text-muted">'.esc_html__('Put the special offer value.', 'designthemes-core').'</p>',
					  'sanitize' => true,
					  'attributes' => array(
					  )
					),
					
					array(
					  'id'      => 'specially_whome',
					  'type'    => 'text',
					  'title'   => esc_html__('For Whome', 'designthemes-core'),
					  'default'	=> 'Only For Families',
					  'desc'    => '<p class="cs-text-muted">'.esc_html__('Put the text of specially for whome.', 'designthemes-core').'</p>',
					  'attributes' => array(
					  )
					),
					
					array(
						'id'      => 'show-book-now',
						'type'    => 'switcher',
						'title'   => esc_html__('Show Book Now', 'designthemes-core' ),
						'desc'    => '<p class="cs-text-muted">'.esc_html__('Would you like to show the book now section ', 'designthemes-core').'</p>',
						'default' => true
					),
						
					array(
						'id'      => 'show-ratings',
						'type'    => 'switcher',
						'title'   => esc_html__('Show Ratings', 'designthemes-core' ),
						'desc'    => '<p class="cs-text-muted">'.esc_html__('Would you like to show the rating section ', 'designthemes-core').'</p>',
						'default' => true
					),
					
					array(
						'id'      => 'show-reviews',
						'type'    => 'switcher',
						'title'   => esc_html__('Show Reviews', 'designthemes-core' ),
						'desc'    => '<p class="cs-text-muted">'.esc_html__('Would you like to show the reviews section ', 'designthemes-core').'</p>',
						'default' => true
					),
					
					array(
					  'id'             => 'room-types',
					  'type'           => 'select',
					  'title'          => esc_html__('Choose Rooms','designthemes-core'),
					  'options'        => 'posts',
					  'class'          => 'chosen',
					  'query_args'     => array(
						'post_type'         => 'dt_rooms',
						'orderby'      => 'post_date',
						'order'        => 'DESC',
					  ),
					  'attributes'         => array(
						'data-placeholder' => esc_html__('Select Room Type','designthemes-core'),
						'multiple'         => 'only-key',
						'style'            => 'width: 300px;'
					  ),
					  'info'           => esc_html__('You can choose room under a hotel in the booking page.','designthemes-core'),
					),
					
					array(
					  'id'          => 'hotel-gallery',
					  'type'        => 'gallery',
					  'title'       => esc_html__('Hotel Images', 'designthemes-core'),
					  'desc'        => esc_html__('Simply add images to gallery items.', 'designthemes-core'),
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
		function dt_hotel_cs_framework_options( $options ) {
			
			$options[]      = array(
			  'name'        => 'hotels',
			  'title'       => esc_html__('Hotels', 'designthemes-core'),
			  'icon'        => 'fa fa-home',
			
			  'fields'      => array(

				
				array(
				  'type'    => 'subheading',
				  'content' => esc_html__( 'Hotel Archives Page Layout', 'designthemes-core' ),
				),
				
				array(
				  'id'      	 => 'hotel-archives-page-layout',
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
					'data-depend-id' => 'hotel-archives-page-layout',
				  ),
				),
				
				array(
				  'id'  		 => 'show-standard-left-sidebar-for-hotel-archives',
				  'type'  		 => 'switcher',
				  'title' 		 => esc_html__('Show Standard Left Sidebar', 'designthemes-core'),
				  'dependency'   => array( 'hotel-archives-page-layout', 'any', 'with-left-sidebar,with-both-sidebar' ),
				),
			
				array(
				  'id'  		 => 'show-standard-right-sidebar-for-hotel-archives',
				  'type'  		 => 'switcher',
				  'title' 		 => esc_html__('Show Standard Right Sidebar', 'designthemes-core'),
				  'dependency'   => array( 'hotel-archives-page-layout', 'any', 'with-right-sidebar,with-both-sidebar' ),
				),

				array(
				  'type'    => 'subheading',
				  'content' => esc_html__( 'Permalinks', 'designthemes-core' ),
				),
				
				array(
				  'id'      => 'single-hotel-slug',
				  'type'    => 'text',
				  'title'   => esc_html__('Single Hotel Slug', 'designthemes-core'),
				  'after' 	=> '<p class="cs-text-info">'.esc_html__('Do not use characters not allowed in links. Use, eg. hotel-item ', 'designthemes-core').'<br> <b>'.esc_html__('After made changes save permalinks.', 'designthemes-core').'</b></p>',
				),
				
				array(
				  'id'      => 'hotel-category-slug',
				  'type'    => 'text',
				  'title'   => esc_html__('Hotel Category Slug', 'designthemes-core'),
				  'after' 	=> '<p class="cs-text-info">'.esc_html__('Do not use characters not allowed in links. Use, eg. hotel-types ', 'designthemes-core').'<br> <b>'.esc_html__('After made changes save permalinks.', 'designthemes-core').'</b></p>',
				),

			  ),
			);

			return $options;
		}

		function dt_hotel_wp_enqueue_scripts() {

			//wp_enqueue_style( 'trendytravel-hotel',	  plugin_dir_url ( __FILE__ ) . 'css/hotel.css', false, TRENDYTRAVEL_THEME_VERSION, 'all' );
			wp_enqueue_script ( 'dt-sc-hotel-custom-script', plugin_dir_url ( __FILE__ ) . 'js/hotel-custom.js', array ('jquery'), false, true );

		}

		/**
		 *
		 * @param unknown $columns        	
		 * @return multitype:
		 */
		function dt_hotels_edit_columns($columns) {

			$newcolumns = array (
				"cb" => "<input type=\"checkbox\" />",
				"dt_hotel_thumb" => esc_html__("Image", 'designthemes-core'),
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
		function dt_hotels_columns_display($columns, $id) {
		
			global $post;
			switch ($columns) {

				case "dt_hotel_thumb" :
				    $image = wp_get_attachment_image(get_post_thumbnail_id($id), array(75,75));
					if(!empty($image)):
					  	echo ($image);
				    else:
						$hotel_settings = get_post_meta ( $post->ID, '_hotel_settings', TRUE );
						$hotel_settings = is_array ( $hotel_settings ) ? $hotel_settings : array ();

						if( array_key_exists("hotel-gallery", $hotel_settings)) {
							$items = explode(',', $hotel_settings["hotel-gallery"]);
							echo wp_get_attachment_image( $items[0], array(75, 75) );
						}
					endif;
				break;
			}
		}

		/**
		 * To load hotel pages in front end
		 *
		 * @param string $template
		 * @return string
		 */
		function dt_template_include($template) {
		
			if (is_singular( 'dt_hotels' )) {
				if (! file_exists ( get_stylesheet_directory () . '/single-dt_hotels.php' )) {
					$template = plugin_dir_path ( __FILE__ ) . 'templates/single-dt_hotels.php';
				}			
			} elseif (is_tax ( 'hotel_entries' )) {
				if (! file_exists ( get_stylesheet_directory () . '/taxonomy-hotel_entries.php' )) {
					$template = plugin_dir_path ( __FILE__ ) . 'templates/taxonomy-hotel_entries.php';
				}
			} elseif (is_post_type_archive ( 'dt_hotels' )) {
				if (! file_exists ( get_stylesheet_directory () . '/archive-dt_hotels.php' )) {
					$template = plugin_dir_path ( __FILE__ ) . 'templates/archive-dt_hotels.php';
				}					
			}

			return $template;

		}

		function dt_header_footer_metabox_option( $post_types ) {

			array_push( $post_types, 'dt_hotels' );

			return $post_types;
		}
	}
}?>