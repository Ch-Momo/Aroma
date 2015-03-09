$(document).ready(function()
{	
	/*
		Gestion des champs du formulaire.
	*/
	$('#form_nom').keyup(function(event)
		{
			var texte=$("#form_nom").val();
			if ($.trim(texte).length<6){
				if(texte===""){
					$('#err_nom').removeClass("valide");
					$('#err_nom').removeClass("invalide");
					$('#err_nom').hide();
					return;
				}
				$('#err_nom').removeClass("valide");
				$('#err_nom').addClass("invalide");
				$('#err_nom').text("Ce champ doit contenir au moins 6 caractères");
				$('#err_nom').show();
			}
			else{	
				
				$('#err_nom').removeClass("invalide");
				$('#err_nom').addClass("valide");
				$('#err_nom').text("Champ valide");
				
			}

		});

	
	$('#form_latin').keyup(function(event)
		{
			var texte=$("#form_latin").val();
			if ($.trim(texte).length<6){
				if(texte==""){
					$('#err_latin').removeClass("valide");
					$('#err_latin').removeClass("invalide");
					$('#err_latin').hide();
					return;
				}
				$('#err_latin').removeClass("valide");
				$('#err_latin').addClass("invalide");
				$('#err_latin').text("Ce champ doit contenir au moins 6 caractères");
				$('#err_latin').show();
			}
			else{	
				
				$('#err_latin').removeClass("invalide");
				$('#err_latin').addClass("valide");
				$('#err_latin').text("Champ valide");
				
			}
	});

	$('#form_famille').keyup(function(event)
		{
			var texte=$("#form_famille").val();
			if ($.trim(texte).length<6){
				if(texte==""){
					$('#err_famille').removeClass("valide");
					$('#err_famille').removeClass("invalide");
					$('#err_famille').hide();
					return;
				}
				$('#err_famille').removeClass("valide");
				$('#err_famille').addClass("invalide");
				$('#err_famille').text("Ce champ doit contenir au moins 6 caractères");
				$('#err_famille').show();
			}
			else{	
				
				$('#err_famille').removeClass("invalide");
				$('#err_famille').addClass("valide");
				$('#err_famille').text("Champ valide");
				
			}
	});

	$('#form_origine_geo').keyup(function(event)
		{
			var texte=$("#form_origine_geo").val();
			if ($.trim(texte).length<6){
				if(texte==""){
					$('#err_origine_geo').removeClass("valide");
					$('#err_origine_geo').removeClass("invalide");
					$('#err_origine_geo').hide();
					return;
				}
				$('#err_origine_geo').removeClass("valide");
				$('#err_origine_geo').addClass("invalide");
				$('#err_origine_geo').text("Champ invalide");
				$('#err_origine_geo').show();
			}
			else{	
				
				$('#err_origine_geo').removeClass("invalide");
				$('#err_origine_geo').addClass("valide");
				$('#err_origine_geo').text("Champ valide");
				
			}
	});
	function verifier(v1,v2,v3,v4,v5){
		if(v1===v2 || v1===v3 || v1===v4 || v1===v5 || v2===v3 || v2===v4 || v2===v5 || v3===v4 || v3===v5 || v4===v5 || $.trim(v1)===""|| $.trim(v2)===""|| $.trim(v3)===""|| $.trim(v4)===""|| $.trim(v5)===""){
			return false;
		}
		else
			return true;
	}

	$('.constituants_pourcentages').keyup(function(event)
		{
			var c1=$("#constituant1").val();
			var c2=$("#constituant2").val();
			var c3=$("#constituant3").val();
			var c4=$("#constituant4").val();
			var c5=$("#constituant5").val();

			var p1=$("#pourcentage1").val();
			var p2=$("#pourcentage2").val();
			var p3=$("#pourcentage3").val();
			var p4=$("#pourcentage4").val();
			var p5=$("#pourcentage5").val();

			if (verifier(c1,c2,c3,c4,c5)==false){
				$('#err_constituants_pourcentages').removeClass("valide");
				$('#err_constituants_pourcentages').addClass("invalide");
				$('#err_constituants_pourcentages').text("Veuillez bien remplir tous les champs");
				$('#err_constituants_pourcentages').show();
			}
			else{	
				if($.trim(p1)===""|| $.trim(p2)===""|| $.trim(p3)===""|| $.trim(p4)===""|| $.trim(p5)==="" || (parseInt($.trim(p1))+parseInt($.trim(p2))+parseInt($.trim(p3))+parseInt($.trim(p4))+parseInt($.trim(p5))>100)){
					$('#err_constituants_pourcentages').removeClass("valide");
					$('#err_constituants_pourcentages').addClass("invalide");
					$('#err_constituants_pourcentages').text("Pourcentages invalides");
					$('#err_constituants_pourcentages').show();
				}else{
					$('#err_constituants_pourcentages').removeClass("invalide");
					$('#err_constituants_pourcentages').addClass("valide");
					$('#err_constituants_pourcentages').text("Champs valides");
				}
				
			}
	});

	$('.proprietes_notations').keyup(function(event)
		{
			var p1=$("#propriete1").val();
			var p2=$("#propriete2").val();
			var p3=$("#propriete3").val();
			var p4=$("#propriete4").val();
			var p5=$("#propriete5").val();

			var n1=$("#notation1").val();
			var n2=$("#notation2").val();
			var n3=$("#notation3").val();
			var n4=$("#notation4").val();
			var n5=$("#notation5").val();

			if (verifier(p1,p2,p3,p4,p5)==false){
				$('#err_proprietes_notations').removeClass("valide");
				$('#err_proprietes_notations').addClass("invalide");
				$('#err_proprietes_notations').text("Veuillez bien remplir tous les champs");
				$('#err_proprietes_notations').show();
			}
			else{	
				if($.trim(n1)===""|| $.trim(n2)===""|| $.trim(n3)===""|| $.trim(n4)===""|| $.trim(n5)===""){
					$('#err_proprietes_notations').removeClass("valide");
					$('#err_proprietes_notations').addClass("invalide");
					$('#err_proprietes_notations').text("Notations invalides");
					$('#err_proprietes_notations').show();
				}else{
					$('#err_proprietes_notations').removeClass("invalide");
					$('#err_proprietes_notations').addClass("valide");
					$('#err_proprietes_notations').text("Champs valides");
				}
				
			}
	});

	$('#form_conseils').keyup(function(event){
		var texte=$("#form_conseils").val();
			if ($.trim(texte).length<6){
				if(texte==""){
					$('#err_conseils').removeClass("valide");
					$('#err_conseils').removeClass("invalide");
					$('#err_conseils').hide();
					return;
				}
				$('#err_conseils').removeClass("valide");
				$('#err_conseils').addClass("invalide");
				$('#err_conseils').text("Veuillez saisir un minimum de conseils");
				$('#err_conseils').show();
			}
			else{	
				
				$('#err_conseils').removeClass("invalide");
				$('#err_conseils').addClass("valide");
				$('#err_conseils').text("Champ valide");
				
			}

	});

	$('#form_indications').keyup(function(event){
		var texte=$("#form_indications").val();
			if ($.trim(texte).length<6){
				if(texte==""){
					$('#err_indications').removeClass("valide");
					$('#err_indications').removeClass("invalide");
					$('#err_indications').hide();
					return;
				}
				$('#err_indications').removeClass("valide");
				$('#err_indications').addClass("invalide");
				$('#err_indications').text("Veuillez saisir un minimum d'indications");
				$('#err_indications').show();
			}
			else{	
				
				$('#err_indications').removeClass("invalide");
				$('#err_indications').addClass("valide");
				$('#err_indications').text("Champ valide");
				
			}

	});

	$('#form_message').keyup(function(event){
		var texte=$("#form_message").val();
			if ($.trim(texte).length<6){
				if(texte==""){
					$('#err_message').removeClass("valide");
					$('#err_message').removeClass("invalide");
					$('#err_message').hide();
					return;
				}
				$('#err_message').removeClass("valide");
				$('#err_message').addClass("invalide");
				$('#err_message').text("Veuillez saisir un minimum de conseils");
				$('#err_message').show();
			}
			else{	
				
				$('#err_message').removeClass("invalide");
				$('#err_message').addClass("valide");
				$('#err_message').text("Champ valide");
				
			}

	});

	$(document).keydown(function(event) {
		if ( (event.keyCode == 76) && (event.shiftKey))  {
			$(location).attr('href',"page_connexion.php");
		}
	});


});