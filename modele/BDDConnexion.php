<?php
//Informations nécessaires à la connexion
$servername = 'localhost';
$dbname='aventure';
$username = 'root';
$password = '';

//On établit la connexion   
try{
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	//Nous indiquons le mode erreur à capturer
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}            
// Si une erreur est capturée nous affichons le message d'erreur
catch(PDOException $e){
	echo "Erreur : " . $e->getMessage();
}

?>
