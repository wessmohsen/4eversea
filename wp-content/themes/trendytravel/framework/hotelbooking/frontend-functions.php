<?php
//Get all dates between two dates
if(!function_exists('dt_theme_get_all_dates')) {
	function dt_theme_get_all_dates($strDateFrom, $strDateTo) {
		$aryRange=array();
	
		$iDateFrom = mktime( 1, 0, 0, substr( $strDateFrom, 5, 2 ), substr( $strDateFrom, 8, 2 ), substr( $strDateFrom, 0, 4 ) );
		$iDateTo = mktime( 1, 0, 0, substr( $strDateTo, 5, 2 ), substr( $strDateTo, 8, 2 ), substr ( $strDateTo, 0, 4 ) );
	
		if( $iDateTo >= $iDateFrom )
		{
			array_push( $aryRange, date( 'd-m-Y', $iDateFrom ) ); // first entry
			while( $iDateFrom < $iDateTo )
			{
				$iDateFrom += 86400; // add 24 hours
				array_push( $aryRange, date('d-m-Y', $iDateFrom ) );
			}
		}
		return $aryRange;
	}
}

//Getting Currency Symbol
if(!function_exists('dt_theme_currecy_symbol')) {
	function dt_theme_currecy_symbol() {
		$hb_gs = get_option('hb_general_settings');
		$symbol = get_dt_theme_hb_currency_symbol($hb_gs['hb-general-currency']);
		if(!empty($symbol))
			return $symbol;
		else
			return '$';
	}
}

//Getting Net Amount
if(!function_exists('dt_theme_hb_net_amount')) {
	function dt_theme_hb_net_amount($room_id = "") {
		$total_days = count(dt_theme_get_all_dates($_COOKIE['checkin'], $_COOKIE['checkout'])) - 1;
		$room_meta = get_post_meta($room_id, '_room_settings', true);	
		$rcost = $room_meta['room_price'];
		$net_amount = ($total_days * $rcost * $_COOKIE['adults']);
		
		return $net_amount;
	}
}

//Getting Services Amount
if(!function_exists('dt_theme_hb_service_amount')) {
	function dt_theme_hb_service_amount($service_id = array()) {
		$service_amount = 0;
		$service_opts = get_option('hb_service_settings');
	
		if(count($service_id) > 0):
			foreach($service_id as $sid):
				$service_amount += $service_opts[$sid]['hb-service-price'];
			endforeach;
		endif;
	
		return $service_amount;
	}
}

//Getting Services title by ids array
if(!function_exists('dt_theme_hb_service_title')) {
	function dt_theme_hb_service_title($service_id = "") {
		$service_id = explode(',', $service_id);
		$titles = "";
		$currency = dt_theme_currecy_symbol();
		$serviceopts = get_option('hb_service_settings');
		
		foreach($service_id as $sid):
			$titles .= $serviceopts[$sid]['hb-service-name'].' ['.$currency.$serviceopts[$sid]['hb-service-price'].'], ';
		endforeach;
		
		return $titles;
	}
}

//Set Html Content Type
if(!function_exists('dt_theme_set_html_content_type')) {
	function dt_theme_set_html_content_type() {
		return 'text/html';
	}
}

//Get Hotels List
if(!function_exists('dt_theme_roomtype_list')) {
	function dt_theme_roomtype_list($id, $selected = '', $class = "mytheme_select") {
		$name = explode ( ",", $id );
		if (count ( $name ) > 1) {
			$name = "[{$name[0]}][{$name[1]}]";
		} else {
			$name = "[{$name[0]}]";
		}
		$name = ($class == "multidropdown") ? "mytheme{$name}[]" : "mytheme{$name}";
		$output = "<select name='{$name}' class='{$class}'>";
		$output .= "<option value=''>" . __ ( 'Select Room Type', 'trendytravel' ) . "</option>";
		$myhotels = get_posts ( 'posts_per_page=-1&post_type=dt_rooms&order=ASC' );
		
		foreach ( $myhotels as $hotel ) : setup_postdata( $hotel );
			$id = esc_attr ( $hotel->ID );
			$title = esc_html ( $hotel->post_title );
			$output .= "<option value='{$id}' " . selected ( $selected, $id, false ) . ">{$title}</option>";
		endforeach;
		
		wp_reset_postdata();
		$output .= "</select>\n";
		return $output;
	}
}

//Load List of Cities
add_action("wp_ajax_dt_ajax_load_location_terms", "dt_ajax_load_location_terms");
add_action("wp_ajax_nopriv_dt_ajax_load_location_terms", "dt_ajax_load_location_terms");
if(!function_exists('dt_ajax_load_location_terms')) {
	function dt_ajax_load_location_terms() {
		
		$nonce = $_REQUEST['nonce'];
		if(wp_verify_nonce( $nonce, 'booking-nonce' )) {

			$results = get_terms('hotel_locations', 'search='.$_GET['name_startsWith'].'');
		
			$data = array();
			foreach($results as $row) {
				array_push($data, $row->name.'|'.$row->term_id);
			}	
			echo json_encode($data);

		}

		exit();

	}
}

//Caluculate when Additional Services
add_action("wp_ajax_dt_theme_checkout_calculation", "dt_theme_checkout_calculation");
add_action("wp_ajax_nopriv_dt_theme_checkout_calculation", "dt_theme_checkout_calculation");
if(!function_exists('dt_theme_checkout_calculation')) {
	function dt_theme_checkout_calculation() {

		$nonce = $_REQUEST['nonce'];
		if(wp_verify_nonce( $nonce, 'booking-nonce' )) {

			$netAmount = dt_theme_hb_net_amount($_REQUEST['room_id']); $disAmount = '';
		
			if(isset($_REQUEST['chkservice'])):
				$netAmount += dt_theme_hb_service_amount($_REQUEST['chkservice']);
			endif;
			
			$hb_general_settings = get_option('hb_general_settings');
			if($hb_general_settings['hb-general-enabledepositdue'] && $hb_general_settings['hb-general-depositpercent'] != ""):
				$disAmount = $netAmount * ($hb_general_settings['hb-general-depositpercent'] / 100);
			endif;
			
			$data = array();
			array_push($data, round($netAmount, 2).'|'.round($disAmount, 2));
			echo json_encode($data);

		}

		exit();

	}
}