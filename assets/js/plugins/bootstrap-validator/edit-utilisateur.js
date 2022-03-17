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
            nom: {
                validators: {
                    notEmpty: {
                        message: 'Ce champ est requis'
                    },
                    stringLength: {
                        min: 2,
                        message: 'au moins 2 caractères'
                    },
                }
            },
            prenom: {
                validators: {
                    notEmpty: {
                        message: 'Ce champ est requis'
                    },
                    stringLength: {
                        min: 2,
                        message: 'Au moins 2 caractères'
                    },
                }
            },
            motdepasse: {
                validators: {
                    identical: {
                        field: 'remotdepasse',
                        message: 'Le mot de passe et sa confirmation ne sont pas les mêmes'
                    }
                }
            },
            remotdepasse: {
                validators: {
                    identical: {
                        field: 'motdepasse',
                        message: 'Le mot de passe et sa confirmation ne sont pas les mêmes'
                    }
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

              var formdata = new FormData($form[0]); //formelement
              var request = new XMLHttpRequest();

              //progress completed load event
              request.addEventListener('load',function(e){
                $form.find('.progress-bar').addClass('progress-bar-success');
              });

              request.open('post', 'handler/edit-utilisateur.php');
              request.send(formdata);
              request.onreadystatechange = getInfo;

                function getInfo() {
                    if (request.readyState == 4) {
                        var val = request.responseText;
                        $('.finalMessage').html(val);
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