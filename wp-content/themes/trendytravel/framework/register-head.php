<?php
/* ---------------------------------------------------------------------------
 * Loading Theme Scripts
 * --------------------------------------------------------------------------- */
add_action('wp_enqueue_scripts', 'trendytravel_enqueue_scripts');
function trendytravel_enqueue_scripts() {
	// comment reply script ------------------------------------------------------
	if (is_singular() AND comments_open()):
		wp_enqueue_script( 'comment-reply' );
	endif;

	// scipts variable -----------------------------------------------------------
	$loadingbar = cs_get_option( 'use-site-loader' );
	$loadingbar = !empty( $loadingbar ) ?  "enable" : "disable";

	if(is_rtl()) $rtl = true; else $rtl = false;

	wp_enqueue_script('ui-totop', get_theme_file_uri('/framework/js/jquery.ui.totop.min.js'), array(), false, true);
	wp_enqueue_script('easing', get_theme_file_uri('/framework/js/jquery.easing.js'), array(), false, true);
	wp_enqueue_script('caroufredsel', get_theme_file_uri('/framework/js/jquery.caroufredsel.js'), array(), false, true);
	wp_enqueue_script('debouncedresize', get_theme_file_uri('/framework/js/jquery.debouncedresize.js'), array(), false, true);
	wp_enqueue_script('prettyphoto', get_theme_file_uri('/framework/js/jquery.prettyphoto.js'), array(), false, true);
	wp_enqueue_script('touchswipe', get_theme_file_uri('/framework/js/jquery.touchswipe.js'), array(), false, true);
	wp_enqueue_script('parallax', get_theme_file_uri('/framework/js/jquery.parallax.js'), array(), false, true);
	wp_enqueue_script('downcount', get_theme_file_uri('/framework/js/jquery.downcount.js'), array(), false, true);
	wp_enqueue_script('nicescroll', get_theme_file_uri('/framework/js/jquery.nicescroll.js'), array(), false, true);
	wp_enqueue_script('bxslider', get_theme_file_uri('/framework/js/jquery.bxslider.js'), array(), false, true);
	wp_enqueue_script('fitvids', get_theme_file_uri('/framework/js/jquery.fitvids.js'), array(), false, true);
	wp_enqueue_script('sticky', get_theme_file_uri('/framework/js/jquery.sticky.js'), array(), false, true);
	wp_enqueue_script('simple-sidebar', get_theme_file_uri('/framework/js/jquery.simple-sidebar.js'), array(), false, true);
	wp_enqueue_script('classie', get_theme_file_uri('/framework/js/jquery.classie.js'), array(), false, true);
	wp_enqueue_script('placeholder', get_theme_file_uri('/framework/js/jquery.placeholder.js'), array(), false, true);
	wp_enqueue_script('visualnav', get_theme_file_uri('/framework/js/jquery.visualNav.min.js'), array(), false, true);
	wp_enqueue_script('resizesensor', get_theme_file_uri('/framework/js/ResizeSensor.min.js'), array(), false, true);
	wp_enqueue_script('theia-sticky-sidebar', get_theme_file_uri('/framework/js/theia-sticky-sidebar.min.js'), array(), false, true);
	wp_register_script('particles-min', get_theme_file_uri('/framework/js/particles.min.js'), array(), false, true);
	
	wp_enqueue_script('validate', get_theme_file_uri('/framework/js/jquery.validate.min.js'),array(),false,true);
	wp_enqueue_script('colorbox', get_theme_file_uri('/framework/js/jquery.colorbox-min.js'), array(), false, true);
	wp_enqueue_script('fancybox', get_theme_file_uri('/framework/js/jquery.fancybox.pack.js'), array(), false, true);
	wp_enqueue_script('contact', get_theme_file_uri('/framework/js/contact.js'), array(), false, true);

	//Hotel and Places details page map
	if(is_singular('dt_hotels') || is_singular('dt_places')):
		$args = array( 'key' => cs_get_option('google-map-key'), 'callback' => 'initMap' );
		$mapurl = add_query_arg( $args, 'https://maps.googleapis.com/maps/api/js' );
		wp_enqueue_script('jq-googleapi', esc_url_raw($mapurl), array(), false, true);
	endif;

	if(class_exists('Tribe__Events__Pro__Main')) {
		if(!tribe_is_photo()) {
			wp_enqueue_script('isotope-pkgd', get_theme_file_uri('/framework/js/isotope.pkgd.min.js'), array(), false, true);
		}
	} else {
		wp_enqueue_script('isotope-pkgd', get_theme_file_uri('/framework/js/isotope.pkgd.min.js'), array(), false, true);
	}
	
	if( cs_get_option('enable-cookie-consent') == "true" ) {
		wp_enqueue_script('trendytravel-cookie', get_theme_file_uri('/framework/js/cookieconsent.js'), array(), false, true);
	}

	wp_enqueue_script('magnific-popup', get_theme_file_uri('/framework/js/magnific/jquery.magnific-popup.min.js'), array(), false, true);

	if( $loadingbar == 'enable' ) {
		wp_enqueue_script('pace', get_theme_file_uri('/framework/js/pace.min.js'),array(),false,true);
		wp_localize_script('pace', 'paceOptions', array(
			'restartOnRequestAfter' => 'false',
			'restartOnPushState' => 'false'
		));
	}

	wp_enqueue_script('trendytravel-jqcustom', get_theme_file_uri('/framework/js/custom.js'), array(), false, true);

	wp_localize_script('nicescroll', 'dttheme_urls', array(
		'theme_base_url' => esc_js(TRENDYTRAVEL_THEME_URI),
		'framework_base_url' => esc_js(TRENDYTRAVEL_THEME_URI).'/framework/',
		'ajaxurl' => esc_url( admin_url('admin-ajax.php') ),
		'url' => esc_url( get_site_url() ),
		'isRTL' => esc_js($rtl),
		'loadingbar' => esc_js($loadingbar),
		'advOptions' => esc_html__('Show Advanced Options', 'trendytravel'),
		'wpnonce' => wp_create_nonce('rating-nonce'),
		'hotelwpnonce' => wp_create_nonce('hotel-nonce'),
		'bookingwpnonce' => wp_create_nonce('booking-nonce')
	));

	$picker = cs_get_option( 'enable-stylepicker' );
	if( isset($picker) ) {
		wp_enqueue_script('cookie', get_theme_file_uri('/framework/js/jquery.cookie.min.js'),array(),false,true);
		wp_enqueue_script('trendytravel-jqcpanel', get_theme_file_uri('/framework/js/controlpanel.js'),array(),false,true);
	}
	
	#Hotels Booking File Starts...
	$disable_hotel_booking = cs_get_option('disable-hotel-booking');
	if(!isset($disable_hotel_booking) ) {
		wp_enqueue_script('trendytravel-hb-booking-script', get_theme_file_uri('/framework/js/booking.script.js'), array(), false, true);
		wp_enqueue_style( 'trendytravel-hb-front-flick-theme', get_theme_file_uri('/framework/hotelbooking/css/flick/jquery-ui.min.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );
		wp_enqueue_style( 'trendytravel-hb-front-flick-ui-dp', get_theme_file_uri('/framework/hotelbooking/css/ui-flick.datepick.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );
	
		wp_enqueue_script('jquery-ui');
		wp_enqueue_script('jquery-effects-core');
		wp_enqueue_script('jquery-effects-pulsate');
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('jquery-ui-autocomplete');
	}
	#Hotels Booking File Ends...
}

/* ---------------------------------------------------------------------------
 * Scripts of Custom JS from Theme Back-End
* --------------------------------------------------------------------------- */
function trendytravel_scripts_custom() {
	
	$enable_custom_js = (int) get_theme_mod( 'enable-custom-js', trendytravel_defaults('enable-custom-js') );
	$custom_js = get_theme_mod( 'custom-js', '');
	
	if( !empty( $enable_custom_js ) && !empty( $custom_js ) ){
		wp_add_inline_script('trendytravel-jqcustom', trendytravel_wp_kses(stripslashes($custom_js)) ,'after');
	}
}
add_action('wp_enqueue_scripts', 'trendytravel_scripts_custom', 100);

/* ---------------------------------------------------------------------------
 * Loading Theme Styles
 * --------------------------------------------------------------------------- */
add_action( 'wp_enqueue_scripts', 'trendytravel_enqueue_styles', 101 );
function trendytravel_enqueue_styles() {

	// site icons ---------------------------------------------------------------
	if ( ! has_site_icon() ):
		$url = TRENDYTRAVEL_THEME_URI . "/images/favicon.ico";
		echo "<link href='$url' rel='shortcut icon' type='image/x-icon' />\n";		
	endif;

	// wp_enqueue_style ---------------------------------------------------------------
	wp_enqueue_style( 'trendytravel', get_stylesheet_uri(), false, TRENDYTRAVEL_THEME_VERSION, 'all' );

	wp_enqueue_style( 'trendytravel-base',		  get_theme_file_uri('/css/base.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );
	wp_enqueue_style( 'trendytravel-grid', 		  get_theme_file_uri('/css/grid.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );
	wp_enqueue_style( 'trendytravel-widget', 	  get_theme_file_uri('/css/widget.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );
	wp_enqueue_style( 'trendytravel-layout', 	  get_theme_file_uri('/css/layout.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );
	wp_enqueue_style( 'trendytravel-blog',	      get_theme_file_uri('/css/blog.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );
	wp_enqueue_style( 'trendytravel-contact',	  get_theme_file_uri('/css/contact.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );
	wp_enqueue_style( 'trendytravel-custom-class', get_theme_file_uri('/css/custom-class.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );
	wp_enqueue_style( 'trendytravel-browsers', 	  get_theme_file_uri('/css/browsers.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );

	wp_enqueue_style( 'prettyphoto',	get_theme_file_uri('/css/prettyPhoto.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );

	wp_enqueue_style( 'trendytravel-google-fonts',	trendytravel_load_fonts_url(), array(), TRENDYTRAVEL_THEME_VERSION, 'all' );

	if (function_exists('bp_add_cover_image_inline_css')) {
		$inline_css = bp_add_cover_image_inline_css( true );
		wp_add_inline_style( 'bp-parent-css', strip_tags( $inline_css['css_rules'] ) );
	}

	// icon fonts ---------------------------------------------------------------------
	wp_enqueue_style ( 'custom-font-awesome',		get_theme_file_uri('/css/font-awesome.min.css'), array (), '4.3.0' );
	wp_enqueue_style ( 'pe-icon-7-stroke',			get_theme_file_uri('/css/pe-icon-7-stroke.css'), array () );
	wp_enqueue_style ( 'stroke-gap-icons-style',	get_theme_file_uri('/css/stroke-gap-icons-style.css'), array () );
	wp_enqueue_style ( 'icon-moon',					get_theme_file_uri('/css/icon-moon.css'), array () );
	wp_enqueue_style ( 'material-design-iconic',	get_theme_file_uri('/css/material-design-iconic-font.min.css'), array () );

	// comingsoon css
	if( cs_get_option( 'enable-comingsoon' ) )
		wp_enqueue_style("trendytravel-comingsoon",  get_theme_file_uri("/css/comingsoon.css"), false, TRENDYTRAVEL_THEME_VERSION, 'all' );

	// notfound css
	if ( is_404() )
		wp_enqueue_style("trendytravel-notfound",	get_theme_file_uri("/css/notfound.css"), false, TRENDYTRAVEL_THEME_VERSION, 'all' );

	// loader css
	$loadingbar = cs_get_option( 'use-site-loader' );
	if( !empty( $loadingbar ) )
		wp_enqueue_style("trendytravel-loader", 		get_theme_file_uri("/css/loaders.css"), false, TRENDYTRAVEL_THEME_VERSION, 'all' );

	// woocommerce css
	if( function_exists( 'is_woocommerce' ) ):
		wp_enqueue_style( 'trendytravel-woo-default', 		get_theme_file_uri('/css/woocommerce/woocommerce-default.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );
		wp_enqueue_style( 'trendytravel-woo-type1', 			get_theme_file_uri('/css/woocommerce/type1-fashion.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );
		wp_enqueue_style( 'trendytravel-woo-type4', 			get_theme_file_uri('/css/woocommerce/type4-hosting.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );
		wp_enqueue_style( 'trendytravel-woo-type8', 			get_theme_file_uri('/css/woocommerce/type8-insurance.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );
		wp_enqueue_style( 'trendytravel-woo-type10', 		get_theme_file_uri('/css/woocommerce/type10-medical.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );
		wp_enqueue_style( 'trendytravel-woo-type11', 		get_theme_file_uri('/css/woocommerce/type11-model.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );
		wp_enqueue_style( 'trendytravel-woo-type12', 		get_theme_file_uri('/css/woocommerce/type12-attorney.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );
		wp_enqueue_style( 'trendytravel-woo-type13', 		get_theme_file_uri('/css/woocommerce/type13-architecture.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );
		wp_enqueue_style( 'trendytravel-woo-type14', 		get_theme_file_uri('/css/woocommerce/type14-fitness.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );
		wp_enqueue_style( 'trendytravel-woo-type16', 		get_theme_file_uri('/css/woocommerce/type16-photography.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );
		wp_enqueue_style( 'trendytravel-woo-type17', 		get_theme_file_uri('/css/woocommerce/type17-restaurant.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );
		wp_enqueue_style( 'trendytravel-woo-type20', 		get_theme_file_uri('/css/woocommerce/type20-yoga.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );
		wp_enqueue_style( 'trendytravel-woo-type21', 		get_theme_file_uri('/css/woocommerce/type21-styleshop.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );

		wp_enqueue_style( 'trendytravel-woo', 				get_theme_file_uri('/css/woocommerce.css'), 'woocommerce-general-css', TRENDYTRAVEL_THEME_VERSION, 'all' );
	endif;


	// tribe-events -------------------------------------------------------------------
	wp_enqueue_style( 'trendytravel-customevent', 		get_theme_file_uri('/tribe-events/custom.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );
	
	// cookie-consent -----------------------------------------------------------------
	if( cs_get_option('enable-cookie-consent') == "true" ) {
		wp_enqueue_style( 'trendytravel-cookie-css', 		get_theme_file_uri('/css/cookieconsent.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );
	}

	wp_enqueue_style( 'trendytravel-magnific-popup', 	get_theme_file_uri('/framework/js/magnific/magnific-popup.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );

	// custom css ---------------------------------------------------------------------
	wp_enqueue_style( 'trendytravel-custom', 			get_theme_file_uri('/css/custom.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );

	// jquery scripts --------------------------------------------
	wp_enqueue_script('modernizr-custom', 	get_theme_file_uri('/framework/js/modernizr.custom.js'), array('jquery'));
	
	wp_enqueue_style( 'trendytravel-colorbox', get_theme_file_uri('/css/colorbox.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );
	wp_enqueue_style( 'trendytravel-fancybox', get_theme_file_uri('/css/jquery.fancybox.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );
	wp_enqueue_style('trendytravel-rating', get_theme_file_uri('/css/rating.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );
	
	if(is_singular('dt_hotels') || is_singular('dt_places')):
		$api_key = cs_get_option( 'google-map-key' );
		$api_url = 'http://maps.googleapis.com';
		if( is_ssl() ) {
			$api_url = 'https://maps-api-ssl.google.com';
		}
		$api_url .= '/maps/api/js';
		$api_url = add_query_arg( array( 'key' => $api_key ) , $api_url );
	endif;

	// rtl ----------------------------------------------------------------------------
	if(is_rtl()) wp_enqueue_style('trendytravel-rtl', 	get_theme_file_uri('/css/rtl.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );
	
	// gutenberg css ---------------------------------------------------------------------
	wp_enqueue_style( 'trendytravel-gutenberg', get_theme_file_uri('/css/gutenberg.css'), false, TRENDYTRAVEL_THEME_VERSION, 'all' );

	$primary_color = get_theme_mod('primary-color',trendytravel_defaults('primary-color'));
	$secondary_color = get_theme_mod('secondary-color',trendytravel_defaults('secondary-color'));
	$tertiary_color = get_theme_mod('tertiary-color',trendytravel_defaults('tertiary-color'));
	$quinary_color = get_theme_mod('quinary-color',trendytravel_defaults('quinary-color'));
	

	$css = '';

	if( !empty( $primary_color ) ) {

		$rgba = trendytravel_hex2rgb( $primary_color );
		$rgba = implode(',', $rgba);

		# Widget Style
		$widget_style = cs_get_option( 'wtitle-style' );
		if( $widget_style == 'type5' ) {
			$css .= '.secondary-sidebar .type5 .widgettitle { border-color:rgba('.$rgba.', 0.5) }';
		} if( $widget_style == 'type12' ) {
			$css .= '.secondary-sidebar .type12 .widgettitle { background: rgba('.$rgba.', 0.2) }';
		}

		$css .= '.dt-sc-menu-sorting a { color: rgba('.$rgba.', 0.6) }';
		$css .= '.dt-sc-team.type2 .dt-sc-team-thumb .dt-sc-team-thumb-overlay, .dt-sc-hexagon-image span:before, .dt-sc-keynote-speakers .dt-sc-speakers-thumb .dt-sc-speakers-thumb-overlay {  background: rgba('.$rgba.', 0.9) }';

		$css .= '.recent-portfolio-widget ul li a:before, .dt-sc-image-caption.type2:hover .dt-sc-image-content, .dt-sc-fitness-program-short-details-wrapper .dt-sc-fitness-program-short-details { background: rgba('.$rgba.', 0.9) }';

		# Shortcode
		$css .= '.dt-sc-contact-info.type4 span:after, .dt-sc-pr-tb-col.type2 .dt-sc-tb-header:before { box-shadow:5px 0px 0px 0px '.$primary_color.'}';
		// $css .= '.dt-sc-icon-box.type10:hover .icon-wrapper:before { box-shadow:7px 0px 0px 0px '.$primary_color.'}';
		$css .= '.dt-sc-counter.type6 .dt-sc-couter-icon-holder:before { box-shadow:5px 1px 0px 0px '.$primary_color.'}';
		$css .= '.dt-sc-button.with-shadow.white, .dt-sc-pr-tb-col.type2 .dt-sc-buy-now a { box-shadow:3px 3px 0px 0px '.$primary_color.'}';
		$css .= '.dt-sc-custom-icon-box .dt-sc-icon-box.type3.light-border:hover .icon-wrapper span { box-shadow: 0 0 0 8px rgba('.$rgba.',0.3) }';

		$css .= '.dt-sc-restaurant-events-list .dt-sc-restaurant-event-details h6:before { border-bottom-color: rgba('.$rgba.',0.6) }';
		$css .= '.portfolio.type4 .image-overlay, .dt-sc-timeline-section.type4 .dt-sc-timeline-thumb-overlay, .dt-sc-yoga-classes .dt-sc-yoga-classes-image-wrapper:before, .dt-sc-yoga-course .dt-sc-yoga-course-thumb-overlay, .dt-sc-yoga-program .dt-sc-yoga-program-thumb-overlay, .dt-sc-yoga-pose .dt-sc-yoga-pose-thumb:before, .dt-sc-yoga-teacher .dt-sc-yoga-teacher-thumb:before, .dt-sc-doctors .dt-sc-doctors-thumb-overlay, .dt-sc-event-addon > .dt-sc-event-addon-date, .dt-sc-course .dt-sc-course-overlay, .dt-sc-process-steps .dt-sc-process-thumb-overlay { background: rgba('.$rgba.',0.85) }';

		$css .= '@media only screen and (max-width: 767px) { .dt-sc-contact-info.type4:after, .dt-sc-counter.type6.last h4::before, .dt-sc-counter.type6 h4::after { background-color:'.$primary_color.'} }';
		$css .= '@media only screen and (max-width: 767px) { .dt-sc-timeline-section.type2, .dt-sc-timeline-section.type2::before { border-color:'.$primary_color.'} }';
		
		# WooCommerce
		if( function_exists( 'is_woocommerce' ) ){

			$css .= '.woocommerce ul.products li.product .woo-type1 .star-rating:before, .woocommerce ul.products li.product .woo-type1 .star-rating span:before, .woocommerce ul.products li.product .woo-type1 .star-rating:before, .woocommerce ul.products li.product .woo-type1 .star-rating span:before, .woocommerce .woo-type1 .star-rating:before, .woocommerce .woo-type1 .star-rating span:before, .woocommerce .woo-type1 .star-rating:before, .woocommerce .woo-type1 .star-rating span:before { color: rgba('.$rgba.', 0.75) }';
			$css .= '.woocommerce ul.products li.product:hover .woo-type8 .product-content, .woocommerce ul.products li.product-category:hover .woo-type8 .product-thumb .image:after, .woocommerce ul.products li.product:hover .woo-type8 .product-content, .woocommerce ul.products li.product-category:hover .woo-type8 .product-thumb .image:after, .woocommerce ul.products li.product:hover .woo-type13 .product-content, .woocommerce ul.products li.product:hover .woo-type13 .product-content, .woocommerce ul.products li.product.instock:hover .woo-type13 .on-sale-product .product-content, .woocommerce ul.products li.product.instock:hover .woo-type13 .on-sale-product .product-content, .woocommerce ul.products li.product.outofstock:hover .woo-type13 .out-of-stock-product .product-content, .woocommerce ul.products li.product.outofstock:hover .woo-type13 .out-of-stock-product .product-content, .woocommerce ul.products li.product-category:hover .woo-type13 .product-thumb .image:after, .woocommerce ul.products li.product-category:hover .woo-type13 .product-thumb .image:after { background-color: rgba('.$rgba.', 0.75) }';

			$css .= '.woocommerce ul.products li.product:hover .woo-type8 .product-content:after, .woocommerce ul.products li.product:hover .woo-type8 .product-content:after {
				border-color : rgba( '.$rgba.', 0.75 ) rgba('.$rgba.', 0.75 ) rgba(255, 255, 255, 0.35) rgba(255, 255, 255, 0.35)
			}';				

			$css .= 'ul.products li.product:hover .woo-type11 .product-wrapper {
				-webkit-box-shadow: 0 0 0 3px '.$primary_color.';
				-moz-box-shadow: 0 0 0 3px '.$primary_color.';
				-ms-box-shadow: 0 0 0 3px '.$primary_color.';
				-o-box-shadow: 0 0 0 3px '.$primary_color.';
				box-shadow: 0 0 0 3px '.$primary_color.';
			}';

			$css .= '.woo-type12 ul.products li.product .product-details {
				-webkit-box-shadow: 0 -3px 0 0 '.$primary_color.' inset;
				-moz-box-shadow: 0 -3px 0 0 '.$primary_color.' inset;
				-ms-box-shadow: 0 -3px 0 0 '.$primary_color.' inset;
				-o-box-shadow: 0 -3px 0 0 '.$primary_color.' inset;
				box-shadow: 0 -3px 0 0 '.$primary_color.' inset;
			}';

			$css .= 'ul.products li.product .woo-type14 .product-details, ul.products li.product .woo-type14 .product-details h5:after {
				-webkit-box-shadow: 0 0 0 2px '.$primary_color.' inset;
				-moz-box-shadow: 0 0 0 2px '.$primary_color.' inset;
				-ms-box-shadow: 0 0 0 2px '.$primary_color.' inset;
				-o-box-shadow: 0 0 0 2px '.$primary_color.' inset;
				box-shadow: 0 0 0 2px '.$primary_color.' inset;					
			}';
		}			
	}

	if( !empty( $secondary_color ) ) {

		$rgba = trendytravel_hex2rgb( $secondary_color );
		$rgba = implode(',', $rgba);

		$css .= '.dt-sc-event-month-thumb .dt-sc-event-read-more, .dt-sc-training-thumb-overlay{ background: rgba('.$rgba.',0.85) }';

		# Shortcode
		$css .= '@media only screen and (max-width: 767px) { .dt-sc-highlight .dt-sc-testimonial.type6 .dt-sc-testimonial-author:after,.dt-sc-highlight .dt-sc-testimonial.type6 .dt-sc-testimonial-author:after,.skin-highlight .dt-sc-testimonial.type6 .dt-sc-testimonial-author:after { background-color:'.$secondary_color.'} }';

		# WooCommerce
		if( function_exists( 'is_woocommerce' ) ){

			$css .= 'ul.products li.product:hover .woo-type8 .product-details h5:after { border-color: rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) '.$secondary_color.' rgba(0, 0, 0, 0); }';

			$css .= 'ul.products li.product .woo-type20 .product-thumb a.add_to_cart_button:hover, ul.products li.product .woo-type20 .product-thumb a.button.product_type_simple:hover, ul.products li.product .woo-type20 .product-thumb a.button.product_type_variable:hover, ul.products li.product .woo-type20 .product-thumb a.added_to_cart.wc-forward:hover, ul.products li.product .woo-type20 .product-thumb a.add_to_wishlist:hover, ul.products li.product .woo-type20 .product-thumb .yith-wcwl-wishlistaddedbrowse a:hover, ul.products li.product .woo-type20 .product-thumb .yith-wcwl-wishlistexistsbrowse a:hover, ul.products li.product:hover .woo-type20 .product-wrapper, .woocommerce ul.products li.product .woo-type20 .product-buttons-wrapper a.yith-wcqv-button:hover, .woocommerce ul.products li.product .woo-type20 .product-buttons-wrapper a.yith-woocompare-button:hover { background-color: rgba('.$rgba.',0.5 )}';
			
			$css .= '.woocommerce ul.products li.product:hover .woo-type20 .product-buttons-wrapper { background-color: rgba('.$rgba.', 0.3); }';
		}	
	}

	if( !empty( $tertiary_color ) ) {

		$rgba = trendytravel_hex2rgb( $tertiary_color );
		$rgba = implode(',', $rgba);

		$css .= '.dt-sc-faculty .dt-sc-faculty-thumb-overlay { background: rgba('.$rgba.',0.9) }';
		
		$css .= '.dt-sc-icon-box.type3.light-border:hover .icon-wrapper span { box-shadow: 0 0 0 8px rgba('.$rgba.',0.3) }';
		
		$css .= '.dt-sc-icon-box.type10 .icon-wrapper:before { box-shadow: 5px 0 0 0 rgba('.$rgba.',1) }';
		
		$css .= '.custom-timeline.dt-sc-timeline-section.type4 .dt-sc-timeline .dt-sc-timeline-content:before { box-shadow: 0 0 0 4px rgba('.$rgba.',1) }';

		# WooCommerce
		if( function_exists( 'is_woocommerce' ) ){

			$css .= 'ul.products li.product:hover .woo-type1 .product-thumb:after { 
				-webkit-box-shadow: 0 0 0 10px rgba('. $rgba.',0.35) inset;
				-moz-box-shadow: 0 0 0 10px rgba('. $rgba.',0.35) inset;
				-ms-box-shadow: 0 0 0 10px rgba('. $rgba.',0.35) inset;
				-o-box-shadow: 0 0 0 10px rgba('. $rgba.',0.35) inset;
				box-shadow: 0 0 0 10px rgba('. $rgba.',0.35) inset;
			}';

			$css .= 'ul.products li.product .woo-type20 .product-wrapper {
				-webkit-box-shadow: 0 0 0 5px rgba('. $rgba.',0.75) inset;
				-moz-box-shadow: 0 0 0 5px rgba('. $rgba.',0.75) inset;
				-ms-box-shadow: 0 0 0 5px rgba('. $rgba.',0.75) inset;
				-o-box-shadow: 0 0 0 5px rgba('. $rgba.',0.75) inset;
				box-shadow: 0 0 0 5px rgba('. $rgba.',0.75) inset;					
			}';
		}
	}
	
	if( !empty( $quinary_color ) ) {

		$rgba = trendytravel_hex2rgb( $quinary_color );
		$rgba = implode(',', $rgba);

		$css .= '.portfolio .image-overlay { background: rgba('.$rgba.',0.9) }';
		
	}
	
	if( !empty($primary_color) && !empty($secondary_color) && !empty($tertiary_color) ) {

		$css .= '@-webkit-keyframes color-change { 0% { color:'.$primary_color.'; } 50% { color:'.$secondary_color.'; }  100% { color:'.$tertiary_color.'; } }';
		$css .= '@-moz-keyframes color-change { 0% { color:'.$primary_color.'; } 50% { color:'.$secondary_color.'; } 100% { color:'.$tertiary_color.'; } }';
		$css .= '@-ms-keyframes color-change { 0% { color:'.$primary_color.'; } 50% { color:'.$secondary_color.'; } 100% { color:'.$tertiary_color.'; }	}';
		$css .= '@-o-keyframes color-change { 0% { color:'.$primary_color.'; } 50% { color:'.$secondary_color.'; } 100% { color:'.$tertiary_color.'; }	}';
		$css .= '@keyframes color-change { 0% { color:'.$primary_color.'; } 50% { color:'.$secondary_color.'; } 100% { color:'.$tertiary_color.'; }	}';
	}

	wp_add_inline_style( 'trendytravel-custom', $css );
	

	$fonts = cs_get_option('custom_font_fields');
	if(isset($fonts)){
		if( count( $fonts ) > 0 ){
			wp_add_inline_style('trendytravel-custom', trendytravel_styles_custom_font() );
		}
	}
}

add_action( 'wp_enqueue_scripts', 'trendytravel_enqueue_custom_inline', 999 );
if ( ! function_exists( 'trendytravel_enqueue_custom_inline' ) ) {
	function trendytravel_enqueue_custom_inline() {
		wp_register_style( 'trendytravel-custom-inline', '', array(), TRENDYTRAVEL_THEME_VERSION, 'all' );
	}
}

function trendytravel_load_fonts_url() {
    
		$font_url = '';

		// Default fonts used by theme
		$font_families = array('Open Sans Condensed:300,300i,700');   

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
		);
		
		$font_url = add_query_arg( $query_args, 'http'. trendytravel_ssl() .'://fonts.googleapis.com/css' );
		
		return $font_url;
	}

/* ---------------------------------------------------------------------------
 * Styles of Custom Font
 * --------------------------------------------------------------------------- */
function trendytravel_styles_custom_font() {
	$out = '';

	$fonts = cs_get_option('custom_font_fields');
		if(is_array($fonts)) {
			if( count( $fonts ) > 0 ){
				foreach( $fonts as $font ):
					$out .= '@font-face {';
						$out .= 'font-family: "'. $font['custom_font_name'] .'";';
						$out .= 'src: url("'. $font['custom_font_woof'] .'") format("woff"),';
							$out .= 'url("'. $font['custom_font_woof2'] .'") format("woff2");';
						$out .= 'font-weight: normal;';
						$out .= 'font-style: normal;';
					$out .= '}';
				endforeach;
			}
		}

	return $out;
}

/* ---------------------------------------------------------------------------
 * Site SSL Compatibility
 * --------------------------------------------------------------------------- */
function trendytravel_ssl( $echo = false ){
	$ssl = '';
	if( is_ssl() ) $ssl = 's';
	if( $echo ){
		echo "{$ssl}";
	}
	return $ssl;
}

/* ---------------------------------------------------------------------------
 * Body Class Filter for layout changes
 * --------------------------------------------------------------------------- */
function trendytravel_body_classes( $classes ) {
	
	// layout
	$classes[] 		= 	'layout-'. get_theme_mod( 'site-layout', trendytravel_defaults('site-layout') );
	
	if( is_page() ) {
		global $post;
		$page_meta = get_post_meta( $post->ID, '_tpl_default_settings', true );
		$page_meta = is_array( $page_meta ) ? $page_meta : array();

		if( array_key_exists( 'show_slider', $page_meta ) && $page_meta['show_slider'] ) {
			$classes[] = "page-with-slider";
		}
		if( array_key_exists( 'enable-sub-title', $page_meta ) && !($page_meta['enable-sub-title']) ) {
			$classes[] = "no-breadcrumb";
		}
	} elseif( is_singular('post') ) {
		global $post;
		$post_meta = get_post_meta( $post->ID, '_dt_post_settings', true );
		$post_meta = is_array( $post_meta ) ? $post_meta : array();

		if( array_key_exists( 'enable-sub-title', $post_meta ) && !($post_meta['enable-sub-title']) ) {
			$classes[] = "no-breadcrumb";
		}
	} elseif( is_home() ) {
		$pageid = get_option('page_for_posts');
		$page_meta = get_post_meta( $pageid, '_tpl_default_settings', true );
		$page_meta = is_array( $page_meta ) ? $page_meta : array();

		if( array_key_exists( 'show_slider', $page_meta ) && $page_meta['show_slider'] ) {
			$classes[] = "page-with-slider";
		}
	} else {
		$show_breadcrump = cs_get_option('show-breadcrumb');
		if( is_null( $show_breadcrump ) ) {
			$classes[] = "no-breadcrumb";
		}
	}
	
	# Gutenberg Class
	if ( is_singular() && function_exists('has_blocks') && has_blocks() ) {
		
		$classes[] = 'has-gutenberg-blocks';
	}

	# Browsers
	global $is_macIE, $is_winIE, $is_IE, $is_gecko;

	if( $is_gecko )
		$classes[] = 'browser-firefox';

	if( $is_macIE || $is_winIE || $is_IE )
		$classes[] = 'browser-ie';

	return $classes;
}
add_filter( 'body_class', 'trendytravel_body_classes' ); ?>