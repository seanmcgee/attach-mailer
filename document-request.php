<?php
// This script allows a document to be requested via e-mail as an attachment.
// Author: Sean McGee
// Date: 8.16.12

/*
if (!$_POST || $_POST['name'] == "" || $_POST['email'] == "") { 
	header('Location: signup-form.php');
	die();
 }
$name = $_POST['name'];
$email = $_POST['email'];
$organization = $_POST['organization'];
$country = $_POST['country'];
*/

if(!$_POST) {
	header("Location: test.php");
	die();	
}


$name = $_POST['name'];
$email = $_POST['email'];
$organization = $_POST['organization'];
$country = $_POST['country'];
$filename = $_POST['filename'];

require("phpmailer/class.phpmailer.php");
$mail = new PHPMailer();
$mail->IsMail();

$mail->AddAddress($email);
//send copy to futurex
$mail->AddAddress("smcgee@futurex.com");
$mail->AddReplyTo("info@futurex.com","Futurex");
$mail->SetFrom('info@futurex.com', 'Futurex');
$mail->Subject = "Document Request by " . $name;
$mail->Body = "Dear " . $name . "\r\n" . "Here is the document you requested. \r\n";
$mail->AddAttachment($filename);
if(!$mail->Send())
{
   echo "Error sending: " . $mail->ErrorInfo;;
}
else
{
   echo "Letter sent";
   echo("<br>" . mime_content_type($filename));
}
?>