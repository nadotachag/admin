<?php
include('authen.php');
require_once 'includes/header.php';
require_once 'includes/navbar.php';
include('includes/connection.php');
include('includes/fonctionnaire.php');
$_FON = new Fonctionnaire();
$count = $_FON->countFonctionnaire();
$dataFon = $_FON->viewFonctionnaire();
?>


<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <div>
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Liste des utilisateurs</h1>
            </div>

          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <?php if ($_SESSION['role_fon'] == "Administrateur") { ?>
          <div class="well-sm col-sm-12">
            <div class="btn-group pull-right">
              <form class="form-horizontal" action="export_user.php" method="post" name="upload_excel" enctype="multipart/form-data">
                <div class="form-group">
                  <div class="col-md-4 col-md-offset-4">
                    <input type="submit" name="Export" class="btn btn-info" value="Export to excel" />
                  </div>
                </div>
              </form>
            </div>
          </div>
        <?php } ?>

        <div class="row">
          <div class="col-12">
            <!-- /.card -->
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>
                          <font size="2">Nom</font>
                        </th>
                        <th>
                          <font size="2">Prenom</font>
                        </th>
                        <th>
                          <font size="2">Pseudo</font>
                        </th>
                        <th>
                          <font size="2">Email</font>
                        </th>
                        <th>
                          <font size="2">Telephonne</font>
                        </th>
                        <th>
                          <font size="2">Ville</font>
                        </th>
                        <th>
                          <font size="2">Pays</font>
                        </th>
                        <th>
                          <font size="2">Role</font>
                        </th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      for ($i = 0; $i < $count; $i++) {
                        echo '<tr>';
                        echo '<td><font size="2">' . $dataFon[$i]['nom_fon'] . '</font></td>';
                        echo '<td><font size="2">' . $dataFon[$i]['prenom_fon'] . '</font></td>';
                        echo '<td><font size="2">' . $dataFon[$i]['pseudo_fon'] . '</font></td>';
                        echo '<td><font size="2">' . $dataFon[$i]['email_fon'] . '</font></td>';
                        echo '<td><font size="2">' . $dataFon[$i]['telephone_fon'] . '</font></td>';
                        echo '<td><font size="2">' . $dataFon[$i]['ville_fon'] . '</font></td>';
                        echo '<td><font size="2">' . $dataFon[$i]['pays_fon'] . '</font></td>';
                        echo '<td><font size="2">' . $dataFon[$i]['role_fon'] . '</font></td>';
                        // echo '<td>'.$data[$i]['Description_app'].'</td>';
                        echo '<td>';
                        echo '<a href="employe_edit.php?idf=' . $dataFon[$i][0] . '" class="btn btn-block bg-gradient-warning btn-xs d-inline">
                                         <em class="fas fa-edit"></em></a> &nbsp;';
                        echo '<a href="#' . $dataFon[$i][0] . '" class="btn btn-block bg-gradient-danger btn-xs deleteFon d-inline">
                                        <em class="fa fa-trash"></em></a>';
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

    <script>
      $(document).ready(function() {
        $('.content').on('click', '.deleteFon', function(e) {
          e.preventDefault();
          if (confirm("Êtes-vous sûr de vouloir supprimer?!")) {
            var idf = $(this).attr('href').replace('#', '');
            $(this).parent().parent().hide(200);
            $.ajax({
              url: 'handler/delete-fonctionnaire.php',
              type: 'POST',
              data: {
                idf: idf
              },
              success: function(result, status, xhr) {
                if (result != 'OK')
                  alert("Fonctionnaire n'a pas été supprimé, veuillez réessayer!");
              }
            });
          }

        });
      });
    </script>
</body>

</html>