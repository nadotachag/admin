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
            nomFon: {
                validators: {
                    notEmpty: {
                        message: 'Ce champ est requis'
                    },
                    stringLength: {
                        min: 2,
                        max: 180,
                        message: 'Le nom doit comporter plus de 2 caractères et moins de 180 caractères'
                    },
                }
            },
			prenomFon: {
                validators: {
                    notEmpty: {
                        message: 'Ce champ est requis'
                    },
                    stringLength: {
                        min: 2,
                        max: 180,
                        message: 'Le nom doit comporter plus de 2 caractères et moins de 180 caractères'
                    },
                }
            },
		     emailFon: {
                validators: {
                    emailAddress: {
                        message: 'Invalide format'
                    }
                }
            },
			adresseFon: {
                validators: {
                    notEmpty: {
                        message: 'Ce champ est requis'
                    },
                    stringLength: {
                        min: 2,
                        max: 80,
                        message: 'ce champ doit comporter plus de 2 caractères et moins de 80 caractères'
                    },
                }
            },
			villeFon: {
                validators: {
                    notEmpty: {
                        message: 'Ce champ est requis'
                    },
                    stringLength: {
                        min: 2,
                        max: 80,
                        message: 'Ce champ doit comporter plus de 2 caractères et moins de 80 caractères'
                    },
                }
            },
			paysFon: {
                validators: {
                    notEmpty: {
                        message: 'Ce champ est requis'
                    },
                    stringLength: {
                        min: 2,
                        max: 80,
                        message: 'Ce champ doit comporter plus de 2 caractères et moins de 80 caractères'
                    },
                }
            },
		      telephoneFon: {
                validators: {
                    phone: {
                        message: 'Invalide format',
                        country: 'GB'
                    }
                }
            },
			salaireFon: {
                validators: {
                    notEmpty: {
                        message: 'Ce champ est requis'
                    },
                    numeric: {
                        message: 'Format invalide   '
                    },
                }
            },
			pseudoFon: {
                validators: {
                    notEmpty: {
                        message: 'Ce champ est requis'
                    },
                    stringLength: {
                        min: 2,
                        max: 80,
                        message: 'Ce champ doit comporter plus de 2 caractères et moins de 80 caractères'
                    },
                }
            },
            passwordFon: {
                validators: {
                    notEmpty: {
                        message: 'Ce champ est requis'
                    },
                    stringLength: {
                        min: 2,
                        max: 80,
                        message: 'Ce champ doit comporter plus de 2 caractères et moins de 80 caractères'
                    },
                }
            }
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

              request.open('post', 'handler/add-boitier.php');
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