<?php 
	require('connexion.php');
	require('fonctionsMomo.php');
	session_start();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Aroma - Création de plusieurs traitements </title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.dropotron.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<link rel="stylesheet" type="text/css" href="css/creation_traitement_fichier.css" title="style" />
		<noscript>
		<link rel="stylesheet" href="css/skel.css" />
		<link rel="stylesheet" href="css/style.css" />
		</noscript>
		
	</head>
	<body class="homepage">
		<?php
			require("menu.php");
		?>
		<!-- Le contenu -->
			<div id="main" class="wrapper style1">	

				<h2 id="titre"> <img  id="huile" src="images/huile3.png" width="100" length="100"/> <span id="titre">Création de plusieurs traitements : </p></h2><br/>
  				<?php
  					if(isset($_FILES['fichier'])){
  							$formValide=true;
					  		$dossier = 'fichiers_huiles/';
							$fichier = basename($_FILES['fichier']['name']);
							$taille_maxi = 1000000000;
							$taille = filesize($_FILES['fichier']['tmp_name']);
							$extensions = array('.zip');
							$extension = strrchr($_FILES['fichier']['name'], '.');
							//Début des vérifications de sécurité...
							if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
							{
							    $formValide=false;
							}
							if($taille>$taille_maxi)
							{
							     $formValide=false;
							}
							if($formValide){
							     $fichier = strtr($fichier, 
							          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
							          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
							     $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
							     $_FILES['fichier']['tmp_name'];
							     if(move_uploaded_file($_FILES['fichier']['tmp_name'],''.$dossier.$fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
							     {
							         $formValide=true;
							     }
							     else //Sinon (la fonction renvoie FALSE).
							     {
							          $formValide=false;
							     }
							}

							if($formValide==true){
								unzip_file($dossier.$fichier,$dossier);
								$res=ajouterHuiles($bd);
								echo '<div class="alert alert-success" role="alert">Résultat du traitement de vos ficheirs : <strong>'.$res[0].' huiles ajoutées, '.$res[1].' échecs.</strong></p></div>';
								unlink($dossier.$fichier);

							}
							else{
								echo '<div class="alert alert-danger" role="alert"><p><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"> ERREUR-FICHIER!</p></div>';
							}
							
  					}	

  				?>


  				<form enctype="multipart/form-data" action="" method="post">
  						<p>Sélectionnez les fichiers sous format "zip". Cliquez <a href="creation_traitement_fichier_infos.php">ici</a> pour plus d'informations.</p>
  						<input name="fichier" type="file" /><br />
  						<input type="submit" value="Créer des huiles"/>
  				</form>
			
		</div>
		<!-- Le Footer -->
			<div id="footer">
				
			</div>

	</body>
</html>
