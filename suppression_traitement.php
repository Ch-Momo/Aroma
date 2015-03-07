	<?php 
		require('connexion.php');
		require('fonctionsUsman.php');
		session_start();

	?>
	
<!DOCTYPE HTML>
<html>
	<head>
		<title>Aroma - Suppression d'un traitement</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.dropotron.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/creation_traitement.css" title="style" />
		<noscript>
		<link rel="stylesheet" href="css/skel.css" />
		<link rel="stylesheet" href="css/style.css" />
		</noscript>
		
		<script src="js/creation_traitement.js"></script>
		
	</head>
	
<body class="homepage">
		<?php
			require("menu.php");
		?>

<?php

if(isset($_POST['choixTrait']))
{
//si le choix a ete fait

$choixTrait = $_POST['choixTrait'];

 }

  else
  {
  $choixTrait='ererer';
  }
?>
<div id="main" class="wrapper style1">

	<form action="suppression_traitement.php?choixTrait=<?php echo $choixTrait;?>" method="post">
		<h2>Suppression d'un traitement : </h2>
		</br>
		<p><label> Traitement :</label>
				<select id="choixTrait" name = "choixTrait">
					<option></option><?php genereListboxTraitement($bd); ?>
				</select>
		</p>
		<p> <input type="submit" value="Choisir" /> </p>
	</form>


	<?php 
		if(isset($_POST['choixTrait']) && traitementExiste($bd,$_POST['choixTrait']))
		{
		afficheTraitementsSelonSelection($bd, $_POST['choixTrait']);
			
		affichePathologiesSelonSelection($bd, $_POST['choixTrait']);
		
	?>

	<form action="suppression_traitement.php" method="post">
			<input type="hidden" name="choixTrait" value="<?php echo $_POST['choixTrait'];?>"/></p>
		<p><input id="supp" type="submit" value="Supprimer" name="suppression"/></p></br>
	</form>


<?php
    }
    else
    {
?>

    <p>Veuillez choisir un traitement </p>.
<?php } ?>

<?php

    //Suppression d'un traitement ?
    $paramPost = array('suppression','choixTrait');
    if(testCles($paramPost,$_POST) && $_POST['suppression']=='Supprimer')
    {
        //On teste si le traitement existe
        if(traitementExiste($bd,$choixTrait))
			
        {	
			echo '<script type="text/javascript">';
			
			echo "alert('Le traitement a bien été supprimé');";
			
			echo '</script>';
			
	
            //On prend d'abord l id de traitement 	
			$idtraitement = recupererIdtraitement($bd, $choixTrait);
      	
            //Puis on supprime le lien entre traitment et pathologie sinon erreur !
            try
            {
                $req = $bd->prepare('DELETE from traitements_pathologies WHERE id_traitement=:idtraitement');
                $req->bindValue(':idtraitement',$idtraitement['id_traitement']);
                $req->execute();
                
            }
            catch(PDOException $e)
            {
                die('Erreur : ' . $e->getMessage());
            }	
			
            //Enfin on supprime le traitement
            supprimerTraitement($bd, $choixTrait);
			
        }
    }

?>
</div>
		<!-- Le Footer -->
			<div id="footer">
				
			</div>

</body>
</html>