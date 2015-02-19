<?php
	try
	{
	  $bd= new PDO('pgsql:host=aquanux;dbname=11310270','11310270','0JYJQN02CE4');
	  $bd->query('SET NAMES utf8');
	  $bd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		die('<p>La connexion a échoué. Erreur['.$e->getcode().'] : '.$e->getMessage().'</p>');
	}
?>
