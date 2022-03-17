<?php
include('authen.php');
require_once 'includes/navbar.php';
require_once '../admin/includes/headerRendezVous.php';
include('../admin/includes/connection.php');
include('includes/rendezVous.php');

$_RDV = new rendezVous();

$dataRDV = $_RDV->getAllRendezVousDTO();
$countRDV = $_RDV->countAllRendezVousDTO();

?>

<style>

table th {
    text-align: center ;
}

a.disabled {
  /* Make the disabled links grayish*/
  color: gray;
  /* And disable the pointer events */
  pointer-events: none;
}
</style>

<body class="hold-transition sidebar-mini">
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h4>
              <font color="#c21f37"> Liste des Rendez-Vous de la Mesure de la QoS Fixe </font>
            </h4>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th >
                        <font size="3">N° du volontaire</font>
                      </th>
                      <th>
                        <font size="3">Volontaire</font>
                      </th>
                      <th>
                        <font size="3">Date/Heure du rendez-vous</font>
                      </th>
                      <th>
                        <font size="3">Objet</font>
                      </th>
                      <th>
                        <font size="3">Technicien</font>
                      </th>
                      <th  >
                        <font size="3">Adresse</font>
                      </th>
                      <th>
                        <font size="3">Ville</font>
                      </th>
                      <th>
                        <font size="3">Statut</font>
                      </th>
                      <th>
                          <font size="3">Commentaires</font>
                      </th>
                      <th>
                        <font size="3">Actions</font>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    for ($i = 0; $i < $countRDV; $i++) {
                      echo '<tr>';
                      echo '<td><font size="3">' . $id_volontaire = $dataRDV[$i]['num_volontaire'] . '</font></td>';
                      echo '<td><font size="3">' . $nom_complet_volontaire =  $dataRDV[$i]['nom_par'] . ' ' . $dataRDV[$i]['prenom_par'] . '</font></td>';
                      echo '<td><font size="3">' . $datetimeRDV = $dataRDV[$i]['date_rdv'] . ' ' . $dataRDV[$i]['heure_rdv'] . '</font></td>';
                      echo '<td><font size="3">' . $objetRDV = $dataRDV[$i]['objet'] . '</font></td>';
                      echo '<td><font size="3">' . $technicienRDV = $dataRDV[$i]['pseudo_fon'] . '</font></td>';
                      echo '<td><font size="3">' . $adresseRDV = $dataRDV[$i]['adresse_par'] . '</font></td>';
                      echo '<td><font size="3">' . $villeRDV = $dataRDV[$i]['ville_par'] . '</font></td>';
                      echo '<td><font size="3">' . $statutRDV = $dataRDV[$i]['statut'] . '</font></td>';
                      echo '<td><font size="3">' . $commentaireRDV = $dataRDV[$i]['comment_rdv'] . '</font></td>';

                        $dis = '';
                        if ($dataRDV[$i]['statut']=='Annulé'){$dis='disabled';}

                      echo '<td style="white-space: nowrap">';
                      if ($_SESSION['role_fon'] == "Administrateur") {
                        echo '<a href="edit-rendezvous.php?idrdv=' . $dataRDV[$i]['id_rdv'] . '" 
                                class="btn btn-block bg-gradient-info btn-xs '.$dis.' d-inline " 
                                data-toggle="tooltip" 
                                data-placement="top" 
                                title="Editer Rendez-Vous" >
                                <em class="fas fa-edit disabled" ></em></a> &nbsp;';

                          echo '<a href="cancel-rendezvous.php?idrdv=' . $dataRDV[$i]['id_rdv'] . '" 
                                class="btn btn-block bg-gradient-warning btn-xs '.$dis.' d-inline " 
                                data-toggle="tooltip" 
                                data-placement="top" 
                                title="Cancel Rendez-Vous" >
                                <em class="fas fa-times disabled" ></em></a> &nbsp;';

                          echo '<a href="delete-rendezvous.php?idrdv=' . $dataRDV[$i]['id_rdv'] . '" 
                                class="btn btn-block bg-gradient-danger btn-xs  d-inline " 
                                data-toggle="tooltip" 
                                data-placement="top" 
                                onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce rendez-vous?\');"
                                title="Delete Rendez-Vous" >
                                <em class="fas fa-trash disabled" ></em></a> &nbsp;';
                      }
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
