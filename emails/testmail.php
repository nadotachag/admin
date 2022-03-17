<?php
//require("../emails/PHPMailerAutoload.php"); 
require("class.phpmailer.php");


$mail = new PHPMailer();

$mail->IsSMTP();  // telling the class to use SMTP
// $mail->Host     = "smtp.anrt.ma"; // SMTP server
$mail->Host     = "mail.anrt.ma"; // SMTP server

$mail->From     = "noreply-qosfixe@anrt.ma";
// $mail->Username = "adnan@devappsolution.com";
// $mail->Password = "Demo123*";
// $mail->AddAddress("adnan@devappsolution.com");

$mail->Subject  = "First PHPMailer Message";
$mail->Body     = "Hi! nn This is my first e-mail sent through PHPMailer.";
$mail->WordWrap = 50;

if(!$mail->Send()) {
echo "Message was not sent.";
echo "Mailer error: " . $mail->ErrorInfo;
} else {
echo "Message has been sent.";
}
?>