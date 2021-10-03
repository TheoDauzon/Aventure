<?php

require_once "../outil/phpTools.php";

//verification des paramètres
if (!verifParam("form2AvatarNom","POST") || !verifParam("form2Genre","POST") || !verifParam("form2force","POST") || !verifParam("form2agilite","POST") || !verifParam("form2dexterite","POST") || !verifParam("form2constitution","POST") || !verifParam("form2magie","POST") || !verifParam("form2Login","POST") || !verifParam("form2Mdp","POST"))
{	
	//pas de param ou mauvais params tu dégages Pirate !
	header('Location: ../controleur/index.php');
	exit();
	
}
else{	
	//Récupération des paramètres
	$nom=strip_tags($_POST["form2AvatarNom"]);
	$genre=(int)$_POST["form2Genre"];
	$fo=(int)$_POST["form2force"];
	$agi=(int)$_POST["form2agilite"];
	$dex=(int)$_POST["form2dexterite"];
	$con=(int)$_POST["form2constitution"];
	$mag=(int)$_POST["form2magie"];
	$login=strip_tags($_POST["form2Login"]);
	$pwd=password_hash(strip_tags($_POST["form2Mdp"]), PASSWORD_DEFAULT);	
	//on se connecte à la base et on fait l'enregistrement des données
	
	// partie donnnées
	require_once "../modele/BDDConnexion.php";
	require_once "../modele/BDDRequete.php";

	// Vérifier qu'il n'y a pas un compte déjà créé avec cette email
	require_once "../vue/pageEntete.php";

	if (!existUser($login,$conn)) 
	{
		//Appel de la fonction d'insertion 
		$noPerso=insertUser($login,$pwd,$nom,$fo,$dex,$con,$agi,$mag,$genre,$conn);

		// partie Affichage
		if ($noPerso!=0) // l'insertion se déroule correctement
		{
			header('Location: ../controleur/pageJeu.php?p='.$noPerso.'&ph='.sha1($noPerso));
			exit();
		}
		else
		{	
			// L'insertion n'a pas fonctionné
			$errorInscription=true; // dis à pageIndexColInscription d'afficher une erreur
			$errorInscriptionMsg="Nous avons rencontrer une erreur,<br>Veuillez recommencer !";
			require_once "../vue/pageIndexColInscription.php";
			
		}
	}
	else
	{
		$errorInscription=true; // dis à pageIndexColInscription d'afficher une erreur
		$errorInscriptionMsg="Cette adresse existe déjà !";
		require_once "../vue/pageIndexColInscription.php";

	}
	require_once "../vue/pagePied.php";
}

	//Fermeture de la connexion
	$conn=null;

