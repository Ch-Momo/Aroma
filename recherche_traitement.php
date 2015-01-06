<?php

session_start();

require('connexion.php');

$cherche = '\''.$_POST['rechercheTraitement'].'\'';

$req = $bd->prepare('SELECT nom_traitement,Desc_traitement FROM traitements WHERE nom_traitement LIKE '.$cherche);
$req-> execute();
$res = $req->fetch(PDO::FETCH_ASSOC);

echo '<p> Nom: '.$res['nom_traitement'].'<br />Description: <br />'.$res['Desc_traitement'].'</p>';

?>
