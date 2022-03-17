<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="logo/anrt.jpg"
           alt="ANRT"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">ANRT</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['nom_fon']. ' '. $_SESSION['prenom_fon']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fa fa-user"></i>
              <p>
                  &nbsp;&nbsp;&nbsp;&nbsp; Fonctionnaire 
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../admin/fonctionnaire_add.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Nouveau fonctionnaire</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../admin/fonctionnaire_liste.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Liste des fonctionnaires</p>
                </a>
              </li>
            </ul>
          </li> 
		

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fa fa-user"></i>
              <p>
                &nbsp;&nbsp;&nbsp;&nbsp; Participant
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Editer un participant</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../admin/participation_liste.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Liste des participants</p> 
                </a>
              </li>
            </ul>
          </li> 	
	  	  	 	  	  
		  
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>