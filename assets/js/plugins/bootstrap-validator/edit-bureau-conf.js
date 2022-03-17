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
            titreBur: {
                validators: {
                    notEmpty: {
                        message: 'Ce champ est requis'
                    },
                    stringLength: {
                        min: 2,
                        max: 80,
                        message: 'Le nom doit BurporBur plus de 2 caractères et moins de 20 caractères'
                    },
                }
            },
            superficieBur: {
                validators: {
                    notEmpty: {
                        message: 'Ce champ est requis'
                    },
                    numeric: {
                        message: 'Format invalide   '
                    },
                }
            },
            prixBur: {
                validators: {
                    notEmpty: {
                        message: 'Ce champ est requis'
                    },
                    numeric: {
                        message: 'Format invalide   '
                    },
                }
            },
			villeBur: {
                validators: {
                    notEmpty: {
                        message: 'Ce champ est requis'
                    },
                    stringLength: {
                        min: 2,
                        max: 60,
                        message: 'Le nom doit BurporBur plus de 2 caractères et moins de 60 caractères'
                    },
                }
            },
            adresseBur: {
                validators: {
                    notEmpty: {
                        message: 'Ce champ est requis'
                    },
                    stringLength: {
                        min: 20,
                        message: 'au moins 20 caractères'
                    },
                }
            },
            descrBur: {
                validators: {
                    notEmpty: {
                        message: 'Ce champ est requis'
                    },
                    stringLength: {
                        min: 20,
                        message: 'au moins 20 caractères'
                    },
                }
            }
        },
        onSuccess: function(e, data) {

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

              //progress Burpleted load event
              request.addEventListener('load',function(e){
                $form.find('.progress-bar').addClass('progress-bar-success');
              });

              request.open('post', 'handler/edit-bureau.php');
              request.send(formdata);
              request.onreadystatechange = getInfo;

                function getInfo() {
                    if (request.readyState == 4) {
                        var val = request.responseText;
                        $('.finalMessage').html(val);
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