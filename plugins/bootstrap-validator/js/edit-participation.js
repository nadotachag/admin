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
            prenomPar: {
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
            nomPar: {
                validators: {
                    notEmpty: {
                        message: '<font color="red">Ce champ est requis</font>'
                    },
                    stringLength: {
                        min: 2,
                        max: 80,
                        message: '<font color="red">Le nom doit comporter plus de 2 caractères et moins de 80 caractères</font>'
                    },
                }
            },
            telPar: {
                validators: {
                    notEmpty: {
                        message: '<font color="red">Ce champ est requis okokok </font>'
                    },
                    stringLength: {
                        min: 2,
                        max: 80,
                        message: '<font color="red">Ce champ doit comporter plus de 2 caractères et moins de 80 caractères</font>'
                    },
                }
            },
            operateurPar: {
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
            villePar: {
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
            cinPar: {
                validators: {
                    notEmpty: {
                        message: '<font color="red">Ce champ est requis</font>'
                    },
                    stringLength: {
                        min: 2,
                        max: 40,
                        message: '<font color="red">Ce champ doit comporter plus de 2 caractères et moins de 40 caractères</font>'
                    },
                }
            },
            typeaccesPar: {
                validators: {
                    stringLength: {
                        min: 2,
                        max: 20,
                        message: '<font color="red">Le type doit comporter plus de 2 caractères et moins de 18 caractères</font>'
                    },
                }
            },
            offreservicePar: {
                validators: {
                    stringLength: {
                        min: 2,
                        max: 20,
                        message: '<font color="red">Le type doit comporter plus de 2 caractères et moins de 18 caractères</font>'
                    },
                }
            },
            numlignePar: {
                validators: {
                    notEmpty: {
                        message: '<font color="red">Ce champ est requis</font>'
                    },
                    phone: {
                        message: '<font color="red">Invalide format</font>',
                        country: 'GB'
                    },
                    stringLength: {
                        min: 2,
                        max: 20,
                        message: '<font color="red">Ce champ doit comporter plus de 2 caractères et moins de 20 caractères</font>'
                    },
                }
            },
            typeclientPar: {
                validators: {
                    stringLength: {
                        min: 2,
                        max: 80,
                        message: '<font color="red">Ce champ doit comporter plus de 2 caractères et moins de 80 caractères</font>'
                    },
                }
            },
            emailPar: {
                validators: {
                    emailAddress: {
                        message: '<font color="red">Invalide format</font>'
                    }
                }
            },

            quartierPar: {
                validators: {
                    stringLength: {
                        min: 2,
                        max: 180,
                        message: '<font color="red">ce champ doit comporter plus de 2 caractères et moins de 180 caractères</font>'
                    },
                }
            },

            // dateParOne: {
            //     validators: {
            //         notEmpty: {
            //             message: '<font color="red">Ce champ est requis</font>'
            //         },
            //     }
            // },
            // dateRecParOne: {
            //     validators: {
            //         notEmpty: {
            //             message: '<font color="red">Ce champ est requis</font>'
            //         },
            //     }
            // },
            /* dateParTwo: {
                validators: {
					notEmpty: {
                        message: '<font color="red">Ce champ est requis</font>'
                    },
                }
            },
            dateRecParTwo: {
                validators: {
					notEmpty: {
                        message: '<font color="red">Ce champ est requis</font>'
                    },
                }
            }, */
            adressePar: {
                validators: {
                    stringLength: {
                        min: 2,
                        max: 280,
                        message: '<font color="red">ce champ doit comporter plus de 2 caractères et moins de 280 caractères</font>'
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

            function uploadImage($form) {
                $form.find('.progress-bar').removeClass('progress-bar-success')
                    .removeClass('progress-bar-danger');

                var formdata = new FormData($form[0]); //formelement
                var request = new XMLHttpRequest();

                //progress event...
                request.upload.addEventListener('progress', function(e) {
                    var percent = Math.round(e.loaded / e.total * 100);
                    $form.find('.progress-bar').width(percent + '%').html(percent + '%');
                });

                //progress completed load event
                request.addEventListener('load', function(e) {
                    $form.find('.progress-bar').addClass('progress-bar-success');
                });

                request.open('post', '/admin/handler/edit-participation.php');
                request.send(formdata);
                request.onreadystatechange = getInfo;

                function getInfo() {
                    if (request.readyState == 4) {
                        var val = request.responseText;
                        $('.finalMessage').html(val);

                        // CLEAR DATA
                        $('.validator-form').data('bootstrapValidator').resetForm(true);
                        $('input[name=image1]').val('');
                        $('input[name=image2]').val('');
                        $('input[name=image3]').val('');
                        $('input[name=image4]').val('');

                        $('input[name=image22]').val('');
                        $('input[name=image33]').val('');
                        $('input[name=image44]').val('');
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
