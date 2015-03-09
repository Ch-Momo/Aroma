	<?php 
		require('connexion.php');
		require('fonctionsUsman.php');
		session_start();

	?>
	
<!DOCTYPE HTML>
<html>
	<head>
		<title>Aroma - Création d'un traitement</title>
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
		<link rel="stylesheet" type="text/css" href="css/creation_traitement.css" title="style" />
		<noscript>
		<link rel="stylesheet" href="css/skel.css" />
		<link rel="stylesheet" href="css/style.css" />
		</noscript>
		
		<script src="js/creation_traitement.js"></script>
		
	</head>
	<body class="homepage">
		<?php
			require("menu.php");
		?>
		<!-- Le contenu -->
			<div id="main" class="wrapper style1">


	
<?php
creationEtTestFormulaire($bd);
?>

<h2> Création d'un traitement </h2>
</br>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
		<p><label> Nom du traitement : *<span id="Ok" class="vide">Valide</span></label>
		<input type="text" name="nom" id="nom" autocomplete="off" autofocus required placeholder="Entrez le nom du traitement"/></p>
		<p><label class="nom_patho"> Pathologies : *<span id="pathoSaisieChamp">Saisir une pathologie valide</span></label><p> 
		<?php creerChampsPathologies($bd); ?>
		<p><label> Description du traitement : *</label>
		</br>
		<textarea name="description" cols="50" rows="7" required placeholder="Donnez une brève description du traitement..."></textarea></p>
		<p><label> Modalités : *</label>
		</br>
			<select name="modalite" size="3">
				<option value="1" selected>Voie cutanée</option>
				<option value="2">Voie orale</option>
				<option value="3">En diffusion</option>
			</select>
		</p>
		<p> Sélectionnez une image :<input type="file" name="image"/>  </p>	
		<p> <input type="submit" value="Créer un traitement" name="conf" id="confirmer" /></p></br>
</form>

</div>


		<!-- Le Footer -->
			<div id="footer">
				
			</div>
			
			
	</body>
</html>
