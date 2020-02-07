<?php

Class View
{
	//Nom du fichier associé à la vue
	private $file;
	//Titre de la vue (défini dans le fichier vue)
	private $title;

	public function __construct($action)
	{
		//Détermination du nom du fichier vue à partir de l'action
		$this->file = "View/frontend/" . $action . ".php";
	}

	//Génère et affiche la vue
	public function generate($data)
	{
		//Génération de la partie spécifique de la vue
		$content = $this->generateFile($this->file, $data);
		//Génération du template commun utilisant la partie spécifique
		$view = $this->generateFile('View/frontend/template.php',array('title' => $this->title, 'content' => $content));
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
}