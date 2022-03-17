<?php 
require_once 'includes/headercampagne.php'; 
include ('authen.php');
require_once 'includes/navbar.php';  
?>

<style>
    .select2-container--default .select2-purple .select2-selection--multiple .select2-selection__choice, .select2-purple .select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #c21f37;
    border-color: #c21f37;
    color: #fff;
}
</style>

<style>
    .card-primary:not(.card-outline) .card-header {
    background-color: #084743;
}
</style>


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
            <h4> <font color="#c21f37"> Ajouter une nouvelle campagne </font> </h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Campagnes</a></li>
              <li class="breadcrumb-item active">Ajouter une campagne</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
	 <form method="post" class="validator-form" action="#" id="form">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Paramètres</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="nomCpg">Nom de la campagne</label>
                <input type="text" id="nomCpg" name="nomCpg" class="form-control">
              </div>
			  
			   <div class="form-group">
               <label for="dateDebutCpg">Date de début </label>
                <input type="date" id="dateDebutCpg" name="dateDebutCpg" class="form-control" onchange="checkDate()">
                <div class="dateDebutMessage"></div>
              </div>
			  
			    <div class="form-group">
               <label for="dateFinCpg">Date de fin </label>
                <input type="date" id="dateFinCpg" name="dateFinCpg" class="form-control" onchange="checkDate()">
                <div class="dateMessage"></div>
              </div>
              
              <div class="form-group">
                  <label>Villes</label>
                  <div class="select2-purple">
                    <select class="select2" name="villeCp[]" id="villeCp" multiple="multiple" data-placeholder="Selectionner une ou plusieurs villes" data-dropdown-css-class="select2-purple" style="width: 100%;">
                            <option value="Agadir">Agadir</option>
                            <option value="Al Hoceïma">Al Hoceïma</option>
                            <option value="Aoussered">Aoussered</option>
                            <option value="Assilah">Assilah</option>
                            <option value="Azrou">Azrou</option>
                            <option value="Benahmed">Benahmed</option>
                            <option value="Benguérir">Benguérir</option>
                            <option value="Béni Mellal">Béni Mellal</option>
                            <option value="Benslimane">Benslimane</option>
                            <option value="Berkane">Berkane</option>
                            <option value="Berrechid">Berrechid</option>
                            <option value="Boujdour">Boujdour</option>
                            <option value="Bouskoura">Bouskoura</option>
                            <option value="Bouznika">Bouznika</option>
                            <option value="Casablanca">Casablanca</option>
                            <option value="Chefchaouen">Chefchaouen</option>
                            <option value="Chichaoua">Chichaoua</option>
                            <option value="Dakhla">Dakhla</option>
                            <option value="Driouch">Driouch</option>
                            <option value="El Hajeb">El Hajeb</option>
                            <option value="El Jadida">El Jadida</option>
                            <option value="El Kelaâ des Sraghna">El Kelaâ des Sraghna</option>
                            <option value="Errachidia">Errachidia</option>
                            <option value="Essaouira">Essaouira</option>
                            <option value="Es-Semara">Es-Semara</option>
                            <option value="Fès">Fès</option>
                            <option value="Figuig">Figuig</option>
                            <option value="Fnideq">Fnideq</option>
                            <option value="Fquih Ben Salah">Fquih Ben Salah</option>
                            <option value="Guelmim">Guelmim</option>
                            <option value="Guercif">Guercif</option>
                            <option value="Ifrane">Ifrane</option>
                            <option value="Inezgane-Aït Melloul">Inezgane-Aït Melloul</option>
                            <option value="Kénitra">Kénitra</option>
                            <option value="Khémisset">Khémisset</option>
                            <option value="Khénifra">Khénifra</option>
                            <option value="Khouribga">Khouribga</option>
                            <option value="Ksar El Kebir">Ksar El Kebir</option>
                            <option value="Laâyoune">Laâyoune</option>
                            <option value="Larache">Larache</option>
                            <option value="Marrakech">Marrakech</option>
                            <option value="Martil">Martil</option>
                            <option value="M'Diq">M'Diq</option>
                            <option value="Méknès">Méknès</option>
                            <option value="Midelt">Midelt</option>
                            <option value="Mohammedia">Mohammedia</option>
                            <option value="Nador">Nador</option>
                            <option value="Oualidia">Oualidia</option>
                            <option value="Ouarzazate">Ouarzazate</option>
                            <option value="Ouazzane">Ouazzane</option>
                            <option value="Oujda">Oujda</option>
                            <option value="Rabat">Rabat</option>
                            <option value="Safi">Safi</option>
                            <option value="Saidia">Saidia</option>
                            <option value="Salé">Salé</option>
                            <option value="Sefrou">Sefrou</option>
                            <option value="Settat">Settat</option>
                            <option value="Sidi Bennour">Sidi Bennour</option>
                            <option value="Sidi Ifni">Sidi Ifni</option>
                            <option value="Sidi Kacem">Sidi Kacem</option>
                            <option value="Sidi Slimane">Sidi Slimane</option>
                            <option value="Skhirate">Skhirate</option>
                            <option value="Tanger">Tanger</option>
                            <option value="Tan-Tan">Tan-Tan</option>
                            <option value="Taounate">Taounate</option>
                            <option value="Taourirt">Taourirt</option>
                            <option value="Tarfaya">Tarfaya</option>
                            <option value="Taroudannt">Taroudannt</option>
                            <option value="Tata">Tata</option>
                            <option value="Taza">Taza</option>
                            <option value="Témara">Témara</option>
                            <option value="Tétouan">Tétouan</option>
                            <option value="Tifelt">Tifelt</option>
                            <option value="Tinghir">Tinghir</option>
                            <option value="Tiznit">Tiznit</option>
                            <option value="Youssoufia">Youssoufia</option>
                            <option value="Zagora">Zagora</option>
                    </select>
                  </div>
                </div>
                <!-- /.form-group -->
                
            <div class="form-group">
		    <label for="operateurCp" class="col-sm-7 col-form-label" > Opérateurs <font color="#F74A4A"> * </font> </label> 
		    <div class="select2-purple">
               <select class="select2" name="operateurCp[]" id="operateurCp" multiple="multiple" data-placeholder="Selectionner un ou plusieurs opérateurs" data-dropdown-css-class="select2-purple" style="width: 100%;">
				  <option value="Itissalat Al-Maghrib / Maroc Telecom">Itissalat Al-Maghrib / Maroc Telecom</option>
				  <option value="Medi Telecom / Orange">Medi Telecom / Orange</option>
				  <option value="Wana Corporate / Inwi"> Wana Corporate / Inwi</option> 
              </select>
		    </div>
            </div>
            
            <div class="form-group row">
		   <label for="commentaireCp" class="col-sm-4 col-form-label" > Commentaire </label> 
			 <textarea id="commentaireCp" name="commentaireCp" class="form-control"  rows="4"></textarea>
		  </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        </div>
         <!-- /.row -->
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
 require_once 'includes/footercampagne.php';  
?>

<script src="plugins/bootstrap-validator/js/add-campagne.js"></script>

<script>
function checkDate() {
  var dateForm  = document.forms['form'];
  var startDate = new Date(dateForm['dateDebutCpg'].value);
  var endDate   = new Date(dateForm['dateFinCpg'].value);
  
    date1 = new Date();
    var nowdate = date1.setHours(0,0,0,0)

  if (startDate < nowdate) {
     var valdebutdate = "<font color='red'>La date de début ne peut pas être antérieure à la date d'aujourd'hui </font>";
     $('.dateDebutMessage').html(valdebutdate);
     document.getElementById('dateDebutCpg').value = "";
  } 
  else {
   var val = "";
     $('.dateDebutMessage').html(val);
  }

  if (startDate >= endDate) {
     var val = "<font color='red'>La date de fin ne peut pas être antérieure à la date de début !</font>";
     $('.dateMessage').html(val);
     document.getElementById('dateFinCpg').value = "";
  } 
  else {
   var val = "";
     $('.dateMessage').html(val);
  }
}
</script>
