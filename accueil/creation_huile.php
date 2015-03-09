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


<!DOCTYPE HTML>
<html>
	<head>
		<title>Aroma - Huiles essentielles</title>
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
		<noscript>
		<link rel="stylesheet" href="css/skel.css" />
		<link rel="stylesheet" href="css/style.css" />
		</noscript>
		<link rel="stylesheet" type="text/css" href="creation_huile.css" title="style" />
		<script src="creation_huile.js"></script>
		
	</head>
	<body class="homepage">

		<!-- Header -->
			<div id="header">
				<div class="container">
						
					<!-- Logo -->
						
						<img id="image-logo" src="images/logo.png"/>
					
					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="index.html">Accueil</a></li>
								<li>
									<a href="">Gestion de bases de données</a>
									<ul>
										<li>
											<a href="">Modifier la base de données des Huiles</a>
											<ul>
												<li><a href="#">Ajouter une huile</a></li>
												<li><a href="#">Modifier une huile</a></li>
												<li><a href="#">Supprimer une huile</a></li>
											</ul>
										</li>
										<li>
											<a href="">Modifier la base de données des traitements<span id="span-douiller">.</span></a>
											<ul>
												<li><a href="#">Ajouter un traitement</a></li>
												<li><a href="#">Modifier un traitement</a></li>
												<li><a href="#">Supprimer un traitement</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li><a href="left-sidebar.html">Les huiles</a></li>
								<li><a href="right-sidebar.html">Les traitements</a></li>
								<li><a href="no-sidebar.html">Déconnexion</a></li>
							</ul>

						</nav>


					<!-- Banner -->
					<div id="banner">
							<div class="container">
								<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
											  <!-- Indicators -->
											  <ol class="carousel-indicators">
												<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
												<li data-target="#carousel-example-generic" data-slide-to="1"></li>
												<li data-target="#carousel-example-generic" data-slide-to="2"></li>
											  </ol>

											  <!-- Wrapper for slides -->
											  <div class="carousel-inner" role="listbox">
												<div class="item active">
												  <img id="image1" src="images/1.jpeg" alt="...">
												  <div class="carousel-caption">
													Base de données des huiles
												  </div>
												</div>
												<div class="item">
												  <img src="images/2.jpg" alt="...">
												  <div class="carousel-caption">
													Base de données des traitements
												  </div>
												</div>
											  </div>

											  <!-- Controls -->
											  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
												<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
												<span class="sr-only">Previous</span>
											  </a>
											  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
												<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
												<span class="sr-only">Next</span>
											  </a>
											</div>	
							</div>
						</div>

				</div>	
			</div>

		<!-- Main -->
			<div id="main" class="wrapper style1">
				
					
						<!-- Content -->
							 <h2> <img  id="huile" src="images/huile.png" width="100" length="100"/> Création d'une huile essentielle : </h2><br/>
  			
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
		
		<!-- Footer -->
			<div id="footer">
				
			</div>

	</body>
</html>
