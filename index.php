<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(isset ($_SESSION['id_fon']))
{
    echo '<script>window.location="./participation_liste_yes.php"</script>';
}
?>
<!DOCTYPE html>
<html>
<?php
require_once 'includes/header.php';
?>
<body class="hold-transition login-page">
<style>
    #form-connect .input-group{
        position: relative;
    }
    #form-connect .input-group .form-validation{
        position: absolute;
        color: red;
        font-size: 12px;
        font-weight: bold;
        left: 1px;
        bottom: -16px;
    }
    .loader{
        display: none;
    }
    .messageError {
        color: red;
        font-size: 12px;
    }

    label,
    input,
    button {
        border: 0;
        margin-bottom: 3px;
        display: block;
        width: 100%;
    }
</style>
  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b>Espace Administration</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Connectez-vous à votre session</p>

        <form id="form-connect" name="form-connect" method="post" action="login.php">
          <div class="input-group mb-3">
            <input type="email" id="email" name="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" id="passe" name="passe">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <!-- <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
              -->
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block" id="getConnect">Connecter</button>
            </div>
            <!-- /.col -->
          </div>

          <div class="loader">Loader ...</div>
          <div class="finalMessage"></div>

        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!--  <script src="assets/js/jquery.validate.min.js"></script>-->
<!-- Bootstrap 4 -->
<script src="assets/js/plugins/underscore/underscore-min.js"></script>
<script src="assets/js/bootstrap/bootstrap.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('body').on('submit','#form-connect',function (e) {
            let me = $(this),
                data = me.serialize(),
                method = me.attr('method'),
                action = me.attr('action');
            $.ajax({
                url : action,
                data : data,
                method : method,
                dataType : 'json',
                beforeSend : function () {
                    $('.loader').show(200);
                    $('.form-validation').remove();
                },
                success : function (result) {
                    if('form_validation' in result){
                        $.each(result.form_validation, function (element,msg) {
                            $('#'+element).after(msg);
                        });
                    }else{
                        $('.finalMessage').html(result.msg);
                        if('redirect' in result){
                            window.location.href = result.redirect;
                        }
                    }
                    console.log(result);
                    $('.loader').hide(200);
                },
                error : function (xhr) {
                    console.log(xhr);
                }
            });
            e.preventDefault();
        });
    });
</script>
</body>
</html>
