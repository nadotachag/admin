$(document).ready(function(){
	
  jQuery.validator.setDefaults({
    debug: true,
    success: "valid"
  });

	var vldC = $("#form-send-email");
	  vldC.validate({
	    rules:{
		meprenom:{
	        required: true,
	      },
	      menom:{
	        required: true,
	      },
	      memail:{
	        required: true,
	        email: true
	      },
	      confmemail:{
	        required: false,
	        email: true
	      },
		  mmessage:{
	        required: true,
			minlength: 20
	      }		  
	    },
	    messages:{
		meprenom: {
	        required: "<span style='color:#FF0000'>Ce champ est requis !</span>",	       
	      },
	    menom: {
	        required: "<span style='color:#FF0000'>Ce champ est requis !</span>",	       
	      },
	      memail: {
	        required: "<span style='color:#FF0000'>Ce champ est requis !</span>",
	        email: "<span style='color:#FF0000'>S'il vous plaît, mettez une adresse email valide</span>"
	      },
	      confmemail: {
	        required: "<span style='color:#FF0000'>Ce champ est requis !</span>",
	        email: "<span style='color:#FF0000'>S'il vous plaît, mettez une adresse email valide</span>"
	      },
	      mmessage: {
	        required: "<span style='color:#FF0000'>Ce champ est requis !</span>",
			minlength: "<span style='color:#FF0000'>votre message doit contenir au moins 20 caractères <br> يجب أن تحتوي رسالتكم على 20 حرفا على الأقل</span>"
	      }
		  
	    }
	  });

	$('#btnSendMail').click(function(){
		if(vldC.valid())
		{
			var meprenom = $('#meprenom').val();
			var menom = $('#menom').val();
			var memail = $('#memail').val();
			var typedemande = $('#typedemande').val();
			var meobjet = $('#meobjet').val();
			var mmessage = $('#mmessage').val();

			$('.qloader').show(200);

			$.ajax({
				url: 'handler/contactmail-withclass.php',
				type: 'POST',
				data: {	
				    meprenom: meprenom,
				    menom: menom,
					memail: memail,
					typedemande: typedemande,
					meobjet: meobjet,
					mmessage: mmessage
				},
				success: function(result){
					$('#submit').show();
					$('.finalMessageRequest').html(result);
					$('.qloader-w').hide();
					$('#myModal').modal('show');																				
				}
			});
		}
	});


});