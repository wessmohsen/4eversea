<?php ob_start();
/** create_admin_menu()
  * Objective:
  *		Hook to create thme option page at back end.
**/
function create_admin_menu() {

	$role = get_role('administrator');
	if(!$role->has_cap('manage_theme')) $role->add_cap('manage_theme');

	#Hotel Booking Menu Starts...
	if(function_exists('add_submenu_page') && cs_get_option('disable-hotel-booking') != 1) {
		add_submenu_page( 'edit.php?post_type=dt_hotels', esc_html__('Rooms', 'trendytravel'), esc_html__('Rooms', 'trendytravel'), 'edit_posts', 'edit.php?post_type=dt_rooms', '');
		add_submenu_page( 'edit.php?post_type=dt_hotels', esc_html__('General Settings', 'trendytravel'), esc_html__('General Settings', 'trendytravel'), 'manage_options', 'generalsettings', 'dt_theme_hb_general_page');
		add_submenu_page( 'edit.php?post_type=dt_hotels', esc_html__('Rooms Availability', 'trendytravel'), esc_html__('Rooms Availability', 'trendytravel'), 'manage_options', 'availablesettings', 'dt_theme_hb_available_page');
		add_submenu_page( 'edit.php?post_type=dt_hotels', esc_html__('Additional Services', 'trendytravel'), esc_html__('Additional Services', 'trendytravel'), 'manage_options', 'servicesettings', 'dt_theme_hb_service_page');
		add_submenu_page( 'edit.php?post_type=dt_hotels', esc_html__('Order Details', 'trendytravel'), esc_html__('Order Details', 'trendytravel'), 'manage_options', 'ordersettings', 'dt_theme_hb_order_page');
	}
	#Hotel Booking Menu Ends...
}
### --- ****  create_admin_menu() *** --- ###
add_action('admin_menu', 'create_admin_menu');
$template_uri = get_template_directory().'/framework';

#Hotel Booking File Starts...
require_once($template_uri.'/hotelbooking/generalsettings.php');
require_once($template_uri.'/hotelbooking/availablesettings.php');
require_once($template_uri.'/hotelbooking/servicesettings.php');
require_once($template_uri.'/hotelbooking/ordersettings.php');

require_once($template_uri.'/hotelbooking/admin/core-functions.php');
require_once($template_uri.'/hotelbooking/frontend-functions.php');
#Hotel Booking File Ends...
#ob_flush();?>