<?php
// Classe - Le nom de la classe commence par une majuscule

class Personnage
{
	// Propriétés de la classe
	// elles sont préivées 
	// le nom commence par un _
	private $_persoId;
	private $_persoNom;
	private $_persoFor;
	private $_persoDex;
	private $_persoCon;
	private $_persoAgi;
	private $_persoMag;
	private $_genreIdfk;
	private $_joueurIdfk;
	
	// constructeur de la classe 
	// appelé au moment de la création de l'objet
	// instanciation de la classe
	public function __construct($perso)
	{
		$this->_set_persoId((int)$perso["persoId"]);
		$this->_set_persoNom($perso["persoNom"]);
		$this->_set_persoFor((int)$perso["persoFor"]);
		$this->_set_persoDex((int)$perso["persoDex"]);
		$this->_set_persoCon((int)$perso["persoCon"]);
		$this->_set_persoAgi((int)$perso["persoAgi"]);
		$this->_set_persoMag((int)$perso["persoMag"]);
		$this->_set_genreIdfk((int)$perso["genreIdfk"]);
		$this->_set_joueurIdfk((int)$perso["joueurIdfk"]);
	}

	// méthode accesseur permet d'accéder aux données
	// set -> setteur permet de modifier une propriété

	private function _set_persoId($valeur) { $this->_persoId = $valeur;}
	private function _set_persoNom($valeur) { $this->_persoNom = $valeur;}
	private function _set_persoFor($valeur) { $this->_persoFor = $valeur;}
	private function _set_persoDex($valeur) { $this->_persoDex = $valeur;}
	private function _set_persoCon($valeur) { $this->_persoCon = $valeur;}
	private function _set_persoAgi($valeur) { $this->_persoAgi = $valeur;}
	private function _set_persoMag($valeur) { $this->_persoMag = $valeur;}
	private function _set_genreIdfk($valeur) { $this->_genreIdfk = $valeur;}
	private function _set_joueurIdfk($valeur) { $this->_joueurIdfk = $valeur;}
	

	//La classe peut contenir des méthodes, privées ou publiques. 
	//Les méthodes publiques seront accessibles depuis une instance de la classe. 
	//Les méthodes privées ne peuvent être utilisées qu’à l’intérieur de la classe. 
	//Ces méthodes sont des fonctions avec ou sans valeur de retour, avec ou sans paramètres. 
	public function getBonus($carac) 
	{
		return (int)$carac-10 ;
	}
	public function attaque()
	{
		$degat=rand(0,5) + $this->getBonus($this->_persoFor);
		if ($degat>=0) return $degat;
		else return 0; 
	}
	
	// méthode accesseur permet d'accéder aux données
	// get -> getteur permet de récupérer la valeur d'une propriété  
	
	public function get_persoId() { return $this->_persoId;}
	public function get_persoNom() { return $this->_persoNom;}
	public function get_persoFor() { return $this->_persoFor;}
	public function get_persoDex() { return $this->_persoDex;}
	public function get_persoCon() { return $this->_persoCon;}
	public function get_persoAgi() { return $this->_persoAgi;}
	public function get_persoMag() { return $this->_persoMag;}
	public function get_genreIdfk() { return $this->_genreIdfk;}
	public function get_joueurIdfk() { return $this->_joueurIdfk;}
	
	
}