<?php
	$tmp_file1 = $_FILES['image1']['tmp_name'];
	$filename1 = $_FILES['image1']['name'];

	$idf = (int)$_POST['idf'];
	
	include ('../includes/connection.php');
	include ('../includes/fonctionnaire.php');
	$_FON = new Fonctionnaire();
	$dataFon = $_FON->getFonctionnaireById($idf);

	if (empty($tmp_file1))
		$filename1 = $dataFon['image_fon'];
	else
		move_uploaded_file($tmp_file1, '../uploadimages/'. $filename1);
	if (
			isset($_POST['nomFon'])
		)
		{
			$nomFon = strip_tags($_POST['nomFon']);
			$prenomFon = strip_tags($_POST['prenomFon']);
			$pseudoFon = strip_tags($_POST['pseudoFon']);
			$passwordFon = strip_tags($_POST['passwordFon']);
			$emailFon = strip_tags($_POST['emailFon']);
			$adresseFon = strip_tags($_POST['adresseFon']);
			$villeFon = strip_tags($_POST['villeFon']);
			$paysFon = strip_tags($_POST['paysFon']);
			$telephoneFon = strip_tags($_POST['telephoneFon']);
			$salaireFon = strip_tags($_POST['salaireFon']);
			$roleFon = strip_tags($_POST['roleFon']);
		
		$checkThis = $_FON->editFonctionnaireById($idf,
												$nomFon,
												$prenomFon,
												$pseudoFon,
												$passwordFon,
												$emailFon,
												$adresseFon,
												$villeFon, 
												$paysFon,
												$telephoneFon,
												$salaireFon,												
												$roleFon,
												$filename1
	);


		if ($checkThis){
		echo '<script>window.location="fonctionnaire_liste.php"</script>';
		}
		echo '<script>window.location="fonctionnaire_liste.php"</script>';
		}	

?>
