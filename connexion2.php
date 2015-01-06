<?php

session_start();

try
{
	$bd = new PDO('mysql:host=localhost;dbname=aromes', $_POST['pseudo'], $_POST['pass']);
	$bd->query('SET NAMES utf8');
	$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "<p> Connexion réussie! Redirection en cours.</p>";
	
	$_SESSION['pseudo']=$_POST['pseudo'];
	$_SESSION['pass']=$_POST['pass'];
	
	//regarde si l'utilisateur est un administrateur
	//$req = $bd->prepare('SELECT login FROM administrateurs_modérateurs');
	//$req->execute();
	//$res = $req->fetch(PDO::FETCH_ASSOC);
	//if($res==$_SESSION['pseudo'])
	//	$_SESSION['statut']=2;
	//else
		$_SESSION['statut']=1;
	
	//redirection vers la page qui demandait l'identification.
	header("Refresh: 2;http://localhost/main/".$_SESSION['pageEnCours']);
}
catch (PDOException $e)
{
   // On termine le script en affichant le n de l'erreur ainsi que le message 
    die('<p> La connexion a échoué. Erreur[' .$e->getCode().'] : ' .$e->getMessage() . '</p>');
}


?>
