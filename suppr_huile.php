
<?php 
	require('connexion.php');
	require('fonctionsMomo.php');
	session_start();
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Aroma - Suppression d'une huile essentielle</title>
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
		<link rel="stylesheet" type="text/css" href="css/suppr_huile.css" title="style" />
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
				<h2 id="titre"> <img  id="huile" src="images/huile2.png" width="100" length="100"/> <span id="titre">Suppression d'une huile essentielle : </p></h2><br/>
				<p> Veuillez sélectionner l'huile à modifier :</p>
		<form method="post">
			<?php
				if(isset($_POST['nom_huile_a_suppr'])){
					suppr_huile($bd,donnees_huile($bd,$_POST['nom_huile_a_suppr'])['nom_huile']);
				}
				echo '<select name="nom_huile_a_suppr">';
				listboxHuiles($bd);
				echo'</select>';
			?>
			<br/><br/><input type="submit" value="Supprimer l'huile"/>
		</form>
		</div>
		<!-- Le Footer -->
			<div id="footer">
				
			</div>

	</body>
</html>



