<?php require_once("../../../../wp-load.php"); ?>

<?php
/* -------------------------------------------------------------
 * Use WordPress methods...
 * ------------------------------------------------------------- */

header( 'Content-type: text/css;' );

$nonce = $_REQUEST['booknowwpnonce'];
if(!wp_verify_nonce( $nonce, 'booknow-nonce' )) {
	echo "<div class='dt-sc-error-box'>".esc_html__('Something went wrong!', 'trendytravel')."</div>";
	exit;
}

$url 	= dirname( __FILE__ );
$strpos = strpos( $url, 'wp-content' );
$base 	= substr( $url, 0, $strpos );

require_once( $base .'wp-load.php' );

if(!$_POST) exit;

    $to 	  = sanitize_text_field($_POST['hidbookadminemail']);
	$name	  = sanitize_text_field($_POST['txtfname']);
	$email    = sanitize_text_field($_POST['txtemail']);
	$adate 	  = sanitize_text_field($_POST['txtdate']);
	$hname	  = sanitize_text_field($_POST['hidhotelname']);
	$phone    = sanitize_text_field($_POST['txtphone']);
    $comment  = sanitize_text_field($_POST['txtmessage']);
        
	if(get_magic_quotes_gpc()) { $comment = stripslashes($comment); }

	 $e_subject = 'You\'ve been contacted by ' . $name . '.';

	 $msg  = "You have been contacted by $name with regards to booking request.\r\n\n";
	 $msg .= "Hotel Name: $hname\r\n\n";
	 $msg .= "Date of arrival: $adate\r\n\n";
	 $msg .= "Phone no: $phone\r\n\n";
	 $msg .= "$comment\r\n\n";
	 $msg .= "You can contact $name via email, $email.\r\n\n";
	 $msg .= "-------------------------------------------------------------------------------------------\r\n";
	 $headers = "From: $name <$email>";
	 $headers .= "Content-type: text/html\r\n"; 

	 if( call_user_func( 'mail', $to, $e_subject, $msg, $headers ) ) {
		 echo "<div class='dt-sc-success-box'>".$_POST['hidbooksuccess']."</div>";
	 }
	 else {
		 echo "<div class='dt-sc-error-box'>".$_POST['hidbookerror']."</div>";
	 }

?>