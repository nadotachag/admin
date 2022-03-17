<?php
if (isset($_POST['idf']))
{
	$idf = (int)$_POST['idf'];
	include ('../includes/connection.php');
	include ('../includes/participation.php');
	$_PAR = new Participation();

	// DELETE CATEGORY BY ID
	$checkThis = $_PAR->deleteParticipationById($idf);
	if ($checkThis > 0)
		echo 'OK';		
}
?>