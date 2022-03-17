<!-- Navbar -->

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script> -->

<!-- <nav class="navbar navbar-expand-sm navbar-light bg-white shadow-sm"> -->
<nav class="navbar navbar-expand-sm navbar-light bg-white shadow-sm active">
    <div class="container">
  <!-- Brand -->
  <a class="navbar-brand" href="#" width="100"> <img src="logo/anrt.jpg" width="100" alt="" class="d-inline-block align-middle mr-2"></a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Links -->

  <div class="collapse navbar-collapse" id="navbarText">
 <!-- <ul class="navbar-nav ml-auto">  -->
 <ul class="navbar-nav mr-auto">

    <!-- Dropdown -->
    <?php if($_SESSION['role_fon']=="Administrateur") { ?>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Utilisateurs
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="fonctionnaire_add.php">Ajouter un utilisateur</a>
        <a class="dropdown-item" href="fonctionnaire_liste.php">Liste des utilisateurs</a>
      </div>
    </li>
     <?php } ?>

     <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Volontaires
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="participation_liste_yes.php">Volontaires</a>
        <a class="dropdown-item" href="participation_liste_no.php">Volontaires non vérifiés</a>
      </div>
    </li>

    <?php if(($_SESSION['role_fon']=="Administrateur") || ($_SESSION['role_fon']=="Technicien")) {  ?>
         <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Campagnes
      </a>
      <div class="dropdown-menu">
          <?php if($_SESSION['role_fon']=="Administrateur") { ?>
        <a class="dropdown-item" href="campagne_add.php">Ajouter une campagne</a>
        <?php } ?>
        <a class="dropdown-item" href="campagne_liste.php">Gérer une campagne</a>
      </div>

      <?php if($_SESSION['role_fon']=="Administrateur") {  ?>
         <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Rendez-Vous
      </a>
      <div class="dropdown-menu">
          <?php if($_SESSION['role_fon']=="Administrateur") { ?>
        <a class="dropdown-item" href="add-rendezvous.php">Ajouter un Rendez-Vous</a>
        <a class="dropdown-item" href="list-rendezvous.php">Gérer les Rendez-Vous</a>
        <?php } ?>
        <a class="dropdown-item" href="calendrier-rdv.php">Calendriez des Rendez-Vous</a>
      </div>
    </li>
     <?php } ?>

    </li>
     <?php } ?>

     <?php if(($_SESSION['role_fon']=="Administrateur") || ($_SESSION['role_fon']=="Technicien")) { ?>
<!--    <li class="nav-item">-->
<!--      <a class="nav-link" href="../participation.php" target="_blank">Formulaire de Demande de Participation</a>-->
<!--    </li>-->
     <?php  } ?>

     <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        <i class="fas fa-lock"></i>
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="#">
            <div class="media">
              <img src="logo/anrt.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  <?php echo "Bonjour ". $_SESSION['prenom_fon']; ?>
                  <span class="float-right text-sm text-danger"><!--<i class="fas fa-star"></i>--></span>
                </h3>
				 <div class="dropdown-divider"></div>
                <a href="logout.php" class="text-sm">Logout </a>
              </div>
            </div>
        </a>
      </div>
    </li>

  </ul>
  </div>
  </div>
</nav>
