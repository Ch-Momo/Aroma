<?php

		session_start();
		
		
		$_SESSION['pageEnCours']='page_traitement.php';
		
		//vérifie si le visiteur s'est identifié (user ou admin)
		if($_SESSION['statut']!=1&&$_SESSION['statut']!=2)
			header('Location: page_connexion.php');
		
		//connexion à la bd
		require('connexion.php');

		$req = $bd->prepare('SELECT nom_traitement FROM traitements');
		$req->execute();
		
		//barre de recherche
		echo '	<form method="post" action="recherche_traitement.php">
					<p>
						<label for="rechercheTraitement">Tapez ici le traitement recherché :</label>
						<input list="traitements" type="text" name="rechercheTraitement" id="rechercheTraitement" autofocus>
						<datalist id="traitements">';
		while($res = $req->fetch(PDO::FETCH_ASSOC))
			echo '			<option value="' . $res[nom_traitement] . '">';
		echo '			</datalist>
						<br />
						<input type="submit" value="Chercher" />
					</p>
				</form>';
				
		//affichage de tous les traitements
		require('affiche_traitement.php');
?>
