<?php
session_start();
require_once 'framework/Configuration.php';

Class View
{
	//Nom du fichier associé à la vue
	private $file;
	//Titre de la vue (défini dans le fichier vue)
	private $title;

	public function __construct($action, $controler = "")
	{
		//Détermination du nom du fichier vue à partir de l'action
		$file = "view/";
		if ($controler != "")
		{
			$file = $file . $controler . "/";			
		}
		$this->file = $file . $action . ".php";
	}

	//Génère et affiche la vue
	public function generate($data)
	{
		//Génération de la partie spécifique de la vue
		$content = $this->generateFile($this->file, $data);
		//On définit une variable locale accessible par la vue pour la racine web
		//Il s'agit du chemine vers le site sur le serveur Web
		//Nécessaire pour les URL de type controler/action/id
		$racineWeb = Configuration::get("racineWeb","/");
		//Génération du template commun utilisant la partie spécifique
		$view = $this->generateFile('view/template.php',array('title' => $this->title, 'content' => $content, 'racineWeb' => $racineWeb));
		//Renvoi la vue au navigateur
		echo $view;
	}

	//Génère un fichier vue et renvoie le résultat produit
	private function generateFile($file, $data)
	{
		if (file_exists($file))
		{
			//Rend les éléments du tableau $donnees accessibles dans la vue
			extract($data);
			ob_start();
			//inclut le fichier vue
			//son résultat est placé dans le tampon de sortie
			require $file;
			return ob_get_clean();			
		}
		else
		{
			throw new Exception("Fichier " .$file . " introuvable");			
		}
	}

	//Nettoie une valeur insérée dans une page HTML
	private function sanitize($value)
	{
		return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
	}
}