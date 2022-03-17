<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

<!-- jQuery Version 1.11.1 -->
<footer class="bg-light text-center text-lg-start">
  <!-- Copyright -->
  <div class="float-right d-none d-sm-block">
    <!--  <b>Version</b> 3.0.1  -->
  </div>
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
    <font color="#a7a7a7" style="font-size: 16px">Copyright &copy; <?php echo date("Y"); ?></font><a href="https://anrt.ma/" style="font-size: 16px">ANRT</a>.
  </div>
  <!-- Copyright -->
</footer>


<!-- jQuery -->
<!-- Bootstrap Core JavaScript -->
<script src="js/jquery.js"></script>
<script src="js/bootbox.min.js"></script>

<script>
  $(document).ready(function() {
    $('.resend_mail').click(function(e) {
      e.preventDefault();
      var pid = $(this).attr('data-id');
      var parent = $(this).parent("td").parent("tr");

      bootbox.dialog({
        title: "<i class='fa fa-paper-plane'></i> Renvoyer Email !",
        message: "<p>Voulez-vous envoyer un message de confirmation d'adresse Email à ce volontaire ?</p>",
        //size: 'small',
        // onEscape: true,
        // backdrop: true,
        buttons: {
          fum: {
            label: 'Annuler',
            className: 'btn-danger',
            callback: function() {

            }
          },
          fo: {
            label: 'Renvoyer',
            className: 'btn-success',
            callback: function() {
              $.ajax({

                  type: 'POST',
                  url: 'resendmail.php',
                  data: 'resend=' + pid

                })
                .done(function(response) {

                  bootbox.alert(response);
                  // parent.fadeOut('slow');

                })
                .fail(function() {

                  bootbox.alert("Une erreur s'est produite. Veuillez réessayer ....");

                })
            }
          }
        }
      })
    });
  });
</script>


<script>
  $(document).ready(function() {
    $("#myModal").modal({
      keyboard: true,
      backdrop: "static",
      show: false,

    }).on("show.bs.modal", function(event) {
      var button = $(event.relatedTarget); // button the triggered modal
      var personId = button.data("id"); //data-id of button which is equal to id (primary key) of person
      var lastName = $(event.relatedTarget).closest("tr").find("td:eq(1)").text();
      var firstName = $(event.relatedTarget).closest("tr").find("td:eq(2)").text();

      //displays values to modal
      $(this).find("#personDetails").html($("<b>ID: " + personId + "<br>Last Name: " + lastName + "<br>First Name: " + firstName + "</b>"))
    }).on("hide.bs.modal", function(event) {
      $(this).find("#personDetails").html("");
    });
  });
</script>

<script>
  $(document).ready(function() {

    $('.affect_vol').click(function(e) {

      e.preventDefault();

      var Insid = $(this).attr('data-id');
      var parent = $(this).parent("td").parent("tr");
      var idf = $(this).attr('href').replace('#', '');
      // var idf ="salam";
      var data = "cofsend=" + Insid + "&idf=" + idf;

      bootbox.dialog({
        title: "<i class='fa fa-user-plus'></i> Affecter volontaire !",
        message: "<p>Voulez-vous affecter le volontaire n°" + Insid + " à cette campagne ?</p>",
        //size: 'small',
        onEscape: true,
        backdrop: true,
        buttons: {
          fum: {
            label: 'Annuler',
            className: 'btn-danger',
            callback: function() {

            }
          },
          fo: {
            label: 'Affecter',
            className: 'btn-success',
            callback: function() {
              $.ajax({

                  type: 'POST',
                  url: 'confirm_affectation.php',
                  data: data,

                })
                .done(function(response) {
                  bootbox.alert(response);
                  // parent.fadeOut('slow');
                })
                .fail(function() {
                  bootbox.alert("Une erreur s'est produite. Veuillez réessayer ....");
                })
            }
          }
        }
      })
    });
  });
</script>



<script>
  $(document).ready(function() {

    $('.no_affect_vol').click(function(e) {

      e.preventDefault();

      var Insid = $(this).attr('data-id');
      var parent = $(this).parent("td").parent("tr");
      var idf = $(this).attr('href').replace('#', '');
      // var idf ="salam";
      var data = "cofsend=" + Insid + "&idf=" + idf;

      bootbox.dialog({
        title: "<i class='fa fa-user-plus'></i> Affecter volontaire !",
        message: "<p align='justify'> <i class='fa fa-info-circle fa-lg' aria-hidden='true'></i>  Impossible d'affecter le volontaire N°" + Insid + " à cette campagne: les données personnelles du volontaire ne sont pas encore validées</p>",
        //size: 'small',
        onEscape: true,
        backdrop: true,
        buttons: {
          fum: {
            label: 'OK',
            className: 'btn-danger',
            callback: function() {}
          },
        }
      })
    });
  });
</script>

<script>
  $(document).ready(function() {

    $('.delete_vol_cp').click(function(e) {

      e.preventDefault();

      var Insid = $(this).attr('data-id');
      var parent = $(this).parent("td").parent("tr");
      var idf = $(this).attr('href').replace('#', '');
      var data = "cofsend=" + Insid + "&idf=" + idf;
      bootbox.dialog({
        title: "<i class='fa fa-user-minus'></i> Supprimer volontaire !",
        message: "<p> Voulez-vous supprimer le volontaire n°" + Insid + " de cette campagne ?</p>",
        //size: 'small',
        onEscape: true,
        backdrop: true,
        buttons: {
          fum: {
            label: 'Annuler',
            className: 'btn-success',
            callback: function() {}
          },
          fo: {
            label: 'Supprimer',
            className: 'btn-danger',
            callback: function() {
              $.ajax({

                  type: 'POST',
                  url: 'handler/delete_affectation.php',
                  data: data,

                })
                .done(function(response) {

                  bootbox.alert(response);
                  // parent.fadeOut('slow');

                })
                .fail(function() {

                  bootbox.alert("Une erreur s'est produite. Veuillez réessayer ....");

                })
            }
          }
        }
      })
    });
  });
</script>

<script>
  $(document).ready(function() {
    $('.content').on('click', '.delete', function(e) {
      e.preventDefault();
      if (confirm("Êtes-vous sûr de vouloir supprimer?!")) {
        var idf = $(this).attr('href').replace('#', '');
        $(this).parent().parent().hide(200);
        $.ajax({
          url: 'handler/delete-participation.php',
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


<script src="js/bootstrap.min.js"></script>

<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- FullCalendar -->
<script src='js/moment.min.js'></script>
<script src='js/fullcalendar.min.js'></script>


<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    bsCustomFileInput.init();
  });
</script>

<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<!-- page script DataTables -->
<script>
  $(function() {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>

<script>
  // $(document).bind("contextmenu", function(e) {
  //   e.preventDefault();
  // });

  $(document).keydown(function(e) {
    if (e.which === 123) {
      return false;
    }
  });
</script>

<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<!-- Bootstrap Validator -->
<script src="plugins/bootstrap-validator/js/bootstrapValidator.min.js"></script>

</body>

</html>
