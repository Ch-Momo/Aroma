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
				<p><label> Traitement :</label> <input list="choixTrait" name="choixTrait" />
					<datalist id="choixTrait">
						<option></option><?php genereListboxTraitement($bd); ?>
					</datalist>
				</p>
			<p> <input type="submit" value="Choisir" /> </p>
		</form>
	</div>
		<div id="main" class="wrapper style1">
		<div id="formTemp">
	<?php 

	//Si le choix est validé et que le traitement existe, on affiche le traitement (On le prévisualise)

		if(isset($_POST['choixTrait']) && traitementExiste($bd,$_POST['choixTrait']))
		{
		afficheTraitementsSelonSelection($bd, $_POST['choixTrait']);
			   $idtraitement = recupererIdtraitement($bd, $choixTrait);
		$pathoAmodif = recupererNomPathologie($bd, $choixTrait);
	
	?>	</div>
		</div>
				<div id="main" class="wrapper style1">
		<form action="modifier_traitement.php?id-traitement=<?php echo $idtraitement['id_traitement']; ?>&pathoAmodif=<?php if(empty($pathoAmodif['0'])){echo "";} else { echo $pathoAmodif['0'];} ?>&pathoAmodif2=<?php if(empty($pathoAmodif['1'])){echo "";} else { echo $pathoAmodif['1'];} ?>&pathoAmodif3=<?php if(empty($pathoAmodif['2'])){echo "";} else { echo $pathoAmodif['2'];} ?>&pathoAmodif4=<?php if(empty($pathoAmodif['3'])){echo "";} else { echo $pathoAmodif['3'];} ?>&pathoAmodif5=<?php if(empty($pathoAmodif['4'])){echo "";} else { echo $pathoAmodif['4'];} ?>" method="post">
			<p> Voulez-vous modifier ce traitement ? <?php echo $_POST['choixTrait'] . ' '; ?> ?
				<input type="hidden" name="choixTrait" value="<?php echo $_POST['choixTrait'];?>"/></p>
			<p><input type="submit" value="oui" name="confModif"/><input type="submit" value="non" name="confModif"/></p>
		</form>
	</div>
	<?php
		}
		else
		{
	?>

		<p>Veuillez choisir un traitement </p>.
	<?php } ?>


	<?php

		//Modification d'un traitement ?
		$paramPost = array('confModif','choixTrait');
		if(testCles($paramPost,$_POST) && $_POST['confModif']=='oui')
		{	
		//on récupère les infos de la BDD pour pré-remplir le formulaire de modif.
		$req=$bd->prepare('SELECT * from traitements where nom_traitement=:choixTrait');
			$req->bindValue(':choixTrait',$choixTrait);
		$req->execute();
			$tab = array();
			$tab=$req->fetch(PDO::FETCH_ASSOC);
			$nom=$tab['nom_traitement'];
			$desc=$tab['Desc_traitement'];		
			$mod=$tab['id_modalite'];
			
	$patho = recupererNomPathologie($bd, $choixTrait);
	   
	?>
			

	<div id="main" class="wrapper style1">
			<form action="modifier_traitement.php?id-traitement=<?php echo $_GET['id-traitement']; ?>&pathoAmodif=<?php if(empty($_GET['pathoAmodif'])){echo "";} else { echo $_GET['pathoAmodif'];} ?>&pathoAmodif2=<?php if(empty($_GET['pathoAmodif2'])){echo "";} else { echo $_GET['pathoAmodif2'];} ?>&pathoAmodif3=<?php if(empty($_GET['pathoAmodif3'])){echo "";} else { echo $_GET['pathoAmodif3'];} ?>&pathoAmodif4=<?php if(empty($_GET['pathoAmodif4'])){echo "";} else { echo $_GET['pathoAmodif4'];} ?>&pathoAmodif5=<?php if(empty($_GET['pathoAmodif5'])){echo "";} else { echo $_GET['pathoAmodif5'];} ?>" method="post">
					<p><label> Nom du traitement : *</label> <input type="text" name="nom" value="<?php echo $nom; ?>"/></p>
					<p><label> Pathologies : *</label><p> 
					 <input list="pathologie" name="pathologie" value="<?php if(empty($patho['0'])){echo "";} else { echo $patho['0'];} ?>"/>
						<datalist id="pathologie">
							<option></option><?php genereListboxPathologie($bd); ?>
						</datalist>
						 <input list="pathologie2" name="pathologie2" value="<?php if(empty($patho['1'])){echo "";} else { echo $patho['1'];} ?>"/>
						<datalist id="pathologie2">
							<option></option><?php genereListboxPathologie($bd); ?>
						</datalist>
						 <input list="pathologie3" name="pathologie3" value="<?php if(empty($patho['2'])){echo "";} else { echo $patho['2'];} ?>"/>
						<datalist id="pathologie3">
							<option></option><?php genereListboxPathologie($bd); ?>
						</datalist>
						 <input list="pathologie4" name="pathologie4" value="<?php if(empty($patho['3'])){echo "";} else { echo $patho['3'];} ?>"/>
						<datalist id="pathologie4">
							<option></option><?php genereListboxPathologie($bd); ?>
						</datalist>
						 <input list="pathologie5" name="pathologie5" value="<?php if(empty($patho['4'])){echo "";} else { echo $patho['4'];} ?>"/>
						<datalist id="pathologie5">
							<option></option><?php genereListboxPathologie($bd); ?>
						</datalist>
				
<?php $idcount = recupererNombrePathologieParTraitement($bd, $_GET['id-traitement']);
				if($idcount>=5){
		    	echo "<b><p>Ce traitement est déjà associé à 5 pathologies. Par conséquent, toute modification de pathologie écrasera l'ancien lien</p></b></br>";		
						}

					?>
				<p><label> Description du traitement : *</label></br><textarea name="description" cols="50" rows="7"><?php echo $desc; ?></textarea></p>
				<p><label> Modalité : *</label><select name="modalite" size="3">
				<option value="1" selected>Voie cutanée</option>
				<option value="2">Voie orale</option>
				<option value="3">En diffusion</option>
				</select>
				</p>
				</br>
				<p> <input type="submit" name="modifier" value="Valider"/> </p>
		</form>
	</div>
	   <?php } ?>

	<?php 

		if(isset($_POST['modifier']))//bouton 'Valider' en fait
		{
			
			if(trim($_POST['nom'])=='' or (trim($_POST['pathologie'])=='' && trim($_POST['pathologie2'])=='' && trim($_POST['pathologie3'])=='' && trim($_POST['pathologie4'])=='' && trim($_POST['pathologie5'])=='') or trim($_POST['description'])=='' or trim($_POST['modalite'])==''){

		$champs="<b>Champs obligatoires (*) !</b>"; 
		
		if((trim($_POST['pathologie'])=='' && trim($_POST['pathologie2'])=='' && trim($_POST['pathologie3'])=='' && trim($_POST['pathologie4'])=='' && trim($_POST['pathologie5'])=='')){
			
			echo "<p>Veuillez choisir ou créer au moins une pathologie</p>";
			
		}
		
		if(trim($_POST['description'])==''){
			echo "<p>Description est un champs obligatoire</p>";
		}
		
		if(traitementExiste($bd, $_POST['nom']))
			{
			echo "<p>Ce traitement existe déjà</p>";
			}
		}
		
		else{
				
			$idtraitement = recupererIdtraitement($bd, $_POST['nom']);
			
			 miseAjourTraitement($bd, $_POST['nom'], $_POST['description'], $_POST['modalite'], $_GET['id-traitement']);
					
			if(!empty($_POST['pathologie'])){
					
						supprimerAncienLien($bd, $_GET['id-traitement'], $_GET['pathoAmodif']);						
						ajouterPathologieM($bd, $_POST['pathologie'], $_GET['id-traitement']);	
				}
			
			if(!empty($_POST['pathologie2'])){
				
						supprimerAncienLien($bd, $_GET['id-traitement'], $_GET['pathoAmodif2']);
						ajouterPathologieM($bd, $_POST['pathologie2'], $_GET['id-traitement']);		
			}

			if(!empty($_POST['pathologie3'])){
				
						supprimerAncienLien($bd, $_GET['id-traitement'], $_GET['pathoAmodif3']);			
						ajouterPathologieM($bd, $_POST['pathologie3'], $_GET['id-traitement']);
			}
			
			if(!empty($_POST['pathologie4'])){
				
						supprimerAncienLien($bd, $_GET['id-traitement'], $_GET['pathoAmodif4']);
						ajouterPathologieM($bd, $_POST['pathologie4'], $_GET['id-traitement']);					
				}

			if(!empty($_POST['pathologie5'])){
					
						supprimerAncienLien($bd, $_GET['id-traitement'], $_GET['pathoAmodif5']);				
						ajouterPathologieM($bd, $_POST['pathologie5'], $_GET['id-traitement']);
				} 
			
		}
		}

	?>
	</body>
</html>