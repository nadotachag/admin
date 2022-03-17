<?php
if (isset($_POST['idf']))
{
	$idf = (int)$_POST['idf'];
	include ('../includes/connection.php');
	include ('../includes/fonctionnaire.php');
	$_FON = new Fonctionnaire();

	// DELETE CATEGORY BY ID
	$checkThis = $_FON->deleteFonctionnaireById($idf);
	if ($checkThis > 0)
		echo 'OK';		
}

?>