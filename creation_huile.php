<?php 
	require('connexion.php');
	require('fonctionsMomo.php');
	session_start();

?>
		<?php
			if(count($_POST)>0){
				$formSoumis=true;
			}
			else {
				$formSoumis=false;
			}
			
		?>


<!DOCTYPE HTML>
<html>
	<head>
		<title>Aroma - Création d'une huile</title>
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
		<link rel="stylesheet" type="text/css" href="css/creation_huile.css" title="style" />
		<noscript>
		<link rel="stylesheet" href="css/skel.css" />
		<link rel="stylesheet" href="css/style.css" />
		</noscript>
		
		<script src="js/creation_huile.js"></script>
		
	</head>
	<body class="homepage">
		<?php
			require("menu.php");
		?>
		<!-- Le contenu -->
			<div id="main" class="wrapper style1">
				
					

				<h2 id="titre"> <img  id="huile" src="images/huile.png" width="100" length="100"/> <span id="titre">Création d'une huile essentielle : </p></h2><br/>
  			
			<?php
				$cree=false;
				/*
					Si $_POST n'est pas vide, c'est à dire que l'utilisateur a soumis un formulaire.
				*/
				if(count($_POST)>0){
					if(isset($_POST['nom'])and isset($_POST['nom_latin'])and isset($_POST['famille'])and isset($_POST['organe'])and isset($_POST['origine_geo'])and isset($_POST['constituant1'])and isset($_POST['constituant2'])and isset($_POST['constituant3'])and isset($_POST['constituant4'])and isset($_POST['constituant5'])and isset($_POST['notation1'])and isset($_POST['notation2'])and isset($_POST['notation3'])and isset($_POST['notation4'])and isset($_POST['notation5'])and isset($_POST['propriete1'])and isset($_POST['propriete2'])and isset($_POST['propriete3'])and isset($_POST['propriete4'])and isset($_POST['propriete5'])and isset($_POST['pourcentage1'])and isset($_POST['pourcentage2'])and isset($_POST['pourcentage3'])and isset($_POST['pourcentage4'])and isset($_POST['pourcentage5'])and isset($_POST['conseils'])and isset($_POST['indications'])and isset($_POST['modeEmploi'])and isset($_POST['message_energetique']) and isset($_FILES['image'])){
						$formValide=verification_formulaire_creation_huile($bd,$_POST);
						
						if($formValide==true){
							if(huile_existe($bd,$_POST['nom'])){
								echo '<div class="alert alert-danger" role="alert"><p> Erreur de la création ! L\'huile <strong>'.$_POST['nom'].' </strong> existe déjà dans la base. </p></div>';
								$formValide=false;
							}
							else{
								creation_huile($bd,$_POST);
								echo '<div class="alert alert-success" role="alert"><strong> L\'huile a bien été crée. </strong></p></div>';
								$cree=true;
							}
						}
					}
					else{
								echo'<div class="alert alert-danger" role="alert">
								  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
								  <span class="sr-only">Error:</span>
								  Veuillez remplir tous les champs nécessaires.
								</div>';
					}
				}

				if($formSoumis and !$cree){
					formulaire_creation_huile_prerempli($bd,$_POST);
				}
				else{
					formulaire_creation_huile($bd);
				}
			?>
		</div>
		<!-- Le Footer -->
			<div id="footer">
				
			</div>

	</body>
</html>
