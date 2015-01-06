<?php 
	require('connexion.php');
	require('fonctionsMomo.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
 <html>
  	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  		<title>Suppression d'une huile essentielle</title>
  	</head>
  	<body>
		<h2> Suppression d'une HE : </h2>
		<p> Veuillez sélectionner l'huile à modifier :</p>
		<form method="post">
			<?php
				if(isset($_POST['nom_huile_a_suppr'])){
					suppr_huile($bd,donnees_huile($bd,$_POST['nom_huile_a_suppr'])['nom_huile']);
				}
				echo '<select name="nom_huile_a_suppr">';
				listboxHuiles($bd);
				echo'</select>';
			?>
			<br/><br/><input type="submit" value="Supprimer l'huile"/>
		</form>
		<?php
			
		?>
	</body>

</html>