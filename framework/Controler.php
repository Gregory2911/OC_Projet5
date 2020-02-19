<?php

require_once 'Request.php';
require_once 'view/frontend/View.php';

abstract class Controler
{
	//action à réaliser
	private $action;

	//requête entrante
	protected $request;


	//défini la requête entrante
	public function setRequest(Request $request)
	{
		$this->request = $request;
	}

	//Exécute l'action à réaliser
	public function executeAction($action)
	{
		if (method_exists($this, $action))
		{
			$this->action = $action;
			$this->{$this->action}();
		}
		else
		{
			$classControler = get_class($this);
			throw new Exception("Action " . $action . " non définie dans la classe " . $classControler);			
		}		
	}

	//Méthode abstraite correspondant à l'action par défaut
	//Oblige les classes enfants à implémenter cette action par défaut
	//public abstract function index();

	//Génère la vue associée au controleur courant
	protected function generateView($dataView = array())
	{
		//Détermination du nom du fichier vue à partir du nom du contrôleur actuel
		$classControler = get_class($this);
		$controler = str_replace("Controler", "", $classControler);
		$action = $this->action ."View";
		//Instanciation et génération de la vue
		$view = new View($action, $controler);
		$view->generate($dataView);
	}
}