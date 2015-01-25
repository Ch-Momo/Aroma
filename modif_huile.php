<?php 
	require('connexion.php');
	require('fonctionsMomo.php');
	session_start();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
 <html>
  	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  		<title>Modification d'une huile essentielle</title>
  	</head>
  	<body>
		<h2> Modification d'une HE : </h2>
		<p> Veuillez sélectionner l'huile à modifier :</p>
		<form method="post">
			<?php
				echo '<select name="nom_huile_a_modif">';
				listboxHuiles($bd);
				echo'</select>';
			?>
			<br/><br/><input type="submit" value="Afficher les caractéristiques"/>
		</form>
		<?php
			$modifiee=false;
			if(count($_POST)>1){
				if(isset($_POST['nom'])and isset($_POST['nom_latin'])and isset($_POST['famille'])and isset($_POST['organe'])and isset($_POST['origine_geo'])and isset($_POST['constituant1'])and isset($_POST['constituant2'])and isset($_POST['constituant3'])and isset($_POST['constituant4'])and isset($_POST['constituant5'])and isset($_POST['notation1'])and isset($_POST['notation2'])and isset($_POST['notation3'])and isset($_POST['notation4'])and isset($_POST['notation5'])and isset($_POST['propriete1'])and isset($_POST['propriete2'])and isset($_POST['propriete3'])and isset($_POST['propriete4'])and isset($_POST['propriete5'])and isset($_POST['pourcentage1'])and isset($_POST['pourcentage2'])and isset($_POST['pourcentage3'])and isset($_POST['pourcentage4'])and isset($_POST['pourcentage5'])and isset($_POST['conseils'])and isset($_POST['indications'])and isset($_POST['modeEmploi'])and isset($_POST['message_energetique'])and isset($_POST['image'])and isset($_POST['video'])){

					$formValide=verification_formulaire_creation_huile($bd,$_POST);
					if($formValide==true){
							if(isset($_SESSION['nom_huile_modifiee'])){
								if($_SESSION['nom_huile_modifiee']!=$_POST['nom'])
									suppr_huile($bd,$_SESSION['nom_huile_modifiee']);
								else
									suppr_huile($bd,$_POST['nom']);
							}
							creation_huile($bd,$_POST);
							echo '<p> <strong> L\'huile a bien été modifiée. </strong></p>';
							$modifiee=true;
					}
				}
				else{
					echo '<p> Veuillez remplir tous les champs nécessaires.</p>';
				}
			}


			if(isset($_POST['nom_huile_a_modif']) and $_POST['nom_huile_a_modif']!='empty' and $modifiee==false){//premier submit
				formulaire_modification_huile($bd,donnees_huile($bd,$_POST['nom_huile_a_modif']));
				$_SESSION['nom_huile_modifiee']=$_POST['nom_huile_a_modif'];
			}
			else if(isset($_POST['nom']) and $modifiee==false){//deuxieme submit
				formulaire_modification_huile($bd,donnees_huile($bd,$_SESSION['nom_huile_modifiee	']));
			}
		?>
	</body>

</html>