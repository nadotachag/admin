<?php 
 require_once '../../includes/header.php';  
?>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <?php 
 require_once '../../includes/navbar.php';  
  ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
    <?php 
	require_once '../../includes/sidebar.php';  
	?>
 <!-- End main sidebar -->
 
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ajouter un nouveau employé</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Project Add</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
	 <form method="post" class="validator-form" action="#" id="form">
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
               <label for="inputPrenom">Prenom </label>
                <input type="text" id="prenomFon" name="prenomFon" class="form-control">
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
                <input type="text" id="telephoneFon" name="telephoneFon" class="form-control">
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
				  <option>Directeur genérale adjoint</option>
				  <option>Directeur RH</option>
                  <option>Chef de projet</option>
                  <option>Assistant de projet</option>
				  <option>Chef secretariat de DG</option>
                </select>
              </div>
			  <div class="form-group">
                    <label for="image1">Photo</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image1" name="image1">
                        <label class="custom-file-label" for="image1"></label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>
					
					                            <div class="col-md-6">
                              <div class="form-group">
                                  <label class="control-label">Marque</label>
                                  <input type="text" class="form-control" name="marqueBoitier" />
                              </div>
                            </div>
					
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>

	  </form>
	  
	        <div class="row">
        <div class="col-12">
          <!-- <a href="#" class="btn btn-secondary">Cancel</a> -->
          <input type="submit" value="Create new Porject" class="btn btn-success float-right" id="validateBtn"> 
		  <br><br><br>
        </div>
      </div>
	  
	  <div class="qloader"></div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php 
 require_once '../../includes/footer.php';  
?>
