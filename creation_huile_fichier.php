

<?php 
	require('connexion.php');
	require('fonctionsMomo.php');
	session_start();
?>
		<?php
			if(count($_POST)>0){
				$formSoumis=true;
			}
			else {
				$formSoumis=false;
			}
			
		?>


<!DOCTYPE HTML>
<html>
	<head>
		<title>Aroma - Création de plusieurs huiles</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		

		<script src="js/creation_huile.js"></script>
		
	</head>
	<body class="homepage">

		<?php
		ajouterHuiles($bd);
		?>	

							  			
							


	</body>
</html>
