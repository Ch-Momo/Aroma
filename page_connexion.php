<?php 
	require('connexion.php');
	require('fonctionsMomo.php');
	session_start();
?>

<?php
$form_valide=false;
$formSoumis=false;
	if(isset($_POST["pseudo"]) and isset($_POST["pass"]) and trim($_POST['pseudo'])!='' and  trim($_POST['pass'])!=''){
		$formSoumis=true;
		 if(moderateur_existe($bd,$_POST["pseudo"],$_POST["pass"])){
		 	$form_valide=true;
		 	$_SESSION['admin']='yes';
		 	$_SESSION['pseudo']=$_POST['pseudo'];		
		 }
		 else{
		 	$form_valide=false;
		 }
	}

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Aroma - Authentification</title>
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
		<link rel="stylesheet" type="text/css" href="css/page_connexion.css" title="style" />
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
				<h2 id="titre"> <img  id="huile" src="images/admin.png" width="100" length="100"/> <span id="titre">Connexion en tant qu'Administrateur : </p></h2><br/>
  			<p style="font-size:15px;">Vous avez le droit de vous connecter seulement si vous êtes admin, si ce n'est pas le cas, revenez vers la page <a href="accueil.php">d'accueil.</a></p>	
			﻿<?php
			if($formSoumis and !$form_valide){
				echo '<div class="alert alert-danger" role="alert"><p> Erreur d\'authentification</p></div>';
			}
			if($form_valide==true){
				echo '<div class="alert alert-success" role="alert"><p>Vous vous êtes connecté avec succès.</p></div>';			}
			else{
			echo '
				<div id="form_connexion">
				<form method="post">
					<p>
						<label for="pseudo">Pseudo :
						<input type="text" name="pseudo" id="pseudo" /> <span id="err_pseudo" class="vide"> invalide</span><br/><br/>
						</label> 
						<label for="pass">Mot de passe :
						<input type="password" name="pass" id="pass" /> <span id="err_pass" class="vide"> invalide</span></label>

						<br />
						<input type="submit" value="Se connecter" />

					</p>
				</form>
				</div>';
			}

			?>

			
		</div>
		<!-- Le Footer -->
			<div id="footer">
				
			</div>

	</body>
</html>
