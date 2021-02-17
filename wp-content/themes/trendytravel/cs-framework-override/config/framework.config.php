<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$settings           = array( 
  'menu_title'      => constant('TRENDYTRAVEL_THEME_NAME').' '.esc_html__('Options', 'trendytravel'),
  'menu_type'       => 'theme', // menu, submenu, options, theme, etc.
  'menu_slug'       => 'cs-framework',
  'ajax_save'       => true,
  'show_reset_all'  => false,
  'framework_title' => sprintf( esc_html__('Designthemes Framework %sby Designthemes%s', 'trendytravel'), '<small>', '</small>')
);

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options        = array();

$options[]      = array(
  'name'        => 'general',
  'title'       => esc_html__('General', 'trendytravel'),
  'icon'        => 'fa fa-gears',

  'fields'      => array(

	array(
	  'type'    => 'subheading',
	  'content' => esc_html__( 'General Options', 'trendytravel' ),
	),
	
	array(
		'id'	=> 'header',
		'type'	=> 'select',
		'title'	=> esc_html__('Site Header', 'trendytravel'),
		'class'	=> 'chosen',
		'options'	=> 'posts',
		'query_args'	=> array(
			'post_type'	=> 'dt_headers',
			'orderby'	=> 'title',
			'order'	=> 'ASC',
			'posts_per_page' => -1
		),
		'default_option'	=> esc_attr__('Select Header', 'trendytravel'),
		'attributes'	=> array ( 'style'	=> 'width:50%'),
		'info'	=> esc_html__('Select default header.','trendytravel'),
	),
	
	array(
		'id'	=> 'footer',
		'type'	=> 'select',
		'title'	=> esc_html__('Site Footer', 'trendytravel'),
		'class'	=> 'chosen',
		'options'	=> 'posts',
		'query_args'	=> array(
			'post_type'	=> 'dt_footers',
			'orderby'	=> 'title',
			'order'	=> 'ASC',
			'posts_per_page' => -1
		),
		'default_option'	=> esc_attr__('Select Footer', 'trendytravel'),
		'attributes'	=> array ( 'style'	=> 'width:50%'),
		'info'	=> esc_html__('Select defaultfooter.','trendytravel'),
	),

	array(
	  'id'  	 => 'use-site-loader',
	  'type'  	 => 'switcher',
	  'title' 	 => esc_html__('Site Loader', 'trendytravel'),
	  'info'	 => esc_html__('YES! to use site loader.', 'trendytravel')
	),	

	array(
	  'id'  	 => 'enable-stylepicker',
	  'type'  	 => 'switcher',
	  'title' 	 => esc_html__('Style Picker', 'trendytravel'),
	  'info'	 => esc_html__('YES! to show the style picker.', 'trendytravel')
	),		

	array(
	  'id'  	 => 'show-pagecomments',
	  'type'  	 => 'switcher',
	  'title' 	 => esc_html__('Globally Show Page Comments', 'trendytravel'),
	  'info'	 => esc_html__('YES! to show comments on all the pages. This will globally override your "Allow comments" option under your page "Discussion" settings.', 'trendytravel'),
	  'default'  => false,
	),

	array(
	  'id'  	 => 'showall-pagination',
	  'type'  	 => 'switcher',
	  'title' 	 => esc_html__('Show all pages in Pagination', 'trendytravel'),
	  'info'	 => esc_html__('YES! to show all the pages instead of dots near the current page.', 'trendytravel')
	),

	array(
	  'id'  	 => 'disable-hotel-booking',
	  'type'  	 => 'switcher',
	  'title' 	 => esc_html__('Disable Hotel Booking Module', 'trendytravel'),
	  'info'	 => esc_html__('Check if you want to disable the hotel booking. ', 'trendytravel')
	),

	array(
	  'id'      => 'google-map-key',
	  'type'    => 'text',
	  'title'   => esc_html__('Google Map API Key', 'trendytravel'),
	  'after' 	=> '<p class="cs-text-info">'.esc_html__('Put a valid google account api key here', 'trendytravel').'</p>',
	),

	array(
	  'id'      => 'mailchimp-key',
	  'type'    => 'text',
	  'title'   => esc_html__('Mailchimp API Key', 'trendytravel'),
	  'after' 	=> '<p class="cs-text-info">'.esc_html__('Put a valid mailchimp account api key here', 'trendytravel').'</p>',
	),

  ),
);

$options[]      = array(
  'name'        => 'layout_options',
  'title'       => esc_html__('Layout Options', 'trendytravel'),
  'icon'        => 'dashicons dashicons-exerpt-view',
  'sections' => array(

	// -----------------------------------------
	// Header Options
	// -----------------------------------------
	array(
	  'name'      => 'breadcrumb_options',
	  'title'     => esc_html__('Breadcrumb Options', 'trendytravel'),
	  'icon'      => 'fa fa-sitemap',

		'fields'      => array(

		  array(
			'type'    => 'subheading',
			'content' => esc_html__( "Breadcrumb Options", 'trendytravel' ),
		  ),

		  array(
			'id'  		 => 'show-breadcrumb',
			'type'  	 => 'switcher',
			'title' 	 => esc_html__('Show Breadcrumb', 'trendytravel'),
			'info'		 => esc_html__('YES! to display breadcrumb for all pages.', 'trendytravel'),
			'default' 	 => true,
		  ),

		  array(
			'id'           => 'breadcrumb-delimiter',
			'type'         => 'icon',
			'title'        => esc_html__('Breadcrumb Delimiter', 'trendytravel'),
			'info'         => esc_html__('Choose delimiter style to display on breadcrumb section.', 'trendytravel'),
		  ),

		  array(
			'id'           => 'breadcrumb-style',
			'type'         => 'select',
			'title'        => esc_html__('Breadcrumb Style', 'trendytravel'),
			'options'      => array(
			  'default' 							=> esc_html__('Default', 'trendytravel'),
			  'aligncenter'    						=> esc_html__('Align Center', 'trendytravel'),
			  'alignright'  						=> esc_html__('Align Right', 'trendytravel'),
			  'breadcrumb-left'    					=> esc_html__('Left Side Breadcrumb', 'trendytravel'),
			  'breadcrumb-right'     				=> esc_html__('Right Side Breadcrumb', 'trendytravel'),
			  'breadcrumb-top-right-title-center'  	=> esc_html__('Top Right Title Center', 'trendytravel'),
			  'breadcrumb-top-left-title-center'  	=> esc_html__('Top Left Title Center', 'trendytravel'),
			),
			'class'        => 'chosen',
			'default'      => 'default',
			'info'         => esc_html__('Choose alignment style to display on breadcrumb section.', 'trendytravel'),
		  ),

		  array(
			  'id'                 => 'breadcrumb-position',
			  'type'               => 'select',
			  'title'              => esc_html__('Position', 'trendytravel' ),
			  'options'            => array(
				  'header-top-absolute'    => esc_html__('Behind the Header','trendytravel'),
				  'header-top-relative'    => esc_html__('Default','trendytravel'),
			  ),
			  'class'        => 'chosen',
			  'default'      => 'header-top-relative',
			  'info'         => esc_html__('Choose position of breadcrumb section.', 'trendytravel'),
		  ),

		  array(
			'id'    => 'breadcrumb_background',
			'type'  => 'background',
			'title' => esc_html__('Background', 'trendytravel'),
			'desc'  => esc_html__('Choose background options for breadcrumb title section.', 'trendytravel')
		  ),

		),
	),

  ),
);

$options[]      = array(
  'name'        => 'allpage_options',
  'title'       => esc_html__('All Page Options', 'trendytravel'),
  'icon'        => 'fa fa-files-o',
  'sections' => array(

	// -----------------------------------------
	// Post Options
	// -----------------------------------------
	array(
	  'name'      => 'post_options',
	  'title'     => esc_html__('Post Options', 'trendytravel'),
	  'icon'      => 'fa fa-file',

		'fields'      => array(

		  array(
			'type'    => 'subheading',
			'content' => esc_html__( "Single Post Options", 'trendytravel' ),
		  ),
		
		  array(
			'id'  		 => 'single-post-authorbox',
			'type'  	 => 'switcher',
			'title' 	 => esc_html__('Single Author Box', 'trendytravel'),
			'info'		 => esc_html__('YES! to display author box in single blog posts.', 'trendytravel')
		  ),

		  array(
			'id'  		 => 'single-post-related',
			'type'  	 => 'switcher',
			'title' 	 => esc_html__('Single Related Posts', 'trendytravel'),
			'info'		 => esc_html__('YES! to display related blog posts in single posts.', 'trendytravel')
		  ),

		  array(
			'id'  		 => 'single-post-navigation',
			'type'  	 => 'switcher',
			'title' 	 => esc_html__('Single Post Navigation', 'trendytravel'),
			'info'		 => esc_html__('YES! to display post navigation in single posts.', 'trendytravel')
		  ),

		  array(
			'id'  		 => 'single-post-comments',
			'type'  	 => 'switcher',
			'title' 	 => esc_html__('Posts Comments', 'trendytravel'),
			'info'		 => esc_html__('YES! to display single blog post comments.', 'trendytravel'),
			'default' 	 => true,
		  ),

		  array(
			'type'    => 'subheading',
			'content' => esc_html__( "Post Archives Page Layout", 'trendytravel' ),
		  ),

		  array(
			'id'      	 => 'post-archives-page-layout',
			'type'       => 'image_select',
			'title'      => esc_html__('Page Layout', 'trendytravel'),
			'options'    => array(
			  'content-full-width'   => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/without-sidebar.png',
			  'with-left-sidebar'    => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/left-sidebar.png',
			  'with-right-sidebar'   => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/right-sidebar.png',
			  'with-both-sidebar'    => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/both-sidebar.png',
			),
			'default'      => 'content-full-width',
			'attributes'   => array(
			  'data-depend-id' => 'post-archives-page-layout',
			),
		  ),

		  array(
			'id'  		 => 'show-standard-left-sidebar-for-post-archives',
			'type'  	 => 'switcher',
			'title' 	 => esc_html__('Show Standard Left Sidebar', 'trendytravel'),
			'dependency' => array( 'post-archives-page-layout', 'any', 'with-left-sidebar,with-both-sidebar' ),
		  ),

		  array(
			'id'  		 => 'show-standard-right-sidebar-for-post-archives',
			'type'  	 => 'switcher',
			'title' 	 => esc_html__('Show Standard Right Sidebar', 'trendytravel'),
			'dependency' => array( 'post-archives-page-layout', 'any', 'with-right-sidebar,with-both-sidebar' ),
		  ),

		  array(
			'type'    => 'subheading',
			'content' => esc_html__( "Post Archives Post Layout", 'trendytravel' ),
		  ),

		  array(
			'id'      	   => 'post-archives-post-layout',
			'type'         => 'image_select',
			'title'        => esc_html__('Post Layout', 'trendytravel'),
			'options'      => array(
			  'one-column' 		  => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/one-column.png',
			  'one-half-column'   => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/one-half-column.png',
			  'one-third-column'  => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/one-third-column.png',
			  '1-2-2'			  => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/1-2-2.png',
			  '1-2-2-1-2-2' 	  => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/1-2-2-1-2-2.png',
			  '1-3-3-3'			  => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/1-3-3-3.png',
			  '1-3-3-3-1' 		  => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/1-3-3-3-1.png',
			),
			'default'      => 'one-half-column',
		  ),

		  array(
			'id'           => 'post-style',
			'type'         => 'select',
			'title'        => esc_html__('Post Style', 'trendytravel'),
			'options'      => array(
			  'blog-default-style' 		=> esc_html__('Default', 'trendytravel'),
			  'entry-date-left'      	=> esc_html__('Date Left', 'trendytravel'),
			  'entry-date-left outer-frame-border'      	=> esc_html__('Date Left Modern', 'trendytravel'),
			  'entry-date-author-left'  => esc_html__('Date and Author Left', 'trendytravel'),
			  'blog-modern-style'       => esc_html__('Modern', 'trendytravel'),
			  'bordered'      			=> esc_html__('Bordered', 'trendytravel'),
			  'classic'      			=> esc_html__('Classic', 'trendytravel'),
			  'entry-overlay-style' 	=> esc_html__('Trendy', 'trendytravel'),
			  'overlap' 				=> esc_html__('Overlap', 'trendytravel'),
			  'entry-center-align'		=> esc_html__('Stripe', 'trendytravel'),
			  'entry-fashion-style'	 	=> esc_html__('Fashion', 'trendytravel'),
			  'entry-minimal-bordered' 	=> esc_html__('Minimal Bordered', 'trendytravel'),
			  'blog-medium-style'       => esc_html__('Medium', 'trendytravel'),
			  'blog-medium-style dt-blog-medium-highlight'     					 => esc_html__('Medium Hightlight', 'trendytravel'),
			  'blog-medium-style dt-blog-medium-highlight dt-sc-skin-highlight'  => esc_html__('Medium Skin Highlight', 'trendytravel'),
			),
			'class'        => 'chosen',
			'default'      => 'entry-date-author-left',
			'info'         => esc_html__('Choose post style to display post archives pages.', 'trendytravel'),
		  ),

		  array(
			'id'  		 => 'post-archives-enable-excerpt',
			'type'  	 => 'switcher',
			'title' 	 => esc_html__('Allow Excerpt', 'trendytravel'),
			'info'		 => esc_html__('YES! to allow excerpt', 'trendytravel'),
			'default'    => true,
		  ),

		  array(
			'id'  		 => 'post-archives-excerpt',
			'type'  	 => 'number',
			'title' 	 => esc_html__('Excerpt Length', 'trendytravel'),
			'after'		 => '<span class="cs-text-desc">&nbsp;'.esc_html__('Put Excerpt Length', 'trendytravel').'</span>',
			'default' 	 => 40,
		  ),

		  array(
			'id'  		 => 'post-archives-enable-readmore',
			'type'  	 => 'switcher',
			'title' 	 => esc_html__('Read More', 'trendytravel'),
			'info'		 => esc_html__('YES! to enable read more button', 'trendytravel'),
			'default'	 => false,
		  ),

		  array(
			'id'  		 => 'post-archives-readmore',
			'type'  	 => 'textarea',
			'title' 	 => esc_html__('Read More Shortcode', 'trendytravel'),
			'info'		 => esc_html__('Paste any button shortcode here', 'trendytravel'),
			'default'	 => '[dt_sc_button title="Read More" style="dt-sc-button small filled rounded-corner"]',
		  ),

		  array(
			'type'    => 'subheading',
			'content' => esc_html__( "Single Post & Post Archive options", 'trendytravel' ),
		  ),

		  array(
			'id'      => 'post-format-meta',
			'type'    => 'switcher',
			'title'   => esc_html__('Post Format Meta', 'trendytravel' ),
			'info'	  => esc_html__('YES! to show post format meta information', 'trendytravel'),
			'default' => true
		  ),

		  array(
			'id'      => 'post-author-meta',
			'type'    => 'switcher',
			'title'   => esc_html__('Author Meta', 'trendytravel' ),
			'info'	  => esc_html__('YES! to show post author meta information', 'trendytravel'),
			'default' => true
		  ),

		  array(
			'id'      => 'post-date-meta',
			'type'    => 'switcher',
			'title'   => esc_html__('Date Meta', 'trendytravel' ),
			'info'	  => esc_html__('YES! to show post date meta information', 'trendytravel'),
			'default' => true
		  ),

		  array(
			'id'      => 'post-comment-meta',
			'type'    => 'switcher',
			'title'   => esc_html__('Comment Meta', 'trendytravel' ),
			'info'	  => esc_html__('YES! to show post comment meta information', 'trendytravel'),
			'default' => true
		  ),

		  array(
			'id'      => 'post-category-meta',
			'type'    => 'switcher',
			'title'   => esc_html__('Category Meta', 'trendytravel' ),
			'info'	  => esc_html__('YES! to show post category information', 'trendytravel'),
			'default' => true
		  ),

		  array(
			'id'      => 'post-tag-meta',
			'type'    => 'switcher',
			'title'   => esc_html__('Tag Meta', 'trendytravel' ),
			'info'	  => esc_html__('YES! to show post tag information', 'trendytravel'),
			'default' => true
		  ),

		),
	),

	// -----------------------------------------
	// 404 Options
	// -----------------------------------------
	array(
	  'name'      => '404_options',
	  'title'     => esc_html__('404 Options', 'trendytravel'),
	  'icon'      => 'fa fa-warning',

		'fields'      => array(

		  array(
			'type'    => 'subheading',
			'content' => esc_html__( "404 Message", 'trendytravel' ),
		  ),
		  
		  array(
			'id'      => 'enable-404message',
			'type'    => 'switcher',
			'title'   => esc_html__('Enable Message', 'trendytravel' ),
			'info'	  => esc_html__('YES! to enable not-found page message.', 'trendytravel'),
			'default' => true
		  ),

		  array(
			'id'           => 'notfound-style',
			'type'         => 'select',
			'title'        => esc_html__('Template Style', 'trendytravel'),
			'options'      => array(
			  'type1' 	   => esc_html__('Modern', 'trendytravel'),
			  'type2'      => esc_html__('Classic', 'trendytravel'),
			  'type4'  	   => esc_html__('Diamond', 'trendytravel'),
			  'type5'      => esc_html__('Shadow', 'trendytravel'),
			  'type6'      => esc_html__('Diamond Alt', 'trendytravel'),
			  'type7'  	   => esc_html__('Stack', 'trendytravel'),
			  'type8'  	   => esc_html__('Minimal', 'trendytravel'),
			),
			'class'        => 'chosen',
			'default'      => 'type1',
			'info'         => esc_html__('Choose the style of not-found template page.', 'trendytravel')
		  ),

		  array(
			'id'      => 'notfound-darkbg',
			'type'    => 'switcher',
			'title'   => esc_html__('404 Dark BG', 'trendytravel' ),
			'info'	  => esc_html__('YES! to use dark bg notfound page for this site.', 'trendytravel')
		  ),

		  array(
			'id'           => 'notfound-pageid',
			'type'         => 'select',
			'title'        => esc_html__('Custom Page', 'trendytravel'),
			'options'      => 'pages',
			'class'        => 'chosen',
			'default_option' => esc_html__('Choose the page', 'trendytravel'),
			'info'       	 => esc_html__('Choose the page for not-found content.', 'trendytravel')
		  ),
		  
		  array(
			'type'    => 'subheading',
			'content' => esc_html__( "Background Options", 'trendytravel' ),
		  ),

		  array(
			'id'    => 'notfound_background',
			'type'  => 'background',
			'title' => esc_html__('Background', 'trendytravel')
		  ),

		  array(
			'id'  		 => 'notfound-bg-style',
			'type'  	 => 'textarea',
			'title' 	 => esc_html__('Custom Styles', 'trendytravel'),
			'info'		 => esc_html__('Paste custom CSS styles for not found page.', 'trendytravel')
		  ),

		),
	),

	// -----------------------------------------
	// Underconstruction Options
	// -----------------------------------------
	array(
	  'name'      => 'comingsoon_options',
	  'title'     => esc_html__('Under Construction Options', 'trendytravel'),
	  'icon'      => 'fa fa-thumbs-down',

		'fields'      => array(

		  array(
			'type'    => 'subheading',
			'content' => esc_html__( "Under Construction", 'trendytravel' ),
		  ),
	
		  array(
			'id'      => 'enable-comingsoon',
			'type'    => 'switcher',
			'title'   => esc_html__('Enable Coming Soon', 'trendytravel' ),
			'info'	  => esc_html__('YES! to check under construction page of your website.', 'trendytravel')
		  ),
	
		  array(
			'id'           => 'comingsoon-style',
			'type'         => 'select',
			'title'        => esc_html__('Template Style', 'trendytravel'),
			'options'      => array(
			  'type1' 	   => esc_html__('Diamond', 'trendytravel'),
			  'type2'      => esc_html__('Teaser', 'trendytravel'),
			  'type3'  	   => esc_html__('Minimal', 'trendytravel'),
			  'type4'      => esc_html__('Counter Only', 'trendytravel'),
			  'type5'      => esc_html__('Belt', 'trendytravel'),
			  'type6'  	   => esc_html__('Classic', 'trendytravel'),
			  'type7'  	   => esc_html__('Boxed', 'trendytravel')
			),
			'class'        => 'chosen',
			'default'      => 'type1',
			'info'         => esc_html__('Choose the style of coming soon template.', 'trendytravel'),
		  ),

		  array(
			'id'      => 'uc-darkbg',
			'type'    => 'switcher',
			'title'   => esc_html__('Coming Soon Dark BG', 'trendytravel' ),
			'info'	  => esc_html__('YES! to use dark bg coming soon page for this site.', 'trendytravel')
		  ),

		  array(
			'id'           => 'comingsoon-pageid',
			'type'         => 'select',
			'title'        => esc_html__('Custom Page', 'trendytravel'),
			'options'      => 'pages',
			'class'        => 'chosen',
			'default_option' => esc_html__('Choose the page', 'trendytravel'),
			'info'       	 => esc_html__('Choose the page for comingsoon content.', 'trendytravel')
		  ),

		  array(
			'id'      => 'show-launchdate',
			'type'    => 'switcher',
			'title'   => esc_html__('Show Launch Date', 'trendytravel' ),
			'info'	  => esc_html__('YES! to show launch date text.', 'trendytravel'),
		  ),

		  array(
			'id'      => 'comingsoon-launchdate',
			'type'    => 'text',
			'title'   => esc_html__('Launch Date', 'trendytravel'),
			'attributes' => array( 
			  'placeholder' => '10/30/2016 12:00:00'
			),
			'after' 	=> '<p class="cs-text-info">'.esc_html__('Put Format: 12/30/2016 12:00:00 month/day/year hour:minute:second', 'trendytravel').'</p>',
		  ),

		  array(
			'id'           => 'comingsoon-timezone',
			'type'         => 'select',
			'title'        => esc_html__('UTC Timezone', 'trendytravel'),
			'options'      => array(
			  '-12' => '-12', '-11' => '-11', '-10' => '-10', '-9' => '-9', '-8' => '-8', '-7' => '-7', '-6' => '-6', '-5' => '-5', 
			  '-4' => '-4', '-3' => '-3', '-2' => '-2', '-1' => '-1', '0' => '0', '+1' => '+1', '+2' => '+2', '+3' => '+3', '+4' => '+4',
			  '+5' => '+5', '+6' => '+6', '+7' => '+7', '+8' => '+8', '+9' => '+9', '+10' => '+10', '+11' => '+11', '+12' => '+12'
			),
			'class'        => 'chosen',
			'default'      => '0',
			'info'         => esc_html__('Choose utc timezone, by default UTC:00:00', 'trendytravel'),
		  ),

		  array(
			'id'    => 'comingsoon_background',
			'type'  => 'background',
			'title' => esc_html__('Background', 'trendytravel')
		  ),

		  array(
			'id'  		 => 'comingsoon-bg-style',
			'type'  	 => 'textarea',
			'title' 	 => esc_html__('Custom Styles', 'trendytravel'),
			'info'		 => esc_html__('Paste custom CSS styles for under construction page.', 'trendytravel'),
		  ),

		),
	),

  ),
);

// -----------------------------------------
// Widget area Options
// -----------------------------------------
$options[]      = array(
  'name'        => 'widgetarea_options',
  'title'       => esc_html__('Widget Area', 'trendytravel'),
  'icon'        => 'fa fa-trello',

  'fields'      => array(

	  array(
		'type'    => 'subheading',
		'content' => esc_html__( "Custom Widget Area for Sidebar", 'trendytravel' ),
	  ),

	  array(
		'id'           => 'wtitle-style',
		'type'         => 'select',
		'title'        => esc_html__('Sidebar widget Title Style', 'trendytravel'),
		'options'      => array(
		   'default' => esc_html__('Choose any type', 'trendytravel'),
		  'type1' 	   => esc_html__('Double Border', 'trendytravel'),
		  'type2'      => esc_html__('Tooltip', 'trendytravel'),
		  'type3'  	   => esc_html__('Title Top Border', 'trendytravel'),
		  'type4'      => esc_html__('Left Border & Pattren', 'trendytravel'),
		  'type5'      => esc_html__('Bottom Border', 'trendytravel'),
		  'type6'  	   => esc_html__('Tooltip Border', 'trendytravel'),
		  'type7'  	   => esc_html__('Boxed Modern', 'trendytravel'),
		  'type8'  	   => esc_html__('Elegant Border', 'trendytravel'),
		  'type9' 	   => esc_html__('Needle', 'trendytravel'),
		  'type10' 	   => esc_html__('Ribbon', 'trendytravel'),
		  'type11' 	   => esc_html__('Content Background', 'trendytravel'),
		  'type12' 	   => esc_html__('Classic BG', 'trendytravel'),
		  'type13' 	   => esc_html__('Tiny Boders', 'trendytravel'),
		  'type14' 	   => esc_html__('BG & Border', 'trendytravel'),
		  'type15' 	   => esc_html__('Classic BG Alt', 'trendytravel'),
		  'type16' 	   => esc_html__('Left Border & BG', 'trendytravel'),
		  'type17' 	   => esc_html__('Basic', 'trendytravel'),
		  'type18' 	   => esc_html__('BG & Pattern', 'trendytravel'),
		),
		'class'          => 'chosen',
		'default' 		 =>  'default',
		'info'           => esc_html__('Choose the style of sidebar widget title.', 'trendytravel')
	  ),

	  array(
		'id'              => 'widgetarea-custom',
		'type'            => 'group',
		'title'           => esc_html__('Custom Widget Area', 'trendytravel'),
		'button_title'    => esc_html__('Add New', 'trendytravel'),
		'accordion_title' => esc_html__('Add New Widget Area', 'trendytravel'),
		'fields'          => array(

		  array(
			'id'          => 'widgetarea-custom-name',
			'type'        => 'text',
			'title'       => esc_html__('Name', 'trendytravel'),
		  ),

		)
	  ),

	),
);

// -----------------------------------------
// Woocommerce Options
// -----------------------------------------
if( function_exists( 'is_woocommerce' ) && ! class_exists ( 'DTWooPlugin' ) ){

	$options[]      = array(
	  'name'        => 'woocommerce_options',
	  'title'       => esc_html__('Woocommerce', 'trendytravel'),
	  'icon'        => 'fa fa-shopping-cart',

	  'fields'      => array(

		  array(
			'type'    => 'subheading',
			'content' => esc_html__( "Woocommerce Shop Page Options", 'trendytravel' ),
		  ),

		  array(
			'id'  		 => 'shop-product-per-page',
			'type'  	 => 'number',
			'title' 	 => esc_html__('Products Per Page', 'trendytravel'),
			'after'		 => '<span class="cs-text-desc">&nbsp;'.esc_html__('Number of products to show in catalog / shop page', 'trendytravel').'</span>',
			'default' 	 => 12,
		  ),

		  array(
			'id'           => 'product-style',
			'type'         => 'select',
			'title'        => esc_html__('Product Style', 'trendytravel'),
			'options'      => array(
			  'woo-type1' 	   => esc_html__('Thick Border', 'trendytravel'),
			  'woo-type4'      => esc_html__('Diamond Icons', 'trendytravel'),
			  'woo-type8' 	   => esc_html__('Modern', 'trendytravel'),
			  'woo-type10' 	   => esc_html__('Easing', 'trendytravel'),
			  'woo-type11' 	   => esc_html__('Boxed', 'trendytravel'),
			  'woo-type12' 	   => esc_html__('Easing Alt', 'trendytravel'),
			  'woo-type13' 	   => esc_html__('Parallel', 'trendytravel'),
			  'woo-type14' 	   => esc_html__('Pointer', 'trendytravel'),
			  'woo-type16' 	   => esc_html__('Stack', 'trendytravel'),
			  'woo-type17' 	   => esc_html__('Bouncy', 'trendytravel'),
			  'woo-type20' 	   => esc_html__('Masked Circle', 'trendytravel'),
			  'woo-type21' 	   => esc_html__('Classic', 'trendytravel'),
			  'woo-type22' 	   => esc_html__('Trendy', 'trendytravel')
			),
			'class'        => 'chosen',
			'default' 	   => 'woo-type22',
			'info'         => esc_html__('Choose products style to display shop & archive pages.', 'trendytravel')
		  ),

		  array(
			'id'      	 => 'shop-page-product-layout',
			'type'       => 'image_select',
			'title'      => esc_html__('Product Layout', 'trendytravel'),
			'options'    => array(
				  1   => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/one-column.png',
				  2   => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/one-half-column.png',
				  3   => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/one-third-column.png',
				  4   => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/one-fourth-column.png',
			),
			'default'      => 4,
			'attributes'   => array(
			  'data-depend-id' => 'shop-page-product-layout',
			),
		  ),

		  array(
			'type'    => 'subheading',
			'content' => esc_html__( "Product Detail Page Options", 'trendytravel' ),
		  ),

		  array(
			'id'      	   => 'product-layout',
			'type'         => 'image_select',
			'title'        => esc_html__('Layout', 'trendytravel'),
			'options'      => array(
			  'content-full-width'   => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/without-sidebar.png',
			  'with-left-sidebar'    => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/left-sidebar.png',
			  'with-right-sidebar'   => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/right-sidebar.png',
			  'with-both-sidebar'    => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/both-sidebar.png',
			),
			'default'      => 'content-full-width',
			'attributes'   => array(
			  'data-depend-id' => 'product-layout',
			),
		  ),

		  array(
			'id'  		 	 => 'show-shop-standard-left-sidebar-for-product-layout',
			'type'  		 => 'switcher',
			'title' 		 => esc_html__('Show Shop Standard Left Sidebar', 'trendytravel'),
			'dependency'   	 => array( 'product-layout', 'any', 'with-left-sidebar,with-both-sidebar' ),
		  ),

		  array(
			'id'  			 => 'show-shop-standard-right-sidebar-for-product-layout',
			'type'  		 => 'switcher',
			'title' 		 => esc_html__('Show Shop Standard Right Sidebar', 'trendytravel'),
			'dependency' 	 => array( 'product-layout', 'any', 'with-right-sidebar,with-both-sidebar' ),
		  ),

		  array(
			'id'  		 	 => 'enable-related',
			'type'  		 => 'switcher',
			'title' 		 => esc_html__('Show Related Products', 'trendytravel'),
			'info'	  		 => esc_html__("YES! to display related products on single product's page.", 'trendytravel')
		  ),

		  array(
			'type'    => 'subheading',
			'content' => esc_html__( "Product Category Page Options", 'trendytravel' ),
		  ),

		  array(
			'id'      	   => 'product-category-layout',
			'type'         => 'image_select',
			'title'        => esc_html__('Layout', 'trendytravel'),
			'options'      => array(
			  'content-full-width'   => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/without-sidebar.png',
			  'with-left-sidebar'    => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/left-sidebar.png',
			  'with-right-sidebar'   => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/right-sidebar.png',
			  'with-both-sidebar'    => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/both-sidebar.png',
			),
			'default'      => 'content-full-width',
			'attributes'   => array(
			  'data-depend-id' => 'product-category-layout',
			),
		  ),

		  array(
			'id'  		 	 => 'show-shop-standard-left-sidebar-for-product-category-layout',
			'type'  		 => 'switcher',
			'title' 		 => esc_html__('Show Shop Standard Left Sidebar', 'trendytravel'),
			'dependency'   	 => array( 'product-category-layout', 'any', 'with-left-sidebar,with-both-sidebar' ),
		  ),

		  array(
			'id'  			 => 'show-shop-standard-right-sidebar-for-product-category-layout',
			'type'  		 => 'switcher',
			'title' 		 => esc_html__('Show Shop Standard Right Sidebar', 'trendytravel'),
			'dependency' 	 => array( 'product-category-layout', 'any', 'with-right-sidebar,with-both-sidebar' ),
		  ),
		  
		  array(
			'type'    => 'subheading',
			'content' => esc_html__( "Product Tag Page Options", 'trendytravel' ),
		  ),

		  array(
			'id'      	   => 'product-tag-layout',
			'type'         => 'image_select',
			'title'        => esc_html__('Layout', 'trendytravel'),
			'options'      => array(
			  'content-full-width'   => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/without-sidebar.png',
			  'with-left-sidebar'    => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/left-sidebar.png',
			  'with-right-sidebar'   => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/right-sidebar.png',
			  'with-both-sidebar'    => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/both-sidebar.png',
			),
			'default'      => 'content-full-width',
			'attributes'   => array(
			  'data-depend-id' => 'product-tag-layout',
			),
		  ),

		  array(
			'id'  		 	 => 'show-shop-standard-left-sidebar-for-product-tag-layout',
			'type'  		 => 'switcher',
			'title' 		 => esc_html__('Show Shop Standard Left Sidebar', 'trendytravel'),
			'dependency'   	 => array( 'product-tag-layout', 'any', 'with-left-sidebar,with-both-sidebar' ),
		  ),

		  array(
			'id'  			 => 'show-shop-standard-right-sidebar-for-product-tag-layout',
			'type'  		 => 'switcher',
			'title' 		 => esc_html__('Show Shop Standard Right Sidebar', 'trendytravel'),
			'dependency' 	 => array( 'product-tag-layout', 'any', 'with-right-sidebar,with-both-sidebar' ),
		  ),

	  ),
	);
}

// -----------------------------------------
// Sociable Options
// -----------------------------------------
$options[]      = array(
  'name'        => 'sociable_options',
  'title'       => esc_html__('Sociable', 'trendytravel'),
  'icon'        => 'fa fa-share-alt-square',

  'fields'      => array(

	  array(
		'type'    => 'subheading',
		'content' => esc_html__( "Sociable", 'trendytravel' ),
	  ),

	  array(
		'id'              => 'sociable_fields',
		'type'            => 'group',
		'title'           => esc_html__('Sociable', 'trendytravel'),
		'info'            => esc_html__('Click button to add type of social & url.', 'trendytravel'),
		'button_title'    => esc_html__('Add New Social', 'trendytravel'),
		'accordion_title' => esc_html__('Adding New Social Field', 'trendytravel'),
		'fields'          => array(
		  array(
			'id'          => 'sociable_fields_type',
			'type'        => 'select',
			'title'       => esc_html__('Select Social', 'trendytravel'),
			'options'      => array(
			  'delicious' 	 => esc_html__('Delicious', 'trendytravel'),
			  'deviantart' 	 => esc_html__('Deviantart', 'trendytravel'),
			  'digg' 	  	 => esc_html__('Digg', 'trendytravel'),
			  'dribbble' 	 => esc_html__('Dribbble', 'trendytravel'),
			  'envelope' 	 => esc_html__('Envelope', 'trendytravel'),
			  'facebook' 	 => esc_html__('Facebook', 'trendytravel'),
			  'flickr' 		 => esc_html__('Flickr', 'trendytravel'),
			  'google-plus'  => esc_html__('Google Plus', 'trendytravel'),
			  'gtalk'  		 => esc_html__('GTalk', 'trendytravel'),
			  'instagram'	 => esc_html__('Instagram', 'trendytravel'),
			  'lastfm'	 	 => esc_html__('Lastfm', 'trendytravel'),
			  'linkedin'	 => esc_html__('Linkedin', 'trendytravel'),
			  'pinterest'	 => esc_html__('Pinterest', 'trendytravel'),
			  'reddit'		 => esc_html__('Reddit', 'trendytravel'),
			  'rss'		 	 => esc_html__('RSS', 'trendytravel'),
			  'skype'		 => esc_html__('Skype', 'trendytravel'),
			  'stumbleupon'	 => esc_html__('Stumbleupon', 'trendytravel'),
			  'tumblr'		 => esc_html__('Tumblr', 'trendytravel'),
			  'twitter'		 => esc_html__('Twitter', 'trendytravel'),
			  'viadeo'		 => esc_html__('Viadeo', 'trendytravel'),
			  'vimeo'		 => esc_html__('Vimeo', 'trendytravel'),
			  'yahoo'		 => esc_html__('Yahoo', 'trendytravel'),
			  'youtube'		 => esc_html__('Youtube', 'trendytravel'),
			),
			'class'        => 'chosen',
			'default'      => 'delicious',
		  ),

		  array(
			'id'          => 'sociable_fields_url',
			'type'        => 'text',
			'title'       => esc_html__('Enter URL', 'trendytravel')
		  ),
		)

	),
		
	),
);

// -----------------------------------------
// Hook Options
// -----------------------------------------
$options[]      = array(
  'name'        => 'hook_options',
  'title'       => esc_html__('Hooks', 'trendytravel'),
  'icon'        => 'fa fa-paperclip',

  'fields'      => array(

	  array(
		'type'    => 'subheading',
		'content' => esc_html__( "Top Hook", 'trendytravel' ),
	  ),

	  array(
		'id'  	=> 'enable-top-hook',
		'type'  => 'switcher',
		'title' => esc_html__('Enable Top Hook', 'trendytravel'),
		'info'	=> esc_html__("YES! to enable top hook.", 'trendytravel')
	  ),

	  array(
		'id'  		 => 'top-hook',
		'type'  	 => 'textarea',
		'title' 	 => esc_html__('Top Hook', 'trendytravel'),
		'info'		 => esc_html__('Paste your top hook, Executes after the opening &lt;body&gt; tag.', 'trendytravel')
	  ),

	  array(
		'type'    => 'subheading',
		'content' => esc_html__( "Content Before Hook", 'trendytravel' ),
	  ),

	  array(
		'id'  	=> 'enable-content-before-hook',
		'type'  => 'switcher',
		'title' => esc_html__('Enable Content Before Hook', 'trendytravel'),
		'info'	=> esc_html__("YES! to enable content before hook.", 'trendytravel')
	  ),

	  array(
		'id'  		 => 'content-before-hook',
		'type'  	 => 'textarea',
		'title' 	 => esc_html__('Content Before Hook', 'trendytravel'),
		'info'		 => esc_html__('Paste your content before hook, Executes before the opening &lt;#primary&gt; tag.', 'trendytravel')
	  ),

	  array(
		'type'    => 'subheading',
		'content' => esc_html__( "Content After Hook", 'trendytravel' ),
	  ),

	  array(
		'id'  	=> 'enable-content-after-hook',
		'type'  => 'switcher',
		'title' => esc_html__('Enable Content After Hook', 'trendytravel'),
		'info'	=> esc_html__("YES! to enable content after hook.", 'trendytravel')
	  ),

	  array(
		'id'  		 => 'content-after-hook',
		'type'  	 => 'textarea',
		'title' 	 => esc_html__('Content After Hook', 'trendytravel'),
		'info'		 => esc_html__('Paste your content after hook, Executes after the closing &lt;/#main&gt; tag.', 'trendytravel')
	  ),

	  array(
		'type'    => 'subheading',
		'content' => esc_html__( "Bottom Hook", 'trendytravel' ),
	  ),

	  array(
		'id'  	=> 'enable-bottom-hook',
		'type'  => 'switcher',
		'title' => esc_html__('Enable Bottom Hook', 'trendytravel'),
		'info'	=> esc_html__("YES! to enable bottom hook.", 'trendytravel')
	  ),

	  array(
		'id'  		 => 'bottom-hook',
		'type'  	 => 'textarea',
		'title' 	 => esc_html__('Bottom Hook', 'trendytravel'),
		'info'		 => esc_html__('Paste your bottom hook, Executes after the closing &lt;/body&gt; tag.', 'trendytravel')
	  ),

  array(
		'id'  	=> 'enable-analytics-code',
		'type'  => 'switcher',
		'title' => esc_html__('Enable Tracking Code', 'trendytravel'),
		'info'	=> esc_html__("YES! to enable site tracking code.", 'trendytravel')
	  ),

	  array(
		'id'  		 => 'analytics-code',
		'type'  	 => 'textarea',
		'title' 	 => esc_html__('Google Analytics Tracking Code', 'trendytravel'),
		'info'		 => esc_html__('Enter your Google tracking id (UA-XXXXX-X) here. If you want to offer your visitors the option to stop being tracked you can place the shortcode [dt_sc_privacy_google_tracking] somewhere on your site', 'trendytravel')
	  ),

   ),
);


// -----------------------------------------
// Search Options
// -----------------------------------------
$options[]      = array(
  'name'        => 'search_options',
  'title'       => esc_html__('Search', 'trendytravel'),
  'icon'        => 'fa fa-paperclip',

  'fields'      => array(

	  array(
		'type'    => 'subheading',
		'content' => esc_html__( "Search Options", 'trendytravel' ),
	  ),

	  array(
	  'id'      => 'smodule',
	  'type'    => 'text',
	  'title'   => esc_html__('Currency', 'trendytravel'),
	  'after' 	=> '<p class="cs-text-info">'.esc_html__('Please set default currency', 'trendytravel').'</p>',
	),
	
	array(
		'type'    => 'subheading',
		'content' => esc_html__( "Hotels Tab Settings", 'trendytravel' ),
	  ),
	  
	  array(
		'id'  	=> 'disable-hotels-tab',
		'type'  => 'switcher',
		'title' => esc_html__('Disable Hotels Tab', 'trendytravel'),
		'info'	=> esc_html__("YES! to disable hotels tab.", 'trendytravel')
	  ),
	  
	  array(
	  'id'      => 'hotel-title',
	  'type'    => 'text',
	  'title'   => esc_html__('Hotel Title', 'trendytravel'),
	  'after' 	=> '<p class="cs-text-info">'.esc_html__('Put Hotel tab title. eg: Hotels', 'trendytravel').'</p>',
	),
	  
	  array(
		'id'  	=> 'enable-title-module-for-hotels',
		'type'  => 'switcher',
		'title' => esc_html__('Enable Title Module', 'trendytravel'),
		'info'	=> esc_html__("YES! to enable title module.", 'trendytravel')
	  ),
	  
	  array(
		'id'  	=> 'enable-type-module-for-hotels',
		'type'  => 'switcher',
		'title' => esc_html__('Enable Hotels Type Module', 'trendytravel'),
		'info'	=> esc_html__("YES! to enable hotels type module.", 'trendytravel')
	  ),
	  
	  array(
		'id'  	=> 'enable-location-for-hotels',
		'type'  => 'switcher',
		'title' => esc_html__('Enable Hotels Location', 'trendytravel'),
		'info'	=> esc_html__("YES! to enable hotels location.", 'trendytravel')
	  ),
	  
	  array(
		'id'  	=> 'enable-offer-for-hotels',
		'type'  => 'switcher',
		'title' => esc_html__('Enable Hotels Offer', 'trendytravel'),
		'info'	=> esc_html__("YES! to enable offers for hotels.", 'trendytravel')
	  ),
	  
	  array(
		'id'              => 'offer-for-hotels',
		'type'            => 'group',
		'title'           => esc_html__('Hotel Offers', 'trendytravel'),
		'info'            => esc_html__('Click button to add type of hotel offers.', 'trendytravel'),
		'button_title'    => esc_html__('Adding New Hotel Offers', 'trendytravel'),
		'accordion_title' => esc_html__('Adding New Hotel Offers', 'trendytravel'),
		'fields'          => array(
			  array(
				'id'          => 'offer-for-hotels-name',
				'type'        => 'text',
				'title'       => esc_html__('Enter Hotel Offers', 'trendytravel'),
			  ),
		),
	),
	  
	  array(
		'id'  	=> 'enable-min-price-for-hotels',
		'type'  => 'switcher',
		'title' => esc_html__('Enable Minimum Price Search', 'trendytravel'),
		'info'	=> esc_html__("YES! to enable minimum price search for hotels.", 'trendytravel')
	  ),
	  
	  array(
		'id'              => 'min-price-for-hotels',
		'type'            => 'group',
		'title'           => esc_html__('Minimum Price', 'trendytravel'),
		'info'            => esc_html__('Click button to add minimum price.', 'trendytravel'),
		'button_title'    => esc_html__('Adding New Minimum Price', 'trendytravel'),
		'accordion_title' => esc_html__('Adding New Minimum Price', 'trendytravel'),
		'fields'          => array(
			  array(
				'id'          => 'minimum-price-for-hotels',
				'type'        => 'text',
				'title'       => esc_html__('Enter Minimum Price', 'trendytravel'),
			  ),
		),
	),
	  
	  array(
		'id'  	=> 'enable-max-price-for-hotels',
		'type'  => 'switcher',
		'title' => esc_html__('Enable Maximum Price Search', 'trendytravel'),
		'info'	=> esc_html__("YES! to enable maximum price search for hotels.", 'trendytravel')
	  ),
	  
	  array(
		'id'              => 'max-price-for-hotels',
		'type'            => 'group',
		'title'           => esc_html__('Maximum Price', 'trendytravel'),
		'info'            => esc_html__('Click button to add maximum price.', 'trendytravel'),
		'button_title'    => esc_html__('Adding New Maximum Price', 'trendytravel'),
		'accordion_title' => esc_html__('Adding New Maximum Price', 'trendytravel'),
		'fields'          => array(
			  array(
				'id'          => 'maximum-price-for-hotels',
				'type'        => 'text',
				'title'       => esc_html__('Enter Maximum Price', 'trendytravel'),
			  ),
		),
	),
	  
	  array(
		'type'    => 'subheading',
		'content' => esc_html__( "Packages Tab Settings", 'trendytravel' ),
	  ),
	  
	  array(
		'id'  	=> 'disable-packages-tab',
		'type'  => 'switcher',
		'title' => esc_html__('Disable Packages Tab', 'trendytravel'),
		'info'	=> esc_html__("YES! to disable packages tab", 'trendytravel')
	  ),
	  
	  array(
	  'id'      => 'packages-title',
	  'type'    => 'text',
	  'title'   => esc_html__('Packages Title', 'trendytravel'),
	  'after' 	=> '<p class="cs-text-info">'.esc_html__('Put packages tab title. eg: Packages', 'trendytravel').'</p>',
	),
	  
	  array(
		'id'  	=> 'enable-title-module-for-packages',
		'type'  => 'switcher',
		'title' => esc_html__('Enable Title Module', 'trendytravel'),
		'info'	=> esc_html__("YES! to enable title.", 'trendytravel')
	  ),
	  
	  array(
		'id'  	=> 'enable-type-module-for-packages',
		'type'  => 'switcher',
		'title' => esc_html__('Enable Packages Type Module', 'trendytravel'),
		'info'	=> esc_html__("YES! to enable site Packages Type", 'trendytravel')
	  ),
	  
	  array(
		'id'  	=> 'enable-location-for-packages',
		'type'  => 'switcher',
		'title' => esc_html__('Enable Packages Location', 'trendytravel'),
		'info'	=> esc_html__("YES! to enable Packages Location", 'trendytravel')
	  ),
	  
	  array(
		'id'              => 'location-for-packages',
		'type'            => 'group',
		'title'           => esc_html__('Add City/Location for Packages', 'trendytravel'),
		'info'            => esc_html__('Click button to add city/location for packages', 'trendytravel'),
		'button_title'    => esc_html__('Add City/Location for Packages', 'trendytravel'),
		'accordion_title' => esc_html__('Add City/Location for Packages', 'trendytravel'),
		'fields'          => array(
			  array(
				'id'          => 'loc-for-packages',
				'type'        => 'text',
				'title'       => esc_html__('Add City/Location for Packages', 'trendytravel'),
			  ),
		),
	),
	  
	  array(
		'id'  	=> 'enable-persons-for-packages',
		'type'  => 'switcher',
		'title' => esc_html__('Enable Packages No.of. Persons', 'trendytravel'),
		'info'	=> esc_html__("YES! to enable site tracking code.", 'trendytravel')
	  ),
	  
	  
	  array(
		'id'              => 'persons-for-packages',
		'type'            => 'group',
		'title'           => esc_html__('Add Person for Packages', 'trendytravel'),
		'info'            => esc_html__('Click button to add person for packages', 'trendytravel'),
		'button_title'    => esc_html__('Add Person for Packages', 'trendytravel'),
		'accordion_title' => esc_html__('Add Person for Packages', 'trendytravel'),
		'fields'          => array(
			  array(
				'id'          => 'person-for-packages',
				'type'        => 'text',
				'title'       => esc_html__('Add Person for Packages', 'trendytravel'),
			  ),
		),
	),
	  
	  array(
		'id'  	=> 'enable-min-price-for-packages',
		'type'  => 'switcher',
		'title' => esc_html__('Enable Minimum Price Search', 'trendytravel'),
		'info'	=> esc_html__("YES! to enable minimum price search.", 'trendytravel')
	  ),
	  
	  array(
		'id'              => 'min-price-for-packages',
		'type'            => 'group',
		'title'           => esc_html__('Minimum Price', 'trendytravel'),
		'info'            => esc_html__('Click button to add minimum price.', 'trendytravel'),
		'button_title'    => esc_html__('Adding New Minimum Price', 'trendytravel'),
		'accordion_title' => esc_html__('Adding New Minimum Price', 'trendytravel'),
		'fields'          => array(
			  array(
				'id'          => 'minimum-price-for-packages',
				'type'        => 'text',
				'title'       => esc_html__('Enter Minimum Price', 'trendytravel'),
			  ),
		),
	),
	  
	  array(
		'id'  	=> 'enable-max-price-for-packages',
		'type'  => 'switcher',
		'title' => esc_html__('Enable Maximum Price Search', 'trendytravel'),
		'info'	=> esc_html__("YES! to enable maximum price search.", 'trendytravel')
	  ),
	  
	  array(
		'id'              => 'max-price-for-packages',
		'type'            => 'group',
		'title'           => esc_html__('Maximum Price', 'trendytravel'),
		'info'            => esc_html__('Click button to add maximum price.', 'trendytravel'),
		'button_title'    => esc_html__('Adding New Maximum Price', 'trendytravel'),
		'accordion_title' => esc_html__('Adding New Maximum Price', 'trendytravel'),
		'fields'          => array(
			  array(
				'id'          => 'maximum-price-for-packages',
				'type'        => 'text',
				'title'       => esc_html__('Enter Maximum Price', 'trendytravel'),
			  ),
		),
	),
	  
	   array(
		'type'    => 'subheading',
		'content' => esc_html__( "Places Tab Settings", 'trendytravel' ),
	  ),
	  
	  array(
		'id'  	=> 'disable-places-tab',
		'type'  => 'switcher',
		'title' => esc_html__('Disable Places Tab', 'trendytravel'),
		'info'	=> esc_html__("YES! to disable places tab", 'trendytravel')
	  ),
	  
	  array(
	  'id'      => 'places-title',
	  'type'    => 'text',
	  'title'   => esc_html__('Places Title', 'trendytravel'),
	  'after' 	=> '<p class="cs-text-info">'.esc_html__('Put places tab title. eg: Places', 'trendytravel').'</p>',
	),
	  
	  array(
		'id'  	=> 'enable-title-module-for-places',
		'type'  => 'switcher',
		'title' => esc_html__('Enable Title Module', 'trendytravel'),
		'info'	=> esc_html__("YES! to enable title.", 'trendytravel')
	  ),
	  
	  array(
		'id'  	=> 'enable-type-module-for-places',
		'type'  => 'switcher',
		'title' => esc_html__('Enable Places Type Module', 'trendytravel'),
		'info'	=> esc_html__("YES! to enable site places type", 'trendytravel')
	  ),
	  
	  array(
		'id'  	=> 'enable-location-for-places',
		'type'  => 'switcher',
		'title' => esc_html__('Enable Places Location', 'trendytravel'),
		'info'	=> esc_html__("YES! to enable places Location", 'trendytravel')
	  ),
	  
	  array(
		'id'              => 'location-for-places',
		'type'            => 'group',
		'title'           => esc_html__('Add City/Location for Places', 'trendytravel'),
		'info'            => esc_html__('Click button to add city/location for places', 'trendytravel'),
		'button_title'    => esc_html__('Add City/Location for Places', 'trendytravel'),
		'accordion_title' => esc_html__('Add City/Location for Places', 'trendytravel'),
		'fields'          => array(
			  array(
				'id'          => 'loc-for-places',
				'type'        => 'text',
				'title'       => esc_html__('Add City/Location for Places', 'trendytravel'),
			  ),
		),
	),

   ),
);


// -----------------------------------------
// Custom Font Options
// -----------------------------------------
$options[]      = array(
  'name'        => 'font_options',
  'title'       => esc_html__('Custom Fonts', 'trendytravel'),
  'icon'        => 'fa fa-font',

  'fields'      => array(

	  array(
		'type'    => 'subheading',
		'content' => esc_html__( "Custom Fonts", 'trendytravel' ),
	  ),

	  array(
		'id'              => 'custom_font_fields',
		'type'            => 'group',
		'title'           => esc_html__('Custom Font', 'trendytravel'),
		'info'            => esc_html__('Click button to add font name & urls.', 'trendytravel'),
		'button_title'    => esc_html__('Add New Font', 'trendytravel'),
		'accordion_title' => esc_html__('Adding New Font Field', 'trendytravel'),
		'fields'          => array(
		  array(
			'id'          => 'custom_font_name',
			'type'        => 'text',
			'title'       => esc_html__('Font Name', 'trendytravel')
		  ),

		  array(
			'id'      => 'custom_font_woof',
			'type'    => 'upload',
			'title'   => esc_html__('Upload File (*.woff)', 'trendytravel'),
			'after'   => '<p class="cs-text-muted">'.esc_html__('You can upload custom font family (*.woff) file here.', 'trendytravel').'</p>',
		  ),

		  array(
			'id'      => 'custom_font_woof2',
			'type'    => 'upload',
			'title'   => esc_html__('Upload File (*.woff2)', 'trendytravel'),
			'after'   => '<p class="cs-text-muted">'.esc_html__('You can upload custom font family (*.woff2) file here.', 'trendytravel').'</p>',
		  )
		)
	  ),

   ),
);

// ------------------------------
// backup                       
// ------------------------------
$options[]   = array(
  'name'     => 'backup_section',
  'title'    => esc_html__('Backup', 'trendytravel'),
  'icon'     => 'fa fa-shield',
  'fields'   => array(

    array(
      'type'    => 'notice',
      'class'   => 'warning',
      'content' => esc_html__('You can save your current options. Download a Backup and Import.', 'trendytravel')
    ),

    array(
      'type'    => 'backup',
    ),

  )
);

// ------------------------------
// license
// ------------------------------
$options[]   = array(
  'name'     => 'theme_version',
  'title'    => constant('TRENDYTRAVEL_THEME_NAME').esc_html__(' Log', 'trendytravel'),
  'icon'     => 'fa fa-info-circle',
  'fields'   => array(

    array(
      'type'    => 'heading',
      'content' => constant('TRENDYTRAVEL_THEME_NAME').esc_html__(' Theme Change Log', 'trendytravel')
    ),
    array(
      'type'    => 'content',
		'content' => '<pre>

		2020.10.27 - version 5.0

		* Latest jQuery fixes updated
		* Updated: All premium plugins

		2020.10.21 - version 4.9

		* Updated: Coming soon enabled sticky menu issue
		* Updated: All premium plugins
		* Updated: Woocommerce latest version
		* Updated: Booking Page issue
		* Updated: Hotel Rooms availability settings fix
		* Updated: Iphone click issue

		2020.09.14- version 4.8

		* Compatible with wordpress 5.5.1
		* Updated: Notice errors
		* Updated: Fatal error on other theme activation
		* Updated: All premium plugins
		* Updated: Outdated copies of some WooCommerce template files
		* Updated: Icon box shortcode image option design issue
		* Updated: Show reviews, recommendations, hotels and destination button on/off fix in places backend
		* Updated: Show book now, ratings and review button on/off fix in hotels backend
		* Updated: Backend Places template page, category filter option added
		* Updated: Backend Hotels template page, category filter option added
		* Updated: Header login link not working issue
		* Updated: Fatal error on woocommerce deactivation

		2020.08.13 - version 4.7

		* Compatible with wordpress 5.5

		2020.07.28 - version 4.6

		* Updated: Envato Theme check
		* Updated: sanitize_text_field added
		* Updated: All wordpress theme standards
		* Updated: All premium plugins

		2020.02.06 - version 4.5

		* Updated : All premium plugins
		
		2020.01.28 - version 4.4

		* Compatible with wordpress 5.3.2
		* Updated: All premium plugins
		* Updated: All wordpress theme standards
		* Updated: Privacy and Cookies concept
		* Updated: Gutenberg editor support for custom post types

		* Fixed: Google Analytics issue
		* Fixed: Mailchimp email client issue
		* Fixed: Privacy Button Issue
		* Fixed: Gutenberg check for old wordpress version

		* Improved: Tags taxonomy added for portfolio
		* Improved: Single product breadcrumb section
		* Improved: Revisions options added for all custom posts


		2019.11.14 - version 4.3
		* Updated all wordpress theme standards
		* Compatible with latest Gutenberg editor
		* Updated: All premium plugins
		* Compatible with wordpress 5.3

		2019.07.26 - version 4.2
		* Compatible with wordpress 5.2.2
		* Updated: All premium plugins
		* Updated: Revisions added to all custom post types
		* Updated: Gutenberg editor support for custom post types
		* Updated: Link for phone number module
		* Updated: Online documentation link, check readme file

		* Fixed: Customizer logo option
		* Fixed: Google Analytics issue
		* Fixed: Mailchimp email client issue
		* Fixed: Gutenberg check for old wordpress version
		* Fixed: Edit with Visual Composer for portfolio
		* Fixed: Header & Footer wpml option
		* Fixed: Smooth scrolling in ie 11
		* Fixed: Site title color
		* Fixed: Privacy popup bg color
		* Fixed: 404 page scrolling issue

		* Improved: Single product breadcrumb section
		* Improved: Tags taxonomy added for portfolio
		* Improved: Woocommerce cart module added with custom class option

		* New: Whatsapp Shortcode

		2019.07.08 – version 4.1
		* Updated dt_rooms issue

		2019.02.07 – version 4.0
		* Major update of TrendyTravel theme.
		* All the demo contents updated to Visual Composer modules
		* Compatible with wordpress 5.0.3
		* Themes options with codestar framework.
		* Customizer options with Kirki plugin.
		* Gutenberg compatible.
		* Updated documentation.
		* Clients please do not upload the new version TrendyTravel theme or plugin files to your existing trendytravel old version, since the site will crash. If you need to continue with your old version, we have provided the old version trendytravel-old.zip(3.8) separately please use those files. If you need to go with the new visual composer version, you need to install it in a fresh site.
		* Please follow this KB steps for installing the new 4.0 version http://support.wedesignthemes.com/knowledge-base/steps-to-install-new-themes-version/
		
		2018.12.25 – version 3.7
		 
		 * Latest wordpress version 5.0.2 compatible
		 * Updated latest version of all third party plugins
		 * Updated documentation
		
		2018.10.05 - version 3.6
		
		* Fix - Tracking Code Option
		* Fix - Archive Page issue
		* Fix - Updated Plugin files included 
		
		2018.08.20 - version 3.5
		 * Fix - Buddypress issue
		 * Updated latest version of all third party plugins
		 * GDPR Update
		 * Compatible with wordpress 4.9.8
		
		2018.03.08 - version 3.4
		 * New Documentation Updated
		 * All theme functions updated for child theme support
		 * Option to change site color
		 * BuddyPress pages sidebar option issue fixed
		 * Unyson page builder conflict issue fixed
		 * Mail issue fixed with wp core function
		 * In Bpanel # comment removed
		 * Visual Editor option with page builder issue fixed
		 * Color piker issue inside page builder module issue fixed
		 * TGM plugin bulk install issue fixed
		 * Social media shortcode target attribute included
		 * New Widget Modules in Page Builder issues fixed
		 * Menu with disable link option issue fixed
		 * WordPress 4.9.4 compatible
		 * Some design tweaks updated
		 * Updated latest version of all third party plugins
		
		2017.08.24 - version 3.3
		 * Footer content section editable in BPanel
		 * Iconbox shortcodes types content renaming
		 * Woocommerce 4.8.1 compatible
		 * Updated latest version of all third party plugins
		 * Unyson importer content updated
		
		2017.04.25 - version 3.2
		 * Packages shortcode variable product price issue updated
		 * Updated latest version of all third party plugins
		 * Unyson importer content updated
		 * Woocommerce 3.0 compatible
		 * Some design tweaks updated
		 * Few php warnings fixed
		 * Twitter widget link text issue fixed
		 * Few latest scripts updated
		
		2016.11.09 - version 3.1
		 * Page builder fix
		
		2016.10.15 - version 3.0
		 * BPanel UI design fixes for Events Calendar update
		
		2016.10.03 - version 2.9
		 * Woocommerce coupon code update css issue fixed
		 * WPML page builder issue fixed
		 * Dummy data content optimized
		 * Mailchimp updated to latest api 3.0
		 * Updated latest version of all third party plugins
		 * Font awesome css updated
		 * Social share links alignment issue fixed
		 * Page Builder UI enhancements
		 * Dummy content importer updated
		 * Unyson importer plugin included
		 * SSL compatible updated
		
		2016.08.17 - version 2.8
		 * WordPress 4.6 Compatible
		 * Visual Composer 4.12 Compatible
		 * Tribe events widget area class updated
		 * Some translation text missing updated
		 * BuddyPress cover image issue fixed
		 * Global sidebar theme option issue updated
		 * Some design issues updated
		
		2016.08.08 - version 2.7
		 * Map jQuery updated with Google map api
		
		2016.07.01 - version 2.6
		 * Latest TGM plugin updated
		 * Latest Responsive Styled Google Maps plugin updated for Google Maps API key request.
		 * Updated latest version of all third party plugins
		 * Little design tweaks fixed
		
		2016.04.21 - version 2.5
		 * WordPress 4.5 Compatible
		 * Updated latest version of all third party plugins
		 * Pagebuilder small issue fixed
		 * Some design issues fixed
		
		2016.03.24 - version 2.4
		 * Updated latest version of all third party plugins
		 * WordPress 4.4.2 Compatible
		 * WPML compatible issue updated
		 * Pagebuilder small issues fixed
		 * Titledbox shortcode updated
		 * Font awesome stylesheet updated
		 * Some translation texts updated
		 * Some design issues fixed
		
		2015.11.20 - version 2.3
		 * All plugins compatible checked
		 * Added retina support option in BPanel
		 * New Hotels list shortcode added
		 * Hotels & Places single page map issue fixed
		 * Some translation text updated
		 * New documentation updated
		 * Font awesome stylesheet updated
		 * WPML compatible issue updated
		 * BPanel media upload option updated
		 * Added global page layout option in BPanel
		 * WordPress 4.3.1 Compatible
		
		2015.07.29 - version 2.2
		 * All plugins compatible checked
		 * Woocommerce category listing fixed
		
		2015.07.10 - version 2.1
		 * One column shortcode issue fixed
		 * Captcha for contact form added
		 * Category option added for timeline shortcode
		 * Some design issues fixed
		 * Logged users rating issue fixed
		
		2015.06.24 - version 2.0
		 * Fixed XSS vulnerability in prettyPhoto jQuery library
		
		2015.04.25 - version 1.9
		 * Fixed XSS vulnerability
		 * Updated to TGM Plugin 2.4.1
		 * WordPress 4.2 Compatible
		 * Updated latest version of all third party plugins
		 * BPanel options issues fixed
		
		2015.03.23 - version 1.8
		 * Added search module disable option
		 * wpml-config.xml file updated
		 * Single post date disable option fixed
		 * Tour package shortcode issue fixed
		 * All plugins compatible checked
		 * Added "order" option in events shortcode
		
		2015.01.12 - version 1.7
		 * New Image Sizes updated
		
		2014.12.27 - version 1.6
		 * Now Retina ready
		 * Documentaion updated
		 * Added placeholder image disable option
		 * Theme & Plugin language files updated
		 * Added demo slider zip file
		 * rtl.css updated
		 * Dummy content file updated
		 * Some responsive issues fixed
		 * Few BPanel files updated
		
		2014.11.29 - version 1.5
		 * Added Hotels Reservation Module
		 * Added category option in Hotels Widget
		 * Added category option in Package List shortcode
		
		2014.10.24 - version 1.4
		 * Added New Page Builder to create pages
		 * All plugins Compatible checked
		 * Social widget class name updated
		
		2014.09.30 - version 1.3
		 * Jquery nice-scroll updated
		
		2014.09.11 - version 1.2
		 * WordPress 4.0 Compatible
		 * WooCommerce 2.2.2 Compatible
		 * Revolution Slider 4.6.0 updated
		 * Some BPanel option issues fixed
		 * Hotel details metabox issues fixed
		 * Included: Disable Loading bar option
		
		2014.08.21 - version 1.1
		 * Archive pages layout option issues fixed
		 * Places category archives page added
		 * BPanel appearance tab font selection updated
		 * rtl.css updated
		
		2014.07.26 - version 1.0
		 * First release!</pre>',
    ),
  )
);

// ------------------------------
// Seperator
// ------------------------------
$options[] = array(
  'name'   => 'seperator_1',
  'title'  => esc_html__('Plugin Options', 'trendytravel'),
  'icon'   => 'fa fa-plug'
);


CSFramework::instance( $settings, $options );