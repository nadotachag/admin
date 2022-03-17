<?php
	$tmp_file1 = $_FILES['image1']['tmp_name'];
	$filename1 = $_FILES['image1']['name'];

	if (empty($tmp_file1)){
		echo '<span class=messageError>Vous devez télécharger un fichier</span>';
	} else {
		if(!empty($tmp_file1)) {
		move_uploaded_file($tmp_file1, '../uploadimages/'. $filename1);
		} else { $filename1 ="noImage.jpg"; }

		if (isset($_POST['nomFon']))
		{

			include ('../includes/connection.php');
			include ('../includes/fonctionnaire.php');
			$_FON = new Fonctionnaire();

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

			$cniFon = strip_tags($_POST['cniFon']);
			$dateNaissFon = strip_tags($_POST['dateNaissFon']);
			$lieuNaissFon = strip_tags($_POST['lieuNaissFon']);

			$checkThis = $_FON->addFonctionnaire($nomFon,
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
												$filename1,
												$cniFon,
												$dateNaissFon,
												$lieuNaissFon);
			if ($checkThis){
				echo '<span class=messageError>Ajoute</span>';
				echo '<script>window.location="fonctionnaire_liste.php"</script>';
            }else {
				echo '<span class=messageError>Non Ajouter</span>';
			}
		} else{
			echo ':(';
		}

	}

?>
