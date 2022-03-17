$(document).ready(function() {

    $('.validator-form').bootstrapValidator({
//      live: 'disabled',
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            titreApf: {
                validators: {
                    notEmpty: {
                        message: 'Ce champ est requis'
                    },
                    stringLength: {
                        min: 2,
                        max: 80,
                        message: '<font color="red">Le nom doit comporter plus de 2 caractères et moins de 80 caractères</font>'
                    },
                }
            },
			descriptionApf: {
                validators: {
                    notEmpty: {
                        message: 'Ce champ est requis'
                    },
                    stringLength: {
                        min: 2,
                        max: 80,
                        message: '<font color="red">Le nom doit comporter plus de 2 caractères et moins de 80 caractères</font>'
                    },
                }
            },
			clientApf: {
                validators: {
                    notEmpty: {
                        message: '<font color="red">Ce champ est requis</font>'
                    },
                }
            },
			dateApf: {
                validators: {
                    notEmpty: {
                        message: '<font color="red">Ce champ est requis</font>'
                    },
                }
            },
			
        },
        onSuccess: function(e, data) {

            // show loader
            $('.qloader').show();

            e.preventDefault()
            $form = $('#form');
            uploadImage($form);

            function uploadImage($form){
              $form.find('.progress-bar').removeClass('progress-bar-success')
                            .removeClass('progress-bar-danger');

              var formdata = new FormData($form[0]); //formelement
              var request = new XMLHttpRequest();

              //progress event...
              request.upload.addEventListener('progress',function(e){
                var percent = Math.round(e.loaded/e.total * 100);
                $form.find('.progress-bar').width(percent+'%').html(percent+'%');
              });

              //progress completed load event
              request.addEventListener('load',function(e){
                $form.find('.progress-bar').addClass('progress-bar-success');
              });

              request.open('post', 'handler/add-appel-offre.php');
              request.send(formdata);
              request.onreadystatechange = getInfo;

                function getInfo() {
                    if (request.readyState == 4) {
                        var val = request.responseText;
                        $('.finalMessage').html(val);

                        // CLEAR DATA
                        $('.validator-form').data('bootstrapValidator').resetForm(true);
                        $('input[name=image1]').val('');
                        $('input[type=textarea]').val('');

                        // CLEAR
                        $('.qloader').hide();
                    }
                }
            }
        }
    });

    // Validate the form manually
    $('#validateBtn').click(function() {
        $('.validator-form').bootstrapValidator('validate');

    });

	// Reset the validation
    $('#resetBtn').click(function() {
        $('.validator-form').data('bootstrapValidator').resetForm(true);
        $('input[name=image]').val('');
    });
	
});