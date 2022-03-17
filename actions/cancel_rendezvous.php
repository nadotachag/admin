<?php

include('../includes/connection.php');
include('../includes/rendezVous.php');

if(isset($_POST['id_rdv']) && isset($_POST['raisonAnnulation'])){

    $id_rdv = strip_tags(trim(addcslashes($_POST['id_rdv'], "'")));
    $raisonAnnulation = strip_tags(trim(addcslashes($_POST['raisonAnnulation'], "'")));
    $statut = strip_tags(trim(addcslashes('Annulé', "'")));

    $errors = [];

    if(empty($id_rdv)){
        $errors['form_validation']['id_rdv'] = '<span class="form-validation">Ce champ est requis</span>';
    }

    if(empty($raisonAnnulation)){
        $errors['form_validation']['raisonAnnulation'] = '<span class="form-validation">Ce champ est requis</span>';
    }

    if(count($errors) != 0){
        echo json_encode($errors);
    }else{
        $data = array(
            '_id_rdv' => $id_rdv,
            '_statut' => $statut,
            '_raisonAnnulation' => $raisonAnnulation
        );

        $_RDV = new rendezVous();

        if($_RDV->cancelRendezVous($data)){
            echo json_encode([
                'status' => 'success',
                'redirect' => '/admin/list-rendezvous.php',
                'msg' => 'Rendez-vous annulé'
            ]);
        }
    }

}else{
    echo json_encode([
        'status' => 'error',
        'msg' => 'Formulaire incomplet'
    ]);
}
