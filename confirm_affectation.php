<?php
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
include('includes/connection.php');
include('includes/detailcampagne.php');
$_DCP = new DetailCampagne();

include('includes/campagne.php');
$_CPG = new Campagne();

if ($_REQUEST['cofsend']) {
  $idf = (int)$_REQUEST['idf'];
  $insid = (int)$_REQUEST['cofsend'];


  $dataVol = $_DCP->getExistVolontaire($idf, $insid);
  if ($dataVol) {
    echo "<i class='fa fa-info-circle fa-2x' aria-hidden='true'></i> Le vontontaire N° $insid est déjà affecté à cette campagne </span>";
    exit;
  }

  $dataCpg = $_CPG->getDateFinCpByNumVol($insid);
  if ($dataCpg) {
    echo "<i class='fa fa-info-circle fa-2x' aria-hidden='true'></i> Impossible d'affecter le vontontaire N° $insid  à cette campagne: Ce volontaire est déjà affecté à une autre campagne </span>";
    exit;
  }

  $checkThiscCpg = $_DCP->addDetailCampagne($idf, $insid);
  if ($checkThiscCpg) {

    // TAMMA Aziz
    // Add mail notification 
    echo '<script>window.location="private-space/sendMailNotification.php?code=1"</script>';

    echo "<span class=messageSuccess>Le volontaire N° $insid a été affecté à cette campagne </span>";
    echo '<script>window.location="affectvolontaire.php?idf=' . $idf . '"</script>';
  } else {
    echo '<span class=messageError>Non Ajouter</span>';
  }
}
