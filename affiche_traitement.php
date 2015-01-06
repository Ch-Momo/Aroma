
<?php
	$req = $bd->prepare('SELECT * FROM traitements;');
	$req->execute();
	while($res = $req->fetch(PDO::FETCH_ASSOC))
		echo '<p> n:0'. $res['id_traitement'] . '  ' . $res['nom_traitement'] . '<br>' . $res['Desc_traitement'] . '</p>';
?>
