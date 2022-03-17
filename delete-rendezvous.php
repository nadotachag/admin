<?php
include('authen.php');
include('../admin/includes/connection.php');
include('includes/rendezVous.php');

$_RDV = new rendezVous();

if(isset($_REQUEST['idrdv']) && !empty($_REQUEST['idrdv']) && is_numeric($_REQUEST['idrdv'])){
    $idrdv = $_REQUEST['idrdv'];
}else{
    echo '<script>window.location.href="/admin/list-rendezvous.php"</script>';
}

if($_RDV->deleteRendezVous($idrdv)){
    echo '<script>window.location.href="/admin/list-rendezvous.php"</script>';
}
