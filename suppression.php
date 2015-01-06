<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<title>Suppression d'un traitement</title>
<!-- <link rel="stylesheet" href="style.css"> -->
</head>
<body>
<?php
require('connexion.php');
//require('entete.php');
require('fonctions.php');
?>
<?php
if(isset($_POST['choixTrait']))
{
//si le choix a ete fait
$choixTrait = $_POST['choixTrait'];
}
else
{
$choixTrait='ererer';
}
?>
<form action="suppression.php?choixTrait=<?php echo $choixTrait;?>" method="post">
<h2>Suppression d'un traitement : </h2>
</br>
<p><label> Traitement :</label> <input list="choixTrait" name="choixTrait" />
<datalist id="choixTrait">
<option></option><?php genereListboxTraitement($bd); ?>
</datalist>
</p>
<p> <input type="submit" value="Choisir" /> </p>
</form>
<?php
if(isset($_POST['choixTrait']) && traitementExiste($bd,$_POST['choixTrait']))
{
afficheTraitementsSelonSelection($bd, $_POST['choixTrait']);
echo '</br><p>Ce traitement est associé aux pathologies suivantes : </p></br>';
affichePathologiesSelonSelection($bd, $_POST['choixTrait']);
?>
<form action="suppression.php" method="post">
<p> Voulez-vous vraiment supprimer le traitement <?php echo $_POST['choixTrait'] . ' '; ?> ?
<input type="hidden" name="choixTrait" value="<?php echo $_POST['choixTrait'];?>"/></p>
<p><input type="submit" value="oui" name="suppression"/><input type="submit" value="non" name="suppression"/></p>
</form>
<?php
}
else
{
?>
<p>Veuillez choisir un traitement </p>.
<?php } ?>
<?php
//Suppression d'un traitement ?
$paramPost = array('suppression','choixTrait');
if(testCles($paramPost,$_POST) && $_POST['suppression']=='oui')
{
//On teste si le traitement existe
if(traitementExiste($bd,$choixTrait))
{ echo '<p>Le traitement a bien été supprimé. Par conséquent, il n\'existe plus.</p>';
echo '<p> Retourner à la <a href="suppression.php">liste des traitements ?</a>';
//On prend d'abord l id de traitement
$idtraitement = recupererIdtraitement($bd, $choixTrait);
//Puis on supprime le lien entre traitment et pathologie sinon erreur !
try
{
$req = $bd->prepare('DELETE from traitements_pathologies WHERE id_traitement=:idtraitement');
$req->bindValue(':idtraitement',$idtraitement['id_traitement']);
$req->execute();
}
catch(PDOException $e)
{
die('Erreur : ' . $e->getMessage());
}
//Enfin on supprime le traitement
supprimerTraitement($bd, $choixTrait);
}
}
?>
<?php// require("fin.php"); ?>
</body>