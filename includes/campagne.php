<?php

class Campagne extends Connection{
	
	// get one admin login
	public function getFonctionnaireToConnect($email, $pass)
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT * FROM `fonctionnaire` WHERE email_fon = '".$email."' AND password_fon = '".$pass."'");
		$stmt->execute();

		return $stmt->fetch();
	}

	public function addCampagne
	(
		$idCpg,
		$nomCpg,
		$dateDebutCpg,
		$dateFinCpg,
		$commentaireCpg
	)
	{
			// get connection
			parent::beConnected();
			global $pdo;

			$stmt = $pdo->prepare("INSERT INTO `campagne` (campagne_id, campagne_nom, campagne_date_debut, campagne_date_fin, campagne_commentaire) 
				VALUES (
				:_idCpg,
				:_nomCpg,
				:_dateDebutCpg,
				:_dateFinCpg,
				:_commentaireCpg
				)");

			$affected = $stmt->execute(array('_idCpg' => $idCpg,
			                                 '_nomCpg' => $nomCpg,
											 '_dateDebutCpg' => $dateDebutCpg,
											 '_dateFinCpg' => $dateFinCpg,
											 '_commentaireCpg' => $commentaireCpg
											 ));
			if ($affected > 0)
				return true;
			else
				return false;
	}
	
	public function editCampagneById($idf,
										$nomCpg,
										$dateDebutCpg,
										$dateFinCpg,
										$commentaireCpg
	)
	{
		// get connection
		parent::beConnected();
		global $pdo;
		$stmt = $pdo->prepare("UPDATE campagne SET campagne_nom = '".$nomCpg."', campagne_date_debut = '".$dateDebutCpg."', campagne_date_fin = '".$dateFinCpg."', campagne_commentaire = '".$commentaireCpg."' WHERE campagne_id = '".$idf."'");
		$stmt->execute();
	    $affected = $stmt->rowCount();
			if ($affected > 0)
				return true;
			else
				return false;
	}
	
	
	
		public function getVilleByCpgId($idf)
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT ville_id, ville_nom FROM ville WHERE compagne_id = ".$idf."");
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
		public function countVilleByCpgId($idf)
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT count(*) FROM ville WHERE compagne_id = ".$idf."");
		$stmt->execute(array('ville_nom'));

		return $stmt->fetch();
	}


	
	public function addVille($villeCpg, $idCpg)
	{
			// get connection
			parent::beConnected();
			global $pdo;
			
			$stmt = $pdo->prepare("INSERT INTO `ville` (ville_nom, compagne_id) 
				VALUES (
				:_villeCpg,
				:_idCpg
				)");
           
		$stmt->execute(array('_villeCpg' => $villeCpg,
											 '_idCpg' => $idCpg
											 ));
	}
	
		public function verifyexistIdVlCp($villeCpg ,$idf)
	{
		// get connection
		parent::beConnected();
		global $pdo;

          $stmt = $pdo->prepare("SELECT ville_id FROM ville WHERE ville_nom = :_villeCpg and compagne_id = :_idf");
          $stmt->bindParam(":_villeCpg", $villeCpg, PDO::PARAM_STR);
          $stmt->bindParam(":_idf", $idf, PDO::PARAM_INT);
          $stmt->execute();
          
		/*
		if ($affected > 0)
				return true;
			else
				return false;
		*/

		return $stmt->fetch();
	}
	
	
		public function getIdVille($idf)
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT ville_id FROM ville WHERE compagne_id = ".$idf."");
		$stmt->execute();

		return $stmt->fetch();
	}
	
		public function editVilleById($villeCpg, $idf)
	{
		// get connection
		parent::beConnected();
		global $pdo;
		
		$stmt = $pdo->prepare("UPDATE ville SET ville_nom = '".$villeCpg."' where compagne_id = '".$idf."'");
		$stmt->execute();
		return $stmt->rowCount();

	}
	
	public function getOperateurByCpgId($idf)
	{
		// get connection
		parent::beConnected();
		global $pdo;
		$stmt = $pdo->prepare("SELECT operateur_nom FROM operateur WHERE compagne_id = ".$idf."");
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function deleteVilleById($idf)
	{
		// get connection
		parent::beConnected();
		global $pdo;
        
        $stmt = $pdo->prepare("DELETE FROM ville WHERE compagne_id = ".$idf." ");
		$stmt->execute();

		return $stmt->rowCount();
	}
	
		public function addOperateur
	(
		$operateurCpg,
		$idCpg
	)
	{
			// get connection
			parent::beConnected();
			global $pdo;

			$stmt = $pdo->prepare("INSERT INTO `operateur` (operateur_nom, compagne_id) 
				VALUES (
				:_operateurCpg,
				:_idCpg
				)");

			$affected = $stmt->execute(array('_operateurCpg' => $operateurCpg,
											 '_idCpg' => $idCpg
											 ));
			if ($affected > 0)
				return true;
			else
				return false;
	}
	
		public function editOperateurById($operateurCpg, $idf)
	{
		// get connection
		parent::beConnected();
		global $pdo;
		$stmt = $pdo->prepare("UPDATE operateur SET operateur_nom = '".$operateurCpg."' where compagne_id = '".$idf."'");
		$stmt->execute();
		return $stmt->rowCount();
	}	
	
	public function deleteOperateurById($idf)
	{
		// get connection
		parent::beConnected();
		global $pdo;
		
        $stmt = $pdo->prepare("DELETE FROM operateur WHERE compagne_id = ".$idf." ");
		$stmt->execute();

		return $stmt->rowCount();
	}

    	public function getCampagneLastId()
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT Max(campagne_id) FROM campagne");
		$stmt->execute();
		return $stmt->fetchAll();
	}


	public function getFonctionnaireById($idf)
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT * FROM fonctionnaire WHERE id_fon = ".$idf."");
		$stmt->execute();

		return $stmt->fetch();
	}


	public function deleteFonctionnaireById($idf)
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("DELETE FROM fonctionnaire WHERE id_fon = ".$idf." ");
		$stmt->execute();

		return $stmt->rowCount();
	}

	// edit
	public function editFonctionnaireById($idf,
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
	)
	{
		// get connection
		parent::beConnected();
		global $pdo;
		$stmt = $pdo->prepare("UPDATE fonctionnaire SET nom_fon = '".$nomFon."', prenom_fon = '".$prenomFon."', pseudo_fon = '".$pseudoFon."', password_fon = '".$passwordFon."', email_fon = '".$emailFon."', adresse_fon = '".$adresseFon."', ville_fon = '".$villeFon."', pays_fon = '".$paysFon."', telephone_fon = '".$telephoneFon."', salaire_fon = '".$salaireFon."', role_fon = '".$roleFon."', image_fon = '".$filename1."' WHERE id_fon = '".$idf."'");
		$stmt->execute();
		return $stmt->rowCount();
	}
	
		public function getCampagneById($idCpg)
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT * FROM campagne WHERE campagne_id = ".$idCpg."");
		$stmt->execute();

		return $stmt->fetch();
	}

	// view 
	public function viewCampagne()
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT * FROM campagne ORDER BY campagne_id DESC");
		$stmt->execute();

		return $stmt->fetchAll();
	}


	
		public function viewVille($idCpg)
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT ville_nom FROM ville where compagne_id = '".$idCpg."'");
		$stmt->execute();

		return $stmt->fetchAll();
	}
	
		public function countVille($idCpg)
	{
		// get connection
		parent::beConnected();
		global $pdo;
		
		$result = $pdo->prepare("SELECT count(*) FROM ville where compagne_id = '".$idCpg."'"); 
		$result->execute(); 
		return $result->fetchColumn();
	}
	
	public function countVilleCp($idf)
	{
		// get connection
		parent::beConnected();
		global $pdo;
		
		$result = $pdo->prepare("SELECT count(*) FROM ville where compagne_id = '".$idf."'"); 
		$result->execute(); 
		return $result->fetchColumn();
	}
	
	
		public function viewOperateur($idCpg)
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT operateur_nom FROM operateur where compagne_id = '".$idCpg."'");
		$stmt->execute();

		return $stmt->fetchAll();
	}
	
		public function countOperateur($idCpg)
	{
		// get connection
		parent::beConnected();
		global $pdo;
		
		$result = $pdo->prepare("SELECT count(*) FROM operateur where compagne_id = '".$idCpg."'"); 
		$result->execute(); 
		return $result->fetchColumn();
	}
	
	
		public function viewChefProjet()
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT * FROM fonctionnaire where role_fon='Chef de projet Consulting' ORDER BY id_fon DESC");
		$stmt->execute();

		return $stmt->fetchAll();
	}
	
			public function viewChefFormation()
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT * FROM fonctionnaire where role_fon='Chef de formation' ORDER BY id_fon DESC");
		$stmt->execute();

		return $stmt->fetchAll();
	}


	public function countCampagne()
	{
		// get connection
		parent::beConnected();
		global $pdo;
		
		$result = $pdo->prepare("SELECT count(*) FROM `campagne`"); 
		$result->execute(); 
		return $result->fetchColumn();
	}
	
	public function getDateFinCpByNumVol($insid)
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("select campagne_date_fin from campagne where campagne_date_fin > now() and campagne_id in (select campagne_id from detail_campagne where num_volontaire = ".$insid.")"); 
		$stmt->execute();
		return $stmt->fetch();
	}
}

?>