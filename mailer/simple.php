<?php

// error_reporting(E_ALL);
// ini_set("display_errors", 1);


include('../mailer/smtp/PHPMailerAutoload.php');
echo smtp_mailer('tammaaziz@gmail.com','test subject','salam my message');
function smtp_mailer($to,$subject, $msg){

	$mail = new PHPMailer(); 


	$mail->IsSMTP();
	$mail->Host = "mail.anrt.ma";
	$mail->Port = "25";
	$mail->IsHTML(true);
	$mail->CharSet = "UTF-8";
	$mail->SetFrom("noreply-qosfixe@anrt.ma", "ANRT");
   
	$mail->Subject = $subject;
	$mail->Body =$msg;
   
	// $mail->AddAddress("qosfixe-support@anrt.ma", "ANRT");
	$mail->AddAddress($to);

	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}else{
		echo 'Sent';
	}
}
?>