<?php
require_once('includes/header.php');
include('authen.php');
include('includes/connection.php');
require_once 'includes/navbar.php';
include('includes/participation.php');

$idf = (int)$_GET['idf'];
$_PAR = new Participation();
$dataPar = $_PAR->getParticipationById($idf);

// Get Request from detail campagne
include('includes/detailcampagne.php');
$_DCP = new DetailCampagne();
?>

<style>
	.form-group.required label:after {
		color: red;
		font-family: 'FontAwesome';
		font-weight: normal;
		font-size: 14px;
		content: "*";
		top: 4px;
		position: absolute;
		margin-left: 8px;
	}

	.badge-pistache {
		background-color: #bef574;
	}
</style>


<body class="hold-transition sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

		<style>
			.select2-container .select2-selection--single {
				height: 34px !important;
			}

			.select2-container--default .select2-selection--single {
				border: 1px solid #ccc !important;
				border-radius: 0px !important;
			}
		</style>


		<style>
			.myHide {
				display: none;
			}

			.myVisible {
				display: block;
			}
		</style>
		<!-- Content Wrapper. Contains page content -->
		<div class="container">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-12">
							<center>
								<br>
								<h4>
									<font color="#c21f37"> <b>Liste des données personnelles et techniques du volontaire </b> </font>
								</h4>
							</center>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>


			<section class="content">
				<form method="post" class="validator-form" action="#" id="form">
					<div class="card">
						<div class="row">
							<div class="col-sm-6">

								<div class="form-group">
									<?php $getvalnumVolotaire = $dataPar['num_volontaire'];
									$dataVol = $_DCP->getExistVolontaireById($getvalnumVolotaire);
									?>

									<!-- No validate email -->
									<?php if ((trim($dataPar['active_par'])) == 0) { ?>
										<label for="NumPar" class="col-sm-3 col-form-label"><span class="badge badge-secondary">
												<h5><b> Volontaire N° <?= $getvalnumVolotaire ?> </b></h5>
											</span></label>
									<?php } ?>

									<!-- Validate email -->
									<?php if (($dataPar['active_par'] == 1) && ($dataPar['etat_submit_hotline'] == 0) && ($dataPar['num_sonde_par'] == "")) { ?>
										<label for="NumPar" class="col-sm-3 col-form-label"><span class="badge badge-light">
												<h5><b> Volontaire N° <?= $getvalnumVolotaire ?></b></h5>
											</span></label>

									<?php } ?>

									<!-- Validate hotline -->
									<?php if (($dataPar['etat_submit_hotline']) == 1 && $dataVol == false  && ($dataPar['num_sonde_par'] == "")) { ?>
										<label for="NumPar" class="col-sm-3 col-form-label"><span class="badge badge-warning">
												<h5> <b>Volontaire N° <?= $getvalnumVolotaire ?></b></h5>
											</span></label>
									<?php } ?>


									<!-- Validate Campagne -->
									<?php
									if ($dataVol && ($dataPar['num_sonde_par'] == "")) { ?>
										<label for="NumPar" class="col-sm-3 col-form-label"><span class="badge badge-success">
												<h5><b> Volontaire N° <?= $getvalnumVolotaire ?> </b></h5>
											</span></label>
									<?php } ?>

									<!-- Validate Sonde -->
									<?php
									if (($dataPar['num_sonde_par']) && trim($dataPar['active_par']) == 1) { ?>
										<label for="NumPar" class="col-sm-3 col-form-label"><span class="badge badge-pistache">
												<h5><b>Volontaire N° <?= $getvalnumVolotaire ?> </b> </h5>
											</span></label>
									<?php } ?>
								</div>

							</div>
						</div>
					</div>

					<h5>
						<font color="#c21f37"><b> Données personnelles </b></font>
					</h5>

					<div class="card">
						<div class="row">
							<div class="col-sm-6">
								<!--  <div class="card"> -->
								<div class="card-body">
									<div class="form-group row required control-label">
										<label for="prenomPar" class="col-sm-3 col-form-label"> Prénom </label>
										<div class="col-sm-6">
											<input type="text" id="prenomPar" name="prenomPar" class="form-control" value="<?= $dataPar['prenom_par'] ?>" <?php if ($_SESSION['role_fon'] == "Technicien") { ?> disabled <?php } ?>>
										</div>
										<?php if ($_SESSION['role_fon'] == "Technicien") { ?>
											<input type="hidden" name="prenomPar" value="<?= $dataPar['prenom_par'] ?>" />
										<?php } ?>
									</div>

									<div class="form-group row required control-label">
										<label for="nomPar" class="col-sm-3 col-form-label"> Nom </label>
										<div class="col-sm-6">
											<input type="text" id="nomPar" name="nomPar" class="form-control" value="<?= $dataPar['nom_par'] ?>" <?php if ($_SESSION['role_fon'] == "Technicien") { ?> disabled <?php } ?>>
											<input type="hidden" name="idf" value="<?= $idf ?>" />
											<?php if ($_SESSION['role_fon'] == "Technicien") { ?>
												<input type="hidden" name="nomPar" value="<?= $dataPar['nom_par'] ?>" />
											<?php } ?>
										</div>
									</div>

									<div class="form-group row required control-label">
										<label for="telPar" class="col-sm-3 col-form-label"> N° contact Tél </label>
										<div class="col-sm-6">
											<input type="text" id="telPar" name="telPar" class="form-control" value="<?= $dataPar['num_contact_tel_par'] ?>" <?php if ($_SESSION['role_fon'] == "Technicien") { ?> disabled <?php } ?>>
											<?php if ($_SESSION['role_fon'] == "Technicien") { ?>
												<input type="hidden" name="telPar" value="<?= $dataPar['num_contact_tel_par'] ?>" />
											<?php } ?>
										</div>
									</div>
								</div>
								<!--  </div> -->
							</div>

							<div class="col-sm-6">
								<!--   <div class="card">  -->
								<div class="card-body">
									<div class="form-group row required control-label">
										<label for="operateurPar" class="col-sm-3 col-form-label"> Opérateur </label>
										<div class="col-sm-6">
											<select class="form-control custom-select" name="operateurPar" <?php if ($_SESSION['role_fon'] == "Technicien") { ?> disabled <?php } ?>>
												<option value="Itissalat Al-Magrib / Maroc Telecom">Itissalat Al-Maghrib / Maroc Telecom</option>
												<option value="Méditelecom / Orange">Médi Télecom / Orange</option>
												<option value="Wana Corporate / Inwi"> Wana Corporate / Inwi</option>
											</select>

											<?php if ($_SESSION['role_fon'] == "Technicien") { ?>
												<input type="hidden" name="operateurPar" value="<?= $dataPar['operateur_par'] ?>" />
											<?php } ?>
										</div>
									</div>

									<div class="form-group row required control-label">
										<label for="villePar" class="col-sm-3 col-form-label"> Ville </label>
										<div class="col-sm-6">

											<select class="form-control select2" name="villePar" id="villePar" <?php if ($_SESSION['role_fon'] == "Technicien") { ?> disabled <?php } ?>>
												<option selected value="<?= $dataPar['ville_par'] ?>"><?php echo $dataPar['ville_par'] ?></option>
												<option disabled>Sélectionnez une ville</option>
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
											<script>
												$('.select2').select2();
											</script>

											<?php if ($_SESSION['role_fon'] == "Technicien") { ?>
												<input type="hidden" name="villePar" value="<?= $dataPar['ville_par'] ?>" />
											<?php } ?>

										</div>
									</div>

									<div class="form-group row required control-label">
										<label for="cinPar" class="col-sm-3 col-form-label"> CIN </label>
										<div class="col-sm-6">
											<input type="text" id="cinPar" name="cinPar" class="form-control" value="<?= $dataPar['cin_par'] ?>" <?php if ($_SESSION['role_fon'] == "Technicien") { ?> disabled <?php } ?>>
											<?php if ($_SESSION['role_fon'] == "Technicien") { ?>
												<input type="hidden" name="cinPar" value="<?= $dataPar['cin_par'] ?>" />
											<?php } ?>
										</div>
									</div>

								</div>
								<!--  </div>  -->
							</div>
						</div>
					</div>

					<h5>
						<font color="#c21f37"><b> Données techniques</b></font>
					</h5>

					<div class="card">
						<div class="row">
							<div class="col-sm-6">
								<!--  <div class="card"> -->
								<div class="card-body">
									<div class="form-group row">
										<label for="typeaccesPar" class="col-sm-5 col-form-label">Type d'abonnement <font color="red"> *</font></label>
										<div class="col-sm-6">
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="typeaccesPar" id="typeaccesPar1" value="ADSL" <?php if (($dataPar['type_acces_par']) == "ADSL") { ?> checked <?php } ?> <?php if ($_SESSION['role_fon'] == "Technicien") { ?> disabled <?php } ?>>
												<label class="form-check-label" for="typeaccesPar1">ADSL</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="typeaccesPar" id="typeaccesPar2" value="FTTH" <?php if (($dataPar['type_acces_par']) == "FTTH") { ?> checked <?php } ?> <?php if ($_SESSION['role_fon'] == "Technicien") { ?> disabled <?php } ?>>
												<label class="form-check-label" for="typeaccesPar2">FTTH</label>
											</div>

											<?php if ($_SESSION['role_fon'] == "Technicien") { ?>
												<input type="hidden" name="typeaccesPar" value="<?= $dataPar['type_acces_par'] ?>" />
											<?php } ?>

										</div>
									</div>

									<?php $val = '4Mbps' ?>
									<div class="form-group row">
										<label for="offreservicePar" class="col-sm-4 col-form-label"> Débit contracté : </label>
										<div class="col-sm-6">

											<select class="form-control custom-select" name="offreservicePar" id="firstDropdown" <?php if ($_SESSION['role_fon'] == "Technicien") { ?> disabled <?php } ?>>
												<option selected disabled="true" value="<?= $dataPar['offre_service_par'] ?>"><?php echo $dataPar['offre_service_par'] ?> </option>
												<option selected hidden value="<?= $dataPar['offre_service_par'] ?>"><?php echo $dataPar['offre_service_par'] ?> </option>
												<option value="4 Mb/s">4 Mb/s</option>
												<option value="8 Mb/s">8 Mb/s</option>
												<option value="12 Mb/s">12 Mb/s</option>
												<option value="20 Mb/s">20 Mb/s</option>
											</select>

											<select class="form-control custom-select myHide" name="offreservicePar" id="secondDropdown">
												<option selected disabled="true" value="<?= $dataPar['offre_service_par'] ?>"><?php echo $dataPar['offre_service_par'] ?> </option>
												<option value="12 Mb/s">12 Mb/s</option>
												<option value="20 Mb/s">20 Mb/s</option>
												<option value="50 Mb/s">50 Mb/s</option>
												<option value="100 Mb/s">100 Mb/s</option>
												<option value="200 Mb/s">200 Mb/s</option>
											</select>

											<?php if ($_SESSION['role_fon'] == "Technicien") { ?>
												<input type="hidden" name="offreservicePar" value="<?= $dataPar['offre_service_par'] ?>" />
											<?php } ?>
										</div>
									</div>

									<div class="form-group row">
										<label for="numlignePar" class="col-sm-4 col-form-label"> N° de ligne : </label>
										<div class="col-sm-6">
											<input type="text" id="numlignePar" name="numlignePar" class="form-control" value="<?= $dataPar['num_ligne_par'] ?>" <?php if ($_SESSION['role_fon'] == "Technicien") { ?> disabled <?php } ?>>

											<?php if ($_SESSION['role_fon'] == "Technicien") { ?>
												<input type="hidden" name="numlignePar" value="<?= $dataPar['num_ligne_par'] ?>" />
											<?php } ?>

										</div>
									</div>

									<div class="form-group row">
										<label for="typeclientPar" class="col-sm-4 col-form-label"> Type d'abonné : </label>
										<div class="col-sm-6">
											<select class="form-control custom-select" name="typeclientPar" <?php if ($_SESSION['role_fon'] == "Technicien") { ?> disabled <?php } ?>>

												<option value="Résidentiel">Résidentiel</option>
												<option value="Professionnel">Professionnel</option>
											</select>

											<?php if ($_SESSION['role_fon'] == "Technicien") { ?>
												<input type="hidden" name="typeclientPar" value="<?= $dataPar['type_client_par'] ?>" />
											<?php } ?>

										</div>
									</div>

									<div class="form-group row">
										<label for="emailPar" class="col-sm-4 col-form-label"> Email : </label>
										<div class="col-sm-6">
											<input type="text" id="emailPar" name="emailPar" class="form-control" value="<?= $dataPar['adresse_email_par'] ?>" <?php if ($_SESSION['role_fon'] == "Technicien") { ?> disabled <?php } ?>>

											<?php if ($_SESSION['role_fon'] == "Technicien") { ?>
												<input type="hidden" name="emailPar" value="<?= $dataPar['adresse_email_par'] ?>" />
											<?php } ?>

										</div>
									</div>

								</div>
								<!--  </div> -->
							</div>

							<div class="col-sm-6">
								<!--   <div class="card">  -->
								<div class="card-body">
									<div class="form-group row align-items-start">
										<label for="quartierPar" class="col-sm-4 col-form-label "> Quartier </label>
										<div class="col-sm-6">
											<input type="text" id="quartierPar" name="quartierPar" class="form-control" value="<?= $dataPar['quartier_par'] ?>" <?php if ($_SESSION['role_fon'] == "Technicien") { ?> disabled <?php } ?>>

											<?php if ($_SESSION['role_fon'] == "Technicien") { ?>
												<input type="hidden" name="quartierPar" value="<?= $dataPar['quartier_par'] ?>" />
											<?php } ?>

										</div>
									</div>

									<div class="form-group row">
										<label for="adressePar" class="col-sm-4 col-form-label"> Adresse </label>
										<div class="col-sm-6">
											<textarea id="adressePar" name="adressePar" class="form-control" rows="4" <?php if ($_SESSION['role_fon'] == "Technicien") { ?> disabled <?php } ?>><?php echo $dataPar['adresse_par'] ?></textarea>

											<?php if ($_SESSION['role_fon'] == "Technicien") { ?>
												<input type="hidden" name="adressePar" value="<?= $dataPar['adresse_par'] ?>" />
											<?php } ?>

										</div>
									</div>

									<div class="form-group row">
										<label for="exampleInputFile" class="col-sm-4 col-form-label">Joindre copie ou photo de votre facture d'abonnement / أرفق نسخة أو صورة من فاتورة اشتراكك</label>
										<div class="col-sm-6">
											<div class="input-group">
												<div class="custom-file">
													<input type="file" class="custom-file-input" id="image1" name="image1" <?php if ($_SESSION['role_fon'] == "Technicien") { ?> disabled <?php } ?>>
													<label class="custom-file-label" for="exampleInputFile">Selectionnez la facture</label>
												</div>
											</div>

											<div style="margin-top: 10px;"></div>
											<div class="progress progress-striped active">
												<div class="progress-bar" style="width:0%"></div>
											</div>
										</div>
									</div>

								</div>
								<!--  </div>  -->
							</div>

							<div class="container-fluid">
								<div class="col-12">
									<?php if ($_SESSION['role_fon'] == "Hotline") { ?>
										<div class="float-right"><button type="submit" class="btn btn-secondary" name="signup" id="validateBtn">Valider les données </button></div>
									<?php   } ?>
								</div>
							</div>
						</div>
					</div>
					<?php // }
					?>


					<h5>
						<font color="#c21f37"><b> Equipement installé </b></font>
					</h5>

					<!--   SONDE 1  -->
					<?php if (($_SESSION['role_fon'] == "Administrateur") || ($_SESSION['role_fon'] == "Technicien")) { ?>

						<div class="card">
							<div class="row mx-2 mt-3">
								<label for="num_sonde_par" class="col-sm-4 col-form-label">N° de l'équipement de mesure</label>
								<div class="col-sm-2">
									<input type="text" id="numsondeParOne" name="numsondeParOne" class="form-control" value="<?= $dataPar['num_sonde_par'] ?>" <?php if (($_SESSION['role_fon'] == "Technicien") && (trim($dataPar['num_sonde_par']) !== "")) { ?>disabled<?php } ?>>

									<?php if (($dataPar['num_sonde_par'] !== "") && ($_SESSION['role_fon'] !== "Administrateur")) { ?>
										<input type="hidden" name="numsondeParOne" value="<?= $dataPar['num_sonde_par'] ?>" />
									<?php  } ?>

								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<!--  <div class="card"> -->
									<div class="card-body">
										<div class="form-group row">
											<label for="dateParOne" class="col-sm-8 col-form-label">
												<font color="#1f8383">Installation de l'équipement de mesure </font>
											</label>
										</div>
										<hr>

										<div class="form-group row">
											<label for="dateParOne" class="col-sm-4 col-form-label"> Date </label>
											<div class="col-sm-6">
												<input type="date" id="dateParOne" name="dateParOne" class="form-control" min="<?= date('Y-m-d'); ?>" value="<?= $dataPar['data_installation_par'] ?>" <?php if (($_SESSION['role_fon'] == "Technicien") && (trim($dataPar['data_installation_par']) !== "")) { ?>disabled<?php } ?>>

												<?php if (($dataPar['data_installation_par'] !== "") && ($_SESSION['role_fon'] !== "Administrateur")) { ?>
													<input type="hidden" name="dateParOne" value="<?= $dataPar['data_installation_par'] ?>" />
												<?php } ?>

											</div>
										</div>

										<div class="form-group row">
											<label for="heureParOne" class="col-sm-4 col-form-label"> Heure: </label>
											<div class="col-sm-6">
												<input type="time" id="heureParOne" name="heureParOne" class="form-control" value="<?= $dataPar['heure_installation_par'] ?>" <?php if (($_SESSION['role_fon'] == "Technicien") && (trim($dataPar['heure_installation_par']) !== "")) { ?>disabled<?php } ?>>

												<?php if (($dataPar['heure_installation_par'] !== "") && ($_SESSION['role_fon'] !== "Administrateur")) { ?>
													<input type="hidden" name="heureParOne" value="<?= $dataPar['heure_installation_par'] ?>" />
												<?php } ?>

											</div>
										</div>

										<div class="form-group row">
											<label for="etatsondeParOne" class="col-sm-4 col-form-label"> Etat: </label>
											<div class="col-sm-6">
												<select class="form-control custom-select" name="etatsondeParOne" <?php if (($_SESSION['role_fon'] == "Technicien") && (trim($dataPar['etat_sond_installation_par']) !== "")) { ?>disabled<?php } ?>>
													<option selected value="<?= $dataPar['etat_sond_installation_par'] ?>"><?php echo $dataPar['etat_sond_installation_par'] ?> </option>
													<option value="Parfaite">Parfaite</option>
													<option value="Bonne">Bonne</option>
													<option value="Dégradée">Dégradée</option>
													<option value="Endomagée">Endomagée</option>
												</select>

												<?php if (($dataPar['etat_sond_installation_par'] !== "") && ($_SESSION['role_fon'] !== "Administrateur")) { ?>
													<input type="hidden" name="etatsondeParOne" value="<?= $dataPar['etat_sond_installation_par'] ?>" />
												<?php } ?>

											</div>
										</div>

										<div class="form-group row">
											<label for="photoParOne" class="col-sm-4 col-form-label">Photo:</label>
											<div class="col-sm-6">
												<div class="input-group">
													<div class="custom-file">
														<input type="file" class="custom-file-input" id="image2" name="image2" <?php if (($_SESSION['role_fon'] == "Technicien") && (trim($dataPar['photo_sonde_inst_par']) !== "" || trim($dataPar['num_sonde_par']) !== "")) { ?>disabled<?php } ?>>
														<label class="custom-file-label" for="photoParOne">Photo </label>
													</div>
												</div>

												<div style="margin-top: 10px;"></div>
												<div class="progress progress-striped active">
													<div class="progress-bar" style="width:0%"></div>
												</div>
											</div>
										</div>

										<div class="form-group row">
											<label for="piecejointeParOne" class="col-sm-4 col-form-label">Pièce Jointe (Engagement du client):</label>
											<div class="col-sm-6">
												<div class="input-group">
													<div class="custom-file">
														<input type="file" class="custom-file-input" id="image3" name="image3" <?php if (($_SESSION['role_fon'] == "Technicien") && (trim($dataPar['piece_jointe_engagement_par']) !== "" || trim($dataPar['num_sonde_par']) !== "")) { ?>disabled<?php } ?>>
														<label class="custom-file-label" for="piecejointeParOne">Pièce Jointe</label>
													</div>
												</div>

												<div style="margin-top: 10px;"></div>
												<div class="progress progress-striped active">
													<div class="progress-bar" style="width:0%"></div>
												</div>
											</div>
										</div>
									</div>
									<!--  </div> -->
								</div>
								<div class="col-sm-6">
									<!--   <div class="card">  -->
									<div class="card-body">
										<div class="form-group row">
											<label for="dateRecParOne" class="col-sm-8 col-form-label">
												<font color="#1f8383"> Récupération de l'équipement de mesure </font>
											</label>
										</div>
										<hr>

										<div class="form-group row">
											<label for="dateRecParOne" class="col-sm-4 col-form-label"> Date </label>
											<div class="col-sm-6">
												<input type="date" id="dateRecParOne" name="dateRecParOne" class="form-control" min="<?= date('Y-m-d'); ?>" value="<?= $dataPar['data_recuperation_par'] ?>" <?php if (($_SESSION['role_fon'] == "Technicien") && (trim($dataPar['data_recuperation_par']) !== "" || trim($dataPar['num_sonde_par']) == "")) { ?>disabled<?php } ?>>

												<?php if (($dataPar['data_recuperation_par'] !== "") && ($_SESSION['role_fon'] !== "Administrateur")) { ?>
													<input type="hidden" name="dateRecParOne" value="<?= $dataPar['data_recuperation_par'] ?>" />
												<?php } ?>

											</div>
										</div>

										<div class="form-group row">
											<label for="heureRecParOne" class="col-sm-4 col-form-label"> Heure: </label>
											<div class="col-sm-6">
												<input type="time" id="heureRecParOne" name="heureRecParOne" class="form-control" value="<?= $dataPar['heure_recuperation_par'] ?>" <?php if (($_SESSION['role_fon'] == "Technicien") && (trim($dataPar['heure_recuperation_par']) !== "" || trim($dataPar['num_sonde_par']) == "")) { ?>disabled<?php } ?>>

												<?php if (($dataPar['heure_recuperation_par'] !== "") && ($_SESSION['role_fon'] !== "Administrateur")) { ?>
													<input type="hidden" name="heureRecParOne" value="<?= $dataPar['heure_recuperation_par'] ?>" />
												<?php } ?>
											</div>
										</div>

										<div class="form-group row">
											<label for="etatsondeRecParOne" class="col-sm-4 col-form-label"> Etat : </label>
											<div class="col-sm-6">
												<select class="form-control custom-select" name="etatsondeRecParOne" <?php if (($_SESSION['role_fon'] == "Technicien") && (trim($dataPar['etat_sond_recuperation_par']) !== "" || trim($dataPar['num_sonde_par']) == "")) { ?>disabled<?php } ?>>
													<option selected value="<?= $dataPar['etat_sond_recuperation_par'] ?>"><?php echo $dataPar['etat_sond_recuperation_par'] ?> </option>
													<option value="Parfaite">Parfaite</option>
													<option value="Bonne">Bonne</option>
													<option value="Dégradée">Dégradée</option>
													<option value="Endomagée">Endomagée</option>
												</select>

												<?php if (($dataPar['etat_sond_recuperation_par'] !== "") && ($_SESSION['role_fon'] !== "Administrateur")) { ?>
													<input type="hidden" name="etatsondeRecParOne" value="<?= $dataPar['etat_sond_recuperation_par'] ?>" />
												<?php } ?>

											</div>
										</div>

										<div class="form-group row">
											<label for="photoRecParOne" class="col-sm-4 col-form-label">Photo :</label>
											<div class="col-sm-6">
												<div class="input-group">
													<div class="custom-file">
														<input type="file" class="custom-file-input" id="image4" name="image4" <?php if (($_SESSION['role_fon'] == "Technicien") && (trim($dataPar['photo_sonde_recuperation_par']) !== "" || trim($dataPar['num_sonde_par']) == "")) { ?>disabled<?php } ?>>
														<label class="custom-file-label" for="photoRecParOne">Photo </label>
													</div>
												</div>

												<div style="margin-top: 10px;"></div>
												<div class="progress progress-striped active">
													<div class="progress-bar" style="width:0%"></div>
												</div>
											</div>
										</div>

									</div>
									<!--  </div>  -->
								</div>
							</div>

							<!--   SONDE 2  -->
							<div class="row mx-2 mt-3">
								<label class="col-sm-4 col-form-label" for="num_sonde_par">N° de l'équipement de mesure 2</label>
								<div class="col-sm-2">
									<input type="text" id="numsondeParTwo" name="numsondeParTwo" class="form-control" value="<?= $dataPar['num_sondeTwo_par'] ?>" <?php if (($_SESSION['role_fon'] == "Technicien") && (trim($dataPar['num_sondeTwo_par']) !== "" || trim($dataPar['data_recuperation_par']) == "" || trim($dataPar['num_sonde_par']) == "")) { ?>disabled<?php } else { ?> enabled <?php } ?>>

									<?php if (($dataPar['num_sondeTwo_par'] !== "") && ($_SESSION['role_fon'] !== "Administrateur")) { ?>
										<input type="hidden" name="numsondeParTwo" value="<?= $dataPar['num_sondeTwo_par'] ?>" />
									<?php } ?>

								</div>
							</div>

							<div class="row">
								<div class="col-sm-6">
									<!--  <div class="card"> -->
									<div class="card-body">

										<div class="form-group row">
											<label for="dateParTwo" class="col-sm-4 col-form-label">
												<font color="#1f8383"> Installation de l'équipement de mesure </font>
											</label>
										</div>
										<hr>

										<div class="form-group row">
											<label for="dateParTwo" class="col-sm-4 col-form-label"> Date </label>
											<div class="col-sm-6">
												<input type="date" id="dateParTwo" name="dateParTwo" class="form-control" min="<?= date('Y-m-d'); ?>" value="<?= $dataPar['data_installationTwo_par'] ?>" <?php if (($_SESSION['role_fon'] == "Technicien") && (trim($dataPar['data_installationTwo_par']) !== "" || trim($dataPar['data_recuperation_par']) == "" || trim($dataPar['num_sonde_par']) == "")) { ?>disabled<?php } else { ?> enabled <?php } ?>>

												<?php if (($dataPar['data_installationTwo_par'] !== "") && ($_SESSION['role_fon'] !== "Administrateur")) { ?>
													<input type="hidden" name="dateParTwo" value="<?= $dataPar['data_installationTwo_par'] ?>" />
												<?php } ?>

											</div>
										</div>

										<div class="form-group row">
											<label for="heureParOne" class="col-sm-4 col-form-label"> Heure: </label>
											<div class="col-sm-6">
												<input type="time" id="heureParTwo" name="heureParTwo" class="form-control" value="<?= $dataPar['heure_installationTwo_par'] ?>" <?php if (($_SESSION['role_fon'] == "Technicien") && (trim($dataPar['heure_installationTwo_par']) !== "" || trim($dataPar['data_recuperation_par']) == "" || trim($dataPar['num_sonde_par']) == "")) { ?>disabled<?php } else { ?> enabled <?php } ?>>

												<?php if (($dataPar['heure_installationTwo_par'] !== "") && ($_SESSION['role_fon'] !== "Administrateur")) { ?>
													<input type="hidden" name="heureParTwo" value="<?= $dataPar['heure_installationTwo_par'] ?>" />
												<?php } ?>
											</div>
										</div>

										<div class="form-group row">
											<label for="etatsondeParTwo" class="col-sm-4 col-form-label"> Etat : </label>
											<div class="col-sm-6">
												<select class="form-control custom-select" name="etatsondeParTwo" <?php if (($_SESSION['role_fon'] == "Technicien") && (trim($dataPar['etat_sond_installationTwo_par']) !== "" || trim($dataPar['data_recuperation_par']) == "" || trim($dataPar['num_sonde_par']) == "")) { ?>disabled<?php } else { ?> enabled <?php } ?>>
													<option selected value="<?= $dataPar['etat_sond_installationTwo_par'] ?>"><?php echo $dataPar['etat_sond_installationTwo_par'] ?> </option>

													<option value="Neuf">Neuf</option>
													<option value="2ème installation">2ème installation</option>
													<option value="3ème installation">3ème installation</option>
													<option value="4ème installation">4ème installation</option>

													<!-- <option value="Parfaite">Parfaite</option>
													<option value="Bonne">Bonne</option>
													<option value="Dégradée">Dégradée</option>
													<option value="Endomagée">Endomagée</option> -->
												</select>

												<?php if (($dataPar['etat_sond_installationTwo_par'] !== "") && ($_SESSION['role_fon'] !== "Administrateur")) { ?>
													<input type="hidden" name="etatsondeParTwo" value="<?= $dataPar['etat_sond_installationTwo_par'] ?>" />
												<?php } ?>

											</div>
										</div>

										<div class="form-group row">
											<label for="photoParTwo" class="col-sm-4 col-form-label">Photo :</label>
											<div class="col-sm-6">
												<div class="input-group">
													<div class="custom-file">
														<input type="file" class="custom-file-input" id="image22" name="image22" <?php if (($_SESSION['role_fon'] == "Technicien") && (trim($dataPar['photo_sonde_instTwo_par']) !== "" || trim($dataPar['data_recuperation_par']) == "" || trim($dataPar['num_sonde_par']) == "")) { ?>disabled<?php } else { ?> enabled <?php } ?>>
														<label class="custom-file-label" for="photoParTwo">Photo</label>
													</div>
												</div>
												<div style="margin-top: 10px;"></div>
												<div class="progress progress-striped active">
													<div class="progress-bar" style="width:0%"></div>
												</div>
											</div>
										</div>

										<div class="form-group row">
											<label for="piecejointeParTwo" class="col-sm-4 col-form-label">Pièce Jointe (Engagement du client):</label>
											<div class="col-sm-6">
												<div class="input-group">
													<div class="custom-file">
														<input type="file" class="custom-file-input" id="image33" name="image33" <?php if (($_SESSION['role_fon'] == "Technicien") && (trim($dataPar['piece_jointe_engagementTwo_par']) !== "" || trim($dataPar['data_recuperation_par']) == "" || trim($dataPar['num_sondeTwo_par']) !== "")) { ?>disabled<?php } else { ?> enabled <?php } ?>>
														<label class="custom-file-label" for="piecejointeParTwo">Pièce Jointe</label>
													</div>
												</div>

												<div style="margin-top: 10px;"></div>
												<div class="progress progress-striped active">
													<div class="progress-bar" style="width:0%"></div>
												</div>
											</div>
										</div>
									</div>
									<!--  </div> -->
								</div>

								<div class="col-sm-6">
									<!--   <div class="card">  -->
									<div class="card-body">

										<div class="form-group row">
											<label for="dateParTwo" class="col-sm-4 col-form-label">
												<font color="#1f8383">Récupération de l'équipement de mesure </font>
											</label>
										</div>
										<hr>

										<div class="form-group row">
											<label for="dateRecParTwo" class="col-sm-4 col-form-label"> Date </label>
											<div class="col-sm-6">
												<input type="date" id="dateRecParTwo" name="dateRecParTwo" class="form-control" min="<?= date('Y-m-d'); ?>" value="<?= $dataPar['data_recuperationTwo_par'] ?>" <?php if (($_SESSION['role_fon'] == "Technicien") && (trim($dataPar['data_installationTwo_par']) == "" || trim($dataPar['data_recuperationTwo_par']) !== "")) { ?>disabled<?php } else { ?> enabled <?php } ?>>

												<?php if (($dataPar['data_recuperationTwo_par']) && ($_SESSION['role_fon'] !== "Administrateur")) { ?>
													<input type="hidden" name="dateRecParTwo" value="<?= $dataPar['data_recuperationTwo_par'] ?>" />
												<?php } ?>

											</div>
										</div>

										<div class="form-group row">
											<label for="heureRecParTwo" class="col-sm-4 col-form-label"> Heure: </label>
											<div class="col-sm-6">
												<input type="time" id="heureRecParTwo" name="heureRecParTwo" class="form-control" value="<?= $dataPar['heure_recuperationTwo_par'] ?>" <?php if (($_SESSION['role_fon'] == "Technicien") && (trim($dataPar['data_installationTwo_par']) == "" || trim($dataPar['heure_recuperationTwo_par']) !== "")) { ?>disabled<?php } else { ?> enabled <?php } ?>>

												<?php if (($dataPar['heure_recuperationTwo_par']) && ($_SESSION['role_fon'] !== "Administrateur")) { ?>
													<input type="hidden" name="heureRecParTwo" value="<?= $dataPar['heure_recuperationTwo_par'] ?>" />
												<?php } ?>

											</div>
										</div>

										<div class="form-group row">
											<label for="etatsondeRecParTwo" class="col-sm-4 col-form-label"> Etat : </label>
											<div class="col-sm-6">
												<select class="form-control custom-select" name="etatsondeRecParTwo" <?php if (($_SESSION['role_fon'] == "Technicien") && (trim($dataPar['data_installationTwo_par']) == "" || trim($dataPar['etat_sond_recuperationTwo_par']) !== "")) { ?>disabled<?php } else { ?> enabled <?php } ?>>
													<option selected value="<?= $dataPar['etat_sond_recuperationTwo_par'] ?>"><?php echo $dataPar['etat_sond_recuperationTwo_par'] ?> </option>
													<option value="Parfaite">Parfaite</option>
													<option value="Bonne">Bonne</option>
													<option value="Dégradée">Dégradée</option>
													<option value="Endomagée">Endomagée</option>
												</select>

												<?php if (($dataPar['etat_sond_recuperationTwo_par'])  && ($_SESSION['role_fon'] !== "Administrateur")) { ?>
													<input type="hidden" name="etatsondeRecParTwo" value="<?= $dataPar['etat_sond_recuperationTwo_par'] ?>" />
												<?php } ?>
											</div>
										</div>

										<div class="form-group row">
											<label for="photoRecParTwo" class="col-sm-4 col-form-label">Photo :</label>
											<div class="col-sm-6">
												<div class="input-group">
													<div class="custom-file">
														<input type="file" class="custom-file-input" id="image44" name="image44" <?php if (($_SESSION['role_fon'] == "Technicien") && (trim($dataPar['photo_sonde_recuperationTwo_par']) !== "" || trim($dataPar['data_recuperationTwo_par']) !== "" || trim($dataPar['num_sondeTwo_par']) == "")) { ?>disabled<?php } ?>>
														<label class="custom-file-label" for="photoRecParTwo">Photo</label>
													</div>
												</div>

												<div style="margin-top: 10px;"></div>
												<div class="progress progress-striped active">
													<div class="progress-bar" style="width:0%"></div>
												</div>
											</div>
										</div>

									</div>
									<!--  </div>  -->
								</div>
							</div>

						<?php  } ?>

						<div class="container">
							<div class="row mx-5 mb-3 align-items-center ">
								<!-- <div class="col-12"> -->
								<?php if ($_SESSION['role_fon'] == "Technicien" || ($_SESSION['role_fon'] == "Administrateur")) { ?>
									<div class="float-left col-sm-6"> <a href="participation_liste_yes.php" class="previous">&laquo; Annuler</a></div>
									<div class="col-sm-6"> <button type="submit" class="btn btn-secondary float-right " name="signup" id="validateBtn">Soumettre</button> </div>
								<?php   } ?>

								<!-- Final Message -->
								<div class="finalMessage"></div>
								<div class="col-md-12 flr">
									<div class="qloader"></div>
								</div>
								<!-- </div> -->
							</div>
						</div>

				</form>
			</section>

			<!-- Main content -->
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<?php
		require_once 'includes/footer.php';
		?>

		<script>
			$(document).ready(function() {
				$("input[type=radio]").change(function() {
					$("select").removeClass('myVisible myHide');
					if (typeaccesPar1.checked) {
						$('#firstDropdown').addClass('myVisible');
						$('#secondDropdown').addClass('myHide');

					}
					if (typeaccesPar2.checked) {
						$('#firstDropdown').addClass('myHide');
						$('#secondDropdown').addClass('myVisible');

					}
				});

			});
		</script>

		<script src="plugins/bootstrap-validator/js/edit-participation.js"></script>
