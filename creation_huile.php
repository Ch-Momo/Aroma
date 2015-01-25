<?php 
	require('connexion.php');
	require('fonctionsMomo.php');
?>
		<?php
			if(count($_POST)>0){
				$formSoumis=true;
			}
			else {
				$formSoumis=false;
			}
			
		?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
 <html>
  	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  		<title>Création d'une huile essentielle</title>
			  		<!-- Latest compiled and minified CSS -->
			<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

			<!-- Optional theme -->
			<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

			<!-- Latest compiled and minified JavaScript -->
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

			<link rel="stylesheet" type="text/css" href="creation_huile.css" title="style" />
  		
  	</head>
  	<body>	<nav id="menu">
		  		<ul><li>Accueil</li>
			  <li>Base de données des HE</li>
			  <li>
			    Base de donnée de traitements
			    <ul>
			      <li>Web Design</li>
			      <li>Web Development</li>
			      <li>Illustrations</li>
			    </ul>
			  </li>
			  <li>Connexion</li>
			  <li>Contact</li>
			</ul>
  			</nav>
	  		<div id="contenu">
	  		<h2> Création d'une huile essentielle : </h2>
  			
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
								echo '<strong> L\'huile a bien été crée. </strong></p>';
								$cree=true;
							}
						}
					}
					else{
					echo '<p> Veuillez remplir tous les champs nécessaires.</p>';
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
	</body>

</html>