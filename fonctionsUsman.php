<?php
function afficheTraitements($bd)
{
try
{
$req = $bd->prepare('SELECT * FROM traitements');
$req->execute();
echo '<table>' . "\n";
$res = $req->fetch(PDO::FETCH_ASSOC);
//Il y a au moins une ligne
if($res)
{
//On affiche les en-têtes
echo '<tr>'."\n";
foreach($res as $c => $v)
echo '<th>' . $c . '</th>';
echo '</tr>'."\n";
//On affiche la première ligne
echo '<tr>'."\n";
foreach($res as $v)
echo '<td>' . $v . '</td>';
echo '</tr>'."\n";
while($res = $req->fetch(PDO::FETCH_ASSOC))
{
echo '<tr>'."\n";
foreach($res as $v)
echo '<td>' . $v . '</td>';
echo '</tr>'."\n";
}
}
else
echo 'Aucun traitements dans la base de données';
}
catch(PDOException $e)
{
// On termine le script en affichant le n de l'erreur ainsi que le message
die('<p> La connexion a échoué. Erreur[' .$e->getCode().'] : ' .$e->getMessage() . '</p>');
}
catch(Exception $e)
{
echo 'Problème !!!';
}
echo '</table>'."\n";
}
//Teste si il existe un traitement, si oui retourne true sinon false
function traitementExiste($bd, $nom)
{
try
{
$req = $bd->prepare('SELECT * from traitements where nom_traitement = :nom ');
$req->bindValue(':nom',$nom);
$req->execute();
return $req->fetch() != false;
}
catch(PDOException $e)
{
die('ERREUR : ' . $e->getMessage());
}
}
function pathoExiste($bd, $patho)
{
try
{
$req = $bd->prepare('SELECT * from pathologies where nom_pathologie=:patho');
$req->bindValue(':patho',$patho);
$req->execute();
return $req->fetch() != false;
}
catch(PDOException $e)
{
die('ERREURddf : ' . $e->getMessage());
}
}
//Teste si les valeurs du premier tableau ($cle) sont des clés du deuxième et si les valeurs ne sont pas vides
//En gros, on teste si l'utilisateur rentre de bonnes valeurs et ne laisse pas d'espace.
function testCles($cle,$tab)
{
foreach($cle as $v)
if(!isset($tab[$v]) or trim($tab[$v])== '')
return false;
return true;
}
function genereListboxTraitement($bd)
{
try
{
$req = $bd->prepare('SELECT DISTINCT nom_traitement FROM traitements ORDER BY nom_traitement');
$req->execute();
while($res = $req->fetch(PDO::FETCH_NUM))
echo '<option> '. $res['0'] . '</option>'."\n";
}
catch(PDOException $e)
{
// On termine le script en affichant le num de l'erreur ainsi que le message
die('<p> La connexion a échoué. Erreur[' .$e->getCode().'] : ' .$e->getMessage() . '</p>');
}
}
function genereListboxPathologie($bd)
{
try
{
$req = $bd->prepare('SELECT DISTINCT nom_pathologie FROM pathologies ORDER BY nom_pathologie');
$req->execute();
while($res = $req->fetch(PDO::FETCH_NUM))
echo '<option> '. $res['0'] . '</option>'."\n";
}
catch(PDOException $e)
{
die('<p> La connexion a échoué. Erreur[' .$e->getCode().'] : ' .$e->getMessage() . '</p>');
}
}
function afficheTraitementsSelonSelection($bd, $selection)
{
try
{
$sql = 'SELECT * FROM traitements where nom_traitement=:selection';
$req = $bd->prepare($sql);
$req->bindValue(':selection',$selection);
$req->execute();
echo '<table>' . "\n";
$res = $req->fetch(PDO::FETCH_ASSOC);
//Il y a au moins une ligne
if($res)
{
//On affiche les en-têtes
echo '<tr>'."\n";
foreach($res as $c => $v)
echo '<th>' . $c . '</th>';
//On affiche la première ligne
echo '<tr>'."\n";
foreach($res as $v)
echo '<td>' . $v . '</td>';
while($res = $req->fetch(PDO::FETCH_ASSOC))
{
echo '<tr>'."\n";
foreach($res as $v)
echo '<td>' . $v . '</td>';
}
}
}
catch(PDOException $e)
{
die('ERREUR : ' . $e->getMessage());
}
echo '</table>'."\n";
}
function affichePathologiesSelonSelection($bd, $nom)
{
try
{
$sql2 = 'SELECT nom_pathologie FROM pathologies natural join traitements natural join traitements_pathologies where nom_traitement=:nom';
$req = $bd->prepare($sql2);
$req->bindValue(':nom',$nom);
$req->execute();
echo '<table>' . "\n";
$res = $req->fetch(PDO::FETCH_ASSOC);
//Il y a au moins une ligne
if($res)
{
//On affiche les en-têtes
echo '<tr>'."\n";
foreach($res as $c => $v)
echo '<th>' . $c . '</th>';
//On affiche la première ligne
echo '<tr>'."\n";
foreach($res as $v)
echo '<td>' . $v . '</td>';
while($res = $req->fetch(PDO::FETCH_ASSOC))
{
echo '<tr>'."\n";
foreach($res as $v)
echo '<td>' . $v . '</td>';
}
}
}
catch(PDOException $e)
{
die('ERREUR : ' . $e->getMessage());
}
echo '</table>'."\n";
}
function ajouterPathologie($bd, $pathologie, $idtraitement){
if(pathoExiste($bd, $pathologie)){
$sql2 = 'SELECT id_pathologie from pathologies where nom_pathologie=:pathologie';
try
{
$req = $bd->prepare($sql2);
$req->bindValue('pathologie',htmlentities($pathologie));
$req->execute();
$idpathologie=$req->fetch(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
die('Erreur71 : ' . $e->getMessage());
}
}
else{
$sql2 = 'INSERT INTO pathologies (nom_pathologie) VALUES (:pathologie)';
try
{
$req = $bd->prepare($sql2);
$req->bindValue(':pathologie',htmlentities($pathologie));
$req->execute();
}
catch(PDOException $e)
{
die('Erreur119 : ' . $e->getMessage());
}
//On récupère l id de pathologie
$sql22 = 'SELECT id_pathologie from pathologies where nom_pathologie=:pathologie';
try
{
$req = $bd->prepare($sql22);
$req->bindValue(':pathologie',htmlentities($pathologie));
$req->execute();
$idpathologie=$req->fetch(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
die('Erreur136 : ' . $e->getMessage());
}
}
//On fait une dernière requete pour lier traitement et pathologie.
$sql222 = 'INSERT INTO traitements_pathologies (id_traitement, id_pathologie) VALUES (:idtraitement, :idpathologie)';
try
{
$req = $bd->prepare($sql222);
$req->bindValue(':idtraitement',htmlentities($idtraitement['id_traitement']));
$req->bindValue(':idpathologie',htmlentities($idpathologie['id_pathologie']));
$req->execute();
}
catch(PDOException $e)
{
die('Erreur71 : ' . $e->getMessage());
}
}
function creerTraitement($bd, $nom, $decription, $modalite, $image, $video){
$sql = 'INSERT INTO traitements (nom_traitement, Desc_traitement, id_modalite, image, video) VALUES (:nom, :description, :modalite, :image, :video)';
try
{
$req = $bd->prepare($sql);
$req->bindValue(':nom',htmlentities($nom));
$req->bindValue(':description',htmlentities($decription));
$req->bindValue(':modalite',htmlentities($modalite));
$req->bindValue(':image',htmlentities($image));
$req->bindValue(':video',htmlentities($video));
$req->execute();
}
catch(PDOException $e)
{
die('Erreur51 : ' . $e->getMessage());
}
}
function recupererIdtraitement($bd, $nom){
//On récupere l id de traitement
$sql32 = 'SELECT id_traitement from traitements where nom_traitement=:nom';
try
{
$req = $bd->prepare($sql32);
$req->bindValue(':nom',htmlentities($nom));
$req->execute();
$idtraitement=$req->fetch(PDO::FETCH_ASSOC);
return $idtraitement;
}
catch(PDOException $e)
{
die('Erreur153 : ' . $e->getMessage());
}
}
function miseAjourPathologies($bd, $pathologie){
$sql22 = 'SELECT id_pathologie from pathologies where nom_pathologie=:pathologie';
try
{
$req = $bd->prepare($sql22);
$req->bindValue(':pathologie',htmlentities($pathologie));
$req->execute();
$idpathologieMAJ=$req->fetch(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
die('Erreur136 : ' . $e->getMessage());
}
$sql2='UPDATE pathologies SET nom_pathologie=:pathologie WHERE id_pathologie=:idpathologieMAJ';
try
{
$req = $bd->prepare($sql2);
$req->bindValue(':idpathologieMAJ',htmlentities($idpathologieMAJ));
$req->execute();
echo '<p>Pathologie mise à jour avec succès !</p>';
}
catch(PDOException $e)
{
die('Erreur : ' . $e->getMessage());
}
}
function miseAjourTraitement($bd, $nom, $decription, $modalite, $image, $video){
$sql = 'UPDATE traitements SET nom_traitement=:nom, Desc_traitement=:description, id_modalite=:modalite, image=:image, video=:video WHERE id_traitement=:idtraitement';
try
{
$req = $bd->prepare($sql);
$req->bindValue(':nom',htmlentities($nom));
$req->bindValue(':description',htmlentities($decription));
$req->bindValue(':modalite',htmlentities($modalite));
$req->bindValue(':image',htmlentities($image));
$req->bindValue(':video',htmlentities($video));
$req->execute();
echo '<p>MAJ effectué avec succès !</p>';
}
catch(PDOException $e)
{
die('Erreur MAJ : ' . $e->getMessage());
}
}
function supprimerTraitement($bd, $nom){
try
{
$req = $bd->prepare('DELETE from traitements WHERE nom_traitement = :nom');
$req->bindValue(':nom',$nom);
$req->execute();
}
catch(PDOException $e)
{
die('Erreur : ' . $e->getMessage());
}
}
?>