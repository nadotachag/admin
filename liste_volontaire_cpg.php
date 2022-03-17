<?php
include ('authen.php');
$idCpg = (int)$_GET['idf'];
require_once 'includes/headercampagne.php';
require_once 'includes/navbar.php';  
include ('includes/connection.php');
include ('includes/campagne.php');
    
// error_reporting(E_ALL);
// ini_set("display_errors", 1);

$_CPG = new Campagne();
$dataCpg = $_CPG->getCampagneById($idCpg);
   
/*  Get Volontaires information  */
    
include ('includes/participation.php');
$_PAR = new Participation();
$dataPar = $_PAR->getParticipationByVilleOpr($idCpg);
$count = $_PAR->countParticipationByVilleOpr($idCpg);

include ('includes/detailcampagne.php');
$_DCP = new DetailCampagne();
$dataParCompagne = $_DCP->getVolontaireCpgById($idCpg);
$countParCompagne = $_DCP->countVolontaireCpgById($idCpg);

?>

<style>
.bootbox .modal-header{
display: block;
}

.fa-user-minus {
  color: #c21f37;
}

.table-pistache, .table-pistache>td, .table-pistache>th {
    background-color: #bef574;
}

</style>

<style>
    .icon-green {
      color: #26E16A;
    } 
    
    .icon-yellow {
      color: #FFC300;
    } 
</style>


 <!-- Navbar <class="wrapper"> class="hold-transition sidebar-mini" --> 
<body class="hold-transition sidebar-mini">
   <!-- Navbar <class="wrapper"> --> 
<div class="wrapper">
  <div>
    <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
        <div class="">
                <div class="col-sm-12">
                <h4> <font color="#c21f37"> <b> Gérer cette campagne </b> </font> </h4>
              </div>
        </div>
      </div>
      <!-- /.container-fluid -->
 </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->
          <div class="card">
            <div class="card-body">
                <div class="table-responsive">
              <table id="" class="table table-bordered table-striped">
                <thead>
                <tr>
				  <th><font size="2">N° de la campagne</font></th>
                  <th><font size="2">Nom de la campagne</font></th>
                  <th><font size="2">Date de début</font></th>
                  <th><font size="2">Date de fin</font></th>
                  <th><font size="2">Opérateurs</font></th> 
                  <th><font size="2">Villes</font></th> 
                  <?php if($_SESSION['role_fon']=="Administrateur"){ ?>
                  <th><font size="2">Paramètres</font></th> 
                  <?php } ?>
                </tr>
                </thead>
                <tbody>
                <?php 
                                echo '<tr>';
									echo '<td><font size="2">'.$dataCpg['campagne_id'].'</font></td>';
                                    echo '<td><font size="2">'.$dataCpg['campagne_nom'].'</font></td>';
                                    echo '<td><font size="2">'.$dataCpg['campagne_date_debut'].'</font></td>';
                                    echo '<td><font size="2">'.$dataCpg['campagne_date_fin'].'</font></td>';
                                    
                                    
                                    
                                     // methode opérateur
                                     $countOpr = $_CPG->countOperateur($idCpg);
                                     $dataOpr = $_CPG->viewOperateur($idCpg);
                                     echo'<td>';
                                    for ($j = 0; $j< $countOpr; $j++)
                                     {
                                    echo '<font size="2">'.$dataOpr[$j]['operateur_nom'].'</font>'.', ';
                                     }
                                     echo'</td>';
                                     
                                     
                                     
                                     // methode ville
                                     $countVille = $_CPG->countVille($idCpg);
                                     $dataVille = $_CPG->viewVille($idCpg);
                                     echo'<td>';
                                     for ($k = 0; $k< $countVille; $k++){
                                        echo '<font size="2">'.$dataVille[$k]['ville_nom'].'</font>'.', '; 
                                     }
                                     echo'</td>';
                                 if($_SESSION['role_fon']=="Administrateur"){ 
                                    echo '<td style="white-space: nowrap">';
                                        echo '<a href="campagne_edit.php?idf='.$dataCpg['campagne_id'].'" class="btn btn-block bg-gradient-warning btn-xs d-inline">
                                         <em class="fas fa-edit"></em></a> &nbsp;';
                                    echo '</td>';
                                 }  
                                    echo '</td>'; 
                                echo '</tr>';
                               
                              ?>
                </tbody>
              </table>
              </div>
            </div>
          </div>
          <!-- /.card -->
                  
      <div class="card-body">
        <div class="float-right">
         <?php if($_SESSION['role_fon']=="Administrateur") { ?>    
        <div class="well-sm col-sm-12">
            <div class="btn-group pull-right">
            <form class="form-horizontal" action="export_data.php" method="post" name="upload_excel"   
                      enctype="multipart/form-data">
                  <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <input type="submit" name="Export" class="btn btn-info" value="Export to excel"/>
                            </div>
                   </div>                    
            </form>  
        </div>
    </div>
    <?php } ?>
    </div>
                <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
				  <th><font size="2">N° volontaire</font></th>
                  <th><font size="2">Nom</font></th>
                  <th><font size="2">Prénom</font></th>
                  <th><font size="2">Téléphone</font></th>
                  <th><font size="2">Opérateur</font></th>
                  <th><font size="2">Ville</font></th> 
				  <th><font size="2">Type de client</font></th>
                  <th><font size="2">Type d'accès</font></th>
                  <th><font size="2">Offre de service</font></th>
                  <th><font size="2">N° Equipement de mesure 1</font></th> 
                  <th><font size="2">PV Equipement de mesure 1</font></th> 
                  <th><font size="2">Equipement de mesure 2/ Photo</font></th>
                  <th><font size="2">N° Equipement de mesure 2</font></th>
                  <th><font size="2">PV Equipement de mesure 2</font></th> 
                  <th><font size="2">Equipement de mesure 2/ Photo</font></th>
                  <th><font size="2">Gérer Equipement de mesure</font></th>
                  <th><font size="2">Gérer QoS</font></th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    for($i = 0; $i<$countParCompagne; $i++){
                             $numvol = $dataParCompagne[$i]['num_volontaire'];
                            $numsondCpg = $_PAR->getNumSondeParticipationById($numvol);
                        ?>
                        <tr class="<?php if($dataParCompagne[$i]['num_sonde_par']){ echo "table-pistache"; }else{ echo "table-success"; } ?>">
                       <?php
									echo '<td>'.$dataParCompagne[$i]['num_volontaire'].'</font></td>';
                                    echo '<td><font size="2">'.$dataParCompagne[$i]['nom_par'].'</font></td>';
                                    echo '<td><font size="2">'.$dataParCompagne[$i]['prenom_par'].'</font></td>';
                                    echo '<td><font size="2">'.$dataParCompagne[$i]['num_contact_tel_par'].'</font></td>';
                                    echo '<td><font size="2">'.$dataParCompagne[$i]['operateur_par'].'</font></td>';
                                    echo '<td><font size="2">'.$dataParCompagne[$i]['ville_par'].'</font></td>'; 
									echo '<td><font size="2">'.$dataParCompagne[$i]['type_client_par'].'</font></td>'; 
                                    echo '<td><font size="2">'.$dataParCompagne[$i]['type_acces_par'].'</font></td>'; 
                                    echo '<td><font size="2">'.$dataParCompagne[$i]['offre_service_par'].'</font></td>';
                                    echo '<td><font size="2">'.$dataParCompagne[$i]['num_sonde_par'].'</font></td>';
                                    ?>
                                    <td align="center"><font size="2"> <?php if(trim($dataParCompagne[$i]['piece_jointe_engagement_par']) !==""){ ?><a href="uploadimages/<?php echo $dataParCompagne[$i]['piece_jointe_engagement_par'] ?>" target="_blank"><i class="far fa-file fa-lg"></i></a> <?php } ?></font></td>
                                    <td align="center"><font size="2"> <?php if(trim($dataParCompagne[$i]['photo_sonde_inst_par']) !==""){ ?><a href="uploadimages/<?php echo $dataParCompagne[$i]['photo_sonde_inst_par'] ?>" target="_blank"><i class="fas fa-camera fa-lg"></i></a> <?php } ?></font></td>

                                    <?php
                                    echo '<td><font size="2">'.$dataParCompagne[$i]['num_sondeTwo_par'].'</font></td>';
                                    ?>
                                    <td align="center"><font size="2"> <?php if(trim($dataParCompagne[$i]['piece_jointe_engagementTwo_par']) !==""){ ?><a href="uploadimages/<?php echo $dataParCompagne[$i]['piece_jointe_engagementTwo_par'] ?>" target="_blank"><i class="far fa-file fa-lg"></i></a> <?php } ?></font></td>
                                    <td align="center"><font size="2"> <?php if(trim($dataParCompagne[$i]['photo_sonde_instTwo_par']) !==""){ ?><a href="uploadimages/<?php echo $dataParCompagne[$i]['photo_sonde_instTwo_par'] ?>" target="_blank"><i class="fas fa-camera fa-lg"></i></a> <?php } ?></font></td>

                                    <?php
                                    echo '<td style="white-space: nowrap">';
                  
                                        echo '<a href="participation_edit.php?idf='.$dataParCompagne[$i]['num_volontaire'].'" class="btn btn-block bg-gradient-warning btn-xs d-inline" data-toggle="tooltip" data-placement="top" title="Editer sonde">
                                         <em class="fas fa-edit"></em></a> &nbsp;'; 
                                    echo '<td><font size="2"><img src="uploadimages/file-bar-graph.svg"></font></td>';
                                echo '</tr>';
                          } 
                    ?>
                </tbody>
              </table>
              </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
              
	 <?php 
	 require_once 'includes/footer.php';  
	?>
