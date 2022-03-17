<?php
include('authen.php');
// error_reporting(E_ALL);
// ini_set("display_errors", 1);

$idCpg = (int)$_GET['idf'];

require_once 'includes/headercampagne.php';
require_once 'includes/navbar.php';
include('includes/connection.php');
include('includes/campagne.php');
$_CPG = new Campagne();
$dataCpg = $_CPG->getCampagneById($idCpg);

/*  Get Volontaires information  */
include('includes/participation.php');
$_PAR = new Participation();
$dataPar = $_PAR->getParticipationByVilleOpr($idCpg);
$count = $_PAR->countParticipationByVilleOpr($idCpg);
include('includes/detailcampagne.php');
$_DCP = new DetailCampagne();
?>
<style>
  .bootbox .modal-header {
    display: block;
  }

  .fa-user-minus {
    color: #c21f37;
  }
</style>

<style>
  .btn-info {
    color: #fff;
    background-color: #084743;
    border-color: #084743;
    box-shadow: none;
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
      <br>
      <section class="content">
        <div class="container-fluid">
          <div class="col-12">
            <h4>
              <font color="#c21f37"> Affecter des volontaires à cette campagne </font>
            </h4>
          </div>
        </div>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="card-body">
              <div class="table-responsive">
                <table id="" class="table table-bordered table-striped">
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
                        <font size="2">Paramètres</font>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    echo '<tr>';
                    echo '<td><font size="2">' . $idCpg = $dataCpg['campagne_id'] . '</font></td>';
                    echo '<td><font size="2">' . $dataCpg['campagne_nom'] . '</font></td>';
                    echo '<td><font size="2">' . $dataCpg['campagne_date_debut'] . '</font></td>';
                    echo '<td><font size="2">' . $dataCpg['campagne_date_fin'] . '</font></td>';

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
                    echo '<a href="campagne_edit.php?idf=' . $idCpg . '" class="btn btn-block bg-gradient-warning btn-xs d-inline">
                                         <em class="fas fa-edit"></em></a> &nbsp;';
                    if ($_SESSION['role_fon'] == "Administrateur") {
                    }
                    echo '</td>';
                    echo '</td>';
                    echo '</tr>';
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="float-right">
              <?php if ($_SESSION['role_fon'] == "Administrateur") { ?>
                <div class="well-sm col-sm-12">
                  <div class="btn-group pull-right">
                    <form class="form-horizontal" action="export_volontaire.php?idcp=<?php echo $idCpg ?>" method="post" name="upload_excel" enctype="multipart/form-data">
                      <div class="form-group">
                        <div class="col-md-4 col-md-offset-4">
                          <input type="submit" name="Export" href="" class="btn btn-info" value="Exporter en Excel" />
                          <?php // echo '<a href="export_volontaire.php?idcp='.$idCpg.'" class="btn btn-info"> Exporter en Excel </a> &nbsp;'; 
                          ?>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              <?php } ?>
            </div>
            <!-- /.card -->
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>
                        <font size="2">N° volontaire</font>
                      </th>
                      <th>
                        <font size="2">Nom</font>
                      </th>
                      <th>
                        <font size="2">Prénom</font>
                      </th>
                      <th>
                        <font size="2">Téléphone</font>
                      </th>
                      <th>
                        <font size="2">Opérateur</font>
                      </th>
                      <th>
                        <font size="2">Ville</font>
                      </th>
                      <th>
                        <font size="2">Type de client</font>
                      </th>
                      <th>
                        <font size="2">Type d'accès</font>
                      </th>
                      <th>
                        <font size="2">Offre de service</font>
                      </th>
                      <th>
                        <font size="2">Email vérifié</font>
                      </th>
                      <th>
                        <font size="2">Affecter Volontaire</font>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                      $dataVol = $_DCP->getEligibleVolontaire($idCpg);
                      
                      
                      $count = $_DCP->countEligibleVolontaire($idCpg)[0];

                      for ($i = 0; $i < $count; $i++) {
                        $insid = $dataVol[$i]['num_volontaire'];
                        $volCpg = $_DCP-> getExistVolontaireInCampagne($dataVol[$i]['num_volontaire']);
                        // TODO
                        // $dataVol = $_DCP->getExistVolontaire($idCpg, $insid);

                        if ($dataVol[$i]['etat_submit_hotline'] == 1) {
                          // echo '<tr bgcolor="pink">';
                    ?>
                        <tr class="<?php if ($dataVol[$i]['active_par'] == "1" && $volCpg>0)  {
                                      echo "table-success";
                                    } else {
                                      echo "table-warning";
                                    } ?>">
                          <?php
                          echo '<td><font size="2">' . $dataVol[$i]['num_volontaire'] . '</font></td>';
                          echo '<td><font size="2">' . $dataVol[$i]['nom_par'] . '</font></td>';
                          echo '<td><font size="2">' . $dataVol[$i]['prenom_par'] . '</font></td>';
                          echo '<td><font size="2">' . $dataVol[$i]['num_contact_tel_par'] . '</font></td>';
                          echo '<td><font size="2">' . $dataVol[$i]['operateur_par'] . '</font></td>';
                          echo '<td><font size="2">' . $dataVol[$i]['ville_par'] . '</font></td>';
                          echo '<td><font size="2">' . $dataVol[$i]['type_client_par'] . '</font></td>';
                          echo '<td><font size="2">' . $dataVol[$i]['type_acces_par'] . '</font></td>';
                          echo '<td><font size="2">' . $dataVol[$i]['offre_service_par'] . '</font></td>';

                          if ($dataVol[$i]['active_par'] == "0") {
                            $nvolontaire = $dataVol[$i]['num_volontaire'];
                          ?>
                            <td align="center"><a class="resend_mail" data-id="<?php echo $nvolontaire ?>" href="javascript:void(0)"><i class="fa fa-paper-plane"></i></a></td>
                          <?php
                          } else {
                            echo '<td align="center"> <i class="fa fa-check icon-green" aria-hidden="true"></i> </td>';
                          }
                          ?>

                          <td align="center"><a class="affect_vol" data-id="<?php echo $dataVol[$i]['num_volontaire'] ?>" href="#<?php echo $idCpg ?>"><i class="fa fa-user-plus" aria-hidden="true"></i></a>
                            <a class="delete_vol_cp" data-id="<?php echo $dataVol[$i]['num_volontaire'] ?>" href="#<?php echo $idCpg ?>"><i class="fa fa-user-minus" aria-hidden="true"></i></a>
                          </td>
                          <?php
                          echo '</tr>';
                        } else {
                          echo '<tr>';
                          echo '<td><font size="2">' . $dataVol[$i]['num_volontaire'] . '</font></td>';
                          echo '<td><font size="2">' . $dataVol[$i]['nom_par'] . '</font></td>';
                          echo '<td><font size="2">' . $dataVol[$i]['prenom_par'] . '</font></td>';
                          echo '<td><font size="2">' . $dataVol[$i]['num_contact_tel_par'] . '</font></td>';
                          echo '<td><font size="2">' . $dataVol[$i]['operateur_par'] . '</font></td>';
                          echo '<td><font size="2">' . $dataVol[$i]['ville_par'] . '</font></td>';
                          echo '<td><font size="2">' . $dataVol[$i]['type_client_par'] . '</font></td>';
                          echo '<td><font size="2">' . $dataVol[$i]['type_acces_par'] . '</font></td>';
                          echo '<td><font size="2">' . $dataVol[$i]['offre_service_par'] . '</font></td>';

                          if ($dataVol[$i]['active_par'] == "0") {
                            $nvolontaire = $dataVol[$i]['num_volontaire'];
                          ?>
                            <td align="center"><a class="resend_mail" data-id="<?php echo $nvolontaire ?>" href="javascript:void(0)"><i class="fa fa-paper-plane"></i></a></td>
                          <?php

                          } else {

                            echo '<td align="center"> <i class="fa fa-check icon-green" aria-hidden="true"></i> </td>';
                          }
                          ?>
                          <td align="center"><a class="no_affect_vol" data-id="<?php echo $dataVol[$i]['num_volontaire'] ?>" href="#<?php echo $idCpg ?>"><i class="fa fa-user-plus" aria-hidden="true"></i></a></td>

                      <?php
                          echo '</tr>';
                        }
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