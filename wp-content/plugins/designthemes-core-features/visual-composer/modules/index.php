<?php

define( 'DT_VC_CATEGORY', THEME_NAME );

// Animations
global $dt_animation_types;
$dt_animation_types = array("None" => '',"flash" => "flash", "shake" => "shake", "bounce" => "bounce", "tada" => "tada", "swing" => "swing",
	"wobble" => "wobble",
	"pulse" => "pulse", "flip" => "flip", "flipInX" => "flipInX", "flipOutX" => "flipOutX", "flipInY" => "flipInY", "flipOutY" => "flipOutY",
	"fadeIn" => "fadeIn", "fadeInUp" => "fadeInUp", "fadeInDown" => "fadeInDown", "fadeInLeft" => "fadeInLeft", "fadeInRight" => "fadeInRight",
	"fadeInUpBig" => "fadeInUpBig", "fadeInDownBig" => "fadeInDownBig", "fadeInLeftBig" => "fadeInLeftBig", "fadeInRightBig" => "fadeInRightBig",
	"fadeOut" => "fadeOut", "fadeOutUp" => "fadeOutUp","fadeOutDown" => "fadeOutDown", "fadeOutLeft" => "fadeOutLeft", "fadeOutRight" => "fadeOutRight",
	"fadeOutUpBig" => "fadeOutUpBig", "fadeOutDownBig" => "fadeOutDownBig", "fadeOutLeftBig" => "fadeOutLeftBig","fadeOutRightBig" => "fadeOutRightBig",
	"bounceIn" => "bounceIn", "bounceInUp" => "bounceInUp", "bounceInDown" => "bounceInDown", "bounceInLeft" => "bounceInLeft",
	"bounceInRight" => "bounceInRight", "bounceOut" => "bounceOut", "bounceOutUp" => "bounceOutUp", "bounceOutDown" => "bounceOutDown",
	"bounceOutLeft" => "bounceOutLeft", "bounceOutRight" => "bounceOutRight", "rotateIn" => "rotateIn", "rotateInUpLeft" => "rotateInUpLeft",
	"rotateInDownLeft" => "rotateInDownLeft", "rotateInUpRight" => "rotateInUpRight", "rotateInDownRight" => "rotateInDownRight",
	"rotateOut" => "rotateOut", "rotateOutUpLeft" => "rotateOutUpLeft","rotateOutDownLeft" => "rotateOutDownLeft",
	"rotateOutUpRight" => "rotateOutUpRight", "rotateOutDownRight" => "rotateOutDownRight", "hinge" => "hinge", "rollIn" => "rollIn",
	"rollOut" => "rollOut", "lightSpeedIn" => "lightSpeedIn", "lightSpeedOut" => "lightSpeedOut", "slideDown" => "slideDown",
	"slideUp" => "slideUp", "slideLeft" => "slideLeft", "slideRight" => "slideRight", "slideExpandUp" => "slideExpandUp",
	"expandUp" => "expandUp", "expandOpen" => "expandOpen", "bigEntrance" => "bigEntrance", "hatch" => "hatch", "floating" => "floating",
	"tossing" => "tossing", "pullUp" => "pullUp", "pullDown" => "pullDown", "stretchLeft" => "stretchLeft", "stretchRight" => "stretchRight");

// Colors
global $variations;
$variations = array( "None" => '-',"Blue" => "blue","Brown" => "brown","CadetBlue" => "cadetblue","Chillipepper" => "chillipepper","Cyan" => "cyan",
	"DarkGolden" => "darkgolden","DeepOrange" => "deeporange","DeepPurple" => "deeppurple","Green" => "green","Lime" => "lime",
	"Magenta" => "magenta","Orange" => "orange","Pink" => "pink","Purple" => "purple","Red" => "red","Skyblue" => "skyblue",
	"Teal" => "teal","Turquoise" => "turquoise","Wisteria" => "wisteria","Yellow" => "yellow");
	
	
// Custom Modules
	require_once plugin_dir_path( __FILE__ ).'/align.php';
	require_once plugin_dir_path( __FILE__ ).'/anyclass_style.php';

	// Tabs
	require_once plugin_dir_path( __FILE__ ).'/tabs.php';
	require_once plugin_dir_path( __FILE__ ).'/tab.php';

	// Accordion
	require_once plugin_dir_path( __FILE__ ).'/accordion.php';
	require_once plugin_dir_path( __FILE__ ).'/accordion_tab.php';

	require_once plugin_dir_path( __FILE__ ).'/button.php';
	require_once plugin_dir_path( __FILE__ ).'/colored_button.php';
	require_once plugin_dir_path( __FILE__ ).'/titled_box.php';
	require_once plugin_dir_path( __FILE__ ).'/blockquote.php';
	require_once plugin_dir_path( __FILE__ ).'/pullquote.php';
	require_once plugin_dir_path( __FILE__ ).'/dropcap.php';
	require_once plugin_dir_path( __FILE__ ).'/donutchart.php';
	require_once plugin_dir_path( __FILE__ ).'/iconbox.php';
	require_once plugin_dir_path( __FILE__ ).'/orderedlist.php';
	require_once plugin_dir_path( __FILE__ ).'/unorderedlist.php';
	require_once plugin_dir_path( __FILE__ ).'/progress_bar.php';
	require_once plugin_dir_path( __FILE__ ).'/infographic_bar.php';
	require_once plugin_dir_path( __FILE__ ).'/callout_box.php';
	require_once plugin_dir_path( __FILE__ ).'/colored_box.php';

	// Pricing Table
	require_once plugin_dir_path( __FILE__ ).'/pricing_table_item.php';
	require_once plugin_dir_path( __FILE__ ).'/pricing_table_minimal_item.php';
	require_once plugin_dir_path( __FILE__ ).'/pricing_table_item_2.php';

	// Toggle
	require_once plugin_dir_path( __FILE__ ).'/toggle_group.php';
	require_once plugin_dir_path( __FILE__ ).'/toggle.php';

	require_once plugin_dir_path( __FILE__ ).'/tooltip.php';
	require_once plugin_dir_path( __FILE__ ).'/title.php';

	// Divider
	require_once plugin_dir_path( __FILE__ ).'/hr_invisible.php';
	require_once plugin_dir_path( __FILE__ ).'/hr_top.php';
	require_once plugin_dir_path( __FILE__ ).'/hr_custom.php';
	require_once plugin_dir_path( __FILE__ ).'/hr_svg.php';
	
	// Separator
	require_once plugin_dir_path( __FILE__ ).'/separator.php';

	require_once plugin_dir_path( __FILE__ ).'/email.php';
	require_once plugin_dir_path( __FILE__ ).'/phone_no.php';
	require_once plugin_dir_path( __FILE__ ).'/whatsapp.php';
	require_once plugin_dir_path( __FILE__ ).'/url.php';

	require_once plugin_dir_path( __FILE__ ).'/search_form.php';
	require_once plugin_dir_path( __FILE__ ).'/woo_cart.php';

	require_once plugin_dir_path( __FILE__ ).'/icon.php';
	require_once plugin_dir_path( __FILE__ ).'/image.php';
	
	require_once plugin_dir_path( __FILE__ ).'/video_manager.php';	

	// Unique
	require_once plugin_dir_path( __FILE__ ).'/contact_info.php';
	require_once plugin_dir_path( __FILE__ ).'/number_counter.php';
	require_once plugin_dir_path( __FILE__ ).'/image_caption.php';
	require_once plugin_dir_path( __FILE__ ).'/image_flip.php';
	require_once plugin_dir_path( __FILE__ ).'/event_caption.php';
	require_once plugin_dir_path( __FILE__ ).'/event_contact_info.php';
	require_once plugin_dir_path( __FILE__ ).'/mc_newsletter.php';

	// Team
	require_once plugin_dir_path( __FILE__ ).'/team.php';

	require_once plugin_dir_path( __FILE__ ).'/testimonial.php';

	require_once plugin_dir_path( __FILE__ ).'/testimonial_carousel_wrapper.php';
	require_once plugin_dir_path( __FILE__ ).'/testimonial_carousel_item.php';
	
	require_once plugin_dir_path( __FILE__ ).'/fullwidth_testimonial.php';

	require_once plugin_dir_path( __FILE__ ).'/testimonial_carousel_special.php';

	require_once plugin_dir_path( __FILE__ ).'/partners_carousel.php';
	require_once plugin_dir_path( __FILE__ ).'/images_carousel.php';

	// Tweet
	require_once plugin_dir_path( __FILE__ ).'/twitter_tweets.php';

	// Popular content
	require_once plugin_dir_path( __FILE__ ).'/popular_content.php';

	// Horizontal Time line
	require_once plugin_dir_path( __FILE__ ).'/horizontal_timeline.php';
	require_once plugin_dir_path( __FILE__ ).'/hr_timeline_entry.php';

	// Vertical Time line
	require_once plugin_dir_path( __FILE__ ).'/vertical_timeline.php';
	require_once plugin_dir_path( __FILE__ ).'/vertical_timeline_entry.php';

	require_once plugin_dir_path( __FILE__ ).'/horizontal_timeline_slider.php';

	// Post
	require_once plugin_dir_path( __FILE__ ).'/single_post.php';
	require_once plugin_dir_path( __FILE__ ).'/recent_posts.php';
	require_once plugin_dir_path( __FILE__ ).'/recent_posts_by_category.php';
	require_once plugin_dir_path( __FILE__ ).'/latest_news.php';

	// Portfolio
	require_once plugin_dir_path( __FILE__ ).'/single_portfolio_item.php';
	require_once plugin_dir_path( __FILE__ ).'/portfolios.php';
	require_once plugin_dir_path( __FILE__ ).'/infinite_portfolios.php'; 

	//Break
	require_once plugin_dir_path( __FILE__ ).'/br.php';

	// Custom Menu
	require_once plugin_dir_path( __FILE__ ).'/custom_menu.php';

	// Sociables From Admin panel
	require_once plugin_dir_path( __FILE__ ).'/sociable.php';

	// Coming soon
	require_once plugin_dir_path( __FILE__ ).'/down_count.php';

	// Notfound Message
	require_once plugin_dir_path( __FILE__ ).'/notfound_msg.php';

	// Carousel
	require_once plugin_dir_path( __FILE__ ).'/advanced_carousel.php';

	// Google Map
	require_once plugin_dir_path( __FILE__ ).'/google_map.php';

	// Working Hours
	require_once plugin_dir_path( __FILE__ ).'/working_hours.php';
	require_once plugin_dir_path( __FILE__ ).'/work_hour.php';	
	
	//Hotel Rooms
	require_once plugin_dir_path( __FILE__ ).'/hotel_room.php';	
	require_once plugin_dir_path( __FILE__ ).'/hotel_reviews.php';
	
	//Packages List
	require_once plugin_dir_path( __FILE__ ).'/packages_list.php';
	require_once plugin_dir_path( __FILE__ ).'/tour_packages_list.php';
	
	//Best Destination Place
	require_once plugin_dir_path( __FILE__ ).'/best_destination_place.php';
	require_once plugin_dir_path( __FILE__ ).'/destination_place.php';

	//Recommended Places
	require_once plugin_dir_path( __FILE__ ).'/recommended_places.php';

	// Login / Logout Links
	require_once plugin_dir_path( __FILE__ ).'/login-logout-links.php';

	if ( class_exists( 'Tribe__Events__Main' ) ) {

		require_once plugin_dir_path( __FILE__ ).'/tribe_events_list.php';
		require_once plugin_dir_path( __FILE__ ).'/menu_events_list.php';
		require_once plugin_dir_path( __FILE__ ).'/tribe_special_events_list.php';
	}

// VC Row ----------------------------------------------------------------------
vc_remove_param( 'vc_row', 'full_width' );
$attributes = array(
	'type' => 'dropdown',
	'heading' => esc_html__( 'Row stretch', 'designthemes-core' ),
	'param_name' => 'full_width',
	'value' => array(
		esc_html__( 'Default', 'designthemes-core' ) => '',
		esc_html__( 'Default (no paddings)', 'designthemes-core' ) => 'default_no_spaces',
		esc_html__( 'Stretch row', 'designthemes-core' ) => 'stretch_row',
		esc_html__( 'Stretch row and content', 'designthemes-core' ) => 'stretch_row_content',
		esc_html__( 'Stretch row and content (no paddings)', 'designthemes-core' ) => 'stretch_row_content_no_spaces',
	),
	'description' => esc_html__( 'Select stretching options for row and content (Note: stretched may not work properly if parent container has "overflow: hidden" CSS property).', 'designthemes-core' ),
	'weight' => 1
);
vc_add_param( 'vc_row', $attributes );

$attributes = array(
    'type' => 'textarea',
    'heading' => "Inline styles",
    'param_name' => 'addstyles',
    'description' => esc_html__( 'Enter inline styles for this row.', 'designthemes-core' )
);
vc_add_param( 'vc_row', $attributes );

$attributes = array(
    'type' => 'colorpicker',
    'heading' => "Text color",
    'param_name' => 'text_color',
    'description' => esc_html__( 'Enter text color for this row.', 'designthemes-core' )
);
vc_add_param( 'vc_row', $attributes );

$attributes = array(
	'type' => 'dropdown',
	'heading' => esc_html__( 'Apply Particle Jquery', 'designthemes-core' ),
	'param_name' => 'apply_particle_jquery',
	'value' => array(
		esc_html__( 'No', 'designthemes-core' ) => '',
		esc_html__( 'Yes', 'designthemes-core' ) => 'yes',
	),
	'description' => esc_html__( 'Choose "Yes" if you like to apply particle jquery for this row.', 'designthemes-core' ),
);
vc_add_param( 'vc_row', $attributes );

$attributes = array(
	'type' => 'dropdown',
	'heading' => esc_html__( 'Enable Sticky', 'designthemes-core' ),
	'param_name' => 'enable_sticky',
	'value' => array(
		esc_html__( 'No', 'designthemes-core' ) => '',
		esc_html__( 'Yes', 'designthemes-core' ) => 'yes',
	),
	'description' => esc_html__( 'Choose "Yes" if you like to apply sticky for this row ( Only Works in Header Custom Post Type ).', 'designthemes-core' ),
);
vc_add_param( 'vc_row', $attributes );

// VC Row Inner -------------------------------------------------------------------
$attributes = array(
	'type' => 'dropdown',
	'heading' => esc_html__( 'Spacing', 'designthemes-core' ),
	'param_name' => 'spacing',
	'value' => array(
		esc_html__( 'Default', 'designthemes-core' ) => '',
		esc_html__( 'Default (no paddings)', 'designthemes-core' ) => 'default_no_spaces'
	),
	'description' => esc_html__( 'Default (no paddings) option removes padding of columns inside it.', 'designthemes-core' ),
	'weight' => 1
);
vc_add_param( 'vc_row_inner', $attributes );

$attributes = array(
    'type' => 'textarea',
    'heading' => "Inline styles",
    'param_name' => 'addstyles',
    'description' => esc_html__( 'Enter inline styles for this row.', 'designthemes-core' )
);
vc_add_param( 'vc_row_inner', $attributes );

// VC Column ----------------------------------------------------------------------
$attributes = array(
	'type' => 'dropdown',
	'heading' => esc_html__( 'Content Alignment', 'designthemes-core' ),
	'param_name' => 'el_align',
	'value' => array( esc_html__('None', 'designthemes-core') => '', 'Left' => 'left', 'Right' => 'right', 'Center' => 'center', 'Justify' => 'justify' ),
	'description' => esc_html__( 'Select column alignment.', 'designthemes-core' ),
	'std' => '',
	'weight' => 1
);
vc_add_param( 'vc_column', $attributes );
vc_add_param( 'vc_column_inner', $attributes );

$attributes = array(
    'type' => 'textarea',
    'heading' => "Inline styles",
    'param_name' => 'addstyles',
    'description' => esc_html__( 'Enter inline styles for this column.', 'designthemes-core' )
);
vc_add_param( 'vc_column', $attributes );
vc_add_param( 'vc_column_inner', $attributes );

// VC Column Text ----------------------------------------------------------------------
$attributes['description'] = esc_html__( 'Enter inline styles for this textblock.', 'designthemes-core' );
vc_add_param( 'vc_column_text', $attributes );?>