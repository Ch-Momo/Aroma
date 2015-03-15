<?php 
	require('connexion.php');
	require('fonctionsMomo.php');
	session_start();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Aroma - Informations - Création de plusieurs huiles </title>
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
		<link rel="stylesheet" type="text/css" href="css/creation_huile_fichier_infos.css" title="style" />
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


  				<div id="contenu">
  					<h3>Comment ajouter plusieurs huiles en même temps ?</h3><br/>
  					<p> Il faut tout d'abord créer un fichier excel contenant toutes les informations sur les huiles :<br/><br/>
  						- Chaque ligne correspond à une huile à ajouter (hormis la première ligne qui sera consacrée aux titres).<br/><br/>
  						- Chaque colonne correspond à une caractéristique de l'huile en question.<br/><br/>
  						Ce fichier doit être nommé <strong>"huiles.xls"</strong> pour le bon déroulement de l'algorithme.<br/><br/>
  						<Strong>Remarques : </Strong><br/><br/>
  						- La colonne correspondant aux modes d'empoloi de l'huile doit contenir au moins une des chaînes de caractères (Voie orale,Voie cutanée ou En Diffusion).<br/><br/>
  						- La colonne image doit contenir le nom complet de l'image correspendante à l'huile (nom+extension).<br/><br/>
  						Ensuite, il faut constituer un fichier ".zip" contenant le fichier "Huiles.xls" ainsi que toutes les images des huiles nommées en fonction de la colonne 'image' dans le fichier xls. Envoyez ce fichier dans le formulaire et les huiles VALIDES seront ajoutées automatiquement dans la base de données. En cas d'erreur quelque part dans les informations fournies, seules les huiles avec des données valides seront ajoutées.
  						<br/><br/>
  						<a><strong>Appuyez ici pour télécharger un exemple </strong></a><br/><br/><br/>
  					</p>
  				</div>
			
		</div>
		<!-- Le Footer -->
			<div id="footer">
				
			</div>

	</body>
</html>
