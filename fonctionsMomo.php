<?php

function listboxFamilles($bd){
	try{
		echo '<input name="famille" list="choixFamille" type="text" autocomplete="off" placeholder="Entrez le nom de sa famille" id="form_famille" />
			<datalist  id="choixFamille">';
		$req=$bd->prepare('SELECT*FROM familles;');
		$req->execute();
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			echo'<option value="'.$rep['nom_famille'].'">'.$rep['nom_famille'].'</option>;';
		}
		echo'</datalist> <span id="err_famille" class="vide">Ce champ doit contenir au moins 6 caractères</span>';
	}catch(PDOException $e){
		die('Erreur ! '.$e->getMessage().'</body></html>');
	}
}
function listboxFamilles_prerempli($bd,$tab){
	try{
		$req=$bd->prepare('SELECT*FROM familles where id_famille=:id_famille;');
		$req->bindValue(':id_famille',$tab['id_famille']);
		$req->execute();
		$rep=$req->fetch(PDO::FETCH_ASSOC);
		echo '<input name="famille" list="choixFamille" type="text" autocomplete="off" value="'.$rep['nom_famille'].'" placeholder="Entrez le nom de sa famille" id="form_famille"/>
			<datalist  id="choixFamille">';
		$req=$bd->prepare('SELECT*FROM familles;');
		$req->execute();
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			echo'<option value="'.$rep['nom_famille'].'">'.$rep['nom_famille'].'</option>;';
		}
		echo'</datalist><span id="err_famille" class="vide">Ce champ doit contenir au moins 6 caractères</span>';
	}catch(PDOException $e){
		die('Erreur ! '.$e->getMessage().'</body></html>');
	}
}
function listboxFamilles_precreation($bd,$tab){
	try{
		echo '<input name="famille" list="choixFamille" type="text" autocomplete="off" placeholder="Entrez le nom de sa famille" id="form_famille" value="'.$tab['famille'].'"/>
			<datalist  id="choixFamille">';
		$req=$bd->prepare('SELECT*FROM familles;');
		$req->execute();
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			echo'<option value="'.$rep['nom_famille'].'">'.$rep['nom_famille'].'</option>;';
		}
		echo'</datalist> <span id="err_famille" class="vide">Ce champ doit contenir au moins 6 caractères</span>';
	}catch(PDOException $e){
		die('Erreur ! '.$e->getMessage().'</body></html>');
	}
}
function listboxOrganes($bd){
	try{
		echo '<select name="organe">';
		$req=$bd->prepare('SELECT*FROM organes;');
		$req->execute();
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			echo'<option value="'.$rep['nom_organe'].'">'.$rep['nom_organe'].'</option>;';
		}
		echo'</select>';
	}catch(PDOException $e){
		die('Erreur ! '.$e->getMessage().'</body></html>');
	}
}

function listboxOrganes_prerempli($bd,$tab){
	try{
		/*
			Pour avoir l'id de l'organe associé à l'huile.
		*/
		$req=$bd->prepare('select  distinct * from huiles_organes where id_huile=:id_huile');
		$req->bindValue(':id_huile',$tab['id_huile']);
		$req->execute();
		$rep=$req->fetch(PDO::FETCH_ASSOC);
		$id_organe=$rep['id_organe'];

		echo '<select name="organe">';
		$req=$bd->prepare('SELECT*FROM organes;');
		$req->execute();
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			if($rep['id_organe']==$id_organe){
				echo'<option value="'.$rep['nom_organe'].'" selected>'.$rep['nom_organe'].'</option>;';
			}
			else{
				echo'<option value="'.$rep['nom_organe'].'">'.$rep['nom_organe'].'</option>;';
			}
		}
		echo'</select>';
	}catch(PDOException $e){
		die('Erreur ! '.$e->getMessage().'</body></html>');
	}
}

function listboxConstituants($bd,$numero){
	/*
		Affichage d'une zone texte avec des constituants.
	*/
	try{
		$req=$bd->prepare('SELECT*FROM constituants;');
		$req->execute();
		echo '<input name="constituant'.$numero.'" list="choixConstituant" type="text" autocomplete="off" placeholder="Double cliquez pour choisir..." id="constituant'.$numero.'" class="constituants_pourcentages"/>
			<datalist  id="choixConstituant">';
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			echo'<option value="'.$rep['nom_constituant'].'">'.$rep['nom_constituant'].'</option>;';
		}
		echo'</datalist>';
		echo ' <img src="images/fleche.png" /> <input type="text" name="pourcentage'.$numero.'" id="pourcentage'.$numero.'" class="constituants_pourcentages"/> %';

	}catch(PDOException $e){
		die('Erreur ! '.$e->getMessage().'</body></html>');
	}
}

function listboxConstituants_prerempli($bd,$tab){
	/*
		Affichage d'une zone texte avec des constituants.
	*/
	try{
		/*
			Avoir les noms et les pourcentages des constituants relatifs à l'huile.
		*/
		$req=$bd->prepare('SELECT*FROM huiles_constituants where id_huile=:id_huile');
		$req->bindValue(':id_huile',$tab['id_huile']);
		$req->execute();
		$constituants=array();
		$pourcentages=array();
		$i=1;
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			$constituants[$i]=$rep['id_constituant'];
			$pourcentages[$i]=$rep['pourcentage'];
			$i++;
		}
		/*
			Avoir les noms des constituants.
		*/
		$nom_constituants=array();
		for($i=1;$i<6;$i++){
			$req=$bd->prepare('SELECT*FROM constituants where id_constituant=:id_constituant');
			$req->bindValue(':id_constituant',$constituants[$i]);
			$req->execute();
			while($rep=$req->fetch(PDO::FETCH_ASSOC)){
				$nom_constituants[$i]=$rep['nom_constituant'];
			}
		}
		
		for($numero=1;$numero<6;$numero++){
			$req2=$bd->prepare('SELECT*FROM constituants;');
			$req2->execute();
			echo '<input name="constituant'.$numero.'" list="choixConstituant" type="text" autocomplete="off" value="'.$nom_constituants[$numero].'" placeholder="Double cliquez pour choisir..." id="constituant'.$numero.'" class="constituants_pourcentages"/>
				<datalist  id="choixConstituant">';
			while($rep2=$req2->fetch(PDO::FETCH_ASSOC)){
				echo'<option value="'.$rep2['nom_constituant'].'">'.$rep2['nom_constituant'].'</option>;';
			}
			echo'</datalist>';
			echo ' <img src="images/fleche.png" />  <input type="text" name="pourcentage'.$numero.'" size="1" value="'.$pourcentages[$numero].'" id="pourcentage'.$numero.'" class="constituants_pourcentages"/> %<br/>';
	}

	}catch(PDOException $e){
		die('Erreur ! '.$e->getMessage().'</body></html>');
	}
}

function listboxConstituants_precreation($bd,$numero,$tab){
	/*
		Affichage d'une zone texte avec des constituants.
	*/
	try{
		$req=$bd->prepare('SELECT*FROM constituants;');
		$req->execute();
		echo '<input name="constituant'.$numero.'" list="choixConstituant" type="text" autocomplete="off" placeholder="Double cliquez pour choisir..." id="constituant'.$numero.'" class="constituants_pourcentages" value="'.$tab['constituant'.$numero].'"/>
			<datalist  id="choixConstituant">';
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			echo'<option value="'.$rep['nom_constituant'].'">'.$rep['nom_constituant'].'</option>;';
		}
		echo'</datalist>';
		echo ' à  <input type="text" name="pourcentage'.$numero.'" id="pourcentage'.$numero.'"/ class="constituants_pourcentages" value="'.$tab['pourcentage'.$numero].'"> %';

	}catch(PDOException $e){
		die('Erreur ! '.$e->getMessage().'</body></html>');
	}
}

function listboxProprietesEtNotations($bd,$numero){
	try{
		$req=$bd->prepare('SELECT*FROM proprietes;');
		$req->execute();
		echo '<input name="propriete'.$numero.'" list="choixPropriete" type="text"/ autocomplete="off" placeholder="Double cliquez pour choisir..." id="propriete'.$numero.'" class="proprietes_notations">
			<datalist  id="choixPropriete">';
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			echo'<option value="'.$rep['nom_propriete'].'">'.$rep['nom_propriete'].'</option>;';
		}
		echo'</datalist>';
		/*
			Les notations :
		*/
		echo '<img src="images/fleche.png" /> ';
		$req2=$bd->prepare('SELECT*FROM notations;');
		$req2->execute();
		echo '<input name="notation'.$numero.'" list="choixNotation" type="text" size ="1" autocomplete="off" id="notation'.$numero.'" class="proprietes_notations"/>
			<datalist id="choixNotation">';
		while($rep2=$req2->fetch(PDO::FETCH_ASSOC)){
			echo'<option value="'.$rep2['signe_notation'].'">'.$rep2['signe_notation'].'</option>;';
		}
		echo'</datalist>';
	}catch(PDOException $e){
		die('Erreur ! '.$e->getMessage().'</body></html>');
	}
}

function listboxProprietesEtNotations_prerempli($bd,$tab){
	try{
		/*
			Avoir les proprietes et notations des constituants relatifs à l'huile.
		*/
		$req=$bd->prepare('SELECT*FROM huiles_proprietes where id_huile=:id_huile');
		$req->bindValue(':id_huile',$tab['id_huile']);
		$req->execute();
		$proprietes=array();
		$notations=array();
		$i=1;
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			$proprietes[$i]=$rep['id_propriete'];
			$notations[$i]=$rep['id_notation'];
			$i++;
		}
		/*
			Avoir les noms des proprietes.
		*/
		$nom_proprietes=array();
		for($i=1;$i<6;$i++){
			$req=$bd->prepare('SELECT*FROM proprietes where id_propriete=:id_propriete');
			$req->bindValue(':id_propriete',$proprietes[$i]);
			$req->execute();
			while($rep=$req->fetch(PDO::FETCH_ASSOC)){
				$nom_proprietes[$i]=$rep['nom_propriete'];
			}
		}

		/*
			Avoir les signes des notations.
		*/
		$signe_notations=array();
		for($i=1;$i<6;$i++){
			$req=$bd->prepare('SELECT*FROM notations where id_notation=:id_notation');
			$req->bindValue(':id_notation',$notations[$i]);
			$req->execute();
			while($rep=$req->fetch(PDO::FETCH_ASSOC)){
				$signe_notations[$i]=$rep['signe_notation'];
			}
		}

		for($numero=1;$numero<6;$numero++){
			$req2=$bd->prepare('SELECT*FROM proprietes;');
			$req2->execute();
			echo '<input name="propriete'.$numero.'" list="choixPropriete" type="text" autocomplete="off" value="'.$nom_proprietes[$numero].'" placeholder="Double cliquez pour choisir..." id="propriete'.$numero.'" class="proprietes_notations"/>
				<datalist  id="choixPropriete">';
			while($rep2=$req2->fetch(PDO::FETCH_ASSOC)){
				echo'<option value="'.$rep2['nom_propriete'].'">'.$rep2['nom_propriete'].'</option>;';
			}
			echo'</datalist>';
			echo '<img src="images/fleche.png" /> ';
			$req3=$bd->prepare('SELECT*FROM notations;');
			$req3->execute();
			echo '<input name="notation'.$numero.'" list="choixNotation" type="text" autocomplete="off" value="'.$signe_notations[$numero].'" id="notation'.$numero.'" class="proprietes_notations"/>
				<datalist  id="choixNotation">';
			while($rep3=$req3->fetch(PDO::FETCH_ASSOC)){
				echo'<option value="'.$rep3['signe_notation'].'">'.$rep3['signe_notation'].'</option>;';
			}
			echo'</datalist><br/>';
		}

	}catch(PDOException $e){
		die('Erreur ! '.$e->getMessage().'</body></html>');
	}
}


function listboxProprietesEtNotations_precreation($bd,$numero,$tab){
	try{
		$req=$bd->prepare('SELECT*FROM proprietes;');
		$req->execute();
		echo '<input name="propriete'.$numero.'" list="choixPropriete" type="text"/ autocomplete="off" placeholder="Double cliquez pour choisir..." id="propriete'.$numero.'" class="proprietes_notations" value="'.$tab['propriete'.$numero].'">
			<datalist  id="choixPropriete">';
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			echo'<option value="'.$rep['nom_propriete'].'">'.$rep['nom_propriete'].'</option>;';
		}
		echo'</datalist>';
		/*
			Les notations :
		*/
		echo ' ->';
		$req2=$bd->prepare('SELECT*FROM notations;');
		$req2->execute();
		echo '<input name="notation'.$numero.'" list="choixNotation" type="text" size ="1" autocomplete="off" placeholder="Sélectionnez la notation correspendante..." id="notation'.$numero.'" class="proprietes_notations" value="'.$tab['notation'.$numero].'"/>
			<datalist id="choixNotation">';
		while($rep2=$req2->fetch(PDO::FETCH_ASSOC)){
			echo'<option value="'.$rep2['signe_notation'].'">'.$rep2['signe_notation'].'</option>;';
		}
		echo'</datalist>';
	}catch(PDOException $e){
		die('Erreur ! '.$e->getMessage().'</body></html>');
	}
}

function listboxModeEmploi($bd){
	try{
		$req=$bd->prepare('SELECT*FROM modeEmploi;');
		$req->execute();
		echo '<div class="modal-2">';
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			echo '<div class="checkbox inline">';
			echo '';
			echo'<input type="checkbox" name="modeEmploi[]" value="'.$rep['nom_modeEmploi'].'" > <label>'.$rep['nom_modeEmploi'].'</label>';
			echo '</div>';
		}
		echo '</div>';
	}catch(PDOException $e){
		die('Erreur ! '.$e->getMessage().'</body></html>');
	}
}

function listboxModeEmploi_prerempli($bd,$tab){
	try{
		/*
			Pour avoir le(s) id de(s) modes emploi associés à l'huile.
		*/
		$req=$bd->prepare('select * from huiles_modeEmploi where id_huile=:id_huile');
		$req->bindValue(':id_huile',$tab['id_huile']);
		$req->execute();
		$id_modeEmploi=array();
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			$id_modeEmploi[]=$rep['id_modeEmploi'];
		}
		$req=$bd->prepare('SELECT*FROM modeEmploi;');
		$req->execute();
		echo '<div class="modal-2">';
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			echo '<div class="checkbox inline">';
			if(in_array($rep['id_modeEmploi'],$id_modeEmploi)){
				echo'<input type="checkbox" name="modeEmploi[]" value="'.$rep['nom_modeEmploi'].'" checked><label><p>'.$rep['nom_modeEmploi'].'</label>';
			}
			else{
				echo'<input type="checkbox" name="modeEmploi[]" value="'.$rep['nom_modeEmploi'].'"><label><p>'.$rep['nom_modeEmploi'].'</label>';
			}
			echo '</div>';
	}
	echo '</div>';
	}catch(PDOException $e){
		die('Erreur ! '.$e->getMessage().'</body></html>');
	}
}

function valeurs_distincts($v1,$v2,$v3,$v4,$v5){
	return $v1!=$v2 and $v1!=$v3 and $v1!=$v4 and $v1!=$v5 and $v2!=$v3 and $v2!=$v4 and $v2!=$v5 and $v3!=$v4 and $v3!=$v5 and $v4!=$v5;
}

function formulaire_creation_huile($bd){
	echo '<form method="post" enctype="multipart/form-data">
			<p> Nom : <input  type="text" name="nom" placeholder="Entrez le nom de l\'huile" id="form_nom" /> <span id="err_nom" class="vide">Ce champ doit contenir au moins 6 caractères</span></p>
			<p> Nom latin : <input type="text" name="nom_latin" placeholder="Entrez son nom latin" id="form_latin"/> <span id="err_latin" class="vide">Ce champ doit contenir au moins 6 caractères</span></p>
			<p> Famille de l\'huile :';
	listboxFamilles($bd);
	echo '</p>';
	echo '<p> Organe producteur :';
	listboxOrganes($bd);
	echo '</p><br/>';
	echo '<p> Origine géographique :<input type="text" name="origine_geo" placeholder="Entrez son origine géographique" id="form_origine_geo"/> <span id="err_origine_geo" class="vide">Champ invalide</span></p> 
			<p> Constituants/Pourcentages:<span id="err_constituants_pourcentages" class="vide">Champs invalides</span> </p>';
	for($i=1;$i<6;$i++){
		listboxConstituants($bd,$i);
		echo'<br/>';
	}
	echo '<br/><p> Proprietes/Notations : <span id="err_proprietes_notations" class="vide">Champs invalides</span> </p>';
	for($i=1;$i<6;$i++){
		listboxProprietesEtNotations($bd,$i);
		echo'<br/>';
	}
	echo '<br/><p> Conseils : <span id="err_conseils" class="vide">Champs invalides</span> </p> <textarea cols="60" rows="5" name="conseils" placeholder="Donnez quelques conseils sur l\'huile..." id="form_conseils"></textarea>
			<p> <br/>Indications : <span id="err_indications" class="vide">Champs invalides</span></p> <textarea cols="60" rows="5" name="indications" placeholder="Donnez quelques indications sur l\'huile..." id="form_indications"></textarea>
			<p><br/> Mode(s) d\'emploi : </p> ';
	listboxModeEmploi($bd);
	echo '<p> Message enérgétique : <span id="err_message" class="vide">Champs invalides</span> </p> <textarea cols="60" rows="5" name="message_energetique" placeholder="Saisissez un message enérgétique..." id="form_message"></textarea>
			<p><br/> Sélectionnez une image :<br/> <br/><input type="file" name="image"/>  </p> 
			<br/><br/><div ><input type="submit" value="Créer l\'huile !" /><br/></div>
		</form>';

}

function formulaire_creation_huile_prerempli($bd,$tab){
	echo '<form method="post" enctype="multipart/form-data">
			<p> Nom : <input type="text" name="nom" value="'.$tab['nom'].'" placeholder="Entrez le nom de l\'huile"  id="form_nom"/><span id="err_nom" class="vide">Ce champ doit contenir au moins 6 caractères</span></p> 
			<p> Nom latin : <input type="text" name="nom_latin" value="'.$tab['nom_latin'].'" placeholder="Entrez son nom latin" id="form_latin"/> <span id="err_latin" class="vide">Ce champ doit contenir au moins 6 caractères</span></p> 
			<p> Famille de l\'huile : ';
	listboxFamilles_precreation($bd,$tab);
		echo ' </p><br/>';
	echo '<p> Organe producteur :</p>';
	listboxOrganes($bd);
	echo '</p><br/>';
	echo '<p> Origine géographique : <input type="text" name="origine_geo" value="'.$tab['origine_geo'].'" placeholder="Entrez son origine géographique" id="form_origine_geo"/><span id="err_origine_geo" class="vide">Champ invalide</span> </p> 
			<p> Constituants/Pourcentages:<span id="err_constituants_pourcentages" class="vide">Champs invalides</span> </p>';
	for($i=1;$i<6;$i++){
		listboxConstituants_precreation($bd,$i,$tab);	
		echo'<br/>';
	}
	echo '<p> <br/>Proprietes/Notations : <span id="err_proprietes_notations" class="vide">Champs invalides</span></p>';
	for($i=1;$i<6;$i++){	
		listboxProprietesEtNotations_precreation($bd,$i,$tab);
		echo'<br/>';
	}
	echo '<p> <br/>Conseils : <span id="err_conseils" class="vide">Champs invalides</span> </p> <textarea cols="60" rows="5" name="conseils" placeholder="Donnez quelques conseils sur l\'huile..." id="form_conseils" >'.$tab['conseils'].'</textarea>
			<p> <br/>Indications : <span id="err_indications" class="vide">Champs invalides</span></p> <textarea cols="60" rows="5" name="indications" placeholder="Donnez quelques indications sur l\'huile..." id="form_indications">'.$tab['indications'].'</textarea>
			<p> <br/>Mode(s) d\'emploi : </p> ';
	listboxModeEmploi($bd);
	echo '<p> Message enérgétique : <span id="err_message" class="vide">Champs invalides</span></p> <textarea cols="60" rows="5" name="message_energetique" placeholder="Saisissez un message enérgétique..." id="form_message">'.$tab['message_energetique'].'</textarea>
	<p> <br/> Sélectionnez une image :<br/> <br/><input type="file" name="image" />  </p> 
			<br/><br/><input type="submit" id="boutonCreation" value="Créer l\'huile !" />
		</form>';

}

function formulaire_modification_huile($bd,$tab){
	echo '<form method="post" enctype="multipart/form-data">
			<p> Nom : <input type="text" name="nom" value="'.$tab['nom_huile'].'" placeholder="Entrez le nom de l\'huile" id="form_nom"/><span id="err_nom" class="vide">Ce champ doit contenir au moins 6 caractères</span></p> 
			<p> Nom latin :<input type="text" name="nom_latin" value="'.$tab['nom_latin'].'" placeholder="Entrez son nom latin"  id="form_latin"/><span id="err_latin" class="vide">Ce champ doit contenir au moins 6 caractères</span></p>
			<p> Famille de l\'huile : ';
	listboxFamilles_prerempli($bd,$tab);
	echo '</p><p> Organe producteur :</p>';
	listboxOrganes_prerempli($bd,$tab);
	echo '</p>';
	echo '<p> Origine géographique : <input type="text" name="origine_geo" value="'.$tab['origine_geo'].'" placeholder="Entrez son origine géographique"id="form_origine_geo"/><span id="err_origine_geo" class="vide">Champ invalide</span> </p> 
			<p> Constituants/Pourcentages:<span id="err_constituants_pourcentages" class="vide">Champs invalides</span></p>';
	listboxConstituants_prerempli($bd,$tab);
	echo '<p> <br/>Proprietes/Notations :  <span id="err_proprietes_notations" class="vide">Champs invalides</span></p>';	
	listboxProprietesEtNotations_prerempli($bd,$tab);

	echo '<p> <br/>Conseils : <span id="err_conseils" class="vide">Champs invalides</span>  </p> <textarea id="form_conseils" cols="60" rows="5" name="conseils" placeholder="Donnez quelques conseils sur l\'huile..." >'.$tab['conseils'].'</textarea>
			<p> <br/>Indications : <span id="err_indications" class="vide">Champs invalides</span></p> <textarea cols="60" rows="5" name="indications" placeholder="Donnez quelques indications sur l\'huile..." id="form_indications">'.$tab['indications'].'</textarea>
			<p> <br/>Mode(s) d\'emploi : </p> ';
	listboxModeEmploi_prerempli($bd,$tab);
	echo '<p> Message enérgétique : <span id="err_message" class="vide">Champs invalides</span></p> <textarea cols="60" rows="5" name="message_energetique"  placeholder="Saisissez un message enérgétique..." id="form_message">'.$tab['message_energetique'].'</textarea>
	<input type="hidden" name="image_existante" value="'.$tab['image'].'" /><br/>
	<p> <br/>Image actuelle :</p><img src="images_huiles/'.$tab['image'].'" alt="" width="400" height="300" id="img_huile"/>
	<p> <br/> Sélectionnez une image si vous voulez modifier l\'image existante :<br/><br/><input type="file" name="image" />  </p> 
				<br/><br/><input type="submit" value="Modifier l\'huile !" />
		</form>';

}
function verification_formulaire_creation_huile($bd,&$tab){
	$err_nom=false;
	$err_const=false;
	$err_pourc=false;
	$err_prop=false;
	$err_notation=false;
	$err_conseils=false;
	$err_img=false;
	$formValide=true;
	/*
		Vérification des données que l'utilisateur a saisi.
	*/
	if(strlen(trim($tab['nom']))<6 or strlen(trim($tab['nom_latin']))<6 or strlen(trim($tab['famille']))<6 or strlen(trim($tab['origine_geo']))<6){
		$formValide=false;
		$err_nom=true;
	}
	/*	
		Vérifier que les constituants ne sont pas des chaines vides et qu'ils sont distincts
	*/
	if(trim($tab['constituant1'])=='' or trim($tab['constituant2'])=='' or trim($tab['constituant3'])=='' or trim($tab['constituant4'])=='' or trim($tab['constituant5'])=='' or !valeurs_distincts($tab['constituant1'],$tab['constituant2'],$tab['constituant3'],$tab['constituant4'],$tab['constituant5'])){
		$formValide=false;
		$err_const=true;
	}
	/*
		Vérifier les bonnes valeurs des pourcentages
	*/
	if($tab['pourcentage1']>100 or $tab['pourcentage1']<1 or $tab['pourcentage4']>100 or $tab['pourcentage4']<1 or $tab['pourcentage2']>100 or $tab['pourcentage2']<1 or $tab['pourcentage3']>100 or $tab['pourcentage3']<1 or $tab['pourcentage5']>100 or $tab['pourcentage5']<1 or($tab['pourcentage1']+ $tab['pourcentage2']+ $tab['pourcentage3']+ $tab['pourcentage4']+ $tab['pourcentage5']>100)){
		$formValide=false;
		$err_pourc=true;
	}
	/*	
		Vérifier que les propriétés ne sont pas des chaines vides et qu'ils sont distincts
	*/
	if(trim($tab['propriete1'])=='' or trim($tab['propriete2'])=='' or trim($tab['propriete3'])=='' or trim($tab['propriete4'])=='' or trim($tab['propriete5'])=='' or !valeurs_distincts($tab['propriete1'],$tab['propriete2'],$tab['propriete3'],$tab['propriete4'],$tab['propriete5'])){
		$formValide=false;
		$err_prop=true;
	}
	/*
		Vérifier les notations.
	*/	
	if(trim($tab['notation1'])=='' or trim($tab['notation2'])=='' or trim($tab['notation3'])=='' or trim($tab['notation4'])=='' or trim($tab['notation5'])==''){
		$formValide=false;
		$err_notation=true;
	}
	/*
		Vérifier les conseils et les indications
	*/
	if(trim($tab['conseils'])=='' or trim($tab['indications'])==''){
		$formValide=false;
		$err_conseils=true;
	}
	/*

		L'image.

	*/
	
	if(isset($tab['image_existante']) and $_FILES['image']['size']==0){
		// Récuperer le nom de l'image qui existe déjà
		$req=$bd->prepare('select * from huiles where nom_huile=:nom_huile');
		$req->bindValue(':nom_huile',$tab['nom']);
		$req->execute();
		$rep=$req->fetch(PDO::FETCH_ASSOC);
		$tab['image_existe']='oui';
		$tab['image_extension']=$rep['image'];
	}
	if(!isset($tab['image_existe'])){
		$dossier = 'images_huiles/';
		$fichier = basename($_FILES['image']['name']);
		$taille_maxi = 10000000;
		$taille = filesize($_FILES['image']['tmp_name']);
		$extensions = array('.png', '.gif', '.jpg', '.jpeg');
		$extension = strrchr($_FILES['image']['name'], '.');
		//Début des vérifications de sécurité...
		if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
		{
		    $formValide=false;
		    $err_img=true;
		}
		if($taille>$taille_maxi)
		{
		     $formValide=false;
		     $err_img=true;
		}
		if($formValide){
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
		          $formValide=false;
		          $err_img=true;
		     }
		 
		}
	}

	if($formValide==false){
		echo '<div class="alert alert-danger" role="alert" style="margin-bottom:30px;">';
		if($err_nom==true){
			echo '<p> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Le nom, le nom de la famille de l\'huile et son origine géographique doivent contenir au moins 6 caractères.<br/></p>';
		}
		if($err_const==true){
			echo '<p><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Vérifiez que vous avez bien saisi tous les constituants de l\'huile et qu\'ils sont distincts.<br/></p>';

		}
		if($err_pourc==true){
			echo '<p><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Vérifiez les bonnes valeurs des pourcentages.<br/></p>';

		}
		if($err_prop==true){
			echo '<p><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Vérifiez que vous avez bien saisi toutes les propriétés de l\'huile et qu\'elles sont distincts.<br/></p>';

		}
		if($err_notation==true){
			echo '<p><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Il faut associer une notation à chaque propriété.<br/></p>';

		}
		if($err_conseils==true){
			echo '<p><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Vous devez saisir un minimum de conseils, d\'indications et un message énergétique.<br/></p>';

		}
		if($err_img==true){
			echo '<p><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Echec de l\'upload de l\'image !</p>';
		}
		echo '</div>';
	}

	return $formValide;

}
function famille_existe($bd,$nom_famille){
	try{

		$req=$bd->prepare('Select distinct * From familles where nom_famille=:nom_famille');
		$req->bindValue(':nom_famille',$nom_famille);
		$req->execute();
		$i=0;
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			$i++;
		}
		return $i!=0;
	}catch(PDOException $e){
		die('Erreur ! '.$e->getMessage().'</body></html>');
	}
}

function constituant_existe($bd,$nom_constituant){
	try{

		$req=$bd->prepare('Select distinct * From constituants where nom_constituant=:nom_constituant');
		$req->bindValue(':nom_constituant',$nom_constituant);
		$req->execute();
		$i=0;
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			$i++;
		}
		return $i!=0;
	}catch(PDOException $e){
		die('Erreur ! '.$e->getMessage().'</body></html>');
	}
}

function propriete_existe($bd,$nom_propriete){
	try{

		$req=$bd->prepare('Select distinct * From proprietes where nom_propriete=:nom_propriete');
		$req->bindValue(':nom_propriete',$nom_propriete);
		$req->execute();
		$i=0;
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			$i++;
		}
		return $i!=0;
	}catch(PDOException $e){
		die('Erreur ! '.$e->getMessage().'</body></html>');
	}
}

function notation_existe($bd,$signe_notation){
	try{

		$req=$bd->prepare('Select distinct * From notations where signe_notation=:signe_notation');
		$req->bindValue(':signe_notation',$signe_notation);
		$req->execute();
		$i=0;
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			$i++;
		}
		return $i!=0;
	}catch(PDOException $e){
		die('Erreur ! '.$e->getMessage().'</body></html>');
	}
}

function huile_existe($bd,$nom){
	try{

		$req=$bd->prepare('Select distinct * From huiles where nom_huile=:nom');
		$req->bindValue(':nom',$nom);
		$req->execute();
		$i=0;
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			$i++;
		}
		return $i!=0;
	}catch(PDOException $e){
		die('Erreur ! '.$e->getMessage().'</body></html>');
	}
}

function creation_huile($bd,$tab){
	try{
		/*
			Si la famille existe pas deja dans la base, on l'ajoute.
		*/
		if(!famille_existe($bd,$tab['famille'])){
			$req=$bd->prepare('INSERT INTO familles (nom_famille)VALUES (:nom_famille)');
			$req->bindValue(':nom_famille',$tab['famille']);
			$req->execute();
		}
		/*
			Si les constituants existent pas dans la base on les ajoute.
		*/
		for($i=1;$i<6;$i++){
			if(!constituant_existe($bd,$tab['constituant'.$i])){
				$req=$bd->prepare('INSERT INTO constituants (nom_constituant)VALUES (:nom_constituant)');
				$req->bindValue(':nom_constituant',$tab['constituant'.$i]);
				$req->execute();
			}
		}
		/*
			Si les proprietes n'existent pas dans la base on les ajoute.
		*/
		for($i=1;$i<6;$i++){
			if(!propriete_existe($bd,$tab['propriete'.$i])){
				$req=$bd->prepare('INSERT INTO proprietes (nom_propriete)VALUES (:nom_propriete)');
				$req->bindValue(':nom_propriete',$tab['propriete'.$i]);
				$req->execute();
			}
		}
		/*
			Si la notation existe pas on l'ajoute.
		*/
		for($i=1;$i<6;$i++){
			if(!notation_existe($bd,$tab['notation'.$i])){
				$req=$bd->prepare('INSERT INTO notations (signe_notation)VALUES (:signe_notation)');
				$req->bindValue(':signe_notation',$tab['notation'.$i]);
				$req->execute();
			}
		}
		/*
			Obtenir l'identifiant de la famille de l'huile.
		*/

		$req=$bd->prepare('select * from familles where nom_famille=:nom_famille');
		$req->bindValue(':nom_famille',$tab['famille']);
		$req->execute();
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			$id_famille=$rep['id_famille'];
		}

		/*
			Créer l'huile dans la table.
		*/
		$req=$bd->prepare('INSERT INTO huiles (nom_huile,nom_latin,id_famille,origine_geo,conseils,indications,message_energetique,image) VALUES (:nom,:nom_latin,:id_famille,:origine_geo,:conseils,:indications,:message_energetique,:image)');
		$req->bindValue(':nom',$tab['nom']);
		$req->bindValue(':nom_latin',$tab['nom_latin']);
		$req->bindValue(':id_famille',$id_famille);
		$req->bindValue(':origine_geo',$tab['origine_geo']);
		$req->bindValue(':conseils',$tab['conseils']);
		$req->bindValue(':indications',$tab['indications']);
		$req->bindValue(':message_energetique',$tab['message_energetique']);
		$req->bindValue(':image',$tab['image_extension']);
		$req->execute();
		/*
			Lier l'huile à l'organe, aux constituants et proprietes.
		*/
		/*
			Obtenir l'id de l'huile et de l'organe :
		*/
		$req=$bd->prepare('select * from organes where nom_organe=:nom_organe');
		$req->bindValue(':nom_organe',$tab['organe']);
		$req->execute();
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			$id_organe=$rep['id_organe'];
		}

		$req=$bd->prepare('select * from huiles where nom_huile=:nom_huile');
		$req->bindValue(':nom_huile',$tab['nom']);
		$req->execute();
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			$id_huile=$rep['id_huile'];
		}
		/*
			Inserer dans huiles_organes.
		*/
		$req=$bd->prepare('INSERT INTO huiles_organes (id_huile,id_organe) VALUES (:id_huile,:id_organe)');
		$req->bindValue(':id_huile',$id_huile);
		$req->bindValue(':id_organe',$id_organe);
		$req->execute();
		/*
			Obtenir l'id des consituants.
		*/
		$id_constituants=array();
		for($i=1;$i<6;$i++){
			$req=$bd->prepare('select distinct * from constituants where nom_constituant=:nom_constituant');
			$req->bindValue(':nom_constituant',$tab['constituant'.$i]);
			$req->execute();
			while($rep=$req->fetch(PDO::FETCH_ASSOC)){
				$id_constituants[$i]=$rep['id_constituant'];
			}
		}
		/*
			Inserer dans huiles_constituants.
		*/
		for($i=1;$i<6;$i++){
			$req=$bd->prepare('INSERT INTO huiles_constituants (id_huile,id_constituant,pourcentage) VALUES (:id_huile,:id_constituant,:pourcentage)');
			$req->bindValue(':id_huile',$id_huile);
			$req->bindValue(':id_constituant',$id_constituants[$i]);
			$req->bindValue(':pourcentage',$tab['pourcentage'.$i]);
			$req->execute();
		}
		/*
			Obtenir les id des proprietes et des notations.
		*/
		$id_proprietes=array();
		for($i=1;$i<6;$i++){
			$req=$bd->prepare('select distinct * from proprietes where nom_propriete=:nom_propriete');
			$req->bindValue(':nom_propriete',$tab['propriete'.$i]);
			$req->execute();
			while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			$id_proprietes[$i]=$rep['id_propriete'];
			}
		}

		$id_notations=array();
		for($i=1;$i<6;$i++){
			$req=$bd->prepare('select distinct * from notations where signe_notation=:signe_notation');
			$req->bindValue(':signe_notation',$tab['notation'.$i]);
			$req->execute();	
			while($rep=$req->fetch(PDO::FETCH_ASSOC)){
				$id_notations[$i]=$rep['id_notation'];
			}
		}

		/*
			Insertion dans huiles_proprietes.
		*/

		for($i=1;$i<6;$i++){
			$req=$bd->prepare('INSERT INTO huiles_proprietes (id_huile,id_propriete,id_notation) VALUES (:id_huile,:id_propriete,:id_notation)');
			$req->bindValue(':id_huile',$id_huile);
			$req->bindValue(':id_propriete',$id_proprietes[$i]);
			$req->bindValue(':id_notation',$id_notations[$i]);
			$req->execute();
		}
		/*
			Ajouter les modes d'emploi
		*/
		foreach($tab['modeEmploi'] as $cle => $valeur){
			$req=$bd->prepare('select distinct * from modeEmploi where nom_modeEmploi=:nom_modeEmploi');
			$req->bindValue(':nom_modeEmploi',$valeur);
			$req->execute();
			while($rep=$req->fetch(PDO::FETCH_ASSOC)){
				$id_modeEmploi=$rep['id_modeEmploi'];
			}
			$req=$bd->prepare('INSERT INTO huiles_modeEmploi (id_huile,id_modeEmploi) VALUES (:id_huile,:id_modeEmploi)');
			$req->bindValue(':id_huile',$id_huile);
			$req->bindValue(':id_modeEmploi',$id_modeEmploi);
			$req->execute();
		}
	}catch(PDOException $e){
		die('<p> Erreur ! '.$e->getMessage().$e->getCode().'</p></body></html>');
	}
}

function listboxHuiles($bd){
	try{
		
		$req=$bd->prepare('SELECT*FROM huiles;');
		$req->execute();
		echo'<option value="empty" selected>Liste des huiles essentielles dans la base </option>';
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			echo'<option value="'.$rep['nom_huile'].'">'.$rep['nom_huile'].'</option>';
		}
	}catch(PDOException $e){
		die('Erreur ! '.$e->getMessage().'</body></html>');
	}
}

function donnees_huile($bd,$nom_huile){
	try{
		$req=$bd->prepare('SELECT*FROM huiles where nom_huile=:nom_huile');
		$req->bindValue(':nom_huile',$nom_huile);
		$req->execute();
		$rep=$req->fetch(PDO::FETCH_ASSOC);
		return $rep;
	}catch(PDOException $e){
		die('Erreur ! '.$e->getMessage().'</body></html>');
	}
}

function suppr_huile($bd,$nom_huile){
	/*
		avoir l'id de l'huile.
	*/
	$req=$bd->prepare('Select*from huiles where nom_huile=:nom_huile');
	$req->bindValue(':nom_huile',$nom_huile);
	$req->execute();
	$rep=$req->fetch(PDO::FETCH_ASSOC);
	$id_huile=$rep['id_huile'];
	/*

		Supprimer l'image stockée.
	*/
	$req=$bd->prepare('Select*from huiles where nom_huile=:nom_huile');
	$req->bindValue(':nom_huile',$nom_huile);
	$req->execute();
	$rep=$req->fetch(PDO::FETCH_ASSOC);
	$image=$rep['image'];
	$chemin='images_huiles/'.$image;
	unlink($chemin);
	/*
		Supprimer la trace de l'huile dans toutes les tables.
	*/
	$req=$bd->prepare('Delete from huiles_modeEmploi where id_huile=:id_huile');
	$req->bindValue(':id_huile',$id_huile);
	$req->execute();
	$req=$bd->prepare('Delete from huiles_constituants where id_huile=:id_huile');
	$req->bindValue(':id_huile',$id_huile);
	$req->execute();
	$req=$bd->prepare('Delete from huiles_proprietes where id_huile=:id_huile');
	$req->bindValue(':id_huile',$id_huile);
	$req->execute();
	$req=$bd->prepare('Delete from huiles_organes where id_huile=:id_huile');
	$req->bindValue(':id_huile',$id_huile);
	$req->execute();
	$req=$bd->prepare('Delete from huiles where id_huile=:id_huile');
	$req->bindValue(':id_huile',$id_huile);
	$req->execute();


}
/*
	Sans suppression de l'image stockée.
*/
function suppr_huile_modif($bd,$nom_huile){
	/*
		avoir l'id de l'huile.
	*/
	$req=$bd->prepare('Select*from huiles where nom_huile=:nom_huile');
	$req->bindValue(':nom_huile',$nom_huile);
	$req->execute();
	$rep=$req->fetch(PDO::FETCH_ASSOC);
	$id_huile=$rep['id_huile'];
	/*

	*/
	/*
		Supprimer la trace de l'huile dans toutes les tables.
	*/
	$req=$bd->prepare('Delete from huiles_modeEmploi where id_huile=:id_huile');
	$req->bindValue(':id_huile',$id_huile);
	$req->execute();
	$req=$bd->prepare('Delete from huiles_constituants where id_huile=:id_huile');
	$req->bindValue(':id_huile',$id_huile);
	$req->execute();
	$req=$bd->prepare('Delete from huiles_proprietes where id_huile=:id_huile');
	$req->bindValue(':id_huile',$id_huile);
	$req->execute();
	$req=$bd->prepare('Delete from huiles_organes where id_huile=:id_huile');
	$req->bindValue(':id_huile',$id_huile);
	$req->execute();
	$req=$bd->prepare('Delete from huiles where id_huile=:id_huile');
	$req->bindValue(':id_huile',$id_huile);
	$req->execute();


}

function moderateur_existe($bd,$pseudo,$pass){
	try{

		$req=$bd->prepare('Select distinct * From administrateurs_modérateurs where nom=:pseudo');
		$req->bindValue(':pseudo',$pseudo);
		$req->execute();
		$i=0;
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			$i++;
		}
		return $i!=0;
	}catch(PDOException $e){
		die('Erreur ! '.$e->getMessage().'</body></html>');
	}
}

function ajouterHuiles($bd){
	require_once 'Classes/PHPExcel/IOFactory.php';
				 
	// Chargement du fichier Excel
	$objPHPExcel = PHPExcel_IOFactory::load("fichiers_huiles/huiles.xls");
							 
	/**
	* récupération de la première feuille du fichier Excel
	* @var PHPExcel_Worksheet $sheet
	*/
	$sheet = $objPHPExcel->getSheet(0);			 
	$nbLignes=0;
	$tab=array();
	// On boucle sur les lignes
	foreach($sheet->getRowIterator() as $row) {
		if($nbLignes!=0){
			$nbColonnes=0;
		   // On boucle sur les cellule de la ligne
		   foreach ($row->getCellIterator() as $cell) {
				    if($nbColonnes==0){
				      $tab['nom']=$cell->getValue();
				    }
				    else if ($nbColonnes==1){
				    	$tab['nom_latin']=$cell->getValue();
				    }
				    else if ($nbColonnes==2){
				    	$tab['famille']=$cell->getValue();
				    }
				    else if ($nbColonnes==3){
				    	$tab['organe']=$cell->getValue();
				    }
				    else if ($nbColonnes==4){
				    	$tab['origine_geo']=$cell->getValue();
				    }
				    else if ($nbColonnes==5){
				    	$tab['constituant1']=$cell->getValue();
				    }
				    else if ($nbColonnes==6){
				    	$tab['pourcentage1']=$cell->getValue();
				    }
				    else if ($nbColonnes==7){
				    	$tab['constituant2']=$cell->getValue();
				    }
				    else if ($nbColonnes==8){
				    	$tab['pourcentage2']=$cell->getValue();
				    }
				    else if ($nbColonnes==9){
				    	$tab['constituant3']=$cell->getValue();
				    }
				    else if ($nbColonnes==10){
				    	$tab['pourcentage3']=$cell->getValue();
				    }
				    else if ($nbColonnes==11){
				    	$tab['constituant4']=$cell->getValue();
				    }
				    else if ($nbColonnes==12){
				    	$tab['pourcentage4']=$cell->getValue();
				    }
				    else if ($nbColonnes==13){
				    	$tab['constituant5']=$cell->getValue();
				    }
				    else if ($nbColonnes==14){
				    	$tab['pourcentage5']=$cell->getValue();
				    }
				    else if ($nbColonnes==15){
				    	$tab['propriete1']=$cell->getValue();
				    }
				    else if ($nbColonnes==16){
				    	$tab['notation1']=$cell->getValue();
				    }
				    else if ($nbColonnes==17){
				    	$tab['propriete2']=$cell->getValue();
				    }
				    else if ($nbColonnes==18){
				    	$tab['notation2']=$cell->getValue();
				    }
				    else if ($nbColonnes==19){
				    	$tab['propriete3']=$cell->getValue();
				    }
				    else if ($nbColonnes==20){
				    	$tab['notation3']=$cell->getValue();
				    }
				    else if ($nbColonnes==21){
				    	$tab['propriete4']=$cell->getValue();
				    }
				    else if ($nbColonnes==22){
				    	$tab['notation4']=$cell->getValue();
				    }
				    else if ($nbColonnes==23){
				    	$tab['propriete5']=$cell->getValue();
				    }
				    else if ($nbColonnes==24){
				    	$tab['notation5']=$cell->getValue();
				    }
				    else if ($nbColonnes==25){
				    	$tab['conseils']=$cell->getValue();
				    }
				    else if ($nbColonnes==26){
				    	$tab['indications']=$cell->getValue();
				    }
				    else if ($nbColonnes==27){
				    	$tab['mode_emploi']=$cell->getValue();
				    }
				    else if ($nbColonnes==28){
				    	$tab['image']=$cell->getValue();
				    }
			
				 $nbColonnes++;   
			    
			   }

		print_r($tab);  	
		echo '<br/><br/>';						 
		}
		
		// Creation de l'huile
		//$formValide=verification_formulaire_creation_huile_fichier($bd,$tab);

		$nbLignes++;
		}
	echo $nbLignes;    
				    
								
}


function verification_formulaire_creation_huile_fichier($bd,&$tab){
	$err_nom=false;
	$err_const=false;
	$err_pourc=false;
	$err_prop=false;
	$err_notation=false;
	$err_conseils=false;
	$err_img=false;
	$formValide=true;
	/*
		Vérification des données que l'utilisateur a saisi.
	*/
	if(strlen(trim($tab['nom']))<6 or strlen(trim($tab['nom_latin']))<6 or strlen(trim($tab['famille']))<6 or strlen(trim($tab['origine_geo']))<6){
		$formValide=false;
		$err_nom=true;
	}
	/*	
		Vérifier que les constituants ne sont pas des chaines vides et qu'ils sont distincts
	*/
	if(trim($tab['constituant1'])=='' or trim($tab['constituant2'])=='' or trim($tab['constituant3'])=='' or trim($tab['constituant4'])=='' or trim($tab['constituant5'])=='' or !valeurs_distincts($tab['constituant1'],$tab['constituant2'],$tab['constituant3'],$tab['constituant4'],$tab['constituant5'])){
		$formValide=false;
		$err_const=true;
	}
	/*
		Vérifier les bonnes valeurs des pourcentages
	*/
	if($tab['pourcentage1']>100 or $tab['pourcentage1']<1 or $tab['pourcentage4']>100 or $tab['pourcentage4']<1 or $tab['pourcentage2']>100 or $tab['pourcentage2']<1 or $tab['pourcentage3']>100 or $tab['pourcentage3']<1 or $tab['pourcentage5']>100 or $tab['pourcentage5']<1 or($tab['pourcentage1']+ $tab['pourcentage2']+ $tab['pourcentage3']+ $tab['pourcentage4']+ $tab['pourcentage5']>100)){
		$formValide=false;
		$err_pourc=true;
	}
	/*	
		Vérifier que les propriétés ne sont pas des chaines vides et qu'ils sont distincts
	*/
	if(trim($tab['propriete1'])=='' or trim($tab['propriete2'])=='' or trim($tab['propriete3'])=='' or trim($tab['propriete4'])=='' or trim($tab['propriete5'])=='' or !valeurs_distincts($tab['propriete1'],$tab['propriete2'],$tab['propriete3'],$tab['propriete4'],$tab['propriete5'])){
		$formValide=false;
		$err_prop=true;
	}
	/*
		Vérifier les notations.
	*/	
	if(trim($tab['notation1'])=='' or trim($tab['notation2'])=='' or trim($tab['notation3'])=='' or trim($tab['notation4'])=='' or trim($tab['notation5'])==''){
		$formValide=false;
		$err_notation=true;
	}
	/*
		Vérifier les conseils et les indications
	*/
	if(trim($tab['conseils'])=='' or trim($tab['indications'])==''){
		$formValide=false;
		$err_conseils=true;
	}

	/*

		L'image.

	*/
	
	if(trim($tab['image'])=='' or trim($tab['image'])==''){
		$formValide=false;
	}


	if ($formValide){
		if(file_exists('fichiers_huiles/'.$tab['image'])){
			exec('cp fichiers/huiles'.$tab['image'].' /var/www/html/Aroma/avec-Design/images_huiles');
		}

	}
	return $formValide;

}




?>
