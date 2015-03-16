$(document).ready(function()
{
	$('#nomTest').keyup(function(event)
		{
			var texte=$("#nomTest").val();
			if ($.trim(texte).length<6){
				
				if(texte===""){
					$('#message').removeClass("valide");
					$('#message').removeClass("invalide");
					$('#message').hide();
					return;
				}

					console.log("affiche !");
					$('#messageNom').text("Ce champ doit contenir au moins 6 caractères");
					$('#messageNom').addClass('invalide');
					$('#messageNom').show();
					$('#messageNom').removeClass('valide');
			}
				else
				{
					$('#messageNom').removeClass('invalide');
					console.log("remove !");
					$('#messageNom').addClass('valide');
					console.log("add !");
					$('#messageNom').text("Champ valide");
					$('#messageNom').show();

					
				}

			

		});
		
		
		
		
		
		
		
	$('#pathoTest').keyup(function(event)
		{
			var texte=$("#pathoTest").val();
			if ($.trim(texte).length<6){
				
				if(texte===""){
					$('#messagePatho').removeClass("valide");
					$('#messagePatho').removeClass("invalide");
					$('#messagePatho').hide();
					return;
				}

					console.log("affiche !");
					$('#messagePatho').text("Ce champ doit contenir au moins 6 caractères");
					$('#messagePatho').addClass('invalide');
					$('#messagePatho').show();
			}
				else
				{
					$('#messagePatho').removeClass('invalide');
					console.log("remove !");
					$('#messagePatho').addClass('valide');
					console.log("add !");
					$('#messagePatho').text("Champ valide");
					

					$('#messagePatho').show();
					
					
				}

			

		});
		
	$('#pathoTest2').keyup(function(event)
		{
			var texte=$("#pathoTest2").val();
			if ($.trim(texte).length<6){
				
				if(texte===""){
					$('#messagePatho2').removeClass("valide");
					$('#messagePatho2').removeClass("invalide");
					$('#messagePatho2').hide();
					return;
				}

					console.log("affiche !");
					$('#messagePatho2').text("Ce champ doit contenir au moins 6 caractères");
					$('#messagePatho2').addClass('invalide');
					$('#messagePatho2').show();
			}
				else
				{
					$('#messagePatho2').removeClass('invalide');
					console.log("remove !");
					$('#messagePatho2').addClass('valide');
					console.log("add !");
					$('#messagePatho2').text("Champ valide");
					

					$('#messagePatho2').show();
					
					
				}

			

		});
		
	$('#pathoTest3').keyup(function(event)
		{
			var texte=$("#pathoTest3").val();
			if ($.trim(texte).length<6){
				
				if(texte===""){
					$('#messagePatho3').removeClass("valide");
					$('#messagePatho3').removeClass("invalide");
					$('#messagePatho3').hide();
					return;
				}

					console.log("affiche !");
					$('#messagePatho3').text("Ce champ doit contenir au moins 6 caractères");
					$('#messagePatho3').addClass('invalide');
					$('#messagePatho3').show();
			}
				else
				{
					$('#messagePatho3').removeClass('invalide');
					console.log("remove !");
					$('#messagePatho3').addClass('valide');
					console.log("add !");
					$('#messagePatho3').text("Champ valide");
					

					$('#messagePatho3').show();
					
					
				}

			

		});
		
	$('#pathoTest4').keyup(function(event)
		{
			var texte=$("#pathoTest4").val();
			if ($.trim(texte).length<6){
				
				if(texte===""){
					$('#messagePatho4').removeClass("valide");
					$('#messagePatho4').removeClass("invalide");
					$('#messagePatho4').hide();
					return;
				}

					console.log("affiche !");
					$('#messagePatho4').text("Ce champ doit contenir au moins 6 caractères");
					$('#messagePatho4').addClass('invalide');
					$('#messagePatho4').show();
			}
				else
				{
					$('#messagePatho4').removeClass('invalide');
					console.log("remove !");
					$('#messagePatho4').addClass('valide');
					console.log("add !");
					$('#messagePatho4').text("Champ valide");
					

					$('#messagePatho4').show();
					
					
				}

			

		});
		
		
		
	$('#pathoTest5').keyup(function(event)
		{
			var texte=$("#pathoTest5").val();
			if ($.trim(texte).length<6){
				
				if(texte===""){
					$('#messagePatho5').removeClass("valide");
					$('#messagePatho5').removeClass("invalide");
					$('#messagePatho5').hide();
					return;
				}

					console.log("affiche !");
					$('#messagePatho5').text("Ce champ doit contenir au moins 6 caractères");
					$('#messagePatho5').addClass('invalide');
					$('#messagePatho5').show();
			}
				else
				{
					$('#messagePatho5').removeClass('invalide');
					console.log("remove !");
					$('#messagePatho5').addClass('valide');
					console.log("add !");
					$('#messagePatho5').text("Champ valide");
					

					$('#messagePatho5').show();
					
					
				}

			

		});
		
		
	$('#desTest').keyup(function(event)
		{
			var texte=$("#desTest").val();
			if ($.trim(texte).length<6){
				
				if(texte===""){
					$('#messageDes').removeClass("valide");
					$('#messageDes').removeClass("invalide");
					$('#messageDes').hide();
					return;
				}

					console.log("affiche !");
					$('#messageDes').text("Ce champ doit contenir au moins 6 caractères");
					$('#messageDes').addClass('invalide');
					$('#messageDes').show();
					$('#messageDes').removeClass('valide');
			}
				else
				{
					$('#messageDes').removeClass('invalide');
					console.log("remove !");
					$('#messageDes').addClass('valide');
					console.log("add !");
					$('#messageDes').text("Champ valide");
					

					$('#messageDes').show();
					
					
				}

			

		});
		
		
		
});