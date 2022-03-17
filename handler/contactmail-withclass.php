
<?php 		
header("Content-Type: text/html; charset=utf-8");
require("../emails/PHPMailerAutoload.php");

$successMsg = "<center><img src='images/successMessage.png' width='110px' height='110px'/><br><h4> MESSAGE DÉLIVRÉ ! </h4> <br> VOTRE MESSAGE A ÉTÉ ENVOYÉ AVEC SUCCÈS </center>";
$errorMsg   = "<center><img src='images/errorMessage.png' width='110px' height='110px'/><br><h4> MESSAGE NOT DELIVERED ! </h4> <br>Impossible d'envoyer votre email pour des raisons techniques .. <br> Contactez-nous par téléphone, merci de votre compréhension </center>";

$meprenom = $_POST['meprenom'];
$menom = $_POST['menom'];
$email = $_POST['memail'];
$meobjet = $_POST['meobjet'];
$Message = $_POST['mmessage'];

$mail = new PHPMailer(); 

$mail->IsSMTP();
$mail->Host = "mail.anrt.ma";
$mail->Port = "25";
$mail->IsHTML(true);
$mail->CharSet = "UTF-8";

$mail->SetFrom($email, $meprenom);

$mail->Subject = "Nouveau Message :".date("d-m-Y H:i:s");
$mail->Body ="Prénom: ".$meprenom."<br>"."Nom: ".$menom."<br>". "Email: ".$email."<br>"."Objet: ".$meobjet."<br>"."Message: ".$Message."<br>";

$mail->AddAddress("qosfixe-support@anrt.ma", "ANRT");
// $mail->AddAddress("tammaaziz@gmail.com","Aziz");
// $mail->AddAddress("qosfixe-support@anrt.ma", "ANRT-QoSFixe");

// $mail->AddAddress("dev.apsolution@gmail.com");

 if(!$mail->Send()) {
      echo "[Warning] : erreur envoi message" ;
      echo $errorMsg;
 } else {
      echo "[Info] : message envoye avec succes";
      echo $successMsg;
 }
?>