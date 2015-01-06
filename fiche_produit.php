<?php
require('connexion.php'); //Permet la connexion à la base de données
require('entete.php'); //En-tête html
require('fct.php'); //Ensemble de fonctions php
?>
<?php
if (isset($_GET['produit'])and (trim($_GET['produit'])!="")){
$produit=$requete = htmlspecialchars($_GET['produit']);
$req = $bd->prepare("SELECT * FROM huiles WHERE id_huile = :id_huile");
$req->bindValue(':id_huile', $produit);
$req->execute();
while ($donnees = $req->fetch()) {
// ICI C'EST LE LIEN
echo '<p> nom: '.$donnees['nom_huile'].'<br/> nom latin: '.$donnees['nom_latin'].'<br/>'.'conseil :'.$donnees['conseils'].'</p><br/>';
} //Fin wh
}
?>