<?php
if(isset($_POST["Export"])){ 
$conn = new mysqli('localhost', 'dbadmin', 'Demo123*');  
mysqli_select_db($conn, 'qos-fixe');  
$sql = "SELECT * FROM `fonctionnaire`";  
$setRec = mysqli_query($conn, $sql);  
$columnHeader = '';  
$columnHeader = "Id" . "\t" . "CNI" . "\t" . "Date de naissance" . "\t" . "Lieu" . "\t"  . "Nom" . "\t" . "Prenom" . "\t"
. "Pseudo" . "\t" . "Password" . "\t" . "Email" . "\t" . "Adresse" . "\t" . "Ville" . "\t" . "Pays" . "\t" 
. "Telephone" . "\t" . "Salaire" . "\t" . "Role" . "\t"
. "Image" . "\t" . "Super admin" . "\t" . "Etat" . "\t"
. "Archive" . "\t";  
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
header("Content-Disposition: attachment; filename=Users_Detail.xls");  
header("Pragma: no-cache");  
header("Expires: 0");  

  echo ucwords($columnHeader) . "\n" . $setData . "\n";  

 } 
?> 