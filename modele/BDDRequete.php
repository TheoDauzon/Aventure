<?php

	function existUser($login,$conn)
	{
		try{
			// On prépare la requête
			$requete = $conn->prepare("SELECT * FROM joueur WHERE joueurLogin = :mail");
			// On lie les variables définies au-dessus aux paramètres de la requête préparée
			$requete->bindValue(':mail',$login , PDO::PARAM_STR);
			//On exécute la requête
			$requete->execute();
			// On récupère le résultat
			if ($requete->fetch()) {return true;}
		}
		// Si une erreur est capturée nous affichons le message d'erreur
		catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			return false;
		}
	}


	function connectUser($login,$pwd,$conn)
	{
		try{
		// On prépare la requête
		$requete = $conn->prepare("SELECT joueurMdp,persoId FROM joueur INNER JOIN personnage ON joueur.joueurid=personnage.joueuridfk WHERE joueurLogin = :mail");
		// On lie les variables définies au-dessus aux paramètres de la requête préparée
		$requete->bindValue(':mail',$login , PDO::PARAM_STR);
		//On exécute la requête
		$requete->execute();
		// On récupère le résultat
		$data = $requete->fetchAll();
		$isConnected=false;
		foreach ($data as $row) {
			if (password_verify($pwd,$row['joueurMdp'])) $isConnected=true;
		}
		if ($isConnected) return ($row['persoId']);
		else return 0;
		}            
		// Si une erreur est capturée nous affichons le message d'erreur
		catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			return 0;
		}
	}

	function insertUser($mail,$pwd,$nom,$fo,$dex,$con,$agi,$mag,$genre,$conn)
	{
		try{
			$requete = $conn->prepare("INSERT INTO joueur (joueurId,joueurLogin,joueurMdp) VALUES (null,:mail,:pwd)");
			$requete->bindValue(':mail',$mail , PDO::PARAM_STR);
			$requete->bindValue(':pwd',$pwd , PDO::PARAM_STR);
			$requete->execute(); 
			$id_joueur = $conn->lastInsertId();
			$requete = $conn->prepare("INSERT INTO personnage (persoId,persoNom,persoFor,persoDex,persoCon,persoAgi,persoMag,genreIdfk,joueurIdfk) VALUES (null,:nom,:fo,:dex,:con,:agi,:mag,:genre,:id_joueur)");
			$requete->bindValue(':nom',$nom,PDO::PARAM_STR);
			$requete->bindValue(':fo',$fo,PDO::PARAM_INT);
			$requete->bindValue(':dex',$dex,PDO::PARAM_INT);
			$requete->bindValue(':con',$con,PDO::PARAM_INT);
			$requete->bindValue(':agi',$agi,PDO::PARAM_INT);
			$requete->bindValue(':mag',$mag,PDO::PARAM_INT);
			$requete->bindValue(':genre',$genre,PDO::PARAM_INT);
			$requete->bindValue(':id_joueur',$id_joueur,PDO::PARAM_INT);
			$requete->execute(); 
			$id_perso = $conn->lastInsertId();
			return $id_perso;
		}            
		catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			return 0;
		}	
	}
	
	function selectPerso($joueurId,$conn)
	{
		try{
		// On prépare la requête
		$requete = $conn->prepare("SELECT persoId,persoNom,persoFor,persoDex,persoCon,persoAgi,persoMag,genreIdfk,joueurIdfk FROM joueur INNER JOIN personnage ON joueur.joueurId=personnage.joueurIdfk WHERE persoId = :persoId");
		// On lie les variables définies au-dessus aux paramètres de la requête préparée
		$requete->bindValue(':persoId',$joueurId , PDO::PARAM_INT);
		//On exécute la requête
		$requete->execute();
		// On récupère le résultat
		$data = $requete->fetch(PDO::FETCH_ASSOC);
		return array(true, $data);
		}            
		// Si une erreur est capturée nous affichons le message d'erreur
		catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			return array(false,"");
		}
	}

	
	
?>