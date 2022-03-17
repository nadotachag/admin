<?php
include('authen.php');
require_once 'includes/header.php';
include('includes/connection.php');
include('includes/participation.php');
require_once 'includes/navbar.php';
include('includes/rendezVous.php');


$_PAR = new Participation();
$_RDV = new RendezVous();

$count = $_PAR->countParticipationActivate();
$dataPar = $_PAR->viewParticipationActivate();

// error_reporting(E_ALL);
// ini_set("display_errors", 1);

?>

<style>
  table th {
    text-align: center;
  }

  .btn-info {
    color: #fff;
    background-color: #084743;
    border-color: #084743;
    box-shadow: none;
  }
</style>

<style>
  .bootbox .modal-header {
    display: block;
  }
</style>

<style>
  .icon-white {
    color: white;
  }

  .icon-green {
    color: #26E16A;
  }

  .icon-yellow {
    color: #FFC300;
  }

  .icon-warn {
    color: #f0ad4e;
  }

  .icon-info {
    color: #5bc0de;
  }

  .bg-icon-info {
    background-color: #5bc0de;
  }
</style>

<!-- Navbar <class="wrapper"> class="hold-transition sidebar-mini" -->

<body class="hold-transition sidebar-mini">
  <!-- Navbar <class="wrapper"> -->
  <div class="wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h4>
              <font color="#c21f37"> Volontaires avec adresses Emails vérifiées </font>
            </h4>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="float-right">
                <?php if ($_SESSION['role_fon'] == "Administrateur") { ?>
                  <div class="well-sm col-sm-12">
                    <div class="btn-group pull-right">
                      <form class="form-horizontal" action="export_data.php" method="post" name="upload_excel" enctype="multipart/form-data">
                        <div class="form-group">
                          <div class="col-md-4 col-md-offset-4">
                            <input type="submit" name="Export" class="btn btn-info" value="Exporter en Excel" />
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>

            <!-- /.card-header -->

            <div class="card-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>
                        <font size="2">N° Volontaire</font>
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
                        <font size="2">Rendez-vous</font>
                      </th>
                      <!-- <th><font size="2">Document</font></th>  -->
                      <th>
                        <font size="2">Actions</font>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    for ($i = 0; $i < $count; $i++) {

                      $is_rdv = false;
                      $nvolontaire  = -1;
                      $nvolontaire = $dataPar[$i]['num_volontaire'];

                      if ($nvolontaire > 0) {
                        $dataRDV = $_RDV->getRendezVousVolontaire($nvolontaire);
                      }
                      if (is_array($dataRDV)) {
                        $is_rdv = true;
                      } else {
                        $is_rdv = false;
                      }

                      echo '<tr>';
                      echo '<td><font size="2">' . $dataPar[$i]['num_volontaire'] . '</font></td>';
                      echo '<td><font size="2">' . $dataPar[$i]['nom_par'] . '</font></td>';
                      echo '<td><font size="2">' . $dataPar[$i]['prenom_par'] . '</font></td>';
                      echo '<td><font size="2">' . $dataPar[$i]['num_contact_tel_par'] . '</font></td>';
                      echo '<td><font size="2">' . $dataPar[$i]['operateur_par'] . '</font></td>';
                      echo '<td><font size="2">' . $dataPar[$i]['ville_par'] . '</font></td>';
                      echo '<td><font size="2">' . $dataPar[$i]['type_client_par'] . '</font></td>';
                      echo '<td><font size="2">' . $dataPar[$i]['type_acces_par'] . '</font></td>';
                      echo '<td><font size="2">' . $dataPar[$i]['offre_service_par'] . '</font></td>';

                      if ($dataPar[$i]['active_par'] == "0") {
                    ?>

                        <td align="center"><a class="resend_mail" data-id="<?php echo $nvolontaire ?>" href="javascript:void(0)"><i class="fa fa-paper-plane"></i></a></td>
                    <?php

                      } else {

                        echo '<td align="center"> <i class="fa fa-check icon-green" aria-hidden="true"></i> </td>';
                      }

                      if ($is_rdv == true) {

                        echo '<td align="center"> <i class="fa fa-check icon-green" aria-hidden="true"></i> </td>';
                      } else {
                        echo '<td align="center">  </td>';
                      }

                      echo '<td style="white-space: nowrap">';
                      echo '<a href="participation_edit.php?idf=' . $dataPar[$i][0] . '" class="btn btn-block bg-gradient-warning btn-xs d-inline">
                                         <em class="fas fa-edit"></em></a> &nbsp;';

                      if ($_SESSION['role_fon'] == "Administrateur") {
                        echo '<a href="#' . $dataPar[$i][0] . '" class="btn btn-block bg-gradient-danger btn-xs delete d-inline">
                                        <em class="fa fa-trash"></em></a> &nbsp;';
                      }


                      if ($_SESSION['role_fon'] == "Administrateur" && $is_rdv == false && $dataPar[$i]['etat_submit_hotline'] == '0') {
                        echo '<a href="add-rendezvous.php?idv=' . $dataPar[$i][0] . '" class="btn btn-block bg-icon-info btn-xs d-inline"  >
                                        <em class="fa fa-calendar-plus icon-white"></i></em> &nbsp;';
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
