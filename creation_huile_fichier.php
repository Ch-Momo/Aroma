<?php 
	require('connexion.php');
	require('fonctionsMomo.php');
?>


<?php
	print(count($_FILES));
	if(isset($_FILES['image'])){
		$dossier = 'images_huiles/';
		$fichier = basename($_FILES['image']['name']);
		$taille_maxi = 10000000;
		$taille = filesize($_FILES['image']['tmp_name']);
		$extensions = array('.png', '.gif', '.jpg', '.jpeg');
		$extension = strrchr($_FILES['image']['name'], '.');
		//Début des vérifications de sécurité...
		if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
		{
		     $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, t.';
		}
		if($taille>$taille_maxi)
		{
		     $erreur = 'Le fichier est trop gros...';
		}
		if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
		{
		     //On formate le nom du fichier ici...
		     $fichier = strtr($fichier, 
		          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
		          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
		     $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
		     if(move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
		     {
		          echo 'Upload effectué avec succès !';
		     }
		     else //Sinon (la fonction renvoie FALSE).
		     {
		          echo 'Echec de l\'upload !';
		     }
		}
		else
		{
		     echo $erreur;
		}
	}
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
 <html>
  	<head>
		
  		
  	</head>
  	<body>	
  		<h2> Création d'une HE à partir d'un fichier : </h2>
  		<form method="post" enctype="multipart/form-data" >
			<input type="file" name="image" />
			<input type="submit"  value="Valider" />
		</form>
				
	</body>

</html>