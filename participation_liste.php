<?php
include ('authen.php');
require_once 'includes/header.php';  
include ('includes/connection.php');
include ('includes/participation.php');
require_once 'includes/navbar.php';  
$_PAR = new Participation();
$count = $_PAR->countParticipation();
$dataPar = $_PAR->viewParticipation();
?>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h4> <font color="red"> Liste des Volontaires pour la Campagne de la Mesure de la QoS Fixe  </font> </h4>
          </div>
        </div>
        
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
        
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          
          <!-- /.card -->

          <div class="card">
            <div class="card-body">
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
                  <th><font size="2">Numéro Equipement de mesure</font></th>
                  <th><font size="2">Document</font></th>
                  <th></th> 
                </tr>
                </thead>
                <tbody>
                <?php 
                                for ($i = 0; $i< $count; $i++)
                                {
                                echo '<tr>';
									echo '<td><font size="2">'.$dataPar[$i]['num_volontaire'].'</font></td>';
                                    echo '<td><font size="2">'.$dataPar[$i]['nom_par'].'</font></td>';
                                    echo '<td><font size="2">'.$dataPar[$i]['prenom_par'].'</font></td>';
                                    echo '<td><font size="2">'.$dataPar[$i]['num_contact_tel_par'].'</font></td>';
                                    echo '<td><font size="2">'.$dataPar[$i]['operateur_par'].'</font></td>';
                                    echo '<td><font size="2">'.$dataPar[$i]['ville_par'].'</font></td>'; 
									echo '<td><font size="2">'.$dataPar[$i]['type_client_par'].'</font></td>'; 
                                    echo '<td><font size="2">'.$dataPar[$i]['type_acces_par'].'</font></td>'; 
                                    echo '<td><font size="2">'.$dataPar[$i]['offre_service_par'].'</font></td>'; 
                                    echo '<td><font size="2">'.$dataPar[$i]['num_sonde_par'].'</font></td>';
                                    if($dataPar[$i]['piece_jointe_par'] !== "noImage.jpg"){
                                    echo '<td><font size="2"><a href="uploadimages/'.$dataPar[$i]['piece_jointe_par'].'" target="_blank">Apercu</a></font></td>';
                                    }else{
                                         echo '<td></td>';
                                    }
                                    echo '<td style="white-space: nowrap">';
                                        echo '<a href="participation_edit.php?idf='.$dataPar[$i][0].'" class="btn btn-block bg-gradient-warning btn-xs d-inline">
                                         <em class="fas fa-edit"></em></a> &nbsp;';
                                        if($_SESSION['role_fon']=="Administrateur"){ 
                                        echo '<a href="#'.$dataPar[$i][0].'" class="btn btn-block bg-gradient-danger btn-xs delete d-inline">
                                        <em class="fa fa-trash"></em></a>';
                                        }
                                    echo '</td>';
                                       

                                    echo '</td>'; 
                                echo '</tr>';
                                }
                              ?>
                </tbody>
              </table>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
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
