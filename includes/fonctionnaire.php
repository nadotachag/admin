<?php

class Fonctionnaire extends Connection{
	
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

	public function addFonctionnaire
	(
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
		$filename1,
		$cniFon,
		$dateNaissFon,
		$lieuNaissFon
	)
	{
			// get connection
			parent::beConnected();
			global $pdo;

			$stmt = $pdo->prepare("INSERT INTO `fonctionnaire` (nom_fon, prenom_fon, pseudo_fon, password_fon, email_fon, adresse_fon, ville_fon, pays_fon, telephone_fon, salaire_fon, role_fon, image_fon, cni_fon, date_naissance_fon, lieu_naissance_fon) 
				VALUES (
				:_nomFon,
				:_prenomFon,
				:_pseudoFon,
				:_passwordFon,
				:_emailFon,
				:_adresseFon,
				:_villeFon,
				:_paysFon,
				:_telephoneFon,
				:_salaireFon,
				:_roleFon,
				:_filename1,
				:_cniFon,
				:_dateNaissFon,
				:_lieuNaissFon
				)");

			$affected = $stmt->execute(array('_nomFon' => $nomFon,
											 '_prenomFon' => $prenomFon,
											 '_pseudoFon' => $pseudoFon,
											 '_passwordFon' => $passwordFon,
											 '_emailFon' => $emailFon,
											 '_adresseFon' => $adresseFon,
											 '_villeFon' => $villeFon,
											 '_paysFon' => $paysFon,
											 '_telephoneFon' => $telephoneFon,
											 '_salaireFon' => $salaireFon, 
											 '_roleFon' => $roleFon,
											 '_filename1' => $filename1,
											 
											 '_cniFon' => $cniFon,
											 '_dateNaissFon' => $dateNaissFon,
											 '_lieuNaissFon' => $lieuNaissFon											 
											 ));
			if ($affected > 0)
				return true;
			else
				return false;
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

	// view 
	public function viewFonctionnaire()
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT * FROM fonctionnaire ORDER BY id_fon DESC");
		$stmt->execute();

		return $stmt->fetchAll();
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


	public function countFonctionnaire()
	{
		// get connection
		parent::beConnected();
		global $pdo;
		
		$result = $pdo->prepare("SELECT count(*) FROM `fonctionnaire`"); 
		$result->execute(); 
		return $result->fetchColumn();
	}
	
		public function countChefProjet()
	{
		// get connection
		parent::beConnected();
		global $pdo;
		
		$result = $pdo->prepare("SELECT count(*) FROM `fonctionnaire` where role_fon='Chef de projet Consulting'"); 
		$result->execute(); 
		return $result->fetchColumn();
	}
	
	public function countChefFormation()
	{
		// get connection
		parent::beConnected();
		global $pdo;
		
		$result = $pdo->prepare("SELECT count(*) FROM `fonctionnaire` where role_fon='Chef de formation'"); 
		$result->execute(); 
		return $result->fetchColumn();
	}


}

?>