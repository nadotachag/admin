<?php

//commentaireCp: ""
//dateRdv: ""
//nomCpg: "133"
//objetRdv: "Installation"
//technicienRdv: "17"

include('../includes/connection.php');
include('../includes/rendezVous.php');

$_RDV = new rendezVous();

if(isset($_POST['nomCpg']) && isset($_POST['dateRdv']) && isset($_POST['objetRdv']) && isset($_POST['technicienRdv'])
    && isset($_POST['commentaireCp']) && isset($_POST['id_rdv'])){

    $nomCpg = strip_tags(trim(addcslashes($_POST['nomCpg'], "'")));
    $dateRdv = strip_tags(trim(addcslashes($_POST['dateRdv'], "'")));
    $objetRdv = strip_tags(trim(addcslashes($_POST['objetRdv'], "'")));
    $technicienRdv = strip_tags(trim(addcslashes($_POST['technicienRdv'], "'")));
    $commentaireCp = strip_tags(trim(addcslashes($_POST['commentaireCp'], "'")));
    $id_rdv = strip_tags(trim(addcslashes($_POST['id_rdv'], "'")));
    $heure_rdv = strip_tags(trim(addcslashes($_POST['heure_rdv'], "'")));

    $errors = [];

    if(empty($nomCpg)){
        $errors['form_validation']['nomCpg'] = '<span class="form-validation">Ce champ est requis</span>';
    }
    if(empty($id_rdv)){
        $errors['form_validation']['id_rdv'] = '<span class="form-validation">Ce champ est requis</span>';
    }
    if(empty($dateRdv)){
        $errors['form_validation']['dateRdv'] = '<span class="form-validation">Ce champ est requis</span>';
    }

    if(empty($objetRdv)){
        $errors['form_validation']['objetRdv'] = '<span class="form-validation">Ce champ est requis</span>';
    }

    if(empty($technicienRdv)){
        $errors['form_validation']['technicienRdv'] = '<span class="form-validation">Ce champ est requis</span>';
    }

    if(empty($heure_rdv)){
        $errors['form_validation']['heure_rdv'] = '<span class="form-validation">Ce champ est requis</span>';
    }

    if(count($errors) != 0){
        echo json_encode($errors);
    }else{
        $data = array(
            '_id_rdv' => $id_rdv,
            '_objet' => $objetRdv,
            '_volontaire' => $nomCpg,
            '_technicien' => $technicienRdv,
            '_date_rdv' => $dateRdv,
            '_heure_rdv' => $heure_rdv,
            '_contact' => NULL,
            '_date_contact_tel' => NULL,
            '_statut' => 'Planifi??',
            '_raisonAnnulation' => NULL,
            '_comment_rdv' => $commentaireCp,);

        if($_RDV->updateRendezVous($data)){
            echo json_encode([
                'status' => 'success',
                'msg' => 'Rendez-vous modifi??',
                'redirect' => '/admin/list-rendezvous.php'
            ]);
        }
    }

}else{
    echo json_encode([
        'status' => 'error',
        'msg' => 'Formulaire incomplet'
    ]);
}
