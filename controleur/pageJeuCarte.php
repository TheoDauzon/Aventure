<?php
// Taille de la carte
$x = 10;
$y = 10;

// Si nous avons déjà parcouru la carte elle est en paramètres
// On la charge

if (isset($_POST["tabCarte"]) && isset($_POST["tabCarteDecouvert"]) && isset($_POST["tabCarteHash"]) && isset($_POST["tabCarteDecouvertHash"]) && sha1($_POST["tabCarte"])==$_POST["tabCarteHash"] && sha1($_POST["tabCarteDecouvert"])==$_POST["tabCarteDecouvertHash"])
{	
	$tabCarte=unserialize($_POST["tabCarte"]);
	$tabCarteDecouvert=unserialize($_POST["tabCarteDecouvert"]);
}
else //initialisation de la carte
{	
	// 0 => case bloquée
	// 1 => case libre
	// 2 => porte
	$tabCarte=
	[
		[0,1,1,1,0,0,1,1,1,1],
		[0,0,0,1,1,1,1,0,1,1],
		[1,1,0,1,1,1,1,0,1,1],
		[1,1,0,1,0,0,1,0,1,1],
		[1,1,1,1,0,0,1,0,0,0],
		[0,0,1,1,1,1,1,1,1,1],
		[0,0,1,0,1,1,0,0,1,1],
		[1,1,1,0,1,1,1,0,1,1],
		[1,1,1,0,0,1,1,0,0,1],
		[1,1,0,0,0,1,1,1,1,2]
	];	
	// 0=> case non découverte
	// 1=> case découverte
	$tabCarteDecouvert=
	[
		[0,0,0,0,0,0,0,0,0,0],
		[0,0,0,0,0,0,0,0,0,0],
		[0,0,0,0,0,0,0,0,0,0],
		[0,0,0,0,0,0,0,0,0,0],
		[0,0,0,0,0,0,0,0,0,0],
		[0,0,0,0,0,0,0,0,0,0],
		[0,0,0,0,0,0,0,0,0,0],
		[0,0,0,0,0,0,0,0,0,0],
		[0,0,0,0,0,0,0,0,0,0],
		[0,0,0,0,0,0,0,0,0,0]
	];
	
}

$direction = "";
// Parcours des paramètres à la recherche de la direction
foreach($_POST as $name_post => $element){
	if ($name_post=="nord" || $name_post=="sud" || $name_post=="ouest" || $name_post=="est")
	{$direction=$name_post;}
}

$porteTrouve=false;
if ($direction=="")
{ // position par défaut si aucune direction
	$xInit=3;
	$yInit=0;
	$tabCarteDecouvert[$yInit][$xInit]=1;
}
elseif ((int)$_POST["xInit"]<0 || (int)$_POST["xInit"] >= $x || (int)$_POST["yInit"]<0 || (int)$_POST["yInit"] >= $y)
{
	//mauvais params tu dégages Pirate !
	header('Location: ../controleur/index.php');
	exit();	
}
else { 
//On conserve la position précédente
	$xInitDep=$xInit=(int)$_POST["xInit"];
	$yInitDep=$yInit=(int)$_POST["yInit"];
	switch ($direction) {
		case("nord"):
			$yInit--;
			break;
		case("sud"):
			$yInit++;
			break;
		case("est"):
			$xInit++;
			break;
		case("ouest"):
			$xInit--;
			break;
	}
	// Si les coordonnées sortent de la map alors retour aux coordonnées précédentes
	if ($yInit<0 || $xInit<0 || $yInit==$y || $xInit==$x)
	{
		$xInit=$xInitDep;
		$yInit=$yInitDep;
	}
	elseif ($tabCarte[$yInit][$xInit]==2) 	//Est-ce que la porte est sur la nouvelle case ?
	{
		$porteTrouve=true;
		$tabCarteDecouvert[$yInit][$xInit]=1;
	}
	else {
			$tabCarteDecouvert[$yInit][$xInit]=1;
			// si la case est bloquée / on coche la case en bloquée
			// retour aux coordonnées de départ
			if ($tabCarte[$yInit][$xInit]==0)
			{
				$xInit=$xInitDep;
				$yInit=$yInitDep;
			}
	}
}


// Stockage des tables pour passage en paramètre
$strTabCarte=serialize($tabCarte);
$strTabCarteHash=sha1($strTabCarte);
$strTabCarteDecouvert=serialize($tabCarteDecouvert);
$strTabCarteDecouvertHash=sha1($strTabCarteDecouvert);
?>