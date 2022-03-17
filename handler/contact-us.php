<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<?php
session_start();
include('../mailer/smtp/PHPMailerAutoload.php');
if (isset($_POST['btnSendMail']) && filter_var($_POST['meemail'], FILTER_VALIDATE_EMAIL)) {

    $successMsg = "<center><img src='../images/successMessage.png' width='110px' height='110px'/><br><h4> MESSAGE DÉLIVRÉ ! </h4> <br> VOTRE MESSAGE A ÉTÉ ENVOYÉ AVEC SUCCÈS </center>";
    // $errorMsg   = "<center>
    //                     <img src='../images/errorMessage.png' width='110px' height='110px'/><br>
    //                     <h4> MESSAGE NON LIVRÉ ! </h4> <br>
    //                     Impossible d'envoyer votre email pour des raisons techniques .. <br> 
    //                     Contactez-nous par téléphone, merci de votre compréhension 
    //                 </center>";

    $errorMsg   = '<center><br>
                            <div class="alert alert-danger text-wrap" role="alert" mt-2 style="width: 30rem;">
                                <img src="../images/errorMessage.png" width="110px" height="110px"/><br>
                                <h4> MESSAGE NON LIVRÉ ! </h4><br>
                                Impossible d\'envoyer votre email pour des raisons techniques .. <br> 
                                Contactez-nous par téléphone, merci de votre compréhension 
                                <br><br>
                                <a href="/participation.php" id="contBtn">Retour</a>
                            </div>
                        </center>';
    $errorCaptcha   = '<center><br>
                            <div class="alert alert-danger text-wrap" role="alert" mt-2 style="width: 30rem;">
                                <img src="../images/errorMessage.png" width="110px" height="110px"/><br>
                                <h4> MESSAGE NON LIVRÉ ! </h4><br>
                                Le code Captcha saisi est invalide, merci de réessayer <br><br>
                                <a href="/participation.php" id="contBtn">Retour</a>
                            </div>
                        </center>';

    if (isset($_POST['captcha_contact'])) {
        if ($_POST['captcha_contact'] != $_SESSION['code_contact']) {
            echo $errorCaptcha;
            exit;
        }
    }

    $meprenom = strip_tags($_POST['meprenom']);
    $menom = strip_tags($_POST['menom']);
    $meemail = strip_tags($_POST['meemail']);
    $meobjet = strip_tags($_POST['meobjet']);
    $memessage = strip_tags($_POST['memessage']);
    $fullName = $menom . " " . $meprenom;

    $mail = new PHPMailer();

    $mail->IsSMTP();
    $mail->Host = "mail.anrt.ma";
    $mail->Port = "25";
    $mail->IsHTML(true);
    $mail->CharSet = "UTF-8";
    $mail->SetFrom($meemail, $fullName);

    // test
    // $mail->AddAddress("tammaaziz@gmail.com", "ANRT");
    $mail->AddAddress("qosfixe-support@anrt.ma", "ANRT");

    $mail->Subject = "Contacter Nous - Nouveau Message :" . date("d-m-Y H:i:s");
    $mail->Body = "Prénom: " . $meprenom . "<br>" . "Nom: " . $menom . "<br>" . "Email: " . $meemail . "<br>" . "Objet: " . $meobjet . "<br>" . "Message: " . $memessage . "<br>";

    $mail->SMTPOptions = array("ssl" => array(
        "verify_peer" => false,
        "verify_peer_name" => false,
        "allow_self_signed" => false
    ));

    $resultSend = false ;
    try {
        $resultSend = $mail->Send() ;
    }
    catch (Exception $e) {
        echo $errorMsg;
    }
    finally{
        if ($resultSend) {
            echo ("<script>location.href = '../contact_validate_par.php';</script>");
        }
        else {echo $errorMsg;}
    }
}
?>

</body>
</html>