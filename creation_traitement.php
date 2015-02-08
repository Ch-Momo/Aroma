<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Création d'un traitement</title>
	
  			<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
			<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css"/>
			<link rel="stylesheet" type="text/css" href="creation_traitement.css"/>

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	</head>
	
	
<body>
	<nav id="menu">
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

	<?php 
		require('connexion.php');
		//require("entete.php");
		require('fonctionsUsman.php');

	?>

	<body>


	
<?php
creationEtTestFormulaire($bd);
?>

<h2> Création d'un traitement </h2>
</br>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
		<p><label> Nom du traitement : *</label>
		</br> 
		<input type="text" name="nom" id="nom" autocomplete="off" autofocus required placeholder="Entrez le nom du traitement"/></p>
		<p><label> Pathologie : *</label><p> 
		<?php creerChampsPathologies($bd); ?>
		<p><label> Description du traitement : *</label>
		</br>
		<textarea name="description" cols="50" rows="7" required placeholder="Donnez une brève description du traitement..."></textarea></p>
		<p><label> Modalité : *</label>
		</br>
			<select name="modalite" size="3">
				<option value="1" selected>Voie cutanée</option>
				<option value="2">Voie orale</option>
				<option value="3">En diffusion</option>
			</select>
		</p>
		</br>
		<p><label> Lien image : </label>
		</br>
		<input type="text" name="image" id="image"/></p>
		</br>
		<p> Sélectionnez une image :<input type="file" name="image"/>  </p> 
		<p> <input type="submit" value="Créer un traitement" name="conf" id="confirmer" /></p>
</form>

<h2>Traitements de la base de données (brouillon)</h2>

<?php afficheTraitements($bd); 

?>
</div>
</body>

<? //php require("fin.php"); ?>
