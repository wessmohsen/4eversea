<?php
	$wtstyle = cs_get_option( 'wtitle-style' );

	$before_title = '<h3 class="widgettitle">';
	$after_title = '</h3>';

	if( $wtstyle == 'type17' ) {
		$before_title = ' <div class="mz-title"> <div class="mz-title-content"> <h3 class="widgettitle">';
		$after_title  = '</h3> </div> </div>';
	} elseif( $wtstyle == 'type18' ) {
		$before_title = ' <div class="mz-stripe-title"> <div class="mz-stripe-title-content"> <h3 class="widgettitle">';
		$after_title  = '</h3> </div> </div>';
	}

	// standard left sidebar
	register_sidebar(array(
		'name' 			=>	esc_html__('Standard | Left Sidebar', 'trendytravel'),
		'id'			=>	'standard-sidebar-left',
		'description'	=>	esc_html__("Appears in the Left side of the site, one enabled.",'trendytravel'),
		'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
		'after_widget' 	=> 	'</aside>',
		'before_title' 	=> 	$before_title,
		'after_title' 	=> 	$after_title));

	// standard right sidebar
	register_sidebar(array(
		'name' 			=>	esc_html__('Standard | Right Sidebar', 'trendytravel'),
		'id'			=>	'standard-sidebar-right',
		'description'	=>	esc_html__("Appears in the Right side of the site, one enabled.",'trendytravel'),
		'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
		'after_widget' 	=> 	'</aside>',
		'before_title' 	=> 	$before_title,
		'after_title' 	=> 	$after_title));

	// custom widget area
	$widget_areas = is_array( cs_get_option( 'widgetarea-custom' ) ) ? cs_get_option( 'widgetarea-custom' ) : array();
	$widget_areas = array_filter($widget_areas);

    foreach ($widget_areas as $widget_area ) {
	   	$id = mb_convert_case($widget_area['widgetarea-custom-name'], MB_CASE_LOWER, "UTF-8");
    	$id = str_replace(" ", "-", $id);

    	register_sidebar(array(
			'name' 			=>	$widget_area['widgetarea-custom-name'],
			'id'			=>	$id,
			'description'   =>  esc_html__("Custom sidebar created in Designthemes Framework.",'trendytravel'),
			'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</aside>',
			'before_title' 	=> 	$before_title,
			'after_title' 	=> 	$after_title));
    }

	// post archives sidebar
	$layout = cs_get_option( 'post-archives-page-layout' );
	$layout = !empty($layout) ? $layout : "content-full-width";
	switch($layout) :
		case 'with-left-sidebar':
			register_sidebar(array(
				'name' 			=>	esc_html__("Post Archives | Left Sidebar",'trendytravel'),
				'id'			=>	'post-archives-sidebar-left',
				'description'   =>  esc_html__("Appears in the Left side of Post Archives Page.",'trendytravel'),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	$before_title,
				'after_title' 	=> 	$after_title));
		break;

		case 'with-right-sidebar':
			register_sidebar(array(
				'name' 			=>	esc_html__("Post Archives | Right Sidebar",'trendytravel'),
				'id'			=>	'post-archives-sidebar-right',
				'description'   =>  esc_html__("Appears in the Right side of Post Archives Page.",'trendytravel'),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	$before_title,
				'after_title' 	=> 	$after_title));
		break;

		case 'with-both-sidebar':
			register_sidebar(array(
				'name' 			=>	esc_html__("Post Archives | Left Sidebar",'trendytravel'),
				'id'			=>	'post-archives-sidebar-left',
				'description'   =>  esc_html__("Appears in the Left side of Post Archives Page.",'trendytravel'),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	$before_title,
				'after_title' 	=> 	$after_title));

			register_sidebar(array(
				'name' 			=>	esc_html__("Post Archives | Right Sidebar",'trendytravel'),
				'id'			=>	'post-archives-sidebar-right',
				'description'   =>  esc_html__("Appears in the Right side of Post Archives Page.",'trendytravel'),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	$before_title,
				'after_title' 	=> 	$after_title));
		break;
	endswitch;

	// events everywhere sidebar
	if( class_exists('Tribe__Events__Main')	):
		// left sidebar
		register_sidebar(array(
			'name' 			=>	esc_html__('Events | Left Sidebar', 'trendytravel'),
			'id'			=>	'events-everywhere-sidebar-left',
			'description'   =>  esc_html__("Main sidebar for The Events Calendar pages that appears on the left.",'trendytravel'),
			'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</aside>',
			'before_title' 	=> 	$before_title,
			'after_title' 	=> 	$after_title));

		// right sidebar
		register_sidebar(array(
			'name' 			=>	esc_html__('Events | Right Sidebar', 'trendytravel'),
			'id'			=>	'events-everywhere-sidebar-right',
			'description'   =>  esc_html__("Main sidebar for The Events Calendar pages that appears on the right.",'trendytravel'),
			'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</aside>',
			'before_title' 	=> 	$before_title,
			'after_title' 	=> 	$after_title));
	endif;

	// portfolio archives sidebar
	if( class_exists( 'DTCorePlugin' ) ):
		$layout = cs_get_option( 'portfolio-archives-page-layout' );
		$layout = !empty($layout) ? $layout : "content-full-width";
		switch($layout) :
			case 'with-left-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Portfolio Archives | Left Sidebar",'trendytravel'),
					'id'			=>	'custom-post-portfolio-archives-sidebar-left',
					'description'   =>  esc_html__("Appears in the Left side of Portfolio Archives Page.",'trendytravel'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));
			break;

			case 'with-right-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Portfolio Archives | Right Sidebar",'trendytravel'),
					'id'			=>	'custom-post-portfolio-archives-sidebar-right',
					'description'   =>  esc_html__("Appears in the Right side of Portfolio Archives Page.",'trendytravel'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));
			break;

			case 'with-both-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Portfolio Archives | Left Sidebar",'trendytravel'),
					'id'			=>	'custom-post-portfolio-archives-sidebar-left',
					'description'   =>  esc_html__("Appears in the Left side of Portfolio Archives Page.",'trendytravel'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));

				register_sidebar(array(
					'name' 			=>	esc_html__("Portfolio Archives | Right Sidebar",'trendytravel'),
					'id'			=>	'custom-post-portfolio-archives-sidebar-right',
					'description'   =>  esc_html__("Appears in the Right side of Portfolio Archives Page.",'trendytravel'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));
			break;
		endswitch;
	endif;
	
	// hotel archives sidebar
	if( class_exists( 'DTCorePlugin' ) ):
		$layout = cs_get_option( 'hotel-archives-page-layout' );
		$layout = !empty($layout) ? $layout : "content-full-width";
		switch($layout) :
			case 'with-left-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Hotel Archives | Left Sidebar",'trendytravel'),
					'id'			=>	'custom-post-hotel-archives-sidebar-left',
					'description'   =>  esc_html__("Appears in the Left side of Hotel Archives Page.",'trendytravel'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));
			break;

			case 'with-right-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Hotel Archives | Right Sidebar",'trendytravel'),
					'id'			=>	'custom-post-hotel-archives-sidebar-right',
					'description'   =>  esc_html__("Appears in the Right side of Hotel Archives Page.",'trendytravel'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));
			break;

			case 'with-both-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Hotel Archives | Left Sidebar",'trendytravel'),
					'id'			=>	'custom-post-hotel-archives-sidebar-left',
					'description'   =>  esc_html__("Appears in the Left side of Hotel Archives Page.",'trendytravel'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));

				register_sidebar(array(
					'name' 			=>	esc_html__("Hotel Archives | Right Sidebar",'trendytravel'),
					'id'			=>	'custom-post-hotel-archives-sidebar-right',
					'description'   =>  esc_html__("Appears in the Right side of Hotel Archives Page.",'trendytravel'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));
			break;
		endswitch;
	endif;
	
	// places archives sidebar
	if( class_exists( 'DTCorePlugin' ) ):
		$layout = cs_get_option( 'places-archives-page-layout' );
		$layout = !empty($layout) ? $layout : "content-full-width";
		switch($layout) :
			case 'with-left-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Place Archives | Left Sidebar",'trendytravel'),
					'id'			=>	'custom-post-place-archives-sidebar-left',
					'description'   =>  esc_html__("Appears in the Left side of Place Archives Page.",'trendytravel'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));
			break;

			case 'with-right-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Place Archives | Right Sidebar",'trendytravel'),
					'id'			=>	'custom-post-place-archives-sidebar-right',
					'description'   =>  esc_html__("Appears in the Right side of Place Archives Page.",'trendytravel'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));
			break;

			case 'with-both-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Place Archives | Left Sidebar",'trendytravel'),
					'id'			=>	'custom-post-place-archives-sidebar-left',
					'description'   =>  esc_html__("Appears in the Left side of Place Archives Page.",'trendytravel'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));

				register_sidebar(array(
					'name' 			=>	esc_html__("Place Archives | Right Sidebar",'trendytravel'),
					'id'			=>	'custom-post-place-archives-sidebar-right',
					'description'   =>  esc_html__("Appears in the Right side of Place Archives Page.",'trendytravel'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));
			break;
		endswitch;
	endif;

	// shop everywhere sidebar
	if( class_exists('woocommerce')	):
		// left sidebar
		register_sidebar(array(
			'name' 			=>	esc_html__('Shop | Left Sidebar', 'trendytravel'),
			'id'			=>	'shop-everywhere-sidebar-left',
			'description'   =>  esc_html__("Main sidebar for The Shop pages that appears on the left.",'trendytravel'),
			'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</aside>',
			'before_title' 	=> 	$before_title,
			'after_title' 	=> 	$after_title));

		// right sidebar
		register_sidebar(array(
			'name' 			=>	esc_html__('Shop | Right Sidebar', 'trendytravel'),
			'id'			=>	'shop-everywhere-sidebar-right',
			'description'   =>  esc_html__("Main sidebar for The Shop pages that appears on the right.",'trendytravel'),
			'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</aside>',
			'before_title' 	=> 	$before_title,
			'after_title' 	=> 	$after_title));

		// custom left sidebars for product
		$layout = cs_get_option( 'product-layout' );
		$layout = !empty($layout) ? $layout : "content-full-width";
		switch($layout) :
			case 'with-left-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Product Detail | Left Sidebar", 'trendytravel'),
					'id'			=>	"product-detail-sidebar-left",
					'description'	=>  esc_html__("Appears in the Left side of Product details Page.",'trendytravel'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));
			break;

			case 'with-right-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Product Detail | Right Sidebar", 'trendytravel'),
					'id'			=>	"product-detail-sidebar-right",
					'description'	=>  esc_html__("Appears in the Right side of Product details Page.",'trendytravel'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));
			break;

			case 'with-both-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Product Detail | Left Sidebar", 'trendytravel'),
					'id'			=>	"product-detail-sidebar-left",
					'description'	=>  esc_html__("Appears in the Left side of Product details Page.",'trendytravel'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));

				register_sidebar(array(
					'name' 			=>	esc_html__("Product Detail | Right Sidebar", 'trendytravel'),
					'id'			=>	"product-detail-sidebar-right",
					'description'	=>  esc_html__("Appears in the Right side of Product details Page.",'trendytravel'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));
			break;
		endswitch;

		// custom left sidebars for product category
		$layout = cs_get_option( 'product-category-layout' );
		$layout = !empty($layout) ? $layout : "content-full-width";
		switch($layout) :
			case 'with-left-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Product Category | Left Sidebar", 'trendytravel'),
					'id'			=>	"product-category-sidebar-left",
					'description'	=>  esc_html__("Appears on Left side of Product Category Page.",'trendytravel'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));
			break;

			case 'with-right-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Product Category | Right Sidebar", 'trendytravel'),
					'id'			=>	"product-category-sidebar-right",
					'description'	=>  esc_html__("Appears on Right side of Product Category Page.",'trendytravel'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));
			break;

			case 'with-both-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Product Category | Left Sidebar", 'trendytravel'),
					'id'			=>	"product-category-sidebar-left",
					'description'	=>  esc_html__("Appears on Left side of Product Category Page.",'trendytravel'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));

				register_sidebar(array(
					'name' 			=>	esc_html__("Product Category | Right Sidebar", 'trendytravel'),
					'id'			=>	"product-category-sidebar-right",
					'description'	=>  esc_html__("Appears on Right side of Product Category Page.",'trendytravel'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));
			break;
		endswitch;

		// custom left sidebars for product tag
		$layout = cs_get_option( 'product-tag-layout' );
		$layout = !empty($layout) ? $layout : "content-full-width";
		switch($layout) :
			case 'with-left-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Product Tag | Left Sidebar", 'trendytravel'),
					'id'			=>	"product-tag-sidebar-left",
					'description'	=>  esc_html__("Appears on Left side of Product Tag Page.",'trendytravel'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));
			break;

			case 'with-right-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Product Tag | Right Sidebar", 'trendytravel'),
					'id'			=>	"product-tag-sidebar-right",
					'description'	=>  esc_html__("Appears on Right side of Product Tag Page.",'trendytravel'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));
			break;

			case 'with-both-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Product Tag | Left Sidebar", 'trendytravel'),
					'id'			=>	"product-tag-sidebar-left",
					'description'	=>  esc_html__("Appears on Left side of Product Tag Page.",'trendytravel'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));

				register_sidebar(array(
					'name' 			=>	esc_html__("Product Tag | Right Sidebar", 'trendytravel'),
					'id'			=>	"product-tag-sidebar-right",
					'description'	=>  esc_html__("Appears on Right side of Product Tag Page.",'trendytravel'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));
			break;
		endswitch;
	endif; ?>