<?php
	
/*****************************************working mail php section**************************************************************** **/


/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Australia/Brisbane');

require 'PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.live.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "animalhousevetclinic@hotmail.com";

//Password to use for SMTP authentication
$mail->Password = "Infs3202";

//Set who the message is to be sent from
$mail->setFrom('animalhousevetclinic@hotmail.com', 'Animal House');

//Set who the message is to be sent to
$current_user_email = $_SESSION['user'];
//send to current users email
$mail->addAddress($current_user_email);

//Set the subject line
$mail->Subject = 'Your Animal House Appointment';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));


$mail->Body = 'Your appointment is on ' .$_POST['date']. ' at ' .$_POST['time']. '. Please contact us if you would like to change or cancel your appointment. <br /><br>
				Sincerely,<br />
				Animal House Vet Clinic<br />
				Address: 153 PARK ROAD, WOOLLOONGABBA QLD 4102 <br />
				Phone: 0733767361<br />
				Email: animalhousevetclinic@hotmail.com';
//Replace the plain text body with one created manually
$mail->AltBody = 'Your appointment is on ' .$_POST['date']. ' at ' .$_POST['time']. '. Please contact us if you would like to change or cancel your appointment.';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}

?>