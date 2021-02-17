<?php
/**
 * Theme Functions
 *
 * @package DTtheme
 * @author DesignThemes
 * @link http://wedesignthemes.com
 */
define( 'TRENDYTRAVEL_THEME_DIR', get_template_directory() );
define( 'TRENDYTRAVEL_THEME_URI', get_template_directory_uri() );
define( 'TRENDYTRAVEL_CORE_PLUGIN', WP_PLUGIN_DIR.'/designthemes-core-features' );

if (function_exists ('wp_get_theme')) :
	$themeData = wp_get_theme();
	define( 'TRENDYTRAVEL_THEME_NAME', $themeData->get('Name'));
	define( 'TRENDYTRAVEL_THEME_VERSION', $themeData->get('Version'));
endif;

/* ---------------------------------------------------------------------------
 * Loads Kirki
 * ---------------------------------------------------------------------------*/
require_once( TRENDYTRAVEL_THEME_DIR .'/kirki/index.php' );

/* ---------------------------------------------------------------------------
 * Loads Codestar
 * ---------------------------------------------------------------------------*/

if( !defined( 'CS_OPTION' ) ) {  define( 'CS_OPTION', '_trendytravel_cs_options' ); }

require_once TRENDYTRAVEL_THEME_DIR .'/cs-framework/cs-framework.php';

if( !defined( 'CS_ACTIVE_TAXONOMY' ) ) { define( 'CS_ACTIVE_TAXONOMY',   false ); }
define( 'CS_ACTIVE_SHORTCODE',  false );
define( 'CS_ACTIVE_CUSTOMIZE',  false );

/* ---------------------------------------------------------------------------
 * Create function to get theme options
 * --------------------------------------------------------------------------- */
function trendytravel_cs_get_option($key, $value = '') {

	$v = cs_get_option( $key );

	if ( !empty( $v ) ) {
		return $v;
	} else {
		return $value;
	}
}

/* ---------------------------------------------------------------------------
 * Loads Theme Textdomain
 * ---------------------------------------------------------------------------*/ 
define( 'TRENDYTRAVEL_LANG_DIR', TRENDYTRAVEL_THEME_DIR. '/languages' );
load_theme_textdomain( 'trendytravel', TRENDYTRAVEL_LANG_DIR );

/* ---------------------------------------------------------------------------
 * Loads the Admin Panel Style
 * ---------------------------------------------------------------------------*/
function trendytravel_admin_scripts() {
	wp_enqueue_style('trendytravel-admin', TRENDYTRAVEL_THEME_URI .'/cs-framework-override/style.css');
	
	#Hotel Booking Script Starts...
	$current_screen = get_current_screen();
	$template_uri = get_template_directory_uri();
	
	if($current_screen->base == 'dt_hotels_page_availablesettings') {
		wp_enqueue_style('hb-flick-theme', $template_uri.'/framework/hotelbooking/css/flick/jquery-ui.min.css');
		wp_enqueue_style('hb-flick-ui-dp', $template_uri.'/framework/hotelbooking/css/ui-flick.datepick.css');

		wp_enqueue_script('jquery-ui');
		wp_enqueue_script('jquery-ui-datepicker');

		wp_enqueue_script('hb-multipicker', $template_uri.'/framework/hotelbooking/js/jquery-ui.multidatespicker.js', array(), false, true);
	}
	if($current_screen->base == 'dt_hotels_page_servicesettings' || $current_screen->base == 'dt_hotels_page_ordersettings') {
		wp_enqueue_style('hb-table-pager', $template_uri.'/framework/hotelbooking/css/themes/blue/style.css');
		wp_enqueue_script('hb-browser-js' , plugin_dir_url ( __FILE__ ).'/framework/hotelbooking/js/jquery.browser.min.js');
		wp_enqueue_script('hb-table-sorter', $template_uri.'/framework/hotelbooking/js/jquery.tablesorter.min.js');
		wp_enqueue_script('hb-table-pager', $template_uri.'/framework/hotelbooking/js/jquery.tablesorter.pager.js');
		wp_enqueue_script('hb-quick-search', $template_uri.'/framework/hotelbooking/js/jquery.quicksearch.js');
	}

	wp_enqueue_style('hb-custom', $template_uri.'/framework/hotelbooking/css/style.css');
	
	wp_enqueue_script('hb-admin-js', $template_uri.'/framework/hotelbooking/js/hotel_scripts.js', array('jquery'));
	wp_localize_script('hb-admin-js', 'dtThemeAjax', array('ajax_url' => esc_url( admin_url( 'admin-ajax.php') )));

		
		#Hotel Booking Script Ends...
}
add_action( 'admin_enqueue_scripts', 'trendytravel_admin_scripts' );

/* ---------------------------------------------------------------------------
 * Loads Theme Functions
 * ---------------------------------------------------------------------------*/

// Functions --------------------------------------------------------------------
require_once( TRENDYTRAVEL_THEME_DIR .'/framework/register-functions.php' );

// Header -----------------------------------------------------------------------
require_once( TRENDYTRAVEL_THEME_DIR .'/framework/register-head.php' );

// Hooks ------------------------------------------------------------------------
require_once( TRENDYTRAVEL_THEME_DIR .'/framework/register-hooks.php' );

// Post Functions ---------------------------------------------------------------
require_once( TRENDYTRAVEL_THEME_DIR .'/framework/register-post-functions.php' );
new trendytravel_post_functions;

// Widgets ----------------------------------------------------------------------
add_action( 'widgets_init', 'trendytravel_widgets_init' );

function trendytravel_widgets_init() {
	require_once( TRENDYTRAVEL_THEME_DIR .'/framework/register-widgets.php' );
}

// Plugins ---------------------------------------------------------------------- 
require_once( TRENDYTRAVEL_THEME_DIR .'/framework/register-plugins.php' );

// WooCommerce ------------------------------------------------------------------
if( function_exists( 'is_woocommerce' ) && ! class_exists ( 'DTWooPlugin' ) ){
	require_once( TRENDYTRAVEL_THEME_DIR .'/framework/register-woocommerce.php' );
}

##Include Room menus options
require_once( TRENDYTRAVEL_THEME_DIR .'/framework/hotelbooking/menu.php' );

// WP Store Locator -------------------------------------------------------------
if( class_exists( 'WP_Store_locator' ) ){
	require_once( TRENDYTRAVEL_THEME_DIR .'/framework/register-storelocator.php' );
}

// Register Gutenberg -----------------------------------------------------------
require_once( TRENDYTRAVEL_THEME_DIR .'/framework/register-gutenberg-editor.php' );