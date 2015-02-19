$(document).ready(function()
{
	$('#nom').keyup(function(event)
		{
			var texte=$('#nom').val();
			if (texte.length>6){
				$('#Ok').show();
			}
			else
				$('#Ok').hide();
		});
		
		
	$('nom_patho').click(function(){
		if($('nom_patho').val()==''){
			
			$('#pathoSaisieChamp').show();
		}
		else
			$('#pathoSaisieChamp').hide();
		
		
	});
	
});