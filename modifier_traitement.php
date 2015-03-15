<?php 
		require('connexion.php');
		require('fonctionsUsman.php');
		session_start();

	?>
	
<!DOCTYPE HTML>
<html>
	<head>
		<title>Aroma - Modification d'un traitement</title>
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
		<script src="bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/creation_traitement.css" title="style" />
		<noscript>
		<link rel="stylesheet" href="css/skel.css" />
		<link rel="stylesheet" href="css/style.css" />
		</noscript>
		
		<script src="js/modifier_traitement.js"></script>
		
	</head>

<body class="homepage">
			<?php
				require("menu.php");
			?>

	<?php 

	if(isset($_POST['choixTrait']))
	{
	//si le choix a ete fait

	$choixTrait = $_POST['choixTrait'];
	

	 }

	  else
	  {
	  $choixTrait='';
	  }
	?>
	<div id="main" class="wrapper style1">
		<form action="modifier_traitement.php?choixTrait=<?php echo $choixTrait;?>" method="post">
			<h2>Modification d'un traitement : </h2>
			</br>
				<p><label> Traitement :</label>
					<select id="choixTrait" name="choixTrait">
						<option></option><?php genereListboxTraitement($bd); ?>
					</select>
				</p>
			<p> <input type="submit" value="Modifier" /> </p>
		</form>


		<div id="formTemp">
	<?php 

	//Si le choix est validé et que le traitement existe, on affiche le traitement (On le prévisualise)

		if(isset($_POST['choixTrait']) && traitementExiste($bd,$_POST['choixTrait']))
		{
		 $idtraitement = recupererIdtraitement($bd, $choixTrait);
		 $pathoAmodif = recupererNomPathologie($bd, $choixTrait);

	
		//on récupère les infos de la BDD pour pré-remplir le formulaire de modif.
		$req=$bd->prepare('SELECT * from traitements where nom_traitement=:choixTrait');
			$req->bindValue(':choixTrait',$choixTrait);
		$req->execute();
			$tab = array();
			$tab=$req->fetch(PDO::FETCH_ASSOC);
			$nom=$tab['nom_traitement'];
			$desc=$tab['Desc_traitement'];		
			$mod=$tab['id_modalite'];
			$image=$tab["image"];

	?>
			


			<form action="modifier_traitement.php" method="post" enctype="multipart/form-data">
					<p><label> Nom du traitement : </label> <input type="text" name="nom" autofocus required value="<?php echo $nom; ?>"/></p>
					<input type="hidden" name="id-cache" value="<?php echo $idtraitement['id_traitement']; ?>"/>
					<p><label> Pathologies : *</label><p> 
					
					 <?php modifierChampsPathologies($bd, $pathoAmodif);?>
					 	
<?php 				

					?>
					<p><label> Description du traitement : *</label></br><textarea name="description" cols="50" rows="7"><?php echo $desc; ?></textarea></p>
					<p><label> Modalité : *</label>
					</br>
						<?php listboxModaliteRempli($bd, $idtraitement['id_traitement']);?>
					</p>
					</br>
					<p> <br/><label>Image actuelle :</label></p><img src="images_huiles/<?php echo $image; ?>" alt="image" width="400" height="300" id="img_huile" />
					<p> <br/> Sélectionnez une image si vous voulez modifier l'image existante :<br/><br/><input type="file" name="image" />  </p> 
					<input type="hidden" name="image_existante" value="<?php $image?>" /><br/>	
					<p> <input type="submit" name="valider" value="Valider"/> </p></br>
		</form>
	</div>
	   <?php } ?>
	</div>
	<?php 

					verificationFormulaireModifier($bd, $_POST);

	?>
			<!-- Le Footer -->
			<div id="footer">
				
			</div>
	</body>
</html>