$(document).ready(function()
{
	$('#form_nom').keyup(function(event)
		{
			var texte=$("#form_nom").val();
			if (texte.length<6){
				$('#err_nom').show();
			}
			else
				$('#err_nom').hide();
		});
	
	$('#form_latin').keyup(function(event)
		{
			var texte=$("#form_latin").val();
			if (texte.length<6){
				$('#err_latin').show();
			}
			else
				$('#err_latin').hide();
		});
});