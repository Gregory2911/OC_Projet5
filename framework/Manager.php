<?php

require_once 'Configuration.php';
//namespace OpenClassrooms\Blog\Model;

abstract class Manager
{
	//Objet PDO d'accès à la BD
	private static $bdd; 

	//Exécute une requête SQL éventuellement paramétrée 
	protected function executeRequete($sql, $params = null)
	{
		if ($params == null)
		{
			$resultat = self::dbConnect()->query($sql); //execution directe sans paramètre
		}
		else
		{			
			$resultat = self::dbConnect()->prepare($sql); //requête préparée			
			$resultat->execute($params);
		}		
		return $resultat;
	}

	//renvoi un objet de connexion à la BD en initialisant la connexion au besoin
	private static function dbConnect()
	{
		if (self::$bdd == null)
		{
			//Récupération des paramètres de configuration DB
			$dsn = Configuration::get("dsn");
			$login = Configuration::get("login");
			$password = Configuration::get("password");
			//Création de la connexion			
			self::$bdd = new PDO($dsn, $login, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}		
        return self::$bdd;
	}
}