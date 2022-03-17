<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

if ($_REQUEST['cofsend']) {
  $idf = (int)$_REQUEST['idf'];
  $insid = (int)$_REQUEST['cofsend'];
  
  	include ('../includes/connection.php');
    include ('../includes/detailcampagne.php');
    $_DCP = new DetailCampagne();

	// DELETE CATEGORY BY ID
	$checkThis = $_DCP->deleteVolCpgById($idf, $insid);
	if ($checkThis > 0)
		echo 'Le volontaire a été supprimé de cette campagne avec succès';		
}

?>