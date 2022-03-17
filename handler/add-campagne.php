<?php
// error_reporting(E_ALL);
// ini_set("display_errors", 1);

	if (
			isset($_POST['nomCpg']))
		{

			include ('../includes/connection.php');
			include ('../includes/campagne.php');
			$_CPG = new Campagne();
			//$VILLE_CPG = new Compagne();
			$dataLastId = $_CPG->getCampagneLastId();
			
			$idCpg = $dataLastId[0][0];
			
			if($idCpg == ""){
			    $idCpg = 1;
			}else{
			    $idCpg = $idCpg + 1;
			} 
        
			$nomCpg = strip_tags($_POST['nomCpg']);
			$dateDebutCpg = strip_tags($_POST['dateDebutCpg']);
			
			$dateFinCpg = strip_tags($_POST['dateFinCpg']);
			$villeCpg= $_POST['villeCp'];
			$operateurCpg= $_POST['operateurCp'];
			$commentaireCpg = strip_tags($_POST['commentaireCp']);

			$checkThiscCpg = $_CPG->addCampagne($idCpg,
			                                    $nomCpg,
												$dateDebutCpg,
												$dateFinCpg,
												$commentaireCpg
												);
												
		foreach ($villeCpg as $i) { 
		    $villeCpg = $i;
			$checkThisVil = $_CPG->addVille($villeCpg,
												$idCpg
												);
		}
			
		foreach ($operateurCpg as $j) { 
		    $operateurCpg = $j;
			$checkThisOpr = $_CPG->addOperateur($operateurCpg,
												$idCpg
												);
		}
												
			if ($checkThiscCpg && $checkThisVil && $checkThisOpr)
					echo '<span class=messageSuccess>Ajouter</span>';
			else
				echo '<span class=messageError>Non Ajouter</span>';
		}
		else
			echo ':(';
?>