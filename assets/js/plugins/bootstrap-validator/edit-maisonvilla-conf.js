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
			categoriemv: {
					validators: {
							notEmpty: {
								message: 'Ce champ est requis'
							},
							stringLength: {
								min: 2,
								max: 18,
								message: 'Le nom doit comporter plus de 2 caractères et moins de 18 caractères'
							},
						}
					},
            titremv: {
                validators: {
                    notEmpty: {
                        message: 'Ce champ est requis'
                    },
                    stringLength: {
                        min: 2,
                        max: 80,
                        message: 'Le nom doit comporter plus de 2 caractères et moins de 20 caractères'
                    },
                }
            },
            superficiemv: {
                validators: {
                    notEmpty: {
                        message: 'Ce champ est requis'
                    },
                    numeric: {
                        message: 'Format invalide   '
                    },
                }
            },
            prixmv: {
                validators: {
                    notEmpty: {
                        message: 'Ce champ est requis'
                    },
                    numeric: {
                        message: 'Format invalide   '
                    },
                }
            },
			villemv: {
                validators: {
                    notEmpty: {
                        message: 'Ce champ est requis'
                    },
                    stringLength: {
                        min: 2,
                        max: 60,
                        message: 'Le nom doit comporter plus de 2 caractères et moins de 60 caractères'
                    },
                }
            },
			 nbrChambremv: {
                validators: {
                    notEmpty: {
                        message: 'Ce champ est requis'
                    },
                    numeric: {
                        message: 'Format invalide   '
                    },
                }
            },
            adressemv: {
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
            descrmv: {
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

              //progress completed load event
              request.addEventListener('load',function(e){
                $form.find('.progress-bar').addClass('progress-bar-success');
              });

              request.open('post', 'handler/edit-maisonvilla.php');
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