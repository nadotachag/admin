$(document).ready(function() {

    $('.validator-form').bootstrapValidator({
//      live: 'disabled',
        message: 'This value is not valid',
        feedbackIcons: {
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            adresse: {
                validators: {
                    notEmpty: {
                        message: 'Ce champ est requis'
                    }
                }
            },
            email: {
                validators: {
                    emailAddress: {
                        message: 'Invalide format'
                    }
                }
            },
            gsm: {
                validators: {
                    phone: {
                        message: 'Invalide format',
                        country: 'GB'
                    }
                }
            },
            tel: {
                validators: {
                    phone: {
                        message: 'Invalide format',
                        country: 'GB'
                    }
                }
            },
            fax: {
                validators: {
                    phone: {
                        message: 'Invalide format',
                        country: 'GB'
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

              request.open('post', 'handler/edit-contact.php');
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