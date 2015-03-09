
<?php 
	require('connexion.php');
	require('fonctionsMomo.php');
	session_start();
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Aroma - Modification d'une huile</title>
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
		<link rel="stylesheet" type="text/css" href="css/modif_huile.css" title="style" />
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
				
					
					<h2 id="titre"> <img  id="huile" src="images/huile2.png" width="100" length="100"/> <span id="titre">Modification d'une huile essentielle : </p></h2><br/>




				
  			<p> Veuillez sélectionner l'huile à modifier :</p>
		<form method="post">
			<?php
				echo '<select name="nom_huile_a_modif">';
				listboxHuiles($bd);
				echo'</select>';
			?>
			<br/><br/><input type="submit" value="Afficher les caractéristiques"/>
		</form>
		
		<?php
			$modifiee=false;
			if(count($_POST)>1){
				if(isset($_POST['nom'])and isset($_POST['nom_latin'])and isset($_POST['famille'])and isset($_POST['organe'])and isset($_POST['origine_geo'])and isset($_POST['constituant1'])and isset($_POST['constituant2'])and isset($_POST['constituant3'])and isset($_POST['constituant4'])and isset($_POST['constituant5'])and isset($_POST['notation1'])and isset($_POST['notation2'])and isset($_POST['notation3'])and isset($_POST['notation4'])and isset($_POST['notation5'])and isset($_POST['propriete1'])and isset($_POST['propriete2'])and isset($_POST['propriete3'])and isset($_POST['propriete4'])and isset($_POST['propriete5'])and isset($_POST['pourcentage1'])and isset($_POST['pourcentage2'])and isset($_POST['pourcentage3'])and isset($_POST['pourcentage4'])and isset($_POST['pourcentage5'])and isset($_POST['conseils'])and isset($_POST['indications'])and isset($_POST['modeEmploi'])and isset($_POST['message_energetique']) and isset($_FILES['image'])){
					$formValide=verification_formulaire_creation_huile($bd,$_POST);
					if($formValide==true){
							if(isset($_SESSION['nom_huile_modifiee'])){
								if($_SESSION['nom_huile_modifiee']!=$_POST['nom']){
									if(isset($_POST['image_existe'])){
										suppr_huile_modif($bd,$_SESSION['nom_huile_modifiee']);
									}
									else{
										suppr_huile($bd,$_SESSION['nom_huile_modifiee']);
									}
								}
								else{

									if(isset($_POST['image_existe'])){
										suppr_huile_modif($bd,$_POST['nom']);
									}
									else{
										suppr_huile($bd,$_POST['nom']);
									}
								}
							}

							creation_huile($bd,$_POST);
							echo '<div id="res"><div class="alert alert-success" role="alert"><p> <strong> L\'huile a bien été modifiée. </strong></p></div></div>';
							$modifiee=true;
					}
				}
				else{
					echo '<div class="alert alert-danger" role="alert"><p> Veuillez remplir tous les champs nécessaires.</p></div>';
				}
			}


			if(isset($_POST['nom_huile_a_modif']) and $_POST['nom_huile_a_modif']!='empty' and $modifiee==false){//premier submit
				echo '<p style="font-size:20px"> Les caractéristiques actuelles de l\'huile <strong>'.$_POST['nom_huile_a_modif'].' :</strong></p>';
				formulaire_modification_huile($bd,donnees_huile($bd,$_POST['nom_huile_a_modif']));
				$_SESSION['nom_huile_modifiee']=$_POST['nom_huile_a_modif'];
			}
			else if(isset($_POST['nom']) and $modifiee==false){//deuxieme submit
				echo '<p style="font-size:20px"> Les caractéristiques actuelles de l\'huile <strong>'.$_SESSION['nom_huile_modifiee'].' :</strong></p>';
				formulaire_modification_huile($bd,donnees_huile($bd,$_SESSION['nom_huile_modifiee']));
			}
		?>
		</div>
		<!-- Le Footer -->
			<div id="footer">
				
			</div>

	</body>
</html>
