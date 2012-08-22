<?php
// This script allows a document to be requested via e-mail as an attachment.
// Author: Sean McGee
// Date: 8.16.12

if(!$_POST) {
	header("Location: test.php");
	die();	
}

// SET THE EMAIL ADDRESS YOU WANT THE EMAIL TO COME FROM HERE
$from = "sean@webdude.us";
$from_name = "Sean McGee";

$name = $_POST['name'];
$email = $_POST['email'];
$organization = $_POST['organization'];
$country = $_POST['country'];
$filename = $_POST['filename'];

require("phpmailer/class.phpmailer.php");
$mail = new PHPMailer();
$mail->IsMail();

$mail->AddAddress($email);
$mail->AddReplyTo($from, $from_name);
$mail->SetFrom($from, $from_name);
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