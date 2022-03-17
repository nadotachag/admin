<?php
include ('authen.php');
require_once 'includes/header.php';
require_once 'includes/navbar.php';
?>

<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ajouter un nouvel utilisateur</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="fonctionnaire_liste.php">Utilisateurs</a></li>
              <li class="breadcrumb-item active">Ajouter un utilisateur</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
	 <form method="post" class="validator-form" action="#" id="form" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">General</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputName">Nom </label>
                <input type="text" id="nomFon" name="nomFon" class="form-control">
              </div>
              <div class="form-group">
               <label for="inputPrenom">Prénom </label>
                <input type="text" id="prenomFon" name="prenomFon" class="form-control">
              </div>

			   <div class="form-group">
               <label for="cniFon">CNI </label>
                <input type="text" id="cniFon" name="cniFon" class="form-control">
              </div>

			   <div class="form-group">
               <label for="dateNaissFon">Date de naissance </label>
                <input type="date" id="dateNaissFon" name="dateNaissFon" class="form-control">
              </div>

			   <div class="form-group">
               <label for="lieuNaissFon">Lieu de naissance </label>
                <input type="text" id="lieuNaissFon" name="lieuNaissFon" class="form-control" onkeypress="return /[a-z]/i.test(event.key)">
              </div>

              <div class="form-group">
               <label for="inputEmail">Email </label>
                <input type="text" id="emailFon" name="emailFon" class="form-control">
              </div>
              <div class="form-group">
                 <label for="adresseFon">Adresse</label>
                <textarea id="adresseFon" class="form-control" name="adresseFon" rows="4"></textarea>
              </div>
              <div class="form-group">
                <label for="villeFon">Ville </label>
                <input type="text" id="villeFon" name="villeFon" class="form-control">
              </div>
			   <div class="form-group">
                <label for="paysFon">Pays </label>
                <input type="text" id="paysFon" name="paysFon" class="form-control">
              </div>
			  <div class="form-group">
                <label for="telephoneFon">Telephone </label>
                <input type="tel" id="telephoneFon" name="telephoneFon" class="form-control" >
              </div>
			  <div class="form-group">
                <label for="salaireFon">Salaire </label>
                <input type="text" id="salaireFon" name="salaireFon" class="form-control">
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-6">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Connexion</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputPseudo">Pseudo</label>
                <input type="text" id="pseudoFon" name="pseudoFon" class="form-control">
              </div>
              <div class="form-group">
                <label for="passwordFon">Password</label>
                <input type="password" id="passwordFon" name="passwordFon" class="form-control">
              </div>
              <div class="form-group">
                <label for="roleFon">Role</label>
                <select class="form-control custom-select" name="roleFon">
                  <option selected disabled>Selectionnez un role </option>
				  <option value="Administrateur">Administrateur</option>
				  <option value="Hotline">Hotline</option>
				  <option value="Technicien">Technicien</option>
                </select>
              </div>

		<!-- custom file -->
					<div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image1" name="image1">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>
					  <div style="margin-top: 10px;"></div>
                                <div class="progress progress-striped active">
                        <div class="progress-bar" style="width:0%"></div>
                      </div>
                </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>

	  <div class="row">
        <div class="col-12">
		  <button type="submit" class="btn btn-success float-right" name="signup" id="validateBtn">Ajouter</button>

	   <!-- Final Message -->
        <div class="finalMessage"></div>
        <div class="col-md-12 flr">
			<div class="qloader"></div>
        </div>
		<br><br><br>
        </div>
      </div>
	  </form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
 require_once 'includes/footer.php';
?>

<script src="plugins/bootstrap-validator/js/add-fonctionnaire.js"></script>
