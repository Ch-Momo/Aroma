<?php
require('connexion.php'); //Permet la connexion à la base de données
require('entete.php'); //En-tête html
require('fct.php'); //Ensemble de fonctions php
?>
<?php
if (isset($_POST['requete'])and (trim($_POST['requete'])!="")){
$requete = htmlspecialchars($_POST['requete']);
/* ont compte s'il y a bien des huiles qui corresponde a la recherche via le formulaire */
$req = $bd->prepare("SELECT COUNT(*) as nb FROM huiles WHERE nom_huile LIKE \"%$requete%\" OR nom_latin LIKE \"%$requete%\" ");
$req->execute(array());
$resultat = $req->fetch();
/* S'il n'y a rien on préviens l'utilisateur*/
if ($resultat['nb'] == 0) {
echo 'Aucun produits trouvé pour votre recherche : '.$requete;
} else {
/* S'il y a des enregistremets on affiche */
$req2 = $bd->prepare('SELECT * FROM huiles WHERE nom_huile LIKE "%'.$requete.'%"');
$req2->execute(array());
while ($donnees = $req2->fetch()) {
// ICI C'EST LE LIEN
echo '<a href="fiche_produit.php?produit='.$donnees['id_huile'].'">'.$donnees['nom_huile'].'</a> <br/>';
} //Fin while $req2
} //Fin else
}
?>
<?php require('fin.php'); ?>