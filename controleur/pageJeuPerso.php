<?php

require_once "../classe/Personnage.class.php";
// si un personnage a été passé en paramètre
if (isset($_POST["perso"]) && isset($_POST["persoHash"]) && $_POST["persoHash"]==sha1($_POST["perso"]) ) 
{ // Récupération de l'objet
	$perso=unserialize(urldecode($_POST['perso']));
}
elseif (isset($_GET["p"]) && isset($_GET["ph"]) && $_GET["ph"]==sha1($_GET["p"]) )  
{ 
	// récupération du perso
	list($result,$persoTab)=selectPerso((int)$_GET["p"],$conn);
	if ($result) 
	{
		$perso=new Personnage($persoTab);
	}
	else 
	{
		//pas de param ou mauvais params tu dégages Pirate !
		header('Location: ../controleur/index.php');
		exit();
	}
}
else {
	header('Location: ../controleur/index.php');
	exit();
}
// Stockage du personnage pour passage 
$strPerso=urlencode(serialize($perso)) ;
$strPersoHash=sha1($strPerso) ;
?>