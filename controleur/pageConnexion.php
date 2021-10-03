<?php

require_once "../outil/phpTools.php";

//verification des paramètres
if (!verifParam("form1Login","POST") || !verifParam("form1Mdp","POST"))
{	
	//pas de param tu dégages Pirate !
	header('Location: ../controleur/index.php');
	exit();
}
else// sinon on écrit une erreur
{	
	$mail=strip_tags($_POST["form1Login"]);
	$pwd=strip_tags($_POST["form1Mdp"]);
	
	// partie donnnées
	require_once "../modele/BDDConnexion.php";
	require_once "../modele/BDDRequete.php";
	
	// partie Affichage
	require_once "../vue/pageEntete.php";
	$noPerso=connectUser($mail,$pwd,$conn);
	if ($noPerso!=0)
	{
		// Tout va bien go page Jeu
		header('Location: ../controleur/pageJeu.php?p='.$noPerso.'&ph='.sha1($noPerso));
		exit();
	}
	else
	{	
		// l'utilisateur n'existe pas ou la saisie est incorrect
		$errorConnexion=true; // dis à pageIndexColConnexion d'afficher une erreur
		require_once "../vue/pageIndexColConnexion.php";
		
	}
	require_once "../vue/pagePied.php";
	//Fermeture de la connexion
	$conn=null;
}


