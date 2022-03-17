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
            nomCltSoc: {
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
			cniClt: {
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
			typeClt: {
                validators: {
                    notEmpty: {
                        message: '<font color="red">Ce champ est requis</font>'
                    },
                    stringLength: {
                        min: 2,
                        max: 80,
                        message: '<font color="red">Le prenom doit comporter plus de 2 caractères et moins de 80 caractères</font>'
                    },
                }
            },
		     emailClt: {
                validators: {
                    emailAddress: {
                        message: '<font color="red">Invalide format</font>'
                    }
                }
            },
			adresseClt: {
                validators: {
                    notEmpty: {
                        message: '<font color="red">Ce champ est requis</font>'
                    },
                    stringLength: {
                        min: 2,
                        max: 180,
                        message: '<font color="red">ce champ doit comporter plus de 2 caractères et moins de 180 caractères</font>'
                    },
                }
            },
			villeClt: {
                validators: {
                    notEmpty: {
                        message: '<font color="red">Ce champ est requis</font>'
                    },
                    stringLength: {
                        min: 2,
                        max: 80,
                        message: '<font color="red">Ce champ doit comporter plus de 2 caractères et moins de 80 caractères</font>'
                    },
                }
            },
			paysClt: {
                validators: {
                    notEmpty: {
                        message: '<font color="red">Ce champ est requis</font>'
                    },
                    stringLength: {
                        min: 2,
                        max: 80,
                        message: '<font color="red">Ce champ doit comporter plus de 2 caractères et moins de 80 caractères</font>'
                    },
                }
            },
		    telephoneClt: {
                validators: {
                    phone: {
                        message: '<font color="red">Invalide format</font>',
                        country: 'GB'
                    }
                }
            },
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

              //progress completed load event
              request.addEventListener('load',function(e){
                $form.find('.progress-bar').addClass('progress-bar-success');
              });

              request.open('post', 'handler/edit-client.php');
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