<?php

class rendezVous extends Connection{

	public function getAllRendezVousDTO()
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT id_rdv, num_volontaire, nom_par, prenom_par , objet , date_rdv, heure_rdv, statut, comment_rdv, pseudo_fon, adresse_par, ville_par, num_contact_tel_par
								from rendezvous
								join participation on participation.num_volontaire = rendezvous.volontaire  
								join fonctionnaire on rendezvous.technicien = fonctionnaire.id_fon; 
								;");
		$stmt->execute();

		return $stmt->fetchAll();
	}

	public function countAllRendezVousDTO()
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT count(*)
                                from rendezvous
                                join participation on participation.num_volontaire = rendezvous.volontaire  
                                join fonctionnaire on rendezvous.technicien = fonctionnaire.id_fon; 
                                ;");
		$stmt->execute();

		return $stmt->fetch()[0];

	}

	public function getRendezVousVolontaire($id_vol){
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT * FROM rendezvous where volontaire = '".$id_vol."' and statut = 'Planifié' order by date_rdv desc limit 1 ;");
		$stmt->execute();

		return $stmt->fetch();
	}

	public function getAllTechniciens(){
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT id_fon, nom_fon, prenom_fon, cni_fon FROM fonctionnaire where role_fon ='Technicien' ;");
		$stmt->execute();

		return $stmt->fetchAll();
	}

	public function countAllTechniciens(){
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT count(*) FROM fonctionnaire where role_fon ='Technicien' ;");
		$stmt->execute();

		return $stmt->fetch()[0];
	}

	public function addRendezVous($data)
	{
		// get connection
		parent::beConnected();
		global $pdo;

		// $stmt = $pdo -> prepare("INSERT INTO `rendezvous` ( objet, volontaire, technicien, date_rdv, heure_rdv, contact, date_contact_tel, statut, raisonAnnulation, comment_rdv)
		//                 VALUES ('Test2','375','17','2022-03-06','20:00:00',null,null,'Planifie',null,'client contacte a 5 reprises')");

		// $affected = $stmt->execute();

		$stmt = $pdo->prepare("INSERT INTO `rendezvous` ( objet, volontaire, technicien, date_rdv, heure_rdv, contact, date_contact_tel, statut, raisonAnnulation, comment_rdv) 
				VALUES (
				:_objet,
				:_volontaire,
				:_technicien,
				:_date_rdv,
				:_heure_rdv,
				:_contact,
				:_date_contact_tel,
				:_statut,
				:_raisonAnnulation,
				:_comment_rdv
				)");

		$affected = $stmt->execute($data);

		// $affected = $stmt->execute($data);
		if ($affected > 0)
			return true;
		else
			return false;
	}

	public function updateRendezVous($data)
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("UPDATE `rendezvous` 
				SET 
				objet = :_objet,
				volontaire = :_volontaire,
				technicien = :_technicien,
				date_rdv = :_date_rdv,
				heure_rdv = :_heure_rdv,
				contact = :_contact,
				date_contact_tel = :_date_contact_tel,
				statut = :_statut,
				raisonAnnulation = :_raisonAnnulation,
				comment_rdv = :_comment_rdv
				WHERE id_rdv = :_id_rdv
				");

		$affected = $stmt->execute($data);
		if ($affected > 0)
			return true;
		else
			return false;
	}

	public function cancelRendezVous($data)
	{
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("UPDATE `rendezvous` 
				SET 
				statut = :_statut,
				raisonAnnulation = :_raisonAnnulation
				WHERE id_rdv = :_id_rdv
				");

		$affected = $stmt->execute($data);
		if ($affected > 0)
			return true;
		else
			return false;
	}

	public function deleteRendezVous($id){
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("DELETE FROM `rendezvous` 
				WHERE id_rdv = :_id_rdv
				");

		$affected = $stmt->execute(['_id_rdv' => $id]);
		if ($affected > 0)
			return true;
		else
			return false;
	}

	public function getRendezVousByID($id){
		// get connection
		parent::beConnected();
		global $pdo;

		$stmt = $pdo->prepare("SELECT * FROM rendezvous WHERE id_rdv = '$id' ");
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
}
