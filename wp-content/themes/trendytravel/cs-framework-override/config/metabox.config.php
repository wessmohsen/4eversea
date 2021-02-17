<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.

// -----------------------------------------
// Custom Widgets                    -
// -----------------------------------------
function trendytravel_custom_widgets() {
  $custom_widgets = array();
  $widgets = is_array( cs_get_option( 'widgetarea-custom' ) ) ? cs_get_option( 'widgetarea-custom' ) : array();
  $widgets = array_filter($widgets);

  if( isset( $widgets ) ):
    foreach ( $widgets as $widget ) :
      $id = mb_convert_case($widget['widgetarea-custom-name'], MB_CASE_LOWER, "UTF-8");
      $id = str_replace(" ", "-", $id);
      $custom_widgets[$id] = $widget['widgetarea-custom-name'];
    endforeach;
  endif;

  return $custom_widgets;
}

// -----------------------------------------
// Layer Sliders
// -----------------------------------------
function trendytravel_layersliders() {
  $layerslider = array(  esc_html__('Select a slider','trendytravel') );

  if( class_exists( 'LS_Sliders' ) ) {

    $sliders = LS_Sliders::find(array('limit' => 50));

    if(!empty($sliders)) {
      foreach($sliders as $key => $item){
        $layerslider[ $item['id'] ] = $item['name'];
      }
    }
  }

  return $layerslider;
}

// -----------------------------------------
// Revolution Sliders
// -----------------------------------------
function trendytravel_revolutionsliders() {
  $revolutionslider = array( '' => esc_html__('Select a slider','trendytravel') );

  if(class_exists( 'RevSlider' )) {
    $sld = new RevSliderSlider();
    $sliders = $sld->getArrSliders();
    if(!empty($sliders)){
      foreach($sliders as $key => $item) {
        $revolutionslider[$item->getAlias()] = $item->getTitle();
      }
    }    
  }

  return $revolutionslider;  
}

// -----------------------------------------
// Meta Layout Section
// -----------------------------------------
$meta_layout_section =array(
  'name'  => 'layout_section',
  'title' => esc_html__('Layout', 'trendytravel'),
  'icon'  => 'fa fa-columns',
  'fields' =>  array(
    array(
      'id'  => 'layout',
      'type' => 'image_select',
      'title' => esc_html__('Page Layout', 'trendytravel' ),
      'options'      => array(
          'content-full-width'   => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/without-sidebar.png',
          'with-left-sidebar'    => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/left-sidebar.png',
          'with-right-sidebar'   => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/right-sidebar.png',
          'with-both-sidebar'    => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/both-sidebar.png',
          'fullwidth'            => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/fullwidth.png',
      ),
      'default'      => 'content-full-width',
	  'info'		 => esc_html__('Layout "fullwidth" only apply for gallery template.', 'trendytravel'),
      'attributes'   => array( 'data-depend-id' => 'page-layout' )
    ),
    array(
      'id'        => 'show-standard-sidebar-left',
      'type'      => 'switcher',
      'title'     => esc_html__('Show Standard Left Sidebar', 'trendytravel' ),
      'dependency'  => array( 'page-layout', 'any', 'with-left-sidebar,with-both-sidebar' ),
    ),
    array(
      'id'        => 'widget-area-left',
      'type'      => 'select',
      'title'     => esc_html__('Choose Left Widget Areas', 'trendytravel' ),
      'class'     => 'chosen',
      'options'   => trendytravel_custom_widgets(),
      'attributes'  => array( 
        'multiple'  => 'multiple',
        'data-placeholder' => esc_html__('Select Left Widget Areas','trendytravel'),
        'style' => 'width: 400px;'
      ),
      'dependency'  => array( 'page-layout', 'any', 'with-left-sidebar,with-both-sidebar' ),
    ),
    array(
      'id'          => 'show-standard-sidebar-right',
      'type'        => 'switcher',
      'title'       => esc_html__('Show Standard Right Sidebar', 'trendytravel' ),
      'dependency'  => array( 'page-layout', 'any', 'with-right-sidebar,with-both-sidebar' ),
    ),
    array(
      'id'        => 'widget-area-right',
      'type'      => 'select',
      'title'     => esc_html__('Choose Right Widget Areas', 'trendytravel' ),
      'class'     => 'chosen',
      'options'   => trendytravel_custom_widgets(),
      'attributes'    => array( 
        'multiple' => 'multiple',
        'data-placeholder' => esc_html__('Select Right Widget Areas','trendytravel'),
        'style' => 'width: 400px;'
      ),
      'dependency'  => array( 'page-layout', 'any', 'with-right-sidebar,with-both-sidebar' ),
    )
  )
);

// -----------------------------------------
// Meta Breadcrumb Section
// -----------------------------------------
$meta_breadcrumb_section = array(
  'name'  => 'breadcrumb_section',
  'title' => esc_html__('Breadcrumb', 'trendytravel'),
  'icon'  => 'fa fa-arrows-h',
  'fields' =>  array(
    array(
      'id'      => 'enable-sub-title',
      'type'    => 'switcher',
      'title'   => esc_html__('Show Breadcrumb', 'trendytravel' ),
      'default' => true
    ),
    array(
    	'id'                 => 'breadcrumb_position',
	'type'               => 'select',
      'title'              => esc_html__('Position', 'trendytravel' ),
      'options'            => array(
        'header-top-absolute'    => esc_html__('Behind the Header','trendytravel'),
        'header-top-relative' 	   => esc_html__('Default','trendytravel'),
		),
		'default'            => 'header-top-relative',	
      'dependency'         => array( 'enable-sub-title', '==', 'true' ),
    ),    
    array(
      'id'    => 'breadcrumb_background',
      'type'  => 'background',
      'title' => esc_html__('Background', 'trendytravel' ),
      'dependency'   => array( 'enable-sub-title', '==', 'true' ),
    ),
  )
);

// -----------------------------------------
// Meta Slider Section
// -----------------------------------------
$meta_slider_section = array(
  'name'  => 'slider_section',
  'title' => esc_html__('Slider', 'trendytravel'),
  'icon'  => 'fa fa-slideshare',
  'fields' =>  array(
    array(
      'id'           => 'slider-notice',
      'type'         => 'notice',
      'class'        => 'danger',
      'content'      => esc_html__('Slider tab works only if breadcrumb disabled.','trendytravel'),
      'class'        => 'margin-30 cs-danger',
      'dependency'   => array( 'enable-sub-title', '==', 'true' ),
    ),

    array(
      'id'           => 'show_slider',
      'type'         => 'switcher',
      'title'        => esc_html__('Show Slider', 'trendytravel' ),
      'dependency'   => array( 'enable-sub-title', '==', 'false' ),
    ),
    array(
    	'id'                 => 'slider_position',
	'type'               => 'select',
	'title'              => esc_html__('Position', 'trendytravel' ),
	'options'            => array(
		'header-top-relative'     => esc_html__('Top Header Relative','trendytravel'),
		'header-top-absolute'    => esc_html__('Top Header Absolute','trendytravel'),
		'bottom-header' 	   => esc_html__('Bottom Header','trendytravel'),
	),
	'default'            => 'bottom-header',
	'dependency'         => array( 'enable-sub-title|show_slider', '==|==', 'false|true' ),
   ),
   array(
      'id'                 => 'slider_type',
      'type'               => 'select',
      'title'              => esc_html__('Slider', 'trendytravel' ),
      'options'            => array(
        ''                 => esc_html__('Select a slider','trendytravel'),
        'layerslider'      => esc_html__('Layer slider','trendytravel'),
        'revolutionslider' => esc_html__('Revolution slider','trendytravel'),
        'customslider'     => esc_html__('Custom Slider Shortcode','trendytravel'),
      ),
      'validate' => 'required',
      'dependency'         => array( 'enable-sub-title|show_slider', '==|==', 'false|true' ),
    ),

    array(
      'id'          => 'layerslider_id',
      'type'        => 'select',
      'title'       => esc_html__('Layer Slider', 'trendytravel' ),
      'options'     => trendytravel_layersliders(),
      'validate'    => 'required',
      'dependency'  => array( 'enable-sub-title|show_slider|slider_type', '==|==|==', 'false|true|layerslider' )
    ),

    array(
      'id'          => 'revolutionslider_id',
      'type'        => 'select',
      'title'       => esc_html__('Revolution Slider', 'trendytravel' ),
      'options'     => trendytravel_revolutionsliders(),
      'validate'    => 'required',
      'dependency'  => array( 'enable-sub-title|show_slider|slider_type', '==|==|==', 'false|true|revolutionslider' )
    ),

    array(
      'id'          => 'customslider_sc',
      'type'        => 'textarea',
      'title'       => esc_html__('Custom Slider Code', 'trendytravel' ),
      'validate'    => 'required',
      'dependency'  => array( 'enable-sub-title|show_slider|slider_type', '==|==|==', 'false|true|customslider' )
    ),
	
	 array(
      'id'           => 'show_search_section',
      'type'         => 'switcher',
      'title'        => esc_html__('Show Hotels Search', 'trendytravel' ),
      'dependency'   => array( 'enable-sub-title', '==', 'false' ),
	  'info'	=> esc_html__('ON! to show hotels search in slider on this page.','trendytravel'),
    ),
	 array(
      'id'           => 'search_section_on_slider',
      'type'         => 'switcher',
      'title'        => esc_html__('Hotels Search Position', 'trendytravel' ),
      'dependency'   => array( 'enable-sub-title', '==', 'false' ),
	  'info'	=> esc_html__('ON! to show hotels search on the slider.','trendytravel'),
    ),
  )  
);

// -----------------------------------------
// Blog Template Section
// -----------------------------------------
$blog_template_section = array(
  'name'  => 'blog_template_section',
  'title' => esc_html__('Blog Template', 'trendytravel'),
  'icon'  => 'fa fa-files-o',
  'fields' =>  array(
    array(
      'id'           => 'blog-tpl-notice',
      'type'         => 'notice',
      'class'        => 'success',
      'content'      => esc_html__('Blog Tab Works only if page template set to Blog Template in Page Attributes','trendytravel'),
      'class'        => 'margin-30 cs-success',      
    ),
    array(
      'id'                     => 'blog-post-layout',
      'type'                   => 'image_select',
      'title'                  => esc_html__('Post Layout', 'trendytravel' ),
      'options'                => array(
          'one-column'         => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/one-column.png',
          'one-half-column'    => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/one-half-column.png',
          'one-third-column'   => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/one-third-column.png',
		  '1-2-2'			   => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/1-2-2.png',
		  '1-2-2-1-2-2' 	   => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/1-2-2-1-2-2.png',
		  '1-3-3-3'			   => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/1-3-3-3.png',
      '1-3-3-3-1' 		   => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/1-3-3-3-1.png',
      'blog-thumb' 		   => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/thumb.png',
      ),
      'default'                => 'one-half-column'
    ),
    array(
      'id'                     => 'blog-post-style',
      'type'                   => 'select',
      'title'                  => esc_html__('Post Style', 'trendytravel' ),
      'options'                => array(
        'blog-default-style' => esc_html__('Default','trendytravel'),
        'entry-date-left'    => esc_html__('Date Left','trendytravel'),
		'entry-date-left outer-frame-border'      	=> esc_html__('Date Left Modern', 'trendytravel'),
        'entry-date-author-left' => esc_html__('Date and Author Left','trendytravel'),
		'blog-modern-style'      => esc_html__('Modern', 'trendytravel'),
		'bordered'      		 => esc_html__('Bordered', 'trendytravel'),
		'classic'      			 => esc_html__('Classic', 'trendytravel'),
		'entry-overlay-style' 	 => esc_html__('Trendy', 'trendytravel'),
		'overlap' 				 => esc_html__('Overlap', 'trendytravel'),
		'entry-center-align'	 => esc_html__('Stripe', 'trendytravel'),
		'entry-fashion-style'	 => esc_html__('Fashion', 'trendytravel'),
		'entry-minimal-bordered' => esc_html__('Minimal Bordered', 'trendytravel'),
        'blog-medium-style'  	 => esc_html__('Medium','trendytravel'),
        'blog-medium-style dt-blog-medium-highlight' => esc_html__('Medium Highlight','trendytravel'),
        'blog-medium-style dt-blog-medium-highlight dt-sc-skin-highlight' => esc_html__('Medium Skin Highlight','trendytravel')
      ),
      'default'      => 'entry-date-author-left',
    ),
    array(
      'id'      => 'enable-blog-readmore',
      'type'    => 'switcher',
      'title'   => esc_html__('Read More', 'trendytravel' ),
      'default' => true
    ),
    array(
      'id'           => 'blog-readmore',
      'type'         => 'textarea',
      'title'        => esc_html__('Read More Shortcode', 'trendytravel' ),
      'default'      => '[dt_sc_button title="Read More" style="filled" icon_type="fontawesome" iconalign="icon-right with-icon" iconclass="fa fa-long-arrow-right" class="type1" /]',
      'dependency'   => array( 'enable-blog-readmore', '==', 'true' ),
    ),
    array(
      'id'      => 'blog-post-excerpt',
      'type'    => 'switcher',
      'title'   => esc_html__('Allow Excerpt', 'trendytravel' ),
      'default' => true
    ),
    array(
      'id'           => 'blog-post-excerpt-length',
      'type'         => 'number',
      'title'        => esc_html__('Excerpt Length', 'trendytravel' ),
      'default'      => '45',
      'dependency'   => array( 'blog-post-excerpt', '==', 'true' ),
    ),
    array(
      'id'           => 'blog-post-per-page',
      'type'         => 'number',
      'title'        => esc_html__('Post Per Page', 'trendytravel' ),
      'default'      => '-1',      
    ),
    array(
      'id'             => 'blog-post-cats',
      'type'           => 'select',
      'title'          => esc_html__('Categories','trendytravel'),
      'options'        => 'categories',
      'default_option' => esc_html__('Select a categories','trendytravel'),
      'class'              => 'chosen',
      'attributes'         => array(
        'multiple'         => 'only-key',
        'style'            => 'width: 200px;'
      ),
      'info'           => esc_html__('Select categories to exclude from your blog page.','trendytravel'),
    ),
    array(
      'id'      => 'show-postformat-info',
      'type'    => 'switcher',
      'title'   => esc_html__('Show Post Format Info', 'trendytravel' ),
      'default' => true
    ),
    array(
      'id'      => 'show-author-info',
      'type'    => 'switcher',
      'title'   => esc_html__('Show Post Author Info', 'trendytravel' ),
      'default' => true,
    ),
    array(
      'id'      => 'show-date-info',
      'type'    => 'switcher',
      'title'   => esc_html__('Show Post Date Info', 'trendytravel' ),
      'default' => true
    ),
    array(
      'id'      => 'show-comment-info',
      'type'    => 'switcher',
      'title'   => esc_html__('Show Post Comment Info', 'trendytravel' ),
      'default' => true
    ),
    array(
      'id'      => 'show-category-info',
      'type'    => 'switcher',
      'title'   => esc_html__('Show Post Category Info', 'trendytravel' ),
      'default' => true
    ),
    array(
      'id'      => 'show-tag-info',
      'type'    => 'switcher',
      'title'   => esc_html__('Show Post Tag Info', 'trendytravel' ),
      'default' => true
    )    
  )
);

// -----------------------------------------
// Gallery Template Section
// -----------------------------------------
$portfolio_template_section = array(
  'name'  => 'portfolio_template_section',
  'title' => esc_html__('Gallery Template', 'trendytravel'),
  'icon'  => 'fa fa-picture-o',
  'fields' =>  array(

    array(
      'id'           => 'portfolio-tpl-notice',
      'type'         => 'notice',
      'class'        => 'success',
      'content'      => esc_html__('Gallery Tab Works only if page template set to Gallery Template in Page Attributes','trendytravel'),
      'class'        => 'margin-30 cs-success',      
    ),

    array(
      'id'                     => 'portfolio-post-layout',
      'type'                   => 'image_select',
      'title'                  => esc_html__('Post Layout', 'trendytravel' ),
      'options'                => array(
          'one-half-column'    => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/one-half-column.png',
          'one-third-column'   => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/one-third-column.png',
          'one-fourth-column'  => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/one-fourth-column.png',
      ),
      'default'                => 'one-half-column'
    ),

    array(
      'id'      => 'portfolio-post-style',
      'type'    => 'select',
      'title'   => esc_html__('Post Style', 'trendytravel' ),
      'options' => array(
        'type1' => esc_html__('Modern Title','trendytravel'),
        'type2' => esc_html__('Title & Icons Overlay','trendytravel'),
        'type3' => esc_html__('Title Overlay','trendytravel'),
        'type4' => esc_html__('Icons Only','trendytravel'),
        'type5' => esc_html__('Classic','trendytravel'),
        'type6' => esc_html__('Minimal Icons','trendytravel'),
        'type7' => esc_html__('Presentation','trendytravel'),
        'type8' => esc_html__('Girly','trendytravel'),
        'type9' => esc_html__('Art','trendytravel'),
        'type10' 	 => esc_html__('Like This','trendytravel'),
      ),
      'default' => 'type10',
    ),

    array(
      'id'      => 'portfolio-grid-space',
      'type'    => 'switcher',
      'title'   => esc_html__('Allow Grid Space', 'trendytravel' ),
      'default' => true,
      'info'    => esc_html__('YES! to allow grid space in between gallery item','trendytravel')
    ),

    array(
      'id'      => 'filter',
      'type'    => 'switcher',
      'title'   => esc_html__('Allow Filters', 'trendytravel' ),
      'default' => true,
      'info'    => esc_html__('YES! to allow filter options for gallery items','trendytravel')
    ),

    array(
      'id'           => 'portfolio-post-per-page',
      'type'         => 'number',
      'title'        => esc_html__('Post Per Page', 'trendytravel' ),
      'default'      => '-1',      
    ),

    array(
      'id'             => 'portfolio-categories',
      'type'           => 'select',
      'title'          => esc_html__('Categories','trendytravel'),
      'options'        => 'categories',
      'class'          => 'chosen',
      'query_args'     => array(
        'type'         => 'dt_portfolios',
        'taxonomy'     => 'portfolio_entries',
        'orderby'      => 'post_date',
        'order'        => 'DESC',
      ),
      'attributes'         => array(
        'data-placeholder' => esc_html__('Select a categories','trendytravel'),
        'multiple'         => 'only-key',
        'style'            => 'width: 200px;'
      ),
      'info'           => esc_html__('Select categories to show in gallery items.','trendytravel'),
    ),   
  )
);

// -----------------------------------------
// Places Template Section
// -----------------------------------------
$places_template_section = array(
  'name'  => 'places_template_section',
  'title' => esc_html__('Places Template', 'trendytravel'),
  'icon'  => 'fa fa-picture-o',
  'fields' =>  array(

    array(
      'id'           => 'places-tpl-notice',
      'type'         => 'notice',
      'class'        => 'success',
      'content'      => esc_html__('Places Tab Works only if page template set to Places Template in Page Attributes','trendytravel'),
      'class'        => 'margin-30 cs-success',      
    ),

    array(
      'id'                     => 'places-post-layout',
      'type'                   => 'image_select',
      'title'                  => esc_html__('Post Layout', 'trendytravel' ),
      'options'                => array(
          'one-half-column'    => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/one-half-column.png',
          'one-third-column'   => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/one-third-column.png',
          'one-fourth-column'  => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/one-fourth-column.png',
      ),
      'default'                => 'one-half-column'
    ),

    array(
      'id'      => 'places-grid-space',
      'type'    => 'switcher',
      'title'   => esc_html__('Allow Grid Space', 'trendytravel' ),
      'default' => true,
      'info'    => esc_html__('YES! to allow grid space in between gallery item','trendytravel')
    ),

    array(
      'id'      => 'filter',
      'type'    => 'switcher',
      'title'   => esc_html__('Allow Filters', 'trendytravel' ),
      'default' => true,
      'info'    => esc_html__('YES! to allow filter options for gallery items','trendytravel')
    ),

    array(
      'id'           => 'places-post-per-page',
      'type'         => 'number',
      'title'        => esc_html__('Post Per Page', 'trendytravel' ),
      'default'      => '-1',      
    ),   
    array(
      'id'             => 'place-categories',
      'type'           => 'select',
      'title'          => esc_html__('Categories','trendytravel'),
      'options'        => 'categories',
      'class'          => 'chosen',
      'query_args'     => array(
        'type'         => 'dt_places',
        'taxonomy'     => 'place_entries',
        'orderby'      => 'post_date',
        'order'        => 'DESC',
      ),
      'attributes'         => array(
        'data-placeholder' => esc_html__('Select a categories','trendytravel'),
        'multiple'         => 'only-key',
        'style'            => 'width: 200px;'
      ),
      'info'           => esc_html__('Select categories to show in places items.','trendytravel'),
    )
  )
);


// -----------------------------------------
// Hotels Template Section
// -----------------------------------------
$hotels_template_section = array(
  'name'  => 'hotels_template_section',
  'title' => esc_html__('Hotels Template', 'trendytravel'),
  'icon'  => 'fa fa-picture-o',
  'fields' =>  array(

    array(
      'id'           => 'hotels-tpl-notice',
      'type'         => 'notice',
      'class'        => 'success',
      'content'      => esc_html__('Hotels Tab Works only if page template set to Hotels Template in Page Attributes','trendytravel'),
      'class'        => 'margin-30 cs-success',      
    ),

    array(
      'id'                     => 'hotels-post-layout',
      'type'                   => 'image_select',
      'title'                  => esc_html__('Post Layout', 'trendytravel' ),
      'options'                => array(
          'one-half-column'    => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/one-half-column.png',
          'one-third-column'   => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/one-third-column.png',
          'one-fourth-column'  => TRENDYTRAVEL_THEME_URI . '/cs-framework-override/images/one-fourth-column.png',
      ),
      'default'                => 'one-half-column',
	  'info'    => esc_html__('You can choose between a left, right or no sidebar layout.','trendytravel')
    ),

   array(
      'id'      => 'hotel-post-excerpt',
      'type'    => 'switcher',
      'title'   => esc_html__('Allow Excerpt', 'trendytravel' ),
      'default' => true,
      'info'    => esc_html__('Enable Excerpt for hotels ','trendytravel')
    ),

    array(
      'id'      => 'hotels-filter',
      'type'    => 'switcher',
      'title'   => esc_html__('Allow Filters', 'trendytravel' ),
      'default' => true,
      'info'    => esc_html__('Allow filter options for hotels ','trendytravel')
    ),

    array(
      'id'           => 'hotels-post-per-page',
      'type'         => 'number',
      'title'        => esc_html__('Post Per Page', 'trendytravel' ),
      'default'      => '-1',  
	  'info'    => esc_html__('Your hotels pages show at most selected number of posts per page. ','trendytravel')    
    ),  
    
    array(
      'id'             => 'hotel-categories',
      'type'           => 'select',
      'title'          => esc_html__('Categories','trendytravel'),
      'options'        => 'categories',
      'class'          => 'chosen',
      'query_args'     => array(
        'type'         => 'dt_hotels',
        'taxonomy'     => 'hotel_entries',
        'orderby'      => 'post_date',
        'order'        => 'DESC',
      ),
      'attributes'         => array(
        'data-placeholder' => esc_html__('Select a categories','trendytravel'),
        'multiple'         => 'only-key',
        'style'            => 'width: 200px;'
      ),
      'info'           => esc_html__('Select categories to show in hotel items.','trendytravel'),
    ),
	
	array(
		'id'           => 'hotel-post-excerpt-length',
		'type'         => 'text',
		'title'        => esc_html__('Excerpt Length', 'trendytravel' ),
		'info'         => esc_html__('Limit! Number of charectors from the content to appear on each hotel post (Number Only) ', 'trendytravel')
	),
  )
);

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// METABOX OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options = array();

// -----------------------------------------
// Page Metabox Options                    -
// -----------------------------------------
array_push( $meta_layout_section['fields'], array(
  'id'        => 'enable-sticky-sidebar',
  'type'      => 'switcher',
  'title'     => esc_html__('Enable Sticky Sidebar', 'trendytravel' ),
  'dependency'  => array( 'page-layout', 'any', 'with-left-sidebar,with-right-sidebar,with-both-sidebar' )
) );

$options[] = array(
	'id'        => '_tpl_default_settings',
    'title'     => esc_html__('Page Settings','trendytravel'),
    'post_type' => 'page',
    'context'   => 'normal',
    'priority'  => 'high',
    'sections'  => array(
		$meta_layout_section,
		$meta_breadcrumb_section,
		$meta_slider_section,

		$blog_template_section,
		$portfolio_template_section,
		$places_template_section,
		$hotels_template_section,
		array(
		  'name'  => 'sidenav_template_section',
		  'title' => esc_html__('Side Navigation Template', 'trendytravel'),
		  'icon'  => 'fa fa-th-list',
		  'fields' =>  array(

			array(
			  'id'           => 'sidenav-tpl-notice',
			  'type'         => 'notice',
			  'class'        => 'success',
			  'content'      => esc_html__('Side Navigation Tab Works only if page template set to Side Navigation Template in Page Attributes','trendytravel'),
			  'class'        => 'margin-30 cs-success',      
			),

			array(
			  'id'     		 => 'sidenav-style',
			  'type'    	 => 'select',
			  'title'   	 => esc_html__('Side Navigation Style', 'trendytravel' ),
			  'options'    => array(
				   'type1' => esc_html__('Type1','trendytravel'),
				   'type2' => esc_html__('Type2','trendytravel'),
				   'type3' => esc_html__('Type3','trendytravel'),
				   'type4' => esc_html__('Type4','trendytravel'),
				   'type5' => esc_html__('Type5','trendytravel'),
				   'type6' => esc_html__('Type6','trendytravel'),
				   'type7' => esc_html__('Type7','trendytravel'),
				   'type8' => esc_html__('Type8','trendytravel'),
				   'type9' => esc_html__('Type9','trendytravel'),
				   'type10' => esc_html__('Type10','trendytravel')
			  ),
			),

			array(
			  'id'    		 => 'sidenav-align',
			  'type'    	 => 'switcher',
			  'title'   	 => esc_html__('Align Right', 'trendytravel' ),
			  'info'    	 => esc_html__('YES! to align right of side navigation.','trendytravel')
			),

			array(
			  'id'    		 => 'sidenav-sticky',
			  'type'    	 => 'switcher',
			  'title'   	 => esc_html__('Sticky Side Navigation', 'trendytravel' ),
			  'info'    	 => esc_html__('YES! to sticky side navigation content.','trendytravel')
			),

			array(
			  'id'    		 => 'enable-sidenav-content',
			  'type'    	 => 'switcher',
			  'title'   	 => esc_html__('Show Content', 'trendytravel' ),
			  'info'    	 => esc_html__('YES! to show content in below side navigation.','trendytravel')
			),

			array(
			  'id'	    	 => 'sidenav-content',
			  'type'	     => 'textarea',
			  'title'  		 => esc_html__('Side Navigation Content', 'trendytravel' ),
			  'info'    	 => esc_html__('Paste any shortcode content here','trendytravel'),
			  'attributes' 	 => array(
				  'rows'     => 6,
			  ),
			),

		  )
		),
    )
);

// -----------------------------------------
// Post Metabox Options                    -
// -----------------------------------------
$post_meta_layout_section = $meta_layout_section;
$fields = $post_meta_layout_section['fields'];

	$fields[0]['title'] =  esc_html__('Post Layout', 'trendytravel' );
	unset( $fields[0]['options']['with-both-sidebar'] );
	unset( $fields[0]['info'] );
	unset( $fields[0]['options']['fullwidth'] );
	unset( $fields[5] );
	unset( $post_meta_layout_section['fields'] );
	$post_meta_layout_section['fields']  = $fields;  

	$post_format_section = array(
		'name'  => 'post_format_data_section',
		'title' => esc_html__('Post Format', 'trendytravel'),
		'icon'  => 'fa fa-cog',
		'fields' =>  array(

			array(
				'id'      => 'show-featured-image',
				'type'    => 'switcher',
				'title'   => esc_html__('Show Featured Image', 'trendytravel' ),
				'default' => true,
				'info'    => esc_html__('YES! to show featured image','trendytravel')
			),

			array(
				'id'           => 'single-post-style',
				'type'         => 'select',
				'title'        => esc_html__('Post Style', 'trendytravel'),
				'options'      => array(
				  'standard'      		=> esc_html__('Standard', 'trendytravel'),
				  'info-within-image'   => esc_html__('Info WithIn Image', 'trendytravel'),
				  'info-bottom-image'   => esc_html__('Info Over Image Bottom Left', 'trendytravel'),
				  'info-vertical-image' => esc_html__('Info Over Image Vertically Center', 'trendytravel'),
				  'info-above-image'    => esc_html__('Info Above Image', 'trendytravel'),
          'single-flat' 		=> esc_html__('Flat', 'trendytravel'),
          'left-date' 		 	=> esc_html__('Left Date', 'trendytravel')
				),
				'class'        => 'chosen',
				'default'      => 'left-date',
				'info'         => esc_html__('Choose post style to display single post.', 'trendytravel')
			),

			array(
				'id' => 'post-format-type',
				'title'   => esc_html__('Type', 'trendytravel' ),
				'type' => 'select',
				'default' => 'standard',
				'options' => array(
					'standard'  => esc_html__('Standard', 'trendytravel'),
					'status'	=> esc_html__('Status','trendytravel'),
					'quote'		=> esc_html__('Quote','trendytravel'),
					'gallery'	=> esc_html__('Gallery','trendytravel'),
					'image'		=> esc_html__('Image','trendytravel'),
					'video'		=> esc_html__('Video','trendytravel'),
					'audio'		=> esc_html__('Audio','trendytravel'),
					'link'		=> esc_html__('Link','trendytravel'),
					'aside'		=> esc_html__('Aside','trendytravel'),
					'chat'		=> esc_html__('Chat','trendytravel')
				)
			),

			array(
				'id' 	  => 'post-gallery-items',
				'type'	  => 'gallery',
				'title'   => esc_html__('Add Images', 'trendytravel' ),
				'add_title'   => esc_html__('Add Images', 'trendytravel' ),
				'edit_title'  => esc_html__('Edit Images', 'trendytravel' ),
				'clear_title' => esc_html__('Remove Images', 'trendytravel' ),
				'dependency' => array( 'post-format-type', '==', 'gallery' ),
			),

			array(
				'id' 	  => 'media-type',
				'type'	  => 'select',
				'title'   => esc_html__('Select Type', 'trendytravel' ),
				'dependency' => array( 'post-format-type', 'any', 'video,audio' ),
		      	'options'	=> array(
					'oembed' => esc_html__('Oembed','trendytravel'),
					'self' => esc_html__('Self Hosted','trendytravel'),
				)
			),

			array(
				'id' 	  => 'media-url',
				'type'	  => 'textarea',
				'title'   => esc_html__('Media URL', 'trendytravel' ),
				'dependency' => array( 'post-format-type', 'any', 'video,audio' ),
			),
		)
	);

	$options[] = array(
		'id'        => '_dt_post_settings',
		'title'     => esc_html__('Post Settings','trendytravel'),
		'post_type' => 'post',
		'context'   => 'normal',
		'priority'  => 'high',
		'sections'  => array(
			$post_meta_layout_section,
			$meta_breadcrumb_section,
			$post_format_section			
		)
	);

// -----------------------------------------
// Tribe Events Post Metabox Options
// -----------------------------------------
  array_push( $post_meta_layout_section['fields'], array(
    'id' => 'event-post-style',
    'title'   => esc_html__('Post Style', 'trendytravel' ),
    'type' => 'select',
    'default' => 'type1',
    'options' => array(
      'type1'  => esc_html__('Classic', 'trendytravel'),
      'type2'  => esc_html__('Full Width','trendytravel'),
      'type3'  => esc_html__('Minimal Tab','trendytravel'),
      'type4'  => esc_html__('Clean','trendytravel'),
      'type5'  => esc_html__('Modern','trendytravel'),
    ),
	'class'    => 'chosen',
	'info'     => esc_html__('Your event post page show at most selected style.', 'trendytravel')
  ) );

  $options[] = array(
    'id'        => '_custom_settings',
    'title'     => esc_html__('Settings','trendytravel'),
    'post_type' => 'tribe_events',
    'context'   => 'normal',
    'priority'  => 'high',
    'sections'  => array(
      $post_meta_layout_section,
      $meta_breadcrumb_section
    )
  );


// -----------------------------------------
// Header And Footer Options Metabox
// -----------------------------------------
$post_types = apply_filters( 'trendytravel_header_footer_default_cpt' , array ( 'post', 'page' )  );
$options[] = array(
	'id'	=> '_dt_custom_settings',
	'title'	=> esc_html__('Header & Footer','trendytravel'),
	'post_type' => $post_types,
	'priority'  => 'high',
	'context'   => 'side', 
	'sections'  => array(
	
		# Header Settings
		array(
			'name'  => 'header_section',
			'title' => esc_html__('Header', 'trendytravel'),
			'icon'  => 'fa fa-angle-double-right',
			'fields' =>  array(
			
				# Header Show / Hide
				array(
					'id'		=> 'show-header',
					'type'		=> 'switcher',
					'title'		=> esc_html__('Show Header', 'trendytravel'),
					'default'	=>  true,
				),
				
				# Header
				array(
					'id'  		 => 'header',
					'type'  	 => 'select',
					'title' 	 => esc_html__('Choose Header', 'trendytravel'),
					'class'		 => 'chosen',
					'options'	 => 'posts',
					'query_args' => array(
						'post_type'	 => 'dt_headers',
						'orderby'	 => 'ID',
						'order'		 => 'ASC',
						'posts_per_page' => -1,
					),
					'default_option' => esc_attr__('Select Header', 'trendytravel'),
					'attributes' => array( 'style'	=> 'width:50%' ),
					'info'		 => esc_html__('Select custom header for this page.','trendytravel'),
					'dependency'	=> array( 'show-header', '==', 'true' )
				),							
			)			
		),
		# Header Settings

		# Footer Settings
		array(
			'name'  => 'footer_settings',
			'title' => esc_html__('Footer', 'trendytravel'),
			'icon'  => 'fa fa-angle-double-right',
			'fields' =>  array(
			
				# Footer Show / Hide
				array(
					'id'		=> 'show-footer',
					'type'		=> 'switcher',
					'title'		=> esc_html__('Show Footer', 'trendytravel'),
					'default'	=>  true,
				),
				
				# Footer
		        array(
					'id'         => 'footer',
					'type'       => 'select',
					'title'      => esc_html__('Choose Footer', 'trendytravel'),
					'class'      => 'chosen',
					'options'    => 'posts',
					'query_args' => array(
						'post_type'  => 'dt_footers',
						'orderby'    => 'ID',
						'order'      => 'ASC',
						'posts_per_page' => -1,
					),
					'default_option' => esc_attr__('Select Footer', 'trendytravel'),
					'attributes' => array( 'style'  => 'width:50%' ),
					'info'       => esc_html__('Select custom footer for this page.','trendytravel'),
					'dependency'    => array( 'show-footer', '==', 'true' )
				),			
			)			
		),
		# Footer Settings
		
	)	
);



	
CSFramework_Metabox::instance( $options );