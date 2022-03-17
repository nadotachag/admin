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
            titre: {
                validators: {
                    notEmpty: {
                        message: 'Ce champ est requis'
                    },
                    stringLength: {
                        min: 2,
                        max: 200,
                        message: 'Le titre doit comporter plus de 2 caractères et moins de 200 caractères'
                    },
                }
            },
            titreAr: {
                validators: {
                    notEmpty: {
                        message: 'هذا الحقل مطلوب'
                    },
                    stringLength: {
                        min: 2,
                        max: 200,
                        message: 'يجب أن يكون العنوان أطول من حرفين وأقل من 200 حرفا'
                    },
                }
            },
            descr: {
                validators: {
                    notEmpty: {
                        message: 'Ce champ est requis'
                    },
                    stringLength: {
                        min: 2,
                        max: 200,
                        message: 'Desc. doit comporter plus de 2 caractères et moins de 200 caractères'
                    },
                }
            },
            descrAr: {
                validators: {
                    notEmpty: {
                        message: 'هذا الحقل مطلوب'
                    },
                    stringLength: {
                        min: 2,
                        max: 200,
                        message: 'يجب أن يكون الوصف أطول من حرفين وأقل من 200 حرفا'
                    },
                }
            }
        },
        onSuccess: function(e, data) {
            var titre = $('#titre').val();
            var descr = $('#descr').val();
            var titreAr = $('#titreAr').val();
            var descrAr = $('#descrAr').val();

            e.preventDefault();

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

              request.open('post', 'handler/add-slide.php');
              request.send(formdata);
              request.onreadystatechange = getInfo;

                function getInfo() {
                    if (request.readyState == 4) {
                        var val = request.responseText;
                        $('.finalMessage').html(val);

                        // CLEAR DATA.
                        $('.validator-form').data('bootstrapValidator').resetForm(true);
                        $('input[name=image]').val('');
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