<?php
require('connexion.php'); //Permet la connexion à la base de données
require('entete.php'); //En-tête html
require('fct.php'); //Ensemble de fonctions php
?>
<p>Vous allez faire une recherche dans notre base de donnees concernant les fonctions PHP. Tapez une requete pour realiser une recherche.</p>
<form action="resultat.php" method="Post">
<input type="text" name="requete" size="10">
<?php
for ($i = 1; $i <= 5; $i++) {
?>
<select name="propriete">
<option value="tous" selected="selected"> --- </option>
<?php SelectHuile($bd);?></select>
<?php } ?>
<input type="submit" value="Ok">
</form>
<?php require('fin.php'); ?>