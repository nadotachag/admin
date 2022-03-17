
  
  <footer class="bg-light text-center text-lg-start">
  <!-- Copyright -->
  <div class="float-right d-none d-sm-block">
    <!--  <b>Version</b> 3.0.1  -->
    </div>
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
    <font color="#a7a7a7" style="font-size: 16px">Copyright &copy; <?php echo date("Y"); ?> </font><a href="https://anrt.ma/" style="font-size: 16px">ANRT</a>.
  </div>
  
 
  
  <!-- Copyright -->
</footer>

<!-- ./wrapper -->

	<!-- jQuery Version 1.11.1 -->
	 <script src="../js/jquery.js"></script>
	<script src="../plugins/jquery/jquery.min.js"></script>
	   <!-- Select2 -->
    <script src="../plugins/select2/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

		<!--
	<script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert2.min.js"></script>
   -->

<!-- jQuery -->
    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>


<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>


	<!-- FullCalendar -->
	<script src='../js/moment.min.js'></script>
	<script src='../js/fullcalendar.min.js'></script>

<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>

<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<!-- page script DataTables -->
<script>
  $(function () {
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

<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>

  <!-- Bootstrap Validator -->
    <script src="../plugins/bootstrap-validator/js/bootstrapValidator.min.js"></script>
   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script> -->
   




<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })
</script>
 
 <!--   
    <script>
    $(document).ready(function () {
        $('.selectpicker').selectpicker();
    })
</script>
-->

</body>
</html>