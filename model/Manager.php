<?php

namespace OpenClassrooms\Blog\Model;

abstract class Manager
{
	//Objet PDO d'accès à la BD
	private $bdd;

	//Exécute une requête SQL éventuellement paramétrée 
	protected function executeRequete($sql, $params = null)
	{
		if ($params == null)
		{
			$resultat = $this->dbConnect()->query($sql); //execution directe sans paramètre
		}
		else
		{			
			$resultat = $this->dbConnect()->prepare($sql); //requête préparée
			$resultat->execute($params);
		}
		return $resultat;
	}

	//renvoi un objet de connexion à la BD en initialisant la connexion au besoin
	protected function dbConnect()
	{
		if ($this->bdd == null)
		{
			//création de la connexion
			$this->bdd = new \PDO('mysql:host=localhost;dbname=tp_MVC;charset=utf8', 'root', '');	
		}		
        return $this->bdd;
	}
}