<?php 
	require('connexion.php'); //Permet la connexion à la base de données
	require('fct.php'); //Ensemble de fonctions php
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Aroma - Recherche d'une huile</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
		
		<link rel="stylesheet" href="print.css" type="text/css" media="print" />
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.dropotron.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<link rel="stylesheet" type="text/css" href="css/recherche.css" title="style" />
		<noscript>
		<link rel="stylesheet" href="css/skel.css" />
		<link rel="stylesheet" href="css/style.css" />
		</noscript>
		
		<script src="js/creation_huile.js"></script>
		<!-- news --> 
		
		<link href="styles.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

		 <script src="jquery.colorbox.js"></script>
        <link rel="stylesheet" href="colorbox.css" />
       
        
		<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-45747360-1', 'invitationaudelice.com');
  ga('send', 'pageview');

</script>
       <meta property="fb:admins" content="1273194046" />
        
 <script>
			$(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				$(".group1").colorbox({rel:'group1'});
				$(".group2").colorbox({rel:'group2', transition:"fade"});
				$(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
				$(".group4").colorbox({rel:'group4', slideshow:true});
				$(".ajax").colorbox();
				$(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
				$(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
				$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
				$(".inline").colorbox({inline:true, width:"50%"});
				$(".callbacks").colorbox({
					onOpen:function(){ alert('onOpen: colorbox is about to open'); },
					onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
					onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
					onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
					onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
				});

				$('.non-retina').colorbox({rel:'group5', transition:'none'})
				$('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
				
				//Example of preserving a JavaScript event for inline calls.
				$("#click").click(function(){ 
					$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
			});
		</script>
       
<script>

$(document).ready(function() {

	//move the image in pixel
	var move = -15;
	
	//zoom percentage, 1.2 =120%
	var zoom = 1.2;

	//On mouse over those thumbnail
	$('.item').hover(function() {
		
		//Set the width and height according to the zoom percentage
		width = $('.item').width() * zoom;
		height = $('.item').height() * zoom;
		
		//Move and zoom the image
		$(this).find('img').stop(false,true).animate({'width':width, 'height':height, 'top':move, 'left':move}, {duration:200});
		
		//Display the caption
		$(this).find('div.caption').stop(false,true).fadeIn(200);
	},
	function() {
		//Reset the image
		$(this).find('img').stop(false,true).animate({'width':$('.item').width(), 'height':$('.item').height(), 'top':'0', 'left':'0'}, {duration:100});	

		//Hide the caption
		$(this).find('div.caption').stop(false,true).fadeOut(200);
	});

});

</script>

</head>
<body class="homepage">
		<?php
			require("menu.php");
		?>
		<!-- Le contenu -->
			<div id="main" class="wrapper style1">
				
				<h2 id="titre"> <img  id="huile" src="images/huile.png" width="100" length="100"/> <span id="titre">Cr&egraveation d'une huile essentielle : </p></h2><br/>
	
         
         <?php
if (isset($_POST['requete'])and (trim($_POST['requete'])!=""))
{
	
			$requete = htmlspecialchars($_POST['requete']);
			
		/* ont compte s'il y a bien des huiles qui corresponde a la recherche via le formulaire */
		$req = $bd->prepare("SELECT COUNT(*) as nb FROM huiles WHERE nom_huile LIKE \"%$requete%\" OR nom_latin LIKE \"%$requete%\" ");
		$req->execute(array());
		$resultat = $req->fetch();

		/* S'il n'y a rien on préviens l'utilisateur*/
	if ($resultat['nb'] == 0) {
		echo 'Aucun produits trouvé pour votre recherche'.$requete;
	} 
	else
	{
		/* S'il y a des enregistremets on affiche */
		$req2 = $bd->prepare('SELECT * FROM huiles WHERE nom_huile LIKE "%'.$requete.'%"');
		$req2->execute(array());
		echo ' <p>voici les resultat de la recherche :</p></br>';
		
		echo'<table width="1020" border="0" cellspacing="5" cellpadding="5" bgcolor="#FFF"><tr>';
		while ($donnees = $req2->fetch())
		{
			echo' <td>';
    echo'<div class="item">';
   echo '<img  src="images/huiles/'.$donnees['image'].'" alt="" width="175" height="175"/></a>';
    echo'<div class="caption">';
        echo '<br />'.$donnees['nom_huile'].'<p class="caption2"><br /><br /><br /><a href="fiche_produit.php?produit='.$donnees['id_huile'].'" style="font-size:20px; text-decoration:underline;">Fiche produit</a><br /></p>';
		
    echo'</div>';
	 
	echo '</div>';
	echo'<p  class="ph">'.$donnees['nom_huile'].'</p>'; 
    echo' </td>';
	
		} //Fin while $req2
	
	echo'</tr></table>';} //Fin else
}
else if (isset($_POST['propriete']) )
{
		$tab=$_POST['propriete'];
		if($tab==0){
			echo 'aucun resultat pour les proprietes';}
			else
{		echo ' <p>voici les resultats de la recherche :</p></br>';
		foreach($tab as $valeur)
	{
		$sql =$bd->prepare('SELECT * FROM huiles natural join proprietes natural join huiles_proprietes WHERE nom_propriete = :propriete GROUP BY nom_huile');
        $sql->bindValue(':propriete',$valeur);
		$sql->execute();
		echo'<table width="1020" border="0" cellspacing="5" cellpadding="5" bgcolor="#FFF"><tr>';
		while ($donnees = $sql->fetch())
		{
			echo' <td>';
    echo'<div class="item">';
   echo '<img  src="images/huiles/'.$donnees['image'].'" alt="" width="175" height="175"/></a>';
    echo'<div class="caption">';
        echo '<br />'.$donnees['nom_huile'].'<p class="caption2"><br /><br /><br /><a href="fiche_produit.php?produit='.$donnees['id_huile'].'" style="font-size:20px; text-decoration:underline;">Fiche produit</a><br /></p>';
		
    echo'</div>';
	 
	echo '</div>';
	echo'<p  class="ph">'.$donnees['nom_huile'].'</p>'; 
    echo' </td>';
	
		} //Fin while $req2
	
	echo'</tr></table>'; //Fin else
	} //Fin while 
}
} //Fin else
else {
?>				

<p>recherchee par nom d'huiles</p>
 <form action="form-recherche.php" method="Post">
<input type="text" name="requete" size="10">
<input id="recherche" type="submit" value="Recherhce"> 
</form>

<p> recherche par propriete </p>
 <form id='propriete' action="form-recherche.php" method="Post">
 <?php
   for ($i = 1; $i <= 5; $i++) {
   ?>
   <select name="propriete[]" style="width:10px">
<option selected="selected"> --- </option>
<?php SelectHuile($bd);?></select>
<?php } ?>
<input id="recherche2" type="submit" value="Recherhce"> 
</form>
<?php } ?>

 
       
    </div>
		
			</div>
		<!-- Le Footer -->
			<div id="footer">
				
			</div>
			

	</body>
	
</html>
