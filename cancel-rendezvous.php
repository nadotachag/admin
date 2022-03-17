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

//echo '<pre>';
//print_r($rdv);
//echo '</pre>';
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
                            <font color="#c21f37"> Annuler le rendez-vous </font>
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
                            <form method="post" class="validator-form-rdv" action="actions/cancel_rendezvous.php"
                                  id="add_rendezvous">
                                <input type="hidden" name="id_rdv" value="<?= $rdv['id_rdv'];?>">

                                <div class="form-group row">
                                    <label for="raisonAnnulation" class="col-sm-4 col-form-label"> Raison d'annulation
                                    </label>
                                    <textarea id="raisonAnnulation" name="raisonAnnulation" class="form-control"
                                              rows="4"><?= $rdv['raisonAnnulation'];?></textarea>
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
                    <button type="submit" class="btn btn-success float-right" name="add_rendezvous"
                            id="add_rendezvous_Btn">Annuler le rendez-vous</button>

                    <!-- Final Message -->
                    <div class="finalMessage"></div>
                    <div class="col-md-10 flr">
                        <div class="loader">Loading ...</div>
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
