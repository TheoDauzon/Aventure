<?php


// partie donnnées
require_once "../modele/BDDConnexion.php";
require_once "../modele/BDDRequete.php";

//Gestion du personnage
require_once "../controleur/pageJeuPerso.php";

//gestion de la carte
require_once "../controleur/pageJeuCarte.php";


//Fermeture de la connexion
$conn=null;


// appel de l'affichage
require_once "../vue/pageJeuAffichage.php";
