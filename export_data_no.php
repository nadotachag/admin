<?php
if(isset($_POST["Export"])){ 

$conn = new mysqli('localhost', 'dbadmin', 'Demo123*');  
mysqli_select_db($conn, 'qos-fixe');  
$sql = "SELECT num_volontaire, prenom_par, nom_par, num_contact_tel_par, operateur_par, ville_par, type_client_par, type_acces_par, offre_service_par FROM participation where active_par='0' ORDER BY num_volontaire DESC";  
$setRec = mysqli_query($conn, $sql);  
$columnHeader = '';  

$columnHeader = "Numero volontaire" . "\t" . "Prenom" . "\t" . "Nom" . "\t" . "Telephone" . "\t"  . "Operateur" . "\t" . "Ville" . "\t"
. "Type client" . "\t" . "Type accès" . "\t" . "Offre de service" . "\t";

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