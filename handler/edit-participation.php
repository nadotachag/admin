<?php
// Turn off error reporting
// error_reporting(0);

$tmp_file1 = $_FILES['image1']['tmp_name'];
$filename1 = $_FILES['image1']['name'];

$tmp_file2 = $_FILES['image2']['tmp_name'];
$filename2 = $_FILES['image2']['name'];

$tmp_file3 = $_FILES['image3']['tmp_name'];
$filename3 = $_FILES['image3']['name'];

$tmp_file4 = $_FILES['image4']['tmp_name'];
$filename4 = $_FILES['image4']['name'];



$tmp_file22 = $_FILES['image22']['tmp_name'];
$filename22 = $_FILES['image22']['name'];

$tmp_file33 = $_FILES['image33']['tmp_name'];
$filename33 = $_FILES['image33']['name'];

$tmp_file44 = $_FILES['image44']['tmp_name'];
$filename44 = $_FILES['image44']['name'];


$idf = (int)$_POST['idf'];



include('../includes/connection.php');
include('../includes/participation.php');
$_PAR = new Participation();
$dataPar = $_PAR->getParticipationById($idf);

$probe_already_installed = False ;

$probe_installed = -1;
if (isset($dataPar['numsondeOnePar'])) {
	$probe_installed = 1;
}

if (empty($tmp_file1)) {
	$filename1 = $dataPar['piece_jointe_par'];
} else {
	move_uploaded_file($tmp_file1, '../uploadimages/' . $filename1);
}

if (empty($tmp_file2)) {
	$filename2 = $dataPar['photo_sonde_inst_par'];
} else {
	move_uploaded_file($tmp_file2, '../uploadimages/' . $filename2);
}

if (empty($tmp_file3)) {
	$filename3 = $dataPar['piece_jointe_engagement_par'];
} else {
	move_uploaded_file($tmp_file3, '../uploadimages/' . $filename3);
}

if (empty($tmp_file4)) {
	$filename4 = $dataPar['photo_sonde_recuperation_par'];
} else {
	move_uploaded_file($tmp_file4, '../uploadimages/' . $filename4);
}


if (empty($tmp_file22)) {
	$filename22 = $dataPar['photo_sonde_instTwo_par'];
} else {
	move_uploaded_file($tmp_file22, '../uploadimages/' . $filename22);
}

if (empty($tmp_file33)) {
	$filename33 = $dataPar['piece_jointe_engagementTwo_par'];
} else {
	move_uploaded_file($tmp_file33, '../uploadimages/' . $filename33);
}

if (empty($tmp_file44)) {
	$filename44 = $dataPar['photo_sonde_recuperationTwo_par'];
} else {
	move_uploaded_file($tmp_file44, '../uploadimages/' . $filename44);
}

//}
if (
	isset($_POST['nomPar'])
) {
	$prenomPar = strip_tags($_POST['prenomPar']);
	$nomPar = strip_tags($_POST['nomPar']);
	$telPar = strip_tags($_POST['telPar']);
	$operateurPar = strip_tags($_POST['operateurPar']);
	$villePar = strip_tags($_POST['villePar']);
	$cinPar = strip_tags($_POST['cinPar']);

	$typeaccesPar = strip_tags($_POST['typeaccesPar']);
	$offreservicePar = strip_tags($_POST['offreservicePar']);
	$numlignePar = strip_tags($_POST['numlignePar']);
	$typeclientPar = strip_tags($_POST['typeclientPar']);
	$emailPar = strip_tags($_POST['emailPar']);
	$quartierPar = strip_tags($_POST['quartierPar']);
	$adressePar = strip_tags($_POST['adressePar']);

	$numsondeOnePar = strip_tags($_POST['numsondeParOne']);
	// ! \\ 
	$newProbe = strip_tags($_POST['numsondeParOne']);

	$dateParOne = strip_tags($_POST['dateParOne']);
	$heureParOne = strip_tags($_POST['heureParOne']);
	$etatsondeParOne = strip_tags($_POST['etatsondeParOne']);
	$dateRecParOne = strip_tags($_POST['dateRecParOne']);
	$heureRecParOne = strip_tags($_POST['heureRecParOne']);
	$etatsondeRecParOne = strip_tags($_POST['etatsondeRecParOne']);

	$numsondeTwoPar = strip_tags($_POST['numsondeParTwo']);
	$dateParTwo = strip_tags($_POST['dateParTwo']);
	$heureParTwo = strip_tags($_POST['heureParTwo']);
	$etatsondeParTwo = strip_tags($_POST['etatsondeParTwo']);
	$dateRecParTwo = strip_tags($_POST['dateRecParTwo']);
	$heureRecParTwo = strip_tags($_POST['heureRecParTwo']);
	$etatsondeRecParTwo = strip_tags($_POST['etatsondeRecParTwo']);
	$etatSubmitHotline = 1;

	$checkThis = $_PAR->editParticipationById(
		$idf,
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

		$numsondeOnePar,
		$dateParOne,
		$heureParOne,
		$etatsondeParOne,
		$filename2,
		$dateRecParOne,
		$heureRecParOne,
		$etatsondeRecParOne,
		$filename3,
		$filename4,

		$numsondeTwoPar,
		$dateParTwo,
		$heureParTwo,
		$etatsondeParTwo,
		$filename22,
		$dateRecParTwo,
		$heureRecParTwo,
		$etatsondeRecParTwo,
		$filename33,
		$filename44,
		$cinPar,
		$etatSubmitHotline


	);
	if ($checkThis) {
		if ($probe_installed < 0 && $newProbe > 0 )  {
			// Aziz
			// Add mail notification 
			echo '<script>window.location="private-space/sendMailNotification.php?code=2"</script>';
		}
		echo '<script>window.location="participation_liste_yes.php"</script>';
	} else {
		echo '<script>window.location="participation_liste_yes.php"</script>';
	}
}
