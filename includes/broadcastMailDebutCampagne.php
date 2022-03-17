<?php
    include ('mailer/smtp/PHPMailerAutoload.php');
    include ('includes/connection.php');
	include ('includes/participation.php');
	include ('includes/detail_capmpagne.php');

    //TAMMA Aziz
    $_PAR= new Participation();
	$_DCP = new DetailCampagne();


    // get the campaign id 
    
    // get all volonteers for the specific campaign 

    // loop throug all the volunteers and send mail one by one 

    $pid = $_REQUEST['resend'];
    $dataPar = $_PAR->getParticipationById($pid);
    $nomPar = $dataPar['nom_par'];
    $emailPar = $dataPar['adresse_email_par'];  
    $codePar =  $dataPar['code_par'];
    $hashPar =  $dataPar['hash_par'];
  
  	$mebodyFr = "<h2>Campagne d’évaluation de la qualité technique du service Internet fixe</font></h2> 
                    Merci pour votre inscription. Votre compte a été créé. <br> Veuillez valider votre adresse email en visitant le lien suivant. <br>";
    $mebodyAr ="نشكركم على التسجيل، لقد تم إحداث حسابكم. يرجى تأكيد بريدكم الإلكتروني من خلال زيارة الرابط التالي: <br>";
    $liensend ="https://qosfixe.anrt.ma/admin/verify.php?email=$emailPar&anrtcd=$codePar&hash=$hashPar";
    
    $mail = new PHPMailer(); 

    $mail->IsSMTP();
    $mail->Host = "mail.anrt.ma";
    $mail->Port = "25";
    $mail->IsHTML(true);
    $mail->CharSet = "UTF-8";
    $mail->SetFrom("noreply-qosfixe@anrt.ma", "ANRT");

    // $mail->AddAddress("qosfixe-support@anrt.ma", "ANRT");
    $mail->AddAddress($emailPar, $nom_prenom);

    $mail->Subject = "Confirmation | Verification";
    $mail->Body =$mebodyFr."<br>".$mebodyAr."<br>".$liensend."<br>";
    
    $mail->SMTPOptions=array("ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
        "allow_self_signed"=>false
    ));
                	
    if(!$mail->Send()) {
        echo $errorMsg;
        } else {
        echo "Message de confirmation d'adresse Email envoyé au destinataire <b>".$emailPar."</b>";
    exit();
        }

?>