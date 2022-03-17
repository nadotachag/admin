<?php 
    
if(isset($_POST["Export"])){ 

$conn = new mysqli('localhost', 'dbadmin', 'Demo123*');  
mysqli_select_db($conn, 'qos-fixe');  
$idCpg = (int)$_GET['idcp'];
$sql = "select num_volontaire, nom_par, prenom_par, num_contact_tel_par, operateur_par, ville_par, type_client_par, type_acces_par, offre_service_par, adresse_email_par from participation where active_par='1' and (ville_par, operateur_par) IN (select ville_nom, operateur_nom from ville, operateur where ville.compagne_id = '.$idCpg.' and operateur.compagne_id='.$idCpg.')";  
$setRec = mysqli_query($conn, $sql);  
$columnHeader = ''; 

$columnHeader = "Numero volontaire" . "\t" . "Nom" . "\t" . "Prenom" . "\t" . "Telephone" . "\t"  . "Operateur" . "\t" . "Ville" . "\t"
. "Type client" . "\t" . "Type accès" . "\t" . "Offre de service" . "\t" . "Email vérifier" . "\t";

$setData = '';  
  while ($rec = mysqli_fetch_row($setRec)) {  
    $rowData = '';  
    foreach ($rec as $value) {  
        $value = '"' . $value . '"' . "\t";  
        $rowData .= $value;  
    }  
    $setData .= trim($rowData) . "\n";  
}  
  
header('Content-Encoding: UTF-8');
header('Content-type: text/csv; charset=UTF-8');
header("Content-type: application/octet-stream");  
header("Content-Disposition: attachment; filename=Participation_Detail.xls");  
header("Pragma: no-cache");  
header("Expires: 0");  

  echo ucwords($columnHeader) . "\n" . $setData . "\n";  

 } 

 ?> 