<?php

class Admin extends Connection{

	public function addAdmin($nom, $prenom, $email, $motdepasse, $dateR, $etat)
	{
			// get connection
			parent::beConnected();
			global $pdo;

			$stmt = $pdo->prepare("INSERT INTO `user` (
				nom, 
				prenom, 
				email, 
				motdepasse, 
				dateReg,
				etat) 
				VALUES (:_nom, :_prenom, :_email, :_motdepasse, :_dateR,  :_etat)");
				
				$affected = $stmt->execute(array( 
											 '_nom' => $nom,
											 '_prenom' => $prenom,
											 '_email' => $email,
											 '_motdepasse' => $motdepasse,
											 '_dateR' => $dateR,
											 '_etat' => $etat));
			if ($affected > 0)
				return true;
			else
				return false;
	}

	// get one admin by id
	public function getAdminById($idAdmin)
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT * FROM `user` WHERE idAdmin = ".$idAdmin." ");
		$stmt->execute();

		return $stmt->fetch();
	}

	// get one admin login
	public function getAdminToConnect($email, $pass)
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT * FROM `user` WHERE email = '".$email."' AND motdepasse = '".$pass."'");
		$stmt->execute();

		return $stmt->fetch();
	}


	public function deleteAdminById($idAdmin)
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("DELETE FROM `user` WHERE idAdmin = ".$idAdmin." ");
		$stmt->execute();

		return $stmt->rowCount();
	}

	// edit
	public function editAdminById($idAdmin, $nom, $prenom, $email, $motdepasse)
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$setPassword = $this->getAdminById($idAdmin);
		if ($motdepasse == null || empty($motdepasse))
			$motdepasse = $setPassword['motdepasse'];


		$stmt = $pdo->prepare("UPDATE `user` 
			SET  
			nom = '".$nom."', 
			prenom = '".$prenom."', 
			email = '".$email."',
			motdepasse = '".$motdepasse."'
			WHERE idAdmin = '".$idAdmin."'");
		
		$stmt->execute();
		return $stmt->rowCount();
	}	


	// edit picture of la admin
	public function editAdminById_Pic($idAdmin, $adminImage)
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("UPDATE `user` SET  adminImage = '".$adminImage."' WHERE idAdmin = '".$idAdmin."'");
		
		$stmt->execute();
		return $stmt->rowCount();
	}	

	// view data nom archive
	public function viewAdmin()
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT * FROM `user` WHERE archiver = 0");
		$stmt->execute();

		return $stmt->fetchAll();
	}

	// view data nom archive
	public function viewArchivedAdmin()
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT * FROM `user` WHERE archiver = 1");
		$stmt->execute();

		return $stmt->fetchAll();
	}

	//view data student but this method has two parametre for pagination
	public function viewAdmin_Pagination($start, $finish)
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT * FROM `user` WHERE archiver = 0 LIMIT $start, $finish");
		$stmt->execute();

		return $stmt->fetchAll();
	}


	// arrchivier
	public function archiverAdminById($idAdmin)
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("UPDATE `user` SET archiver = 1 WHERE idAdmin = '".$idAdmin."'");
		
		$stmt->execute();
		return $stmt->rowCount();
	}

	// desarchiver
	public function desarchiverAdminById($idAdmin)
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("UPDATE `user` SET archiver = 0 WHERE idAdmin = '".$idAdmin."'");
		
		$stmt->execute();
		return $stmt->rowCount();
	}

	//view data students by serch lastname (nom)
	public function viewAdmin_Search($name)
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT * FROM `user` WHERE nom LIKE '%".$name."%' WHERE archiver = 0");
		$stmt->execute();

		return $stmt->fetchAll();
	}
	// count rows/items
	public function countAdmin()
	{
		// get connection
		parent::beConnected();
		global $pdo;
		
		$result = $pdo->prepare("SELECT count(*) FROM `user` WHERE archiver = 0"); 
		$result->execute(); 
		return $result->fetchColumn();
	}


	public function countArchivedAdmin()
	{
		// get connection
		parent::beConnected();
		global $pdo;
		
		$result = $pdo->prepare("SELECT count(*) FROM `user` WHERE archiver = 1"); 
		$result->execute(); 
		return $result->fetchColumn();
	}
}

?>