<?php

//Admin Notify Section
if(!function_exists('dt_theme_admin_notify')) {
	function dt_theme_admin_notify($token, $fname, $lname, $email, $amount, $hotelid, $roomid, $checkin, $checkout, $adults, $childs, $percent, $netamount) {
		
		$tomail = get_bloginfo('admin_email');
		$currency = dt_theme_currecy_symbol();
		
		$out = '';
		$out .= '<p>New Reservation submitted, The details of reservation can be found below:</p>';
		
		$out .= '<table width="400" border="0" cellspacing="1" cellpadding="5" bgcolor="#666666">';
			$out .= '<tr>';
				$out .= '<th width="40%" scope="row" bgcolor="#CCCCCC">Order Number</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$token.'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#CCCCCC">First Name</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$fname.'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#CCCCCC">Last Name</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$lname.'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#CCCCCC">Email Address</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$email.'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#CCCCCC">Paid Amount</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$currency.' '.$amount.'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#CCCCCC">Hotel</th>';
				$out .= '<td bgcolor="#FFFFFF">'.get_the_title($hotelid).'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#CCCCCC">Room</th>';
				$out .= '<td bgcolor="#FFFFFF">'.get_the_title($roomid).'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#CCCCCC">Booked Dates</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$checkin.' to '.$checkout.'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#CCCCCC">No.of Persons</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$adults.' Adults, '.$childs.' Childs</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#CCCCCC">Deposit (%)</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$percent.'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#CCCCCC">Net Amount</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$currency.' '.$netamount.'</td>';
			$out .= '</tr>';
		$out .= '</table>';
		
		add_filter( 'wp_mail_content_type', 'dt_theme_set_html_content_type');
		wp_mail( $tomail, 'New Customer Order Submitted', $out, 'From: '.$email );
		remove_filter( 'wp_mail_content_type', 'dt_theme_set_html_content_type' );
	}
}

//User Notify Section
if(!function_exists('dt_theme_user_notify')) {
	function dt_theme_user_notify($token, $fname, $email, $amount, $hotelid, $roomid, $sids, $checkin, $checkout, $adults, $childs, $percent, $netamount) {
	
		$frommail = get_bloginfo('admin_email');
		$currency = dt_theme_currecy_symbol();
		
		$out = '';
		$out .= 'Hi '.$fname.',<br>';
		$out .= '<p>Your Reservation confirmed, thanks! Details of your reservation can be found below:</p>';
		
		$out .= '<table width="400" border="0" cellspacing="1" cellpadding="5" bgcolor="#008282">';
			$out .= '<tr>';
				$out .= '<th width="40%" scope="row" bgcolor="#00D5D5">Order Number</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$token.'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#00D5D5">Email Address</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$email.'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#00D5D5">Paid Amount</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$currency.' '.$amount.'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#00D5D5">Hotel</th>';
				$out .= '<td bgcolor="#FFFFFF">'.get_the_title($hotelid).'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#00D5D5">Room</th>';
				$out .= '<td bgcolor="#FFFFFF">'.get_the_title($roomid).'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#00D5D5">Additional Services</th>';
				$out .= '<td bgcolor="#FFFFFF">'.dt_theme_hb_service_title($sids).'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#00D5D5">Booked Dates</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$checkin.' to '.$checkout.'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#00D5D5">No.of Persons</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$adults.' Adults, '.$childs.' Childs</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#00D5D5">Deposit (%)</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$percent.'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#00D5D5">Net Amount</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$currency.' '.$netamount.'</td>';
			$out .= '</tr>';
		$out .= '</table>';
	
		add_filter( 'wp_mail_content_type', 'dt_theme_set_html_content_type');
		wp_mail( $email, 'Hotel Reservation Confirmed', $out, 'From: '.$frommail );
		remove_filter( 'wp_mail_content_type', 'dt_theme_set_html_content_type' );
	}
}

//Admin Notify Section for PayArrival
if(!function_exists('dt_theme_admin_payarrival_notify')) {
	function dt_theme_admin_payarrival_notify($fname, $lname, $email, $phone, $add1, $add2, $city, $state, $zip, $country, $special, $hotelid, $roomid, $checkin, $checkout, $adults, $childs, $netamount) {
		
		$tomail = get_bloginfo('admin_email');
		$currency = dt_theme_currecy_symbol();
		
		$out = '';
		$out .= '<p>New Email User Reservation submitted, The details of reservation can be found below:</p>';
		
		$out .= '<table width="400" border="0" cellspacing="1" cellpadding="5" bgcolor="#043d50">';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#a0dffa">First Name</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$fname.'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#a0dffa">Last Name</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$lname.'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#a0dffa">Email Address</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$email.'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#a0dffa">Phone</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$phone.'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#a0dffa">Address Line 1</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$add1.'<br>'.$city.'<br>'.$state.'<br>'.$country.' - '.$zip.'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#a0dffa">Address Line 2</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$add2.'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#a0dffa">Special Request</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$special.'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#a0dffa">Hotel</th>';
				$out .= '<td bgcolor="#FFFFFF">'.get_the_title($hotelid).'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#a0dffa">Room</th>';
				$out .= '<td bgcolor="#FFFFFF">'.get_the_title($roomid).'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#a0dffa">Booked Dates</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$checkin.' to '.$checkout.'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#a0dffa">No.of Persons</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$adults.' Adults, '.$childs.' Childs</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#a0dffa">Net Amount</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$currency.' '.$netamount.'</td>';
			$out .= '</tr>';
		$out .= '</table>';
		
		add_filter( 'wp_mail_content_type', 'dt_theme_set_html_content_type');
		wp_mail( $tomail, 'New Email Reservation Submitted', $out, 'From: '.$email );
		remove_filter( 'wp_mail_content_type', 'dt_theme_set_html_content_type' );
	}
}

//User Notify Section for PayArrival
if(!function_exists('dt_theme_user_payarrival_notify')) {
	function dt_theme_user_payarrival_notify($fname, $lname, $email, $phone, $add1, $add2, $city, $state, $zip, $country, $special, $hotelid, $roomid, $sids, $checkin, $checkout, $adults, $childs, $netamount) {
	
		$frommail = get_bloginfo('admin_email');
		$currency = dt_theme_currecy_symbol();
		
		$out = '';
		$out .= 'Hi '.$fname.' '.$lname.',<br>';
		$out .= '<p>Your Reservation registered, thanks! Details of your reservation can be found below:</p>';
		
		$out .= '<table width="400" border="0" cellspacing="1" cellpadding="5" bgcolor="#71540d">';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#f4e0b0">Email Address</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$email.'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#f4e0b0">Phone</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$phone.'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#f4e0b0">Address Line 1</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$add1.'<br>'.$city.'<br>'.$state.'<br>'.$country.' - '.$zip.'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#f4e0b0">Address Line 2</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$add2.'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#f4e0b0">Special Request</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$special.'</td>';
			$out .= '</tr>';		
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#f4e0b0">Hotel</th>';
				$out .= '<td bgcolor="#FFFFFF">'.get_the_title($hotelid).'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#f4e0b0">Room</th>';
				$out .= '<td bgcolor="#FFFFFF">'.get_the_title($roomid).'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#f4e0b0">Additional Services</th>';
				$out .= '<td bgcolor="#FFFFFF">'.dt_theme_hb_service_title($sids).'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#f4e0b0">Booked Dates</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$checkin.' to '.$checkout.'</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#f4e0b0">No.of Persons</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$adults.' Adults, '.$childs.' Childs</td>';
			$out .= '</tr>';
			$out .= '<tr>';
				$out .= '<th scope="row" bgcolor="#f4e0b0">Net Amount</th>';
				$out .= '<td bgcolor="#FFFFFF">'.$currency.' '.$netamount.'</td>';
			$out .= '</tr>';
		$out .= '</table>';
	
		add_filter( 'wp_mail_content_type', 'dt_theme_set_html_content_type');
		wp_mail( $email, 'Hotel Reservation Registered', $out, 'From: '.$frommail );
		remove_filter( 'wp_mail_content_type', 'dt_theme_set_html_content_type' );
	}
}
?>