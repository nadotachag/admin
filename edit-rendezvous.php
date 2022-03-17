<?php
include('authen.php');
require_once 'includes/navbar.php';
require_once '../admin/includes/headerRendezVous.php';
include('../admin/includes/connection.php');
include('includes/rendezVous.php');
include('../admin/includes/participation.php');

$_PAR = new Participation();
$_RDV = new rendezVous();


if(isset($_REQUEST['idrdv']) && !empty($_REQUEST['idrdv']) && is_numeric($_REQUEST['idrdv'])){
    $idrdv = $_REQUEST['idrdv'];
    $rdv = $_RDV->getRendezVousByID($idrdv);
    $participations = $_PAR->getParticipations();

}else{
    echo '<script>window.location.href="/admin/add-rendezvous.php"</script>';
}

$techniciens = $_RDV->getAllTechniciens();
$countTech = $_RDV->countAllTechniciens();

?>

<style>
    .select2-container--default .select2-purple .select2-selection--multiple .select2-selection__choice,
    .select2-purple .select2-container--default .select2-selection--multiple .select2-selection__choice {
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
                        <h4>
                            <font color="#c21f37"> Modifier le rendez-vous </font>
                        </h4>
                    </div>
                    <!-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Rendez-Vous</a></li>
                      <li class="breadcrumb-item active">Ajouter un rendez-vous </li>
                    </ol>
                  </div> -->
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-10">
                    <div class="card card-primary">
                        <div class="card-header">

                            <div id="Volontaire-number">
                                <?php if(isset($rdv)): ?>
                                    <h3 class="card-title">Rendez-vous n° <?php echo $rdv['id_rdv'] ?></h3>
                                <?php endif; ?>
                            </div>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" class="validator-form-rdv" action="actions/update_rendezvous.php"
                                  id="add_rendezvous">
                                <input type="hidden" name="id_rdv" value="<?= $rdv['id_rdv'];?>">
                                <div class="form-group">
                                    <label for="nomCpg" class="col-sm-7">Nom et Prénom</label>
                                    <?php if(isset($dataVol)): ?>

                                        <input type="text" class="form-control" value="<?php echo $dataVol['nom_par'] . ' ' . $dataVol['prenom_par']; ?>" readonly>
                                        <input type="hidden" id="nomCpg" name="nomCpg" value="<?php echo $dataVol['num_volontaire']; ?>" >
                                    <?php else: ?>

                                        <select type="text" name="nomCpg" id="nomCpg" class="form-control">
                                            <option value="">Les participants</option>
                                            <?php
                                            foreach ($participations as $parti){
                                                if($parti['num_volontaire'] == $rdv['volontaire']){
                                                    echo '<option  selected="" value="'.$parti['num_volontaire']
                                                        .'">'.
                                                        $parti['nom_par'] . ' ' . $parti['prenom_par'].'</option>';
                                                }else{
                                                    echo '<option  value="'.$parti['num_volontaire'].'">'. $parti['nom_par'] . ' ' . $parti['prenom_par'].'</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label for="objetRdv" class="col-sm-7">Objet </label>
                                    <div class="">
                                        <select class="form-control" name="objetRdv" id="objetRdv" data-placeholder="Séléctionner l'objet du rendez-vous">
                                            <option value="">Selectionner un objet</option>
                                            <option <?= $rdv['objet'] == "Installation" ? 'Selected' :'' ;
                                            ?> value="Installation">Installation de
                                                l'appareil de
                                                mesure</option>
                                            <option <?= $rdv['objet'] == "Desinstallation" ? 'Selected' : '' ;
                                            ?> value="Desinstallation">Désinstallation de l'appareil de
                                                mesure</option>
                                            <option <?= $rdv['objet'] == "Maintenance" ? 'Selected' : '' ;
                                            ?> value="Maintenance">Maintenance</option>
                                            <option <?= $rdv['objet'] == "Autre" ? 'Selected' : '' ;
                                            ?> value="Autre">Autre</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="heure_rdv" class="col-sm-7">Créneau horaire </label>
                                    <div class="">
                                        <select class="form-control" name="heure_rdv" id="heure_rdv" data-placeholder="Séléctionner l'objet du rendez-vous">
                                            <option value="">Selectionner l'horaire</option>
                                            <option <?= $rdv['heure_rdv'] == "08:00:00" ? 'Selected' : '' ;
                                            ?> value="08:00:00">Matinée  de 8h à 12h</option>
                                            <option <?= $rdv['heure_rdv'] == "14:00:00" ? 'Selected' : '' ;
                                            ?> value="14:00:00">Après midi de 14h à 18h</option>
                                            <option <?= $rdv['heure_rdv'] == "18:00:00" ? 'Selected' : '' ;
                                            ?> value="18:00:00">After work apres 18h</option>
                                        </select>
                                    </div>
                                </div>

                                <?php
                                $today = date("Y-m-d");
                                ?>

                                <div class="form-group">
                                    <label for="dateRdv" class="col-sm-7">Date </label>
                                    <input type="date"
                                           id="dateRdv"
                                           name="dateRdv"
                                           class="form-control"
                                           value="<?= $rdv['date_rdv']?>"
                                           min='<?php echo $today ?>'
                                           onchange="checkDate()">

                                    <!-- <div class="dateDebutMessage"></div> -->
                                </div>

                                <div class="form-group">
                                    <label for="technicienRdv">Technicien intervenant </label>
                                    <select class="form-control" name="technicienRdv" id="technicienRdv" data-placeholder="Affecter le technicien">
                                        <option value="">Selectionner un Technicien intervenant</option>
                                        <?php for($i=0; $i<$countTech;$i++) { ?>
                                            <option <?= $techniciens[$i]['id_fon'] == $rdv['technicien'] ? 'Selected' : '' ;
                                            ?> value="<?php echo $techniciens[$i]['id_fon'] ?>"> <?php echo
                                                    $techniciens[$i]['nom_fon'].' '.$techniciens[$i]['prenom_fon'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group row">
                                    <label for="commentaireCp" class="col-sm-4 col-form-label"> Commentaire </label>
                                    <textarea id="commentaireCp" name="commentaireCp" class="form-control"
                                              rows="4"><?= $rdv['comment_rdv'];?></textarea>
                                </div>
                                <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div>

            <div class="row">
                <div class="col-10">
                    <button type="submit" class="btn btn-success float-right" name="add_rendezvous" id="add_rendezvous_Btn">Ajouter</button>

                    <!-- Final Message -->
                    <div class="finalMessage"></div>
                    <div class="col-md-10 flr">
                        <div class="loader">Loadind ...</div>
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

    <style>
        .form-validation{
            color: red;
            font-size: 13px;
        }
        .loader{
            display: none;
        }
    </style>

    <script>
        $('body').on('change','#nomCpg',function () {
            let me = $(this),
                selectedId = me.children("option:selected").val();
            $('#Volontaire-number').html('<h3 class="card-title">Volontaire n°'+ selectedId +'</h3>');
        });

        $('body').on('submit','#add_rendezvous',function (e) {
            let me = $(this),
                action = me.attr('action'),
                method = me.attr('method'),
                data = me.serialize();
            $.ajax({
                url : action,
                method : method,
                data : data,
                dataType : 'json',
                beforeSend : function(){
                    $('.loader').show(200);
                    $('.form-validation').remove();
                },
                success : function (result) {
                    $('.loader').hide(200);
                    if('form_validation' in result){
                        $.each(result.form_validation, function (element,msg) {
                            $('#'+element).after(msg);
                        });
                    }else{
                        if('msg' in result){
                            $('.finalMessage').html(result.msg);
                        }
                        if('redirect' in result){
                            window.location.href = result.redirect;
                        }
                    }
                },
                error : function (xhr) {
                    console.log(xhr.responseText);
                }
            });
            e.preventDefault();
        });
    </script>

    <script>
        function checkDate() {
            var dataForm = document.forms['form'];
            var startDate = new Date(dataForm['dateDebutCpg'].value);
            var startTime = new Date(dataForm['dateFinCpg'].value);

            date1 = new Date();
            var nowdate = date1.setHours(0, 0, 0, 0)

            if (startDate < nowdate) {
                var valdebutdate = "<font color='red'>La date de début ne peut pas être antérieure à la date d'aujourd'hui </font>";
                $('.dateDebutMessage').html(valdebutdate);
                document.getElementById('dateDebutCpg').value = "";
            } else {
                var val = "";
                $('.dateDebutMessage').html(val);
            }

            if (startDate >= endDate) {
                var val = "<font color='red'>La date de fin ne peut pas être antérieure à la date de début !</font>";
                $('.dateMessage').html(val);
                document.getElementById('dateFinCpg').value = "";
            } else {
                var val = "";
                $('.dateMessage').html(val);
            }
        }
    </script>
