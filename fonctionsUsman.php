<?php

function creerChampsPathologies($bd){
	
		echo '<input class="nom_patho" list="pathologie" name="pathologie" id="pathoTest" required type="text" autocomplete="off" placeholder="Entrez pathologie 1" value="';
		if (isset($_POST['pathologie'])){echo $_POST['pathologie'];}
			echo '"/><span id="messagePatho" class="invalide">Champ invalide</span><datalist id="pathologie"><option></option>';
		genereListboxPathologie($bd);
		echo '</datalist></br></br>';
		
	$i=2;
	while($i<6){
		echo '<input class="nom_patho" list="pathologie'.$i.'" name="pathologie'.$i.'" id="pathoTest'.$i.'" required type="text" autocomplete="off" placeholder="Entrez pathologie '.$i.'" value="';
		if (isset($_POST['pathologie'.$i])){echo $_POST['pathologie'.$i];}
		echo '" /><span id="messagePatho'.$i.'" class="invalide">Champ invalide</span><datalist id="pathologie'.$i.'"><option></option>';
		genereListboxPathologie($bd);
		echo '</datalist></br></br>';
		$i++;
	}
	
}

function modifierChampsPathologies($bd, $pathoAmodif){
	
		echo '<input class="nom_patho" list="pathologie" name="pathologie" id="pathoTest" required type="text" placeholder="Entrez pathologie 1" value="'.$pathoAmodif[0].'"/><span id="messagePatho" class="invalide">Champ invalide</span><datalist id="pathologie"><option></option>';
		genereListboxPathologie($bd);
		echo '</datalist></br></br>';
		
	$i=2;
	$j=1;
	while($i<6 && $j<5){
		echo '<input class="nom_patho" list="pathologie'.$i.'" name="pathologie'.$i.'" id="pathoTest'.$i.'" required type="text" placeholder="Entrez pathologie '.$i.'" value="'.$pathoAmodif[$j].'"/><span id="messagePatho'.$i.'" class="invalide">Champ invalide</span><datalist id="pathologie'.$i.'"><option></option>';
		genereListboxPathologie($bd);
		echo '</datalist></br></br>';
		$i++;
		$j++;
	}
	
}



function listboxModalite($bd){
	try{
		$req=$bd->prepare('SELECT * FROM modalites;');
		$req->execute();
		$i=0;
		echo '<div class="modal-2">';
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			echo '<div class="checkbox inline">';
			echo '';
			echo'<input type="checkbox" name="modalite[]" value="'.$rep['nom_modalite'].'" /> <label>'.$rep['nom_modalite'].'</label>';
			echo '</div>';
		}
		echo '</div>';
	}catch(PDOException $e){
		die('Erreur ! '.$e->getMessage().'</body></html>');
	}
}



function listboxModaliteRempli($bd, $tab){
	try{
		
		/*
			Pour avoir le(s) id de(s) modalite associés au traitement.
		*/
		$req=$bd->prepare('select * from traitements_modalites where id_traitement=:id_traitement');
		$req->bindValue(':id_traitement',$tab);
		$req->execute();
		$id_traitement=array();
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			$id_modalite[]=$rep['id_modalite'];
		}
		$req=$bd->prepare('SELECT*FROM modalites;');
		$req->execute();
		echo '<div class="modal-2">';
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			echo '<div class="checkbox inline">';
			if(in_array($rep['id_modalite'],$id_modalite)){
				echo'<input type="checkbox" name="modalite[]" value="'.$rep['nom_modalite'].'" checked ><label><p>'.$rep['nom_modalite'].'</label>';
			}
			else{
				echo'<input type="checkbox" name="modalite[]" value="'.$rep['nom_modalite'].'"><label><p>'.$rep['nom_modalite'].'</label>';
			}
			echo '</div>';
	}
	echo '</div>';
	}catch(PDOException $e){
		die('Erreur ! '.$e->getMessage().'</body></html>');
	}
}


function supprimerModalite($bd, $idtraitement)
{
	try
	{
		$req = $bd->prepare('DELETE from traitements_modalites WHERE id_traitement = :id_traitement');
		$req->bindValue(':id_traitement',$idtraitement);
		$req->execute();
	}
	
	catch(PDOException $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
	
}



function creationEtTestFormulaire($bd){

	if (!empty($_POST))
	{
	 if(isset($_POST['conf']))
	 {
				
		$dossier = 'images_traitements/';
		$fichier = basename($_FILES['image']['name']);
		$taille_maxi = 10000000;
		$taille = filesize($_FILES['image']['tmp_name']);
		$extensions = array('.png', '.gif', '.jpg', '.jpeg');
		$extension = strrchr($_FILES['image']['name'], '.');
		
		
		//verifier si les champs pathologies ne sont pas identiques
		$i=2;
		$identique = false;
		while($i<6)
		{
			$j=$i+1;
			while($j<6)
			{
				if(($_POST['pathologie'.$i])==($_POST['pathologie'.$j]))
				{
					$identique = true;
					
				}
				$j++;
			}
			$i++;
		}
		
		$z=0;
		while($z<5)
		{
			$j=2;
			while($j<6)
			{
				if(($_POST['pathologie'])==($_POST['pathologie'.$j]))
				{
					$identique = true;
					
				}
				$j++;
			}
			$z++;
		}
		
		
		if(($identique==true) || (traitementExiste($bd, $_POST['nom'])) || trim($_POST['pathologie'])=='' || trim($_POST['pathologie2'])=='' || trim($_POST['pathologie3'])=='' || trim($_POST['pathologie4'])=='' || trim($_POST['pathologie5'])=='' || !isset($_POST["modalite"]) || ($taille>$taille_maxi) || !($_FILES['image']['name']))
		{
		
			if(trim($_POST['description'])=='')
				
				echo  "<b>Le champ description est vide !</b>";
			
			if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
			{
				echo '<p><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Ce format de fichier n\'est pas pris en charge<br/></p>';
			}
			
			if(!isset($_POST["modalite"]))
			{
				echo '<p><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Veuillez choisir au moins une modalite<br/></p>';	
			}
			
			if($taille>$taille_maxi)
			{
				echo '<p><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Fichier trop volumineux<br/></p>';
			}
			
			if(!($_FILES['image']['name']))
			{
				echo '<p><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Veuillez choisir une image<br/></p>';
			}
			
			if(traitementExiste($bd, $_POST['nom']))
			{
				echo '<p><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Ce traitement existe déjà<br/></p>';
			}
			
			if($identique==true) //Si l'extension n'est pas dans le tableau
			{
				echo '<p><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Veuillez choisir des pathologies différentes<br/></p>';
			}			
		
		}
		else
			{
			//Si le traitement existe déjà, renvoie message d'erreur

				
			//Sinon on crée le traitement
				
					$dossier = 'images_traitements/';
					$fichier = basename($_FILES['image']['name']);
					$taille_maxi = 10000000;
					$taille = filesize($_FILES['image']['tmp_name']);
					$extensions = array('.png', '.gif', '.jpg', '.jpeg');
					$extension = strrchr($_FILES['image']['name'], '.');
			
			
					
					//Début des vérifications de sécurité...

				
					 $fichier = strtr($fichier, 
						  'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
						  'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
					 $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
					 if(move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
					 {
						  $_POST['image']=$fichier;
					 }
					 else //Sinon (la fonction renvoie FALSE).
					 {
							echo  "<b>Le fichier n'a pas été correctement chargé</b>";
					 }
					   
					   
					   
					creerTraitement($bd, $_POST['nom'], $_POST['description'], $_POST['image']);
					
					$idtraitement = recupererIdtraitement($bd, $_POST['nom']);
					
					$idtrait = intval($idtraitement['id_traitement']);
					
					ajouterModaliteTraitement($bd, $_POST, $idtrait);

					ajouterPathologie($bd, $_POST['pathologie'], $idtrait);


					echo '<div class="alert alert-success" role="alert"><strong> Le traitement a bien été ajouté </strong></p></div>';
					

					if(!empty($_POST['pathologie2'])){
						
					ajouterPathologie($bd, $_POST['pathologie2'], $idtrait);
					
					}
							
					if(!empty($_POST['pathologie3'])){
								
					ajouterPathologie($bd, $_POST['pathologie3'], $idtrait);

					}
							
					if(!empty($_POST['pathologie4'])){
						
					ajouterPathologie($bd, $_POST['pathologie4'], $idtrait);
					
					}
						
					if(!empty($_POST['pathologie5'])){				
						
					ajouterPathologie($bd, $_POST['pathologie5'], $idtrait);

					}
				
				
		
		}
	}
  }
}


function verificationFormulaireModifier($bd, &$tab)
{
	
	if(isset($tab['valider']))//bouton 'Valider' en fait
		{
			
			$dossier = 'images_traitements/';
			$fichier = basename($_FILES['image']['name']);
			$taille_maxi = 10000000;
			$taille = filesize($_FILES['image']['tmp_name']);
			$extensions = array('.png', '.gif', '.jpg', '.jpeg');
			$extension = strrchr($_FILES['image']['name'], '.');
				
			if(trim($tab['pathologie'])=='' or trim($tab['pathologie2'])=='' or trim($tab['pathologie3'])=='' or trim($tab['pathologie4'])=='' or trim($tab['pathologie5'])=='' or trim($tab['description'])=='' or !isset($tab['modalite']))
			{

				if(trim($tab['nom'])=='')
				{
					echo '<p><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Veuillez ajouter un nom.<br/></p>';
				}
								
				if((trim($tab['pathologie'])=='' || trim($tab['pathologie2'])=='' || trim($tab['pathologie3'])=='' || trim($tab['pathologie4'])=='' || trim($tab['pathologie5'])==''))
				{
					echo '<p><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Veuillez ajouter 5 patholigies.<br/></p>';
				}
				
				if(trim($tab['description'])=='')
				{
					echo '<p><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Veuillez ajouter une desciption.<br/></p>';
				}
				
				if(!isset($tab["modalite"]))
				{
					echo '<p><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Veuillez choisir au moins une modalite<br/></p>';	
				}
				
				if($taille>$taille_maxi)
				{
					echo '<p><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Fichier trop volumineux<br/></p>';
				}
				
				
			}
			
			else
			{
				$pathoAmodif = recupererNomPathologie($bd, $tab['nom']);
				$idtraitement = $tab['id-cache'];
				
				
				if(isset($tab['image_existante']) and $_FILES['image']['size']==0){
					// Récuperer le nom de l'image qui existe déjà
					$req=$bd->prepare('select * from traitements where nom_traitement=:nom_traitement');
					$req->bindValue(':nom_traitement',$tab['nom']);
					$req->execute();
					$rep=$req->fetch(PDO::FETCH_ASSOC);
					$tab['image_existe']='oui';
					$tab['image_extension']=$rep['image'];
				}
		
			
				if(!isset($tab['image_existe']))
				{
					$dossier = 'images_traitements/';
					$fichier = basename($_FILES['image']['name']);
					$taille_maxi = 10000000;
					$taille = filesize($_FILES['image']['tmp_name']);
					$extensions = array('.png', '.gif', '.jpg', '.jpeg');
					$extension = strrchr($_FILES['image']['name'], '.');
		
		
		
			//Début des vérifications de sécurité...

		
					 $fichier = strtr($fichier, 
						  'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
						  'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
					 $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
					 if(move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
						 {
							  $tab['image_extension']=$fichier;
							  
						 }
					 else //Sinon (la fonction renvoie FALSE).
						 {
								echo  "<b>Le fichier n'a pas été correctement chargé</b>";
						 }
				}

				$idtrait = intval($idtraitement);
				miseAjourTraitement($bd, $tab['nom'], $tab['description'], $idtrait, $tab['image_extension']);
				miseAjourPathologies($bd, $idtrait, $pathoAmodif, $tab);
				supprimerModalite($bd, $idtrait);
				modifierModaliteTraitement($bd, $tab, $idtrait);
							
				
			}
		}


}



function afficheTraitements($bd)
{
    try
    {
        $req = $bd->prepare('SELECT * FROM traitements');
        $req->execute();
    
        echo '<table>' . "\n";
        $res = $req->fetch(PDO::FETCH_ASSOC);

        //Il y a au moins une ligne
        if($res)
        {
            //On affiche les en-têtes
            echo '<tr>'."\n";
            foreach($res as $c => $v)
                echo '<th>' . $c . '</th>';
            echo '</tr>'."\n";
        
            //On affiche la première ligne    
            echo '<tr>'."\n";
            foreach($res as $v)
                echo '<td>' . $v . '</td>';
            echo '</tr>'."\n";
     
             while($res = $req->fetch(PDO::FETCH_ASSOC))
            {
                echo '<tr>'."\n";
                foreach($res as $v)
                    echo '<td>' . $v . '</td>';
                echo '</tr>'."\n";
            }
			

			
			
			
        }
        else
            echo 'Aucun traitements dans la base de données';
    }
    catch(PDOException $e)
    {
      // On termine le script en affichant le n de l'erreur ainsi que le message 
    die('<p> La connexion a échoué. Erreur[' .$e->getCode().'] : ' .$e->getMessage() . '</p>');
    }    
    catch(Exception $e)
    {
        echo 'Problème !!!';
    }    
	
	
    echo '</table>'."\n";

}


//Teste si il existe un traitement, si oui retourne true sinon false
function traitementExiste($bd, $nom)
{
	try
	{
		$req = $bd->prepare('SELECT * from traitements where nom_traitement = :nom ');
		$req->bindValue(':nom',$nom);
		$req->execute();
		return $req->fetch() != false;
	}
 	catch(PDOException $e)
    {
       	die('ERREUR : ' . $e->getMessage());
    }
	
}


function pathoExiste($bd, $patho)
{
	try
	{
		$req = $bd->prepare('SELECT * from pathologies where nom_pathologie=:patho');
		$req->bindValue(':patho',$patho);
		$req->execute();
		return $req->fetch() != false;
	}
 	catch(PDOException $e)
    {
        	die('ERREURddf : ' . $e->getMessage());
    }
}



//Teste si les valeurs du premier tableau ($cle) sont des clés du deuxième et si les valeurs ne sont pas vides
//En gros, on teste si l'utilisateur rentre de bonnes valeurs et ne laisse pas d'espace.


function testCles($cle,$tab)
{
    foreach($cle as $v)
        if(!isset($tab[$v]) or trim($tab[$v])== '')
            return false;
    return true;
}

function supprimerAncienLien($bd, $idtraitement, $pathologie){
	
	$idpathologie = recupererIdpathologie($bd, $pathologie);
	
			 $sql6 = 'DELETE from traitements_pathologies WHERE id_traitement=:idtraitement and id_pathologie=:idpathologie';	
	    try
        {
                $req = $bd->prepare($sql6);
                $req->bindValue(':idtraitement', $idtraitement);
                $req->bindValue(':idpathologie', $idpathologie['id_pathologie']);

                $req->execute();
        }
		        catch(PDOException $e)
        {
            die('Erreur suppression ancien lien : ' . $e->getMessage()); 
        }	
	
	
}

function genereListboxTraitement($bd)
{
    try
    {
        $req = $bd->prepare('SELECT DISTINCT nom_traitement FROM traitements ORDER BY nom_traitement');
        $req->execute();
        while($res = $req->fetch(PDO::FETCH_NUM))
            echo '<option> '. $res['0'] . '</option>'."\n";
    }
    catch(PDOException $e)
    {
      // On termine le script en affichant le num de l'erreur ainsi que le message 
    die('<p> La connexion a échoué. Erreur[' .$e->getCode().'] : ' .$e->getMessage() . '</p>');
    }
}

function genereListboxPathologie($bd)
{
    try
    {
        $req = $bd->prepare('SELECT DISTINCT nom_pathologie FROM pathologies ORDER BY nom_pathologie');
        $req->execute();
        while($res = $req->fetch(PDO::FETCH_NUM))
            echo '<option> '. $res['0'] . '</option>'."\n";
    }
    catch(PDOException $e)
    {

    die('<p> La connexion a échoué. Erreur[' .$e->getCode().'] : ' .$e->getMessage() . '</p>');
    }
}


function afficheTraitementsSelonSelection($bd, $selection)
{
    try
    {
        
        $sql = 'SELECT * FROM traitements where nom_traitement=:selection';    
        $req = $bd->prepare($sql);
        $req->bindValue(':selection',$selection);
        $req->execute();
    
        echo '<table id="tableauTraitement">' . "\n";
        $res = $req->fetch(PDO::FETCH_ASSOC);
		$image = $res['image'];
        //Il y a au moins une ligne
		
		echo '<p> <br/><label>Image actuelle :</label></p><img src="images_traitements/'.$image.'" alt="image" width="400" height="300" id="img_huile" /><br/>';
        if($res)
        {
            //On affiche les en-têtes
            echo '<tr>'."\n";
                echo '<th>Id du traitement</th><th>Nom du traitement</th><th>Description</th><th>Image</th></bold>';
        
            //On affiche la première ligne    
            echo '<tr>'."\n";
            foreach($res as $v)
                echo '<td>' . $v . '</td>';
     
             while($res = $req->fetch(PDO::FETCH_ASSOC))
            {
                echo '<tr>'."\n";
                foreach($res as $v)
                    echo '<td>' . $v . '</td>';
            }
			
		
        
        }
		

		
	}
		    catch(PDOException $e)
    {
        die('ERREUR : ' . $e->getMessage());
    }
    echo '</table>'."\n";

    }

	
	function affichePathologiesSelonSelection($bd, $nom)
{
    try
    {
        
        $sql2 = 'SELECT nom_pathologie FROM pathologies natural join traitements natural join  traitements_pathologies where nom_traitement=:nom';    
        $req = $bd->prepare($sql2);
        $req->bindValue(':nom',$nom);
        $req->execute();
    
        echo '<table id="tableauPathologie">' . "\n";
        $res = $req->fetch(PDO::FETCH_ASSOC);

        //Il y a au moins une ligne
        if($res)
        {
            //On affiche les en-têtes
            echo '<tr>'."\n";
                echo '<th>Pathologies associées : </th>';
        
            //On affiche la première ligne    
            echo '<tr>'."\n";
            foreach($res as $v)
                echo '<td>' . $v . '</td>';
     
             while($res = $req->fetch(PDO::FETCH_ASSOC))
            {
                echo '<tr>'."\n";
                foreach($res as $v)
                    echo '<td>' . $v . '</td>';
            }
        
        }

    }
	
	
    catch(PDOException $e)
    {
        die('ERREUR : ' . $e->getMessage());
    }
    echo '</table>'."\n";

}


function afficheModalitesSelonSelection($bd, $idtraitement)
{
    try
    {
        
        $sql2 = 'SELECT nom_modalite FROM modalites natural join  traitements_modalites where id_traitement=:id_traitement';    
        $req = $bd->prepare($sql2);
        $req->bindValue(':id_traitement',$idtraitement);
        $req->execute();
    
        echo '<table id="tableauPathologie">' . "\n";
        $res = $req->fetch(PDO::FETCH_ASSOC);

        //Il y a au moins une ligne
        if($res)
        {
            //On affiche les en-têtes
            echo '<tr>'."\n";
                echo '<th>Modalites associées : </th>';
        
            //On affiche la première ligne    
            echo '<tr>'."\n";
            foreach($res as $v)
                echo '<td>' . $v . '</td>';
     
             while($res = $req->fetch(PDO::FETCH_ASSOC))
            {
                echo '<tr>'."\n";
                foreach($res as $v)
                    echo '<td>' . $v . '</td>';
            }
        
        }

    }
	
	
    catch(PDOException $e)
    {
        die('ERREUR : ' . $e->getMessage());
    }
    echo '</table>'."\n";

}






function ajouterPathologie($bd, $pathologie, $idtraitement)
{

	
	//si la pathologie existe on recupere son id
		if(pathoExiste($bd, $pathologie))
		{
			$sql2 = 'SELECT id_pathologie from pathologies where nom_pathologie=:pathologie';	
			try
			{
					$req = $bd->prepare($sql2);
					$req->bindValue('pathologie',htmlentities($pathologie));
					$req->execute();
					
					$idpathologie=$req->fetch(PDO::FETCH_ASSOC);
					
			}
			catch(PDOException $e)
			{
				die('Erreur71 : ' . $e->getMessage()); 
			}
		}
		
		//sinon on cree la pathologie
		
		else{
	
			$sql2 = 'INSERT INTO pathologies (nom_pathologie) VALUES (:pathologie)';	
			try
			{
					$req = $bd->prepare($sql2);
					$req->bindValue(':pathologie',htmlentities($pathologie));
					$req->execute();
			}
			catch(PDOException $e)
			{
				die('Erreur119 : ' . $e->getMessage()); 
			}
			
					//On récupère l id de pathologie
			
				$sql22 = 'SELECT id_pathologie from pathologies where nom_pathologie=:pathologie';	
			try
			{
					$req = $bd->prepare($sql22);
					$req->bindValue(':pathologie',htmlentities($pathologie));
					$req->execute();
					
					$idpathologie=$req->fetch(PDO::FETCH_ASSOC);
					
			}
			catch(PDOException $e)
			{
				die('Erreur136 : ' . $e->getMessage()); 
			}
		
		}
		
						//On fait une dernière requete pour lier traitement et pathologie.
		
            $sql222 = 'INSERT INTO traitements_pathologies (id_traitement, id_pathologie) VALUES (:idtraitement, :idpathologie)';	
	    try
        {
                $req = $bd->prepare($sql222);
                $req->bindValue(':idtraitement',htmlentities($idtraitement));
                $req->bindValue(':idpathologie',htmlentities($idpathologie['id_pathologie']));

                $req->execute();
        }
		        catch(PDOException $e)
        {
            die('Erreur AjoutPathologie : ' . $e->getMessage()); 
        }
		
	
	
}


function ajouterPathologieM($bd, $pathologie, $idtraitement)
{
	
	//si la pathologie existe on recupere son id
		if(pathoExiste($bd, $pathologie))
		{
		
			$sql2 = 'SELECT id_pathologie from pathologies where nom_pathologie=:pathologie';	
			try
			{
					$req = $bd->prepare($sql2);
					$req->bindValue('pathologie',htmlentities($pathologie));
					$req->execute();
					
					$idpathologie=$req->fetch(PDO::FETCH_ASSOC);
					
			}
			catch(PDOException $e)
			{
				die('Erreur71 : ' . $e->getMessage()); 
			}
		}
		
		//sinon on cree la pathologie
		
		else{
		
			$sql2 = 'INSERT INTO pathologies (nom_pathologie) VALUES (:pathologie)';	
			try
			{
					$req = $bd->prepare($sql2);
					$req->bindValue(':pathologie',htmlentities($pathologie));
					$req->execute();
			}
			catch(PDOException $e)
			{
				die('Erreur119 : ' . $e->getMessage()); 
			}
			
					//On récupère l id de pathologie
			
				$sql22 = 'SELECT id_pathologie from pathologies where nom_pathologie=:pathologie';	
			try
			{
					$req = $bd->prepare($sql22);
					$req->bindValue(':pathologie',htmlentities($pathologie));
					$req->execute();
					
					$idpathologie=$req->fetch(PDO::FETCH_ASSOC);
					
			}
			catch(PDOException $e)
			{
				die('Erreur136 : ' . $e->getMessage()); 
			}
		
		}
		
						//On fait une dernière requete pour lier traitement et pathologie.
		
  	   $sql222 = 'INSERT INTO traitements_pathologies (id_traitement, id_pathologie) VALUES (:idtraitement, :idpathologie)';	
	   
	    try
        {
                $req = $bd->prepare($sql222);
                $req->bindValue(':idtraitement',htmlentities($idtraitement));
                $req->bindValue(':idpathologie',htmlentities($idpathologie['id_pathologie']));

                $req->execute();
        }
		        catch(PDOException $e)
        {
            die('Erreur AjoutPathologie : ' . $e->getMessage()); 
        }
		
	
	
}


function creerTraitement($bd, $nom, $decription, $image)
{


		$sql = 'INSERT INTO traitements (nom_traitement, Desc_traitement, image) VALUES (:nom, :description, :image)';
			
	    try
        {
                $req = $bd->prepare($sql);
                $req->bindValue(':nom',htmlentities($nom));
                $req->bindValue(':description',htmlentities($decription));
				$req->bindValue(':image',htmlentities($image));
                $req->execute();
		}
        catch(PDOException $e)
        {
            die('Erreur [Création traitement] : ' . $e->getMessage()); 
        }
		

}


function ajouterModaliteTraitement($bd, $tab, $idtraitement)
{
	try
	{
	
		foreach($tab['modalite'] as $cle => $valeur)
		{
			$req=$bd->prepare('select distinct * from modalites where nom_modalite=:nom_modalite');
			$req->bindValue(':nom_modalite',$valeur);
			$req->execute();
			while($rep=$req->fetch(PDO::FETCH_ASSOC))
			{
				$id_modalite=$rep['id_modalite'];
			}
			$req=$bd->prepare('INSERT INTO traitements_modalites (id_traitement, id_modalite) VALUES (:id_trait,:id_modal)');
			$req->bindValue(':id_trait',$idtraitement);
			$req->bindValue(':id_modal',$id_modalite);	
			$req->execute();
		}
	}	
		
	catch(PDOException $e)
	{
		die('Erreur [Création modalite] : ' . $e->getMessage()); 
	}
	
}


function modifierModaliteTraitement($bd, $tab, $idtraitement)
{
	try
	{
	
		foreach($tab['modalite'] as $cle => $valeur)
		{
			$req=$bd->prepare('select distinct * from modalites where nom_modalite=:nom_modalite');
			$req->bindValue(':nom_modalite',$valeur);
			$req->execute();
			while($rep=$req->fetch(PDO::FETCH_ASSOC))
			{
				$id_modalite=$rep['id_modalite'];
			}
			$req=$bd->prepare('INSERT INTO traitements_modalites (id_traitement, id_modalite) VALUES (:id_trait,:id_modal)');
			$req->bindValue(':id_trait',$idtraitement);
			$req->bindValue(':id_modal',$id_modalite);	
			$req->execute();
		}
	}	
		
	catch(PDOException $e)
	{
		die('Erreur [Création modalite] : ' . $e->getMessage()); 
	}
	
}


function recupererIdtraitement($bd, $nom)
{
	
	 	//On récupere l id de traitement
		
        $sql32 = 'SELECT id_traitement from traitements where nom_traitement=:nom';	
		
	    try
        {
                $req = $bd->prepare($sql32);
                $req->bindValue(':nom',htmlentities($nom));
                $req->execute();
				
				$idtraitement=$req->fetch(PDO::FETCH_ASSOC);
				
				return $idtraitement;
        }
        catch(PDOException $e)
        {
            die('Erreur153 : ' . $e->getMessage()); 
        }
			  
}


function recupererIdpathologie($bd, $pathologie){
	
		$sql22 = 'SELECT id_pathologie from pathologies where nom_pathologie=:pathologie';	
	   
		try
        {
				$req = $bd->prepare($sql22);
                $req->bindValue(':pathologie',htmlentities($pathologie));
                $req->execute();
				
				$idpathologie=$req->fetch(PDO::FETCH_ASSOC);
				return $idpathologie;
        }
        catch(PDOException $e)
        {
            die('Erreur136 : ' . $e->getMessage()); 
        }
}

function recupererNomPathologie($bd, $nom)
{
	
		$req2=$bd->prepare('SELECT nom_pathologie FROM pathologies natural join traitements natural join  traitements_pathologies where nom_traitement=:choixTrait');
						
        $req2->bindValue(':choixTrait',$nom);
		$req2->execute();
		
		while($tab=$req2->fetch(PDO::FETCH_ASSOC)){
			foreach($tab as $cle => $val)
				$patho[]= $val;
		
		}
		
		return $patho;
		
}

function recupererNombrePathologieParTraitement($bd, $idtraitement)
{
	
	$sqlc = 'Select count(*) from traitements_pathologies where id_traitement=:idtraitement';
	try
        {
                $req = $bd->prepare($sqlc);
				$req->bindValue(':idtraitement', $idtraitement);
                $req->execute();
				
				$idCount=$req->fetch(PDO::FETCH_ASSOC);
				return $idCount;
		}
        catch(PDOException $e)
        {
            die('Erreur136 : ' . $e->getMessage()); 
        }
	
	
}

	/*
function miseAjourPathologies($bd, $pathologie, $nom, $anciennePatho){
	
	//on récupère l'id de pathologie
  $idpathologie1 = recupererIdpathologie($bd, $anciennePatho);
  $idpathologie2 = recupererIdpathologie($bd, $pathologie);
		//puis l id de traitement
		$idtraitement = recupererIdtraitement($bd, $nom);
		
		
		//Pour mettre à jour une pathologie, on doit d'abord supprimer le lien avec l'ancienne pathologie puis recreer le lien avec la nouvelle. 
		 $sql6 = 'UPDATE traitements_pathologies SET id_pathologie=:idpathologie2 where id_traitement=:idtraitement and id_pathologie=:idpathologie1';	
	    try
        {
                $req = $bd->prepare($sql6);
                $req->bindValue(':idtraitement',htmlentities($idtraitement['id_traitement']));
                $req->bindValue(':idpathologie2',htmlentities($idpathologie2['id_pathologie']));				
                $req->bindValue(':idpathologie1',htmlentities($idpathologie1['id_pathologie']));

                $req->execute();
        }
		        catch(PDOException $e)
        {
            die('Erreur MAJ pathologie1 : ' . $e->getMessage()); 
        }	
			
		//et donc on recreer le lien
	
            $sql5 = 'INSERT INTO traitements_pathologies (id_traitement, id_pathologie) VALUES (:idtraitement, :idpathologie2)';	
	    try
        {
                $req = $bd->prepare($sql5);
                $req->bindValue(':idtraitement',htmlentities($idtraitement['id_traitement']));
                $req->bindValue(':idpathologie2',htmlentities($idpathologie2['id_pathologie']));

                $req->execute();
        }
		        catch(PDOException $e)
        {
            die('Erreur MAJ pathologie2 : ' . $e->getMessage()); 
        }	
	
}
*/


function miseAjourPathologies($bd, $idtraitement, $pathoAmodif, &$patho)
{
	
	
	supprimerAncienLien($bd, $idtraitement, $pathoAmodif[0]);						
	ajouterPathologieM($bd, $patho['pathologie'], $idtraitement);	



	supprimerAncienLien($bd, $idtraitement, $pathoAmodif[1]);
	ajouterPathologieM($bd, $patho['pathologie2'], $idtraitement);		



	supprimerAncienLien($bd, $idtraitement, $pathoAmodif[2]);			
	ajouterPathologieM($bd, $patho['pathologie3'], $idtraitement);


	supprimerAncienLien($bd, $idtraitement, $pathoAmodif[3]);
	ajouterPathologieM($bd, $patho['pathologie4'], $idtraitement);					


	supprimerAncienLien($bd, $idtraitement, $pathoAmodif[4]);				
	ajouterPathologieM($bd, $patho['pathologie5'], $idtraitement);
	
	
}


function miseAjourTraitement($bd, $nom, $description, $idtraitement, $img)
{

  $sql = 'UPDATE traitements SET nom_traitement=:nom, Desc_traitement=:description, image=:img WHERE id_traitement=:idtraitement';
			
	  try
          {
			  
                $req = $bd->prepare($sql);
                $req->bindValue(':nom',htmlentities($nom));
                $req->bindValue(':description',htmlentities($description));
				$req->bindValue(':idtraitement',htmlentities($idtraitement));
				$req->bindValue(':img',htmlentities($img));
                $req->execute();
				
				

			echo '<div class="alert alert-success" role="alert"><strong>Le traitement a été mise à jour avec succès</strong></p></div>';
			
			
          }
            catch(PDOException $e)
            {
            die('Erreur MAJ : ' . $e->getMessage()); 
            }


}

function supprimerTraitement($bd, $nom){
	
			try
            {
                $req = $bd->prepare('DELETE from traitements WHERE nom_traitement = :nom');
                $req->bindValue(':nom',$nom);
                $req->execute();
                
            }
            catch(PDOException $e)
            {
                die('Erreur : ' . $e->getMessage());
            }
			
}


?>







