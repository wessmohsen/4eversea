<?php
/**
 * Hotels Booking Core Functions.
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Get full list of currency codes.
 * @return array
 */
if(!function_exists('get_dt_theme_hb_currencies')) {
	function get_dt_theme_hb_currencies() {
		return array_unique(
			apply_filters( 'dt_theme_hb_currencies',
				array(
					'AED' => esc_html__( 'United Arab Emirates Dirham', 'trendytravel' ),
					'AUD' => esc_html__( 'Australian Dollars', 'trendytravel' ),
					'BDT' => esc_html__( 'Bangladeshi Taka', 'trendytravel' ),
					'BRL' => esc_html__( 'Brazilian Real', 'trendytravel' ),
					'BGN' => esc_html__( 'Bulgarian Lev', 'trendytravel' ),
					'CAD' => esc_html__( 'Canadian Dollars', 'trendytravel' ),
					'CLP' => esc_html__( 'Chilean Peso', 'trendytravel' ),
					'CNY' => esc_html__( 'Chinese Yuan', 'trendytravel' ),
					'COP' => esc_html__( 'Colombian Peso', 'trendytravel' ),
					'CZK' => esc_html__( 'Czech Koruna', 'trendytravel' ),
					'DKK' => esc_html__( 'Danish Krone', 'trendytravel' ),
					'EUR' => esc_html__( 'Euros', 'trendytravel' ),
					'HKD' => esc_html__( 'Hong Kong Dollar', 'trendytravel' ),
					'HRK' => esc_html__( 'Croatia kuna', 'trendytravel' ),
					'HUF' => esc_html__( 'Hungarian Forint', 'trendytravel' ),
					'ISK' => esc_html__( 'Icelandic krona', 'trendytravel' ),
					'IDR' => esc_html__( 'Indonesia Rupiah', 'trendytravel' ),
					'INR' => esc_html__( 'Indian Rupee', 'trendytravel' ),
					'ILS' => esc_html__( 'Israeli Shekel', 'trendytravel' ),
					'JPY' => esc_html__( 'Japanese Yen', 'trendytravel' ),
					'KRW' => esc_html__( 'South Korean Won', 'trendytravel' ),
					'MYR' => esc_html__( 'Malaysian Ringgits', 'trendytravel' ),
					'MXN' => esc_html__( 'Mexican Peso', 'trendytravel' ),
					'NGN' => esc_html__( 'Nigerian Naira', 'trendytravel' ),
					'NOK' => esc_html__( 'Norwegian Krone', 'trendytravel' ),
					'NZD' => esc_html__( 'New Zealand Dollar', 'trendytravel' ),
					'PHP' => esc_html__( 'Philippine Pesos', 'trendytravel' ),
					'PLN' => esc_html__( 'Polish Zloty', 'trendytravel' ),
					'GBP' => esc_html__( 'Pounds Sterling', 'trendytravel' ),
					'RON' => esc_html__( 'Romanian Leu', 'trendytravel' ),
					'RUB' => esc_html__( 'Russian Ruble', 'trendytravel' ),
					'SGD' => esc_html__( 'Singapore Dollar', 'trendytravel' ),
					'ZAR' => esc_html__( 'South African rand', 'trendytravel' ),
					'SEK' => esc_html__( 'Swedish Krona', 'trendytravel' ),
					'CHF' => esc_html__( 'Swiss Franc', 'trendytravel' ),
					'TWD' => esc_html__( 'Taiwan New Dollars', 'trendytravel' ),
					'THB' => esc_html__( 'Thai Baht', 'trendytravel' ),
					'TRY' => esc_html__( 'Turkish Lira', 'trendytravel' ),
					'USD' => esc_html__( 'US Dollars', 'trendytravel' ),
					'VND' => esc_html__( 'Vietnamese Dong', 'trendytravel' ),
				)
			)
		);
	}
}

/**
 * Get Currency symbol.
 * @param string $currency (default: '')
 * @return string
 */
if(!function_exists('get_dt_theme_hb_currency_symbol')) {
	function get_dt_theme_hb_currency_symbol( $currency = '' ) {
		if ( ! $currency ) {
			$currency = get_option('dt_theme_hb_currency');
		}
	
		switch ( $currency ) {
			case 'AED' :
				$currency_symbol = 'د.إ';
				break;
			case 'BDT':
				$currency_symbol = '&#2547;&nbsp;';
				break;
			case 'BRL' :
				$currency_symbol = '&#82;&#36;';
				break;
			case 'BGN' :
				$currency_symbol = '&#1083;&#1074;.';
				break;
			case 'AUD' :
			case 'CAD' :
			case 'CLP' :
			case 'MXN' :
			case 'NZD' :
			case 'HKD' :
			case 'SGD' :
			case 'USD' :
				$currency_symbol = '&#36;';
				break;
			case 'EUR' :
				$currency_symbol = '&euro;';
				break;
			case 'CNY' :
			case 'RMB' :
			case 'JPY' :
				$currency_symbol = '&yen;';
				break;
			case 'RUB' :
				$currency_symbol = '&#1088;&#1091;&#1073;.';
				break;
			case 'KRW' : $currency_symbol = '&#8361;'; break;
			case 'TRY' : $currency_symbol = '&#84;&#76;'; break;
			case 'NOK' : $currency_symbol = '&#107;&#114;'; break;
			case 'ZAR' : $currency_symbol = '&#82;'; break;
			case 'CZK' : $currency_symbol = '&#75;&#269;'; break;
			case 'MYR' : $currency_symbol = '&#82;&#77;'; break;
			case 'DKK' : $currency_symbol = 'kr.'; break;
			case 'HUF' : $currency_symbol = '&#70;&#116;'; break;
			case 'IDR' : $currency_symbol = 'Rp'; break;
			case 'INR' : $currency_symbol = 'Rs.'; break;
			case 'ISK' : $currency_symbol = 'Kr.'; break;
			case 'ILS' : $currency_symbol = '&#8362;'; break;
			case 'PHP' : $currency_symbol = '&#8369;'; break;
			case 'PLN' : $currency_symbol = '&#122;&#322;'; break;
			case 'SEK' : $currency_symbol = '&#107;&#114;'; break;
			case 'CHF' : $currency_symbol = '&#67;&#72;&#70;'; break;
			case 'TWD' : $currency_symbol = '&#78;&#84;&#36;'; break;
			case 'THB' : $currency_symbol = '&#3647;'; break;
			case 'GBP' : $currency_symbol = '&pound;'; break;
			case 'RON' : $currency_symbol = 'lei'; break;
			case 'VND' : $currency_symbol = '&#8363;'; break;
			case 'NGN' : $currency_symbol = '&#8358;'; break;
			case 'HRK' : $currency_symbol = 'Kn'; break;
			default    : $currency_symbol = ''; break;
		}
	
		return $currency_symbol;
	}
}

/**
 * Get Available Rooms.
 * @param string hotel_id
 * @return string
 */
add_action("wp_ajax_dt_theme_hbroom_available_lists", "dt_theme_hbroom_available_lists");
if(!function_exists('dt_theme_hbroom_available_lists')) {
	function dt_theme_hbroom_available_lists() {


			$hotelid = $_REQUEST['hotel_id'];
			
			if($hotelid != NULL) {
				$out = '';
				$hotel_settings = get_post_meta ( $hotelid, '_hotel_settings', TRUE );
				if(array_key_exists("room-types",$hotel_settings)):
					$out .= '<option value="">'.esc_html__('Choose Room Type', 'trendytravel').'</option>';
					
					$room_list = array_filter(array_unique($hotel_settings["room-types"]));
					foreach($room_list as $room):
						$out .= '<option value="'.$room.'">'.get_the_title($room).'</option>';
					endforeach;
				endif;
				
				echo do_shortcode($out);
			}

		wp_die();

	}
}

/**
 * Get Unavailable Dates.
 * @param string hotel_id, room_id
 * @return string
 */
add_action("wp_ajax_dt_theme_hbroom_unavailable_dates", "dt_theme_hbroom_unavailable_dates");
if(!function_exists('dt_theme_hbroom_unavailable_dates')) {
	function dt_theme_hbroom_unavailable_dates() {


			$hotelid = $_REQUEST['hotel_id'];
			$roomid = $_REQUEST['room_id'];
			
			if($roomid != NULL) {
				$availableoptions = get_option('hb_available_settings');
				$udates = $availableoptions[$hotelid][$roomid];
				
				echo do_shortcode($udates);
				
			}

		wp_die();

	}
}

/**
 * Set Unavailable Dates.
 * @param string room_id & sel_dates
 * @return string
 */
add_action("wp_ajax_dt_theme_hbroom_set_unavailable", "dt_theme_hbroom_set_unavailable");
if(!function_exists('dt_theme_hbroom_set_unavailable')) {
	function dt_theme_hbroom_set_unavailable() {

			$hotelid = $_REQUEST['hotel_id'];
			$roomid = $_REQUEST['room_id'];
			$sdates = $_REQUEST['sdates'];
			
			if($roomid != NULL && $sdates != NULL) {
				$availableoptions = get_option('hb_available_settings');
				$udates = $availableoptions[$hotelid][$roomid];
				$udates = $udates.','.$sdates;
				$udates = explode(',', $udates);
				$udates = array_filter($udates);
				$udates = implode(',', $udates);
				$availableoptions[$hotelid][$roomid] = $udates;
				update_option('hb_available_settings', $availableoptions);
				
				echo do_shortcode($udates);

			}

		wp_die();

	}
}

/**
 * Clear Unavailable Dates.
 * @param string room_id
 * @return string
 */
add_action("wp_ajax_dt_theme_hbroom_clear_unavailable", "dt_theme_hbroom_clear_unavailable");
if(!function_exists('dt_theme_hbroom_clear_unavailable')) {
	function dt_theme_hbroom_clear_unavailable() {

			$hotelid = $_REQUEST['hotel_id'];
			$roomid = $_REQUEST['room_id'];
			
			if($roomid != NULL) {
				$alldates = get_option('hb_available_settings');
				unset($alldates[$hotelid][$roomid]);
				update_option('hb_available_settings', $alldates);
			}


		wp_die();

	}
}