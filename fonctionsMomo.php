<?php

function listboxFamilles($bd){
	try{
		echo '<input name="famille" list="choixFamille" type="text" autocomplete="off" placeholder="Entrez le nom de sa famille"/>
			<datalist  id="choixFamille">';
		$req=$bd->prepare('SELECT*FROM familles;');
		$req->execute();
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			echo'<option value="'.$rep['nom_famille'].'">'.$rep['nom_famille'].'</option>;';
		}
		echo'</datalist>';
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
		echo '<input name="famille" list="choixFamille" type="text" autocomplete="off" value="'.$rep['nom_famille'].'" placeholder="Entrez le nom de sa famille"/>
			<datalist  id="choixFamille">';
		$req=$bd->prepare('SELECT*FROM familles;');
		$req->execute();
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			echo'<option value="'.$rep['nom_famille'].'">'.$rep['nom_famille'].'</option>;';
		}
		echo'</datalist>';
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
		echo '<input name="constituant'.$numero.'" list="choixConstituant" type="text" autocomplete="off" placeholder="Double cliquez pour choisir..."/>
			<datalist  id="choixConstituant">';
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			echo'<option value="'.$rep['nom_constituant'].'">'.$rep['nom_constituant'].'</option>;';
		}
		echo'</datalist>';
		echo ' à  <input type="text" name="pourcentage'.$numero.'" size="1"/>%';

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
			echo '<input name="constituant'.$numero.'" list="choixConstituant" type="text" autocomplete="off" value="'.$nom_constituants[$numero].'" placeholder="Double cliquez pour choisir..."/>
				<datalist  id="choixConstituant">';
			while($rep2=$req2->fetch(PDO::FETCH_ASSOC)){
				echo'<option value="'.$rep2['nom_constituant'].'">'.$rep2['nom_constituant'].'</option>;';
			}
			echo'</datalist>';
			echo ' à  <input type="text" name="pourcentage'.$numero.'" size="1" value="'.$pourcentages[$numero].'"/>%<br/>';
	}

	}catch(PDOException $e){
		die('Erreur ! '.$e->getMessage().'</body></html>');
	}
}

function listboxProprietesEtNotations($bd,$numero){
	try{
		$req=$bd->prepare('SELECT*FROM proprietes;');
		$req->execute();
		echo '<input name="propriete'.$numero.'" list="choixPropriete" type="text"/ autocomplete="off" placeholder="Double cliquez pour choisir...">
			<datalist  id="choixPropriete">';
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			echo'<option value="'.$rep['nom_propriete'].'">'.$rep['nom_propriete'].'</option>;';
		}
		echo'</datalist>';
		/*
			Les notations :
		*/
		echo ' =======>	 	';
		$req2=$bd->prepare('SELECT*FROM notations;');
		$req2->execute();
		echo '<input name="notation'.$numero.'" list="choixNotation" type="text" size ="1" autocomplete="off" placeholder="Double cliquez pour choisir..."/>
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
			echo '<input name="propriete'.$numero.'" list="choixPropriete" type="text" autocomplete="off" value="'.$nom_proprietes[$numero].'" placeholder="Double cliquez pour choisir..."/>
				<datalist  id="choixPropriete">';
			while($rep2=$req2->fetch(PDO::FETCH_ASSOC)){
				echo'<option value="'.$rep2['nom_propriete'].'">'.$rep2['nom_propriete'].'</option>;';
			}
			echo'</datalist>';
			echo ' =======>	 	';
			$req3=$bd->prepare('SELECT*FROM notations;');
			$req3->execute();
			echo '<input name="notation'.$numero.'" list="choixNotation" type="text" autocomplete="off" value="'.$signe_notations[$numero].'" placeholder="Double cliquez pour choisir..."/>
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

function listboxModeEmploi($bd){
	try{
		$req=$bd->prepare('SELECT*FROM modeEmploi;');
		$req->execute();
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			echo '<label><p>'.$rep['nom_modeEmploi'].'</p>';
			echo'<input type="checkbox" name="modeEmploi[]" value="'.$rep['nom_modeEmploi'].'"></label>';
		}
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
		while($rep=$req->fetch(PDO::FETCH_ASSOC)){
			if(in_array($rep['id_modeEmploi'],$id_modeEmploi)){
				echo '<label><p>'.$rep['nom_modeEmploi'].'</p>';
				echo'<input type="checkbox" name="modeEmploi[]" value="'.$rep['nom_modeEmploi'].'" checked></label>';
			}
			else{
				echo '<label><p>'.$rep['nom_modeEmploi'].'</p>';
				echo'<input type="checkbox" name="modeEmploi[]" value="'.$rep['nom_modeEmploi'].'"></label>';
			}
	}
	}catch(PDOException $e){
		die('Erreur ! '.$e->getMessage().'</body></html>');
	}
}

function valeurs_distincts($v1,$v2,$v3,$v4,$v5){
	return $v1!=$v2 and $v1!=$v3 and $v1!=$v4 and $v1!=$v5 and $v2!=$v3 and $v2!=$v4 and $v2!=$v5 and $v3!=$v4 and $v3!=$v5 and $v4!=$v5;
}

function formulaire_creation_huile($bd){
	echo '<form method="post">
			<p> Nom : </p> <input type="text" name="nom" placeholder="Entrez le nom de l\'huile" />
			<p> Nom latin : </p> <input type="text" name="nom_latin" placeholder="Entrez son nom latin" />
			<p> Famille de l\'huile : </p>';
	listboxFamilles($bd);
	echo '<p> Organe producteur :</p>';
	listboxOrganes($bd);
	echo '<p> Origine géographique : </p> <input type="text" name="origine_geo" placeholder="Entrez son origine géographique"/>
			<p> Constituants/Pourcentages:</p>';
	for($i=1;$i<6;$i++){
		listboxConstituants($bd,$i);
		echo'<br/>';
	}
	echo '<p> Proprietes/Notations :  </p>';
	for($i=1;$i<6;$i++){
		listboxProprietesEtNotations($bd,$i);
		echo'<br/>';
	}
	echo '<p> Conseils : </p> <textarea cols="60" rows="5" name="conseils" placeholder="Donnez quelques conseils sur l\'huile..." ></textarea>
			<p> Indications : </p> <textarea cols="60" rows="5" name="indications" placeholder="Donnez quelques indications sur l\'huile..."></textarea>
			<p> Mode(s) d\'emploi : </p> ';
	listboxModeEmploi($bd);
	echo '<p> Message enérgétique : </p> <textarea cols="60" rows="5" name="message_energetique" placeholder="Saisissez un message enérgétique..."></textarea>
			<p> Lien vers une image : </p> <input type="text" name="image" placeholder="Lien vers une image"/>
			<p> Lien vers une vidéo : </p> <input type="text" name="video" placeholder="Lien vers une vidéo"/>
			<br/><br/><input type="submit" value="Créer une huile !" />
		</form>';

}

function formulaire_creation_huile_prerempli($bd,$tab){
	echo '<form method="post">
			<p> Nom : </p> <input type="text" name="nom" value="'.$tab['nom'].'" placeholder="Entrez le nom de l\'huile"/>
			<p> Nom latin : </p> <input type="text" name="nom_latin" value="'.$tab['nom_latin'].'" placeholder="Entrez son nom latin"/>
			<p> Famille de l\'huile : </p>';
	listboxFamilles($bd,$tab);
	echo '<p> Organe producteur :</p>';
	listboxOrganes($bd);
	echo '<p> Origine géographique : </p> <input type="text" name="origine_geo" value="'.$tab['origine_geo'].'" placeholder="Entrez son origine géographique"/>
			<p> Constituants/Pourcentages:</p>';
	for($i=1;$i<6;$i++){
		listboxConstituants($bd,$i);	
		echo'<br/>';
	}
	echo '<p> Proprietes/Notations :  </p>';
	for($i=1;$i<6;$i++){	
		listboxProprietesEtNotations($bd,$i);
		echo'<br/>';
	}
	echo '<p> Conseils : </p> <textarea cols="60" rows="5" name="conseils" placeholder="Donnez quelques conseils sur l\'huile..." >'.$tab['conseils'].'</textarea>
			<p> Indications : </p> <textarea cols="60" rows="5" name="indications" placeholder="Donnez quelques indications sur l\'huile..." >'.$tab['indications'].'</textarea>
			<p> Mode(s) d\'emploi : </p> ';
	listboxModeEmploi($bd);
	echo '<p> Message enérgétique : </p> <textarea cols="60" rows="5" name="message_energetique" placeholder="Saisissez un message enérgétique..." >'.$tab['message_energetique'].'</textarea>
			<p> Lien vers une image : </p> <input type="text" name="image" value="'.$tab['image'].'" placeholder="Lien vers une image"/>
			<p> Lien vers une vidéo : </p> <input type="text" name="video" value="'.$tab['video'].'" placeholder="Lien vers une vidéo"/>
			<br/><br/><input type="submit" value="Créer une huile !" />
		</form>';

}

function formulaire_modification_huile($bd,$tab){
	echo '<form method="post">
			<p> Nom : </p> <input type="text" name="nom" value="'.$tab['nom_huile'].'" placeholder="Entrez le nom de l\'huile"/>
			<p> Nom latin : </p> <input type="text" name="nom_latin" value="'.$tab['nom_latin'].'" placeholder="Entrez son nom latin"/>
			<p> Famille de l\'huile : </p>';
	listboxFamilles_prerempli($bd,$tab);
	echo '<p> Organe producteur :</p>';
	listboxOrganes_prerempli($bd,$tab);
	echo '<p> Origine géographique : </p> <input type="text" name="origine_geo" value="'.$tab['origine_geo'].'" placeholder="Entrez son origine géographique"/>
			<p> Constituants/Pourcentages:</p>';
	listboxConstituants_prerempli($bd,$tab);
	echo '<p> Proprietes/Notations :  </p>';	
	listboxProprietesEtNotations_prerempli($bd,$tab);

	echo '<p> Conseils : </p> <textarea cols="60" rows="5" name="conseils" "Donnez quelques conseils sur l\'huile... >'.$tab['conseils'].'</textarea>
			<p> Indications : </p> <textarea cols="60" rows="5" name="indications" placeholder="Donnez quelques indications sur l\'huile...">'.$tab['indications'].'</textarea>
			<p> Mode(s) d\'emploi : </p> ';
	listboxModeEmploi_prerempli($bd,$tab);
	echo '<p> Message enérgétique : </p> <textarea cols="60" rows="5" name="message_energetique"  placeholder="Saisissez un message enérgétique..." >'.$tab['message_energetique'].'</textarea>
			<p> Lien vers une image : </p> <input type="text" name="image" value="'.$tab['image'].'" placeholder="Lien vers une image"/>
			<p> Lien vers une vidéo : </p> <input type="text" name="video" value="'.$tab['video'].'" placeholder="Lien vers une vidéo"/>
			<br/><br/><input type="submit" value="Modifier l\'huile !" />
		</form>';

}
function verification_formulaire_creation_huile($bd,$tab){
	$formValide=true;
	/*
		Vérification des données que l'utilisateur a saisi.
	*/
	if(strlen(trim($tab['nom']))<6 or strlen(trim($tab['nom_latin']))<6 or strlen(trim($tab['famille']))<6 or strlen(trim($tab['origine_geo']))<6){
		echo '<p> Le nom, le nom de la famille de l\'huile et son origine géographique doivent contenir au moins 6 caractères.<br/></p>';
		$formValide=false;
	}
	/*	
		Vérifier que les constituants ne sont pas des chaines vides et qu'ils sont distincts
	*/
	if(trim($tab['constituant1'])=='' or trim($tab['constituant2'])=='' or trim($tab['constituant3'])=='' or trim($tab['constituant4'])=='' or trim($tab['constituant5'])=='' or !valeurs_distincts($tab['constituant1'],$tab['constituant2'],$tab['constituant3'],$tab['constituant4'],$tab['constituant5'])){
		echo '<p> Vérifiez que vous avez bien saisi tous les constituants de l\'huile et qu\'ils sont distincts.<br/></p>';
		$formValide=false;
	}
	/*
		Vérifier les bonnes valeurs des pourcentages
	*/
	if($tab['pourcentage1']>100 or $tab['pourcentage1']<1 or $tab['pourcentage4']>100 or $tab['pourcentage4']<1 or $tab['pourcentage2']>100 or $tab['pourcentage2']<1 or $tab['pourcentage3']>100 or $tab['pourcentage3']<1 or $tab['pourcentage5']>100 or $tab['pourcentage5']<1 or($tab['pourcentage1']+ $tab['pourcentage2']+ $tab['pourcentage3']+ $tab['pourcentage4']+ $tab['pourcentage5']>100)){
		echo '<p> Vérifiez les bonnes valeurs des pourcentages.<br/></p>';
		$formValide=false;
	}
	/*	
		Vérifier que les propriétés ne sont pas des chaines vides et qu'ils sont distincts
	*/
	if(trim($tab['propriete1'])=='' or trim($tab['propriete2'])=='' or trim($tab['propriete3'])=='' or trim($tab['propriete4'])=='' or trim($tab['propriete5'])=='' or !valeurs_distincts($tab['propriete1'],$tab['propriete2'],$tab['propriete3'],$tab['propriete4'],$tab['propriete5'])){
		echo '<p> Vérifiez que vous avez bien saisi toutes les propriétés de l\'huile et qu\'elles sont distincts.<br/></p>';
		$formValide=false;
	}
	/*
		Vérifier les notations.
	*/	
	if(trim($tab['notation1'])=='' or trim($tab['notation2'])=='' or trim($tab['notation3'])=='' or trim($tab['notation4'])=='' or trim($tab['notation5'])==''){
		echo '<p> Il faut associer une notation à chaque propriété.<br/></p>';
		$formValide=false;
	}
	/*
		Vérifier les conseils et les indications
	*/
	if(trim($tab['conseils'])=='' or trim($tab['indications'])==''){
		echo '<p> Vous devez saisir un minimum de conseils, d\'indications et de conseils énergétiques.<br/></p>';
		$formValide=false;
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
		$req=$bd->prepare('INSERT INTO huiles (nom_huile,nom_latin,id_famille,origine_geo,conseils,indications,message_energetique,image,video) VALUES (:nom,:nom_latin,:id_famille,:origine_geo,:conseils,:indications,:message_energetique,:image,:video)');
		$req->bindValue(':nom',$tab['nom']);
		$req->bindValue(':nom_latin',$tab['nom_latin']);
		$req->bindValue(':id_famille',$id_famille);
		$req->bindValue(':origine_geo',$tab['origine_geo']);
		$req->bindValue(':conseils',$tab['conseils']);
		$req->bindValue(':indications',$tab['indications']);
		$req->bindValue(':message_energetique',$tab['message_energetique']);
		$req->bindValue(':image',$tab['image']);
		$req->bindValue(':video',$tab['video']);
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
?>
