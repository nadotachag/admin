<?php
//   error_reporting(E_ALL);
//   ini_set("display_errors", 1);
  $idf = (int)$_POST['idf'];
	
  include ('../includes/connection.php');
  include ('../includes/campagne.php');
   
   $_CPG = new Campagne();
   $dataCpg = $_CPG->getCampagneById($idf);
   $dataVilleCpg = $_CPG->getVilleByCpgId($idf);
   $dataOperateurCpg = $_CPG->getOperateurByCpgId($idf);
   $getIdVille = $_CPG->getIdVille($idf);
   
   
   $countVilleCp = $_CPG->countVilleCp($idf);

	if (isset($_POST['nomCpg']) && isset($_POST['dateDebutCpg']) && isset($_POST['dateFinCpg']))
		{
			$nomCpg = strip_tags($_POST['nomCpg']);
			$dateDebutCpg = strip_tags($_POST['dateDebutCpg']);
			$dateFinCpg = strip_tags($_POST['dateFinCpg']);
			$villeCpg= $_POST['villeCp'];
			$operateurCpg= $_POST['operateurCp'];
			$commentaireCpg = strip_tags($_POST['commentaireCp']);
	    	$checkThisCpg = $_CPG->editCampagneById($idf,
												$nomCpg,
												$dateDebutCpg,
												$dateFinCpg,
												$commentaireCpg
												);
			
    	    $_CPG->deleteVilleById($idf);

		      foreach ($villeCpg as $i) { 
    		    $villeCpg = $i;
    			$checkThisVil = $_CPG->addVille($villeCpg,
												$idf
												);
		   }
           
            $_CPG->deleteOperateurById($idf);
	    	foreach ($operateurCpg as $j) { 
		    $operateurCpg = $j;
			$checkThisOpr = $_CPG->addOperateur($operateurCpg,
												$idf
												);
		}
	?>
		
			<script>
			 window.location.href = "../cnfeditcpg.php";
			 exit();
		    </script>
		    
		   
	    <?php
		}	
?>
