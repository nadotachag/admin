<?php
include('authen.php');
require_once 'includes/navbar.php';
require_once 'includes/headercampagne.php';
include('includes/connection.php');
include('includes/campagne.php');
$_CPG = new Campagne();
$countCpg = $_CPG->countCampagne();
$dataCpg = $_CPG->viewCampagne();
?>

<!-- Navbar <class="wrapper"> class="hold-transition sidebar-mini" -->

<body class="hold-transition sidebar-mini">
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h4>
              <font color="#c21f37"> Liste des Campagnes de la Mesure de la QoS Fixe </font>
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
                      <th>
                        <font size="2">N° de la campagne</font>
                      </th>
                      <th>
                        <font size="2">Nom de la campagne</font>
                      </th>
                      <th>
                        <font size="2">Date de début</font>
                      </th>
                      <th>
                        <font size="2">Date de fin</font>
                      </th>
                      <th>
                        <font size="2">Opérateurs</font>
                      </th>
                      <th>
                        <font size="2">Villes</font>
                      </th>
                      <th>
                        <font size="2">Actions</font>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    for ($i = 0; $i < $countCpg; $i++) {
                      echo '<tr>';
                      echo '<td><font size="2">' . $idCpg = $dataCpg[$i]['campagne_id'] . '</font></td>';
                      echo '<td><font size="2">' . $dataCpg[$i]['campagne_nom'] . '</font></td>';
                      echo '<td><font size="2">' . $dataCpg[$i]['campagne_date_debut'] . '</font></td>';
                      echo '<td><font size="2">' . $dataCpg[$i]['campagne_date_fin'] . '</font></td>';

                      // methode opérateur
                      $countOpr = $_CPG->countOperateur($idCpg);
                      $dataOpr = $_CPG->viewOperateur($idCpg);
                      echo '<td>';
                      for ($j = 0; $j < $countOpr; $j++) {
                        echo '<font size="2">' . $dataOpr[$j]['operateur_nom'] . '</font>' . ', ';
                      }
                      echo '</td>';

                      // methode ville
                      $countVille = $_CPG->countVille($idCpg);
                      $dataVille = $_CPG->viewVille($idCpg);
                      echo '<td>';
                      for ($k = 0; $k < $countVille; $k++) {
                        echo '<font size="2">' . $dataVille[$k]['ville_nom'] . '</font>' . ', ';
                      }
                      echo '</td>';

                      echo '<td style="white-space: nowrap">';
                      if ($_SESSION['role_fon'] == "Administrateur") {
                        echo '<a href="campagne_edit.php?idf=' . $dataCpg[$i][0] . '" class="btn btn-block bg-gradient-warning btn-xs d-inline" data-toggle="tooltip" data-placement="top" title="Editer campagne">
                                         <em class="fas fa-edit"></em></a> &nbsp;';
                      }
                      if (($_SESSION['role_fon'] == "Administrateur")) {
                        echo '<a href="affectvolontaire.php?idf=' . $dataCpg[$i][0] . '" class="btn btn-block bg-gradient-info btn-xs d-inline" data-toggle="tooltip" data-placement="top" title="Affecter volontaires"><em class="fa fa-users"></em></a> &nbsp;';
                      }
                      if (($_SESSION['role_fon'] == "Administrateur") || ($_SESSION['role_fon'] == "Technicien")) {
                        echo '<a href="liste_volontaire_cpg.php?idf=' . $dataCpg[$i][0] . '"" class="btn btn-block bg-gradient-dark btn-xs d-inline"><em class="fa fa-table" data-toggle="tooltip" data-placement="top" title="Gérer campagne"></em></a> &nbsp;';
                      }
                      if ($_SESSION['role_fon'] == "Administrateur") {
                        echo '<a href="#" class="btn btn-block bg-gradient-danger btn-xs d-inline" data-toggle="tooltip" data-placement="top" title="Supprimer campagne"><em class="fa fa-trash"></em></a> &nbsp;';
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