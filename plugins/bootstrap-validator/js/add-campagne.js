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
            nomCpg: {
                validators: {
                    notEmpty: {
                        message: '<font color="red">Ce champ est requis </font>'
                    },
                    stringLength: {
                        min: 2,
                        max: 80,
                        message: '<font color="red">Le nom doit comporter plus de 2 caractères et moins de 80 caractères</font>'
                    },
                }
            },
			dateDebutCpg: {
                validators: {
                    notEmpty: {
                        message: '<font color="red">Ce champ est requis </font>'
                    },
                    stringLength: {
                        min: 2,
                        max: 24,
                        message: '<font color="red">La date doit comporter au moins de 10 caractères</font>'
                    },
                }
            },
            dateDebutFinCpg: {
                validators: {
                    notEmpty: {
                        message: '<font color="red">Ce champ est requis </font>'
                    },
                    stringLength: {
                        min: 2,
                        max: 24,
                        message: '<font color="red">La date doit comporter au moins de 10 caractères</font>'
                    },
                }
            },
			"villeCp[]": {
                validators: {
                    notEmpty: {
                        message: '<font color="red">Ce champ est requis </font>'
                    },
                    stringLength: {
                        min: 1,
                        max: 80,
                        message: '<font color="red">Selectionner au moin une ville </font>'
                    },
                }
            },
			"operateurCp[]": {
                validators: {
                    notEmpty: {
                        message: '<font color="red">Ce champ est requis </font>'
                    },
                    stringLength: {
                        min: 1,
                        max: 80,
                        message: '<font color="red">Selectionner au moin un opérateur </font>'
                    },
                }
            },
			
        },
        onSuccess: function(e, data) {

            // show loader
            $('.qloader').show();

            e.preventDefault()
            $form = $('#form');
           // uploadImage($form);

          //  function uploadImage($form){

              var formdata = new FormData($form[0]); //formelement
              var request = new XMLHttpRequest();

     

              request.open('post', 'handler/add-campagne.php');
              request.send(formdata);
              request.onreadystatechange = getInfo;

                function getInfo() {
                    if (request.readyState == 4) {
                        var val = request.responseText;
                        $('.finalMessage').html(val);
                        // CLEAR DATA
                        $('.validator-form').data('bootstrapValidator').resetForm(true);
                        $('input[type=textarea]').val('');
                        // CLEAR
                        $('.qloader').hide();
                    }
                }
           // }
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