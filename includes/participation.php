<?php

class Participation extends Connection{

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

	public function getParticipationToConnect($email, $pass)
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT * FROM `participation` WHERE adresse_email_par = '".$email."' AND code_par = '".$pass."'");
		$stmt->execute();

		return $stmt->fetch();
	}

	public function getParticipationEmail($email)
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT * FROM `participation` WHERE adresse_email_par = '".$email."'");
		$stmt->execute();

		return $stmt->fetch();
	}

    	public function addParticipation
	(
	    $prenomPar,
		$nomPar,
		$telPar,
		$operateurPar,
		$villePar,
		$quartierPar,
		$typeaccesPar,
		$offreservicePar,
		$numlignePar,
		$adressePar,
		$typeclientPar,
		$emailPar,
		$filename1,
	//	$term1Par,
		$term2Par,
		$codePar,
		$hashPar
	 ){

	   	parent::beConnected();
		global $pdo;

	   	$stmt = $pdo->prepare("INSERT INTO `participation` (prenom_par, nom_par, num_contact_tel_par, operateur_par, ville_par, quartier_par, type_acces_par, offre_service_par, num_ligne_par, adresse_par, type_client_par, adresse_email_par, piece_jointe_par, term2_par, code_par, hash_par) 
				VALUES (  
	            :_prenomPar,
				:_nomPar,
				:_telPar,
				:_operateurPar,
				:_villePar,
				:_quartierPar,
				:_typeaccesPar,
				:_offreservicePar,
				:_numlignePar,
				:_adressePar,
				:_typeclientPar,
				:_emailPar,
				:_filename1,
				:_term2Par,
				:_codePar,
				:_hashPar
				)");


			$affected = $stmt->execute(array('_prenomPar' => $prenomPar,
											 '_nomPar' => $nomPar,
											 '_telPar' => $telPar,
											 '_operateurPar' => $operateurPar,
											 '_villePar' => $villePar,
											 '_quartierPar' => $quartierPar,
											 '_typeaccesPar' => $typeaccesPar,
											 '_offreservicePar' => $offreservicePar,
											 '_numlignePar' => $numlignePar,
											 '_adressePar' => $adressePar,
											 '_typeclientPar' => $typeclientPar,
											 '_emailPar' => $emailPar,
											 '_filename1' => $filename1,
											 '_term2Par' => $term2Par,
											 '_codePar' => $codePar,
											 '_hashPar' => $hashPar
											 ))or die(print_r($affected->errorInfo()));


			if ($affected > 0)
				return true;
			else
				return false;
	 }

	 public function getParticipationByVilleOpr($idCpg)
	{
		// get connection
		parent::beConnected();
		global $pdo;
		$stmt = $pdo->prepare("select * from participation where active_par='1' and (ville_par, operateur_par) IN (select ville_nom, operateur_nom from ville, operateur where ville.compagne_id = '.$idCpg.' and operateur.compagne_id='.$idCpg.')");
		$stmt->execute();
        return $stmt->fetchAll();
    }

		public function countParticipationByVilleOpr($idCpg)
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$result = $pdo->prepare("select count(*) from participation where active_par='1' and (ville_par, operateur_par) IN (select ville_nom, operateur_nom from ville, operateur where ville.compagne_id = '.$idCpg.' and operateur.compagne_id='.$idCpg.')");
		$result->execute();
		return $result->fetchColumn();
	}

		public function getNumSondeParticipationById($idCpg)
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT num_sonde_par FROM participation WHERE num_volontaire = '".$idCpg."'");
        $stmt->execute();
        return $stmt->fetch();
	}

	public function getParticipationById($idf)
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT * FROM participation WHERE num_volontaire = ".$idf."");
		$stmt->execute();

		return $stmt->fetch();
	}


	public function getParticipationByIdActivateHotline($idf)
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT * FROM participation WHERE num_volontaire = ".$idf." and etat_submit_hotline='1'");
		$stmt->execute();

		return $stmt->fetch();
	}


	public function deleteParticipationById($idf)
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("DELETE FROM participation WHERE num_volontaire = ".$idf." ");
		$stmt->execute();

		return $stmt->rowCount();
	}

	// edit
	public function editParticipationById($idf,
											$prenomPar,
											$nomPar,
											$telPar,
											$operateurPar,
											$villePar,
											$quartierPar,
											$typeaccesPar,
											$offreservicePar,
											$numlignePar,
											$adressePar,
											$typeclientPar,
											$emailPar,
											$filename1,

											$numsondeOnePar,
											$dateParOne,
											$heureParOne,
											$etatsondeParOne,
											$filename2,
											$dateRecParOne,
											$heureRecParOne,
											$etatsondeRecParOne,
											$filename3,
											$filename4,

											$numsondeTwoPar,
											$dateParTwo,
											$heureParTwo,
											$etatsondeParTwo,
											$filename22,
											$dateRecParTwo,
											$heureRecParTwo,
											$etatsondeRecParTwo,
											$filename33,
											$filename44,
											$cinPar,
											$etatSubmitHotline
	)
	{

		// get connection
		parent::beConnected();
		global $pdo;
		$stmt = $pdo->prepare("UPDATE participation SET prenom_par = '".$prenomPar."', nom_par = '".$nomPar."', num_contact_tel_par = '".$telPar."',
		operateur_par = '".$operateurPar."', ville_par = '".$villePar."', quartier_par = '".$quartierPar."', type_acces_par = '".$typeaccesPar."',
		offre_service_par = '".$offreservicePar."', num_ligne_par = '".$numlignePar."', adresse_par = '".$adressePar."', type_client_par = '".$typeclientPar."',
		adresse_email_par = '".$emailPar."', piece_jointe_par = '".$filename1."', num_sonde_par='".$numsondeOnePar."', data_installation_par='".$dateParOne."',
		heure_installation_par='".$heureParOne."', etat_sond_installation_par='".$etatsondeParOne."', photo_sonde_inst_par='".$filename2."', data_recuperation_par='".$dateRecParOne."',
		heure_recuperation_par='".$heureRecParOne."', etat_sond_recuperation_par='".$etatsondeRecParOne."', photo_sonde_recuperation_par='".$filename4."', piece_jointe_engagement_par='".$filename3."',
		
		num_sondeTwo_par='".$numsondeTwoPar."', data_installationTwo_par='".$dateParTwo."',
		heure_installationTwo_par='".$heureParTwo."', etat_sond_installationTwo_par='".$etatsondeParTwo."', photo_sonde_instTwo_par='".$filename22."', data_recuperationTwo_par='".$dateRecParTwo."',
		heure_recuperationTwo_par='".$heureRecParTwo."', etat_sond_recuperationTwo_par='".$etatsondeRecParTwo."', photo_sonde_recuperationTwo_par='".$filename44."', piece_jointe_engagementTwo_par='".$filename33."',
		    cin_par='".$cinPar."', etat_submit_hotline='".$etatSubmitHotline."'
		WHERE num_volontaire = '".$idf."'");
		$stmt->execute();
		return $stmt->rowCount();
	}


	public function editParticipationByIdprivatespace($idf,
											$prenomPar,
											$nomPar,
											$telPar,
											$operateurPar,
											$villePar,
											$quartierPar,
											$typeaccesPar,
											$offreservicePar,
											$numlignePar,
											$adressePar,
											$typeclientPar,
											$emailPar,
											$filename1,
											$cinPar

	)
	{

		// get connection
		parent::beConnected();
		global $pdo;
		$stmt = $pdo->prepare("UPDATE participation SET prenom_par = '".$prenomPar."', nom_par = '".$nomPar."', num_contact_tel_par = '".$telPar."',
		operateur_par = '".$operateurPar."', ville_par = '".$villePar."', quartier_par = '".$quartierPar."', type_acces_par = '".$typeaccesPar."',
		offre_service_par = '".$offreservicePar."', num_ligne_par = '".$numlignePar."', adresse_par = '".$adressePar."', type_client_par = '".$typeclientPar."',
		adresse_email_par = '".$emailPar."', piece_jointe_par = '".$filename1."', cin_par='".$cinPar."'
		WHERE num_volontaire = '".$idf."'");
		$stmt->execute();
		return $stmt->rowCount();
	}


	// view
	public function viewParticipation()
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT * FROM participation ORDER BY num_volontaire DESC");
		$stmt->execute();

		return $stmt->fetchAll();
	}

		// view participation  Active
	public function viewParticipationActivate()
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT * FROM participation where active_par='1' ORDER BY num_volontaire DESC");
		$stmt->execute();

		return $stmt->fetchAll();
	}

	public function countParticipationActivate()
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$result = $pdo->prepare("SELECT count(*) FROM `participation` where active_par='1'");
		$result->execute();
		return $result->fetchColumn();
	}

		// view participation non Active
	public function viewParticipationNoActivate()
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT * FROM participation where active_par='0' ORDER BY num_volontaire DESC");
		$stmt->execute();

		return $stmt->fetchAll();
	}

	public function countParticipationNoActivate()
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$result = $pdo->prepare("SELECT count(*) FROM `participation` where active_par='0'");
		$result->execute();
		return $result->fetchColumn();
	}

	public function countParticipation()
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$result = $pdo->prepare("SELECT count(*) FROM `participation`");
		$result->execute();
		return $result->fetchColumn();
	}

    public function getParticipations()
    {
        // get connection
        parent::beConnected();
        global $pdo;

        $result = $pdo->prepare("SELECT * FROM `participation`");
        $result->execute();
        return $result->fetchAll();
    }

}

?>
