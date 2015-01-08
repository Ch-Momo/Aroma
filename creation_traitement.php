<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Création d'un traitement</title>
  <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<body>

<?php 
	require('connexion.php');
	//require("entete.php");
	require('fonctionsUsman.php');

?>

<body>

<?php 

$champs="Champs obligatoires (*)"; 

if (!empty($_POST))
{
 if(isset($_POST['conf']))
 {
	 
	if(trim($_POST['nom'])=='' or (trim($_POST['pathologie'])=='' && trim($_POST['pathologie2'])=='' && trim($_POST['pathologie3'])=='' && trim($_POST['pathologie4'])=='' && trim($_POST['pathologie5'])=='') or trim($_POST['description'])=='' or trim($_POST['modalite'])==''){

	$champs="<b>Champs obligatoires (*) !</b>"; 
	
	if((trim($_POST['pathologie'])=='' && trim($_POST['pathologie2'])=='' && trim($_POST['pathologie3'])=='' && trim($_POST['pathologie4'])=='' && trim($_POST['pathologie5'])=='')){
		
		echo "<p>Veuillez choisir ou créer au moins une pathologie</p>";
	}
	
	if(trim($_POST['description'])==''){
		echo "<p>Description est un champs obligatoire</p>";
	}
	}

	else
	{
	//Si le traitement existe déjà, renvoie message d'erreur
		if(traitementExiste($bd, $_POST['nom']))
		{
			echo '<script language="JavaScript" type="text/javascript">'." 
	alert('Ce traitement existe déjà !');</script>"; 
		}
		
	//Sinon on crée le traitement
		else
		{
           
		creerTraitement($bd, $_POST['nom'], $_POST['description'], $_POST['modalite'], $_POST['image'], $_POST['video']);
		
		$idtraitement = recupererIdtraitement($bd, $_POST['nom']);

		ajouterPathologie($bd, $_POST['pathologie'], $idtraitement);

        echo '<p>Traitement ajouté avec succès</p> </section>';
		

		if(!empty($_POST['pathologie2'])){
			
		ajouterPathologie($bd, $_POST['pathologie2'], $idtraitement);
		
		}
				
		if(!empty($_POST['pathologie3'])){
					
		ajouterPathologie($bd, $_POST['pathologie3'], $idtraitement);

		}
				
		if(!empty($_POST['pathologie4'])){
			
		ajouterPathologie($bd, $_POST['pathologie4'], $idtraitement);
		
		}
			
		if(!empty($_POST['pathologie5'])){				
			
		ajouterPathologie($bd, $_POST['pathologie5'], $idtraitement);

		}	
	    }
    }
  }
}
?>

<?php

?>

<h2> Création d'un traitement </h2>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<p><label> Nom du traitement : *</label> <input type="text" name="nom" id="nom" autofocus required /></p>
<p><label> Pathologie : *</label><p> 

 <input list="pathologie" name="pathologie" />
    <datalist id="pathologie">
        <option></option><?php genereListboxPathologie($bd); ?>
    </datalist></br></br>
	 <input list="pathologie2" name="pathologie2" />
    <datalist id="pathologie2">
        <option></option><?php genereListboxPathologie($bd); ?>
    </datalist></br></br>
	 <input list="pathologie3" name="pathologie3" />
    <datalist id="pathologie3">
        <option></option><?php genereListboxPathologie($bd); ?>
    </datalist></br></br>
	 <input list="pathologie4" name="pathologie4" />
    <datalist id="pathologie4">
        <option></option><?php genereListboxPathologie($bd); ?>
    </datalist></br></br>
	 <input list="pathologie5" name="pathologie5" />
    <datalist id="pathologie5">
        <option></option><?php genereListboxPathologie($bd); ?>
    </datalist></br></br>
<p><label> Description du traitement : *</label></br><textarea name="description" cols="50" rows="7" required ></textarea></p>
<p><label> Modalité : *</label><select name="modalite" size="3">
<option value="1" selected>Voie cutanée</option>
<option value="2">Voie orale</option>
<option value="3">En diffusion</option>
</select>
</p>
</br>
<p><label> Lien image : </label> <input type="text" name="image" id="image"/></p>
</br>
<p><label> Lien vidéo : </label> <input type="text" name="video" id="video"/></p>
</br>
<p style='color: red;'><?php echo $champs; ?></p>
<p> <input type="submit" value="Valider" name="conf" /> </p>
</form>

<h2>Traitements de la base de données</h2>

<?php afficheTraitements($bd); ?>

</body>

<? //php require("fin.php"); ?>
