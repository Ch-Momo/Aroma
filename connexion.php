<?php

try{
	header("Content-Type: text/html; charset=utf-8");
	$bd=new PDO('mysql:host=localhost;dbname=Aroma','Momo','mohammedoujda');
	$query=$bd->prepare('USE Aroma');
	$query->execute();
	$bd->exec('SET NAMES utf8');
	$bd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e){
	echo $e->getMessage();
}
?>
