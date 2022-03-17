<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<style>
	.alert {
		display: inline-block;
	}
</style>


<?php
session_start();
include('../mailer/smtp/PHPMailerAutoload.php');
include('../includes/connection.php');
include('../includes/participation.php');
// error_reporting(E_ALL);
// ini_set("display_errors", 1);

// $errorMsg   = "<center><img src='images/errorMessage.png' width='110px' height='110px'/><br><h4> Message non envoyé ! </h4> <br>Impossible d'envoyer votre email pour des raisons techniques .. <br> Contactez-nous par téléphone, merci de votre compréhension </center>";
$errorMsg   = '
<center>
    
    <br>
    <div class="alert alert-danger text-wrap" role="alert" mt-2 style="width: 30rem;">
    <img src="../images/errorMessage.png" width="110px" height="110px"/><br>
    <h4> Message non envoyé ! </h4><br>
    Impossible d\'envoyer votre email pour des raisons techniques
    Contactez-nous par téléphone, merci de votre compréhension
    <br>
    <br>
    <a href="/participation.php" id="contBtn">Retour</a>
</div>

</center>';
$errorMsgExist   = '
<center>
    
    <br>
    <div class="alert alert-danger text-wrap" role="alert" mt-2 style="width: 30rem;">
    <img src="../images/errorMessage.png" width="110px" height="110px"/><br>
    <h4> Echec ajout participant ! </h4><br>
	Adresse mail existante
    <br>
    <br>
    <a href="/participation.php" id="contBtn">Retour</a>
</div>

</center>';

$errorMsgInvalidMail   = '
<center>
    
    <br>
    <div class="alert alert-danger text-wrap" role="alert" mt-2 style="width: 30rem;">
    <img src="../images/errorMessage.png" width="110px" height="110px"/><br>
    <h4> Echec ajout participant ! </h4><br>
	Adresse mail non valide
    <br>
    <br>
    <a href="/participation.php" id="contBtn">Retour</a>
</div>

</center>';

$errorCaptcha   = '
<center>
    
    <br>
    <div class="alert alert-danger text-wrap" role="alert" mt-2 style="width: 30rem;">
    <img src="../images/errorMessage.png" width="110px" height="110px"/><br>
    <h4> Echec ajout participant ! </h4><br>
	Le code Captcha saisi est invalide, merci de réessayer 
    <br>
    <br>
    <a href="/participation.php" id="contBtn">Retour</a>
</div>

</center>';

$PAR = new Participation();
$count = $PAR->countParticipation();


//init variables for

$prenomPar = '';
$nomPar = '';
$telPar = '';
$operateurPar = '';
$villePar = '';
$typeaccesPar =  '';
$offreservicePar = '';
$numlignePar =  '';
$typeclientPar =  '';
$emailPar ='';
$quartierPar = '';
$adressePar ='';
//	$term1Par = strip_tags($_POST['termeCheck1']);
$term2Par = '';

$tmp_file1 = $_FILES['image1']['tmp_name'];
$filename = $_FILES['image1']['name'];
$filename1 = $count . "_" . $filename;

if (!empty($tmp_file1)) {
	move_uploaded_file($tmp_file1, '../uploadimages/' . $filename1);
} else {
	$filename1 = "noImage.jpg";
}

if(isset($_POST['captcha_inscription'])){
    if($_POST['captcha_inscription']!=$_SESSION['code_inscription']){
		echo $errorCaptcha ;
		// echo "captcha_inscription=" . $_POST['captcha_inscription'] ;
		// echo "code_inscription=" . $_SESSION['code_inscription'] ;
		exit ;
    }
}

if (isset($_POST['nomPar']) && filter_var($_POST['emailPar'], FILTER_VALIDATE_EMAIL)) {
	// echo 'adresse correcte' ;
	$checkMail = true;

	$prenomPar = strip_tags($_POST['prenomPar']);
	$nomPar = strip_tags($_POST['nomPar']);
	$telPar = strip_tags($_POST['telPar']);
	if (isset($_POST['operateurPar'])){
		$operateurPar = strip_tags($_POST['operateurPar']) ;
	}
	if (isset($_POST['villePar'])){
		$villePar = strip_tags($_POST['villePar']) ;
	}
	if (isset($_POST['typeaccesPar'])){
		$typeaccesPar = strip_tags($_POST['typeaccesPar']) ;
	}
	if (isset($_POST['offreservicePar'])){
		$offreservicePar = strip_tags($_POST['offreservicePar']) ;
	}
	if (isset($_POST['numlignePar'])){
		$numlignePar = strip_tags($_POST['numlignePar']) ;
	}
	if (isset($_POST['typeclientPar'])){
		$typeclientPar = strip_tags($_POST['typeclientPar']) ;
	}	
	if (isset($_POST['emailPar']) && filter_var($_POST['emailPar'], FILTER_VALIDATE_EMAIL) ){
		$emailPar = strip_tags($_POST['emailPar']);
	}	
	if (isset($_POST['quartierPar'])){
		$quartierPar = strip_tags($_POST['quartierPar']) ;
	}	
	if (isset($_POST['adressePar'])){
		$adressePar = strip_tags($_POST['adressePar']) ;
	}	
	if (isset($_POST['termeCheck2'])){
		$term2Par = strip_tags($_POST['termeCheck2']);
	}
	$hashPar = md5(rand(0, 1000)) . $count;

	//  Verifier si l'adresse mail choisie par le participant existe deja 
	$VolEmailAdresseExist = $PAR->getParticipationEmail($emailPar);

	if ($VolEmailAdresseExist > 0) {
		// echo "[Info] Adresse mail existante";
		$checkMail = false;
	}

	function getRandom($length)
	{

		$str = 'abcdefghijklmnopqrstuvwzyz';
		$str1 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$str2 = '0123456789';

		$shuffled = str_shuffle($str);
		$shuffled1 = str_shuffle($str1);
		$shuffled2 = str_shuffle($str2);
		$total = $shuffled . $shuffled1 . $shuffled2;
		$shuffled3 = str_shuffle($total);
		$result = substr($shuffled3, 0, $length);

		return $result;
	}

	$codePar = getRandom(8);

	// echo "[Info] Ajout participant";
	if ($checkMail) {
		$checkThis = $PAR->addParticipation(
			$prenomPar,
			$nomPar,
			$telPar,
			$operateurPar,
			$villePar,
			$quartierPar,
			$typeaccesPar,
			$offreservicePar,
			$numlignePar,
			$adressePar,
			$typeclientPar,
			$emailPar,
			$filename1,
			//	$term1Par,
			$term2Par,
			$codePar,
			$hashPar
		);
		if ($checkThis) {
			$mebodyFr = "<h2> Campagne d’évaluation de la qualité technique du service Internet fixe </font></h2> 
						L’ANRT vous remercie pour votre inscription.<br>Veuillez cliquer sur le lien suivant pour activer votre compte <br>";
			$mebodyAr = "الوكالة تشكركم على التسجيل.<br> 
						المرجو النقر على الرابط التالي لتفعيل حسابكم<br>";
			$liensend = "https://qosfixe.anrt.ma/admin/verify.php?email=$emailPar&anrtcd=$codePar&hash=$hashPar";

			$mail = new PHPMailer();

			$mail->IsSMTP();
			$mail->Host = "mail.anrt.ma";
			$mail->Port = "25";
			$mail->IsHTML(true);
			$mail->CharSet = "UTF-8";
			$mail->SetFrom("noreply-qosfixe@anrt.ma", "ANRT");

			// $mail->AddAddress("qosfixe-support@anrt.ma", "ANRT");
			$mail->AddAddress($emailPar, $nomPar);

			$mail->Subject = "Confirmation | Vérification";
			$mail->Body = $mebodyFr . "<br>" . $mebodyAr . "<br>" . $liensend . "<br>";

			$mail->SMTPOptions = array("ssl" => array(
				"verify_peer" => false,
				"verify_peer_name" => false,
				"allow_self_signed" => false
			));

			if (!$mail->Send()) {
				echo $errorMsg;
			} else {
				echo ("<script>location.href = '/private-space/success.php';</script>");
				exit();
			}
		} 
		else {
			echo '<br><br><br><center><span class="alert alert-danger" role="alert" p-1>Un problème est survenu ! svp revenez plus tard </span></center>';
			// ajout redirection vers page d'acceuil
		}
	} 
	else {
		?>
<!-- 
		<script>

			bootbox.alert({
				message: "This alert can be dismissed by clicking on the background!",
				backdrop: true
			});
		</script> -->

		<?php
		// echo "[Erreur] Echec ajout participant, adresse mail existante";
		// echo '<div class="alert alert-primary" role="alert">This is a primary alert—check it out!</div>' ;
		// echo $errorMsgExist;
	}
} else
	echo $errorMsgInvalidMail ;
	// echo "[Erreur] Echec ajout participant";
	// ajout redirection vers page d'acceuil

?>

</body>
</html>