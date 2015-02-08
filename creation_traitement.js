$(document).ready(function()
{
	$('span').keyup(function(event)
		{
			var texte=$("#TraitExisteDeja").val();
			if (texte){
				$('#TraitExisteDeja').show();
			}
			else
				$('#TraitExisteDeja').hide();
		});
		
	$('#confirmer').click(function(){
		if($('#papa').val()==''){
			
			$('#pathoSaisieChamp').show();
		}
		else
			$('#pathoSaisieChamp').hide();
		
		
	});
		
});